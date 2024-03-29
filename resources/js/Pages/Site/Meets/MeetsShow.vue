<template>
    <app-layout>
        <Head>
            <title>{{ meet.name }}</title>
            <meta head-key="description" name="description" :content="meet.name" />
        </Head>

        <template #header>
            <div class="pb-8 flex flex-wrap justify-between">
                <div class="mb-2">
                    <Link class="text-teal-400" :href="route('meets.index')">{{__('Meets')}}</Link>
                    /
                    {{ meet.name }}
                </div>
                <div class="flex flex-col md:flex-row space-x-0 space-y-2 md:space-x-2 md:space-y-0" v-show="isEntriable || hasEntries || isAdmin()">
                    <div>
                        <jet-button size="sm" :href="route('portal:meets.show', meet)" v-show="isEntriable">
                            <StatusOnlineIcon class="w-5 h-5 mr-2 animate-pulse" />
                            <!--                        <span class="animate-ping block h-3 w-3 rounded-full opacity-75 ring-green-400 bg-green-600 mr-2"></span>-->
                            <span>
                             {{ __('Entry') }}
                        </span>
                        </jet-button>
                    </div>
                    <div>
                        <jet-button size="sm" :href="route('meets.entries.index', meet)" v-show="hasEntries">
                            <ViewListIcon class="w-5 h-5 mr-2" />
                            {{ __('Entries') }}
                        </jet-button>
                    </div>
                    <div>
                        <jet-button size="sm" :href="route('admin:meets.edit', meet)" v-show="isAdmin()">
                            <CogIcon class="w-5 h-5 mr-2" />
                            Szerkesztés
                        </jet-button>
                    </div>
                </div>
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-8 px-0 xl:px-2">
            <div class="bg-white dark:bg-gray-600 -mt-16 shadow p-5 rounded-md">
                <div class="flex flex-col sm:flex-row justify-between mb-2">
                    <h1 class="text-teal-500 dark:text-teal-400 text-3xl">
                        {{ meet.name }}
                    </h1>
                    <div class="flex items-center mt-3 sm:mt-0 font-semibold text-teal-500 dark:text-teal-400">
                        <icon name="calendar" class="w-4 h-4 mr-2" />
                        <span>{{ meet.date }}</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 dark:text-gray-200 w-full mb-5">
                    <div class="flex" v-if="meet.type">
                        <icon name="swimmer" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{meet.type}}</span>
                    </div>
                    <div class="flex" v-if="meet.contact">
                        <AtSymbolIcon class="w-5 h-5 mr-2" />
                        <span>{{meet.contact.name}} - {{meet.contact.email}}</span>
                    </div>
                    <div class="flex" v-if="meet.location">
                        <LocationMarkerIcon class="w-5 h-5 mr-2" />
                        <span>{{meet.location.city}} <span v-if="meet.location.address">- {{meet.location.address}}</span></span>
                    </div>
                    <div class="flex" v-if="meet.location">
                        <icon name="pool" class="w-5 h-5 mt-1 mr-2" />
                        <span>{{meet.location.pool}} M - {{meet.location.timing}}</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:space-x-6 text-gray-600 dark:text-gray-200 w-full mb-5" v-if="meet.raceInfo || meet.preStartlist || meet.raceRecord || meet.timeSchedule">
                    <div class="flex" v-if="meet.raceInfo">
                        <DocumentIcon class="w-5 h-5" />
                        <a class="ml-1 link" target="_blank" :href="meet.raceInfo.url">{{ __('Raceinfo') }}</a>
                    </div>
                    <div class="flex" v-if="meet.preStartlist">
                        <DocumentIcon class="w-5 h-5" />
                        <a class="ml-1 link" target="_blank" :href="meet.preStartlist.url">{{ __('Pre startlist') }}</a>
                    </div>
                    <div class="flex" v-if="meet.raceRecord">
                        <DocumentIcon class="w-5 h-5" />
                        <a class="ml-1 link" target="_blank" :href="meet.raceRecord.url">{{ __('Race record') }}</a>
                    </div>
                    <div class="flex" v-if="meet.timeSchedule">
                        <DocumentIcon class="w-5 h-5" />
                        <a class="ml-1 link" target="_blank" :href="meet.timeSchedule.url">{{ __('Time schedule') }}</a>
                    </div>
                </div>

                <article class="prose dark:prose-dark my-5 max-w-none" v-if="meet.latestNews && meet.latestNews.body" v-html="meet.latestNews.body" />

                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-4">
                    <div class="w-full sm:w-1/3">
                        <jet-label for="type" :value="__('Type')"/>
                        <select name="type" id="type" v-model="type.selected">
                            <option value="null" selected>{{ __('Choose') }}</option>
                            <option value="getStartlistSections">{{ __('Startlist') }}</option>
                            <option value="getResultSections">{{ __('Entries/Results') }}</option>
                            <option value="getTimeSchedule">{{ __('Time schedule') }}</option>
                            <option value="getSummary">{{ __('Summary') }}</option>
                        </select>
                    </div>

                    <div class="w-full sm:w-1/3" v-if="sections.loading">
                        <jet-label :value="__('Section')"/>
                        <div class="bg-gray-300 dark:bg-gray-700 h-10 animate-pulse rounded-md mt-1"></div>
                    </div>
                    <div class="w-full sm:w-1/3" v-else-if="!sections.loading && !sections.hidden">
                        <jet-label for="section" :value="__('Section')"/>
                        <select name="section" id="section" v-model="sections.selected">
                            <option value="null" selected>{{ __('Choose') }}</option>
                            <option v-for="(section, key) in sections.data" :key="key" :value="section.id">{{ __(section.name) }}</option>
                        </select>
                    </div>

                    <div class="w-full sm:w-1/3" v-if="events.loading && !events.hidden">
                        <jet-label :value="__('Event')"/>
                        <div class="bg-gray-300 dark:bg-gray-700 h-10 animate-pulse rounded-md mt-1"></div>
                    </div>
                    <div class="w-full sm:w-1/3" v-else-if="!events.loading && !events.hidden">
                        <jet-label for="event" :value="__('Event')"/>
                        <select name="event" id="event" v-model="events.selected">
                            <option value="null" selected>{{ __('Choose') }}</option>
                            <option v-for="(event, key) in events.data" :key="key" :value="event.id">{{ event.name }}</option>
                        </select>
                    </div>

<!--                    <div class="w-full sm:w-1/3" v-if="fileContent.data != 'empty'">-->
<!--                        <jet-label for="search" :value="__('Search')"/>-->
<!--                        <jet-input id="search" type="text" name="search" class="mt-1 block w-full" v-model="search" />-->
<!--                    </div>-->
                </div>

                <div class="w-full my-10 flex justify-center">
                    <article class="prose dark:prose-dark text-center overflow-x-scroll max-w-md sm:max-w-none"
                             v-if="!fileContent.loading && fileContent.data != 'empty'"
                             v-html="fileContent.data"
                             id="data"
                    />
                    <div v-else-if="!fileContent.loading && fileContent.data == 'empty'" class="flex justify-center items-center mt-5">
                        <div class="text-gray-900 dark:text-gray-100 text-lg">
                            {{ __('Please, choose from the dropdown, there is no available data') }}
                        </div>
                    </div>
                    <div v-else-if="fileContent.loading" class="flex justify-center items-center mt-16 mb-60">
                        <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-gray-900 dark:border-gray-100" />
                    </div>
                </div>
            </div>
        </div>
        <ScrollTop />
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"
import JetLabel from '@/Jetstream/Label'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import {ref, reactive, watch} from 'vue'
import Icon from "@/Shared/Icon"
import ScrollTop from "@/Shared/ScrollTop"
import { DocumentIcon, CogIcon, LocationMarkerIcon, AtSymbolIcon, StatusOnlineIcon, ViewListIcon } from '@heroicons/vue/outline'

export default {
    components: {
        AppLayout,
        JetLabel,
        JetButton,
        JetInput,
        Icon,
        DocumentIcon,
        ViewListIcon,
        CogIcon,
        LocationMarkerIcon,
        AtSymbolIcon,
        StatusOnlineIcon,
        ScrollTop
    },
    props: ['meet', 'isEntriable', 'hasEntries'],
    setup(props) {

        const type = reactive({
            selected: null,
        });

        const sections = reactive({
            data: null,
            selected: null,
            loading: false,
            hidden: false,
        });

        const events = reactive({
            data: null,
            selected: null,
            loading: false,
            hidden: false,
        });

        const fileContent = reactive({
            data: null,
            loading: false,
        });

        function toggleHide(bool) {
            if (bool) {
                sections.hidden = true
                events.hidden = true
            }else {
                sections.hidden = false
                events.hidden = false
            }
        }

        function clearSelects() {
            toggleHide(false)
            sections.selected = null
            events.selected = null
            fileContent.data = null
        }

        // FIRST SELECT
        watch(
            () => type.selected,
            async (value) => {

                sections.loading = true;
                events.loading = true;

                await axios
                    .get(route('api:meet.contents', {
                            meetId: props.meet.id,
                            method: value
                        })
                    )
                    .then(resp => {
                        console.log('firstselect method: ' + value)

                        switch (value) {
                            case 'getStartlistSections':
                                clearSelects()
                                sections.data = resp.data
                                sections.data.unshift({
                                    id: 'getStartlists',
                                    name: 'All',
                                });
                                sections.selected = (Array.isArray(sections.data) && sections.data[0]) ? sections.data[0].id : null
                                break
                            case 'getResultSections':
                                clearSelects()
                                sections.data = resp.data
                                sections.data.unshift({
                                    id: 'getResults',
                                    name: 'All',
                                });
                                sections.selected = (Array.isArray(sections.data) && sections.data[0]) ? sections.data[0].id : null
                                break
                            case 'getTimeSchedule':
                                toggleHide(true)
                                events.selected = resp.data.id
                                break
                            case 'getSummary':
                                clearSelects()
                                sections.data = resp.data
                                sections.selected = (Array.isArray(sections.data) && sections.data[0]) ? sections.data[0].id : null
                                break
                            default:
                                clearSelects()
                                break
                        }

                    }).catch(err => {
                        console.error(err)
                        toggleHide(true)
                        fileContent.data = 'empty'
                    });

                sections.loading = false;
            }
        );

        // SECOND SELECT
        watch(
            () => sections.selected,
            async (value) => {

                events.loading = true;

                if (value == null || value == 'null') {
                    events.selected = null
                    events.loading = false
                    return;
                }

                var method = null

                // first select
                switch(type.selected) {
                    case 'getStartlistSections':
                        method = Number.isInteger(value) ? 'getStartlistByParam' : 'getStartlists'
                        break
                    case 'getResultSections':
                        method = Number.isInteger(value) ? 'getEventsByParam' : value
                        break
                    case 'getSummary':
                        method = 'getFileContent'
                        break
                    default:
                        method = value
                        break
                }

                console.log('secondselect method: ' + method)
                console.log('secondselect value: ' + value)

                await axios
                    .get(route('api:meet.contents', {
                            meetId: props.meet.id,
                            method: method,
                            param: value
                        })
                    ).then(resp => {

                        switch (method) {
                            case 'getStartlistByParam':
                                events.hidden = true
                                events.selected = (resp.data[0]) ? resp.data[0].id : null
                                break
                            case 'getFileContent':
                                events.hidden = true
                                events.selected = value
                                break
                            default:
                                events.hidden = false
                                events.data = resp.data
                                events.selected = (Array.isArray(resp.data) && resp.data[0]) ? resp.data[0].id : null
                                if (!events.selected) {
                                    fileContent.data = 'empty'
                                }
                                break
                        }
                    }).catch(err => {
                        console.error(err)
                        fileContent.data = 'empty'
                    });

                //console.log('events selected value: ' + events.selected)
                events.loading = false;
            }
        );

        // THIRD SELECT
        watch(
            () => events.selected,
            async (value) => {

                console.log('thirdselectvalue: ' + value)
                fileContent.loading = true

                if (value == null || value == 'null') {
                    //events.selected = null
                    fileContent.data = 'empty'
                    fileContent.loading = false
                    return;
                }

                await axios
                    .get(route('api:meet.contents', {
                            meetId: props.meet.id,
                            method: 'getFileContent',
                            param: value
                        })
                    ).then(resp => {
                        fileContent.data = resp.data
                    }).catch(err => {
                        console.error(err)
                        fileContent.data = 'empty'
                    });
                fileContent.loading = false
            }
        );

        // watch(search, function (value) {
        //     console.log(value)
        //     //$('#returnedData').removeHighlight();
        //     var filter = value;
        //     if(filter.length >= 2) {
        //         //$('#returnedData').highlight(filter);
        //     }
        //     console.log(data.value.querySelector('.search'))
        //     for (let i = 0; i < data.length; i++) {
        //         if (data[i].innerText.toLowerCase().includes(filter)) {
        //             data[i].style.display = "block";
        //         } else {
        //             data[i].style.display = "none";
        //         }
        //     }
        // })

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
.data-enter-active,
.data-leave-active {
    @apply ease-out opacity-100 duration-300;
}

.data-enter, .data-leave-to {
    @apply ease-in opacity-0 duration-200;
}
</style>