@extends('web.index')

@php
	$lingua="ita";
	$colore="red";
@endphp

@section('content')
	@php		
		$video_background = "web/video/video_test.mp4";
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.il club'); $breadcrumbs[$x]['link']='';
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	@include('web.assets.la_storia_css')

	<div id="pagContainer">
		<div style="width:100%; display:flex; gap:35px;">
			<h3 class="gradient-title">{{ $page_title }}</h3>
			<div style="flex:1;">
				<div class="link-arrow" style="width:163px !important; gap:47px !important; margin-top:30px; padding-left:calc(100% - 163px); padding-bottom:7px; border-bottom:solid 2px;">
				 
				</div>
			</div>
		</div>
			
		<div style="width:100%;display:flex; margin-bottom:30px;">
			<div style="flex:1; height:100%;  position:relative;">
				<div>
					<div style="padding:50px 0 25px; ">
						<?php if($lingua=="ita"){?>
							<p style="margin-top:0;">Il centro sportivo dello Yacht Club Costa Smeralda, disponibile esclusivamente per i Soci, è posizionato nella parte finale del canale della Marina nuova di Porto Cervo, sulla sinistra. Un guidone YCCS ne segnala la posizione.</p>
						<?php }else{?>
							<p style="margin-top:0;">The Yacht Club Costa Smeralda’s Sports Centre, open only to YCCS Members, is located at the back of Porto Cervo’s Marina Nuova and can be identified by the YCCS burgee flying above it.</p>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
		
		<div style="width:100%;display:flex; gap:50px; align-items:center; margin-bottom:30px;">
			<div style="flex:1; height:100%;  position:relative;">
				<a href="web/images/mappa_porto_cervo_marina.jpg" class="glightbox">
					<img alt="{{ $lingua=='ita' ? 'Mappa' : 'Map' }}" style="width:100%;" src="web/images/mappa_porto_cervo_marina.jpg" />
				</a>
			</div>
			<div style="flex:1; height:100%;  position:relative;">
				<?php if($lingua=="ita"){?>
					<span style="font-weight:600">INFO TECNICHE &nbsp;</span><br /><br />
					Dotato di 16 posti barca,<br/>
					può ospitare di norma imbarcazioni fino ai 20 mt, occasionalmente può ormeggiare qualche imbarcazione di 25 mt.<br/>
					Pescaggio 2,80 mt.<br/><br/>
					
					<a href="files/mappa Porto Cervo Marina.pdf" class="link-arrow" style="width:160px; margin-top:12px; margin-right:20px;">
						<span>Scarica Mappa</span>
						<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
					</a>
				<?php }else{?>
					<span style="font-weight:600">TECHNICAL INFORMATION &nbsp;</span><br /><br />
					The centre has 16 berths and can host yachts of up to 20 metres. At certain times it may be possible to host yachts of up to 25 metres. Maximum draught is 2.8 metres.<br/><br/>
					
					<a href="files/mappa Porto Cervo Marina.pdf" class="link-arrow" style="width:160px; margin-top:12px; margin-right:20px;">
						<span>Download Map</span>
						<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
					</a>
				<?php }?>
			</div>
		</div>
		
		<div style="margin:50px 0;" data-title="Programma" data-margin="0" data-space="1-1" class="link-regata" onclick="window.location='<?php if($lingua!="ita"){?>en/<?php }?>yccs-porto-cervo/reservation-request.html'">
			<div style="display:flex; z-index:1; align-items:center; justify-content:space-between;">
				<h4>RESERVATION REQUEST</h4>
				<img src="{{ asset('web/images/freccia_thin_up.png') }}" class="arrow-link-regata">
				<img src="{{ asset('web/images/close.png') }}" class="close-link-regata">
			</div>
		</div>
		
		<div style="display:flex; gap:50px">
			<?php if($lingua=="ita"){?>
				<div style="flex:1">
					<p><strong>SERVIZI</strong></p>
					<p>I soci e gli ospiti le cui barche ormeggiano al centro sportivo possono usufruire di ampi parcheggi, bagni, docce, macchina del ghiaccio e un gazebo accogliente per un momento di relax. Per i servizi aggiuntivi, ad esempio alaggio, disalberamento, manutenzione, richiedere un preventivo. Il centro sportivo ha a disposizione una gru che può sollevare imbarcazioni fino a 1700 kg.</p>
				</div>
				<div style="flex:1">
					<p><strong>CONTATTI</strong></p>
					<p>Prima di avvicinarsi all’area ormeggi, è consigliabile mettersi in contatto con il Centro Sportivo tramite VHF o telefono cellulare.</p>
					<p><span style="font-weight:600">VHF</span>: canale 74 dalle 9.00 alle 20.00</p>
					<p><span style="font-weight:600">Centralino</span> - +39 0789 902200</p>
					<p><span style="font-weight:600">Mobile</span> - + 39 346 7963401 (Alessandro Sorgia)</p>
					<p>
						<span style="font-weight:600">Email</span> - <span id="cloak82179">Questo indirizzo email è protetto dagli spambots. È necessario abilitare JavaScript per vederlo.</span>
						<script type='text/javascript'>
						 //<!--
						 document.getElementById('cloak82179').innerHTML = '';
						 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
						 var path = 'hr' + 'ef' + '=';
						 var addy82179 = 'c&#101;ntr&#111;sp&#111;rt&#105;v&#111;' + '&#64;';
						 addy82179 = addy82179 + 'yccs' + '&#46;' + '&#105;t';
						 document.getElementById('cloak82179').innerHTML += '<a class="azzurro" ' + path + '\'' + prefix + ':' + addy82179 + '\'>' + addy82179+'<\/a>';
						 //-->
						</script>
					</p>			
				</div>
			<?php }else{?>
				<div style="flex:1">
					<p><strong>SERVICES</strong></p>
					<p>Members with boats berthed at the Sports Centre have access to car parking, bathrooms, showers, an ice machine and a gazebo in which to relax. Additional services such as haul out and launch, dismasting and maintenance can be provided, please ask for a quotation. The centre has a crane which can lift boats of up to 1700kg.</p>
				</div>
				<div style="flex:1">
					<p><strong>CONTACTS</strong></p>
					<p>Before approaching the morring area please contact the Sports Centre by VHF or phone.</p>
					<p><span style="font-weight:600">VHF</span>: channel 74 from 9 a.m. to 8 p.m.</p>
					<p><span style="font-weight:600">Contact Center</span> - +39 0789 9731001</p>
					<p><span style="font-weight:600">Mobile</span> - + 39 346 7963401 (Alessandro Sorgia) – on call 24h</p>
					<p>
						<span style="font-weight:600">Email</span> - <span id="cloak82179">This email address is being protected from spambots. You need JavaScript enabled to view it.</span>
						<script type='text/javascript'>
						 //<!--
						 document.getElementById('cloak82179').innerHTML = '';
						 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
						 var path = 'hr' + 'ef' + '=';
						 var addy82179 = 'c&#101;ntr&#111;sp&#111;rt&#105;v&#111;' + '&#64;';
						 addy82179 = addy82179 + 'yccs' + '&#46;' + '&#105;t';
						 document.getElementById('cloak82179').innerHTML += '<a class="azzurro" ' + path + '\'' + prefix + ':' + addy82179 + '\'>' + addy82179+'<\/a>';
						 //-->
						</script>
					</p>			
				</div>
			<?php }?>
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