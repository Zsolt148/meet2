<template>
    <jet-action-section>
        <template #title>
            {{__('Two Factor Authentication')}}
        </template>

        <template #description>
            {{__('Add additional security to your account using two factor authentication.')}}
        </template>

        <template #content>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white" v-if="twoFactorEnabled">
                {{__('You have enabled two factor authentication.')}}
            </h3>

            <h3 class="text-lg font-medium text-gray-900 dark:text-white" v-else>
                {{__('You have not enabled two factor authentication.')}}
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-300">
                <p>
                    {{__("When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.")}}
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{__("Two factor authentication is now enabled.Scan the following QR code using your phone's authenticator application.")}}
                        </p>
                    </div>

                    <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white" v-html="qrCode">
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{__("Store these recovery codes in a secure password manager.They can be used to recover access to your account if your two factor authentication device is lost.")}}
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <jet-confirms-password @confirmed="enableTwoFactorAuthentication">
                        <jet-button type="button" :loading="enabling">
                            {{__('Enable')}}
                        </jet-button>
                    </jet-confirms-password>
                </div>

                <div v-else>
                    <jet-confirms-password @confirmed="regenerateRecoveryCodes">
                        <jet-button variant="secondary" type="button" class="mr-3"
                                        v-if="recoveryCodes.length > 0">
                            {{__('Regenerate Recovery Codes')}}
                        </jet-button>
                    </jet-confirms-password>

                    <jet-confirms-password @confirmed="showRecoveryCodes">
                        <jet-button variant="secondary" type="button" class="mr-3" v-if="recoveryCodes.length === 0">
                            {{__('Show Recovery Codes')}}
                        </jet-button>
                    </jet-confirms-password>

                    <jet-confirms-password @confirmed="disableTwoFactorAuthentication">
                        <jet-button     variant="danger" type="button"
                                        :loading="disabling">
                            {{__('Disable')}}
                        </jet-button>
                    </jet-confirms-password>
                </div>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetButton from '@/Jetstream/Button'
    import JetConfirmsPassword from '@/Jetstream/ConfirmsPassword'

    export default {
        components: {
            JetActionSection,
            JetButton,
            JetConfirmsPassword,
        },

        data() {
            return {
                enabling: false,
                disabling: false,

                qrCode: null,
                recoveryCodes: [],
            }
        },

        methods: {
            enableTwoFactorAuthentication() {
                this.enabling = true

                this.$inertia.post('/user/two-factor-authentication', {}, {
                    preserveScroll: true,
                    onSuccess: () => Promise.all([
                        this.showQrCode(),
                        this.showRecoveryCodes(),
                    ]),
                    onFinish: () => (this.enabling = false),
                })
            },

            showQrCode() {
                return axios.get('/user/two-factor-qr-code')
                        .then(response => {
                            this.qrCode = response.data.svg
                        })
            },

            showRecoveryCodes() {
                return axios.get('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.recoveryCodes = response.data
                        })
            },

            regenerateRecoveryCodes() {
                axios.post('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.showRecoveryCodes()
                        })
            },

            disableTwoFactorAuthentication() {
                this.disabling = true

                this.$inertia.delete('/user/two-factor-authentication', {
                    preserveScroll: true,
                    onSuccess: () => (this.disabling = false),
                })
            },
        },

        computed: {
            twoFactorEnabled() {
                return ! this.enabling && this.$page.props.user.two_factor_enabled
            }
        }
    }
</script>
