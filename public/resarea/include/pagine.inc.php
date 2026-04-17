<?php 
$table="la_storia";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";

if($conferma)
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
		
	$query_canc_img = "select img from gallery where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($foto) = $risu_canc_img->fetch();
		if (is_file("img_up/gallery/$foto")) @unlink("img_up/gallery/$foto");
		if (is_file("img_up/gallery/s_$foto")) @unlink("img_up/gallery/s_$foto");
	}
		
	$query_canc = "delete from gallery where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=gallery<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("gallery", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("gallery", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("gallery", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("gallery", "$id_canc");	
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("gallery", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=gallery<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
	
	if ($azione=="attiva") $query_agg = $open_connection->connection->query("update $table set visibile='1' where id='$id_canc'");
	if ($azione=="disattiva") $query_agg = $open_connection->connection->query("update $table set visibile='0' where id='$id_canc'");
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from gallery where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($logo) = $risu_canc_img->fetch();
			if (is_file("img_up/gallery/$logo")) @unlink("img_up/gallery/$logo");
			if (is_file("img_up/gallery/s_$logo")) @unlink("img_up/gallery/s_$logo");
		}
		
		$query_canc = "delete from gallery where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=gallery<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 	
}

?>
<script type="text/javascript">
	var lista_ind=new Array();
	var lista_del="";
	var lista_tutti="";
	function aggiungi_lista(id_check, id_campo){
		if(document.getElementById('check_'+id_check).checked){
			lista_del+=""+id_campo+";";
		} else {
			lista_del = lista_del.replace(id_campo+";", "");
		}
		if(lista_del!=""){
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
		}
	}
	
	function aggiugni_tutti(){
		start = document.getElementById('start').innerHTML;
		end = document.getElementById('end').innerHTML;
		total = document.getElementById('total').innerHTML;
		
		if(document.getElementById('check_tutti').checked){
			ind_lista = 0;
			ind_check = 1;
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[ind_lista]+";";
				ind_lista++;
			}
			for(i=start; i<=end; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=true;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			ind_check = 1;
			for(i=start; i<=total; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=false;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}
</script>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Pagine</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
			
			
	<div class="mws-panel-header" style="clear:both">
		<span><i class="icon-table"></i> IL CLUB</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="text-align:left;">Pagina</th>
					<th style="width:15%">Foto</th>
				</tr>
			</thead>
			<tbody>	
				<tr>
					<td align="left" valign="center">
						La Storia
					</td>
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='la-storia'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=la-storia" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>
				
				<tr>
					<td align="left" valign="center">
						Lo YCCS Oggi
					</td>
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='lo-yccs-oggi'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=lo-yccs-oggi" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>					
				</tr>	
				<?php /*
				<tr>
					<td align="left" valign="center">
						<a href="admin.php?cmd=pagine_mod&pagina=consiglio-direttivo" style="color:#2a2a2d">Consiglio Direttivo</a>
					</td>
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='consiglio-direttivo'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=consiglio_direttivo"><?php echo $num_foto;?></a>
					</td>						
				</tr>*/?>
			</tbody>
		</table>		
	</div>
	
	<div class="mws-panel-header" style="clear:both; margin-top:20px">
		<span><i class="icon-table"></i> YCCS PORTO CERVO</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="text-align:left;">Pagina</th>
					<th style="width:15%">Foto</th>
				</tr>
			</thead>
			<tbody>	
				<tr>
					<td align="left" valign="center">
						La Clubhouse
					</td>
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='la-clubhouse'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=la-clubhouse" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>
				<tr>
					<td align="left" valign="center">
						La Piazza Azzurra
					</td>
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='la-piazza-azzurra'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=la-piazza-azzurra" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>
				<tr>
					<td align="left" valign="center">
						Yccs Wellness Center
					</td>
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='yccs-wellness-center'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=yccs-wellness-center" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>
				<tr>
					<td align="left" valign="center">Scuola di Vela</td>
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='scuola_vela'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=scuola_vela" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>
				<tr>
					<td align="left" valign="center">Centro Sportivo</td>
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='centro_sportivo'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=centro_sportivo" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>
			</tbody>
		</table>		
	</div>
	
	<div class="mws-panel-header" style="clear:both; margin-top:20px">
		<span><i class="icon-table"></i> ONE OCEAN</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="text-align:left;">Pagina</th>
					<th style="width:15%">Foto</th>
				</tr>
			</thead>
			<tbody>					
				<tr>
					<td align="left" valign="center">
						One Ocean
					</td>					
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='one-ocean'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=one-ocean" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>					
				<tr>
					<td align="left" valign="center">
						YCCS e Sostenibilità
					</td>					
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='yccs_sostenibilita'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=yccs_sostenibilita" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>					
				<tr>
					<td align="left" valign="center">
						Charta Smeralda
					</td>					
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='charta_smeralda'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=charta_smeralda" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>					
				<tr>
					<td align="left" valign="center">
						YCCS Clean Beach Day
					</td>					
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='yccs_clean_beach_day'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=yccs_clean_beach_day" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>			
				<tr>
					<td align="left" valign="center">
						10 Eco-Consigli per i velisti
					</td>					
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='10_eco_consigli_per_i_velisti'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=10_eco_consigli_per_i_velisti" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>
			</tbody>
		</table>		
	</div>
	
	<div class="mws-panel-header" style="clear:both; margin-top:20px">
		<span><i class="icon-table"></i> AREA SOCI</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="text-align:left;">Pagina</th>
					<th style="width:15%">Foto</th>
				</tr>
			</thead>
			<tbody>					
				<tr>
					<td align="left" valign="center">
						La Boutique
					</td>					
					<td style="text-align:center;">
						<?php 
						$query_foto="SELECT id FROM fotogallery_pagine WHERE pagina='la-boutique'";
						$resu_foto=$open_connection->connection->query($query_foto);
						$num_foto=$resu_foto->rowCount();
						?>
						<a href="admin.php?cmd=fotogallery_pagine&pagina=la-boutique" class="btn btn-sm" style="color:#2a2a2d"><?php echo $num_foto;?></a>
					</td>						
				</tr>
			</tbody>
		</table>		
	</div>
	
	
</div>
