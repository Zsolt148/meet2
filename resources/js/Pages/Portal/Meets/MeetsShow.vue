<template>
    <portal-layout>
        <Head>
            <title>{{meet.name}}</title>
            <meta head-key="description" name="description" :content="meet.name"/>
        </Head>

        <template #header>
            <div class="flex justify-between">
                <bread-crumb :back-route="route('portal:meets.index')"
                             :back-name="__('Entriable Meets')"
                             :current="meet.name"
                />
                <div>
                    <jet-button size="sm" class="mr-2" :href="route('admin:entries.index', meet.id)" v-show="isAdmin()">
                        <CogIcon class="w-5 h-5 mr-2"/>
                        Szerkesztés
                    </jet-button>
                    <jet-button size="sm" :href="route('meets.show', meet)">
                        <EyeIcon class="w-5 h-5 mr-2" />
                        {{ __('View') }}
                    </jet-button>
                </div>
            </div>
        </template>

        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-600 shadow p-5 rounded-md">
                <div class="flex flex-col sm:flex-row justify-between mb-2">
                    <h1 class="text-teal-500 dark:text-teal-400 text-3xl">
                        {{meet.name}}
                    </h1>
                    <div class="flex items-center mt-3 sm:mt-0 font-semibold text-teal-500 dark:text-teal-400">
                        <icon name="calendar" class="w-4 h-4 mr-2"/>
                        <span>{{meet.date}}</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 dark:text-gray-200 w-full mb-5">
                    <div class="flex" v-if="meet.type">
                        <icon name="swimmer" class="w-5 h-5 mt-1 mr-2"/>
                        <span>{{meet.type}}</span>
                    </div>
                    <div class="flex" v-if="meet.contact">
                        <AtSymbolIcon class="w-5 h-5 mr-2"/>
                        <span>{{meet.contact.name}} - {{meet.contact.email}}</span>
                    </div>
                    <div class="flex" v-if="meet.location">
                        <LocationMarkerIcon class="w-5 h-5 mr-2"/>
                        <span>{{meet.location.city}} <span
                            v-if="meet.location.address">- {{meet.location.address}}</span></span>
                    </div>
                    <div class="flex" v-if="meet.location">
                        <icon name="pool" class="w-5 h-5 mt-1 mr-2"/>
                        <span>{{meet.location.pool}} M - {{meet.location.timing}}</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 dark:text-gray-200 w-full mb-5"
                     v-if="meet.raceInfo || meet.preStartlist || meet.raceRecord || meet.timeSchedule">
                    <div class="flex" v-if="meet.raceInfo">
                        <DocumentIcon class="w-5 h-5"/>
                        <a class="ml-1 link" target="_blank" :href="meet.raceInfo.url">{{__('Raceinfo')}}</a>
                    </div>
                    <div class="flex" v-if="meet.preStartlist">
                        <DocumentIcon class="w-5 h-5"/>
                        <a class="ml-1 link" target="_blank" :href="meet.preStartlist.url">{{__('Pre startlist')}}</a>
                    </div>
                    <div class="flex" v-if="meet.raceRecord">
                        <DocumentIcon class="w-5 h-5"/>
                        <a class="ml-1 link" target="_blank" :href="meet.raceRecord.url">{{__('Race record')}}</a>
                    </div>
                    <div class="flex" v-if="meet.timeSchedule">
                        <DocumentIcon class="w-5 h-5"/>
                        <a class="ml-1 link" target="_blank" :href="meet.timeSchedule.url">{{__('Time schedule')}}</a>
                    </div>
                </div>

                <div class="my-5 text-lg">
                    <div>
                        {{ __('Deadline for entries') }}: {{ timeFormat(meet.deadline, 'YYYY.MM.DD') }} {{ __('midnight') }}
                    </div>

                    <div v-show="meet.entry_price">
                        {{ __('Price per entry') }}: {{ meet.entry_price }} Ft
                    </div>
                </div>

                <div class="mb-2" v-show="entries_count !== 0">
                    <div class="font-semibold">
                        {{ __('Entries submitted') }}:
                    </div>
                    <div>
                        {{ __('Individual entries') }}: {{ individual_entries_count }} db
                    </div>
                    <div>
                        {{ __('Relay entries') }}: {{ relay_entries_count }} db
                    </div>
                    <div>
                        {{ __('Individual entries altogether') }}: {{ price }} Ft
                    </div>
                </div>

                <div class="mt-5">
                    <jet-button :disabled="!meet.is_deadline_ok || !isTeamLeader()" :href="route('portal:meet.entry.create', meet)">
                        {{ __('New entry') }}
                    </jet-button>
<!--                    <jet-button type="button" variant="info" v-show="has_entries && !entries_are_final" :disabled="!meet.is_deadline_ok || !isTeamLeader()" @click="confirmFinalizeShow = true" class="ml-2">-->
<!--                        {{ __('Finalize') }}-->
<!--                    </jet-button>-->
                </div>

                <div class="mt-2 text-xs" v-show="!hasTeam()">
                    {{ __('In order to submit entries, you must set up an association in your profile.') }} <Link class="link" :href="route('profile.show')"> {{ __('Profile settings') }} </Link>
                </div>

                <div class="mt-2 text-xs" v-show="!isTeamLeader() && hasTeam()">
                    {{ __('You do not have permission to submit entries yet, please wait while an admin reviews your registration!') }}
                </div>
            </div>

            <div class="text-lg font-bold mt-5">
                {{ __('Entries submitted') }}
            </div>

            <base-search @search="updateSearch" :search-term="params.search"></base-search>

            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
                <base-table>
                    <template #head>
                        <th class="th-class">
                        <span class="th-content" @click="updateSort('name')">
                            {{ __('Competitor') }}
                            <table-chevron :params="params" value="name"/>
                        </span>
                        </th>
                        <th class="th-class">
                        <span class="th-content cursor-default">
                            {{ __('Entries') }}
                        </span>
                        </th>
                        <th class="th-class">
                        <span class="th-content cursor-default">
                            {{ __('Individual entries fee') }}
                            <table-chevron :params="params" value="time"/>
                        </span>
                        </th>
                        <th class="th-class">
                        <span class="th-content cursor-default">
                            {{ __('Final') }}
                            <table-chevron :params="params" value="is_final" />
                        </span>
                        </th>
                    </template>
                    <template #body>
                        <tr v-for="competitor in competitors" :key="competitor.id" class="tr-class">
                            <td class="td-class">
                                <Link class="td-content" :href="entryRoute(competitor)">
                                    {{competitor.name}}
                                </Link>
                            </td>
                            <td class="td-class">
                                <Link class="td-content" :href="entryRoute(competitor)" tabindex="-1">
                                    {{ competitor.entries.length }} db
                                </Link>
                            </td>
                            <td class="td-class">
                                <Link class="td-content" :href="entryRoute(competitor)" tabindex="-1">
                                    {{ competitor.price }} Ft
                                </Link>
                            </td>
                            <td class="td-class">
                                <Link class="td-content" :href="entryRoute(competitor)" tabindex="-1">
                                    <CheckIcon v-if="competitor.is_final" class="w-5 h-5" /><XIcon v-else class="w-5 h-5"/>
                                </Link>
                            </td>
                            <td class="td-class w-px">
                                <Link class="td-content" :href="entryRoute(competitor)" tabindex="-1">
                                    <ChevronRightIcon class="w-5 h-5"/>
                                </Link>
                            </td>
                        </tr>
                        <tr v-if="competitors.length === 0">
                            <td class="border-t px-6 py-2" colspan="5">{{ __('No entries found') }}</td>
                        </tr>
                    </template>
                </base-table>
            </div>
        </div>
        <ScrollTop/>
        <jet-confirmation-modal :show="confirmFinalizeShow" @close="confirmFinalizeShow = false">
            <template #title>
                {{ __('Finalize all my entries') }}
            </template>

            <template #content>
                <div>
                    {{ __('Are you sure you want to finalize all your entries ?') }}<br>
                    {{ __('It will not be possible to change it after it has been finalized.') }}
                </div>
                <div class="mt-5">
                    {{ __('Entries submitted') }}: {{ entries_count }} db <br>
                    {{ __('Individual entries fee') }}: {{ price }} Ft
                </div>
            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="confirmFinalizeShow = false">
                    {{ __('Cancel') }}
                </jet-button>

                <jet-button variant="info" type="button" @click.native="finalize">
                    {{ __('Finalize') }}
                </jet-button>
            </template>
        </jet-confirmation-modal>
    </portal-layout>
</template>

<script>
import { ref, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import JetLabel from '@/Jetstream/Label'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import Icon from "@/Shared/Icon"
import ScrollTop from "@/Shared/ScrollTop"
import Pagination from "@/Shared/Pagination"
import BreadCrumb from "@/Shared/BreadCrumb"
import BaseSearch from "@/Pages/Portal/Components/BaseSearch"
import TableChevron from '@/Shared/TableChevron'
import BaseTable from "@/Shared/BaseTable"
import PortalLayout from "@/Layouts/PortalLayout"
import {
    DocumentIcon,
    CogIcon,
    LocationMarkerIcon,
    AtSymbolIcon,
    ChevronRightIcon,
    CheckIcon,
    XIcon,
    EyeIcon
} from '@heroicons/vue/outline'
import {getParams, getWatch} from "@/Use/useQuery";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";

export default {
    components: {
        PortalLayout,
        BaseSearch,
        BaseTable,
        TableChevron,
        Pagination,
        BreadCrumb,
        JetLabel,
        JetConfirmationModal,
        JetButton,
        JetInput,
        Icon,
        DocumentIcon,
        CogIcon,
        LocationMarkerIcon,
        AtSymbolIcon,
        ChevronRightIcon,
        CheckIcon,
        XIcon,
        EyeIcon,
        ScrollTop
    },
    props: ['meet', 'competitors', 'filters', 'has_entries', 'entries_count', 'individual_entries_count', 'relay_entries_count', 'entries_are_final'],
    setup(props) {
        const confirmFinalizeShow = ref(false);
        const params = getParams(props);

        function entryRoute(competitor) {
            return props.meet.is_deadline_ok
                ? route('portal:meet.entry.edit', {meet: props.meet.id, competitor: competitor.id})
                : route('portal:meet.entry.show', {meet: props.meet.id, competitor: competitor.id})
        }

        function updateSearch(value) {
            params.search.value = value;
        }

        function updateSort(field) {
            params.field.value = field;
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc';
        }

        const price = computed(() => {
            return props.meet.entry_price * props.individual_entries_count
        })

        function finalize() {
            Inertia.post(route('portal:meet.entry.finalize-all', props.meet))
            confirmFinalizeShow.value = false
        }

        getWatch(params, route('portal:meets.show', props.meet.slug));

        return {
            params,
            confirmFinalizeShow,
            price,
            finalize,
            entryRoute,
            updateSearch,
            updateSort,
        }
    }
}
</script>