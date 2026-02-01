<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col items-center justify-center p-4">

        <div class="absolute top-4 right-4">
            <button @click="logout" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 underline">
                Kijelentkezés
            </button>
        </div>

        <div class="w-full max-w-md bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">

            <div class="text-center mb-6">
                <div class="mx-auto w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">2FA Aktiválása</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">A biztonság érdekében fiókodhoz kötelező a kétfaktoros hitelesítés.</p>
            </div>

            <div v-if="!qrCode && !showRecoveryCodes" class="space-y-4">
                <button @click="enableTwoFactor"
                        class="w-full py-3 px-4 bg-teal-400 hover:bg-teal-500 text-white rounded-xl font-semibold transition-all">
                    Beállítás megkezdése
                </button>
            </div>

            <div v-if="qrCode && !showRecoveryCodes" class="space-y-6">
                <div class="sm:hidden">
                    <a :href="otpAuthUrl"
                       class="flex items-center justify-center gap-3 w-full py-4 px-4 bg-blue-600 text-white rounded-xl font-bold shadow-lg">
                        Megnyitás az Appban
                    </a>
                </div>

                <div class="hidden sm:flex justify-center p-3 bg-white rounded-lg border shadow-inner">
                    <div v-html="qrCode"></div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 text-center">Ellenőrző kód:</label>
                    <input v-model="confirmationCode"
                           type="text" inputmode="numeric" placeholder="000000"
                           class="w-full text-center text-2xl font-mono border-gray-300 dark:bg-gray-700 dark:text-white rounded-xl" />
                </div>

                <button @click="confirmTwoFactor"
                        :disabled="confirmationCode.length < 6"
                        class="w-full py-3 bg-teal-400 hover:bg-teal-500 disabled:opacity-50 text-white rounded-xl font-bold">
                    Megerősítés
                </button>
            </div>

            <div v-if="showRecoveryCodes" class="space-y-6">
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg border border-yellow-200 dark:border-yellow-800">
                    <p class="text-sm text-yellow-800 dark:text-yellow-200 font-bold">Mentsd el ezeket a kódokat!</p>
                    <p class="text-xs text-yellow-700 dark:text-yellow-300">Ha elveszíted a telefonod, csak ezekkel tudsz majd belépni.</p>
                </div>

                <div class="grid grid-cols-2 gap-2 font-mono text-sm bg-gray-50 dark:bg-gray-900 p-4 rounded-lg dark:text-gray-300">
                    <div v-for="code in recoveryCodes" :key="code">{{ code }}</div>
                </div>

                <button @click="finishSetup" class="w-full py-3 bg-teal-400 hover:bg-teal-500 text-white rounded-xl font-bold">
                    Kódokat elmentettem, belépés
                </button>
            </div>

        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';
import Button from "@/Jetstream/Button.vue";

const qrCode = ref(null);
const otpAuthUrl = ref('');
const confirmationCode = ref('');
const recoveryCodes = ref([]);
const showRecoveryCodes = ref(false);

const enableTwoFactor = async () => {
    try {
        await axios.post('/user/two-factor-authentication');

        const [qr, link] = await Promise.all([
            axios.get('/user/two-factor-qr-code'),
            axios.get('/user/two-factor-setup-link')
        ]);

        qrCode.value = qr.data.svg;
        otpAuthUrl.value = link.data.url;
    } catch (error) {
        console.error("Route hiba!", error);
    }
};

const confirmTwoFactor = async () => {
    try {
        await axios.post('/user/confirmed-two-factor-authentication', {
            code: confirmationCode.value
        });

        const codes = await axios.get('/user/two-factor-recovery-codes');
        recoveryCodes.value = codes.data;
        showRecoveryCodes.value = true;
    } catch (e) {
        alert('Érvénytelen kód!');
    }
};

const logout = () => {
    Inertia.post('/logout');
};

const finishSetup = () => {
    Inertia.visit('/portal');
};
</script>