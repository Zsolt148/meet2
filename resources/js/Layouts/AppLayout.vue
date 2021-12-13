<template>
    <Head>
        <title>{{ __('Home')}}</title>
        <meta head-key="description" name="description" content="meet.kvsc.info" />
    </Head>

    <div class="flex flex-col min-h-screen dark:bg-dark-eval-1" :class="route().current('home') ? 'bg-white' : 'bg-gray-100'">

        <!-- Primary Navigation Menu -->
        <nav class="bg-main">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between h-16 border-b border-gray-400 border-opacity-60">

                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center px-4 xl:px-2">
                        <jet-application-logo classes="text-white" />
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex px-4 xl:px-2">
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link :href="route('home')" :active="route().current('home')">
                                {{ __('Home') }}
                            </jet-nav-link>
                            <jet-nav-link :href="route('meets.index')" :active="route().current('meets*')">
                                {{ __('Meets') }}
                            </jet-nav-link>
                            <jet-nav-link :href="route('portal:dashboard')" v-if="$page.props.user">
                                {{ __('Portal') }}
                            </jet-nav-link>
                            <jet-nav-link :href="route('login')" :active="route().current('login')" v-else>
                                {{ __('Login') }}
                            </jet-nav-link>
                        </div>

<!--                        <div class="hidden sm:flex sm:items-center md:ml-4">-->
<!--                            <jet-dropdown width="48" align="right">-->
<!--                                <template #trigger>-->
<!--                                    <span class="inline-flex rounded-md">-->
<!--                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-bold rounded-md text-gray-200 dark:text-gray-200 bg-main hover:text-white focus:outline-none transition">-->
<!--                                            {{ __('Association') }}-->

<!--                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">-->
<!--                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />-->
<!--                                            </svg>-->
<!--                                        </button>-->
<!--                                    </span>-->
<!--                                </template>-->

<!--                                <template #content>-->

<!--                                    <jet-dropdown-link :href="route('home')">-->
<!--                                        {{ __('History') }}-->
<!--                                    </jet-dropdown-link>-->
<!--                                    <jet-dropdown-link :href="route('home')">-->
<!--                                        {{ __('Organizational operation') }}-->
<!--                                    </jet-dropdown-link>-->

<!--                                </template>-->
<!--                            </jet-dropdown>-->
<!--                        </div>-->

                        <!-- Dark toggle -->
                        <div class="inline-flex items-center sm:pl-8">
                            <Button
                                iconOnly
                                variant="secondary"
                                type="button"
                                @click="toggleDarkMode"
                                v-slot="{ iconSizeClasses }"
                                class="inline-flex bg-main dark:bg-main text-gray-200 dark:text-light-blue hover:text-white dark:hover:text-white"
                                srText="Toggle dark mode"
                            >
                                <MoonIcon
                                    v-show="!isDark"
                                    aria-hidden="true"
                                    :class="iconSizeClasses"
                                />
                                <SunIcon
                                    v-show="isDark"
                                    aria-hidden="true"
                                    :class="iconSizeClasses"
                                />
                            </Button>
                        </div>

                        <!-- Language Selector -->
                        <language-selector />

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden px-4">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link :href="route('home')" :active="route().current('home')">
                        {{ __('Home') }}
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link :href="route('meets.index')" :active="route().current('meets*')">
                        {{ __('Meets') }}
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link :href="route('portal:dashboard')" v-if="$page.props.user">
                        {{ __('Portal') }}
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link :href="route('login')" :active="route().current('login')" v-else>
                        {{ __('Login') }}
                    </jet-responsive-nav-link>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            <!-- Page Heading -->
            <header class="bg-main dark:bg-main-dark shadow " v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 xl:px-2 font-bold tracking-wide text-2xl text-white">
                    <slot name="header"></slot>
                </div>
            </header>
            <slot></slot>
        </main>

        <!--     FOOTER      -->
        <section :class="route().current('home') ? 'bg-white' : 'bg-gray-100'" class="border-t border-gray-200 dark:border-gray-500 dark:bg-dark-eval-1">
            <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
                <nav class="flex flex-wrap justify-center -mx-5 -my-2">
                    <div class="px-5 py-2">
                        <a href="#" class="text-base leading-6 text-gray-500 dark:text-white hover:text-gray-900 dark:hover:text-gray-300">
                            Impresszum
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base leading-6 text-gray-500 dark:text-white hover:text-gray-900 dark:hover:text-gray-300">
                            Adatvédelmi Irányelvek
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base leading-6 text-gray-500 dark:text-white hover:text-gray-900 dark:hover:text-gray-300">
                            Elérhetőség
                        </a>
                    </div>
                </nav>
                <p class="mt-8 text-base leading-6 text-center text-gray-400">
                    © 2021 MME Team. All rights reserved.
                </p>
            </div>
        </section>
    </div>
    <!--    COOKIES    -->
    <div class="fixed bottom-5 right-0 lg:right-4 p-4 bg-white dark:bg-gray-800 border-t-4 border-gray-300 dark:border-gray-500 shadow-lg rounded w-full sm:w-1/2 md:w-1/3 lg:w-1/4" v-if="!cookieAccepted">
        <h2 class="text-lg lg:text-xl mb-4 block font-bold leading-tight text-gray-700 dark:text-white">Sütik használata</h2>
        <div class="flex flex-col">
            <p class="mb-5 font-medium text-gray-600 dark:text-gray-200">
                A weboldal sütiket (cookie-kat) használ, hogy biztonságos böngészés mellett a legjobb felhasználói élményt nyújtsa.
            </p>
            <button class="w-full px-3 py-1 bg-gray-300 dark:text-white dark:bg-gray-500 hover:bg-blue-500 hover:underline hover:text-white rounded text-gray-700 uppercase tracking-widest text-xs font-bold"
                    @click.prevent="acceptCookie"
            >
                Elfogadom
            </button>
        </div>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import LanguageSelector from '@/Shared/LanguageSelector'
    import Button from '@/Jetstream/Button'
    import { toggleDarkMode, isDark } from '@/Composables'
    import { SunIcon, MoonIcon } from '@heroicons/vue/outline'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            JetApplicationLogo,
            LanguageSelector,
            Button,
            toggleDarkMode,
            isDark,
            SunIcon,
            MoonIcon,
        },

        mounted() {
            this.cookieAccepted = localStorage.getItem('cookie_accepted') == 'true' ? true : false;
        },

        data() {
            return {
                showingNavigationDropdown: false,
                cookieAccepted: false,
                toggleDarkMode,
                isDark
            }
        },

        methods: {
            acceptCookie() {
                localStorage.setItem('cookie_accepted', true);
                this.cookieAccepted = true;
            }
        }
    }
</script>
