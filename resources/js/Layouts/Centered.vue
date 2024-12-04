<script setup>
import NaiveProvider from "@/Layouts/NaiveProvider.vue";
</script>

<template>
    <NaiveProvider>
        <div class="container max-w-[1225px] mx-auto py-2">
            <slot />
        </div>
    </NaiveProvider>
</template>

<style scoped>

</style>
