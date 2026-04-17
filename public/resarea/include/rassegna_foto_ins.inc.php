<?php 
$table="rassegna_foto";
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
		window.location='admin.php?cmd=rassegna_foto<?php  echo $rif; ?>';
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
			
			$nome_file =  $oggetto_admin->scrivi_img($nome_file , $temp_file, "img_up/rassegna/foto");
			
			list($larghezza_gr , $height, $type, $attr) = getimagesize($temp_file);
			if ($larghezza_gr>1920) $oggetto_admin->thumbjpg_new(1920,$temp_file,$nome_file,"img_up/rassegna/foto");
					
			$oggetto_admin->thumbjpg(400,$temp_file,$nome_file,"img_up/rassegna/foto","s_");
					
			$ord_file = $oggetto_admin->trova_ordine("$table","id_rassegna","$id_rife");
			$query_ins_file = "insert into rassegna_foto (ordine, foto, id_rassegna) values ('$ord_file', '$nome_file', '$id_rife')";
			//echo $query_ins_file."<br/>";
			$risu_ins_file = $open_connection->connection->query($query_ins_file);
		}
	}
	/*
	$arr_no['stato']=1;
	$arr_thumb['foto']=400;
	$oggetto_admin->inserisci_campi ("rassegna_foto" , $arr_no ,  $arr_thumb, "img_up/rassegna/foto");
	$last_id=mysql_insert_id();
	$query="SELECT foto FROM rassegna_foto WHERE id='$last_id'";
	$resu=$open_connection->connection->query($query);
	$risu=$resu->fetch();
	$nome_foto="/resarea/img_up/rassegna/foto/".$risu['foto'];
	$query_up="UPDATE rassegna_foto SET rassegna_foto='$nome_foto' WHERE id='$last_id'";
	$risu_up=$open_connection->connection->query($query_up);*/
?>
	<script language="javascript">
		window.location = "admin.php?cmd=rassegna_foto<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
$nome_reg = "";
$query_reg = "select titolo from rassegna where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
if ($risu_reg) list($nome_reg) = $risu_reg->fetch();
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Foto della conferenza stampa <b><?php  echo ucfirst($nome_reg); ?></b><!-- (Dim. img 1920 x 1280 pixel)--></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=rassegna_foto<?php echo $rif;?>" style="color:#7a7a7a">
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=rassegna_foto_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<?php 
			$ord = $oggetto_admin->trova_ordine("$table","id_rassegna","$id_rife");
			//echo $ord;
			echo "<input type=hidden name=ordine value=$ord>";	
			?>
			<input type="hidden" name="stato" value="inviato">	
			
			<input type="hidden" name="id_rassegna" value="<?php echo $id_rife;?>">					
			
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
