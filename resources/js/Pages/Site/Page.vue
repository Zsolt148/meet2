<template>
    <app-layout>
        <template #header>
            {{ content.name }}
        </template>
        <div class="bg-white dark:bg-gray-800 shadow-md p-5 rounded-md">
            <article class="my-5 prose max-w-none dark:text-white" id="body" v-html="content.body"/>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    components: {
        AppLayout
    },
    props: {
        content: Object,
    }
}
</script>
