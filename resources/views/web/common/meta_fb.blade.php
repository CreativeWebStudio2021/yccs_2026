@php
	$user_fb="100001847343677";
	$app_id="132740373465062";
	$ind_fb=url()->full();
	$meta_titolo_fb=$title_pagina;
	$descrizione_fb=$description_pagina;
	$img_fb=config('app.url')."/web/images/logo.png";
	if($cmd=="news_dett" || ($cmd=="news" && isset($id_dett) && $id_dett!="") || $cmd=="young-azzurra-news-dett"){
		if($lingua=="ita") {
			if($query_dett[0]->titolo && $query_dett[0]->titolo!="") $titolo_fb = ucfirst($query_dett[0]->titolo); else $titolo_fb = ucfirst($query_dett[0]->titolo_eng);
			if($query_dett[0]->testo && $query_dett[0]->testo!="") $testo_fb = trim($query_dett[0]->testo); else $testo_fb = trim($query_dett[0]->testo_eng);
		} else {
			if($query_dett[0]->titolo_eng && $query_dett[0]->titolo_eng!="") $titolo_fb = ucfirst($query_dett[0]->titolo_eng); else $titolo_fb = ""; 
			if($query_dett[0]->testo_eng && $query_dett[0]->testo_eng!="") $testo_fb = trim($query_dett[0]->testo_eng); else $testo_fb = "";
		}
		
		$img_temp="";
		if($query_dett[0]->img && $query_dett[0]->img!=""){
			$img_temp=config('app.url')."/$dir_up/".$query_dett[0]->img;
		}elseif($query_dett[0]->img && $query_dett[0]->img!="" && is_file("$dir_up/regate/press/".$query_dett[0]->img)){
			$img_temp=config('app.url')."/$dir_up/regate/press/".$query_dett[0]->img;
		}else{
			$temp=explode('src="',$query_dett[0]->testo);
			if(isset($temp[1])){
				$temp2=explode('"',$temp[1]);
				$img_temp=$temp2[0];
			}
			if($img_temp==""){
				$temp=explode('src="',$query_dett[0]->testo_eng);
				if(isset($temp[1])){
					$temp2=explode('"',$temp[1]);
					$img_temp=$temp2[0];									
				}
			}
		}
		if($img_temp!="") $img_fb=$img_temp;	
		$meta_titolo_fb = $titolo_fb;
		$descrizione_fb = substr(str_replace('"','\'',strip_tags($testo_fb)),0,500)."...";
	}
@endphp

<meta property="og:type" content="activity"/>
<meta property="og:url" content="<?php echo $ind_fb;?>"/>

<meta property="og:image" content="<?php echo $img_fb;?>"/>

<meta property="og:title" content="<?php echo $meta_titolo_fb;?>"/>
<meta property="og:site_name" content="<?php echo config('app.name');?>"/>
<meta property="fb:admins" content="<?php echo $user_fb;?>"/>
<meta property="og:description" content="<?php /*if($descrizione_fb && $descrizione_fb!="") echo strip_tags($descrizione_fb); else echo $meta_titolo_fb;*/?>"/>


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="<?php echo $img_fb;?>">
<meta name="twitter:title" content="<?php echo $meta_titolo_fb;?>">
<meta name="twitter:description" content="">