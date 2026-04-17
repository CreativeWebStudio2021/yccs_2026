<?php 
$table="edizioni_foto";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";

if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if($id_riferimento!="") $rif.="&id_riferimento=$id_riferimento";

if($id_rife==""){
	$query_canc = "SELECT id_regata FROM edizioni_regate where id='$id_riferimento'";
	$risu_canc = $open_connection->connection->query($query_canc);
	list($id_rife) = $risu_canc->fetch();
}

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
	for($x=0; $x<count ($_FILES['foto']['name']); $x++){
		//echo "@".$_FILES['foto']['name'][$x]."<br/>";
		
		$nome_file = $_FILES['foto']['name'][$x];
		$temp_file = $_FILES['foto']['tmp_name'][$x];
		
		if ($nome_file) {		
			
			$nome_file =  $oggetto_admin->scrivi_img($nome_file , $temp_file, "img_up/regate/foto");
			
			list($larghezza_gr , $height, $type, $attr) = getimagesize($temp_file);
			if ($larghezza_gr>1920) $oggetto_admin->thumbjpg_new(1920,$temp_file,$nome_file,"img_up/regate/foto");
					
			$oggetto_admin->thumbjpg(220,$temp_file,$nome_file,"img_up/regate/foto/thumb","220_");
			$oggetto_admin->thumbjpg(325,$temp_file,$nome_file,"img_up/regate/foto/thumb","325_");
			$oggetto_admin->thumbjpg(400,$temp_file,$nome_file,"img_up/regate/foto/thumb","400_");
			$oggetto_admin->thumbjpg(710,$temp_file,$nome_file,"img_up/regate/foto/thumb","710_");
					
			$ord_file = $oggetto_admin->trova_ordine("$table","id_edizione","$id_riferimento");
			$query_ins_file = "insert into edizioni_foto (ordine, foto, id_regata, id_edizione) values ('$ord_file', '/resarea/img_up/regate/foto/$nome_file', '$id_rife', '$id_riferimento')";
			$risu_ins_file = $open_connection->connection->query($query_ins_file);
		}
	}
	/*
	$arr_no['stato']=1;
	$arr_thumb['foto']=400;
	$oggetto_admin->inserisci_campi ("edizioni_foto" , $arr_no ,  $arr_thumb, "img_up/regate/foto");
	$last_id=mysql_insert_id();
	$query="SELECT foto FROM edizioni_foto WHERE id='$last_id'";
	$resu=$open_connection->connection->query($query);
	$risu=$resu->fetch();
	$nome_foto="/resarea/img_up/regate/foto/".$risu['foto'];
	$query_up="UPDATE edizioni_foto SET foto='$nome_foto' WHERE id='$last_id'";
	$risu_up=$open_connection->connection->query($query_up);*/
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
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=foto<?php echo $rif;?>" style="color:#7a7a7a">
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=foto_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<?php 
			$ord = $oggetto_admin->trova_ordine("$table","id_edizione","$id_riferimento");
			echo "<input type=hidden name=ordine value=$ord>";	
			?>
			<input type="hidden" name="stato" value="inviato">	
			
			<input type="hidden" name="id_regata" value="<?php echo $id_rife;?>">						
			<input type="hidden" name="id_edizione" value="<?php echo $id_riferimento;?>">			
			
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
