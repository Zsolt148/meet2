<template>
    <Head title="Nevezhető verseny" />

    <portal-layout>

        <template #header>
            <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.index', meet.id)">{{ meet.name }}</Link>
                <span class="font-medium pl-1">/</span> Exportok
            </bread-crumb>
        </template>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto">
            <div class="text-xl px-8 py-6">
                Exportok letöltése ({{ meet.entry_app }})
            </div><s></s>

            <div v-if="meet.entry_app == 'meetmanager-csv'" class="px-8 py-6 flex flex-col md:flex-row space-x-0 space-y-4 md:space-x-4 md:space-y-0">
                <div>
                    <jet-button size="sm" external :href="route('admin:entries.exports.competitors', meet)">
                        <DownloadIcon class="w-5 h-5 mr-2" />
                        Athlete.csv
                    </jet-button>
                </div>

                <div>
                    <jet-button size="sm" external :href="route('admin:entries.exports.teams', meet)">
                        <DownloadIcon class="w-5 h-5 mr-2" />
                        Team.csv
                    </jet-button>
                </div>

                <div>
                    <jet-button size="sm" external :href="route('admin:entries.exports.entries', meet)">
                        <DownloadIcon class="w-5 h-5 mr-2" />
                        Entry.csv
                    </jet-button>
                </div>
            </div>
            <div v-else-if="meet.entry_app == 'uszas-csv'" class="px-8 py-6 flex flex-col md:flex-row space-x-0 space-y-4 md:space-x-4 md:space-y-0">
                <div>
                    <jet-button size="sm" external :href="route('admin:entries.exports.teams', meet)">
                        <DownloadIcon class="w-5 h-5 mr-2" />
                        Egyesuletek.csv
                    </jet-button>
                </div>

                <div>
                    <jet-button size="sm" external :href="route('admin:entries.exports.entries', meet)">
                        <DownloadIcon class="w-5 h-5 mr-2" />
                        Nevezesek.csv
                    </jet-button>
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center mt-5">
                <jet-button type="button" variant="secondary" :href="route('admin:entries.index', meet)">
                    {{ __('Back') }}
                </jet-button>
            </div>
        </div>
    </portal-layout>
</template>

<script>
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import { DownloadIcon } from '@heroicons/vue/outline'
import BreadCrumb from "@/Shared/BreadCrumb";

export default {
    components: {
        DownloadIcon,
        JetButton,
        PortalLayout,
        BreadCrumb
    },
    props: {
        meet: Object,
    },
    data() {
        return {

        }
    }
};
</script>
