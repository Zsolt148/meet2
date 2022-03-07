<template>
    <app-layout>
        <Head>
            <title>{{ meet.name }}</title>
            <meta head-key="description" name="description" :content="meet.name" />
        </Head>

        <template #header>
            <div class="flex flex-wrap justify-between">
                <div>
                    <Link class="text-teal-400" :href="route('meets.index')">{{__('Meets')}}</Link>
                    /
                    <Link class="text-teal-400" :href="route('meets.show', meet.slug)">{{ meet.name }}</Link>
                    / {{ __('Entries') }}
                </div>
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-8 px-0 xl:px-2">

            <base-search @search="updateSearch" :search-term="params.search"
            >
                <select name="team" id="team" v-model="selectedTeam" @change="updateTeam(selectedTeam)" class="block rounded-md border-gray-300 py-1 w-1/5 focus:outline-none mr-2">
                    <option value="">-</option>
                    <option v-for="team in teams" :key="team.id" :value="team.id">{{team.name}}</option>
                </select>
            </base-search>

            <div class="bg-white dark:bg-gray-600 shadow p-5 rounded-md mt-5">
                <div v-for="(event, index) in events" :key="event.id" class="mx-auto my-2">
                    <div class="text-lg font-semibold text-teal-500 dark:text-teal-400">
                        {{ meetEvent(event) }}
                    </div>
                    <ol class="list-decimal list-inside ml-5">
                        <li v-for="entry in entries[event.id]" :key="entry.id" class="text-black dark:text-white">
                            {{ entry.competitor.name }} ({{ entry.user.team.name }})
                        </li>
                    </ol>
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

export default {
    components: {
        AppLayout,
        ScrollTop,
        BaseSearch,
    },
    props: ['meet', 'teams', 'filters', 'entries', 'events'],
    setup(props) {
        const params = getParams(props);
        const selectedTeam = ref(props.filters.team);
        params.team = ref(props.filters.team);

        function updateSearch(value) {
            params.search.value = value;
        }

        function updateTeam(value) {
            params.team.value = value;
        }

        function updateSort(field) {
            params.field.value = field;
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc';
        }

        getWatch(params, route('meets.entries.index', props.meet.slug));

        return {
            selectedTeam,
            params,
            updateSearch,
            updateTeam,
            updateSort,
        }
    },
}
</script>