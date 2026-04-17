@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/storia.jpg";
		$video_background = "web/video/Young-Azzurra-1920x500.mp4";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Young Azzurra'; $breadcrumbs[$x]['link']='young-azzurra.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					<style>
						/* Griglia responsive: 3 / 2 / 1 per riga */
						.team-members > div {
							margin-bottom: 30px;
						}
						@media (min-width: 1200px) {
							.team-members > div {
								flex: 0 0 33.3333%;
								max-width: 33.3333%;
							}
						}
						@media (min-width: 768px) and (max-width: 1199.98px) {
							.team-members > div {
								flex: 0 0 50%;
								max-width: 50%;
							}
						}
						@media (max-width: 767.98px) {
							.team-members > div {
								flex: 0 0 100%;
								max-width: 100%;
							}
						}

						/* Box anteprima con rapporto 16:9, tutte uguali */
						.video-thumb-wrapper {
							width: 100%;
							position: relative;
							aspect-ratio: 16 / 9;
							overflow: hidden;
							border-radius: 4px;
						}
						.video-thumb-wrapper img {
							width: 100%;
							height: 100%;
							object-fit: cover;   /* taglia le bande nere sopra/sotto */
							display: block;
						}
						/* Facebook video: cerca di adattare dentro il box */
						.video-thumb-wrapper .fb-video {
							width: 100% !important;
							height: 100% !important;
						}

						/* Loader animato mentre si caricano le anteprime */
						.video-loading-spinner {
							position: absolute;
							inset: 0;
							display: flex;
							align-items: center;
							justify-content: center;
							background: rgba(0,0,0,0.02);
							z-index: 5;
						}
						.video-loading-spinner::before {
							content: "";
							width: 32px;
							height: 32px;
							border-radius: 50%;
							border: 3px solid rgba(255,255,255,0.6);
							border-top-color: #00AEEF;
							animation: video-spin 0.8s linear infinite;
						}
						@keyframes video-spin {
							to { transform: rotate(360deg); }
						}
					</style>
					<div class="row team-members">
						@php
							$query_gal = DB::table('ya_video')
									->select('*')
									->orderBy('ordine', 'DESC')
									->get();
							$num_gal = $query_gal->count();
							
							$rec_pag=12;
							$pag_tot=ceil($num_gal/$rec_pag);				
							$start=($pag_att-1)*$rec_pag;
							
							$query_gal = DB::table('ya_video')
									->select('*')
									->orderBy('ordine', 'DESC')
									->limit($rec_pag)
									->offset($start)
									->get();
						@endphp
						
						@foreach($query_gal AS $key_gal=>$value_gal)
							@php
								$titolo = $value_gal->titolo;
								if($lingua=="eng" && $value_gal->titolo_eng && trim($value_gal->titolo_eng)!="") $titolo = $value_gal->titolo_eng;
								$testo = $value_gal->testo;
								if($lingua=="eng" && $value_gal->testo_eng && trim($value_gal->testo_eng)!="") $testo = $value_gal->testo_eng;
								$link_gal="young-azzurra/video_gallery";
								if($pag_att>1) $link_gal.="-pag".$pag_att;
								$link_gal.="/".creaSlug($value_gal->titolo,"")."-".$value_gal->id.".html";
						@endphp
							<div class="col-lg-6">
								<div class="team-member">
									<div class="team-image">
										<a href="<?php echo $link_gal;?>" title="<?php echo $titolo;?> - Video Gallery - Young Azzurra">
											@if($value_gal->video_fb)
												<div id="fb-root"></div>
												<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
												<div class="video-thumb-wrapper">
													<div class="video-loading-spinner"></div>
													<div style="position:absolute; width:100%; height:100%; z-index:100"></div>
													<div class="fb-video" data-href="https://www.facebook.com/facebook/videos/<?php echo $value_gal->video_fb;?>/"  data-show-text="false"></div>
												</div>
											@else
												@php
													$video = $value_gal->video;					
													$arr_link = explode("?v=",$value_gal->video);
													if (isset($arr_link[1]) && $arr_link[1]!="") $codice_video = substr($arr_link[1],0,11);
														else $codice_video = $video;
													$foto_gal = "http://i4.ytimg.com/vi/".$codice_video."/hqdefault.jpg";
												@endphp
												<div class="video-thumb-wrapper">
													<div class="video-loading-spinner"></div>
													<img src="<?php echo $foto_gal;?>" alt="<?php echo $titolo;?> - Video Gallery - Young Azzurra"/>
												</div>
											@endif
										</a>
									</div>
									<div class="team-desc">
										<a href="<?php echo $link_gal;?>" title="<?php echo $titolo;?> - Video Gallery - Young Azzurra">
											<h3 style="font-size:20px"><?php echo $titolo;?></h3>
										</a>
										<a class="read-more" style="font-size:14px; color:#8D8D8D; font-family:'Open Sans'; font-weight:700" title="<?php echo $titolo;?> - Video Gallery - Young Azzurra" href="<?php echo $link_gal;?>"><?php if($lingua=="ita"){?>GUARDA IL VIDEO<?php }else{?>SEE VIDEO<?php }?></a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<script>
					document.addEventListener("DOMContentLoaded", function () {
						// Loader per le anteprime YouTube (immagini)
						document.querySelectorAll(".video-thumb-wrapper img").forEach(function (img) {
							var wrapper = img.closest(".video-thumb-wrapper");
							if (!wrapper) return;
							var spinner = wrapper.querySelector(".video-loading-spinner");
							if (!spinner) return;

							function hideSpinner() {
								spinner.style.display = "none";
							}

							if (img.complete) {
								hideSpinner();
							} else {
								img.addEventListener("load", hideSpinner);
								img.addEventListener("error", hideSpinner);
							}
						});

						// Loader per i video Facebook (più lenti): fallback con timeout
						document.querySelectorAll(".video-thumb-wrapper .fb-video").forEach(function (fb) {
							var wrapper = fb.closest(".video-thumb-wrapper");
							if (!wrapper) return;
							var spinner = wrapper.querySelector(".video-loading-spinner");
							if (!spinner) return;

							// Nasconde comunque lo spinner dopo qualche secondo
							setTimeout(function () {
								spinner.style.display = "none";
							}, 2500);
						});
					});
					</script>
					@if($pag_tot>1)
						@php
							$root_link="young-azzurra/video_gallery_pag";
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
								<li class="page-item disabled"><a href="#">...</a></li>	
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
								<li class="page-item disabled"><a href="#">...</a></li>	
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
	
@endsection