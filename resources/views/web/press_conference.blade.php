@extends('web.index')

@section('content')
	@php		
		$video_background = "web/video/Regate-generiche-1920x500.mp4";
		$img_background = "web/images/testate/storia.jpg";
		$page_title = 'Press Conference';
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Press'; $breadcrumbs[$x]['link']='press.html';  if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];		
		$x++; $breadcrumbs[$x]['titolo']='Press Conference'; $breadcrumbs[$x]['link']=''; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']=$titolo; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	@include('web.assets.la_storia_css')

	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					<div style="float:right;">
						<a href="<?php if($lingua=="eng"){?>en/<?php }?>press.html" title="YCCS Porto Cervo - Press">
							<button type="button" class="btn btn-dark btn-sm"><i class="fa fa-arrow-left"></i> Press</button>
						</a>
					</div>
					<div style="clear:both"></div>
					<h2>{!! $titolo !!}</h2>
					
					@php
						$query_foto = DB::table('rassegna_foto')
							->select('*')
							->where('id_rassegna','=',$id_dett)
							->orderby('ordine','DESC')
							->get();
						$num_foto = $query_foto->count();
						
						$query_video = DB::table('rassegna_video')
							->select('*')
							->where('id_rassegna','=',$id_dett)
							->orderby('ordine','DESC')
							->get();
						$num_video = $query_foto->count();
						
						$query_documenti = DB::table('rassegna_doc')
							->select('*')
							->where('id_rassegna','=',$id_dett)
							->orderby('ordine','DESC')
							->get();
						$num_documenti = $query_foto->count();
						
						if($num_video>0) $active="video";
						if($num_documenti>0) {if($lingua=="eng")  $active="documents"; else $active="documenti";}
						if($num_foto>0) {if($lingua=="eng")  $active="photo"; else $active="foto";}
						if($active_tab!="") $active = $active_tab;						
					@endphp
					
					<div class="tabs tabs-folder">
						<ul class="nav nav-tabs" id="myTab3" role="tablist">
							<?php if($lingua=="eng") $link_tab="press-conference-$id_dett/photo.html"; else $link_tab="press-conference-$id_dett/foto.html";?>
							<li class="nav-item" <?php if($num_foto>0){?>onmousedown="window.location='<?php echo config('app.url');?>/<?php if($lingua=="eng") echo "en/";?><?php echo $link_tab;?>'"<?php }?>>
								<a class="nav-link <?php if($num_foto==0){?>disabled<?php }?> <?php if($active=="foto" || $active=="photo"){?>active<?php }?>" id="home-tab" data-toggle="tab" href="#foto" role="tab" aria-controls="home" aria-selected="true"><?php if($lingua=="ita"){?>Foto<?php }else{?>Photo<?php }?></a>
							</li>
							<?php if($lingua=="eng") $link_tab="press-conference-$id_dett/documents.html"; else $link_tab="press-conference-$id_dett/documenti.html";?>
							<li class="nav-item" <?php if($num_documenti>0){?>onmousedown="window.history.pushState({},'','<?php if($lingua=="eng") echo "en/";?><?php echo $link_tab;?>');"<?php }?>>
								<a class="nav-link <?php if($num_documenti==0){?>disabled<?php }?> <?php if($active=="documenti" || $active=="documents"){?>active<?php }?>" id="profile-tab" data-toggle="tab" href="#documenti" role="tab" aria-controls="profile" aria-selected="false"><?php if($lingua=="ita"){?>Documenti<?php }else{?>Documents<?php }?></a>
							</li>
							<?php $link_tab="press-conference-$id_dett/video.html";?>
							<li class="nav-item" <?php if($num_video>0){?>onmousedown="window.history.pushState({},'','<?php if($lingua=="eng") echo "en/";?><?php echo $link_tab;?>');"<?php }?>>
								<a class="nav-link <?php if($num_video==0){?>disabled<?php }?> <?php if($active=="video"){?>active<?php }?>" id="contact-tab" data-toggle="tab" href="#video" role="tab" aria-controls="contact" aria-selected="false">Video</a>
							</li>							
						</ul>
						<div class="tab-content" id="myTabContent3">
							<div class="tab-pane fade <?php if($active=="foto" || $active=="photo"){?> show active<?php }?>" id="foto" role="tabpanel" aria-labelledby="home-tab">
								@php					
									$num_gal = 0;
									$query_gal = DB::table('rassegna_foto')
										->select('*')
										->where('id_rassegna', '=', $id_dett)
										->orderBy('ordine', 'DESC')
										->get();
									$num_gal = $query_gal->count();
									
									$dir_up = "resarea/img_up";		
									$g=0;
								@endphp
								@if ($num_gal>0)
									<div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="20" data-lightbox="gallery">		
										@foreach($query_gal AS $key_gal=>$value_gal)
											@php
												$g++;
												$foto_gal = $value_gal->foto;
												$testo = $value_gal->testo;
												
												$testo_foto=$testo;
											@endphp
											
											@if ($foto_gal!="")
												@php
													if(file_exists(public_path()."/resarea/img_up/rassegna/foto/s_$foto_gal")) $s_foto="resarea/img_up/rassegna/foto/s_$foto_gal";
													else $s_foto="resarea/img_up/rassegna/foto/$foto_gal";
													$foto="resarea/img_up/rassegna/foto/$foto_gal";	
												@endphp
											@endif
											
											<div class="portfolio-item shadow img-zoom">
												<div class="portfolio-item-wrap">
													<div class="portfolio-image">
														<img src="<?php echo $foto;?>" alt="">
													</div>
													<div class="portfolio-description">
														<a title="<?php if(isset($testo_foto) && $testo_foto!="") echo $testo_foto;?>" data-lightbox="gallery-image" href="https://www.yccs.it/<?php echo $foto;?>"><i class="icon-maximize"></i></a>
													</div>
												</div>
											</div>
										@endforeach
									</div>
								@endif
							</div>
							<div class="tab-pane fade <?php if($active=="documenti" || $active=="documents"){?> show active<?php }?>" id="documenti" role="tabpanel" aria-labelledby="profile-tab">
								@if($num_documenti>0)
									<div class="list-group">
										@php
											$x=1;
										@endphp
										@foreach($query_documenti AS $key_documenti=>$value_documenti)
											@php
												foreach($value_documenti AS $key=>$value){
													$risu_documenti[$key] = $value;
												}
											@endphp		
											<?php 
											if($lingua=="ita" && $risu_documenti['link'] && $risu_documenti['link']!="") $link=$risu_documenti['link']; 
												else  $link=$risu_documenti['link_eng'];
											if($lingua=="ita" && $risu_documenti['file'] && $risu_documenti['file']!="") $pdf=$risu_documenti['file']; 
												else  $pdf=$risu_documenti['file_eng'];
											if ($risu_documenti['tipo_link']=="link" && $link!="") {
												?>
												<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
													<?php if($lingua=="ita" && $risu_documenti['testo_link'] && $risu_documenti['testo_link']!="") echo $risu_documenti['testo_link']; 
													else echo $risu_documenti['testo_link_eng']; ?>
												</a>									
												<?php 
											} elseif ($risu_documenti['tipo_link']=="allegato" && $pdf!="") {
												?>
												<a href="https://www.yccs.it/resarea/files/rassegna/doc/<?php echo $pdf?>" target="_blank" class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>										
													<?php if($lingua=="ita" && $risu_documenti['testo_link'] && $risu_documenti['testo_link']!="") echo $risu_documenti['testo_link']; 
													else echo $risu_documenti['testo_link_eng']; ?>
												</a>	
												<?php 
											}else{?>
												<span class="list-group-item" style="border:0px; <?php if($x==1){?>background:#f9f9f9<?php }?>" <?php if($x==1){?>onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#f9f9f9'"<?php }?>>
													<?php 
													if($lingua=="ita" && $risu_documenti['testo_link'] && $risu_documenti['testo_link']!="") echo $risu_documenti['testo_link']; 
													else echo $risu_documenti['testo_link_eng'];?>
												</span>
											<?php }
											$x++;
											if($x==3) $x=1;?>
										@endforeach
									</div>
								@endif
							</div>
							<div class="tab-pane fade <?php if($active=="video"){?> show active<?php }?>" id="video" role="tabpanel" aria-labelledby="contact-tab">
								@if($num_video>0)
									<div class="accordion">
										@foreach($query_video AS $key_video=>$value_video)
											@php
												$arr_link = explode("?v=",$value_video->video);
												if (isset($arr_link[1]) && $arr_link[1]!="") $video = substr($arr_link[1],0,11);
												else $video = $value_video->video;
												
												$titolo_video = $value_video->titolo;
												if($lingua=="eng" && $value_video->titolo_eng && $value_video->titolo_eng!="") $titolo_video = $value_video->titolo_eng; 
											@endphp
											<div class="ac-item">
												<h5 class="ac-title">{!! $titolo_video !!}</h5>
												<div class="ac-content">
													<div class="video-container">
														<iframe width="640" height="352" src="https://www.youtube.com/embed/<?php echo $video?>?rel=0" frameborder="0" allowfullscreen></iframe>
													</div>
												</div>
											</div>
										@endforeach		
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-3" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
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
@endsection