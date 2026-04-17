<?php 
$table="rassegna";
$rif="";

if(isset($_GET['nome_ric'])) $nome_ric=$_GET['nome_ric']; else $nome_ric='';
if($nome_ric!="") {
	$rif.="&nome_ric=$nome_ric";
}
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
			/*else if (document.inserimento.logo.value=="") alert('Logo obbigatorio');*/
			else document.inserimento.submit();
	}
</script>
<?php 
if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['data_giorni']=1;
	$arr_no['data_mesi']=1;
	$arr_no['data_anni']=1;

	$_POST['data']=$_POST['data_anni']."-".$_POST['data_mesi']."-".$_POST['data_giorni'];
	$_POST['anno']=$_POST['data_anni'];
	//$arr_thumb['foto']=400;
	
	if(isset($_POST['titolo_eng'])) $_POST['titolo_eng']=str_replace('"','\"',$_POST['titolo_eng']);
	if(isset($_POST['titolo'])) $_POST['titolo']=str_replace('"','\"',$_POST['titolo']);

	$oggetto_admin->inserisci_campi ("$table" , $arr_no );
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Rassegna Stampa</b></div>
	
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine("$table");
			echo "<input type=hidden name=ordine value=$ord>";
?>
			<div class="mws-form-inline">
	<?php 
				$oggetto_admin->campo_ins("Data*" , "data" , "7", 'no');
				$oggetto_admin->campo_ins("Titolo (inglese)*" , "titolo_eng" , "1", 'no');
				$oggetto_admin->campo_ins("Titolo (italiano)" , "titolo" , "1", 'no');
				//$oggetto_admin->campo_ins("Foto" , "foto" , "4", 'no');
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
