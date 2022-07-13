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

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Tree :tree-data="documentTree"></Tree>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import Tree from "../Shared/cms/Tree";

export default {
  components: {
    Tree
  }
};
</script>