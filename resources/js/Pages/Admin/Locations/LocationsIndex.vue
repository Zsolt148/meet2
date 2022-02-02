<template>
    <Head title="Helyszínek" />

    <portal-layout>
        <template #header>
            Helyszínek
        </template>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" :links="locations.links" />

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('city')">
                            Város
                            <table-chevron :params="params" value="city" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('address')">
                            Cím
                            <table-chevron :params="params" value="address" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('pool')">
                            Medence
                            <table-chevron :params="params" value="pool" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('timing')">
                            Időmérés
                            <table-chevron :params="params" value="timing" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('created_at')">
                            Létrehozva
                            <table-chevron :params="params" value="created_at" />
                        </span>
                    </th>
                </tr>
                <tr v-for="location in locations.data" :key="location.id" class="tr-class">
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:locations.edit', location.id)">
                            {{ location.city }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            {{ location.address }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            {{ location.pool }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            {{ location.timing }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            {{ location.created_at }}
                        </Link>
                    </td>
                    <td class="td-class w-px">
                        <Link class="td-content" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            <ChevronRightIcon class="w-5 h-5" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="locations.data.length === 0">
                    <td class="border-t px-6 py-2" colspan="4">Nem található helyszín</td>
                </tr>
            </table>
        </div>
        <pagination class="my-5" :links="locations.links" />
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
        locations: Object,
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

        getWatch(params, route('admin:locations.index'));

        return {
            params,
            updateSearch,
            updateSort,
        }
    },
};
</script>
