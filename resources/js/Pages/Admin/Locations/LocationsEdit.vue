<template>
    <Head title="Helyszín szerkesztése" />
    <portal-layout>
        <div>
            <bread-crumb :back-route="route('admin:locations.index')" back-name="Helyszínek" :current="form.city + ' ' + form.address" />
            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">
                <form @submit.prevent="update">
                    <div class="p-4 md:p-8">
                        <div class="space-x-0 space-y-4 md:space-x-4 md:space-y-0 flex flex-col md:flex-row">
                            <div class="w-full md:w-1/2">
                                <jet-label for="city" value="Város" />
                                <jet-input id="city" type="text" v-model="form.city" autocomplete="off" :error="form.errors.city" />
                                <jet-input-error :message="form.errors.city" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="address" value="Cím" />
                                <jet-input id="address" type="text" v-model="form.address" autocomplete="off" :error="form.errors.address" />
                                <jet-input-error :message="form.errors.address" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="pool" value="Medence" />
                                <jet-input id="pool" type="number" v-model="form.pool" autocomplete="off" :error="form.errors.pool" />
                                <jet-input-error :message="form.errors.pool" class="mt-2" />
                            </div>

                            <div class="w-full md:w-1/2">
                                <jet-label for="timing" value="Időmérés" />
                                <jet-input id="timing" type="text" v-model="form.timing" autocomplete="off" :error="form.errors.timing" />
                                <jet-input-error :message="form.errors.timing" class="mt-2" />
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
                Felhasználó törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a felhasználót ?
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
        location: Object,
    },
    setup(props) {
        const { location } = props;
        const confirmModalShow = ref(false);


        const form = useForm({
            _method: 'PUT',
            city: location.city,
            address: location.address,
            pool: location.pool,
            timing: location.timing,
        })

        function update() {
            form.put(route('admin:locations.update', location.id))
        }

        function deleteModel() {
            form.delete(route('admin:locations.destroy', location.id))
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
