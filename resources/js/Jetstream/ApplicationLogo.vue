<template>
    <Link :href="route('home')">
        <span class="font-extrabold tracking-widest text-2xl" :class="classes">meet.kvsc.info</span>
    </Link>
</template>

<script>
export default {
    props: [
        'classes'
    ]
}
</script>