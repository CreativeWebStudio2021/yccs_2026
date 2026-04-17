@extends('web.index')

@section('content')
	@php		
		$video_background = "web/video/Piazza-Azzurra-1920x500.mp4";
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
			width:100%; display:flex; gap:35px;	
		}
		.gradient-title{
			line-height:1 !important;
		}
		@media screen and (max-width: 1024px) {
			.gradient-title{
				font-size:54px !important;
			}
		}
		@media screen and (max-width: 900px) {
			.page-title-container{
				flex-direction:column;
				gap:0px;
			}
			.link-arrow{
				margin-top:0px !important;
				height:0px !important;
				width:100% !important;
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

		
		@php
			$query_foto = DB::table('fotogallery_pagine');
			$query_foto = $query_foto->select('*');
			$query_foto = $query_foto->where('pagina','=','la-piazza-azzurra');
			$query_foto = $query_foto->get();	
			$num_foto = $query_foto->count();	
			$x=0;
		@endphp
		@if($num_foto>0)
			<div style="width:100%; margin-top:50px;">
				<div class="media-slider-container">
					<div class="media-slider-wrapper">				
						@foreach($query_foto AS $key_foto=>$value_foto)
							@php
								$x++;
								$dir_up = "resarea/img_up";
								
								$img="$dir_up/pagine/".$value_foto->foto;
								if(is_file("$dir_up/pagine/xs_".$value_foto->foto)) $img_xs="$dir_up/pagine/xs_".$value_foto->foto; else $img_xs=$img;
								if(is_file("$dir_up/pagine/s_".$value_foto->foto)) $img_s="$dir_up/pagine/s_".$value_foto->foto; else $img_s=$img;
								if(is_file("$dir_up/pagine/m_".$value_foto->foto)) $img_m="$dir_up/pagine/m_".$value_foto->foto; else $img_m=$img;
								if(is_file("$dir_up/pagine/l_".$value_foto->foto)) $img_l="$dir_up/pagine/l_".$value_foto->foto; else $img_l=$img;
							@endphp
								<a href="<?php echo $img_l;?>" class="glightbox" data-gallery="gallery">
									<div class="media-slide <?php if($x==1){?>active<?php }?>">
										<picture>
											<source srcset="<?php echo $img_m;?>" media="(max-width: 600px)" />
											<source srcset="<?php echo $img_s;?>" media="(max-width: 440px)" />
											<source srcset="<?php echo $img_xs;?>" media="(max-width: 340px)" />
											<img src="<?php echo $img_l;?>"  alt="{!! $value_foto->testo !!} - {{ Lang::get('website.'.$pagina.' nome pagina') }} - {{ config('app.name') }}" class="slide-background-image" alt=""/>
										</picture>
										<div class="slide-content-color-overlay"></div>
										@if($value_foto->testo && $value_foto->testo!="")
											<div class="slide-content-overlay" style="width:100%;">
												<h2>{!! $value_foto->testo !!}</h2>					
											</div>
										@endif
									</div>
								</a>
						@endforeach					
					</div>					
					<div style="position:absolute; width:100%; left:0; bottom:0px; z-index:2">
						<div class="slider-nav-wrapper" style="width:calc(100% - 40px); bottom:10px; margin-left:20px; transform:translate(0px);">
							<button class="nav-arrow-button prev-slide">
								<img src="{{ asset('web/images/freccia_sinistra.png') }}" alt="Prev">
							</button>
							<button class="nav-arrow-button next-slide">
								<img src="{{ asset('web/images/freccia_destra.png') }}" alt="Next">
							</button>
						</div>
					</div>
				</div>
			</div>
		@endif
		
		<style>
			.multi-column {
			  column-count: 2;
			  column-gap: 50px;
			  text-align: justify;
			}

			@media (max-width: 768px) {
			  .multi-column {
				column-count: 1;
			  }
			}
		</style>
			
		<div style="width:100%;display:flex; margin-bottom:30px;">
			<div style="flex:1; height:100%;  position:relative;">
				<div>
					<div style="padding:50px 0; "  class="multi-column">
						<?php if($lingua=="ita"){?>
							<p style="text-align: justify;">
								Piazza Azzurra, antistante l'edificio dello YCCS, è il cuore di tutti gli eventi sociali e sportivi organizzati dal Club. Durante le regate in calendario si popola di regatanti e giornalisti che animano la sala stampa e gli stand dei partner. I velisti al rientro dalle prove in mare si ritrovano nella piazza per piegare le vele e godersi momenti di relax insieme, i giudici di gara l'attraversano per recarsi sulla barca comitato. Non solo, è anche il luogo di ritrovo per briefing, premiazioni e feste dedicate ad armatori ed equipaggi.     
								<br/>
								In Piazza Azzurra si trovano una boutique di abbigliamento sportivo, uno shipchandler, un ATM, bar-ristoranti con ricercate proposte eno-gastronomiche, un famoso coiffeur e altri servizi.
								<br/>
								Tramite la piazza si può inoltre accedere al <a href="yccs-porto-cervo/yccs-wellness-center.html" class="azzurro" title="YCCS Wellness Center & SPA">YCCS Wellness Center & SPA</a>.
							</p>
						<?php }else{?>
							<p style="text-align: justify;">
								Adjoining the YCCS Clubhouse, the Piazza Azzurra is at the heart of all the sporting and social events organised by the club. During regattas it fills with sailors and journalists who flock to the media centre and partners’ stands. After racing, sailors gather in the Piazza to fold away their sails and relax together while race officials criss-cross the square going to and from committee boats. It also hosts briefings, prize givings and parties for owners and crews.
								<br/>
								Piazza Azzurra is home to sportswear boutique, a ship chandler, an ATM, elegant bar-restaurants, a renowned hairdressing salon and other services.
								<br/>
								The <a href="en/yccs-porto-cervo/yccs-wellness-center.html" class="azzurro"  title="YCCS Wellness Center & SPA">YCCS Wellness Center & SPA</a> is also accessible from Piazza Azzurra.
							</p>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
		
		
		@include('web.assets.la_storia_js')
		
		<!-- GLightbox CSS -->
		<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
		<!-- GLightbox JS -->
		<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
		<script>
			document.addEventListener("DOMContentLoaded", () => {
			  const lightbox = GLightbox({
				selector: '.glightbox',
				touchNavigation: true,
				loop: true,
				autoplayVideos: true
			  });
			}); 
		</script>	
@endsection