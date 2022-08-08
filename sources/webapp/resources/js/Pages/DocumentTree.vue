<template>
  <Head title="Document Tree" />

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b border-gray-200">
      Document Tree
    </h1>

    <Tree :tree-data="documentTree"></Tree>
  </div>
</template>

<script>
  import Tree from '@/Shared/cms/Tree'

  export default {
    props: {
      documentTree: Object
    },

    components: {
      Tree
    }
  }
</script>