@php
	if(!isset($anno_ric)) $anno_ric=date("Y");
	if(!isset($arg_ric)) $arg_ric="";
@endphp

<style>
	.sidebarTitle{padding-bottom:10px; border-bottom:solid 4px #444444}
</style>

<div class="widget clearfix widget-archive">
	<h4 class="widget-title"><span class="sidebarTitle"><?php if($lingua=="ita"){?>Articoli<?php }else{?>Articles<?php }?></span></h4>
	
	<ul class="list-posts list-medium">
		@php
			$query_magazine = DB::table('magazine_articolo');
			$query_magazine = $query_magazine->select('*');
			$query_magazine = $query_magazine->where('visibile','=','1');
			$query_magazine = $query_magazine->where(function($query_magazine){
				$query_magazine = $query_magazine->where('id_cat','=','NULL');
				$query_magazine = $query_magazine->orwhere('id_cat','=','0');
			});
			$query_magazine = $query_magazine->ORDERBY('ordine','DESC');
			$query_magazine = $query_magazine->get();
			$num_magazine = $query_magazine->count();
			
		@endphp
		@if($num_magazine>0)
			@foreach($query_magazine AS $key_magazine=>$value_magazine)
				@php
					$titolo_art = $value_magazine->titolo;
					if($lingua=="eng" && $value_magazine->titolo_eng && trim($value_magazine->titolo_eng)!="") $titolo_art = $value_magazine->titolo_eng;
					$link_art="magazine/".creaSlug($titolo_art,"")."-".$value_magazine->id.".html";
				@endphp
				<li>
					<a href="<?php echo $link_art;?>" title="<?php echo $titolo_art;?> - Magazine - <?php echo $nome_del_sito;?>">
						<?php echo $titolo_art;?>
					</a>
				</li>
			@endforeach
		@endif
		
		@php
			$query_anno = DB::table('magazine_articolo')
					->select('anno')
					->distinct()
					->where('visibile','=','1')
					->ORDERBY('anno','DESC')
					->get();
			$x=1;
		@endphp
		@foreach($query_anno AS $key_anno=>$value_anno)
			@php
				$anno = $value_anno->anno;
			@endphp
			<li onclick="vediAnno('<?php echo $anno;?>');">
				<div style="width:80px; text-align:center; background:#0079C2; border-radius:5px; cursor:pointer;">
					<div style="padding:5px 10px; color:#fff"><b><?php echo $anno;?></b> <span id="freccia_anno_<?php echo $anno;?>"><i class="fa fa-chevron-<?php if($anno_ric==$anno){?>up<?php }else{?>down<?php }?>" aria-hidden="true"></i></span></div>
				</div>
			</li>
		
		
			@php
				$query_arg = DB::table('magazine_macrocategorie')
					->select('*')
					->ORDERBY('ordine','DESC')
					->get();
			@endphp
						
			@foreach($query_arg AS $key_arg=>$value_arg)
				@php
					$query_magazine_arg = DB::table('magazine_articolo')
						->select('*')
						->where('visibile','=','1')
						->where('anno','=',$anno)
						->where('id_cat','=',$value_arg->id)
						->ORDERBY('ordine','DESC')
						->get();
					$num_magazine_arg=$query_magazine_arg->count();					
				@endphp
				@if($num_magazine_arg>0)
					@php
						$nome_arg = $value_arg->nome;
						if($lingua=="eng" && $value_arg->nome_eng && trim($value_arg->nome_eng)!="") $nome_arg = $value_arg->nome_eng;
					@endphp
					<li class="anno_<?php echo $anno;?>" style="margin-left:10px; <?php if($anno!=$anno_ric){?>display:none<?php }?>" id='arg_<?php echo $x;?>'>
						<div style="float:left; width:90%">
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>magazine-pag<?php echo $pag_att;?>/<?php echo $anno;?>/<?php echo creaSlug($nome_arg,"");?>-<?php echo $value_arg->id;?>.html" <?php if($value_arg->id==$arg_ric && $anno==$anno_ric){?>style="font-weight:bold; color:#0079c2"<?php }?>  title="<?php echo $nome_arg;?> - Magazine - {{ config('app.name') }}">
								<b><?php echo $nome_arg;?></b>
							</a>
						</div>
						<div style="float:right; width:10%">
							<span id="freccia_<?php echo $x;?>" style="cursor:pointer" onclick="vedi_argomento('<?php echo $x;?>');"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
						</div>
						<div style="clear:both"></div>
					</li>
					
					@php
						$query_cat = DB::table('magazine_categorie')
							->select('*')
							->where('id_cat','=',$value_arg->id)
							->ORDERBY('ordine','DESC')
							->get();
						$num_cat=$query_cat->count();
					@endphp
					<?php /*if($num_cat>0)*/?>
					@if(1)
						<ul style="margin-left:10px; padding-left:10px; line-height:13px; display:<?php if($value_arg->id==$arg_ric && $anno==$anno_ric){?>block<?php }else{?>none<?php }?>" id="cat_<?php echo $x;?>">
							@php
								$query_magazine = DB::table('magazine_articolo');
								$query_magazine = $query_magazine->select('*');
								$query_magazine = $query_magazine->where('visibile','=','1');
								$query_magazine = $query_magazine->where('anno','=',$anno);
								$query_magazine = $query_magazine->where('id_cat','=',$value_arg->id);
								$query_magazine = $query_magazine->where(function($query_magazine){
										$query_magazine = $query_magazine->where('id_sottocat','=','NULL');
										$query_magazine = $query_magazine->orwhere('id_sottocat','=','0');
									});
								$query_magazine = $query_magazine->ORDERBY('ordine','DESC');
								$query_magazine = $query_magazine->get();
								$num_magazine=$query_magazine->count();
							@endphp
							@if($num_magazine>0)
								@foreach($query_magazine AS $key_magazine=>$value_magazine)
									@php
										$titolo_art = $value_magazine->titolo;
										if($lingua=="eng" && $value_magazine->titolo_eng && trim($value_magazine->titolo_eng)!="") $titolo_art = $value_magazine->titolo_eng;
										$link_art="magazine/$anno/".creaSlug($nome_arg,"")."/".creaSlug($titolo_art,"")."-".$value_magazine->id.".html";
									@endphp
									<li style="list-style-type: none;">
										<a href="<?php echo $link_art;?>" title="<?php echo $titolo_art;?> - <?php echo $nome_arg;?> - Magazine - {{ config('app.name') }}">
											<?php echo $titolo_art;?>
										</a>
									</li>
								@endforeach
							@endif
							
							@foreach($query_cat AS $key_cat=>$value_cat)
								@php
									$query_magazine = DB::table('magazine_articolo');
									$query_magazine = $query_magazine->select('*');
									$query_magazine = $query_magazine->where('visibile','=','1');
									$query_magazine = $query_magazine->where('anno','=',$anno);
									$query_magazine = $query_magazine->where('id_cat','=',$value_arg->id);
									$query_magazine = $query_magazine->where('id_sottocat','=',$value_cat->id);
									$query_magazine = $query_magazine->ORDERBY('ordine','DESC');
									$query_magazine = $query_magazine->get();
									$num_magazine=$query_magazine->count();
								@endphp
								@if($num_magazine>0)
									@php
										$nome_cat = $value_cat->nome;
										if($lingua=="eng" && $value_cat->nome_eng && trim($value_cat->nome_eng)!="") $nome_cat = $value_cat->nome_eng;					
									@endphp
									<li style="line-height:12px; margin-left:20px;">
										<a href="<?php if($lingua=="eng"){?>en/<?php }?>magazine-pag<?php echo $pag_att;?>/<?php echo $anno;?>/<?php echo creaSlug($nome_arg,"");?>-<?php echo $value_arg->id;?>/<?php echo creaSlug($nome_cat,"");?>-<?php echo $value_cat->id;?>.html"  title="<?php echo $nome_cat;?> - <?php echo $nome_arg;?> - Magazine - {{ config('app.name') }}" style="font-size:0.9em; <?php if($value_cat->id==$cat_ric){?>color:#00aeef<?php }?>">	
											<b><?php echo $nome_cat;?></b>
											&nbsp;&nbsp;<i class="fa fa-chevron-down"></i>
										</a>
									</li>
									@foreach($query_magazine AS $key_magazine=>$value_magazine)
										@php
											$titolo_art = $value_magazine->titolo;
											if($lingua=="eng" && $value_magazine->titolo_eng && trim($value_magazine->titolo_eng)!="") $titolo_art = $value_magazine->titolo_eng;
											$link_art="magazine/$anno/".creaSlug($nome_arg,"")."/".creaSlug($titolo_art,"")."-".$value_magazine->id.".html";
										@endphp
										<li style="padding-left:10px; list-style-type: none; margin-left:20px">
											<a href="<?php echo $link_art;?>" title="<?php echo $titolo_art;?> - <?php echo $nome_cat;?> - <?php echo $nome_arg;?> - Magazine - {{ config('app.name') }}">
												<?php echo $titolo_art;?>
											</a>
										</li>
									@endforeach
								@endif
							@endforeach
						</ul>					
					@endif
					@php $x++ @endphp
				@endif
			@endforeach
		@endforeach
	</ul>
	
	@if($arg_ric!="")
		<a href="magazine.html">
			<div style="width:120px; text-align:center; background:#0079C2; border-radius:5px">
				<div style="padding:5px 10px; color:#fff">IN EVIDENZA</div>
			</div>
		</a>
	@endif
	
	<script>
		function vediAnno(anno){
			$('.anno_'+anno).slideToggle();
			var frecciaAnno = document.getElementById('freccia_anno_'+anno).innerHTML;
			if(frecciaAnno=='<i class="fa fa-chevron-down" aria-hidden="true"></i>') 
				document.getElementById('freccia_anno_'+anno).innerHTML = '<i class="fa fa-chevron-up" aria-hidden="true"></i>';
			else document.getElementById('freccia_anno_'+anno).innerHTML = '<i class="fa fa-chevron-down" aria-hidden="true"></i>';
		}
		function vedi_argomento(id_cat){
			$('#cat_'+id_cat).slideToggle();
			var freccia = document.getElementById('freccia_'+id_cat).innerHTML;
			if(freccia=='<i class="fa fa-chevron-down" aria-hidden="true"></i>') 
				document.getElementById('freccia_'+id_cat).innerHTML = '<i class="fa fa-chevron-up" aria-hidden="true"></i>';
			else document.getElementById('freccia_'+id_cat).innerHTML = '<i class="fa fa-chevron-down" aria-hidden="true"></i>';
		}
	</script>
</div>