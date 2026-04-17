@if($value_ed->visible_noticeboard==1)
	<!-- COMUNICATI -->
	<div  id="noticeboard"></div>
	@php
		$img_noticeboard   = $value_ed->img_noticeboard;
		$foto = "https://www.yccs.it/web/images/new/LPCSRR16ff_03949.jpg";
		$ante = $foto;
		if(!empty($img_noticeboard)){ 
			if(is_file("resarea/img_up/regate/".$img_noticeboard))
				$ante = "resarea/img_up/regate/".$img_noticeboard;
			else 
				$ante = "https://www.yccs.it/resarea/img_up/regate/".$img_noticeboard;
			
			$foto_1200 = $ante;
			$foto_800 = $ante;
			$foto_400 = $ante;
			
			if(is_file("resarea/img_up/regate/1200_".$img_noticeboard)) $foto_1200 = "resarea/img_up/regate/1200_".$img_noticeboard;
			if(is_file("resarea/img_up/regate/800_".$img_noticeboard)) $foto_800 = "resarea/img_up/regate/800_".$img_noticeboard;
			if(is_file("resarea/img_up/regate/400_".$img_noticeboard)) $foto_400 = "resarea/img_up/regate/400_".$img_noticeboard;					
		}
	@endphp
	
	<style>
		#sezNoticeBoard{
			background:url(<?php echo $ante;?>) center;
			background-size:cover;
			height:500px;
		}
		@media (max-width: 1920px) {
			#sezNoticeBoard{
				background:url(<?php echo $ante;?>) center;		
				background-size:initial;
				height:388px;
			}
		}
		@if($img_noticeboard && trim($img_noticeboard)!="" && is_file("resarea/img_up/regate/".$img_noticeboard))
			@media (max-width: 1200px) {
				#sezNoticeBoard{
					background:url(<?php echo $foto_1200;?>) center;		
				}
			}
			@media (max-width: 800px) {
				#sezNoticeBoard{
					background:url(<?php echo $foto_800;?>) center;		
				}
			}
			@media (max-width: 400px) {
				#sezNoticeBoard{
					background:url(<?php echo $foto_400;?>) center;		
				}
			}
		@endif
		@media (max-width: 400px) {
			#sezNoticeBoard{
				height:200px;
			}
		}
	</style>
	<div style="position:relative; width:100%; " class="bgBox" id="sezNoticeBoard">
		<div style="position:absolute; width:100%; height:100%; top:0: left:0px; background:rgba(<?php echo $colore_rgb;?>,0.8); display:none" id="mask_noticeboard"></div>
		@php
			$query_noticeboard = DB::table('edizioni_noticeboard');
			$query_noticeboard = $query_noticeboard->select('*');
			$query_noticeboard = $query_noticeboard->where('id_edizione','=',$id_dett);
			$query_noticeboard = $query_noticeboard->orderby('ordine','DESC');
			$query_noticeboard = $query_noticeboard->get();
			$num_noticeboard = $query_noticeboard->count();
		@endphp
		
		@if($num_noticeboard>0)
		<div style="position:absolute; cursor:pointer;" id="boxNoticeBoard" onclick="vedi('noticeboard');">
		@else
		<div style="position:absolute;" id="boxNoticeBoard">
		@endif
			<div style="background:rgba(255,255,255,0.7); text-align:center; <?php if($num_noticeboard==0){?>color:rgba(<?php echo $colore_testo_rgb;?>,0.5)<?php }else{?>color:#<?php echo $colore_testo;?><?php }?>" class="titoliBox">
				<?php if($lingua=="ita"){?>ALBO DEI COMUNICATI<?php }else{?>OFFICIAL NOTICE BOARD<?php }?><br/> 
				<?php if($num_noticeboard>0){?><i class="fa fa-chevron-down" aria-hidden="true"></i><?php }?>
			</div>
		</div>
			
		<script>
			var h = $("#boxNoticeBoard").height();
			var w = $("#boxNoticeBoard").width();
			$("#boxNoticeBoard").css({"top":"50%", "margin-top":"-"+(h/2)+"px"});
			$("#boxNoticeBoard").css({"left":"50%", "margin-left":"-"+(w/2)+"px"});
		</script>
	</div>
	<div style="padding:0px 0px; background:#000; display:none;" id="link_noticeboard">
		@php
			$x=1;
		@endphp
		
		@foreach($query_noticeboard AS $key_noticeboard=>$value_noticeboard)
			@php
			if($lingua=="ita" && $value_noticeboard->link && $value_noticeboard->link!="") $link=$value_noticeboard->link; 
				else  $link=$value_noticeboard->link_eng;
			if($lingua=="ita" && $value_noticeboard->file && $value_noticeboard->file!="") $pdf=$value_noticeboard->file; 
				else  $pdf=$value_noticeboard->file_eng;
			@endphp
			
			@if ($value_noticeboard->tipo_link=="link" && $link!="")
				<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
					<div style="padding-top:14px; text-align:center;">
						<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?>/<?php }?><?php echo $link?>" target="_blank" style="color:#fff">										
							<?php if($lingua=="ita" && $value_noticeboard->testo_link && $value_noticeboard->testo_link!="") echo $value_noticeboard->testo_link; 
							else echo $value_noticeboard->testo_link_eng; ?>
						</a>									
					</div>
				</div>
			@elseif ($value_noticeboard->tipo_link=="allegato" && $pdf!=""))
				<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
					<div style="padding-top:14px; text-align:center; color:#fff">
						<a href="resarea/files/regate/noticeboard/<?php echo $pdf?>" target="_blank" style="color:#fff">
							<?php if($lingua=="ita" && $value_noticeboard->testo_link && $value_noticeboard->testo_link!="") echo $value_noticeboard->testo_link; 
							else echo $value_noticeboard->testo_link_eng; ?>
						</a>	
					</div>
				</div>
			@elseif ($value_noticeboard->tipo_link=="titolo")
				<div style="width:100%; min-height:50px; background:rgba(255,255,255,0.9)">
					<div style="padding-top:14px; text-align:center; color:#494949; font-weight:700">
						
							<?php if($lingua=="ita" && $value_noticeboard->testo_link && $value_noticeboard->testo_link!="") echo $value_noticeboard->testo_link; 
							else echo $value_noticeboard->testo_link_eng; ?>
							
					</div>
				</div>
			@else
				<div style="width:100%; min-height:50px; background:<?php if($x==1){?>rgba(<?php echo $colore_rgb;?>,1)<?php }else{?>rgba(<?php echo $colore_rgb;?>,0.9)<?php }?>">
					<div style="padding-top:14px; text-align:center; color:#fff">
						<?php if($lingua=="ita" && $value_noticeboard->testo_link && $value_noticeboard->testo_link!="") echo $value_noticeboard->testo_link; 
						else echo $value_noticeboard->testo_link_eng;?>
					</div>
				</div>
			@endif
			@php
				$x++;
				if($x==3) $x=1;
			@endphp
		@endforeach
	</div>
	<div style="width:100%; height:10px"></div>
	<!-- FINE COMUNICATI -->
@endif