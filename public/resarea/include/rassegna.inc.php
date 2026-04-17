<?php 
$table="rassegna";

$criterio="";
$rif="";

if(isset($_GET['anno_ric'])) $anno_ric=$_GET['anno_ric']; else $anno_ric='';
if($anno_ric!="") {
	$criterio=" and data like '%$anno_ric%'";
	$rif.="&anno_ric=$anno_ric";
}
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
//$rif.="&pag_att=$pag_att";

if($azione=="cancella" && $id_canc!="") {
	
	//$query_canc_img = "select foto from $table where id='$id_canc'";
	//$risu_canc_img = $open_connection->connection->query($query_canc_img);
	//if ($risu_canc_img) {
		//list($img) = $risu_canc_img->fetch();
		//if (is_file("img_up/$table/$img")) @unlink("img_up/$table/$img");
		//if (is_file("img_up/$table/s_$img")) @unlink("img_up/$table/s_$img");
	//}
	
	
	$query="SELECT file, file_eng FROM rassegna_doc where id_rassegna='$id_canc'";
	$resu=$open_connection->connection->query($query);
	while($risu=$resu->fetch()){
		if (is_file("files/$table/doc/".$risu['file'])) @unlink("files/$table/doc/".$risu['file']);
		if (is_file("files/$table/doc/".$risu['file_eng'])) @unlink("files/$table/doc/".$risu['file_eng']);
	}	
	$query_canc = "delete from rassegna_doc where id_rassegna='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
	
	$query="SELECT foto FROM rassegna_foto where id_rassegna='$id_canc'";
	$resu=$open_connection->connection->query($query);
	while($risu=$resu->fetch()){
		if (is_file("img_up/$table/foto/".$risu['file'])) @unlink("img_up/$table/foto/".$risu['file']);
		if (is_file("img_up/$table/foto/".$risu['file_eng'])) @unlink("img_up/$table/foto/".$risu['file_eng']);
	}	
	$query_canc = "delete from rassegna_foto where id_rassegna='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
	$query_canc = "delete from rassegna_video where id_rassegna='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
	
	/*if ($azione=="attiva") $query_agg = $open_connection->connection->query("update $table set visibile='1' where id='$id_canc'");
	if ($azione=="disattiva") $query_agg = $open_connection->connection->query("update $table set visibile='0' where id='$id_canc'");*/
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		//$query_canc_img = "select foto from $table where id='".$temp[$z]."'";
		//$risu_canc_img = $open_connection->connection->query($query_canc_img);
		//if ($risu_canc_img) {
			//list($img) = $risu_canc_img->fetch();
			//if (is_file("img_up/$table/$img")) @unlink("img_up/$table/$img");
			//if (is_file("img_up/$table/s_$img")) @unlink("img_up/$table/s_$img");
		//}
		
		$query="SELECT file, file_eng FROM rassegna_doc where id_rassegna='".$temp[$z]."'";
		$resu=$open_connection->connection->query($query);
		while($risu=$resu->fetch()){
			if (is_file("files/$table/doc/".$risu['file'])) @unlink("files/$table/doc/".$risu['file']);
			if (is_file("files/$table/doc/".$risu['file_eng'])) @unlink("files/$table/doc/".$risu['file_eng']);
		}	
		$query_canc = "delete from rassegna_doc where id_rassegna='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
		
		
		$query="SELECT foto FROM rassegna_foto where id_rassegna='".$temp[$z]."'";
		$resu=$open_connection->connection->query($query);
		while($risu=$resu->fetch()){
			if (is_file("img_up/$table/foto/".$risu['file'])) @unlink("img_up/$table/foto/".$risu['file']);
			if (is_file("img_up/$table/foto/".$risu['file_eng'])) @unlink("img_up/$table/foto/".$risu['file_eng']);
		}	
		$query_canc = "delete from rassegna_foto where id_rassegna='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
		
		$query_canc = "delete from rassegna_video where id_rassegna='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
	<div style="height:30px;font-size:1.2em;padding-top:10px"><b><?php echo ucfirst($table);?></b></div>
		
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div class="mws-panel-header" style="cursor:pointer;" onclick="apri_ricerca();" id="searchHeader">
		<span><i class="fa fa-search-plus" style="color:#fff"></i> Archivio</span>
	</div>
	<div class="mws-panel-body no-padding" id="searchPanel">
		<form name="ricerca" class="mws-form" action="admin.php" method="GET" enctype="multipart/form-data">
			<input type="hidden" name="cmd" value="<?php echo $table;?>">
			<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>">
			
			<div class="mws-form-inline">									
				<div class="mws-form-row">		
					<div style="float:left;width:20%">Anno</div>
					<div style="float:left;width:30%">
						<input type="text" name="anno_ric" value="<?php  echo $anno_ric; ?>" />
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Cerca" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="window.location='admin.php?cmd=rassegna'">
			</div>
		</form>
	</div>
			
	<div style="clear:both;height:20px">&nbsp;</div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi Conferenza Stampa</b>
			</div>
		</a>
	</div>

	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Conferenze</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<?php /*<th>Foto</th>*/?>
					<th>Data</th>
					<th style="text-align:left;">Titolo</th>
					<th>Documenti</th>
					<th>Foto</th>
					<th>Video</th>
					<th style="text-align:left;">Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY data desc";
				/*echo $query_ele;*/
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY data desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$titolo = ucfirst($arr_ele['titolo']);
						$foto = $arr_ele['foto'];	
						$id_campo = $arr_ele['id'];	
						$data = $arr_ele['data'];						
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>
					<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
					<?php /*<td align="center" valign="center"><?php  if ($foto!="" && is_file("img_up/$table/$foto")) { ?><img src="img_up/<?php echo $table;?>/<?php  echo $foto; ?>" alt="" style="width:150px"/><?php  } ?></td>*/?>
					<td align="center">
						<?php echo date_to_data($data);?>
					</td>
					<td>
						<?php  echo $titolo; ?>
					</td>
					
					<td align="center">
						<?php 
						$query_comm="SELECT id FROM rassegna_doc WHERE id_rassegna='$id_campo'";
						$resu_comm=$open_connection->connection->query($query_comm);
						$num_comm=$resu_comm->rowCount();
						?>
						<span style="color:#000; cursor:pointer;">
							<a href="admin.php?cmd=rassegna_doc&id_rife=<?php echo $id_campo;?>&pag_att=<?php echo $pag_att;?>" style="color:#111" class="btn btn-sm">	
								<?php echo $num_comm;?>
							</a>
						</span>
					</td>
					<td align="center">
						<?php 
						$query_comm="SELECT id FROM rassegna_foto WHERE id_rassegna='$id_campo'";
						$resu_comm=$open_connection->connection->query($query_comm);
						$num_comm=$resu_comm->rowCount();
						?>
						<span style="color:#000; cursor:pointer;">
							<a href="admin.php?cmd=rassegna_foto&id_rife=<?php echo $id_campo;?>&pag_att=<?php echo $pag_att;?>" style="color:#111" class="btn btn-sm">
								<?php echo $num_comm;?>
							</a>
						</span>
					</td>
					<td align="center">
						<?php 
						$query_comm="SELECT id FROM rassegna_video WHERE id_rassegna='$id_campo'";
						$resu_comm=$open_connection->connection->query($query_comm);
						$num_comm=$resu_comm->rowCount();
						?>
						<span style="color:#000; cursor:pointer;">
							<a href="admin.php?cmd=rassegna_video&id_rife=<?php echo $id_campo;?>&pag_att=<?php echo $pag_att;?>" style="color:#111" class="btn btn-sm">
								<?php echo $num_comm;?>
							</a>
						</span>
					</td>
					<td style="width:10%">
						<span class="btn-group">
							<?php /*<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
								<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
								<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="<?php echo $table;?>"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
									</form>
								</div>
							</div>*/?>
							<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onclick="return confirm('Cancellare l\'elemento?')" href="admin.php?cmd=<?php echo $table;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
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
		<a href="" onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>

<div style="position:fixed; width:780px; height:500px; background:#fff; top:50%; left:50%; display:none; border:solid 1px #808080; border-radius:2px; text-align:center;  margin-left:-390px; margin-top:-200px; z-index:0000000; box-shadow:5px 5px 5px #808080" id="box_link">
	<iframe src="" style="width:780px; height:500px; margin-top:5px;" id="frame_link" frameborder=0 ></iframe>
	<div style="position:absolute; top:15px; right:25px; width:20px; height:20px; cursor:pointer; text-align:center;" onclick="document.getElementById('box_link').style.display='none'; window.location='<?php echo $_SERVER['REQUEST_URI'];?>';">
		<i class="fa fa-times-circle fa-2x"></i>		
	</div>
</div>
