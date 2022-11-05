<template>
  <ModalDialog
    :open="open"
    @on-close="onClose">
    <template v-slot:title>
      <slot name="title" />
    </template>

    <template v-slot:body>
      <slot name="body" />
    </template>
  </ModalDialog>
</template>

<script setup>
  import ModalDialog from '@/components/Modals/ModalDialog'

  const props = defineProps({
    locale: { type: String, required: true },
    commentary: { type: Object, required: true },
    versionTimestamp: { type: String, required: false, default: null },
    open: { type: Boolean, required: false, default: false }
  })

  const onClose = () => {
    // update the url with the currently loaded version
    let versionUrl = '/' + props.locale + '/kommentare/' + props.commentary.slug + (props.versionTimestamp !== '' ? '/versions/' + props.versionTimestamp : '')
    history.pushState({ versionUrl }, '', versionUrl)
  }
</script>