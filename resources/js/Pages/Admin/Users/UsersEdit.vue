<template>
    <portal-layout>
        <Head title="Felhasználó szerkesztése" />
        <div>
            <bread-crumb :back-route="route('admin:users.index')" back-name="Felhasználók" :current="form.name" />
            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">
                <form @submit.prevent="update">
                    <div class="p-8">
                        <div class="mb-5">
                            <img :src="editUser.profile_photo_url" :alt="editUser.name" class="rounded-full h-20 w-20 object-cover">
                        </div>
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
                                <jet-label for="team_id" value="Egyesület"/>
                                <select name="team_id" id="team_id" v-model="form.team_id">
                                    <option value="null">{{ __('Empty') }}</option>
                                    <option v-for="team in teams" :key="team.id" :value="team.id">{{team.name}}</option>
                                </select>
                                <jet-input-error :message="form.errors.team_id" class="mt-2" />
                            </div>
                        </div>

                        <div class="space-x-4 flex flex-row mt-5">
                            <div class="w-full">
                                <jet-label for="" value="Jogosultságok"/>
                                <div v-for="(role, index) in allRoles" :key="index" class="my-3">
                                    <jet-label :for="role.id">
                                        <div class="flex items-center text-xl">
                                            <jet-checkbox :id="role.id" v-model="roles[index].isSelected" :checked="role.isSelected" />

                                            <div class="ml-2">
                                                {{ role.name }} <br>
                                                <div class="text-xs">{{ role.hint }}</div>
                                            </div>
                                        </div>
                                    </jet-label>
                                </div>
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

                <jet-button variant="danger" type="button" @click.native="deleteModel">
                    Törlés
                </jet-button>
            </template>
        </jet-confirmation-modal>
    </portal-layout>
</template>

<script>
import { ref, reactive } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from "@inertiajs/inertia";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import BreadCrumb from "@/Shared/BreadCrumb";

export default {
    components: {
        PortalLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetCheckbox,
        JetConfirmationModal,
        BreadCrumb
    },
    props: {
        editUser: Object,
        allRoles: Array,
        teams: Array,
    },
    setup(props) {
        const confirmModalShow = ref(false);
        const roles = reactive(props.allRoles);

        const form = useForm({
            _method: 'PUT',
            name: props.editUser.name,
            email: props.editUser.email,
            team_id: props.editUser.team_id,
            roles: []
        })

        function update() {
            form.roles = roles
            form.put(route('admin:users.update', props.editUser.id))
        }

        function deleteModel() {
            Inertia.delete(route('admin:users.destroy', props.editUser.id))
        }

        function isChecked(obj, id) {
            return obj.find(x => x.id === id) ? true : false
        }

        return {
            confirmModalShow,
            form,
            roles,
            update,
            deleteModel,
            isChecked
        }
    },
}
</script>
