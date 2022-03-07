<template>
    <div class="mb-6 flex w-full justify-between items-center">
        <input class="relative w-full px-4 py-1 rounded-md border-gray-300 dark:border-gray-600 mr-2"
               autocomplete="off" type="text" name="search" :placeholder="__('Search')"
               @input="search"
               v-model="searchTerm"
               />
        <select v-show="selectValues" name="year" id="year" v-model="selectValue" @change="select" class="block rounded-md border-gray-300 py-1 w-1/5 focus:outline-none mr-2">
            <option value="">-</option>
            <option v-for="value in selectValues" :key="value" :value="value">{{value}}</option>
        </select>
        <slot></slot>
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
    props: {
        searchTerm: {
            default: null
        },
        selectValue: {
            type: String,
            default: null
        },
        selectValues: {
            type: Array,
            default: null
        }
    },
    emits: ['search', 'select'],
    setup(props, { emit }) {

        const searchTerm = ref(props.searchTerm);
        const selectValue = ref(props.selectValue);

        function search() {
            emit('search', searchTerm.value);
        }

        function select() {
            emit('select', selectValue.value);
        }

        function reset() {
            searchTerm.value = '';
            selectValue.value = null;
        }

        return {
            searchTerm,
            selectValue,
            search,
            select,
            reset,
        }
    },
};
</script>
