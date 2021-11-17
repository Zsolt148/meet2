<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link) in links">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border border-opacity-50 rounded" v-html="link.label" />
                <inertia-link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-opacity-50 hover:border-green dark:hover:border-green-light rounded hover:bg-white dark:hover:bg-jet dark:hover:text-green-light"
                              :class="{ 'bg-white dark:bg-jet text-green dark:text-green-light border-green dark:border-green-light border-opacity-100': link.active }"
                              :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        links: Array,
    },
}
</script>
