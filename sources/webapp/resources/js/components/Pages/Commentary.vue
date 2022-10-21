<template>
  <div class="px-4 overflow-hidden bg-white md:max-w-[1225px] md:mx-auto md:mb-auto md:px-12 lg:px-24 xl:px-32 lg:py-12">
    <div class="relative flex items-center justify-between border-b border-black lg:pb-4 md:grid md:grid-cols-3 md:gap-px">
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

      <div class="items-center justify-center hidden font-serif text-2xl md:flex">
        {{ commentary.title }}
      </div>

      <FlyoutMenuFullWidth
        v-if="versions"
        :label="$t('versions')"
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

    <div class="flex flex-col items-center my-8 space-y-6 md:my-12">
      <div v-if="commentary.original_language !== commentary.locale" class="p-4 text-sm font-medium text-white bg-ok-red">
        {{ $t("ATTENTION: This version of the commentary is an automatic machine translation of the original. The original version is in :original_language. The translation was done with www.deepl.com. Only the original version is authoritative. The translated form of the commentary cannot be cited.", { original_language: $t(commentary.original_language) }) }}
      </div>
      
      <div class="font-sans text-xs tracking-widest uppercase">
        {{ $t('commentary_on') }}
      </div>

      <div class="font-serif text-3xl md:text-4xl xl:text-5xl">
        {{ commentary.title }}
      </div>

      <div class="text-center lg:text-xl">
        <p v-if="commentary.assigned_authors.length > 0 && commentary.assigned_authors[0] !== ''">
          {{ $t('commentary_by') }} <i>{{ commentary.assigned_authors.join(' ' + $t('and') + ' ') }}</i>
        </p>
        <p v-if="commentary.assigned_editors.length > 0 && commentary.assigned_editors[0] !== ''">
          {{ $t('edited_by') }} <i>{{ commentary.assigned_editors.join(' ' + $t('and') + ' ') }}</i>
        </p>
      </div>

      <FlyoutMenuFullWidth
        v-if="commentary"
        :label="$t('suggested_citation')"
        class="relative flex justify-center w-full md:w-2/3"
        menu-classes="top-8">
        <SuggestedCitationsPanel :commentary="commentary" />
      </FlyoutMenuFullWidth>
    </div>

    <div v-if="localizedLegalText != ''" class="flex flex-col p-4 space-y-4 md:p-8 bg-ok-orange md:space-y-6">
      <div class="flex justify-end">
        <span @click="setLegalTextLocale('de')" class="legal-text-locale-link" :class="{ active: legalTextLocale == 'de' }">de</span>
        <span @click="setLegalTextLocale('en')" class="legal-text-locale-link" :class="{ active: legalTextLocale == 'en' }">en</span>
        <span @click="setLegalTextLocale('fr')" class="legal-text-locale-link" :class="{ active: legalTextLocale == 'fr' }">fr</span>
        <span @click="setLegalTextLocale('it')" class="legal-text-locale-link" :class="{ active: legalTextLocale == 'it' }">it</span>
      </div>
      <div v-html="localizedLegalText" class="space-y-4 font-serif lg:text-xl md:space-y-6">
      </div>
    </div>

    <div class="my-8 content">
      <slot name="content" />
    </div>

    <template v-if="commentary.pdf_commentary_filename !== ''">
      <h2 class="mt-12 mb-4 font-sans text-xl tracking-wider uppercase">
        Download PDF
      </h2>
      <p>
        <a :href="commentary.pdf_commentary_path + commentary.pdf_commentary_filename" download>
          <svg xmlns="http://www.w3.org/2000/svg" width="20.571" height="24" viewBox="0 0 20.571 24" class="inline mr-2">
            <path id="Icon_metro-file-pdf" data-name="Icon metro-file-pdf" d="M22.231,7.293a3.116,3.116,0,0,1,.643,1.018,3.091,3.091,0,0,1,.268,1.179V24.918A1.28,1.28,0,0,1,21.856,26.2h-18a1.28,1.28,0,0,1-1.286-1.286V3.489A1.28,1.28,0,0,1,3.856,2.2h12a3.092,3.092,0,0,1,1.179.268,3.116,3.116,0,0,1,1.018.643ZM16.285,4.025V9.061h5.036a1.463,1.463,0,0,0-.295-.549L16.834,4.32a1.463,1.463,0,0,0-.549-.295Zm5.143,20.464V10.775H15.856a1.28,1.28,0,0,1-1.286-1.286V3.918H4.285V24.489H21.428Zm-6.884-7.942a10.19,10.19,0,0,0,1.125.75,13.29,13.29,0,0,1,1.567-.094q1.969,0,2.371.656a.647.647,0,0,1,.027.7.039.039,0,0,1-.013.027l-.027.027v.013q-.08.509-.951.509a5.525,5.525,0,0,1-1.54-.268,9.766,9.766,0,0,1-1.741-.71,24.116,24.116,0,0,0-5.25,1.112Q8.062,22.775,6.87,22.775a.779.779,0,0,1-.375-.094l-.321-.161q-.013-.013-.08-.067a.553.553,0,0,1-.08-.482,2.908,2.908,0,0,1,.75-1.225,6.473,6.473,0,0,1,1.768-1.292.2.2,0,0,1,.308.08.077.077,0,0,1,.027.054q.7-1.138,1.433-2.638a20.441,20.441,0,0,0,1.393-3.509,10.826,10.826,0,0,1-.409-2.136A5.207,5.207,0,0,1,11.37,9.6q.147-.536.563-.536h.295a.565.565,0,0,1,.469.2,1.07,1.07,0,0,1,.121.911.29.29,0,0,1-.054.107.349.349,0,0,1,.013.107v.4a17.538,17.538,0,0,1-.187,2.571,6.776,6.776,0,0,0,1.955,3.188Zm-7.714,5.5a5.914,5.914,0,0,0,1.835-2.116,7.635,7.635,0,0,0-1.172,1.125A4.452,4.452,0,0,0,6.83,22.052ZM12.16,9.73a3.982,3.982,0,0,0-.027,1.768q.013-.094.094-.589,0-.04.094-.576a.3.3,0,0,1,.054-.107.039.039,0,0,1-.013-.027.027.027,0,0,0-.007-.02.027.027,0,0,1-.007-.02.771.771,0,0,0-.174-.482.039.039,0,0,1-.013.027V9.73ZM10.5,18.583A19.644,19.644,0,0,1,14.3,17.5a2.02,2.02,0,0,1-.174-.127,2.4,2.4,0,0,1-.214-.181,7.094,7.094,0,0,1-1.7-2.357A17.9,17.9,0,0,1,11.1,17.471q-.4.75-.6,1.112Zm8.652-.214a3.205,3.205,0,0,0-1.875-.321,5.066,5.066,0,0,0,1.661.375,1.3,1.3,0,0,0,.241-.013q0-.013-.027-.04Z" transform="translate(-2.571 -2.204)"/>
          </svg> {{ commentary.title }}
        </a>
      </p>
    </template>
    
    <h2 class="mt-12 mb-4 font-sans text-xl tracking-wider uppercase">
      {{ $t('creative_commons_license') }}
    </h2>
    <p>
      Onlinekommentar.ch, {{ $t('commentary_on') }} {{ commentary.title }} {{ $t('creative_commons_text') }}
    </p>
    <p class="mt-4"><img src="/img/cc-license.png" alt="Creative Commons"></p>
  </div>

  <Loading
    :show="isLoading"
    :label="$t('is_loading')"
  />

  <ModalDialog>
    <template v-slot:title>
      {{ $t('compare_versions') }}
    </template>
    <template v-slot:body>
      <RevisionComparisonPanel
        v-if="versionComparisonData"
        :content="versionComparisonData"
        @close="emitter.emit('close-modal-dialog')"
      />
    </template>
  </ModalDialog>
</template>

<script setup>
  import { ref, useSlots } from 'vue'
  import FlyoutMenuFullWidth from '@/components/Menus/FlyoutMenuFullWidth'
  import ModalDialog from '@/components/Modals/ModalDialog'
  import Loading from '@/components/Indicators/Loading'
  import VersionsPanel from '@/components/Pages/Partials/VersionsPanel'
  import RevisionComparisonPanel from '@/components/Pages/Partials/RevisionComparisonPanel'
  import SuggestedCitationsPanel from '@/components/Pages/Partials/SuggestedCitationsPanel'
  import axios from 'axios'
  import useEmitter from '@/composables/useEmitter'

  const emitter = useEmitter()

  const props = defineProps({
    locale: { type: String, required: true },
    commentary: { type: Object, required: true },
    versions: { type: Object, required: false, default: null },
  })

  const slots = useSlots()
  const hasSlot = (name) => !!slots[name]

  const legalTextLocale = ref(props.commentary.locale)
  let localizedLegalText = ref(props.commentary.legal_text)

  const activeVersion = ref(props.versions[0])
  const versionComparisonData = ref(null)

  const isLoading = ref(false)

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
    // set the active version
    props.versions.forEach(version => {
      if (version.timestamp === timestamp) {
        activeVersion.value = version
      }
    })
  }

  const compareVersions = (versions) => {
    versionComparisonData.value = null
    isLoading.value = true

    // compare the two selected revisions and display results in a modal dialog
    axios.get('/' + props.locale + '/commentaries/' + props.commentary.id + '/revisions/' + versions[0].timestamp + '/compare/' + versions[1].timestamp)
      .then(response => {
        isLoading.value = false
        versionComparisonData.value = response.data
        emitter.emit('open-modal-dialog')
      })
      .catch(error => {
        isLoading.value = false
        versionComparisonData.value = null
        emitter.emit('close-modal-dialog')
      })
  }
</script>

<style lang="postcss" scoped>
  .content {
    :deep(h2) {
      @apply uppercase font-sans tracking-wider text-xl lg:text-2xl mt-12 mb-6
    }

    :deep(h2 strong) {
      @apply font-medium
    }

    :deep(h3) {
      @apply font-sans tracking-wider text-xl lg:text-2xl mt-12 mb-6
    }

    :deep(h3 strong) {
      @apply font-medium
    }

    :deep(h4) {
      @apply font-sans tracking-wider text-lg mb-6
    }

    :deep(p) {
      @apply lg:text-xl !leading-[1.5em] relative font-serif mb-6;

      a {
        @apply underline break-all
      }

      em {
        @apply tracking-wide
      }
    }
    
    :deep(.paragraph-nr) {
      @apply absolute -left-8 text-sm font-sans
    }

    :deep(hr) {
      @apply my-3 border-gray-300
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
</style>