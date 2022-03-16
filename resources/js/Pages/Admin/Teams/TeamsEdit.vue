<template>
    <Head title="Egyesület szerkesztése" />

    <portal-layout>
        <template #header>
            <bread-crumb :back-route="route('admin:teams.index')" back-name="Egyesületek" :current="form.name" />
        </template>
        <div class="bg-white dark:bg-gray-700 rounded-md shadow overflow-hidden">
            <form @submit.prevent="update">
                <div class="p-8">
                    <div v-show="team.type == 'senior'" class="mb-5">
                        Ez egy hivatalos szenior egyesület, módosítani az mszuosz.hu oldalon lehet.
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <div class="w-full sm:w-1/2">
                            <jet-label for="name" value="Engedélyrendszer név" />
                            <jet-input id="name" type="text" v-model="form.name" autocomplete="off" :disabled="team.type == 'senior'" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-5">
                        <div class="w-full sm:w-1/3">
                            <jet-label for="sa" value="SA" />
                            <jet-input id="sa" type="text" v-model="form.SA" autocomplete="off" :disabled="team.type == 'senior'" />
                            <jet-input-error :message="form.errors.SA" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3">
                            <jet-label for="short" value="Rövidítés (max 20 karakter)" />
                            <jet-input id="short" type="text" v-model="form.short" autocomplete="off" :maxlength="20" :disabled="team.type == 'senior'" />
                            <jet-input-error :message="form.errors.short" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3">
                            <jet-label for="meet_abbr" value="Meet abbr (max 5 karakter)" />
                            <jet-input id="meet_abbr" type="text" v-model="form.meet_abbr" autocomplete="off" :maxlength="5" :disabled="team.type == 'senior'" />
                            <jet-input-error :message="form.errors.meet_abbr" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-5">

                        <div class="w-full sm:w-1/2">
                            <jet-label for="country" value="Ország" />
                            <select name="country" id="country" v-model="form.country" :disabled="team.type == 'senior'">
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
                            <jet-input-error :message="form.errors.country" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2">
                            <jet-label for="address" value="Cím" />
                            <jet-input id="address" type="text" v-model="form.address" autocomplete="off" :disabled="team.type == 'senior'" />
                            <jet-input-error :message="form.errors.address" class="mt-2" />
                        </div>
                    </div>

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
        <jet-confirmation-modal :show="confirmModalShow" @close="confirmModalShow = false">
            <template #title>
                Egyesület törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd az Egyesületet ?
            </template>

            <template #footer>
                <jet-button variant="secondary" @click.native="confirmModalShow = false">
                    Mégse
                </jet-button>

                <jet-button variant="danger" class="ml-2" @click.native="deleteTeam">
                    Törlés
                </jet-button>
            </template>
        </jet-confirmation-modal>
    </portal-layout>
</template>

<script>
import PortalLayout from "@/Layouts/PortalLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetConfirmationModal from '@/Jetstream/ConfirmationModal';
import BreadCrumb from "@/Shared/BreadCrumb";

export default {
    components: {
        PortalLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetConfirmationModal,
        BreadCrumb,
    },
    props: {
        team: Object,
    },
    data() {
        return {
            confirmModalShow: false,
            form: this.$inertia.form({
                _method: 'PUT',
                name: this.team.name,
                type: this.team.type,
                short: this.team.short,
                meet_abbr: this.team.meet_abbr,
                SA: this.team.SA,
                country: this.team.country,
                address: this.team.address,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:teams.update', this.team.id))
        },
        deleteTeam() {
            this.$inertia.delete(this.route('admin:teams.destroy', this.team.id))
        },
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.confirmModalShow = false;
            },
        },
    },
}
</script>
