<template>
    <Head title="Felhasználók" />

    <portal-layout>
        <template #header>
            Felhasználók
        </template>

        <base-search @search="updateSearch" :search-term="params.search"></base-search>

        <pagination class="my-5" :links="users.links" />

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
                        <span class="th-content" @click="updateSort('email')">
                            Email
                            <table-chevron :params="params" value="email" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('role')">
                            Jogosultság
                            <table-chevron :params="params" value="role" />
                        </span>
                    </th>
                    <th class="th-class">
                        <span class="th-content" @click="updateSort('created_at')">
                            Létrehozva
                            <table-chevron :params="params" value="created_at" />
                        </span>
                    </th>
                </tr>
                <tr v-for="user in users.data" :key="user.id" class="tr-class">
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:users.edit', user.id)">
                            <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-8 w-8 object-cover mr-4">

                            {{ user.name }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:users.edit', user.id)" tabindex="-1">
                            {{ user.email }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:users.edit', user.id)" tabindex="-1">
                            {{ user.role_val }}
                        </Link>
                    </td>
                    <td class="td-class">
                        <Link class="td-content" :href="route('admin:users.edit', user.id)" tabindex="-1">
                            {{ user.created_at }}
                        </Link>
                    </td>
                    <td class="td-class w-px">
                        <Link class="td-content" :href="route('admin:users.edit', user.id)" tabindex="-1">
                            <ChevronRightIcon class="w-5 h-5" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="users.data.length === 0">
                    <td class="border-t px-6 py-2" colspan="4">Nem található felhasználó</td>
                </tr>
            </table>
        </div>
        <pagination class="my-5" :links="users.links" />
    </portal-layout>
</template>

<script>
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import { ChevronRightIcon } from '@heroicons/vue/outline'
import TableChevron from '@/Shared/TableChevron'
import Pagination from '@/Shared/Pagination'
import { getParams, getWatch } from '@/Use/useQuery';
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
        users: Object,
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

        getWatch(params, route('admin:users.index'));

        return {
            params,
            updateSearch,
            updateSort,
        }
    },
};
</script>
