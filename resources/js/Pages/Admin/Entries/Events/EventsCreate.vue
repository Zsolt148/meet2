<template>
    <Head title="Versenyszámok" />

    <portal-layout>

        <template #header>
            <div class="flex flex-col md:flex-row justify-between mb-5 md:mb-0">

                <bread-crumb :back-route="route('admin:entries.meet.index')" back-name="Nevezhető versenyek">
                    <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.index', meet.id)">{{ meet.name }}</Link>
                    <span class="font-medium pl-1">/</span>
                    <Link class="text-teal-500 dark:text-teal-400 hover:text-teal-500 dark:hover:text-teal-500" :href="route('admin:entries.meet.event.index', meet.id)"> Versenyszámok </Link>
                    <span class="font-medium pl-1">/</span>
                    <span v-if="isEventsEmpty">Létrehozás</span><span v-else>Szerkesztés</span>
                </bread-crumb>
            </div>
        </template>

        <div v-if="isEventsEmpty" class="flex flex-row items-center bg-yellow-100 dark:bg-yellow-200 rounded-lg p-3 text-sm text-yellow-700 mb-5" role="alert">
            <div class="mr-2">
                <ExclamationIcon class="w-5 h-5" />
            </div>
            <div>
                <span class="font-bold">Figyelem!</span>
                Ezt a listát egyszer lehet létrehozni, szerkesztésre nincs mód, csupán teljes törlésre amely a leadott nevezések törlésével is járhat!
            </div>
        </div>
        <div v-else class="flex flex-row items-center bg-red-100 rounded-lg p-3 text-sm text-red-700 mb-5" role="alert">
            <div class="mr-2">
                <ExclamationIcon class="w-5 h-5" />
            </div>
            <div>
                <span class="font-bold">Figyelem!</span>
                Ez a lista már létre lett hozva egyszer, az újboli mentés az előző lista és a hozzá tartozó összes nevezés törlésével jár!
            </div>
        </div>

        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-x-auto p-8">

            <div class="flex flex-row items-center justify-end">
                <jet-button @click="confirmModalShow = true">
                    Mentés
                </jet-button>
            </div>

            <div class="flex flex-row space-x-4">

                <div class="flex flex-col w-1/3">
                    <div class="text-xl">Összes versenyszám</div>
                    <draggable
                        class="h-80 w-full overflow-y-scroll"
                        v-model="allEvents"
                        :group="{ name: 'events', pull: 'clone', put: false }"
                        :clone="onClone"
                        :sort="false"
                        item-key="id"
                    >
                        <template #item="{ element }">
                            <div class="px-4 py-2 cursor-move rounded border border-gray-400 border-opacity-50">
                                {{element.length}}m {{ __(element.sex) }} {{ __(element.swim) }}
                            </div>
                        </template>
                    </draggable>
                </div>

                <div class="flex flex-col w-2/3">
                    <div class="text-xl">Versenyszámok</div>
                    <draggable
                        class="rounded border border-dotted border-gray-400 h-80 w-full overflow-y-scroll p-2"
                        handle=".handle"
                        :list="eventList"
                        group="events"
                        item-key="id"
                    >
                        <template #item="{ element, index }">
                            <div class="px-4 py-2 rounded border border-gray-400 border-opacity-50 flex">
                                <div class="flex w-1/2 mt-2">
                                    <div class="mr-2">
                                        {{ index + 1}}.
                                    </div>
                                    <ViewListIcon class="w-5 h-5 mr-2 cursor-move handle" />
                                    <div>
                                        {{element.length}}m {{ __(element.sex) }} {{ __(element.swim) }}
                                    </div>
                                </div>
                                <div class="flex w-1/2">
                                    <input type="text" :placeholder="__('Category')" class="text-xs" v-model="element.category" />
                                    <XIcon class="w-5 h-5 mt-2 ml-2 cursor-pointer" @click="removeAt(index)" />
                                </div>
                            </div>
                        </template>
                    </draggable>
                </div>
            </div>
        </div>
        <jet-confirmation-modal :show="confirmModalShow" @close="confirmModalShow = false">
            <template #title>
                Nevezések létrehozása
            </template>

            <template #content>
                <div v-if="isEventsEmpty" class="flex flex-row items-center bg-yellow-100 rounded-lg p-3 text-sm text-yellow-700 mb-5" role="alert">
                    <div class="mr-2">
                        <ExclamationIcon class="w-5 h-5" />
                    </div>
                    <div>
                        <span class="font-bold">Figyelem!</span>
                        Ezt a listát egyszer lehet létrehozni, szerkesztésre nincs mód, csupán teljes törlésre amely a nevezések törlésével is járhat!
                    </div>
                </div>
                <div v-else class="flex flex-row items-center bg-red-100 rounded-lg p-3 text-sm text-red-700 mb-5" role="alert">
                    <div class="mr-2">
                        <ExclamationIcon class="w-5 h-5" />
                    </div>
                    <div>
                        <span class="font-bold">Figyelem!</span>
                        Ez a lista már létre lett hozva egyszer, az újboli mentés az előző lista és a hozzá tartozó összes nevezés törlésével jár!
                    </div>
                </div>

                Biztosan létre szeretnéd hozni a versenyszámokat ?

            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="confirmModalShow = false">
                    Mégse
                </jet-button>

                <jet-button variant="primary" type="button" @click.native="save">
                    Mentés
                </jet-button>
            </template>
        </jet-confirmation-modal>
    </portal-layout>
</template>

<script>
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import { ExclamationIcon, ViewListIcon, XIcon } from '@heroicons/vue/outline'
import BreadCrumb from "@/Shared/BreadCrumb";
import draggable from 'vuedraggable'
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";

export default {
    components: {
        JetButton,
        PortalLayout,
        BreadCrumb,
        ExclamationIcon,
        ViewListIcon,
        XIcon,
        draggable,
        JetConfirmationModal
    },
    props: {
        allEvents: Object,
        meet: Object,
        isEventsEmpty: Boolean,
    },
    data() {
        return {
            eventList: [],
            idGlobal: 0,
            confirmModalShow: false,
        }
    },
    methods: {
        removeAt(idx) {
            this.eventList.splice(idx, 1);
        },
        onClone(og) {
            this.idGlobal++;
            console.log(og);
            return {
                id: this.idGlobal,
                event_id: og.id,
                length: og.length,
                sex: og.sex,
                swim: og.swim,
            };
        },
        save: function() {
            this.$inertia.post(route('admin:entries.meet.event.store', this.meet), {
                events: this.eventList
            })
        },
    }
};
</script>
