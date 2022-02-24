<template>
    <Head title="Nevezhető verseny" />

    <portal-layout>

        <div class="flex flex-col md:flex-row justify-between mb-5 md:mb-0">

            <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek" :current="meet.name" />

            <div class="flex flex-col md:flex-row space-x-0 space-y-4 md:space-x-4 md:space-y-0">
                <div>
                    <jet-button size="sm" :href="route('admin:entries.meet.edit', meet)">
                        <CogIcon class="w-5 h-5 mr-2" />
                        Szerkesztés
                    </jet-button>
                </div>

                <div>
                    <jet-button size="sm" variant="success" :href="route('admin:entries.meet.event.index', meet)">
                        Versenyszámok
                    </jet-button>
                </div>

                <div>
                    <jet-button size="sm" variant="info" :href="route('admin:entries.meet.edit', meet)">
                        Fizetések
                    </jet-button>
                </div>
            </div>
        </div>

        <div v-if="!isEntrySet" class="flex flex-row items-center bg-yellow-100 rounded-lg p-3 text-sm text-yellow-700 mb-5" role="alert">
            <div class="mr-2">
                <ExclamationIcon class="w-5 h-5" />
            </div>
            <div>
                <span class="font-bold">Figyelem!</span>
                Nincs még minden nevezési beállítás megadva! Kattintson a szerkesztés gombra!
            </div>
        </div>

        <div class="text-lg font-bold ">
            Leadott Nevezések - Összesen: {{ entries_count }} db
        </div>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" v-if="entries" :links="entries.links" />

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <base-table>
                <template #head>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('name')">
                            Versenyző
                            <table-chevron :params="params" value="name" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('event')">
                            Versenyszám
                            <table-chevron :params="params" value="event" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('time')">
                            Idő
                            <table-chevron :params="params" value="time" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('user_id')">
                            Nevezte
                            <table-chevron :params="params" value="user_id" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('is_final')">
                            Végleges
                            <table-chevron :params="params" value="is_final" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('created_at')">
                            Létrehozva
                            <table-chevron :params="params" value="created_at" />
                        </span>
                    </th>
                </template>
                <template #body>
                    <tr v-for="entry in entries.data" :key="entry.id" class="tr-class">
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(meet, entry)">
                                {{ entry.competitor.name }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(meet, entry)" tabindex="-1">
                                {{ entry.meet_event.event.length }}m {{ __(entry.meet_event.event.sex) }} {{ __(entry.meet_event.event.swim) }} {{ entry.meet_event.category }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(meet, entry)" tabindex="-1">
                                {{ entry.time }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(meet, entry)" tabindex="-1">
                                {{ entry.user.name }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(meet, entry)" tabindex="-1">
                                <CheckIcon v-if="entry.is_final" class="w-5 h-5" /><XIcon v-else class="w-5 h-5"/>
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="entryRoute(meet, entry)" tabindex="-1">
                                {{ timeFormat(entry.created_at) }}
                            </Link>
                        </td>
                        <td class="td-class w-px">
                            <Link class="td-content" :href="entryRoute(meet, entry)" tabindex="-1">
                                <ChevronRightIcon class="w-5 h-5" />
                            </Link>
                        </td>
                    </tr>
                    <tr v-if="entries.data.length === 0">
                        <td class="border-t px-6 py-2" colspan="7">Nem található nevezés</td>
                    </tr>
                </template>
            </base-table>
        </div>
        <pagination class="my-5" :links="entries.links" />
    </portal-layout>
</template>

<script>
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import { ChevronRightIcon, CogIcon, ExclamationIcon, CheckIcon, XIcon } from '@heroicons/vue/outline'
import Pagination from '@/Shared/Pagination'
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
        Pagination,
        BaseSearch,
        TableChevron,
        BaseTable,
        BreadCrumb
    },
    props: {
        meet: Object,
        entries: Object,
        filters: Object,
        isEntrySet: Boolean,
        entries_count: Number,
    },
    setup(props) {
        const params = getParams(props);

        function entryRoute(meet, entry) {
            return route('admin:entries.edit', { meet: meet, entry: entry })
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
