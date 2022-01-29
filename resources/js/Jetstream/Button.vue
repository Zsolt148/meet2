<template>
    <component :is="Tag" v-if="href" :href="!disabled ? href : null" :class="classes" :aria-disabled="disabled.toString()">
        <span v-if="srText" class="sr-only">{{ srText }}</span>
        <slot :iconSizeClasses="iconSizeClasses" />
    </component>
    <button v-else :type="type" :class="classes" @click="handleClick" :disabled="disabled || loading">
        <div v-if="loading" class="btn-spinner mr-2" />
        <span class="sr-only">{{ srText }}</span>
        <slot :iconSizeClasses="iconSizeClasses" />
    </button>
</template>

<script>
import { toRefs, computed } from 'vue'
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: {
        variant: {
            type: String,
            default: 'primary',
            validator(value) {
                return ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'black'].includes(value)
            },
        },
        type: {
            type: String,
            default: 'submit',
        },
        size: {
            type: String,
            default: 'base',
            validator(value) {
                return ['sm', 'base', 'lg'].includes(value)
            },
        },
        squared: {
            type: Boolean,
            default: false,
        },
        pill: {
            type: Boolean,
            default: false,
        },
        href: {
            type: String,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        iconOnly: {
            type: Boolean,
            default: false,
        },
        srText: {
            type: String || undefined,
            default: undefined,
        },
        external: {
            type: Boolean,
            default: false,
        },
        loading: {
            type: Boolean || undefined,
            default: false,
        },
    },

    emits: ['click'],

    setup(props, { emit }) {
        const { type, variant, size, squared, pill, href, iconOnly, srText, external } = props

        const { disabled } = toRefs(props)

        const baseClasses = [
            'inline-flex items-center font-medium select-none tracking-widest shadow-lg transition' +
            ' disabled:opacity-50 disabled:cursor-not-allowed ' +
            'focus:outline-none focus:ring focus:ring-offset-1 focus:ring-opacity-50 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2',
        ]

        const variantClasses = (variant) => ({
            'bg-teal-400 text-white hover:bg-teal-500 focus:ring-teal-500 dark:focus:ring-teal-400 dark:bg-teal-500 dark:hover:bg-teal-400 shadow-teal-400/30 hover:shadow-teal-500/50 dark:shadow-teal-500/30 dark:hover:shadow-teal-400/30':
                variant == 'primary',
            'bg-white dark:bg-dark-eval-1 border border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-300 hover:text-teal-400 dark:hover:text-teal-500 focus:outline-none focus:ring-white dark:focus:ring-dark-eval-1':
                variant == 'secondary',
            'bg-green-500 text-white hover:bg-green-600 focus:ring-green-500':
                variant == 'success',
            'bg-red-500 text-white hover:bg-red-600 focus:ring-red-500 shadow-red-500/30':
                variant == 'danger',
            'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-500':
                variant == 'warning',
            'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500':
                variant == 'info',
            'bg-black text-gray-300 hover:text-white hover:bg-gray-800 focus:ring-black dark:hover:bg-dark-eval-3':
                variant == 'black',
        })

        const classes = computed(() => [
            ...baseClasses,
            iconOnly
                ? {
                    'p-1.5': size == 'sm',
                    'p-2': size == 'base',
                    'p-3': size == 'lg',
                    'border-none shadow-none' : true,
                }
                : {
                    'px-2.5 py-1.5 text-sm': size == 'sm',
                    'px-4 py-2 text-sm': size == 'base',
                    'px-5 py-2 text-base': size == 'lg',
                },
            variantClasses(variant),
            {
                'rounded-lg': !squared && !pill,
                'rounded-full': pill,
            },
            {
                'pointer-events-none opacity-50': href && disabled.value,
            },
        ])

        const iconSizeClasses = [
            {
                'w-5 h-5': size == 'sm',
                'w-6 h-6': size == 'base',
                'w-7 h-7': size == 'lg',
            },
        ]

        const handleClick = (e) => {
            if (disabled.value) {
                e.preventDefault()
                e.stopPropagation()
                return
            }
            emit('click')
        }

        const Tag = external ? 'a' : Link

        return {
            classes,
            handleClick,
            Tag,
            iconSizeClasses,
        }
    }
}
</script>
