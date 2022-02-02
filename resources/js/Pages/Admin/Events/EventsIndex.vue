<template>
    <Head title="Egyesületek" />

    <portal-layout>
        <template #header>
            Versenyszámok
        </template>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" :links="events.links" />

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('length')">
                            Hossz
                            <table-chevron :params="params" value="length" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('sex')">
                            Nem
                            <table-chevron :params="params" value="sex" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('swim')">
                            Úszás
                            <table-chevron :params="params" value="swim" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('created_at')">
                            Létrehozva
                            <table-chevron :params="params" value="created_at" />
                        </span>
                    </th>
                </tr>
                <tr v-for="event in events.data" :key="event.id" class="tr-class">
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:events.edit', event.id)">
                            {{ event.length }}m
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:events.edit', event.id)">
                            {{ __(event.sex) }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:events.edit', event.id)" tabindex="-1">
                            {{ __(event.swim) }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:events.edit', event.id)" tabindex="-1">
                            {{ event.created_at }}
                        </Link>
                    </td>
                    <td class="td-class w-px">
                        <Link class="td-content" :href="route('admin:events.edit', event.id)" tabindex="-1">
                            <ChevronRightIcon class="w-5 h-5" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="events.data.length === 0">
                    <td class="border-t px-6 py-2" colspan="4">Nem található versenyszám</td>
                </tr>
            </table>
        </div>
        <pagination class="my-5" :links="events.links" />
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
        events: Object,
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

        getWatch(params, 'admin:events.index');

        return {
            params,
            updateSearch,
            updateSort,
        }
    },
};
</script>
