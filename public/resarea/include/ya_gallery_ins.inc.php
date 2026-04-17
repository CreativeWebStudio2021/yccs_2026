<?php 
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=ya_gallery<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.gino.titolo.value=="") alert('Titolo obbigatorio');
		else document.gino.submit();
	}
</script>
<?php 
if($stato=="inviato"){

	$arr_no['stato']=1;
	
	//$_POST['titolo']=str_replace('"','\"',$_POST['titolo']);
	//$_POST['titolo_eng']=str_replace('"','\"',$_POST['titolo_eng']);
	//$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	//$_POST['testo_eng']=str_replace('"','\"',$_POST['testo_eng']);
	
	if (isset($_POST['data_mod'])) $data_mod = $oggetto_admin->date_to_data($_POST['data_mod']);
		else $data_mod = "";
	
	if(!isset($_POST['id_rife'])) $_POST['id_rife']='0';
	$_POST['ordine'] = $oggetto_admin->trova_ordine("ya_gallery",'id_rife',$_POST['id_rife']);
	
	$oggetto_admin->inserisci_campi ("ya_gallery" , $arr_no);
?>
	<script language="javascript">
		window.location = "admin.php?cmd=ya_gallery<?php echo $rif;?>" ;
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci articolo</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=ya_gallery<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle gallery</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=ya_gallery_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">

			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Categoria</label>
					<div class="mws-form-item">
						<select name="id_rife">
							<option value="">Seleziona...</option>
							<?php 
							$query_cat="SELECT * FROM ya_gallery_cat ORDER BY nome ASC";
							$resu_cat=$open_connection->connection->query($query_cat);
							while($risu_cat=$resu_cat->fetch()){?>
								<option value="<?php echo $risu_cat['id'];?>"><?php echo $risu_cat['nome'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
			<?php 
				$oggetto_admin->campo_ins("Titolo (Italiano)*", "titolo" , "1", 'no');	
				$oggetto_admin->campo_ins("Titolo (Inglese)", "titolo_eng" , "1", 'no');	
				?>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Italiano)*</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo"></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_eng"></textarea>
					</div>
				</div>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
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
