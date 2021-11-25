<template>
    <Head title="Versenyek" />

    <portal-layout>
        <template #header>
            Versenyek
        </template>

        <base-search @search="updateSearch" :search-term="params.search"
                     @select="updateYear" :select-value="params.year" :select-values="years"
        ></base-search>

        <pagination class="my-5" :links="meets.links" />

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('name')">
                            Név
                            <table-chevron :params="params" value="name" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('host')">
                            Rendező
                            <table-chevron :params="params" value="host" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('type')">
                            Típus
                            <table-chevron :params="params" value="type" />
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
                </tr>
                <tr v-for="meet in meets.data" :key="meet.id" class="tr-class">
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:meets.edit', meet.id)">
                            {{ meet.name }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:meets.edit', meet.id)" tabindex="-1">
                            {{ meet.host }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:meets.edit', meet.id)" tabindex="-1">
                            {{ meet.type }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:meets.edit', meet.id)" tabindex="-1">
                            {{ meet.date }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:meets.edit', meet.id)" tabindex="-1">
                            {{ meet.created_at }}
                        </Link>
                    </td>
                    <td class="td-class w-px">
                        <Link class="td-content" :href="route('admin:meets.edit', meet.id)" tabindex="-1">
                            <ChevronRightIcon class="w-5 h-5" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="meets.data.length.value === 0">
                    <td class="border-t px-6 py-2" colspan="4">Nem található verseny</td>
                </tr>
            </table>
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

export default {
    components: {
        ChevronRightIcon,
        JetButton,
        PortalLayout,
        Pagination,
        BaseSearch,
        TableChevron,
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
            params.search.year = value;
        }

        function updateSort(field) {
            params.field.value = field;
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc';
        }

        getWatch(params, 'admin:meets.index');

        return {
            params,
            updateSearch,
            updateYear,
            updateSort,
        }
    },
};
</script>
