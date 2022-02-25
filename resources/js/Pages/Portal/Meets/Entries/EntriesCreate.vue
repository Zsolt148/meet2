<template>
    <portal-layout>
        <Head>
            <title>{{ meet.name }}</title>
            <meta head-key="description" name="description" :content="meet.name" />
        </Head>

        <template #header>

            <div class="flex justify-between">
                <bread-crumb :back-route="route('portal:meets.index')" :back-name="__('Entriable Meets')">
                    <Link class="text-teal-500 dark:text-teal-400" :href="route('portal:meets.show', meet)">
                        {{ meet.name }}
                    </Link>
                    / {{ __('New Entry') }}
                </bread-crumb>
            </div>

            <div v-show="!$page.props.user.team" class="flex flex-row items-center bg-yellow-100 dark:bg-yellow-200 rounded-lg p-3 text-sm text-yellow-700 mb-5" role="alert">
                <div class="mr-2">
                    <ExclamationIcon class="w-5 h-5" />
                </div>
                <div>
                    {{ __('Úgy tűnik nincs még egyesületed és azért nem tudsz versenyzők kiválasztani. Egyesületet a profil beállításodban tudsz választani.') }}
                    <Link class="link" :href="route('profile.show')">{{ __('Profile settings') }}</Link>
                </div>
            </div>

        </template>

        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-600 shadow rounded-md">
                <div class="p-5 flex flex-col sm:flex-row justify-between">
                    <h1 class="text-teal-500 dark:text-teal-400 text-3xl">
                        {{ __('Create an entry') }}
                    </h1>
                    <div class="flex items-center mt-3 sm:mt-0 font-semibold text-teal-500 dark:text-teal-400">
                        <icon name="calendar" class="w-4 h-4 mr-2" />
                        <span>{{ meet.date }}</span>
                    </div>
                </div>

                <form @submit.prevent="submit">
                    <div class="p-5 flex flex-col max-w-3xl">
                        <div class="w-full flex flex-col space-y-4">
                            <div class="w-full">
                                <jet-label for="competitor_id" :value="__('Competitor')"/>
                                <select name="competitor_id" id="competitor_id" v-model="form.competitor_id">
                                    <option value="" selected>{{ __('Empty') }}</option>
                                    <option v-for="comp in competitors" :key="comp.id" :value="comp.id">
                                        {{ comp.name }} ({{ comp.birth }})
                                    </option>
                                </select>
                                <jet-input-error :message="form.errors.competitor_id" class="mt-2" />
                            </div>

                            <div class="w-full">
                                <jet-label for="meet_event_id" :value="__('Event')"/>
                                <select name="meet_event_id" id="meet_event_id" v-model="form.meet_event_id">
                                    <option value="" selected>{{ __('Empty') }}</option>
                                    <option v-for="meet_event in meet_events" :key="meet_event.id" :value="meet_event.id">
                                        {{ meet_event.event.length }}m {{ __(meet_event.event.sex) }} {{ __(meet_event.event.swim)}} {{ meet_event.category }}
                                    </option>
                                </select>
                                <jet-input-error :message="form.errors.meet_event_id" class="mt-2" />
                            </div>

                            <div class="w-full">
                                <jet-label for="time" :value="__('Time')" />
                                <jet-input id="time" type="text" v-model="form.time" autocomplete="off" placeholder="00:00.00" />
                                <jet-input-error :message="form.errors.time" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                        <jet-button :loading="form.processing">
                            {{ __('Save') }}
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>

        <ScrollTop />
    </portal-layout>
</template>

<script>
import JetLabel from '@/Jetstream/Label'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import Icon from "@/Shared/Icon"
import ScrollTop from "@/Shared/ScrollTop"
import PortalLayout from "@/Layouts/PortalLayout"
import { DocumentIcon, CogIcon, LocationMarkerIcon, AtSymbolIcon, ExclamationIcon } from '@heroicons/vue/outline'
import BreadCrumb from "@/Shared/BreadCrumb";

export default {
    components: {
        PortalLayout,
        BreadCrumb,
        JetLabel,
        JetButton,
        JetInput,
        JetInputError,
        Icon,
        DocumentIcon,
        CogIcon,
        LocationMarkerIcon,
        AtSymbolIcon,
        ExclamationIcon,
        ScrollTop
    },
    props: ['meet', 'meet_events', 'competitors'],
    data() {
        return {
            form: this.$inertia.form({
                method: '_POST',
                competitor_id: null,
                meet_event_id: null,
                time: null,
            })
        }
    },
    methods: {
        submit() {
            this.form.post(route('portal:meet.entry.store', this.meet))
        }
    }
}
</script>