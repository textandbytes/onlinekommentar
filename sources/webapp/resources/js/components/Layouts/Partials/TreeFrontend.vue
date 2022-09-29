<template>
  <div id="document-tree">
    <ul id="tree-root">
      <TreeNodeFrontend :node="treeData"></TreeNodeFrontend>
    </ul>
  </div>
</template>

<script setup>
  import TreeNodeFrontend from './TreeNodeFrontend.vue'

  defineProps({
    treeData: Object
  })
</script>

<style>
  #tree-root ul {
    padding-left: 16px;
    padding-right: 32px;
    margin: 6px 0;
  }
</style>