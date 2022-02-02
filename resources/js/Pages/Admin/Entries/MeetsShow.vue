<template>
    <Head title="Nevezhető verseny" />

    <portal-layout>
        <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek" :current="meet.name" />

        <div class="flex flex-col md:flex-row space-x-0 space-y-4 md:space-x-4 md:space-y-0 mb-5 -mt-3">
            <div>
                <jet-button size="sm" :href="route('admin:entries.meet.edit', meet)">
                    <CogIcon class="w-5 h-5 mr-2" />
                    Szerkesztés
                </jet-button>
            </div>

            <div>
                <jet-button size="sm" variant="success" :href="route('admin:entries.meet.edit', meet)">
                    Versenyszámok
                </jet-button>
            </div>

            <div>
                <jet-button size="sm" variant="info" :href="route('admin:entries.meet.edit', meet)">
                    Fizetések
                </jet-button>
            </div>
        </div>

        <div class="text-lg font-bold">
            Leadott Nevezések
        </div>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" v-if="entries" :links="entries.links" />

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <base-table>
                <template #head>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('name')">
                            Név
                            <table-chevron :params="params" value="name" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('entry_type')">
                            Típus
                            <table-chevron :params="params" value="entry_type" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('entries_count')">
                            Nevezések
                            <table-chevron :params="params" value="entries_count" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('date')">
                            Dátum
                            <table-chevron :params="params" value="date" />
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
                            <Link class="td-content" :href="route('admin:entries.meet.edit', entry.id)">
                                {{ entry.name }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="route('admin:entries.meet.edit', entry.id)" tabindex="-1">
                                {{ entry.entry_type }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="route('admin:entries.meet.edit', entry.id)" tabindex="-1">
                                0
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="route('admin:entries.meet.edit', entry.id)" tabindex="-1">
                                {{ entry.date }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="route('admin:entries.meet.edit', entry.id)" tabindex="-1">
                                {{ entry.created_at }}
                            </Link>
                        </td>
                        <td class="td-class w-px">
                            <Link class="td-content" :href="route('admin:entries.meet.edit', entry.id)" tabindex="-1">
                                <ChevronRightIcon class="w-5 h-5" />
                            </Link>
                        </td>
                    </tr>
                    <tr v-if="entries.data.length === 0">
                        <td class="border-t px-6 py-2" colspan="5">Nem található nevezés</td>
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
import { ChevronRightIcon, CogIcon } from '@heroicons/vue/outline'
import Pagination from '@/Shared/Pagination'
import { getParams, getWatch } from '@/Use/useQuery';
import TableChevron from '@/Shared/TableChevron'
import BaseTable from "@/Shared/BaseTable";
import BreadCrumb from "@/Shared/BreadCrumb";

export default {
    components: {
        ChevronRightIcon,
        CogIcon,
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
    },
    setup(props) {
        const params = getParams(props);

        function updateSearch(value) {
            params.search.value = value;
        }

        function updateSort(field) {
            params.field.value = field;
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc';
        }

        getWatch(params, route('admin:entries.meet.show', props.meet.id));

        return {
            params,
            updateSearch,
            updateSort,
        }
    },
};
</script>
