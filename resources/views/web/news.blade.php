@extends('web.index')

@section('content')
	@php
		$video_background = "web/video/Regate-generiche-1920x500.mp4";
		$img_background = "web/images/testate/ufficio_stampa.jpg";
		$page_title = "News";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
		
		$covid="";
		if(str_contains(url()->full(), 'news_coronavirus_pag')) $covid=1;
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-2"></div>
				<div class="content col-lg-6">
					@if($covid==1)
						<div style="text-align:center; background:#00AEEF; text-align:center; padding:10px 5px 10px 5px; margin-bottom:30px;">
							<h4 style="color:#fff;font-size:1.2em">CORONAVIRUS</h4>
						</div>
					@endif
					<div class="row team-members">
						@php
							$query_news = DB::table('news');
							$query_news = $query_news->select('*');
							if ($covid=="1") $query_news = $query_news->where('covid','=','1');
							else $query_news = $query_news->where('covid','=','0');
							$query_news = $query_news->where('news','=','1');
							/*$query_news = $query_news->where(function($query_news) {
								$query_news = $query_news->where('tipo','=','news')
									->orWhere(function($query_news) {
										$query_news->where('tipo', '=', 'news_young')
											->Where('news', '=', '1');
										});
									});*/
							if ($lingua=="eng") $query_news = $query_news->where('titolo_eng','<>','');
							//dd( $query_news->toSql(),  $query_news->getBindings());
							$query_news = $query_news->get();
							$num_news = $query_news->count();
							
							$rec_pag=12;
							$pag_tot=ceil($num_news/$rec_pag);				
							$start=($pag_att-1)*$rec_pag;
							
							$query_news = DB::table('news');
							$query_news = $query_news->select('*');
							if ($covid=="1") $query_news = $query_news->where('covid','=','1');
							else $query_news = $query_news->where('covid','=','0');
							$query_news = $query_news->where('news','=','1');
							/*$query_news = $query_news->where(function($query_news) {
								$query_news = $query_news->where('tipo','=','news')
									->orWhere(function($query_news) {
										$query_news->where('tipo', '=', 'news_young')
											->Where('news', '=', '1');
										});
									});*/
							if ($lingua=="eng") $query_news = $query_news->where('titolo_eng','<>','');
							$query_news = $query_news->orderby('data_news','DESC');
							$query_news = $query_news->limit($rec_pag);
							$query_news = $query_news->offset($start);
							$query_news = $query_news->get();
							
							$dir_up = "resarea/img_up";		
						@endphp
						
						@foreach($query_news AS $key_news=>$value_news)
							@php
								// 1. Pulizia codifica e testi
								$value_news->img = mb_convert_encoding($value_news->img, 'ISO-8859-1', 'UTF-8');
								$titolo = ($lingua == "eng" && !empty(trim($value_news->titolo_eng))) ? $value_news->titolo_eng : $value_news->titolo;
								
								$testo_raw = ($lingua == "eng" && !empty(trim($value_news->testo_eng))) ? $value_news->testo_eng : $value_news->testo;
								$testo = substr(trim(strip_tags(str_replace("admin/", "resarea/", $testo_raw))), 0, 100) . "...";

								// 2. Costruzione Link
								$prefix = ($lingua == "eng") ? "en/" : "";
								$slug = creaSlug(($lingua == "ita" ? $value_news->titolo : $value_news->titolo_eng), "");
								$link_news = "{$prefix}news-pag{$pag_att}/{$slug}-{$value_news->id}.html";

								// 3. LOGICA IMMAGINE (CORRETTA)
								$img = "";

								if (!empty($value_news->img)) {
									// Se c'è un valore nel DB, lo passiamo a smartAssetNews.
									// Sarà la funzione a decidere se caricarlo localmente o da yccs.it
									$img = $value_news->img; 
								} else {
									// Se il campo img è vuoto nel DB, proviamo a estrarlo dal testo
									$temp = explode('src="', $testo_raw);
									if (isset($temp[1])) {
										$temp2 = explode('"', $temp[1]);
										$img = $temp2[0];
									}
								}
							@endphp
 
							<div class="col-lg-4">
								<div class="team-member">
									{{-- Usiamo !empty perché è più solido di isset per le stringhe --}}
									@if(!empty($img))
										<div class="team-image">
											<a href="{{ $link_news }}" title="{{ $titolo }} - News">
												<img 
													alt="{{ $titolo }} - News - {{ config('app.name') }}" 
													style="width:100%" 
													src="{{ smartAssetNews($img) }}"
												>
											</a>
										</div>
									@endif
									
									<div class="team-desc" style="text-align:left;">
										<div style="margin-bottom:15px;">
											{{ convertDateFormat($value_news->data_news, "Y-m-d", "d/m") }}
										</div>
										<a href="{{ $link_news }}" title="{{ $titolo }} - News">
											<h3 style="font-size:20px; line-height:20px; text-transform: uppercase;">{!! $titolo !!}</h3>
										</a>
										@if(!empty($testo))
											<p style="line-height:18px">{!! $testo !!}</p>
										@endif
										<a class="read-more" style="font-size:14px; color:#111; font-family:'Open Sans'; font-weight:700" 
										   title="{{ $titolo }} - News" href="{{ $link_news }}">
											{{ ($lingua == "ita") ? "LEGGI" : "READ MORE" }}
										</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					@if($pag_tot>1)
						@php
							$root_link="news_pag";
							if($covid==1) $root_link="news_coronavirus_pag";
							$num_elem=4; //dimensione multipagina: sempre num pari
						@endphp
						<style>
							activePag(background:red;)
						</style>
						<ul class="pagination pagination-lg justify-content-center">							
							<li class="page-item<?php if($pag_att==1){?> disabled<?php }?>">
								<a class="page-link" href="<?php echo $root_link;?>1.html" tabindex="-1"><i class="fa fa-angle-double-left"></i></a>
							</li>
							<li class="page-item<?php if($pag_att==1){?> disabled<?php }?>">
								<a class="page-link" href="<?php echo $root_link;?><?php echo $pag_att-1;?>.html"><i class="fa fa-angle-left"></i></a>
							</li>
							@if($pag_att>((ceil($num_elem/2))+1) && $pag_tot>$num_elem)
								<li class="page-item disabled"><a href="#"class="page-link">...</a></li>	
							@endif
							
							
							@if($pag_tot>$num_elem)
								@if($pag_att<=(($num_elem/2)+1))
									@for($i=1; $i<=$num_elem; $i++)
										<li class="page-item <?php if($pag_att==$i){?> active<?php }?>">
											<a class="page-link" <?php if($pag_att==$i){?>style="background:#00AEEF; color:#fff;"<?php }?> href="<?php echo $root_link;?><?php echo $i;?>.html"><?php echo $i;?></a>
										</li>
									@endfor										
								@elseif($pag_att>(($num_elem/2)+1) && $pag_att<($pag_tot-(($num_elem/2)-1)))
									@for($i=($pag_att-($num_elem/2)); $i<=($pag_att+(($num_elem/2)-1)); $i++)
										<li class="page-item <?php if($pag_att==$i){?> active<?php }?>">
											<a class="page-link" <?php if($pag_att==$i){?>style="background:#00AEEF; color:#fff;"<?php }?> href="<?php echo $root_link;?><?php echo $i;?>.html"><?php echo $i;?></a>
										</li>
									@endfor			
								@else
									@for($i=($pag_tot-($num_elem-1)); $i<=$pag_tot; $i++)
										<li class="page-item <?php if($pag_att==$i){?> active<?php }?>">	
											<a class="page-link" <?php if($pag_att==$i){?>style="background:#00AEEF; color:#fff;"<?php }?> href="<?php echo $root_link;?><?php echo $i;?>.html"><?php echo $i;?></a>
										</li>
									@endfor			
								@endif
							@else
								@for($i=1; $i<=$pag_tot; $i++)
									<li class="page-item <?php if($pag_att==$i){?> active<?php }?>">
										<a class="page-link" <?php if($pag_att==$i){?>style="background:#00AEEF; color:#fff;"<?php }?> href="<?php echo $root_link;?><?php echo $i;?>.html" <?php if($pag_att==$i){?>style="pointer-events: none; cursor: default;"<?php }?>><?php echo $i;?></a>
									</li>
								@endfor			
							@endif
							
							@if($pag_att<($pag_tot-(ceil($num_elem/2))+1) && $pag_tot>$num_elem)
								<li class="page-item disabled"><a href="#" class="page-link">...</a></li>	
							@endif
							<li class="page-item<?php if($pag_att==$pag_tot){?> disabled<?php }?>">
								<a class="page-link" href="<?php echo $root_link;?><?php echo $pag_att+1;?>.html"><i class="fa fa-angle-right"></i></a>
							</li>			
							<li class="page-item<?php if($pag_att==$pag_tot){?> disabled<?php }?>">
								<a class="page-link" href="<?php echo $root_link;?><?php echo $pag_tot;?>.html" ><i class="fa fa-angle-double-right"></i></a>
							</li>
						</ul>
					@endif
				</div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-4" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-7">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-5"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection