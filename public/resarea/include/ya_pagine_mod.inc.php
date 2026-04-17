<?php 
if(isset($_GET['pagina'])) $pagina=$_GET['pagina']; else $pagina="";
$table="ya_pagine";
$rif="&pagina=$pagina";

$query="SELECT * FROM ya_pagine WHERE id='$pagina'";
$resu=$open_connection->connection->query($query);
$num=$resu->rowCount();
$risu=$resu->fetch();

$n_titolo = $risu['titolo'];
$n_titolo_eng = $risu['titolo_eng'];
$n_foto = $risu['foto'];
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=ya_pagine<?php  echo $rif; ?>';
	}
</script>

<?php 
if($campocanc!="")
{		
	$query_canc_img = "update $table set $campocanc=NULL where id='$pagina'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=ya_pagine_mod&pagina=<?php echo $pagina;?>';
	</script>	
<?php 
}
		
if($stato=="inviato")
{
	$_POST['testo']=str_replace('"',"'",$_POST['testo']);
	$_POST['testo_eng']=str_replace('"',"'",$_POST['testo_eng']);
	$_POST['titolo']=str_replace('"',"'",$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"',"'",$_POST['titolo_eng']);

	$arr_no['stato']=1;
	$oggetto_admin->modifica_campi ("$table" ,$risu['id'] , $arr_no ,  $arr_thumb,"img_up/ya_pagine");	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=ya_pagine<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{

?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Testo pagina Young Azzurra</div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=ya_pagine_mod<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">					
			<div style="height:10px">&nbsp;</div>
		
			<?php 
			$oggetto_admin->campo_mod("Titolo (Italiano)" , "titolo" , "$n_titolo"  , "1", 'no', "$cmd", "$pagina");
			?>
			<div class="mws-form-row">
				<label class="mws-form-label">Titolo (Inglese)</label>
				<div class="mws-form-item">
					<input type="text" class="medium" name="titolo_eng" value="<?php  echo $n_titolo_eng; ?>"/>
					<a href="admin.php?cmd=ya_pagine_mod&campocanc=titolo_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
				</div>
			</div>
			<?php 
			$oggetto_admin->campo_mod("Foto" , "foto" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec","","","img_up/ya_pagine");
			?>
			<div class="mws-form-row">
				<label class="mws-form-label">Testo Pagina (Italiano)</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo"><?php  echo $risu['testo']; ?></textarea>
					<a href="admin.php?cmd=ya_pagine_mod&campocanc=testo<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
				</div>
			</div>
			<div class="mws-form-row">
				<label class="mws-form-label">Testo Pagina (Inglese)</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo_eng"><?php  echo $risu['testo_eng']; ?></textarea>
					<a href="admin.php?cmd=ya_pagine_mod&campocanc=testo_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
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
