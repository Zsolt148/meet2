<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link) in links">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border border-gray-300 dark:border-gray-700 rounded" v-html="link.label" />
                <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm text-black dark:text-white leading-4 border hover:border-teal-400 dark:hover:border-teal-500 rounded hover:bg-white dark:hover:text-teal-500"
                              :class="{
                                'bg-white dark:bg-dark-eval-3 text-teal-500 dark:text-teal-400 border-teal-400 dark:border-teal-500': link.active,
                                'bg-white dark:bg-dark-eval-3 text-teal-500 dark:text-teal-400 border-gray-300 dark:border-gray-700': !link.active,
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
