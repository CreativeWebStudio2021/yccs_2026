<div style="width:100%; min-height:180px; padding:0; margin:0;">
	<div id="boxInfo" class="row" style="width:100%; margin:0;">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 titoliBox2" style="position:relative; margin:0; padding:0;">
			<div  id="programme" style="position:absolute; top:-100px;"></div>
			@php
				$query_prog = DB::table('edizioni_info');
				$query_prog = $query_prog->select('*');
				$query_prog = $query_prog->where('id_edizione','=',$id_dett);
				$query_prog = $query_prog->where('programma','=','1');
				$query_prog = $query_prog->get();
				$num_prog = $query_prog->count();
				$colore_programma = "#".$colore_testo;
			@endphp	
			
			@if($num_prog>0)
				@php								
					if($lingua=="ita" && isset($query_prog[0]->link) && $query_prog[0]->link!="") $link=$query_prog[0]->link; 
						else  $link=$query_prog[0]->link_eng;
					if($lingua=="ita" && isset($query_prog[0]->file) && $query_prog[0]->file!="") $pdf=$query_prog[0]->file; 
						else  $pdf=$query_prog[0]->file_eng;
					$pdf=str_replace("admin/","resarea/",$pdf);
				@endphp			
				
				@if($query_prog[0]->tipo_link=="link" && $link!="")
					<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" style="color:#<?php echo $colore_testo;?>">											
						<div style="width:200px; margin:0 auto; padding:10px 0px;" id="programmaBott">
							<?php if($lingua=="ita"){?>PROGRAMMA<?php }else{?>PROGRAMME<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i>
						</div>
					</a>			
				@elseif($query_prog[0]->tipo_link=="allegato" && $pdf!="")
					@php
						$link_p = "resarea/files/regate/info/".$pdf;
						if($query_prog[0]->link_fisso=="1"){
							$link_p = "regate-";
							$testo_link = $query_prog[0]->testo_link_eng;
							if($lingua=="ita" && isset($query_prog[0]->testo_link) && $query_prog[0]->testo_link!="") $testo_link = $query_prog[0]->testo_link;
							if($lingua=="eng") $link_p = "en/regattas-";
							$link_p .= $anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett."/info-".$query_prog[0]->id."/".to_htaccess_url($testo_link,"");
						}
					@endphp
					<a href="<?php echo $link_p?>" target="_blank" style="color:#<?php echo $colore_testo;?>">										
						<div style="width:200px; margin:0 auto; padding:10px 0px;" id="programmaBott">
							<?php if($lingua=="ita"){?>PROGRAMMA<?php }else{?>PROGRAMME<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i>
						</div>
					</a>	
				@endif		
			@else
				@php $colore_programma = "rgba(".$colore_testo.",0.5)"; @endphp
				<div style="width:200px; margin:0 auto; padding:10px 0px; color:rgba(<?php echo $colore_testo_rgb;?>,0.5);" id="programmaBott">
					<?php if($lingua=="ita"){?>PROGRAMMA<?php }else{?>PROGRAMME<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i>
				</div>
			@endif			
		</div>
		
		@php
			$query_iscritti = DB::table('edizioni_iscritti');
			$query_iscritti = $query_iscritti->select('*');
			$query_iscritti = $query_iscritti->where('id_edizione','=',$id_dett);
			$query_iscritti = $query_iscritti->orderby('ordine','DESC');
			$query_iscritti = $query_iscritti->get();
			$num_iscritti = $query_iscritti->count();
			
			$colore_iscritti = "#".$colore_testo;
		@endphp	
		
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 titoliBox2" style="position:relative; <?php if($num_iscritti>1 || ($num_iscritti==1 && $value_ed->lista_iscritti=='1')){?>cursor:pointer;"  onclick="vediDati('iscritti')<?php }?>">
			<div  id="entry_list" style="position:absolute; top:-100px;"></div>
			@if($num_iscritti==1 && $value_ed->lista_iscritti=='0')
				@php
					if($lingua=="ita" && $query_iscritti[0]->link &&  $query_iscritti[0]->link!="") $link= $query_iscritti[0]->link; 
						else  $link= $query_iscritti[0]->link_eng;
					if($lingua=="ita" &&  $query_iscritti[0]->file && $query_iscritti[0]->file!="") $pdf=$query_iscritti[0]->file; 
						else  $pdf=$query_iscritti[0]->file_eng;
				@endphp
				
				@if ($query_iscritti[0]->tipo_link=="link" && $link!="")
					<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" style="color:#<?php echo $colore_testo;?>">										
						<div style="width:200px; margin:0 auto;  padding:10px 0px;" id="iscrittiBott"><?php if($lingua=="ita"){?>ISCRITTI<?php }else{?>ENTRY LIST<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
					</a>
				@elseif ($query_iscritti[0]->tipo_link=="allegato" && $pdf!="" && is_file("resarea/files/regate/iscritti/$pdf"))
					@php
						$link_i = "resarea/files/regate/iscritti/".$pdf;
						if($query_iscritti[0]->link_fisso=="1"){
							$link_i = "regate-";
							$testo_link = $query_iscritti[0]->testo_link_eng;
							if($lingua=="ita" && isset($query_iscritti[0]->testo_link) && $query_iscritti[0]->testo_link!="") $testo_link = $query_iscritti[0]->testo_link;
							if($lingua=="eng") $link_i = "en/regattas-";
							$link_i .= $anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett."/iscritti-".$query_iscritti[0]->id."/".to_htaccess_url($testo_link,"");
						}
					@endphp
					<a href="<?php echo $link_i?>" target="_blank" style="color:#<?php echo $colore_testo;?>">										
						<div style="width:200px; margin:0 auto;  padding:10px 0px;" id="iscrittiBott"><?php if($lingua=="ita"){?>ISCRITTI<?php }else{?>ENTRY LIST<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
					</a>	
				@else
					@php $colore_iscritti = "rgba(".$colore_testo.",0.5)"; @endphp
					<div style="width:200px; margin:0 auto;  padding:10px 0px; color:rgba(<?php echo $colore_testo_rgb;?>,0.5);" id="iscrittiBott"><?php if($lingua=="ita"){?>ISCRITTI<?php }else{?>ENTRY LIST<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
				@endif
			@elseif($num_iscritti==0 && $value_ed->lista_iscritti=='1')
				<a href="regate-<?php echo $anno_regata;?>/entry_list/<?php echo to_htaccess_url($nome_regata,"");?>-<?php echo $value_ed->id;?>.html" style="color:#<?php echo $colore_testo;?>">
					<div style="width:200px; margin:0 auto;  padding:10px 0px;" id="iscrittiBott"><?php if($lingua=="ita"){?>ISCRITTI<?php }else{?>ENTRY LIST<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
				</a>
			@else
				<div style="width:200px; margin:0 auto;  padding:10px 0px; <?php if($num_iscritti==0){ $colore_iscritti = "rgba(".$colore_testo.",0.5)";?>color:rgba(<?php echo $colore_testo_rgb;?>,0.5);<?php }else{?>color:#<?php echo $colore_testo;?><?php }?>" id="iscrittiBott"><?php if($lingua=="ita"){?>ISCRITTI<?php }else{?>ENTRY LIST<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
			@endif
		</div>
		
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 titoliBox2" style="position:relative;">
			<div  id="palmares" style="position:absolute; top:-100px;"></div>
			@php
				$query_albo = DB::table('edizioni_risultati');
				$query_albo = $query_albo->select('*');
				$query_albo = $query_albo->where('id_edizione','=',$id_dett);
				$query_albo = $query_albo->where('albodoro','=','1');
				$query_albo = $query_albo->get();
				$num_albo = $query_albo->count();				
				
				$pdf=""; 
				$tipo_link="";
				
				if($num_albo>0){
					$tipo_link=$query_albo[0]->tipo_link;
					if($lingua=="ita" && $query_albo[0]->link && $query_albo[0]->link!="") $link=$query_albo[0]->link; 
						else  $link=$query_albo[0]->link_eng;
					if($lingua=="ita" && $query_albo[0]->file && $query_albo[0]->file!="") $pdf=$query_albo[0]->file; 
						else  $pdf=$query_albo[0]->file_eng;
					$pdf=str_replace("admin/","resarea/",$pdf);
				}
				
				$colore_albo='#<?php echo $colore_testo;?>';
			@endphp
			<?php 
			
			?>
			
			@if ($tipo_link=="link" && $link!="")
				<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" style="color:#<?php echo $colore_testo;?>">											
					<div style="width:200px; margin:0 auto; padding:10px 0px;" id="programmaBott">
						<?php if($lingua=="ita"){?>ALBO D'ORO<?php }else{?>PALMARES<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i>
					</div>
				</a>
			@elseif ($tipo_link=="allegato" && $pdf!="" && is_file("resarea/files/regate/risultati/$pdf"))
				@php
					$link_albo = "resarea/files/regate/risultati/".$pdf;
					if($query_albo[0]->link_fisso=="1"){
						$link_albo = "regate-";
						$testo_link = $query_albo[0]->testo_link_eng;
						if($lingua=="ita" && isset($query_albo[0]->testo_link) && $query_albo[0]->testo_link!="") $testo_link = $query_albo[0]->testo_link;
						if($lingua=="eng") $link_albo = "en/regattas-";
						$link_albo .= $anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett."/risultati-".$query_albo[0]->id."/".to_htaccess_url($testo_link,"");
					}
				@endphp
				<a href="<?php echo $link_albo?>" target="_blank" style="color:#<?php echo $colore_testo;?>">										
					<div style="width:200px; margin:0 auto; padding:10px 0px;" id="programmaBott">
						<?php if($lingua=="ita"){?>ALBO D'ORO<?php }else{?>PALMARES<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i>
					</div>
				</a>	
			@else
				@php $colore_albo='rgba('.$colore_testo_rgb.',0.5);'; @endphp
				<div style="width:200px; margin:0 auto; padding:10px 0px; color:rgba(<?php echo $colore_testo_rgb;?>,0.5);" id="programmaBott">
					<?php if($lingua=="ita"){?>ALBO D'ORO<?php }else{?>PALMARES<?php }?><br/><i class="fa fa-chevron-down" aria-hidden="true"></i>
				</div>
			@endif
		</div>
		
		@php
			$crew_board  = $value_ed->crew_board;
			$colore_crew_board='#<?php echo $colore_testo;?>';
		@endphp
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 titoliBox2" style="position:relative; <?php if($crew_board==1){?>cursor:pointer;color:#<?php echo $colore_testo;?>"  onclick="vediDati('crewBoat')<?php }else{ $colore_crew_board="rgba(".$colore_testo_rgb.",0.5)"; ?>color:rgba(<?php echo $colore_testo_rgb;?>,0.5);<?php }?>">
			<div  id="crew_board" style="position:absolute; top:-100px;"></div>
			<div style="width:200px; margin:0 auto;  padding:10px 0px;" id="crewBoatBott">CREW/BOAT BOARD<br/><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
		</div>
		<div style="clear:both"></div>
	</div>	
	<script>
		var h = $("#boxInfo").height();
		$("#boxInfo").css({"padding-top":(90-(h/2))+"px"});
		
		var sel="";
		function vediDati(sez){
			$("#programma").css({"display":"none"});
			$("#programmaBott").css({"background":"#fff","color":"<?php echo $colore_programma;?>"});
			$("#iscritti").css({"display":"none"});
			$("#iscrittiBott").css({"background":"#fff","color":"<?php echo $colore_iscritti;?>"});
			$("#albo").css({"display":"none"});
			$("#alboBott").css({"background":"#fff","color":"<?php echo $colore_albo;?>"});
			$("#crewBoat").css({"display":"none"});
			$("#crewBoatBott").css({"background":"#fff","color":"<?php echo $colore_crew_board;?>"});
			if (sel=="" || sel==sez) $("#boxDati").slideToggle();
			if (sel!=sez){
				$("#"+sez+"Bott").css({"background":"#<?php echo $colore;?>","color":"#fff"});
				$("#"+sez).fadeIn();
				sel = sez;
			}else sel="";
		}
	</script>
</div>
<div style="display:none" id="boxDati">
	
	@include('web.dettaglio_regata_v2.box_info_programma')	
	@include('web.dettaglio_regata_v2.box_info_iscritti')	
	@include('web.dettaglio_regata_v2.box_info_crew_boat_board')	
</div>
