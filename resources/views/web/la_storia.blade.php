@extends('web.index')

@section('content')
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
		
		@media screen and (max-width: 800px) {
			.page-title-container{
				flex-direction:column;
				gap:0px;
			}
			.link-arrow{
				margin-top:0px !important;
				height:0px !important;
			}
		}
		@media screen and (max-width: 600px) {
			.gradient-title{
				font-size:50px !important;
				line-height:1 !important;
			}
		}
	</style>
	<div id="pagContainer" >
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
			$query_foto = $query_foto->where('pagina','=','la-storia');
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
								<a href="https://www.yccs.it/<?=$img_l;?>" class="glightbox" data-gallery="gallery">
									<div class="media-slide <?php if($x==1){?>active<?php }?>">
										<picture>
											<source srcset="https://www.yccs.it/<?=$img_m;?>" media="(max-width: 600px)" />
											<source srcset="https://www.yccs.it/<?=$img_s;?>" media="(max-width: 440px)" />
											<source srcset="https://www.yccs.it/<?=$img_xs;?>" media="(max-width: 340px)" />
											<img src="https://www.yccs.it/<?=$img_l;?>"  alt="{!! $value_foto->testo !!} - {{ Lang::get('website.'.$pagina.' nome pagina') }} - {{ config('app.name') }}" class="slide-background-image" alt=""/>
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
							<p style="margin-top:0;">Lo Yacht Club Costa Smeralda &egrave; stato fondato il 12 maggio 1967 da S.A. l&#39;Aga Khan, Andr&egrave; Ardoin, Giuseppe Kerry Mentasti e Luigi Vietti, come associazione sportiva senza fini di lucro, intesa a riunire i Soci amanti del mare e degli sport nautici e a promuoverne l&#39;attivit&agrave;. Le regate organizzate dal Club e le vittorie collezionate dai Soci sotto il suo guidone hanno contribuito ad assicurare al Club un ruolo di primo piano nel mondo dello yachting internazionale. Oggi lo YCCS &egrave; legato da accordi di reciprocit&agrave; con lo Yacht Club di Monaco, il New York Yacht Club, Royal Yacht Squadron e Norddeutscher Regatta Verein. Lo YCCS &egrave; rappresentato dal Consiglio Direttivo presieduto dal presidente, Principessa Zahra Aga Khan. Oltre al Consiglio Direttivo hanno responsabilit&agrave; operativa il Commodoro, il Segretario Generale e il Direttore Sportivo.<br />
							<br />
							<strong>LE PRIME REGATE</strong><br />
							Affiliato alla Federazione Italiana Vela dal 1968 e alla Federazione Italiana Motonautica dal 1978, il Club parte con l&#39;ambizione di organizzare regate di richiamo internazionale e gi&agrave; nel 1972 si svolge la prima edizione della Settimana delle Bocche. Nel 1973 organizza la One Ton Cup e diventa di fatto il promotore della vela agonistica d&#39;altura in Italia e nel Mediterraneo. &Egrave; del 1978 la prima edizione della Sardinia Cup, importante passo dello Yacht Club Costa Smeralda nell&#39;organizzazione di eventi velici ripetitivi a livello mondiale. La Sardinia Cup si svolge negli anni pari, in alternanza con la famosa regata del Solent, l&#39;Admiral&#39;s Cup. Il 1980 &egrave; l&#39;anno di istituzione di due importanti campionati mondiali: il Maxi Yacht World Championship e la Swan World Cup. Nello stesso anno prende il via il Gran Premio Offshore Costa Smeralda. Il primo Veteran Boat Rally si tiene nel 1982.<br />
							<br />
							<strong>GLI ANNI DI AZZURRA</strong><br />
							Nel 1981 lo Yacht Club Costa Smeralda promuove la prima sfida italiana all&#39;America&#39;s Cup. Gi&agrave; due anni dopo il mitico 12 metri S.l. Azzurra conquista un brillante terzo posto nelle regate di selezione, a Newport. Azzurra diventa il simbolo della vela agonistica ai massimi livelli e suscita I&#39;interesse di tutti gli sportivi italiani. A seguito del successo di Azzurra viene istituito nel 1984 a Porto Cervo il primo Campionato del Mondo Classe 12 metri. Nello stesso anno lo YCCS viene prescelto dal Royal Perth Yacht Club quale Challenger of Record per I&#39;America&#39;s Cup del 1987. Come tale viene incaricato di preparare e coordinare tutte le attivit&agrave; inerenti gli sfidanti per la Coppa, nonch&eacute; I&#39;organizzazione delle regate di selezione per l&#39;America&#39;s Cup in Australia. Vi partecipa ancora un&#39;imbarcazione con i colori dello YCCS: Azzurra &#39;87.<br />
							<br />
							<strong>L&#39;IMPRESA DI DESTRIERO</strong><br />
							II 1992 segna un grande successo nel campo della velocit&agrave; a motore: Destriero compie in 58 ore, 54 minuti e 50 secondi la traversata dell&#39;Atlantico dall&#39;Ambrose Light, il faro di New York, al faro inglese di Bishop Rock nelle isole Scilly: 3.106 miglia percorse alla media di 53,09 nodi pari a 98,323 chilometri all&#39;ora. Questa spettacolare avventura ha visto assegnare a Destriero, oltre al Columbus Atlantic Trophy, istituito dal New York Yacht Club e dallo Yacht Club Costa Smeralda per premiare il record della doppia traversata atlantica, anche il Virgin Atlantic Challenge per l&#39;attraversata dell&#39;Oceano Atlantico pi&ugrave; veloce in assoluto.<br />
							<br />
							<strong>LE BARCHE YCCS</strong><br />
							Nel 1981 viene varata Smeralda Prima, un Two-Tonner che conquista un secondo posto nel campionato mondiale, con grande soddisfazione dei Soci. Dieci anni dopo German Frers &egrave; all&#39;opera su incarico dei Soci dello YCCS per studiare una barca monotipo che sia adatta a regate di flotta e alle sfide a match race. Nel 1992 vengono varati i primi scafi delle Smeralda 888, veloci, competitivi e in grado di regalare forti emozioni all&#39;equipaggio composto anche solo da tre persone</p>
						<?php }else{?>
							<p style="margin-top:0;">The Yacht Club Costa Smeralda was founded on 12th May 1967 by H.H. the Aga Khan, Andr&egrave; Ardoin, Giuseppe Kerry Mentasti and Luigi Vietti 
							as a non-profit making sporting association for fellow sailing enthusiasts and with a view to promoting related activities.&nbsp;The sporting 
							events organized by the Club and the victories won by Members flying the Club&#39;s burgee have helped to establish the YCCS&#39; position at the 
							forefront of international yachting. Today the YCCS enjoys reciprocal &nbsp;agreements with the Yacht Club di Monaco, the New York Yacht Club, Royal Yacht Squadron and Norddeutscher Regatta Verein. 
							The YCCS is represented by the Board of Directors headed by its President, Princess Zahra Aga Khan. 
							The Commodore, Secretary General and Sports Director also manage the Club&#39;s social and sporting activities.
							<br /><br /><br /><br />
							<strong>THE FIRST REGATTAS</strong><br />
							The Club has been affiliated with the Italian Sailing Federation since 1968 and with the Italian 
							Powerboat Federation since 1978. From its inception, the Club has aimed to organize international regattas and as early as 1972 the first e
							dition of the Settimana delle Bocche was held. In 1973 the Club organized the One Ton Cup and became recognized as the primary promoter of 
							competitive offshore sailing in Italy and in the Mediterranean. The first Sardinia Cup, held in 1978, marked an important step for the Yacht 
							Club Costa Smeralda in organizing annual and biennial world-class sailing events. The Sardinia Cup is held in alternate years to the famous 
							Admiral&#39;s Cup race in the Solent. 1980 saw the creation of two important world championships: the Maxi Yacht World Championship and the
							Swan World Cup. That same year saw the first ever Costa Smeralda Offshore Grand Prix while the inaugural Veteran Boat Rally was held in 1982.
							<br />
							<br />
							<strong>THE AZZURRA YEARS</strong><br />
							In 1981 the Yacht Club Costa Smeralda launched the first Italian challenge for the America&#39;s Cup. Just two years later the 12-Metre Azzurra 
							came a triumphant third in the qualifying regattas for the finals in Newport. Azzurra became a symbol for Italy&#39;s potential in top-level 
							competitive sailing and was followed closely by fans at home. Thanks to her success, the first 12 Metre Class World Championship was held in 
							Porto Cervo in 1984. That same year, the Royal Perth Yacht Club chose the YCCS to act as Challenger of Record for the 1987 edition of the America&#39;s 
							Cup. As such, the YCCS was responsible for coordinating preparations for the challengers for the Cup, as well as organizing the qualifying regattas held 
							in Australia. A vessel flying YCCS colours also participated in this edition: Azzurra &#39;87.
							<br /><br />
							<strong>DESTRIERO</strong><br />1
							992 was also the year of a great achievement in the field of powerboat construction: Destriero crossed the Atlantic in 58 hours 54&#39; 50&quot;, 
							covering the 3,106 miles between the Ambrose Light off New York and the Bishop Rock lighthouse on the Scilly Isles at an average speed of 98.323 km/h. This spectacular adventure won Destriero not only the Columbus Atlantic Trophy, the prize instituted by the New York Yacht Club and the Yacht Club Costa Smeralda for the fastest return Atlantic crossing, but also the Virgin Atlantic Challenge for the fastest crossing.<br /><br /><strong>YCCS BOATS</strong><br />1981 saw the launch of the Smeralda Prima, a Two-Tonner which achieved second place in the World Championships, to the delight of Members. Ten years later, YCCS Members commissioned German Frers to create a one-design sailing boat which could take part in fleet yacht races and match races. The first examples of the Smeralda 888 were launched in 1992 and quickly proved fast, competitive and rewarding to handle even with only three crew members.</p>
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