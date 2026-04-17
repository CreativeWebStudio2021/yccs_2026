@extends('web.index')

@section('content')
	@php		
		$video_background = "web/video/Regate-generiche-1920x500.mp4";
		$img_background = "web/images/testate/storia.jpg";
		if($lingua=="ita" && $query_dett[0]->titolo && $query_dett[0]->titolo!="") $tit_st = $query_dett[0]->titolo; 
			else $tit_st = $query_dett[0]->titolo_eng;
			
		if($lingua=="ita" && $query_dett[0]->descr && $query_dett[0]->descr!="") $descr_st = $query_dett[0]->descr; 
			else $descr_st = $query_dett[0]->descr_eng;
		$data_st = convertDateFormat($query_dett[0]->data_stampa,"Y-m-d", "d/m/Y");
		
		$img_background = "web/images/testate/ufficio_stampa.jpg";
		if($lingua=="ita") $page_title = "Press"; else  $page_title = "Press";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='YCCS Porto Cervo'; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.press nome pagina'); $breadcrumbs[$x]['link']='press.html'; if($lingua=="eng") $breadcrumbs[$x]['link'] = "en/".$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']=$tit_st; $breadcrumbs[$x]['link']='';

		$dir_up = "resarea/img_up";		
	@endphp
	<style>
		.slide-content-overlay-title{
			width:100% !important;
		}
	</style>
	@include('web.common.page_title')
	
	@include('web.assets.la_storia_css')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">					
					<div class="post-item" style="padding:0; border-bottom:1px solid #eee; margin-bottom:40px; ">
						<div class="post-item-wrap">
							@if ($query_dett[0]->img!="")
								<div class="post-image">
									<img alt="" src="https://www.yccs.it/<?php  echo $dir_up; ?>/stampa/<?php  echo $query_dett[0]->img; ?>">
								</div>
							@endif
							<div class="post-item-description">
								<h2>
								{!! ucfirst($tit_st) !!}
								</h2>
								@if ($data_st!="")
									<span class="post-meta-date" style="color:#222"><i class="fa fa-calendar" aria-hidden="true"></i><?php  echo $data_st; ?></span>											
								@endif
								@if ($descr_st!="")
									@php 
										$testo_gal = $descr_st; 
									@endphp
									@if(isset($testo_gal) && $testo_gal!="")
										<p>@include('web.common.testo_gal')	</p>							
									@endif
								@endif
							</div>
						</div>
					</div>	
					
					<section style="padding:0">
						<div class="tabs tabs-folder">
							<ul class="nav nav-tabs" id="myTab3" role="tablist">
								@php
									$query_foto = DB::table('gallery_stampa');
									$query_foto = $query_foto->select('*');
									$query_foto = $query_foto->where('id_rife','=',$id_dett);
									$query_foto = $query_foto->orderby('ordine','DESC');
									$query_foto = $query_foto->get();
									$num_foto = $query_foto->count();
									
									$query_documenti = DB::table('documenti_stampa');
									$query_documenti = $query_documenti->select('*');
									$query_documenti = $query_documenti->where('id_rife','=',$id_dett);
									$query_documenti = $query_documenti->orderby('ordine','DESC');
									$query_documenti = $query_documenti->get();
									$num_documenti = $query_documenti->count();
									
									$video_st = $query_dett[0]->video;
									$active="foto";
									if($num_foto>0) $active="foto";
									elseif($video_st!="") $active="video";
									elseif($num_documenti>0) $active="documenti";
									
									if(isset($tipo)) $active=$tipo;
																
									if(isset($_SESSION['tab_'.$id_dett])) $active = $_SESSION['tab_'.$id_dett];

									$link_tab="press"."/".$active."/".creaSlug($tit_st,"")."-".$id_dett.".html";
									if($lingua=="eng") $link_tab="en/".$link_tab;
									
									$dir_up = "resarea/img_up";
								@endphp
								
							
								@php $link_tab="press/foto/".creaSlug($tit_st,"")."-".$id_dett.".html"; @endphp
								
								@if($num_foto>0)
									<li class="nav-item" 
										<?php if(isset($tipo) && $tipo!="foto"){?>
											onclick="window.location='<?php echo $link_tab;?>'"									
										<?php }?>
									>
										<a class="nav-link {{ $active=='foto' ? 'active' : '' }}" id="home-tab" data-toggle="tab" href="#foto" role="tab" aria-controls="home" aria-selected={{ $active=='foto' ? 'true' : 'false' }}>Foto</a>
									</li>
								@endif
								@if($video_st!="")
									@php $link_tab=str_replace("/foto/","/video/",$link_tab); @endphp
									<li class="nav-item">
										<a class="nav-link {{ $active=='video' ? 'active' : '' }}" id="profile-tab" data-toggle="tab" href="#video" role="tab" aria-controls="profile" aria-selected={{ $active=='video' ? 'true' : 'false' }}>Video</a>
									</li>
								@endif
								@if($num_documenti>0)
									@php $link_tab=str_replace("/video/","/documenti/",$link_tab); @endphp
									<li class="nav-item">
										<a class="nav-link {{ $active=='documenti' ? 'active' : '' }}" id="contact-tab" data-toggle="tab" href="#documenti" role="tab" aria-controls="contact" aria-selected={{ $active=='documenti' ? 'true' : 'false' }}><?php if($lingua=="ita"){?>Documenti<?php }else{?>Documents<?php }?></a>
									</li>
								@endif
							</ul>
							@if($num_foto>0 || $video_st!="" || $num_documenti>0 )
								<div class="tab-content" id="myTabContent3">
									@if($num_foto>0)
										<div class="tab-pane fade {{ $active=='foto' ? 'show active' : '' }}" id="foto" role="tabpanel" aria-labelledby="home-tab">
											<div id="" class="grid-layout post-4-columns m-b-30" data-lightbox="gallery" data-item="post-item">
												@foreach($query_foto AS $key_foto=>$value_foto)
													@php
														$foto=$value_foto->img;	
														if(is_file("resarea/img_up/stampa/gallery/s_$foto")) $s_foto="resarea/img_up/stampa/gallery/s_$foto";
															else $s_foto="resarea/img_up/stampa/gallery/$foto";
														$foto="resarea/img_up/stampa/gallery/$foto";
													@endphp
													<!-- Post item-->
													<div class="post-item border">
														<div class="post-item-wrap">
															<div class="post-image">
																<a href="{{ $foto }}" data-lightbox="gallery-image">
																	<img alt="{!! ucfirst($tit_st) !!} - {!! Lang::get('website.comunicati nome pagina') !!} - {{ config('app.name') }}" src="https://www.yccs.it/{{ $s_foto }}">
																</a>
															</div>
														</div>
													</div>
													<!-- end: Post item-->
												@endforeach
											</div>
										</div>
									@endif
									@if($video_st!="")
										<div class="tab-pane fade {{ $active=='video' ? 'show active' : '' }}" id="video" role="tabpanel" aria-labelledby="profile-tab">
											<div class="post-item border">
												<div class="post-item-wrap">
													<div class="post-video">
														@php
															$arr_link = explode("?v=",$video_st);
															if ($arr_link[1]!="") $video = substr($arr_link[1],0,11);
																else $video = $video_st;
														@endphp
														
														<iframe width="560" height="320" src="https://www.youtube.com/embed/{{$video}}?rel=0" frameborder="0" allowfullscreen></iframe>
													</div>
												</div>
											</div>
										</div>
									@endif
									@if($num_documenti>0)
										<div class="tab-pane fade {{ $active=='documenti' ? 'show active' : '' }}" id="documenti" role="tabpanel" aria-labelledby="contact-tab">
											<style>
												.list-group-item{background:#FFFFFF; transition: 0.3s;}
												.list-group-item:hover{background:#f4f4f4;}
												.list-group-item2{background:#F9F9F9; transition: 0.3s;}
												.list-group-item2:hover{background:#f4f4f4;}
											</style>
											<div class="list-group">
												@php $x=1 @endphp
												@foreach($query_documenti AS $key_documenti=>$value_documenti)
													@php
														if($lingua=="ita" && $value_documenti->pdf && $value_documenti->pdf!="") $pdf=$value_documenti->pdf; 
														else  $pdf=$value_documenti->pdf_eng;
														
														if($lingua=="ita" && $value_documenti->testo_link && $value_documenti->testo_link!="") $testo_link = $value_documenti->testo_link; 
															else $testo_link = $value_documenti->testo_link_eng;
													@endphp
													@if ($pdf!="")
														<a href="resarea/files/stampa/{{ $pdf }}" target="_blank" class="list-group-item {{ $x=='2' ? 'list-group-item2' : '' }} list-group-item-action">{!! $testo_link !!}</a>												
													@endif
													@php $x++; if($x==3) $x=1; @endphp
												@endforeach
											</div>
										</div>
									@endif
								</div>
							@endif
						</div>
						
					</section>
				</div>	
				<div class="content col-lg-1"></div>				
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-9">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-3"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
	@include('web.assets.la_storia_js')
@endsection