<script setup>
import {NTimePicker} from 'naive-ui'
const model = defineModel('value')
</script>

<template>
    <NTimePicker v-model:value="model" format="HH:mm" placeholder="" class="w-full" v-mask="'##:##'" clearable />
</template>

<style scoped>

</style>
