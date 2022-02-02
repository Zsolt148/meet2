<template>
    <Head :title="__('Dashboard')" />

    <portal-layout>
        <div class="mx-auto my-5">
            <div class="p-5 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 text-xl">
                Üdvözüljök a portálon, {{ $page.props.user.name }}!
            </div>
        </div>
    </portal-layout>
</template>

<script>
import { ref, watch } from 'vue'
import PortalLayout from "@/Layouts/PortalLayout";

export default {
    components: {
        PortalLayout
    },
    setup() {

    }
}
</script>
