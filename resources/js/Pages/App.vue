<script setup>
import Centered from "@/Layouts/Centered.vue"
import { format } from "date-fns"
defineProps({ schedule: Array })
</script>

<template>
    <Centered>
        <table class="border w-full text-custom font-semibold uppercase leading-[44px]">
            <thead>
                <tr>
                    <td class="bg-primary" colspan="4">
                        <div class="flex flex-row justify-center items-center w-full py-3 text-white">
                            РАСПИСАНИЕ РАБОТЫ ВРАЧЕЙ
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="bg-primary border-t border-secondary w-[352px]">Специалист</th>
                    <th class="bg-primary border-t border-secondary w-[397px]"></th>
                    <th class="bg-primary border-t border-secondary w-[175px]">Кабинет</th>
                    <th class="bg-primary border-t border-secondary w-[300px]">Время<br>приёма</th>
                </tr>
            </thead>
            <tbody class="border border-secondary">
                <tr v-for="scheduleItem in schedule" :key="scheduleItem.id" height="62">
                    <td class="max-w-[352px] text-[32px] leading-[36px] pl-4 py-1">
                        {{ scheduleItem.doctor_job }}
                    </td>
                    <td class="max-w-[397px] text-[32px] leading-[36px] pl-4">
                        ({{ scheduleItem.doctor_name }})
                    </td>
                    <td align="center" class="text-[32px] leading-[36px]">
                        [{{ scheduleItem.room }}]
                    </td>
                    <td align="center" class="text-[32px] leading-[36px]">
                        <div v-if="scheduleItem.status_schedule_item_id === 1">
                            {{ format(scheduleItem.start_at, 'HH:mm') }}-{{ format(scheduleItem.end_at, 'HH:mm') }}
                        </div>
                        <div v-else></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </Centered>
</template>

<style scoped>
::v-deep(tr:nth-child(odd)) {
    background-color: #ddebf7;
}
::v-deep(tr:nth-child(even)) {
    background-color: #5b9bd5;
}
</style>
