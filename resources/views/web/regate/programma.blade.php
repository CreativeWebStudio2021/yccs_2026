<div>
	@php
		$query_prog = DB::table('edizioni_info');
		$query_prog = $query_prog->select('*');
		$query_prog = $query_prog->where('id_edizione','=',$id_dett);
		$query_prog = $query_prog->where('programma','=','1');
		$query_prog = $query_prog->get();
		$num_prog = $query_prog->count();
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
			<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank">											
				<div data-space="1-1"  class="link-regata">
					<div style="display:flex; z-index:1; align-items:center; justify-content:space-between;">
						<h4><?php if($lingua=="ita"){?>Programma<?php }else{?>Programme<?php }?></h4>								
						<img src="{{ asset('web/images/freccia_thin_up.png') }}" class="arrow-link-regata">
						<img src="{{ asset('web/images/close.png') }}" class="close-link-regata">
					</div>
				</div>
			</a>			
		@elseif($query_prog[0]->tipo_link=="allegato" && $pdf!="" && file_exists(public_path()."/resarea/files/regate/info/$pdf"))
			@php
				$link_p = "resarea/files/regate/info/".$pdf;
				if($query_prog[0]->link_fisso=="1"){
					$link_p = "regate-";
					$testo_link = $query_prog[0]->testo_link_eng;
					if($lingua=="ita" && isset($query_prog[0]->testo_link) && $query_prog[0]->testo_link!="") $testo_link = $query_prog[0]->testo_link;
					if($lingua=="eng") $link_p = "en/regattas-";
					$link_p .= $anno_regata."/".creaSlug($nome_regata,"")."-".$id_dett."/info-".$query_prog[0]->id."/".creaSlug($testo_link,"");
				}
			@endphp
			<a href="<?php echo $link_p?>" target="_blank">										
				<div  data-space="1-1" class="link-regata">
					<div style="display:flex; z-index:1; align-items:center; justify-content:space-between;">
						<h4><?php if($lingua=="ita"){?>Programma<?php }else{?>Programme<?php }?></h4>									
						<img src="{{ asset('web/images/freccia_thin_up.png') }}" class="arrow-link-regata">
						<img src="{{ asset('web/images/close.png') }}" class="close-link-regata">
					</div>
				</div>
			</a>	
		@endif		
	@else
		<div style="pointer-events: none; color:var(--greyHalfDark) !important; border-color:var(--greyHalfDark) !important;" data-space="1-1" class="link-regata">
			<div style="display:flex; z-index:1; align-items:center; justify-content:space-between;">
				<h4><?php if($lingua=="ita"){?>Programma<?php }else{?>Programme<?php }?></h4>
			</div>
		</div>
	@endif	
</div>