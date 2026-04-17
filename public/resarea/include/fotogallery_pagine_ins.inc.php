<?php 
if(isset($_GET['pagina'])) $pagina=$_GET['pagina']; else $pagina="";
$table="fotogallery_pagine";
$rif="&pagina=$pagina";

if($pagina=="la-storia") $titolo_pagina="Il Club - La Storia";
if($pagina=="yccs_oggi") $titolo_pagina="Il Club - Lo YCCS Oggi";
if($pagina=="consiglio_direttivo") $titolo_pagina="Il Club - Consiglio Direttivo";
if($pagina=="clubhouse") $titolo_pagina="YCCS Porto Cervo - La Clubhouse";
if($pagina=="scuola_vela") $titolo_pagina="YCCS Porto Cervo - Scuola di Vela";
if($pagina=="centro_sportivo") $titolo_pagina="YCCS Porto Cervo - Centro Sportivo";
if($pagina=="clubhouse_vg") $titolo_pagina="YCCS Virgin Gorda - La Clubhouse";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=fotogallery_pagine<?php  echo $rif; ?>';
	}
</script>
<?php 
		
if($stato=="inviato")
{
	for($x=0; $x<count ($_FILES['foto']['name']); $x++){
		//echo "@".$_FILES['foto']['name'][$x]."<br/>";
		
		$nome_file = $_FILES['foto']['name'][$x];
		$temp_file = $_FILES['foto']['tmp_name'][$x];
		
		if ($nome_file) {		
			
			$nome_file =  $oggetto_admin->scrivi_img($nome_file , $temp_file, "img_up/pagine");
			
			list($larghezza_gr , $height, $type, $attr) = getimagesize($temp_file);
			if ($larghezza_gr>800) $oggetto_admin->thumbjpg_new(800,$temp_file,$nome_file,"img_up/pagine");			
			
			$ordine = $oggetto_admin->trova_ordine('fotogallery_pagine','pagina',$pagina);
			$query_ins_file = "insert into fotogallery_pagine (foto, ordine, pagina) values ('$nome_file','$ordine','$pagina')";
			//echo $query_ins_file."<br/>";
			$risu_ins_file = $open_connection->connection->query($query_ins_file);
		}
	}
?>
	<script language="javascript">
		window.location = "admin.php?cmd=fotogallery_pagine<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{

?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Foto della pagina <b><?php echo $titolo_pagina;?></b><!-- (Dim. img 1920 x 1280 pixel)--></div>
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=fotogallery_pagine<?php  echo $rif; ?>" style="color:#7a7a7a">
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=fotogallery_pagine_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">			
			<div style="height:10px">&nbsp;</div>
			
			<?php /*<div id="uploader">
				<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
			</div>*/?>
			
			<?php $oggetto_admin->campo_ins("Foto<br />", "foto" , "42", 'no');	?>
			
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
