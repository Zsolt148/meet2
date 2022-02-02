<template>
    <Head title="Egyesületek" />

    <portal-layout>
        <template #header>
            <div class="flex flex-col md:flex-row justify-between">
                <span>Egyesületek</span>
                <div class="justify-content-end">
                    <span class="text-sm font-normal mr-2">Szenior egyesületek lekérdezése az mszuosz.hu-ról</span>
                    <Button size="sm" @click="syncTeams()">Szinkronizálás</Button>
                </div>
            </div>
        </template>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" :links="teams.links" />

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
                        <span class="th-content" @click="updateSort('type')">
                            Típus
                            <table-chevron :params="params" value="type" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('SA')">
                            SA
                            <table-chevron :params="params" value="SA" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('address')">
                            Cím
                            <table-chevron :params="params" value="address" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('created_at')">
                            Létrehozva
                            <table-chevron :params="params" value="created_at" />
                        </span>
                    </th>
                </tr>
                <tr v-for="team in teams.data" :key="team.id" class="tr-class">
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:teams.edit', team.id)">
                            {{ team.name }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:teams.edit', team.id)">
                            {{ __(team.type) }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:teams.edit', team.id)" tabindex="-1">
                            {{ team.SA }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:teams.edit', team.id)" tabindex="-1">
                            {{ team.address }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:teams.edit', team.id)" tabindex="-1">
                            {{ team.created_at }}
                        </Link>
                    </td>
                    <td class="td-class w-px">
                        <Link class="td-content" :href="route('admin:teams.edit', team.id)" tabindex="-1">
                            <ChevronRightIcon class="w-5 h-5" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="teams.data.length === 0">
                    <td class="border-t px-6 py-2" colspan="5">Nem található egyesület</td>
                </tr>
            </table>
        </div>
        <pagination class="my-5" :links="teams.links" />
    </portal-layout>
</template>

<script>
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import PortalLayout from "@/Layouts/PortalLayout";
import Button from "@/Jetstream/Button";
import { ChevronRightIcon } from '@heroicons/vue/outline'
import Pagination from '@/Shared/Pagination'
import { getParams, getWatch } from '@/Use/useQuery';
import TableChevron from '@/Shared/TableChevron'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        ChevronRightIcon,
        Button,
        PortalLayout,
        Pagination,
        BaseSearch,
        TableChevron,
    },
    props: {
        filters: Object,
        teams: Object,
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

        getWatch(params, 'admin:teams.index');

        function syncTeams() {
            useForm({_method: 'POST'}).post(route('admin:teams.sync'));
        }

        return {
            params,
            updateSearch,
            updateSort,
            syncTeams,
        }
    },
};
</script>
