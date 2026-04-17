@php
	$img_background = "web/images/testate/storia.jpg";
		$video_background = "web/video/Young_Azzurra-960.mp4";
	$page_title = "Photogallery";
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
				<div class="row team-members">
					@php
						$query_gal = DB::table('ya_gallery')
								->select('*')
								->orderBy('ordine', 'DESC')
								->get();
						$num_gal = $query_gal->count();
						
						$rec_pag=12;
						$pag_tot=ceil($num_gal/$rec_pag);				
						$start=($pag_att-1)*$rec_pag;
						
						$query_gal = DB::table('ya_gallery')
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
							$link_gal="young-azzurra/photogallery";
							if($pag_att>1) $link_gal.="-pag".$pag_att;
							$link_gal.="/".creaSlug($value_gal->titolo,"")."-".$value_gal->id.".html";
						@endphp
						<div class="col-lg-6">
							<div class="team-member">
								<div class="team-image">
									<a href="<?php echo $link_gal;?>" title="<?php echo $titolo;?> - Photogallery - Young Azzurra">
										@php
											$query_f = DB::table('ya_gallery_foto')
												->select('foto')
												->where('id_rife','=',$value_gal->id)
												->where('foto','<>','')
												->orderBy('ordine', 'DESC')
												->limit(1)
												->get();
											$dir_up = "resarea/img_up";						
											$foto_gal = $query_f[0]->foto;
										
											if (file_exists(public_path()."/$dir_up/ya_gallery_foto/450_$foto_gal")) $foto_gal_m="450_$foto_gal"; else $foto_gal_m=$foto_gal;
											if (file_exists(public_path()."/$dir_up/ya_gallery_foto/360_$foto_gal")) $foto_gal_s="360_$foto_gal"; else $foto_gal_s=$foto_gal;
											if (file_exists(public_path()."/$dir_up/ya_gallery_foto/250_$foto_gal")) $foto_gal_xs="250_$foto_gal"; else $foto_gal_xs=$foto_gal;
										@endphp
										<picture>
											  <source srcset="<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_s;?>" media="(max-width: 360px)" />
											  <source srcset="<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_m;?>" media="(max-width: 478px)" />
											  <source srcset="<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_s;?>" media="(max-width: 990px)" />
											  <source srcset="<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_xs;?>" media="(max-width: 1199px)" />
											  <img src="<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_m;?>"  alt="<?php echo $titolo;?> - Photogallery - Young Azzurra" style="width:100%"/>
										</picture>
									</a>
								</div>
								<div class="team-desc">
									<a href="<?php echo $link_gal;?>" title="<?php echo $titolo;?> - Photogallery - Young Azzurra">
										<h3 style="font-size:20px"><?php echo $titolo;?></h3>
									</a>
									<a class="read-more" style="font-size:14px; color:#8D8D8D; font-family:'Open Sans'; font-weight:700" title="<?php echo $titolo;?> - Photogallery - Young Azzurra" href="<?php echo $link_gal;?>"><?php if($lingua=="ita"){?>VEDI FOTOGALLERY<?php }else{?>SEE PHOTOGALLERY<?php }?></a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				@if($pag_tot>1)
					@php
						$root_link="young-azzurra/photogallery_pag";
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