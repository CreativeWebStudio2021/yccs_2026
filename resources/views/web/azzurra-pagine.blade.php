@extends('web.index')

@section('content')
	@php
		$query_pag = DB::table('azzurra_pagine')
			->select('*')
			->where('id','=',$id_dett)
			->get();
			
		$tit_pag = $query_pag[0]->titolo;
		if($lingua=="eng" && $query_pag[0]->titolo_eng && trim($query_pag[0]->titolo_eng)!="") $tit_pag = $query_pag[0]->titolo_eng;
		$foto_dett = $query_pag[0]->foto;
		$testo_pag = $query_pag[0]->testo;
		if($lingua=="eng" && $query_pag[0]->testo_eng && trim($query_pag[0]->testo_eng)!="") $testo_pag = $query_pag[0]->testo_eng;
		
		$img_background = "web/images/testate/storia.jpg";
		$video_background = "web/video/Azzurra-Americas-Cup-1920x500.mp4";
		$page_title = $tit_pag;
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Azzurra'; $breadcrumbs[$x]['link']='';
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@if($id_dett!='2' && $id_dett!='3')
		@include('web.common.page_title')
	@endif
	@include('web.assets.la_storia_css')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					@php
						$query_foto = DB::table('azzurra_pagine_slide');
						$query_foto = $query_foto->select('*');
						$query_foto = $query_foto->where('id_rife','=',$id_dett);
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
											
											$img="$dir_up/azzurra_pagine_slide/".$value_foto->img;
											if(is_file("$dir_up/azzurra_pagine_slide/xs_".$value_foto->img)) $img_xs="$dir_up/azzurra_pagine_slide/xs_".$value_foto->img; else $img_xs=$img;
											if(is_file("$dir_up/azzurra_pagine_slide/s_".$value_foto->img)) $img_s="$dir_up/azzurra_pagine_slide/s_".$value_foto->img; else $img_s=$img;
											if(is_file("$dir_up/azzurra_pagine_slide/m_".$value_foto->img)) $img_m="$dir_up/azzurra_pagine_slide/m_".$value_foto->img; else $img_m=$img;
											if(is_file("$dir_up/azzurra_pagine_slide/l_".$value_foto->img)) $img_l="$dir_up/azzurra_pagine_slide/l_".$value_foto->img; else $img_l=$img;
										@endphp
											<a href="https://www.yccs.it/<?php echo $img_l;?>" class="glightbox" data-gallery="gallery">
												<div class="media-slide <?php if($x==1){?>active<?php }?>">
													<picture>
														<source srcset="https://www.yccs.it/<?php echo $img_m;?>" media="(max-width: 600px)" />
														<source srcset="https://www.yccs.it/<?php echo $img_s;?>" media="(max-width: 440px)" />
														<source srcset="https://www.yccs.it/<?php echo $img_xs;?>" media="(max-width: 340px)" />
														<img src="https://www.yccs.it/<?php echo $img_l;?>"  alt="{!! $value_foto->testo !!} - {{ Lang::get('website.'.$pagina.' nome pagina') }} - {{ config('app.name') }}" class="slide-background-image" alt=""/>
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
					
					
					<!-- CAROUSEL -->
					<section class="no-padding" style="margin-top:20px;">
						<div id="blog" class="single-post" style="">
							<div class="post-item">
								<div class="post-item-wrap">							
									<?php if($foto_dett){?>
										<div class="post-image">
											<img style="width:100%" src="https://www.yccs.it/resarea/img_up/azzurra_pagine/<?php echo $foto_dett;?>">
										</div>
									<?php }?>
									<div class="post-item-description">
										{!! $testo_pag !!}					
									</div>
								</div>
							</div>
						</div>
						<hr>
						@php							
							$query_gal = DB::table('azzurra_pagine_gallery')
								->select('*')
								->where('id_rife','=',$id_dett)
								->orderby('ordine','DESC')
								->get();
								
							$num_gal = $query_gal->count();
							$dir_up = "resarea/img_up";
						@endphp
						@if ($num_gal>0)
							<div class="widget">	
								<h4 class="widget-title"><span class="sidebarTitle"><?php if($lingua=="ita"){?>FOTOGALLERY<?php }else{?>PHOTOGALLERY<?php }?></span></h4>
							</div>
							<div class="grid-layout post-4-columns m-b-30" data-lightbox="gallery" data-item="post-item">
								@foreach($query_gal AS $key_gal=>$value_gal)
									@php
										$foto_gal = $value_gal->img;
										$testo = $value_gal->testo;
										$testo_eng = $value_gal->testo_eng;
										
										$testo_foto=$testo;
										if($lingua=="eng" && $testo_eng && trim($testo_eng)!="")  $testo_foto=$testo_eng;
									@endphp
									@if ($foto_gal!="")
										@php	
											if (is_file("$dir_up/azzurra_pagine_gallery/450_$foto_gal")) $foto_gal_m="450_$foto_gal"; else $foto_gal_m=$foto_gal;
											if (is_file("$dir_up/azzurra_pagine_gallery/360_$foto_gal")) $foto_gal_s="360_$foto_gal"; else $foto_gal_s=$foto_gal;
											if (is_file("$dir_up/azzurra_pagine_gallery/250_$foto_gal")) $foto_gal_xs="250_$foto_gal"; else $foto_gal_xs=$foto_gal;
										@endphp
										<div class="post-item border">
											<div class="post-item-wrap">
												<div class="post-image">
													<a href="https://www.yccs.it/<?php  echo $dir_up; ?>/azzurra_pagine_gallery/{{ $foto_gal }}" data-lightbox="gallery-image"  title="{!! $testo_foto!="" ? $testo_foto." - " : '' !!} {!! ucfirst($tit_pag) !!} - Azzura - {{ config('app.name') }}">
														<picture>
														  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/azzurra_pagine_gallery/<?php echo $foto_gal_s;?>" media="(max-width: 360px)" />
														  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/azzurra_pagine_gallery/<?php echo $foto_gal_m;?>" media="(max-width: 478px)" />
														  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/azzurra_pagine_gallery/<?php echo $foto_gal_s;?>" media="(max-width: 990px)" />
														  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/azzurra_pagine_gallery/<?php echo $foto_gal_xs;?>" media="(max-width: 1199px)" />
														  <img src="https://www.yccs.it/<?php  echo $dir_up; ?>/azzurra_pagine_gallery/<?php echo $foto_gal_m;?>"  alt="{!! $testo_foto!="" ? $testo_foto." - " : '' !!} {!! ucfirst($tit_pag) !!} - Azzura - {{ config('app.name') }}"/>
														</picture>
													</a>
												</div>
											</div>
										</div>
									@endif
								@endforeach
							</div>
						@endif
					</section>
					<!-- end: CAROUSEL -->
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