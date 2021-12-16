<template>
    <Head title="meet.kvsc.info"/>

    <app-layout>
        <div class="max-w-7xl flex flex-col items-center px-5 py-16 mx-auto md:flex-row lg:px-28">
            <div class="flex flex-col items-start mb-16 text-left lg:flex-grow md:w-1/2 lg:pr-12 md:pr-16 md:mb-0">
                <h2 class="mb-8 text-xs font-semibold tracking-widest text-black dark:text-white uppercase title-font">
                    {{ __('Welcome at the new site!') }}</h2>
                <h1 class="mb-8 text-4xl md:text-5xl font-black tracking-tighter text-green dark:text-green-light title-font">
                    meet.kvsc.info</h1>
                <p class="mb-8 text-base leading-relaxed text-left text-black dark:text-white">
                    Online {{__('news')}} <br>
                    Online {{__('results')}} <br>
                    Online {{__('entries')}}
                </p>
                <div class="flex flex-row justify-center">
                    <jet-button :href="route('meets.index')">
                        {{__('Meets')}}
                    </jet-button>
<!--                    <Link :href="route('home')"-->
<!--                          class="inline-flex items-center font-semibold text-gray-900 dark:text-white md:mb-2 lg:mb-0 hover:text-main dark:hover:text-green-light ml-4">-->
<!--                        Hírek-->
<!--                        <icon name="arrow-right" class="w-4 h-4 ml-2"></icon>-->
<!--                    </Link>-->
                </div>
            </div>
            <div class="w-full md:w-1/2 sm:pt-8 lg:w-4/6">
                <img src="/images/main-swimmer.png" alt="Swimmer">
            </div>
        </div>
        <div class="">
            <img class="spacer" src="/images/waves1.svg" alt="Wave">
        </div>
        <div class="bg-main">
            <div class="container mx-auto">
                <div
                    class="rounded-lg bg-green text-black p-8 flex flex-col md:flex-row space-between items-center justify-between relative overflow-hidden">
                    <!-- LEFT PART -->
                    <div class="flex flex-col lg:ml-14 xl:ml-28 max-w-sm lg:max-w-3xl z-10">
                        <h4 class="text-2xl text-center md:text-left font-bold text-white md:pb-2">
                            {{ __('Official results of swimming competitions - ') }} nevezes@kvsc.info
                        </h4>
                        <p class="text-center md:text-left text-gray-100 md:pb-6">
                            {{ __('Follow the results online, even on mobiles too.') }}
                        </p>
                        <p class="text-xs text-gray-200 hidden md:block">
                            MME Team
                        </p>
                    </div>
                    <!-- RIGHT PART -->
                    <div class="pt-8 md:pt-0 justify-center lg:ml-auto z-10">
                        <jet-button :href="route('meets.index')" variant="secondary" size="lg">
                            {{__('Meets')}}
                            <icon class="w-5 h-5" name="arrow-right"/>
                        </jet-button>
                    </div>

                    <div class="absolute bg-light-blue opacity-60 w-96 h-96 -top-10 -right-16 md:w-[800px] md:h-[800px] md:left-[45%] md:top-[-150%] rounded-full z-0"></div>
                </div>
            </div>
        </div>
        <div class="sm:-mb-10 md:-mb-16 lg:-mb-20">
            <img class="spacer" src="/images/waves2.svg" alt="Wave">
        </div>

        <div class="max-w-7xl mx-auto mb-20">
            <div v-for="(data, key) in meets" :key="key"
                 class="mx-auto mb-6 px-4 py-2 bg-gray-100 dark:bg-gray-600 shadow hover:shadow-md hover:border-transparent transition-shadow duration-200 ease-in-out rounded-lg w-full">
                <div class="py-2 flex flex-col sm:flex-row justify-between">
                    <div class="flex flex-row items-center">
                        <Link class="text-2xl link" :href="route('meets.show', data.slug)">
                            {{data.name}}
                        </Link>
                    </div>
                    <div class="flex items-center mt-3 sm:mt-0 font-semibold text-green dark:text-green-light">
                        <icon name="calendar" class="w-4 h-4 mt-1 mr-2"/>
                        <span>{{data.date}}</span>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 dark:text-gray-200 w-full mb-5">
                    <div class="flex" v-if="data.type">
                        <icon name="swimmer" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{data.type}}</span>
                    </div>
                    <div class="flex" v-if="data.location">
                        <LocationMarkerIcon class="w-5 h-5 mr-2" />
                        <span>{{data.location.city}} <span v-if="data.location.address">- {{data.location.address}}</span></span>
                    </div>
                    <div class="flex" v-if="data.location">
                        <icon name="pool" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{data.location.pool}} M - {{data.location.timing}}</span>
                    </div>
                </div>
                <div>
                    <article class="my-5 prose dark:prose-dark max-w-none bg-gray-100 dark:bg-gray-600"
                             v-if="data.latestNews && data.latestNews.body" v-html="data.latestNews.body"/>
                </div>
                <div>
                    <Link class="inline-flex items-center text-green dark:text-green-light hover:text-green-light"
                          :href="route('meets.show', data.slug)">
                        Tovább
                        <icon name="arrow-right" class="w-4 h-4 ml-2"></icon>
                    </Link>
                </div>
            </div>

            <div class="mt-10 flex justify-end">
                <jet-button :href="route('meets.index')" size="lg">
                    {{ __('All Meets') }}
                    <icon name="arrow-right" class="w-4 h-4 ml-2"></icon>
                </jet-button>
            </div>

            <!--            <div class="bg-white p-2 sm:p-4 sm:h-64 rounded-2xl shadow-lg flex flex-col sm:flex-row gap-5 select-none">-->
            <!--                <div class="h-52 sm:h-full sm:w-72 rounded-xl bg-gray-200 animate-pulse" ></div>-->
            <!--                <div class="flex flex-col flex-1 gap-5 sm:p-2">-->
            <!--                    <div class="flex flex-1 flex-col gap-3">-->
            <!--                        <div class="bg-gray-200 w-full animate-pulse h-14 rounded-2xl"></div>-->
            <!--                        <div class="bg-gray-200 w-full animate-pulse h-3 rounded-2xl"></div>-->
            <!--                        <div class="bg-gray-200 w-full animate-pulse h-3 rounded-2xl"></div>-->
            <!--                        <div class="bg-gray-200 w-full animate-pulse h-3 rounded-2xl"></div>-->
            <!--                        <div class="bg-gray-200 w-full animate-pulse h-3 rounded-2xl"></div>-->
            <!--                    </div>-->
            <!--                    <div class="mt-auto flex gap-3">-->
            <!--                        <div class="bg-gray-200 w-20 h-8 animate-pulse rounded-full"></div>-->
            <!--                        <div class="bg-gray-200 w-20 h-8 animate-pulse rounded-full"></div>-->
            <!--                        <div class="bg-gray-200 w-20 h-8 animate-pulse rounded-full ml-auto"></div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from "@/Jetstream/Button";
import Icon from "@/Shared/Icon"
import { LocationMarkerIcon } from '@heroicons/vue/outline'

export default {
    components: {
        AppLayout,
        JetButton,
        Icon,
        LocationMarkerIcon
    },
    props: {
        meets: Object
    },
    setup({ meets }) {
        meets = _.orderBy(meets, 'id', 'desc')
        return {
            meets,
        }
    }
}
</script>
