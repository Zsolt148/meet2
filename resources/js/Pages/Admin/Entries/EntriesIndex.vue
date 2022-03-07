<template>
    <Head :title="meet.name + ' leadott nevezések'" />

    <portal-layout>

        <template #header>
            <div class="flex flex-wrap justify-between">

                <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek" :current="meet.name" />

                <div class="flex flex-col md:flex-row space-x-0 space-y-4 md:space-x-4 sm:space-y-0">
                    <div>
                        <jet-button size="sm" :href="route('admin:entries.meet.edit', meet)">
                            Nevezési beállítások
                        </jet-button>
                    </div>

                    <div>
                        <jet-button size="sm" variant="success" :href="route('admin:entries.meet.event.index', meet)">
                            Versenyszámok
                        </jet-button>
                    </div>

                    <div>
                        <jet-button size="sm" variant="info" :href="route('admin:entries.exports.index', meet)">
                            Exportok
                        </jet-button>
                    </div>
                </div>
            </div>
        </template>

        <div v-if="!isEntrySet" class="flex flex-row items-center bg-yellow-100 dark:bg-yellow-200 rounded-lg p-3 text-sm text-yellow-700 mb-5" role="alert">
            <div class="mr-2">
                <ExclamationIcon class="w-5 h-5" />
            </div>
            <div>
                <span class="font-bold">Figyelem!</span>
                Nincs még minden nevezési beállítás megadva! Kattintson a <Link class="link" :href="route('admin:entries.meet.edit', meet)">nevezés szerkesztése</Link> gombra!
            </div>
        </div>

        <div class="mb-2">
            <div class="font-semibold">
                Leadott Nevezések:
            </div>
            <div>
                Egyéni nevezések: {{ individual_entries_count }} db
            </div>
            <div>
                Váltó nevezések: {{ relay_entries_count }} db
            </div>
            <div>
                Összesen: {{ individual_entries_count + relay_entries_count }} db
            </div>
        </div>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <base-table>
                <template #head>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('name')">
                            {{ __('Competitor') }}
                            <table-chevron :params="params" value="name"/>
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content cursor-default">
                            {{ __('Entries') }}
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content cursor-default">
                            {{ __('Individual entries fee') }}
                            <table-chevron :params="params" value="time"/>
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content cursor-default">
                            {{ __('Final') }}
                            <table-chevron :params="params" value="is_final" />
                        </span>
                    </th>
                </template>
                <template #body>
                    <tr v-for="competitor in competitors" :key="competitor.id" class="tr-class">
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(competitor)">
                                {{competitor.name}}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(competitor)" tabindex="-1">
                                {{ competitor.entries_count }} db
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(competitor)" tabindex="-1">
                                {{ competitor.price }} Ft
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(competitor)" tabindex="-1">
                                <CheckIcon v-if="competitor.is_final" class="w-5 h-5" /><XIcon v-else class="w-5 h-5"/>
                            </Link>
                        </td>
                        <td class="td-class w-px">
                            <Link class="td-content" :href="entryRoute(competitor)" tabindex="-1">
                                <ChevronRightIcon class="w-5 h-5"/>
                            </Link>
                        </td>
                    </tr>
                    <tr v-if="competitors.length === 0">
                        <td class="border-t px-6 py-2" colspan="5">{{ __('No competitors found') }}</td>
                    </tr>
                </template>
            </base-table>
        </div>
    </portal-layout>
</template>

<script>
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import { ChevronRightIcon, CogIcon, ExclamationIcon, CheckIcon, XIcon } from '@heroicons/vue/outline'
import { getParams, getWatch } from '@/Use/useQuery';
import TableChevron from '@/Shared/TableChevron'
import BaseTable from "@/Shared/BaseTable";
import BreadCrumb from "@/Shared/BreadCrumb";

export default {
    components: {
        ChevronRightIcon,
        CogIcon,
        CheckIcon,
        XIcon,
        ExclamationIcon,
        JetButton,
        PortalLayout,
        BaseSearch,
        TableChevron,
        BaseTable,
        BreadCrumb
    },
    props: {
        meet: Object,
        competitors: Object,
        filters: Object,
        isEntrySet: Boolean,
        individual_entries_count: Number,
        relay_entries_count: Number,
    },
    setup(props) {
        const params = getParams(props);

        function entryRoute(competitor) {
            return route('admin:entries.edit', { meet: props.meet, competitor: competitor })
        }

        function updateSearch(value) {
            params.search.value = value;
        }

        function updateSort(field) {
            params.field.value = field;
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc';
        }

        getWatch(params, route('admin:entries.index', props.meet.id));

        return {
            params,
            entryRoute,
            updateSearch,
            updateSort,
        }
    },
};
</script>
