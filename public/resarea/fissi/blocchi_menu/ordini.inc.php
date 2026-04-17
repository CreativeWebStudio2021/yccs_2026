<li style="margin-top:20px; width:200px" <?php  if (!empty($blocco) && $blocco=="ordini") { ?>class="active"<?php  } ?>>
	<a href="#" style="display:flex; align-items:center; margin-left:20px; gap:10px;">
		<i class="fa fa-money fa-2x" aria-hidden="true"></i>
		<span class="scritte_menu">Ordini</span>
	</a>
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=ordini&stato_ric=aperti">Ordini Aperti</a></li>
		<li><a href="admin.php?cmd=ordini&stato_ric=evasi">Ordini Evasi</a></li>
		<li><a href="admin.php?cmd=ordini&stato_ric=annullati">Ordini Annullati</a></li>
	</ul>
</li>