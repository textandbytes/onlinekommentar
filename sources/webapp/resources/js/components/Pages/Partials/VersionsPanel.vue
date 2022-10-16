<template>
  <div class="divide-y divide-ok-light-gray px-1">
    <div class="flex justify-between py-2">
      <div class="font-medium text-xs uppercase">
        {{ $t('versions') }}
      </div>
      <div
        v-if="currentVersions.length > 1"
        class="font-medium text-xs uppercase">
        {{ $t('compare_versions') }}
      </div>
    </div>

    <CheckboxWithLabel
      v-for="version in currentVersions"
      :key="version.id"
      :option="version"
      :show="currentVersions.length > 1"
      :disabled="numberOfSelectedVersions > 1 && !version.checked"
      v-model:checked="version.checked">
      <template v-slot:option="option">
        <label
          class="font-medium"
          :class="[option.id === activeVersion.id ? 'text-ok-light-gray' : 'cursor-pointer']"
          @click="option.id !== activeVersion.id ? { click: $emit('on-select', option.timestamp) } : {}">
          {{ option.label }}
        </label>
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

  const numberOfSelectedVersions = computed(() => {
    return currentVersions.value.filter(version => version.checked === true).length
  })
</script>