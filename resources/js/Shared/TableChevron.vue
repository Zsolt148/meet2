<template>
    <ChevronDownIcon class="w-5 h-5" v-if="params && params.field.value === value && params.direction.value === 'asc'" />
    <ChevronUpIcon class="w-5 h-5" v-if="params && params.field.value === value && params.direction.value === 'desc'" />
</template>

<script>
import { ChevronDownIcon, ChevronUpIcon } from '@heroicons/vue/outline'

export default {
    props: ['params', 'value'],
    components: {
        ChevronDownIcon,
        ChevronUpIcon,
    }
}
</script>