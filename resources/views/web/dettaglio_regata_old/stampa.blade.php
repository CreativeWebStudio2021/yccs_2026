@if($num_stampa>0)
	<div class="list-group">
		@php
			$x=1;
		@endphp
		@foreach($query_stampa AS $key_stampa=>$value_stampa)
			@php
				foreach($value_stampa AS $key=>$value){
					$risu_stampa[$key] = $value;
				}
			@endphp
			<?php 
			$link="regate-";
			if($lingua=="eng") $link="en/regattas-";
			$link.=$anno;
			$link.="/".to_htaccess_url($nome_regata,"");
			$link.="/comunicati/";
			if($lingua=="ita" && $risu_stampa['titolo'] && $risu_stampa['titolo']!="") $link.=to_htaccess_url($risu_stampa['titolo'],"");
			else $link.=to_htaccess_url($risu_stampa['titolo_eng'],"");
			$link.="-".$risu_stampa['id'].".html";
			?>
			<a href="<?php echo $link;?>" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>
				<?php if($lingua=="ita" && $risu_stampa['titolo'] && $risu_stampa['titolo']!="") echo $risu_stampa['titolo']; 
					else echo $risu_stampa['titolo_eng']; 
				?>											
			</a>
			<?php $x++;
			if($x==3) $x=1;
			?>
		@endforeach
	</div>
@endif