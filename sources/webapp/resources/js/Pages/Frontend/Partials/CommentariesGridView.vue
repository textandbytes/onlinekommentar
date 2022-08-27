<template>
  <div class="bg-gray-800 overflow-hidden shadow divide-y divide-gray-800 sm:divide-y-0 sm:grid sm:grid-cols-3 sm:gap-px">
    <div
      v-for="commentary in commentaries"
      :key="commentary.id"
      class="flex flex-col items-center relative group transition ease-in-out delay-150 bg-white hover:bg-ok-orange p-8 cursor-pointer"
      @click="$emit('selected', commentary)">
      <div class="text-xs uppercase mb-8">
        {{ commentary.document_label ?? '&nbsp;' }}
      </div>

      <div class="flex flex-col items-center">
        <h2 class="text-4xl text-center font-medium font-serif mb-8">
          {{ commentary.label }}
        </h2>

        <div class="text-sm text-center">
          Ein Kommentar von <i>Marco Zollinger</i>
        </div>

        <div class="text-sm text-center mt-1">
          Herausgegeben von <i>Stefan Schlegel</i> und <i>Odile Ammannn</i>
        </div>
      </div>

      <button
        type="button"
        class="transition ease-in-out delay-150 inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-full text-black bg-white group-hover:bg-black group-hover:text-white mt-12">
        {{ __('view_commentary') }}
      </button>
    </div>

    <div v-for="n in (commentaries.length % 3) + 1" class="bg-white" />
  </div>
</template>

<script setup>
  defineProps({
    commentaries: { type: Object, required: true }
  })
</script>