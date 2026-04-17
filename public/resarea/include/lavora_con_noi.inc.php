<?php 
$pagina=1;
$table="lavora_con_noi";
$rif="";

$query="SELECT * FROM lavora_con_noi WHERE id='$pagina'";
$resu=$open_connection->connection->query($query);
$num=$resu->rowCount();
$risu=$resu->fetch();

$n_foto = $risu['img'];
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=lavora_con_noi<?php  echo $rif; ?>';
	}
</script>

<?php 
if($campocanc!="")
{		
	$query_canc_img = "update $table set $campocanc=NULL where id='$pagina'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=lavora_con_noi&pagina=<?php echo $pagina;?>';
	</script>	
<?php 
}
		
if($stato=="inviato")
{
	$_POST['testo']=str_replace('"',"'",$_POST['testo']);
	$_POST['testo_eng']=str_replace('"',"'",$_POST['testo_eng']);

	$arr_no['stato']=1;
	$oggetto_admin->modifica_campi ("$table" ,$risu['id'] , $arr_no ,  "","img_up");	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=lavora_con_noi<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{

?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Testo pagina Lavora con Noi</div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=lavora_con_noi<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">					
			<div style="height:10px">&nbsp;</div>
		
			<?php 
			$oggetto_admin->campo_mod("Foto" , "img" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec","","","img_up");
			?>
			<div class="mws-form-row">
				<label class="mws-form-label">Testo Pagina (Italiano)</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo"><?php  echo $risu['testo']; ?></textarea>
				</div>
			</div>
			<div class="mws-form-row">
				<label class="mws-form-label">Testo Pagina (Inglese)</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo_eng"><?php  echo $risu['testo_eng']; ?></textarea>
					<a href="admin.php?cmd=lavora_con_noi&campocanc=testo_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>
			</div>
			
			
			<div class="mws-button-row">
				<input type="submit" value="Modifica" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
