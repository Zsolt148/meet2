<template>
    <portal-layout>
        <div>
            <bread-crumb :back-route="route('admin:locations.index')" back-name="Helyszínek" current="Új helyszín" />
            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">
                <form @submit.prevent="create">
                    <div class="p-4 md:p-8">
                        <div class="space-x-0 space-y-4 md:space-x-4 md:space-y-0 flex flex-col md:flex-row">
                            <div class="w-full md:w-1/2">
                                <jet-label for="city" value="Város" />
                                <jet-input id="city" type="text" v-model="form.city" autocomplete="off" />
                                <jet-input-error :message="form.errors.city" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="address" value="Cím" />
                                <jet-input id="address" type="text" v-model="form.address" autocomplete="off" />
                                <jet-input-error :message="form.errors.address" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="pool" value="Medence" />
                                <jet-input id="pool" type="text" v-model="form.pool" autocomplete="off" />
                                <jet-input-error :message="form.errors.pool" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="timing" value="Időmérés" />
                                <jet-input id="timing" type="text" v-model="form.timing" autocomplete="off" />
                                <jet-input-error :message="form.errors.timing" class="mt-2" />
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
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from "@inertiajs/inertia";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import BreadCrumb from "@/Shared/BreadCrumb";

export default {
    components: {
        PortalLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        BreadCrumb
    },
    props: {
        location: Object,
    },
    setup() {
        const form = useForm({
            _method: 'POST',
            city: null,
            address: null,
            pool: null,
            timing: null,
        })

        function create() {
            form.post(route('admin:locations.store'))
        }

        return {
            form,
            create,
        }
    },
}
</script>
