<?php 

$table="fotogallery_pagine";
$rif="";

if(isset($_GET['pagina'])) $pagina=$_GET['pagina']; else $pagina='';
if($pagina!="") $rif="&pagina=$pagina";

if($pagina=="la-storia") $titolo_pagina="Il Club - La Storia";
if($pagina=="yccs_oggi") $titolo_pagina="Il Club - Lo YCCS Oggi";
if($pagina=="consiglio_direttivo") $titolo_pagina="Il Club - Consiglio Direttivo";
if($pagina=="clubhouse") $titolo_pagina="YCCS Porto Cervo - La Clubhouse";
if($pagina=="scuola_vela") $titolo_pagina="YCCS Porto Cervo - Scuola di Vela";
if($pagina=="centro_sportivo") $titolo_pagina="YCCS Porto Cervo - Centro Sportivo";
if($pagina=="clubhouse_vg") $titolo_pagina="YCCS Virgin Gorda - La Clubhouse";

	
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if($conferma)
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
		
	$query_canc_img = "select foto from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($foto) = $risu_canc_img->fetch();
		if (is_file("../$foto")) @unlink("../$foto");
		if (is_file("img_up/regate/foto/s_$foto")) @unlink("img_up/regate/foto/s_$foto");
	}
		
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=fotogallery_pagine<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc", "pagina" , "$pagina") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc", "pagina" , "$pagina") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc", "pagina" , "$pagina");
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc", "pagina" , "$pagina");	
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos", "pagina" , "$pagina");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=fotogallery_pagine<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select foto from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($foto) = $risu_canc_img->fetch();
			if (is_file("img_up/pagine/$foto")) @unlink("img_up/pagine/$foto");
			if (is_file("img_up/pagine/s_$foto")) @unlink("img_up/pagine/s_$foto");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=fotogallery_pagine<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 	
}

if($azione=="cancella" && $id_canc!="") {
	$query_canc_img = "select foto from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($foto) = $risu_canc_img->fetch();
		if (is_file("img_up/pagine/$foto")) @unlink("img_up/pagine/$foto");
		if (is_file("img_up/pagine/s_$foto")) @unlink("img_up/pagine/s_$foto");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	?>
		<script type="text/javascript">
			window.location='admin.php?cmd=fotogallery_pagine<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 	
}

if($azione=="modifica_testo" && $id_canc!="") {
	if(isset($_GET['testo_foto'])) $testo_foto=$_GET['testo_foto'];
	$testo_foto=str_replace('"','\"',$testo_foto);
	$query_up="UPDATE fotogallery_pagine SET testo='$testo_foto' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
}
if($azione=="cancella_testo" && $id_canc!="") {
	$query_up="UPDATE fotogallery_pagine SET testo=NULL WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
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
			document.getElementById('cancella_sel').href='admin.php?cmd=fotogallery_pagine<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=fotogallery_pagine<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px">Foto della pagina <b><?php  echo $titolo_pagina; ?></b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=pagine" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle pagine</b>
			</div>
		</a>
		<a href="admin.php?cmd=fotogallery_pagine_ins&pagina=<?php echo $pagina;?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" style="color:#7a7a7a">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi foto</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header" style="clear:both">
		<span><i class="icon-table"></i> Elenco foto</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th>Foto</th>
					<th style="width:50%">Testo</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from $table where pagina='$pagina' order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "select * from $table where pagina='$pagina' order by ordine desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$foto = $arr_ele['foto'];
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>
					<td align="center" valign="center">
						<?php  echo $start+$x+1; ?>
					</td>
					<td align="center" valign="center"><?php  if ($arr_ele['foto']!="") { ?><img src="img_up/pagine/<?php  echo $foto; ?>" style="width:150px"/><?php  } ?></td>
					<td align="left" valign="center">
						<form name="cambia_testo_<?php echo $id_campo;?>" action="admin.php" method="GET">
							<input type="hidden" name="cmd" value="<?php echo $table;?>"/>
							<input type="hidden" name="pagina" value="<?php echo $pagina;?>"/>
							<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
							<input type="hidden" name="azione" value="modifica_testo"/>
							<input type="hidden" name="id_canc" value="<?php echo $id_campo;?>"/>
							<input type="text" name="testo_foto" value="<?php echo $arr_ele['testo'];?>" style="width:90%"/>
							<i class="fa fa-pencil-square-o" style="cursor:pointer;" onclick="document.cambia_testo_<?php echo $id_campo;?>.submit();"></i>
							<a href="admin.php?cmd=<?php echo $table;?>&azione=cancella_testo&id_canc=<?php echo $id_campo;?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" style="color:#333333"><i class="fa fa-eraser"></i></a>
						</form>
					</td>
					<td style="width:10%" align="center" valign="center">
						<span class="btn-group">
							<a href="admin.php?cmd=fotogallery_pagine&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=fotogallery_pagine&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=fotogallery_pagine&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=fotogallery_pagine&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
								<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
								<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="fotogallery_pagine"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="pagina" value="<?php  echo $pagina; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
									</form>
								</div>
							</div>
							<!--<a href="admin.php?cmd=gallery_mod&id_rec=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>-->
							<a onclick="return confirm('Si vuole procedere alla cancellazione dell\'elemento?');" href="admin.php?cmd=fotogallery_pagine&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>
		<?php  include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
