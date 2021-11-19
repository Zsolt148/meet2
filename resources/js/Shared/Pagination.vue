<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link) in links">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border border-opacity-50 rounded" v-html="link.label" />
                <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm text-black dark:text-white leading-4 border hover:border-green dark:hover:border-green-light rounded hover:bg-white dark:hover:text-green-light"
                              :class="{
                                'bg-white dark:bg-dark-eval-3 text-green dark:text-green-light border-green dark:border-green-light': link.active,
                                'bg-white dark:bg-dark-eval-3 text-green dark:text-green-light border-gray-300 dark:border-gray-700': !link.active,
                                }"
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
