@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/loYCCSoggi.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		
		$title ="YCCS e Sostenibilità";
		if($lingua=="eng") $page_title ="YCCS and Sustainability";
		
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.YCCS e Sostenibilita'); $breadcrumbs[$x]['link']=''; 
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
						$query_foto = $query_foto->where('pagina','=','charta_smeralda');
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
											  <img src="https://www.yccs.it/<?php echo $img_l;?>"  alt="{!! $value_foto->testo !!} - {{ Lang::get('website.'.$pagina.' nome pagina') }} - {{ config('app.name') }}"/>
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
						
						ul{margin-left:30px}
					</style>
					<?php if($lingua=="ita"){?>
					
						<div class="rwd-video" style="margin-bottom:40px;">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/S-XTVNFiAho?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
						
						<p>A conclusione del Forum One Ocean, svoltosi a
						Milano nell’ottobre del 2017, è stata
						presentata la Charta Smeralda di cui lo Yacht
						Club Costa Smeralda è stato il primo
						firmatario.<br/><br/>
						La Charta Smeralda rappresenta un codice etico che guida individui e organizzazioni verso
						comportamenti rispettosi dell’ambiente. Lo
						YCCS promuove il decalogo dei principi verso i
						Soci del Club, i suoi Partner e tutti i
						partecipanti alle attività sportive.<br/><br/>
						Ognuno può contribuire alla preservazione
						dell’ambiente marino firmando la Charta
						Smeralda e impegnandosi a seguire le linee
						guida riportate al suo interno.<br/><br/>
						Per firmare <a href="https://www.1ocean.org/charta-smeralda/" target="_blank"><u>cliccare qui.</u></a><br/><br/>

						Troverete di seguito il decalogo che sintetizza
						le azioni riportate nella Charta Smeralda.</p>
						
						<div class="grid-item">
							<div class="grid-item-wrap">
								<div class="grid-image"> 
									<img alt="Charta Smeralda" src="web/images/CHARTA-SMERALDA_ITA.jpg" />
								</div>
								<div class="grid-description">
									<a title="Charta Smeralda" data-lightbox="image" href="web/images/CHARTA-SMERALDA_ITA.jpg" class="btn btn-light btn-rounded">Zoom</a>
								</div>
							</div>
						</div>
					<?php }else{?>					
						<div class="rwd-video" style="margin-bottom:40px;">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/PhcULL3XRro?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
					
						<p>
						At the conclusion of the One Ocean Forum that took place in Milan in October 2017, the Charta Smeralda was presented and the Yacht Club Costa Smeralda was its first signatory.
						<br/><br/>
						The Charta Smeralda represents an ethical code intended to guide individuals and organisations to adopt environmentally friendly behaviour. YCCS promotes this code of conduct to its Club members, its partners and all participants in its sporting activities.
						<br/><br/>
						Everyone can contribute to preserving the marine environment by signing the Charta Smeralda and pledging to follow the guidelines it contains.
						<br/><br/>
						To sign up <a href="https://www.1ocean.org/charta-smeralda/" target="_blank"><u>click here</u></a>.
						<br/><br/>
						Below is a guide summarising the actions listed in the Charta Smeralda.
						</p>
						
						<div class="grid-item">
							<div class="grid-item-wrap">
								<div class="grid-image"> 
									<img alt="Charta Smeralda" src="web/images/CHARTA-SMERALDA_ENG.jpg" />
								</div>
								<div class="grid-description">
									<a title="Charta Smeralda" data-lightbox="image" href="web/images/CHARTA-SMERALDA_ENG.jpg" class="btn btn-light btn-rounded">Zoom</a>
								</div>
							</div>
						</div>				
					<?php }?>
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