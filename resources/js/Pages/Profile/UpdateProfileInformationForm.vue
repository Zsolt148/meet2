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
                <select name="team_id" id="team_id" v-model="form.team_id" :disabled="user.team_id">
                    <option value="">{{ __('Empty') }}</option>
                    <option v-for="team in teams" :key="team.id" :value="team.id" :selected="form.team_id === team.id">{{team.name}}</option>
                    <option value="other">{{ __('Other') }}</option>
                </select>
                <div class="mt-2 text-xs">
                    {{ __('Choosing a team is required to submit an entry') }}
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
                <select name="other_team_country" id="other_team_country" v-model="form.other_team_country">
                    <option value="AF">Afganisztán</option>
                    <option value="AX">Aland-szigetek</option>
                    <option value="AL">Albánia</option>
                    <option value="DZ">Algéria</option>
                    <option value="AS">Amerikai Szamoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarktisz</option>
                    <option value="AG">Antigua és Barbuda</option>
                    <option value="AR">Argentína</option>
                    <option value="AM">Örményország</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Ausztrália</option>
                    <option value="AT">Ausztria</option>
                    <option value="AZ">Azerbajdzsán</option>
                    <option value="BS">Bahama-szigetek</option>
                    <option value="BH">Bahrein</option>
                    <option value="BD">Banglades</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Fehéroroszország</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhután</option>
                    <option value="BO">Bolívia</option>
                    <option value="BQ">Bonaire, Sint Eustatius és Saba</option>
                    <option value="BA">Bosznia és Hercegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvet-sziget</option>
                    <option value="BR">Brazília</option>
                    <option value="IO">Brit Indiai-óceáni terület</option>
                    <option value="BN">Brunei Darussalam</option>
                    <option value="BG">Bulgária</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Kambodzsa</option>
                    <option value="CM">Kamerun</option>
                    <option value="CA">Kanada</option>
                    <option value="CV">zöld-fok</option>
                    <option value="KY">Kajmán-szigetek</option>
                    <option value="CF">Közép-Afrikai Köztársaság</option>
                    <option value="TD">Csád</option>
                    <option value="CL">Chile</option>
                    <option value="CN">Kína</option>
                    <option value="CX">Karácsony-sziget</option>
                    <option value="CC">Cocos (Keeling) szigetek</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comore-szigetek</option>
                    <option value="CG">Kongó</option>
                    <option value="CD">Kongó, Kongói Demokratikus Köztársaság</option>
                    <option value="CK">Cook-szigetek</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Elefántcsontpart</option>
                    <option value="HR">Horvátország</option>
                    <option value="CU">Kuba</option>
                    <option value="CW">Curacao</option>
                    <option value="CY">Ciprus</option>
                    <option value="CZ">Cseh Köztársaság</option>
                    <option value="DK">Dánia</option>
                    <option value="DJ">Dzsibuti</option>
                    <option value="DM">Dominika</option>
                    <option value="DO">Dominikai Köztársaság</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egyiptom</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Egyenlítői-Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Észtország</option>
                    <option value="ET">Etiópia</option>
                    <option value="FK">Falkland-szigetek (Malvinas)</option>
                    <option value="FO">Faroe Szigetek</option>
                    <option value="FJ">Fidzsi-szigetek</option>
                    <option value="FI">Finnország</option>
                    <option value="FR">Franciaország</option>
                    <option value="GF">Francia Guyana</option>
                    <option value="PF">Francia Polinézia</option>
                    <option value="TF">Francia déli területek</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Grúzia</option>
                    <option value="DE">Németország</option>
                    <option value="GH">Ghána</option>
                    <option value="GI">Gibraltár</option>
                    <option value="GR">Görögország</option>
                    <option value="GL">Grönland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Bissau-Guinea</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard-sziget és a McDonald-szigetek</option>
                    <option value="VA">Szentszék (Vatikánvárosi állam)</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Magyarország</option>
                    <option value="IS">Izland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonézia</option>
                    <option value="IR">Irán, az Iszlám Köztársaság</option>
                    <option value="IQ">Irak</option>
                    <option value="IE">Írország</option>
                    <option value="IM">Man-sziget</option>
                    <option value="IL">Izrael</option>
                    <option value="IT">Olaszország</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japán</option>
                    <option value="JE">Jersey</option>
                    <option value="JO">Jordánia</option>
                    <option value="KZ">Kazahsztán</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KP">Korea, a Népi Demokratikus Köztársaság</option>
                    <option value="KR">Koreai Köztársaság</option>
                    <option value="XK">Koszovó</option>
                    <option value="KW">Kuvait</option>
                    <option value="KG">Kirgizisztán</option>
                    <option value="LA">Laoszi Népi Demokratikus Köztársaság</option>
                    <option value="LV">Lettország</option>
                    <option value="LB">Libanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Libéria</option>
                    <option value="LY">Líbiai arab Jamahiriya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Litvánia</option>
                    <option value="LU">Luxemburg</option>
                    <option value="MO">Makaó</option>
                    <option value="MK">Macedónia, Macedónia Volt Jugoszláv Köztársaság</option>
                    <option value="MG">Madagaszkár</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldív-szigetek</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Málta</option>
                    <option value="MH">Marshall-szigetek</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritánia</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexikó</option>
                    <option value="FM">Mikronézia, Macedónia Szövetségi Államok</option>
                    <option value="MD">Moldovai Köztársaság</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongólia</option>
                    <option value="ME">Montenegró</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Marokkó</option>
                    <option value="MZ">Mozambik</option>
                    <option value="MM">Mianmar</option>
                    <option value="NA">Namíbia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepál</option>
                    <option value="NL">Hollandia</option>
                    <option value="AN">Holland Antillák</option>
                    <option value="NC">Új-Kaledónia</option>
                    <option value="NZ">Új Zéland</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigéria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk-sziget</option>
                    <option value="MP">Észak Mariana szigetek</option>
                    <option value="NO">Norvégia</option>
                    <option value="OM">Omán</option>
                    <option value="PK">Pakisztán</option>
                    <option value="PW">Palau</option>
                    <option value="PS">Palesztin Terület, elfoglalt</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Pápua Új-Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Fülöp-szigetek</option>
                    <option value="PN">Pitcairn</option>
                    <option value="PL">Lengyelország</option>
                    <option value="PT">Portugália</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Katar</option>
                    <option value="RE">Reunion</option>
                    <option value="RO">Románia</option>
                    <option value="RU">Orosz Föderáció</option>
                    <option value="RW">Ruanda</option>
                    <option value="BL">Szent Barthelemy</option>
                    <option value="SH">Szent Heléna</option>
                    <option value="KN">Saint Kitts és Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="MF">Szent Márton</option>
                    <option value="PM">Saint Pierre és Miquelon</option>
                    <option value="VC">Saint Vincent és a Grenadine-szigetek</option>
                    <option value="WS">Szamoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome és Principe</option>
                    <option value="SA">Szaud-Arábia</option>
                    <option value="SN">Szenegál</option>
                    <option value="RS">Szerbia</option>
                    <option value="CS">Szerbia és Montenegró</option>
                    <option value="SC">Seychelle-szigetek</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Szingapúr</option>
                    <option value="SX">Szent Márton</option>
                    <option value="SK">Szlovákia</option>
                    <option value="SI">Szlovénia</option>
                    <option value="SB">Salamon-szigetek</option>
                    <option value="SO">Szomália</option>
                    <option value="ZA">Dél-Afrika</option>
                    <option value="GS">Dél-Georgia és a South Sandwich-szigetek</option>
                    <option value="SS">Dél Szudán</option>
                    <option value="ES">Spanyolország</option>
                    <option value="LK">Srí Lanka</option>
                    <option value="SD">Szudán</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard és Jan Mayen</option>
                    <option value="SZ">Szváziföld</option>
                    <option value="SE">Svédország</option>
                    <option value="CH">Svájc</option>
                    <option value="SY">Szíriai Arab Köztársaság</option>
                    <option value="TW">Tajvan, Kína tartomány</option>
                    <option value="TJ">Tádzsikisztán</option>
                    <option value="TZ">Tanzánia, Lengyel Köztársaság</option>
                    <option value="TH">Thaiföld</option>
                    <option value="TL">Kelet-Timor</option>
                    <option value="TG">Menni</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad és Tobago</option>
                    <option value="TN">Tunézia</option>
                    <option value="TR">pulyka</option>
                    <option value="TM">Türkmenisztán</option>
                    <option value="TC">Turks-és Caicos-szigetek</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukrajna</option>
                    <option value="AE">Egyesült Arab Emírségek</option>
                    <option value="GB">Egyesült Királyság</option>
                    <option value="US">Egyesült Államok</option>
                    <option value="UM">Az Egyesült Államok Kis Külső Szigetei</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Üzbegisztán</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela</option>
                    <option value="VN">Vietnam</option>
                    <option value="VG">Virgin-szigetek, brit</option>
                    <option value="VI">Virgin-szigetek, Egyesült Államok</option>
                    <option value="WF">Wallis és Futuna</option>
                    <option value="EH">nyugat-Szahara</option>
                    <option value="YE">Jemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                </select>
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
