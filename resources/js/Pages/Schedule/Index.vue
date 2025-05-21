<script setup>
import {ref, h, reactive, provide, readonly} from "vue"
import {
    NH1,
    NSpace,
    NFlex,
    NButton,
    NDivider,
    NDropdown,
    NDataTable,
    NIcon,
    NDialogProvider,
    useDialog,
    NEl
} from 'naive-ui'
import { IconDots } from '@tabler/icons-vue'
import Admin from "@/Layouts/Admin.vue"
import CreateScheduleItemModal from "@/components/Modals/CreateScheduleItemModal.vue"
import UpdateScheduleItemModal from "@/components/Modals/UpdateScheduleItemModal.vue"
import {format} from "date-fns"
import {router} from "@inertiajs/vue3"

const props = defineProps({ schedule: Array, scheduleSlots: Array, scheduleStatuses: Array })

const hasOpenCreateScheduleItemModal = ref(false)
const hasOpenUpdateScheduleItemModal = ref(false)
const selectedScheduleItem = ref({})
provide('selectedScheduleItem', readonly(selectedScheduleItem))

const rowOptions = ref([
    {
        label: 'Изменить слот',
        key: 'edit',
        onClick: (row) => {
            openUpdateModal(true, row)
        }
    },
    {
        label: 'Удалить слот',
        key: 'delete',
        onClick: async (row) => {
            await deleteSlot(row)
        }
    },
])

const columns = ref([
    {
        title: 'Должность врача',
        key: 'doctor_job'
    },
    {
        title: 'ФИО врача',
        key: 'doctor_name'
    },
    {
        title: 'Кабинет',
        key: 'room'
    },
    {
        title: 'Время приёма',
        key: 'time',
        render(row) {
            return h(
                'div',
                {},
                {
                    default: () => `${format(row.start_at, 'HH:mm')}-${format(row.end_at, 'HH:mm')}`
                }
            )
        }
    },
    {
        title: 'Приём',
        key: 'status_schedule',
        render(row) {
            return h(
                NEl,
                {
                    style: {
                        color: row.status_schedule_item_id === 1 ? 'var(--primary-color)' : 'var(--error-color)'
                    }
                },
                {
                    default: () => row.status_schedule
                }
            )
        }
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

// const dialog = useDialog()
function deleteSlot(row) {
    router.delete(route('schedule.delete', {scheduleItem: row.id}))
}
</script>

<template>

        <Admin>
            <NDialogProvider>
                <NSpace vertical>
                    <NFlex justify="space-between" align="center" class="mb-5">
                        <NH1 class="!mb-0">Расписание</NH1>
                        <NSpace align="center">
                            <NText>
                                Доступно слотов {{ scheduleSlots.allow }} из {{ scheduleSlots.all }}
                            </NText>
                            <NDivider vertical />
                            <NButton :disabled="scheduleSlots.hasDisabledAddButton" type="primary" @click="hasOpenCreateScheduleItemModal = true">
                                Добавить слот
                            </NButton>
                        </NSpace>
                    </NFlex>
                    <NDataTable :columns="columns" :data="schedule" />
                </NSpace>
            </NDialogProvider>
            <CreateScheduleItemModal v-model:open="hasOpenCreateScheduleItemModal" :schedule-statuses="scheduleStatuses" />
            <UpdateScheduleItemModal v-model:open="hasOpenUpdateScheduleItemModal" :selected-schedule-item="selectedScheduleItem" :schedule-statuses="scheduleStatuses" />
        </Admin>

</template>

<style scoped>

</style>
