<template>
  <div id="document-tree">
    <ul id="tree-root">
      <node-tree :node="treeData"></node-tree>
    </ul>
  </div>
</template>

<script>
import NodeTree from "./NodeTree";

export default {
  props: {
    treeData: Object
  },
  components: {
    NodeTree
  }
};
</script>

<style>
#tree-root ul {
  padding-left: 16px;
  margin: 6px 0;
}
</style>