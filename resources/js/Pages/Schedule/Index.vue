<script setup>
import {ref, h, reactive, provide, readonly} from "vue"
import { NH1, NSpace, NFlex, NButton, NDivider, NDropdown, NDataTable, NIcon } from 'naive-ui'
import { IconDots } from '@tabler/icons-vue'
import Admin from "@/Layouts/Admin.vue"
import CreateScheduleItemModal from "@/components/Modals/CreateScheduleItemModal.vue"
import UpdateScheduleItemModal from "@/components/Modals/UpdateScheduleItemModal.vue"

const props = defineProps({ schedule: Array })

const hasOpenCreateScheduleItemModal = ref(false)
const hasOpenUpdateScheduleItemModal = ref(false)
const selectedScheduleItem = ref({})
provide('selectedScheduleItem', readonly(selectedScheduleItem))

const rowOptions = ref([
    {
        label: 'Редактировать',
        key: 'edit',
        onClick: (row) => {
            openUpdateModal(true, row)
        }
    },
    // {
    //     label: 'Скачать',
    //     key: 'download',
    //     onClick: async (row) => {
    //         await downloadCert([row.id])
    //     }
    // },
])

const columns = ref([
    {
        title: 'Должность',
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
    },
    {
        title: '',
        key: 'actions',
        width: 60,
        render(row) {
            return h(
                NFlex,
                {

                },
                {
                    default: () => h(
                        NDropdown,
                        {
                            trigger: 'click',
                            placement: 'bottom-end',
                            options: rowOptions.value,
                            onSelect: (key, option) => option.onClick(row)
                        },
                        {
                            default: () => h(NButton, { text: true, class: 'text-xl' }, { default: () => h(NIcon, null, { default: () => h(IconDots) }) })
                        }
                    )
                }
            )
        }
    }
])

function openUpdateModal(open, row) {
    selectedScheduleItem.value = row
    hasOpenUpdateScheduleItemModal.value = open
}

</script>

<template>
    <Admin>
        <NSpace vertical>
            <NFlex justify="space-between" align="center" class="mb-5">
                <NH1 class="!mb-0">Расписание</NH1>
                <NSpace align="center">
                    <NText>
                        Доступно слотов 29 из 30
                    </NText>
                    <NDivider vertical />
                    <NButton type="primary" @click="hasOpenCreateScheduleItemModal = true">
                        Добавить
                    </NButton>
                </NSpace>
            </NFlex>
            <NDataTable :columns="columns" :data="schedule" />
        </NSpace>
        <CreateScheduleItemModal v-model:open="hasOpenCreateScheduleItemModal" />
        <UpdateScheduleItemModal v-model:open="hasOpenUpdateScheduleItemModal" :selected-schedule-item="selectedScheduleItem" />
    </Admin>
</template>

<style scoped>

</style>
