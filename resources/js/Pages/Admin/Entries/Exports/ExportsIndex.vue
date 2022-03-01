<template>
    <Head title="Nevezhető verseny" />

    <portal-layout>

        <template #header>
            <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.index', meet.id)">{{ meet.name }}</Link>
                <span class="font-medium pl-1">/</span> Exportok
            </bread-crumb>
        </template>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto p-5">
            <div class="text-xl">
                Exportok letöltése
            </div>
            <div class="flex flex-col md:flex-row space-x-0 space-y-4 md:space-x-4 md:space-y-0 mt-5">
                <div>
                    <jet-button size="sm" external :href="route('admin:entries.exports.competitors', meet)">
                        <DownloadIcon class="w-5 h-5 mr-2" />
                        Athlete.csv letöltése
                    </jet-button>
                </div>

                <div>
                    <jet-button size="sm" external :href="route('admin:entries.exports.teams', meet)">
                        <DownloadIcon class="w-5 h-5 mr-2" />
                        Team.csv letöltése
                    </jet-button>
                </div>

                <div>
                    <jet-button size="sm" external :href="route('admin:entries.exports.entries', meet)">
                        <DownloadIcon class="w-5 h-5 mr-2" />
                        Entry.csv letöltése
                    </jet-button>
                </div>
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
