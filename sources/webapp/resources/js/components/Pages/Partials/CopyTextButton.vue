<template>
  <div class="uppercase cursor-pointer" @click="copy">
    <svg v-if="copyStatus === 'copied'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <svg v-else-if="copyStatus === 'error'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <img v-else src="/img/copy.svg" />

    <span v-if="label" class="ml-1 text-xs font-medium tracking-wider">
      {{ copyLabel }}
    </span>

    <input
      v-on:focus="onFocus"
      ref="textToCopy"
      type="hidden"
      readonly
      :value="text"
      tabindex="-1">
  </div>
</template>

<script setup>
  import { ref } from 'vue'

  const props = defineProps({
    label: { type: String, required: false, default: null },
    text: { type: String, required: true }
  })

  const copyStatus = ref('')

  const copyLabel = ref(props.label)

  const textToCopy = ref()

  const onFocus = (event) => {
    event.target.select()
  }

  const copy = () => {
    textToCopy.value.setAttribute('type', 'text')
    textToCopy.value.focus()

    // copy the citation and update the label
    try {
      document.execCommand('copy')
      copyLabel.value = translations.value.copied_citation
      copyStatus.value = 'copied'
    } catch (err) {
      copyLabel.value = translations.value.copy_citation_error
      copyStatus.value = 'error'
    }

    textToCopy.value.setAttribute('type', 'hidden')

    // reset the label to its original value
    setTimeout(() => {
      copyLabel.value = props.label
      copyStatus.value = ''
    }, 2000)
  }
</script>