<template>
    <Head title="Új verseny" />
    <portal-layout>
        <div>
            <bread-crumb :back-route="route('admin:meets.index')" back-name="Versenyek" current="Új verseny" />
            <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">

                <form @submit.prevent="create">
                    <div class="p-8 flex flex-col">
                        <div class="mb-5">
                            <jet-label for="is_visible">
                                <div class="flex items-center text-xl">
                                    <jet-checkbox name="is_visible" id="is_visible" v-model:checked="form.is_visible" />

                                    <div class="ml-2">
                                        Látható
                                    </div>
                                </div>
                            </jet-label>
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
                                            locale="hu"
                                            format="yyyy.MM.dd"
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
                                            locale="hu" format="yyyy.MM.dd"
                                            selectText="Mentés" cancelText="Mégse"
                                            id="deadline" name="deadline"
                                            :enableTimePicker="false"
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
                    </div>
                    <div class="px-8 py-4 bg-gray-50 dark:bg-dark-eval-3 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                        <jet-button :loading="form.processing">
                            Mentés
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>
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
import BreadCrumb from "@/Shared/BreadCrumb";
import JetCheckbox from "@/Jetstream/Checkbox";
import Editor from '@tinymce/tinymce-vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { isDark } from '@/Composables'

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
        BreadCrumb,
        JetCheckbox,
        Editor,
        FilePond,
        Datepicker,
        isDark
    },
    props: {
        locations: Object,
        contacts: Object,
    },

    setup() {
        const confirmModalShow = ref(false)
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
            _method: 'POST',
            is_visible: false,
            name: null,
            slug: null,
            host: null,
            type: null,
            phases: null,
            date: [],
            deadline: null,
            location_id: null,
            contact_id: null,
            body: null,
            files: [],
        })

        function slug(string) {
            if(string == null) return '';
            return string.toString().toLowerCase()
                .replaceAll('.', '-')           // . to -
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

        function create() {
            form.files = files;
            form.post(route('admin:meets.store'))
        }

        return {
            confirmModalShow,
            form,
            create,
            filesServer,
            files,
            isDark,
        }
    },
}
</script>
