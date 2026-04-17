<?php 
$table="ya_slide";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_riga1 = $arr_rec['riga1'];
$n_riga2 = $arr_rec['riga2'];
$n_riga3 = $arr_rec['riga3'];
$n_img = $arr_rec['img'];
$n_video = $arr_rec['video'];
$n_link = $arr_rec['link'];

?>

<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		<?php if(!$n_img || $n_img==""){?>
			if (document.inserimento.img.value=="") alert('Immagine obbigatoria');	
				else document.inserimento.submit();
		<?php }?>
		document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/ya_slide/$cancimg")){unlink("img_up/ya_slide/$cancimg");}
	if(is_file("img_up/ya_slide/s_$cancimg")){unlink("img_up/ya_slide/s_$cancimg");}
	if(is_file("files/ya_slide/$cancimg")){unlink("files/ya_slide/$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=ya_slide_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['img']=150;
	
	$_POST['riga1']=str_replace('"','\"',$_POST['riga1']);
	$_POST['riga2']=str_replace('"','\"',$_POST['riga2']);
	$_POST['riga3']=str_replace('"','\"',$_POST['riga3']);

	$oggetto_admin->modifica_campi("$table" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/ya_slide", "files/ya_slide");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica slide Young Azzurra</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=ya_slide<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle slide</b>
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
				$oggetto_admin->campo_mod("Foto *<br /><i>(Dim. 1920x1080 pixel)</i>" , "img" , "$n_img"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/ya_slide");
				$oggetto_admin->campo_mod("Video<br /><i>(formato mp4, max 30Mb)</i>" , "video" , "$n_video"  , "5", 'no', "$cmd", "$id_rec", "", "", "files/ya_slide");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Didascalia - Riga 1</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="riga1" value="<?php  echo $n_riga1; ?>"/>
						<a href="admin.php?cmd=ya_slide_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=riga1<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Didascalia - Riga 2</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="riga2" value="<?php  echo $n_riga2; ?>"/>
						<a href="admin.php?cmd=ya_slide_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=riga2<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Didascalia - Riga 3</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="riga3" value="<?php  echo $n_riga3; ?>"/>
						<a href="admin.php?cmd=ya_slide_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=riga3<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Link<br /><i>(a partire da http://...)</i></label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="link" value="<?php  echo $n_link; ?>"/>
						<a href="admin.php?cmd=ya_slide_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<!--<div class="mws-form-row">
					<label class="mws-form-label">Didascalia<br /><i>(Max. 40 caratteri)</i></label>
					<div class="mws-form-item">
						<input type="text" name="titolo" class="medium" maxlength="40" value="<?php  echo $n_tit; ?>"/>
					</div>
				</div>-->
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
<script language="javascript">
function MaxCaratteri(Object, MaxLen)
{
    return (Object.value.length <= MaxLen);
}
</script>
<?php 
}
?>
