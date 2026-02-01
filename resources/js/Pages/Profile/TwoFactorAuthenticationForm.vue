<template>
    <jet-action-section>
        <template #title>
            {{ __('Kétlépcsős azonosítás') }}
        </template>

        <template #description>
            {{ __('Fiókja biztonságának fokozása kétlépcsős azonosítás használatával.') }}
        </template>

        <template #content>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white" v-if="twoFactorEnabled">
                {{ __('A kétlépcsős azonosítás be van kapcsolva.') }}
            </h3>

            <h3 class="text-lg font-medium text-gray-900 dark:text-white" v-else>
                {{ __('A kétlépcsős azonosítás nincs bekapcsolva.') }}
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                <p>
                    {{ __("Ha a kétlépcsős azonosítás engedélyezve van, a bejelentkezés során egy biztonságos, véletlenszerű tokent kell megadnia. Ezt a tokent a telefonja Google Authenticator vagy más hitelesítő alkalmazásából érheti el.") }}
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-300">
                        <p class="font-semibold">
                            {{ __("A kétlépcsős azonosítás mostantól aktív. Szkennelje be az alábbi QR-kódot a telefonja hitelesítő alkalmazásával.") }}
                        </p>
                    </div>

                    <div class="mt-4 inline-block p-4 bg-white rounded-lg shadow-inner" v-html="qrCode">
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-300">
                        <p class="font-semibold">
                            {{ __("Tárolja ezeket a visszaállítási kódokat egy biztonságos jelszókezelőben. Ezek segítségével férhet hozzá fiókjához, ha elveszítené a hitelesítő eszközét.") }}
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-900 dark:text-gray-300 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="!twoFactorEnabled">
                    <jet-confirms-password @confirmed="enableTwoFactorAuthentication">
                        <jet-button type="button" :loading="enabling" class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Bekapcsolás') }}
                        </jet-button>
                    </jet-confirms-password>
                </div>

                <div v-else>
                    <jet-confirms-password @confirmed="regenerateRecoveryCodes">
                        <jet-button variant="secondary" type="button" class="mr-3"
                                    v-if="recoveryCodes.length > 0">
                            {{ __('Új kódok generálása') }}
                        </jet-button>
                    </jet-confirms-password>

                    <jet-confirms-password @confirmed="showRecoveryCodes">
                        <jet-button variant="secondary" type="button" class="mr-3" v-if="recoveryCodes.length === 0">
                            {{ __('Kódok megjelenítése') }}
                        </jet-button>
                    </jet-confirms-password>

                    <jet-confirms-password @confirmed="disableTwoFactorAuthentication">
                        <jet-button variant="danger" type="button" :loading="disabling">
                            {{ __('Kikapcsolás') }}
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
            return !this.enabling && this.$page.props.user.two_factor_enabled
        }
    }
}
</script>