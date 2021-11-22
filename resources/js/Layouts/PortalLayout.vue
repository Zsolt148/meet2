<template>
    <div
        class="min-h-screen text-gray-900 bg-gray-100 dark:bg-dark-bg dark:text-gray-100"
    >
        <!-- Sidebar -->
        <Sidebar />

        <div
            style="transition-property: margin; transition-duration: 150ms"
            :class="[
                'min-h-screen flex flex-col',
                {
                    'lg:ml-64': sidebarState.isOpen,
                    'md:ml-16': !sidebarState.isOpen,
                },
            ]"
        >
            <!-- Navbar -->
            <Navbar />

            <!-- Page Heading -->
            <header v-if="$slots.header">
                <div class="mx-2 sm:mx-4 mt-4 text-2xl font-semibold">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 mx-2 sm:mx-4 my-4">
                <flash-messages />
                <slot />
            </main>

            <PageFooter />
        </div>
    </div>
</template>

<script>
import Sidebar from '@/Pages/Portal/Sidebar/Sidebar.vue'
import Navbar from '@/Pages/Portal/Navbar.vue'
import PageFooter from '@/Pages/Portal/Footer.vue'
import { sidebarState } from '@/Composables'
import FlashMessages from "@/Shared/FlashMessages";

export default {
    components: {
        Sidebar,
        Navbar,
        PageFooter,
        FlashMessages
    },

    setup() {
        return {
            sidebarState,
        }
    },
}
</script>
