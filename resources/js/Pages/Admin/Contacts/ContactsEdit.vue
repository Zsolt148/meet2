<template>
    <portal-layout>
        <div>
            <bread-crumb :back-route="route('admin:contacts.index')" back-name="Kapcsolattartók" :current="form.name" />
            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">
                <form @submit.prevent="update">
                    <div class="p-4 md:p-8">
                        <div class="space-x-0 space-y-4 md:space-x-4 md:space-y-0 flex flex-col md:flex-row">
                            <div class="w-full md:w-1/2">
                                <jet-label for="name" value="Név" />
                                <jet-input id="name" type="text" v-model="form.name" autocomplete="off" :error="form.errors.name" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="phone" value="Telefon" />
                                <jet-input id="phone" type="text" v-model="form.phone" autocomplete="off" :error="form.errors.phone" />
                                <jet-input-error :message="form.errors.phone" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="email" value="Email" />
                                <jet-input id="email" type="text" v-model="form.email" autocomplete="off" :error="form.errors.email" />
                                <jet-input-error :message="form.errors.email" class="mt-2" />
                            </div>

                        </div>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                        <jet-button :loading="form.processing">
                            Mentés
                        </jet-button>
                        <jet-button variant="danger" type="button" @click="confirmModalShow = true">
                            Törlés
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>
        <jet-confirmation-modal :show="confirmModalShow" @close="confirmModalShow = false">
            <template #title>
                Kapcsolattartó törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a kapcsolattartót ?
            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="confirmModalShow = false">
                    Mégse
                </jet-button>

                <jet-button variant="danger" type="button" @click.native="deleteModel" :loading="form.processing">
                    Törlés
                </jet-button>
            </template>
        </jet-confirmation-modal>
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
        JetConfirmationModal,
        BreadCrumb
    },
    props: {
        contact: Object,
    },
    setup(props) {
        const { contact } = props;
        const confirmModalShow = ref(false);


        const form = useForm({
            _method: 'PUT',
            name: contact.name,
            phone: contact.phone,
            email: contact.email,
        })

        function update() {
            form.put(route('admin:contacts.update', contact.id))
        }

        function deleteModel() {
            form.delete(route('admin:contacts.destroy', contact.id))
        }

        return {
            confirmModalShow,
            form,
            update,
            deleteModel,
        }
    },
}
</script>
