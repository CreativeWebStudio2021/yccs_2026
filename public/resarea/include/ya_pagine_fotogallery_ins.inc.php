<?php 
$table="ya_pagine_gallery";
$rif="";

if(isset($_GET['pagina'])) $pagina=$_GET['pagina']; else $pagina='';
if($pagina!="") $rif="&pagina=$pagina";
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
			
			$nome_file =  $oggetto_admin->scrivi_img($nome_file , $temp_file, "img_up/ya_pagine_gallery");
			
			list($larghezza_gr , $height, $type, $attr) = getimagesize($temp_file);
			if ($larghezza_gr>1920) $oggetto_admin->thumbjpg_new(1920,$temp_file,$nome_file,"img_up/ya_pagine_gallery");
					
			$oggetto_admin->thumbjpg(250,$temp_file,$nome_file,"img_up/ya_pagine_gallery","250_");
			$oggetto_admin->thumbjpg(360,$temp_file,$nome_file,"img_up/ya_pagine_gallery","360_");
			$oggetto_admin->thumbjpg(450,$temp_file,$nome_file,"img_up/ya_pagine_gallery","450_");
					
			$ord_file = $oggetto_admin->trova_ordine("$table","id_rife","$pagina");
			$query_ins_file = "insert into ya_pagine_gallery (ordine, img, id_rife) values ('$ord_file', '$nome_file', '$pagina')";
			$risu_ins_file = $open_connection->connection->query($query_ins_file);
		}
	}
?>
	<script language="javascript">
		window.location = "admin.php?cmd=ya_pagine_fotogallery<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Foto </div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=ya_pagine_fotogallery_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<?php 
			$ord = $oggetto_admin->trova_ordine("$table","id_rife","$pagina");
			echo "<input type=hidden name=ordine value=$ord>";	
			?>
			<input type="hidden" name="stato" value="inviato">	
			
			<input type="hidden" name="pagina" value="<?php echo $pagina;?>">					
			
			<div style="height:10px">&nbsp;</div>
			
			<?php $oggetto_admin->campo_ins("Foto<br />", "img" , "42", 'no');	?>
			
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
