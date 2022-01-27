<template>
    <Head title="Kapcsolattartók" />

    <portal-layout>
        <template #header>
            Kapcsolattartók
        </template>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" :links="contacts.links" />

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
                        <span class="th-content" @click="updateSort('phone')">
                            Telefon
                            <table-chevron :params="params" value="phone" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('email')">
                            Email
                            <table-chevron :params="params" value="email" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('created_at')">
                            Létrehozva
                            <table-chevron :params="params" value="created_at" />
                        </span>
                    </th>
                </tr>
                <tr v-for="contact in contacts.data" :key="contact.id" class="tr-class">
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:contacts.edit', contact.id)">
                            {{ contact.name }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:contacts.edit', contact.id)" tabindex="-1">
                            {{ contact.phone }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:contacts.edit', contact.id)" tabindex="-1">
                            {{ contact.email }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:contacts.edit', contact.id)" tabindex="-1">
                            {{ contact.created_at }}
                        </Link>
                    </td>
                    <td class="td-class w-px">
                        <Link class="td-content" :href="route('admin:contacts.edit', contact.id)" tabindex="-1">
                            <ChevronRightIcon class="w-5 h-5" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="contacts.data.length === 0">
                    <td class="border-t px-6 py-2" colspan="4">Nem található kapcsolattartó</td>
                </tr>
            </table>
        </div>
        <pagination class="my-5" :links="contacts.links" />
    </portal-layout>
</template>

<script>
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import Pagination from '@/Shared/Pagination'
import TableChevron from '@/Shared/TableChevron'
import { getParams, getWatch } from '@/Use/useQuery';
import { ChevronRightIcon } from '@heroicons/vue/outline'

export default {
    components: {
        ChevronRightIcon,
        JetButton,
        PortalLayout,
        Pagination,
        BaseSearch,
        TableChevron
    },
    props: {
        filters: Object,
        contacts: Object,
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

        getWatch(params, 'admin:contacts.index');

        return {
            params,
            updateSearch,
            updateSort,
        }
    },
};
</script>
