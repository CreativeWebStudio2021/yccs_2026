<!-- TESTATA -->
<div style="position:relative; ">
	<?php if(!empty($img_testata)){?>
		<?php 
		$foto = "resarea/img_up/regate/".$img_testata;
		if(file_exists("resarea/img_up/regate/".$img_testata)) 
			$ante = $foto;
		else
			$ante = "https://www.yccs.it/resarea/img_up/regate/".$img_testata;
		$foto_1920 = $ante;
		$foto_1200 = $ante;
		$foto_800 = $ante;
		$foto_400 = $ante;
		
		if(is_file("resarea/img_up/regate/1200_".$img_testata)) $foto_1200 = "resarea/img_up/regate/1200_".$img_testata;
		if(is_file("resarea/img_up/regate/800_".$img_testata)) $foto_800 = "resarea/img_up/regate/800_".$img_testata;
		if(is_file("resarea/img_up/regate/400_".$img_testata)) $foto_400 = "resarea/img_up/regate/400_".$img_testata;
		
		?>
		<picture>
			<source srcset="<?php echo $foto_400;?>" media="(max-width: 400px)" />
			<source srcset="<?php echo $foto_800;?>" media="(max-width: 800px)" />
			<source srcset="<?php echo $foto_1200;?>" media="(max-width: 1200px)" />
			<img src="<?php echo $ante;?>" style="width:100%;" alt="<?php echo $titolo_regata;?>"/>
		</picture>
	<?php }else{?>
		<img src="https://www.yccs.it/web/images/new/TESTATA_REGATA_NEW.jpg" alt="" style="width:100%;"/>		
	<?php }?>
	
	<div style="position:absolute; width:80%; top:2vw; left:10%; margin:0 auto; text-align:center; color:#fff;" id="regattaTitle">
		<h1 style="margin:0; padding:0; border:0; color:#fff; line-height:50px; <?php /*font-family: 'Tinos', serif;*/?> font-size:4em; line-height:1em; text-shadow:2px 2px 5px #000"><?php echo strtoupper($nome_regata);?></h1>
		<div style="margin-top:10px;text-shadow:2px 2px 5px #000" id="regattaSubTitle">
			<?php echo ucfirst($luogo);?>
			&nbsp;|&nbsp;
			<?php if($data_dal!=$data_al && $data_al!="0000-00-00"){?>
				dal <?php echo substr(date_to_data($data_dal,"/"),0,5);?> <?php if($data_al && $data_al!=""){?> al <?php echo substr(date_to_data($data_al,"/"),0,5);?><?php }?> 
			<?php }else{?>
				<?php echo date_to_data($data_dal,"/");?>
			<?php }?>
		</div>
		
		<div class="breadcrumb" style=" width:100%; text-align:center !important; text-shadow:2px 2px 5px #000">
			<a href="home.html" style="color:#fff"><i class="fa fa-home"></i></a>
			&nbsp;>&nbsp;
			<a href="regate-{{date('Y')}}.html" style="color:#fff"><?php if($lingua=="ita"){?>Le Regate<?php }else{?>Regattas<?php }?></a>
			&nbsp;>&nbsp;
			<a href="regate-<?php if($anno_regata=="") echo date("Y"); else echo $anno_regata;?>.html" style="color:#fff"><?php if($lingua=="ita"){?>Regate<?php }else{?>Regattas<?php }?> <?php if($anno_regata=="") echo "2018"; else echo $anno_regata;?></a>
		</div>
	</div>
	<script>
		var h = $("#regattaTitle").height();
		$("#regattaTitle").css({"top":"50%", "margin-top":"-"+(h/2)+"px"})
	</script>
</div>
<!-- FINE TESTATA -->