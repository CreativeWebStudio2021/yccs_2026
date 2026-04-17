@php
	$img_background = "web/images/testate/storia.jpg";
		$video_background = "web/video/Young-Azzurra-1920x500.mp4";
	$page_title = $query_dett[0]->titolo;
	$x=0;
	$x++; $breadcrumbs[$x]['titolo']='Young Azzurra'; $breadcrumbs[$x]['link']='young-azzurra.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
	$x++; $breadcrumbs[$x]['titolo']='Photogallery'; $breadcrumbs[$x]['link']='young-azzurra/photogallery.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
	if(isset($nome_cat)){		
		$link_cat = "young-azzurra/photogallery-category/".creaSlug($nome_cat)."-".$query_dett['0']->id_rife.".html";
		if($lingua=="eng") $link_cat = "en/".$link_cat;
		$x++; $breadcrumbs[$x]['titolo']=$nome_cat; $breadcrumbs[$x]['link']=$link_cat;			
	}
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
				@if(isset($nome_cat))
					<div style="float:right; margin-left:10px;">
						<a href="{{ $link_cat }}" title="{!! $nome_cat !!} - Photogallery - Young Azzurra">
							<button type="button" class="btn btn-dark btn-sm"><i class="fa fa-arrow-left"></i> {!! $nome_cat !!}</button>
						</a>
					</div>						
				@endif
				<div style="float:right;">
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/photogallery<?php if($pag_att && $pag_att>1){?>_pag<?php echo $pag_att;?><?php }?>.html" title="Young Azzurra - Photogallery">
						<button type="button" class="btn btn-dark btn-sm"><i class="fa fa-arrow-left"></i> Photogallery</button>
					</a>
				</div>
				<div style="clear:both"></div>
				<h2><?php echo $page_title;?></h2>
				
				@php
					$testo_gal = $query_dett[0]->testo;
					if($lingua=="eng" && $query_dett[0]->testo_eng && trim($query_dett[0]->testo_eng)!="") $testo_gal = $query_dett[0]->testo_eng;
				@endphp
				@if(isset($testo_gal) && $testo_gal!="")
					<p>{!! $testo_gal !!}</p>
				@endif	
				
				@php					
					$num_gal = 0;
					$query_gal = DB::table('ya_gallery_foto')
						->select('foto', 'testo', 'testo_eng')
						->where('id_rife', '=', $id_dett)
						->orderBy('ordine', 'DESC')
						->get();
					$num_gal = $query_gal->count();
					
					$dir_up = "resarea/img_up";		
					$g=0;
				@endphp
				
				@if ($num_gal>0)
					<hr style="color:#75797D; border-top: 1px solid #75797D; margin:30px 30px 40px"/>
					<div id="portfolio" class="grid-layout portfolio-3-columns" data-margin="20" data-lightbox="gallery">
						@foreach($query_gal AS $key_gal=>$value_gal)
							@php
								$g++;
								$foto_gal = $value_gal->foto;
								$testo = $value_gal->testo;
								$testo_eng = $value_gal->testo_eng;
								
								$testo_foto="";
								if($testo && trim($testo)!="")  $testo_foto=$testo;
								if($lingua=="eng" && $testo_eng && trim($testo_eng)!="")  $testo_foto=$testo_eng;
							@endphp
							
							@if ($foto_gal!="")
								@php
									if (file_exists(public_path()."/ya_gallery_foto/450_$foto_gal")) $foto_gal_m="450_$foto_gal"; else $foto_gal_m=$foto_gal;
									if (file_exists(public_path()."/ya_gallery_foto/360_$foto_gal")) $foto_gal_s="360_$foto_gal"; else $foto_gal_s=$foto_gal;
									if (file_exists(public_path()."/ya_gallery_foto/250_$foto_gal")) $foto_gal_xs="250_$foto_gal"; else $foto_gal_xs=$foto_gal;
								@endphp
							@endif
							
							<div class="portfolio-item shadow img-zoom">
								<div class="portfolio-item-wrap">
									<div class="portfolio-image">
										<a href="#">
											<picture>
											  <source srcset="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_s) }}" media="(max-width: 360px)" />
											  <source srcset="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_m) }}" media="(max-width: 478px)" />
											  <source srcset="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_s) }}" media="(max-width: 990px)" />
											  <source srcset="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_xs) }}" media="(max-width: 1199px)" />
											  <img src="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_m) }}"  alt="{{ config('app.name') }} - Fotogallery - Foto <?php echo $g;?>"/>
											</picture>	
										</a>
									</div>
									<div class="portfolio-description">
										<a title="{{ $testo_foto }}" data-lightbox="gallery-image" href="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal) }}"><i class="icon-maximize"></i></a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
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