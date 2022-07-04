<template>
  <li class="node-tree">
    <span class="label" v-if="node.id != 1">{{ node.label }} <span v-if="node.children && node.children.length">[{{ node.children.length }}] [{{ childrenCount }}]</span></span>

    <ul v-if="node.children && node.children.length" :key="node.id" class="children-list">
      <node v-for="child in node.children" :node="child" @born="helloWorld(node.id)" />
    </ul>
  </li>
</template>

<script>
export default {
  name: "node",
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
      helloWorld(iNodeId) {
          this.childrenCount++;
          this.$emit('born');
      },
  }
};
</script>