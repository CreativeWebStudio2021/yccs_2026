<?php 
$table="comunicati_home";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";

$rif="";

if($azione=="canc" && $id_canc!="")
{	
	
	$query_canc_img = "select allegato, allegato_eng from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($allegato, $allegato_eng) = $risu_canc_img->fetch();
		if (is_file("files/$allegato")) @unlink("files/$allegato");
		if (is_file("files/$allegato_eng")) @unlink("files/$allegato_eng");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 
if($azione=="visibile") {
	$query_up="UPDATE $table SET visibile='1' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script type="text/javascript">
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
	</script>
	<?php 
}
if($azione=="non_visibile") {
	$query_up="UPDATE $table SET visibile='0' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script type="text/javascript">
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
	</script>
	<?php 
}

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc");
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($logo) = $risu_canc_img->fetch();
			if (is_file("img_up/$logo")) @unlink("img_up/$logo");
			if (is_file("img_up/s_$logo")) @unlink("img_up/s_$logo");
		}
		
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Comunicati Home</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" style="color:#7a7a7a">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi Comunicati Home</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Comunicati Home</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th>Regata/Edizione</th>
					<th>Titolo</th>
					<th>Tipo</th>
					<th>Link</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from $table order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{		
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table ORDER BY ordine DESC LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$tipo = $arr_ele['tipo'];
						$tit = $oggetto_admin->puntini(ucfirst($arr_ele['testo']));
						$tit_eng = $oggetto_admin->puntini(ucfirst($arr_ele['testo_eng']));
						$tit_gruppo = $oggetto_admin->puntini(ucfirst($arr_ele['testo_gruppo']));
						$tit_gruppo_eng = $oggetto_admin->puntini(ucfirst($arr_ele['testo_gruppo_eng']));
						$id_campo = $arr_ele['id'];
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
					<td>
						<?php 
						$query_reg="SELECT nome FROM regate WHERE id='".$arr_ele['id_regata']."'";
						$resu_reg=$open_connection->connection->query($query_reg);
						list($nome_reg)=$resu_reg->fetch();
						
						$query_ed="SELECT anno FROM edizioni_regate WHERE id_regata='".$arr_ele['id_regata']."' AND id='".$arr_ele['id_edizione']."'";
						$resu_ed=$open_connection->connection->query($query_ed);
						list($anno_ed)=$resu_ed->fetch();
						
						if($nome_reg && $nome_reg!="") echo $nome_reg." - ".$anno_ed;
						?>
					</td>
					<td align="left">
						<?php if($arr_ele['tipo']=="gruppo_link"){?>
							<?php if($arr_ele['testo_gruppo'] && $arr_ele['testo_gruppo']!=""){?><img src="https://www.yccs.it/web/images/it.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $tit_gruppo; ?><br/><?php }?>
							<?php if($arr_ele['testo_gruppo_eng'] && $arr_ele['testo_gruppo_eng']!=""){?><img src="https://www.yccs.it/web/images/en.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $tit_gruppo_eng; ?><?php }?>
						<?php }else{?>
							<?php if($arr_ele['testo'] && $arr_ele['testo']!=""){?><img src="https://www.yccs.it/web/images/it.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $tit; ?><br/><?php }?>
							<?php if($arr_ele['testo_eng'] && $arr_ele['testo_eng']!=""){?><img src="https://www.yccs.it/web/images/en.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $tit_eng; ?><?php }?>
						<?php }?>
					</td>
					<td align="center">
						<?php  echo $tipo; ?>
					</td>
					<td align="center">
						<?php if($arr_ele['tipo']=="gruppo_link"){
							$query_comm="SELECT id FROM comunicati_home_link WHERE id_rife='$id_campo'";
							$resu_comm=$open_connection->connection->query($query_comm);
							$num_comm=$resu_comm->rowCount();
							?>
							<span  class="btn btn-sm" style="color:#2a2a2d" onclick="vedi_link('<?php echo $id_campo;?>')"><?php echo $num_comm;?></span>
						<?php }?>
					</td>
					<td style="width:10%">
						<span class="btn-group" style="display:flex; align-items:center">
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=<?php if($arr_ele['visibile']==1){?>non_<?php }?>visibile<?php echo $rif;?>" class="btn btn-small"><?php if($arr_ele['visibile']==1){?><i style="color:green" class="fa fa-circle"></i><?php }else{?><i style="color:red" class="fa fa-circle-o"></i><?php }?></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<a class="btn btn-small" style="width:36px; height:24px; padding:0; margin:0; border-left:0; border-right:0">
								
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="<?php echo $table;?>"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:100%; height:100%; margin-top:-2px; border:0; text-align:center; background:none"/>
									</form>
								
							</a>
							<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&azione=canc&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small" onclick="return confirm('Si vuole procedere alla cancellazione dell\'elemento?')"><i class="icon-trash"></i></a>
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

<div class="popup" id="box_link">
	<iframe src="" style="width:100%; height:100%;" id="frame_link" frameborder=0 ></iframe>
	<div style="position:absolute; top:15px; right:25px; width:20px; height:20px; cursor:pointer; text-align:center;" onclick="document.getElementById('box_link').style.display='none'; window.location='<?php echo $_SERVER['REQUEST_URI'];?>';">
		<i class="fa fa-times-circle fa-2x"></i>		
	</div>
</div>

<script type="text/javascript">
	function vedi_link(id_comm){
		$("#box_link").fadeIn();
		document.getElementById('frame_link').src="frame/link_comunicati.php?id_comm="+id_comm;	
	}
</script>
