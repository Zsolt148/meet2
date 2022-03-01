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
                    / {{ __('New Entries') }}
                </bread-crumb>
            </div>

            <div v-show="!$page.props.user.team" class="flex flex-row items-center bg-yellow-100 dark:bg-yellow-200 rounded-lg p-3 text-sm text-yellow-700 mb-5" role="alert">
                <div class="mr-2">
                    <ExclamationIcon class="w-5 h-5" />
                </div>
                <div>
                    {{ __("Looks like you don't have a team yet and you can't select a competitor. You can select a team in your profile setting.") }}
                    <Link class="link" :href="route('profile.show')">{{ __('Profile settings') }}</Link>
                </div>
            </div>

        </template>

        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-600 shadow rounded-md">

                <div class="px-8 pt-6">
                    <div class="text-2xl text-teal-500 dark:text-teal-400">
                        {{ __('New Entries') }}
                    </div>

                    <div class="pt-4 text-gray-700 dark:text-gray-200">
                        {{ __('Select a competitor from the list and select the event you want to enter and add the entry time') }}
                    </div>
                </div>

                <form @submit.prevent="submit">
                    <div class="px-8 py-6 flex flex-col max-w-3xl">
                        <div class="w-full flex flex-col">
                            <div class="w-full">
                                <jet-label for="competitor_id" :value="__('Competitor')"/>
                                <select name="competitor_id" id="competitor_id" v-model="form.competitor_id" :class="form.errors.competitor_id ? 'input-error' : ''">
                                    <option value="" selected>{{ __('Empty') }}</option>
                                    <option v-for="comp in competitors" :key="comp.id" :value="comp.id">
                                        {{ comp.name }} ({{ comp.birth }})
                                    </option>
                                </select>
                                <jet-input-error :message="form.errors.competitor_id" class="mt-2" />
                            </div>

                            <div v-if="selected_competitor">
                                <div v-for="(entry, index) in form.entries" :key="index" class="my-5">
                                    <div class="w-full">
                                        <jet-label for="meet_event_id" :value="(index + 1) + '. ' + __('Event')"/>
                                        <div class="flex">
                                            <select name="meet_event_id"
                                                    id="meet_event_id"
                                                    v-model="form.entries[index]['meet_event_id']"
                                                    :class="form.errors['entries.'+index+'.meet_event_id'] ? 'input-error' : ''"
                                            >
                                                <option value="" selected>{{ __('Empty') }}</option>
                                                <option v-for="meet_event in meet_events_by_gender" :key="meet_event.id" :value="meet_event.id">
                                                    {{ meetEvent(meet_event) }}
                                                </option>
                                            </select>
                                            <div class="ml-2 mt-2">
                                                <jet-button size="sm" type="button" variant="danger" class="outline" @click="removeEntry(index)">
                                                    <TrashIcon class="w-5 h-5" />
                                                </jet-button>
                                            </div>
                                        </div>
                                        <jet-input-error :message="form.errors['entries.'+index+'.meet_event_id'] ? form.errors['entries.'+index+'.meet_event_id'] : ''" class="mt-2" />
                                    </div>

                                    <div class="w-full mt-4">
                                        <div class="w-full flex space-x-2">
                                            <div class="">
                                                <jet-label for="min" class="text-xs" :value="__('Min')" />
                                                <jet-input id="min" type="text" v-model="form.entries[index]['time']['min']" autocomplete="off" placeholder="00" class="w-12" :error="form.errors['entries.'+index+'.time']" />
                                            </div>
                                            <span class="font-bold text-2xl mt-8">:</span>
                                            <div class="">
                                                <jet-label for="sec" class="text-xs" :value="__('Second')" />
                                                <jet-input id="sec" type="text" v-model="form.entries[index]['time']['sec']" autocomplete="off" placeholder="00" class="w-12" :error="form.errors['entries.'+index+'.time']" />
                                            </div>
                                            <span class="font-bold text-2xl mt-8">.</span>
                                            <div class="">
                                                <jet-label for="milli" class="text-xs" :value="__('Millisecond')" />
                                                <jet-input id="milli" type="text" v-model="form.entries[index]['time']['milli']" autocomplete="off" placeholder="00" class="w-12" :error="form.errors['entries.'+index+'.time']" />
                                            </div>
                                        </div>
                                        <jet-input-error :message="form.errors['entries.'+index+'.time'] ? form.errors['entries.'+index+'.time'] : ''" class="mt-2" />
                                    </div>
                                </div>

                                <div class="w-full mt-5">
                                    <jet-button type="button" variant="secondary" @click="addNewEntry">
                                        <PlusIcon class="w-5 h-5 mr-2" />
                                        {{ __('Add event') }}
                                    </jet-button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between mt-5">
                        <jet-button :loading="form.processing" :disabled="form.entries.length == 0 || form.competitor_id == null">
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
import { DocumentIcon, CogIcon, LocationMarkerIcon, AtSymbolIcon, ExclamationIcon, PlusIcon, TrashIcon } from '@heroicons/vue/outline'
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
        TrashIcon,
        PlusIcon,
        ScrollTop
    },
    props: ['meet', 'male_meet_events', 'female_meet_events', 'competitors'],
    data() {
        return {
            selected_competitor: null,
            form: this.$inertia.form({
                method: '_POST',
                competitor_id: null,
                entries: [],
            })
        }
    },
    methods: {
        addNewEntry() {
            this.form.entries.push({
                meet_event_id: null,
                time: {
                    min: null,
                    sec: null,
                    milli: null,
                },
            })
            console.log(this.form.entries)
        },
        removeEntry(index) {
            this.form.entries.splice(index, 1)
        },
        submit() {
            this.form.post(route('portal:meet.entry.store', this.meet))
        }
    },
    watch: {
        'form.competitor_id'(value) {
            this.selected_competitor = this.competitors.find(x => x.id === value)
            // if a competitor is selected
            // null form entries and add one
            if (this.selected_competitor) {
                this.form.entries = []
                this.addNewEntry()
            }
        },
    },
    computed: {
        meet_events_by_gender() {
            if (this.selected_competitor) {
                return this.selected_competitor.sex == 'F'
                    ? this.male_meet_events
                    : this.female_meet_events
            }
        }
    }
}
</script>