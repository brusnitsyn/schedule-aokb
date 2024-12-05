<script setup lang="ts">
import {ref} from "vue"
import { NModal, NForm, NCard, NGrid, NFormItemGi, NInput, NFlex, NButton, NSelect, useMessage } from 'naive-ui'
import type {FormInst} from 'naive-ui'
import { useForm } from '@inertiajs/vue3'
import TimePicker from "@/components/TimePicker.vue"

const props = defineProps(['scheduleStatuses'])

const open = defineModel<boolean>('open')

const message = useMessage()
const formRef = ref<FormInst | null>(null)
const form = useForm({
    doctor_job: '',
    doctor_name: '',
    room: '',
    start_at: null,
    end_at: null,
    status_schedule_item_id: 1
})
const rules = {
    doctor_job: [
        {
            required: true,
            message: 'Поле обязательно к заполнению',
            trigger: ['input', 'blur']
        }
    ],
    doctor_name: [
        {
            required: true,
            message: 'Поле обязательно к заполнению',
            trigger: ['input', 'blur']
        }
    ],
    room: [
        {
            required: true,
            message: 'Поле обязательно к заполнению',
            trigger: ['input', 'blur']
        }
    ],
    start_at: [
        {
            required: true,
            validator(rule, value) {
              if (!value) return new Error('Поле обязательно к заполнению')
            },
            trigger: ['change', 'blur']
        }
    ],
    end_at: [
        {
            required: true,
            validator(rule, value) {
              if (!value) return new Error('Поле обязательно к заполнению')
            },
            trigger: ['change', 'blur']
        }
    ],
}

function handleSubmit() {
    formRef.value?.validate((errors) => {
        if (!errors) {
            form.post('/schedule/create', {
                onSuccess: () => {
                    closeModal()
                }
            })
        }
        else {
            console.log(errors)
            message.error('Заполните все обязательные поля')
        }
    })
}

function closeModal() {
    form.reset()
    open.value = false
}

</script>

<template>
    <NModal v-model:show="open" class="w-[640px]" preset="card" title="Добавление слота в расписание">
        <NForm @submit.prevent="handleSubmit" ref="formRef" :model="form" :rules="rules">
            <NGrid cols="2"  x-gap="8">
                <NFormItemGi label="ФИО врача" span="2" path="doctor_name">
                    <NInput v-model:value="form.doctor_name" placeholder="" clearable />
                </NFormItemGi>
                <NFormItemGi label="Должность врача" path="doctor_job">
                    <NInput v-model:value="form.doctor_job" placeholder="" clearable />
                </NFormItemGi>
                <NFormItemGi label="Кабинет" path="room">
                    <NInput v-model:value="form.room" placeholder="" clearable />
                </NFormItemGi>
                <NFormItemGi label="Время начала приема" path="start_at">
                    <TimePicker v-model:value="form.start_at" />
                </NFormItemGi>
                <NFormItemGi label="Время окончания приема" path="end_at">
                    <TimePicker v-model:value="form.end_at" />
                </NFormItemGi>
                <NFormItemGi label="Приём" path="status_schedule_item_id">
                    <NSelect v-model:value="form.status_schedule_item_id" :items="scheduleStatuses" value-field="id" />
                </NFormItemGi>
            </NGrid>
        </NForm>
        <template #action>
            <NFlex justify="space-between">
                <NButton secondary @click="closeModal">
                    Отмена
                </NButton>
                <NButton type="primary" :loading="form.processing" :disabled="form.processing || !form.isDirty" attr-type="submit" @click="handleSubmit">
                    Добавить слот
                </NButton>
            </NFlex>
        </template>
    </NModal>
</template>

<style scoped>

</style>
