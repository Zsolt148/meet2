<template>
    <button v-show="visible" class="focus:outline-none" @click="scrollTop">
        <div class="fixed bottom-5 right-2 lg:right-4 p-3 bg-white text-teal-500 dark:bg-gray-500 dark:text-teal-400 shadow-lg rounded-full flex justify-center">
            <ArrowUpIcon class="w-5 h-5" />
        </div>
    </button>
</template>

<script>
import { ArrowUpIcon } from '@heroicons/vue/outline'

export default {
    components: {
        ArrowUpIcon
    },
    data () {
        return {
            visible: false
        }
    },
    methods: {
        scrollTop: function () {
            window.scroll({
                top: 0,
                left: 0,
                behavior: 'smooth'
            })
        },
        scrollListener: function (e) {
            this.visible = window.scrollY > 150
        }
    },
    mounted: function () {
        window.addEventListener('scroll', this.scrollListener)
    },
    beforeDestroy: function () {
        window.removeEventListener('scroll', this.scrollListener)
    }
}
</script>

<style scoped>
.bottom-right {
    position: fixed;
    bottom: 20px;
    right: 20px;
    cursor: pointer;
}
</style>