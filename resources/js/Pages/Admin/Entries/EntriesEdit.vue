<template>
    <Head title="Nevezés szerkesztése" />
    <portal-layout>
        <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek">
            <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.index', meet.id)">{{ meet.name }}</Link>
            <span class="font-medium pl-1">/</span> Nevezés szerkesztése
        </bread-crumb>
        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">

            <form @submit.prevent="submit">
                <div class="p-8 flex flex-col max-w-3xl">
                    <div class="w-full flex flex-col space-y-4 mt-5">

                        <div class="flex justify-start space-x-4">
                            <jet-label for="is_final">
                                <div class="flex items-center text-xl">
                                    <jet-checkbox name="is_final" id="is_final" v-model:checked="form.is_final" />

                                    <div class="ml-2">
                                        Végleges nevezés
                                    </div>
                                </div>
                            </jet-label>

                            <jet-label for="is_paid">
                                <div class="flex items-center text-xl">
                                    <jet-checkbox name="is_paid" id="is_paid" v-model:checked="form.is_paid" />

                                    <div class="ml-2">
                                        Fizetve
                                    </div>
                                </div>
                            </jet-label>
                        </div>

                        <div class="w-full">
                            <jet-label for="user_id" value="Nevezte"/>
                            {{ entry.user.name }} - {{ entry.user.team.name }}
                        </div>

                        <div class="w-full">
                            <jet-label for="competitor_id" value="Versenyző"/>
                            <jet-input id="competitor_id"
                                       name="competitor_id"
                                       type="text"
                                       aria-readonly="true" disabled="disabled"
                                       :value="entry.competitor.name"
                            />
                        </div>

                        <div class="w-full">
                            <jet-label for="meet_event_id" value="Versenyszám"/>
                            <jet-input id="meet_event_id"
                                       type="text"
                                       name="meet_event_id"
                                       aria-readonly="true" disabled="disabled"
                                       :value="entry.meet_event.event.length +'m ' + __(entry.meet_event.event.sex) + __(entry.meet_event.event.swim) + entry.meet_event.category"
                            />
                        </div>

                        <div class="w-full">
                            <jet-label for="time" value="Nevezési idő" />
                            <jet-input id="time" type="text" v-model="form.time" autocomplete="off" placeholder="00:00.00" />
                            <jet-input-error :message="form.errors.time" class="mt-2" />
                        </div>

                        <div class="w-full">
                            <jet-label for="user_id" value="Létrehozta"/>
                            {{ entry.created_at }}
                        </div>
                    </div>

                </div>
                <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                    <jet-button type="submit" :loading="form.processing">
                        Mentés
                    </jet-button>
                </div>
            </form>
        </div>
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

export default {
    components: {
        PortalLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        BreadCrumb,
        JetCheckbox,
        isDark,
    },
    props: {
        meet: Object,
        entry: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                method: '_POST',
                competitor_id: this.entry.competitor_id,
                meet_event_id: this.entry.meet_event_id,
                time: this.entry.time,
                is_final: this.entry.is_final,
                is_paid: this.entry.is_paid,
            })
        }
    },
    methods: {
        submit() {
            this.form.post(route('admin:entries.update', { meet: this.meet, entry: this.entry }))
        }
    }
}
</script>