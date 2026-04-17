<li style="margin-top:20px; width:200px" <?php  if (!empty($blocco) && $blocco=="negozio") { ?>class="active"<?php  } ?>>
	<a href="#" style="display:flex; align-items:center; margin-left:20px; gap:10px;">
		<i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
		<span class="scritte_menu"> Negozio</span>
	</a>
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=categorie">Categorie</a></li>
		<li><a href="admin.php?cmd=sottocategorie">Sottocategorie</a></li>
		<li><a href="admin.php?cmd=tipo_taglia">Tipo Taglia</a></li>
		<li><a href="admin.php?cmd=valori_taglia">Valori Taglia</a></li>
		<li><a href="admin.php?cmd=colori">Colori</a></li>
		<li><a href="admin.php?cmd=prodotti">Prodotti</a></li>
	</ul>
</li>