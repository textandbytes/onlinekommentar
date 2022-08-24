<template>
  <Head title="Edit Commentary" />

  <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b">
    <Link class="text-gray-500 hover:text-gray-700" href="/cms/commentaries">
      Commentaries
    </Link>
    <span class="text-gray-500 font-medium">/</span> {{ commentary.label_de }}
  </h1>

  <div class="max-w-7xl bg-white rounded-md shadow overflow-hidden">
    <form @submit.prevent="onUpdate">
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
            v-for="language in languages"
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

        <TextInput
          v-model="form.doi"
          :error="form.errors.doi"
          :required="true"
          class="pb-8 pr-6 w-full"
          label="DOI"
        />

        <TextInput
          v-model="form.slug"
          :error="form.errors.slug"
          :required="true"
          class="pb-8 pr-6 w-full"
          label="Slug"
        />
      </div>

      <div class="flex items-center justify-between px-8 py-4 bg-gray-50 border-t border-gray-100">
        <button
          v-if="$page.props.can['delete-commentaries']"
          class="text-red-600 hover:underline"
          tabindex="-1"
          type="button"
          @click="onDelete(commentary)">
          Delete Commentary
        </button>

        <LoadingButton
          :loading="form.processing"
          class="btn-indigo ml-auto"
          type="submit">
          Update Commentary
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
  import { Inertia } from '@inertiajs/inertia'
  import { useForm } from '@inertiajs/inertia-vue3'
  import TextInput from '@/Shared/TextInput'
  import TipTapEditor from '@/TipTapEditor/TipTapEditor'
  import SelectInput from '@/Shared/SelectInput'
  import LoadingButton from '@/Shared/LoadingButton'
  import useEmitter from '@/composables/useEmitter'

  const emitter = useEmitter()

  const props = defineProps({
    commentary: { type: Object, required: true },
    languages: { type: Array, required: true }
  })

  const form = useForm({
    label_de: props.commentary.label_de,
    label_en: props.commentary.label_en,
    label_fr: props.commentary.label_fr,
    label_it: props.commentary.label_it,
    content_de: props.commentary.content_de,
    content_en: props.commentary.content_en,
    content_fr: props.commentary.content_fr,
    content_it: props.commentary.content_it,
    original_language: props.commentary.original_language,
    suggested_citation_long: props.commentary.suggested_citation_long,
    suggested_citation_short: props.commentary.suggested_citation_short,
    doi: props.commentary.doi,
    slug: props.commentary.slug,
  })

  const onUpdate = () => {
    form.put(`/cms/commentaries/${props.commentary.slug}`)
  }

  const onDelete = (commentary) => {
    let payload = {
      title: 'Delete Commentary',
      message: 'Are you sure you want to delete this commentary?',
      confirmLabel: 'Delete',
      confirmCallback: () => {
        Inertia.post(`/cms/commentaries/${commentary.slug}`, { _method: 'DELETE' })
      }
    }
    emitter.emit('open-modal', payload)
  }
</script>
