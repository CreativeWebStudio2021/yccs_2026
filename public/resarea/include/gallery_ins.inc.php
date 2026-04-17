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
{/**/
	$arr_no['stato']=1;
	$arr_thumb['img']=400;
	$oggetto_admin->inserisci_campi ("gallery" , $arr_no ,  $arr_thumb, "img_up/gallery");
	
	$last_id=$open_connection->connection->lastInsertId();
	$query_f="SELECT img FROM gallery WHERE id='$last_id'";
	$resu_f=$open_connection->connection->query($query_f);
	list($nome_f)=$resu_f->fetch();
	$oggetto_admin->thumbjpg( "300" ,  "img_up/gallery/".$nome_f ,$nome_f, $dir_imm="img_up/gallery", $start="xs_" );
	$oggetto_admin->thumbjpg( "600" ,  "img_up/gallery/".$nome_f ,$nome_f, $dir_imm="img_up/gallery", $start="m_" );
	$oggetto_admin->thumbjpg( "800" ,  "img_up/gallery/".$nome_f ,$nome_f, $dir_imm="img_up/gallery", $start="l_" );
	$oggetto_admin->thumbjpg( "1200" ,  "img_up/gallery/".$nome_f ,$nome_f, $dir_imm="img_up/gallery", $start="xl_" );
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
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=gallery<?php echo $rif;?>" style="color:#7a7a7a">
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
		<form name="gino" class="mws-form" action="admin.php?cmd=gallery_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<?php /**/$ord = $oggetto_admin->trova_ordine("$table");
			echo "<input type=hidden name=ordine value=$ord>";	?>
			<input type="hidden" name="stato" value="inviato">			
			<div style="height:10px">&nbsp;</div>
			
			<?php /*<div id="uploader">
				<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
			</div>*/?>
			
			<?php $oggetto_admin->campo_ins("Foto<br />", "img" , "4", 'no');	?>
			
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
