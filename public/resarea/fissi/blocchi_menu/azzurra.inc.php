<li style="margin-top:20px; width:200px" <?php  if (str_replace("azzurra_pagine","",$cmd)!=$cmd) { ?>class="active"<?php  } ?>>
	<a href="#">
		<div style="width:100%">
			<div style="float:left; width:35px; height:35px;">
				<img src="../web/images/ya_favicon/android-icon-36x36.png" style="width:30px"/>
			</div>
			<div class="scritte_menu" style="float:left; margin-top:8px">AZZURRA</div>
			<div style="clear:both"></div>
		</div>
	</a>
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=azzurra_40_pagina_mod">AZZURRA 40°</a></li>
		<li><a href="admin.php?cmd=azzurra_40_pagina_mod" style="line-height:5px;">&nbsp;&nbsp;&nbsp;&nbsp;- Pagina</a></li>
		<li><a href="admin.php?cmd=azzurra_40_video" style="line-height:5px;">&nbsp;&nbsp;&nbsp;&nbsp;- Video</a></li>
		<?php $query_pag = "SELECT id, titolo FROM azzurra_pagine ORDER BY id ASC";
		$resu_pag = $open_connection->connection->query($query_pag);
		while($risu_pag=$resu_pag->fetch()){?>
			<li><a href="admin.php?cmd=azzurra_pagine_mod&pagina=<?php echo $risu_pag['id'];?>"><?php echo $risu_pag['titolo'];?></a></li>
			<li><a href="admin.php?cmd=azzurra_pagine_slide&pagina=<?php echo $risu_pag['id'];?>" style="line-height:5px;">&nbsp;&nbsp;&nbsp;&nbsp;- Slide</a></li>
			<li><a href="admin.php?cmd=azzurra_pagine_fotogallery&pagina=<?php echo $risu_pag['id'];?>" style="line-height:5px;">&nbsp;&nbsp;&nbsp;&nbsp;- Foto</a></li>
		<?php }?>
		<li><a href="admin.php?cmd=azzurra_pagine">Tutte Le pagine</a></li>
	</ul>
</li>