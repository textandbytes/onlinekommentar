<template>
  <div id="document-tree">
    <ul id="tree-root">
      <TreeNodeFrontend :node="treeData"></TreeNodeFrontend>
    </ul>
  </div>
</template>

<script>
import TreeNodeFrontend from "./TreeNodeFrontend";

export default {
  props: {
    treeData: Object
  },
  components: {
    TreeNodeFrontend
  }
};
</script>

<style>
#tree-root ul {
  padding-left: 16px;
  padding-right: 32px;
  margin: 6px 0;
}
</style>