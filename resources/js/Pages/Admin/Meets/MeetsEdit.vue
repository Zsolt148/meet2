<template>
    <Head title="Verseny szerkesztése" />
    <portal-layout>
        <div>
            <bread-crumb :back-route="route('admin:meets.index')" back-name="Versenyek" :current="form.name" />
            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">

                <form @submit.prevent="update">
                    <div class="p-8 flex flex-col">
                        <div class="flex justify-between mb-5">
                            <jet-label for="is_visible">
                                <div class="flex items-center text-xl">
                                    <jet-checkbox name="is_visible" id="is_visible" v-model:checked="form.is_visible" />

                                    <div class="ml-2">
                                        Látható
                                    </div>
                                </div>
                            </jet-label>
<!--                                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">-->
<!--                                    <input type="checkbox" name="is_visible" id="is_visible" class="toggle-checkbox absolute block w-6 h-6 rounded-full border-2 bg-white appearance-none cursor-pointer" v-model:checked="form.is_visible"/>-->
<!--                                    <label for="is_visible" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>-->
<!--                                </div>-->
<!--                                <label for="is_visible" class="text-xs text-gray-700">Látható</label>-->

                            <jet-button size="sm" :href="route('meets.show', meet)">
                                <EyeIcon class="w-5 h-5 mr-2" />
                                Megtekintés
                            </jet-button>
                        </div>

                        <div class="w-full flex flex-row space-x-4">
                            <div class="w-1/2">
                                <jet-label for="name" value="Név" />
                                <jet-input id="name" type="text" v-model="form.name" autocomplete="off" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="w-1/2">
                                <jet-label for="slug" value="URL" />
                                <jet-input id="slug" type="text" class="mt-1 block w-full bg-gray-200" v-model="form.slug" autocomplete="off" aria-readonly="true" disabled="disabled" />
                                <jet-input-error :message="form.errors.slug" class="mt-2" />
                            </div>
                        </div>

                        <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mt-5">
                            <div class="w-full sm:w-1/2">
                                <jet-label for="date" value="Dátum" />
                                <Datepicker class="mt-1" :dark="isDark"
                                            locale="hu" format="yyyy.MM.dd"
                                            selectText="Mentés" cancelText="Mégse"
                                            id="date" name="date"
                                            v-model="form.date"
                                            :enableTimePicker="false"
                                            :timePicker="false"
                                            range
                                />
                                <jet-input-error :message="form.errors.date" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/2">
                                <jet-label for="deadline" value="Nevezési határidő" />
                                <Datepicker class="mt-1" :dark="isDark"
                                            locale="hu" format="yyyy.MM.dd HH:mm"
                                            selectText="Mentés" cancelText="Mégse"
                                            id="deadline" name="deadline"
                                            v-model="form.deadline"
                                />
                                <jet-input-error :message="form.errors.deadline" class="mt-2" />
                            </div>
                        </div>

                        <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mt-5">
                            <div class="w-full sm:w-1/3">
                                <jet-label for="host" value="Rendező" />
                                <jet-input id="host" type="text" v-model="form.host" autocomplete="off" />
                                <jet-input-error :message="form.errors.host" class="mt-2" />
                            </div>
                            <div class="w-full sm:w-1/3">
                                <jet-label for="type" value="Típus" />
                                <jet-input id="type" type="text" v-model="form.type" autocomplete="off" />
                                <jet-input-error :message="form.errors.type" class="mt-2" />
                            </div>
                            <div class="w-full sm:w-1/3">
                                <jet-label for="phases" value="Szakaszok száma" />
                                <jet-input id="phases" type="number" v-model="form.phases" autocomplete="off" />
                                <jet-input-error :message="form.errors.phases" class="mt-2" />
                            </div>
                        </div>

                        <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mt-5">
                            <div class="w-full sm:w-1/2">
                                <jet-label for="location_id" value="Helyszín"/>
                                <select name="location_id" id="location_id" v-model="form.location_id">
                                    <option v-for="location in locations" :key="location.id" :value="location.id">{{location.city}} - {{location.address}}</option>
                                </select>
                                <jet-input-error :message="form.errors.location_id" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/2">
                                <jet-label for="contact_id" value="Kapcsolattartó"/>
                                <select name="contact_id" id="contact_id" v-model="form.contact_id">
                                    <option v-for="contact in contacts" :key="contact.id" :value="contact.id">{{contact.name}}</option>
                                </select>
                                <jet-input-error :message="form.errors.location_id" class="mt-2" />
                            </div>
                        </div>

                        <div class="w-full mt-5">
                            <jet-label for="files" value="Fájlok"/>
                            <file-pond
                                name="files"
                                ref="pond"
                                :required="false"
                                v-bind:allow-multiple="true"
                                accepted-file-types="application/*, image/*, .xls, .xlsx, .doc, .docx"
                                max-files="5"
                                v-bind:server="filesServer"
                                label-idle='<p>Húzd ide a fájlokat vagy <span class="filepond--label-action" tabindex="0">Böngéssz</span></p>'
                            />
                        </div>

                        <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4" v-show="meet.mediaFiles">
                            <div v-for="(file, id) in meet.mediaFiles" :key="id">
                                <a class="text-blue-600 dark:text-blue-400 underline mr-3" target="_blank" :href="file.url">{{ file.name.substring(0, 20) }}</a>
                                <jet-button variant="secondary" size="sm" type="button" @click="confirmDeleteMedia(file.uuid)">
                                    Törlés
                                </jet-button>
                            </div>
                        </div>

                        <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mt-5">
                            <div class="w-full sm:w-1/4">
                                <jet-label for="race_info_id" value="Versenykiírás"/>
                                <select name="race_info_id" id="race_info_id" v-model="form.race_info_id">
                                    <option value="">Üres</option>
                                    <option v-for="file in meet.mediaFiles" :key="file.id" :value="file.uuid">{{file.name}}</option>
                                </select>
                                <jet-input-error :message="form.errors.race_info_id" class="mt-2" />
                            </div>
                            <div class="w-full sm:w-1/4">
                                <jet-label for="pre_startlist_id" value="Előzetes rajtlista"/>
                                <select name="pre_startlist_id" id="pre_startlist_id" v-model="form.pre_startlist_id">
                                    <option value="">Üres</option>
                                    <option v-for="file in meet.mediaFiles" :key="file.id" :value="file.uuid">{{file.name}}</option>
                                </select>
                                <jet-input-error :message="form.errors.pre_startlist_id" class="mt-2" />
                            </div>
                            <div class="w-full sm:w-1/4">
                                <jet-label for="race_record_id" value="Jegyzőkönyv"/>
                                <select name="race_record_id" id="race_record_id" v-model="form.race_record_id">
                                    <option value="">Üres</option>
                                    <option v-for="file in meet.mediaFiles" :key="file.id" :value="file.uuid">{{file.name}}</option>
                                </select>
                                <jet-input-error :message="form.errors.race_record_id" class="mt-2" />
                            </div>
                            <div class="w-full sm:w-1/4">
                                <jet-label for="time_schedule_id" value="Időterv"/>
                                <select name="time_schedule_id" id="time_schedule_id" v-model="form.time_schedule_id">
                                    <option value="">Üres</option>
                                    <option v-for="file in meet.mediaFiles" :key="file.id" :value="file.uuid">{{file.name}}</option>
                                </select>
                                <jet-input-error :message="form.errors.time_schedule_id" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <jet-label for="body" value="Leírás" />
                            <editor
                                v-model="form.body"
                                id="body"
                                name="body"
                                api-key="skchna384fb9c6sj8ez6wr06oe6eqtedt3m8qburl2n2agbq"
                                output-format="html"
                                :init="{
                                 height: 600,
                                 language: 'hu_HU',
                                 // skin: 'oxide-dark',
                                 // content_css: 'dark',
                                 plugins: [
                                   'link table lists print preview'
                                 ],
                                 toolbar:
                                 'undo redo | styleselect fontsizeselect | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | table link | print preview'
                               }"
                            />
                            <jet-input-error :message="form.errors.body" class="mt-2" />
                        </div>
<!--                        <div v-if="form.body" class="my-8">-->
<!--                            <div class="mb-3 text-2xl">Előnézet:</div>-->
<!--                            <article class="my-5 mx-auto prose dark:prose-dark max-w-none" v-html="form.body"/>-->
<!--                        </div>-->
                    </div>
                    <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                        <jet-button :loading="form.processing">
                            Mentés
                        </jet-button>
                        <jet-button variant="danger" type="button" @click="confirmModalShow = true">
                            Törlés
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-10" v-if="meet.news && meet.news[0]">
            <div class="mb-5 font-bold text-2xl">
                Leírás előzmények
            </div>

            <div v-for="news in meet.news" :key="news.id" class="bg-white dark:bg-gray-600 rounded-md shadow overflow-hidden mb-5">
                <div class="p-5 flex flex-col">
                    <div class="items-center mt-3 sm:mt-0 font-semibold text-green dark:text-green-light">
                        {{ news.created_at }}
                    </div>
                    <article class="my-5 prose dark:prose-dark max-w-none" v-html="news.body" />
                </div>
            </div>
        </div>
        <jet-confirmation-modal :show="fileConfirmModalShow" @close="fileConfirmModalShow = false">
            <template #title>
                Fájl törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a fájlt ?
            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="fileConfirmModalShow = false">
                    Mégse
                </jet-button>

                <jet-button variant="danger" type="button" @click.native="deleteMedia(fileToDeleteId)" :loading="form.processing">
                    Törlés
                </jet-button>
            </template>
        </jet-confirmation-modal>
        <jet-confirmation-modal :show="confirmModalShow" @close="confirmModalShow = false">
            <template #title>
                Verseny törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a versenyt ?
            </template>

            <template #footer>
                <jet-button variant="secondary" type="button" class="mr-2" @click.native="confirmModalShow = false">
                    Mégse
                </jet-button>

                <jet-button variant="danger" type="button" @click.native="deleteModel" :loading="form.processing">
                    Törlés
                </jet-button>
            </template>
        </jet-confirmation-modal>
    </portal-layout>
</template>

<script>
import { ref, reactive, watch, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from "@inertiajs/inertia";
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import BreadCrumb from "@/Shared/BreadCrumb";
import JetCheckbox from "@/Jetstream/Checkbox";
import Editor from '@tinymce/tinymce-vue';
import Datepicker from 'vue3-date-time-picker';
import 'vue3-date-time-picker/dist/main.css';
import { isDark } from '@/Composables'
import { EyeIcon } from '@heroicons/vue/outline'

// Filepond
import vueFilePond, { setOptions } from 'vue-filepond';
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";

const FilePond = vueFilePond(FilePondPluginFileValidateType);

export default {
    components: {
        PortalLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetConfirmationModal,
        BreadCrumb,
        JetCheckbox,
        Editor,
        FilePond,
        Datepicker,
        isDark,
        EyeIcon
    },
    props: {
        meet: Object,
        locations: Object,
        contacts: Object,
    },

    setup({ meet }) {
        const confirmModalShow = ref(false)
        const fileConfirmModalShow = ref(false)
        const fileToDeleteId = ref(null)
        const files = reactive([]);

        const filesServer = {
            process: {
                url: '/fileupload/store/files',
                onload: (resp) => {
                    files.push(JSON.parse(resp))
                    console.log(files)
                },
            },
        }

        const form = useForm({
            _method: 'PUT',
            is_visible: meet.is_visible,
            name: meet.name,
            slug: meet.slug,
            host: meet.host,
            type: meet.type,
            phases: meet.phases,
            date: [new Date(meet.date.split('-')[0]), new Date(meet.date.split('-')[1])],
            deadline: meet.deadline,
            location_id: meet.location_id,
            contact_id: meet.contact_id,
            body: meet.latestNews ? meet.latestNews.body : null,
            //files
            files: [],
            race_info_id: meet.race_info_id,
            pre_startlist_id: meet.pre_startlist_id,
            race_record_id: meet.race_record_id,
            time_schedule_id: meet.time_schedule_id,
        })

        function slug(string) {
            if(string == null) return '';
            return string.toString().toLowerCase()
                .replaceAll('.', '-')
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/&/g, `-and-`)         // & to and
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/-+$/, '');
        }

        watch([() => form.date, () => form.name], (values, prevValues) => {
            if (values[0] && values[0][0]) {
                form.slug = slug(new Date(values[0][0]).toLocaleDateString() + '-' + values[1]);
            }else {
                form.slug = slug(values[1]);
            }
        });

        function update() {
            form.files = files
            form.put(route('admin:meets.update', meet.id))
        }

        function deleteModel() {
            form.delete(route('admin:meets.destroy', meet.id))
        }

        function confirmDeleteMedia(mediaId) {
            fileToDeleteId.value = mediaId
            fileConfirmModalShow.value = true
        }

        function deleteMedia(mediaId) {
            fileConfirmModalShow.value = false
            Inertia.delete(route('admin:meets.delete.media', mediaId));
        }

        return {
            confirmModalShow,
            fileConfirmModalShow,
            form,
            update,
            deleteModel,
            deleteMedia,
            confirmDeleteMedia,
            fileToDeleteId,
            filesServer,
            files,
            isDark,
        }
    },
}
</script>