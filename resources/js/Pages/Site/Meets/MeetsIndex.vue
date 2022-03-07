<template>

    <app-layout>
        <Head>
            <title>{{ __('Meets')}}</title>
            <meta head-key="description" name="description" :content="__('Meets')" />
        </Head>

        <template #header>
            {{ __('Meets') }}
        </template>

        <div class="max-w-7xl mx-auto py-8 px-0 xl:px-2">

            <base-search @search="updateSearch" :search-term="params.search"
                         @select="updateYear" :select-value="params.year" :select-values="years"
            ></base-search>

            <pagination class="my-5" :links="meets.links" />

            <div v-for="data in meets.data" :key="data.id" class="mx-auto mb-6 px-4 py-2 bg-white dark:bg-gray-600 shadow hover:shadow-md transition-shadow duration-200 ease-in-out rounded-lg w-full">
                <div class="py-2 flex flex-col sm:flex-row justify-between">
                    <div class="flex flex-row items-center">
                        <Link class="text-2xl link" :href="route('meets.show', data.slug)">
                            {{ data.name }}
                        </Link>
                    </div>
                    <div class="flex items-center mt-3 sm:mt-0 font-semibold text-teal-500 dark:text-teal-400">
                        <icon name="calendar" class="w-4 h-4 mt-1 mr-2" />
                        <span>{{ data.date }}</span>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 dark:text-gray-200 w-full mb-5">
                    <div class="flex" v-if="data.type">
                        <icon name="swimmer" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{data.type}}</span>
                    </div>
                    <div class="flex" v-if="data.location">
                        <LocationMarkerIcon class="w-5 h-5 mr-2" />
                        <span>{{data.location.city}} <span v-if="data.location.address">- {{data.location.address}}</span></span>
                    </div>
                    <div class="flex" v-if="data.location">
                        <icon name="pool" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{data.location.pool}} M - {{data.location.timing}}</span>
                    </div>
                </div>
                <div>
                    <Link class="inline-flex items-center text-teal-500 hover:text-teal-400 dark:text-teal-400" :href="route('meets.show', data.slug)">
                        Tovább
                        <icon name="arrow-right" class="w-4 h-4 ml-2"></icon>
                    </Link>
                </div>
            </div>

            <div v-if="meets.data.length === 0" class="text-black dark:text-white">
                Nincs a keresésnek '{{params.search}}' megfelelő találat
            </div>

            <pagination class="my-5" :links="meets.links" />

        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import {getParams, getWatch} from "@/Use/useQuery";
import BaseSearch from "@/Pages/Portal/Components/BaseSearch";
import Pagination from '@/Shared/Pagination'
import Icon from "@/Shared/Icon";
import {ref} from "vue";
import { LocationMarkerIcon } from '@heroicons/vue/outline'

export default {
    components: {
        AppLayout,
        BaseSearch,
        Pagination,
        Icon,
        LocationMarkerIcon
    },
    props: {
        filters: Object,
        meets: Object,
        years: Array,
    },
    setup(props) {
        const params = getParams(props);
        params.year = ref(props.filters.year);

        function updateSearch(value) {
            params.search.value = value;
        }

        function updateYear(value) {
            params.year.value = value;
        }

        function updateSort(field) {
            params.field.value = field;
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc';
        }

        getWatch(params, route('meets.index'));

        return {
            params,
            updateSearch,
            updateYear,
            updateSort,
        }
    },
}
</script>