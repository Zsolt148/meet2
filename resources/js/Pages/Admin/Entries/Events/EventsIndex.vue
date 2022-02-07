<template>
    <Head title="Versenyszámok" />

    <portal-layout>

        <div class="flex flex-col md:flex-row justify-between mb-5 md:mb-0">

            <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.meet.show', meet.id)">{{ meet.name }}</Link>
                <span class="font-medium pl-1">/</span> Versenyszámok
            </bread-crumb>

            <div v-show="isEventsEmpty">
                <jet-button size="sm" :href="route('admin:entries.meet.event.create', meet)">
                    <PlusIcon class="w-5 h-5 mr-2" />
                    Hozzáadás
                </jet-button>
            </div>

        </div>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" :links="events.links" />

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('order')">
                            Sorrend
                            <table-chevron :params="params" value="order" />
                        </span>
                    </th>
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
                        <span class="th-content" @click="updateSort('category')">
                            Kategória
                            <table-chevron :params="params" value="category" />
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
                    <td class="td-class td-content">
                        {{ __(event.pivot.order) }}
                    </td>
                    <td class="td-class">
                        {{ event.length }}m
                    </td>
                    <td class="td-class">
                        {{ __(event.sex) }}
                    </td>
                    <td class="td-class">
                        {{ __(event.swim) }}
                    </td>
                    <td class="td-class">
                        {{ __(event.pivot.category) }}
                    </td>
                    <td class="td-class">
                        {{ event.created_at }}
                    </td>
                </tr>
                <tr v-if="events.data.length === 0">
                    <td class="border-t px-6 py-2" colspan="6">Nem található versenyszám</td>
                </tr>
            </table>
        </div>
        <pagination class="my-5" :links="events.links" />
    </portal-layout>
</template>

<script>
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import { PlusIcon } from '@heroicons/vue/outline'
import Pagination from '@/Shared/Pagination'
import { getParams, getWatch } from '@/Use/useQuery';
import TableChevron from '@/Shared/TableChevron'
import { useForm } from '@inertiajs/inertia-vue3'
import BreadCrumb from "@/Shared/BreadCrumb";

export default {
    components: {
        JetButton,
        PortalLayout,
        Pagination,
        BaseSearch,
        TableChevron,
        BreadCrumb,
        PlusIcon
    },
    props: {
        isEventsEmpty: Boolean,
        filters: Object,
        events: Object,
        meet: Object,
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

        getWatch(params, route('admin:entries.meet.event.index', props.meet));

        return {
            params,
            updateSearch,
            updateSort,
        }
    },
};
</script>
