<template>
    <div>
        <button type="submit" class="w-full" :class="style" v-if="as == 'button'">
            <slot></slot>
        </button>

        <a :href="href" :class="style" v-else-if="as =='a'">
            <slot></slot>
        </a>

        <Link :href="href" :class="style" :method="method ? method : 'get'" v-else>
            <slot></slot>
        </Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: ['href', 'as', 'method'],
    components: {
        Link
    },

    data() {
        return {
            style: 'block px-4 py-2 text-sm leading-5 text-black hover:bg-green hover:bg-opacity-30 dark:text-white focus:outline-none transition'
        }
    }
}
</script>
