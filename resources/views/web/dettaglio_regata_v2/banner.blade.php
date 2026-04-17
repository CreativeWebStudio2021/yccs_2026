<!-- BANNER -->
<div  id="banner"></div>
<?php 	
if(($value_ed->banner_img && trim($value_ed->banner_img)!="" && is_file("resarea/img_up/regate/".$value_ed->banner_img)) || ($value_ed->banner_img_eng && trim($value_ed->banner_img_eng)!="" && is_file("resarea/img_up/regate/".$value_ed->banner_img_eng))){
	if($value_ed->banner_img && trim($value_ed->banner_img)!="" && is_file("resarea/img_up/regate/".$value_ed->banner_img)) $banner_ita=$value_ed->banner_img; else $banner_ita="";
	if($value_ed->banner_img_eng && trim($value_ed->banner_img_eng)!="" && is_file("resarea/img_up/regate/".$value_ed->banner_img_eng)) $banner_eng=$value_ed->banner_img_eng; else $banner_eng="";
	
	if($banner_ita=="") $banner_ita=$banner_eng;
	if($banner_eng=="") $banner_eng=$banner_ita;
	
	$banner_ita = "resarea/img_up/regate/".$banner_ita;
	$banner_ita_1200 = $banner_ita;
	$banner_ita_800 = $banner_ita;
	$banner_ita_400 = $banner_ita;
	
	if(is_file("resarea/img_up/regate/1200_".$banner_ita)) $banner_ita_1200 = "resarea/img_up/regate/1200_".$banner_ita;
	if(is_file("resarea/img_up/regate/800_".$banner_ita)) $banner_ita_800 = "resarea/img_up/regate/800_".$banner_ita;
	if(is_file("resarea/img_up/regate/400_".$banner_ita)) $banner_ita_400 = "resarea/img_up/regate/400_".$banner_ita;
	
	$banner_eng = "resarea/img_up/regate/".$banner_eng;
	$banner_eng_1200 = $banner_eng;
	$banner_eng_800 = $banner_eng;
	$banner_eng_400 = $banner_eng;
	
	if(is_file("resarea/img_up/regate/1200_".$banner_eng)) $banner_eng_1200 = "resarea/img_up/regate/1200_".$banner_eng;
	if(is_file("resarea/img_up/regate/800_".$banner_eng)) $banner_eng_800 = "resarea/img_up/regate/800_".$banner_eng;
	if(is_file("resarea/img_up/regate/400_".$banner_eng)) $banner_eng_400 = "resarea/img_up/regate/400_".$banner_eng;
	
	if($value_ed->banner_link_eng && trim($value_ed->banner_link_eng)!="") $link_eng=$value_ed->banner_link_eng; else $link_eng="";
	if($value_ed->banner_link && trim($value_ed->banner_link)!="") $link_ita=$value_ed->banner_link; else $link_ita="";
	
	if ($link_ita=="") $link_ita=$link_eng;
	if ($link_eng=="") $banner_eng=$link_ita;
	?>
	<div style="margin-top:10px;">
		<div style="width:95%; text-align:center; margin:0 auto;">
			<div style="padding-bottom:40px">
				<span class="" style="color:#fff">
					<a href="<?php if($lingua=="ita") echo $link_ita; else echo $link_eng;?>">
						<picture>
							<source srcset="<?php if($lingua=="ita") echo $banner_ita_400; else echo $banner_eng_400;?>" media="(max-width: 400px)" />
							<source srcset="<?php if($lingua=="ita") echo $banner_ita_800; else echo $banner_eng_400;?>" media="(max-width: 800px)" />
							<source srcset="<?php if($lingua=="ita") echo $banner_ita_1200; else echo $banner_eng_1200;?>" media="(max-width: 1200px)" />
							<img src="<?php if($lingua=="ita") echo $banner_ita; else echo $banner_eng;?>" style="width:100%;" alt="<?php echo $titolo_regata;?>"/>
						</picture>
					</a>
				</span>
			</div>
		</div>
	</div>
<?php }?>
<!-- FINE BANNER -->