<?php 
$table="rassegna";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_titolo_eng = $arr_rec['titolo_eng'];
$n_titolo = $arr_rec['titolo'];
//$n_foto = $arr_rec['foto'];
$n_data = $arr_rec['data'];

$rif="";
if(isset($_GET['nome_ric'])) $nome_ric=$_GET['nome_ric']; else $nome_ric='';
if($nome_ric!="") $rif.="&nome_ric=$nome_ric";
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";
?>

<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.titolo_eng.value=="") alert('Titolo (inglese) obbigatorio');
			/*else if (foto=="" && document.inserimento.logo.value=="") alert('Logo obbigatorio');*/
			else document.inserimento.submit();
	}
</script>
<?php 

if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$table/$cancimg")){unlink("img_up/$table/$cancimg");}
	if(is_file("img_up/$table/s_$cancimg")){unlink("img_up/$table/s_$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['data_giorni']=1;
	$arr_no['data_mesi']=1;
	$arr_no['data_anni']=1;
	//$arr_thumb['foto']=400;
	
	$_POST['data']=$_POST['data_anni']."-".$_POST['data_mesi']."-".$_POST['data_giorni'];	
	$_POST['anno']=$_POST['data_anni'];
	
	if(isset($_POST['titolo_eng'])) $_POST['titolo_eng']=str_replace('"','\"',$_POST['titolo_eng']);
	if(isset($_POST['titolo'])) $_POST['titolo']=str_replace('"','\"',$_POST['titolo']);

	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no );
?>
	<script language="javascript">
		window.location = "admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" ;
	</script>
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Conferenza Stampa</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna alla rassegna stampa</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
			<?php 
				$oggetto_admin->campo_mod("Data*" , "data" , "$n_data"  , "7", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Titolo (inglese)*" , "titolo_eng" , "$n_titolo_eng"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Titolo (italiano)" , "titolo" , "$n_titolo"  , "1", 'no', "$cmd", "$id_rec");
				//$oggetto_admin->campo_mod("Foto" , "foto" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/$table");
			?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
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
