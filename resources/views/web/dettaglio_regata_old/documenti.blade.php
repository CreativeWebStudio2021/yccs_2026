@if($num_documenti>0)
	<div class="list-group">
		@php
			$x=1;
		@endphp
		@foreach($query_documenti AS $key_documenti=>$value_documenti)
			@php
				foreach($value_documenti AS $key=>$value){
					$risu_documenti[$key] = $value;
				}
			@endphp		
			<?php 
			if($lingua=="ita" && $risu_documenti['link'] && $risu_documenti['link']!="") $link=$risu_documenti['link']; 
				else  $link=$risu_documenti['link_eng'];
			if($lingua=="ita" && $risu_documenti['file'] && $risu_documenti['file']!="") $pdf=$risu_documenti['file']; 
				else  $pdf=$risu_documenti['file_eng'];
			if ($risu_documenti['tipo_link']=="link" && $link!="") {
				?>
				<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
					<?php if($lingua=="ita" && $risu_documenti['testo_link'] && $risu_documenti['testo_link']!="") echo $risu_documenti['testo_link']; 
					else echo $risu_documenti['testo_link_eng']; ?>
				</a>									
				<?php 
			} elseif ($risu_documenti['tipo_link']=="allegato" && $pdf!="" && file_exists(public_path()."/resarea/files/regate/doc/$pdf")) {
				?>
				<a href="resarea/files/regate/doc/<?php echo $pdf?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
					<?php if($lingua=="ita" && $risu_documenti['testo_link'] && $risu_documenti['testo_link']!="") echo $risu_documenti['testo_link']; 
					else echo $risu_documenti['testo_link_eng']; ?>
				</a>	
				<?php 
			}else{?>
				<span class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>
					<?php 
					if($lingua=="ita" && $risu_documenti['testo_link'] && $risu_documenti['testo_link']!="") echo $risu_documenti['testo_link']; 
					else echo $risu_documenti['testo_link_eng'];?>
				</span>
			<?php }
			$x++;
			if($x==3) $x=1;?>
		@endforeach
	</div>
@endif