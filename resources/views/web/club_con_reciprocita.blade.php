@extends('web.index')

@section('content')
	@php		
		$video_background = "web/video/Club_e_varie_regate-1920x500.mp4";
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.il club'); $breadcrumbs[$x]['link']='';
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	@include('web.assets.la_storia_css')
	<style>
		.page-title-container{
			width:100%;
			display:flex;
			gap:35px;
		}
		@media screen and (max-width: 800px) {
			.page-title-container{
				flex-direction:column;
				gap:0px;
			}
			.link-arrow{
				margin-top:0px !important;
				height:0px !important;
			}
		}
		@media screen and (max-width: 600px) {
			.gradient-title{
				font-size:50px !important;
				line-height:1 !important;
			}
		}
	</style>
	<div id="pagContainer">
		<div class="page-title-container">
			<h3 class="gradient-title">{{ $page_title }}</h3>
			<div style="flex:1;">
				<div class="link-arrow" style="width:163px !important; gap:47px !important; margin-top:30px; padding-left:calc(100% - 163px); padding-bottom:7px; border-bottom:solid 2px;">
				 
				</div>
			</div>
		</div>

		
		<?php
		function boxFlag($name, $image, $website){
			return '
				<img src="https://www.yccs.it/web/images/loghi/'.$image.'" style="max-width:440px; width:100%; margin:0 auto;" alt="'.$name.'"/>
				<div style="width:100%; text-align:center;">
					<h3 style="font-size:22px">'.$name.'</h3>
				</div>
				<a style="color:#fff; text-transform: lowercase;" href="'.$website.'" target="_blank" title="'.$name.'">
					<div style="width:280px;height:22px; margin:0 auto; margin-top:20px;" class="btnYccsGradient">
						'.$website.'
					</div>
				</a>
			';
		}
		?>
		<style>
			.club-con-reciprocita-container{
				display:flex;
				gap:20px;
			}
			@media screen and (max-width: 800px) {
				.club-con-reciprocita-container{
					flex-direction:column;
				}
			}
		</style>
		
		<div style="display:flex; gap:40px; flex-direction:column; padding-bottom:30px;">
			<div class="club-con-reciprocita-container">
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("ROYAL THAMES YACHT CLUB", "logo_royal_theme_yacht_club.jpg", "https://royalthames.com/"); ?>
				</div>
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("ST. FRANCIS YACHT CLUB", "logo_st_fracis_yacht_club.jpg", "https://www.stfyc.com/"); ?>
				</div>
				<div style="flex:1; text-align:centeR;">
					<?php /*echo boxFlag("GSTAAD YACHT CLUB", "logo_gstaad_yacht_club.jpg", "https://www.gstaadyachtclub.com/"); */?>
					<?php echo boxFlag("KEY BISCANE YACHT CLUB", "KBYC-main-logo.jpg", "https://www.kbyc.org/"); ?>
				</div>
			</div>
			
			<div class="club-con-reciprocita-container">
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("YACHT CLUB OF GREECE", "logo_yacht_club_of_greece2.jpg", "https://ycg.gr/"); ?>
				</div>
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("CRUISING YACHT CLUB OF AUSTRALIA", "logo_cyca.jpg", "https://cyca.com.au/"); ?>
				</div>
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("YACHT CLUB ARGENTINO", "logo_yca.jpg", "https://yca.org.ar/"); ?>
				</div>
			</div>	
			
			<div class="club-con-reciprocita-container">
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("SOCIÉTÉ NAUTIQUE DE GENÈVE", "logo_sng.jpg", "https://www.nautique.ch/"); ?>
				</div>
				<div style="flex:1; text-align:centeR;">
					
				</div>
				<div style="flex:1; text-align:centeR;">
					
				</div>
			</div>			
		</div>	
	</div>	
@endsection