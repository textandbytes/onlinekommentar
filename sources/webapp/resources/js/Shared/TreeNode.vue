<template>
  <li class="tree-node">
    <span class="label" v-if="node.id != 1">{{ node.label }} <span v-if="node.children && node.children.length">[{{ node.children.length }}] [{{ childrenCount }}]</span></span>

    <ul v-if="node.children && node.children.length" :key="node.id" class="children-list">
      <TreeNode v-for="child in node.children" :node="child" @born="initNode(node.id)" />
    </ul>
  </li>
</template>

<script>
export default {
  name: "TreeNode",
  props: {
    node: Object
  },
  data() {
      return {
          childrenCount: 0,
      };
  },
  mounted() {
    this.$emit('born');
  },
  methods: {
        initNode(iNodeId) {
          this.childrenCount++;
          this.$emit('born');
      },
  }
};
</script>