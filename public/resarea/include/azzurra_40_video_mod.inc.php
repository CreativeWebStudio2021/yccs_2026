<?php 
$table="azzurra_40_video";
$rif="";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_video = $arr_rec['video'];
$n_tit = $arr_rec['titolo'];
$n_tit_eng = $arr_rec['titolo_eng'];
$n_anteprima = $arr_rec['anteprima'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=azzurra_40_video<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){		
		/*if (document.inserimento.titolo.value=="") alert('Titolo obbigatorio');	
			else*/ if (document.inserimento.video.value=="") alert('Codice Video Vimeo obbligatorio');
			/*else if (document.inserimento.testo.value=="") alert('Testo obbligatorio');*/
			else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	/*$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}*/
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=azzurra_40_video_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['anteprima']=400;
	
	$_POST['titolo']=str_replace('"',"''",$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"',"''",$_POST['titolo_eng']);
	
		
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/azzurra_40");
?>
	<script language="javascript">
		window.location='admin.php?cmd=azzurra_40_video<?php echo $rif;?>';
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
	<div style="height:50px;font-size:1.2em;padding-top:10px">Modifica Video Azzurra 40</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=azzurra_40_video<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco dei video</b>
			</div>
		</a>
		<div></div>
	</div>	
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=azzurra_40_video_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Codice Video Vimeo" , "video" , "$n_video"  , "1", 'no', "$cmd", "$id_rec","","","","","1");
				$oggetto_admin->campo_mod("Titolo (Italiano)" , "titolo" , "$n_tit"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Titolo (Inglese)" , "titolo_eng" , "$n_tit_eng"  , "1", 'no', "$cmd", "$id_rec");
				//$oggetto_admin->campo_mod("Anteprima" , "anteprima" , "$n_anteprima"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/azzurra_40");
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
