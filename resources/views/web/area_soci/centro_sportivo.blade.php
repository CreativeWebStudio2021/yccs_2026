@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/centro_sportivo.jpg";
		    $video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.'.$pagina.' nome pagina');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
            $x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
			
		@endphp
		@include('web.common.page_title')
		
		<style>
			.list-group-item.list-group-item-com {
				background:#fff;
				color:#555555;
			}
			.list-group-item.list-group-item-com:hover{
				background:#F5F5F5;
				color:#555555;
			}
		</style>
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-7">
						<div style="width:100%; display:flex; gap:35px;">
							<h3 class="gradient-title">{{ $page_title }}</h3>
							<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
						</div>
						<div style="">
                            @if($lingua=="ita")
                                <p>Il centro sportivo dello Yacht Club Costa Smeralda, disponibile esclusivamente per i Soci, è posizionato nella parte finale del canale della Marina nuova di Porto Cervo, sulla sinistra. Un guidone YCCS ne segnala la posizione.</p>
                                <p>&nbsp;</p>
                                
                                <div class="row">
                                    <div class="col-md-4" style="">
                                        <div class="grid-item">
                                            <div class="grid-item-wrap">
                                                <div class="grid-image"> 
                                                    <img alt="{{ $lingua=='ita' ? 'Mappa' : 'Map' }}" src="web/images/mappa_porto_cervo_marina.jpg" />
                                                </div>
                                                <div class="grid-description">
                                                    <a title="{{ $lingua=='ita' ? 'Mappa' : 'Map' }}" data-lightbox="image" href="web/images/mappa_porto_cervo_marina.jpg" class="btn btn-light btn-rounded">Zoom</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-7 m-t-30">
                                        <strong>INFO TECNICHE &nbsp;</strong><br />
                                        Dotato di 16 posti barca,<br/>
                                        può ospitare di norma imbarcazioni fino ai 20 mt, occasionalmente può ormeggiare qualche imbarcazione di 25 mt.<br/>
                                        Pescaggio 2,80 mt.<br/><br/>
                                        <a href="files/mappa Porto Cervo Marina.pdf" class="btn btn-sm" target="_blank"><b>Scarica Mappa</b></a>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                                <p>&nbsp;</p>
                                
                                <p><a href="area-soci/reservation-request.html" class="btn"><strong>RESERVATION REQUEST</strong></a></p>
                                <p><strong>SERVIZI</strong></p>
                                <p>I soci e gli ospiti le cui barche ormeggiano al centro sportivo possono usufruire di ampi parcheggi, bagni, docce, macchina del ghiaccio e un gazebo accogliente per un momento di relax. Per i servizi aggiuntivi, ad esempio alaggio, disalberamento, manutenzione, richiedere un preventivo. Il centro sportivo ha a disposizione una gru che può sollevare imbarcazioni fino a 1700 kg.</p>
                                <p><strong>CONTATTI</strong></p>
                                <p>Prima di avvicinarsi all’area ormeggi, è consigliabile mettersi in contatto con il Centro Sportivo tramite VHF o telefono cellulare.</p>
                                <p><strong>VHF</strong>: canale 74 dalle 9.00 alle 20.00</p>
                                <p><strong>Centralino</strong> - +39 0789 902200</p>
                                <p><strong>Mobile</strong> - + 39 346 7963401 (Alessandro Sorgia)</p>
                                <p><strong>Email</strong> - <a href="mailto:centrosportivo@yccs.it">centrosportivo@yccs.it</a></p>
                            @else
                                <p>The Yacht Club Costa Smeralda’s Sports Centre, open only to YCCS Members, is located at the back of Porto Cervo’s Marina Nuova and can be identified by the YCCS burgee flying above it.</p>
                                <p>&nbsp;</p>
                                
                                <div class="row">
                                    <div class="col-md-4" style="">
                                        <div class="grid-item">
                                            <div class="grid-item-wrap">
                                                <div class="grid-image"> 
                                                    <img alt="{{ $lingua=='ita' ? 'Mappa' : 'Map' }}" src="public/web/images/mappa_porto_cervo_marina.jpg" />
                                                </div>
                                                <div class="grid-description">
                                                    <a title="{{ $lingua=='ita' ? 'Mappa' : 'Map' }}" data-lightbox="image" href="public/web/images/mappa_porto_cervo_marina.jpg" class="btn btn-light btn-rounded">Zoom</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-7 m-t-30">
                                        <strong>TECHNICAL INFORMATION &nbsp;</strong><br />
                                        The centre has 16 berths and can host yachts of up to 20 metres. At certain times it may be possible to host yachts of up to 25 metres. Maximum draught is 2.8 metres.<br/><br/>
                                        <a href="files/mappa Porto Cervo Marina.pdf" class="btn btn-sm" target="_blank"><b>Download Map</b></a>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                                <p>&nbsp;</p>
                                
                                <p><a href="en/area-soci/reservation-request.html" class="btn"><strong>RESERVATION REQUEST</strong></a></p>
                                <p><strong>SERVICES</strong></p>
                                <p>Members with boats berthed at the Sports Centre have access to car parking, bathrooms, showers, an ice machine and a gazebo in which to relax. Additional services such as haul out and launch, dismasting and maintenance can be provided, please ask for a quotation. The centre has a crane which can lift boats of up to 1700kg.</p>
                                <p><strong>CONTACTS</strong></p>
                                <p>Before approaching the morring area please contact the Sports Centre by VHF or phone:</p>
                                <p><strong>VHF</strong>: channel 74 from 9 a.m. to 8 p.m.</p>
                                <p><strong>Contact Center</strong> - +39 0789 9731001</p>
                                <p><strong>Mobile</strong> - + 39 346 7963401 (Alessandro Sorgia) – on call 24h</p>
                                <p><strong>Email</strong> - <a href="mailto:centrosportivo@yccs.it">centrosportivo@yccs.it</a></p>
                            @endif
					    </div>						
					</div>
					<div class="content col-lg-1"></div>				
					<!-- end: post content -->
					<!-- Sidebar-->
					<div class="sidebar sticky-sidebar sidebar-modern col-lg-3" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
						<div class="row">
							<div class="content col-lg-12">
								@include('web.common.laterale-area-soci')
							</div>
						</div>
					</div>
					<!-- end: Sidebar-->
				</div>
			</div>
		</section> <!-- end: Content -->
		
	@endsection
@else	
	<script language="javascript">
		window.location = "<?php echo config('app.url');?>/<?php if($lingua=="eng"){?>en/<?php }?>area-soci/login.html";
	</script>
@endif