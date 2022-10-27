<template>
  <div class="divide-y divide-ok-light-gray px-1">
    <div class="flex items-center justify-between py-2">
      <div class="font-medium text-xs uppercase">
        {{ $t('versions') }}
      </div>

      <button
        v-if="currentVersions.length > 1"
        :disabled="selectedVersions.length !== 2"
        class="uppercase rounded-full text-xs border px-2 py-1 font-medium"
        :class="[selectedVersions.length !== 2 ? 'border-ok-light-gray text-ok-light-gray cursor-not-allowed' : 'border-black hover:bg-opacity-100 hover:bg-black hover:text-opacity-100 hover:text-white cursor-pointer']"
        @click="$emit('on-compare', selectedVersions)">
        {{ $t('compare') }}
      </button>
    </div>

    <CheckboxWithLabel
      v-for="(version, index) in currentVersions"
      :key="version.id"
      :option="version"
      :show="currentVersions.length > 1"
      :disabled="selectedVersions.length > 1 && !version.checked"
      v-model:checked="version.checked">
      <template v-slot:option="option">
        <label
          class="font-medium"
          :class="[option.id === activeVersion.id ? 'text-ok-light-gray' : 'cursor-pointer']"
          @click="option.id !== activeVersion.id ? { click: $emit('on-select', option.timestamp) } : {}">
          {{ option.label }}
        </label>

        <span
          v-if="index === 0"
          class="inline-flex items-center rounded-full bg-ok-blue ml-2 px-1.5 text-xs font-medium text-black uppercase">
          {{ $t('published') }}
        </span>
      </template>
    </CheckboxWithLabel>
  </div>
</template>

<script setup>
  import { ref, computed } from 'vue'
  import CheckboxWithLabel from '@/components/Checkboxes/CheckboxWithLabel'

  const props = defineProps({
    versions: { type: Array, required: false, default: [] },
    activeVersion: { type: Object, required: false, default: null }
  })

  const currentVersions = ref(props.versions)

  const selectedVersions = computed(() => {
    // reverse the order of the selected revisions since the original list is supplied in descending order
    return currentVersions.value.filter(version => version.checked === true).reverse()
  })
</script>