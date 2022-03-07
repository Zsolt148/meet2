<template>
    <Head title="Nevezés szerkesztése" />
    <portal-layout>
        <template #header>
            <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.index', meet.id)">{{ meet.name }}</Link>
                <span class="font-medium pl-1">/</span> Nevezés szerkesztése
            </bread-crumb>
        </template>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">

<!--            <div class="w-full">-->
<!--                <jet-label for="user_id" value="Nevezte"/>-->
<!--                {{ competitor.user.name }}-->
<!--            </div>-->

            <div class="px-8 pt-6">
                <div class="text-2xl text-teal-500 dark:text-teal-400">
                    {{ __('Edit entries') }}
                </div>
            </div>

            <form @submit.prevent="submit">
                <div class="px-8 py-6 flex flex-col max-w-3xl">

                    <div class="w-full flex flex-col">

                        <div class="w-full mb-4">
                            <jet-label for="user_id" value="Egyesület"/>
                            {{ competitor.team.name }}
                        </div>

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
                                    <jet-label :for="'meet_event_id'+index" :value="(index + 1) + '. ' + __('Event')"/>
                                    <div class="flex">
                                        <select name="meet_event_id"
                                                :id="'meet_event_id'+index"
                                                v-model="form.entries[index]['meet_event_id']"
                                                :class="form.errors['entries.'+index+'.meet_event_id'] ? 'input-error' : ''"
                                                :disabled="form.is_final || form.entries[index]['is_final']"
                                                @change="eventSelected(index, form.entries[index]['meet_event_id'])"
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
                                            <jet-label :for="'min'+index" class="text-xs" :value="__('Min')"/>
                                            <jet-input :id="'min'+index" type="text" v-model="form.entries[index]['time']['min']"
                                                       autocomplete="off" placeholder="--" class="w-12"
                                                       :disabled="form.is_final || form.entries[index]['is_final']"
                                                       :error="form.errors['entries.'+index+'.time']"
                                                       :maxlength="2"
                                            />
                                        </div>
                                        <span class="font-bold text-2xl mt-8">:</span>
                                        <div class="">
                                            <jet-label :for="'sec'+index" class="text-xs" :value="__('Second')"/>
                                            <jet-input :id="'sec'+index" type="text" v-model="form.entries[index]['time']['sec']"
                                                       autocomplete="off" placeholder="--" class="w-12"
                                                       :disabled="form.is_final || form.entries[index]['is_final']"
                                                       :error="form.errors['entries.'+index+'.time']"
                                                       :maxlength="2"
                                            />
                                        </div>
                                        <span class="font-bold text-2xl mt-8">.</span>
                                        <div class="">
                                            <jet-label :for="'milli'+index" class="text-xs" :value="__('Millisecond')"/>
                                            <jet-input :id="'milli'+index" type="text"
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

                                <div class="w-full mt-4">
                                    <div class="flex justify-between">
                                        <div class="flex justify-start space-x-4 mt-2">

                                            <jet-label :for="'is_final'+index">
                                                <div class="flex items-center text-lg">
                                                    <jet-checkbox name="is_final" :id="'is_final'+index" v-model:checked="form.entries[index]['is_final']" />

                                                    <div class="ml-2">
                                                        Végleges nevezés
                                                    </div>
                                                </div>
                                            </jet-label>

                                            <jet-label :for="'is_paid'+index">
                                                <div class="flex items-center text-lg">
                                                    <jet-checkbox name="is_paid" :id="'is_paid'+index" v-model:checked="form.entries[index]['is_paid']" />

                                                    <div class="ml-2">
                                                        Fizetve
                                                    </div>
                                                </div>
                                            </jet-label>
                                        </div>
                                        <div class="flex mt-2">
                                            <div>
                                                <jet-label for="user_id" :value="__('Created at')"/>
                                                {{ timeFormat(form.entries[index]['created_at']) }}
                                            </div>
                                            <div class="ml-5">
                                                <jet-label for="user_id" :value="__('Updated at')"/>
                                                {{ timeFormat(form.entries[index]['updated_at']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                    <div class="flex">
                        <jet-button type="submit" :loading="form.processing" class="mr-2">
                            {{__('Save')}}
                        </jet-button>
                        <jet-button variant="info" type="button" @click="confirmFinalizeShow = true">
                            {{__('Finalize')}}
                        </jet-button>
                    </div>
                    <jet-button variant="danger" type="button" @click="confirmDeleteShow = true">
                        Törlés
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

                <jet-button variant="info" type="button" @click.native="finalize"
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

                <jet-button variant="danger" type="button" @click.native="deleteAll"
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

                <jet-button variant="danger" type="button" @click.native="removeEntry(removeEntryIndex)"
                            :loading="form.processing">
                    {{__('Delete')}}
                </jet-button>
            </template>
        </jet-confirmation-modal>
    </portal-layout>
</template>

<script>
import { ref, reactive, watch, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from "@inertiajs/inertia";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import BreadCrumb from "@/Shared/BreadCrumb";
import JetCheckbox from "@/Jetstream/Checkbox";
import { isDark } from '@/Composables'
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import {PlusIcon, TrashIcon} from "@heroicons/vue/outline";

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
        submit() {
            this.form.put(route('admin:entries.update', { meet: this.meet, competitor: this.competitor }))
        },
        finalize() {
            this.form.put(route('admin:entries.finalize', {meet: this.meet, competitor: this.competitor}))
        },
        deleteModel() {
            this.form.delete(route('admin:entries.delete', { meet: this.meet, competitor: this.competitor }))
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
        deleteEntry(entryId) {
            axios.delete(route('admin:entries.delete', {
                meet: this.meet, entryId: entryId
            })).then(() => {
                this.confirmRemoveEntryShow = false
            }).catch(error => {
                console.error(error)
            });
        },
        deleteAll() {
            this.form.delete(route('admin:entries.delete-all', {meet: this.meet, competitor: this.competitor}))
        },
    }
}
</script>