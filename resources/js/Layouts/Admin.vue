<script setup>
import NaiveProvider from "@/Layouts/NaiveProvider.vue";
</script>

<template>
    <NaiveProvider>
        <div class="container max-w-5xl mx-auto p-4">
            <slot />
        </div>
    </NaiveProvider>
</template>

<style scoped>

</style>
