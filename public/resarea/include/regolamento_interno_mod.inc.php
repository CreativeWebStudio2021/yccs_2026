<?php 
$table="regolamento_interno";
$rif="";
$id_rec=1;

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();


$n_file = $arr_rec['pdf'];
$n_file_eng = $arr_rec['pdf_eng'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=regolamento_interno_mod<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.pdf.value=="") alert('Inserire Allegato (italiano)');
		else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("files/$cancimg")){unlink("files/$cancimg");}
		
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=regolamento_interno_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
					
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb="no", "", "files/comunicati-ai-soci");
?>
	<script language="javascript">
		window.location='admin.php?cmd=regolamento_interno_mod<?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:30px;font-size:1.2em;padding-top:10px"><b>Modifica Regolamento Interno</b></div>
	<div style="height:30px;text-align:right"><!--<a style="color:#000" href="admin.php?cmd=edizioni<?php echo $rif;?>"><< Torna all'elenco delle edizioni</a>--></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=regolamento_interno_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Allegato (Italiano)*" , "pdf" , "$n_file"  , "5", 'no', "$cmd", "$id_rec", "", "", "", "files/comunicati-ai-soci");
				$oggetto_admin->campo_mod("Allegato (Inglese)" , "pdf_eng" , "$n_file_eng"  , "5", 'no', "$cmd", "$id_rec", "", "", "", "files/comunicati-ai-soci");
				?>				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
				<div style="margin-left:20px; padding-bottom:10px;"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
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
