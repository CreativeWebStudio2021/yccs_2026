<li style="margin-top:20px; width:200px" <?php  if (!empty($blocco) && $blocco=="area_soci") { ?>class="active"<?php  } ?>>
	<a href="#" style="display:flex; align-items:center; margin-left:20px; gap:10px;">
		<i class="fa fa-user fa-2x"></i>
		<span class="scritte_menu">Area Soci</span>
	</a>
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=clienti">Iscritti</a></li>
		<li><a href="admin.php?cmd=comunicazioni_ai_soci">Comunicazioni</a></li>
		<li><a href="admin.php?cmd=statuto_mod">Statuto</a></li>
		<li><a href="admin.php?cmd=regolamento_interno_mod">Regolamento Interno</a></li>
	</ul>
</li>