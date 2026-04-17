<?php 
$table="gallery";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=gallery<?php  echo $rif; ?>';
	}
</script>
<?php 
		
if($stato=="inviato")
{
	/*$arr_no['stato']=1;
	$oggetto_admin->inserisci_campi ("foto_auto" , $arr_no ,  $arr_thumb="no");*/
?>
	<script language="javascript">
		window.location = "admin.php?cmd=gallery<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Foto nella Gallery</b><!-- (Dim. img 1920 x 1280 pixel)--></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=gallery_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">			
			<div style="height:10px">&nbsp;</div>
			
			<div id="uploader">
				<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
			</div>
			
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
