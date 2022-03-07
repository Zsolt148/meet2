<template>
    <Head title="Nevezés szerkesztése"/>
    <portal-layout>

        <template #header>
            <bread-crumb :back-route="route('portal:meets.index')" :back-name="__('Entriable Meets')">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500"
                      :href="route('portal:meets.show', meet.slug)">{{meet.name}}
                </Link>
                <span class="font-medium pl-1">/</span> {{ __('Edit entries') }}
            </bread-crumb>
        </template>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">

            <div class="px-8 pt-6">
                <div class="text-2xl text-teal-500 dark:text-teal-400">
                    {{ __('Edit entries') }}
                </div>
            </div>

            <form @submit.prevent="submit">
                <div class="px-8 py-6 flex flex-col max-w-3xl">
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

                        <div v-if="competitor">
                            <div v-for="(entry, index) in form.entries" :key="index" class="my-5">
                                <div class="w-full">
                                    <jet-label for="meet_event_id" :value="(index + 1) + '. ' + __('Event')"/>
                                    <div class="flex">
                                        <select name="meet_event_id"
                                                id="meet_event_id"
                                                v-model="form.entries[index]['meet_event_id']"
                                                :class="form.errors['entries.'+index+'.meet_event_id'] ? 'input-error' : ''"
                                                @change="eventSelected(index, form.entries[index]['meet_event_id'])"
                                                :disabled="form.is_final || form.entries[index]['is_final']"
                                        >
                                            <option value="" selected>{{__('Empty')}}</option>
                                            <option v-for="meet_event in meet_events_by_gender" :key="meet_event.id"
                                                    :value="meet_event.id">
                                                {{meetEvent(meet_event)}}
                                            </option>
                                        </select>
                                        <div class="ml-2 mt-2">
                                            <jet-button size="sm" type="button" variant="danger" class="outline"
                                                        @click="confirmRemoveEntry(index)"
                                                        :disabled="form.is_final || form.entries[index]['is_final']"
                                            >
                                                <TrashIcon class="w-5 h-5"/>
                                            </jet-button>
                                        </div>
                                    </div>
                                    <jet-input-error
                                        :message="form.errors['entries.'+index+'.meet_event_id'] ? form.errors['entries.'+index+'.meet_event_id'] : ''"
                                        class="mt-2"/>
                                </div>

                                <div class="w-full mt-4" v-show="!isRelay(form.entries[index]['meet_event_id'])">
                                    <div class="w-full flex space-x-2">
                                        <div class="">
                                            <jet-label for="min" class="text-xs" :value="__('Min')"/>
                                            <jet-input id="min" type="text" v-model="form.entries[index]['time']['min']"
                                                       autocomplete="off" placeholder="--" class="w-12"
                                                       :disabled="form.is_final || form.entries[index]['is_final']"
                                                       :error="form.errors['entries.'+index+'.time']"
                                                       :maxlength="2"
                                            />
                                        </div>
                                        <span class="font-bold text-2xl mt-8">:</span>
                                        <div class="">
                                            <jet-label for="sec" class="text-xs" :value="__('Second')"/>
                                            <jet-input id="sec" type="text" v-model="form.entries[index]['time']['sec']"
                                                       autocomplete="off" placeholder="--" class="w-12"
                                                       :disabled="form.is_final || form.entries[index]['is_final']"
                                                       :error="form.errors['entries.'+index+'.time']"
                                                       :maxlength="2"
                                            />
                                        </div>
                                        <span class="font-bold text-2xl mt-8">.</span>
                                        <div class="">
                                            <jet-label for="milli" class="text-xs" :value="__('Millisecond')"/>
                                            <jet-input id="milli" type="text"
                                                       v-model="form.entries[index]['time']['milli']" autocomplete="off"
                                                       placeholder="--" class="w-12"
                                                       :disabled="form.is_final || form.entries[index]['is_final']"
                                                       :error="form.errors['entries.'+index+'.time']"
                                                       :maxlength="2"
                                            />
                                        </div>
                                    </div>
                                    <jet-input-error
                                        :message="form.errors['entries.'+index+'.time'] ? form.errors['entries.'+index+'.time'] : ''"
                                        class="mt-2"/>
                                </div>
                            </div>

                            <div class="w-full mt-5" v-show="!form.is_final">
                                <jet-button type="button" @click="addNewEntry" variant="secondary" :disabled="form.is_final">
                                    <PlusIcon class="w-5 h-5 mr-2"/>
                                    {{__('Add event')}}
                                </jet-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                    <div class="flex">
                        <jet-button type="button" variant="secondary" :href="route('portal:meets.show', meet.slug)">
                            {{ __('Back') }}
                        </jet-button>
                        <jet-button type="submit" :disabled="form.is_final" :loading="form.processing" class="mx-2">
                            {{__('Save')}}
                        </jet-button>
                        <jet-button variant="info" type="button" :disabled="form.is_final"
                                    @click="confirmFinalizeShow = true">
                            {{__('Finalize')}}
                        </jet-button>
                    </div>
                    <jet-button variant="danger" type="button" :disabled="form.is_final"
                                @click="confirmDeleteShow = true">
                        {{__('Delete')}}
                    </jet-button>
                </div>
            </form>
        </div>
        <jet-confirmation-modal :show="confirmFinalizeShow" @close="confirmFinalizeShow = false">
            <template #title>
                Nevezések véglegesítése
            </template>

            <template #content>
                Biztosan véglegesíteni szeretnéd az összes nevezést ? <br>
                Véglegesítés után nem lehet majd módosítani a nevezéseket.
            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="confirmFinalizeShow = false">
                    {{__('Cancel')}}
                </jet-button>

                <jet-button variant="info" :disabled="form.is_final" type="button" @click.native="finalize"
                            :loading="form.processing">
                    {{__('Finalize')}}
                </jet-button>
            </template>
        </jet-confirmation-modal>
        <jet-confirmation-modal :show="confirmDeleteShow" @close="confirmDeleteShow = false">
            <template #title>
                Nevezések törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a versenyző összes nevezését ?
            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="confirmDeleteShow = false">
                    {{__('Cancel')}}
                </jet-button>

                <jet-button variant="danger" :disabled="form.is_final" type="button" @click.native="deleteAll"
                            :loading="form.processing">
                    {{__('Delete')}}
                </jet-button>
            </template>
        </jet-confirmation-modal>
        <jet-confirmation-modal :show="confirmRemoveEntryShow" @close="confirmRemoveEntryShow = false">
            <template #title>
                Nevezés törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a nevezést ?
            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="confirmRemoveEntryShow = false">
                    {{__('Cancel')}}
                </jet-button>

                <jet-button variant="danger" :disabled="form.is_final" type="button" @click.native="removeEntry(removeEntryIndex)"
                            :loading="form.processing">
                    {{__('Delete')}}
                </jet-button>
            </template>
        </jet-confirmation-modal>
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
            confirmFinalizeShow: false,
            confirmDeleteShow: false,
            confirmRemoveEntryShow: false,
            removeEntryIndex: null,

            form: this.$inertia.form({
                method: '_POST',
                competitor_id: this.competitor_form.competitor_id,
                is_final: this.competitor_form.is_final,
                entries: this.competitor_form.entries,
            })
        }
    },
    methods: {
        isRelay(meet_event_id) {
            if (!meet_event_id) return false
            return this.meet_events_by_gender.find(x => x.id == meet_event_id).event.is_relay
        },
        eventSelected(index, meet_event_id) {
            // if its a relay set 00 to the time
            if (index && this.isRelay(meet_event_id)) {
                this.form.entries[index]['time']['min'] = '00'
                this.form.entries[index]['time']['sec'] = '00'
                this.form.entries[index]['time']['milli'] = '00'
            }else {
                this.form.entries[index]['time']['min'] = null
                this.form.entries[index]['time']['sec'] =  null
                this.form.entries[index]['time']['milli'] = null
            }
        },
        addNewEntry() {
            this.form.entries.push({
                meet_event_id: null,
                time: {
                    min: null,
                    sec: null,
                    milli: null,
                },
            })
        },
        confirmRemoveEntry(index) {
            this.removeEntryIndex = index
            this.confirmRemoveEntryShow = true
        },
        removeEntry(index) {
            let deletedEntry = this.form.entries.splice(index, 1)[0]
            // if id is set, so it is in db
            if (deletedEntry.id) {
                this.deleteEntry(deletedEntry.id)
            }else {
                this.confirmRemoveEntryShow = false
            }
        },
        submit() {
            this.form.put(route('portal:meet.entry.update', {meet: this.meet, competitor: this.competitor}))
        },
        finalize() {
            this.form.put(route('portal:meet.entry.finalize', {meet: this.meet, competitor: this.competitor}))
        },
        deleteEntry(entryId) {
            axios.delete(route('portal:meet.entry.delete', {
                meet: this.meet, entryId: entryId
            })).then(() => {
                this.confirmRemoveEntryShow = false
            }).catch(error => {
                console.error(error)
            });
        },
        deleteAll() {
            this.form.delete(route('portal:meet.entry.delete-all', {meet: this.meet, competitor: this.competitor}))
        },
    },
}
</script>