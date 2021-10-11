<template>
    <div class="mb-6 flex w-full justify-between items-center">
        <input class="relative w-full px-4 py-1 rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-600 mr-2 placeholder-gray-400 dark:placeholder-gray-200 focus:placeholder-green-light"
               autocomplete="off" type="text" name="search" :placeholder="__('Search')"
               @input="search"
               v-model="searchTerm"
               />
        <jet-secondary-button @click="reset" class="mt-1">
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
