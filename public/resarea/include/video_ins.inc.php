<?php 
$table="edizioni_video";
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
		window.location='admin.php?cmd=video<?php  echo $rif; ?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.titolo.value=="") alert('Titolo obbigatorio');	
			else if (document.inserimento.video.value=="") alert('Codice video su YouTube obbigatorio');	
			else document.inserimento.submit();
	}
</script>
<?php 
		
if($stato=="inviato")
{
	$arr_no['stato']=1;
	
	$_POST['titolo']=str_replace('"',"''",$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"',"''",$_POST['titolo_eng']);
	
	$oggetto_admin->inserisci_campi ("edizioni_video" , $arr_no ,  $arr_thumb="no");
?>
	<script language="javascript">
		window.location = "admin.php?cmd=video<?php  echo $rif; ?>" ;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Video della regata <b><?php  echo ucfirst($nome_reg); ?></b> - <b>Edizione <?php  echo $anno_ed; ?></b><!-- (Dim. img 1920 x 1280 pixel)--></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=edizioni<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle edizioni</b>
			</div>
		</a>
		<div></div>
	</div>	
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=video_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<input type="hidden" name="id_regata" value="<?php echo $id_rife;?>">
			<input type="hidden" name="id_edizione" value="<?php echo $id_riferimento;?>">
			<?php 
			$ord_ev = $oggetto_admin->trova_ordine2("$table", "id_regata", $id_rife, "id_edizione", $id_riferimento);
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';
			?>
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_ins("Titolo (Italiano)*" , "titolo" , "1", 'no');
				$oggetto_admin->campo_ins("Titolo (Inglese)" , "titolo_eng" , "1", 'no');
				$oggetto_admin->campo_ins("Link video su YouTube (Italiano)*" , "video" , "2", 'no');
				$oggetto_admin->campo_ins("Link video su YouTube (Inglese)" , "video_eng" , "2", 'no');
				?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
			</div>
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
