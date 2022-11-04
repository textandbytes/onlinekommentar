<template>
  <div class="flex items-center py-2">
    <div class="min-w-0 flex-1 text-xs">
      <slot name="option" v-bind="option" />
    </div>

    <div
      v-if="show"
      class="flex items-center">
      <input
        v-model="proxyChecked"
        :id="`option-${option.id}`"
        type="checkbox"
        :value="proxyChecked"
        :disabled="disabled"
        class="focus:ring-0 focus:ring-offset-0 rounded-sm"
        :class="[disabled ? 'cursor-not-allowed' : 'cursor-pointer']"
      />
    </div>
  </div>
</template>

<script setup>
  import { computed } from 'vue'

  const emit = defineEmits(['update:checked'])

  const props = defineProps({
    option: { type: Object, required: true },
    show: { type: Boolean, required: false, default: true },
    checked: { type: Boolean, required: false, default: false },
    disabled: { type: Boolean, required: false, default: false }
  })

  const proxyChecked = computed({
    get() {
      return props.checked
    },

    set(val) {
      emit('update:checked', val)
    }
  })
</script>