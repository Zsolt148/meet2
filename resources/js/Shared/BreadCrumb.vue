<template>
    <h1 class="mb-8 font-bold text-3xl">
        <inertia-link class="text-green dark:text-green-light hover:underline" :href="backRoute">{{ backName }}</inertia-link>
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