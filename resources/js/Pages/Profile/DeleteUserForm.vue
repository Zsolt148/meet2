<template>
    <jet-action-section>
        <template #title>
            {{__('Delete Account')}}
        </template>

        <template #description>
            {{__('Permanently delete your account.')}}
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600 dark:text-gray-200">
                {{__('Once your account is deleted, all of its resources and data will be permanently deleted.Before deleting your account, please download any data or information that you wish to retain.')}}
            </div>

            <div class="mt-5">
                <jet-button variant="danger" type="button" @click="confirmUserDeletion">
                    {{__('Delete Account')}}
                </jet-button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <jet-dialog-modal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    {{__('Delete Account')}}
                </template>

                <template #content>
                    {{__('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.')}}

                    <div class="mt-4">
                        <jet-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                    ref="password"
                                    v-model="form.password"
                                    @keyup.enter="deleteUser" />

                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-button variant="secondary" type="button" @click="closeModal">
                        {{__('Cancel')}}
                    </jet-button>

                    <jet-button variant="danger" type="button" class="ml-2" @click="deleteUser" :loading="form.processing">
                        {{__('Delete Account')}}
                    </jet-button>
                </template>
            </jet-dialog-modal>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetButton from '@/Jetstream/Button'

    export default {
        components: {
            JetActionSection,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetButton,
        },

        data() {
            return {
                confirmingUserDeletion: false,

                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods: {
            confirmUserDeletion() {
                this.confirmingUserDeletion = true;

                setTimeout(() => this.$refs.password.focus(), 250)
            },

            deleteUser() {
                this.form.delete(route('current-user.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },

            closeModal() {
                this.confirmingUserDeletion = false

                this.form.reset()
            },
        },
    }
</script>
