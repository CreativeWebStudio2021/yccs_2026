@if($num_risultati>0)
	<div class="list-group">
		@php
			$x=1;
		@endphp
		@foreach($query_risultati AS $key_risultati=>$value_risultati)
			@php
				foreach($value_risultati AS $key=>$value){
					$risu_risultati[$key] = $value;
				}
			@endphp		
			<?php 
			if($lingua=="ita" && $risu_risultati['link'] && $risu_risultati['link']!="") $link=$risu_risultati['link']; 
				else  $link=$risu_risultati['link_eng'];
			if($lingua=="ita" && $risu_risultati['file'] && $risu_risultati['file']!="") $pdf=$risu_risultati['file']; 
				else  $pdf=$risu_risultati['file_eng'];
			
			if ($risu_risultati['tipo_link']=="link" && $link!="") {
			?>
			<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
				<?php if($lingua=="ita" && $risu_risultati['testo_link'] && $risu_risultati['testo_link']!="") echo $risu_risultati['testo_link']; 
				else echo $risu_risultati['testo_link_eng']; ?>
			</a>
			<?php 
			} elseif ($risu_risultati['tipo_link']=="allegato" && $pdf!="" && file_exists(public_path()."/resarea/files/regate/risultati/$pdf")) {
			?>
			<a href="resarea/files/regate/risultati/<?php echo $pdf?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
				<?php if($lingua=="ita" && $risu_risultati['testo_link'] && $risu_risultati['testo_link']!="") echo $risu_risultati['testo_link']; 
				else echo $risu_risultati['testo_link_eng']; ?>
			</a>	
			<?php 
			}else{?>
				<span class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>
					<?php 
					if($lingua=="ita" && $risu_risultati['testo_link'] && $risu_risultati['testo_link']!="") echo $risu_risultati['testo_link']; 
					else echo $risu_risultati['testo_link_eng'];?>
				</span>
			<?php }
			$x++;
			if($x==3) $x=1;?>
		@endforeach
	</div>
@endif