<template>
    <div class="mb-6 flex w-full justify-between items-center">
        <input class="relative w-full px-4 py-1 rounded-md border-gray-300 mr-2" :class="inputClass"
               autocomplete="off" type="text" name="search" :placeholder="__(searchPlaceholder)"
               @input="search"
               v-model="searchTerm"
               />
        <select v-show="selectValues" name="year" id="year" v-model="selectValue" @change="select" class="block rounded-md border-gray-300 py-1 w-1/5 focus:outline-none mr-2">
            <option value="">-</option>
            <option v-for="value in selectValues" :key="value" :value="value">{{value}}</option>
        </select>
        <slot></slot>
        <div :class="inputClass ?? 'mt-1'">
            <jet-button variant="secondary" type="button" size="sm" @click="reset">
                {{ __('Delete') }}
            </jet-button>
        </div>
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
        searchPlaceholder: {
            type: String,
            default: 'Search',
        },
        selectValue: {
            type: String,
            default: null
        },
        selectValues: {
            type: Array,
            default: null
        },
        inputClass: {
            type: String,
            default: null
        },
    },
    emits: ['search', 'select', 'reset'],
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
            emit('reset');
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
