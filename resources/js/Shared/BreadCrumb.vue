<template>
    <h1 class="mb-8 font-bold text-2xl">
        <Link class="text-green dark:text-green-light hover:text-green-light dark:hover:text-green" :href="backRoute">{{ backName }}</Link>
        <span class="font-medium pl-1">/</span>
        {{ current }}
    </h1>
</template>

<script>
export default {
    props: ['backRoute', 'backName', 'current'],
}
</script>

<style scoped>

</style>