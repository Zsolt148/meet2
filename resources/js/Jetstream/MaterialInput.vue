
<template>
    <div class="mt-10 relative">
        <input :value="modelValue" :id="id" :name="name" :placeholder="name" @input="$emit('update:modelValue', $event.target.value)"
               class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-green" />
        <label :for="id"
               class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
            {{ name }}
        </label>
    </div>
</template>

<script>
export default {
    props: ['modelValue', 'id', 'name', 'type'],

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>