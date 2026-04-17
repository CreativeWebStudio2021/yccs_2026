@php
	if(!isset($anno_regata)) $anno_regata="";
	if(!isset($anno_risultati)) $anno_risultati="";
@endphp

<style>
	.sidebarTitle{
		line-height:28px;
		padding-bottom:2px; 
		border-bottom:solid 4px #444444
	}
</style>

<div class="widget clearfix widget-archive">
	@if($cmd == "comunicati_dett")
		@php
			$query_st = DB::table('stampa');
			$query_st = $query_st->select('*');
			$query_st = $query_st->where('id','<>',$id_dett);
			if ($lingua=="eng") $query_st = $query_st->where('titolo_eng','<>',"''");
			$query_st = $query_st->orderby('ordine','DESC');
			$query_st = $query_st->get();
			$num_st = $query_st->count();
		@endphp
		
		@if ($num_st>0)
			<div class="widget clearfix widget-blog-articles">
				<h4 class="widget-title"><span class="sidebarTitle">{{ Lang::get('website.press nome pagina') }}</span></h4>
				<ul class="list-posts list-medium">
					@foreach($query_st AS $key_st=>$value_st)
						@php
							if($lingua=="ita" && $value_st->titolo && $value_st->titolo!="") $tit_st = $value_st->titolo; 
								else $tit_st = $value_st->titolo_eng;
							
							//$tit_st = mb_convert_encoding($tit_st, 'ISO-8859-1', 'UTF-8');
							
							$data_st = "";
							$data_st = convertDateFormat($value_st->data_stampa,"Y-m-d", "d/m/Y");
								
							$link_st = "press/".creaSlug($tit_st,"")."-".$value_st->id.".html";
							if($lingua=="eng") $link_st = "en/".$link_st;
						@endphp
						<li>
							<a href="<?php echo $link_st;?>" title="<?php  echo ucfirst($tit_st); ?> - <?php  if ($lingua=="eng") echo "Press Office"; else echo "Ufficio Stampa"; ?> - {{ config('app.name') }}">	
								{!! ucfirst($tit_st) !!}
							</a>
							<small>{{ convertDateFormat($data_st,"Y-m-d", "d/m/Y") }}</small>
						</li>
					@endforeach
				</ul>
				<a href="{{$lingua=='eng' ? 'en/' : '' }}press.html" class="btn btn-sm btn-dark" style="background:#444444">{{$lingua=='eng' ? 'SEE ALL' : 'VEDI TUTTI' }}</a>
			</div>
		@endif
	@endif
	@if(str_replace("young-azzurra","",$pagina)!=$pagina)
		@php
			$query_stato = DB::table('ya_elements');
			$query_stato = $query_stato->select('risultati');
			$query_stato = $query_stato->where('id','=','1');
			$query_stato = $query_stato->get();
			
			$stato_risultat = $query_stato[0]->risultati;
		@endphp
		
		@if($stato_risultat==1)
			<h4 class="widget-title"><span class="sidebarTitle"><?php if($lingua=="ita"){?>Archivio Risultati<?php }else{?>Archive Results<?php }?></span></h4>
			<div style="padding-bottom:30px;" id="box_archivio">
				<ul class="list list-lines">
					@php
						$query_anni = DB::table('ya_risultati');						
						$query_anni = $query_anni->distinct();
						$query_anni = $query_anni->select('anno');
						$query_anni = $query_anni->where('visibile','=','1');
						$query_anni = $query_anni->orderby('anno','DESC');
						$query_anni = $query_anni->get();
					@endphp
					@foreach($query_anni AS $key_anni=>$value_anni)
						<li >
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/risultati-<?php echo $value_anni->anno;?>.html" <?php if($value_anni->anno==$anno_risultati){?>style="font-weight:bold; color:#0079c2"<?php }?>><?php if($lingua=="ita"){?>Risultati<?php }else{?>Results<?php }?> <?php echo $value_anni->anno;?></a>							
						</li>
					@endforeach
					
				</ul>
			</div>
		@endif
		<style>
			@media screen AND (max-width:1145px){
				.YANews	{font-size:12px}					
			}
			@media screen AND (max-width:991px){
				.YANews	{font-size:14px}					
			}
		</style>
		<div class="widget clearfix widget-blog-articles">
			<h4 class="widget-title"><span class="sidebarTitle YANews">News Young Azzurra</span></span></h4>
			<ul class="list-posts list-medium">
				@php
					$query_nl = DB::table('news');
					$query_nl = $query_nl->select('id','data_news','titolo','titolo_eng');
					$query_nl = $query_nl->where('tipo','=','news_young');
					$query_nl = $query_nl->where('news','=','1');
					if ($lingua=="eng") $query_nl = $query_nl->where('titolo_eng','<>','');
					$query_nl = $query_nl->orderby('ordine','DESC');
					$query_nl = $query_nl->limit('3');
					$query_nl = $query_nl->get();
					$num_nl = $query_nl->count();
				@endphp
								
				@if ($num_nl>0)
					@foreach ($query_nl AS $ket_nl=>$value_nl)
						@php	
							$id_nl = $value_nl->id;
							$data_nl = $value_nl->data_news;
							$tit_nl = $value_nl->titolo;
							$tit_eng_nl = $value_nl->titolo_eng;
							if($lingua=="eng") $link="en/young-azzurra/"; 
								else $link="young-azzurra/";
							$link.="news-pag1/";
							if($lingua=="ita" && $tit_nl && $tit_nl!="") $link.=creaSlug($tit_nl,"");
								else $link.=creaSlug($tit_eng_nl,"");
							$link.="-".$id_nl.".html";
		
							//$tit_nl = mb_convert_encoding($tit_nl, 'ISO-8859-1', 'UTF-8');
							//$tit_eng_nl = mb_convert_encoding($tit_eng_nl, 'ISO-8859-1', 'UTF-8');
						@endphp
						<li>
							<a href="<?php echo $link;?>" title="<?php  if($lingua=="ita" && $tit_nl && $tit_nl!="") echo ucfirst($tit_nl); else echo ucfirst($tit_eng_nl);  ?> - NEWS - {{ config('app.name') }}">	
								<?php  if($lingua=="ita" && $tit_nl && $tit_nl!="") echo ucfirst($tit_nl); else echo ucfirst($tit_eng_nl);  ?>
							</a>
							<small><?php  echo convertDateFormat($data_nl,"Y-m-d", "d/m/Y");?></small>
						</li>
					@endforeach
				@endif
			</ul>
		</div>
	@endif
	
	<?php /*if($cmd=="suppliers"){?>
	<div style="width:250px; height:250px; background:grey; margin-bottom:20px; ">
		<div style="width:90%; margin:0 auto; text-align:center; padding-top:110px; color:#fff">
			<b>SPAZIO BANNER</b>
		</div>
	</div>
	<?php }*/?>
	
	@if($cmd=="press_conference")
		<h4 class="widget-title2"><span class="sidebarTitle"><?php if($lingua=="ita"){?>Archivio Conferenze<?php }else{?>Conference Archive<?php }?></span></h4>
		<div style="" id="box_archivio">
			<ul class="list list-lines">
				@php
					if(!isset($anno)) $anno="";
					if(!isset($id_dett)) $id_dett="";
					
					$query_anno = DB::table('rassegna');
					$query_anno = $query_anno->distinct();
					$query_anno = $query_anno->select('anno');
					$query_anno = $query_anno->orderby('anno','DESC');
					$query_anno = $query_anno->get();
					$x=1;
				@endphp
				
				@foreach($query_anno AS $key_anno=>$value_anno)				
					@if($anno!="")
						<li id='cf_<?php echo $x;?>' <?php if($x>5 && $value_anno->anno<$anno){?>style="display:none"<?php }?>>
					@else
						<li id='cf_<?php echo $x;?>' <?php if($x>5){?>style="display:none"<?php }?>>
					@endif
					
					<span <?php if($value_anno->anno==$anno){?>style="font-weight:bold; color:#0079c2"<?php }?>>
						<?php if($lingua=="ita"){?>Anno<?php }else{?>Year<?php }?> <?php echo $value_anno->anno;?>
					</span>
					&nbsp;&nbsp;
					<span id="freccia_<?php echo $value_anno->anno;?>" style="cursor:pointer" onclick="vedi_rassegna_<?php echo $value_anno->anno;?>();">
						<i class="fa fa-chevron-<?php if($value_anno->anno!=$anno){?>down<?php }else{?>up<?php }?>"></i>
					</span>
					
					@php
						$query_e = DB::table('rassegna');
						$query_e = $query_e->select('*');
						$query_e = $query_e->where('anno','=',$value_anno->anno);
						$query_e = $query_e->orderby('data','ASC');
						$query_e = $query_e->get();
						$num_e = $query_e->count();
					@endphp					
					
					@if($num_e>0)
						<ul style="margin-left:15px; padding-left:10px; line-height:13px; <?php if($value_anno->anno!=$anno){?>display:none<?php }?>" id="conf_<?php echo $value_anno->anno;?>">
							@foreach($query_e AS $key_e=>$value_e)
								@php
									if($lingua=="eng") $titolo=$value_e->titolo_eng;
									else if($value_e->titolo && $value_e->titolo!="") $titolo=$value_e->titolo;
								@endphp
								<li style="line-height:12px;">
									<a href="press-conference-<?php echo $value_e->id;?>.html" style="<?php if($value_e->id==$id_dett){?>font-weight:bold<?php }?>"><?php echo $titolo;?>	</a>								
								</li>									
							@endforeach
							<li style="list-style: none outside none; cursor:pointer; font-size:0.8em" onclick="vedi_rassegna_<?php echo $value_anno->anno;?>();"><b>Chiudi</b> <i class="fa fa-chevron-up"></i></li>
						</ul>
					@endif
					<script type="text/javascript">
						var aperto_<?php echo $value_anno->anno;?>= <?php if($value_anno->anno!=$anno){?>0<?php }else{?>1<?php }?>;
						function vedi_rassegna_<?php echo $value_anno->anno;?>(){
							if(aperto_<?php echo $value_anno->anno;?>==0){
								@php
									$query_a = DB::table('rassegna');
									$query_a = $query_a->distinct();
									$query_a = $query_a->select('anno');
									$query_a = $query_a->orderby('anno','DESC');
									$query_a = $query_a->get();
								@endphp	
								
								@foreach($query_a AS $key_a=>$value_a)
									$("#conf_<?php echo $value_a->anno;?>").fadeOut();
									aperto_<?php echo $value_a->anno;?>=0;
									document.getElementById('freccia_<?php echo $value_a->anno;?>').innerHTML='<i class="fa fa-chevron-down"></i>';
								@endforeach
								
								aperto_<?php echo $value_anno->anno;?>=1;
								document.getElementById('freccia_<?php echo $value_anno->anno;?>').innerHTML='<i class="fa fa-chevron-up"></i>';
								$("#conf_<?php echo $value_anno->anno;?>").fadeIn();
							}else{
								aperto_<?php echo $value_anno->anno;?>=0;		
								document.getElementById('freccia_<?php echo $value_anno->anno;?>').innerHTML='<i class="fa fa-chevron-down"></i>';							
								$("#conf_<?php echo $value_anno->anno;?>").fadeOut();
							}
						}
					</script>
					
					@php $x++; @endphp
				@endforeach				
			</ul>
		</div>
	@endif
	
	<?php if($cmd!="press-conference" && str_replace("young-azzurra","",$pagina)==$pagina){?>
		<h4 class="widget-title2"><span class="sidebarTitle"><?php if($lingua=="ita"){?>Archivio Regate<?php }else{?>Regattas<?php }?></span></h4>
		<div style="" id="box_archivio">
			<ul class="list list-lines">
				@php
					$query_max = DB::table('edizioni_regate');
					$query_max = $query_max->distinct();
					$query_max = $query_max->select('anno');
					$query_max = $query_max->where('visibile','=','1');
					$query_max = $query_max->orderby('anno','DESC');
					$query_max = $query_max->limit('1');
					$query_max = $query_max->get();
					
					$data_max = $query_max[0]->anno;
					$x=1;
				@endphp
				@for($i=$data_max; $i>1995; $i--)
					<?php if($anno_regata!=""){?>
						<li id='reg_<?php echo $x;?>' <?php if($x>5 && $i<$anno_regata){?>style="display:none"<?php }?>>
					<?php }else{?>
						<li id='reg_<?php echo $x;?>' <?php if($x>5){?>style="display:none"<?php }?>>
					<?php }?>
						<a href="<?php if($lingua=="eng"){?>en/<?php }?>regate-<?php echo $i;?>.html" <?php if($i==$anno_regata){?>style="font-weight:bold; color:#0079c2"<?php }?>><?php if($lingua=="ita"){?>Regate<?php }else{?>Regattas<?php }?> <?php echo $i;?></a>
						&nbsp;&nbsp;<span id="freccia_<?php echo $i;?>" style="cursor:pointer" onclick="vedi_regate_<?php echo $i;?>();"><i class="fa fa-chevron-<?php if($i!=$anno_regata){?>down<?php }else{?>up<?php }?>"></i></span>
						
						@php
							$query_e = DB::table('edizioni_regate');
							$query_e = $query_e->select('id','id_regata','luogo','nome_regata');
							$query_e = $query_e->where('visibile','=','1');
							$query_e = $query_e->where('anno','=',$i);
							$query_e = $query_e->orderby('data_dal','ASC');
							$query_e = $query_e->orderby('ordine','DESC');
							$query_e = $query_e->get();
							$num_e = $query_e->count();
						@endphp
						@if($num_e>0)
							<ul style="margin-left:15px; padding-left:10px; line-height:13px; <?php if($i!=$anno_regata){?>display:none<?php }?>" id="regate_<?php echo $i;?>">
								@foreach($query_e AS $key_e=>$value_e)
									@php
										$z=1;
										$query_r = DB::table('regate');
										$query_r = $query_r->select('id','nome');
										$query_r = $query_r->where('id','=',$value_e->id_regata);
										$query_r = $query_r->get();
										$num_r = $query_r->count();
									@endphp
									@if($num_r>0)
										@php
											$titolo_regata=$value_e->nome_regata." - ".$value_e->luogo." ".$z;
											$z++;
										@endphp							
										<li style="line-height:12px;">
											<a href="<?php if($lingua=="eng"){?>en/<?php }?>regate-<?php echo $i;?>/<?php echo creaSlug($value_e->nome_regata,"");?>-<?php echo $value_e->id;?>.html" title="<?php echo $titolo_regata;?>" style="font-size:0.9em; <?php if(isset($id_dett) && $id_dett==$value_e->id){?>color:#00aeef<?php }?>">
												{!! $value_e->nome_regata !!}
											</a>
										</li>
									@endif
								@endforeach
								<li style="list-style: none outside none; cursor:pointer;" onclick="vedi_regate_<?php echo $i;?>();"><b>Chiudi Regate</b> <i class="fa fa-chevron-up"></i></li>
							</ul>
						@endif
						<script type="text/javascript">
							var aperto_<?php echo $i;?>= <?php if($i!=$anno_regata){?>0<?php }else{?>1<?php }?>;
							function vedi_regate_<?php echo $i;?>(){
								if(aperto_<?php echo $i;?>==0){
									<?php for($ind=$data_max; $ind>1995; $ind--){?>
										$("#regate_<?php echo $ind;?>").fadeOut();
										aperto_<?php echo $ind;?>=0;
										document.getElementById('freccia_<?php echo $ind;?>').innerHTML='<i class="fa fa-chevron-down"></i>';
									<?php }?>
									aperto_<?php echo $i;?>=1;
									document.getElementById('freccia_<?php echo $i;?>').innerHTML='<i class="fa fa-chevron-up"></i>';
									$("#regate_<?php echo $i;?>").fadeIn();
								}else{
									aperto_<?php echo $i;?>=0;		
									document.getElementById('freccia_<?php echo $i;?>').innerHTML='<i class="fa fa-chevron-down"></i>';							
									$("#regate_<?php echo $i;?>").fadeOut();
								}
							}
						</script>
					</li>
					@php $x++ @endphp
				@endfor
				
			</ul>
		</div>
		<ul class="list list-lines">
			<li id="vedi" style="cursor:pointer;" onclick="vedi_anni();"><?php if($lingua=="ita"){?>Vedi Tutti gli Anni<?php }else{?>See More<?php }?> <i class="fa fa-caret-down"></i></li>
		</ul>
		
		<script type="text/javascript">
			var aperto=0;
			function vedi_anni(){
				if(aperto==0){
					aperto=1;
					<?php for($ind=1; $ind<=$x; $ind++){?>
						$("#reg_<?php echo $ind;?>").fadeIn();
					<?php }?>
					document.getElementById('vedi').innerHTML='<?php if($lingua=="ita"){?>Nascondi Anni<?php }else{?>Hide<?php }?> <i class="fa fa-caret-up"></i>';
				}else{
					aperto=0;
					<?php for($ind=5; $ind<=$x; $ind++){?>
						$("#reg_<?php echo $ind;?>").fadeOut();
					<?php }?>
					document.getElementById('vedi').innerHTML='<?php if($lingua=="ita"){?>Vedi Tutti gli Anni<?php }else{?>See More<?php }?> <i class="fa fa-caret-down"></i>';
				}
			}
		</script>
	<?php }?>
</div>

@if(str_replace("young-azzurra","",$cmd)==$cmd)
	<div class="widget clearfix widget-blog-articles">
		<h4 class="widget-title"><span class="sidebarTitle">News</span></h4>
		<ul class="list-posts list-medium">
		@php
			$num_nl = 0;
			$query_nl = DB::table('news');
			$query_nl = $query_nl->select('id','data_news','titolo','titolo_eng','YA');
			$query_nl = $query_nl->where('tipo','=','news');
			$query_nl = $query_nl->orWhere(function($query_nl) {
						$query_nl->where('tipo', '=', 'news_young')
							->orWhere('news', '=', '1');
					});
			if ($lingua=="eng") $query_nl = $query_nl->where('titolo_eng','<>','');
			$query_nl = $query_nl->orderby('ordine','DESC');
			$query_nl = $query_nl->limit('3');
			$query_nl = $query_nl->get();
			$num_nl = $query_nl->count();
		@endphp
		
		@if ($num_nl>0)
			@foreach ($query_nl AS $key_nl=>$value_nl)
				@php
					$id_nl = $value_nl->id;
					$data_nl = $value_nl->data_news;
					$tit_nl = $value_nl->titolo;
					$ya_nl = $value_nl->YA;
					$tit_eng_nl = $value_nl->titolo_eng;
					
					if($lingua=="eng") $link="en/"; 
						else $link="";
					if($ya_nl==1) $link.="young-azzurra/";
					$link.="news-pag1/";
					if($lingua=="ita" && $tit_nl && $tit_nl!="") $link.=creaSlug($tit_nl,"");
						else $link.=creaSlug($tit_eng_nl,"");
					$link.="-".$id_nl.".html";
		
					//$tit_nl = mb_convert_encoding($tit_nl, 'ISO-8859-1', 'UTF-8');
					//$tit_eng_nl = mb_convert_encoding($tit_eng_nl, 'ISO-8859-1', 'UTF-8');
				@endphp
			<li>
				<a href="<?php echo $link;?>" title="<?php  if($lingua=="ita" && $tit_nl && $tit_nl!="") echo ucfirst($tit_nl); else echo ucfirst($tit_eng_nl);  ?> - NEWS - {{ config('app.name') }}">	
					<?php  if($lingua=="ita" && $tit_nl && $tit_nl!="") echo ucfirst($tit_nl); else echo ucfirst($tit_eng_nl);  ?>
				</a>
				<small><?php  echo convertDateFormat($data_nl,"Y-m-d", "d/m/Y");?></small>
			</li>
			@endforeach
		@endif
		</ul>
	</div>
@endif

<?php /*if($cmd!="contatti" && $cmd!="login" && $cmd!="registrazione"){?>
	<div class="widget clearfix">
		<a class="twitter-timeline" href="https://twitter.com/YccsPortoCervo" data-widget-id="689456557474447360">Tweet di @YccsPortoCervo</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>
<?php }*/?> 