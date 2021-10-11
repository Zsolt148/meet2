<template>
    <app-layout>
        <div class="max-w-7xl flex flex-col items-center px-5 py-16 mx-auto md:flex-row lg:px-28">
            <div class="flex flex-col items-start mb-16 text-left lg:flex-grow md:w-1/2 lg:pr-12 md:pr-16 md:mb-0">
                <h2 class="mb-8 text-xs font-semibold tracking-widest text-black dark:text-white uppercase title-font">Üdvözöljük az új oldalon!</h2>
                <h1 class="mb-8 text-5xl font-black tracking-tighter text-green dark:text-green-light title-font">meet.kvsc.info</h1>
                <p class="mb-8 text-base leading-relaxed text-left text-black dark:text-white">
                    Online {{ __('news') }} <br>
                    Online {{ __('results') }} <br>
                    Online {{ __('entries') }}
                </p>
                <div class="flex flex-row justify-center">
                    <inertia-link :href="route('meets.index')">
                        <jet-button>
                            {{ __('Meets') }}
                        </jet-button>
                    </inertia-link>
                    <inertia-link :href="route('home')" class="inline-flex items-center font-semibold text-gray-900 dark:text-white md:mb-2 lg:mb-0 hover:text-main dark:hover:text-green-light ml-4">
                        Hírek
                        <icon name="arrow-right" class="w-4 h-4 ml-2"></icon>

                    </inertia-link>
                </div>
            </div>
            <div class="w-full md:w-1/2 sm:pt-8 lg:w-4/6">
                <img src="/images/main-swimmer.png" alt="Swimmer">
            </div>
        </div>
        <div class="spacer bg-wave-1 -mt-16"></div>
        <div class="bg-main">
            <div class="container mx-auto">
                <div class="rounded-lg bg-green text-black p-8 flex flex-col md:flex-row space-between items-center justify-between relative overflow-hidden">
                    <!-- LEFT PART -->
                    <div class="flex flex-col lg:ml-14 xl:ml-28 max-w-sm lg:max-w-xl z-10">
                        <h4 class="text-4xl text-center md:text-left font-bold text-white md:pb-2">
                            You need more informations?
                        </h4>
                        <p class="text-center md:text-left text-gray-100 md:pb-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        </p>
                        <p class="text-xs text-gray-200 hidden md:block">
                            MME Team
                        </p>
                    </div>
                    <!-- RIGHT PART -->
                    <div class="pt-8 md:pt-0 justify-center lg:ml-auto z-10">
                        <!-- Contribuer -->
                        <inertia-link :href="route('meets.index')" target="_blank" class="flex items-center px-8 py-4 text-center font-bold text-black uppercase bg-white font-display rounded-full transition duration-200 hover:bg-main hover:text-white">
                            <span class="pt-1.5 pr-2 animate-pulse">
                                {{ __('Meets') }}
                            </span>
                            <icon class="w-5 h-5 animate-pulse" name="arrow-right" />
                        </inertia-link>
                    </div>

                    <div class="absolute bg-light-blue opacity-60 w-96 h-96 -top-10 -right-16 md:w-[800px] md:h-[800px] md:left-[45%] md:top-[-150%] rounded-full z-0"></div>
                </div>
            </div>
        </div>
        <div class="spacer bg-wave-2 -mb-16"></div>
        <div class="max-w-7xl mx-auto mb-16">
            <div class="bg-white p-2 sm:p-4 sm:h-64 rounded-2xl shadow-lg flex flex-col sm:flex-row gap-5 select-none">
                <div class="h-52 sm:h-full sm:w-72 rounded-xl bg-gray-200 animate-pulse" ></div>
                <div class="flex flex-col flex-1 gap-5 sm:p-2">
                    <div class="flex flex-1 flex-col gap-3">
                        <div class="bg-gray-200 w-full animate-pulse h-14 rounded-2xl" ></div>
                        <div class="bg-gray-200 w-full animate-pulse h-3 rounded-2xl" ></div>
                        <div class="bg-gray-200 w-full animate-pulse h-3 rounded-2xl" ></div>
                        <div class="bg-gray-200 w-full animate-pulse h-3 rounded-2xl" ></div>
                        <div class="bg-gray-200 w-full animate-pulse h-3 rounded-2xl" ></div>
                    </div>
                    <div class="mt-auto flex gap-3">
                        <div class="bg-gray-200 w-20 h-8 animate-pulse rounded-full" ></div>
                        <div class="bg-gray-200 w-20 h-8 animate-pulse rounded-full" ></div>
                        <div class="bg-gray-200 w-20 h-8 animate-pulse rounded-full ml-auto" ></div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from "@/Jetstream/Button";
import Icon from "@/Shared/Icon"

export default {
    components: {
        AppLayout,
        JetButton,
        Icon,
    },
}
</script>
