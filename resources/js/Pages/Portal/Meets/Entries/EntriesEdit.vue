<template>
    <Head title="Nevezés szerkesztése" />
    <portal-layout>

        <template #header>
            <bread-crumb :back-route="route('portal:meets.index')" :back-name="__('Entriable Meets')">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('portal:meets.show', meet.slug)">{{ meet.name }}</Link>
                <span class="font-medium pl-1">/</span> Nevezés szerkesztése
            </bread-crumb>
        </template>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">

            <form @submit.prevent="update">
                <div class="p-8 flex flex-col max-w-3xl">
                    <div class="text-2xl">
                        {{ entry.competitor.name }} - {{ meet_event }}
                    </div>
                    <div class="w-full flex flex-col space-y-4 mt-5">

                        <div class="w-full">
                            <jet-label for="competitor_id" :value="__('Competitor')"/>
                            <jet-input id="competitor_id"
                                       name="competitor_id"
                                       type="text"
                                       aria-readonly="true" disabled="disabled"
                                       :value="entry.competitor.name"
                            />
                        </div>

                        <div class="w-full">
                            <jet-label for="meet_event_id" :value="__('Event')"/>
                            <jet-input id="meet_event_id"
                                       type="text"
                                       name="meet_event_id"
                                       aria-readonly="true" disabled="disabled"
                                       :value="meet_event"
                            />
                        </div>

                        <div class="w-full">
                            <div class="w-full flex space-x-2">
                                <div class="">
                                    <jet-label for="min" class="text-xs" :value="__('Min')" />
                                    <jet-input id="min" type="text" v-model="form.time.min" autocomplete="off" placeholder="00" class="w-12" :disabled="entry.is_final" />
                                </div>
                                <span class="font-bold text-2xl mt-8">:</span>
                                <div class="">
                                    <jet-label for="sec" class="text-xs" :value="__('Second')" />
                                    <jet-input id="sec" type="text" v-model="form.time.sec" autocomplete="off" placeholder="00" class="w-12" :disabled="entry.is_final" />
                                </div>
                                <span class="font-bold text-2xl mt-8">.</span>
                                <div class="">
                                    <jet-label for="milli" class="text-xs" :value="__('Millisecond')" />
                                    <jet-input id="milli" type="text" v-model="form.time.milli" autocomplete="off" placeholder="00" class="w-12" :disabled="entry.is_final" />
                                </div>
                            </div>
                            <jet-input-error :message="form.errors.time" class="mt-2" />
                        </div>

                        <div class="w-full">
                            <jet-label for="user_id" :value="__('Created at')"/>
                            {{ timeFormat(entry.created_at) }}
                        </div>
                    </div>

                </div>
                <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                    <div>
                        <jet-button type="submit" :disabled="entry.is_final" :loading="form.processing">
                            {{ __('Save') }}
                        </jet-button>
                        <jet-button variant="info" type="button" :disabled="entry.is_final" @click="confirmFinalizeShow = true" class="ml-2">
                            {{ __('Finalize') }}
                        </jet-button>
                    </div>
                    <jet-button variant="danger" type="button" :disabled="entry.is_final" @click="confirmDeleteShow = true">
                        {{ __('Delete') }}
                    </jet-button>
                </div>
            </form>
        </div>
        <jet-confirmation-modal :show="confirmFinalizeShow" @close="confirmFinalizeShow = false">
            <template #title>
                Nevezés véglegesítése
            </template>

            <template #content>
                Biztosan véglegesíteni szeretnéd a nevezést ? <br>
                Véglegesítés után nem lehet majd frissíteni.
            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="confirmFinalizeShow = false">
                    {{ __('Cancel') }}
                </jet-button>

                <jet-button variant="info" :disabled="entry.is_final" type="button" @click.native="finalize" :loading="form.processing">
                    {{ __('Finalize') }}
                </jet-button>
            </template>
        </jet-confirmation-modal>
        <jet-confirmation-modal :show="confirmDeleteShow" @close="confirmDeleteShow = false">
            <template #title>
                Nevezés törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a nevezést ?
            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="confirmDeleteShow = false">
                    {{ __('Cancel') }}
                </jet-button>

                <jet-button variant="danger" :disabled="entry.is_final" type="button" @click.native="deleteModel" :loading="form.processing">
                    {{ __('Delete') }}
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
        isDark,
    },
    props: {
        meet: Object,
        entry: Object,
        meet_event: String,
    },

    data() {
        return {
            confirmFinalizeShow: false,
            confirmDeleteShow: false,
            form: this.$inertia.form({
                method: '_POST',
                competitor_id: this.entry.competitor_id,
                meet_event_id: this.entry.meet_event_id,
                time: {
                    min: this.entry.min,
                    sec: this.entry.sec,
                    milli: this.entry.milli,
                },
            })
        }
    },
    methods: {
        update() {
            this.form.put(route('portal:meet.entry.update', { meet: this.meet, entry: this.entry }))
        },
        finalize() {
            this.form.put(route('portal:meet.entry.finalize', { meet: this.meet, entry: this.entry }))
        },
        deleteModel() {
            this.form.delete(route('portal:meet.entry.delete', { meet: this.meet, entry: this.entry }))
        }
    },
}
</script>