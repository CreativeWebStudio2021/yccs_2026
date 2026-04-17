@extends('web.index')

@php
	$lingua="ita";
@endphp

<style>
	#panelNews{
		opacity:0;
		transition:all 1s;
	}
	#panelNewsContainer{
		flex:2%;
		transition:all 1s;
	}
	#imgNews{
		flex:43%; 
		transition:all 1s;
	}
	#txtNews{
		flex:50%; 
		transition:all 1s;
	}
	.title-news-big{
		font-family: Arial;
		font-size: 160px; 
		font-weight: 900; 
		color: #ffffff; /* fallback */
		-webkit-text-stroke: 1px #D9D9D9;
		-webkit-text-fill-color: transparent;
		line-height:1;
	}
	.title-news-big-mob{
		display:none;
	}
	.title-news-big-desk{
		display:block;
	}
	.news-container{
		margin-top:60px;
		display:flex;
		gap:20px;
		position:relative;
		width:100%;
	}
	.title-news{
		margin-top:0px;
		font-size:30px; 
		padding:5px 0 20px; 
		line-height:30px;
	}
	.link-arrow2.link-arrow2-news{
		width:100%; 
		padding-bottom:15px; 
		justify-content:space-between;		
	}
	@media screen and (max-width: 800px) {
		.news-container{
			flex-direction:column;
			margin-top:0px;
		}
		.title-news-big-mob{
			display:block;
		}
		.title-news-big-desk{
			display:none;
		}
		.title-news{
			padding:5px 20px 20px;
		}
		.link-arrow2.link-arrow2-news{
			width:calc(100% - 40px);
			margin-left:20px;
		}
	}
</style>

@section('content')
	@include('web.assets.regate_css')
		<div style="width:width:100%; height:300px; position:relative;">
			<div class="media-slider-container" style="height:300px;">
			  <div class="media-slider-wrapper">
				<div class="media-slide active">
				  <!-- video slide -->
				  <video autoplay muted loop playsinline class="slide-background-video">
					<source src="web/video/Regate-generiche-1920x500.mp4" type="video/mp4">
				  </video>
				  <div class="slide-content-overlay" style="bottom:40px;">
					<h1 style="color:#fff">{{ $value_ed->nome_regata }}</h1>
					<a class="slide-info-link">
					  <div>
						<h3 style="color:#fff">{{ $value_ed->luogo }}</h3>
						<div class="slide-date" style="color:#fff">dal {{ convertDateFormat($value_ed->data_dal,"Y-m-d","d-m") }} al {{ convertDateFormat($value_ed->data_al,"Y-m-d","d-m") }} {{ $value_ed->anno }}</div> 
					  </div>
					  <img src="web/images/freccia_bianca.png" class="slide-info-arrow" alt="">
					</a>
				  </div>
				</div>
			  </div>
			</div>		
		</div>
		
		<div class="news-container">
			<div class="title-news-big title-news-big-mob">
				NEWS
			</div>
			<div style="height:100vh; position:relative;" class="colLeft" id="imgNews">
				<a href="https://www.yccs.it/resarea/img_up/regate/press/{{ $foto }}" class="glightbox" data-gallery="gallery">
					<img src="https://www.yccs.it/resarea/img_up/regate/press/{{ $foto }}" style="width:100%; height:100%; object-fit:cover; object-position:center top"/>
				</a>
			</div>
			<div style="height:100vh; overflow-y:scroll; position:relative; " class="noscrollbar colRight" id="txtNews">
				<div style=" display:flex; flex-direction:column; position:relative;">
					<div class="title-news-big title-news-big-desk">
						NEWS
					</div>
					
					<h3 class="gradient-title title-news">{{ $titolo }}</h3>
					<div >
						<div class="link-arrow2 link-arrow2-news">
							<div>
								<a onclick="window.history.back()" class="link-arrow3" style="cursor:pointer; width:180px; margin-top:13px;border:none">
									<img src="web/images/arrow.png" alt="freccia" class="arrow-img-reflect"/>
									<span>
										<?php if($lingua=="ita"){?>
											Torna alla Regata
										<?php }else{?>
											Back to the Regatta
										<?php }?>
									</span>
								</a>
							</div>
							<?php /*<div style="transition:all 1s;" id="goToNews">
								<a onclick="panelNews();" class="link-arrow3" style="cursor:pointer; width:145px; margin-top:13px;border:none">
									<span id="goToNewsTxt">
										<?php if($lingua=="ita"){?>
											Vedi News
										<?php }else{?>
											See all News
										<?php }?>
									</span>
									<img src="web/images/arrow.png" alt="freccia" class="arrow-img"/>
								</a>
							</div>*/?>
						</div>
						<div style="padding:20px 30px 110px 20px;">
							{!! $testo !!}
						</div>
						
					</div>
					
					
				</div>
			</div>
			<div style="position:relative; height:100vh; overflow-y:scroll" id="panelNewsContainer" class="noscrollbar">
				<div id="panelNews" style="position:absolute; top:0; left:0; width:300px; padding-bottom:110px; height:100vh; overflow-y:scroll; background:white; display:flex; flex-direction:column; gap:30px; transition:all 1s; box-shadow: 4px 4px 25px 0px rgba(0, 0, 0, 0.1);" class="noscrollbar">
					@php
						$query_press = DB::table('press');
						$query_press = $query_press->select('*');
						$query_press = $query_press->where('id_edizione','=',$id_dett); 
						$query_press = $query_press->where(function($query_press)  {
							$query_press = $query_press->where('foto1', '<>', 'NULL');
							$query_press = $query_press->orWhere('foto2', '<>', 'NULL');
						});
						$query_press = $query_press->orderby('data','DESC');
						//dd($query_press->toSql(), $query_press->getBindings());
						$query_press = $query_press->get();
						$num_press = $query_press->count();
						$i=1;
					@endphp
					@foreach($query_press AS $key_press=>$value_press)	
						@php
							if(!empty($value_press->foto1)) $foto = $value_press->foto1;
							else $foto = $value_press->foto2;
							
							$link = "regate-".$anno_regata."/press/".$nome_regata."-".$id_dett."/".creaSlug($value_press->titolo,"")."-".$value_press->id.".html";
						@endphp
						
						<div style="padding:20px;">
							<a href="{{ $link }}" title = "{{ $value_press->titolo }}">
								<img style="width:100%;" src="https://www.yccs.it/resarea/img_up/regate/press/{{ $foto }}" class="news-hero-image">
							</a>
							
							
							<div class="news-hero-date" style="position:relative !important; color:#000; border-color:#000; margin-top:10px;">
								{{ convertDateFormat($value_press->data,"Y-m-d", "d/m/Y") }}
							</div>
							<div class="news-hero-title" style="color:#000; font-size:16px;">
								{{ \Illuminate\Support\Str::limit($value_press->titolo, 60) }}
							</div>	
							<a href="{{ $link }}" class="link-arrow" title = "{{ $value_press->titolo }}" style="width:136px; margin-top:8px; margin-right:20px;">
								<span>Scopri di più</span>
								<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
							</a>
						</div>
						
					@endforeach
				</div>				
			</div>
						
				
			<div id="gradient1" style="position:absolute; width:calc(100% - 43% - 20px); transition:all 1s; height:80px; background: linear-gradient(to top, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%); bottom:30px; right:0;"></div>
			<div id="gradient2" style="position:absolute; width:calc(100% - 43% - 20px); transition:all 1s; height:30px; background: white; bottom:0; right:0;"></div>
			<script>
				let panelOpen = 0;
				function panelNews(){
					if(panelOpen == 0) panelOpen = 1; else panelOpen = 0;
					
					const panelNews = document.getElementById('panelNews');
					const panelNewsContainer = document.getElementById('panelNewsContainer');
					const imgNews = document.getElementById('imgNews');
					const txtNews = document.getElementById('txtNews');
					const gradient1 = document.getElementById('gradient1');
					const gradient2 = document.getElementById('gradient2');
					const goToNews = document.getElementById('goToNews');
					const goToNewsTxt = document.getElementById('goToNewsTxt');
					
					if(panelOpen==1){
						imgNews.style.flex = "37%";
						txtNews.style.flex = "44%";
						panelNewsContainer.style.flex = "14%";						
						gradient1.style.width = "calc(100% - 37% - 20px)";						
						gradient2.style.width = "calc(100% - 37% - 20px)";						
						panelNews.style.opacity = "1";
						goToNewsTxt.innerHTML = "Chiudi";
					}else{
						imgNews.style.flex = "43%";
						txtNews.style.flex = "50%";
						panelNewsContainer.style.flex = "2%";		
						gradient1.style.width = "calc(100% - 43% - 20px)";						
						gradient2.style.width = "calc(100% - 43% - 20px)";						
						panelNews.style.opacity = "0";
						goToNewsTxt.innerHTML = "Vedi News";
					}
					/*var rightPos = panelNews.style.right;
					if(rightPos=="-300px"){
						panelNews.style.right="0px";
						goToNews.style.paddingRight="300px";
						goToNewsTxt.innerHTML = "Chiudi News";
					}else{
						panelNews.style.right="-300px";
						goToNews.style.paddingRight="0px";
						goToNewsTxt.innerHTML = "Vai alle News";
					}*/
				}
			</script>
			<?php /*<div style="flex:5%;height:100vh; overflow-y:scroll; position:relative;" id="listaNews" class="noscrollbar">
				<div style="position:absolute; width:300px; top:0; left:-200px; background:red; display:flex; flex-direction:column; gap:30px;">
					@php
						$query_press = DB::table('press');
						$query_press = $query_press->select('*');
						$query_press = $query_press->where('id_edizione','=',$id_dett);
						$query_press = $query_press->where(function($query_press)  {
							$query_press = $query_press->where('foto1', '<>', 'NULL');
							$query_press = $query_press->orWhere('foto2', '<>', 'NULL');
						});
						$query_press = $query_press->orderby('data','DESC');
						//dd($query_press->toSql(), $query_press->getBindings());
						$query_press = $query_press->get();
						$num_press = $query_press->count();
						$i=1;
					@endphp
					@foreach($query_press AS $key_press=>$value_press)	
						@php
							if(!empty($value_press->foto1)) $foto = $value_press->foto1;
							else $foto = $value_press->foto2;
							
							$link = "regate-".$anno_regata."/press/".$nome_regata."-".$id_dett."/".creaSlug($value_press->titolo,"")."-".$value_press->id.".html";
						@endphp
						
						<div style="padding:20px; padding-top:0;">
							<a href="{{ $link }}" title = "{{ $value_press->titolo }}">
								<img style="width:100%;" src="https://www.yccs.it/resarea/img_up/regate/press/{{ $foto }}" class="news-hero-image">
							</a>
							
							
							<div class="news-hero-date" style="position:relative !important; color:#000; border-color:#000; margin-top:10px;">
								{{ convertDateFormat($value_press->data,"Y-m-d", "d/m/Y") }}
							</div>
							<div class="news-hero-title" style="color:#000; font-size:16px;">
								{{ \Illuminate\Support\Str::limit($value_press->titolo, 60) }}
							</div>	
							<a href="{{ $link }}" class="link-arrow" title = "{{ $value_press->titolo }}" style="width:136px; margin-top:8px; margin-right:20px;">
								<span>Scopri di più</span>
								<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
							</a>
						</div>
						
					@endforeach
				</div>
			</div>*/?>
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