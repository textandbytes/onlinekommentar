<template>
  <li class="tree-node">
    <span class="label" v-if="node.id != 1" :class="{ 'font-medium' : node.node_type === 'leaf' }">{{ node.label }} <span v-if="node.element_count > 0">({{ node.element_count }})</span>
    </span>

    <ul v-if="node.children && node.children.length" :key="node.id" class="children-list">
      <TreeNodeFrontend v-for="child in node.children" :node="child" />
    </ul>
    
  </li>
</template>

<script>
export default {
  name: "TreeNodeFrontend",
  props: {
    node: Object
  },
};
</script>