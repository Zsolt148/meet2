<template>
    <app-layout>
        <template #header>
            <div class="pb-8">
                <inertia-link class="text-green-light" :href="route('meets.index')">{{__('Meets')}}</inertia-link>
                /
                asdas
            </div>
        </template>
        <div class="max-w-7xl mx-auto py-8 px-0 xl:px-2">
            <div class="bg-white dark:bg-gray-600 -mt-16 shadow p-5 rounded-md">
                <h1 class="text-green dark:text-green-light text-3xl">Lorem ipsum</h1>

                <div class="w-1/3">
                    <jet-label for="type" value="Típus"/>
                    <select name="type" id="type" v-model="type">
                        <option value="null" selected>Válassz</option>
                        <option value="startlist">Rajtlista</option>
                        <option value="results">Nevezes</option>
                    </select>
                </div>

                <article class="my-5 prose max-w-none text-black dark:text-white">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget euismod arcu. Maecenas non
                    semper dolor, quis placerat neque. In urna dui, fermentum non viverra ac, cursus eu erat. Quisque
                    elementum enim ut dolor placerat commodo. Curabitur est justo, porttitor sit amet enim at, rhoncus
                    hendrerit tellus. Suspendisse potenti. Donec auctor eu dolor eu placerat. Curabitur hendrerit massa
                    et blandit faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vitae risus
                    augue. Nunc eleifend augue non urna porttitor, aliquet dignissim justo porta. Nam molestie ipsum non
                    eros tempus tincidunt.
                    <br><br>
                    Vivamus quis suscipit dolor. Suspendisse non nunc diam. Nullam commodo vehicula erat, ac porttitor
                    nisi varius ut. Integer egestas turpis sit amet risus eleifend, quis fermentum lorem vestibulum.
                    Curabitur ligula velit, tristique a ultricies tempus, placerat sed nisl. Morbi at leo luctus,
                    vulputate tellus sed, eleifend turpis. Integer pharetra ipsum vitae ipsum placerat, sed pretium enim
                    accumsan. Integer suscipit augue in leo volutpat eleifend. Cras vitae suscipit magna, vel auctor
                    quam. Vestibulum a libero at nisi cursus eleifend. Aenean vehicula turpis sed venenatis iaculis.
                    Nulla vestibulum cursus neque quis vestibulum. Mauris vel lectus sodales ex ornare cursus. Donec vel
                    risus sed enim congue interdum.
                </article>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetLabel from '@/Jetstream/Label'
import {ref, watch} from 'vue';

export default {
    components: {
        AppLayout,
        JetLabel,
    },
    setup() {
        const type = ref(null);

        watch(type, async () => {
            let response = await axios.get('/api/test');
            console.log(response.data);
        })

        return {
            type,
        }
    }
}
</script>

<style scoped>

</style>