<template>
    <Head title="Versenyszámok" />

    <portal-layout>

        <div class="flex flex-col md:flex-row justify-between mb-5 md:mb-0">

            <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.index', meet.id)">{{ meet.name }}</Link>
                <span class="font-medium pl-1">/</span> Versenyszámok
            </bread-crumb>

            <div v-if="isEventsEmpty">
                <jet-button size="sm" :href="route('admin:entries.meet.event.create', meet)">
                    <PlusIcon class="w-5 h-5 mr-2" />
                    Hozzáadás
                </jet-button>
            </div>
            <div v-else>
                <jet-button size="sm" :href="route('admin:entries.meet.event.create', meet)">
                    <CogIcon class="w-5 h-5 mr-2" />
                    Szerkesztés
                </jet-button>
            </div>

        </div>

        <div>
            Összess leadott nevezés: {{ entries_count }} db
        </div>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="th-class">
                        <span class="th-content" >
                            Sorrend
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content">
                            Hossz
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content">
                            Nem
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content">
                            Úszás
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content">
                            Kategória
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content">
                            Leadott nevezések
                        </span>
                    </th>
                </tr>
                <tr v-for="event in events" :key="event.id" class="tr-class">
                    <td class="td-class td-content">
                        #{{ event.order }}
                    </td>
                    <td class="td-class">
                        {{ event.event.length }}m
                    </td>
                    <td class="td-class">
                        {{ __(event.event.sex) }}
                    </td>
                    <td class="td-class">
                        {{ __(event.event.swim) }}
                    </td>
                    <td class="td-class">
                        {{ __(event.category) }}
                    </td>
                    <td class="td-class">
                        {{ event.entries_count }} db
                    </td>
                </tr>
                <tr v-if="events.length === 0">
                    <td class="border-t px-6 py-2" colspan="6">Nem található versenyszám</td>
                </tr>
            </table>
        </div>
    </portal-layout>
</template>

<script>
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import { PlusIcon, CogIcon } from '@heroicons/vue/outline'
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
        PlusIcon,
        CogIcon
    },
    props: {
        events: Object,
        meet: Object,
        entries_count: Number,
    },
    setup(props) {
        return {
        }
    },
};
</script>
