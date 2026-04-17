@extends('web.index')

@section('content')
	
	@include('web.assets.regate_css')
		<div style="width:width:100%; height:520px; position:relative;">
			<div class="media-slider-container">
			  <div class="media-slider-wrapper">
				<div class="media-slide active">
				  <!-- video slide -->
				  <video autoplay muted loop playsinline class="slide-background-video">
					<source src="web/video/blue-sea.mp4" type="video/mp4">
				  </video>
				  <div class="slide-content-overlay">
					<h1 style="color:#fff">{!! $value_ed->nome_regata !!}</h1>
					<a class="slide-info-link">
					  <div>
						<h3 style="color:#fff">{!! $value_ed->luogo !!}</h3>
						<div class="slide-date" style="color:#fff">
							{{ $lingua=="ita" ? 'dal' : 'from' }} 
							{{ convertDateFormat($value_ed->data_dal,"Y-m-d","d/m") }} 
							{{ $lingua=="ita" ? 'al' : 'to' }}  
							{{ convertDateFormat($value_ed->data_al,"Y-m-d","d/m") }} 
							{!! $value_ed->anno !!}
						</div>
					  </div>
					  <img src="web/images/freccia_bianca.png" class="slide-info-arrow" alt="">
					</a>
				  </div>
				</div>
			  </div>
			</div>		
		</div>
		<div style="width:calc(100% - 260px); margin-left:130px; margin-bottom:40px;">
			<div style="width:100%; display:flex; gap:35px;margin-top:65px;">
				<h3 class="gradient-title">Gallery</h3>
				<div style="flex:1;">
					<div class="link-arrow2" style="margin-top:50px; padding-left:calc(100%); padding-bottom:5px; justify-content:flex-end;">
						<div>
							<a href="{{ $link_regata }}" class="link-arrow3" style="cursor:pointer; width:180px; margin-top:0px;border:none">
								<span>
									<?php if($lingua=="ita"){?>
										Torna alla Regata
									<?php }else{?>
										Back to the Regatta
									<?php }?>
								</span>
								<img src="web/images/arrow.png" alt="freccia" class="arrow-img"/>
							</a>
						</div>
					</div>
				</div>
			</div>
			
			
			@php
				$heights = collect(range(1, 16))->map(fn() => rand(400, 1000));
			@endphp

			<style>
			.gallery {
				column-count: 4;
				column-gap: 1rem;
				margin-top:20px;
			}
			.gallery-item {
				break-inside: avoid;
				margin-bottom: 1rem;
				overflow: hidden; /* per evitare che l'immagine esca dal contenitore */
			}

			.gallery-item img {
				width: 100%;
				height: auto;
				display: block;
				opacity: 1;
				transition: opacity 0.8s ease, transform 1s ease;
			}

			.gallery-item img.loaded {
				opacity: 1;
			}

			.gallery-item:hover img {
				transform: scale(1.05);
			}
			</style>

			<div class="gallery">
				@php
					$query_img = DB::table('edizioni_foto');
					$query_img = $query_img->select('*');
					$query_img = $query_img->where('id_edizione','=',$id_dett);
					$query_img = $query_img->orderby('ordine','DESC');
					//$query_img = $query_img->limit('20');
					$query_img = $query_img->get();
					$num_img = $query_img->count();
					
					$i=0;
				@endphp
	
				@foreach($query_img AS $key_img=>$value_img)
					@foreach($value_img AS $key_risu=>$value_risu)
						@php
							$risu_img[$key_risu]=$value_risu;
						@endphp
					@endforeach
					
					@php
						$i++;
						
						if (stristr($risu_img['foto'],"admin")==true || stristr($risu_img['foto'],"resarea")) {
							$foto=substr($risu_img['foto'],1);
							$foto=str_replace("admin/img_up/regate/foto/","",$foto);
							$foto=str_replace("resarea/img_up/regate/foto/","",$foto);
							
							if(file_exists(public_path()."/resarea/img_up/regate/foto/s_$foto")) $s_foto="resarea/img_up/regate/foto/s_$foto";
							else $s_foto="resarea/img_up/regate/foto/$foto";
							$foto="resarea/img_up/regate/foto/$foto";												
						} else {
							$foto=substr($risu_img['foto'],1);
							$foto=str_replace("-150-100","-800-600",$foto);
							$foto=str_replace("-140-90","-800-600",$foto);
							$foto=substr($foto,0,-6).".jpg";
							
							$s_foto=substr($risu_img['foto'],1);
						}
						
						$galleryReg[$i] = $foto;
						
					@endphp
					
					<div class="gallery-item">
						<a href="{{ smartAsset($foto) }}" class="glightbox" data-gallery="gallery">
							<img
								src="{{ smartAsset($foto) }}"
								width="500"
								height="auto"
								alt=""
								loading="lazy"
							>
						</a>
					</div>
				@endforeach
					
			</div>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				document.querySelectorAll('.gallery-item img').forEach(img => {
					img.addEventListener('load', () => {
						img.classList.add('loaded');
					});
				});
			});
		</script>
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