<li style="margin-top:20px; width:200px" <?php  if (!empty($blocco) && $blocco=="young_azzurra") { ?>class="active"<?php  } ?>>
	<a href="#">
		<div style="width:100%">
			<div style="float:left; width:35px; height:35px;">
				<img src="../web/images/ya_favicon/android-icon-36x36.png" style="width:30px"/>
			</div>
			<div style="float:left; margin-top:8px" class="scritte_menu">YOUNG AZZURRA</div>
			<div style="clear:both"></div>
		</div>
	</a>
	<ul class="scritte_menu">
		<?php /*<li><a href="admin.php?cmd=members_calendario">Calendario Sportivo</a></li>*/?>
		<li><a href="admin.php?cmd=ya_slide" <?php if(str_replace("ya_slide","",$cmd)!=$cmd){?>style="font-weight:bold"<?php }?>>Slide</a></li>
		<li><a href="admin.php?cmd=members_eventi" <?php if(str_replace("members_eventi","",$cmd)!=$cmd){?>style="font-weight:bold"<?php }?>>Eventi</a></li>
		<li><a href="admin.php?cmd=members_news" <?php if(str_replace("members_news","",$cmd)!=$cmd){?>style="font-weight:bold"<?php }?>>News</a></li>
		<li><a href="admin.php?cmd=ya_gallery_cat" <?php if(str_replace("ya_gallery_cat","",$cmd)!=$cmd){?>style="font-weight:bold"<?php }?>>Photogallery Categorie</a></li>
		<li><a href="admin.php?cmd=ya_gallery" <?php if(str_replace("ya_gallery","",$cmd)!=$cmd && str_replace("ya_gallery_cat","",$cmd)==$cmd){?>style="font-weight:bold"<?php }?>>Photogallery</a></li>
		<li><a href="admin.php?cmd=ya_video" <?php if(str_replace("ya_video","",$cmd)!=$cmd){?>style="font-weight:bold"<?php }?>>Video Gallery</a></li>
		<li><a href="admin.php?cmd=ya_team" <?php if(str_replace("ya_team","",$cmd)!=$cmd){?>style="font-weight:bold"<?php }?>>Atleti Young Azzurra</a></li>
		<li><a href="admin.php?cmd=ya_risultati" <?php if(str_replace("ya_risultati","",$cmd)!=$cmd){?>style="font-weight:bold"<?php }?>>Risultati</a></li>
		<li><a href="admin.php?cmd=ya_testo_home" <?php if(str_replace("ya_testo_home","",$cmd)!=$cmd){?>style="font-weight:bold"<?php }?>>Testo Home</a></li>
	</ul>
</li>