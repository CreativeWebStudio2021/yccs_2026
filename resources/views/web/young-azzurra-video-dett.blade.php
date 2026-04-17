@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/storia.jpg";
		$video_background = "web/video/Young-Azzurra-1920x500.mp4";
		$page_title = "Young Azzurra Video Gallery";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Young Azzurra'; $breadcrumbs[$x]['link']='young-azzurra.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']='Video Gallery'; $breadcrumbs[$x]['link']='young-azzurra/video_gallery.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']=$query_dett[0]->titolo; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					<div style="float:right;">
						<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/video_gallery<?php if($pag_att && $pag_att>1){?>_pag<?php echo $pag_att;?><?php }?>.html" title="Young Azzurra - Photogallery">
							<button type="button" class="btn btn-dark btn-sm"><i class="fa fa-arrow-left"></i> Video Gallery</button>
						</a>
					</div>
					<div style="clear:both"></div>
					<h2><?php echo $page_title;?></h2>
					@if($query_dett[0]->video_fb)
						<div id="fb-root"></div>
						<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
							
						<div class="fb-video" data-href="https://www.facebook.com/facebook/videos/<?php echo $query_dett[0]->video_fb;?>/"  data-show-text="false" style="width:100%;z-index:10000"></div>
					@else
						@php
							$video = $query_dett[0]->video;
							if($lingua=="eng" && $query_dett[0]->video_eng && trim($query_dett[0]->video_eng)!="") $video = $query_dett[0]->video_eng;
							$arr_link = explode("?v=",$video);
							if (isset($arr_link[1]) && $arr_link[1]!="") $codice_video = substr($arr_link[1],0,11);
								else $codice_video = $video;
						@endphp
						<iframe  width="560" height="315" src="https://www.youtube.com/embed/<?php echo $codice_video;?>?rel=0" frameborder="0" allowfullscreen></iframe>	
					@endif
					@php
						$testo_gal = $query_dett[0]->testo;
						if($lingua=="eng" && $query_dett[0]->testo_eng && trim($query_dett[0]->testo_eng)!="") $testo_gal = $query_dett[0]->testo_eng;
					@endphp
					@if(isset($testo_gal) && $testo_gal!="")
						<div style="margin:30px 0;">
							<p>{!! $testo_gal !!}</p>
						</div>
					@endif
				</div>
				<div class="content col-lg-1"></div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-9">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-3"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection