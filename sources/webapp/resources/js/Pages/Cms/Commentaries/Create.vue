<template>
  <Head title="Create Commentary" />

  <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b">
    <Link class="text-gray-500 hover:text-gray-700" href="/cms/commentaries">
      Commentaries
    </Link>
    <span class="text-gray-500 font-medium">/</span> Create
  </h1>

  <div class="max-w-7xl bg-white rounded-md shadow overflow-hidden">
    <form @submit.prevent="store">
      <div class="flex flex-col -mb-8 -mr-6 p-8">
        <TextInput
          v-model="form.label_de"
          :error="form.errors.label_de"
          :required="true"
          class="pb-8 pr-6 w-full"
          label="Label (de)"
        />

        <TipTapEditor
          v-model="form.content_de"
          :error="form.errors.content_de"
          class="pb-8 pr-6 w-full"
          label="Content (de)"
        />

        <TextInput
          v-model="form.label_en"
          :error="form.errors.label_en"
          class="pb-8 pr-6 w-full"
          label="Label (en)"
        />

        <TipTapEditor
          v-model="form.content_en"
          :error="form.errors.content_en"
          class="pb-8 pr-6 w-full"
          label="Content (en)"
        />

        <TextInput
          v-model="form.label_fr"
          :error="form.errors.label_fr"
          class="pb-8 pr-6 w-full"
          label="Label (fr)"
        />

        <TipTapEditor
          v-model="form.content_fr"
          :error="form.errors.content_fr"
          class="pb-8 pr-6 w-full"
          label="Content (fr)"
        />

        <TextInput
          v-model="form.label_it"
          :error="form.errors.label_it"
          class="pb-8 pr-6 w-full"
          label="Label (it)"
        />

        <TipTapEditor
          v-model="form.content_it"
          :error="form.errors.content_it"
          class="pb-8 pr-6 w-full"
          label="Content (it)"
        />

        <SelectInput
          v-model="form.original_language"
          :error="form.errors.original_language"
          class="pb-8 pr-6 w-full"
          label="Original language">
          <option
            v-for="(language, index) in languages"
            :value="language">
            {{ __(language) }}
          </option>
        </SelectInput>

        <TipTapEditor
          v-model="form.suggested_citation_long"
          :error="form.errors.suggested_citation_long"
          class="pb-8 pr-6 w-full"
          label="Suggested citation (long)"
        />

        <TextInput
          v-model="form.suggested_citation_short"
          :error="form.errors.suggested_citation_short"
          class="pb-8 pr-6 w-full"
          label="Suggested citation (short)"
        />
      </div>

      <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
        <LoadingButton
          :loading="form.processing"
          class="btn-indigo"
          type="submit">
          Create Commentary
        </LoadingButton>
      </div>
    </form>
  </div>
</template>

<script>
  import CmsLayout from '@/Layouts/CmsLayout.vue'
  
  export default {
    layout: CmsLayout
  }
</script>

<script setup>
  import { useForm } from '@inertiajs/inertia-vue3'
  import TextInput from '@/Shared/TextInput'
  import TipTapEditor from '@/TipTapEditor/TipTapEditor'
  import SelectInput from '@/Shared/SelectInput'
  import LoadingButton from '@/Shared/LoadingButton'

  const props = defineProps({
    languages: { type: Array, required: true }
  })

  const form = useForm({
    label_de: null,
    label_en: null,
    label_fr: null,
    label_it: null,
    content_de: null,
    content_en: null,
    content_fr: null,
    content_it: null,
    original_language: props.languages[0],
    suggested_citation_long: null,
    suggested_citation_short: null,
  })

  const store = () => {
    form.post('/cms/commentaries')
  }
</script>
