<template>
    <Head title="Kapcsolattartó létrehozása" />
    <portal-layout>
        <div>
            <bread-crumb :back-route="route('admin:contacts.index')" back-name="Kapcsolattartók" current="Új kapcsolattartó" />
            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">
                <form @submit.prevent="create">
                    <div class="p-4 md:p-8">
                        <div class="space-x-0 space-y-4 md:space-x-4 md:space-y-0 flex flex-col md:flex-row">
                            <div class="w-full md:w-1/2">
                                <jet-label for="name" value="Város" />
                                <jet-input id="name" type="text" v-model="form.name" autocomplete="off" :error="form.errors.name" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="phone" value="Cím" />
                                <jet-input id="phone" type="text" v-model="form.phone" autocomplete="off" :error="form.errors.phone" />
                                <jet-input-error :message="form.errors.phone" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="email" value="Medence" />
                                <jet-input id="email" type="number" v-model="form.email" autocomplete="off" :error="form.errors.email" />
                                <jet-input-error :message="form.errors.email" class="mt-2" />
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
            name: null,
            phone: null,
            email: null,
        })

        function create() {
            form.post(route('admin:contacts.store'))
        }

        return {
            form,
            create,
        }
    },
}
</script>
