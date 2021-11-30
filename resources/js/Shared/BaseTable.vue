<template>
    <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
            <slot name="head" />
        </tr>
        <slot name="body" />
    </table>
</template>

<script>
export default {
    name: "BaseTable",
}
</script>