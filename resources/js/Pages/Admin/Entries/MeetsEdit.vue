<template>
    <Head title="Nevezhető verseny szerkesztése" />
    <portal-layout>
        <div>
            <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek">
                <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.meet.show', meet.id)">{{ form.name }}</Link>
                <span class="font-medium pl-1">/</span> Szerkesztés
            </bread-crumb>
            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">

                <form @submit.prevent="update">
                    <div class="p-8 flex flex-col">
                        <div class="flex flex-col md:flex-row justify-between mb-5">
                            <jet-label for="is_entriable">
                                <div class="flex items-center text-xl">
                                    <jet-checkbox name="is_entriable" id="is_entriable" v-model:checked="form.is_entriable" />

                                    <div class="ml-2">
                                        Nevezhető
                                    </div>
                                </div>
                            </jet-label>
                        </div>

                        <div class="w-full flex flex-row space-x-4">
                            <div class="w-full sm:w-1/3">
                                <jet-label for="entry_price" value="Nevezés ára - Ft" />
                                <jet-input id="entry_price" type="number" v-model="form.entry_price" autocomplete="off" />
                                <jet-input-error :message="form.errors.entry_price" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/3">
                                <jet-label for="entry_type" value="Nevezés típusa"/>
                                <select name="entry_type" id="entry_type" v-model="form.entry_type">
                                    <option value="">Üres</option>
                                    <option v-for="type in entryTypes" :key="type" :value="type">{{type}}</option>
                                </select>
                                <jet-input-error :message="form.errors.entry_type" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/3">
                                <jet-label for="entry_app" value="Nevezések exportálása"/>
                                <select name="entry_app" id="entry_app" v-model="form.entry_app">
                                    <option value="">Üres</option>
                                    <option v-for="type in entryApps" :key="type" :value="type">{{type}}</option>
                                </select>
                                <jet-input-error :message="form.errors.entry_app" class="mt-2" />
                            </div>
                        </div>

                    </div>
                    <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                        <jet-button :loading="form.processing">
                            Mentés
                        </jet-button>
                    </div>
                </form>
            </div>
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
        entryTypes: Array,
        entryApps: Array,
    },

    setup({ meet }) {

        const form = useForm({
            _method: 'PUT',
            name: meet.name,
            is_entriable: meet.is_entriable,
            entry_price: meet.entry_price,
            entry_type: meet.entry_type ?? null,
            entry_app: meet.entry_app ?? null,
        })

        function update() {
            form.put(route('admin:entries.meet.update', meet.id))
        }

        return {
            form,
            update,
        }
    },
}
</script>