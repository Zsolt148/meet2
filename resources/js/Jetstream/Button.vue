<template>
    <button :type="type" class="inline-flex items-center text-sm px-4 py-2 bg-main dark:bg-main-light border border-transparent rounded-md font-semibold text-white dark:hover:text-white uppercase tracking-widest hover:bg-green dark:hover:bg-green active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
