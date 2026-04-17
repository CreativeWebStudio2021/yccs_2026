@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/storia.jpg";
		$video_background = "web/video/Young_Azzurra-960.mp4";
		$page_title = $nome_cat;
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Young Azzurra'; $breadcrumbs[$x]['link']='young-azzurra.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']="Photogallery"; $breadcrumbs[$x]['link']='young-azzurra/photogallery.html'; 
		$x++; $breadcrumbs[$x]['titolo']=$nome_cat; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					<div style="float:right;">
						<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/photogallery<?php if($pag_att && $pag_att>1){?>_pag<?php echo $pag_att;?><?php }?>.html" title="Young Azzurra - Photogallery">
							<button type="button" class="btn btn-dark btn-sm"><i class="fa fa-arrow-left"></i> Photogallery</button>
						</a>
					</div>
					<div style="clear:both"></div>
					<h2><?php echo $nome_cat;?></h2>	
					<hr style="color:#75797D; border-top: 1px solid #75797D; margin:30px 30px 40px"/>
					
					<div class="row team-members">
						@php
							$dir_up = "resarea/img_up";
							$query_gal = DB::table('ya_gallery')
									->select('*')
									->where('num_foto','>','0')
									->where('id_rife','=',$id_dett)
									->get();
							$num_gal = $query_gal->count();
						@endphp
						
						@foreach($query_gal AS $key_gal=>$value_gal)
							@php
								$titolo = $value_gal->titolo;
								if($lingua=="eng" && $value_gal->titolo_eng && trim($value_gal->titolo_eng)!="") $titolo = $value_gal->titolo_eng;
								$testo = $value_gal->testo;
								if($lingua=="eng" && $value_gal->testo_eng && trim($value_gal->testo_eng)!="") $testo = $value_gal->testo_eng;
								$link_gal="young-azzurra/photogallery";
								if($pag_att>1) $link_gal.="-pag".$pag_att;
								$link_gal.="/".creaSlug($titolo,"")."-".$value_gal->id.".html";
								if($lingua=="eng") $link_gal = "en/".$link_gal;
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
											<div style="position:relative; overflow: hidden; display: flex; justify-content: center; align-items: center;"> 
												<picture>
													  <?php /*<source srcset="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_s) }}" media="(max-width: 360px)" />
													  <source srcset="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_m) }}" media="(max-width: 478px)" />
													  <source srcset="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_s) }}" media="(max-width: 990px)" />
													  <source srcset="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_xs) }}" media="(max-width: 1199px)" />*/?>
													  <img 
														src="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal) }}"  
														alt="<?php echo $titolo;?> - Photogallery - Young Azzurra"   
														style="position:absolute; width:100%; height:100%; top:0; left:0; object-fit:cover; object-position:center;"
													  />
												</picture>
												<img src="{{ smartAsset('/web/images/gallery_blank.jpg') }}" style="width:100%" alt=""/>
											</div>
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