<?php 
$table="ya_testo_home";
$rif="";

$query="SELECT * FROM $table WHERE id='1'";
$resu=$open_connection->connection->query($query);
$num=$resu->rowCount();
$risu=$resu->fetch();

$n_testo = $risu['testo'];
$n_testo_eng = $risu['testo_eng'];
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php  echo $rif; ?>';
	}
</script>

<?php 
if($campocanc!="")
{		
	$query_canc_img = "update $table set $campocanc=NULL where id='1'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $table;?>';
	</script>	
<?php 
}
		
if($stato=="inviato")
{
	$_POST['testo']=str_replace('"',"'",$_POST['testo']);
	$_POST['testo_eng']=str_replace('"',"'",$_POST['testo_eng']);

	$arr_no['stato']=1;
	$oggetto_admin->modifica_campi ("$table" ,"1" , $arr_no );	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=<?php echo $table;?><?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{

?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Testo Home Young Azzurra</div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=ya_testo_home<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">					
			<div style="height:10px">&nbsp;</div>
		
			
			<div class="mws-form-row">
				<label class="mws-form-label">Testo (Italiano)</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo"><?php  echo $risu['testo']; ?></textarea>
					<a href="admin.php?cmd=ya_testo_home&campocanc=testo<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="mws-form-row">
				<label class="mws-form-label">Testo (Inglese)</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo_eng"><?php  echo $risu['testo_eng']; ?></textarea>
					<a href="admin.php?cmd=ya_testo_home&campocanc=testo_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>
			</div>
			
			
			<div class="mws-button-row">
				<input type="submit" value="Modifica" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
