<?php 
$table="lista";
$rif="";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();


$n_file = $arr_rec['pdf'];
$n_file_eng = $arr_rec['pdf_eng'];
$n_link = $arr_rec['link'];
$n_link_eng = $arr_rec['link_eng'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=lista<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.link_eng.value=="" && document.inserimento.link.value=="") alert('Inserire Testo (inglese)');
		//else if (document.inserimento.pdf_eng.value=="") alert('Inserire Allegato (inglese)');
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
		window.location='admin.php?cmd=lista_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
					
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb="no", "", "files");
?>
	<script language="javascript">
		window.location='admin.php?cmd=lista<?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Documento</b></div>
	
	<div style="display:flex; justify-content:space-between;">
	<a href="admin.php?cmd=lista<?php echo $rif;?>" style="color:#7a7a7a">
		<div class="newAdminBott2">
			<i class="fa fa-caret-left" aria-hidden="true"></i>
			&nbsp;
			<b>Torna all'elenco dei documenti</b>
		</div>
	</a>
	<div></div>
</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=lista_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Testo (Inglese)*" , "link_eng" , "$n_link_eng"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Testo (Italiano)" , "link" , "$n_link"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Allegato (Inglese)*" , "pdf_eng" , "$n_file_eng"  , "5", 'no', "$cmd", "$id_rec", "", "", "", "files");
				$oggetto_admin->campo_mod("Allegato (Italiano)" , "pdf" , "$n_file"  , "5", 'no', "$cmd", "$id_rec", "", "", "", "files");
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
