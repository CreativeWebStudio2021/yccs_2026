@if($num_iscritti>0)
	<div class="list-group">
		@php
			$x=1;
		@endphp
		@foreach($query_iscritti AS $key_iscritti=>$value_iscritti)
			@php
				foreach($value_iscritti AS $key=>$value){
					$risu_iscritti[$key] = $value;
				}
			@endphp		
			<?php 
			if($lingua=="ita" && $risu_iscritti['link'] && $risu_iscritti['link']!="") $link=$risu_iscritti['link']; 
				else  $link=$risu_iscritti['link_eng'];
			if($lingua=="ita" && $risu_iscritti['file'] && $risu_iscritti['file']!="") $pdf=$risu_iscritti['file']; 
				else  $pdf=$risu_iscritti['file_eng'];
			
			if ($risu_iscritti['tipo_link']=="link" && $link!="") {
			?>
			<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
				<?php if($lingua=="ita" && $risu_iscritti['testo_link'] && $risu_iscritti['testo_link']!="") echo $risu_iscritti['testo_link']; 
				else echo $risu_iscritti['testo_link_eng']; ?>
			</a>
			<?php 
			} elseif ($risu_iscritti['tipo_link']=="allegato" && $pdf!="" && file_exists(public_path()."/resarea/files/regate/iscritti/$pdf")) {
			?>
			<a href="resarea/files/regate/iscritti/<?php echo $pdf?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
				<?php if($lingua=="ita" && $risu_iscritti['testo_link'] && $risu_iscritti['testo_link']!="") echo $risu_iscritti['testo_link']; 
				else echo $risu_iscritti['testo_link_eng']; ?>
			</a>	
			<?php 
			}else{?>
				<span class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>
					<?php 
					if($lingua=="ita" && $risu_iscritti['testo_link'] && $risu_iscritti['testo_link']!="") echo $risu_iscritti['testo_link']; 
					else echo $risu_iscritti['testo_link_eng'];?>
				</span>
			<?php }
			$x++;
			if($x==3) $x=1;?>
		@endforeach
	</div>
@endif