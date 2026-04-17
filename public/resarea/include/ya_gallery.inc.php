<?php 
$table = "ya_gallery";
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";

if(isset($_GET['ric_cat'])) $ric_cat=$_GET['ric_cat']; else $ric_cat="";

$rif="";
$criterio="";
if($ric_cat!="") {$rif.="&ric_cat=".$ric_cat; $criterio.= " AND id_rife='$ric_cat'";}

if(isset($_POST['stato_categoria_ins']) && $_POST['stato_categoria_ins']=="inviato"){

	$arr_no['stato_categoria_ins']=1;
	
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);
	if(isset($_POST['nome_eng'])) $_POST['nome_eng']=str_replace('"','\"',$_POST['nome_eng']);
	
	$_POST['ordine'] = $oggetto_admin->trova_ordine("ya_gallery_cat");
	
	$oggetto_admin->inserisci_campi ("ya_gallery_cat" , $arr_no);
	?>
	<script language="javascript">
		//window.location = "admin.php?cmd=ya_gallery<?php echo $rif;?>" ;
	</script>
	<?php 
}

if($azione=="cancella" && $id_canc!="")
{		
	$query_canc_img = "select foto from ya_gallery_foto where id_rife='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($foto) = $risu_canc_img->fetch();
		if (is_file("img_up/ya_gallery_foto/$foto")) @unlink("img_up/ya_gallery_foto/$foto");
		if (is_file("img_up/ya_gallery_foto/220_$foto")) @unlink("img_up/ya_gallery_foto/220_$foto");
		if (is_file("img_up/ya_gallery_foto/325_$foto")) @unlink("img_up/ya_gallery_foto/325_$foto");
		if (is_file("img_up/ya_gallery_foto/400_$foto")) @unlink("img_up/ya_gallery_foto/400_$foto");
		if (is_file("img_up/ya_gallery_foto/710_$foto")) @unlink("img_up/ya_gallery_foto/710_$foto");
	}
		
	$query_canc = "delete from ya_gallery_foto where id_rife='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
		
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.location="admin.php?cmd=ya_gallery<?php echo $rif;?>";
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
	if($azione=="inserisci_cat") {
		if(isset($_GET['valore_cat']) && $_GET['valore_cat']!=""){
			$ordine = $oggetto_admin->trova_ordine("ya_gallery",'id_rife',$_GET['valore_cat']);
			$query_up="UPDATE ya_gallery SET id_rife = '".$_GET['valore_cat']."', ordine = '$ordine' WHERE id='$id_canc'";
		}else{
			$query_up="UPDATE ya_gallery SET id_rife = '0' WHERE id='$id_canc'";
		}
		//echo $query_up;
		$risu_up = $open_connection->connection->query($query_up);
	}
	if($azione=="cancella_cat") {
		$ordine = $oggetto_admin->trova_ordine("ya_gallery",'id_rife','0');
		$query_up="UPDATE ya_gallery SET id_rife = '0', ordine = '$ordine' WHERE id='$id_canc'";
		$risu_up = $open_connection->connection->query($query_up);
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia" || $azione=="inserisci_cat" || $azione=="cancella_cat"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=ya_gallery<?php echo $rif;?>';
		</script>
	<?php }
}

?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Galleries Young Azzurra</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
			
	
	<div style="float:left;width:50%;text-align:left">
		<div style="float:left; margin-top:5px;"><b>Categorie:</b></div>
		<div style="float:left; margin-left:5px;">
			<select onchange="window.location='admin.php?cmd=ya_gallery&ric_cat='+this.value">
				<option value="">Seleziona...</option>
				<?php 
				$query_cat="SELECT * FROM ya_gallery_cat ORDER BY nome ASC";
				$resu_cat=$open_connection->connection->query($query_cat);
				while($risu_cat=$resu_cat->fetch()){?>
					<option value="<?php echo $risu_cat['id'];?>" <?php if($risu_cat['id']==$ric_cat){?>selected="selected"<?php }?>><?php echo $risu_cat['nome'];?></option>
				<?php }?>
				<option value="0" <?php if("0"==$ric_cat){?>selected="selected"<?php }?>>Senza Categoria</option>
			</select>
		</div>		
	</div>
	<div style="clear:both; height:10px"></div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=ya_gallery_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi Gallery</b>
			</div>
		</a>
	</div>
	
	<iframe src="" style="display:none" id="hiddenFrame"></iframe>
	
	<div class="mws-panel-header" style="clear:both">
		<span><i class="icon-table"></i> Lista Galleries</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="text-align:left;">Categoria</th>
					<th style="text-align:left;">Titolo</th>
					<th style="width:15%">Foto</th>
					<th style="width:30px">Azioni</th>
				</tr>
			</thead>
			<tbody>	
				<?php 
				$query_pag="SELECT titolo, id, id_rife FROM ya_gallery WHERE 1 $criterio ORDER BY ordine DESC";
				$resu_pag=$open_connection->connection->query($query_pag);
				$num_ele = $resu_pag->rowCount();
				$x=0;
				$start=0;
				while($risu_pag=$resu_pag->fetch()){
					$id_campo = $risu_pag['id'];
					$id_rife = $risu_pag['id_rife'];
					$titolo_pag = $risu_pag['titolo'];
				?>
					<tr>
						<td align="left" valign="center">
							<div id="nomeCat_<?php echo $id_campo;?>">
								<?php if(isset($id_rife) && $id_rife!=0){
									$query_cat="SELECT nome FROM ya_gallery_cat WHERE id='$id_rife'";
									$resu_cat = $open_connection->connection->query($query_cat);
									list($nome_cat)=$resu_cat->fetch();
									?>
									 <a class="btn" href="admin.php?cmd=ya_gallery&id_canc=<?php  echo $id_campo; ?>&azione=cancella_cat<?php  echo $rif; ?>"><i class="fa fa-times"></i></a>
									 &nbsp; 
									 <a class="btn" onclick="document.getElementById('nomeCat_<?php echo $id_campo;?>').style.display='none'; document.getElementById('selectCat_<?php echo $id_campo;?>').style.display='block';"><i class="icon-pencil"></i></a>
									 &nbsp; <b><?php echo $nome_cat;?></b>
								<?php }else{?>
									<a class="btn" onclick="document.getElementById('nomeCat_<?php echo $id_campo;?>').style.display='none'; document.getElementById('selectCat_<?php echo $id_campo;?>').style.display='block';">Inserisci</a>
								<?php }?>
							</div>
							<div id="selectCat_<?php echo $id_campo;?>" style="display:none">
								<select onchange="window.location='admin.php?cmd=ya_gallery&id_canc=<?php  echo $id_campo; ?>&azione=inserisci_cat&valore_cat='+this.value+'<?php  echo $rif; ?>'">
									<option value="">Seleziona...</option>
									<?php 
									$query_cat="SELECT * FROM ya_gallery_cat ORDER BY nome ASC";
									$resu_cat=$open_connection->connection->query($query_cat);
									while($risu_cat=$resu_cat->fetch()){?>
										<option value="<?php echo $risu_cat['id'];?>" <?php if(isset($id_rife) && $risu_cat['id']==$id_rife){?>selected="selected"<?php }?>><?php echo $risu_cat['nome'];?></option>
									<?php }?>
								</select>
							</div>
						</td>
						<td align="left" valign="center">
							<?php echo $titolo_pag;?>
						</td>
						<td style="text-align:center;">
							<?php 
							$query_foto="SELECT id FROM ya_gallery_foto WHERE id_rife='".$id_campo."'";
							$resu_foto=$open_connection->connection->query($query_foto);
							$num_foto=$resu_foto->rowCount();
							?>
							<span class="btn-group">
								<a href="admin.php?cmd=ya_gallery_foto&id_rife=<?php echo $id_campo;?>" class="btn btn-small" style="color:#2a2a2d"><?php echo $num_foto;?></a>
							</span>
						</td>						
						<td>
							<span class="btn-group">
								<?php if($ric_cat!=""){?>
									<a href="admin.php?cmd=ya_gallery&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php  echo $rif; ?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
									<a href="admin.php?cmd=ya_gallery&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php  echo $rif; ?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
									<a href="admin.php?cmd=ya_gallery&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php  echo $rif; ?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
									<a href="admin.php?cmd=ya_gallery&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php  echo $rif; ?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
									<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
										<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
										<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
											<form action="admin.php" method="GET">
												<input type="hidden" name="cmd" value="ya_gallery"/>
												<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
												<input type="hidden" name="pagina" value="<?php  echo $pagina; ?>"/>
												<input type="hidden" name="azione" value="cambia"/>
												<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
											</form>
										</div>
									</div>
								<?php }?>
								<a href="admin.php?cmd=ya_gallery_mod&id_rife=<?php echo $id_campo;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
								<a <?php if($num_foto==0){?>onclick="return confirm('Confermi la cancellazione?')" href="admin.php?cmd=ya_gallery&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php  echo $rif; ?>"<?php }else{?>onclick="return confirm('Prima di rimuovere la photogallery cancellare tutte le foto')" disabled="disabled"<?php }?>  class="btn btn-small"><i class="icon-trash"></i></a>
							</span>
						</td>
					</tr>
					<?php $x++;
				}?>
			</tbody>
		</table>	
		<?php  include("fissi/multipagina.inc.php"); ?>
	</div>
</div>
