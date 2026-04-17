@include('web.common.v2.functions')
@extends('web.index')

@section('content')
	
	@php		
		if(isset($_GET['active_tab'])) $active_tab=$_GET['active_tab']; else $active_tab="";
		
		$logo_edizione  = $value_ed->logo_edizione;
		$nome_regata   = $value_ed->nome_regata;
		$luogo    = $value_ed->luogo;
		$data_dal   = $value_ed->data_dal;
		$data_al   = $value_ed->data_al;
		$anno_regata   = $value_ed->anno;
		$img_testata   = $value_ed->img_testata;
		$modulo_iscrizioni   = $value_ed->modulo_iscrizioni;		

		$titolo_regata=$nome_regata." - ".$luogo." ".$anno_regata;
		
		
	@endphp
	
	<link href="{!! asset('web/css/plugins.css') !!}" rel="stylesheet">
	<link href="{!! asset('web/css/style.css') !!}" rel="stylesheet">
	<link href="{!! asset('web/css/custom.css') !!}" rel="stylesheet">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Arizonia&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
	
	<style>
		#v2 div, #v2 span, #v2 a, #v2 p, #v2 h1, #v2 h2, #v2 #v2 h3, #v2 h4, #v2 h5, #v2 h6, #v2 ul, #v2 li {font-family:'Open Sans' !important}
		a{color:#222; transition: 0.3s;}
		a:hover{color:#00AEEF; transition: 0.3s;}	
		
		@media screen AND (max-width:1024px){
			#page-title{margin-top:0px; height:300px !important;}
		}

		.titoliBox{
			//font-family: 'Tinos', serif; 
			color:#10205c; 
			font-size:1.3em; 
			letter-spacing: 2px;
			font-weight:900;
			text-transform: uppercase;
			padding:25px 100px;
		}
		
		.titoliBox2{
			//font-family: 'Tinos', serif; 
			color:#10205c; 
			font-size:1.1em; 
			letter-spacing: 2px;
			font-weight:900;
			text-align:center;
			text-transform: uppercase;
		}
		
		.testiSec{
			//font-family: 'Raleway', sans-serif;
			color:#fff; 
			font-size:1em; 
			text-align:center;
		}
		
		.owl-carousel .owl-controls .owl-nav .owl-next,
		.owl-carousel .owl-controls .owl-nav .owl-prev {
			background: none;
		}
		
		@media (max-width: 400px) {
			.titoliBox{
				padding:10px 20px;
				line-height:20px;
			}
		}
	</style>
	
	<div style="position:relative; width:100%;" id="v2">	
		
		@if( count($errors) > 0)
			@foreach($errors->all() as $error)
				<div  class="row" style="margin-top:20px">
					<div class="col-lg-2"></div>
					<div class="col-lg-8 alert alert-success" role="alert" id="errorMessage" style="background:{{ str_contains($error, 'Error') ? 'red' : '#81c868' }}; border:none;">
						<div style="position:relative; text-align:center; width:100%; margin:0 auto;">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							{!! $error !!}
							<div style="position:absolute; right:0px; top:0px; cursor:pointer;" onclick="$('#errorMessage').fadeOut();"><b>x</b></div>
						</div>
					</div>
					<div class="col-lg-2"></div>
				</div>
			@endforeach
		@endif
		
		@include('web.dettaglio_regata_v2.testata')
		
		@include('web.dettaglio_regata_v2.loghi_sponsor')
		@include('web.dettaglio_regata_v2.comunicati')
		@include('web.dettaglio_regata_v2.documenti')
		
		@include('web.dettaglio_regata_v2.box_info')
		
		@include('web.dettaglio_regata_v2.risultati')
		@include('web.dettaglio_regata_v2.informazioni')
		
		<div  class="row" style="width:100%; margin:0; margin-top:10px;background:#<?php echo $colore;?>">
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align:center; padding:0;">
				@include('web.dettaglio_regata_v2.foto')
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="boxStampa" style="padding:0;">
				@include('web.dettaglio_regata_v2.press')
			</div>
			<div style="clear:both"></div>
		</div>
		@include('web.dettaglio_regata_v2.video')
		@include('web.dettaglio_regata_v2.banner')
		@include('web.dettaglio_regata_v2.loghi_partners')	
		@include('web.dettaglio_regata_v2.footer')	
	</div>
	
	<script>
		function vedi(sezione){
			if ($("#mask_documenti").is(':visible') && sezione!="documenti") $("#mask_documenti").fadeOut();
			if ($("#link_documenti").is(':visible') && sezione!="documenti") $("#link_documenti").slideToggle();
			if ($("#mask_risultati").is(':visible') && sezione!="risultati") $("#mask_risultati").fadeOut();
			if ($("#link_risultati").is(':visible') && sezione!="risultati") $("#link_risultati").slideToggle();
			if ($("#mask_generali").is(':visible') && sezione!="generali") $("#mask_generali").fadeOut();
			if ($("#link_generali").is(':visible') && sezione!="generali") $("#link_generali").slideToggle();	
			if ($("#mask_noticeboard").is(':visible') && sezione!="noticeboard") $("#mask_noticeboard").fadeOut();
			if ($("#link_noticeboard").is(':visible') && sezione!="noticeboard") $("#link_noticeboard").slideToggle();		
			
			if ($("#mask_"+sezione).is(':visible')) $("#mask_"+sezione).fadeOut(); else $("#mask_"+sezione).fadeIn();
			if ($("#link_"+sezione).is(':visible')) $("#link_"+sezione).slideToggle(); else $("#link_"+sezione).slideToggle();
		}
		<?php if($active_tab=="documenti" || $active_tab=="documents"){?>vedi('documenti');<?php }?>
		<?php if($active_tab=="risultati" || $active_tab=="results"){?>vedi('risultati');<?php }?>
		<?php if($active_tab=="informazioni" || $active_tab=="info"){?>vedi('generali');<?php }?>
		<?php if($active_tab=="albo_comunicati" || $active_tab=="official_notice_board"){?>vedi('noticeboard');<?php }?>
		
		@if(isset($message))
			alert('{!!$message!!}');
		@endif
	</script>
@endsection