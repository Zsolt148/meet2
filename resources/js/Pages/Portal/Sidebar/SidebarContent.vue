<template>
    <PerfrectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >
        <SidebarLink
            :title="__('Dashboard')"
            :href="route('portal:dashboard')"
            :active="route().current('portal:dashboard')"
        >
            <template #icon>
                <HomeIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <div class="mt-4 flex items-center justify-between" v-show="isAdmin()">
            <span class="border-b border-gray-300 dark:border-gray-500 w-2/6"></span>

            <span class="text-xs text-center text-gray-500 dark:text-gray-200 uppercase">admin</span>

            <span class="border-b border-gray-300 dark:border-gray-500 w-2/6"></span>
        </div>

        <SidebarLink
            title="Felhasználók"
            :href="route('admin:users.index')"
            :active="isUrl('admin/users*')"
            v-show="isAdmin()"
        >
            <template #icon>
                <UserGroupIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            title="Egyesületek"
            :href="route('admin:teams.index')"
            :active="isUrl('admin/teams*')"
            v-show="isAdmin()"
        >
            <template #icon>
                <UsersIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            title="Versenyszámok"
            :href="route('admin:events.index')"
            :active="isUrl('admin/events*')"
            v-show="isAdmin()"
        />

        <SidebarCollapsible
            title="Nevezések"
            :active="isUrl('admin/entries/meet*')"
            v-show="isAdmin()"
        >
            <SidebarCollapsibleItem :href="route('admin:entries.meet.index')" title="Versenyek" :active="route().current('admin:entries.meet.index') || route().current('admin:entries.meet.edit') || route().current('admin:entries.meet.show')" />
        </SidebarCollapsible>

        <SidebarCollapsible
            title="Versenyek"
            :active="isUrl('admin/meets*')"
            v-show="isAdmin()"
        >
            <template #icon>
                <CalendarIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem :href="route('admin:meets.create')" title="Új verseny" :active="route().current('admin:meets.create')" />
            <SidebarCollapsibleItem :href="route('admin:meets.index')" title="Összes" :active="route().current('admin:meets.index') || route().current('admin:meets.edit')" />
        </SidebarCollapsible>

        <SidebarCollapsible
            title="Helyszínek"
            :active="isUrl('admin/locations*')"
            v-show="isAdmin()"
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

        <SidebarCollapsible
            title="Kapcsolattartók"
            :active="isUrl('admin/contacts*')"
            v-show="isAdmin()"
        >
            <template #icon>
                <AtSymbolIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem :href="route('admin:contacts.create')" title="Új kapcsolat" :active="route().current('admin:contacts.create')" />
            <SidebarCollapsibleItem :href="route('admin:contacts.index')" title="Összes" :active="route().current('admin:contacts.index') || route().current('admin:contacts.edit')" />
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
import { UserGroupIcon, LocationMarkerIcon, AtSymbolIcon, CalendarIcon, HomeIcon, UsersIcon } from '@heroicons/vue/outline'
import SidebarCollapsible from '@/Pages/Portal/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Pages/Portal/Sidebar/SidebarCollapsibleItem.vue'

export default {
    components: {
        PerfrectScrollbar,
        SidebarLink,
        SidebarCollapsible,
        SidebarCollapsibleItem,
        //Icons
        HomeIcon,
        UserGroupIcon,
        LocationMarkerIcon,
        AtSymbolIcon,
        CalendarIcon,
        UsersIcon
    },

    methods: {
        isAdmin() {
            return this.$page.props.user.role === 'admin' //TODO nicer
        }
    }
}
</script>
