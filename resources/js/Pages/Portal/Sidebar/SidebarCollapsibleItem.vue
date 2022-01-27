<template>
    <li
        :class="[
            'relative leading-8 m-0 pl-6',
            'before:block before:w-4 before:h-0 before:absolute before:left-0 before:top-4 before:border-t-2 before:border-t-gray-200 before:-mt-0.5',
            'last:before:bg-white last:before:h-auto last:before:top-4 last:before:bottom-0',
            'dark:last:before:bg-dark-eval-1 dark:before:border-t-gray-600',
        ]"
    >
        <Link
            :href="href"
            v-bind="$attrs"
            :class="[
                'transition-colors hover:text-teal-500 dark:hover:text-teal-400',
                {
                    'text-teal-500 dark:text-teal-400': active,
                    'text-gray-700 dark:text-gray-200': !active,
                },
            ]"
        >
            {{ title }}
        </Link>
    </li>
</template>

<script>
export default {
    props: {
        href: String,
        title: String,
        active: {
            type: Boolean,
            default: false,
        },
    },
}
</script>
