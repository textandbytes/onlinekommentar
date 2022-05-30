<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    documentTree: Array
});
</script>

<template>
    <AppLayout title="Document Tree">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Document Tree
            </h2>
        </template>
        <div class="ml-16">
        <ul v-for="node in documentTree" :key="node.id">

        <li>{{node.label_de}}</li>
        
        </ul>
        </div>
       
    </AppLayout>
</template>
