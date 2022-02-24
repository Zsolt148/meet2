<template>
    <Head title="Nevezés szerkesztése" />
    <portal-layout>

        <template #header>
            <bread-crumb :back-route="route('portal:meets.index')" :back-name="__('Entriable Meets')">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('portal:meets.show', meet.slug)">{{ meet.name }}</Link>
                <span class="font-medium pl-1">/</span> Nevezés
            </bread-crumb>
        </template>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">

            <form @submit.prevent="update">
                <div class="p-8 flex flex-col max-w-3xl">
                    <div class="text-2xl">
                        {{ entry.competitor.name }} - {{ meet_event }}
                    </div>
                    <div class="w-full flex flex-col space-y-4 mt-5">

                        <div class="w-full">
                            <jet-label for="competitor_id" :value="__('Competitor')"/>
                            <jet-input id="competitor_id"
                                       name="competitor_id"
                                       type="text"
                                       aria-readonly="true" disabled="disabled"
                                       :value="entry.competitor.name"
                            />
                        </div>

                        <div class="w-full">
                            <jet-label for="meet_event_id" :value="__('Event')"/>
                            <jet-input id="meet_event_id"
                                       type="text"
                                       name="meet_event_id"
                                       aria-readonly="true" disabled="disabled"
                                       :value="meet_event"
                            />
                        </div>

                        <div class="w-full">
                            <jet-label for="time" :value="__('Entry time')" />
                            <jet-input id="time"
                                       type="text"
                                       autocomplete="off"
                                       placeholder="00:00.00"
                                       aria-readonly="true" disabled="disabled"
                                       :value="entry.time"
                            />
                        </div>

                        <div class="w-full">
                            <jet-label for="user_id" :value="__('Created at')"/>
                            {{ timeFormat(entry.created_at) }}
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </portal-layout>
</template>

<script>
import PortalLayout from "@/Layouts/PortalLayout";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import BreadCrumb from "@/Shared/BreadCrumb";
import { isDark } from '@/Composables'

export default {
    components: {
        PortalLayout,
        JetInput,
        JetLabel,
        BreadCrumb,
        isDark,
    },
    props: {
        meet: Object,
        entry: Object,
        meet_event: String,
    },

    data() {
        return {
            //
        }
    },
}
</script>