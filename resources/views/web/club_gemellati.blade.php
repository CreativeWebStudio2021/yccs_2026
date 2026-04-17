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
				<img src="web/images/loghi/'.$image.'" style="max-width:440px; width:100%; margin:0 auto;" alt="'.$name.'"/>
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
			.club-gemellati-container{
				display:flex;
				gap:20px;
			}
			@media screen and (max-width: 800px) {
				.club-gemellati-container{
					flex-direction:column;
				}
			}
		</style>
		<div style="display:flex; gap:40px; flex-direction:column; padding-bottom:30px;">
			<div class="club-gemellati-container">
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("YACHT CLUB DE MONACO", "logo_yacht_club_de_monaco2.jpg", "https://yacht-club-monaco.mc/"); ?>
				</div>
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("NEW YORK YACHT CLUB", "logo_new_york_yacht_club2.jpg", "https://nyyc.org/"); ?>
				</div>
			</div>
			
			<div class="club-gemellati-container" >
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("ROYAL YACHT SQUADRON", "logo_royal_yacht_squadron.jpg", "https://www.rys.org.uk/"); ?>
				</div>
				<div style="flex:1; text-align:centeR;">
					<?php echo boxFlag("NORDDEUTSCHER REGATTA VEREIN", "logo_NRV2.jpg", "https://www.nrv.de/"); ?>
				</div>
			</div>			
		</div>
	</div>	
@endsection