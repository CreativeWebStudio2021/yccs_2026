<li style="margin-top:20px; width:200px" <?php  if (!empty($blocco) && $blocco=="stampa") { ?>class="active"<?php  } ?>>
	<a href="admin.php?cmd=stampa" onclick="window.location='admin.php?cmd=stampa'" style="display:flex; align-items:center; margin-left:20px; gap:10px;">
		<i class="fa fa-archive fa-2x" aria-hidden="true"></i>
		<span class="scritte_menu"> Ufficio Stampa</span>
	</a>
	
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=rassegna">Conferenze Stampa</a></li>
		<li><a href="admin.php?cmd=stampa">Rassegna Stampa</a></li>
	</ul>
</li>