@extends('web.index')


@section('content')		
	@php	
		$query_blocchi = DB::table('azzurra_40')
				->select('*')
				->get();
		$testo_1 = $query_blocchi[0]->testo_1;
		$testo_1_eng = $query_blocchi[0]->testo_1_eng;
		$testo1 = $testo_1;
		if($lingua=="eng" && isset($testo_1_eng) && $testo_1_eng!="") $testo1 = $testo_1_eng;
		
		$testo_2 = $query_blocchi[0]->testo_2;
		$testo_2_eng = $query_blocchi[0]->testo_2_eng;
		$testo2 = $testo_2;
		if($lingua=="eng" && isset($testo_2_eng) && $testo_2_eng!="") $testo2 = $testo_2_eng;
		
		$testo_3 = $query_blocchi[0]->testo_3;
		$testo_3_eng = $query_blocchi[0]->testo_3_eng;
		$testo3 = $testo_3;
		if($lingua=="eng" && isset($testo_3_eng) && $testo_3_eng!="") $testo3 = $testo_3_eng;
		
		$video = $query_blocchi[0]->video;
		$foto_testata = $query_blocchi[0]->foto_testata;
		$foto_sotto = $query_blocchi[0]->foto_sotto;
		
		$page_title = "40 anni di Azzurra";
		if($lingua=="eng") $page_title = "40 years of Azzurra";	
		
		$video_background = "web/video/Club_e_varie_regate-960.mp4";
		$img_background = "web/images/testate/storia.jpg";
	@endphp
	
	<style>				
		p{font-size:18px; line-height:24px; font-family:'Open Sans'}
		.tp-tabs, .tp-thumbs, .tp-bullets{display:none;}
		
		.testoMagazine{font-size:1.3em; line-height:1.3em}
		.testoLato{padding:150px}
		.halfMagazine{float:left; width:50%;}
		.prx{margin:30px 0px;}
		
		#magazine_tit{font-size:3.8em; line-height:1em}
		#magazine_sottotit{font-size:2em;}
		#magazine_bcrumbs{font-size:1em;}
		#blockSlide{width:50%; padding:20px 30px;}
				
		@media screen AND (min-width:1025px){
			.prx{margin:80px 0px;}
		}
		
		@media screen AND (max-width:1200px){
			.testoLato{padding:75px}
			#blockSlide{width:60%;}
		}
		@media screen AND (max-width:1025px){
			#blockSlide{width:70%; padding:50px 30px;}
		}
		@media screen AND (max-width:800px){
			.testoMagazine{font-size:1.3em; line-height:1.3em}
			.testoLato{padding:50px}
		}
		@media screen AND (max-width:600px){
			.testoMagazine{font-size:1.2em; line-height:1.25em}
			.testoLato{padding:40px}
			#magazine_tit{font-size:2em;}
			#magazine_sottotit{font-size:1.3em;}
			#blockSlide{padding:8px 10px;}
		}
		@media screen AND (max-width:478px){
			.halfMagazine{width:100%;}
			.testoLato{padding:50px 20px}
		}					
	</style>
	
	@if (isset($foto_testata) && $foto_testata!="")
		<style>
			#sliderMob{display:none}
			#slider{display:block}
			#titleMob{width:50%;}
			#titleMobTitolo{font-size:2.5em}
			
			@media screen AND (max-width:850px){
				#sliderMob{display:block}
				#slider{display:none}
			}
			@media screen AND (max-width:650px){
				#titleMob{width:60%;}
			}
			@media screen AND (max-width:550px){
				#titleMob{width:70%;}
			}
			@media screen AND (max-width:450px){
				#titleMob{width:80%;}
			}
			@media screen AND (max-width:400px){
				#titleMobTitolo{font-size:1.85em}
			}
		</style>
		<div id="sliderMob" style="position:relative; margin-bottom:80px">
			<img src="{{ asset($img_background) }}" alt="{!! $page_title !!}" style="width:100%"/>
			
			<div id="titleMob" style="position:absolute;  top: 50%; left: 50%; transform: translate(-50%, -50%); background:rgba(0,0,0,0.5)">
				<div style="padding:20px; color:#fff; text-align:center;">
					<img src="web/images/azzurra_logo_w.png" style="width:120px" alt="Azzurra"/>
					
					<div style="margin-top:20px">
						<span id="titleMobTitolo">{!! $page_title !!}</span>
					</div>
					<div>
						<a href="<?php if($lingua=="eng") echo "en/";?>home.html" style="color:#fff">
							<i class="fa fa-home"></i></a>
							- <a  style="color:#fff">Azzurra</a>
							- <a href="<?php if($lingua=="eng"){ echo "en/"; }?>azzurra/40_anni_di_azzurra.html" style="color:#fff">{!! $page_title !!}</a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- SECTION REVOLUTION SLIDER -->
		<div id="slider" style="position:relative; height:100vh; min-height:100vh; top:-130px; background:url(resarea/img_up/azzurra_40/<?php  echo $foto_testata; ?>) center center; background-size:cover;">
			
			<div id="blockSlide" style="background:rgba(0,0,0,0.5); margin:0 auto;  position:absolute; display: inline-block; text-align:centeR; top:50%; left:50%;-ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%); color:#fff;">
				<style>
					#logoAzzurra{width:200px; height:86px; margin:0 auto;}
					@media  screen AND (max-width:1024px){
						#logoAzzurra{width:150px; height:65px; margin:-20px auto 10px;}
					}
				</style>
				<div id="logoAzzurra">
					<img src="web/images/azzurra_logo_w.png" style="width:100%" alt="Azzurra"/>
				</div>
				
				<div id="magazine_tit" style=" font-weight: 900; ">
					<span>{!! $page_title !!}</span>
				</div>					
				
				<div id="magazine_bcrumbs" style="font-weight: 500; margin-top:15px; text-align:center;">
					<a href="<?php if($lingua=="eng") echo "en/";?>home.html" style="color:#fff">
						<i class="fa fa-home"></i></a>
						- <a  style="color:#fff">Azzurra</a>
						- <a href="<?php if($lingua=="eng"){ echo "en/"; }?>azzurra/40_anni_di_azzurra.html" style="color:#fff">{!! $page_title !!}</a>
				</div>
			</div>
		</div>
		<!-- END SECTION REVOLUTION SLIDER -->
	@endif
	
	<div class="testoMagazine">
		@if (isset($testo1) && $testo1!="")
			<section class="content" style="padding-top:0; margin-top:0px;">
				<div class="container">
					<?php 
					$testo1 = $testo_1;
					if($lingua=="eng" && isset($testo_1_eng) && trim($testo_1_eng)!="") $testo1 = $testo_1_eng;
					?>
					{!! $testo1 !!}
				</div>
			</section>
		@endif
		
		@if (isset($video) && $video!="")
			<section class="content background-grey">
				<div class="container">
					<iframe src="https://player.vimeo.com/video/{!! $video !!}?title=0&byline=0&portrait=0" width="500" height="281"></iframe>
				</div>
			</section>
		@endif
		
		@if (isset($testo2) && $testo2!="")
			<section class="content">
				<div class="container">
					<?php 
					$testo2 = $testo_2;
					if($lingua=="eng" && isset($testo_2_eng) && trim($testo_2_eng)!="") $testo2 = $testo_2_eng;
					?>
					{!! $testo2 !!}
				</div>
			</section>
		@endif
		
		@php
			$dir_up = "resarea/img_up";		
			$b=1;
			$query_video = DB::table('azzurra_40_video')
				->select('*')
				->orderby('ordine','DESC')
				->get();
			$num_video = $query_video->count();
		@endphp
		
		@if($num_video>0)
			<section class="background-grey p-b-90">
				<div class="carousel" data-items="6">
					@foreach($query_video AS $key_video=>$value_video)
						@php
							$titolo_video = $value_video->titolo;
							if($lingua=="eng" && isset($value_video->titolo_eng) && $value_video->titolo_eng!="") $titolo_video = $value_video->titolo_eng;
						@endphp
						<!-- Post item-->
						<div class="post-item border" onmouseenter="seeVideoPlay({!! $value_video->id !!})" onmouseleave="hideVideoPlay({!! $value_video->id !!})">
							<div class="post-item-wrap">
								<div class="post-image" style="position:relative;">
									<a href="https://vimeo.com/{!! $value_video->video !!}" data-lightbox="iframe">
										<img src="https://vumbnail.com/{!! $value_video->video !!}.jpg"  alt="{!! $titolo_video !!} - {!! $page_title !!} - Azzurra"/> 
									</a>
									<div id="video_{!! $value_video->id !!}" style="position:absolute; width:100%; height:100%; top:0; left:0; display:none">
										<a href="https://vimeo.com/{!! $value_video->video !!}" data-lightbox="iframe">
											<div style="width:100%; height:100%; background:rgba(0,0,0,0.5); position:relative;">
												<div style="color:rgba(255,255,255,0.9); font-size:3em; text-align:center;width:100%; position:absolute; top:50%; transform: translateY(-50%);"><i class="icon-play-circle"></i></div>
											</div> 
										</a>
									</div>
								</div>
								<div class="post-item-description">
									<h3 style="font-size:20px; line-height:20px; text-transform: uppercase;">
										{!! $titolo_video !!}
									</h3>
								</div>
							</div>
						</div>
						<!-- end: Post item-->
					@endforeach
				</div>
				<script>
					function seeVideoPlay(id){
						$("#video_"+id).fadeIn();
					}
					function hideVideoPlay(id){
						$("#video_"+id).fadeOut();
					}
				</script>
				
			</section>
		@endif	
		
		@if (isset($testo3) && $testo3!="")
			<section class="content p-b-20">
				<div class="container">
					<?php 
					$testo3 = $testo_3;
					if($lingua=="eng" && isset($testo_3_eng) && trim($testo_3_eng)!="") $testo3 = $testo_3_eng;
					?>
					{!! $testo3 !!}
				</div>
			</section>
		@endif
		
		<div class="img-holder prx" style="margin-bottom:0" data-image="https://www.yccs.it/resarea/img_up/azzurra_40/<?php echo $foto_sotto;?>"></div>			
		
	</div>
@endsection	
