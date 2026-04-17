<?php 
$table="ya_team";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";
if(isset($_GET['ric_anno'])) $ric_anno=$_GET['ric_anno']; else $ric_anno=date("Y");

$rif="&ric_anno=$ric_anno";
$criterio="";
	
if($azione=="cancella" && $id_canc!="")
{	
	$query_canc_img = "select foto from ya_team where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($foto) = $risu_canc_img->fetch();
		if (is_file("img_up/ya_team/$foto")) @unlink("img_up/ya_team/$foto");
		if (is_file("img_up/ya_team/s_$foto")) @unlink("img_up/ya_team/s_$foto");
	}
	
	$query_canc = "delete from ya_team where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=ya_team<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("ya_team", "$id_canc", "anno", "$ric_anno") ;
	if($azione=="scendi") $oggetto_admin->scendi("ya_team", "$id_canc", "anno", "$ric_anno") ;
	if($azione=="primo") $oggetto_admin->primo("ya_team", "$id_canc", "anno", "$ric_anno") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("ya_team", "$id_canc", "anno", "$ric_anno") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("ya_team", "$id_canc", "$new_pos", "anno", "$ric_anno") ;
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=ya_team<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select foto from ya_team where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($foto) = $risu_canc_img->fetch();
			if (is_file("img_up/ya_team/$foto")) @unlink("img_up/ya_team/$foto");
			if (is_file("img_up/ya_team/s_$foto")) @unlink("img_up/ya_team/s_$foto");
		}
		
		$query_canc = "delete from ya_team where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=ya_team<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=ya_team<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=ya_team<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Atleti Young Azzurra</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="height:30px;width:50%;float:left; text-align:left">
		<div style="float:left; margin-top:5px;"><b>Anni:</b></div>
		<?php 
		$query_anni="SELECT DISTINCT anno FROM $table ORDER BY anno ASC";
		$resu_anni = $open_connection->connection->query($query_anni);
		while($risu_anni=$resu_anni->fetch()){?>
			<a href="admin.php?cmd=ya_team&ric_anno=<?php echo $risu_anni['anno'];?>">
				<div style="float:left; margin-left:5px;" class="btn <?php if($ric_anno==$risu_anni['anno']){?>btn-info<?php }?>"><?php echo $risu_anni['anno'];?></div>
			</a>
		<?php }?>
	</div>
	<div style="height:30px;width:150px;float:right; text-align:right">
		<a href="admin.php?cmd=ya_team_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi Atleta</b>
			</div>
		</a>
	</div>
	<div style="clear:both; height:20px"></div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Atleti Young Azzurra</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:50px">Anno</th>
					<th style="width:200px">Foto</th>
					<th align="left">Titolo</th>
					<th align="left">Nome</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from ya_team WHERE anno='$ric_anno' ORDER BY ordine DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{		
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM ya_team WHERE anno='$ric_anno' ORDER BY ordine DESC LIMIT $start,$rec_pag";
					//echo $query_ele;
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					$cont=1;
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$foto = $arr_ele['foto'];
						$tit = $oggetto_admin->puntini(ucfirst($arr_ele['titolo']));
						$nome = $arr_ele['nome'];
						$cognome = $arr_ele['cognome'];
						$id_campo = $arr_ele['id'];
						$anno = $arr_ele['anno'];
						
						if(file_exists("img_up/ya_team/s_$foto")) $ante = "img_up/ya_team/s_$foto";
						elseif(file_exists("img_up/ya_team/$foto")) $ante = "img_up/ya_team/$foto";
						else $ante = "https://www.yccs.it/resarea/img_up/ya_team/$foto";
						?>	
						<script type="text/javascript">
							lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
						</script>
						<tr <?php if($cont==2){?>style="background:#ddd"<?php }?>>
							<td align="center" valign="center">
								<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
							</td>
							<td align="center" valign="center">
								<?php  echo $start+$x+1; ?>
							</td>
							<td align="center" valign="center">
								<?php  echo $anno; ?>
							</td>
							<td align="center" valign="center">
								<img style="width:200px;" src="<?php  echo $ante; ?>" alt=""/>
							</td>
							<td align="left">
								<?php  echo $tit; ?>							
							</td>
							<td align="left" valign="center">
								<?php  echo $nome; ?>	<?php  echo $cognome; ?>	
							</td>
							<td style="width:10%">
								<span class="btn-group">
									<a href="admin.php?cmd=ya_team&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
									<a href="admin.php?cmd=ya_team&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
									<a href="admin.php?cmd=ya_team&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
									<a href="admin.php?cmd=ya_team&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
									<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
										<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
										<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
											<form action="admin.php" method="GET">
												<input type="hidden" name="cmd" value="ya_team"/>
												<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
												<input type="hidden" name="azione" value="cambia"/>
												<input type="hidden" name="ric_anno" value="<?php echo $ric_anno;?>"/>
												<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
											</form>
										</div>
									</div>
									<a href="admin.php?cmd=ya_team_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
									<a onclick="return confirm('Si conferma la cancellazione dell\'elemento?')" href="admin.php?cmd=ya_team&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
								</span>
							</td>
						</tr>
						<?php $cont++; if($cont==3) $cont=1;
					}
				}
			?>
			</tbody>
		</table>
		<?php  include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>


