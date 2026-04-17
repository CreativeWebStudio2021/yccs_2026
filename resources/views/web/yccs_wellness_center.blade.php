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
				<div class="link-arrow" style="width:163px !important; gap:47px !important; margin-top:30px; padding-left:calc(100% - 163px); padding-bottom:7px; border-bottom:solid 2px;">
				 
				</div>
			</div>
		</div>

		
		@php
			$query_foto = DB::table('fotogallery_pagine');
			$query_foto = $query_foto->select('*');
			$query_foto = $query_foto->where('pagina','=','yccs-wellness-center');
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
					<div style="padding:50px 0; "  class="multi-column">
						<?php if($lingua=="ita"){?>
							<p style="text-align:justify">
								Gli accoglienti ed eleganti spazi dello YCCS Wellness Center trovano la loro collocazione nell&#39;esclusiva cornice dello Yacht Club Costa Smeralda di Porto Cervo, destinazione di prestigiose regate internazionali da oltre 50 anni.&nbsp;
								<br/><br/>
								Spazi dal design contemporaneo per sperimentare momenti unici di relax, un ambiente esclusivo e discreto, studiato in ogni dettaglio per donare agli ospiti una profonda sensazione di benessere.&nbsp;
								<br/><br/>
								YCCS Wellness Center offre trattamenti personalizzati viso - corpo, rituali efficaci, risultati visibili e duraturi, effettuati con formulazioni all&rsquo;avanguardia e con prodotti di eccellente qualit&agrave; combinando scienza e natura.&nbsp;
								<br/><br/>
								Selezionati principi attivi vegetali nutrono la pelle e ripristinano la naturale luminosit&agrave;, mentre speciali tecniche di massaggio evocano un profondo relax. Esclusivi servizi beauty - Manicure, Pedicure, Shellac &ndash; completano il percorso bellezza studiato per soddisfare anche i clienti pi&ugrave; esigenti.&nbsp;
								<br/><br/>
								YCCS Wellness Center comprende 1 Suite privata di coppia con hammam, docce emozionali e cromoterapia, 4 suite attrezzate per trattamenti viso e corpo, massaggi e servizi beauty, una zona umida naturalmente corredata di bagno di vapore aromatico, sauna finlandese e biosauna nonch&eacute; la boutique dove trovare le creazioni pi&ugrave; esclusive di Acqua di Parma.&nbsp;
								<br/><br/>
								All&rsquo;interno della struttura &egrave; presente una palestra Technogym, attrezzata con le pi&ugrave; innovative soluzioni di allenamento Technogym.<?php /*, tra cui SKILL LINE - un concentrato di tecnologia e design che si ispira alla passione per lo sport ed &egrave; dedicata a tutti coloro che desiderano migliorare la propria performance atletica.
								<br/>
								Tra i prodotti della linea SKILL anche l&rsquo;ultimissima Skillbike, la rivoluzionaria bici che permette a ciclisti, triatleti ed appassionati di vivere le emozioni e le sfide dell&rsquo;esperienza su strada nel comfort di un contesto indoor.
								<br/>
								Vieni a vivere un&rsquo;esperienza di allenamento unica, completa e personalizzata secondo le tue necessit&agrave;.&nbsp;*/?>
								<br/><br/>
								Gli orari di apertura sono dal luned&igrave; alla domenica: 9.00 - 13.00/ 16.00 &ndash; 20.00.
								<br />
								Per ulteriori informazioni contattare il seguente numero&nbsp;<a href="http://mtrack.me/tracking/raWzMz50paMkCGHjBGZ2ZmtkBGRzMKWjqzA2pzSaqaR9ZmH1BQH3AGVmWay2LKu2pG0kBGLjAwp5ZGp5BIZ">0789 973 425</a>&nbsp;oppure scrivere a&nbsp;<a href="mailto:wellness.center@yccs.it">wellness.center@yccs.it</a>.&nbsp;
								<br/><br/><br/>
								<span style="font-size:0.9em; font-style:italic; line-height:1.2;">I servizi vengono forniti da Società controllata da Yacht Club Costa Smeralda, proprietaria di parte dell'edificio YCCS e gestore delle attività alberghiere.</span>
							</p>
							
						<?php }else{?>
							<p style="text-align:justify">
								The elegant, welcoming surroundings of the YCCS Wellness Center are located within the exclusive setting of the Yacht Club Costa Smeralda in Porto Cervo, home to prestigious international regattas for over 50 years. 
								<br/><br/>
								Contemporary spaces afford unique moments of relaxation in an exclusive and discreet atmosphere, with every detail designed to promote a profound sense of wellbeing. 
								<br/><br/>
								YCCS Wellness Center offers personalised face and body treatments, effective rituals providing visible and lasting results, employing cutting-edge techniques and top quality products that combine science and nature.
								<br/><br/>
								Selected active plant ingredients nourish your skin and restore its natural glow, while special massage techniques stimulate deep relaxation. Exclusive cosmetic treatments - manicures, pedicures, Shellac – complete the offering designed to satisfy even the most exacting clients.
								<br/><br/>	
								YCCS Wellness Center includes a private couples' suite with hammam, sensorial shower and chromotherapy; four suites for face and body treatments, massages and cosmetic treatments; a wet zone including an aromatic steam bath, Finnish sauna and bio sauna; and a boutique offering Acqua di Parma’s most exclusive ranges.
								<br/><br/>	
								The structure is home to a Technogym fitness area, equipped with the most innovative Technogym training solutions.<?php /*, including SKILL LINE - a concentrate of technology and design inspired by a passion for sport and dedicated to anyone looking to improve their athletic performance.
								<br/>
								Among the products in the SKILL line is the latest Skillbike, a revolutionary bike that allows cyclists, triathletes and enthusiasts to experience the thrills and challenges of road riding from the comfort of the gym.
								<br/>
								Come and experience a unique and complete training experience, fully personalised according to your needs.*/?>
								<br/><br/>
								Opening hours are Monday to Sunday: 9.00 am. – 1.00 pm./ 4.00 pm. – 8.00 pm.
								<br/>
								For more information contact <a href="tel:+390789973425">+39 0789 973 425</a> or write to <a href="mailto:wellness.center@yccs.it">wellness.center@yccs.it</a>.
								<br/><br/><br/>				
								<span style="font-size:0.9em; font-style:italic; line-height:1.2;">Services are provided by a subsidiary of Yacht Club Costa Smeralda, which owns part of the YCCS building and manages the hotel operations.</span>
							</p>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
		
		@php
			if(isset($_POST['nome'])) $nome=$_POST['nome']; else $nome="";
			if(isset($_POST['cognome'])) $cognome=$_POST['cognome']; else $cognome="";
			if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
			if(isset($_POST['telefono'])) $telefono=$_POST['telefono']; else $telefono="";
			if(isset($_POST['messaggio'])) $messaggio=$_POST['messaggio']; else $messaggio="";
			if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";
			$data=date("Y-m-d H:i:s");
		@endphp
		
		<style>
			.form-group label:not(.error) {font-weight: 600; color:#111111}
			.form-gray-fields .form-control {
				background-color: #f2f2f2;
				border-color: #e9e9e9;
				color: #333;
			}
		</style>
		<div class="row" style="margihn-top:20px;">
			<div class="col-md-12">
				<form name="sendRequest" action="{{ url()->full() }}" method="post" class="form-gray-fields" autocomplete="off">
					@csrf
					<input type="hidden" name="stato" value="inviato"/>
					<div style="display:flex; gap:50px">
						<div style="flex:1">
							<div class="form-group">
								<label class="upper" for="name"><?php if($lingua=="ita"){?>Nome<?php }else{?>Your Name<?php }?>*</label>
								<input type="text" class="form-control" name="nome"  id="name3" required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" value="<?php echo $nome;?>">
								<div class="help-block with-errors"></div>										
							</div>
						</div>
						<div style="flex:1">
							<div class="form-group">
								<label class="upper" for="surname"><?php if($lingua=="ita"){?>Cognome<?php }else{?>Your Surname<?php }?>*</label>
								<input type="text" class="form-control" name="cognome"  id="email3" required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" value="<?php echo $cognome;?>">
							</div>
						</div>
					</div>
					<div style="display:flex; gap:50px">
						<div style="flex:1">
							<div class="form-group">
								<label class="upper" for="phone"><?php if($lingua=="ita"){?>Telefono<?php }else{?>Your Phone<?php }?></label>
								<input type="tel" class="form-control" name="telefono"  id="phone3" value="<?php echo $telefono;?>">
							</div>
						</div>
						<div style="flex:1">
							<div class="form-group">
								<label class="upper" for="email">Email*</label>
								<input type="email" class="form-control" name="email"  id="email3" required="required"  oninvalid="if(this.validity.typeMismatch){this.setCustomValidity('<?php if($lingua=="ita"){?>Immettere un indirizzo di posta elettronico valido<?php }else{?>Enter a valid email address<?php }?>')}else{this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')}" oninput="setCustomValidity('')" value="<?php echo $email;?>">
							</div>
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="upper" for="message"><?php if($lingua=="ita"){?>Messaggio<?php }else{?>Message<?php }?>*</label>
								<textarea class="form-control" name="messaggio" rows="9"  id="comment3" required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')"><?php echo $messaggio;?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group" style="font-size:0.8em; line-height:15px">
								<?php /*<?php if($lingua=="eng"){?><p>In accordance with d.lgs. 196/2003 (Italy) I authorize the Data Controller to treat this data for the purposes herein indicated. The Data Controller shall not release this information to third parties unless obliged to do so by law.</p><?php }?>*/?>
								<label>
									<input type="checkbox" id="privacy" name="privacy" value="0" <?php /*onclick="check_privacy()"*/?> required="required" onchange="this.setCustomValidity(validity.valueMissing ? '<?php if($lingua=="ita"){?>Autorizzazione della privacy obbligatoria<?php }else{?>Privacy Required<?php }?>' : '');" oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Autorizzazione della privacy obbligatoria<?php }else{?>Privacy Required<?php }?>')" oninput="setCustomValidity('')"/> 
									&nbsp; 
									<a href="<?php if($lingua=="en"){?>en/<?php }?>privacy.html">
										<?php if($lingua=="ita"){?>
											Dichiaro di aver preso visione dell’informativa sul trattamento dei dati personali (GDPR 679/16), e di autorizzarne il trattamento *
										<?php } else {?>
											I declare to have read the notice on processing of personal data (GDPR 679/16), and I authorise processing. *
										<?php }?>
									</a>
								</label>
							</div>
							<?php /*<script type="text/javascript">
								var pr=0;
								function check_privacy(){
									if(pr==0) pr=1;
									else pr=0;
									document.sendRequest.privacy.value=pr;
								}
							</script>*/?>
						</div>
					</div>
					
					<div class="g-recaptcha" style="width:305px; margin:20px auto; " data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group text-center">
								<button class="btnYccsWhite" style="width:80px;" type="button" id="inviaCrew" onclick="checkForm();"><?php if($lingua=="ita"){?>INVIA<?php }else{?>SEND<?php }?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row" style="margihn-top:20px;margihn-bottom:20px;">
			<div class="col-md-12" style="text-align:center;">
				<img src="web/images/partner_technogym2.jpg" alt="Technogym" style="width:170px"/><br/>Wellness Technical Partner
			</div>
		</div>
		<script type="text/javascript">
			Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
			function checkForm(){
				if (document.sendRequest.nome.value=="") alert('<?php if($lingua=="eng"){?>"Name" required<?php } else {?>Campo "Nome" obbligatorio<?php }?>');			
				else if (document.sendRequest.cognome.value=="") alert('<?php if($lingua=="eng"){?>"Surname" required<?php } else {?>Campo "Cognome" obbligatorio<?php }?>');			
				else if (document.sendRequest.email.value=="") alert('<?php if($lingua=="eng"){?>"Email" required<?php } else {?>Campo "E-mail" obbligatorio<?php }?>');
				else if (isNaN(document.sendRequest.telefono.value) && document.sendRequest.telefono.value!="") alert('<?php if($lingua=="eng"){?>Enter a valid phone number (only digits)<?php } else {?>Inserisci un numero di telefono corretto (solo numeri)<?php }?>');
				else if (Filtro.test(document.sendRequest.email.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
										
				else if (document.sendRequest.privacy.value=="0") alert('<?php if($lingua=="eng"){?>Privacy required<?php } else {?>Autorizzazione della privacy obbligatoria<?php }?>');
				else document.sendRequest.submit();
			}

		</script>
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