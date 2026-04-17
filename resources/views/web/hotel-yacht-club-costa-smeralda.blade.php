@extends('web.index')

@section('content')
	<style>
		.slide-content-overlay-title{
			bottom:80px !important;
		}
		.slide-content-overlay-title h1{
			line-height:1;
		}
	</style>
	@php		
		$video_background = "web/video/Club_e_varie_regate-1920x500.mp4";
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
				<div class="link-arrow" style="width:163px; gap:47px !important; margin-top:30px; padding-left:calc(100% - 163px); padding-bottom:7px; border-bottom:solid 2px;">
				 
				</div>
			</div>
		</div>

		
		@php
			$query_foto = DB::table('fotogallery_pagine');
			$query_foto = $query_foto->select('*');
			$query_foto = $query_foto->where('pagina','=','la-clubhouse');
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
					<div style="padding:50px 0 25px; "  class="multi-column">
						<?php if($lingua=="ita"){?>
							<p style="margin-top:0;">
							La prima sede dello YCCS fu alla Maison Du Port, primo edificio di Porto Cervo, situato presso quello che oggi viene chiamato il "molo vecchio". Nel 1977 lo YCCS si sposta nella nuova sede 
							prospiciente la Marina Nuova, con una struttura moderna e funzionale, adatta ad ospitare i numerosi Soci e le sempre più numerose manifestazioni organizzate dal Club.
							<br/><br/>
							Nei primi anni del 2000 (dal 2001 al 2003) l’area che attualmente ospita lo YCCS è stata oggetto di un ampliamento e di un completo restyling. Incaricato del progetto è lo studio 
							dell'architetto newyorkese Peter Marino. Dalla sua matita nasce quella che oggi è considerata una delle più prestigiose, moderne e funzionali strutture nel suo genere. 
							Nei suoi 6,000 metri quadri trovano posto una terrazza panoramica con piscina, ristoranti interni ed esterni, un bar, un loungee un centro benessere. L’hotel Yacht Club Costa Smeralda 
							ospita inoltre 24 suites, compresa una Suite Presidenziale inaugurata nel 2016.
							</p>
							<p style="font-size:0.9em; font-style:italic; line-height:1.2;">							
								I servizi vengono forniti da Società controllata da Yacht Club Costa Smeralda, proprietaria di parte dell'edificio YCCS e gestore delle attività alberghiere.							
							</p>
						<?php }else{?>
							<p style="margin-top:0;">
							The Yacht Club Costa Smeralda's first base was the Maison Du Port, the first building erected in Porto Cervo on what is nowadays called the "Old Port". In 1977 the Club moved to new premises overlooking the New Marina: a modern and functional structure ideal for hosting numerous Members and the ever-growing regatta calendar.
							<br/><br/>
							At the start of the new millennium (from 2001 to 2003) the area that now hosts the YCCS was completely renovated in a project supervised by New York architect Peter Marino and is now considered one of the most beautifully functional structures of its kind in existence. The structure covers more than 6,000 square metres and includes a panoramic pool terrace, internal and external dining, Members' lounge, bar and Wellness Center.
							The Yacht Club Costa Smeralda hotel also features 24 suites, including a Presidential Suite inaugurated in 2016.
							</p>
							<p style="font-size:0.9em; font-style:italic; line-height:1.2;">							
								Services are provided by a subsidiary of Yacht Club Costa Smeralda, which owns part of the YCCS building and manages the hotel operations.							
							</p>
						<?php }?>
					</div>
					<hr>
					<div style="padding:25px 0 25px; ">
						<?php if($lingua=="ita"){?>
							<p style="margin-top:0;">
							<span class="azzurro">ORARI RISTORANTE</span>
							</p>
							<div style="display:flex; gap:20px; flex-wrap:wrap;">
								<div style="padding-right:100px">
										MAGGIO E OTTOBRE<br />
									<p>
										Dal luned&igrave; al gioved&igrave;:<br/>								
										colazione dalle 12.30 alle 14.30<br/>
										cena dalle 19.30 alle 22.00
										<br/><br/>
										Weekend:<br/>	
										colazione dalle 12.30 alle 15.00<br/>
										cena dalle 19.30 alle 22.30
									</p>
								</div>
								<div style="">
									GIUGNO - SETTEMBRE<br />
									<p>
									Tutti i giorni:<br/>		
									colazione dalle 12.30 alle 15.00<br />
									cena dalle 19.30 alle 22.30
									</p>
								</div>
							</div>
						<?php }else{?>
							<p style="margin-top:0;">
							<span class="azzurro">RESTAURANT OPENING TIMES</span>
							</p>
							<div style="display:flex; gap:20px; flex-wrap:wrap;">
								<div style="padding-right:100px">
										MAY and OCTOBER<br />
									<p>
										Monday to Thursday:<br/>								
										lunch 12.30 to 2.30 p.m.<br />
										dinner 7.30 to 10 p.m.
										<br/><br/>
										Weekends:<br/>	
										lunch 12.30 to 3 p.m.<br />
										dinner 7.30 to 10.30 p.m.
									</p>
								</div>
								<div style="">
									JUNE to SEPTEMBER<br />
									<p>		
									lunch 12.30 to 3 p.m.<br />
									dinner 7.30 p.m. to 10.30 p.m.
									</p>
								</div>
							</div>
						<?php }?>
					</div>
					<hr>
					<div style="padding:25px 0 25px; ">
						<?php if($lingua=="ita"){?>
							<p style="margin-top:0;">
							<span class="azzurro">ORARI BAR</span>
							</p>
							
							<div style="display:flex; gap:20px; flex-wrap:wrap;">
								<div style="padding-right:100px">
										MAGGIO E OTTOBRE<br />
									<p>
										Dal luned&igrave; al gioved&igrave;:<br/>								
										dalle 9.00 fino alle 22.30
										<br/><br/>
										Dal venerdì alla domenica:<br/>	
										dalle 9.00 fino alle 23.00
									</p>
								</div>
								<div style="">
									GIUGNO - SETTEMBRE<br />
									<p>
									Tutti i giorni dalle 9.00 in poi<br />
									dalle 12.30 alle 18.30 light lunch con snack menu
									</p>
								</div>
							</div>
						<?php }else{?>
							<p style="margin-top:0;">
							<span class="azzurro">BAR OPENING TIMES</span>
							</p>
							
							<div style="display:flex; gap:150px;">
								<div style="">
										MAY and OCTOBER<br />
									<p>
										Monday to Thursday:<br/>								
										9.00 a.m. to 10.30 p.m.
										<br/><br/>
										Weekends:<br/>	
										9.00 a.m. to 11 p.m.
									</p>
								</div>
								<div style="">
									JUNE to SEPTEMBER<br />
									<p>
									9 a.m. to midnight<br />
									Light lunch/Snack Menu from 12.30 p.m. to 6.30 p.m.
									</p>
								</div>
							</div>
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