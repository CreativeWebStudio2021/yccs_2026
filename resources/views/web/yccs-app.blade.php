@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/ufficio_stampa.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = "YCCS APP";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']="YCCS APP"; $breadcrumbs[$x]['link']=''; 
		
	@endphp
	@include('web.common.page_title')
	
	<style>
		.form-group label:not(.error) {font-weight: 600; color:#111111}
		.form-gray-fields .form-control {
			background-color: #f2f2f2;
			border-color: #e9e9e9;
			color: #333;
		}
	</style>
					
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-2"></div>
				<div class="content col-lg-6">
					<div class="panel-body">
						<h3>YCCS APP</h3>
						
						<div style="margin-top:30px;margin-bottom:50px;">
							<?php if($lingua=="ita"){?>
								<p>L’APP YCCS è pensata per tutti i partecipanti alle regate internazionali organizzate dallo Yacht Club e per gli appassionati al mondo della vela e del mare.</p>
								<p>Disponibile gratuitamente sugli store iOS e Android, permette di avere aggiornamenti live sulle attività sportive con informazioni utili sulla Costa Smeralda e dintorni.</p>
								<p>All’interno dell’APP, si trova anche un’area dedicata unicamente al progetto di preservazione dell’ambiente marino promosso dallo YCCS: One Ocean.</p>
							<?php }else{?>
								<p>YCCS APP is designed for everyone participating in the international regattas organised by the Yacht Club and for sailing and marine enthusiasts.</p>
								<p>Available free from iOS and Android stores, it provides live updates on sporting activities together with useful info on the Costa Smeralda and surrounding areas.</p>
								<p>The APP also contains an area dedicated to the project for the safeguard of the marine environment promoted by YCCS: One Ocean.</p>
							<?php }?>
						</div>
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="col-lg-3" style="text-align:center; margin-bottom:10px;">
								<a href="https://itunes.apple.com/it/app/yccs/id1396409475?mt=8" target="_blank"><button class="btn btn-primary " style="width:200px; text-align:center;"><b><?php if($lingua=="ita"){?>Scarica Per iOS<?php }else{?>Download for iOS<?php }?></b></button></a>
							</div>
							<div class="col-lg-2"></div>
							<div class="col-lg-3" style="text-align:center; margin-bottom:30px;">
								<a href="https://play.google.com/store/apps/details?id=it.yccs.YCCS&hl=it" target="_blank"><button class="btn btn-primary " style="width:200px; text-align:center;"><b><?php if($lingua=="ita"){?>Scarica Per Android<?php }else{?>Download for Android<?php }?></b></button></a>
							</div>
						</div>
					</div>
				</div>			
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-4" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-7">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-5"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection