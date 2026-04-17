<li style="margin-top:20px; width:200px" <?php  if (!empty($blocco) && $blocco=="home") { ?>class="active"<?php  } ?>>
	<a href="#" style="display:flex; align-items:center; margin-left:20px; gap:10px;">
		<i class="fa fa-home fa-2x" aria-hidden="true"></i>
		<span class="scritte_menu">Home</span>
	</a>
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=slide" <?php if($cmd=="slide"){?>style="font-weight:bold"<?php }?>>Slide</a></li>
		<li><a href="admin.php?cmd=gallery" <?php if($cmd=="gallery"){?>style="font-weight:bold"<?php }?>>Fotogallery</a></li>
		<li><a href="admin.php?cmd=instagram" <?php if($cmd=="instagram"){?>style="font-weight:bold"<?php }?>>Instagram Feed</a></li>
	</ul>
</li>