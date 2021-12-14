<template>
    <nav
        aria-label="secondary"
        :class="[
            'sticky top-0 z-10 px-6 py-4 bg-white flex items-center justify-between transition-transform duration-500 dark:bg-dark-eval-1',
            {
                '-translate-y-full': scrolling.down,
                'translate-y-0': scrolling.up,
            },
        ]"
    >
        <div class="flex items-center gap-2">
            <Button
                iconOnly
                variant="secondary"
                type="button"
                @click="toggleDarkMode"
                v-slot="{ iconSizeClasses }"
                class="md:hidden"
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
        <div class="flex items-center gap-2">
            <Button
                iconOnly
                variant="secondary"
                type="button"
                @click="toggleDarkMode"
                v-slot="{ iconSizeClasses }"
                class="hidden md:inline-flex"
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

            <Button
                iconOnly
                variant="secondary"
                type="button"
                @click="toggleFullScreen"
                v-slot="{ iconSizeClasses }"
                class="hidden md:inline-flex"
                srText="Toggle dark mode"
            >
                <ArrowsExpandIcon
                    v-show="!isFullscreen"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
                <ArrowsInnerIcon
                    v-show="isFullscreen"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
            </Button>

            <!-- Language Selector -->
            <language-selector />

            <!-- Dropdwon -->
            <jet-dropdown width="48" align="right">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-bold rounded-md text-black dark:text-white bg-white dark:bg-dark-eval-1 hover:text-green dark:hover:text-green-light focus:outline-none transition">

                            <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" class="rounded-full h-8 w-8 object-cover">

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-700 dark:text-gray-200">
                        {{__('Profile settings')}}
                    </div>

                    <jet-dropdown-link :href="route('profile.show')">
                        {{__('Settings')}}
                    </jet-dropdown-link>

                    <div class="border-t border-gray-100 dark:border-gray-700"></div>

                    <!-- Authentication -->
                    <jet-dropdown-link :href="route('logout')" method="post">
                        {{__('Logout')}}
                    </jet-dropdown-link>
                </template>
            </jet-dropdown>
        </div>
    </nav>

    <!-- Mobile bottom bar -->
    <div
        :class="[
            'fixed inset-x-0 bottom-0 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white md:hidden dark:bg-dark-eval-1',
            {
                'translate-y-full': scrolling.down,
                'translate-y-0': scrolling.up,
            },
        ]"
    >
<!--        <Button-->
<!--            iconOnly-->
<!--            variant="secondary"-->
<!--            type="button"-->
<!--            v-slot="{ iconSizeClasses }"-->
<!--            srText="Search"-->
<!--        >-->
<!--            <SearchIcon aria-hidden="true" :class="iconSizeClasses" />-->
<!--        </Button>-->

        <Link :href="route('portal:dashboard')">
            <ApplicationLogo class="w-10 h-10" />
            <span class="sr-only">admin</span>
        </Link>

        <Button
            iconOnly
            variant="secondary"
            type="button"
            @click="sidebarState.isOpen = !sidebarState.isOpen"
            v-slot="{ iconSizeClasses }"
            class="md:hidden"
            srText="Search"
        >
            <MenuIcon
                v-show="!sidebarState.isOpen"
                aria-hidden="true"
                :class="iconSizeClasses"
            />
            <XIcon
                v-show="sidebarState.isOpen"
                aria-hidden="true"
                :class="iconSizeClasses"
            />
        </Button>
    </div>
</template>

<script>
import { defineComponent, onMounted, onUnmounted, Transition } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import { useFullscreen } from '@vueuse/core'
import {
    SunIcon,
    MoonIcon,
    SearchIcon,
    MenuIcon,
    XIcon,
    ArrowsExpandIcon
} from '@heroicons/vue/outline'
import {
    handleScroll,
    isDark,
    scrolling,
    toggleDarkMode,
    sidebarState,
} from '@/Composables'
import Button from '@/Jetstream/Button'
import ApplicationLogo from '@/Jetstream/ApplicationLogo'
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import { ArrowsInnerIcon } from '@/Icons/outline.jsx'
import LanguageSelector from "@/Shared/LanguageSelector";

export default {
    components: {
        ApplicationLogo,
        Button,
        JetDropdown,
        JetDropdownLink,
        LanguageSelector,
        // icons
        SunIcon,
        MoonIcon,
        SearchIcon,
        MenuIcon,
        XIcon,
        ArrowsInnerIcon,
        ArrowsExpandIcon
    },

    setup() {
        const { isFullscreen, toggle: toggleFullScreen } = useFullscreen()

        onMounted(() => {
            document.addEventListener('scroll', handleScroll)
        })
        onUnmounted(() => {
            document.removeEventListener('scroll', handleScroll)
        })

        return {
            scrolling,
            isDark,
            toggleDarkMode,
            isFullscreen,
            toggleFullScreen,
            sidebarState,
        }
    },
}
</script>
