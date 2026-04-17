<!-- DOCUMENTI UFFICIALI -->
<div  id="documents"></div>
@php
	$ante = '';
	$foto_1200 = $foto_800 = $foto_400 = "https://www.yccs.it/web/images/new/LPCSRR16ff_03949.jpg";
	$img_documenti = isset($value_ed) ? ($value_ed->img_documenti ?? '') : '';
	$modulo_iscrizioni = isset($value_ed) ? ($value_ed->modulo_iscrizioni ?? 0) : 0;
	if(!empty($img_documenti)){
		$ante = smartAsset("resarea/img_up/regate/".$img_documenti);
		$foto_1200 = $foto_800 = $foto_400 = $ante;
		if(file_exists(public_path("resarea/img_up/regate/1200_".$img_documenti))) $foto_1200 = asset("resarea/img_up/regate/1200_".$img_documenti);
		if(file_exists(public_path("resarea/img_up/regate/800_".$img_documenti))) $foto_800 = asset("resarea/img_up/regate/800_".$img_documenti);
		if(file_exists(public_path("resarea/img_up/regate/400_".$img_documenti))) $foto_400 = asset("resarea/img_up/regate/400_".$img_documenti);
	}
@endphp
<style>
	#sezDocumenti{
		background:url(<?php echo $ante;?>) center;
		background-size:cover;
		height:500px;
	}
	@media (max-width: 1920px) {
		#sezDocumenti{
			background:url(<?php echo $ante;?>) center;		
			background-size:initial;
			height:388px;
		}
	}
	@if($img_documenti && trim($img_documenti)!="" && is_file(public_path("resarea/img_up/regate/".$img_documenti)))
		@media (max-width: 1200px) {
			#sezDocumenti{
				background:url(<?php echo $foto_1200;?>) center;		
			}
		}
		@media (max-width: 800px) {
			#sezDocumenti{
				background:url(<?php echo $foto_800;?>) center;		
			}
		}
		@media (max-width: 400px) {
			#sezDocumenti{
				background:url(<?php echo $foto_400;?>) center;		
			}
		}
	@endif
	@media (max-width: 400px) {
		#sezDocumenti{
			height:200px;
		}
	}
</style>
<div style="position:relative; width:100%; " class="bgBox" id="sezDocumenti">
	<div style="position:absolute; width:100%; height:100%; top:0: left:0px; background:rgba(<?php echo $colore_rgb;?>,0.8); display:none" id="mask_documenti"></div>
	@php
		$query_documenti = DB::table('edizioni_doc');
		$query_documenti = $query_documenti->select('*');
		$query_documenti = $query_documenti->where('id_edizione','=',$id_dett);
		$query_documenti = $query_documenti->orderby('ordine','DESC');
		$query_documenti = $query_documenti->get();
		$num_documenti = $query_documenti->count();
		
		$visibilita=0;
		$query_mod = DB::table('edizioni_modulo_iscrizioni');
		$query_mod = $query_mod->select('*');
		$query_mod = $query_mod->where('id_edizione','=',$id_dett);
		$query_mod = $query_mod->get();
		if($query_mod->count()>0){
			$visibilita=$query_mod[0]->visibilita;		
		}
	@endphp

	@if($num_documenti>0 || ($modulo_iscrizioni==1 && $visibilita==1))
	<div style="position:absolute; cursor:pointer;" id="boxDocumenti" onclick="vedi('documenti');">
	@else
	<div style="position:absolute;" id="boxDocumenti">
	@endif
		<div style="background:rgba(255,255,255,0.7); text-align:center; <?php if($num_documenti==0 && ($modulo_iscrizioni==0 || $visibilita==0)){?>color:rgba(<?php echo $colore_testo_rgb;?>,0.5)<?php }else{?>color:#<?php echo $colore_testo;?><?php }?>" class="titoliBox">
			<?php if($lingua=="ita"){?>DOCUMENTI UFFICIALI<?php }else{?>DOCUMENTS<?php }?><br/>
			<?php if($num_documenti>0 || ($modulo_iscrizioni==1 && $visibilita==1)){?><i class="fa fa-chevron-down" aria-hidden="true"></i><?php }?>
		</div>
	</div>
		
	<script>
		var h = $("#boxDocumenti").height();
		var w = $("#boxDocumenti").width();
		$("#boxDocumenti").css({"top":"50%", "margin-top":"-"+(h/2)+"px"});
		$("#boxDocumenti").css({"left":"50%", "margin-left":"-"+(w/2)+"px"});
	</script>
</div>
<div style="padding:0px 0px; background:#000; display:none;" id="link_documenti">
	@php $x=1; @endphp	
	@if($modulo_iscrizioni==1 && $visibilita==1)
		@php
			$query_mod = DB::table('edizioni_modulo_iscrizioni');
			$query_mod = $query_mod->select('testo_modulo_ita','testo_modulo_eng');
			$query_mod = $query_mod->where('id_edizione','=',$id_dett);
			$query_mod = $query_mod->get();;
		@endphp
		<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
			<div style="padding-top:14px; text-align:center;">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>regate-<?php echo $anno_regata;?>/modulo_iscrizione/<?php echo to_htaccess_url($nome_regata,"");?>-<?php echo $id_dett;?>.html" style="color:#fff">										
					<?php if($lingua=="ita"){?><?php echo $query_mod[0]->testo_modulo_ita;?> Online<?php }else{?>Online <?php echo $query_mod[0]->testo_modulo_eng;?><?php }?>
				</a>									
			</div>
		</div>
		@php $x++; @endphp
	@endif
	
	@foreach($query_documenti AS $key_documenti=>$value_documenti)
		@foreach($value_documenti AS $key_risu=>$value_risu)
			@php
				$risu_documenti[$key_risu]=$value_risu;
			@endphp
		@endforeach
		@php
			if($lingua=="ita" && $risu_documenti['link'] && $risu_documenti['link']!="") $link=$risu_documenti['link']; 
				else  $link=$risu_documenti['link_eng'];
			if($lingua=="ita" && $risu_documenti['file'] && $risu_documenti['file']!="") $pdf=$risu_documenti['file']; 
				else  $pdf=$risu_documenti['file_eng'];
		@endphp
		@if ($risu_documenti['tipo_link']=="link" && $link!="")
				<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
					<div style="padding-top:14px; text-align:center;">
						<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" style="color:#fff">										
							<?php if($lingua=="ita" && $risu_documenti['testo_link'] && $risu_documenti['testo_link']!="") echo $risu_documenti['testo_link']; 
							else echo $risu_documenti['testo_link_eng']; ?>
						</a>									
					</div>
				</div>
		@elseif ($risu_documenti['tipo_link']=="allegato" && $pdf!="" && is_file(public_path("resarea/files/regate/doc/".$pdf)))
				<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
					<div style="padding-top:14px; text-align:center; color:#fff">
						<?php 
						$testo_link = $risu_documenti['testo_link_eng']; 
						if($lingua=="ita" && $risu_documenti['testo_link'] && $risu_documenti['testo_link']!="") $testo_link = $risu_documenti['testo_link']; 
						$link_allegato = "resarea/files/regate/doc/".$pdf;
						if($risu_documenti['link_fisso']==1){
							$link_allegato = "regate-";
							if($lingua=="eng") $link_allegato = "en/regattas-";
							$link_allegato .= $anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett."/doc-".$risu_documenti['id']."/".to_htaccess_url($testo_link,"");
						}
						?>
						<a href="<?php echo $link_allegato?>" target="_blank" style="color:#fff">
							<?php echo $testo_link;?>
						</a>	
					</div>
				</div>
		@else
			<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
				<div style="padding-top:14px; text-align:center; color:#fff">
					<?php if($lingua=="ita" && $risu_documenti['testo_link'] && $risu_documenti['testo_link']!="") echo $risu_documenti['testo_link']; 
					else echo $risu_documenti['testo_link_eng'];?><?php echo $pdf;?>
				</div>
			</div>
		@endif
		@php
			$x++;
			if($x==3) $x=1;
		@endphp
	@endforeach
</div>
<!-- FINE DOCUMENTI UFFICIALI -->