<template>
    <app-layout>
        <jet-authentication-card>
            <template #logo>
                {{ __('Register') }}
            </template>

            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <jet-label for="name" :value="__('Name')" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" :error="form.errors.email" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <jet-label for="email" value="Email" />
                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" :error="form.errors.email" required />
                </div>

                <div class="mt-4">
                    <jet-label for="password" :value="__('Password')" />
                    <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" :error="form.errors.password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <jet-label for="password_confirmation" :value="__('Confirm Password')" />
                    <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" :error="form.errors.password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <jet-label for="isSenior">
                        <div class="flex items-center">
                            <jet-checkbox name="isSenior" id="isSenior" v-model:checked="form.isSenior" />

                            <div class="ml-2">
                                {{ __('I would like to register as a senior team leader so I can submit entries for competitions') }}
                            </div>
                        </div>
                    </jet-label>
                </div>

                <div class="mt-4" v-if="form.isSenior">
                    <jet-label for="team_id" :value="__('Team')"/>
                    <select name="team_id" id="team_id" v-model="form.team_id">
                        <option v-for="team in teams" :key="team.id" :value="team.id">{{team.name}}</option>
                        <option value="other">{{ __('Other') }}</option>
                    </select>
                    <jet-input-error :message="form.errors.team_id" class="mt-2" />
                </div>

                <div class="mt-4" v-if="form.isSenior && form.team_id == 'other'">
                    <jet-label for="other_team" :value="__('Other team name')" />
                    <jet-input id="other_team" type="text" v-model="form.other_team" autocomplete="off" />
                    <jet-input-error :message="form.errors.other_team" class="mt-2" />
                </div>
                <div class="mt-4" v-if="form.isSenior && form.team_id == 'other'">
                    <jet-label for="other_team_country" :value="__('Other team country')" />
                    <jet-input id="other_team_country" type="text" v-model="form.other_team_country" autocomplete="off" />
                    <jet-input-error :message="form.errors.other_team_country" class="mt-2" />
                </div>

                <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                    <jet-label for="terms">
                        <div class="flex items-center">
                            <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                            <div class="ml-2">
                                {{ __('I agree to the') }}
                                <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                                    {{ __('Terms of Service') }}
                                </a>
                                {{ __('and') }}
                                <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                                    {{ __('Privacy Policy') }}
                                </a>
                            </div>
                        </div>
                    </jet-label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <Link :href="route('login')" class="underline text-sm text-gray-600 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                        {{ __('Login') }}
                    </Link>

                    <jet-button :loading="form.processing">
                        {{ __('Register') }}
                    </jet-button>
                </div>
            </form>
        </jet-authentication-card>
    </app-layout>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import AppLayout from "@/Layouts/AppLayout";

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            AppLayout
        },

        props: ['teams'],

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    isSenior: false,
                    team_id: '',
                    other_team: '',
                    other_team_country: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
