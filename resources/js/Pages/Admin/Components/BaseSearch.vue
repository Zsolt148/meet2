<template>
    <div class="mb-6 flex w-full justify-between items-center">
        <input class="relative w-full px-4 py-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 mr-2 bg-white"
               autocomplete="off" type="text" name="search" :placeholder="__('Search')"
               @input="search"
               v-model="searchTerm"
               />
        <jet-secondary-button @click="reset">
            {{ __('Delete') }}
        </jet-secondary-button>
    </div>
</template>

<script>
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import { ref } from 'vue';

export default {
    components: {
        JetSecondaryButton,
    },
    props: ['searchTerm'],
    emits: ['search'],
    setup(props, { emit }) {

        const searchTerm = ref(props.searchTerm);

        function search() {
            emit('search', searchTerm.value);
        }

        function reset() {
            searchTerm.value = '';
        }

        return {
            searchTerm,
            search,
            reset,
        }
    },
};
</script>
