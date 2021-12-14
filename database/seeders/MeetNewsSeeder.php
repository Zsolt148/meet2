<?php

namespace Database\Seeders;

use App\Models\MeetNews;
use Illuminate\Database\Seeder;

class MeetNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            0 => [
                'id_news' => '40',
                'meets_id' => '233',
                'text' => '<p><font color="#555555">Gratulálunk az eredményekhez!</font></p>',
                'created_at' => '2020-03-09 12:23:39',
                'updated_at' => '2020-03-09 12:23:39',
            ],
            1 => [
                'id_news' => '43',
                'meets_id' => '235',
                'text' => '<p>Kérjük valamennyi csapatvezetőt, hogy a nevezési listában ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a nevezes@kvsc.info címen.</p>',
                'created_at' => '2020-11-29 09:15:32',
                'updated_at' => '2020-11-29 09:15:32',
            ],
            2 => [
                'id_news' => '44',
                'meets_id' => '235',
                'text' => '<p><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a <a href="/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank" style="">nevezési listában</a> ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a nevezes@kvsc.info címen.</span></p>',
                'created_at' => '2020-11-29 09:18:30',
                'updated_at' => '2020-11-29 09:18:30',
            ],
            3 => [
                'id_news' => '45',
                'meets_id' => '235',
                'text' => '<p><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a <a href="csatolmany1.pdf" target="_blank" style="">nevezési listában</a>&nbsp;</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);"> ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a nevezes@kvsc.info címen.</span></p>',
                'created_at' => '2020-11-29 09:19:59',
                'updated_at' => '2020-11-29 09:19:59',
            ],
            4 => [
                'id_news' => '23',
                'meets_id' => '233',
                'text' => 'Kérjük, a módosításokat, lemondásokat péntek (03.06) este 19.00-ig küljdék el a nevezes@kvsc.info e-mail címre! <span style="color: rgb(255, 0, 0);">A rajtlista és az időterv csak előzetes, tájékoztató jellegű, a lemondások, visszalépések alapján még változni fog. Végleges rajtlista szombat reggel 9.00-kor lesz.</span>',
                'created_at' => '2020-03-04 05:37:21',
                'updated_at' => '2020-03-04 05:37:21',
            ],
            5 => [
                'id_news' => '20',
                'meets_id' => '233',
                'text' => 'Kérjük, a módosításokat, lemondásokat péntek (03.06) este 19.00-ig küljdék el a nevezes@kvsc.info e-mail címre!',
                'created_at' => '2020-03-03 04:43:31',
                'updated_at' => '2020-03-03 04:43:31',
            ],
            6 => [
                'id_news' => '21',
                'meets_id' => '233',
                'text' => 'Kérjük, a módosításokat, lemondásokat péntek (03.06) este 19.00-ig küljdék el a nevezes@kvsc.info e-mail címre! Részletek hamarosan...',
                'created_at' => '2020-03-03 04:44:18',
                'updated_at' => '2020-03-03 04:44:18',
            ],
            7 => [
                'id_news' => '16',
                'meets_id' => '183',
                'text' => '<p><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Üdvözöljük önöket a IX.Aranyhomok Kupa Nemzetközi Úszóverseny hivatalos oldalán!</span></p>',
                'created_at' => '2020-03-01 15:26:32',
                'updated_at' => '2020-03-01 15:26:32',
            ],
            8 => [
                'id_news' => '6',
                'meets_id' => '232',
                'text' => '<p style="line-height: 1;"><span style="color: rgb(255, 0, 0);">Üdvözöljük a 2020. évi Belügyminisztériumi Úszó OB hivatalos oldalán!&nbsp;</span><span style="color: rgb(255, 0, 0); font-size: 0.875rem;">Gratulálunk az elért eredményekhez!</span></p><p style="line-height: 1;"><a href="/pdf/2020_02_26_Belugyminiszteriumi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i>&nbsp;Jegyzőkönyv</a></p>',
                'created_at' => '2020-02-28 08:28:20',
                'updated_at' => '2020-02-28 08:28:20',
            ],
            9 => [
                'id_news' => '10',
                'meets_id' => '182',
                'text' => '<p><span style="color: rgb(255, 0, 0);">Üdvözöljük önöket a&nbsp;II.Kecskeméti Cikluszáró Úszóverseny hivatalos oldalán!</span></p>',
                'created_at' => '2020-02-28 08:53:56',
                'updated_at' => '2020-02-28 08:53:56',
            ],
            10 => [
                'id_news' => '17',
                'meets_id' => '183',
                'text' => '<p><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Üdvözöljük önöket a IX.Aranyhomok Kupa Nemzetközi Úszóverseny hivatalos oldalán.</span></p>',
                'created_at' => '2020-03-02 12:51:03',
                'updated_at' => '2020-03-02 12:51:03',
            ],
            11 => [
                'id_news' => '37',
                'meets_id' => '232',
                'text' => '<p style="line-height: 1;"><span style="color: rgb(255, 0, 0);">Üdvözöljük a 2020. évi Belügyminisztériumi Úszó OB hivatalos oldalán.&nbsp;</span><span style="color: rgb(255, 0, 0); font-size: 0.875rem;">Gratulálunk az elért eredményekhez!</span></p><p style="line-height: 1;"><span style="color: rgb(255, 0, 0); font-size: 0.875rem;"><br></span></p><p style="line-height: 1;"><a href="/pdf/2020_02_26_Belugyminiszteriumi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i>&nbsp;Jegyzőkönyv</a></p>',
                'created_at' => '2020-03-09 10:43:37',
                'updated_at' => '2020-03-09 10:43:37',
            ],
            12 => [
                'id_news' => '35',
                'meets_id' => '233',
                'text' => '<p><span style="font-size: 0.875rem; color: rgb(85, 85, 85);">Kérjük, a módosításokat, lemondásokat vasárnap </span><span style="font-size: 0.875rem; color: rgb(255, 0, 0); font-weight: bold;">09.00-ig</span><span style="font-size: 0.875rem; color: rgb(85, 85, 85);"> küldjék el a nevezes@kvsc.info e-mail címre, vagy adják le a versenyirodán! </span></p><p><span style="font-size: 0.875rem; color: rgb(85, 85, 85);">Élő adás:</span><span style="color: rgb(255, 0, 0); font-size: 0.875rem;">&nbsp;</span><a href="https://youtu.be/Rpy61KEQXOI" target="_blank" style="font-size: 0.875rem; background-color: rgb(255, 255, 255); color: rgb(0, 0, 255); font-weight: bold;">Youtube</a></p>',
                'created_at' => '2020-03-09 10:42:00',
                'updated_at' => '2020-03-09 10:42:00',
            ],
            13 => [
                'id_news' => '32',
                'meets_id' => '233',
                'text' => '<p>Kérjük, a módosításokat, lemondásokat péntek (03.06) este 19.00-ig küljdék el a nevezes@kvsc.info e-mail címre!&nbsp;<span style="color: rgb(255, 0, 0); font-size: 0.875rem;">A rajtlista és az időterv csak előzetes, tájékoztató jellegű, a lemondások, visszalépések alapján még változni fog. Végleges rajtlista szombat reggel 9.00-kor lesz.&nbsp;</span><a href="https://youtu.be/PyEPXWXms5E" target="_blank" style="font-size: 0.875rem; background-color: rgb(255, 255, 255); color: rgb(0, 0, 255); font-weight: bold;">Youtube</a></p>',
                'created_at' => '2020-03-07 08:57:07',
                'updated_at' => '2020-03-07 08:57:07',
            ],
            14 => [
                'id_news' => '33',
                'meets_id' => '233',
                'text' => '<p><span style="font-size: 0.875rem; color: rgb(85, 85, 85);">Kérjük, a módosításokat, lemondásokat vasárnap </span><span style="font-size: 0.875rem; color: rgb(255, 0, 0); font-weight: bold;">09.00-ig</span><span style="font-size: 0.875rem; color: rgb(85, 85, 85);"> küldjék el a nevezes@kvsc.info e-mail címre, vagy adják le a versenyirodán!&nbsp;</span><span style="color: rgb(255, 0, 0); font-size: 0.875rem;">&nbsp;</span><a href="https://youtu.be/PyEPXWXms5E" target="_blank" style="font-size: 0.875rem; background-color: rgb(255, 255, 255); color: rgb(0, 0, 255); font-weight: bold;">Youtube</a></p>',
                'created_at' => '2020-03-07 13:47:46',
                'updated_at' => '2020-03-07 13:47:46',
            ],
            15 => [
                'id_news' => '34',
                'meets_id' => '233',
                'text' => '<p><span style="font-size: 0.875rem; color: rgb(85, 85, 85);">Kérjük, a módosításokat, lemondásokat vasárnap </span><span style="font-size: 0.875rem; color: rgb(255, 0, 0); font-weight: bold;">09.00-ig</span><span style="font-size: 0.875rem; color: rgb(85, 85, 85);"> küldjék el a nevezes@kvsc.info e-mail címre, vagy adják le a versenyirodán!&nbsp;</span><span style="color: rgb(255, 0, 0); font-size: 0.875rem;">&nbsp;</span><a href="https://youtu.be/Rpy61KEQXOI" target="_blank" style="font-size: 0.875rem; background-color: rgb(255, 255, 255); color: rgb(0, 0, 255); font-weight: bold;">Youtube</a></p>',
                'created_at' => '2020-03-08 10:36:20',
                'updated_at' => '2020-03-08 10:36:20',
            ],
            16 => [
                'id_news' => '46',
                'meets_id' => '235',
                'text' => '<p><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a nevezési listában (</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a>)<span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);"> ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.</span></p>',
                'created_at' => '2020-11-29 09:21:59',
                'updated_at' => '2020-11-29 09:21:59',
            ],
            17 => [
                'id_news' => '47',
                'meets_id' => '235',
                'text' => '<h3><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h3><p><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a nevezési listában (</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a>)<span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);"> ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.</span></p>',
                'created_at' => '2020-11-29 09:28:23',
                'updated_at' => '2020-11-29 09:28:23',
            ],
            18 => [
                'id_news' => '48',
                'meets_id' => '235',
                'text' => '<h3 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h3><p style="line-height: 0.8;"><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a nevezési listában (</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a>)<span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);"> ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.</span></p>',
                'created_at' => '2020-11-29 09:29:13',
                'updated_at' => '2020-11-29 09:29:13',
            ],
            19 => [
                'id_news' => '49',
                'meets_id' => '235',
                'text' => '<h3 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h3><p style="line-height: 0.8;"><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a nevezési listában (</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">) e</span><span style="font-size: 0.875rem; color: rgb(255, 0, 0);">llenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.</span></p>',
                'created_at' => '2020-11-29 14:46:19',
                'updated_at' => '2020-11-29 14:46:19',
            ],
            20 => [
                'id_news' => '50',
                'meets_id' => '235',
                'text' => '<h3 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h3><p style="line-height: 0.8;"><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a nevezési listában (</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a>,<span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">&nbsp;</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a>)&nbsp;<span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">e</span><span style="font-size: 0.875rem; color: rgb(255, 0, 0);">llenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.</span></p>',
                'created_at' => '2020-11-29 14:47:28',
                'updated_at' => '2020-11-29 14:47:28',
            ],
            21 => [
                'id_news' => '51',
                'meets_id' => '235',
                'text' => '<h3 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h3><p style="line-height: 0.8;"><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a <a href="/htmls/nevezesilista_v00.htm" target="_blank">nevezési listában</a> (</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a>,<span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">&nbsp;</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a>)&nbsp;<span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">e</span><span style="font-size: 0.875rem; color: rgb(255, 0, 0);">llenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.</span></p>',
                'created_at' => '2020-11-29 15:03:57',
                'updated_at' => '2020-11-29 15:03:57',
            ],
            22 => [
                'id_news' => '52',
                'meets_id' => '235',
                'text' => '<h3 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h3><p style="line-height: 0.8;"><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a <a href="/htmls/nevezesilista_v00.htm" target="_blank">nevezési listában</a> (</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a>,<span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">&nbsp;</span><a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank"><i class="icon-file-pdf1"></i> Csatolmány</a>)&nbsp;<span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">e</span><span style="font-size: 0.875rem; color: rgb(255, 0, 0);">llenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.</span></p><p style="line-height: 0.8;"><br></p><p style="line-height: 0.8;"><span style="font-size: 0.875rem; color: rgb(255, 0, 0);">Az egyes szakaszok végleges rajtlistái a versenynapok reggelén kerünekl kiadásra 8.00-kor.</span></p>',
                'created_at' => '2020-11-29 15:06:11',
                'updated_at' => '2020-11-29 15:06:11',
            ],
            23 => [
                'id_news' => '53',
                'meets_id' => '235',
                'text' => '<h3 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h3><p style="line-height: 0.8;"><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">Kérjük valamennyi csapatvezetőt, hogy a <a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank">nevezési listában</a>&nbsp;</span><span style="color: rgb(255, 0, 0); background-color: rgb(255, 255, 255);">e</span><span style="font-size: 0.875rem; color: rgb(255, 0, 0);">llenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.</span></p><p style="line-height: 0.8;"><br></p><p style="line-height: 0.8;"><span style="font-size: 0.875rem; color: rgb(255, 0, 0);">Az egyes szakaszok végleges rajtlistái a versenynapok reggelén kerünekl kiadásra 8.00-kor.</span></p>',
                'created_at' => '2020-11-29 18:01:27',
                'updated_at' => '2020-11-29 18:01:27',
            ],
            24 => [
                'id_news' => '54',
                'meets_id' => '235',
                'text' => '<h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h4><p style="line-height: 1.5;"><span style="color: rgb(255, 0, 0);">Kérjük valamennyi csapatvezetőt, hogy a <a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank" style="">nevezési listában</a>&nbsp;ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.&nbsp;<span style="font-size: 0.875rem;">Az egyes szakaszok végleges rajtlistái a versenynapok reggelén kerünekl kiadásra 8.00-kor.</span></span></p>',
                'created_at' => '2020-12-02 04:32:17',
                'updated_at' => '2020-12-02 04:32:17',
            ],
            25 => [
                'id_news' => '55',
                'meets_id' => '235',
                'text' => '<h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h4><p style="line-height: 1.5;"><span style="color: rgb(255, 0, 0);">Kérjük valamennyi csapatvezetőt, hogy a <a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank" style="">nevezési listában</a>&nbsp;ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="mailto:nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.&nbsp;<span style="font-size: 0.875rem;">Az egyes szakaszok végleges rajtlistái a versenynapok reggelén kerünekl kiadásra 8.00-kor.</span></span></p>',
                'created_at' => '2020-12-02 10:44:10',
                'updated_at' => '2020-12-02 10:44:10',
            ],
            26 => [
                'id_news' => '56',
                'meets_id' => '235',
                'text' => '<h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán! </span></h4><p style="line-height: 1.5;"><span style="color: rgb(255, 0, 0);">Kérjük valamennyi csapatvezetőt, hogy a <a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank" style="">nevezési listában</a>&nbsp;ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="mailto:nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.&nbsp;<span style="font-size: 0.875rem;">Az egyes szakaszok végleges rajtlistái a versenynapok reggelén kerünekl kiadásra 8.00-kor.&nbsp;</span></span></p><p style="line-height: 1.5;"><font color="#ff0000">Élő közvetetítés az alábbi<a href="https://youtu.be/eH_K1ZY1AJ4" target="_blank"> LINK-en</a> érhető el.&nbsp;<a href="https://youtu.be/eH_K1ZY1AJ4" target="_blank">https://youtu.be/eH_K1ZY1AJ4</a></font></p>',
                'created_at' => '2020-12-04 10:20:59',
                'updated_at' => '2020-12-04 10:20:59',
            ],
            27 => [
                'id_news' => '57',
                'meets_id' => '235',
                'text' => '<h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán</span></h4><h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255); color: rgb(255, 0, 0);">FIGYELEM! A vasárnap délutáni program 13.00-kor kezdődik, a bemelegítés 12.00-kor.</span></h4><p style="line-height: 1.5;"><span style="color: rgb(255, 0, 0);">Kérjük valamennyi csapatvezetőt, hogy a <a href="/pdf/2020_12_04_Del-Alfoldi/csatolmany1.pdf" target="_blank" style="">nevezési listában</a>&nbsp;ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a <a href="mailto:nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a> címen.&nbsp;<span style="font-size: 0.875rem;">Az egyes szakaszok végleges rajtlistái a versenynapok reggelén kerünekl kiadásra 8.00-kor.&nbsp;</span></span></p><p style="line-height: 1.5;"><font color="#ff0000">Élő közvetetítés az alábbi<a href="https://youtu.be/eH_K1ZY1AJ4" target="_blank"> LINK-en</a> érhető el.&nbsp;<a href="https://youtu.be/eH_K1ZY1AJ4" target="_blank">https://youtu.be/eH_K1ZY1AJ4</a></font></p>',
                'created_at' => '2020-12-06 09:01:32',
                'updated_at' => '2020-12-06 09:01:32',
            ],
            28 => [
                'id_news' => '58',
                'meets_id' => '235',
                'text' => '<h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán</span></h4><h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255); color: rgb(255, 0, 0);">FIGYELEM! A vasárnap délutáni program 13.00-kor kezdődik, a bemelegítés 12.00-kor.</span></h4><p style="line-height: 1.5;"><span style="color: rgb(255, 0, 0); font-size: 0.875rem;">Élő közvetetítés az alábbi</span><a href="https://youtu.be/eH_K1ZY1AJ4" target="_blank" style="background-color: rgb(255, 255, 255); font-size: 0.875rem;"> LINK-en</a><span style="color: rgb(255, 0, 0); font-size: 0.875rem;"> érhető el.&nbsp;</span><a href="https://youtu.be/eH_K1ZY1AJ4" target="_blank" style="background-color: rgb(255, 255, 255); font-size: 0.875rem;">https://youtu.be/eH_K1ZY1AJ4</a><br></p>',
                'created_at' => '2020-12-06 09:19:19',
                'updated_at' => '2020-12-06 09:19:19',
            ],
            29 => [
                'id_news' => '59',
                'meets_id' => '235',
                'text' => '<h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán</span></h4><h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255); color: rgb(255, 0, 0);">Gratulálunk az elért eredményekhez versenyzőknek, edzőknek egyaránt! Köszönjük a részvételt!</span></h4>',
                'created_at' => '2020-12-06 19:55:44',
                'updated_at' => '2020-12-06 19:55:44',
            ],
            30 => [
                'id_news' => '60',
                'meets_id' => '235',
                'text' => '<h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255);">Üdvözöljük a 2020. évi Dél-Alföldi Régió delfin, cápa, gyermek korosztályos regionális bajnokság hivatalos oldalán</span></h4><h4 style="line-height: 1.5;"><span style="background-color: rgb(255, 255, 255); color: rgb(255, 0, 0);">Gratulálunk az elért eredményekhez versenyzőknek, edzőknek egyaránt! Köszönjük a részvételt! Elérhető a <a href="http://meet.kvsc.info/pdf/2020_12_04_Del-Alfoldi/race_record.pdf" target="_blank">jegyzőkönyv</a>, illetve a lenyitható mezőben több összesítés is a versenyről.</span></h4>',
                'created_at' => '2020-12-06 21:06:38',
                'updated_at' => '2020-12-06 21:06:38',
            ],
            31 => [
                'id_news' => '71',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span> (<a href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az <span style="background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 01.28-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 7.30-kor.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;"><span style="background-color: #fbeeb8;">Rendk&iacute;v&uuml;li k&ouml;zlem&eacute;ny:</span> T&ouml;bb versenysz&aacute;mban (400 gyors, 400 vegyes, 200 gyors, stb) teljes futamok vannak jelenleg &eacute;s &uacute;jabb futamot nem ind&iacute;tunk, ezen versenysz&aacute;mokban v&aacute;r&oacute;lista alakult ki, ez&eacute;rt k&eacute;rj&uuml;k, hogy a lemond&aacute;sokat, visszal&eacute;p&eacute;seket mielőbb k&uuml;ldj&eacute;k meg az edzők, csapatvezetők.</span></p>',
                'created_at' => '2021-01-23 06:00:17',
                'updated_at' => '2021-01-23 06:00:17',
            ],
            32 => [
                'id_news' => '67',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 0.6;">Üdvözöljük a X. Aranyhomok Kupa úszóverseny hivatalos oldalán!</h4><h1 style="line-height: 0.6;"><p style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: rgb(255, 0, 0);">Kérjük valamennyi csapatvezetőt, hogy a nevezési listában (<a href="https://meet.kvsc.info/races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank">nevezések/eredmények menüpont</a>)&nbsp;</span><span style="color: rgb(255, 0, 0);">ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a&nbsp;<a href="https://meet.kvsc.info/admin/meets/235/nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a>&nbsp;címen.</span></p></h1>',
                'created_at' => '2021-01-17 09:59:00',
                'updated_at' => '2021-01-17 09:59:00',
            ],
            33 => [
                'id_news' => '68',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 0.6;">Üdvözöljük a X. Aranyhomok Kupa úszóverseny hivatalos oldalán!</h4><h1 style="line-height: 0.6;"><p style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: rgb(255, 0, 0);">Kérjük valamennyi csapatvezetőt, hogy a <span style="background-color: rgb(255, 255, 0);">nevezési listában</span> (<a href="https://meet.kvsc.info/races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank">nevezések/eredmények menüpont</a>)&nbsp;</span><span style="color: rgb(255, 0, 0);">ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a&nbsp;<a href="https://meet.kvsc.info/admin/meets/235/nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a>&nbsp;címen. A várható futamszámokat, kezdési időket az <span style="background-color: rgb(255, 255, 0);">időtervben</span> lehet nyomon követni. Az előzetes rajtlista 01.28-án kerül elkészítésre, míg a végleges rajtlista az adott versenynapon reggel 7.30-kor.&nbsp;</span></p></h1>',
                'created_at' => '2021-01-17 10:07:49',
                'updated_at' => '2021-01-17 10:07:49',
            ],
            34 => [
                'id_news' => '69',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">Üdvözöljük a X. Aranyhomok Kupa úszóverseny hivatalos oldalán!</h4><h1 style="line-height: 0.6;"><p style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: rgb(255, 0, 0);">Kérjük valamennyi csapatvezetőt, hogy a <span style="background-color: rgb(255, 255, 0);">nevezési listában</span> (<a href="https://meet.kvsc.info/races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank">nevezések/eredmények menüpont</a>)&nbsp;</span><span style="color: rgb(255, 0, 0);">ellenőrizze a leadott nevezéseket. Módosítási igényüket e-mailen jelezzék a&nbsp;<a href="https://meet.kvsc.info/admin/meets/235/nevezes@kvsc.info" target="_blank">nevezes@kvsc.info</a>&nbsp;címen. A várható futamszámokat, kezdési időket az <span style="background-color: rgb(255, 255, 0);">időtervben</span> lehet nyomon követni. Az előzetes rajtlista 01.28-án kerül elkészítésre, míg a végleges rajtlista az adott versenynapon reggel 7.30-kor.&nbsp;</span></p></h1>',
                'created_at' => '2021-01-17 13:44:31',
                'updated_at' => '2021-01-17 13:44:31',
            ],
            35 => [
                'id_news' => '70',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span> (<a href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az <span style="background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 01.28-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 7.30-kor.&nbsp;</span></p>',
                'created_at' => '2021-01-20 16:11:59',
                'updated_at' => '2021-01-20 16:11:59',
            ],
            36 => [
                'id_news' => '72',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span> (<a href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az <span style="background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 8.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;">Elő k&ouml;zvet&iacute;t&eacute;s:&nbsp;</span></span><span style="color: #ff0000; font-family: Lato, sans-serif;">rtmp://a.rtmp.youtube.com/live2</span></p>',
                'created_at' => '2021-01-30 07:13:24',
                'updated_at' => '2021-01-30 07:13:24',
            ],
            37 => [
                'id_news' => '73',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span> (<a href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az <span style="background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 8.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><a href="rtmp://a.rtmp.youtube.com/live2" target="_blank" rel="noopener"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;">Elő k&ouml;zvet&iacute;t&eacute;s</span></span></a></p>',
                'created_at' => '2021-01-30 07:28:46',
                'updated_at' => '2021-01-30 07:28:46',
            ],
            38 => [
                'id_news' => '74',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span> (<a href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az <span style="background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 8.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><a href="https://youtu.be/lcvmS2T8_GM" target="_blank" rel="noopener"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;">Elő k&ouml;zvet&iacute;t&eacute;s</span></span></a></p>',
                'created_at' => '2021-01-30 08:29:34',
                'updated_at' => '2021-01-30 08:29:34',
            ],
            39 => [
                'id_news' => '75',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span> (<a href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az <span style="background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 8.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/lcvmS2T8_GM">1. nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/4P8-bMTA5F0">2.nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>',
                'created_at' => '2021-01-31 08:55:53',
                'updated_at' => '2021-01-31 08:55:53',
            ],
            40 => [
                'id_news' => '76',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span> (<a href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az <span style="background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 8.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/lcvmS2T8_GM" target="_blank" rel="noopener">1. nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/4P8-bMTA5F0" target="_blank" rel="noopener">2.nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>',
                'created_at' => '2021-01-31 08:56:59',
                'updated_at' => '2021-01-31 08:56:59',
            ],
            41 => [
                'id_news' => '77',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span> (<a href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az <span style="background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 8.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/lcvmS2T8_GM" target="_blank" rel="noopener">1. nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/4P8-bMTA5F0" target="_blank" rel="noopener">2. nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>',
                'created_at' => '2021-01-31 08:57:55',
                'updated_at' => '2021-01-31 08:57:55',
            ],
            42 => [
                'id_news' => '78',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span> (<a href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az <span style="background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 8.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/lcvmS2T8_GM" target="_blank" rel="noopener">1. nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/4P8-bMTA5F0" target="_blank" rel="noopener">2. nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><a href="https://youtu.be/AqYZql40dLw" target="_blank" rel="noopener"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;">Folytat&aacute;s 2. nap</span></span></a></p>',
                'created_at' => '2021-01-31 09:47:20',
                'updated_at' => '2021-01-31 09:47:20',
            ],
            43 => [
                'id_news' => '79',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">Gratul&aacute;lunk a versenyen el&eacute;rt eredm&eacute;nyekhez versenyzőknek, edzőknek egyar&aacute;nt. Tov&aacute;bbi eredm&eacute;nyes felk&eacute;sz&uuml;l&eacute;st &eacute;s COVID mentes j&oacute; eg&eacute;szs&eacute;get k&iacute;v&aacute;nunk.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/lcvmS2T8_GM" target="_blank" rel="noopener">1. nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;"><a href="https://youtu.be/4P8-bMTA5F0" target="_blank" rel="noopener">2. nap &eacute;lő k&ouml;zvet&iacute;t&eacute;s</a></span></span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><a href="https://youtu.be/AqYZql40dLw" target="_blank" rel="noopener"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000;"><span style="background-color: #fbeeb8;">Folytat&aacute;s 2. nap</span></span></a></p>',
                'created_at' => '2021-01-31 20:55:46',
                'updated_at' => '2021-01-31 20:55:46',
            ],
            44 => [
                'id_news' => '80',
                'meets_id' => '237',
                'text' => '<h4 style="line-height: 1.4;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a X. Aranyhomok Kupa &uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</h4>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="color: #ff0000;">Gratul&aacute;lunk a versenyen el&eacute;rt eredm&eacute;nyekhez versenyzőknek, edzőknek egyar&aacute;nt. Tov&aacute;bbi eredm&eacute;nyes felk&eacute;sz&uuml;l&eacute;st &eacute;s COVID mentes j&oacute; eg&eacute;szs&eacute;get k&iacute;v&aacute;nunk.&nbsp;</span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000; background-color: #bfedd2;"><a style="background-color: #bfedd2;" href="https://youtu.be/lcvmS2T8_GM" target="_blank" rel="noopener">1. nap k&ouml;zvet&iacute;t&eacute;s</a></span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000; background-color: #bfedd2;"><a style="background-color: #bfedd2;" href="https://youtu.be/4P8-bMTA5F0" target="_blank" rel="noopener">2. nap k&ouml;zvet&iacute;t&eacute;s</a></span></p>
<p style="color: #555555; font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.2;"><span style="background-color: #bfedd2;"><a style="background-color: #bfedd2;" href="https://youtu.be/AqYZql40dLw" target="_blank" rel="noopener"><span style="font-family: Lato, sans-serif; font-size: 16px; font-weight: 400; color: #ff0000; background-color: #bfedd2;">2.nap, 2. r&eacute;sz k&ouml;zvet&iacute;t&eacute;s</span></a></span></p>',
                'created_at' => '2021-01-31 21:00:27',
                'updated_at' => '2021-01-31 21:00:27',
            ],
            45 => [
                'id_news' => '81',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. Az előzetes rajtlista 04.23-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 7.30-kor.&nbsp;</span></p>',
                'created_at' => '2021-04-18 21:06:18',
                'updated_at' => '2021-04-18 21:06:18',
            ],
            46 => [
                'id_news' => '82',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. Az előzetes rajtlista 04.23-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 7.30-kor.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>',
                'created_at' => '2021-04-18 21:13:21',
                'updated_at' => '2021-04-18 21:13:21',
            ],
            47 => [
                'id_news' => '83',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. Az előzetes rajtlista 04.23-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 7.30-kor.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Az egyes&uuml;letek a medencet&eacute;ri lel&aacute;t&oacute;n az al&aacute;bbi elrendez&eacute;sben helyezkednek el (Szombat, Vas&aacute;rnap). K&eacute;rj&uuml;k ennek betart&aacute;s&aacute;t.</span></p>',
                'created_at' => '2021-04-22 05:29:09',
                'updated_at' => '2021-04-22 05:29:09',
            ],
            48 => [
                'id_news' => '84',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. Az előzetes rajtlista 04.23-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 7.30-kor.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Az egyes&uuml;letek a medencet&eacute;ri lel&aacute;t&oacute;n az al&aacute;bbi elrendez&eacute;sben helyezkednek el (<a href="../../../pdf/2021_04_24_XXXVI./Kmet_Szombat_lelato_ulesrend.pdf" target="_blank" rel="noopener">Szombat</a>, <a href="../../../pdf/2021_04_24_XXXVI./Kmet_Vasarnap_lelato_ulesrend.pdf" target="_blank" rel="noopener">Vas&aacute;rnap</a>). K&eacute;rj&uuml;k ennek betart&aacute;s&aacute;t.</span></p>',
                'created_at' => '2021-04-22 05:29:55',
                'updated_at' => '2021-04-22 05:29:55',
            ],
            49 => [
                'id_news' => '85',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<span style="color: #843fa1;">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</span>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. Az előzetes rajtlista 04.23-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 7.30-kor.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Az egyes&uuml;letek a medencet&eacute;ri lel&aacute;t&oacute;n az al&aacute;bbi elrendez&eacute;sben helyezkednek el (<a href="../../../pdf/2021_04_24_XXXVI./Kmet_Szombat_lelato_ulesrend.pdf" target="_blank" rel="noopener">Szombat</a>, <a href="../../../pdf/2021_04_24_XXXVI./Kmet_Vasarnap_lelato_ulesrend.pdf" target="_blank" rel="noopener">Vas&aacute;rnap</a>). K&eacute;rj&uuml;k ennek betart&aacute;s&aacute;t.</span></p>',
                'created_at' => '2021-04-22 05:39:31',
                'updated_at' => '2021-04-22 05:39:31',
            ],
            50 => [
                'id_news' => '86',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<span style="color: #843fa1;">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</span>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. Az <a href="../../../pdf/2021_04_24_XXXVI./2021-04-24_25_BacsvizKupa_Rajtlista_v00.pdf" target="_blank" rel="noopener">előzetes rajtlista</a> 04.23-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 8.00-kor.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Az egyes&uuml;letek a medencet&eacute;ri lel&aacute;t&oacute;n az al&aacute;bbi elrendez&eacute;sben helyezkednek el (<a href="../../../pdf/2021_04_24_XXXVI./Kmet_Szombat_lelato_ulesrend.pdf" target="_blank" rel="noopener">Szombat</a>, <a href="../../../pdf/2021_04_24_XXXVI./Kmet_Vasarnap_lelato_ulesrend.pdf" target="_blank" rel="noopener">Vas&aacute;rnap</a>). K&eacute;rj&uuml;k ennek betart&aacute;s&aacute;t.</span></p>',
                'created_at' => '2021-04-23 07:08:44',
                'updated_at' => '2021-04-23 07:08:44',
            ],
            51 => [
                'id_news' => '87',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<span style="color: #843fa1;">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</span>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Az egyes&uuml;letek a medencet&eacute;ri lel&aacute;t&oacute;n az al&aacute;bbi elrendez&eacute;sben helyezkednek el (<a href="../../../pdf/2021_04_24_XXXVI./Kmet_Szombat_lelato_ulesrend.pdf" target="_blank" rel="noopener">Szombat</a>, <a href="../../../pdf/2021_04_24_XXXVI./Kmet_Vasarnap_lelato_ulesrend.pdf" target="_blank" rel="noopener">Vas&aacute;rnap</a>). K&eacute;rj&uuml;k ennek betart&aacute;s&aacute;t.</span></p>',
                'created_at' => '2021-04-24 08:21:42',
                'updated_at' => '2021-04-24 08:21:42',
            ],
            52 => [
                'id_news' => '88',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<span style="color: #843fa1;">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</span>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Az egyes&uuml;letek a medencet&eacute;ri lel&aacute;t&oacute;n az al&aacute;bbi elrendez&eacute;sben helyezkednek el (<a href="../../../pdf/2021_04_24_XXXVI./Kmet_Szombat_lelato_ulesrend.pdf" target="_blank" rel="noopener">Szombat</a>, <a href="../../../pdf/2021_04_24_XXXVI./Kmet_Vasarnap_lelato_ulesrend.pdf" target="_blank" rel="noopener">Vas&aacute;rnap</a>). K&eacute;rj&uuml;k ennek betart&aacute;s&aacute;t.</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Online k&ouml;zvet&iacute;t&eacute;s: <a href="rtmp://a.rtmp.youtube.com/live2" target="_blank" rel="noopener">1. nap LINK</a></span></p>',
                'created_at' => '2021-04-24 08:26:31',
                'updated_at' => '2021-04-24 08:26:31',
            ],
            53 => [
                'id_news' => '89',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<span style="color: #843fa1;">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</span>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Az egyes&uuml;letek a medencet&eacute;ri lel&aacute;t&oacute;n az al&aacute;bbi elrendez&eacute;sben helyezkednek el (<a href="../../../pdf/2021_04_24_XXXVI./Kmet_Szombat_lelato_ulesrend.pdf" target="_blank" rel="noopener">Szombat</a>, <a href="../../../pdf/2021_04_24_XXXVI./Kmet_Vasarnap_lelato_ulesrend.pdf" target="_blank" rel="noopener">Vas&aacute;rnap</a>). K&eacute;rj&uuml;k ennek betart&aacute;s&aacute;t.</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Online k&ouml;zvet&iacute;t&eacute;s: <a href="https://youtu.be/7C8-TXqspMw" target="_blank" rel="noopener">1. nap LINK</a></span></p>',
                'created_at' => '2021-04-24 08:50:25',
                'updated_at' => '2021-04-24 08:50:25',
            ],
            54 => [
                'id_news' => '90',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a m</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a> c&iacute;men.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Online k&ouml;zvet&iacute;t&eacute;s: <a href="https://youtu.be/7C8-TXqspMw" target="_blank" rel="noopener">1. nap LINK</a></span></p>',
                'created_at' => '2021-04-24 09:13:55',
                'updated_at' => '2021-04-24 09:13:55',
            ],
            55 => [
                'id_news' => '91',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a lemond&aacute;sokat a versenyirod&aacute;n, vagy</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> e-mailen a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a> c&iacute;men&nbsp;</span><span style="background-color: #ffffff; color: #ff0000; font-family: Lato, sans-serif; font-size: 16px;">jelezz&eacute;k</span><span style="background-color: #ffffff; color: #ff0000; font-family: Lato, sans-serif; font-size: 16px;"> reggel 8-ig</span><span style="background-color: #ffffff; color: #ff0000; font-family: Lato, sans-serif; font-size: 16px;">.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Online k&ouml;zvet&iacute;t&eacute;s: <a href="https://youtu.be/7C8-TXqspMw" target="_blank" rel="noopener">1. nap LINK</a></span></p>',
                'created_at' => '2021-04-24 09:20:43',
                'updated_at' => '2021-04-24 09:20:43',
            ],
            56 => [
                'id_news' => '92',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a lemond&aacute;sokat a versenyirod&aacute;n, vagy</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> e-mailen a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a> c&iacute;men&nbsp;</span><span style="background-color: #ffffff; color: #ff0000; font-family: Lato, sans-serif; font-size: 16px;">jelezz&eacute;k</span><span style="background-color: #ffffff; color: #ff0000; font-family: Lato, sans-serif; font-size: 16px;"> reggel 8-ig</span><span style="background-color: #ffffff; color: #ff0000; font-family: Lato, sans-serif; font-size: 16px;">.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff;"> Lel&aacute;t&oacute;rend: </span><a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; font-family: Lato, sans-serif; font-size: 16px;" href="../../../pdf/2021_04_24_XXXVI./Kmet_Szombat_lelato_ulesrend.pdf" target="_blank" rel="noopener">Szombat</a><span style="color: #ff0000; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff;">,&nbsp;</span><a style="box-sizing: border-box; color: #1d68a7; font-family: Lato, sans-serif; font-size: 16px; outline: none !important;" href="../../../pdf/2021_04_24_XXXVI./Kmet_Vasarnap_lelato_ulesrend.pdf" target="_blank" rel="noopener">Vas&aacute;rnap</a></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Online k&ouml;zvet&iacute;t&eacute;s: <a href="https://youtu.be/7C8-TXqspMw" target="_blank" rel="noopener">1. nap LINK</a></span></p>',
                'created_at' => '2021-04-24 09:51:37',
                'updated_at' => '2021-04-24 09:51:37',
            ],
            57 => [
                'id_news' => '93',
                'meets_id' => '238',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a lemond&aacute;sokat a versenyirod&aacute;n, vagy</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> e-mailen a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a> c&iacute;men&nbsp;</span><span style="background-color: #ffffff; color: #ff0000; font-family: Lato, sans-serif; font-size: 16px;">jelezz&eacute;k</span><span style="background-color: #ffffff; color: #ff0000; font-family: Lato, sans-serif; font-size: 16px;"> reggel 8-ig</span><span style="background-color: #ffffff; color: #ff0000; font-family: Lato, sans-serif; font-size: 16px;">.&nbsp;</span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">T&aacute;j&eacute;koztat&oacute; a versenyről, COVID nyilatkozatok itt &eacute;rhetők el (<a href="../../../pdf/2021_04_24_XXXVI./Bacsviz_Kupa_Kozerdeku_Infok.pdf" target="_blank" rel="noopener">t&aacute;j&eacute;koztat&oacute;</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Kiskor&uacute;%20Sportol&oacute;_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">kiskor&uacute; COVID</a>, <a href="../../../pdf/2021_04_24_XXXVI./COVID%20Nyilatkozat_Felnőtt_XXXVI.%20B&aacute;csv&iacute;z%20Kupa.pdf" target="_blank" rel="noopener">felnőtt COVID</a>)&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff;"> Lel&aacute;t&oacute;rend: </span><a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; font-family: Lato, sans-serif; font-size: 16px;" href="../../../pdf/2021_04_24_XXXVI./Kmet_Szombat_lelato_ulesrend.pdf" target="_blank" rel="noopener">Szombat</a><span style="color: #ff0000; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff;">,&nbsp;</span><a style="box-sizing: border-box; color: #1d68a7; font-family: Lato, sans-serif; font-size: 16px; outline: none !important;" href="../../../pdf/2021_04_24_XXXVI./Kmet_Vasarnap_lelato_ulesrend.pdf" target="_blank" rel="noopener">Vas&aacute;rnap</a></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Online k&ouml;zvet&iacute;t&eacute;s:</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">&nbsp;<a href="https://youtu.be/7C8-TXqspMw" target="_blank" rel="noopener">1. nap LINK</a></span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">&nbsp;-&nbsp;</span><a href="https://youtu.be/9wXAXxtRFkI" target="_blank" rel="noopener"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">2. nap LINK</span></a></p>',
                'created_at' => '2021-04-25 08:42:05',
                'updated_at' => '2021-04-25 08:42:05',
            ],
            58 => [
                'id_news' => '94',
                'meets_id' => '238',
                'text' => '<p><span style="color: #ecf0f1; background-color: #e03e2d;">Gratul&aacute;lunk az el&eacute;rt eredm&eacute;nyekhez sportol&oacute;nak, edzőnek egyar&aacute;nt. Tov&aacute;bbi eredm&eacute;nyes felk&eacute;sz&uuml;l&eacute;st, versenyz&eacute;st &eacute;s COVID mentes mindennapokat.&nbsp;</span></p>',
                'created_at' => '2021-04-26 07:14:45',
                'updated_at' => '2021-04-26 07:14:45',
            ],
            59 => [
                'id_news' => '95',
                'meets_id' => '238',
                'text' => '<p><span style="color: #ecf0f1; background-color: #e03e2d;">Gratul&aacute;lunk az el&eacute;rt eredm&eacute;nyekhez sportol&oacute;nak, edzőnek egyar&aacute;nt. Tov&aacute;bbi eredm&eacute;nyes felk&eacute;sz&uuml;l&eacute;st, versenyz&eacute;st &eacute;s COVID mentes mindennapokat.&nbsp;</span></p>
<p><span style="color: #000000; background-color: #ecf0f1;">R&ouml;gz&iacute;tett felv&eacute;tel: <a href="https://youtu.be/0UBz7uUpOGw" target="_blank" rel="noopener">1. nap</a> - <a href="https://youtu.be/9wXAXxtRFkI" target="_blank" rel="noopener">2. nap</a>&nbsp;</span></p>',
                'created_at' => '2021-04-27 05:25:07',
                'updated_at' => '2021-04-27 05:25:07',
            ],
            60 => [
                'id_news' => '96',
                'meets_id' => '239',
                'text' => '<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi versenyzőt, hogy a <span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000; outline: none !important;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon lesz el&eacute;rhető (szombat 13.00, vas&aacute;rnap 7.30).&nbsp;</span></p>',
                'created_at' => '2021-09-10 05:15:59',
                'updated_at' => '2021-09-10 05:15:59',
            ],
            61 => [
                'id_news' => '97',
                'meets_id' => '239',
                'text' => '<p><span style="color: #ff0000; font-family: Lato, sans-serif;"><span style="background-color: #ffffff;">Gratul&aacute;lunk az eredm&eacute;nyekhez, tov&aacute;bbi eredm&eacute;nyes felk&eacute;sz&uuml;l&eacute;st &eacute;s versenyz&eacute;st, j&oacute; eg&eacute;szs&eacute;get minden versenyzőnek, &eacute;rdeklődőnek.</span></span></p>',
                'created_at' => '2021-09-18 05:34:01',
                'updated_at' => '2021-09-18 05:34:01',
            ],
            62 => [
                'id_news' => '98',
                'meets_id' => '240',
                'text' => '<p>Tisztelt Csapatvezetők!</p>
<p>A 2021. &eacute;vi versenyre kiz&aacute;r&oacute;lag online lehet nevezni az al&aacute;bbi űrlap seg&iacute;ts&eacute;g&eacute;vel - <a title="Nevez&eacute;si űrlap" href="https://docs.google.com/forms/d/e/1FAIpQLSeFdGvryZfcMr-NRfuGtZ81HphLj2DL5f5qqlrOH6RRl8RZXw/viewform?usp=sf_link" target="_blank" rel="noopener">LINK</a>.&nbsp;</p>
<p>&nbsp;</p>
<p>A nevez&eacute;s menet a k&ouml;vetkező:</p>
<ol>
<li>V&aacute;laszd ki a csapatodat a list&aacute;b&oacute;l (ha nincs a list&aacute;ban v&aacute;laszd az "egy&eacute;b" mezőt</li>
<li>&Iacute;rd meg a versenyző vezet&eacute;k &eacute;s keresztnev&eacute;t k&uuml;l&ouml;n-k&uuml;l&ouml;n a megfelelő mezőkbe</li>
<li>Add meg a versenyző sz&uuml;let&eacute;snapj&aacute;t - az &eacute;v a fontos, &iacute;gy lehet a h&oacute;nap/nap 01.01 is.</li>
<li>V&aacute;laszd ki a versenyző nem&eacute; (f&eacute;rfi, nő)</li>
<li>V&aacute;laszd ki az első egy&eacute;ni versenysz&aacute;mot a list&aacute;b&oacute;l ha egy&eacute;niben is &uacute;szik a versenyző, figyelj a korcsoportra.</li>
<li>V&aacute;laszd ki a m&aacute;sodik egy&eacute;ni versenysz&aacute;mot a list&aacute;b&oacute;l ha van, figyelj a korcsoportra.</li>
<li>V&aacute;laszd ki a gyorsv&aacute;lt&oacute; korcsoportj&aacute;t, ha &uacute;szik az adott versenyző, ha nem &uacute;szik, marad a "-" jelzetű mező</li>
<li>V&aacute;laszd ki, hogy &uacute;szik-e a versenyző a mix v&aacute;lt&oacute;ban - igen, nem</li>
<li>Mentsd el az űrlapot.</li>
</ol>
<p>A megadott e-mail c&iacute;mre a rendszer elk&uuml;ldi a nevez&eacute;si lapot, &iacute;gy azt k&eacute;sőbb tudod m&oacute;dos&iacute;tani a nevez&eacute;s lez&aacute;r&aacute;s&aacute;ig: 2021.10.23-ig.</p>
<p>&Uacute;j versenyző eset&eacute;n t&ouml;ltsd ki &uacute;jra egy &uuml;res űrlapot.</p>
<p>K&eacute;rd&eacute;s eset&eacute;n keress a kolonics@kvsc.info c&iacute;men.</p>',
                'created_at' => '2021-09-26 11:52:05',
                'updated_at' => '2021-09-26 11:52:05',
            ],
            63 => [
                'id_news' => '99',
                'meets_id' => '240',
                'text' => '<p>Tisztelt Csapatvezetők!</p>
<p>A 2021. &eacute;vi versenyre kiz&aacute;r&oacute;lag online lehet nevezni az al&aacute;bbi űrlap seg&iacute;ts&eacute;g&eacute;vel - <a title="Nevez&eacute;si űrlap" href="https://docs.google.com/forms/d/e/1FAIpQLSeFdGvryZfcMr-NRfuGtZ81HphLj2DL5f5qqlrOH6RRl8RZXw/viewform?usp=sf_link" target="_blank" rel="noopener">LINK</a>.&nbsp;</p>
<p>A nevez&eacute;s menet a k&ouml;vetkező:</p>
<ol>
<li style="list-style-type: none;">
<ol>
<li>V&aacute;laszd ki a csapatodat a list&aacute;b&oacute;l (ha nincs a list&aacute;ban v&aacute;laszd az "egy&eacute;b" mezőt</li>
<li>&Iacute;rd meg a versenyző vezet&eacute;k &eacute;s keresztnev&eacute;t k&uuml;l&ouml;n-k&uuml;l&ouml;n a megfelelő mezőkbe</li>
<li>Add meg a versenyző sz&uuml;let&eacute;snapj&aacute;t - az &eacute;v a fontos, &iacute;gy lehet a h&oacute;nap/nap 01.01 is.</li>
<li>V&aacute;laszd ki a versenyző nem&eacute; (f&eacute;rfi, nő)</li>
<li>V&aacute;laszd ki az első egy&eacute;ni versenysz&aacute;mot a list&aacute;b&oacute;l ha egy&eacute;niben is &uacute;szik a versenyző, figyelj a korcsoportra.</li>
<li>V&aacute;laszd ki a m&aacute;sodik egy&eacute;ni versenysz&aacute;mot a list&aacute;b&oacute;l ha van, figyelj a korcsoportra.</li>
<li>V&aacute;laszd ki a gyorsv&aacute;lt&oacute; korcsoportj&aacute;t, ha &uacute;szik az adott versenyző, ha nem &uacute;szik, marad a "-" jelzetű mező</li>
<li>V&aacute;laszd ki, hogy &uacute;szik-e a versenyző a mix v&aacute;lt&oacute;ban - igen, nem</li>
<li>Mentsd el az űrlapot.</li>
</ol>
</li>
</ol>
<p>A megadott e-mail c&iacute;mre a rendszer elk&uuml;ldi a nevez&eacute;si lapot, &iacute;gy azt k&eacute;sőbb tudod m&oacute;dos&iacute;tani a nevez&eacute;s lez&aacute;r&aacute;s&aacute;ig: 2021.10.23-ig.</p>
<p>&Uacute;j versenyző eset&eacute;n t&ouml;ltsd ki &uacute;jra egy &uuml;res űrlapot.</p>
<p>K&eacute;rd&eacute;s eset&eacute;n keress a kolonics@kvsc.info c&iacute;men.</p>',
                'created_at' => '2021-09-26 11:52:33',
                'updated_at' => '2021-09-26 11:52:33',
            ],
            64 => [
                'id_news' => '100',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><strong><span style="color: #e03e2d;">FELH&Iacute;V&Aacute;S: A verseny a fokozódó járványhelyzetre való tekintettel zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</span></strong></p>
<strong><span style="color: #e03e2d;"> </span></strong></div>
<strong><span style="color: #e03e2d;"> </span></strong></div>
<strong><span style="color: #e03e2d;"> </span></strong></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor.&nbsp;</span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-09-26 12:07:34',
                'updated_at' => '2021-09-26 12:07:34',
            ],
            65 => [
                'id_news' => '101',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff;"><strong>FELH&Iacute;V&Aacute;S: A verseny a fokozódó járványhelyzetre való tekintettel zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<span style="background-color: #e03e2d; color: #ffffff;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor.&nbsp;</span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-09-27 04:40:41',
                'updated_at' => '2021-09-27 04:40:41',
            ],
            66 => [
                'id_news' => '102',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff;"><strong>FELH&Iacute;V&Aacute;S: A verseny a fokozódó járványhelyzetre való tekintettel zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<span style="background-color: #e03e2d; color: #ffffff;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor.&nbsp;</span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Az uszod&aacute;ban a verseny ideje alatt nem kell maszkot haszn&aacute;lni &eacute;s nyilatkozatot sem k&eacute;r&uuml;nk előzetesen.&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">A nevez&eacute;si d&iacute;jakat k&eacute;rj&uuml;k a helysz&iacute;nen k&eacute;szp&eacute;nzben rendezz&eacute;k.</span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-09-30 08:33:01',
                'updated_at' => '2021-09-30 08:33:01',
            ],
            67 => [
                'id_news' => '103',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff;"><strong>FELH&Iacute;V&Aacute;S: A verseny zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<p><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">Az uszod&aacute;ban a verseny ideje alatt nem kell maszkot haszn&aacute;lni &eacute;s nyilatkozatot sem k&eacute;r&uuml;nk előzetesen.&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">A nevez&eacute;si d&iacute;jakat k&eacute;rj&uuml;k a helysz&iacute;nen k&eacute;szp&eacute;nzben rendezz&eacute;k</span></p>
<span style="background-color: #e03e2d; color: #ffffff;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;">.</span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-09-30 08:34:29',
                'updated_at' => '2021-09-30 08:34:29',
            ],
            68 => [
                'id_news' => '104',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff; font-size: 10pt;"><strong>FELH&Iacute;V&Aacute;S: A verseny zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<p><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">Az uszod&aacute;ban a verseny ideje alatt nem kell maszkot haszn&aacute;lni &eacute;s nyilatkozatot sem k&eacute;r&uuml;nk előzetesen.&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">A nevez&eacute;si d&iacute;jakat k&eacute;rj&uuml;k a helysz&iacute;nen k&eacute;szp&eacute;nzben rendezz&eacute;k.</span></span></p>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">.</span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-02 09:44:33',
                'updated_at' => '2021-10-02 09:44:33',
            ],
            69 => [
                'id_news' => '105',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong>FELH&Iacute;V&Aacute;S: A verseny zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<p><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">Az uszod&aacute;ban a verseny ideje alatt nem kell maszkot haszn&aacute;lni &eacute;s nyilatkozatot sem k&eacute;r&uuml;nk előzetesen.&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">A nevez&eacute;si d&iacute;jakat k&eacute;rj&uuml;k a helysz&iacute;nen k&eacute;szp&eacute;nzben rendezz&eacute;k.</span></span></p>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">.</span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-02 09:44:54',
                'updated_at' => '2021-10-02 09:44:54',
            ],
            70 => [
                'id_news' => '106',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong>FELH&Iacute;V&Aacute;S: A verseny zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<p><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">Az uszod&aacute;ban a verseny ideje alatt nem kell maszkot haszn&aacute;lni &eacute;s nyilatkozatot sem k&eacute;r&uuml;nk előzetesen.&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">A nevez&eacute;si d&iacute;jakat k&eacute;rj&uuml;k a helysz&iacute;nen k&eacute;szp&eacute;nzben rendezz&eacute;k.</span></span></p>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">.</span></span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">&Eacute;lő k&ouml;zvet&iacute;t&eacute;s - <a href="rtmp://a.rtmp.youtube.com/live2" target="_blank" rel="noopener">LINK</a></span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-02 10:02:53',
                'updated_at' => '2021-10-02 10:02:53',
            ],
            71 => [
                'id_news' => '107',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong>FELH&Iacute;V&Aacute;S: A verseny zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<p><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">Az uszod&aacute;ban a verseny ideje alatt nem kell maszkot haszn&aacute;lni &eacute;s nyilatkozatot sem k&eacute;r&uuml;nk előzetesen.&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">A nevez&eacute;si d&iacute;jakat k&eacute;rj&uuml;k a helysz&iacute;nen k&eacute;szp&eacute;nzben rendezz&eacute;k.</span></span></p>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">.</span></span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">&Eacute;lő k&ouml;zvet&iacute;t&eacute;s - <a href="https://youtu.be/qTV7gjFn6UY" target="_blank" rel="noopener">LINK</a></span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-02 10:04:02',
                'updated_at' => '2021-10-02 10:04:02',
            ],
            72 => [
                'id_news' => '108',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong>FELH&Iacute;V&Aacute;S: A verseny zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<p><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">Az uszod&aacute;ban a verseny ideje alatt nem kell maszkot haszn&aacute;lni &eacute;s nyilatkozatot sem k&eacute;r&uuml;nk előzetesen.&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">A nevez&eacute;si d&iacute;jakat k&eacute;rj&uuml;k a helysz&iacute;nen k&eacute;szp&eacute;nzben rendezz&eacute;k.</span></span></p>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">.</span></span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">&Eacute;lő k&ouml;zvet&iacute;t&eacute;s - <a href="https://youtu.be/p9OKcwfK_-U" target="_blank" rel="noopener">LINK</a></span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-02 12:28:06',
                'updated_at' => '2021-10-02 12:28:06',
            ],
            73 => [
                'id_news' => '109',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong>FELH&Iacute;V&Aacute;S: A verseny zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<p><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">Az uszod&aacute;ban a verseny ideje alatt nem kell maszkot haszn&aacute;lni &eacute;s nyilatkozatot sem k&eacute;r&uuml;nk előzetesen.&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">A nevez&eacute;si d&iacute;jakat k&eacute;rj&uuml;k a helysz&iacute;nen k&eacute;szp&eacute;nzben rendezz&eacute;k.</span></span></p>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">.&nbsp;</span></span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="color: #ecf0f1; font-size: 8pt;"><span style="background-color: #2dc26b;"><span style="background-color: #2dc26b;"><span style="box-sizing: border-box; font-family: Lato, sans-serif;">Szombat d&eacute;lelőtt&nbsp;</span></span><span style="font-family: Lato, sans-serif; background-color: #2dc26b;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; background-color: #2dc26b; color: #ecf0f1;" href="https://youtu.be/qTV7gjFn6UY" target="_blank" rel="noopener">link</a></span><span style="background-color: #ffffff; font-family: Lato, sans-serif;">&nbsp;<span style="background-color: #3598db;">Szombat d&eacute;lut&aacute;n&nbsp;</span></span><span style="background-color: #3598db;"><span style="font-family: Lato, sans-serif; background-color: #3598db;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; color: #ecf0f1; background-color: #3598db;" href="https://youtu.be/p9OKcwfK_-U" target="_blank" rel="noopener">link</a></span></span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">&Eacute;lő k&ouml;zvet&iacute;t&eacute;s - <a href="https://youtu.be/p9OKcwfK_-U" target="_blank" rel="noopener">LINK</a></span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-03 08:22:39',
                'updated_at' => '2021-10-03 08:22:39',
            ],
            74 => [
                'id_news' => '110',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>
<p><span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong>FELH&Iacute;V&Aacute;S: A verseny zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!!!</strong></span></p>
<p><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">Az uszod&aacute;ban a verseny ideje alatt nem kell maszkot haszn&aacute;lni &eacute;s nyilatkozatot sem k&eacute;r&uuml;nk előzetesen.&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">A nevez&eacute;si d&iacute;jakat k&eacute;rj&uuml;k a helysz&iacute;nen k&eacute;szp&eacute;nzben rendezz&eacute;k.</span></span></p>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<span style="background-color: #e03e2d; color: #ffffff; font-size: 8pt;"><strong> </strong></span></div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span> lehet nyomon k&ouml;vetni. Az előzetes rajtlista 09.30-&aacute;n ker&uuml;l elk&eacute;sz&iacute;t&eacute;sre, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">.&nbsp;</span></span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="color: #ecf0f1; font-size: 8pt;"><span style="background-color: #2dc26b;"><span style="background-color: #2dc26b;"><span style="box-sizing: border-box; font-family: Lato, sans-serif;">Szombat d&eacute;lelőtt&nbsp;</span></span><span style="font-family: Lato, sans-serif; background-color: #2dc26b;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; background-color: #2dc26b; color: #ecf0f1;" href="https://youtu.be/qTV7gjFn6UY" target="_blank" rel="noopener">link</a></span><span style="background-color: #ffffff; font-family: Lato, sans-serif;">&nbsp;<span style="background-color: #3598db;">Szombat d&eacute;lut&aacute;n&nbsp;</span></span><span style="background-color: #3598db;"><span style="font-family: Lato, sans-serif; background-color: #3598db;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; color: #ecf0f1; background-color: #3598db;" href="https://youtu.be/p9OKcwfK_-U" target="_blank" rel="noopener">link</a></span></span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">&Eacute;lő k&ouml;zvet&iacute;t&eacute;s - <a href="https://youtu.be/xGQivIaWfp4" target="_blank" rel="noopener">LINK</a></span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-03 09:39:50',
                'updated_at' => '2021-10-03 09:39:50',
            ],
            75 => [
                'id_news' => '111',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div>&nbsp;</div>
</div>
</div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="color: #ecf0f1; font-size: 8pt;"><span style="background-color: #2dc26b;"><span style="background-color: #2dc26b;"><span style="box-sizing: border-box; font-family: Lato, sans-serif;">Szombat d&eacute;lelőtt&nbsp;</span></span><span style="font-family: Lato, sans-serif; background-color: #2dc26b;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; background-color: #2dc26b; color: #ecf0f1;" href="https://youtu.be/qTV7gjFn6UY" target="_blank" rel="noopener">link</a></span><span style="background-color: #ffffff; font-family: Lato, sans-serif;">&nbsp;<span style="background-color: #3598db;">Szombat d&eacute;lut&aacute;n&nbsp;</span></span><span style="background-color: #3598db;"><span style="font-family: Lato, sans-serif; background-color: #3598db;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; color: #ecf0f1; background-color: #3598db;" href="https://youtu.be/p9OKcwfK_-U" target="_blank" rel="noopener">link</a></span></span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">Vas&aacute;rnapi &eacute;lő k&ouml;zvet&iacute;t&eacute;s - <a href="https://youtu.be/xGQivIaWfp4" target="_blank" rel="noopener">LINK</a></span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-03 09:41:43',
                'updated_at' => '2021-10-03 09:41:43',
            ],
            76 => [
                'id_news' => '112',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div><span style="background-color: #34495e; color: #ecf0f1;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a verseny hivatalos oldal&aacute;n! R&eacute;szletes online friss&uuml;lő inform&aacute;ci&oacute;kat a leg&ouml;rd&uuml;lő men&uuml;ben tal&aacute;l!</span></div>
</div>
</div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="color: #ecf0f1; font-size: 8pt;"><span style="background-color: #2dc26b;"><span style="background-color: #2dc26b;"><span style="box-sizing: border-box; font-family: Lato, sans-serif;">Szombat d&eacute;lelőtt&nbsp;</span></span><span style="font-family: Lato, sans-serif; background-color: #2dc26b;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; background-color: #2dc26b; color: #ecf0f1;" href="https://youtu.be/qTV7gjFn6UY" target="_blank" rel="noopener">link</a></span><span style="background-color: #ffffff; font-family: Lato, sans-serif;">&nbsp;<span style="background-color: #3598db;">Szombat d&eacute;lut&aacute;n&nbsp;</span></span><span style="background-color: #3598db;"><span style="font-family: Lato, sans-serif; background-color: #3598db;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; color: #ecf0f1; background-color: #3598db;" href="https://youtu.be/p9OKcwfK_-U" target="_blank" rel="noopener">link</a></span></span></p>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">Vas&aacute;rnapi &eacute;lő k&ouml;zvet&iacute;t&eacute;s - <a href="https://youtu.be/xGQivIaWfp4" target="_blank" rel="noopener">LINK</a></span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-03 09:47:56',
                'updated_at' => '2021-10-03 09:47:56',
            ],
            77 => [
                'id_news' => '113',
                'meets_id' => '241',
                'text' => '<div id="news" style="box-sizing: border-box; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px;">
<div class="col mt-3" style="box-sizing: border-box; position: relative; width: 1920px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; margin-top: 1rem !important;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff; color: #ff0000;"> </span></p>
<div title="Page 2">
<div>
<div><span style="background-color: #34495e; color: #ecf0f1;">&Uuml;dv&ouml;z&ouml;lj&uuml;k a verseny hivatalos oldal&aacute;n! R&eacute;szletes inform&aacute;ci&oacute;kat a leg&ouml;rd&uuml;lő men&uuml;ben tal&aacute;l!</span></div>
<div><span style="background-color: #34495e; color: #ecf0f1;">Gratul&aacute;lunk az eredm&eacute;nyekhez, k&ouml;sz&ouml;nj&uuml;k a r&eacute;szv&eacute;telt.</span></div>
</div>
</div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="color: #ecf0f1; font-size: 8pt;"><span style="background-color: #2dc26b;"><span style="background-color: #2dc26b;"><span style="box-sizing: border-box; font-family: Lato, sans-serif;">Szombat d&eacute;lelőtt&nbsp;</span></span><span style="font-family: Lato, sans-serif; background-color: #2dc26b;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; background-color: #2dc26b; color: #ecf0f1;" href="https://youtu.be/qTV7gjFn6UY" target="_blank" rel="noopener">link</a></span><span style="background-color: #ffffff; font-family: Lato, sans-serif;">&nbsp;<span style="background-color: #3598db;">Szombat d&eacute;lut&aacute;n&nbsp;</span></span><span style="background-color: #3598db;"><span style="font-family: Lato, sans-serif; background-color: #3598db;">vide&oacute;&nbsp;</span><a style="font-family: Lato, sans-serif; color: #ecf0f1; background-color: #3598db;" href="https://youtu.be/p9OKcwfK_-U" target="_blank" rel="noopener">link</a></span></span><span style="font-size: 8pt;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; background-color: #ffffff; color: #ff0000;">&nbsp;<span style="color: #ecf0f1; background-color: #ba372a;">V&aacute;rnapi &eacute;lő k&ouml;zvet&iacute;t&eacute;s - </span><a href="https://youtu.be/xGQivIaWfp4" target="_blank" rel="noopener"><span style="color: #ecf0f1; background-color: #ba372a;">LINK</span></a></span></span></p>
<hr style="box-sizing: content-box; height: 0px; overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-right-style: initial; border-bottom-style: initial; border-left-style: initial; border-image: initial; border-color: rgba(0, 0, 0, 0.1) initial initial initial;" /></div>
</div>',
                'created_at' => '2021-10-03 15:14:36',
                'updated_at' => '2021-10-03 15:14:36',
            ],
            78 => [
                'id_news' => '114',
                'meets_id' => '240',
                'text' => '<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px; background-color: #ffffff; margin-bottom: 0px !important;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; color: #ff0000;">K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a&nbsp;<a href="../../../pdf/2021_10_27_Belugyminiszteriumi/nevezesilista_v0.pdf"><span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span></a>&nbsp;(nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; color: #ff0000;">ellenőrizze a leadott nevez&eacute;seket (<a href="../../../pdf/2021_10_27_Belugyminiszteriumi/csapatlista.pdf">csapatok lista</a>). M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a <a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. Az előzetes rajtlista el&eacute;rhető a lenti leg&ouml;rd&uuml;lő list&aacute;ban, m&iacute;g a v&eacute;gleges rajtlista az adott versenynapon 10.00-kor lesz kiadva.</span></p>',
                'created_at' => '2021-10-25 11:10:48',
                'updated_at' => '2021-10-25 11:10:48',
            ],
            79 => [
                'id_news' => '115',
                'meets_id' => '240',
                'text' => '<p><strong>K&ouml;sz&ouml;nj&uuml;k a r&eacute;szv&eacute;telt &eacute;s egyben gratul&aacute;lunk valamennyi &eacute;rmes &eacute;s helyezett versenyzőnek, csapatvezetőnek az el&eacute;rt eredm&eacute;nyekhez.</strong></p>
<p>A verseny <a href="../../../pdf/2021_10_27_Belugyminiszteriumi/BMOB2021_jegyzokonyv.pdf">jegyzők&ouml;nyv&eacute;ben</a> valamennyi időeredm&eacute;ny &eacute;s helyez&eacute;s megtal&aacute;lhat&oacute;.</p>',
                'created_at' => '2021-10-27 15:11:16',
                'updated_at' => '2021-10-27 15:11:16',
            ],
            80 => [
                'id_news' => '116',
                'meets_id' => '242',
                'text' => '<div id="news" class="col" style="box-sizing: border-box; position: relative; width: 1110px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px; background-color: #ffffff;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; color: #ff0000;">&Uuml;dv&ouml;z&ouml;lj&uuml;k &ouml;n&ouml;ket a III.Kecskem&eacute;ti Ciklusz&aacute;r&oacute; &Uacute;sz&oacute;verseny hivatalos oldal&aacute;n!</span></p>
</div>',
                'created_at' => '2021-12-05 08:11:25',
                'updated_at' => '2021-12-05 08:11:25',
            ],
            81 => [
                'id_news' => '117',
                'meets_id' => '242',
                'text' => '<div id="news" class="col" style="box-sizing: border-box; position: relative; width: 1110px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px; background-color: #ffffff;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; color: #ff0000; font-size: 12pt;">&Uuml;dv&ouml;z&ouml;lj&uuml;k &ouml;n&ouml;ket a III.Kecskem&eacute;ti Ciklusz&aacute;r&oacute; &Uacute;sz&oacute;verseny hivatalos oldal&aacute;n! A nevez&eacute;seket a <a href="http://www.muszuszoranglista.hu/" target="_blank" rel="noopener">www.muszuszoranglista.hu</a> oldalon 2021. december 13. &eacute;jf&eacute;lig kell r&ouml;gz&iacute;teni.</span></p>
<div style="box-sizing: border-box; font-size: 14.4px;" title="Page 2">
<div style="box-sizing: border-box;">
<div style="box-sizing: border-box;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-weight: bolder;"><span style="box-sizing: border-box; color: #e03e2d;">FELH&Iacute;V&Aacute;S: A verseny a járványhelyzetre való tekintettel zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!</span></span></p>
</div>
</div>
</div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; color: #ff0000;">A nevez&eacute;sek lez&aacute;r&aacute;s&aacute;t k&ouml;vetően az előzetes rajtlista 12.15-&eacute;n szerd&aacute;n ker&uuml;l k&ouml;zz&eacute;t&eacute;telre. K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; color: #ff0000; outline: none !important;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.</span></p>
</div>',
                'created_at' => '2021-12-06 04:35:44',
                'updated_at' => '2021-12-06 04:35:44',
            ],
            82 => [
                'id_news' => '118',
                'meets_id' => '242',
                'text' => '<div id="news" class="col" style="box-sizing: border-box; position: relative; width: 1110px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px; background-color: #ffffff;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; color: #ff0000; font-size: 12pt;">&Uuml;dv&ouml;z&ouml;lj&uuml;k &ouml;n&ouml;ket a III.Kecskem&eacute;ti Ciklusz&aacute;r&oacute; &Uacute;sz&oacute;verseny hivatalos oldal&aacute;n! A nevez&eacute;seket a <a href="http://www.muszuszoranglista.hu/" target="_blank" rel="noopener">www.muszuszoranglista.hu</a> oldalon 2021. december 13. &eacute;jf&eacute;lig kell r&ouml;gz&iacute;teni.</span></p>
<div style="box-sizing: border-box; font-size: 14.4px;" title="Page 2">
<div style="box-sizing: border-box;">
<div style="box-sizing: border-box;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-weight: bolder;"><span style="box-sizing: border-box; color: #e03e2d;">FELH&Iacute;V&Aacute;S: A verseny a járványhelyzetre való tekintettel zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!&nbsp;</span></span><strong><span style="color: #ff0000; font-family: Lato, sans-serif; font-size: medium;">A maszk haszn&aacute;lata z&aacute;rt t&eacute;rben k&ouml;telező!</span></strong></p>
</div>
</div>
</div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; color: #ff0000;">A nevez&eacute;sek lez&aacute;r&aacute;s&aacute;t k&ouml;vetően az előzetes rajtlista 12.15-&eacute;n szerd&aacute;n ker&uuml;l k&ouml;zz&eacute;t&eacute;telre. K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; color: #ff0000; outline: none !important;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.</span></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><strong><span style="color: #ff0000; font-family: Lato, sans-serif;">Verseny előtti &eacute;s k&ouml;zbeni bemeleg&iacute;t&eacute;s:</span></strong></p>
<ul>
<li style="box-sizing: border-box; line-height: 1.8; font-size: 14.4px;"><span style="color: #ff0000; font-family: Lato, sans-serif;">2021. december 16. cs&uuml;t&ouml;rt&ouml;k</span>
<ul>
<li style="box-sizing: border-box; line-height: 1.8; font-size: 14.4px;"><span style="color: #ff0000; font-family: Lato, sans-serif;">50 m versenymedence 9:00 &oacute;r&aacute;t&oacute;l; d&eacute;lut&aacute;n 16:00 &oacute;r&aacute;t&oacute;l</span></li>
<li style="box-sizing: border-box; line-height: 1.8; font-size: 14.4px;"><span style="color: #ff0000; font-family: Lato, sans-serif;">25 m versenymedence 3 db kijel&ouml;lt p&aacute;ly&aacute;j&aacute;n 9:00 &oacute;r&aacute;t&oacute;l; d&eacute;lut&aacute;n 16:00 &oacute;r&aacute;t&oacute;l</span></li>
</ul>
</li>
<li style="box-sizing: border-box; line-height: 1.8; font-size: 14.4px;"><span style="color: #ff0000; font-family: Lato, sans-serif;">2021. december 17. p&eacute;ntek</span>
<ul>
<li style="box-sizing: border-box; line-height: 1.8; font-size: 14.4px;"><span style="color: #ff0000; font-family: Lato, sans-serif;">50 m versenymedence 9:00 &oacute;r&aacute;t&oacute;l; d&eacute;lut&aacute;n 16:00 &oacute;r&aacute;t&oacute;l</span></li>
<li style="box-sizing: border-box; line-height: 1.8; font-size: 14.4px;"><span style="color: #ff0000; font-family: Lato, sans-serif;">25 m versenymedence 3 db kijel&ouml;lt p&aacute;ly&aacute;j&aacute;n 9:00 &oacute;r&aacute;t&oacute;l; d&eacute;lut&aacute;n 16:00 &oacute;r&aacute;t&oacute;l</span></li>
</ul>
</li>
<li style="box-sizing: border-box; line-height: 1.8; font-size: 14.4px;"><span style="color: #ff0000; font-family: Lato, sans-serif;">2021. december 18. szombat</span>
<ul>
<li style="box-sizing: border-box; line-height: 1.8; font-size: 14.4px;"><span style="color: #ff0000; font-family: Lato, sans-serif;">50 m versenymedence 9:00 &oacute;r&aacute;t&oacute;l; d&eacute;lut&aacute;n 16:00 &oacute;r&aacute;t&oacute;l</span></li>
<li style="box-sizing: border-box; line-height: 1.8; font-size: 14.4px;"><span style="color: #ff0000; font-family: Lato, sans-serif;">25 m versenymedence 3 db kijel&ouml;lt p&aacute;ly&aacute;j&aacute;n 9:00 &oacute;r&aacute;t&oacute;l; d&eacute;lut&aacute;n 16:00 &oacute;r&aacute;t&oacute;l</span></li>
</ul>
</li>
</ul>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><strong><span style="color: #ff0000; font-family: Lato, sans-serif;">Bel&eacute;p&eacute;s az Medence ter&uuml;let&eacute;re:</span></strong></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><span style="color: #ff0000; font-family: Lato, sans-serif;">2021. december 16-17-18-&aacute;n egys&eacute;gesen </span><span style="color: #ff0000; font-family: Lato, sans-serif;">8:00-t&oacute;l van lehetős&eacute;g a versenyzők, edzők&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">sz&aacute;m&aacute;ra a versenymedence melletti lel&aacute;t&oacute;n, pihenő teraszon&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">elfoglalni a helyeket.&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">A sportol&oacute;i &ouml;lt&ouml;zői ajt&oacute;k fel&eacute; ny&iacute;l&oacute; forg&oacute;kapu is nyitva lesz 9:40-től!</span></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><strong><span style="color: #ff0000; font-family: Lato, sans-serif;">&Uuml;nnep&eacute;lyes megnyit&oacute;: 2021. december 16. cs&uuml;t&ouml;rt&ouml;k 9:45 &oacute;rakor</span></strong></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><span style="color: #ff0000; font-family: Lato, sans-serif;"><strong>D&ouml;ntőkből t&ouml;rt&eacute;nő visszal&eacute;p&eacute;sek bejelent&eacute;se</strong>: a d&eacute;lelőtti előd&ouml;ntők ut&aacute;n 30 perc &aacute;ll rendelkez&eacute;sre a&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">visszal&eacute;p&eacute;sek bejelent&eacute;s&eacute;re, &iacute;gy k&eacute;r&uuml;nk minden edzőt &eacute;s versenyzőt, hogy az előd&ouml;ntők&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">befejez&eacute;se ut&aacute;n 1 &oacute;r&aacute;val ellenőrizz&eacute;k a d&eacute;lut&aacute;ni d&ouml;ntőbe jutottak n&eacute;vsor&aacute;t a hirdető t&aacute;bl&aacute;kon&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">&eacute;s a meet.kvsc.info oldalon.</span></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><span style="color: #ff0000; font-family: Lato, sans-serif;">J&oacute; versenyz&eacute;st k&iacute;v&aacute;nunk Mindenkinek!</span></p>
</div>',
                'created_at' => '2021-12-09 05:14:21',
                'updated_at' => '2021-12-09 05:14:21',
            ],
            83 => [
                'id_news' => '119',
                'meets_id' => '242',
                'text' => '<div id="news" class="col" style="box-sizing: border-box; position: relative; width: 1110px; padding-right: 15px; padding-left: 15px; flex-basis: 0px; -webkit-box-flex: 1; flex-grow: 1; max-width: 100%; color: #212529; font-family: Nunito, sans-serif; font-size: 14.4px; background-color: #ffffff;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; color: #ff0000; font-size: 12pt;">&Uuml;dv&ouml;z&ouml;lj&uuml;k &ouml;n&ouml;ket a III.Kecskem&eacute;ti Ciklusz&aacute;r&oacute; &Uacute;sz&oacute;verseny hivatalos oldal&aacute;n! A nevez&eacute;seket a <a href="http://www.muszuszoranglista.hu/" target="_blank" rel="noopener">www.muszuszoranglista.hu</a> oldalon 2021. december 13. &eacute;jf&eacute;lig kell r&ouml;gz&iacute;teni.</span></p>
<div style="box-sizing: border-box; font-size: 14.4px;" title="Page 2">
<div style="box-sizing: border-box;">
<div style="box-sizing: border-box;">
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;"><span style="box-sizing: border-box; font-weight: bolder;"><span style="box-sizing: border-box; color: #e03e2d;">FELH&Iacute;V&Aacute;S: A verseny a járványhelyzetre való tekintettel zárt kapuk mögött kerül lebonyolításra. A verseny jellegéből kifolyólag a rendezvény online nyomon követhető lesz videó közvetítés formájában!&nbsp;</span></span><strong><span style="color: #ff0000; font-family: Lato, sans-serif; font-size: medium;">A maszk haszn&aacute;lata z&aacute;rt t&eacute;rben k&ouml;telező!</span></strong></p>
</div>
</div>
</div>
<p style="box-sizing: border-box; margin-bottom: 0px !important; margin-top: 0px; line-height: 1.8;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; color: #ff0000;">A nevez&eacute;sek lez&aacute;r&aacute;s&aacute;t k&ouml;vetően az előzetes rajtlista 12.15-&eacute;n szerd&aacute;n ker&uuml;l k&ouml;zz&eacute;t&eacute;telre. K&eacute;rj&uuml;k valamennyi csapatvezetőt, hogy a <span style="box-sizing: border-box; background-color: #ffff00;">nevez&eacute;si list&aacute;ban</span>&nbsp;(<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../../../races/20210130-x-aranyhomok-kupa-uszoverseny" target="_blank" rel="noopener">nevez&eacute;sek/eredm&eacute;nyek men&uuml;pont</a>)&nbsp;</span><span style="box-sizing: border-box; font-family: Lato, sans-serif; font-size: 16px; color: #ff0000; outline: none !important;">ellenőrizze a leadott nevez&eacute;seket. M&oacute;dos&iacute;t&aacute;si ig&eacute;ny&uuml;ket e-mailen jelezz&eacute;k a&nbsp;<a style="box-sizing: border-box; color: #3490dc; text-decoration-line: none; background-color: transparent;" href="../235/nevezes@kvsc.info" target="_blank" rel="noopener">nevezes@kvsc.info</a>&nbsp;c&iacute;men. A v&aacute;rhat&oacute; futamsz&aacute;mokat, kezd&eacute;si időket az&nbsp;<span style="box-sizing: border-box; background-color: #ffff00;">időtervben</span>&nbsp;lehet nyomon k&ouml;vetni. A v&eacute;gleges rajtlista az adott versenynapon reggel 9.00-kor ker&uuml;l k&ouml;zz&eacute;t&eacute;telre.</span></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><strong><span style="color: #ff0000; font-family: Lato, sans-serif;">Verseny előtti &eacute;s k&ouml;zbeni bemeleg&iacute;t&eacute;s: </span></strong><span style="color: #ff0000; font-family: Lato, sans-serif;">Egys&eacute;gesen </span><span style="color: #ff0000; font-family: Lato, sans-serif;">mindh&aacute;rom napon az al&aacute;bbiak szerint&nbsp;</span></p>
<ul>
<li><span style="color: #ff0000; font-family: Lato, sans-serif;">50 m versenymedence 9:00 &oacute;r&aacute;t&oacute;l; d&eacute;lut&aacute;n 16:00 &oacute;r&aacute;t&oacute;l</span></li>
<li><span style="color: #ff0000; font-family: Lato, sans-serif;">25 m versenymedence 3 db kijel&ouml;lt p&aacute;ly&aacute;j&aacute;n 9:00 &oacute;r&aacute;t&oacute;l; d&eacute;lut&aacute;n 16:00 &oacute;r&aacute;t&oacute;l</span></li>
</ul>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><strong><span style="color: #ff0000; font-family: Lato, sans-serif;">Bel&eacute;p&eacute;s az Medence ter&uuml;let&eacute;re:</span></strong></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><span style="color: #ff0000; font-family: Lato, sans-serif;">2021. december 16-17-18-&aacute;n egys&eacute;gesen </span><span style="color: #ff0000; font-family: Lato, sans-serif;">8:00-t&oacute;l van lehetős&eacute;g a versenyzők, edzők&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">sz&aacute;m&aacute;ra a versenymedence melletti lel&aacute;t&oacute;n, pihenő teraszon&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">elfoglalni a helyeket.&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">A sportol&oacute;i &ouml;lt&ouml;zői ajt&oacute;k fel&eacute; ny&iacute;l&oacute; forg&oacute;kapu is nyitva lesz 9:40-től!</span></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><strong><span style="color: #ff0000; font-family: Lato, sans-serif;">&Uuml;nnep&eacute;lyes megnyit&oacute;: 2021. december 16. cs&uuml;t&ouml;rt&ouml;k 9:45 &oacute;rakor</span></strong></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><span style="color: #ff0000; font-family: Lato, sans-serif;"><strong>D&ouml;ntőkből t&ouml;rt&eacute;nő visszal&eacute;p&eacute;sek bejelent&eacute;se</strong>: a d&eacute;lelőtti előd&ouml;ntők ut&aacute;n 30 perc &aacute;ll rendelkez&eacute;sre a&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">visszal&eacute;p&eacute;sek bejelent&eacute;s&eacute;re, &iacute;gy k&eacute;r&uuml;nk minden edzőt &eacute;s versenyzőt, hogy az előd&ouml;ntők&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">befejez&eacute;se ut&aacute;n 1 &oacute;r&aacute;val ellenőrizz&eacute;k a d&eacute;lut&aacute;ni d&ouml;ntőbe jutottak n&eacute;vsor&aacute;t a hirdető t&aacute;bl&aacute;kon&nbsp;</span><span style="color: #ff0000; font-family: Lato, sans-serif;">&eacute;s a meet.kvsc.info oldalon.</span></p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;">&nbsp;</p>
<p style="box-sizing: border-box; margin-top: 0px; line-height: 1.8; font-size: 14.4px; margin-bottom: 0px !important; outline: none !important;"><span style="color: #ff0000; font-family: Lato, sans-serif;">J&oacute; versenyz&eacute;st k&iacute;v&aacute;nunk Mindenkinek!</span></p>
</div>',
                'created_at' => '2021-12-09 05:17:02',
                'updated_at' => '2021-12-09 05:17:02',
            ],
        ];


        foreach($data as $news) {
            MeetNews::firstOrCreate(
                [
                    'id' => $news['id_news']
                ], [
                    'meet_id' => $news['meets_id'],
                    'body' => $news['text'],
                    'created_at' => $news['created_at'],
                    'updated_at' => $news['updated_at'],
                ]
            );
        }
    }
}
