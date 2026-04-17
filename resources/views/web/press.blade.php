@extends('web.index')

@section('content')
	@php		
		$video_background = "web/video/Regate-generiche-1920x500.mp4";
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.il club'); $breadcrumbs[$x]['link']='';
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	@include('web.assets.la_storia_css')

	<style>
		.row-press{
			display:flex;
			gap:30px;
		}
		@media screen and (max-width: 800px) {
			.row-press{
				flex-direction:column;
			}
		}
	</style>
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">					
					<div style="margin-top:30px">
						<?php if($lingua=="ita"){?>
							<div class="row-press" style="display:flex; gap:30px;">
								<div style="flex:1;">
									<p>I comunicati stampa, le foto e i video degli eventi sono disponibili nella sezione dedicata alla relativa regata oppure consultabili tramite le news in homepage e accessibili dal menu principale.</p>
								</div>							
								<div style="flex:1;">
									<p>Tutte le attività sono anche veicolate tramite i canali ufficiali dello YCCS su:<br/>
										Instagram <a href="https://www.instagram.com/yccs_portocervo/"target="_blank" class="azzurro">@yccs_portocervo</a>,<br/>
										Twitter <a href="https://twitter.com/yccsportocervo" target="_blank" class="azzurro">@YccsPortoCervo</a>,<br/>
										Youtube <a href="https://www.youtube.com/user/YCCostaSmeralda"target="_blank" class="azzurro">@YCCostaSmeralda</a>
									</p>
								</div>
							</div>
							<h4><a href="registrazione-giornalisti.html" class="btn"><u>Modulo Registrazione Giornalisti</u></a></h4>
						<?php }else{?>
							<p>Press releases, photos and videos of events are available on the relevant regatta page or in the news section of the main menu.<br/>
								Information on all of the Club’s activities is also available via the official YCCS social media channels:<br/>
								Instagram <a href="https://www.instagram.com/yccs_portocervo/"target="_blank" class="azzurro">@yccs_portocervo</a>,<br/>
								Twitter <a href="https://twitter.com/yccsportocervo"target="_blank" class="azzurro">@YccsPortoCervo</a>,<br/>
								Youtube <a href="https://www.youtube.com/user/YCCostaSmeralda"target="_blank" class="azzurro">@YCCostaSmeralda</a>.
							</p>
							<h4><a href="en/registrazione-giornalisti.html" class="btn"><u>Journalist Registration Form</u></a></h4>
						<?php }?>
						<div style="clear:both;height:30px;border-bottom:1px solid #eee;margin-bottom:50px;">&nbsp;</div>
						
						@php
							$stampa_all = DB::table('stampa')
								->where('visibile', '1')
								->when($lingua == "eng", function ($q) {
									return $q->where('titolo_eng', '<>', "''");
								})
								->orderBy('ordine', 'DESC')
								->get();
							
							$primo = $stampa_all->first();
							$altri = $stampa_all->skip(1);

							if($primo) {
								// Logica per il primo elemento
								if($lingua=="ita" && $primo->titolo && $primo->titolo!="") $tit_st = $primo->titolo; 
								else $tit_st = $primo->titolo_eng; // Corretto qui: era value_st
									
								if($lingua=="ita" && $primo->descr && $primo->descr!="") $descr_st = $primo->descr; 
								else $descr_st = $primo->descr_eng;
									
								$data_st = convertDateFormat($primo->data_stampa,"Y-m-d", "d/m/Y");
								$link_st = ($lingua=="eng" ? "en/" : "") . "press/".creaSlug($tit_st,"")."-".$primo->id.".html";
								$dir_up = "resarea/img_up";
							}
						@endphp

						@if($primo)
						<div class="post-item" style="padding:0; border-bottom:1px solid #eee; margin-bottom:40px;">
							<div class="post-item-wrap">
								@if ($primo->img!="")
									<div class="post-image">
										<a href="{{ url($link_st) }}">
											<img src="{{ $dir_up }}/stampa/{{ $primo->img }}">
										</a>
									</div>
								@endif
								<div class="post-item-description">
									<h2><a href="{{ url($link_st) }}">{!! ucfirst($tit_st) !!}</a></h2>
									@if ($data_st!="")
										<span class="post-meta-date" style="color:#222"><i class="fa fa-calendar"></i> {{ $data_st }}</span>											
									@endif
									@if ($descr_st!="")
										<p>{{ ucfirst(substr(strip_tags($descr_st),0,250)) }}...</p>
									@endif
									<a href="{{ url($link_st) }}" class="link-arrow" style="width:145px; margin-top:12px; margin-right:20px;">
										<span>{{ $lingua=="eng" ? 'READ MORE' : 'LEGGI TUTTO' }}</span>
										<img src="{{ asset('web/images/arrow.png') }}" style="width:13px; height:13px;" class="arrow-img"/>
									</a>
								</div>
							</div>
						</div>

						@if($altri->count() > 0)
						<div id="btn-container-stampa" style="text-align: center; margin-bottom: 40px;">
							<button id="show-more-stampa" class="btn" style="padding: 10px 30px; border: none; cursor: pointer;">
								{{ $lingua=="eng" ? 'VIEW ALL' : 'VEDI TUTTO' }}
							</button>
						</div>
						@endif

						<div id="altri-stampa" style="display:none">
							@foreach($altri AS $value_st)
								@php
									if($lingua=="ita" && $value_st->titolo && $value_st->titolo!="") $tit_st = $value_st->titolo; 
									else $tit_st = $value_st->titolo_eng;
										
									if($lingua=="ita" && $value_st->descr && $value_st->descr!="") $descr_st = $value_st->descr; 
									else $descr_st = $value_st->descr_eng;
										
									$data_st = convertDateFormat($value_st->data_stampa,"Y-m-d", "d/m/Y");
									$link_st = ($lingua=="eng" ? "en/" : "") . "press/".creaSlug($tit_st,"")."-".$value_st->id.".html";
								@endphp
								
								<div class="post-item" style="padding:0; border-bottom:1px solid #eee; margin-bottom:40px;">
									<div class="post-item-wrap">
										@if ($value_st->img!="")
											<div class="post-image">
												<a href="{{ url($link_st) }}">
													<img src="{{ $dir_up }}/stampa/{{ $value_st->img }}">
												</a>
											</div>
										@endif
										<div class="post-item-description">
											<h2><a href="{{ url($link_st) }}">{!! ucfirst($tit_st) !!}</a></h2>
											@if ($data_st!="")
												<span class="post-meta-date" style="color:#222"><i class="fa fa-calendar"></i> {{ $data_st }}</span>											
											@endif
											@if ($descr_st!="")
												<p>{{ ucfirst(substr(strip_tags($descr_st),0,250)) }}...</p>
											@endif
											<a href="{{ url($link_st) }}" class="link-arrow" style="width:145px; margin-top:12px; margin-right:20px;">
												<span>{{ $lingua=="eng" ? 'READ MORE' : 'LEGGI TUTTO' }}</span>
												<img src="{{ asset('web/images/arrow.png') }}" style="width:13px; height:13px;" class="arrow-img"/>
											</a>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						@endif
						
						<script>
							$(document).ready(function(){
								$("#show-more-stampa").click(function(){
									// Mostra il blocco con un effetto di scivolamento
									$("#altri-stampa").slideToggle("slow");
									// Nasconde il contenitore del bottone
									$("#btn-container-stampa").fadeOut("fast");
								});
							});
						</script>
						
						<a name="conference"></a> 
						<h4><?php if($lingua=="ita"){?>Area Conferenza Stampa<?php }else{?>Press Conference Area<?php }?></h4>
						<div class="widget clearfix widget-tags" style="margin-top:30px;">						
							<div class="tags">
								<?php if($lingua=="ita"){?>Archivio<?php }else{?>Archive<?php }?>: &nbsp;&nbsp;
								@php
									if(!isset($anno_rassegna)) {
										$query_anni = DB::table('rassegna')
											->distinct('anno')
											->orderby('anno','DESC')
											->limit('1')
											->get();
										$anno_rassegna = $query_anni[0]->anno;
									}
									
									$query_anni = DB::table('rassegna')
											->distinct('anno')
											->orderby('anno','DESC')
											->get();
								@endphp
								@foreach($query_anni AS $key_anni=>$value_anni)
									<a class="btn btn-light" href="<?php if($lingua=="eng"){?>en/<?php }?>press-<?php echo $value_anni->anno;?>.html#conference" <?php if($value_anni->anno==$anno_rassegna){?>style="background:#e8e8e8"<?php }?>><?php echo $value_anni->anno;?></a>
								@endforeach
							</div>
						</div>
						<div style="margin-top:30px;">
							@php
								$query_ras = DB::table('rassegna')						
									->select('*')
									->where('data','LIKE','%'.$anno_rassegna.'%')
									//dd($query_ras->toSql(),$query_ras->getBindings());
									->get();
								$x=1;
							@endphp
							@foreach($query_ras AS $key_ras=>$value_ras)
								@php								
									$titolo=$value_ras->titolo_eng;
									if($lingua=="ita" && $value_ras->titolo && $value_ras->titolo!="") $titolo=$value_ras->titolo;
								@endphp
								<a href="press-conference-<?php echo $value_ras->id;?>.html">
									<div style="width:100%; border-bottom:1px solid #eee; <?php if($x==1){?>background:#f5f5f5;<?php }?>">
										<div style="padding:5px">
											<?php if($lingua=="eng") echo str_replace("-","/",$value_ras->data); else echo convertDateFormat($value_ras->data,"Y-m-d", "d/m/Y");?> - <?php echo $titolo;?>
										</div>
									</div>
								</a>
								@php								
									$x++; if($x==3) $x=1;
								@endphp
							@endforeach
						
						</div>
						
						<div style="width:100%; height:40px"></div>
							
						<?php if($lingua=="ita"){?>		
							<p>
								L'ufficio stampa è a disposizione per qualsiasi ulteriore informazione:<br /><br />
								<strong>Contatti Ufficio Stampa</strong><br />
								
								Marialisa Panu & Giuliano Luzzatto | Yacht Club Costa Smeralda<br />
								tel. +39 0789 902200 - <span id="cloak47874">Questo indirizzo email è protetto dagli spambots. È necessario abilitare JavaScript per vederlo.</span>
								<script type='text/javascript'>
									 //<!--
									 document.getElementById('cloak47874').innerHTML = '';
									 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
									 var path = 'hr' + 'ef' + '=';
									 var addy47874 = 'pr&#101;ss&#111;ff&#105;c&#101;' + '&#64;';
									 addy47874 = addy47874 + 'yccs' + '&#46;' + '&#105;t';
									 var addy_text47874 = 'pr&#101;ss&#111;ff&#105;c&#101;' + '&#64;' + 'yccs' + '&#46;' + '&#105;t';
									 document.getElementById('cloak47874').innerHTML += '<a ' + path + '\'' + prefix + ':' + addy47874 + '\'>'+addy_text47874+'<\/a>';
									 //-->
								 </script>
							 </p>
						<?php }else{?>
							<p>
								Please do not hesitate to contact the Press Office for any further information you may require.<br /><br />
								<strong>Press Office</strong><br />
								
								Marialisa Panu & Giuliano Luzzatto | Yacht Club Costa Smeralda<br />
								tel. +39 0789 902200 - <span id="cloak47874">This email address is being protected from spambots. You need JavaScript enabled to view it.</span>
								<script type='text/javascript'>
									 //<!--
									 document.getElementById('cloak47874').innerHTML = '';
									 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
									 var path = 'hr' + 'ef' + '=';
									 var addy47874 = 'pr&#101;ss&#111;ff&#105;c&#101;' + '&#64;';
									 addy47874 = addy47874 + 'yccs' + '&#46;' + '&#105;t';
									 var addy_text47874 = 'pr&#101;ss&#111;ff&#105;c&#101;' + '&#64;' + 'yccs' + '&#46;' + '&#105;t';
									 document.getElementById('cloak47874').innerHTML += '<a ' + path + '\'' + prefix + ':' + addy47874 + '\'>'+addy_text47874+'<\/a>';
									 //-->
								 </script>
							 </p>
						<?php }?>
					</div>
				</div>
				<div class="content col-lg-1"></div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-12">
							@include('web.common.laterale')
						</div>
						
					</div>
				</div>
				<!-- end: Sidebar--> 
			</div>
		</div>
	</section> <!-- end: Content -->
	@include('web.assets.la_storia_js')
@endsection