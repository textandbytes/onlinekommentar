<template>
  <div class="bg-white lg:pt-8 lg:pb-12 md:max-w-[1225px] md:mx-auto md:mb-auto print:overflow-visible print:m-0 print:p-0 print:w-full print:table">
    <div class="bg-white px-4 md:px-12 lg:px-24 xl:px-32 print:hidden sticky -top-px z-10">
      <div class="flex items-center justify-between border-b border-black md:grid md:grid-cols-3 md:gap-px lg:py-4">
        <FlyoutMenuFullWidth
          v-if="hasSlot('table-of-contents')"
          :label="$t('table_of_contents')"
          class="flex items-center py-2 md:py-4"
          menu-classes="top-16">
          <div class="p-4 toc">
            <slot name="table-of-contents" />
          </div>
        </FlyoutMenuFullWidth>
        <div v-else class="py-2 md:py-4">&nbsp;</div>

        <div class="items-center justify-center hidden font-serif text-2xl md:flex text-center">
          {{ commentary.title }}
        </div>

        <FlyoutMenuFullWidth
          v-if="versions && activeVersion"
          :label="$t('version') + ': ' + activeVersion.label_date_only"
          class="flex items-center justify-end py-2 md:py-4"
          menu-classes="top-16">
          <VersionsPanel
            :versions="versions"
            :active-version="activeVersion"
            @on-select="loadVersionWithTimestamp"
            @on-compare="compareVersions">
          </VersionsPanel>
        </FlyoutMenuFullWidth>
        <div v-else class="py-2 md:py-4">&nbsp;</div>
      </div>
    </div>

    <div class="px-4 md:px-12 lg:px-24 xl:px-32">

      <div class="flex flex-col items-center my-8 space-y-6 md:my-12">
        <div v-if="commentary.original_language && (commentary.original_language !== commentary.locale)" class="p-4 text-sm font-medium text-white bg-ok-red">
          {{ $t("ATTENTION: This version of the commentary is an automatic machine translation of the original. The original version is in :original_language. The translation was done with www.deepl.com. Only the original version is authoritative. The translated form of the commentary cannot be cited.", { original_language: $t(commentary.original_language) }) }}
        </div>

        <div class="font-sans text-xs tracking-widest uppercase">
          {{ $t('commentary_on') }}
        </div>

        <div class="font-serif text-3xl md:text-4xl xl:text-5xl text-center">
          {{ commentary.title }}
        </div>

        <div class="text-center lg:text-xl">
          <p v-if="commentary.assigned_authors && commentary.assigned_authors.length > 0 && commentary.assigned_authors[0] !== ''">
            {{ $t('commentary_by') }} 
            <i>
              <template v-for="assigned_author, index in commentary.assigned_authors">
                <span v-if="index !== 0"> / </span>
                <a class="underline decoration-ok-beige hover:decoration-ok-gray" :href="basePathPrefix + 'autoren/' + assigned_author.slug">
                  {{ assigned_author.name }}
                </a>
              </template>
            </i>
          </p>
          <p v-if="commentary.assigned_editors && commentary.assigned_editors.length > 0 && commentary.assigned_editors[0] !== ''">
            {{ $t('edited_by') }} 
            <i>
              <template v-for="assigned_editor, index in commentary.assigned_editors">
                <span v-if="index !== 0"> / </span>
                <a class="underline decoration-ok-beige hover:decoration-ok-gray" :href="basePathPrefix + 'herausgeber/' + assigned_editor.slug">
                  {{ assigned_editor.name }}
                </a>
              </template>
            </i>
          </p>
        </div>

        <FlyoutMenuFullWidth
          v-if="commentary"
          :label="$t('suggested_citation')"
          class="relative flex justify-center w-full md:w-2/3 print:hidden"
          menu-classes="top-8">
          <SuggestedCitationsPanel :commentary="commentary" class="print:hidden" />
        </FlyoutMenuFullWidth>
        <div id="print-suggested-citations" class="hidden print:block">
          <span class="text-xs tracking-widest uppercase">
              {{ $t('suggested_citation') }}
          </span>
          <SuggestedCitationsPanel :commentary="commentary" />
        </div>
      </div>

      <div v-if="localizedLegalText != ''" class="flex flex-col p-4 space-y-4 md:p-8 bg-ok-orange md:space-y-6">
        <div class="flex justify-end print:hidden">
          <span @click="setLegalTextLocale('de')" class="legal-text-locale-link" :class="{ active: legalTextLocale == 'de' }">de</span>
          <span @click="setLegalTextLocale('fr')" class="legal-text-locale-link" :class="{ active: legalTextLocale == 'fr' }">fr</span>
          <span @click="setLegalTextLocale('it')" class="legal-text-locale-link" :class="{ active: legalTextLocale == 'it' }">it</span>
          <span @click="setLegalTextLocale('en')" class="legal-text-locale-link" :class="{ active: legalTextLocale == 'en' }">en</span>
        </div>
        <div v-html="localizedLegalText" class="localized-legal-text space-y-4 font-serif lg:text-xl md:space-y-6">
        </div>
      </div>

      <div class="my-8 content">
        <slot name="content" />
      </div>

      <div v-if="store.footnotes.length > 0" class="footnotes">
          <h2 class="mt-12 mb-6 font-sans text-xl tracking-wider uppercase lg:text-2xl">
              {{ $t('footnotes') }}
          </h2>
          <ul>
              <li v-for="(footnote, index) in store.footnotes" :key="index" class="mb-2 ml-12 list-decimal break-words" v-html="footnote"></li>
          </ul>
      </div>

      <template v-if="commentary.additional_documents.length">
        <h2 class="mt-12 mb-4 font-sans text-xl tracking-wider uppercase">
          {{ $t('additional_documents') }}
        </h2>
        <p v-for="additional_document in commentary.additional_documents" class="mt-2">
          <a :href="additional_document.url" download>
            <svg xmlns="http://www.w3.org/2000/svg" width="20.571" height="24" viewBox="0 0 20.571 24" class="inline mr-2">
              <path id="Icon_metro-file-pdf" data-name="Icon metro-file-pdf" d="M22.231,7.293a3.116,3.116,0,0,1,.643,1.018,3.091,3.091,0,0,1,.268,1.179V24.918A1.28,1.28,0,0,1,21.856,26.2h-18a1.28,1.28,0,0,1-1.286-1.286V3.489A1.28,1.28,0,0,1,3.856,2.2h12a3.092,3.092,0,0,1,1.179.268,3.116,3.116,0,0,1,1.018.643ZM16.285,4.025V9.061h5.036a1.463,1.463,0,0,0-.295-.549L16.834,4.32a1.463,1.463,0,0,0-.549-.295Zm5.143,20.464V10.775H15.856a1.28,1.28,0,0,1-1.286-1.286V3.918H4.285V24.489H21.428Zm-6.884-7.942a10.19,10.19,0,0,0,1.125.75,13.29,13.29,0,0,1,1.567-.094q1.969,0,2.371.656a.647.647,0,0,1,.027.7.039.039,0,0,1-.013.027l-.027.027v.013q-.08.509-.951.509a5.525,5.525,0,0,1-1.54-.268,9.766,9.766,0,0,1-1.741-.71,24.116,24.116,0,0,0-5.25,1.112Q8.062,22.775,6.87,22.775a.779.779,0,0,1-.375-.094l-.321-.161q-.013-.013-.08-.067a.553.553,0,0,1-.08-.482,2.908,2.908,0,0,1,.75-1.225,6.473,6.473,0,0,1,1.768-1.292.2.2,0,0,1,.308.08.077.077,0,0,1,.027.054q.7-1.138,1.433-2.638a20.441,20.441,0,0,0,1.393-3.509,10.826,10.826,0,0,1-.409-2.136A5.207,5.207,0,0,1,11.37,9.6q.147-.536.563-.536h.295a.565.565,0,0,1,.469.2,1.07,1.07,0,0,1,.121.911.29.29,0,0,1-.054.107.349.349,0,0,1,.013.107v.4a17.538,17.538,0,0,1-.187,2.571,6.776,6.776,0,0,0,1.955,3.188Zm-7.714,5.5a5.914,5.914,0,0,0,1.835-2.116,7.635,7.635,0,0,0-1.172,1.125A4.452,4.452,0,0,0,6.83,22.052ZM12.16,9.73a3.982,3.982,0,0,0-.027,1.768q.013-.094.094-.589,0-.04.094-.576a.3.3,0,0,1,.054-.107.039.039,0,0,1-.013-.027.027.027,0,0,0-.007-.02.027.027,0,0,1-.007-.02.771.771,0,0,0-.174-.482.039.039,0,0,1-.013.027V9.73ZM10.5,18.583A19.644,19.644,0,0,1,14.3,17.5a2.02,2.02,0,0,1-.174-.127,2.4,2.4,0,0,1-.214-.181,7.094,7.094,0,0,1-1.7-2.357A17.9,17.9,0,0,1,11.1,17.471q-.4.75-.6,1.112Zm8.652-.214a3.205,3.205,0,0,0-1.875-.321,5.066,5.066,0,0,0,1.661.375,1.3,1.3,0,0,0,.241-.013q0-.013-.027-.04Z" transform="translate(-2.571 -2.204)"/>
            </svg> {{ additional_document.title }}
          </a>
        </p>
      </template>

      <template v-if="commentary.pdf_commentary_filename !== ''">
        <h2 class="mt-12 mb-4 font-sans text-xl tracking-wider uppercase">
          {{ $t('download_pdf') }}
        </h2>
        <p>
          <a :href="commentary.pdf_commentary_path + commentary.pdf_commentary_filename" download>
            <svg xmlns="http://www.w3.org/2000/svg" width="20.571" height="24" viewBox="0 0 20.571 24" class="inline mr-2">
              <path id="Icon_metro-file-pdf" data-name="Icon metro-file-pdf" d="M22.231,7.293a3.116,3.116,0,0,1,.643,1.018,3.091,3.091,0,0,1,.268,1.179V24.918A1.28,1.28,0,0,1,21.856,26.2h-18a1.28,1.28,0,0,1-1.286-1.286V3.489A1.28,1.28,0,0,1,3.856,2.2h12a3.092,3.092,0,0,1,1.179.268,3.116,3.116,0,0,1,1.018.643ZM16.285,4.025V9.061h5.036a1.463,1.463,0,0,0-.295-.549L16.834,4.32a1.463,1.463,0,0,0-.549-.295Zm5.143,20.464V10.775H15.856a1.28,1.28,0,0,1-1.286-1.286V3.918H4.285V24.489H21.428Zm-6.884-7.942a10.19,10.19,0,0,0,1.125.75,13.29,13.29,0,0,1,1.567-.094q1.969,0,2.371.656a.647.647,0,0,1,.027.7.039.039,0,0,1-.013.027l-.027.027v.013q-.08.509-.951.509a5.525,5.525,0,0,1-1.54-.268,9.766,9.766,0,0,1-1.741-.71,24.116,24.116,0,0,0-5.25,1.112Q8.062,22.775,6.87,22.775a.779.779,0,0,1-.375-.094l-.321-.161q-.013-.013-.08-.067a.553.553,0,0,1-.08-.482,2.908,2.908,0,0,1,.75-1.225,6.473,6.473,0,0,1,1.768-1.292.2.2,0,0,1,.308.08.077.077,0,0,1,.027.054q.7-1.138,1.433-2.638a20.441,20.441,0,0,0,1.393-3.509,10.826,10.826,0,0,1-.409-2.136A5.207,5.207,0,0,1,11.37,9.6q.147-.536.563-.536h.295a.565.565,0,0,1,.469.2,1.07,1.07,0,0,1,.121.911.29.29,0,0,1-.054.107.349.349,0,0,1,.013.107v.4a17.538,17.538,0,0,1-.187,2.571,6.776,6.776,0,0,0,1.955,3.188Zm-7.714,5.5a5.914,5.914,0,0,0,1.835-2.116,7.635,7.635,0,0,0-1.172,1.125A4.452,4.452,0,0,0,6.83,22.052ZM12.16,9.73a3.982,3.982,0,0,0-.027,1.768q.013-.094.094-.589,0-.04.094-.576a.3.3,0,0,1,.054-.107.039.039,0,0,1-.013-.027.027.027,0,0,0-.007-.02.027.027,0,0,1-.007-.02.771.771,0,0,0-.174-.482.039.039,0,0,1-.013.027V9.73ZM10.5,18.583A19.644,19.644,0,0,1,14.3,17.5a2.02,2.02,0,0,1-.174-.127,2.4,2.4,0,0,1-.214-.181,7.094,7.094,0,0,1-1.7-2.357A17.9,17.9,0,0,1,11.1,17.471q-.4.75-.6,1.112Zm8.652-.214a3.205,3.205,0,0,0-1.875-.321,5.066,5.066,0,0,0,1.661.375,1.3,1.3,0,0,0,.241-.013q0-.013-.027-.04Z" transform="translate(-2.571 -2.204)"/>
            </svg> {{ commentary.title }}
          </a>
        </p>
      </template>

      <h2 class="mt-12 mb-4 font-sans text-xl tracking-wider uppercase print:hidden">
        {{ $t('print_commentary') }}
      </h2>

      <p class="print:hidden">
        <button @click="printCommentary()" class="ok-button">
          <span class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
            </svg> <span class="ml-2">{{ $t('print') }}</span>
          </span>
        </button>
      </p>

      <h2 v-if="commentary.doi" class="mt-12 mb-4 font-sans text-xl tracking-wider uppercase">
        DOI (Digital Object Identifier)
      </h2>

      <p v-if="commentary.doi">
        <div class="text-xl">{{ commentary.doi }}</div >
        <div><a class="underline" target="_blank" :href="'https://doi.org/' + commentary.doi">https://doi.org/{{ commentary.doi }}</a></div >
      </p>

      <h2 class="mt-12 mb-4 font-sans text-xl tracking-wider uppercase">
        {{ $t('creative_commons_license') }}
      </h2>

      <p class="license">
        Onlinekommentar.ch, {{ $t('commentary_on') }} {{ commentary.title }} <span v-html="$t('creative_commons_text')"></span>
      </p>
      <p class="mt-4"><a href="http://creativecommons.org/licenses/by/4.0/"><img src="/img/cc-license.png" alt="Creative Commons"></a></p>

    </div>

  </div>
</template>

<script setup>
  import { ref, useSlots, computed, onMounted, nextTick } from 'vue'
  import FlyoutMenuFullWidth from '@/components/Menus/FlyoutMenuFullWidth'
  import VersionsPanel from '@/components/Pages/Partials/VersionsPanel'
  import SuggestedCitationsPanel from '@/components/Pages/Partials/SuggestedCitationsPanel'
  import { store } from '@/composables/store.js'
  import axios from 'axios'

  const props = defineProps({
    locale: { type: String, required: true },
    commentary: { type: Object, required: true },
    versions: { type: Array, required: false, default: null },
    versionTimestamp: { type: String, required: false, default: null },
    basePathPrefix: { type: String, required: true }
  })

  const slots = useSlots()
  const hasSlot = (name) => !!slots[name]

  const legalTextLocale = ref(props.commentary.locale)
  let localizedLegalText = ref(props.commentary.legal_text)

  onMounted(async () => {
    await nextTick();
    document.querySelector(window.location.hash)?.scrollIntoView();
  })

  const printCommentary = () => {
    window.print()
  }

  const activeVersion = computed(() => {
    const version = props.versions.find(version => {
      return version.id == props.versionTimestamp
    })
    // return the most recently published version if a version for the timestamp could not found
    return version ?? props.versions[0]
  })

  const setLegalTextLocale = (locale) => {
    // filter all commentary entries by the given locale and commentary slug and return the legal text field
    axios.get('/api/collections/commentaries/entries/?filter[site]=' + locale + '&filter[slug]=' + props.commentary.slug + '&fields=legal_text')
      .then(response => {
        localizedLegalText.value = response.data.data[0].legal_text
      })
      .catch(error => {})

    legalTextLocale.value = locale
  }

  const loadVersionWithTimestamp = (timestamp) => {
    // redirect to the revision with the given timestamp
    window.location.href = '/' + props.locale + '/kommentare/' + props.commentary.slug + (timestamp == props.versions[0].timestamp ? '' : '/versions/' + timestamp)
  }

  const compareVersions = (versions) => {
    // compare the two selected revisions, redirect to the commentary detail view and display comparison result in a modal dialog
    window.location.href = '/' + props.locale + '/commentaries/' + props.commentary.id + '/revisions/' + versions[0].timestamp + '/compare/' + versions[1].timestamp + (props.versionTimestamp ? '/versions/' + props.versionTimestamp : '')
  }
</script>

<style lang="postcss" scoped>
  .content {

    :deep(h2) {
      @apply uppercase font-sans tracking-wider text-2xl mt-12 mb-6
    }

    :deep(h2 strong) {
      @apply font-medium
    }

    :deep(h3) {
      @apply font-sans tracking-wider text-2xl mt-12 mb-6 print:break-inside-avoid print:break-after-avoid
    }

    :deep(h3 strong) {
      @apply font-medium print:break-inside-avoid print:break-after-avoid
    }

    :deep(h4) {
      @apply font-sans tracking-wider text-xl mt-3 mb-6 print:break-inside-avoid print:break-after-avoid
    }

    :deep(h5) {
      @apply font-sans tracking-wider text-lg mt-3 mb-6 print:break-inside-avoid print:break-after-avoid
    }

    :deep(h6) {
      @apply font-sans tracking-wider text-base uppercase text-ok-gray mt-3 mb-6 print:break-inside-avoid print:break-after-avoid
    }

    :deep(ul) {
      @apply list-disc list-outside ml-10 mb-4
    }

    :deep(ul ul) {
      @apply list-circle
    }

    :deep(ul ul ul) {
      @apply list-square
    }

    :deep(ol) {
      @apply list-decimal list-outside ml-10 mb-4
    }

    :deep(ol ol) {
      @apply list-upper-roman
    }

    :deep(ol ol ol) {
      @apply list-lower-roman
    }

    :deep(li) {
      @apply mt-2 pl-2
    }

    :deep(li p) {
      @apply inline
    }

    :deep(p) {
      @apply lg:text-xl !leading-[1.5em] relative font-serif mb-6;
      @apply scroll-mt-12 md:scroll-mt-16 lg:scroll-mt-24;

      a {
        @apply underline break-all print:break-inside-avoid
      }

      em {
        @apply tracking-wide
      }
    }

    :deep(.paragraph-nr) {
      @apply 
        block md:absolute 
        w-max
        md:-left-8 
        md:top-1 
        md:text-sm 
        font-sans
        px-2
        bg-ok-light-beige
        rounded-full
        md:-ml-2
    }

    :deep(p:target .paragraph-nr) {
      @apply bg-ok-yellow
    }

    :deep(hr) {
      @apply my-3 border-gray-300
    }

    :deep(table) {
      @apply w-full overflow-x-auto block;
    }

    :deep(table) tbody tr:first-child {
      @apply bg-gray-100 border border-gray-400;
      p {
        @apply align-middle m-0 py-2 font-semibold;
      }
    }

    :deep(table) tbody td {
      @apply px-4 py-1 border border-gray-400;
      p {
        @apply font-sans text-base;
      }
    }

    @media (min-width: 640px) {
      :deep(table) {
        @apply inline-table;
      }
    }

  }

  .localized-legal-text {

    :deep(ul) {
      @apply list-disc list-outside ml-10
    }

    :deep(ol) {
      @apply list-decimal list-outside ml-10
    }

    :deep(li) {
      @apply mt-2 pl-2
    }

    :deep(li p) {
      @apply inline
    }

  }

  .license {
    :deep(a) {
    @apply underline
    }
  }

  .toc {
    :deep(ul > li) {
      @apply uppercase
    }

    :deep(ul li ul li) {
      @apply ml-4 normal-case
    }
  }

  .legal-text-locale-link {
    @apply flex mr-2 rounded-xl px-2 text-sm uppercase cursor-pointer
  }

  .legal-text-locale-link.active {
    @apply border border-black
  }

  .footnotes { 
    :deep(a) {
      @apply underline break-all;
    }
  }

  @media print {
    @page {
      margin: 2cm;
    }
  }
</style>