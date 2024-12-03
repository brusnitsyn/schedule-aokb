<script setup>
import {ref} from "vue"
import { NH1, NSpace, NDataTable } from 'naive-ui'
import Admin from "@/Layouts/Admin.vue";
const props = defineProps({ schedule: Array })

const columns = ref([
    {
        title: 'Профиль',
        key: 'doctor_job'
    },
    {
        title: 'ФИО',
        key: 'doctor_name'
    },
    {
        title: 'Кабинет',
        key: 'room'
    },
    {
        title: 'Время приёма',
        key: 'time'
    }
])
</script>

<template>
    <Admin>
        <NSpace vertical>
            <NFlex>
                <NH1>Расписание</NH1>
            </NFlex>
            <NDataTable :columns="columns" :data="schedule" />
        </NSpace>
    </Admin>
</template>

<style scoped>

</style>
