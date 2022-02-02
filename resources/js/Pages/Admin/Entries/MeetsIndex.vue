<template>
    <Head title="Nevezhető Versenyek" />

    <portal-layout>
        <template #header>
            Nevezhető Versenyek
        </template>

        <base-search @search="updateSearch" :search-term="params.search"
                     @select="updateYear" :select-value="params.year" :select-values="years"
        ></base-search>

        <pagination class="my-5" :links="meets.links" />

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
                    <tr v-for="meet in meets.data" :key="meet.id" class="tr-class">
                        <td class="td-class">
                            <Link class="td-content" :href="route('admin:entries.meet.show', meet.id)">
                                {{ meet.name }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="route('admin:entries.meet.show', meet.id)" tabindex="-1">
                                {{ meet.entry_type }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="route('admin:entries.meet.show', meet.id)" tabindex="-1">
                                0
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="route('admin:entries.meet.show', meet.id)" tabindex="-1">
                                {{ meet.date }}
                            </Link>
                        </td>
                        <td class="td-class">
                            <Link class="td-content" :href="route('admin:entries.meet.show', meet.id)" tabindex="-1">
                                {{ meet.created_at }}
                            </Link>
                        </td>
                        <td class="td-class w-px">
                            <Link class="td-content" :href="route('admin:entries.meet.show', meet.id)" tabindex="-1">
                                <ChevronRightIcon class="w-5 h-5" />
                            </Link>
                        </td>
                    </tr>
                    <tr v-if="meets.data.length === 0">
                        <td class="border-t px-6 py-2" colspan="4">Nem található verseny</td>
                    </tr>
                </template>
            </base-table>
        </div>
        <pagination class="my-5" :links="meets.links" />
    </portal-layout>
</template>

<script>
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import { ChevronRightIcon } from '@heroicons/vue/outline'
import Pagination from '@/Shared/Pagination'
import { getParams, getWatch } from '@/Use/useQuery';
import TableChevron from '@/Shared/TableChevron'
import { ref } from 'vue';
import BaseTable from "@/Shared/BaseTable";

export default {
    components: {
        ChevronRightIcon,
        JetButton,
        PortalLayout,
        Pagination,
        BaseSearch,
        TableChevron,
        BaseTable,
    },
    props: {
        filters: Object,
        meets: Object,
        years: Array,
    },
    setup(props) {
        const params = getParams(props);
        params.year = ref(props.filters.year);

        function updateSearch(value) {
            params.search.value = value;
        }

        function updateYear(value) {
            params.year.value = value;
        }

        function updateSort(field) {
            params.field.value = field;
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc';
        }

        getWatch(params, route('admin:meets.index'));

        return {
            params,
            updateSearch,
            updateYear,
            updateSort,
        }
    },
};
</script>
