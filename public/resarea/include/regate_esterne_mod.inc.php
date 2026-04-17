<?php 
$query_rec = "select * from regate_esterne where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_testo = $arr_rec['testo'];
$n_luogo = $arr_rec['luogo'];
$n_link = $arr_rec['link'];
$n_data = $arr_rec['data'];
$n_testo_eng = $arr_rec['testo_eng'];
$n_luogo_eng = $arr_rec['luogo_eng'];
$n_link_eng = $arr_rec['link_eng'];
$n_data_eng = $arr_rec['data_eng'];

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=regate_esterne<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.gino.testo.value=="") alert('Titolo obbigatorio');
		/*else if (document.gino.data_mod.value=="") alert('Data obbigatoria');
		else if (document.gino.descrizione.value=="") alert('Testo obbigatorio');*/
		else document.gino.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from regate_esterne where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}
	
	$query_canc_img = "update regate_esterne set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=regate_esterne_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['data_mod']=1;
	/*$arr_no['data_regate_esterne_giorni']=1;
	$arr_no['data_regate_esterne_mesi']=1;
	$arr_no['data_regate_esterne_anni']=1;*/
	$arr_thumb['img']=150; 
	
	$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	$_POST['link']=str_replace('"','\"',$_POST['link']);
	$_POST['luogo']=str_replace('"','\"',$_POST['luogo']);
	$_POST['data']=str_replace('"','\"',$_POST['data']);
	

	$oggetto_admin->modifica_campi ("regate_esterne" ,$id_rec , $arr_no ,  $arr_thumb);
?>
	<script language="javascript">
		window.location = "admin.php?cmd=regate_esterne<?php echo $rif;?>" ;
	</script>
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Regata Interclub</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=regate_esterne<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle regate</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=regate_esterne_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Testo*" , "testo" , "$n_testo"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Testo Eng" , "testo_eng" , "$n_testo_eng"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Link" , "link" , "$n_link"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Link Eng" , "link_eng" , "$n_link_eng"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Luogo" , "luogo" , "$n_luogo"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Luogo Eng" , "luogo_eng" , "$n_luogo_eng"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Data" , "data" , "$n_data"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Data Eng" , "data_eng" , "$n_data_eng"  , "1", 'no', "$cmd", "$id_rec");
				?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;">
					<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i> cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i>
				</div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
