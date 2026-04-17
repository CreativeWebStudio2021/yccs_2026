@php
	if(isset($metatag['title'])){
		$title_pagina = $metatag['title'];
	} else {
		$title_pagina = Lang::get("website.Default title");
	}
	
	if(isset($metatag['description'])){
		$description_pagina = $metatag['description'];
	} else {
		$description_pagina = Lang::get("website.Default description");
	}
	
@endphp
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<base href="{{ Config::get('app.url') }}/" />

<meta name="author" content="Creative Web Studio" />
<meta name="description" content="{!! $description_pagina !!}">
@include('web.common.meta_fb')

<link rel="icon" type="image/png" href="images/favicon.png">   
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{!! $title_pagina !!} {{ (isset($pag_att) && $pag_att!="1" && $pag_att!="") ? " - Pag $pag_att" : "" }}</title>

<?php if(
		$cmd=="home" || 
		$cmd=="la-storia" || 
		$cmd=="lo-yccs-oggi" || 
		$cmd=="consiglio_direttivo" || 
		$cmd=="club_gemellati" || 
		$cmd=="club_con_reciprocita" || 
		$cmd=="la-clubhouse" || 
		$cmd=="la-piazza-azzurra" || 
		$cmd=="yccs-wellness-center" || 
		//$cmd=="centro-sportivo" || 
		$cmd=="regate" || 
		$cmd=="new"
	){ 
		$_SESSION['version_2025']=1;
	}else{
		$_SESSION['version_2025']=0;
	}?>
	
	@if($_SESSION['version_2025']==0)
		<!-- Document title -->
		<!-- Stylesheets & Fonts -->
		<link href="{!! asset('web/css/plugins.css') !!}" rel="stylesheet">
		<link href="{!! asset('web/css/style.css') !!}" rel="stylesheet">
		<link href="{!! asset('web/css/custom.css') !!}" rel="stylesheet">
		@if($cmd=="new" || $cmd=="new_fotogallery" || $cmd=="new_comunicati" || $cmd=="new_post" || $cmd=="new_modulo_iscrizione" || $cmd=="new_entry_list")
			<link href="{!! asset('web/css/regate.css') !!}" rel="stylesheet">
		@endif

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Arizonia&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

		<?php if($cmd=="reservation-request" || $cmd=="yccs-sailing-school-iscrizioni" || $cmd=="new_modulo_iscrizione" || $cmd=="registrazione-giornalisti"){?>
			<link rel="stylesheet" type="text/css" href="resarea/jui/css/jquery.ui.datepicker.css" media="screen">
			<link rel="stylesheet" type="text/css" href="resarea/jui/css/jquery.ui.all.css" media="screen">
			<link rel="stylesheet" type="text/css" href="resarea/css/mws-theme.css" media="screen">
		<?php }?>

		<script src="{!! asset('web/js/jquery.js') !!}"></script>

		@endif
	<link rel="stylesheet" type="text/css" href="{!! asset('web/flipbook/css/flipbook.style.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('web/flipbook/css/font-awesome.css') !!}">

@include('css.general')
<link rel="stylesheet" href="{{ asset('fonts/Montserrat/montserrat.css') }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{!! asset('web/flipbook/js/flipbook.min.js') !!}"></script>