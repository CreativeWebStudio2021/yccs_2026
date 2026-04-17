@if(($value_ed->banner_img && trim($value_ed->banner_img)!="" && file_exists(public_path()."/resarea/img_up/regate/".$value_ed->banner_img)) || ($value_ed->banner_img_eng && trim($value_ed->banner_img_eng)!="" && is_file("resarea/img_up/regate/".$value_ed->banner_img_eng)))
	@php 	
		if($value_ed->banner_img && trim($value_ed->banner_img)!="" && file_exists(public_path()."/resarea/img_up/regate/".$value_ed->banner_img)) $banner_ita=$value_ed->banner_img; else $banner_ita="";
		if($value_ed->banner_img_eng && trim($value_ed->banner_img_eng)!="" && file_exists(public_path()."/resarea/img_up/regate/".$value_ed->banner_img_eng)) $banner_eng=$value_ed->banner_img_eng; else $banner_eng="";
		
		if($banner_ita=="") $banner_ita=$banner_eng;
		if($banner_eng=="") $banner_eng=$banner_ita;
		
		$banner_ita = "resarea/img_up/regate/".$banner_ita;
		$banner_ita_1200 = $banner_ita;
		$banner_ita_800 = $banner_ita;
		$banner_ita_400 = $banner_ita;
		
		if(file_exists(public_path()."/resarea/img_up/regate/1200_".$banner_ita)) $banner_ita_1200 = "resarea/img_up/regate/1200_".$banner_ita;
		if(file_exists(public_path()."/resarea/img_up/regate/800_".$banner_ita)) $banner_ita_800 = "resarea/img_up/regate/800_".$banner_ita;
		if(file_exists(public_path()."/resarea/img_up/regate/400_".$banner_ita)) $banner_ita_400 = "resarea/img_up/regate/400_".$banner_ita;
		
		$banner_eng = "resarea/img_up/regate/".$banner_eng;
		$banner_eng_1200 = $banner_eng;
		$banner_eng_800 = $banner_eng;
		$banner_eng_400 = $banner_eng;
		
		if(file_exists(public_path()."/resarea/img_up/regate/1200_".$banner_eng)) $banner_eng_1200 = "resarea/img_up/regate/1200_".$banner_eng;
		if(file_exists(public_path()."/resarea/img_up/regate/800_".$banner_eng)) $banner_eng_800 = "resarea/img_up/regate/800_".$banner_eng;
		if(file_exists(public_path()."/resarea/img_up/regate/400_".$banner_eng)) $banner_eng_400 = "resarea/img_up/regate/400_".$banner_eng;
		
		if($value_ed->banner_link_eng && trim($value_ed->banner_link_eng)!="") $link_eng=$value_ed->banner_link_eng; else $link_eng="";
		if($value_ed->banner_link && trim($value_ed->banner_link)!="") $link_ita=$value_ed->banner_link; else $link_ita="";
		
		if ($link_ita=="") $link_ita=$link_eng;
		if ($link_eng=="") $banner_eng=$link_ita;
		
		$nome_regata   = $value_ed->nome_regata;
		$luogo    = $value_ed->luogo;
		$anno_regata   = $value_ed->anno;

		$titolo_regata=$nome_regata." - ".$luogo." ".$anno_regata;
	@endphp
	
	<div style="width:100%; padding:30px 0;">
		<div style="width:100%;">
			<a href="<?php if($lingua=="ita") echo $link_ita; else echo $link_eng;?>">
				<picture>
					<source srcset="<?php if($lingua=="ita") echo $banner_ita_400; else echo $banner_eng_400;?>" media="(max-width: 400px)" />
					<source srcset="<?php if($lingua=="ita") echo $banner_ita_800; else echo $banner_eng_400;?>" media="(max-width: 800px)" />
					<source srcset="<?php if($lingua=="ita") echo $banner_ita_1200; else echo $banner_eng_1200;?>" media="(max-width: 1200px)" />
					<img src="<?php if($lingua=="ita") echo $banner_ita; else echo $banner_eng;?>" style="width:100%;" alt="<?php echo $titolo_regata;?>"/>
				</picture>
			</a>
		</div>
	</div>
@endif