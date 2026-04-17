<?php 
$table="valori_taglia";

$criterio="";
$riferimenti="";
$rif="";

if(isset($_GET['id_tipo'])) $id_tipo=$_GET['id_tipo']; else $id_tipo='';
if($id_tipo!="") {
	$criterio=" AND id_tipo='$id_tipo'";
	$rif.="&id_tipo=$id_tipo";
}
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

if($azione=="cancella")
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	/*
	$query_canc_img = "select img from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/$img")) @unlink("img_up/$img");
	}*/
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc", "id_tipo", "$id_tipo") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc", "id_tipo", "$id_tipo") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc", "id_tipo", "$id_tipo") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc", "id_tipo", "$id_tipo") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos", "id_tipo", "$id_tipo") ;	
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		</script>
	<?php }
	
	if ($azione=="attiva") $query_agg = $open_connection->connection->query("update $table set visibile='1' where id='$id_canc'");
	if ($azione=="disattiva") $query_agg = $open_connection->connection->query("update $table set visibile='0' where id='$id_canc'");
	
	if ($azione=="scarica") {
		include("include/scarica_prodotti.inc.php");
		scarica_prodotti($id_riferimento,$id_canc);
	}
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		/*$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/$img")) @unlink("img_up/$img");
		}*/
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?>&azione=cancella_sel&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
		}
	}
	
	function aggiugni_tutti(){
		start = document.getElementById('start').innerHTML;
		end = document.getElementById('end').innerHTML;
		total = document.getElementById('total').innerHTML;

		if(document.getElementById('check_tutti').checked){
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[i]+";";
			}
			for(i=start; i<=end; i++){
				document.getElementById('check_'+i).checked=true;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			for(i=start; i<=total; i++){
				document.getElementById('check_'+i).checked=false;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}
</script>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Valori Taglia</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div class="mws-form-item">
		<select name="id_tipo" class="small" onchange="window.location='admin.php?cmd=valori_taglia&id_tipo='+this.value">
			<option value="">Seleziona Tipo Taglia</option>
			<?php 
			$query_cat="SELECT * FROM tipo_taglia ORDER BY nome ASC";
			$resu_cat=$open_connection->connection->query($query_cat);
			while($risu_cat=$resu_cat->fetch()){?>
				<option value="<?php echo $risu_cat['id'];?>" <?php if($id_tipo==$risu_cat['id']){?>selected="selected"<?php }?>><?php echo $risu_cat['nome'];?></option>
			<?php }?>					
		</select>
	</div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi Valori Taglia</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco <?php echo $table;?></span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<?php /*<th style="width:50px;"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>*/?>
					<th style="width:50px;"></th>
					<th style="text-align:left">Nome</th>
					<th style="text-align:left">Tipo Taglia</th>
					<th style="text-align:left">Valore</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY id_tipo ASC, ordine DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY ordine DESC LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$valore = $arr_ele['valore'];
						$id_cat = $arr_ele['id_tipo'];
						$id_campo = $arr_ele['id'];
						
						$query_cat="SELECT nome FROM tipo_taglia WHERE id='$id_cat'";
						$resu_cat=$open_connection->connection->query($query_cat);
						list($tipo)=$resu_cat->fetch();
						
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<?php /*<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>*/?>
					<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
					<td>
						<?php  echo $arr_ele['valore']; ?><br/>
					</td>
					<td><?php  echo $tipo; ?></td>
					<td style="width:10%">
						<span class="btn-group">
							<?php if($id_tipo!=""){?>
								<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
								<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
								<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
								<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
								<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
									<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
									<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
										<form action="admin.php" method="GET">
											<input type="hidden" name="cmd" value="<?php echo $table;?>"/>
											<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
											<input type="hidden" name="azione" value="cambia"/>
											<input type="hidden" name="id_tipo" value="<?php echo $id_tipo;?>"/>
											<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
											<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
										</form>
									</div>
								</div>
							<?php }?>
							<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onclick="return confirm('cancellare l\'elemento?');" href="admin.php?cmd=<?php echo $table;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>
		
		<?php include("fissi/multipagina.inc.php");?>
		
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
