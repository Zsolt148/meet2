<template>
    <h1 class="mb-8 font-bold text-2xl">
        <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="backRoute">{{ backName }}</Link>
        <span class="font-medium pl-1">/</span>
        {{ current }}
        <slot></slot>
    </h1>
</template>

<script>
export default {
    props: ['backRoute', 'backName', 'current'],
}
</script>

<style scoped>

</style>