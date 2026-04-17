<?php 
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";

$rif="";
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Pagine Azzurra</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
			
			
	<div class="mws-panel-header" style="clear:both">
		<span><i class="icon-table"></i> Lista Pagine</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="text-align:left; width:150px;">Immagine</th>
					<th style="text-align:left;">Pagina</th>
					<th style="width:15%">Slides</th>
					<th style="width:15%">Fotogallery</th>
					<th style="width:30px">Azioni</th>
				</tr>
			</thead>
			<tbody>	
				<?php 
				$query_pag="SELECT titolo, id, foto FROM azzurra_pagine ORDER BY id ASC";
				$resu_pag=$open_connection->connection->query($query_pag);
				while($risu_pag=$resu_pag->fetch()){
					$id_pag = $risu_pag['id'];
					$titolo_pag = $risu_pag['titolo'];
					$foto_pag = $risu_pag['foto'];
					
					if(file_exists("img_up/images/s_$foto_pag")) $ante = "img_up/gallery/s_$foto_pag";
					elseif(file_exists("img_up/images/$foto_pag")) $ante = "img_up/images/$foto_pag";
					else $ante = "https://www.yccs.it/resarea/img_up/images/$foto_pag";
				?>
					<tr>
						<td align="center" valign="center">
							<?php  if ($foto_pag && $foto_pag!="") { ?>
								<img src="<?php  echo $ante; ?>" style="width:150px"/>
							<?php }?>
						</td>
						<td align="left" valign="center">
							<?php echo $titolo_pag;?>
						</td>
						<td style="text-align:center;">
							<?php 
							$query_foto="SELECT id FROM azzurra_pagine_slide WHERE id_rife='".$id_pag."'";
							$resu_foto=$open_connection->connection->query($query_foto);
							$num_foto=$resu_foto->rowCount();
							?>
							<span class="btn-group">
								<a href="admin.php?cmd=azzurra_pagine_slide&pagina=<?php echo $id_pag;?>" class="btn btn-small" style="color:#2a2a2d"><?php echo $num_foto;?></a>
							</span>
						</td>
						<td style="text-align:center;">
							<?php 
							$query_foto="SELECT id FROM azzurra_pagine_gallery WHERE id_rife='".$id_pag."'";
							$resu_foto=$open_connection->connection->query($query_foto);
							$num_foto=$resu_foto->rowCount();
							?>
							<span class="btn-group">
								<a href="admin.php?cmd=azzurra_pagine_fotogallery&pagina=<?php echo $id_pag;?>" class="btn btn-small" style="color:#2a2a2d"><?php echo $num_foto;?></a>
							</span>
						</td>						
						<td>
							<span class="btn-group">
								<a href="admin.php?cmd=azzurra_pagine_mod&pagina=<?php echo $id_pag;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							</span>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>		
	</div>
</div>
