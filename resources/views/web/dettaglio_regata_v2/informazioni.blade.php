<!-- INFORMAZIONI GENERALI -->
<div  id="info"></div>
@php
	$ante = '';
	$foto = "https://www.yccs.it/images/new/LPCSRR16lb_14451.jpg";
	$foto_1200 = $foto_800 = $foto_400 = $foto;
	$img_informazioni = isset($value_ed) ? ($value_ed->img_informazioni ?? '') : '';
	if(!empty($img_informazioni)){
		$ante = smartAsset("resarea/img_up/regate/".$img_informazioni);
		$foto_1200 = $foto_800 = $foto_400 = $ante;
		if(file_exists(public_path("resarea/img_up/regate/1200_".$img_informazioni))) $foto_1200 = asset("resarea/img_up/regate/1200_".$img_informazioni);
		if(file_exists(public_path("resarea/img_up/regate/800_".$img_informazioni))) $foto_800 = asset("resarea/img_up/regate/800_".$img_informazioni);
		if(file_exists(public_path("resarea/img_up/regate/400_".$img_informazioni))) $foto_400 = asset("resarea/img_up/regate/400_".$img_informazioni);
	}
@endphp

<style>
	#sezInfo{
		background:url(<?php echo $ante;?>) center;
		background-size:cover;
		height:500px;
	}
	@media (max-width: 1920px) {
		#sezInfo{
			background:url(<?php echo $ante;?>) center;		
			background-size:initial;
			height:388px;
		}
	}
	@if($img_informazioni && trim($img_informazioni)!="" && is_file(public_path("resarea/img_up/regate/".$img_informazioni)))
		@media (max-width: 1200px) {
			#sezInfo{
				background:url(<?php echo $foto_1200;?>) center;		
			}
		}
		@media (max-width: 800px) {
			#sezInfo{
				background:url(<?php echo $foto_800;?>) center;		
			}
		}
		@media (max-width: 400px) {
			#sezInfo{
				background:url(<?php echo $foto_400;?>) center;		
			}
		}
	@endif
	@media (max-width: 400px) {
		#sezInfo{
			height:200px;
		}
	}
</style>
<div style="position:relative; width:100%; margin-top:10px;" class="bgBox" id="sezInfo">
	<div style="position:absolute; width:100%; height:100%; top:0: left:0px; background:rgba(<?php echo $colore_rgb;?>,0.8); display:none" id="mask_generali"></div>
	@php
		$query_info = DB::table('edizioni_info');
		$query_info = $query_info->select('*');
		$query_info = $query_info->where('id_edizione','=',$id_dett);
		$query_info = $query_info->where('programma','=','0');
		$query_info = $query_info->orderby('ordine','DESC');
		$query_info = $query_info->get();
		$num_info = $query_info->count();	

		$caso=0;
		if($num_info==1){
			if($lingua=="ita" && $query_info[0]->link && $query_info[0]->link!="") $link=$query_info[0]->link; 
				else  $link=$query_info[0]->link_eng;
			if($lingua=="ita" && $query_info[0]->file && $query_info[0]->file!="") $pdf=$query_info[0]->file; 
				else  $pdf=$query_info[0]->file_eng;
			if ($query_info[0]->tipo_link=="link" && $link!="") $caso=1;
			elseif ($query_info[0]->tipo_link=="allegato" && $pdf!="" && is_file(public_path("resarea/files/regate/info/".$pdf))) $caso=2;
			else $caso=3;
		}
	@endphp

	<div style="position:absolute; <?php if($num_info>0){?>cursor:pointer;<?php }?>" id="boxGen" <?php if($num_info>0){?>onclick="vedi('generali');"<?php }?>>
		<?php if($caso==1 || $caso==2){?>
			<a href="<?php if($caso==1){?><?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?><?php }else{?>resarea/files/regate/info/<?php echo $pdf?><?php }?>">
		<?php }?>
			<div style="background:rgba(255,255,255,0.7); text-align:center; <?php if($num_info==0 || $caso==3){?>color:rgba(<?php echo $colore_testo_rgb;?>,0.5)<?php }else{?>color:#<?php echo $colore_testo;?><?php }?>" class="titoliBox">
				<?php if($lingua=="ita"){?>INFORMAZIONI GENERALI<?php }else{?>INFO<?php }?><br/>
				<?php if($num_info>0){?><i class="fa fa-chevron-down" aria-hidden="true"></i><?php }?>
			</div>
		<?php if($caso==1 || $caso==2){?></a><?php }?>
	</div>
		
	<script>
		var h = $("#boxGen").height();
		var w = $("#boxGen").width();
		$("#boxGen").css({"top":"50%", "margin-top":"-"+(h/2)+"px"});
		$("#boxGen").css({"left":"50%", "margin-left":"-"+(w/2)+"px"});
	</script>
</div>
<div style=" background:#000; display:none;" id="link_generali">		
	@if($num_info>1)
		@php $x=1; @endphp
		@foreach($query_info AS $key_info=>$value_info)
			@foreach($value_info AS $key_risu=>$value_risu)
				@php
					$risu_info[$key_risu]=$value_risu;
				@endphp
			@endforeach
			@php
				if($lingua=="ita" && $risu_info['link'] && $risu_info['link']!="") $link=$risu_info['link']; 
					else  $link=$risu_info['link_eng'];
				if($lingua=="ita" && $risu_info['file'] && $risu_info['file']!="") $pdf=$risu_info['file']; 
					else  $pdf=$risu_info['file_eng'];
			@endphp
			@if ($risu_info['tipo_link']=="link" && $link!="")
				<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
					<div style="padding-top:14px; text-align:center;">
						<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" style="color:#fff">										
							<?php if($lingua=="ita" && $risu_info['testo_link'] && $risu_info['testo_link']!="") echo $risu_info['testo_link']; 
							else echo $risu_info['testo_link_eng']; ?>
						</a>									
					</div>
				</div>
			@elseif ($risu_info['tipo_link']=="allegato" && $pdf!="" && is_file(public_path("resarea/files/regate/info/".$pdf)))
				<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
					<div style="padding-top:14px; text-align:center; color:#fff">
						<?php 
						$testo_link = $risu_info['testo_link_eng']; 
						if($lingua=="ita" && $risu_info['testo_link'] && $risu_info['testo_link']!="") $testo_link = $risu_info['testo_link']; 
						$link_allegato = "resarea/files/regate/info/".$pdf;
						if($risu_info['link_fisso']==1){
							$link_allegato = "regate-";
							if($lingua=="eng") $link_allegato = "en/regattas-";
							$link_allegato .= $anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett."/info-".$risu_info['id']."/".to_htaccess_url($testo_link,"");
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
						<?php if($lingua=="ita" && $risu_info['testo_link'] && $risu_info['testo_link']!="") echo $risu_info['testo_link']; 
						else echo $risu_info['testo_link_eng'];?>
					</div>
				</div>
			@endif
			@php	
				$x++;
				if($x==3) $x=1;
			@endphp
		@endforeach
	@endif
	
</div>


<!-- FINE INFORMAZIONI GENERALI -->