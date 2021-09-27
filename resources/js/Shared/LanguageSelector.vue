<template>
    <div class="inline-flex items-center pl-2">
        <inertia-link :href="route('language', selectable_locale)">
            <icon class="w-5 h-5" :name="selectable_locale" />
        </inertia-link>
    </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default {
    name: "LanguageSelector",
    components: {
        Icon,
    },

    computed: {
        selectable_locale() {
            if(this.$page.props.locale == 'en') {
                return 'hu';
            }
            return 'en';
        }
    },
}
</script>