<?php 
$table="ya_gallery_foto";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=ya_pagine_fotogallery<?php  echo $rif; ?>';
	}
</script>
<?php 
		
if($stato=="inviato")
{
	for($x=0; $x<count ($_FILES['img']['name']); $x++){
		//echo "@".$_FILES['img']['name'][$x]."<br/>";
		
		$nome_file = $_FILES['img']['name'][$x];
		$temp_file = $_FILES['img']['tmp_name'][$x];
		
		if ($nome_file) {		
			
			$nome_file =  $oggetto_admin->scrivi_img($nome_file , $temp_file, "img_up/ya_gallery_foto");
			
			list($larghezza_gr , $height, $type, $attr) = getimagesize($temp_file);
			if ($larghezza_gr>1920) $oggetto_admin->thumbjpg_new(1920,$temp_file,$nome_file,"img_up/ya_gallery_foto");
					
			$oggetto_admin->thumbjpg(250,$temp_file,$nome_file,"img_up/ya_gallery_foto","250_");
			$oggetto_admin->thumbjpg(360,$temp_file,$nome_file,"img_up/ya_gallery_foto","360_");
			$oggetto_admin->thumbjpg(450,$temp_file,$nome_file,"img_up/ya_gallery_foto","450_");
					
			$ord_file = $oggetto_admin->trova_ordine("$table","id_rife","$id_rife");
			$query_ins_file = "insert into ya_gallery_foto (ordine, foto, id_rife) values ('$ord_file', '$nome_file', '$id_rife')";
			$risu_ins_file = $open_connection->connection->query($query_ins_file);
		}
	}
?>
	<script language="javascript">
		window.location = "admin.php?cmd=ya_gallery_foto<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Foto </div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=ya_gallery_foto<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle foto</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=ya_gallery_foto_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<?php 
			$ord = $oggetto_admin->trova_ordine("$table","id_rife","$id_rife");
			echo "<input type=hidden name=ordine value=$ord>";	
			?>
			<input type="hidden" name="stato" value="inviato">	
			
			<input type="hidden" name="id_rife" value="<?php echo $id_rife;?>">					
			
			<div style="height:10px">&nbsp;</div>
			
			<?php $oggetto_admin->campo_ins("Foto<br /><i>Per una visualizzazione ottimale si consiglia per la foto che andrà in prima posizione una dimensione di 1200x800</i>", "img" , "42", 'no');	?>
			
			<div class="mws-button-row">
				<input type="submit" value="Inserisci" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
