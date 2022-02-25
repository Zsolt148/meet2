<template>
    <portal-layout>
        <Head>
            <title>{{meet.name}}</title>
            <meta head-key="description" name="description" :content="meet.name"/>
        </Head>

        <template #header>
            <div class="flex justify-between">
                <bread-crumb :back-route="route('portal:meets.index')" :back-name="__('Entriable Meets')"
                             :current="meet.name"/>
                <div>
                    <jet-button size="sm" :href="route('admin:meets.edit', meet.id)" v-show="isAdmin()">
                        <CogIcon class="w-5 h-5 mr-2"/>
                        Szerkesztés
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

                <div class="my-5">
                    {{ __('Deadline for entries') }}: {{ timeFormat(meet.deadline) }} {{ __('midnight') }}
                </div>

                <div class="mt-5">
                    <jet-button :disabled="!meet.is_deadline_ok || !isTeamLeader()" :href="route('portal:meet.entry.create', meet)">
                        {{ __('New entry') }}
                    </jet-button>
                    <jet-button type="button" variant="info" v-show="hasEntries" :disabled="!meet.is_deadline_ok || !isTeamLeader()" @click="confirmFinalizeShow = true" class="ml-2">
                        {{ __('Finalize') }}
                    </jet-button>
                </div>

                <div class="mt-2 text-xs" v-show="!isTeamLeader()">
                    Ahhoz, hogy nevezéseket tudj leadni, a <Link class="link" :href="route('profile.show')">profilodban</Link> bekell állítanod egy egyesületet
                </div>
            </div>

            <div class="text-lg font-bold mt-5">
                {{ __('Entries submitted') }}
            </div>

            <base-search @search="updateSearch" :search-term="params.search"></base-search>

            <pagination class="my-5" v-if="entries" :links="entries.links"/>

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
                            {{ __('Event') }}
                        </span>
                        </th>
                        <th class="th-class">
                        <span class="th-content" @click="updateSort('time')">
                            {{ __('Time') }}
                            <table-chevron :params="params" value="time"/>
                        </span>
                        </th>
                        <th class="th-class">
                        <span class="th-content" @click="updateSort('is_final')">
                            Végleges
                            <table-chevron :params="params" value="is_final" />
                        </span>
                        </th>
                        <th class="th-class">
                        <span class="th-content" @click="updateSort('created_at')">
                            {{ __('Created at') }}
                            <table-chevron :params="params" value="created_at"/>
                        </span>
                        </th>
                    </template>
                    <template #body>
                        <tr v-for="entry in entries.data" :key="entry.id" class="tr-class">
                            <td class="td-class">
                                <Link class="td-content" :href="entryRoute(entry)">
                                    {{entry.competitor.name}}
                                </Link>
                            </td>
                            <td class="td-class">
                                <Link class="td-content" :href="entryRoute(entry)" tabindex="-1">
                                    {{entry.meet_event.event.length}}m {{__(entry.meet_event.event.sex)}}
                                    {{__(entry.meet_event.event.swim)}} {{entry.meet_event.category}}
                                </Link>
                            </td>
                            <td class="td-class">
                                <Link class="td-content" :href="entryRoute(entry)" tabindex="-1">
                                    {{entry.time}}
                                </Link>
                            </td>
                            <td class="td-class">
                                <Link class="td-content" :href="entryRoute(entry)" tabindex="-1">
                                    <CheckIcon v-if="entry.is_final" class="w-5 h-5" /><XIcon v-else class="w-5 h-5"/>
                                </Link>
                            </td>
                            <td class="td-class">
                                <Link class="td-content" :href="entryRoute(entry)" tabindex="-1">
                                    {{ timeFormat(entry.created_at) }}
                                </Link>
                            </td>
                            <td class="td-class w-px">
                                <Link class="td-content" :href="entryRoute(entry)" tabindex="-1">
                                    <ChevronRightIcon class="w-5 h-5"/>
                                </Link>
                            </td>
                        </tr>
                        <tr v-if="entries.data.length === 0">
                            <td class="border-t px-6 py-2" colspan="5">{{ __('No entries found') }}</td>
                        </tr>
                    </template>
                </base-table>
            </div>
            <pagination class="my-5" :links="entries.links"/>
        </div>
        <ScrollTop/>
        <jet-confirmation-modal :show="confirmFinalizeShow" @close="confirmFinalizeShow = false">
            <template #title>
                Nevezések véglegesítése
            </template>

            <template #content>
                Biztosan véglegesíteni szeretnéd az összes nevezésed ? <br>
                Véglegesítés után nem lehet majd frissíteni.
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
import { ref } from 'vue'
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
    XIcon
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
        ScrollTop
    },
    props: ['meet', 'entries', 'filters', 'hasEntries'],
    setup(props) {
        const confirmFinalizeShow = ref(false);
        const params = getParams(props);

        function entryRoute(entry) {
            return props.meet.is_deadline_ok
                ? route('portal:meet.entry.edit', {meet: props.meet.id, entry: entry})
                : route('portal:meet.entry.show', {meet: props.meet.id, entry: entry})
        }

        function updateSearch(value) {
            params.search.value = value;
        }

        function updateSort(field) {
            params.field.value = field;
            params.direction.value = params.direction.value === 'asc' ? 'desc' : 'asc';
        }

        function finalize() {
            Inertia.post(route('portal:meet.entry.finalize-all', props.meet))
            confirmFinalizeShow.value = false
        }

        getWatch(params, route('portal:meets.show', props.meet.slug));

        return {
            params,
            confirmFinalizeShow,
            finalize,
            entryRoute,
            updateSearch,
            updateSort,
        }
    }
}
</script>