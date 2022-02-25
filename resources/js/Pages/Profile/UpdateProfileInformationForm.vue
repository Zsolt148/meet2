<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            {{__('Profile Information')}}
        </template>

        <template #description>
            {{__("Update your account's profile information and email address.")}}
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            ref="photo"
                            @change="updatePhotoPreview">

                <jet-label for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="! photoPreview">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <jet-button variant="secondary" class="mt-2 mr-2" type="button" @click="selectNewPhoto">
                    {{__('Select A New Photo')}}
                </jet-button>

                <jet-button variant="secondary" type="button" class="mt-2" @click="deletePhoto" v-if="user.profile_photo_path">
                    {{__('Remove Photo')}}
                </jet-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" :error="form.errors.name" autocomplete="name" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" :error="form.errors.email" disabled="disabled" />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="team_id" :value="__('Team')"/>
                <select name="team_id" id="team_id" v-model="form.team_id">
                    <option value="">{{ __('Empty') }}</option>
                    <option v-for="team in teams" :key="team.id" :value="team.id" :selected="form.team_id === team.id">{{team.name}}</option>
                    <option value="other">{{ __('Other') }}</option>
                </select>
                <div class="mt-2 text-xs">
                    {{ __('I would like to register as a senior team leader so I can submit entries for competitions') }}
                </div>
                <jet-input-error :message="form.errors.team_id" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4" v-if="form.team_id == 'other'">
                <jet-label for="other_team" :value="__('Other team name')" />
                <jet-input id="other_team" type="text" v-model="form.other_team" autocomplete="off" />
                <jet-input-error :message="form.errors.other_team" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4" v-if="form.team_id == 'other'">
                <jet-label for="other_team_country" :value="__('Other team country')" />
                <jet-input id="other_team_country" type="text" v-model="form.other_team_country" autocomplete="off" />
                <jet-input-error :message="form.errors.other_team_country" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                {{__('Saved.')}}
            </jet-action-message>

            <jet-button :loading="form.processing">
                {{__('Save')}}
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        props: ['user', 'teams'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    name: this.user.name,
                    email: this.user.email,
                    photo: null,
                    team_id: this.user.team_id,
                    other_team: this.user.other_team,
                    other_team_country: this.user.other_team_country,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => (this.photoPreview = null),
                });
            },
        },
    }
</script>
