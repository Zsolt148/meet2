<template>
    <app-layout>
        <Head>
            <title>{{ meet.name }}</title>
            <meta head-key="description" name="description" :content="meet.name" />
        </Head>

        <template #header>
            <div class="flex flex-wrap justify-between">
                <div class="mb-2">
                    <Link class="text-teal-400" :href="route('meets.index')">{{__('Meets')}}</Link>
                    /
                    <Link class="text-teal-400" :href="route('meets.show', meet.slug)">{{ meet.name }}</Link>
                    / {{ __('Entries') }}
                </div>
                <div class="flex flex-col md:flex-row space-x-0 space-y-2 md:space-x-2 md:space-y-0">
                    <div>
                        <jet-button size="sm" :href="route('meets.entries.statistics', meet)">
                            <ViewListIcon class="w-5 h-5 mr-2" />
                            {{ __('Statistics') }}
                        </jet-button>
                    </div>
                </div>
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-8 px-0 xl:px-2">
            <base-search @search="updateSearch"
                         @reset="reset"
                         :search-term="params.search"
                         search-placeholder="Search in competitors"
                         input-class="mt-6"
            >
                <div class="flex flex-col w-1/4 mr-2">
                    <jet-label :value="__('Event')" />
                    <select name="event" id="event" v-model="selectedEvent" @change="updateEvent(selectedEvent)" class="py-1">
                        <option value="">-</option>
                        <option v-for="event in all_events" :key="event.id" :value="event.id">{{ meetEvent(event) }}</option>
                    </select>
                </div>
                <div class="flex flex-col w-1/4 mr-2">
                    <jet-label :value="__('Team')" />
                    <select name="team" id="team" v-model="selectedTeam" @change="updateTeam(selectedTeam)" class="py-1">
                        <option value="">-</option>
                        <option v-for="team in teams" :key="team.id" :value="team.id">{{__(team.name)}}</option>
                    </select>
                </div>
            </base-search>

            <div class="bg-white dark:bg-gray-600 shadow p-5 rounded-md mt-5">
                <div v-for="(event, index) in events" :key="event.id" class="mx-auto my-2">
                    <div class="flex flex-row justify-between">
                        <div class="text-lg font-semibold text-teal-500 dark:text-teal-400">
                            {{ meetEvent(event) }}
                        </div>
                        <div>
                            {{ entries[event.id].length }} db
                        </div>
                    </div>
                    <ul class="list-disc list-inside ml-5">
                        <li v-for="entry in entries[event.id]" :key="entry.id" class="text-black dark:text-white">
                            {{ entry.competitor.name }} - {{ entry.competitor.birth }} ({{ __(entry.competitor.team.name) }})
                        </li>
                    </ul>
                </div>

                <div v-show="events.length === 0" class="text-black dark:text-white">
                    {{ __('No entries found') }}
                </div>
            </div>
        </div>
        <ScrollTop />
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"
import {ref} from 'vue'
import ScrollTop from "@/Shared/ScrollTop"
import {getParams, getWatch} from "@/Use/useQuery";
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import {ViewListIcon} from "@heroicons/vue/outline";

export default {
    components: {
        AppLayout,
        ScrollTop,
        BaseSearch,
        JetLabel,
        JetButton,
        ViewListIcon,
    },
    props: ['meet', 'teams', 'filters', 'entries', 'events', 'all_events'],
    setup(props) {
        const params = getParams(props);
        const selectedEvent = ref(props.filters.event);
        const selectedTeam = ref(props.filters.team);
        params.event = ref(props.filters.event);
        params.team = ref(props.filters.team);

        function updateSearch(value) {
            params.search.value = value;
        }

        function updateEvent(value) {
            params.event.value = value;
        }

        function updateTeam(value) {
            params.team.value = value;
        }

        function updateSort(field) {
            params.field.value = field;
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc';
        }

        function reset() {
            selectedEvent.value = null;
            selectedTeam.value = null;
            params.event.value = null;
            params.team.value = null;
        }

        getWatch(params, route('meets.entries.index', props.meet.slug));

        return {
            selectedEvent,
            selectedTeam,
            params,
            updateSearch,
            updateEvent,
            updateTeam,
            updateSort,
            reset,
        }
    },
}
</script>