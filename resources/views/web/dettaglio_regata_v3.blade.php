@extends('web.index')

@section('content')
	@include('web.assets.regate_css')
	
	<div style="width:width:100%; height:520px; position:relative;">
		<div class="media-slider-container">
		  <div class="media-slider-wrapper">
			<div class="media-slide active">
			  <?php /*<!-- video slide -->
			  <video autoplay muted loop playsinline class="slide-background-video">
				<source src="{{ smartAsset('web/video/video_test.mp4') }}" type="video/mp4">
			  </video>*/?>
			  
			  <img class="slide-background-image-title" src="{{ smartAsset('resarea/img_up/regate/'.$value_ed->img_testata_v3) }}" alt="{!! $value_ed->nome_regata !!} - {{ config('app.name'); }}"/>
			  <div style="position:absolute; width:100%; height:100%; top:0; left:0; background:rgba(0,0,0,0.2)"></div>
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
				  <img src="{{ smartAsset('web/images/freccia_bianca.png') }}" class="slide-info-arrow" alt="">
				</a>
			  </div>
			</div>
		  </div>
		</div>		
	</div>
	
	@include('web.regate.loghi_sponsor')
	
	<div class="page-container" style="margin-top:0;">
		@php
			$query_noticeboard = DB::table('edizioni_noticeboard');
			$query_noticeboard = $query_noticeboard->select('*');
			$query_noticeboard = $query_noticeboard->where('id_edizione','=',$id_dett);
			$query_noticeboard = $query_noticeboard->orderby('ordine','DESC');
			$query_noticeboard = $query_noticeboard->get();
			$num_noticeboard = $query_noticeboard->count();
		@endphp
		
		@if($num_noticeboard==0)
			<div class="row-doc" style="cursor: default;">
				<h4 class="greyHalfDark"><?php if($lingua=="ita"){?>Albo dei Comunicati<?php }else{?>Official Notice Board<?php }?></h4>
			</div>
		@else
			<div class="row-doc list-title">
				<h4 class="gradient-title"><?php if($lingua=="ita"){?>Albo dei Comunicati<?php }else{?>Official Notice Board<?php }?></h4>
				<img src="{{ smartAsset('web/images/freccia_thin_up.png') }}" class="row-doc-arrow list-arrow">
			</div>
		@endif
		
		@if($num_noticeboard>0)
			@php
				$chunks = $query_noticeboard->chunk(ceil($query_noticeboard->count() / 2));
			@endphp
			<div style="display:flex; gap:20px;" class="list-container">
				@foreach($chunks as $chunk)
					<div style="flex:1;">
						<div style="display:flex; gap:5px; flex-direction:column; padding-top:20px; padding-bottom:20px;">
							@foreach($chunk as $value_noticeboard)
								@php
									$link = $lingua=="ita" && $value_noticeboard->link ? $value_noticeboard->link : $value_noticeboard->link_eng;
									$pdf  = $lingua=="ita" && $value_noticeboard->file ? $value_noticeboard->file : $value_noticeboard->file_eng;
									$titolo = $lingua=="ita" && $value_noticeboard->testo_link ? $value_noticeboard->testo_link : $value_noticeboard->testo_link_eng;
								@endphp

								<div class="list-link">
									<img src="{{ smartAsset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
									
									@if ($value_noticeboard->tipo_link=="link" && $link!="")
										<a href="{{ str_starts_with($link,'http') ? $link : config('app.url').'/'.$link }}" target="_blank">
											<span style="font-size:12px;">{{ $titolo }}</span>
										</a>
									@elseif ($value_noticeboard->tipo_link=="allegato" && $pdf))
										<a href="{{ smartAsset("resarea/files/regate/noticeboard/$pdf") }}" target="_blank">
											<span style="font-size:12px;">{{ $titolo }}</span>
										</a>
									@else
										<span style="font-size:12px;">{{ $titolo }}</span>
									@endif
								</div>
							@endforeach
						</div>
					</div>
				@endforeach
			</div>
		@endif
		
		@php
			$items = collect();
			$modulo_iscrizioni = $value_ed->modulo_iscrizioni;
		
			// 🔹 Aggiungi modulo iscrizioni per primo
			if ($modulo_iscrizioni==1 && $visibilita==1) {
				$mod = DB::table('edizioni_modulo_iscrizioni')
					->select('testo_modulo_ita','testo_modulo_eng')
					->where('id_edizione','=',$id_dett)
					->first();

				if ($mod) {
					$titolo = $lingua=="ita"
						? $mod->testo_modulo_ita.' Online'
						: 'Online '.$mod->testo_modulo_eng;

					$link = ($lingua=="eng" ? 'en/' : '') .
						"regate-$anno_regata/modulo_iscrizione/" .
						creaSlug($nome_regata,"") .
						"-$id_dett.html";

					$items->push([
						'tipo'   => 'modulo',
						'titolo' => $titolo,
						'href'   => $link,
					]);
				}
			}

			// 🔹 Aggiungi documenti
			$query_documenti = DB::table('edizioni_doc');
			$query_documenti = $query_documenti->select('*');
			$query_documenti = $query_documenti->where('id_edizione','=',$id_dett);
			$query_documenti = $query_documenti->orderby('ordine','DESC');
			$query_documenti = $query_documenti->get();
			$num_documenti = $query_documenti->count();
		@endphp
		
		@if($num_documenti>0 || ($modulo_iscrizioni==1 && $visibilita==1))
			<div class="row-doc list-title">
				<h4 class="gradient-title"><?php if($lingua=="ita"){?>Documenti Ufficiali<?php }else{?>Documents<?php }?></h4>
				<img src="{{ smartAsset('web/images/freccia_thin_up.png') }}" class="row-doc-arrow list-arrow">
			</div>
		@else
			<div class="row-doc" style="cursor: default;">
				<h4 class="greyHalfDark"><?php if($lingua=="ita"){?>Documenti Ufficiali<?php }else{?>Documents<?php }?></h4>
			</div>
		@endif
		
		@php	
			foreach ($query_documenti as $doc) {
				$link   = $lingua=="ita" && $doc->link ? $doc->link : $doc->link_eng;
				$pdf    = $lingua=="ita" && $doc->file ? $doc->file : $doc->file_eng;
				$titolo = $lingua=="ita" && $doc->testo_link ? $doc->testo_link : $doc->testo_link_eng;

				if ($doc->tipo_link=="link" && $link) {
					$items->push([
						'tipo'   => 'link',
						'titolo' => $titolo,
						'href'   => str_starts_with($link,"http") ? $link : config('app.url').'/'.$link,
						'fisso'  => $doc->link_fisso,
						'id_doc' => $doc->id,
					]);
				}
				elseif ($doc->tipo_link=="allegato" && $pdf) {
					$items->push([
						'tipo'   => 'allegato',
						'titolo' => $titolo,
						'href'   => asset("resarea/files/regate/noticeboard/$pdf"),
						'fisso'  => $doc->link_fisso,
						'id_doc' => $doc->id,
					]);
				}
				else {
					$items->push([
						'tipo'   => 'testo',
						'titolo' => $titolo,
						'href'   => null,
						'fisso'  => $doc->link_fisso,
						'id_doc' => $doc->id,
					]);
				}
			}

			// 🔹 Divide in 2 colonne
			$chunks = $items->chunk( ceil($items->count() / 2) );
		@endphp

		@if($items->count() > 0)
			<div style="display:flex; gap:20px;" class="list-container">
				@foreach($chunks as $chunk)
					<div style="flex:1;">
						<div style="display:flex; gap:5px; flex-direction:column; padding-top:20px; padding-bottom:20px;">
							@foreach($chunk as $item)
								<div class="list-link">
									<img src="{{ smartAsset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
									@if($item['href'])
										@php
											$link_allegato = $item['href'];
											if($item['fisso']==1){
												$link_allegato = "regate-";
												if($lingua=="eng") $link_allegato = "en/regattas-";
												$link_allegato .= $anno_regata."/".creaSlug($nome_regata,"")."-".$id_dett."/doc-".$item['id_doc']."/".creaSlug($item['titolo'],"");
											}
										@endphp
										<a href="{{ $link_allegato }}" target="_blank">
											<span style="font-size:12px;">{{ $item['titolo'] }}</span>
										</a>
									@else
										<span style="font-size:12px;">{{ $item['titolo'] }}</span>
									@endif
								</div>
							@endforeach
						</div>
					</div>
				@endforeach
			</div>
		@endif

	</div>
	<style>
		.programma-container {
			width:100%;
			margin-top:85px;
			display:flex;
			gap:20px;
		}
		@media screen and (max-width: 800px) {
			.programma-container {
				flex-direction:column;
			}
		}
	</style>
	<div class="programma-container">
		<div style="height:100vh; position:relative;" class="colLeft">
			<img src="{{ smartAsset('resarea/img_up/regate/'.$value_ed->img_documenti_v3) }}" style="width:100%; height:100%; object-fit:cover; object-position:center top"/>
		</div>
		<div style="height:calc(100vh - 60px); margin-top:30px; position:relative; display:flex; gap:25px; flex-direction:column;" class="colRight">
			@include("web.regate.programma")
			@include("web.regate.iscritti")
			@include("web.regate.albo")
			@include("web.regate.crew")
			@include("web.regate.info")
			@include("web.regate.risultati")
			
		</div>
	</div>
	
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
	
	@if($num_press>0)
		<style>
			.news-container {
				position:absolute; 
				width:calc(100% - 260px);
				margin-left:130px; 
				top:0; 
				height:100%; 
				overflow:hidden; 
				z-index:0;
			}
			.link-arrow.riga-news{				
				width:calc(100% - 80px) !important;
				margin-top:100px!important;
				margin-left:80px;
			}
			@media screen and (max-width: 1400px) {
				.news-container {
					width:calc(100% - 130px);
					margin-left:65px;
				}
				.link-arrow.riga-news{
					width:calc(100% - 130px) !important;
					margin-left:130px;
				}
			}
			@media screen and (max-width: 1024px) {
				.news-container {
					width:calc(100% - 65px);
					margin-left:32.5px;
				}
				.link-arrow.riga-news{
					width:calc(100% - 160px) !important;
					margin-left:160px;
				}
			}
			@media screen and (max-width: 800px) {
				#regateNews{
					
				}
				.link-arrow.riga-news{		
					margin-top:70px!important;
				}	
				.news-item  {
					flex: calc(50% - 24px);
					max-width: calc(50% - 24px);
				}
				.news-title {
					margin-top:20px;
				}
				.news-container-margin-top {
					margin-top:150px;
				}
				.news-container-title{
					margin-top:0px!important;
				}
			}
			@media screen and (max-width: 450px) {
				.news-item  {
					flex: calc(100% - 24px);
					max-width: calc(100% - 24px);
				}
			}
		</style>
		<div class="news-container-margin-top"></div>
		<div style="width:100%; height:105vh; position:relative; overflow:hidden" id="regateNews">					
			<video autoplay muted loop playsinline class="slide-background-video" style="position:absolute;">
				<source src="{{ smartAsset('web/video/Vela_Background.mp4') }}" type="video/mp4">
			</video>
			<div class="news-container">
				<div style="width:100%; display:flex; gap:35px;margin-top:65px;" class="news-container-title">
					<h3 class="gradient-title news-title">News</h3>
					<div class="news-container" id="regateNews">					
						<div class="link-arrow riga-news">
						 
						</div>
					</div>
				</div>
				<style>
					.news-scroll-container-wrapper {
						padding:10px 150px 0px 150px;
					}
					@media screen and (max-width: 1200px) {
						.news-scroll-container-wrapper {
							padding:10px 75px 0px 75px;
						}
					}
					@media screen and (max-width: 1024px) {
						.news-scroll-container-wrapper {
							padding:10px 32.5px 0px 32.5px;
						}
					}
					@media screen and (max-width: 800px) {
						.news-scroll-container-wrapper {
							padding:10px 0px 0px 0px;
						}
					}
				</style>	
				<div class="news-scroll-container-wrapper">
					<div class="news-scroll-container">
						<div class="news-scroll-wrapper" id="news-scroll-wrapper">
							
							@foreach($query_press AS $key_press=>$value_press)		
							
								@if($i==1)
									<div class="news-row">
								@endif
									@php
										if($i==1) $pos="left";
										if($i==2) $pos="center";
										if($i==3) $pos="right";
										
										if(!empty($value_press->foto1)) $foto = $value_press->foto1;
										else $foto = $value_press->foto2;
										
										$link = "regate-".$anno_regata."/press/".$nome_regata."-".$id_dett."/".creaSlug($value_press->titolo,"")."-".$value_press->id.".html";
									@endphp
									<div class="news-item  news-item-<?php echo $pos;?> news-hero-container news-hero-container2">
										<div style="width:100%; height:190px; position:relative; overflow:hidden;">
											<a href="{{ $link }}" title = "{{ $value_press->titolo }}">
												<img style="width:100%; height:100%; object-fit:cover;" src="https://www.yccs.it/resarea/img_up/regate/press/{{ $foto }}" class="news-hero-image">
											</a>
										</div>
										
										<div class="news-hero-date" style="position:relative !important; color:#000; border-color:#000; margin-top:10px;">
											{{ convertDateFormat($value_press->data,"Y-m-d", "d/m/Y") }}
										</div>
										<div class="news-hero-title" style="color:#000;">
											{{ \Illuminate\Support\Str::limit($value_press->titolo, 60) }}
										</div>	
										<a href="{{ $link }}" class="link-arrow" title = "{{ $value_press->titolo }}" style="width:136px; margin-top:12px; margin-right:20px;">
											<span><?php if($lingua=="ita"){?>Scopri di più<?php }else{?>Read More<?php }?></span>
											<img src="{{ smartAsset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
										</a>
									</div>	
								@if($i==3  || $loop->last)
									</div>
								@endif
							
								@php
									$i++; if($i==4) $i=1;
								@endphp
							@endforeach
						</div>
					</div>
				</div>
				
				<div class="scroll-arrows-container" <?php if($num_press<=6){?> style="display:none" <?php }?>>
					<img src="{{ smartAsset('web/images/freccia_giu.png') }}" class="scroll-arrow-btn" id="arrowDown"
						 data-default="freccia_giu.png" data-hover="freccia_giu_on.png"
						 style="width:43px; height:43px" alt=""/>
					<img src="{{ smartAsset('web/images/freccia_su.png') }}" class="scroll-arrow-btn" id="arrowUp"
						 data-default="freccia_su.png" data-hover="freccia_su_on.png"
						 style="width:43px; height:43px" alt=""/>
				</div>
				
			</div>
		</div>
	@endif
	
	
	@php
		$query_img = DB::table('edizioni_foto')
			->where('id_edizione', $id_dett)
			->orderby('ordine', 'DESC')
			->limit(8)
			->get();
		
		$num_img = $query_img->count();
		$galleryReg = [];
		$i = 0;

		foreach($query_img as $value_img) {
			$i++;
			$foto_raw = $value_img->foto;
			
			if (stristr($foto_raw, "admin") || stristr($foto_raw, "resarea")) {
				$foto_clean = str_replace(["admin/img_up/regate/foto/", "resarea/img_up/regate/foto/"], "", substr($foto_raw, 1));
				$galleryReg[$i] = "resarea/img_up/regate/foto/" . $foto_clean;
			} else {
				$foto_clean = substr($foto_raw, 1);
				$foto_clean = str_replace(["-150-100", "-140-90"], "-800-600", $foto_clean);
				$galleryReg[$i] = substr($foto_clean, 0, -6) . ".jpg";
			}
		}
	@endphp

	@if($num_img > 0)
		<style>
			.masonry-grid {
				display: grid;
				grid-template-columns: repeat(4, 1fr); 
				grid-auto-rows: 182px;
				gap: 20px;
				width: 100%;
			}
			
			.masonry-grid .item {
				position: relative;
				width: 100%;      
				height: 100%;      
				overflow: hidden;
			}
			
			.gallery-section {
				display: block;
				width: calc(100% - 300px);
				margin-left: 150px;
				height: auto;       /* Permette di crescere con il contenuto */
				min-height: 182px;  /* Almeno l'altezza di una riga */
				position: relative;
				clear: both;        /* Evita che elementi float precedenti interferiscano */
				margin-top:70px; 
				margin-bottom:65px;
			}

			/* 1 Foto: Full width */
			.grid-count-1 .item { grid-column: span 4; grid-row: span 2; height: 385px; }

			/* 2 Foto: Due colonne grandi */
			.grid-count-2 .item { grid-column: span 2; grid-row: span 2; height: 385px; }

			/* 3 Foto: 1 grande e 2 piccole a lato */
			.grid-count-3 .item:nth-child(1) { grid-column: span 2; grid-row: span 2; height: 385px; }
			.grid-count-3 .item:nth-child(2), .grid-count-3 .item:nth-child(3) { grid-column: span 2; height: 182px; }

			/* 4 Foto: 2x2 */
			.grid-count-4 .item { 
				grid-column: span 2; 
				grid-row: span 2; 
				height: 385px; 
			}

			/* --- CASO 5 FOTO: Layout Asimmetrico --- */
			/* Foto 1: Alta tutta a sinistra */
			.grid-count-5 .item:nth-child(1) { 
				grid-column: span 1; 
				grid-row: span 2; 
				height: 385px; 
			}

			/* Foto 2 (Sopra - Piccola): 1 colonna */
			.grid-count-5 .item:nth-child(2) { 
				grid-column: span 1; 
				grid-row: span 1; 
				height: 182px; 
			}

			/* Foto 3 (Sopra - Lunga): 2 colonne */
			.grid-count-5 .item:nth-child(3) { 
				grid-column: span 2; 
				grid-row: span 1; 
				height: 182px; 
			}

			/* Foto 4 (Sotto - Lunga): 2 colonne */
			.grid-count-5 .item:nth-child(4) { 
				grid-column: span 2; 
				grid-row: span 1; 
				height: 182px; 
			}

			/* Foto 5 (Sotto - Piccola): 1 colonna */
			.grid-count-5 .item:nth-child(5) { 
				grid-column: span 1; 
				grid-row: span 1; 
				height: 182px; 
			}

			/* --- CASO 6 FOTO: 1 Lunga + 1 Larga + 4 Piccole --- */

			/* Foto 1: LUNGA (Verticale) - occupa la prima colonna per 2 righe */
			.grid-count-6 .item:nth-child(1) { 
				grid-column: span 1; 
				grid-row: span 2; 
				height: 384px; /* 182 + 182 + 20px gap */
			}

			/* Foto 2: LARGA (Orizzontale) - occupa 2 colonne nella prima riga */
			.grid-count-6 .item:nth-child(2) { 
				grid-column: span 2; 
				grid-row: span 1; 
				height: 182px; 
			}

			/* Foto 3: Piccola - occupa l'ultima colonna della prima riga */
			.grid-count-6 .item:nth-child(3) { 
				grid-column: span 1; 
				grid-row: span 1; 
				height: 182px; 
			}

			/* Foto 4, 5 e 6: Piccole - riempiono la seconda riga */
			.grid-count-6 .item:nth-child(4),
			.grid-count-6 .item:nth-child(5),
			.grid-count-6 .item:nth-child(6) { 
				grid-column: span 1; 
				grid-row: span 1; 
				height: 182px; 
			}
			
			
			/* --- CASO 7 FOTO: Tutte piccole, una larga al centro (Riga 2) --- */
			.grid-count-7 .item { grid-column: span 1; grid-row: span 1; height: 182px; }
			.grid-count-7 .item:nth-child(5) { 
				grid-column: span 2; /* Larga al centro nella seconda riga */
			}

			/* --- CASO 8 FOTO: Incastro complesso (3 righe) --- */
			/* RIGA 1: Larga (2 col) - Lunga (1 col) - Piccola (1 col) */
			.grid-count-8 .item:nth-child(1) { grid-column: span 2; height: 182px; }
			.grid-count-8 .item:nth-child(2) { grid-column: span 1; grid-row: span 2; height: 385px; } /* Lunga */
			.grid-count-8 .item:nth-child(3) { grid-column: span 1; height: 182px; }

			/* RIGA 2: Lunga (1 col) - Piccola (1 col) - (Spazio occupato dalla 2) - Piccola (1 col) */
			.grid-count-8 .item:nth-child(4) { grid-column: span 1; grid-row: span 2; height: 385px; } /* Lunga */
			.grid-count-8 .item:nth-child(5) { grid-column: span 1; height: 182px; }
			/* Qui la foto 2 occupa la terza colonna */
			.grid-count-8 .item:nth-child(6) { grid-column: span 1; height: 182px; }

			/* RIGA 3: (Spazio occupato dalla 4) - Larga (2 col) - Piccola (1 col) */
			/* Qui la foto 4 occupa la prima colonna */
			.grid-count-8 .item:nth-child(7) { grid-column: span 2; height: 182px; } /* Larga */
			.grid-count-8 .item:nth-child(8) { grid-column: span 1; height: 182px; }

			.img-gallery { width: 100%; height: 100%; object-fit: cover; border-radius: 4px; }
			.gallery-container {
				width: calc(100% - 260px);
				margin-left:130px;
			}

			@media screen and (max-width: 1400px) {
				.gallery-container {
					width: calc(100% - 130px);
					margin-left:65px;
				}
			}
			@media screen and (max-width: 1200px) {
				.gallery-section {
					width: calc(100% - 150px);
					margin-left:75px;
				}
			}
			@media screen and (max-width: 1024px) {
				.gallery-container {
					width: calc(100% - 65px);
					margin-left:32.5px;
				}
				.gallery-section {
					width: calc(100% - 65px);
					margin-left:32.5px;
				}
				/* Sotto 1024: sempre 2 colonne, indipendentemente dal numero di foto */
				.masonry-grid {
					grid-template-columns: repeat(2, 1fr);
					grid-auto-rows: 200px;
				}
				.masonry-grid .item,
				.masonry-grid.grid-count-1 .item,
				.masonry-grid.grid-count-2 .item,
				.masonry-grid.grid-count-3 .item,
				.masonry-grid.grid-count-3 .item:nth-child(1),
				.masonry-grid.grid-count-3 .item:nth-child(2),
				.masonry-grid.grid-count-3 .item:nth-child(3),
				.masonry-grid.grid-count-4 .item,
				.masonry-grid.grid-count-5 .item,
				.masonry-grid.grid-count-5 .item:nth-child(1),
				.masonry-grid.grid-count-5 .item:nth-child(2),
				.masonry-grid.grid-count-5 .item:nth-child(3),
				.masonry-grid.grid-count-5 .item:nth-child(4),
				.masonry-grid.grid-count-5 .item:nth-child(5),
				.masonry-grid.grid-count-6 .item,
				.masonry-grid.grid-count-6 .item:nth-child(1),
				.masonry-grid.grid-count-6 .item:nth-child(2),
				.masonry-grid.grid-count-6 .item:nth-child(3),
				.masonry-grid.grid-count-6 .item:nth-child(4),
				.masonry-grid.grid-count-6 .item:nth-child(5),
				.masonry-grid.grid-count-6 .item:nth-child(6),
				.masonry-grid.grid-count-7 .item,
				.masonry-grid.grid-count-7 .item:nth-child(5),
				.masonry-grid.grid-count-8 .item,
				.masonry-grid.grid-count-8 .item:nth-child(1),
				.masonry-grid.grid-count-8 .item:nth-child(2),
				.masonry-grid.grid-count-8 .item:nth-child(3),
				.masonry-grid.grid-count-8 .item:nth-child(4),
				.masonry-grid.grid-count-8 .item:nth-child(5),
				.masonry-grid.grid-count-8 .item:nth-child(6),
				.masonry-grid.grid-count-8 .item:nth-child(7),
				.masonry-grid.grid-count-8 .item:nth-child(8) {
					grid-column: span 1 !important;
					grid-row: span 1 !important;
					height: 200px !important;
				}
				.gallery-section {
					margin-top:20px;
				}
			}
			@media screen and (max-width: 450px) {
				/* Sotto 450: 1 colonna */
				.masonry-grid {
					grid-template-columns: 1fr;
					grid-auto-rows: 240px;
				}
				.masonry-grid .item,
				.masonry-grid [class^="grid-count-"] .item {
					grid-column: span 1 !important;
					grid-row: span 1 !important;
					height: 240px !important;
				}
			}
			@media screen and (max-width: 800px) {
				.gallery-container {
					width: calc(100% - 32.5px);
					margin-left:16.25px;
				}
				.gallery-section {
					margin-top:0px;
				}
			}
			@media screen and (max-width: 450px) {
				.masonry-grid{
					gap:0;
				}
			}
			</style>

		<div class="gallery-container" >
			<div style="width:100%; display:flex; gap:35px; margin-top:65px;">
				<h3 class="gradient-title">Gallery</h3>
				<div style="flex:1;">
					<div class="link-arrow" style="width:163px !important; margin-top:30px; padding-left:calc(100% - 163px); padding-bottom:7px; border-bottom:solid 2px;"></div>
				</div>
			</div>

			<div class="gallery-section">
				<div class="gallery-overlay"></div>
				
				<div class="masonry-grid grid-count-{{ $num_img }}">
					@for($img_idx = 1; $img_idx <= 8; $img_idx++)
						@if(isset($galleryReg[$img_idx]))
							<div class="item">
								<div style="width:100%; height:100%; position:relative;">
									<a href="{{ smartAsset($galleryReg[$img_idx]) }}" class="glightbox" data-gallery="gallery">
										<img src="{{ smartAsset($galleryReg[$img_idx]) }}" class="img-gallery" />
									</a>
								</div>
							</div>
						@endif
					@endfor
				</div>
				<style>
					.gallery-nav-container {
						position:absolute; 
						width:100%; 
						left:0; 
						bottom:-20px; 
						z-index:2;
					}
					.gallery-link-arrow {
						width:115px; margin-top:12px; margin-right:20px;
					}
					@media screen and (max-width: 450px) {
						.gallery-nav-container {
							bottom:0px;
						}
						.gallery-link-arrow {
							margin-top:0px;
						}
					}
				</style>		
				<div class="gallery-nav-container">
					<div class="slider-nav-wrapper" style=" display:none;">
						<button class="nav-arrow-button prev-slide">
						  <img src="{{ smartAsset('web/images/freccia_giu.png') }}" 
						  data-default="{{ smartAsset('web/images/freccia_giu.png') }}" 
						  data-hover="{{ smartAsset('web/images/freccia_giu_on.png') }}" 
						  alt="Prev">
						  
						</button>
						<button class="nav-arrow-button next-slide">
						  <img src="{{ smartAsset('web/images/freccia_su.png') }}" 				  
						  data-default="{{ smartAsset('web/images/freccia_su.png') }}" 
						  data-hover="{{ smartAsset('web/images/freccia_su_on.png') }}" 
						  alt="Next">
						</button>
					</div>
					<div style="position:absolute; width:115px; height:50px; right:0; bottom:-45px;">
						<a href="regate-{!! $value_ed->anno !!}/fotogallery/{{ creaSlug($value_ed->nome_regata,"") }}-{{$id_dett}}.html" class="link-arrow gallery-link-arrow">
							<span>{{ $lingua=="ita" ? "Vedi tutte" : "See All" }}</span>
							<img src="{{ smartAsset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
						</a>
					</div>
				</div>
			</div>
		</div>
	@endif
	
	@include('web.regate.banner')
	
	@include('web.regate.loghi_partners')
	@include('web.regate.partners_ufficiali')
	
	<!-- GLightbox CSS -->
	<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
	<!-- GLightbox JS -->
	<script src="{{ asset('https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js') }}"></script>
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
	@include('web.assets.regate_js')
@endsection