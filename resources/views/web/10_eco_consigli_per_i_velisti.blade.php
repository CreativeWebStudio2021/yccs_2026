@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/loYCCSoggi.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.YCCS e Sostenibilita'); $breadcrumbs[$x]['link']='sssss'; 
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
						$query_foto = $query_foto->where('pagina','=','10_eco_consigli_per_i_velisti');
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
											  <source srcset="https://www.yccs.it/<?php echo $img_m;?>" media="(max-width: 600px)" />
											  <source srcset="https://www.yccs.it/<?php echo $img_s;?>" media="(max-width: 440px)" />
											  <source srcset="https://www.yccs.it/<?php echo $img_xs;?>" media="(max-width: 340px)" />
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
						ol{margin-left:30px}
					</style>
					<div style="margin-top:30px;">
						<?php if($lingua=="ita"){?>
							<p>
								Ognuno di noi attraverso le proprie scelte pu&ograve; contribuire alla salvaguardia&nbsp;dell&rsquo;ambiente!<br />
								Segui queste regole per rispettare l&rsquo;ambiente anche in barca:</p>
							
							<ol style="">
								<li><strong>Evita l&rsquo;utilizzo di&nbsp;plastica: </strong>preferisci oggetti riutilizzabili o compostabili ad altri monouso, ad esempio porta con te una borraccia. Presso lo YCCS &egrave; stata installata una fontana che eroga gratuitamente acqua potabile a disposizione di tutti.</li>						
								<li value="2"><strong>Fai la raccolta differenziata e non gettare nulla in mare</strong>: differenzia correttamente i rifiuti a bordo (plastica, vetro, carta) e conferiscili nei bidoni della spazzatura presenti nella marina, in modo che vengano destinati al recupero.</li>						
								<li value="3"><strong>Utilizza detersivi e detergenti ecologici:&nbsp;</strong>per la tua igiene e la pulizia in barca, assicurati che siano biodegradabili.</li>						
								<li value="4"><strong>Non sversare le acque nere in prossimit&agrave; di zone balneari, nei porti, negli approdi e presso gli ormeggi dedicati alla sosta.</strong></li>						
								<li value="5"><strong>Limita l&rsquo;utilizzo di carburanti</strong>: navigare a velocit&agrave; moderata non solo aiuta a risparmiare carburante (e denaro), ma riduce anche il disturbo per la fauna marina.</li>						
								<li value="6"><strong>Evita perdite di carburante:&nbsp;</strong> rifornisci di carburante la tua barca quando ti trovi in porto, non al largo e controlla che non ci siano perdite dal serbatoio o nelle taniche di riserva prima della partenza.</li>						
								<li value="7"><strong>Non sprecare acqua potabile</strong>:&nbsp;elimina gli sprechi e anche per sciacquare la barca usa riduttori di flusso che aiutano a ridurre i consumi.</li>						
								<li value="8"><strong>Utilizza creme solari ecologiche</strong>:&nbsp;i filtri solari chimici non solo possono contenere ingredienti dannosi per la nostra salute ma sono anche altamente tossici per l'ecosistema marino.</li>						
								<li value="9"><strong>Proteggi i fondali marini e non gettare l&rsquo;ancora sulla <em>Posidonia</em></strong>:  gettare l'ancora e trascinarla sui fondali può provocare danni significativi. Per esempio, la Posidonia &egrave; una pianta fondamentale per l'ecosistema marino e impiega decenni per crescere.</li>						
								<li value="10"><strong>Rispetta le aree marine protette:</strong>&nbsp; le aree marine protette sono aree regolamentate per proteggere l'ambiente naturale. Ogni area ha un proprio regolamento da rispettare, scoprilo.</li>
							</ol>
							<p>
								<em>Diventa un&nbsp;Ocean Defender</em><em> applicando e diffondendo queste azioni virtuose e segnalando alle autorit&agrave; situazioni di potenziale pericolo per l&rsquo;ambiente.</em></p>
							<p>
								<a href="https://www.1ocean.org/charta-smeralda/" class="azzurro" target="_blank"><b>Firma Online la Charta Smeralda sul sito 1ocean.org</b></a></p>
							<p>	
								&nbsp;</p>
						<?php }else{?>
							<p>
								Every one of us can make personal choices to help safeguard the environment!<br />
								Follow these rules to care for the environment while on the water:</p>
							<ol style="color:#94918D;">
								<li><strong>Avoid plastic: </strong>use reusable or compostable items, for example, bring your own reusable water bottle wherever you go. The Yacht Club has installed a water fountain that anyone can use!</li>
								<li value="2"><strong>Separate your waste for recycling and don&rsquo;t throw anything in the sea</strong>: separate waste on board correctly (plastic, glass, paper) and put it in the bins at the marina where it will be collected.</li>
								<li value="3"><strong>Use environmentally friendly detergents and cleaning products:</strong>&nbsp;for both personal hygiene and cleaning the boat. Make sure that they are biodegradable.</li>
								<li value="4"><strong>Don&rsquo;t release blackwater near swimming areas, in marina&rsquo;s, harbours or at anchor.</strong></li>
								<li value="5"><strong>Limit the use of fuel:</strong>&nbsp;sailing without having the engine on full throttle will not only help you to save fuel (and money), but will also reduce the disturbance to marine fauna.&nbsp;</li>
								<li value="6"><strong>Prevent fuel loss:</strong>&nbsp;refuel your boat when you are in port, not on open water, and check that there are no leaks from the tank or reserve tanks before setting off.</li>
								<li value="7"><strong>Do not waste water:</strong>&nbsp;eliminate wastage of drinkable water and, when rinsing the boat, use flow restrictors to help reduce consumption.</li>
								<li value="8"><strong>Use eco-friendly sun creams:&nbsp;</strong>chemical solar filters can contain ingredients that are not only harmful to our health but are also highly toxic to the marine ecosystem.</li>
								<li value="9"><strong>Protect the seabedand do not drop anchor on </strong><em>Posidonia</em><strong>:&nbsp;</strong>dropping anchor and dragging it along the seabed can cause significant damage. <em>Posidonia (seagrass)</em>, for example, is a plant that is an essential part of the marine ecosystem and it takes decades to grow.</li>
								<li value="10"><strong>Respect marine protected areas:</strong>&nbsp;marine protected areas are zones where activities are regulated to protect the natural environment. Each marine protected area has its own rules and regulations to be followed, be aware of them.</li>
							</ol>
							<p >
								<em>Become an&nbsp;Ocean Defender by</em><em> promoting and applying these positive actions and reporting situations of potential environmental damage to the authorities</em></p>
							<p>
								<a href="https://www.1ocean.org/en/charta-smeralda/" class="azzurro" target="_blank"><b>Sign the Charta Smeralda online on the website 1ocean.org</b></a></p>
							<p>
								&nbsp;</p>
						<?php }?>
					</div>
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
	
@endsection