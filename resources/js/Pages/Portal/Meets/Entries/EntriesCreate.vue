<template>
    <portal-layout>
        <Head>
            <title>{{ meet.name }}</title>
            <meta head-key="description" name="description" :content="meet.name" />
        </Head>

        <template #header>
            <div class="flex justify-between">
                <div>
                    <Link class="text-teal-400" :href="route('portal:meets.index')">{{__('Meets')}}</Link>
                    /
                    <Link class="text-teal-400" :href="route('portal:meets.show', meet)">
                        {{ meet.name }}
                    </Link>
                    / Nevezés
                </div>
            </div>
        </template>

        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-600 shadow p-5 rounded-md">
                <div class="flex flex-col sm:flex-row justify-between mb-2">
                    <h1 class="text-teal-500 dark:text-teal-400 text-3xl">
                        Nevezés létrehozása
                    </h1>
                    <div class="flex items-center mt-3 sm:mt-0 font-semibold text-teal-500 dark:text-teal-400">
                        <icon name="calendar" class="w-4 h-4 mr-2" />
                        <span>{{ meet.date }}</span>
                    </div>
                </div>

                <div class="max-w-3xl">

                    <div class="w-full flex flex-col space-y-4 mt-5">
                        <div class="w-full">
                            <jet-label for="competitor_id" value="Versenyző"/>
                            <select name="competitor_id" id="competitor_id" v-model="form.competitor_id">
                                <option v-for="comp in competitors" :key="comp.id" :value="comp.id">
                                    {{ comp.name }} ({{ comp.birth}})
                                </option>
                            </select>
                            <jet-input-error :message="form.errors.competitor_id" class="mt-2" />
                        </div>

                        <div class="w-full">
                            <jet-label for="meet_event_id" value="Versenyszám"/>
                            <select name="meet_event_id" id="meet_event_id" v-model="form.meet_event_id">
                                <option v-for="event in events" :key="event.id" :value="event.id">
                                    {{ event.length }}m {{ __(event.sex) }} {{ __(event.swim)}} {{ event.pivot.category }}
                                </option>
                            </select>
                            <jet-input-error :message="form.errors.meet_event_id" class="mt-2" />
                        </div>

                        <div class="w-full">
                            <jet-label for="time" value="Nevezési idő" />
                            <jet-input id="time" type="text" v-model="form.time" autocomplete="off" placeholder="00:00.00" />
                            <jet-input-error :message="form.errors.time" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-5">
                        <jet-button @click="submit()">
                             Mentés
                        </jet-button>
                    </div>
                </div>

            </div>
        </div>
        <ScrollTop />
    </portal-layout>
</template>

<script>
import JetLabel from '@/Jetstream/Label'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import Icon from "@/Shared/Icon"
import ScrollTop from "@/Shared/ScrollTop"
import PortalLayout from "@/Layouts/PortalLayout"
import { DocumentIcon, CogIcon, LocationMarkerIcon, AtSymbolIcon } from '@heroicons/vue/outline'

export default {
    components: {
        PortalLayout,
        JetLabel,
        JetButton,
        JetInput,
        JetInputError,
        Icon,
        DocumentIcon,
        CogIcon,
        LocationMarkerIcon,
        AtSymbolIcon,
        ScrollTop
    },
    props: ['meet', 'events', 'competitors'],
    data() {
        return {
            form: this.$inertia.form({
                method: '_POST',
                competitor_id: null,
                meet_event_id: null,
                time: null,
            })
        }
    },
    methods: {
        submit() {
            this.form.post(route('portal:meet.entry.store', this.meet))
        }
    }
}
</script>