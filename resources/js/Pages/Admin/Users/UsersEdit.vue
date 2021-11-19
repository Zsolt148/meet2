<template>
    <portal-layout>
        <div>
            <bread-crumb :back-route="route('admin:users.index')" back-name="Felhasználók" :current="form.name" />
            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">
                <form @submit.prevent="update">
                    <div class="p-8">
                        <div class="space-x-4 flex flex-row">
                            <div class="w-1/3">
                                <jet-label for="name" value="Név" />
                                <jet-input id="name" type="text" v-model="form.name" autocomplete="off" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="w-1/3">
                                <jet-label for="email" value="Email" />
                                <jet-input id="email" type="text" v-model="form.email" autocomplete="off" />
                                <jet-input-error :message="form.errors.email" class="mt-2" />
                            </div>

                            <div class="w-1/3">
                                <jet-label for="role" value="Típus"/>
                                <select name="role" id="role" v-model="form.role">
                                    <option v-for="(role, key) in roles" :key="key" :value="key">{{role}}</option>
                                </select>
                                <jet-input-error :message="form.errors.role" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                        <jet-button>
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

                <jet-button variant="danger" type="button" @click.native="deleteUser">
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
        editUser: Object,
        roles: Array,
    },
    setup(props) {
        const confirmModalShow = ref(false);

        const form = useForm({
            _method: 'PUT',
            name: props.editUser.name,
            email: props.editUser.email,
            role: props.editUser.role,
        })

        function update() {
            form.put(route('admin:users.update', props.editUser.id))
        }

        function deleteUser() {
            Inertia.delete(route('admin:users.destroy', props.editUser.id))
        }

        return {
            confirmModalShow,
            form,
            update,
            deleteUser,
        }
    },
}
</script>
