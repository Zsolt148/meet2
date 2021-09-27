<template>
    <app-layout>
        <template #header>
            {{ __('Meets') }}
        </template>
        <div class="max-w-7xl mx-auto py-8 px-0 xl:px-2">

            <base-search @search="updateSearch" :search-term="params.search"></base-search>

            <pagination class="my-5" :links="meets.links" />

            <div v-for="data in meets.data" :key="data.id" class="mx-auto mb-6 px-4 py-2 bg-white shadow hover:shadow-md transition-shadow duration-300 ease-in-out rounded-lg w-full border-r-8" :class="data.type == 'important' ? 'border-red-500' : data.type == 'highlighted' ? 'border-blue-500' : ''">
                <div class="py-2 flex flex-col sm:flex-row justify-between">
                    <div class="flex flex-row items-center">
                        <inertia-link class="text-2xl text-main hover:underline" :href="route('meets.show', data.id)">
                            {{ data.name }}
                        </inertia-link>
                    </div>
                    <div class="flex items-center mt-3 sm:mt-0 font-semibold text-gray-">
                        <icon name="calendar" class="w-4 h-4 mt-1 mr-2" />
                        <span>{{ data.created_at }}</span>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 w-full mb-5">
                    <div class="flex" v-if="data.location">
                        <icon name="location-arrow" class="w-5 h-5 sm:w-4 sm:h-4 mt-1 mr-3 sm:mr-2" />
                        <span>{{data.location.city}}, {{content.location.name}} <span v-if="content.location.address">- {{content.location.address}}</span></span>
                    </div>
                    <div class="flex" v-if="data.type">
                        <icon name="swimmer" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{data.type}}</span>
                    </div>
                    <div class="flex" v-if="data.host">
                        <icon name="pool" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{data.host}} M - {{data.host}} időmérés</span>
                    </div>
                </div>
                <div>
                    <inertia-link class="inline-flex items-center text-green hover:text-green-light" :href="route('meets.show', data.id)">
                        Tovább
                        <icon name="arrow-right" class="w-4 h-4 ml-2"></icon>
                    </inertia-link>
                </div>
            </div>

            <div v-if="meets.data.length === 0" class="">
                Nincs a keresésnek '{{params.search}}' megfelelő találat
            </div>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import {getParams, getWatch} from "@/Use/useQuery";
import BaseSearch from "@/Pages/Admin/Components/BaseSearch";
import Pagination from '@/Shared/Pagination'
import Icon from "@/Shared/Icon";

export default {
    components: {
        AppLayout,
        BaseSearch,
        Pagination,
        Icon
    },
    props: {
        filters: Object,
        meets: Object,
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

        getWatch(params, 'meets.index');

        return {
            params,
            updateSearch,
            updateSort,
        }
    },
}
</script>
