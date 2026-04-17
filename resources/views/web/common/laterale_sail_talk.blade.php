@php
	if(!isset($arg_ric)) $arg_ric="";
@endphp

<style>
	.sidebarTitle{padding-bottom:10px; border-bottom:solid 4px #444444}
</style>

<div class="widget clearfix widget-archive">
	<h4 class="widget-title"><span class="sidebarTitle"><?php if($lingua=="ita"){?>Articoli<?php }else{?>Articles<?php }?></span></h4>
	
	<ul class="list-posts list-medium">
		@php
			$query_sail_talk = DB::table('sail_talk_articolo');
			$query_sail_talk = $query_sail_talk->select('*');
			$query_sail_talk = $query_sail_talk->where('visibile','=','1');
			$query_sail_talk = $query_sail_talk->where(function($query_sail_talk){
				$query_sail_talk = $query_sail_talk->where('id_cat','=','NULL');
				$query_sail_talk = $query_sail_talk->orwhere('id_cat','=','0');
			});
			$query_sail_talk = $query_sail_talk->ORDERBY('ordine','DESC');
			$query_sail_talk = $query_sail_talk->get();
			$num_sail_talk = $query_sail_talk->count();
			
		@endphp
		@if($num_sail_talk>0)
			@foreach($query_sail_talk AS $key_sail_talk=>$value_sail_talk)
				@php
					$titolo_art = $value_sail_talk->titolo;
					if($lingua=="eng" && $value_sail_talk->titolo_eng && trim($value_sail_talk->titolo_eng)!="") $titolo_art = $value_sail_talk->titolo_eng;
					$link_art="sail_talk/".creaSlug($titolo_art,"")."-".$value_sail_talk->id.".html";
				@endphp
				<li>
					<a href="<?php echo $link_art;?>" title="<?php echo $titolo_art;?> - Sail Talk - <?php echo $nome_del_sito;?>">
						<?php echo $titolo_art;?>
					</a>
				</li>
			@endforeach
		@endif
		
		@php
			$x=1;
			$query_arg = DB::table('sail_talk_macrocategorie')
				->select('*')
				->ORDERBY('ordine','DESC')
				->get();
		@endphp
					
		@foreach($query_arg AS $key_arg=>$value_arg)
			@php
				$query_sail_talk_arg = DB::table('sail_talk_articolo')
					->select('*')
					->where('visibile','=','1')
					->where('id_cat','=',$value_arg->id)
					->ORDERBY('ordine','DESC')
					->get();
				$num_sail_talk_arg=$query_sail_talk_arg->count();					
			@endphp
			@if($num_sail_talk_arg>0)
				@php
					$nome_arg = $value_arg->nome;
					if($lingua=="eng" && $value_arg->nome_eng && trim($value_arg->nome_eng)!="") $nome_arg = $value_arg->nome_eng;
				@endphp
				<li style="margin-left:10px;" id='arg_<?php echo $x;?>'>
					<div style="float:left; width:90%">
						<a href="<?php if($lingua=="eng"){?>en/<?php }?>sail_talk-pag<?php echo $pag_att;?>/<?php echo creaSlug($nome_arg,"");?>-<?php echo $value_arg->id;?>.html" <?php if($value_arg->id==$arg_ric){?>style="font-weight:bold; color:#0079c2"<?php }?>  title="<?php echo $nome_arg;?> - Sail Talk - {{ config('app.name') }}">
							<b><?php echo $nome_arg;?></b>
						</a>
					</div>
					<div style="float:right; width:10%">
						<span id="freccia_<?php echo $x;?>" style="cursor:pointer" onclick="vedi_argomento('<?php echo $x;?>');"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
					</div>
					<div style="clear:both"></div>
				</li>
				
				@php
					$query_cat = DB::table('sail_talk_categorie')
						->select('*')
						->where('id_cat','=',$value_arg->id)
						->ORDERBY('ordine','DESC')
						->get();
					$num_cat=$query_cat->count();
				@endphp
				<?php /*if($num_cat>0)*/?>
				@if(1)
					<ul style="margin-left:10px; padding-left:10px; line-height:13px; display:<?php if($value_arg->id==$arg_ric){?>block<?php }else{?>none<?php }?>" id="cat_<?php echo $x;?>">
						@php
							$query_sail_talk = DB::table('sail_talk_articolo');
							$query_sail_talk = $query_sail_talk->select('*');
							$query_sail_talk = $query_sail_talk->where('visibile','=','1');
							$query_sail_talk = $query_sail_talk->where('id_cat','=',$value_arg->id);
							$query_sail_talk = $query_sail_talk->where(function($query_sail_talk){
									$query_sail_talk = $query_sail_talk->where('id_sottocat','=','NULL');
									$query_sail_talk = $query_sail_talk->orwhere('id_sottocat','=','0');
								});
							$query_sail_talk = $query_sail_talk->ORDERBY('ordine','DESC');
							$query_sail_talk = $query_sail_talk->get();
							$num_sail_talk=$query_sail_talk->count();
						@endphp
						@if($num_sail_talk>0)
							@foreach($query_sail_talk AS $key_sail_talk=>$value_sail_talk)
								@php
									$titolo_art = $value_sail_talk->titolo;
									if($lingua=="eng" && $value_sail_talk->titolo_eng && trim($value_sail_talk->titolo_eng)!="") $titolo_art = $value_sail_talk->titolo_eng;
									$link_art="sail_talk/".creaSlug($nome_arg,"")."/".creaSlug($titolo_art,"")."-".$value_sail_talk->id.".html";
								@endphp
								<li style="list-style-type: none;">
									<a href="<?php echo $link_art;?>" title="<?php echo $titolo_art;?> - <?php echo $nome_arg;?> - Sail Talk - {{ config('app.name') }}">
										<?php echo $titolo_art;?>
									</a>
								</li>
							@endforeach
						@endif
						
						@foreach($query_cat AS $key_cat=>$value_cat)
							@php
								$query_sail_talk = DB::table('sail_talk_articolo');
								$query_sail_talk = $query_sail_talk->select('*');
								$query_sail_talk = $query_sail_talk->where('visibile','=','1');
								$query_sail_talk = $query_sail_talk->where('id_cat','=',$value_arg->id);
								$query_sail_talk = $query_sail_talk->where('id_sottocat','=',$value_cat->id);
								$query_sail_talk = $query_sail_talk->ORDERBY('ordine','DESC');
								$query_sail_talk = $query_sail_talk->get();
								$num_sail_talk=$query_sail_talk->count();
							@endphp
							@if($num_sail_talk>0)
								@php
									$nome_cat = $value_cat->nome;
									if($lingua=="eng" && $value_cat->nome_eng && trim($value_cat->nome_eng)!="") $nome_cat = $value_cat->nome_eng;					
								@endphp
								<li style="line-height:12px; margin-left:20px;">
									<a href="<?php if($lingua=="eng"){?>en/<?php }?>sail_talk-pag<?php echo $pag_att;?>/<?php echo creaSlug($nome_arg,"");?>-<?php echo $value_arg->id;?>/<?php echo creaSlug($nome_cat,"");?>-<?php echo $value_cat->id;?>.html"  title="<?php echo $nome_cat;?> - <?php echo $nome_arg;?> - Sail Talk - {{ config('app.name') }}" style="font-size:0.9em; <?php if($value_cat->id==$cat_ric){?>color:#00aeef<?php }?>">	
										<b><?php echo $nome_cat;?></b>
										&nbsp;&nbsp;<i class="fa fa-chevron-down"></i>
									</a>
								</li>
								@foreach($query_sail_talk AS $key_sail_talk=>$value_sail_talk)
									@php
										$titolo_art = $value_sail_talk->titolo;
										if($lingua=="eng" && $value_sail_talk->titolo_eng && trim($value_sail_talk->titolo_eng)!="") $titolo_art = $value_sail_talk->titolo_eng;
										$link_art="sail_talk/".creaSlug($nome_arg,"")."/".creaSlug($nome_cat,"")."/".creaSlug($titolo_art,"")."-".$value_sail_talk->id.".html";
									@endphp
									<li style="padding-left:10px; list-style-type: none; margin-left:20px">
										<a href="<?php echo $link_art;?>" title="<?php echo $titolo_art;?> - <?php echo $nome_cat;?> - <?php echo $nome_arg;?> - Sail Talk - {{ config('app.name') }}">
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
		
	</ul>
	
	@if($arg_ric!="")
		<a href="sail_talk.html">
			<div style="width:120px; text-align:center; background:#0079C2; border-radius:5px">
				<div style="padding:5px 10px; color:#fff">IN EVIDENZA</div>
			</div>
		</a>
	@endif
	
	<script>
		function vedi_argomento(id_cat){
			$('#cat_'+id_cat).slideToggle();
			var freccia = document.getElementById('freccia_'+id_cat).innerHTML;
			if(freccia=='<i class="fa fa-chevron-down" aria-hidden="true"></i>') 
				document.getElementById('freccia_'+id_cat).innerHTML = '<i class="fa fa-chevron-up" aria-hidden="true"></i>';
			else document.getElementById('freccia_'+id_cat).innerHTML = '<i class="fa fa-chevron-down" aria-hidden="true"></i>';
		}
	</script>
</div>