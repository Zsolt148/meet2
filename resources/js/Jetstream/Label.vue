<template>
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-200">
        <span v-if="value">{{ __(value) }}</span>
        <span v-else><slot></slot></span>
    </label>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
