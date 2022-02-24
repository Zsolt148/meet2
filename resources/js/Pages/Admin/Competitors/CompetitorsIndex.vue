<template>
    <Head title="Versenyzők" />

    <portal-layout>
        <template #header>
            <div class="flex flex-col md:flex-row justify-between">
                <span>Versenyzők</span>
                <div class="justify-content-end">
                    <span class="text-sm font-normal mr-2">Szenior versenyzők lekérdezése az engedely.mszuosz.hu-ről</span>
                    <Button size="sm" @click="syncTeams" :loading="form.processing">Szinkronizálás</Button>
                </div>
            </div>
        </template>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" :links="competitors.links" />

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
                        <span class="th-content" @click="updateSort('birth')">
                            Születési év
                            <table-chevron :params="params" value="birth" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('sex')">
                            Nem
                            <table-chevron :params="params" value="sex" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content cursor-default">
                            Egyesület
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('created_at')">
                            Létrehozva
                            <table-chevron :params="params" value="created_at" />
                        </span>
                    </th>
                </tr>
                <tr v-for="competitor in competitors.data" :key="competitor.id" class="tr-class">
                    <td class="td-class">
                        <span class="td-content">
                            {{ competitor.name }}
                        </span>
                    </td>
                    <td class="td-class">
                        <span class="td-content">
                            {{ __(competitor.type) }}
                        </span>
                    </td>
                    <td class="td-class">
                        <span class="td-content" tabindex="-1">
                            {{ competitor.birth }}
                        </span>
                    </td>
                    <td class="td-class">
                        <span class="td-content" tabindex="-1">
                            {{ competitor.sex }}
                        </span>
                    </td>
                    <td class="td-class">
                        <span class="td-content" tabindex="-1">
                            {{ competitor.team ? competitor.team.name : '-' }}
                        </span>
                    </td>
                    <td class="td-class">
                        <span class="td-content" tabindex="-1">
                            {{ competitor.created_at }}
                        </span>
                    </td>
                </tr>
                <tr v-if="competitors.data.length === 0">
                    <td class="border-t px-6 py-2" colspan="5">Nem található versenyző</td>
                </tr>
            </table>
        </div>
        <pagination class="my-5" :links="competitors.links" />
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
        competitors: Object,
    },
    setup(props) {
        const params = getParams(props)

        function updateSearch(value) {
            params.search.value = value
        }

        function updateSort(field) {
            params.field.value = field
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc'
        }

        getWatch(params, route('admin:competitors.index'));

        const form = useForm({
            _method: 'POST'
        })

        function syncTeams() {
            form.post(route('admin:competitors.sync'))
        }

        return {
            params,
            updateSearch,
            updateSort,
            form,
            syncTeams,
        }
    },
};
</script>
