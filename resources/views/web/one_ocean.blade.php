@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/loYCCSoggi.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.YCCS e Sostenibilita');; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					@php
						$query_foto = DB::table('fotogallery_pagine');
						$query_foto = $query_foto->select('*');
						$query_foto = $query_foto->where('pagina','=','one-ocean');
						$query_foto = $query_foto->get();	
						$num_foto = $query_foto->count();	
					@endphp
					@if($num_foto>0)
						<!-- CAROUSEL -->
						<section class="no-padding">
							<div class="grid-articles carousel arrows-visibile" data-items="1" data-margin="0" data-dots="false" <?php if($num_foto==1){?>data-arrows="false"<?php }?>>
								@foreach($query_foto AS $key_foto=>$value_foto)
									@php
										$dir_up = "resarea/img_up";
										
										$img="$dir_up/pagine/".$value_foto->foto;
										if(is_file("$dir_up/pagine/xs_".$value_foto->foto)) $img_xs="$dir_up/pagine/xs_".$value_foto->foto; else $img_xs=$img;
										if(is_file("$dir_up/pagine/s_".$value_foto->foto)) $img_s="$dir_up/pagine/s_".$value_foto->foto; else $img_s=$img;
										if(is_file("$dir_up/pagine/m_".$value_foto->foto)) $img_m="$dir_up/pagine/m_".$value_foto->foto; else $img_m=$img;
										if(is_file("$dir_up/pagine/l_".$value_foto->foto)) $img_l="$dir_up/pagine/l_".$value_foto->foto; else $img_l=$img;
									@endphp
									<article class="post-entry">
										<a href="#" class="post-image">
											<picture>
											  <source srcset="<?php echo $img_m;?>" media="(max-width: 600px)" />
											  <source srcset="<?php echo $img_s;?>" media="(max-width: 440px)" />
											  <source srcset="<?php echo $img_xs;?>" media="(max-width: 340px)" />
											  <img src="<?php echo $img_l;?>"  alt="{!! $value_foto->testo !!} - {{ Lang::get('website.'.$pagina.' nome pagina') }} - {{ config('app.name') }}"/>
											</picture>
										</a>
										@if($value_foto->testo && $value_foto->testo!="")
											<div class="post-entry-overlay">
												<div class="post-entry-meta">
													<div class="post-entry-meta-title">
														<h2>{!! $value_foto->testo !!}</h2>
													</div>
												</div>
											</div>
										@endif
									</article>		
								@endforeach
							</div>
						</section>
						<!-- end: CAROUSEL -->
					@endif
					
					<style>
						.rwd-video {
							height: 0;
							overflow: hidden;
							padding-bottom: 56.25%;
							padding-top: 30px;
							position: relative;
						}
						.rwd-video iframe,
						.rwd-video object,
						.rwd-video embed {
							height: 100%;
							left: 0;
							position: absolute;
							top: 0;
							width: 100%;
						}
					</style>
					<div class="rwd-video">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/zckfbWogNLE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
					
					<style>
						ul{margin-left:30px}
					</style>
					<div style="margin-top:30px;">
						<?php if($lingua=="ita"){?>
							<p>
								Nel 2017, anno del suo cinquantesimo anniversario, lo Yacht Club Costa Smeralda ha lanciato un progetto di sostenibilità ambientale focalizzato sulla preservazione dell’ambiente marino: One Ocean.
								<br/><br/>
								La volontà dello YCCS di aggiungere la propria voce ad uno dei temi di maggior urgenza dei nostri tempi è nata dalla consapevolezza che, come Yacht Club, il mare costituisce l’elemento primario su cui si basano tutte le attività principali. Nel 2017 l’iniziativa ha avuto come momento culminante il Forum One Ocean, primo Forum organizzato in Italia sul tema della salvaguardia del mare realizzato in partnership con la Commissione Oceanografica Intergovernativa dell'UNESCO e SDA Bocconi Sustainability LAB.
								<br/><br/>
								Il 3-4 ottobre al Forum a Milano hanno partecipato 800 persone per circa 12 ore di lavori in cui si sono alternati studiosi, eye witness, aziende dal profilo internazionale con propri contributi. A seguito del successo del Forum, nel 2018 è nata la <a href="https://www.1ocean.org/" target="_blank" title="Fondazione One Ocean">Fondazione One Ocean</a>
							</p>
							
						<?php }else{?>
							<p>
								In 2017, the year of its 50th anniversary, the Yacht Club Costa Smeralda launched the One Ocean environmental sustainability project.
								<br/><br/>
								The YCCS' desire to add its voice to one of the most urgent issues of our time came from the knowledge that as a Yacht Club, the sea is the primary element underpinning all of its main activities. In 2017 the initiative culminated in the One Ocean Forum, the first forum organised in Italy on the subject of marine protection, realised in partnership with UNESCO's Intergovernmental Oceanographic Commission and the SDA Bocconi Sustainability Lab.
								<br/><br/>
								On 3-4 October at the Forum in Milan 800 people participated in 12 hours of work featuring contributions from researchers, eye witnesses and international companies. Following the success of the forum, in 2018 was established the <a href="https://www.1ocean.org/" target="_blank" title="Fondazione One Ocean">One Ocean Foundation</a>.
							</p>
							
						<?php }?>
					</div>
				</div>
				<div class="content col-lg-1"></div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-12">
							@include('web.common.laterale')
						</div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection