@php
    // Definiamo la query qui una volta sola per tutto il file
    $query_pag_azzurra = DB::table('azzurra_pagine')
        ->select('id', 'titolo', 'titolo_eng')
        ->orderBy('id', 'ASC')
        ->get();
@endphp

<style>
.menuVoice{
	color:#000;
	font-size:12px;
	font-family: 'Montserrat', sans-serif;
}
#headerYCCS {
    position: fixed;
    top: 0;
    background: #fff;
    width: 100%;
    height: 130px;
    display: flex;
    z-index: 999;
    opacity: 1;
    visibility: visible;
    transition: opacity 0.3s ease, visibility 0.3s ease, box-shadow 0.5s ease;
}

#headerYCCS.hidden {
    opacity: 0;
    visibility: hidden;
}

#headerYCCS.shadow {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.menuWrapper {
	position: relative;
}

.subMenu {
	position: absolute;
	top: 100%;
	left: 0;
	background: #fff;
	box-shadow: 0 4px 10px rgba(0,0,0,0.1);
	border-radius: 6px;
	opacity: 0;
	visibility: hidden;
	transform: translateY(10px);
	transition: all 0.25s ease;
	padding: 10px 0;
	min-width: 200px;
	display: flex;
	flex-direction: column;
	z-index: 1000;
}

.subMenu a {
	padding: 8px 16px;
	font-family: 'Montserrat', sans-serif;
	font-size: 12px;
	line-height:1.3;
	color: #000;
	text-decoration: none;
	transition: background 0.2s;
}

.subMenu a:hover {
	background-color: #f3f3f3;
}

.menuWrapper:hover .subMenu {
	opacity: 1;
	visibility: visible;
	transform: translateY(0);
}
.menuContainerLeftTop{
	width:285px; 
	height:<?php if($_SESSION['version_2025']==1){?>37px<?php }else{?>47px<?php }?>; 
	padding-bottom:5px;
	border-bottom:solid 1px #aaa; 
	margin-left:40px; 
	display:flex; 
	gap:28px;
}
.menuContainerLeft{
	//width:calc(100% - 80px); 
	height:21px; 
	margin-left:40px; 
	margin-bottom:2px; 
	display:flex; 
	gap:33px;
}
.blockLogo{
	width:290px; 
	height:130px;
	position:relative;
}
.logoHeader{
	width:100%; 
	margin-top:30px;
}
.blockRight{
	flex:1; 
	height:130px; 
	display:flex; 
	gap:20px;
}
.menuContainerRigt{
	height:21px;  
	margin-bottom:2px; 
	display:flex; 
	gap:33px; 
	justify-content:right;
}

/* Posizionamento per il sottomenu di secondo livello */
.subMenu .menuWrapper {
    position: relative;
    width: 100%;
}

.subMenu .nestedSubMenu {
    position: absolute;
    top: 0;
    left: 100%; /* Appare a destra del primo sottomenu */
    background: #fff;
    box-shadow: 4px 4px 10px rgba(0,0,0,0.1);
    border-radius: 6px;
    opacity: 0;
    visibility: hidden;
    transform: translateX(10px);
    transform: translateY(-20px);
    transition: all 0.25s ease;
    padding: 10px 0;
    min-width: 220px;
    display: flex;
    flex-direction: column;
    z-index: 1001;
}

/* Effetto Hover per il secondo livello */
.subMenu .menuWrapper:hover > .nestedSubMenu {
    opacity: 1;
    visibility: visible;
    transform: translateX(0px);
}

/* Freccetta indicatrice per voci con sottomenu */
.has-nested::after {
    content: '▶';
    font-size: 15px;
    float: right;
    margin-top: 4px;
    margin-right: 10px;
    color: #aaa;
}

@media screen AND (max-width:1670px){
	.menuContainerLeft{
		gap:15px;
	}
	.menuContainerRigt{
		gap:12px;
	}
}
@media screen AND (max-width:1480px){
	.menuContainerLeftTop{
		margin-left:10px;
		gap:12px;
		width:240px; 
	}
	.menuContainerLeft{
		margin-left:10px; 
		gap:12px;
	}
	.blockRight{
		gap:10px;
	}
	.menuContainerRigt{
		gap:12px;
	}
}
@media screen AND (max-width:1390px){	
	.blockLogo{
		width:200px; 
		margin-top:15px;
		position:absolute;
		left:50%; 
		margin-left:-100px
	}
	.logoHeader{
		position:absolute;
		top:0;
		left:50%;
		margin-left:-100px;
		//tranform:translate(-50%, -50%);
		//width:290px; 
	}
}
@media screen AND (max-width:1100px){	
	.menuContainerLeft{
		width:520px;
		margin-left:5px; 
		gap:8px;
	}
	.menuContainerRigt{
		gap:8px;
	}
}
</style>

<?php 
function voceMenu($nome_ita, $nome_eng, $title_ita, $title_eng, $link_ita, $lingua){
	if($lingua=="ita"){
		return '
			<a href="'.$link_ita.'" title="'.$nome_ita.' - '.$title_ita.' - '.env('APP_NAME').'">
				'.$nome_ita.'
			</a>
		';					
	}else{
		return '
			<a href="en/'.$link_ita.'" title="'.$nome_eng.' - '.$title_eng.' - '.env('APP_NAME').'">
				'.$nome_eng.'
			</a>
		';
	}
}
?>

<div id="headerYCCS">
	<div  style="flex:1; height:130px; display:flex; flex-direction:column;">
		<div class="menuContainerLeftTop">
			<a href="<?php if($lingua=="eng"){?>en/<?php }?>news.html" class="menuVoice" style="margin-top:5px;">News</a>
			<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs-app.html" class="menuVoice" style="margin-top:5px;">YCCS App</a>
			<a href="<?php if($lingua=="eng"){?>en/<?php }?>magazine.html" class="menuVoice" style="margin-top:5px;">Magazine</a>
			<a href="<?php if($lingua=="eng"){?>en/<?php }?>sail_talk.html" class="menuVoice" style="margin-top:5px;">Sail Talk</a>
		</div>
		<div style="flex:1; width:100%;"></div>
		<div class="menuContainerLeft">
			<div style="display:flex; gap:5px; align-items:center;">
				<div class="menuWrapper">
					<div class="menuItem">
						<a style="cursor:pointer;" class="menuVoice"><?php if($lingua=="ita"){?>Lo YCCS<?php }else{?>YCCS<?php }?></a>
						<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
					</div>
					<div class="subMenu">
						<?php echo voceMenu("La Storia","YCCS History","Lo YCCS","YCCS","lo-yccs/la-storia.html", $lingua); ?>
						<?php echo voceMenu("Consiglio Direttivo","Board of Directors","Lo YCCS","YCCS","lo-yccs/consiglio_direttivo.html", $lingua); ?>
						<?php echo voceMenu("Club Gemellati","Twinned YCCSs","Lo YCCS","YCCS","lo-yccs/club_gemellati.html", $lingua); ?>
						<?php echo voceMenu("Club con reciprocità","Clubs with reciprocity","Lo YCCS","YCCS","lo-yccs/club_con_reciprocita.html", $lingua); ?>						
						<div class="menuWrapper">
							<a style="cursor:pointer;" class="has-nested">
								<?php echo ($lingua=="ita") ? "Azzurra" : "Azzurra"; ?>
							</a>
							<div class="nestedSubMenu">
								<a href="<?php echo ($lingua=="eng") ? "en/" : ""; ?>azzurra/40_anni_di_azzurra.html">
									<?php echo ($lingua=="ita") ? "40 Anni di Azzurra" : "40 Years of Azzurra"; ?>
								</a>

								@foreach($query_pag_azzurra AS $value)
									@php
										$tit_p = ($lingua=="eng" && !empty($value->titolo_eng)) ? $value->titolo_eng : $value->titolo;
										$lnk_p = ($lingua=="eng" ? "en/" : "") . "azzurra/".creaSlug($tit_p)."-".$value->id.".html";
									@endphp									
									<a href="{{ url($lnk_p) }}">{!! $tit_p !!}</a>									
								@endforeach
							</div>
						</div>						
					</div>
				</div>
			</div>
			
			<div style="display:flex; gap:5px; align-items:center;">
				@if($cmd!="dettaglio_regata")
					<div class="menuWrapper">
						<div class="menuItem">
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>regate-{{ date('Y') }}.html" class="menuVoice"><?php if($lingua=="ita"){?>Regate<?php }else{?>Regattas<?php }?></a>
						</div>
					</div>
				@else
					<div class="menuWrapper">
						<div class="menuItem">
							<a style="cursor:pointer;" class="menuVoice"><?php if($lingua=="ita"){?>Regate<?php }else{?>Regattas<?php }?> {{ $anno_regata }}</a>
							<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
						</div>
						<div class="subMenu" style="min-width:230px !important;">
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
									$link_regata_eng = "en/regattas-".$anno_regata."/".creaSlug($value_c->nome_regata)."-".$value_c->id.".html";
									if($lingua=="eng")
										$link_regata = $link_regata_eng;
									$title_regata = $value_c->nome_regata." - ".config('app.name');
								@endphp
								<a href="{{ $link_regata }}" title="{{ $title_regata }}" style="line-height:15px; padding-top:5px; padding-bottom:5px;">
									<?php if($value_c->id==$value_ed->id){?><strong><?php }?>
										{!! $value_c->nome_regata !!}
									<?php if($value_c->id==$value_ed->id){?></strong><?php }?>
								</a>			
							@endforeach
						</div>
					</div>
				@endif
			</div>
			@if($cmd=="dettaglio_regata")
				<div style="display:flex; gap:5px; align-items:center;">
					<div class="menuWrapper">
						<div class="menuItem">
							<a style="cursor:pointer;" class="menuVoice"><?php if($lingua=="ita"){?>Edizioni<?php }else{?>Editions<?php }?></a>
							<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
						</div>
						<div class="subMenu">
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
					</div>
				</div>
			@endif
			
			<div style="display:flex; gap:5px; align-items:center;">
				<div class="menuWrapper">
					<div class="menuItem">
						<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs-sailing-school.html" title="YCCS PORTO CERVO - YCCS Sailing School" class="menuVoice">
							<?php if($lingua=="ita"){?>Scuola Vela<?php }else{?>Sailing School<?php }?>
						</a>
					</div>
				</div>
			</div>
			
			<div style="display:flex; gap:5px; align-items:center;">
				<div class="menuWrapper">
					<div class="menuItem">
						<a style="cursor:pointer;" class="menuVoice">Young Azzurra</a>
						<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
					</div>
					<div class="subMenu">
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
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="blockLogo">
		<a href="/"><img src="{{ smartAsset('web/images/Logo_YCCS.png') }}" class="logoHeader" alt="Yacht Club Costa Smeralda"/></a>
	</div>
	
	<div class="blockRight">
		<div style="flex:1; display:flex; flex-direction:column; ">
			<div style="width:100%; height:22px; margin-top:21px;  display:flex; justify-content:flex-end">
				<div style="width:151px; border-bottom: solid 1px #aaa; display:flex; gap:22px; padding-bottom:4px; align-items:center">
					<div style="display:flex; gap:10px; align-items:center">
						<a href="https://www.instagram.com/yccs_portocervo/" target="_blank" title="<?php if($lingua=="ita"){?>Segui Yccs Porto Cervo su<?php }else{?>Follow Yccs Porto Cervo on<?php }?> Instagram"><img src="{{ smartAsset('web/images/icon_instagram.png') }}" style="width:17px;" alt="Instagram"/></a>
						<a href="https://www.youtube.com/user/YCCostaSmeralda" target="_blank" title="<?php if($lingua=="ita"){?>Segui Yccs Porto Cervo su<?php }else{?>Follow Yccs Porto Cervo on<?php }?> YouTube"><img src="{{ smartAsset('web/images/icon_youtube.png') }}" style="width:17px;" alt="YouTube"/></a>
						<a href="https://twitter.com/YccsPortoCervo" target="_blank" title="<?php if($lingua=="ita"){?>Segui Yccs Porto Cervo su<?php }else{?>Follow Yccs Porto Cervo on<?php }?> X"><img src="{{ smartAsset('web/images/icon_x.png') }}" style="width:17px;" alt="X"/></a>
					</div>
					<div style="display:flex; gap:7px">
						<?php if($lingua=="ita"){?>
							<img src="{{ smartAsset('web/images/icon_Italy.png') }}" style="width:25px; height:17px; opacity:0.4;" alt="Italiano"/>
						<?php }else{?>
							<a href="{{ $this_page_path_ita }}" title="{{ config('app.name') }} - Versione Italiana">
								<img src="{{ smartAsset('web/images/icon_Italy.png') }}" style="width:25px; height:17px;" alt="Italiano"/>
							</a>
						<?php }?>
						
						<?php if($lingua=="eng"){?>
							<img src="{{ smartAsset('web/images/icon_gb.png') }}" style="width:25px; height:17px; opacity:0.4;" alt="English"/>
						<?php }else{?>
							<a href="{{ $this_page_path_eng }}" title="{{ config('app.name') }} - English Version">	
								<img src="{{ smartAsset('web/images/icon_gb.png') }}" style="width:25px; height:17px;" alt="English"/>
							</a>
						<?php }?>
					</div>
				</div>
			</div>
			
			<div style="flex:1; width:100%;"></div>
			
			<div class="menuContainerRigt">
				<div style="display:flex; gap:5px; align-items:center;">
					<div class="menuWrapper">
						<div class="menuItem">
							<a style="cursor:pointer;" class="menuVoice"><?php if($lingua=="ita"){?>I Servizi<?php }else{?>Services<?php }?></a>
							<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
						</div>
						<div class="subMenu">
							<?php echo voceMenu("Hotel Yacht Club Costa Smeralda","Hotel Yacht Club Costa Smeralda","I Servizi","Services","servizi/hotel-yacht-club-costa-smeralda.html", $lingua); ?>
							<?php echo voceMenu("YCCS Wellness Center & Spa","YCCS Wellness Center & Spa","I Servizi","Services","servizi/yccs-wellness-center.html", $lingua); ?>
							<?php echo voceMenu("La Piazza Azzurra","Piazza Azzurra","I Servizi","Services","servizi/la-piazza-azzurra.html", $lingua); ?>
						</div>
					</div>
				</div>
				
				<div style="display:flex; gap:5px; align-items:center;">
					<div class="menuWrapper">
						<div class="menuItem">
							<a style="cursor:pointer;" class="menuVoice"><?php if($lingua=="ita"){?>Sostenibilità<?php }else{?>Sustainability<?php }?></a>
							<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
						</div>
						<div class="subMenu">
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs_e_sostenibilita/one-ocean.html" title="<?php if($lingua=="ita"){?>YCCS e Sostenibilità - One Ocean<?php }else{?>YCCS and Sustainability - One Ocean<?php }?>">One Ocean</a>
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs_e_sostenibilita/yccs_sostenibilita.html" title="<?php if($lingua=="ita"){?>YCCS e Sostenibilità<?php }else{?>YCCS and Sustainability<?php }?>"><?php if($lingua=="ita"){?>YCCS e Sostenibilità<?php }else{?>YCCS and Sustainability<?php }?></a>
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs_e_sostenibilita/charta_smeralda.html" title="<?php if($lingua=="ita"){?>YCCS e Sostenibilità - Charta Smeralda<?php }else{?>YCCS and Sustainability - Charta Smeralda<?php }?>"><?php if($lingua=="ita"){?>Charta Smeralda<?php }else{?>Charta Smeralda<?php }?></a>
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs_e_sostenibilita/yccs_clean_beach_day.html" title="<?php if($lingua=="ita"){?>YCCS e Sostenibilità - YCCS Clean Beach Day<?php }else{?>YCCS and Sustainability - YCCS Clean Beach Day<?php }?>"><?php if($lingua=="ita"){?>YCCS Clean Beach Day<?php }else{?>YCCS Clean Beach Day<?php }?></a>							
						</div>
					</div>
				</div>
				
				<div style="display:flex; gap:5px; align-items:center;">
					<div class="menuWrapper">
						<div class="menuItem">
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>meteo.html" title="Meteo" class="menuVoice">
								Meteo
							</a>
						</div>
					</div>
				</div>
				
				<div style="display:flex; gap:5px; align-items:center;">
					<div class="menuWrapper">
						<div class="menuItem">
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>press.html" title="YCCS PORTO CERVO - Press" class="menuVoice">
								Press
							</a>
						</div>
					</div>
				</div>
				
				<div style="display:flex; gap:5px; align-items:center;">
					<div class="menuWrapper">
						<div class="menuItem">
							<a style="cursor:pointer;" class="menuVoice">{{ Lang::get('website.area soci') }}</a>
							<img src="{{ smartAsset('web/images/icon_down.png') }}" style="width:8px;" alt=""/>
						</div>
						<div class="subMenu">
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
									<a  class="openStatuto openStatutoBott" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Statuto<?php }else{?>Statute<?php }?> - {{ config('app.name') }}"><?php if($lingua=="ita"){?>Statuto<?php }else{?>Statute<?php }?></a>
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
									<a  class="openReg openRegBott" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Regolamento Interno<?php }else{?>Internal Rules<?php }?> - {{ config('app.name') }}">
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
								<a class="openOrariServizi openRegBott"  title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Codice di Comportamento Etico<?php }else{?>Code of Ethical Conduct<?php }?> - {{ config('app.name') }}">
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
								
								<a  class="openCodiceComportamento openRegBott" title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Codice di Comportamento Etico<?php }else{?>Code of Ethical Conduct<?php }?> - {{ config('app.name') }}">
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
					</div>
				</div>
			</div>
		</div>
		<div style="width:200px; height:110px; margin-top:10px; border-left:solid 1px #AAA;">
			<div style="width:170px; height:86px; margin-top:2px; margin-left:25px;  display:flex; gap:5px; align-items:center; justify-content:space-between">
				<div style="width:75px; height:57px; ">
					<img src="{{ smartAsset('web/images/rolex_logo.png') }}" style="width:100%" alt="Rolex - Official Timepiece"/>
				</div>
				<div style="width:65px; height:65px;">
					<iframe src="https://static.rolex.com/clocks/2022/YCCS_mobile_en_HTML_65x65/rolex.html" style="width:65px;height:65px;border:0;margin:0;padding:0;overflow:hidden;scroll:none" SCROLLING=NO frameborder="NO"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="width:100%; height:130px;">

</div>
<script>
let lastScrollTop = 0;
const header = document.getElementById('headerYCCS');
let headerHidden = false;
let headerShownByMouse = false;
let hideHeaderTimeout = null;

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop && currentScroll > 150) {
        // Scroll verso il basso: nascondi con fade
        header.classList.add('hidden');
        header.classList.remove('shadow');
        headerHidden = true;
        headerShownByMouse = false;
        if (hideHeaderTimeout) {
            clearTimeout(hideHeaderTimeout);
            hideHeaderTimeout = null;
        }
    } else {
        // Scroll verso l’alto: mostra con fade
        header.classList.remove('hidden');
        if (currentScroll > 0) {
            header.classList.add('shadow');
        } else {
            header.classList.remove('shadow');
        }
        headerHidden = false;
        headerShownByMouse = false;
        // Nascondi dopo 2 secondi se lo scroll si ferma, ma solo se non siamo al top
        if (hideHeaderTimeout) clearTimeout(hideHeaderTimeout);
        if (currentScroll > 0) {
            hideHeaderTimeout = setTimeout(() => {
                if (!headerHidden && !headerShownByMouse && (window.pageYOffset || document.documentElement.scrollTop) > 0) {
                    header.classList.add('hidden');
                    header.classList.remove('shadow');
                    headerHidden = true;
                }
            }, 2000);
        }
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});

// Riappare anche col mouse vicino al top
// E sparisce se si esce dall'header dopo hover top

document.addEventListener('mousemove', (e) => {
    if (e.clientY < 50 && headerHidden) {
        header.classList.remove('hidden');
        header.classList.add('shadow');
        headerHidden = false;
        headerShownByMouse = true;
        if (hideHeaderTimeout) {
            clearTimeout(hideHeaderTimeout);
            hideHeaderTimeout = null;
        }
    }
});

header.addEventListener('mouseleave', () => {
    if (headerShownByMouse && (window.pageYOffset || document.documentElement.scrollTop) > 0) {
        header.classList.add('hidden');
        header.classList.remove('shadow');
        headerHidden = true;
        headerShownByMouse = false;
    }
});

header.addEventListener('mouseenter', () => {
    if (headerShownByMouse && hideHeaderTimeout) {
        clearTimeout(hideHeaderTimeout);
        hideHeaderTimeout = null;
    }
});
</script>