<?php 
$table="edizioni_foto";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";

if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if($id_riferimento!="") $rif.="&id_riferimento=$id_riferimento";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=foto<?php  echo $rif; ?>';
	}
</script>
<?php 
		
if($stato=="inviato")
{
	/*$arr_no['stato']=1;
	$oggetto_admin->inserisci_campi ("foto_auto" , $arr_no ,  $arr_thumb="no");*/
?>
	<script language="javascript">
		window.location = "admin.php?cmd=foto<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
$nome_reg = "";
$query_reg = "select nome from regate where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
if ($risu_reg) list($nome_reg) = $risu_reg->fetch();

$anno_ed = "";
$query_ed = "select anno from edizioni_regate where id='$id_riferimento'";
$risu_ed = $open_connection->connection->query($query_ed);
if ($risu_ed) list($anno_ed) = $risu_ed->fetch();
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Foto della regata <b><?php  echo ucfirst($nome_reg); ?></b> - <b>Edizione <?php  echo $anno_ed; ?></b><!-- (Dim. img 1920 x 1280 pixel)--></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=foto_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
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
