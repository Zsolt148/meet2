<template>
    <app-layout>
        <Head>
            <title>{{ meet.name }}</title>
            <meta head-key="description" name="description" content="Meets" />
        </Head>

        <template #header>
            <div class="pb-8">
                <Link class="text-green-light" :href="route('meets.index')">{{__('Meets')}}</Link>
                /
                {{ meet.name }}
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-8 px-0 xl:px-2">
            <div class="bg-white dark:bg-gray-600 -mt-16 shadow p-5 rounded-md">
                <div class="flex flex-col sm:flex-row justify-between">
                    <h1 class="text-green dark:text-green-light text-3xl">{{ meet.name }}</h1>
                    <div class="flex items-center mt-3 sm:mt-0 font-semibold text-green dark:text-green-light">
                        <icon name="calendar" class="w-4 h-4 mr-2" />
                        <span>{{ meet.date }}</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 dark:text-gray-200 w-full mb-5">
                    <div class="flex" v-if="meet.location">
                        <icon name="location-arrow" class="w-5 h-5 sm:w-4 sm:h-4 mt-1 mr-3 sm:mr-2" />
                        <span>{{meet.location.city}}, {{meet.location.name}} <span v-if="meet.location.address">- {{meet.location.address}}</span></span>
                    </div>
                    <div class="flex" v-if="meet.type">
                        <icon name="swimmer" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{meet.type}}</span>
                    </div>
                    <div class="flex" v-if="meet.host">
                        <icon name="pool" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{meet.host}} M - {{meet.host}} időmérés</span>
                    </div>
                </div>

                <article class="my-5 prose max-w-none">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget euismod arcu. Maecenas non
                    semper dolor, quis placerat neque. In urna dui, fermentum non viverra ac, cursus eu erat. Quisque
                    elementum enim ut dolor placerat commodo. Curabitur est justo, porttitor sit amet enim at, rhoncus
                    hendrerit tellus. Suspendisse potenti. Donec auctor eu dolor eu placerat. Curabitur hendrerit massa
                    et blandit faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vitae risus
                    augue. Nunc eleifend augue non urna porttitor, aliquet dignissim justo porta. Nam molestie ipsum non
                    eros tempus tincidunt.
                </article>

                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-4">
                    <div class="w-full sm:w-1/3">
                        <jet-label for="type" value="Típus"/>
                        <select name="type" id="type" v-model="type.data">
                            <option value="null" selected>Válassz</option>
                            <option value="startlist">Rajtlista</option>
                            <option value="results">Nevezés</option>
                        </select>
                    </div>

                    <div class="w-full sm:w-1/3" v-if="sections.loading">
                        <jet-label value="Szakasz"/>
                        <div class="bg-gray-300 dark:bg-gray-700 h-10 animate-pulse rounded-md mt-1"></div>
                    </div>
                    <div class="w-full sm:w-1/3" v-else-if="!sections.loading">
                        <jet-label for="section" value="Szakasz"/>
                        <select name="section" id="section" v-model="sections.selected">
                            <option value="null" selected>Válassz</option>
                            <option value="startlist">Összes</option>
                            <option v-for="(section, key) in sections.data" :key="key" :value="section.id">{{ section.name }}</option>
                        </select>
                    </div>

                    <div class="w-full sm:w-1/3" v-if="events.loading">
                        <jet-label value="Versenyszám"/>
                        <div class="bg-gray-300 dark:bg-gray-700 h-10 animate-pulse rounded-md mt-1"></div>
                    </div>
                    <div class="w-full sm:w-1/3" v-else-if="!events.loading">
                        <jet-label for="event" value="Versenyszám"/>
                        <select name="event" id="event" v-model="events.selected">
                            <option value="null" selected>Válassz</option>
                            <option v-for="(event, key) in events.data" :key="key" :value="event.file">{{ event.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="w-full my-8 flex justify-center">
                    <article class="prose max-w-none overflow-x-auto text-center" v-html="fileContent.data" v-if="!fileContent.loading" />
                    <div v-else-if="fileContent.loading" class="select-none max-w-2xl w-full">
                        <div class="bg-gray-200 dark:bg-gray-700 animate-pulse h-8 rounded-2xl"></div>
                        <div class="flex flex-1 flex-col gap-8 pt-8 sm:pt-10">
                            <div class="flex gap-6" v-for="index in 10" :key="index">
                                <div class="bg-gray-200 dark:bg-gray-700 w-full h-6 animate-pulse rounded-2xl"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 w-24 h-6 animate-pulse rounded-2xl"></div>
                                <div class="bg-gray-200 dark:bg-gray-700 w-24 h-6 animate-pulse rounded-2xl"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetLabel from '@/Jetstream/Label'
import {ref, reactive, watch} from 'vue';
import Icon from "@/Shared/Icon";

export default {
    components: {
        AppLayout,
        JetLabel,
        Icon,
    },
    props: ['meet'],
    setup(props) {
        const type = reactive({
            data: null,
        });

        const sections = reactive({
            data: null,
            selected: null,
            loading: false,
        });

        const events = reactive({
            data: null,
            selected: null,
            loading: false,
        });

        const fileContent = reactive({
            data: null,
            loading: false,
        });

        // FIRST SELECT
        watch(
            () => type.data,
            async () => {
                sections.loading = true;
                await axios
                    .get(route('api:meet.contents', {
                            meetId: props.meet.id,
                            method: 'getSectionsGroupBy'
                        })
                    )
                    .then(resp => {
                        sections.data = resp.data;
                        sections.selected = null;
                        events.selected = null;
                        fileContent.data = null;
                    }).catch(err => {
                        console.error(err);
                    });

                sections.loading = false;
            }
        );

        // SECOND SELECT
        watch(
            () => sections.selected,
            async (value) => {

                if (value == null || value == 'null') {
                    events.selected = null;
                    return;
                }

                events.loading = true;
                await axios
                    .get(route('api:meet.contents', {
                            meetId: props.meet.id,
                            method: (value == 'startlist') ? 'getStartlist' : 'getSections',
                            param: value
                        })
                    ).then(resp => {
                        events.data = resp.data;
                        events.selected = (Array.isArray(resp.data)) ? resp.data[0].file : null;
                    }).catch(err => {
                        console.error(err);
                    });

                events.loading = false;
            }
        );

        // THIRD SELECT
        watch(
            () => events.selected,
            async (value) => {

                if (value == null || value == 'null') {
                    events.selected = null;
                    return;
                }

                fileContent.loading = true;
                await axios
                    .get(route('api:meet.contents', {
                            meetId: props.meet.id,
                            method: 'getFileContent',
                            param: value
                        })
                    ).then(resp => {
                        fileContent.data = resp.data;
                    }).catch(err => {
                        console.error(err);
                    });
                fileContent.loading = false;
            }
        );

        return {
            type,
            sections,
            events,
            fileContent,
        }
    }
}
</script>

<style scoped>

</style>