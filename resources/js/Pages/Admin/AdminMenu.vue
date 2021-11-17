<template>
     <hr class="my-6 mx-1" />

    <inertia-link :class="getDashboardClass('admin/users*')" :href="route('admin:users.index')">
        <icon name="users" class="w-4 h-4 mr-4 group" />
        <div>Felhasználók</div>
    </inertia-link>
</template>

<script>
import Icon from '@/Shared/Icon';

export default {
    components: {
        Icon,
    },
    methods: {
        getDashboardClass(urls) {
            return this.isUrl(urls) ? 'dashboard-link-active' : 'dashboard-link';
        },
    }
}
</script>