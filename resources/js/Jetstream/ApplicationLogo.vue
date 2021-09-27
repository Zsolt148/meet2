<template>
    <inertia-link :href="route('home')">
        <span class="font-extrabold tracking-widest text-2xl" :class="classes">meet.kvsc.info</span>
    </inertia-link>
</template>

<script>
export default {
    props: [
        'classes'
    ]
}
</script>