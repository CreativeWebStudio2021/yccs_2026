<li style="margin-top:20px; width:200px" <?php  if (!empty($blocco) && $blocco=="sail_talk") { ?>class="active"<?php  } ?>>
	<a href="#" style="display:flex; align-items:center; margin-left:15px; gap:10px;">
		<i class="fa fa-comments-o fa-2x" aria-hidden="true"></i>
		<span class="scritte_menu">Sail Talk</span>
	</a>
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=sail_talk_macrocategorie">Argomenti</a></li>
		<li><a href="admin.php?cmd=sail_talk_categorie">Categorie</a></li>
		<li><a href="admin.php?cmd=sail_talk_articolo">Articoli</a></li>
	</ul>
</li>