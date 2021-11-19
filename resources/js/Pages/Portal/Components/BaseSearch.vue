<template>
    <div class="mb-6 flex w-full justify-between items-center">
        <input class="relative w-full px-4 py-1 rounded-md border-gray-300 dark:border-gray-600 mr-2 placeholder-gray-400 dark:placeholder-gray-200 focus:placeholder-green-light"
               autocomplete="off" type="text" name="search" :placeholder="__('Search')"
               @input="search"
               v-model="searchTerm"
               />
        <jet-button variant="secondary" type="button" size="sm" @click="reset" class="mt-1">
            {{ __('Delete') }}
        </jet-button>
    </div>
</template>

<script>
import JetButton from '@/Jetstream/Button';
import { ref } from 'vue';

export default {
    components: {
        JetButton,
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
