@extends('web.index')

@section('content')
	@include('web.assets.regate_css')
	<div style="width:width:100%; height:520px; position:relative;">
		<div class="media-slider-container">
		  <div class="media-slider-wrapper">
			<div class="media-slide active">
			  <!-- video slide -->
			  <video autoplay muted loop playsinline class="slide-background-video">
				<source src="../web/video/video_test.mp4" type="video/mp4">
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
	<div style="width:calc(100% - 260px); margin-left:130px;">
		<div style="width:100%; display:flex; gap:35px;margin-top:65px;">
			<h3 class="gradient-title">Video</h3>			
			<div style="flex:1;">
				<div class="link-arrow2" style="margin-top:30px; padding-left:calc(100% - 200px); padding-bottom:5px; justify-content:flex-end;">
					<div>
						<a href="{{ $link_regata }}" class="link-arrow3" style="cursor:pointer; width:180px; margin-top:13px;border:none">
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
				opacity: 0;
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
					$ids = [];
					$ids[] = 100;
					$ids[] = 101;
					$ids[] = 102;
					$ids[] = 103;
					$ids[] = 104;
					$ids[] = 99;
					$ids[] = 106;
					$ids[] = 107;
					$ids[] = 108;
					$ids[] = 109;
					$ids[] = 110;
					$ids[] = 111;
					$ids[] = 112;
					$ids[] = 113;
					$ids[] = 114;
					$ids[] = 115;
					$ids[] = 116;
				@endphp
				@foreach ($ids as $i => $id)
					@php $height = rand(400, 900); @endphp
					<div class="gallery-item">
						<a href="https://www.youtube.com/watch?v=7jBvbAvIEYQ" data-type="video" data-width="900" data-height="506" class="glightbox" data-gallery="gallery">
							<img
								src="https://picsum.photos/id/{{ $id }}/600/{{ $height }}"
								width="600"
								height="{{ $height }}"
								alt="Regata {{ $i + 1 }}"
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
	</div>
@endsection