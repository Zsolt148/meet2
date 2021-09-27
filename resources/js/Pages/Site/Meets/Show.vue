<template>
    <app-layout>
        <template #header>
            <div class="pb-8">
                <inertia-link class="text-green-light" :href="route('meets.index')">{{ __('Meets') }}</inertia-link>
                /
                asdas
            </div>
        </template>
        <div class="max-w-7xl mx-auto py-8 px-0 xl:px-2">
            <div class="bg-white dark:bg-gray-600 -mt-16 shadow p-5 rounded-md">
                <h1 class="text-green dark:text-green-light text-3xl">Lorem ipsum</h1>
                <article class="my-5 prose max-w-none text-black dark:text-white">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget euismod arcu. Maecenas non semper dolor, quis placerat neque. In urna dui, fermentum non viverra ac, cursus eu erat. Quisque elementum enim ut dolor placerat commodo. Curabitur est justo, porttitor sit amet enim at, rhoncus hendrerit tellus. Suspendisse potenti. Donec auctor eu dolor eu placerat. Curabitur hendrerit massa et blandit faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vitae risus augue. Nunc eleifend augue non urna porttitor, aliquet dignissim justo porta. Nam molestie ipsum non eros tempus tincidunt.
                    <br>
                    Vivamus quis suscipit dolor. Suspendisse non nunc diam. Nullam commodo vehicula erat, ac porttitor nisi varius ut. Integer egestas turpis sit amet risus eleifend, quis fermentum lorem vestibulum. Curabitur ligula velit, tristique a ultricies tempus, placerat sed nisl. Morbi at leo luctus, vulputate tellus sed, eleifend turpis. Integer pharetra ipsum vitae ipsum placerat, sed pretium enim accumsan. Integer suscipit augue in leo volutpat eleifend. Cras vitae suscipit magna, vel auctor quam. Vestibulum a libero at nisi cursus eleifend. Aenean vehicula turpis sed venenatis iaculis. Nulla vestibulum cursus neque quis vestibulum. Mauris vel lectus sodales ex ornare cursus. Donec vel risus sed enim congue interdum.
                    <br>
                    Nullam tempor velit ante, id dapibus mi sollicitudin a. Mauris at justo vitae risus lobortis dignissim at at metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam vulputate elit erat, eget ultrices sapien lobortis et. Phasellus dolor augue, elementum sit amet metus vitae, dapibus maximus orci. Aliquam tincidunt lobortis consectetur. Nunc vitae nulla at felis vehicula pretium. Ut laoreet ex ipsum, nec egestas diam lacinia luctus. Nunc nec elit ut leo molestie sollicitudin. Sed tincidunt, sem id maximus pharetra, tortor magna condimentum lectus, sed aliquet magna dolor nec quam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus mauris sapien, suscipit et erat eget, venenatis sodales enim. Nulla lobortis aliquam augue eu tincidunt.
                    <br>
                    Nam maximus nunc id ante tristique viverra. In lacinia nibh sed ante porttitor egestas. Ut vel bibendum risus. Nulla tortor orci, fermentum non vulputate eget, viverra non neque. Integer feugiat imperdiet augue vel varius. Aenean aliquam semper lacus vel iaculis. Integer tincidunt tortor ut nibh eleifend accumsan. Sed non hendrerit magna, eu accumsan nulla. Nulla rhoncus tellus eget velit luctus venenatis. Vivamus gravida et tortor id ullamcorper. Mauris finibus purus at lacus vehicula, ut fermentum augue pellentesque. Aliquam euismod tincidunt mi, sed iaculis nulla imperdiet eget. Morbi in semper metus, at malesuada purus. Interdum et malesuada fames ac ante ipsum primis in faucibus.
                    <br>
                    Pellentesque tempor elit quis erat finibus accumsan. Nunc aliquam erat quis magna finibus, sed semper elit dapibus. Donec nec lacus faucibus, tempor nibh ut, sollicitudin lorem. Nam pulvinar felis in augue tempus tristique. Sed vehicula faucibus cursus. Nunc vitae pharetra neque. Pellentesque lacinia venenatis est, sit amet congue nulla. Sed finibus, mauris in condimentum scelerisque, sapien sapien condimentum libero, vitae vulputate mauris justo in sapien. In interdum massa nec hendrerit congue. Cras imperdiet, dui vel dictum mattis, enim augue sagittis elit, sed mattis leo tellus ac urna. Nullam eleifend lorem id sollicitudin varius. Aliquam bibendum quis arcu id gravida. Fusce blandit at mauris id porta. Quisque blandit leo at ligula convallis, non elementum justo molestie. Aliquam accumsan finibus erat vel interdum. Fusce tempor odio sed nibh lacinia, ut condimentum nulla scelerisque.
                </article>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
name: "Show",
    components: {AppLayout}
}
</script>

<style scoped>

</style>