<?php

use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\RegateController;
use App\Http\Controllers\Web\AreaRiservataController;


Route::get('/', [IndexController::class, 'index'])->defaults('cmd', 'home');
	Route::get('en/', [IndexController::class, 'index'])->defaults('cmd', 'home');

Route::get('general_error/{msg}', function($msg) {
    return view('errors.general_error', ['msg' => $msg]);
});

Route::get('home.html', function() {
    return Redirect::to('/', 301);
});

Route::get('en/home.html', function() {
    return Redirect::to('/en/', 301);
});

// AJAX
Route::get('/ajax/contatti', function () {
    return view('web.regate.ajax_contatti');
})->name('ajax.contatti');
Route::get('/ajax/regate_lista_ajax', function () {
    return view('web.regate.regate_lista_ajax');
});
Route::get('/ajax/regate_listaFoto_ajax', function () {
    return view('web.regate.regate_listaFoto_ajax');
});
Route::get('/ajax/regate_bottone_calendario_ajax', function () {
    return view('web.regate.regate_bottone_calendario_ajax');
});
Route::get('/ajax/regate_loghi_ajax', function () {
    return view('web.regate.regate_loghi_ajax');
});

// LO YCCS
Route::get('lo-yccs/{cmd}.html', [IndexController::class, 'index']);
	Route::get('en/lo-yccs/{cmd}.html', [IndexController::class, 'index']);
	
// YCCS Porto Cervo
//Route::post('reservation-request-confirm.html', [IndexController::class, 'invioFormReservation']);
	//Route::post('en/reservation-request-confirm.html', [IndexController::class, 'invioFormReservation']);
Route::post('registrazione-giornalisti-conferma.html', [IndexController::class, 'invioFormGiornalisti']);
	Route::post('en/registrazione-giornalisti-conferma.html', [IndexController::class, 'invioFormGiornalisti']);
Route::post('servizi/yccs-wellness-center.html', [IndexController::class, 'invioFormWellness']);
	Route::post('en/servizi/yccs-wellness-center.html', [IndexController::class, 'invioFormWellness']);

Route::get('yccs-sailing-school-iscrizioni.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'yccs-sailing-school-iscrizioni');
Route::get('en/yccs-sailing-school-iscrizioni.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'yccs-sailing-school-iscrizioni');
	
Route::get('yccs-sailing-school.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'yccs-sailing-school');
Route::get('en/yccs-sailing-school.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'yccs-sailing-school');
	
Route::get('press/{tipo}/{tit}-{id}.html', [IndexController::class, 'comunicatiDettTipo']);
	Route::get('en/press/{tipo}/{tit}-{id_dett}.html', [IndexController::class, 'comunicatiDettTipo']);
Route::get('press/{tit}-{id}.html', [IndexController::class, 'comunicatiDett']);
	Route::get('en/press/{tit}-{id_dett}.html', [IndexController::class, 'comunicatiDett']);
Route::get('press-conference-{id_dett}/{active_tab}.html', [IndexController::class, 'pressConference']);
	Route::get('en/press-conference-{id_dett}/{active_tab}.html', [IndexController::class, 'pressConference']);
Route::get('press-conference-{id_dett}.html', [IndexController::class, 'pressConference']);
	Route::get('en/press-conference-{id_dett}.html', [IndexController::class, 'pressConference']);
Route::get('servizi/{cmd}.html', [IndexController::class, 'index']);
	Route::get('en/servizi/{cmd}.html', [IndexController::class, 'index']);

Route::get('press-{anno_rassegna}.html', function($anno_rassegna) {
	$this_page_path_ita = Config::get('app.url')."press".$anno_rassegna.".html";
	$this_page_path_eng = Config::get('app.url')."/en/press".$anno_rassegna.".html";
    return view('web.press', ['anno_rassegna' => $anno_rassegna, 'pagina' => 'comunicati', 'cmd' => 'comunicati', 'lingua' => 'ita', 'this_page_path_ita' => $this_page_path_ita, 'this_page_path_eng' => $this_page_path_eng ]);
})->whereNumber('anno_rassegna');
Route::get('en/press-{anno_rassegna}.html', function($anno_rassegna) {
	$this_page_path_ita = Config::get('app.url')."press".$anno_rassegna.".html";
	$this_page_path_eng = Config::get('app.url')."/en/press".$anno_rassegna.".html";
    return view('web.press', ['anno_rassegna' => $anno_rassegna, 'pagina' => 'comunicati', 'cmd' => 'comunicati', 'lingua' => 'eng', 'this_page_path_ita' => $this_page_path_ita, 'this_page_path_eng' => $this_page_path_eng ]);
})->whereNumber('anno_rassegna');

	
// SCUOLA VELA	
Route::post('yccs-sailing-school.html', [IndexController::class, 'invioFormScuola']);
	Route::post('en/yccs-sailing-school.html', [IndexController::class, 'invioFormScuola']);

Route::get('yccs-sailing-school-iscrizioni.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'yccs-sailing-school-iscrizioni');

Route::get('en/yccs-sailing-school-iscrizioni.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'yccs-sailing-school-iscrizioni');
	
// METEO	
Route::get('meteo.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'meteo');
Route::get('en/meteo.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'meteo');
	
// PRESS	
Route::get('press.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'press');
Route::get('en/press.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'press');
	
Route::get('registrazione-giornalisti.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'registrazione-giornalisti');
Route::get('en/registrazione-giornalisti.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'registrazione-giornalisti');
	
Route::post('yccs-sailing-school-iscrizioni.html', [IndexController::class, 'invioIscrizioneScuola']);	
	Route::post('en/yccs-sailing-school-iscrizioni.html', [IndexController::class, 'invioIscrizioneScuola']);	
Route::get('yccs-sailing-school-iscrizioni-{codice_iscrizione}-{id_ute}-{fam}-{admin}', [IndexController::class, 'invioIscrizioneScuolaConferma2']);
Route::get('yccs-sailing-school-iscrizioni-{codice_iscrizione}-{id_ute}.html', [IndexController::class, 'invioIscrizioneScuolaConferma']);
Route::get('ajax/dati_iscrizione_scuola.php', [IndexController::class, 'dati_iscrizione_scuola']);	
Route::get('yccs-sailing-school-conferma-iscrizione_{codice}.html', [IndexController::class, 'confermaIscrizioneSailingSchool']);
	Route::get('en/yccs-sailing-school-conferma-iscrizione_{codice}.html', [IndexController::class, 'confermaIscrizioneSailingSchool']);
Route::get('yccs-sailing-school-cambia-password-{codice}.html', [IndexController::class, 'cambiaPasswordSailingSchool']);
	Route::get('en/yccs-sailing-school-cambia-password-{codice}.html', [IndexController::class, 'cambiaPasswordSailingSchool']);
Route::post('yccs-sailing-school-cambia-password-{codice}.html', [IndexController::class, 'cambiaPasswordSailingSchoolPost']);
	Route::post('en/yccs-sailing-school-cambia-password-{codice}.html', [IndexController::class, 'cambiaPasswordSailingSchoolPost']);

// AIUTI DI STATO
Route::get('aiuti-di-stato/{anno}.html', [IndexController::class, 'aiuti']);
	Route::get('en/aiuti-di-stato/{anno}.html', [IndexController::class, 'aiuti']);

// AZZURRA
Route::get('azzurra/40_anni_di_azzurra.html', [IndexController::class, 'azzurra_40']);
	Route::get('en/azzurra/40_anni_di_azzurra.html', [IndexController::class, 'azzurra_40']);
Route::get('azzurra/{pag_att}.html', [IndexController::class, 'azzurra']);
	Route::get('en/azzurra/{pag_att}.html', [IndexController::class, 'azzurra']);

// YOUNG AZZURRA
Route::get('young-azzurra.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'young-azzurra');
Route::get('en/young-azzurra.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'young-azzurra');
	
Route::get('young-azzurra/photogallery-category/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaPhotogalleryCategory']);
	Route::get('en/young-azzurra/photogallery-category/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaPhotogalleryCategory']);
Route::get('young-azzurra/photogallery-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaPhotogalleryPag']);
	Route::get('en/young-azzurra/photogallery-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaPhotogalleryPag']);
Route::get('young-azzurra/photogallery/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaPhotogallery']);
	Route::get('en/young-azzurra/photogallery/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaPhotogallery']);
Route::get('young-azzurra/video_gallery-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaVideogalleryPag']);
	Route::get('en/young-azzurra/video_gallery-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaVideogalleryPag']);
Route::get('young-azzurra/video_gallery/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaVideogallery']);
	Route::get('en/young-azzurra/video_gallery/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaVideogallery']);
Route::get('young-azzurra/news-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaNewsPag']);
	Route::get('en/young-azzurra/news-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'yaNewsPag']);
Route::get('young-azzurra/risultati-{anno_risultati}.html', [IndexController::class, 'yaRisultatiAnno']);
	Route::get('en/young-azzurra/risultati-{anno_risultati}.html', [IndexController::class, 'yaRisultatiAnno']);
Route::get('young-azzurra/team/{pag_dett}-{id_dett}.html', [IndexController::class, 'teamDett']);
	Route::get('en/young-azzurra/team/{pag_dett}-{id_dett}.html', [IndexController::class, 'teamDett']);
Route::get('young-azzurra/atleti-{anno}/{pag_dett}-{id_dett}.html', [IndexController::class, 'atletiDettAnno']);
	Route::get('en/young-azzurra/atleti-{anno}/{pag_dett}-{id_dett}.html', [IndexController::class, 'atletiDettAnno']);
Route::get('young-azzurra/atleti/{pag_dett}-{id_dett}.html', [IndexController::class, 'atletiDett']);
	Route::get('en/young-azzurra/atleti/{pag_dett}-{id_dett}.html', [IndexController::class, 'atletiDett']);
Route::get('young-azzurra/atleti-{anno}.html', [IndexController::class, 'atletiAnno']);
	Route::get('en/young-azzurra/atleti-{anno}.html', [IndexController::class, 'atletiAnno']);

Route::get('young-azzurra/{cmd}-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'index']);
	Route::get('en/young-azzurra/{cmd}-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'index']);
Route::get('young-azzurra/video_gallery_pag{pag_att}.html', [IndexController::class, 'indexVideoPag']);
	Route::get('en/young-azzurra/video_gallery_pag{pag_att}.html', [IndexController::class, 'indexVideoPag']);
Route::get('young-azzurra/{cmd}_pag{pag_att}.html', [IndexController::class, 'index']);
	Route::get('en/young-azzurra/{cmd}_pag{pag_att}.html', [IndexController::class, 'index']);
Route::get('young-azzurra/{cmd}.html', [IndexController::class, 'index']);
	Route::get('en/young-azzurra/{cmd}.html', [IndexController::class, 'index']);

Route::get('one-ocean/{cmd}.html', function($cmd){ 
	return Redirect::to('yccs_e_sostenibilita/'.$cmd.'.html', 301); 
});
Route::get('en/one-ocean/{cmd}.html', function($cmd){ 
	return Redirect::to('en/yccs_e_sostenibilita/'.$cmd.'.html', 301); 
});

// YCCS e Sostenibilità
Route::get('yccs_e_sostenibilita/{cmd}.html', [IndexController::class, 'index']);
	Route::get('en/yccs_e_sostenibilita/{cmd}.html', [IndexController::class, 'index']);

Route::get('news_private-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'NewsPrivatePag']);
	Route::get('en/news_private-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'NewsPrivatePag']);
Route::get('news-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'NewsPag']);
	Route::get('en/news-pag{pag_att}/{pag_dett}-{id_dett}.html', [IndexController::class, 'NewsPag']);
Route::get('news_pag{pag_att}.html', [IndexController::class, 'NewsPag']);
	Route::get('en/news_pag{pag_att}.html', [IndexController::class, 'NewsPag']);
Route::get('news_private_pag{pag_att}.html', [IndexController::class, 'NewsPrivatePag']);
	Route::get('en/news_private_pag{pag_att}.html', [IndexController::class, 'NewsPrivatePag']);

// NEWS
Route::get('news.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'news');
Route::get('en/news.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'news');
	
// YCCS APP
Route::get('yccs-app.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'yccs-app');
Route::get('en/yccs-app.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'yccs-app');
	
// MAGAZINE
Route::get('magazine/{anno_ric}/{arg_ric_nome}/{cat_ric_nome}/{art_nome}-{art_dett}.html', [IndexController::class, 'magazineDettCat']);
	Route::get('en/magazine/{anno_ric}/{arg_ric_nome}/{cat_ric_nome}/{art_nome}-{art_dett}.html', [IndexController::class, 'magazineDettCat']);
Route::get('magazine/{anno_ric}/{arg_ric_nome}/{art_nome}-{art_dett}.html', [IndexController::class, 'magazineDett']);
	Route::get('en/magazine/{anno_ric}/{arg_ric_nome}/{art_nome}-{art_dett}.html', [IndexController::class, 'magazineDett']);
Route::get('magazine/{codice}-{art_dett}', [IndexController::class, 'magazineDettCodex']);
	Route::get('en/magazine/{codice}-{art_dett}', [IndexController::class, 'magazineDettCodex']);

Route::get('magazine-pag{pag_att}/{anno_ric}/{arg_ric_nome}-{arg_ric}/{cat_ric_nome}-{cat_ric}.html', [IndexController::class, 'magazine']);
	Route::get('en/magazine-pag{pag_att}/{anno_ric}/{arg_ric_nome}-{arg_ric}/{cat_ric_nome}-{cat_ric}.html', [IndexController::class, 'magazine']);
Route::get('magazine-pag{pag_att}/{anno_ric}/{arg_ric_nome}-{arg_ric}.html', [IndexController::class, 'magazine']);
	Route::get('en/magazine-pag{pag_att}/{anno_ric}/{arg_ric_nome}-{arg_ric}.html', [IndexController::class, 'magazine']);
Route::get('magazine-pag{pag_att}/{anno_ric}.html', [IndexController::class, 'magazine']);
	Route::get('en/magazine-pag{pag_att}/{anno_ric}.html', [IndexController::class, 'magazine']);
Route::get('magazine-pag{pag_att}/{arg_ric_nome}-{arg_ric}/{cat_ric_nome}-{cat_ric}.html', [IndexController::class, 'magazine']);
	Route::get('en/magazine-pag{pag_att}/{arg_ric_nome}-{arg_ric}/{cat_ric_nome}-{cat_ric}.html', [IndexController::class, 'magazine']);
Route::get('magazine-pag{pag_att}/{arg_ric_nome}-{arg_ric}.html	', [IndexController::class, 'magazine']);
	Route::get('en/magazine-pag{pag_att}/{arg_ric_nome}-{arg_ric}.html	', [IndexController::class, 'magazine']);
Route::get('magazine-pag{pag_att}.html', [IndexController::class, 'magazine']);
	Route::get('en/magazine-pag{pag_att}.html', [IndexController::class, 'magazine']);
Route::get('magazine.html', [IndexController::class, 'magazine']);
	Route::get('en/magazine.html', [IndexController::class, 'magazine']);

// SAIL TALK
Route::get('sail_talk/{arg_ric_nome}/{cat_ric_nome}/{art_nome}-{id_dett}.html', [IndexController::class, 'sailTalkSottocatDett']);
	Route::get('en/sail_talk/{arg_ric_nome}/{cat_ric_nome}/{art_nome}-{id_dett}.html', [IndexController::class, 'sailTalkSottocatDett']);
Route::get('sail_talk/{arg_ric_nome}/{art_nome}-{id_dett}.html', [IndexController::class, 'sailTalkCatDett']);
	Route::get('en/sail_talk/{arg_ric_nome}/{art_nome}-{id_dett}.html', [IndexController::class, 'sailTalkCatDett']);
Route::get('sail_talk/{art_nome}-{id_dett}.html', [IndexController::class, 'sailTalkDett']);
	Route::get('en/sail_talk/{art_nome}-{id_dett}.html', [IndexController::class, 'sailTalkDett']);
Route::get('sail_talk/{codice}-{id_dett}', [IndexController::class, 'sailTalkDettCodex']);
	Route::get('en/sail_talk/{codice}-{id_dett}', [IndexController::class, 'sailTalkDettCodex']);

Route::get('sail_talk-pag{pag_att}/{arg_ric_nome}-{arg_ric}/{cat_ric_nome}-{cat_ric}.html', [IndexController::class, 'sailTalk']);
	Route::get('en/sail_talk-pag{pag_att}/{arg_ric_nome}-{arg_ric}/{cat_ric_nome}-{cat_ric}.html', [IndexController::class, 'sailTalk']);
Route::get('sail_talk-pag{pag_att}/{arg_ric_nome}-{arg_ric}.html	', [IndexController::class, 'sailTalk']);
	Route::get('en/sail_talk-pag{pag_att}/{arg_ric_nome}-{arg_ric}.html	', [IndexController::class, 'sailTalk']);
Route::get('sail_talk-pag{pag_att}.html', [IndexController::class, 'sailTalk']);
	Route::get('en/sail_talk-pag{pag_att}.html', [IndexController::class, 'sailTalk']);
Route::get('sail_talk.html', [IndexController::class, 'sailTalk']);
	Route::get('en/sail_talk.html', [IndexController::class, 'sailTalk']);

// REGATE
Route::get('regate-{anno_regata}/{tipo}gallery/{nome_regata}-{id_regata}.html', [RegateController::class, 'galleryRegata']);
	Route::get('en/regattas-{anno_regata}/{tipo}gallery/{nome_regata}-{id_regata}.html', [RegateController::class, 'galleryRegata']);
	Route::get('en/regate-{anno_regata}/{tipo}gallery/{nome_regata}-{id_regata}.html', [RegateController::class, 'galleryRegata']);
Route::get('regate-{anno_regata}/press/{nome_regata}-{id_dett}/{titolo_press}-{id_press}.html', [RegateController::class, 'post_regata']);
	Route::get('en/regattas-{anno_regata}/press/{nome_regata}-{id_dett}/{titolo_press}-{id_press}.html', [RegateController::class, 'post_regata']);
	Route::get('en/regate-{anno_regata}/press/{nome_regata}-{id_dett}/{titolo_press}-{id_press}.html', [RegateController::class, 'post_regata']);
	
Route::get('regate/yccs-sporting-calendar', [RegateController::class, 'linkFissoCalendar']);
	Route::get('en/regattas/yccs-sporting-calendar', [RegateController::class, 'linkFissoCalendar']);
	Route::get('en/regate/yccs-sporting-calendar', [RegateController::class, 'linkFissoCalendar']);
Route::get('regate-{anno_regata}/calendario_regate', [RegateController::class, 'calendario_regate']);
	Route::get('en/regate-{anno_regata}/sporting_calendar', [RegateController::class, 'calendario_regate']);
Route::get('regate-{anno_regata}/presentazione', [RegateController::class, 'presentazione_regate']);
	Route::get('en/regate-{anno_regata}/presentation', [RegateController::class, 'presentazione_regate']);
Route::get('regate-{anno_regata}/{nome_regata}-{id_dett}/{tipo_doc}-{id_doc}/{nome_doc}', [RegateController::class, 'linkFisso']);
	Route::get('en/regattas-{anno_regata}/{nome_regata}-{id_dett}/{tipo_doc}-{id_doc}/{nome_doc}', [RegateController::class, 'linkFisso']);
	Route::get('en/regate-{anno_regata}/{nome_regata}-{id_dett}/{tipo_doc}-{id_doc}/{nome_doc}', [RegateController::class, 'linkFisso']);


Route::get('regate-{anno_regata}/{sez}/{nome_regata}-{id_dett}.html', [RegateController::class, 'regateSez']);
	Route::get('en/regattas-{anno_regata}/{sez}/{nome_regata}-{id_dett}.html', [RegateController::class, 'regateSez']);	
	Route::get('en/regate-{anno_regata}/{sez}/{nome_regata}-{id_dett}.html', [RegateController::class, 'regateSez']);	
	
Route::get('regate-{anno_regata}/{nome_regata}-{id_regata}.html', [RegateController::class, 'regate']);
	Route::get('en/regattas-{anno_regata}/{nome_regata}-{id_regata}.html', [RegateController::class, 'regate']);
	Route::get('en/regate-{anno_regata}/{nome_regata}-{id_regata}.html', [RegateController::class, 'regate']);
Route::get('regate-{anno_regata}.html', [RegateController::class, 'index']);
	Route::get('en/regate-{anno_regata}.html', [RegateController::class, 'index']);
	Route::get('en/regattas-{anno_regata}.html', [RegateController::class, 'index']);

// AREA SOCI 
Route::get('benvenuto.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'benvenuto');
Route::get('en/benvenuto.html', [IndexController::class, 'index'])
    ->defaults('cmd', 'benvenuto');

Route::get('area-soci/centro-sportivo.html', [IndexController::class, 'index'])
	->defaults('cmd', 'centro-sportivo');
Route::get('en/area-soci/centro-sportivo.html', [IndexController::class, 'index'])
	->defaults('cmd', 'centro-sportivo');


Route::get('area-soci/reservation-request.html', [IndexController::class, 'index'])
	->defaults('cmd', 'reservation-request');
Route::get('en/area-soci/reservation-request.html', [IndexController::class, 'index'])
	->defaults('cmd', 'reservation-request');	

Route::post('area-soci/reservation-request-confirm.html', [IndexController::class, 'invioFormReservation']);
Route::post('en/area-soci/reservation-request-confirm.html', [IndexController::class, 'invioFormReservation']);

Route::get('area-soci/i-miei-ordini-{status}.html', [AreaRiservataController::class, 'iMieiOrdiniAreaSoci']);
	Route::get('en/area-soci/i-miei-ordini-{status}.html', [AreaRiservataController::class, 'iMieiOrdiniAreaSoci']);
Route::get('area-soci/logout.html', [AreaRiservataController::class, 'logout']);
	Route::get('en/area-soci/logout.html', [AreaRiservataController::class, 'logout']);
Route::post('area-soci/login.html', [AreaRiservataController::class, 'loginAreaSoci']);
	Route::post('en/area-soci/login.html', [AreaRiservataController::class, 'loginAreaSoci']);
Route::post('area-soci/registrazione.html', [AreaRiservataController::class, 'registrazioneAreaSoci']);
	Route::post('en/area-soci/registrazione.html', [AreaRiservataController::class, 'registrazioneAreaSoci']);
Route::post('area-soci/recupera-password.html', [AreaRiservataController::class, 'recuperaPasswordAreaSoci']);
	Route::post('en/area-soci/recupera-password.html', [AreaRiservataController::class, 'recuperaPasswordAreaSoci']);
Route::get('cambia-password-{id_cli}.html', [AreaRiservataController::class, 'pagCambiaPasswordAreaSoci']);
	Route::get('en/cambia-password-{id_cli}.html', [AreaRiservataController::class, 'pagCambiaPasswordAreaSoci']);
Route::post('cambia-password-{id_cli}.html', [AreaRiservataController::class, 'cambiaPasswordAreaSoci']);
	Route::post('en/cambia-password-{id_cli}.html', [AreaRiservataController::class, 'cambiaPasswordAreaSoci']);
Route::post('area-soci/profilo-socio.html', [AreaRiservataController::class, 'modificaProfiloAreaSoci']);
	Route::post('en/area-soci/profilo-socio.html', [AreaRiservataController::class, 'modificaProfiloAreaSoci']);
Route::post('area-soci/certificato-di-guidone.html', [AreaRiservataController::class, 'guidoneAreaSoci']);
	Route::post('en/area-soci/certificato-di-guidone.html', [AreaRiservataController::class, 'guidoneAreaSoci']);
	
Route::get('area-soci/la-boutique/{nome_cat}-{id_cat}/{nome_sottocat}-{id_sottocat}/{nome_dett}-{id_dett}.html', [AreaRiservataController::class, 'prodottiDett']);
	Route::get('en/area-soci/la-boutique/{nome_cat}-{id_cat}/{nome_sottocat}-{id_sottocat}/{nome_dett}-{id_dett}.html', [AreaRiservataController::class, 'prodottiDett']);
Route::get('area-soci/la-boutique/{nome_cat}-{id_cat}/{nome_sottocat}-{id_sottocat}.html', [AreaRiservataController::class, 'boutique']);
	Route::get('en/area-soci/la-boutique/{nome_cat}-{id_cat}/{nome_sottocat}-{id_sottocat}.html', [AreaRiservataController::class, 'boutique']);
Route::get('area-soci/la-boutique/{nome_cat}-{id_cat}.html', [AreaRiservataController::class, 'boutique']);
	Route::get('en/area-soci/la-boutique/{nome_cat}-{id_cat}.html', [AreaRiservataController::class, 'boutique']);
Route::get('area-soci/carrello.html', [CarrelloController::class, 'carrello']);
	Route::get('en/area-soci/carrello.html', [CarrelloController::class, 'carrello']);
Route::post('area-soci/carrello.html', [CarrelloController::class, 'carrelloActions']);
	Route::post('en/area-soci/carrello.html', [CarrelloController::class, 'carrelloActions']);

Route::get('area-soci/checkout.html', [CarrelloController::class, 'checkout']);
	Route::get('en/area-soci/checkout.html', [CarrelloController::class, 'checkout']);
Route::get('area-soci/checkout-step{step}.html', [CarrelloController::class, 'checkout']);
	Route::get('en/area-soci/checkout-step{step}.html', [CarrelloController::class, 'checkout']);
Route::post('area-soci/checkout-step{step}.html', [CarrelloController::class, 'checkoutPost']);
	Route::post('en/area-soci/checkout-step{step}.html', [CarrelloController::class, 'checkoutPost']);
Route::post('paga.html', [CarrelloController::class, 'pagamento']);
	Route::post('en/paga.html', [CarrelloController::class, 'pagamento']);

Route::get('paypal_response.php', [CarrelloController::class, 'paypalResponse']);
Route::post('paypal_response.php', [CarrelloController::class, 'paypalResponse']);
//Route::get('ipn.php', [CarrelloController::class, 'ipn']);

Route::get('area-soci/{cmd}.html', [IndexController::class, 'index']);
	Route::get('en/area-soci/{cmd}.html', [IndexController::class, 'index']);

Route::get('ajax/quantitaAdd.php', [CarrelloController::class, 'quantitaAdd']);
Route::post('/conferma-ordine.html', [CarrelloController::class, 'ordina']);
	Route::post('/en/order-confirmation.html',[CarrelloController::class, 'ordina']);	
Route::get('/carrelloFrame.php', [CarrelloController::class, 'carrelloFrame']);

// DEFAULT
Route::get('/{cmd}', [IndexController::class, 'index']);
	Route::get('/en/{cmd}', [IndexController::class, 'index']);
