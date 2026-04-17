<div style="padding:0px 0px; background:#000; display:none;" id="iscritti">
	@php $x=1; @endphp	
	@if($value_ed->lista_iscritti=='1')
		<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
			<div style="padding-top:14px; text-align:center;">
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>regate-<?php echo $anno_regata;?>/entry_list/<?php echo to_htaccess_url($nome_regata,"");?>-<?php echo $id_dett;?>.html"  style="color:#fff">
					<?php if($lingua=="ita"){?>Lista Iscritti<?php }else{?>Entry List<?php }?>
				</a>
			</div>
		</div>
		@php $x++; @endphp
	@endif
	@if($num_iscritti>1 || ($num_iscritti==1 && $value_ed->lista_iscritti=='1'))
		@foreach($query_iscritti AS $key_iscritti=>$value_iscritti)		
			@php
				if($lingua=="ita" && $value_iscritti->link && $value_iscritti->link!="") $link=$value_iscritti->link; 
					else  $link=$value_iscritti->link_eng;
				if($lingua=="ita" && $value_iscritti->file && $value_iscritti->file!="") $pdf=$value_iscritti->file; 
					else  $pdf=$value_iscritti->file_eng;
			@endphp
			@if ($value_iscritti->tipo_link=="link" && $link!="")
				<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
					<div style="padding-top:14px; text-align:center;">
						<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" style="color:#fff">
							<?php if($lingua=="ita" && $value_iscritti->testo_link && $value_iscritti->testo_link!="") echo $value_iscritti->testo_link; 
							else echo $value_iscritti->testo_link_eng; ?>
						</a>
					</div>
				</div>
			@elseif ($value_iscritti->tipo_link=="allegato" && $pdf!="" && file_exists(public_path()."/resarea/files/regate/iscritti/$pdf"))
				<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
					<div style="padding-top:14px; text-align:center;">
						<?php 
						$testo_link =$value_iscritti->testo_link_eng; 
						if($lingua=="ita" && $value_iscritti->testo_link && $value_iscritti->testo_link!="") $testo_link = $value_iscritti->testo_link; 
						$link_allegato = "resarea/files/regate/iscritti/".$pdf;
						if($value_iscritti->link_fisso==1){
							$link_allegato = "regate-";
							if($lingua=="eng") $link_allegato = "en/regattas-";
							$link_allegato .= $anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett."/iscritti-".$value_iscritti->id."/".to_htaccess_url($testo_link,"");
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
						<?php if($lingua=="ita" && $value_iscritti->testo_link && $value_iscritti->testo_link!="") echo $value_iscritti->testo_link; 
						else echo $value_iscritti->testo_link_eng;?>
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