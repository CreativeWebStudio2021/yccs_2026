<?if($cmd=="home" || $cmd=="home2"){
	if(1){
		$num_s = 0;
		$query_s = "select * from slide where visibile='1' order by ordine desc";
		$risu_s = $open_connection->connection->query($query_s);
		$num_s = $risu_s->rowCount();
		if ($num_s>0) {
	?>
		<!-- SECTION REVOLUTION SLIDER -->
		<div id="slider" style=" top:-130px" class="solo_desk">
			<div id="rev_slider_18_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="polo-bar-caffe" style="position:relative; background-color:transparent;padding:0px;">
				<!-- START REVOLUTION SLIDER 5.1 fullscreen mode -->
				<div id="rev_slider_18_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.1">
					<ul>	
					<?
						for ($s=0; $s<$num_s; $s++) {
							$arr_s = $risu_s->fetch(PDO::FETCH_ASSOC);
							$sfondo_s = $arr_s['img'];
							$video_s = $arr_s['video'];
							$riga1_s = $arr_s['riga1'];
							$riga2_s = $arr_s['riga2'];
							$riga3_s = $arr_s['riga3'];
							$link_s = $arr_s['link'];
							
							if ($video_s!="" && is_file("resarea/files/slide/$video_s")) {
					?>
						<!-- SLIDE  -->
						<li data-index="rs-<?=$s;?>" data-transition="fade" <?if($arr_s['link'] && $arr_s['link']!=""){?>data-link="<?=$arr_s['link'];?>"<?}?> data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/slide/<? echo $sfondo_s; ?>" data-rotate="0" data-saveperformance="off" data-title="Drinks" data-description="">
							<!-- MAIN IMAGE -->
							<img src="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/slide/<? echo $sfondo_s; ?>" alt="" width="1280" height="720" data-lazyload="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/slide/<? echo $sfondo_s; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
							<!-- LAYERS -->

							<!-- BACKGROUND VIDEO LAYER -->
							<div class="rs-background-video-layer" 
								data-volume="mute" 
								data-videowidth="100%" 
								data-videoheight="100%" 
								data-videomp4="<?=$http;?>://<?=$ind_sito;?>/resarea/files/slide/<? echo $video_s; ?>" 
								data-videopreload="preload" 
								data-forceCover="1" 
								data-aspectratio="16:9" 
								data-autoplay="true" 
								data-autoplayonlyfirsttime="false" 
								data-nextslideatend="true" 
							></div>
							
							<? if ($riga1_s!="" || $riga2_s!="" || $riga3_s!="") { ?>
							<!-- LAYER NR. 2 -->
							<div class="tp-caption Restaurant-Display tp-resizeme font-raleway" id="slide-<?=$s;?>-layer-2" 
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
								data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
								data-fontsize="['60','60','60','40']"
								data-lineheight="['60','60','40','40']"
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
					 
								data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeOut;" 
								data-transform_out="opacity:0;s:1000;e:Power3.easeOut;s:1000;e:Power3.easeOut;" 
								data-mask_in="x:0px;y:0px;" 
								data-start="1800" 
								data-splitin="none" 
								data-splitout="none" 
								data-responsive_offset="on" 
								
								style="z-index: 6; white-space: nowrap; font-size: 60px; line-height: 60px; text-align:center">							
								<? if ($riga1_s!="") { ?><div style="font-size:0.5em; font-weight: 300; "><? echo strtoupper($riga1_s); ?></div><? } ?>
								<? if ($riga2_s!="") { ?><div style="font-size:1.1em; font-weight: 900; "><? echo strtoupper($riga2_s); ?></div><? } ?>
								<!--<div style="font-size:1.1em; font-weight: 900; " class="solo_mob">ROLEX CUP<br/> & <br/> SWAN CUP</div>-->
								<? if ($riga3_s!="") { ?><div style="font-size:0.6em; font-weight: 400; "><? echo strtoupper($riga3_s); ?></div><? } ?>
							</div>
							<? } ?>
						</li>
					<?
							} else {
					?>
						<!-- SLIDE  -->
						<li data-index="rs-<?=$s;?>" data-transition="fade"  <?if($arr_s['link'] && $arr_s['link']!=""){?>data-link="<?=$arr_s['link'];?>"<?}?> data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/slide/<? echo $sfondo_s; ?>" data-rotate="0" data-saveperformance="off" data-title="Home" data-description="">
							<!-- MAIN IMAGE -->
							<?
							if (is_file("$dir_up/slide/xxl_$sfondo_s")) $sfondo_s_xxl="xxl_$sfondo_s"; else $sfondo_s_xxl=$sfondo_s;
							if (is_file("$dir_up/slide/xl_$sfondo_s")) $sfondo_s_xl="xl_$sfondo_s"; else $sfondo_s_xl=$sfondo_s;
							if (is_file("$dir_up/slide/l_$sfondo_s")) $sfondo_s_l="l_$sfondo_s"; else $sfondo_s_l=$sfondo_s;
							if (is_file("$dir_up/slide/m_$sfondo_s")) $sfondo_s_m="m_$sfondo_s"; else $sfondo_s_m=$sfondo_s;
							if (is_file("$dir_up/slide/s_$sfondo_s")) $sfondo_s_s="s_$sfondo_s"; else $sfondo_s_s=$sfondo_s;
							if (is_file("$dir_up/slide/xs_$sfondo_s")) $sfondo_s_xs="xs_$sfondo_s"; else $sfondo_s_xs=$sfondo_s;
							?>
							<img id="img-<?=$s;?>" src="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/slide/<? echo $sfondo_s_xxl; ?>" alt="" width="1900" height="1200" data-lazyload="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/slide/<? echo $sfondo_s_xxl; ?>" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Power1.easeOut" data-scalestart="110" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
							<script>
								//document.getElementById('img-<?=$s;?>').src="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/slide/<? echo $sfondo_s_xxl; ?>";
							</script>
							<? if ($riga1_s!="" || $riga2_s!="" || $riga3_s!="") { ?>
							
							<!-- LAYER NR. 2 -->
							<div class="tp-caption Restaurant-Display tp-resizeme font-lato" id="slide-<?=$s;?>-layer-2"
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
								data-y="['middle','middle','middle','middle']" data-voffset="['-39','-39','0','0']" 
								data-fontsize="['60','60','60','40']"
								data-lineheight="['60','60','40','40']"
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
					 
								data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeOut;" 
								data-transform_out="opacity:0;s:1000;e:Power3.easeOut;s:1000;e:Power3.easeOut;" 
								data-mask_in="x:0px;y:0px;" 
								data-start="1100" 
								data-splitin="none" 
								data-splitout="none" 
								data-responsive_offset="on" 
								
								style="z-index: 6; white-space: nowrap; font-size: 60px; line-height: 50px; font-family: 'Lato', sans-serif; cursor:pointer">
								
									<? if ($riga1_s!="") { ?><div style="font-size:0.6em; font-weight: 300; "><? echo strtoupper($riga1_s); ?></div><? } ?>
									<? if ($riga2_s!="") { ?><div style="font-size:1.1em; font-weight: 900; "><span style="line-height:70px"><? echo strtoupper($riga2_s); ?></span></div><? } ?>
									<? if ($riga3_s!="") { ?><div style="font-size:0.4em; font-weight: 400; "><? echo strtoupper($riga3_s); ?></div><? } ?>
								
							</div>
							<? } ?>
						</li>
					<?
							}
						}
					?>
					</ul>
					<div class="tp-static-layers"></div>
					<div class="tp-bannertimer" style="height: 5px; background-color: rgba(183, 183, 183, 0.15);"></div>	
				</div>
				<!--<div style="position:absolute; width:100%; height:90%; top:0; left:0; z-index:1000; "></div>	-->
			</div><!-- END REVOLUTION SLIDER -->
				
		</div>
		<!-- END SECTION REVOLUTION SLIDER -->
	<?
		}
	}else{?>
		<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/slide-superyacht-3_2.jpg); margin-bottom:30px">
			<div class="container margin_title">
				<div class="page-title col-md-8">
					<h1>YCCS</h1>
				</div>
				<div class="breadcrumb col-md-4">
					YACHT CLUB COSTA SMERALDA
				</div>
			</div>
		</section>
	<?}	
}elseif($cmd=="regate"){?>
	<!-- PAGE TITLE -->
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/regate.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8" style="text-align:center;">
				<h1><?if($lingua=="ita"){?>Regate<?}else{?>Regattas<?}?> <?=$anno_regata;?></h1>
				<?
					$calendario_ed = $presentazione_ed = "";
					
					$query_cal = "select link,pdf from documenti_edizioni where anno=:anno_regata and tipo='calendario' order by ordine desc";
					$risu_cal = $open_connection->connection->prepare($query_cal);
					$risu_cal->execute(array(':anno_regata'=>$anno_regata));
					if ($risu_cal!=false) {
						list($link_cal,$pdf_cal) = $risu_cal->fetch();
						if ($pdf_cal!="" && is_file("resarea/files/edizioni/$pdf_cal")) $calendario_ed = "resarea/files/edizioni/$pdf_cal";
							elseif ($link_cal!="") $calendario_ed = "$link_cal";
					}
					
					$query_pre = "select link,pdf from documenti_edizioni where anno=':anno_regata' and tipo='presentazione' order by ordine desc";
					$risu_pre = $open_connection->connection->prepare($query_pre);
					$risu_pre->execute(array(':anno_regata'=>$anno_regata));
					if ($risu_pre!=false) {
						list($link_pre,$pdf_pre) = $risu_pre->fetch();
						if ($pdf_pre!="" && is_file("resarea/files/edizioni/$pdf_pre")) $presentazione_ed = "resarea/files/edizioni/$pdf_pre";
							elseif ($link_pre!="") $presentazione_ed = "$link_pre";
					}
				?>	
			</div>
			<div  style="text-align:center; text-decoration: underline; font-size:1.1em">
				<? if ($calendario_ed!="") { ?>
					<i class="fa fa-chevron-right"></i> 
					<b><a href="<? echo $calendario_ed; ?>" target="_blank"><?if($lingua=="ita"){?>Scarica il calendario delle Regate<?}else{?>Download the Sporting Calendar<?}?> <?=$anno_regata;?></a></b> 
					<i class="fa fa-chevron-left"></i>
				<? } ?>
				<? if ($calendario_ed!="" && $presentazione_ed!="") { ?> <br/> <? } ?>
				<? if ($presentazione_ed!="") { ?>
					<i class="fa fa-chevron-right"></i> 
					<b><a href="<? echo $presentazione_ed; ?>" target="_blank"><?if($lingua=="ita"){?>Presentazione Stagione <?=$anno_regata;?><?}else{?>Presentation <?=$anno_regata;?> Season<?}?></a></b> 
					<i class="fa fa-chevron-left"></i>
				<? } ?>
			</div>
			<?
			$query_lista="SELECT * FROM lista";
			$resu_lista=$open_connection->connection->query($query_lista);
			$num_lista=$resu_lista->rowCount();
			if($num_lista>0){
				$risu_lista=$resu_lista->fetch();
				$testo_lista=$risu_lista['link_eng'];
				if($lingua=="ita" && $risu_lista['link'] && $risu_lista['link']!="" && $risu_lista['link']!=" ") $testo_lista=$risu_lista['link'];
				$pdf_lista=$risu_lista['pdf_eng'];
				if($lingua=="ita" && $risu_lista['pdf'] && $risu_lista['pdf']!="") $pdf_lista=$risu_lista['pdf'];
				?>
				<div  style="text-align:center; text-decoration: underline; font-size:1.1em">					
					<i class="fa fa-chevron-right"></i> 
					<b><a href="resarea/files/<?=$pdf_lista;?>" target="_blank"><?=$testo_lista;?></a></b> 
					<i class="fa fa-chevron-left"></i>					
				</div>
			<?}?>
			
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="regate.html"><?if($lingua=="ita"){?>Le Regate<?}else{?>Regattas<?}?></a></li>
					<li class="active"><?if($lingua=="ita"){?>Regate<?}else{?>Regattas<?}?> <?=$anno_regata;?></li>
				</ul>
			</div>
		</div>
	</section>
	<!-- END: PAGE TITLE -->
<?}elseif($cmd=="dettaglio_regata"){
		$query_regata="SELECT * FROM edizioni_regate WHERE id=:id_dett";
		$resu_regata=$open_connection->connection->prepare($query_regata);
		$resu_regata->execute(array(':id_dett'=>$id_dett));
		$risu_regate=$resu_regata->fetch();

		$anno_regata=$risu_regate['anno'];

		$query_reg="SELECT * FROM regate WHERE id='".$risu_regate['id_regata']."'";
		$resu_reg=$open_connection->connection->query($query_reg);
		$risu_reg=$resu_reg->fetch();
?>
	<!-- PAGE TITLE -->
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/regate.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?=$risu_regate['nome_regata'];?></h1>
				<span><?=$risu_regate['luogo'];?> | <?if($lingua=="ita"){?>dal<?}else{?>from<?}?> <?=substr(date_to_data($risu_regate['data_dal'],"/"),0,5);?> <?if($risu_regate['data_al'] && $risu_regate['data_al']!=""){?> <?if($lingua=="ita"){?>al<?}else{?>to<?}?> <?=substr(date_to_data($risu_regate['data_al'],"/"),0,5);?><?}?></span>
			</div>
			
			<?
			$query_doc="SELECT * FROM regate_doc WHERE id_regata='".$risu_regate['id_regata']."' ORDER BY ordine DESC";
			$resu_doc=$open_connection->connection->query($query_doc);
			$num_doc=$resu_doc->rowCount();
			if($num_doc>0){?>
				<div  style="text-align:center; text-decoration: underline; font-size:1.1em; margin-top:10px;">
					<?while($risu_doc=$resu_doc->fetch()){
						if ($risu_doc['testo_eng'] && $risu_doc['testo_eng']!="") { 
							if($lingua=="ita" &&  $risu_doc['testo'] &&  $risu_doc['testo']!="") $testo_doc = $risu_doc['testo']; else $testo_doc = $risu_doc['testo_eng'];?>
							<i class="fa fa-chevron-right"></i> 
							<?if (($risu_doc['link_eng'] && $risu_doc['link_eng']!="") || ($risu_doc['link'] && $risu_doc['link']!="")) { 
								if($lingua=="ita" && $risu_doc['link']!="") $link=$risu_doc['link']; else $link=$risu_doc['link_eng'];
							}else if (($risu_doc['allegato_eng'] && $risu_doc['allegato_eng']!="") || ($risu_doc['allegato'] && $risu_doc['allegato']!="")) {
								if($lingua=="ita" && $risu_doc['allegato']!="") $link=$risu_doc['allegato']; else $link=$risu_doc['allegato_eng'];
							}?>
							<b><a href="<? echo $link; ?>" target="_blank"><?=$testo_doc;?></a></b> 
							<i class="fa fa-chevron-left"></i><br/>
						<?}
					}?>
				</div>
			<?}?>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="regate-<?=date("Y");?>.html"><?if($lingua=="ita"){?>Le Regate<?}else{?>Regattas<?}?></a></li>
					<li class="active"><a href="regate-<?=$anno_regata;?>.html"><?if($lingua=="ita"){?>Regate<?}else{?>Regattas<?}?> <?=$anno_regata;?></a></li>
					<li class="active"><?=$risu_regate['nome_regata'];?></li>
				</ul>
			</div>
		</div>
	</section>
	<!-- END: PAGE TITLE -->
<?}elseif($cmd=="dettaglio_regata"){
		$query_regata="SELECT * FROM edizioni_regate WHERE id=:id_dett";
		$resu_regata=$open_connection->connection->prepare($query_regata);
		$resu_regata->execute(array(':id_dett'=>$id_dett));
		$risu_regate=$resu_regata->fetch();

		$anno_regata=$risu_regate['anno'];

		$query_reg="SELECT * FROM regate WHERE id='".$risu_regate['id_regata']."'";
		$resu_reg=$open_connection->connection->query($query_reg);
		$risu_reg=$resu_reg->fetch();
?>
	<!-- PAGE TITLE -->
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/regate.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?=$risu_regate['nome_regata'];?></h1>
				<span><?=$risu_regate['luogo'];?> | <?if($lingua=="ita"){?>dal<?}else{?>from<?}?> <?=substr(date_to_data($risu_regate['data_dal'],"/"),0,5);?> <?if($risu_regate['data_al'] && $risu_regate['data_al']!=""){?> <?if($lingua=="ita"){?>al<?}else{?>to<?}?> <?=substr(date_to_data($risu_regate['data_al'],"/"),0,5);?><?}?></span>
			</div>
			
			<?
			$query_doc="SELECT * FROM regate_doc WHERE id_regata='".$risu_regate['id_regata']."' ORDER BY ordine DESC";
			$resu_doc=$open_connection->connection->query($query_doc);
			$num_doc=$resu_doc->rowCount();
			if($num_doc>0){?>
				<div  style="text-align:center; text-decoration: underline; font-size:1.1em; margin-top:10px;">
					<?while($risu_doc=$resu_doc->fetch()){
						if ($risu_doc['testo_eng'] && $risu_doc['testo_eng']!="") { 
							if($lingua=="ita" &&  $risu_doc['testo'] &&  $risu_doc['testo']!="") $testo_doc = $risu_doc['testo']; else $testo_doc = $risu_doc['testo_eng'];?>
							<i class="fa fa-chevron-right"></i> 
							<?if (($risu_doc['link_eng'] && $risu_doc['link_eng']!="") || ($risu_doc['link'] && $risu_doc['link']!="")) { 
								if($lingua=="ita" && $risu_doc['link']!="") $link=$risu_doc['link']; else $link=$risu_doc['link_eng'];
							}else if (($risu_doc['allegato_eng'] && $risu_doc['allegato_eng']!="") || ($risu_doc['allegato'] && $risu_doc['allegato']!="")) {
								if($lingua=="ita" && $risu_doc['allegato']!="") $link=$risu_doc['allegato']; else $link=$risu_doc['allegato_eng'];
							}?>
							<b><a href="<? echo $link; ?>" target="_blank"><?=$testo_doc;?></a></b> 
							<i class="fa fa-chevron-left"></i><br/>
						<?}
					}?>
				</div>
			<?}?>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="regate-<?=date("Y");?>.html"><?if($lingua=="ita"){?>Le Regate<?}else{?>Regattas<?}?></a></li>
					<li class="active"><a href="regate-<?=$anno_regata;?>.html"><?if($lingua=="ita"){?>Regate<?}else{?>Regattas<?}?> <?=$anno_regata;?></a></li>
					<li class="active"><?=$risu_regate['nome_regata'];?></li>
				</ul>
			</div>
		</div>
	</section>
	<!-- END: PAGE TITLE -->
<?}elseif($cmd=="crew_board"){
		$query_regata="SELECT * FROM edizioni_regate WHERE id=:id_dett";
		$resu_regata=$open_connection->connection->prepare($query_regata);
		$resu_regata->execute(array(':id_dett'=>$id_dett));
		$risu_regate=$resu_regata->fetch();

		$anno_regata=$risu_regate['anno'];

		$query_reg="SELECT * FROM regate WHERE id='".$risu_regate['id_regata']."'";
		$resu_reg=$open_connection->connection->query($query_reg);
		$risu_reg=$resu_reg->fetch();
	?>
	<!-- PAGE TITLE -->
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/regate.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>CREW/BOAT BOARD</h1>
				
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="regate-<?=date("Y");?>.html"><?if($lingua=="ita"){?>Le Regate<?}else{?>Regattas<?}?></a></li>
					<li><a href="regate-<?=$anno_regata;?>.html"><?if($lingua=="ita"){?>Regate<?}else{?>Regattas<?}?> <?=$anno_regata;?></a></li>
					<li><a href="regate-<?=$anno_regata;?>/<?=to_htaccess_url($risu_reg['nome'],"");?>-<?=$risu_regate['id'];?>.html"><?=$risu_reg['nome'];?></a></li>
					<li class="active"><?=$titolo;?></li>
				</ul>
			</div>
		</div>
	</section>
	<!-- END: PAGE TITLE -->
<?}elseif($cmd=="la-storia"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>La Storia<?}else{?>YCCS History<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>IL CLUB<?}else{?>CLUB<?}?></li>
					<li class="active"><?if($lingua=="ita"){?>La Storia<?}else{?>YCCS History<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="lo-yccs-oggi"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/loYCCSoggi.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>lo yccs oggi<?}else{?>YCCS Today<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>IL CLUB<?}else{?>CLUB<?}?></li>
					<li class="active"><?if($lingua=="ita"){?>Lo YCCS Oggi<?}else{?>YCCS Today<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="consiglio_direttivo"){?>
	<section id="page-title" class="page-title-center text-light" style="background:url(images/testate/consiglio_direttivo.jpg) center -160px; ">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<br/><br/><h1><?if($lingua=="ita"){?>Consiglio Direttivo<?}else{?>Board of Directors<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>IL CLUB<?}else{?>CLUB<?}?></li>
					<li class="active"><?if($lingua=="ita"){?>Consiglio Direttivo<?}else{?>Board of Directors<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="lavora-con-noi"){?>
	<section id="page-title" class="page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<br/><br/><h1>Lavora con noi</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li class="active">Lavora con noi</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="news" || $cmd=="news_dett"){
	$titolo_news="";
	if($id_dett!="") {
		$query_tit="SELECT titolo, titolo_eng FROM news WHERE id=:id_dett";
		$resu_tit=$open_connection->connection->prepare($query_tit);
		$resu_tit->execute(array(':id_dett'=>$id_dett));
		list($titolo_news,$titolo_news_eng)=$resu_tit->fetch();
	}
	?>
	<style>
		.slideNews{
			background-position:center -130px;
		}
		@media (max-width: 788px) {
			.slideNews{
				background-position: 900px -130px; 
			}
		}
	</style>
	<section id="page-title" class="page-title page-title-center text-light slideNews" style="background-image:url(images/testate/ufficio_stampa.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>NEWS</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="">NEWS</a></li>
					<?if($titolo_news!=""){?><li class="active"><?if($lingua=="eng" && $titolo_news_eng) echo $titolo_news_eng; else echo $titolo_news;?></li><?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="magazine"){?>
	<style>
		.slideNews{
			background-position:center -130px;
		}
		@media (max-width: 788px) {
			.slideNews{
				background-position: 900px -130px; 
			}
		}
	</style>
	<section id="page-title" class="page-title page-title-center text-light slideNews" style="background-image:url(images/testate/ufficio_stampa.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>MAGAZINE</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li class="active">MAGAZINE</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="azzurra-pagine"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div style="text-align:center; margin-bottom:20px">
				<img src="images/azzurra_logo_w.png" alt="Young Azzurra" style="width:200px">
			</div>
			
			<div class="page-title col-md-8">
				<h1><?=$tit_pag;?></h1>
			</div>
			
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>azzurra.html">Azzurra</a></li>
					<li class="active"><?=$tit_pag;?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="young-azzurra"){
	$num_s = 0;
	$query_s = "select * from ya_slide where visibile='1' order by ordine desc";
	$risu_s = $open_connection->connection->query($query_s);
	$num_s = $risu_s->rowCount();
	if ($num_s>0) {?>
		<!-- SECTION REVOLUTION SLIDER -->
		<div id="slider" style=" top:-90px;" class="solo_desk">
			<div style="position:absolute; width:200px; top:110px; left:20px; z-index:100">
				<img src="images/young_azzurra_logo_w.png" alt="Young Azzurra" style="width:200px">
			</div>
			<div id="rev_slider_18_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="polo-bar-caffe" style="position:relative; background-color:transparent;padding:0px;">
				<!-- START REVOLUTION SLIDER 5.1 fullscreen mode -->
				<div id="rev_slider_18_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.1">
					<ul>	
					<?
						for ($s=0; $s<$num_s; $s++) {
							$arr_s = $risu_s->fetch(PDO::FETCH_ASSOC);
							$sfondo_s = $arr_s['img'];
							$video_s = $arr_s['video'];
							$riga1_s = $arr_s['riga1'];
							$riga2_s = $arr_s['riga2'];
							$riga3_s = $arr_s['riga3'];
							$link_s = $arr_s['link'];
							
							if ($video_s!="" && is_file("resarea/files/ya_slide/$video_s")) {
					?>
						<!-- SLIDE  -->
						<li data-index="rs-<?=$s;?>" data-transition="fade" <?if($arr_s['link'] && $arr_s['link']!=""){?>data-link="<?=$arr_s['link'];?>"<?}?> data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/ya_slide/<? echo $sfondo_s; ?>" data-rotate="0" data-saveperformance="off" data-title="Drinks" data-description="">
							<!-- MAIN IMAGE -->
							<img src="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/ya_slide/<? echo $sfondo_s; ?>" alt="" width="1280" height="720" data-lazyload="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/ya_slide/<? echo $sfondo_s; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
							<!-- LAYERS -->

							<!-- BACKGROUND VIDEO LAYER -->
							<div class="rs-background-video-layer" 
								data-volume="mute" 
								data-videowidth="100%" 
								data-videoheight="100%" 
								data-videomp4="<?=$http;?>://<?=$ind_sito;?>/resarea/files/ya_slide/<? echo $video_s; ?>" 
								data-videopreload="preload" 
								data-forceCover="1" 
								data-aspectratio="16:9" 
								data-autoplay="true" 
								data-autoplayonlyfirsttime="false" 
								data-nextslideatend="true" 
							></div>
							
							<? if ($riga1_s!="" || $riga2_s!="" || $riga3_s!="") { ?>
							<!-- LAYER NR. 2 -->
							<div class="tp-caption Restaurant-Display tp-resizeme font-raleway" id="slide-<?=$s;?>-layer-2" 
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
								data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
								data-fontsize="['60','60','60','40']"
								data-lineheight="['60','60','40','40']"
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
					 
								data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeOut;" 
								data-transform_out="opacity:0;s:1000;e:Power3.easeOut;s:1000;e:Power3.easeOut;" 
								data-mask_in="x:0px;y:0px;" 
								data-start="1800" 
								data-splitin="none" 
								data-splitout="none" 
								data-responsive_offset="on" 
								
								style="z-index: 6; white-space: nowrap; font-size: 60px; line-height: 60px; text-align:center">							
								<? if ($riga1_s!="") { ?><div style="font-size:0.5em; font-weight: 300; "><? echo strtoupper($riga1_s); ?></div><? } ?>
								<? if ($riga2_s!="") { ?><div style="font-size:1.1em; font-weight: 900; "><? echo strtoupper($riga2_s); ?></div><? } ?>
								<!--<div style="font-size:1.1em; font-weight: 900; " class="solo_mob">ROLEX CUP<br/> & <br/> SWAN CUP</div>-->
								<? if ($riga3_s!="") { ?><div style="font-size:0.6em; font-weight: 400; "><? echo strtoupper($riga3_s); ?></div><? } ?>
							</div>
							<? } ?>
						</li>
					<?
							} else {
					?>
						<!-- SLIDE  -->
						<li data-index="rs-<?=$s;?>" data-transition="fade"  <?if($arr_s['link'] && $arr_s['link']!=""){?>data-link="<?=$arr_s['link'];?>"<?}?> data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/ya_slide/<? echo $sfondo_s; ?>" data-rotate="0" data-saveperformance="off" data-title="Home" data-description="">
							<!-- MAIN IMAGE -->
							<?
							if (is_file("$dir_up/ya_slide/xxl_$sfondo_s")) $sfondo_s_xxl="xxl_$sfondo_s"; else $sfondo_s_xxl=$sfondo_s;
							if (is_file("$dir_up/ya_slide/xl_$sfondo_s")) $sfondo_s_xl="xl_$sfondo_s"; else $sfondo_s_xl=$sfondo_s;
							if (is_file("$dir_up/ya_slide/l_$sfondo_s")) $sfondo_s_l="l_$sfondo_s"; else $sfondo_s_l=$sfondo_s;
							if (is_file("$dir_up/ya_slide/m_$sfondo_s")) $sfondo_s_m="m_$sfondo_s"; else $sfondo_s_m=$sfondo_s;
							if (is_file("$dir_up/ya_slide/s_$sfondo_s")) $sfondo_s_s="s_$sfondo_s"; else $sfondo_s_s=$sfondo_s;
							if (is_file("$dir_up/ya_slide/xs_$sfondo_s")) $sfondo_s_xs="xs_$sfondo_s"; else $sfondo_s_xs=$sfondo_s;
							?>
							<img id="img-<?=$s;?>" src="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/ya_slide/<? echo $sfondo_s_xxl; ?>" alt="" width="1900" height="1200" data-lazyload="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/ya_slide/<? echo $sfondo_s_xxl; ?>" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Power1.easeOut" data-scalestart="110" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
							<script>
								//document.getElementById('img-<?=$s;?>').src="<?=$http;?>://<?=$ind_sito;?>/<? echo $dir_up; ?>/ya_slide/<? echo $sfondo_s_xxl; ?>";
							</script>
							<? if ($riga1_s!="" || $riga2_s!="" || $riga3_s!="") { ?>
							
							<!-- LAYER NR. 2 -->
							<div class="tp-caption Restaurant-Display tp-resizeme font-lato" id="slide-<?=$s;?>-layer-2"
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
								data-y="['middle','middle','middle','middle']" data-voffset="['-39','-39','0','0']" 
								data-fontsize="['60','60','60','40']"
								data-lineheight="['60','60','40','40']"
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-transform_idle="o:1;"
					 
								data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeOut;" 
								data-transform_out="opacity:0;s:1000;e:Power3.easeOut;s:1000;e:Power3.easeOut;" 
								data-mask_in="x:0px;y:0px;" 
								data-start="1100" 
								data-splitin="none" 
								data-splitout="none" 
								data-responsive_offset="on" 
								
								style="z-index: 6; white-space: nowrap; font-size: 60px; line-height: 50px; font-family: 'Lato', sans-serif; cursor:pointer">
									
									<? if ($riga1_s!="") { ?><div style="font-size:0.6em; font-weight: 300; "><? echo strtoupper($riga1_s); ?></div><? } ?>
									<? if ($riga2_s!="") { ?><div style="font-size:1.1em; font-weight: 900; "><span style="line-height:70px"><? echo strtoupper($riga2_s); ?></span></div><? } ?>
									<? if ($riga3_s!="") { ?><div style="font-size:0.4em; font-weight: 400; "><? echo strtoupper($riga3_s); ?></div><? } ?>
								
							</div>
							<? } ?>
						</li>
					<?
							}
						}
					?>
					</ul>
					<div class="tp-static-layers"></div>
					<div class="tp-bannertimer" style="height: 5px; background-color: rgba(183, 183, 183, 0.15);"></div>	
				</div>
				<!--<div style="position:absolute; width:100%; height:90%; top:0; left:0; z-index:1000; "></div>	-->
			</div><!-- END REVOLUTION SLIDER -->
				
		</div>
		<!-- END SECTION REVOLUTION SLIDER -->
	<?}else{?>
		<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
			<div class="container margin_title">
				<div class="page-title col-md-8">
					<h1>Young Azzurra</h1>
				</div>
				
				<div class="breadcrumb col-md-4">
					<ul>
						<li><a href="home.html"><i class="fa fa-home"></i></a></li>
						<li class="active">Young Azzurra</li>
					</ul>
				</div>
			</div>
		</section>
	<?}?>
<?}elseif($cmd=="young-azzurra-news" || $cmd=="young-azzurra-news_dett"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div style="text-align:center; margin-bottom:20px">
				<a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html" title="Young Azzurra">
					<img src="images/young_azzurra_logo_w.png" alt="Young Azzurra" style="width:200px">
				</a>
			</div>
			
			<div class="page-title col-md-8">
				<h1>Young Azzurra News</h1>
			</div>
			<?
			$titolo_news="";
			if($id_dett!="") {
				$query_tit="SELECT titolo, titolo_eng FROM news WHERE id=:id_dett";
				$resu_tit=$open_connection->connection->prepare($query_tit);
				$resu_tit->execute(array(':id_dett'=>$id_dett));
				list($titolo_news,$titolo_news_eng)=$resu_tit->fetch();
			}
			?>
			
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html">Young Azzurra</a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra/news.html">News</a></li>
					<?if($titolo_news!=""){?><li class="active"><?if($lingua=="eng" && $titolo_news_eng) echo $titolo_news_eng; else echo $titolo_news;?></li><?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="young-azzurra-team"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div style="text-align:center; margin-bottom:20px">
				<a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html" title="Young Azzurra">
					<img src="images/young_azzurra_logo_w.png" alt="Young Azzurra" style="width:200px">
				</a>
			</div>
			<div class="page-title col-md-8">
				<h1>Young Azzurra Team</h1>
			</div>
			<?
			$titolo_news="";
			if($id_dett=="") {
				$query_t="SELECT id FROM ya_team ORDER BY id DESC limit 0,1";
				$resu_t=$open_connection->connection->query($query_t);
				list($id_dett)=$resu_t->fetch();
			}
			
			$query_tit="SELECT titolo, titolo_eng, nome, cognome FROM ya_team WHERE id=:id_dett";
			$resu_tit=$open_connection->connection->prepare($query_tit);
			$resu_tit->execute(array(':id_dett'=>$id_dett));
			list($titolo_team,$titolo_team_eng, $nome, $cognome)=$resu_tit->fetch();
			?>
			
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html">Young Azzurra</a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra/team.html">Team</a></li>
					<?if($titolo_team!=""){?><li class="active"><?if($lingua=="eng" && $titolo_team_eng) echo trim($titolo_team_eng); else echo trim($titolo_team);?>, <?=$nome;?> <?=$cognome;?></li><?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="young-azzurra-risultati"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div style="text-align:center; margin-bottom:20px">
				<a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html" title="Young Azzurra">
					<img src="images/young_azzurra_logo_w.png" alt="Young Azzurra" style="width:200px">
				</a>
			</div>
			
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Risultati<?}?> Young Azzurra<?if($lingua=="eng"){?> Results<?}?></h1>
			</div>
			
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html">Young Azzurra</a></li>
					<li class="active"><?if($lingua=="ita"){?>Risultati<?}else{?>Results<?}?> <?=$anno_risultati;?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="young-azzurra-gallery" || $cmd=="young-azzurra-gallery-dett"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div style="text-align:center; margin-bottom:20px">
				<a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html" title="Young Azzurra">
					<img src="images/young_azzurra_logo_w.png" alt="Young Azzurra" style="width:200px">
				</a>
			</div>
			
			<div class="page-title col-md-8">
				<h1>Young Azzurra Photogallery</h1>
			</div>
			<?
			$titolo_news="";
			if($id_dett!="") {
				$query_tit="SELECT titolo, titolo_eng FROM ya_gallery WHERE id=:id_dett";
				$resu_tit=$open_connection->connection->prepare($query_tit);
				$resu_tit->execute(array(':id_dett'=>$id_dett));
				list($titolo_gal,$titolo_eng_gal)=$resu_tit->fetch();
			}
			?>
			
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html">Young Azzurra</a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra/photogallery.html">Photogallery</a></li>
					<?if($titolo_gal!=""){?><li class="active"><?if($lingua=="eng" && $titolo_eng_gal) echo $titolo_eng_gal; else echo $titolo_gal;?></li><?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="young-azzurra-video" || $cmd=="young-azzurra-video-dett"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div style="text-align:center; margin-bottom:20px">
				<a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html" title="Young Azzurra">
					<img src="images/young_azzurra_logo_w.png" alt="Young Azzurra" style="width:200px">
				</a>
			</div>
			
			<div class="page-title col-md-8">
				<h1>Young Azzurra Video Gallery</h1>
			</div>
			<?
			$titolo_news="";
			if($id_dett!="") {
				$query_tit="SELECT titolo, titolo_eng FROM ya_video WHERE id=:id_dett";
				$resu_tit=$open_connection->connection->prepare($query_tit);
				$resu_tit->execute(array(':id_dett'=>$id_dett));
				list($titolo_gal,$titolo_eng_gal)=$resu_tit->fetch();
			}
			?>
			
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra.html">Young Azzurra</a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>young-azzurra/video_gallery.html">Video Gallery</a></li>
					<?if($titolo_gal!=""){?><li class="active"><?if($lingua=="eng" && $titolo_eng_gal) echo $titolo_eng_gal; else echo $titolo_gal;?></li><?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="news_private" || $cmd=="news_private_dett"){
	$titolo_news="";
	if($id_dett!="") {
		$query_tit="SELECT titolo, titolo_eng FROM news_private WHERE id=:id_dett";
		$resu_tit=$open_connection->connection->prepare($query_tit);
		$resu_tit->execute(array(':id_dett'=>$id_dett));
		list($titolo_news,$titolo_news_eng)=$resu_tit->fetch();
	}
	?>
	<style>
		.slideNews{
			background-position:center -130px;
		}
		@media (max-width: 788px) {
			.slideNews{
				background-position: 900px -130px; 
			}
		}
	</style>
	<section id="page-title" class="page-title page-title-center text-light slideNews" style="background-image:url(images/testate/ufficio_stampa.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>NEWS</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><a href="">NEWS</a></li>
					<?if($titolo_news!=""){?><li class="active"><?if($lingua=="eng" && $titolo_news_eng) echo $titolo_news_eng; else echo $titolo_news;?></li><?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="la-clubhouse"){?>
	<section id="page-title" class="page-title-parallax  text-light" style="background-image:url(images/testate/ch_portocervo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>LA CLUBHOUSE<?}else{?>CLUBHOUSE<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS PORTO CERVO</li>
					<li class="active"><?if($lingua=="ita"){?>La Clubhouse<?}else{?>Clubhouse<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="la-piazza-azzurra"){?>
	<?/*<section id="page-title" class=" page-title-center text-light" style="margin-top:-80px; background-image:url(images/testate/la_piazza_azzurra.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>LA PIAZZA AZZURRA<?}else{?>PIAZZA AZZURRA<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS PORTO CERVO</li>
					<li class="active"><?if($lingua=="ita"){?>La Piazza Azzurra<?}else{?>Piazza Azzurra<?}?></li>
				</ul>
			</div>
		</div>
	</section>*/?>
	<?
	include("fissi/testata_interna.inc.php");
	?>
<?}elseif($cmd=="yccs-wellness-center"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/wellness-center.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>YCCS WELLNESS CENTER & SPA</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS PORTO CERVO</li>
					<li class="active">Yccs Wellness Center & Spa</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif(str_replace("yccs-sailing-school","",$cmd)!=$cmd){?>
	<div id="slider" style=" position:relative;">
		<?
		$ind1=rand(1,4);
		$ind2=$ind1;
		while($ind2==$ind1){$ind2=rand(1,4);}
		$ind3=$ind1;
		while($ind1==$ind3 || $ind2==$ind3){$ind3=rand(1,4);}
		$ind4=$ind1;
		while($ind1==$ind4 || $ind2==$ind4 || $ind3==$ind4){$ind4=rand(1,4);}
		?>
		<div id="slider-carousel">
			<div style="background-image:url('images/scuola/gallery/slide/<?=$ind1;?>.jpg'); height:600px;" class="owl-bg-img ">
				<div class="container-fullscreen">
					<div class="text-middle">
						<div class="container"></div>
					</div>
				</div>
			</div>
			<div style="background-image:url('images/scuola/gallery/slide/<?=$ind2;?>.jpg'); height:600px;" class="owl-bg-img ">
				<div class="container-fullscreen">
					<div class="text-middle">
						<div class="container"></div>
					</div>
				</div>
			</div>
			<div style="background-image:url('images/scuola/gallery/slide/<?=$ind3;?>.jpg'); height:600px;" class="owl-bg-img ">
				<div class="container-fullscreen">
					<div class="text-middle">
						<div class="container"></div>
					</div>
				</div>
			</div>
			<div style="background-image:url('images/scuola/gallery/slide/<?=$ind4;?>.jpg'); height:600px;" class="owl-bg-img ">
				<div class="container-fullscreen">
					<div class="text-middle">
						<div class="container"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?}elseif($cmd=="centro-sportivo"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/centro_sportivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>CENTRO SPORTIVO<?}else{?>SPORTS CENTRE<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS PORTO CERVO</li>
					<li class="active"><?if($lingua=="ita"){?>Centro Sportivo<?}else{?>Sports Centre<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="comunicati" || $cmd=="comunicati_dett"){
	$titolo_com="";
	if($id_dett!="") {
		$query_tit="SELECT titolo, titolo_eng FROM stampa WHERE id=':id_dett'";
		$resu_tit=$open_connection->connection->prepare($query_tit);
		$resu_tit->execute(array(':id_dett'=>$id_dett));
		list($titolo_com,$titolo_com_eng)=$resu_tit->fetch();
	}
	?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/ufficio_stampa.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<?if($cmd=="comunicati"){?>
					<h1><?if($lingua=="ita"){?>UFFICIO STAMPA<?}else{?>PRESS OFFICE<?}?></h1>
				<?}else{?>
					<h1><?if($lingua=="ita" && $titolo_com && $titolo_com!="") echo $titolo_com; else echo $titolo_com_eng;?></h1>
				<?}?>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS PORTO CERVO</li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>comunicati.html"><?if($lingua=="ita"){?>Ufficio Stampa<?}else{?>Press Office<?}?></a></li>
					<?if($titolo_com!=""){?><li class="active"><?if($lingua=="ita" && $titolo_com) echo ucfirst($titolo_com); else echo ucfirst($titolo_com_eng);?></li><?}?>
				</ul>
			</div>
		</div>
	</section>

<?}elseif($cmd=="press-conference"){
	$titolo_com="";
	if($id_dett!="") {
		$query_tit="SELECT titolo, titolo_eng FROM rassegna WHERE id=':id_dett'";
		$resu_tit=$open_connection->connection->prepare($query_tit);
		$resu_tit->execute(array(':id_dett'=>$id_dett));
		list($titolo_com,$titolo_com_eng)=$resu_tit->fetch();
	}
	?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/ufficio_stampa.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<?if($cmd=="comunicati"){?>
					<h1><?if($lingua=="ita"){?>RASSEGNA STAMPA<?}else{?>PRESS OFFICE<?}?></h1>
				<?}else{?>
					<h1><?if($lingua=="ita" && $titolo_com && $titolo_com!="") echo $titolo_com; else echo $titolo_com_eng;?></h1>
				<?}?>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS PORTO CERVO</li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>comunicati.html"><?if($lingua=="ita"){?>Ufficio Stampa<?}else{?>Press Office<?}?></a></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>comunicati.html"><?if($lingua=="ita"){?>Area Conferenza Stampa<?}else{?>Press Conference<?}?></a></li>
					<?if($titolo_com!=""){?><li class="active"><?if($lingua=="ita" && $titolo_com) echo ucfirst($titolo_com); else echo ucfirst($titolo_com_eng);?></li><?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="registrazione-giornalisti"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/ufficio_stampa.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Registrazione Giornalisti<?}else{?>Journalist Registration<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS PORTO CERVO</li>
					<li><a href="comunicati.html"><?if($lingua=="ita"){?>Ufficio Stampa<?}else{?>Press Office<?}?></a></li>
					<li class="active"><?if($lingua=="ita"){?>Registrazione Giornalisti<?}else{?>Journalist Registration<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="il-meteo"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/meteo_webcam.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>IL METEO / WEBCAM<?}else{?>METEO / LIVE WEB CAM<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS PORTO CERVO</li>
					<li class="active"><?if($lingua=="ita"){?>Il Meteo / Webcam<?}else{?>Meteo / Live Web Cam<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="la-clubhouse-vg"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/ch_virgingorda.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>LA CLUBHOUSE<?}else{?>CLUBHOUSE<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS VIRGIN GORDA</li>
					<li class="active"><?if($lingua=="ita"){?>La Clubhouse<?}else{?>Clubhouse<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="il-meteo-marina"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/meteo_webcam.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>IL METEO / WEBCAM<?}else{?>METEO / LIVE WEB CAM<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS VIRGIN GORDA</li>
					<li class="active"><?if($lingua=="ita"){?>Il Meteo / Webcam<?}else{?>Meteo / Live Web Cam<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="yccs_virgin_gorda"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/ch_virgingorda.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>YCCS - Virgin Gorda</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS - Virgin Gorda</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="contatti"){?>
	
<?}elseif($cmd=="one-ocean"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/loYCCSoggi.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>ONE OCEAN</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>ONE OCEAN</li>
					<li class="active">One Ocean</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="yccs_sostenibilita"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/loYCCSoggi.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>YCCS e Sostenibilit&agrave;<?}else{?>YCCS and Sustainability<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>ONE OCEAN</li>
					<li class="active"><?if($lingua=="ita"){?>YCCS e Sostenibilit&agrave;<?}else{?>YCCS and Sustainability<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="yccs_clean_beach_day"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/loYCCSoggi.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>YCCS Clean Beach Day</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>ONE OCEAN</li>
					<li class="active">YCCS Clean Beach Day</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="charta_smeralda"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/loYCCSoggi.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>Charta Smeralda</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>ONE OCEAN</li>
					<li class="active">Charta Smeralda</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="10_eco_consigli_per_i_velisti"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/loYCCSoggi.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>10 Eco-Consigli per i velisti<?}else{?>10 Sustainability tips for sailors<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>ONE OCEAN</li>
					<li class="active"><?if($lingua=="ita"){?>10 Eco-Consigli per i velisti<?}else{?>10 Sustainability tips for sailors<?}?></li>
				</ul>
			</div>
		</div>
	</section>
	
<?}elseif($cmd=="sitemap"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>Sitemap</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>Sitemap</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="login"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>Login</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>Login</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="registrazione"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Registrazione<?}else{?>Registration<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Registrazione<?}else{?>Registration<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="la-boutique"){
	if(isset($_GET['id_cat'])) $id_cat=$_GET['id_cat']; else $id_cat="";
	if(isset($_GET['id_sottocat'])) $id_sottocat=$_GET['id_sottocat']; else $id_sottocat="";
	?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>La Boutique<?}else{?>Boutique<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/la-boutique.html"><?if($lingua=="ita"){?>La Boutique<?}else{?>Boutique<?}?></a></li>					
					<?if($id_cat && $id_cat!=""){
						$query_cat="SELECT nome, nome_eng FROM categorie WHERE id=:id_cat";
						$resu_cat=$open_connection->connection->prepare($query_cat);
						$resu_cat->execute(array(':id_cat'=>$id_cat));
						list($nome_cat, $nome_cat_eng)=$resu_cat->fetch();
						?>
					<?}else{
						$id_cat="";
						$id_sottocat="";
						/*$query_cat="SELECT id, nome, nome_eng FROM categorie ORDER BY ordine DESC LIMIT 0,1";
						$resu_cat=mysql_query($query_cat);
						list($id_cat, $nome_cat, $nome_cat_eng)=mysql_fetch_array($resu_cat);*/
					}?>
					<?if($id_cat!=""){?>
						<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/la-boutique/<?if($lingua=="eng") echo to_htaccess_url($nome_cat_eng,""); else echo to_htaccess_url($nome_cat,"")?>-<?=$id_cat;?>.html"><?if($lingua=="eng" && $nome_cat_eng && trim($nome_cat_eng)!="") echo $nome_cat_eng; else echo $nome_cat;?></a></li>			
					<?}?>
					<?if($id_sottocat && $id_sottocat!=""){
						$query_sottocat="SELECT nome, nome_eng FROM sottocategorie WHERE id='$id_sottocat'";
						$resu_sottocat=$open_connection->connection->prepare($query_sottocat);
						$resu_sottocat->execute(array(':id_sottocat'=>$id_sottocat));
						list($nome_sottocat, $nome_sottocat_eng)=$resu_sottocat->fetch();
						?>
						<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/la-boutique/<?if($lingua=="eng") echo to_htaccess_url($nome_cat_eng,""); else echo to_htaccess_url($nome_cat,"")?>-<?=$id_cat;?>/<?if($lingua=="eng") echo to_htaccess_url($nome_sottocat_eng,""); else echo to_htaccess_url($nome_sottocat,"")?>-<?=$id_sottocat;?>.html"><?if($lingua=="eng" && $nome_sottocat_eng && trim($nome_sottocat_eng)!="") echo $nome_sottocat_eng; else echo $nome_sottocat;?></a></li>			
					<?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="profilo"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Profilo Socio<?}else{?>Member Profile<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li><?if($lingua=="ita"){?>Profilo Socio<?}else{?>Member Profile<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="comunicazioni-ai-soci"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Comunicazioni ai Soci<?}else{?>Member Communications<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li><?if($lingua=="ita"){?>Comunicazioni ai Soci<?}else{?>Member Communications<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="regate-interclub"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Regate Interclub<?}else{?>Interclub Regattas<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li><?if($lingua=="ita"){?>Regate Interclub<?}else{?>Interclub Regattas<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="bacheca"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Bacheca<?}else{?>Notice Board<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li><?if($lingua=="ita"){?>Bacheca<?}else{?>Notice Board<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="pagamento-quota"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Pagamento Quota<?}else{?>Fee Payment<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li><?if($lingua=="ita"){?>Pagamento Quota<?}else{?>Fee Payment<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="links"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>Links</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>Links</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="reservation-request"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/centro_sportivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>Reservation Request</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li>YCCS PORTO CERVO</li>
					<li><?if($lingua=="ita"){?><a href="centro-sportivo.html">Centro Sportivo</a><?}else{?><a href="en/centro-sportivo.html">Sports Centre</a><?}?></li>
					<li class="active">Reservation Request</li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="carrello"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/centro_sportivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Carrello<?}else{?>Cart<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li class="active"><?if($lingua=="ita"){?>Carrello<?}else{?>Cart<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="i-miei-ordini"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>I Miei Ordini<?}else{?>My Orders<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li><?if($lingua=="ita"){?>I Miei Ordini<?}else{?>My Orders<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="profilo-socio"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Profilo Socio<?}else{?>Member Profile<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li><?if($lingua=="ita"){?>Profilo Socio<?}else{?>Member Profile<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="certificato-di-guidone"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Certificato di Guidone<?}else{?>Burgee Certificate<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li><?if($lingua=="ita"){?>Certificato di Guidone<?}else{?>Burgee Certificate<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="prodotti_dett"){
	if(isset($_GET['id_dett'])) $id_dett=$_GET['id_dett']; else $id_dett="";
	$query_dett="SELECT * FROM prodotti WHERE id=':id_dett'";
	
	$resu_dett=$open_connection->connection->prepare($query_dett);
	$resu_dett->execute(array(':id_dett'=>$id_dett));
	$risu_dett=$resu_dett->fetch();
	
	$query_cat="SELECT nome, nome_eng FROM categorie WHERE id='".$risu_dett['id_rife']."'";
	$resu_cat=$open_connection->connection->query($query_cat);
	list($nome_cat, $nome_cat_eng)=$resu_cat->fetch();
	
	$query_sottocat="SELECT nome, nome_eng FROM sottocategorie WHERE id='".$risu_dett['id_riferimento']."'";
	$resu_sottocat=$open_connection->connection->query($query_sottocat);
	list($nome_sottocat, $nome_sottocat_eng)=$resu_sottocat->fetch();
	?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="eng" && $risu_dett['nome_eng'] && $risu_dett['nome_eng']!="") echo $risu_dett['nome_eng']; else echo $risu_dett['nome'];?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Area Soci<?}else{?>Members Area<?}?></li>
					<li class="active"><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/la-boutique.html"><?if($lingua=="ita"){?>La Boutique<?}else{?>Boutique<?}?></a></li>
					
					<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/la-boutique/<?if($lingua=="eng") echo to_htaccess_url($nome_cat_eng,""); else echo to_htaccess_url($nome_cat,"")?>-<?=$risu_dett['id_rife'];?>.html"><?if($lingua=="eng" && $nome_cat_eng && trim($nome_cat_eng)!="") echo $nome_cat_eng; else echo $nome_cat;?></a></li>			
					<?if($risu_dett['id_riferimento'] && $risu_dett['id_riferimento']!=""){?>
						<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/la-boutique/<?if($lingua=="eng") echo to_htaccess_url($nome_cat_eng,""); else echo to_htaccess_url($nome_cat,"")?>-<?=$risu_dett['id_rife'];?>/<?if($lingua=="eng") echo to_htaccess_url($nome_sottocat_eng,""); else echo to_htaccess_url($nome_sottocat,"")?>-<?=$risu_dett['id_riferimento'];?>.html"><?if($lingua=="eng" && $nome_sottocat_eng && trim($nome_sottocat_eng)!="") echo $nome_sottocat_eng; else echo $nome_sottocat;?></a></li>			
					<?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="checkout"){
	if(isset($_GET['step'])) $step=$_GET['step']; 
	else {
		if($_SESSION["user_loggato"]=="no") $step=1;
		else $step=2;
	}
	
?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/centro_sportivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>Checkout</h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?><a href="checkout.html">Checkout</a><?}else{?><a href="en/checkout.html">Checkout</a><?}?></li>
					<?if($step==2){?>
						<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/checkout-step2.html"><?if($lingua=="ita"){?>Dettagli di Spedizione/Fatturazione<?}else{?>Shipping/Invoice Details<?}?></a></li>
					<?}?>
					<?if($step==3){?>
						<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/checkout-step2.html"><?if($lingua=="ita"){?>Dettagli di Spedizione/Fatturazione<?}else{?>Shipping/Invoice Details<?}?></a></li>
						<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/checkout-step3.html"><?if($lingua=="ita"){?>Metodo di pagamento e spedizione<?}else{?>Payment/Shipment Method<?}?></a></li>
					<?}?>
					<?if($step==4){?>
						<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/checkout-step2.html"><?if($lingua=="ita"){?>Dettagli di Spedizione/Fatturazione<?}else{?>Shipping/Invoice Details<?}?></a></li>
						<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/checkout-step3.html"><?if($lingua=="ita"){?>Metodo di pagamento e spedizione<?}else{?>Payment/Shipment Method<?}?></a></li>
						<li><a href="<?if($lingua=="eng"){?>en/<?}?>area-soci/checkout-step4.html"><?if($lingua=="ita"){?>Conferma Ordine<?}else{?>Order Confirmation<?}?></a></li>
					<?}?>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="speciale_50"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Speciale 50<?}else{?>YCCS 50th Special Feature<?}?></h1>
			</div>
		</div>
	</section>
<?}elseif($cmd=="suppliers"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Suppliers<?}else{?>Suppliers<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Suppliers<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="preferred_suppliers"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/consiglio_direttivo.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Preferred Suppliers<?}else{?>Preferred Suppliers<?}?></h1>
			</div>
			<div class="breadcrumb col-md-4">
				<ul>
					<li><a href="home.html"><i class="fa fa-home"></i></a></li>
					<li><?if($lingua=="ita"){?>Preferred Suppliers<?}?></li>
				</ul>
			</div>
		</div>
	</section>
<?}elseif($cmd=="rassegna_stampa"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/storia.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1><?if($lingua=="ita"){?>Rassegna Stampa<?}else{?>press review<?}?></h1>
			</div>
		</div>
	</section>
<?}elseif($cmd=="yccs-app"){?>
	<section id="page-title" class="page-title-parallax page-title-center text-light" style="background-image:url(images/testate/ufficio_stampa.jpg);">
		<div class="container margin_title">
			<div class="page-title col-md-8">
				<h1>YCCS APP</h1>
			</div>
		</div>
	</section>
<?}?>