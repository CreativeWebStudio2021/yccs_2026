@if($num_info>0)
	@php
		$x=1;
		foreach($query_info[0] AS $key_info=>$value_info){
			$risu_info[$key_info] = $value_info;
		}
	@endphp
	@foreach($query_info AS $key_info=>$value_info)
		@php
			foreach($value_info AS $key=>$value){
				$risu_info[$key] = $value;
			}
			if($lingua=="ita" && $risu_info['link'] && $risu_info['link']!="") $link=$risu_info['link']; 
				else  $link=$risu_info['link_eng'];
			if($lingua=="ita" && $risu_info['file'] && $risu_info['file']!="") $pdf=$risu_info['file']; 
				else  $pdf=$risu_info['file_eng'];
			$pdf=str_replace("admin/","resarea/",$pdf);
		@endphp
		<?php if ($risu_info['tipo_link']=="link" && $link!="") {?>
			<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
				<?php if($lingua=="ita" && $risu_info['testo_link'] && $risu_info['testo_link']!="") echo $risu_info['testo_link']; 
				else echo $risu_info['testo_link_eng']; ?>
			</a>
		<?php } elseif ($risu_info['tipo_link']=="allegato" && $pdf!="" && file_exists(public_path()."/resarea/files/regate/info/$pdf")) {?>
			<a href="resarea/files/regate/info/<?php echo $pdf?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
				<?php if($lingua=="ita" && $risu_info['testo_link'] && $risu_info['testo_link']!="") echo $risu_info['testo_link']; 
				else echo $risu_info['testo_link_eng']; ?>
			</a>	
		<?php }else{?>
			<span class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>
				<?php if($lingua=="ita" && $risu_info['testo_link'] && $risu_info['testo_link']!="") echo $risu_info['testo_link']; 
				else echo $risu_info['testo_link_eng'];?>
			</span>
		<?php }
		$x++;
		if($x==3) $x=1;
		?>
	@endforeach
@endif