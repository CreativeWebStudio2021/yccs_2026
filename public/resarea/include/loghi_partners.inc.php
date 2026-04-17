<?php 
$table="edizioni_loghi_partners";
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
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";

if($azione=="cancella" && $id_canc!="")
{	
	
	$query_canc_ris = "select img from edizioni_loghi_partners where id='$id_canc'";
	$risu_canc_ris = $open_connection->connection->query($query_canc_ris);
	if ($risu_canc_ris) {
		$num_canc_ris = $risu_canc_ris->rowCount();
		for ($f=0; $f<$num_canc_ris; $f++) {
			list($ris) = $risu_canc_ris->fetch();
			if (is_file("img_up/regate/loghi/$ris")) @unlink("img_up/regate/loghi/$ris");
		}
	}
				
	$query_canc = "delete from edizioni_loghi_partners where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.location="admin.php?cmd=loghi_partners<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("edizioni_loghi_partners", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento") ;
	if($azione=="scendi") $oggetto_admin->scendi("edizioni_loghi_partners", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento") ;
	if($azione=="primo") $oggetto_admin->primo("edizioni_loghi_partners", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");
	if($azione=="ultimo") $oggetto_admin->ultimo("edizioni_loghi_partners", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");	
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("edizioni_loghi_partners", "$id_canc", "$new_pos", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=loghi_partners<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){		
		$query_canc_ris = "select img from edizioni_loghi_partners where id='".$temp[$z]."'";
		$risu_canc_ris = $open_connection->connection->query($query_canc_ris);
		if ($risu_canc_ris) {
			$num_canc_ris = $risu_canc_ris->rowCount();
			for ($f=0; $f<$num_canc_ris; $f++) {
				list($ris) = $risu_canc_ris->fetch();
				if (is_file("img_up/regate/loghi/$ris")) @unlink("img_up/regate/loghi/$ris");
			}
		}
				
		$query_canc = "delete from edizioni_loghi_partners where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=loghi_partners<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=loghi_partners<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=loghi_partners<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px">Loghi Partners della regata <b><?php  echo ucfirst($nome_reg); ?></b> - <b>Edizione <?php  echo $anno_ed; ?></b></div>
	
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
		<a href="admin.php?cmd=loghi_partners_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi logo</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header" style="clear:both">
		<span><i class="icon-table"></i> Elenco Title Sponsor</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:150px">Logo</th>
					<th style="text-align:left;">Nome</th>
					<th style="text-align:left;">Link</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from edizioni_loghi_partners where id_regata='$id_rife' and id_edizione='$id_riferimento' order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "select * from edizioni_loghi_partners where id_regata='$id_rife' and id_edizione='$id_riferimento' order by ordine desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$link_eng = $arr_ele['link_eng'];
						$link = $arr_ele['link'];
						$img = $arr_ele['img'];
						$titolo = $arr_ele['titolo'];
						
						if(file_exists("img_up/regate/loghi/s_$img")) $ante = "img_up/regate/loghi/s_$img";
						elseif(file_exists("img_up/regate/loghi/$img")) $ante = "img_up/regate/loghi/$img";
						else $ante = "https://www.yccs.it/resarea/img_up/regate/loghi/$img";
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
					<td align="center">
						<img src="<?php echo $ante;?>" style="width:150px;" alt=""/>
					</td>
					<td align="left">
						<?php echo $titolo;?>
					</td>
					<td>
						<?php if($link_eng && trim($link_eng)!=""){?><img src="../images/en.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $link_eng; ?><br/><?php }?>
						<?php if($link && trim($link)!=""){?><img src="../images/it.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $link; ?><?php }?>
					</td>
					<td style="width:10%" align="center" valign="center">
						<span class="btn-group">
							<a href="admin.php?cmd=loghi_partners&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=loghi_partners&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=loghi_partners&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=loghi_partners&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
								<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
								<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="loghi_partners"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="id_rife" value="<?php  echo $id_rife; ?>"/>
										<input type="hidden" name="id_riferimento" value="<?php  echo $id_riferimento; ?>"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
									</form>
								</div>
							</div>
							<a href="admin.php?cmd=loghi_partners_mod&id_rec=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onclick="return confirm('Cancellare l\'elemento?')" href="admin.php?cmd=loghi_partners&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
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
