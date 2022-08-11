<template>
  <Head title="Document Tree" />

  <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b border-gray-200">
    Document Tree
  </h1>

  <Tree :tree-data="documentTree"></Tree>
</template>

<script>
  import CmsLayout from '@/Layouts/CmsLayout.vue'
  import Tree from '@/Shared/cms/Tree'

  export default {
    layout: CmsLayout,

    props: {
      documentTree: Object
    },

    components: {
      Tree
    }
  }
</script>