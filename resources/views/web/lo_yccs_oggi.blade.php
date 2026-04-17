@extends('web.index')

@section('content')
	@php		
		$video_background = "web/video/video_test.mp4";
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.il club'); $breadcrumbs[$x]['link']='';
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	@include('web.assets.la_storia_css')

	<div id="pagContainer">
		<div style="width:100%; display:flex; gap:35px;">
			<h3 class="gradient-title">{{ $page_title }}</h3>
			<div style="flex:1;">
				<div class="link-arrow" style="width:163px !important; gap:47px !important; margin-top:30px; padding-left:calc(100% - 163px); padding-bottom:7px; border-bottom:solid 2px;">
				 
				</div>
			</div>
		</div>

		
		@php
			$query_foto = DB::table('fotogallery_pagine');
			$query_foto = $query_foto->select('*');
			$query_foto = $query_foto->where('pagina','=','lo-yccs-oggi');
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
							<p style="margin-top:0;">
							Lo YCCS organizza regate veliche di livello internazionale, inclusi campionati mondiali, per un'ampia varietà di barche, con una esperienza specifica per superyacht e maxi yacht. Tra le prestigiose classi che sovente regatano in Costa Smeralda segnaliamo J Class, Wally Class, TP52, RC44, ClubSwan 50, Melges 32, J/70, Maxi 72. Lo YCCS organizza inoltre regate in collaborazione con cantieri di alta gamma come Nautor's Swan, Perini Navi, Southern Wind.
							</p>
							<p>
							Oltre all’attività sportiva, lo YCCS promuove anche le attività legate alla YCCS Sailing School e alla Fondazione One Ocean, nata a marzo del 2018 e risultato del progetto lanciato nel 2017, in occasione del cinquantesimo anniversario del Club, a favore della sostenibilità ambientale.
							</p>
						<?php }else{?>
							<p style="margin-top:0;">
							The YCCS organises international sailing regattas, including world championships, for a wide range of boats and has specific experience with superyachts and maxi yachts. Among the prestigious classes that frequently race in Costa Smeralda are the J Class, Wally Class, TP52, RC44, ClubSwan 50, Melges 32, J/70 and Maxi 72 classes. The YCCS also organises regattas in collaboration with top shipyards such as Nautor’s Swan, Perini Navi and Southern Wind.
							</p>
							<p>
							In addition to the sporting calendar, the YCCS also promotes activities relating to the YCCS Sailing School and the One Ocean Foundation, created in March 2018 from an environmental sustainability project launched in 2017 to mark the Club’s 50th anniversary.
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