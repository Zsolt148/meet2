<template>
    <portal-layout>
        <Head>
            <title>{{ meet.name }}</title>
            <meta head-key="description" name="description" :content="meet.name" />
        </Head>

        <template #header>
            <div class="flex justify-between">
                <div>
                    <Link class="text-teal-400" :href="route('portal:meets.index')">{{__('Meets')}}</Link>
                    /
                    {{ meet.name }}
                </div>
                <div>
                    <jet-button size="sm" :href="route('admin:meets.edit', meet.id)" v-show="isAdmin()">
                        <CogIcon class="w-5 h-5 mr-2" />
                        Szerkesztés
                    </jet-button>
                </div>
            </div>
        </template>

        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-600 shadow p-5 rounded-md">
                <div class="flex flex-col sm:flex-row justify-between mb-2">
                    <h1 class="text-teal-500 dark:text-teal-400 text-3xl">
                        {{ meet.name }}
                    </h1>
                    <div class="flex items-center mt-3 sm:mt-0 font-semibold text-teal-500 dark:text-teal-400">
                        <icon name="calendar" class="w-4 h-4 mr-2" />
                        <span>{{ meet.date }}</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 dark:text-gray-200 w-full mb-5">
                    <div class="flex" v-if="meet.type">
                        <icon name="swimmer" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{meet.type}}</span>
                    </div>
                    <div class="flex" v-if="meet.contact">
                        <AtSymbolIcon class="w-5 h-5 mr-2" />
                        <span>{{meet.contact.name}} - {{meet.contact.email}}</span>
                    </div>
                    <div class="flex" v-if="meet.location">
                        <LocationMarkerIcon class="w-5 h-5 mr-2" />
                        <span>{{meet.location.city}} <span v-if="meet.location.address">- {{meet.location.address}}</span></span>
                    </div>
                    <div class="flex" v-if="meet.location">
                        <icon name="pool" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{meet.location.pool}} M - {{meet.location.timing}}</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 dark:text-gray-200 w-full mb-5" v-if="meet.raceInfo || meet.preStartlist || meet.raceRecord || meet.timeSchedule">
                    <div class="flex" v-if="meet.raceInfo">
                        <DocumentIcon class="w-5 h-5" />
                        <a class="ml-1 link" target="_blank" :href="meet.raceInfo.url">{{ __('Raceinfo') }}</a>
                    </div>
                    <div class="flex" v-if="meet.preStartlist">
                        <DocumentIcon class="w-5 h-5" />
                        <a class="ml-1 link" target="_blank" :href="meet.preStartlist.url">{{ __('Pre startlist') }}</a>
                    </div>
                    <div class="flex" v-if="meet.raceRecord">
                        <DocumentIcon class="w-5 h-5" />
                        <a class="ml-1 link" target="_blank" :href="meet.raceRecord.url">{{ __('Race record') }}</a>
                    </div>
                    <div class="flex" v-if="meet.timeSchedule">
                        <DocumentIcon class="w-5 h-5" />
                        <a class="ml-1 link" target="_blank" :href="meet.timeSchedule.url">{{ __('Time schedule') }}</a>
                    </div>
                </div>

                <div class="my-5">
                    Nevezési határidő: {{ meet.deadline }} éjfél
                </div>

                <div v-if="meet.is_deadline_ok" class="my-5">
                    <jet-button :href="route('portal:meet.entry.create', meet)" v-show="isAdmin()">
                        Új nevezés
                    </jet-button>
                </div>

            </div>
        </div>
        <ScrollTop />
    </portal-layout>
</template>

<script>
import JetLabel from '@/Jetstream/Label'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import Icon from "@/Shared/Icon"
import ScrollTop from "@/Shared/ScrollTop"
import PortalLayout from "@/Layouts/PortalLayout"
import { DocumentIcon, CogIcon, LocationMarkerIcon, AtSymbolIcon } from '@heroicons/vue/outline'

export default {
    components: {
        PortalLayout,
        JetLabel,
        JetButton,
        JetInput,
        Icon,
        DocumentIcon,
        CogIcon,
        LocationMarkerIcon,
        AtSymbolIcon,
        ScrollTop
    },
    props: ['meet'],
    setup(props) {

        return {

        }
    }
}
</script>

<style scoped>
.data-enter-active,
.data-leave-active {
    @apply ease-out opacity-100 duration-300;
}

.data-enter, .data-leave-to {
    @apply ease-in opacity-0 duration-200;
}
</style>