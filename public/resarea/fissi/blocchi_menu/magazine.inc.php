<li style="margin-top:20px; width:200px" <?php  if (!empty($blocco) && $blocco=="magazine") { ?>class="active"<?php  } ?>>
	<a href="#" style="display:flex; align-items:center; margin-left:20px; gap:10px;">
		<i class="fa fa-newspaper-o fa-2x"></i>
		<span class="scritte_menu"> Magazine</span>
	</a>
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=magazine_macrocategorie">Argomenti</a></li>
		<li><a href="admin.php?cmd=magazine_categorie">Categorie</a></li>
		<li><a href="admin.php?cmd=magazine_articolo">Articoli</a></li>
	</ul>
</li>