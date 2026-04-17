@php
    // Definiamo la query qui una volta sola per tutto il file
    $query_pag_azzurra = DB::table('azzurra_pagine')
        ->select('id', 'titolo', 'titolo_eng')
        ->orderBy('id', 'ASC')
        ->get();
@endphp
<style>
.blockModLeft, .blockModRight{
	width:150px;
}
.blockClock{
	width:150px; 
	height:86px; 
	margin-top:2px; 
	margin-left:10px;  
	display:flex; 
	align-items:center;
}
.logoRolexMob{
	width:65px; 
	height:49.4px; 
	margin-top:5px; 
	margin-left:15px;
}
.blockLogoMob{
	width:calc(100% - 300px); 
	text-align:center; 
	align-items:center;
}
.blockTopRightMob{
	width:135px; 
	margin-right:10px; 
	border-bottom: solid 1px #aaa; 
	display:flex; gap:15px; 
	padding-bottom:4px;
}
@media screen AND (max-width:479px){
	.blockModLeft, .blockModRight{
		width:80px;
	}
	.blockClock{
		width:80px;
		padding-right:0px;
		flex-direction: column;
		margin-left:-8px; 
		margin-top:-15px;		
	}
	.logoRolexMob{
		margin-top:10px; 
	}
	.blockLogoMob{
		width:calc(100% - 160px); 
	}
}
@media screen AND (max-width:370px){
	.blockSocialMob{display:none !important;}	
	.blockTopRightMob{
		width:55px; 
	}
}
</style>
<div style="position:fixed; width:100%; height:120px; display:flex; align-items:center; background:#fff; z-index:1000">
	<div class="blockModLeft">
		<div style="height:110px; margin-top:10px;">
			<div class="blockClock">
				<div style="width:55px; height:55px;">
					<iframe src="https://static.rolex.com/clocks/2022/YCCS_mobile_en_HTML_65x65/rolex.html" style="width:65px;height:65px;border:0;margin:0;padding:0;overflow:hidden;scroll:none" SCROLLING=NO frameborder="NO"></iframe>
				</div>
				<div class="logoRolexMob">
					<img src="{{ smartAsset('web/images/rolex_logo.png') }}" style="width:100%" alt="Rolex - Official Timepiece"/>
				</div>
			</div>
		</div>
	</div>
	<div class="blockLogoMob">
		<a href="/"><img src="{{ smartAsset('web/images/Logo_YCCS.png') }}" style="max-width:290px !important; min-width:160px !important; width:90%; " alt="Yacht Club Costa Smeralda"/></a>
	</div>
	<div class="blockModRight">
		<div style="width:100%; height:22px; margin-top:10px;  display:flex; justify-content:flex-end">
			<div class="blockTopRightMob">
				<div style="display:flex; gap:5px; align-items:center" class="blockSocialMob">
					<a href="https://www.instagram.com/yccs_portocervo/" target="_blank" title="<?php if($lingua=="ita"){?>Segui Yccs Porto Cervo su<?php }else{?>Follow Yccs Porto Cervo on<?php }?> Instagram"><img src="{{ smartAsset('web/images/icon_instagram.png') }}" style="width:17px;" alt="Instagram"/></a>
					<a href="https://www.youtube.com/user/YCCostaSmeralda" target="_blank" title="<?php if($lingua=="ita"){?>Segui Yccs Porto Cervo su<?php }else{?>Follow Yccs Porto Cervo on<?php }?> YouTube"><img src="{{ smartAsset('web/images/icon_youtube.png') }}" style="width:18px;" alt="YouTube"/></a>
					<a href="https://twitter.com/YccsPortoCervo" target="_blank" title="<?php if($lingua=="ita"){?>Segui Yccs Porto Cervo su<?php }else{?>Follow Yccs Porto Cervo on<?php }?> X"><img src="{{ smartAsset('web/images/icon_x.png') }}" style="width:18px;" alt="X"/></a>
				</div>
				<div style="display:flex; gap:5px">
					<?php if($lingua=="ita"){?>
						<img src="{{ smartAsset('web/images/icon_Italy.png') }}" style="width:25px; opacity:0.4;" alt="Italiano"/>
					<?php }else{?>
						<a href="{{ $this_page_path_ita }}" title="{{ config('app.name') }} - Versione Italiana">
							<img src="{{ smartAsset('web/images/icon_Italy.png') }}" style="width:25px;" alt="Italiano"/>
						</a>
					<?php }?>
					
					<?php if($lingua=="eng"){?>
						<img src="{{ smartAsset('web/images/icon_gb.png') }}" style="width:25px; opacity:0.4;" alt="English"/>
					<?php }else{?>
						<a href="{{ $this_page_path_eng }}" title="{{ config('app.name') }} - English Version">	
							<img src="{{ smartAsset('web/images/icon_gb.png') }}" style="width:25px;" alt="English"/>
						</a>
					<?php }?>
				</div>
			</div>
		</div>
		<div style="width:100%; height:88px; text-align:right; display:flex; align-items:flex-end" onclick="toggleMenu();">
			<div style="position:relative; width:calc(100% - 10px); height:40px; margin-right:10px; margin-top:20px;">
				<img src="{{ smartAsset('web/images/icon_menu.jpg') }}" id="iconMenuBar" style="width:40px; height:40px; position:absolute; bottom:20px; right:0; transition: all 0.5s ease">			
				<img src="{{ smartAsset('web/images/close.png') }}" id="iconMenuEx" style="width:40px; height:40px; position:absolute; bottom:20px; right:0; opacity:0; transition: all 0.5s ease">			
			</div>
		</div>
	</div>
</div>
<div style="width:100%; height:120px;">

</div>

<style>
	
	#menuMobInnerPanel::-webkit-scrollbar {
	  display: none;
	}

	#menuMobInnerPanel {
	  -ms-overflow-style: none;  /* IE and Edge */
	  scrollbar-width: none;  /* Firefox */
	}
	.subMenuMob{
		opacity:0 !important; 
		visibility:hidden !important; 
		top:0px !important; 
		right:-65px !important; 
		left:auto !important;
		width:200px;
		position:relative !important;
		overflow:hidden;
		height:0px;
		margin-bottom:0px;
		padding:0 !important;
		transition: all 1s ease, opacity 1s ease, transform 1s ease;
		transform: translateX(20px)
	}
	.subMenuMob a{
		padding:6px 10px !important;
		line-height:14px;
	}
	.subMenuMob.show {
		opacity: 1 !important;
		visibility: visible !important;
		height: auto !important;
		padding: 10px 0 !important;
		margin-bottom: 20px !important;
		right: 0px !important;
		transition: all 1s ease, opacity 1s ease, transform 1s ease;
		transform: translateX(45px);
	}

</style>
<div id="menuMobPanel" style="position:fixed; width:280px; height:calc(100% - 120px); top:120px; right:-300px;  background:white; z-index:1000; box-shadow: 4px 4px 25px 0px rgba(0, 0, 0, 0.1); transition: all 0.5s ease;">
	<div id="menuMobInnerPanel" style="width:calc(100% - 40px);  height:calc(100% - 40px); padding:20px; text-align:right; overflow-y:scroll;">
		<div class="">
			<div style="padding:5px 0">
				<a style="cursor:pointer; color:#000;" class="menuVoice"><?php if($lingua=="ita"){?>Lo YCCS<?php }else{?>YCCS<?php }?></a>
				<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
			</div>
			<div class="subMenu subMenuMob">
				<?php echo voceMenu("La Storia","YCCS History","Lo YCCS","YCCS","lo-yccs/la-storia.html", $lingua); ?>
				<?php echo voceMenu("Consiglio Direttivo","Board of Directors","Lo YCCS","YCCS","lo-yccs/consiglio_direttivo.html", $lingua); ?>
				<?php echo voceMenu("Club Gemellati","Twinned YCCSs","Lo YCCS","YCCS","lo-yccs/club_gemellati.html", $lingua); ?>
				<?php echo voceMenu("Club con reciprocità","Clubs with reciprocity","Lo YCCS","YCCS","lo-yccs/club_con_reciprocita.html", $lingua); ?>						
				
				<div style="padding:5px 25px 5px 0;">
					<a style="cursor:pointer; color:#000;" class="menuVoice" style="font-weight:bold;">Azzurra</a>
					<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
				</div>
				<div class="subMenu subMenuMob">
					<a href="<?php echo ($lingua=="eng") ? "en/" : ""; ?>azzurra/40_anni_di_azzurra.html"><?php echo ($lingua=="ita") ? "40 Anni di Azzurra" : "40 Years of Azzurra"; ?></a>
					@foreach($query_pag_azzurra AS $value)
						@php
							$tit_p = ($lingua=="eng" && !empty($value->titolo_eng)) ? $value->titolo_eng : $value->titolo;
							$lnk_p = ($lingua=="eng" ? "en/" : "") . "azzurra/".creaSlug($tit_p)."-".$value->id.".html";
						@endphp									
						<a href="{{ url($lnk_p) }}">{!! $tit_p !!}</a>									
					@endforeach
				</div>
			</div>
			
			@if($cmd!="dettaglio_regata")
				<div style="padding:5px 0">
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>regate-2025.html" class="menuVoice"><?php if($lingua=="ita"){?>Regate<?php }else{?>Regattas<?php }?></a>
				</div>
			@else
				<div style="padding:5px 0">
					<a style="cursor:pointer; color:#000;" class="menuVoice"><?php if($lingua=="ita"){?>Regate<?php }else{?>Regattas<?php }?>  {{ $anno_regata }}</a>
					<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
				</div>
				<div class="subMenu subMenuMob">
					@php
						$query_c = DB::table('edizioni_regate');
						$query_c = $query_c->select('*');
						$query_c = $query_c->where('anno','=',$anno_regata);
						$query_c = $query_c->orderby('data_dal','ASC');
						$query_c = $query_c->get();
					@endphp
					
					@foreach($query_c AS $key_c=>$value_c)
						@php
							$link_regata = "regate-".$anno_regata."/".creaSlug($value_c->nome_regata)."-".$value_c->id.".html";
							if($lingua=="eng")
								$link_regata = "en/".$link_regata;
							$title_regata = $value_c->nome_regata." - ".config('app.name');
						@endphp
						<a href="{{ $link_regata }}" title="{{ $title_regata }}" style="line-height:15px; padding-top:5px; padding-bottom:5px;">
							<?php if($value_c->id==$value_ed->id){?><strong><?php }?>
								{!! $value_c->nome_regata !!}
							<?php if($value_c->id==$value_ed->id){?></strong><?php }?>
						</a>			
					@endforeach
				</div>
			@endif
			@if($cmd=="dettaglio_regata")
				<div style="padding:5px 0">
					<a style="cursor:pointer; color:#000;" class="menuVoice"><?php if($lingua=="ita"){?>Edizioni<?php }else{?>Editions<?php }?></a>
					<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
				</div>
				<div class="subMenu subMenuMob">
					<div style="display:flex; flex-wrap: wrap;">
						@php
							$query_anni = DB::table('edizioni_regate');
							$query_anni = $query_anni->select('id', 'anno');
							$query_anni = $query_anni->where('id_regata', $value_ed->id_regata);
							$query_anni = $query_anni->where('visibile', '=', '1');
							$query_anni = $query_anni->orderby('anno','DESC');
							$query_anni = $query_anni->get();
						@endphp
						@foreach($query_anni AS $key_anni=>$value_anni)
							@php
								$link_anno = "regate";								
								if($lingua=="eng") $link_anno = "en/regattas";
								$link_anno .= "-".$value_anni->anno."/".creaSlug($value_ed->nome_regata,"")."-".$value_anni->id.".html";
							@endphp
							<a href="{{ $link_anno }}" style="width:65px; text-align:center;">
								<?php if($value_anni->anno==$anno_regata){?><strong><?php }?>
									<?php echo $value_anni->anno;?>
								<?php if($value_anni->anno==$anno_regata){?></strong><?php }?>
							</a>								
						@endforeach
					</div>
				</div>
			@endif
			
			<div style="padding:5px 0">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs-sailing-school.html" title="YCCS Sailing School" class="menuVoice">
					<?php if($lingua=="ita"){?>Scuola Vela<?php }else{?>Sailing School<?php }?>
				</a>
			</div>
			
			<div style="padding:5px 0">
				<a style="cursor:pointer; color:#000;" class="menuVoice">Young Azzurra</a>
				<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
			</div>
			<div class="subMenu subMenuMob">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra.html" title="Young Azzurra">Homepage</a>
				@if($conferenza)
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/atleti.html" title="Young Azzurra - Atleti Young Azzurra">Atleti Young Azzurra</a>
				@else
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/team.html" title="Young Azzurra - Team">Team</a>
				@endif
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/news.html" title="Young Azzurra - News">News</a>
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/photogallery.html" title="Young Azzurra - Photogallery">Photogallery</a>
				@php
					$query_stato = DB::table('ya_elements')
						->select('videogallery')
						->where('id','=','1')
						->get();
					$stato_videogallery = $query_stato[0]->videogallery;
				@endphp
				@if($stato_videogallery==1)
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/video_gallery.html" title="Young Azzurra - Video Gallery">Video Gallery</a>
				@endif
				@php
					$query_stato = DB::table('ya_elements')
						->select('risultati')
						->where('id','=','1')
						->get();
					$stato_risultati = $query_stato[0]->risultati;
				@endphp
				@if($stato_risultati==1)
					<li > <a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/risultati.html" title="Young Azzurra - <?php if($lingua=="ita"){?>Risultati<?php }else{?>Results<?php }?>"><?php if($lingua=="ita"){?>Risultati<?php }else{?>Results<?php }?></a></li>									
				@endif
			</div>
			
			
			
			<div style="padding:5px 0">
				<a style="cursor:pointer; color:#000;" class="menuVoice"><?php if($lingua=="ita"){?>I Servizi<?php }else{?>Services<?php }?></a>
				<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
			</div>
			<div class="subMenu subMenuMob">
				<?php echo voceMenu("Hotel Yacht Club Costa Smeralda","Hotel Yacht Club Costa Smeralda","I Servizi","Services","servizi/hotel-yacht-club-costa-smeralda.html", $lingua); ?>
				<?php echo voceMenu("YCCS Wellness Center & Spa","YCCS Wellness Center & Spa","I Servizi","Services","servizi/yccs-wellness-center.html", $lingua); ?>
				<?php echo voceMenu("La Piazza Azzurra","Piazza Azzurra","I Servizi","Services","servizi/la-piazza-azzurra.html", $lingua); ?>
			</div>
			
			
			<div style="padding:5px 0">
				<a style="cursor:pointer; color:#000;" class="menuVoice"><?php if($lingua=="ita"){?>Sostenibilità<?php }else{?>Sustainability<?php }?></a>
				<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
			</div>
			<div class="subMenu subMenuMob">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs_e_sostenibilita/one-ocean.html" title="<?php if($lingua=="ita"){?>YCCS e Sostenibilità - One Ocean<?php }else{?>YCCS and Sustainability - One Ocean<?php }?>">One Ocean</a>
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs_e_sostenibilita/yccs_sostenibilita.html" title="<?php if($lingua=="ita"){?>YCCS e Sostenibilità<?php }else{?>YCCS and Sustainability<?php }?>"><?php if($lingua=="ita"){?>YCCS e Sostenibilità<?php }else{?>YCCS and Sustainability<?php }?></a>
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs_e_sostenibilita/charta_smeralda.html" title="<?php if($lingua=="ita"){?>YCCS e Sostenibilità - Charta Smeralda<?php }else{?>YCCS and Sustainability - Charta Smeralda<?php }?>"><?php if($lingua=="ita"){?>Charta Smeralda<?php }else{?>Charta Smeralda<?php }?></a>
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs_e_sostenibilita/yccs_clean_beach_day.html" title="<?php if($lingua=="ita"){?>YCCS e Sostenibilità - YCCS Clean Beach Day<?php }else{?>YCCS and Sustainability - YCCS Clean Beach Day<?php }?>"><?php if($lingua=="ita"){?>YCCS Clean Beach Day<?php }else{?>YCCS Clean Beach Day<?php }?></a>
			</div>
			
			<div style="padding:5px 0">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>meteo.html" title="YCCS Sailing School" class="menuVoice">
					Meteo
				</a>
			</div>
			
			<div style="padding:5px 0">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>press.html" title="Press" class="menuVoice">
					Press
				</a>
			</div>
			
			<div style="padding:5px 0">
				<a style="cursor:pointer; color:#000;" class="menuVoice">{{ Lang::get('website.area soci') }}</a>
				<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
			</div>
			<div class="subMenu subMenuMob">
				@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"]=="si")
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/benvenuto.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Benvenuto<?php }else{?>Welcome<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Benvenuto<?php }else{?>Welcome<?php }?></a>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/comunicazioni-ai-soci.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Comunicazioni ai Soci<?php }else{?>Member Communications<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Comunicazioni ai Soci<?php }else{?>Member Communications<?php }?></a>
					<?php /*<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/regate-interclub.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Regate Interclub<?php }else{?>Interclub Regattas<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Regate Interclub<?php }else{?>Interclub Regattas<?php }?></a>*/?>
					@if($_SERVER['REMOTE_ADDR'] == "93.45.34.21")
						<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/centro-sportivo.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Centro Sportivo<?php }else{?>Sports Center<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Centro Sportivo<?php }else{?>Sports Center<?php }?></a>
					@endif
					@php
						$query_stato = DB::table('statuto')
							->select('pdf', 'pdf_eng')
							->where('id','=','1')
							->get();
						$file_statuto = $query_stato[0]->pdf;
						if($lingua=="eng" && trim($query_stato[0]->pdf_eng)!="") $file_statuto = $query_stato[0]->pdf_eng;
					@endphp
					@if(trim($file_statuto)!="")
						<a style="color:#000" class="openStatuto openStatutoBott"  title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Statuto<?php }else{?>Statute<?php }?> - {{ config('app.name') }}">
							<?php if($lingua=="ita"){?>Statuto<?php }else{?>Statute<?php }?>
						</a>
						<script type="text/javascript">
							$(document).ready(function () {
								$(".openStatuto").flipBook({
									pdfUrl:"{{ config('app.url') }}/vedi_allegati.php?lingua=<?php echo $lingua;?>&file=<?php echo $file_statuto;?>",
									lightBox:true
								});
							})
						</script>
					@endif
					@php
						$query_f = DB::table('regolamento_interno')
							->select('pdf', 'pdf_eng')
							->where('id','=','1')
							->get();
						$file_reg = $query_f[0]->pdf;
						if($lingua=="eng" && trim($query_f[0]->pdf_eng)!="") $file_reg = $query_f[0]->pdf_eng;
					@endphp
					@if(trim($file_reg)!="")									
						<a style="color:#000" class="openReg openRegBott" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Regolamento Interno<?php }else{?>Internal Rules<?php }?> - {{ config('app.name') }}">
							<?php if($lingua=="ita"){?>Regolamento Interno<?php }else{?>Internal Rules<?php }?>
						</a>
						<script type="text/javascript">
							$(document).ready(function () {
								$(".openReg").flipBook({
									pdfUrl:"{{ config('app.url') }}/vedi_allegati.php?lingua=<?php echo $lingua;?>&file=<?php echo $file_reg;?>",
									lightBox:true
								});
							})
						</script>
					@endif 
					<a  style="color:#000"class="openOrariServizi openRegBott" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Codice di Comportamento Etico<?php }else{?>Code of Ethical Conduct<?php }?> - {{ config('app.name') }}">
						<?php if($lingua=="ita"){?>Orari Servizi e Modalità Frequentazione<?php }else{?>Season Opening Times and Rules for use of the facilities<?php }?>
					</a>
					<script type="text/javascript">
						$(document).ready(function () {
							$(".openOrariServizi").flipBook({
								pdfUrl:"{{ config('app.url') }}/vedi_pdf_public.php?file={{ $lingua=='ita' ? 'Orari_dei_servizi_2025_e_modalità_di_frequentazione.pdf' : '2025_Season_Opening-Times_and_Rules_for_use_of_the_facilities.pdf' }}",
								lightBox:true
							});
						})
					</script>
					<a style="color:#000" class="openCodiceComportamento openRegBott" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Codice di Comportamento Etico<?php }else{?>Code of Ethical Conduct<?php }?> - {{ config('app.name') }}">
						<?php if($lingua=="ita"){?>Codice di Comportamento Etico<?php }else{?>Code of Ethical Conduct<?php }?>
					</a>
					<script type="text/javascript">
						$(document).ready(function () {
							$(".openCodiceComportamento").flipBook({
								pdfUrl:"{{ config('app.url') }}/vedi_pdf_public.php?file={{ $lingua=='ita' ? 'Codice_di_comportamento_Etico_e_MOG_YCCS.pdf' : 'Codice_di_comportamento_Etico_e_MOG_YCCS(en-GB).pdf' }}",
								lightBox:true
							});
						})
					</script>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/certificato-di-guidone.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Certificato di Guidone<?php }else{?>Burgee Certificate<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Certificato di Guidone<?php }else{?>Burgee Certificate<?php }?></a>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/la-boutique.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>La Boutique<?php }else{?>Boutique<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>La Boutique<?php }else{?>Boutique<?php }?></a>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/carrello.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Carrello<?php }else{?>Cart<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Carrello<?php }else{?>Cart<?php }?></a>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/i-miei-ordini.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>I Miei Ordini<?php }else{?>My Orders<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>I Miei Ordini<?php }else{?>My Orders<?php }?></a>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/profilo-socio.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Profilo Socio<?php }else{?>Member Profile<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Profilo Socio<?php }else{?>Member Profile<?php }?></a>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/pagamento-quota.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Pagamento Quota<?php }else{?>Fee Payment<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Pagamento Quota<?php }else{?>Fee Payment<?php }?></a>
					
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/logout.html" title="Area Soci - <?php if($lingua=="ita"){?>ESCI<?php }else{?>LOGOUT<?php }?> - {{ config('app.name') }}">
						<div class="btn btn-dark btn-xs"><?php if($lingua=="ita"){?>ESCI<?php }else{?>LOGOUT<?php }?></div>
					</a>
					
				@else
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/login.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>ACCEDI<?php }else{?>Login<?php }?> - {{ config('app.name') }}"><span class="label label-danger" style="padding:5px; font-size:1em; background:#00aeef; border-radius:2px; color:#fff"><?php if($lingua=="ita"){?>ACCEDI<?php }else{?>LOGIN<?php }?></span></a>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/registrazione.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Registrati<?php }else{?>Register<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Registrati<?php }else{?>Register<?php }?></a>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/recupera-password.html" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Recupera Password<?php }else{?>Password Recovery<?php }?> - {{ config('app.name') }}" ><?php if($lingua=="ita"){?>Recupera Password<?php }else{?>Password Recovery<?php }?></a>
				@endif
			</div>
			
			<div style="padding:5px 0; margin-top:20px;">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>news.html" class="menuVoice" style="margin-top:25px;">News</a>
				<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px; opacity:0;" alt=""/>
			</div>
			<div style="padding:5px 0">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>magazine.html" class="menuVoice" style="margin-top:25px;">Magazine</a>
				<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px; opacity:0;" alt=""/>
			</div>
			<div style="padding:5px 0">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>sail_talk.html" class="menuVoice" style="margin-top:25px;">Sail Talk</a>
				<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px; opacity:0;" alt=""/>
			</div>
			<div style="padding:5px 0">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs-app.html" class="menuVoice" style="margin-top:25px;">YCCS App</a>
				<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px; opacity:0;" alt=""/>
			</div>
			
			<div style="display:flex; gap:10px; align-items:center; margin-top:20px; margin-right:10px; justify-content:flex-end">
				<a href="https://www.instagram.com/yccs_portocervo/" target="_blank" title="<?php if($lingua=="ita"){?>Segui Yccs Porto Cervo su<?php }else{?>Follow Yccs Porto Cervo on<?php }?> Instagram"><img src="{{ smartAsset('web/images/icon_instagram.png') }}" style="width:17px;" alt="Instagram"/></a>
				<a href="https://www.youtube.com/user/YCCostaSmeralda" target="_blank" title="<?php if($lingua=="ita"){?>Segui Yccs Porto Cervo su<?php }else{?>Follow Yccs Porto Cervo on<?php }?> YouTube"><img src="{{ smartAsset('web/images/icon_youtube.png') }}" style="width:18px;" alt="YouTube"/></a>
				<a href="https://twitter.com/YccsPortoCervo" target="_blank" title="<?php if($lingua=="ita"){?>Segui Yccs Porto Cervo su<?php }else{?>Follow Yccs Porto Cervo on<?php }?> X"><img src="{{ smartAsset('web/images/icon_x.png') }}" style="width:18px;" alt="X"/></a>
			</div>
		</div>
	</div>
</div>
<script>	
	var menu=0;
	function toggleMenu(){
		if(menu==0){
			menu=1;
			document.getElementById('iconMenuBar').style.opacity='0';
			document.getElementById('iconMenuEx').style.opacity='1';
			document.getElementById('menuMobPanel').style.right='0px';
		}else{
			menu=0;
			document.getElementById('iconMenuBar').style.opacity='1';
			document.getElementById('iconMenuEx').style.opacity='0';
			document.getElementById('menuMobPanel').style.right='-300px';
		}
	}
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
	const menuVoices = document.querySelectorAll('.menuVoice');

	menuVoices.forEach((voice, index) => {
		voice.addEventListener('click', function (e) {
			const currentSubMenu = this.parentElement.nextElementSibling;

			// Se NON esiste un subMenu accanto, lascia funzionare il link
			if (!currentSubMenu || !currentSubMenu.classList.contains('subMenuMob')) {
				return; // esegui comportamento normale (vai al link)
			}

			// Altrimenti blocca click e gestisci apertura sottomenu
			e.preventDefault();

			const allSubmenus = document.querySelectorAll('.subMenuMob');

			// Chiude tutti i subMenu tranne quello cliccato e i suoi antenati (es. Lo YCCS quando apri Azzurra)
			allSubmenus.forEach(sub => {
				if (sub !== currentSubMenu && !sub.contains(currentSubMenu)) {
					sub.classList.remove('show');
				}
			});

			// Toggle apertura/chiusura submenu attuale
			currentSubMenu.classList.toggle('show');
		});
	});
});
</script>