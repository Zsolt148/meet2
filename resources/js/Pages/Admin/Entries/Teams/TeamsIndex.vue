<template>
    <Head :title="meet.name + ' leadott nevezések'" />

    <portal-layout>

        <template #header>
            <div class="flex flex-wrap justify-between">

                <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek">
                    <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.index', meet.id)">{{ meet.name }}</Link>
                    <span class="font-medium pl-1">/</span> Egyesületek
                </bread-crumb>

            </div>
        </template>

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
                Összes nevezés: {{ individual_entries_count + relay_entries_count }} db
            </div>
            <div>
                Összesen: {{ individual_entries_count * meet.entry_price }} Ft
            </div>
        </div>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <base-table>
                <template #head>
                    <th class="th-class">
                        <span class="th-content cursor-default">
                            {{ __('Team') }}
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content cursor-default">
                            Versenyzők száma
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content cursor-default">
                            Egyéni nevezések
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content cursor-default">
                            Egyéni nevezések díja
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content cursor-default">
                            Váltó nevezések
                        </span>
                    </th>
                </template>
                <template #body>
                    <tr v-for="(data, name) in teams" :key="name" class="tr-class">
                        <td class="td-class">
                            <span class="td-content">
                                {{name}}
                            </span>
                        </td>
                        <td class="td-class">
                            <span class="td-content">
                                {{ data.competitors_count }} db
                            </span>
                        </td>
                        <td class="td-class">
                            <span class="td-content">
                                {{ data.individual_entries_count }} db
                            </span>
                        </td>
                        <td class="td-class">
                            <span class="td-content">
                                {{ data.individual_entries_price }} Ft
                            </span>
                        </td>
                        <td class="td-class">
                            <span class="td-content">
                                {{ data.team_entries_count }} db
                            </span>
                        </td>
                    </tr>
                    <tr v-if="teams.length === 0">
                        <td class="border-t px-6 py-2" colspan="5">{{ __('No teams found') }}</td>
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
        teams: Object,
        filters: Object,
        individual_entries_count: Number,
        relay_entries_count: Number,
    },
    setup(props) {
        const params = getParams(props);

        function updateSearch(value) {
            params.search.value = value;
        }

        getWatch(params, route('admin:entries.meet.teams.index', props.meet.id));

        return {
            params,
            updateSearch,
        }
    },
};
</script>
