@include('web.common.v2.functions')
@extends('web.index')

@section('content')
	@php
		$query_ed = DB::table('edizioni_regate');
		$query_ed = $query_ed->select('*');
		$query_ed = $query_ed->where('id','=',$id_dett);
		$query_ed = $query_ed->where('visibile','=','1');
		$query_ed = $query_ed->where('new','=','1');
		$query_ed = $query_ed->get();
		$num_ed = $query_ed->count();
	@endphp

	@if($num_ed>0)
		@php	
			$nome_regata = $query_ed[0]->nome_regata;
			$luogo    =  $query_ed[0]->luogo;
			$anno_regata   =  $query_ed[0]->anno;
			$titolo_regata=$nome_regata." - ".$luogo." ".$anno_regata;
			
			$link_back="regate-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
			if($lingua=="eng") $link_back="en/regattas-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		@endphp	

		<section class="content" style="margin-top:30px;">
			<div class="container"> 
				<a href="<?php echo $link_back;?>"><div style="width:300px; margin:0 auto; padding:10px 0; border:solid 1px #<?php echo $colore_testo;?>; color:#<?php echo $colore_testo;?>; text-align:center; margin-top:-25px; margin-bottom:30px"><b><?php if($lingua=="ita"){?>TORNA ALLA HOME REGATA<?php }else{?>BACK TO REGATTA<?php }?></b></div></a>	
				<!-- Blog post-->
				 <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
					@php
						$query_press = DB::table('press');
						$query_press = $query_press->select('*');
						$query_press = $query_press->where('id_edizione','=',$id_dett);
						$query_press = $query_press->orderby('data','DESC');
						$query_press = $query_press->get();
					@endphp
					@foreach($query_press AS $key_press=>$value_press)
						@foreach($value_press AS $key_risu=>$value_risu)
							@php
								$risu_press[$key_risu]=$value_risu;
							@endphp
						@endforeach
						@php
							$titolo = $risu_press['titolo'];
							if($lingua=="eng"){
								if($risu_press['titolo_eng'] && trim($risu_press['titolo_eng'])!="") $titolo = $risu_press['titolo_eng'];
							}
							$testo = $risu_press['testo'];
							if($lingua=="eng"){
								if($risu_press['testo_eng'] && trim($risu_press['testo_eng'])!="") $testo = $risu_press['testo_eng'];
							}
							
							$link='regate-'.$anno_regata.'/press/'.to_htaccess_url($nome_regata,"").'-'.$id_dett.'/'.to_htaccess_url($titolo,"").'-'.$risu_press['id'].'.html';
							if($lingua=="eng") $link='en/regattas-'.$anno_regata.'/press/'.to_htaccess_url($nome_regata,"").'-'.$id_dett.'/'.to_htaccess_url($titolo,"").'-'.$risu_press['id'].'.html';
						@endphp
						<!-- Blog image post-->
						<div class="post-item border">
							<div class="post-item-wrap">
								@if (!empty($risu_press['foto1']))
									@php
										if(is_file("resarea/img_up/regate/press/".$risu_press['foto1'])) 
											$ante = "resarea/img_up/regate/press/".$risu_press['foto1'];
										else $ante  = "https://www.yccs.it/resarea/img_up/regate/press/".$risu_press['foto1'];
									@endphp
								
									<div class="post-image">
										<a href="<?php echo $link;?>">
											<img alt="" src="<?php echo $ante;?>">
										</a>
									</div>
								@endif
								<div class="post-item-description">
									<span class="post-meta-date" style="color:#111"><i class="icon-calendar"></i><?php  echo date_to_data($risu_press['data'],"/"); ?></span>
									<h2><a href="<?php echo $link;?>"><?php echo $titolo;?></a></h2>
									<p><?php  echo substr(strip_tags($testo),0,100); ?>...</p>
									<a href="<?php echo $link;?>" class="item-link" style="color:#888888"><b><?php if($lingua=="ita"){?>leggi<?php }else{?>read more<?php }?></b> <i class="icon-chevron-right"></i></a>
								</div>
							</div>
						</div>
					@endforeach
					<!-- END: Blog post--> 
				</div>
			</div>
		</section>
		<!-- END: SECTION --> 
	@else
		<script>
			window.location="<?php echo $http;?>://<?php echo $ind_sito;?>/home.html";
		</script>
	@endif	
@endsection