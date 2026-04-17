@php					
	$num_gal = 0;
	$query_gal = DB::table('edizioni_foto')
		->select('*')
		->where('id_edizione', '=', $id)
		->where('id_regata', '=', $risu_reg['id'])
		->orderBy('ordine', 'DESC')
		->get();
	$num_gal = $query_gal->count();
	
	$dir_up = "resarea/img_up";		
	$g=0;
@endphp
@if ($num_gal>0)
	<div id="portfolio" class="grid-layout portfolio-5-columns" data-margin="20" data-lightbox="gallery">		
		@foreach($query_gal AS $key_gal=>$value_gal)
			@php
				$g++;
				$foto_gal = $value_gal->foto;
				$testo = $value_gal->testo;
				
				$testo_foto=$testo;
			@endphp
			
			@if ($foto_gal!="")
				@php
					if (stristr($value_gal->foto,"admin")==true || stristr($value_gal->foto,"resarea")) {
						$foto=substr($value_gal->foto,1);
						$foto=str_replace("admin/img_up/regate/foto/","",$foto);
						$foto=str_replace("resarea/img_up/regate/foto/","",$foto);
						$foto=str_replace("images/igallery/","web/images/igallery/",$foto);
						
						if(file_exists(public_path()."/resarea/img_up/regate/foto/s_$foto")) $s_foto="resarea/img_up/regate/foto/s_$foto";
						else $s_foto="resarea/img_up/regate/foto/$foto";
						$foto="resarea/img_up/regate/foto/$foto";												
					} else {
						$foto=substr($value_gal->foto,1);
						$foto=str_replace("-150-100","-800-600",$foto);
						$foto=str_replace("-140-90","-800-600",$foto);
						$foto=str_replace("images/igallery/","web/images/igallery/",$foto);
						$foto=substr($foto,0,-6).".jpg";
						
						$s_foto=substr($value_gal->foto,1);
					}
				@endphp
			@endif
			
			<div class="portfolio-item shadow img-zoom">
				<div class="portfolio-item-wrap">
					<div class="portfolio-image">
						<img src="https://www.yccs.it/<?php echo $foto;?>" alt="">
					</div>
					<div class="portfolio-description">
						<a title="<?php if(isset($testo_foto) && $testo_foto!="") echo $testo_foto;?>" data-lightbox="gallery-image" href="<?php echo $foto;?>"><i class="icon-maximize"></i></a>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endif