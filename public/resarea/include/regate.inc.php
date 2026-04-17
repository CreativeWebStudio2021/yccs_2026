<?php 
$table="regate";

$criterio="";
$rif="";

if(isset($_GET['nome_ric'])) $nome_ric=$_GET['nome_ric']; else $nome_ric='';
if($nome_ric!="") {
	$criterio=" and nome like '%$nome_ric%'";
	$rif.="&nome_ric=$nome_ric";
}
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
//$rif.="&pag_att=$pag_att";

if($conferma)
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc_img = "select logo from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/regate/$img")) @unlink("img_up/regate/$img");
		if (is_file("img_up/regate/s_$img")) @unlink("img_up/regate/s_$img");
		if (is_file("img_up/regate/xs_$img")) @unlink("img_up/regate/xs_$img");
	}

	
	$query_canc = "delete from edizioni_regate where id_regata='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.alert("Il campo e' stato cancellato con successo");
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
		$query_canc_img = "select logo from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/regate/$img")) @unlink("img_up/regate/$img");
			if (is_file("img_up/regate/s_$img")) @unlink("img_up/regate/s_$img");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 	
}

if($azione=="cambia_ragata") {
	if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";
	if(isset($_GET['nuova_reg'])) $nuova_reg=$_GET['nuova_reg']; else $nuova_reg="";
	
	$query_up="UPDATE edizioni_doc SET id_regata='$nuova_reg' WHERE id_regata='$id_canc'";
	$query_up."<br/>";
	$risu_up=$open_connection->connection->query($query_up);
	$query_up="UPDATE edizioni_foto SET id_regata='$nuova_reg' WHERE id_regata='$id_canc'";
	//echo $query_up."<br/>";
	$risu_up=$open_connection->connection->query($query_up);
	$query_up="UPDATE edizioni_info SET id_regata='$nuova_reg' WHERE id_regata='$id_canc'";
	//echo $query_up."<br/>";
	$risu_up=$open_connection->connection->query($query_up);
	$query_up="UPDATE edizioni_iscritti SET id_regata='$nuova_reg' WHERE id_regata='$id_canc'";
	//echo $query_up."<br/>";
	$risu_up=$open_connection->connection->query($query_up);
	$query_up="UPDATE edizioni_regate SET id_regata='$nuova_reg' WHERE id_regata='$id_canc'";
	//echo $query_up."<br/>";
	$risu_up=$open_connection->connection->query($query_up);
	$query_up="UPDATE edizioni_risultati SET id_regata='$nuova_reg' WHERE id_regata='$id_canc'";
	//echo $query_up."<br/>";
	$risu_up=$open_connection->connection->query($query_up);
	$query_up="UPDATE edizioni_video SET id_regata='$nuova_reg' WHERE id_regata='$id_canc'";
	//echo $query_up."<br/>";
	$risu_up=$open_connection->connection->query($query_up);
	$query_up="UPDATE press SET id_regata='$nuova_reg' WHERE id_regata='$id_canc'";
	//echo $query_up."<br/>";
	$risu_up=$open_connection->connection->query($query_up);
	$query_del="DELETE FROM regate WHERE id='$id_canc'";
	//echo $query_del."<br/>";
	$risu_up=$open_connection->connection->query($query_del);
	?>
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
		<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca regate</span>
	</div>
	<div class="mws-panel-body no-padding" id="searchPanel">
		<form name="ricerca" class="mws-form" action="admin.php" method="GET" enctype="multipart/form-data">
			<input type="hidden" name="cmd" value="<?php echo $table;?>">
			<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>">
			
			<div class="mws-form-inline">									
				<div class="mws-form-row">		
					<div style="float:left;width:20%">Nome</div>
					<div style="float:left;width:30%">
						<input type="text" name="nome_ric" value="<?php  echo $nome_ric; ?>" />
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Cerca" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="window.location='admin.php?cmd=regate'">
			</div>
		</form>
	</div>
			
	<div style="clear:both;height:20px">&nbsp;</div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" style="color:#7a7a7a">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi <?php echo $table;?></b>
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
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:100px">Logo</th>
					<th>ID</th>
					<th style="text-align:left;">Nome</th>
					<th style="width:100px">Edizioni</th>
					<th style="width:70px">N. Link</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY ordine desc";
				//echo $query_ele;
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY ordine desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$nome = ucfirst($arr_ele['nome']);
						$home = ucfirst($arr_ele['home']);
						$foto = $arr_ele['logo'];	
						$id_campo = $arr_ele['id'];	

						if(file_exists("img_up/images/s_$foto")) $ante = "img_up/gallery/s_$foto";
						elseif(file_exists("img_up/images/$foto")) $ante = "img_up/images/$foto";
						else $ante = "https://www.yccs.it/resarea/img_up/regate/$foto";						
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>
					<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
					<td align="center" valign="center"><img src="<?php  echo $ante; ?>" alt="" style="width:100px"/><?php  /*}*/ ?></td>
					<td align="center" valign="center"><?php  echo $id_campo; ?></td>
					<td style="overflow:hidden; ">
						<span style=" font-size:16px;"><?php  echo $nome; ?></span> <?php if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="300"){?><i class="fa fa-pencil-square" style="cursor:pointer;" onclick=" document.getElementById('regata_<?php echo $id_campo;?>').style.display='block';"></i><?php }?>
						<select style="width:250px; display:none;" id="regata_<?php echo $id_campo;?>" onchange="window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&azione=cambia_ragata&id_canc=<?php echo $id_campo;?>&nuova_reg='+this.value+'&pag_att=<?php echo $pag_att;?>'">
							<?php 
							$query_reg = "SELECT * FROM regate WHERE 1 ORDER BY id ASC";
							$resu_reg=$open_connection->connection->query($query_reg);
							while($risu_reg=$resu_reg->fetch()){?>
								<option value="<?php echo $risu_reg['id'];?>" <?php if($risu_reg['id']==$id_campo){?>selected="selected"<?php }?>><?php echo $risu_reg['id'];?> - <?php echo $risu_reg['nome'];?></option>
							<?php }?>
						</select>
						<div style="width:800px; padding-bottom:5px;overflow-x:scroll; display:flex; gap:8px; margin-top:20px;">
						<?php 
							$num_ed = 0;
							$query_ed = "select id,anno,visibile,old,new,new2 from edizioni_regate where id_regata='$id_campo' order by anno desc";		
							$risu_ed = $open_connection->connection->query($query_ed);
							if ($risu_ed) $num_ed = $risu_ed->rowCount();
							
							if ($num_ed>0) {
								for ($e=0; $e<$num_ed; $e++) {
									list($id_ed,$anno_ed,$visibile_ed,$old_ed,$new_ed,$new_ed2) = $risu_ed->fetch();
									?>
									<div style="display:flex; flex-direction:column; gap:5px; align-items:center; border-right: solid 1px #ccc; padding-right:8px;">
										<a class="btn" style="text-decoration: none; color:#333333; font-weight:600; font-size:16px;" href="admin.php?cmd=edizioni_mod&id_rife=<?php  echo $id_campo; ?>&id_rec=<?php echo $id_ed;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
											<?php echo $anno_ed;?>
										</a>
										
										<span style="cursor:pointer; display:flex; align-items:center; gap:5px; font-size:1.3em;" onclick="cambiaVers('<?php  echo $id_ed; ?>','1');" id="versione_<?php  echo $id_ed; ?>">	
											<i class="fa fa-certificate" id="ver1_<?php  echo $id_ed; ?>" style="<?php if($old_ed=='1'){?>color:#fbc444<?php }?>" aria-hidden="true" title="<?php if($new_ed=='1'){?>Nuova Versione<?php }else{?>Vecchia Versione<?php }?>"></i> 
											<span style="font-size:13px">v1</span>
										</span>
										
										<span style="cursor:pointer; display:flex; align-items:center; gap:5px; font-size:1.3em;" onclick="cambiaVers('<?php  echo $id_ed; ?>','2');" id="versione_<?php  echo $id_ed; ?>">	
											<i class="fa fa-certificate" id="ver2_<?php  echo $id_ed; ?>" style="<?php if($new_ed=='1'){?>color:#fbc444<?php }?>" aria-hidden="true" title="<?php if($new_ed=='1'){?>Nuova Versione<?php }else{?>Vecchia Versione<?php }?>"></i>
											<span style="font-size:13px">v2</span>
										</span>
										
										<span style="cursor:pointer; display:flex; align-items:center; gap:5px; font-size:1.3em;" onclick="cambiaVers('<?php  echo $id_ed; ?>','3');" id="versione_<?php  echo $id_ed; ?>">	
											<i class="fa fa-certificate" id="ver3_<?php  echo $id_ed; ?>" style="<?php if($new_ed2=='1'){?>color:#fbc444<?php }?>" aria-hidden="true" title="<?php if($new_ed=='1'){?>Nuova Versione<?php }else{?>Vecchia Versione<?php }?>"></i>
											<span style="font-size:13px">v3</span>
										</span>
										
										<span style="cursor:pointer; font-size:1.3em; font-size:16px;color:<?php if($visibile_ed=='1'){?>green<?php }else{?>red<?php }?>" onclick="cambiaVis('<?php  echo $id_ed; ?>');" id="edizioneVis_<?php  echo $id_ed; ?>">
											<?php if($visibile_ed=='1'){?>
												<i class="fa fa-eye" aria-hidden="true" title="Visibile"></i>
											<?php }else{?>
												<i class="fa fa-eye-slash" aria-hidden="true" title="Non Visibile"></i>
											<?php }?>
										</span>								
									</div>
								<?php }
							}
						?>
						</div>
					</td>
					<td align="center">
						<span class="btn-group" style="margin-top:10px;">
							<a href="admin.php?cmd=edizioni_ins&id_rife=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" title="Aggiungi nuova edizione" class="btn btn-small"><i class="fa fa-plus"></i></a>
							<a href="admin.php?cmd=edizioni&id_rife=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" title="Vedi lista edizioni" class="btn btn-small"><i class="fa fa-list"></i></a>
						</span>
					</td>
					<td align="center">
						<?php 
						$query_comm="SELECT id FROM regate_doc WHERE id_regata='$id_campo'";
						$resu_comm=$open_connection->connection->query($query_comm);
						$num_comm=$resu_comm->rowCount();
						?>
						<span class="btn" style="color:#000; cursor:pointer;" onclick="vedi_link('<?php echo $id_campo;?>')"><?php echo $num_comm;?></span>
					</td>
					<td style="width:10%">
						<span class="btn-group">
							<a onclick="home('<?php  echo $id_campo; ?>');" <?php if($home==1){?>style="color:green"<?php }?> class="btn btn-small" id="iconHome_<?php  echo $id_campo; ?>"><i class="icon-home"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
								<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff;"></div>
								<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px;">
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="<?php echo $table;?>"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
									</form>
								</div>
							</div>
							<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<?php  if (isset($num_prod) && $num_prod==0) { ?><a href="admin.php?cmd=<?php echo $table;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a><?php  } ?>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
			<iframe src="" style="display:none" id="hiddenFrame"></iframe>
			<script>
				function home(id_reg){
					if(document.getElementById('iconHome_'+id_reg).style.color=="green") document.getElementById('iconHome_'+id_reg).style.color="#333333";
					else document.getElementById('iconHome_'+id_reg).style.color="green";
					document.getElementById('hiddenFrame').src="frame/cambiaHome.php?id_campo="+id_reg;
				}
				function cambiaVers(id_ed, ver){
					document.getElementById('ver1_'+id_ed).style.color="#333";
					document.getElementById('ver2_'+id_ed).style.color="#333";
					document.getElementById('ver3_'+id_ed).style.color="#333";
					if(ver==1) document.getElementById('ver1_'+id_ed).style.color="#fbc444";
					if(ver==2) document.getElementById('ver2_'+id_ed).style.color="#fbc444";
					if(ver==3) document.getElementById('ver3_'+id_ed).style.color="#fbc444";
					
					document.getElementById('hiddenFrame').src="frame/cambiaVersione.php?id_campo="+id_ed+"&ver="+ver;
				}
				function cambiaVis(id_ed){
					if(document.getElementById('edizioneVis_'+id_ed).style.color=="green") {
						document.getElementById('edizioneVis_'+id_ed).style.color="red";
						document.getElementById('edizioneVis_'+id_ed).innerHTML='<i class="fa fa-eye-slash" aria-hidden="true" title="Non Visibile"></i>';
					}else{
						document.getElementById('edizioneVis_'+id_ed).style.color="green";
						document.getElementById('edizioneVis_'+id_ed).innerHTML='<i class="fa fa-eye" aria-hidden="true" title="Visibile"></i>';
					}
					document.getElementById('hiddenFrame').src="frame/cambiaVisibilita.php?id_campo="+id_ed;
				}
			</script>
		</table>		
		<?php  include("fissi/multipagina.inc.php"); ?>
		<a href="" onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>

<div  class="popup" id="box_link">
	<iframe src="" style="width:100%; height:100%;" id="frame_link" frameborder=0 ></iframe>
	<div style="position:absolute; top:15px; right:25px; width:20px; height:20px; cursor:pointer; text-align:center;" onclick="document.getElementById('box_link').style.display='none'; window.location='<?php echo $_SERVER['REQUEST_URI'];?>';">
		<i class="fa fa-times-circle fa-2x"></i>		
	</div>
</div>

<script type="text/javascript">
	function vedi_link(id_comm){
		$("#box_link").fadeIn();
		document.getElementById('frame_link').src="frame/regate_doc.php?id_comm="+id_comm;	
	}
</script>
