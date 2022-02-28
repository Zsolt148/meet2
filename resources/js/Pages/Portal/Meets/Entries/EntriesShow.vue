<template>
    <Head title="Nevezés szerkesztése"/>
    <portal-layout>

        <template #header>
            <bread-crumb :back-route="route('portal:meets.index')" :back-name="__('Entriable Meets')">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500"
                      :href="route('portal:meets.show', meet.slug)">{{meet.name}}
                </Link>
                <span class="font-medium pl-1">/</span> Nevezés
            </bread-crumb>
        </template>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">

            <div class="p-8 flex flex-col max-w-3xl">
                <div class="w-full flex flex-col">
                    <div class="w-full">
                        <jet-label for="competitor_id" :value="__('Competitor')"/>
                        <jet-input id="competitor_id"
                                   name="competitor_id"
                                   type="text"
                                   aria-readonly="true" disabled="disabled"
                                   :disabled="true"
                                   :value="competitor.name"
                        />
                    </div>

                    <div v-for="(entry, index) in competitor_form.entries" :key="index" class="my-5">
                        <div class="w-full">
                            <jet-label :for="'meet_event_id' + index" :value="(index + 1) + '. ' + __('Event')"/>
                            <div class="flex">
                                <select name="meet_event_id"
                                        id="meet_event_id"
                                        v-model="competitor_form.entries[index]['meet_event_id']"
                                        :disabled="true"
                                >
                                    <option value="" selected>{{__('Empty')}}</option>
                                    <option v-for="meet_event in meet_events_by_gender" :key="meet_event.id"
                                            :value="meet_event.id">
                                        {{meetEvent(meet_event)}}
                                    </option>
                                </select>
                                <div class="ml-2 mt-2">
                                    <jet-button size="sm" type="button" variant="danger" class="outline"
                                                :disabled="true"
                                    >
                                        <TrashIcon class="w-5 h-5"/>
                                    </jet-button>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-4">
                            <div class="w-full flex space-x-2">
                                <div class="">
                                    <jet-label :for="'min'+index" class="text-xs" :value="__('Min')"/>
                                    <jet-input :id="'min'+index" type="text" v-model="competitor_form.entries[index]['time']['min']"
                                               autocomplete="off" placeholder="00" class="w-12"
                                               :disabled="true"
                                    />
                                </div>
                                <span class="font-bold text-2xl mt-8">:</span>
                                <div class="">
                                    <jet-label :for="'sec'+index" class="text-xs" :value="__('Second')"/>
                                    <jet-input :id="'sec'+index" type="text" v-model="competitor_form.entries[index]['time']['sec']"
                                               autocomplete="off" placeholder="00" class="w-12"
                                               :disabled="true"
                                    />
                                </div>
                                <span class="font-bold text-2xl mt-8">.</span>
                                <div class="">
                                    <jet-label :for="'milli'+index" class="text-xs" :value="__('Millisecond')"/>
                                    <jet-input :id="'milli'+index" type="text"
                                               v-model="competitor_form.entries[index]['time']['milli']" autocomplete="off"
                                               placeholder="00" class="w-12"
                                               :disabled="true"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </portal-layout>
</template>

<script>
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import BreadCrumb from "@/Shared/BreadCrumb";
import JetCheckbox from "@/Jetstream/Checkbox";
import {isDark} from '@/Composables'
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import {PlusIcon, TrashIcon} from '@heroicons/vue/outline'

export default {
    components: {
        PortalLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetConfirmationModal,
        BreadCrumb,
        JetCheckbox,
        TrashIcon,
        PlusIcon,
        isDark,
    },
    props: ['meet', 'competitor_form', 'meet_events_by_gender', 'competitor'],

    data() {
        return {
            //
        }
    },
}
</script>