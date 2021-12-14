<template>
    <Head :title="__('Dashboard')" />

    <portal-layout>
        <div class="mx-auto my-5">
            <div class="p-5 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 text-xl">
                Üdv, {{ $page.props.user.name }}!
            </div>
        </div>
    </portal-layout>
</template>

<script>
import { ref, watch } from 'vue'
import PortalLayout from "@/Layouts/PortalLayout";

export default {
    components: {
        PortalLayout
    },
    setup() {
        const people = [
            {id: 1, name: 'Durward Reynolds', unavailable: false},
            {id: 2, name: 'Kenton Towne', unavailable: false},
            {id: 3, name: 'Therese Wunsch', unavailable: false},
            {id: 4, name: 'Benedict Kessler', unavailable: true},
            {id: 5, name: 'Katelyn Rohan', unavailable: false},
        ]

        const selectedPerson = ref(people[0]);

        const enabled = ref(false);

        watch(selectedPerson, function () {
            console.log(selectedPerson.value);
        })

        watch(enabled, function () {
            console.log(enabled.value);
            return enabled.value;
        })

        return {
            people,
            selectedPerson,
            enabled,
        }
    },
}
</script>
