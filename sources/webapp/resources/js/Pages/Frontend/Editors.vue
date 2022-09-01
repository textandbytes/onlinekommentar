<template>
  <Head>
    <title>{{ __('editors') }}</title>
  </Head>

  <div class="flex flex-col">
    <div class="lg:flex lg:items-center lg:justify-between space-y-2 lg:space-y-0 p-4 md:px-6 border-b border-black bg-white">
      <div class="text-xs uppercase font-bold">
        {{ __('editors') }}
      </div>

      <div class="flex flex-col lg:flex-row space-y-2 lg:space-x-2 lg:space-y-0">
        <FlyoutMenuWithDividers
          v-if="documents.length > 0"
          class="lg:min-w-[300px] lg:max-w-[300px] xl:min-w-[450px] xl:max-w-[450px]"
          :label="__('document_filter_label')"
          :options="documents"
          :active-option="activeDocument"
          @changed="onFilter"
        />
      </div>
    </div>

    <GridListView
      :items="editors"
      @selected="onSelected"
      class="bg-ok-beige sm:gap-x-px sm:gap-y-4">
      <template v-slot:item="editor">
        <div class="flex flex-col items-center justify-between p-4 bg-white">
          <div class="text-xs uppercase mb-4">
            {{ editor.expertise ?? 'Bundesverfassung' }}
          </div>

          <div class="flex flex-col items-center justify-between space-y-6">
            <img :src="editor.profile_photo_url" class="w-24 h-24 rounded-full" />

            <h2 class="w-3/4 text-4xl text-center font-medium font-regular leading-normal break-normal">
              {{ editor.name }}
            </h2>

            <div class="w-3/4 text-xs text-center uppercase">
              {{ editor.title }}
            </div>
          </div>

          <div class="w-full py-2 border-y-2 text-sm my-8">
            <p>
              Herausgeber:in
            </p>
            <p
              v-for="commentary in editor.edited_commentaries"
              :key="commentary.id">
              {{ commentary['label_' + $page.props.locale] }}
            </p>
          </div>

          <div class="flex items-center space-x-4">
            <a
              v-if="editor.linkedin_url"
              :href="editor.linkedin_url"
              class="inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-md text-white bg-black hover:bg-white hover:text-black"
              target="_blank"
              rel="noopener">
              LinkedIn
            </a>

            <a
              v-if="editor.website_url"
              :href="editor.website_url"
              class="inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-md text-white bg-black hover:bg-white hover:text-black"
              target="_blank"
              rel="noopener">
              Website
            </a>

            &nbsp;
          </div>
        </div>
      </template>
    </GridListView>
  </div>
</template>

<script>
  import FrontendLayout from '@/Layouts/FrontendLayout.vue'
  
  export default {
    layout: FrontendLayout
  }
</script>

<script setup>
  import GridListView from './Partials/GridListView'
  import FlyoutMenuWithDividers from '@/Menus/FlyoutMenuWithDividers'

  defineProps({
    editors: { type: Object, required: true }
  })

  const documents = [
    'Bundesverfassung',
    'Obligationenrecht',
    'Bundesgesetz über das Internationale Privatrecht',
    'Lugano-Übereinkommen',
    'Strafprozessordnung',
  ]

  const activeDocument = 'Obligationenrecht'

  const onSelected = (editor) => {}

  const onFilter = (document) => {}
</script>