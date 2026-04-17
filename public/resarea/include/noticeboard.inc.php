<?php 
$table="edizioni_noticeboard";
$pagina="noticeboard";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";

if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if($id_riferimento!="") $rif.="&id_riferimento=$id_riferimento";

if($id_rife==""){
	$query_canc = "SELECT id_regata FROM edizioni_regate where id='$id_riferimento'";
	$risu_canc = $open_connection->connection->query($query_canc);
	list($id_rife) = $risu_canc->fetch();
}
	
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if($azione=="cancella" && $id_canc!="")
{	
	$query_canc_doc = "select file,file_eng from edizioni_noticeboard where id='$id_canc'";
	$risu_canc_doc = $open_connection->connection->query($query_canc_doc);
	if ($risu_canc_doc) {
		$num_canc_doc = $risu_canc_doc->rowCount();
		for ($f=0; $f<$num_canc_doc; $f++) {
			list($doc,$doc_eng) = $risu_canc_doc->fetch();
			if (is_file("files/regate/noticeboard/$doc")) @unlink("files/regate/noticeboard/$doc");
			if (is_file("files/regate/noticeboard/$doc_eng")) @unlink("files/regate/noticeboard/$doc_eng");
		}
	}
				
	$query_canc = "delete from edizioni_noticeboard where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.location="admin.php?cmd=noticeboard<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("edizioni_noticeboard", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento") ;
	if($azione=="scendi") $oggetto_admin->scendi("edizioni_noticeboard", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento") ;
	if($azione=="primo") $oggetto_admin->primo("edizioni_noticeboard", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");
	if($azione=="ultimo") $oggetto_admin->ultimo("edizioni_noticeboard", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");	
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("edizioni_noticeboard", "$id_canc", "$new_pos", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=noticeboard<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cambia_stato") {
	$query_stato="SELECT visible_noticeboard FROM edizioni_regate WHERE id='$id_riferimento'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	
	if($stato=="1") $new_stato="0";
	else $new_stato="1";
	
	$query_up="UPDATE edizioni_regate SET visible_noticeboard='$new_stato' WHERE id='$id_riferimento'";
	$risu_up=$open_connection->connection->query($query_up);
	
	?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 
}


if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){		
		$query_canc_doc = "select file,file_eng from edizioni_noticeboard where id='".$temp[$z]."'";
		$risu_canc_doc = $open_connection->connection->query($query_canc_doc);
		if ($risu_canc_doc) {
			$num_canc_doc = $risu_canc_doc->rowCount();
			for ($f=0; $f<$num_canc_doc; $f++) {
				list($doc,$doc_eng) = $risu_canc_doc->fetch();
				if (is_file("files/regate/noticeboard/$doc")) @unlink("files/regate/noticeboard/$doc");
				if (is_file("files/regate/noticeboard/$doc_eng")) @unlink("files/regate/noticeboard/$doc_eng");
			}
		}
				
		$query_canc = "delete from edizioni_noticeboard where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=noticeboard<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 	
}
$nome_reg = "";
$query_reg = "select nome from regate where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
if ($risu_reg) list($nome_reg) = $risu_reg->fetch();

$anno_ed = "";
$query_ed = "select anno from edizioni_regate where id='$id_riferimento'";
$risu_ed = $open_connection->connection->query($query_ed);
if ($risu_ed) list($anno_ed) = $risu_ed->fetch();
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
			document.getElementById('cancella_sel').href='admin.php?cmd=noticeboard<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=noticeboard<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<?php 
	$query_stato="SELECT visible_noticeboard FROM edizioni_regate WHERE id='$id_riferimento'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	?>

	<div style="width:100%; height:40px; margin-bottom:5px;">
		<div style="float:right; ">
			<a href="admin.php?cmd=<?php echo $pagina;?>&azione=cambia_stato<?php echo $rif;?>">
				<?php if($stato=="1"){?>
					<div class="btn" style="background:red; color:#fff" onclick="annulla()">Nascondi</div>
				<?php }else{?>
					<div class="btn" style="background:green; color:#fff" onclick="annulla()">Attiva</div>
				<?php }?>
			</a>
		</div>
		<div style="float:right; margin-top:5px; margin-right:10px;">
			<?php if($stato=="1"){?><span style="color:green"><b>COMUNICATI VISIBILE</b></span><?php }else{?><span style="color:red"><b>COMUNICATI NON VISIBILE</b></span><?php }?>
		</div>
	</div>
	
	<div style="height:50px;font-size:1.2em;padding-top:10px">Comunicati della regata <b><?php  echo ucfirst($nome_reg); ?></b> - <b>Edizione <?php  echo $anno_ed; ?></b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=edizioni<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle edizioni</b>
			</div>
		</a>
		<a href="admin.php?cmd=noticeboard_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi Comunicati</b>
			</div>
		</a>
	</div>
		
	<div class="mws-panel-header" style="clear:both">
		<span><i class="icon-table"></i> Comunicati</span> 
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th>Titolo</th>
					<th>Tipo</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from edizioni_noticeboard where id_regata='$id_rife' and id_edizione='$id_riferimento' order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "select * from edizioni_noticeboard where id_regata='$id_rife' and id_edizione='$id_riferimento' order by ordine desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$tit = $oggetto_admin->puntini(ucfirst($arr_ele['testo_link']));
						$tit_eng = $oggetto_admin->puntini(ucfirst($arr_ele['testo_link_eng']));
						$link = $arr_ele['link'];
						$file = $arr_ele['file'];
						$tipo = $arr_ele['tipo_link'];
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
						<?php if($arr_ele['testo_link'] && $arr_ele['testo_link']!=""){?><img src="../images/it.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $tit; ?><br/><?php }?>
						<?php if($arr_ele['testo_link_eng'] && $arr_ele['testo_link_eng']!=""){?><img src="../images/en.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $tit_eng; ?><?php }?>
					</td>
					<td align="center">
						<?php  echo $tipo; ?>
					</td>
					<td style="width:10%" align="center" valign="center">
						<span class="btn-group">
							<a href="admin.php?cmd=noticeboard&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=noticeboard&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=noticeboard&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=noticeboard&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
								<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
								<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="noticeboard"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="id_rife" value="<?php  echo $id_rife; ?>"/>
										<input type="hidden" name="id_riferimento" value="<?php  echo $id_riferimento; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
									</form>
								</div>
							</div>
							<a href="admin.php?cmd=noticeboard_mod&id_rec=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a  onclick="return confirm('Cancellare l\'elemento?')" href="admin.php?cmd=noticeboard&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>
		<?php  
		$table="noticeboard";
		include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
