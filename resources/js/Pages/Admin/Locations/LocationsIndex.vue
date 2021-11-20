<template>
    <Head title="Helyszínek" />

    <portal-layout>
        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" :links="locations.links" />

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">
                        <span class="inline-flex w-full justify-between cursor-pointer" @click="updateSort('city')">
                            Város
                            <icon v-if="params.field.value === 'city' && params.direction.value === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                            <icon v-if="params.field.value === 'city' && params.direction.value === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                        </span>
                    </th>
                    <th class="px-6 pt-6 pb-4">
                        <span class="inline-flex w-full justify-between cursor-pointer" @click="updateSort('address')">
                            Cím
                            <icon v-if="params.field.value === 'address' && params.direction.value === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                            <icon v-if="params.field.value === 'address' && params.direction.value === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                        </span>
                    </th>
                    <th class="px-6 pt-6 pb-4">
                        <span class="inline-flex w-full justify-between cursor-pointer" @click="updateSort('pool')">
                            Medence
                            <icon v-if="params.field.value === 'pool' && params.direction.value === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                            <icon v-if="params.field.value === 'pool' && params.direction.value === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                        </span>
                    </th>
                    <th class="px-6 pt-6 pb-4">
                        <span class="inline-flex w-full justify-between cursor-pointer" @click="updateSort('timing')">
                            Időmérés
                            <icon v-if="params.field.value === 'timing' && params.direction.value === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                            <icon v-if="params.field.value === 'timing' && params.direction.value === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                        </span>
                    </th>
                    <th class="px-6 pt-6 pb-4">
                        <span class="inline-flex w-full justify-between cursor-pointer" @click="updateSort('created_at')">
                            Létrehozva
                            <icon v-if="params.field.value === 'created_at' && params.direction.value === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                            <icon v-if="params.field.value === 'created_at' && params.direction.value === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                        </span>
                    </th>
                </tr>
                <tr v-for="location in locations.data" :key="location.id" class="hover:bg-gray-100 dark:hover:bg-gray-600 focus-within:bg-gray-100">
                    <td class="border-t dark:border-gray-400">
                        <Link class="px-6 py-2 flex items-center" :href="route('admin:locations.edit', location.id)">
                            {{ location.city }}
                        </Link>
                    </td>
                    <td class="border-t dark:border-gray-400">
                        <Link class="px-6 py-2 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            {{ location.address }}
                        </Link>
                    </td>
                    <td class="border-t dark:border-gray-400">
                        <Link class="px-6 py-2 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            {{ location.pool }}
                        </Link>
                    </td>
                    <td class="border-t dark:border-gray-400">
                        <Link class="px-6 py-2 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            {{ location.timing }}
                        </Link>
                    </td>
                    <td class="border-t dark:border-gray-400">
                        <Link class="px-6 py-2 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            {{ location.created_at }}
                        </Link>
                    </td>
                    <td class="border-t w-px dark:border-gray-400">
                        <Link class="px-4 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                            <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="locations.data.length.value === 0">
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
import Icon from '@/Shared/Icon'
import Pagination from '@/Shared/Pagination'
import { getParams, getWatch } from '@/Use/useQuery';
export default {
    components: {
        Icon,
        JetButton,
        PortalLayout,
        Pagination,
        BaseSearch,
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

        getWatch(params, 'admin:locations.index');

        return {
            params,
            updateSearch,
            updateSort,
        }
    },
};
</script>
