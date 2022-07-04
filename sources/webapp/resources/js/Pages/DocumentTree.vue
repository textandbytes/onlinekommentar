<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    documentTree: Object
});
</script>

<template>
    <AppLayout title="Document Tree">

        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Document Tree</h2>
        </template>

        <div class="ml-16">
          <tree :tree-data="documentTree"></tree>
        </div>

    </AppLayout>
</template>

<script>
import Tree from "./Tree";

export default {
  components: {
    Tree
  }
};
</script>