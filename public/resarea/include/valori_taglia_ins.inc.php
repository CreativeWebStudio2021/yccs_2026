<?php 
$table="valori_taglia";

$rif="";

if(isset($_GET['id_tipo'])) $id_tipo=$_GET['id_tipo']; else $id_tipo='';
if($id_tipo!="") {
	$rif="&id_tipo=$id_tipo";
}
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";
?>

<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.valore.value=="") alert('Valore obbigatorio');
		else if (document.inserimento.id_tipo.value=="") alert('Tipo Taglia obbigatorio');					
		else document.inserimento.submit();
	}
</script>
<?php 


if($stato=="inviato")
{
	$arr_no['stato']=1;
	/*$arr_thumb['img']="120" ; */
	$_POST['valore']=str_replace('"','\"',$_POST['valore']);

	$oggetto_admin->inserisci_campi ("$table" , $arr_no ,  "" );
?>
	<script language="javascript">
		window.location = "admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" ;
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci <?php echo $table;?></b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine("$table", "id_tipo", "$id_tipo");
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Tipo Taglia *</label>
					<div class="mws-form-item">
						<select name="id_tipo" class="small">
							<option value="">Seleziona</option>
							<?php 
							$query_cat="SELECT * FROM tipo_taglia ORDER BY nome ASC";
							$resu_cat=$open_connection->connection->query($query_cat);
							while($risu_cat=$resu_cat->fetch()){?>
								<option value="<?php echo $risu_cat['id'];?>" <?php if($id_tipo==$risu_cat['id']){?>selected="selected"<?php }?>><?php echo $risu_cat['nome'];?></option>
							<?php }?>					
						</select>
					</div>
				</div>
	<?php 
				$oggetto_admin->campo_ins("Valore" , "valore" , "1", 'no');
	?>
				
			</div>
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
