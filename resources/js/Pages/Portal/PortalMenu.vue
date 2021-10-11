<template>
    <div>
        <div class="flex flex-col flex-1 mt-4 justify-between space-y-4 mx-2">

            <inertia-link :class="getDashboardClass('portal$')" :href="route('portal:dashboard')">
                <icon name="dashboard" class="w-4 h-4 mr-4 group" />
                <div :class="isUrl('portal$') ? '' : 'group-hover:text-blue-900'">Kezdőlap</div>
            </inertia-link>

            <admin-menu v-if="$page.props.user.role === 'admin'" />

            <!-- <hr class="my-6" />-->
        </div>
    </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import AdminMenu from "@/Pages/Admin/AdminMenu";

export default {
    components: {
        Icon,
        AdminMenu
    },
    methods: {
        getDashboardClass(urls) {
            return this.isUrl(urls) ? 'dashboard-link-active' : 'dashboard-link';
        },
    }
}
</script>
