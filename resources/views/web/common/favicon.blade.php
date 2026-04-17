@php
	$current_url = URL::current();
@endphp
<?php if($cmd=="new"){
	if($value_ed->logo_edizione){
		if(is_file("resarea/img_up/regate/".$value_ed->logo_edizione)){?>
			<link rel="shortcut icon" href="resarea/img_up/regate/<?php if(is_file("resarea/img_up/regate/xs_".$value_ed->logo_edizione)){?>xs_<?php }?><?php echo $value_ed->logo_edizione;?>">
		<?php }else{?>
			<link rel="shortcut icon" href="web/images/favicon.png">			
		<?php }
	}else{
		$query_r = DB::table('regate')
			->select('logo')
			->where('id',$value_ed->id_regata)
			->get();
		$lg = $query_r[0]->logo;
		if(is_file("resarea/img_up/regate/".$lg)){?>
			<link rel="shortcut icon" href="resarea/img_up/regate/<?php if(is_file("resarea/img_up/regate/xs_".$lg)){?>xs_<?php }?><?php echo $lg;?>">
		<?php }else{?>
			<link rel="shortcut icon" href="web/images/favicon.png">			
		<?php }
	}?>
<?php }elseif(str_replace("yccs-sailing-school","",$current_url)!=$current_url){?>
	  <link rel="shortcut icon" href="web/images/favicon/favicon-yccs-sailing-school.ico" type="image/x-icon" />
	  <link rel="apple-touch-icon" href="web/images/favicon/apple-touch-icon.png" />
	  <link rel="apple-touch-icon" sizes="57x57" href="web/images/favicon/apple-touch-icon-57x57.png" />
	  <link rel="apple-touch-icon" sizes="72x72" href="web/images/favicon/apple-touch-icon-72x72.png" />
	  <link rel="apple-touch-icon" sizes="76x76" href="web/images/favicon/apple-touch-icon-76x76.png" />
	  <link rel="apple-touch-icon" sizes="114x114" href="web/images/favicon/apple-touch-icon-114x114.png" />
	  <link rel="apple-touch-icon" sizes="120x120" href="web/images/favicon/apple-touch-icon-120x120.png" />
	  <link rel="apple-touch-icon" sizes="144x144" href="web/images/favicon/apple-touch-icon-144x144.png" />
	  <link rel="apple-touch-icon" sizes="152x152" href="web/images/favicon/apple-touch-icon-152x152.png" />
	  <link rel="apple-touch-icon" sizes="180x180" href="web/images/favicon/apple-touch-icon-180x180.png" />
<?php }elseif(str_replace("azzurra/","",$current_url)!=$current_url && str_replace("la-piazza-azzurra","",$current_url)==$current_url){?>
		<link rel="apple-touch-icon" sizes="57x57" href="web/images/ya_favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="web/images/ya_favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="web/images/ya_favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="web/images/ya_favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="web/images/ya_favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="web/images/ya_favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="web/images/ya_favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="web/images/ya_favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="web/images/ya_favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="web/images/ya_favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="web/images/ya_favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="web/images/ya_favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="web/images/ya_favicon/favicon-16x16.png">
		<?php /*<link rel="manifest" href="ya_favicon/manifest.json">*/?>
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="web/images/ya_favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
<?php }else{?>
	
	  <link rel="shortcut icon" href="web/images/favicon-yccs/favicon.ico" type="image/x-icon" />
	  <link rel="apple-touch-icon" href="web/images/favicon-yccs/apple-touch-icon.png" />
	  <link rel="apple-touch-icon" sizes="57x57" href="web/images/favicon-yccs/apple-touch-icon-57x57.png" />
	  <link rel="apple-touch-icon" sizes="72x72" href="web/images/favicon-yccs/apple-touch-icon-72x72.png" />
	  <link rel="apple-touch-icon" sizes="76x76" href="web/images/favicon-yccs/apple-touch-icon-76x76.png" />
	  <link rel="apple-touch-icon" sizes="114x114" href="web/images/favicon-yccs/apple-touch-icon-114x114.png" />
	  <link rel="apple-touch-icon" sizes="120x120" href="web/images/favicon-yccs/apple-touch-icon-120x120.png" />
	  <link rel="apple-touch-icon" sizes="144x144" href="web/images/favicon-yccs/apple-touch-icon-144x144.png" />
	  <link rel="apple-touch-icon" sizes="152x152" href="web/images/favicon-yccs/apple-touch-icon-152x152.png" />
	  <link rel="apple-touch-icon" sizes="180x180" href="web/images/favicon-yccs/apple-touch-icon-180x180.png" />
<?php }?>
