<template>
    <PerfrectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >
        <SidebarLink
            title="Kezdőlap"
            :href="route('portal:dashboard')"
            :active="route().current('portal:dashboard')"
        >
            <template #icon>
                <DashboardIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            title="Felhasználók"
            :href="route('admin:users.index')"
            :active="isUrl('admin/users*')"
            v-show="isAdmin"
        >
            <template #icon>
                <UserGroupIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarCollapsible
            title="Helyszínek"
            :active="isUrl('admin/locations*')"
            v-show="isAdmin"
        >
            <template #icon>
                <LocationMarkerIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem :href="route('admin:locations.create')" title="Új helyszín" :active="route().current('admin:locations.create')" />
            <SidebarCollapsibleItem :href="route('admin:locations.index')" title="Összes" :active="route().current('admin:locations.index') || route().current('admin:locations.edit')" />
        </SidebarCollapsible>

<!--        <SidebarCollapsible title="Dropdown">-->
<!--            <SidebarCollapsibleItem href="#" title="Link 1" :active="false" />-->
<!--            <SidebarCollapsibleItem href="#" title="Link 2" :active="true" />-->
<!--            <SidebarCollapsibleItem href="#" title="Link 3" :active="false" />-->
<!--        </SidebarCollapsible>-->

        <!-- Examples -->
        <!-- <SidebarCollapsible title="Dropdown" :active="$page.url.startsWith('/users')">
            <SidebarCollapsibleItem href="#" title="List" :active="$page.url === '/users/index'" />
            <SidebarCollapsibleItem href="#" title="Create" :active="$page.url === '/users/create'" />
        </SidebarCollapsible>

        <SidebarCollapsible title="Dropdown" :active="usePage().url.value.startsWith('/users')">
            <template #icon>
                <UserIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem href="#" title="List" :active="route().current('users.index')" />
            <SidebarCollapsibleItem href="#" title="Create" :active="route().current('users.create')" />
        </SidebarCollapsible> -->
    </PerfrectScrollbar>
</template>

<script>
import PerfrectScrollbar from '@/Shared/PerfectScrollbar'
import SidebarLink from '@/Pages/Portal/Sidebar/SidebarLink.vue'
import { DashboardIcon } from '@/Icons/outline.jsx'
import { UserGroupIcon, LocationMarkerIcon } from '@heroicons/vue/outline'
import SidebarCollapsible from '@/Pages/Portal/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Pages/Portal/Sidebar/SidebarCollapsibleItem.vue'

export default {
    components: {
        PerfrectScrollbar,
        SidebarLink,
        SidebarCollapsible,
        SidebarCollapsibleItem,
        //Icons
        DashboardIcon,
        UserGroupIcon,
        LocationMarkerIcon
    },

    methods: {
        isAdmin() {
            return this.$page.props.user.role === 'admin';
        }
    }
}
</script>
