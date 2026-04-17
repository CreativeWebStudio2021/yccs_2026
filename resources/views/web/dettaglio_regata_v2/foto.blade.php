<!-- FOTO -->
<div style="position:relative; margin-top:0px; margin-bottom:40px; min-height:250px; text-align:center; padding:20px 0; ">
	<div  id="foto"  style="position:absolute; top:-100px;"></div>
	
	
	
	@php
		$query_img = DB::table('edizioni_foto');
		$query_img = $query_img->select('*');
		$query_img = $query_img->where('id_edizione','=',$id_dett);
		$query_img = $query_img->orderby('ordine','DESC');
		$query_img = $query_img->limit('10');
		$query_img = $query_img->get();
		$num_img = $query_img->count();
	@endphp
	
	<?php if($num_img>0){?><a href="regate-<?php echo $anno_regata;?>/fotogallery/<?php echo to_htaccess_url($nome_regata,"");?>-<?php echo $id_dett;?>.html"><?php }?>
		<div style="position:absolute; left:19px; top:19px; background:#fff; z-index:100">
			<div  class="titoliBox" style="padding: 15px 30px; font-size:0.9em; color:#<?php echo $colore_testo;?>">
				FOTOGALLERY&nbsp;&nbsp;<?php if($num_img>0){?><i class="fa fa-chevron-right" aria-hidden="true"></i><?php }?>
			</div>
		</div>
	<?php if($num_img>0){?></a><?php }?>
	
	@if($num_img>0)
		@php 
			$i=1; 
			$dim_square = 19;
			$dim_square2 = 50;
		@endphp	
		<style>
			.foto_carousel_desk{display:block !important}
			.foto_carousel_mob{display:none !important}
			
			.carousel-foto .portfolio-item:not(.no-overlay):hover .portfolio-image:after{
				opacity:0;
			}
			.portfolio-item-wrap{
				margin:0 auto;
				width:<?php echo $dim_square;?>vw; 
				height:<?php echo $dim_square;?>vw;
			}
			@media screen AND (max-width:575px){
				.foto_carousel_desk{display:none !important}
				.foto_carousel_mob{display:block !important}
			
				.portfolio-item-wrap{
					width:<?php echo $dim_square2;?>vw; 
					height:<?php echo $dim_square2;?>vw;
					margin-top:50px;
				}
			}
			.flickity-button {
				top:90%;
			}
		</style>
		<div class="carousel carousel-foto imgSlide" data-items="1" data-dots="false" data-lightbox="gallery" style="padding:3vw">
			@foreach($query_img AS $key_img=>$value_img)
				@foreach($value_img AS $key_risu=>$value_risu)
					@php
						$risu_img[$key_risu]=$value_risu;
					@endphp
				@endforeach
				@php
					if (stristr($risu_img['foto'],"admin")==true || stristr($risu_img['foto'],"resarea")) {
						$foto=substr($risu_img['foto'],1);
						$foto=str_replace("admin/img_up/regate/foto/","",$foto);
						$foto=str_replace("resarea/img_up/regate/foto/","",$foto);
						
						if(file_exists(public_path()."/resarea/img_up/regate/foto/s_$foto")) 
							$s_foto="resarea/img_up/regate/foto/s_$foto";
						elseif(file_exists(public_path()."/resarea/img_up/regate/foto/$foto")) 
							$s_foto="resarea/img_up/regate/foto/$foto";
						else 
							$s_foto="https://www.yccs.it/resarea/img_up/regate/foto/$foto";
						
						$foto="resarea/img_up/regate/foto/$foto";	
						if(file_exists(public_path()."/resarea/img_up/regate/foto/$foto")) 
							$foto="resarea/img_up/regate/foto/$foto";						
						else
							$foto="https://www.yccs.it/resarea/img_up/regate/foto/$foto";
					} else {
						$foto=substr($risu_img['foto'],1);
						$foto=str_replace("-150-100","-800-600",$foto);
						$foto=str_replace("-140-90","-800-600",$foto);
						$foto=substr($foto,0,-6).".jpg";
						
						$s_foto=substr($risu_img['foto'],1);
					}
					
					$new_w = $dim_square;
					$new_w2 = $dim_square;
					$new_h = $dim_square;
					$new_h2 = $dim_square;
					$mtop = "";
					$mtop2 = "";
					
					if(!empty($s_foto)){
						$dim = getimagesize($s_foto);
						$w = $dim[0];
						$h = $dim[1];
						
						if($w>=$h){
							$new_w = $dim_square;
							$new_h = ($dim_square*$h/$w);
							$mtop = "margin-top:".(($dim_square-$new_h)/2)."vw;";
							
							$new_w2 = $dim_square2;
							$new_h2 = ($dim_square2*$h/$w);
							$mtop2 = "margin-top:".(($dim_square2-$new_h2)/2)."vw;";
						}else{
							$new_h = $dim_square;
							$new_w = ($dim_square*$w/$h);
							
							$new_h2 = $dim_square2;
							$new_w2 = ($dim_square2*$w/$h);
						}
					}
				@endphp	
				<div class="portfolio-item">
					<div class="portfolio-item-wrap">
						<div class="portfolio-image" style="text-align:Center;">
							<a href="#">
								<img class="foto_carousel_desk" src="<?php echo $s_foto;?>" alt="<?php echo $titolo_regata;?> - <?php echo $i;?>" style="width:<?php echo $new_w;?>vw; height:<?php echo $new_h;?>vw; margin:0 auto; <?php echo $mtop;?> border:solid 10px #fff">
								<img class="foto_carousel_mob" src="<?php echo $s_foto;?>" alt="<?php echo $titolo_regata;?> - <?php echo $i;?>" style="width:<?php echo $new_w2;?>vw; height:<?php echo $new_h2;?>vw; margin:0 auto; <?php echo $mtop2;?> border:solid 10px #fff">
							</a>
						</div>
						<div class="portfolio-description">
							<a title="<?php echo $titolo_regata;?> - <?php echo $i;?>" data-lightbox="gallery-image" href="<?php echo $foto;?>" class="btn btn-light btn-rounded">Zoom</a>
						</div>
					</div>
				</div>
				@php $i++; @endphp
			@endforeach	
		</div>
	@else	
		<div  style="margin-top:100px; text-align:center;">
			<img src="https://www.yccs.it/web/images/new/coming_soon_foto.png" alt="<?php echo $titolo_regata;?>"  style=" margin:0 auto; max-width:150px;" class="imgSlide"/>	
		</div>	
	@endif
</div>
<!-- FINE FOTO -->