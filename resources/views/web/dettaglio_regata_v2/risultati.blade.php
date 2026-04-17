<!-- RISULTATI -->
<div  id="results"></div>
@php
	$ante = '';
	$foto = "https://www.yccs.it/images/new/LPCSRR16ff_04166.jpg";
	$foto_1200 = $foto_800 = $foto_400 = $foto;
	$img_risultati = isset($value_ed) ? ($value_ed->img_risultati ?? '') : '';
	if(!empty($img_risultati)){
		$ante = smartAsset("resarea/img_up/regate/".$img_risultati);
		$foto_1200 = $foto_800 = $foto_400 = $ante;
		if(file_exists(public_path("resarea/img_up/regate/1200_".$img_risultati))) $foto_1200 = asset("resarea/img_up/regate/1200_".$img_risultati);
		if(file_exists(public_path("resarea/img_up/regate/800_".$img_risultati))) $foto_800 = asset("resarea/img_up/regate/800_".$img_risultati);
		if(file_exists(public_path("resarea/img_up/regate/400_".$img_risultati))) $foto_400 = asset("resarea/img_up/regate/400_".$img_risultati);
	}
@endphp
<style>
	#sezRisultati{
		background:url(<?php echo $ante;?>) center;
		background-size:cover;
		height:500px;
	}
	@media (max-width: 1920px) {
		#sezRisultati{
			background:url(<?php echo $ante;?>) center;		
			background-size:initial;
			height:388px;
		}
	}
	<?php if($img_risultati && trim($img_risultati)!="" && is_file(public_path("resarea/img_up/regate/".$img_risultati))){?>
		@media (max-width: 1200px) {
			#sezRisultati{
				background:url(<?php echo $foto_1200;?>) center;		
			}
		}
		@media (max-width: 800px) {
			#sezRisultati{
				background:url(<?php echo $foto_800;?>) center;		
			}
		}
		@media (max-width: 400px) {
			#sezRisultati{
				background:url(<?php echo $foto_400;?>) center;		
			}
		}
	<?php }?>
	@media (max-width: 400px) {
		#sezRisultati{
			height:200px;
		}
	}
</style>
<div style="position:relative; width:100%; " class="bgBox" id="sezRisultati">
	<div style="position:absolute; width:100%; height:100%; top:0: left:0px; background:rgba(<?php echo $colore_rgb;?>,0.8); display:none" id="mask_risultati"></div>
	@php
		$query_risultati = DB::table('edizioni_risultati');
		$query_risultati = $query_risultati->select('*');
		$query_risultati = $query_risultati->where('id_edizione','=',$id_dett);
		$query_risultati = $query_risultati->where('albodoro','=','0');
		$query_risultati = $query_risultati->orderby('ordine','DESC');
		$query_risultati = $query_risultati->get();
		$num_risultati = $query_risultati->count();	

		$caso=0;
		if($num_risultati==1){			
			if($lingua=="ita" && isset($query_risultati[0]->link) && $query_risultati[0]->link!="") $link=$query_risultati[0]->link; 
				else  $link=$query_risultati[0]->link_eng;
			if($lingua=="ita" && isset($query_risultati[0]->file) && $query_risultati[0]->file!="") $pdf=$query_risultati[0]->file; 
				else  $pdf=$query_risultati[0]->file_eng;
			if ($query_risultati[0]->tipo_link=="link" && $link!="") $caso=1;
			elseif ($query_risultati[0]->tipo_link=="allegato" && $pdf!="" && is_file(public_path("resarea/files/regate/risultati/".$pdf))) $caso=2;
			else $caso=3;
		}
	@endphp

	<div style="position:absolute; <?php if($num_risultati>0){?>cursor:pointer;<?php }?>" id="boxRisultati" <?php if($num_risultati>0){?>onclick="vedi('risultati');"<?php }?>>
		<?php if($caso==1 || $caso==2){
			$link_r = "";
			if($caso==1){
				if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){
					$link_r .= config('app.url');
				}
				$link_r .= $link;
			}else{
				if($query_risultati[0]->link_fisso=="0")
					$link_r = "resarea/files/regate/risultati/".$pdf;
				else
					$link_r = "regate-";
					$testo_link = $query_risultati[0]->testo_link_eng;
					if($lingua=="ita" && isset($query_risultati[0]->testo_link) && $query_risultati[0]->testo_link!="") $testo_link = $query_risultati[0]->testo_link;
					if($lingua=="eng") $link_r = "en/regattas-";
					$link_r .= $anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett."/risultati-".$query_risultati[0]->id."/".to_htaccess_url($testo_link,"");
			}
			?>
			<a href="<?php echo $link_r;?>" target="_blank">
		<?php }?>
			<div style="background:rgba(255,255,255,0.7); text-align:center; <?php if($num_risultati==0 || $caso==3){?>color:rgba(<?php echo $colore_testo_rgb;?>,0.5)<?php }else{?>color:#<?php echo $colore_testo;?><?php }?>" class="titoliBox">
				<?php if($lingua=="ita"){?>RISULTATI<?php }else{?>RESULTS<?php }?><br/>
				<?php if($num_risultati>0){?><i class="fa fa-chevron-down" aria-hidden="true"></i><?php }?>
			</div>
		<?php if($caso==1 || $caso==2){?></a><?php }?>
	</div>
		
	<script>
		var h = $("#boxRisultati").height();
		var w = $("#boxRisultati").width();
		$("#boxRisultati").css({"top":"50%", "margin-top":"-"+(h/2)+"px"});
		$("#boxRisultati").css({"left":"50%", "margin-left":"-"+(w/2)+"px"});
	</script>
</div>
<div style="background:#000; display:none;" id="link_risultati">
	
	@if($num_risultati>1)
		@php $x=1; @endphp
		@foreach($query_risultati AS $key_risultati=>$value_risultati)
			@foreach($value_risultati AS $key_risu=>$value_risu)
				@php
					$risu_risultati[$key_risu]=$value_risu;
				@endphp
			@endforeach
			@php
				if($lingua=="ita" && isset($risu_risultati['link']) && $risu_risultati['link']!="") $link=$risu_risultati['link']; 
					else  $link=$risu_risultati['link_eng'];
				if($lingua=="ita" && isset($risu_risultati['file']) && $risu_risultati['file']!="") $pdf=$risu_risultati['file']; 
					else  $pdf=$risu_risultati['file_eng'];
			@endphp
			@if ($risu_risultati['tipo_link']=="link" && $link!="")
					<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
						<div style="padding-top:14px; text-align:center;">
							<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" style="color:#fff">										
								<?php if($lingua=="ita" && isset($risu_risultati['testo_link']) && $risu_risultati['testo_link']!="") echo $risu_risultati['testo_link']; 
								else echo $risu_risultati['testo_link_eng']; ?>
							</a>									
						</div>
					</div>
			@elseif ($risu_risultati['tipo_link']=="allegato" && $pdf!="" && is_file(public_path("resarea/files/regate/risultati/".$pdf)))
					<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
						<div style="padding-top:14px; text-align:center; color:#fff">
							<?php 
							$testo_link = $risu_risultati['testo_link_eng']; 
							if($lingua=="ita" && $risu_risultati['testo_link'] && $risu_risultati['testo_link']!="") $testo_link = $risu_risultati['testo_link']; 
							$link_allegato = "resarea/files/regate/risultati/".$pdf;
							if($risu_risultati['link_fisso']==1){
								$link_allegato = "regate-";
								if($lingua=="eng") $link_allegato = "en/regattas-";
								$link_allegato .= $anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett."/risultati-".$risu_risultati['id']."/".to_htaccess_url($testo_link,"");
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
						<?php if($lingua=="ita" && isset($risu_risultati['testo_link']) && $risu_risultati['testo_link']!="") echo $risu_risultati['testo_link']; 
						else echo $risu_risultati['testo_link_eng'];?>
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
<!-- FINE RISULTATI -->