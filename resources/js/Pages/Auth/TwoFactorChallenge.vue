<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col items-center justify-center p-4">
        <div class="mb-8">
            <application-logo class="w-20 h-20 fill-current text-indigo-600" />
        </div>

        <div class="w-full max-w-md bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">

            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                    Kétlépcsős azonosítás
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <template v-if="!recovery">
                        Kérjük, erősítse meg hozzáférését a hitelesítő alkalmazás által generált kóddal.
                    </template>
                    <template v-else>
                        Kérjük, adja meg az egyik sürgősségi visszaállítási kódját.
                    </template>
                </p>
            </div>

            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit" class="space-y-6">
                <div v-if="!recovery">
                    <jet-label for="code" value="Hitelesítő kód" class="dark:text-gray-300" />
                    <jet-input
                        ref="code"
                        id="code"
                        type="text"
                        inputmode="numeric"
                        class="mt-1 block w-full text-center text-2xl tracking-[0.3em] font-mono dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        v-model="form.code"
                        autofocus
                        autocomplete="one-time-code"
                        placeholder="000000"
                    />
                </div>

                <div v-else>
                    <jet-label for="recovery_code" value="Visszaállítási kód" class="dark:text-gray-300" />
                    <jet-input
                        ref="recovery_code"
                        id="recovery_code"
                        type="text"
                        class="mt-1 block w-full font-mono dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        v-model="form.recovery_code"
                        autocomplete="one-time-code"
                        placeholder="abcdef-12345"
                    />
                </div>

                <div class="flex flex-col gap-4">
                    <jet-button
                        class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-900 transition shadow-lg shadow-indigo-500/30"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Bejelentkezés
                    </jet-button>

                    <button
                        type="button"
                        class="text-sm text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 underline transition cursor-pointer"
                        @click.prevent="toggleRecovery"
                    >
                        <template v-if="!recovery">
                            Visszaállítási kód használata
                        </template>
                        <template v-else>
                            Hitelesítő kód használata
                        </template>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import ApplicationLogo from '@/Jetstream/ApplicationLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

export default {
    components: {
        ApplicationLogo,
        JetButton,
        JetInput,
        JetLabel,
        JetValidationErrors,
    },

    data() {
        return {
            recovery: false,
            form: this.$inertia.form({
                code: '',
                recovery_code: '',
            })
        }
    },

    methods: {
        toggleRecovery() {
            this.recovery ^= true

            this.$nextTick(() => {
                if (this.recovery) {
                    this.$refs.recovery_code.focus()
                    this.form.code = '';
                } else {
                    this.$refs.code.focus()
                    this.form.recovery_code = ''
                }
            })
        },

        submit() {
            this.form.post(this.route('two-factor.login'))
        }
    }
}
</script>