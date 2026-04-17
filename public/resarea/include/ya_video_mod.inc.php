<?php 
$table="ya_video";
$rif="";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_tit = $arr_rec['titolo'];
$n_tit_eng = $arr_rec['titolo_eng'];
$n_video = $arr_rec['video'];
$n_video_eng = $arr_rec['video_eng'];
$n_video_fb = $arr_rec['video_fb'];
//$n_video_fb_eng = $arr_rec['video_fb_eng'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=ya_video<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.titolo.value=="") alert('Titolo obbigatorio');	
			else if (document.inserimento.video.value=="" && document.inserimento.video_fb.value=="") alert('Link video su YouTube o su Facebook obbigatorio');	
			else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
			
	$_POST['testo']=str_replace('"',"'",$_POST['testo']);
	$_POST['testo_eng']=str_replace('"',"'",$_POST['testo_eng']);
	$_POST['titolo']=str_replace('"',"'",$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"',"'",$_POST['titolo_eng']);
	
	if(isset($_POST['video_fb'])){
		$temp = explode('videos%2F',$_POST['video_fb']);
		if(count($temp)>1){
			$temp2 = explode('%2F',$temp[1]);
			$_POST['video_fb']=$temp2[0];
		}else{
			$temp = explode('v=',$_POST['video_fb']);
			if(isset($temp[1])) $_POST['video_fb']=$temp[1];
		}
	}
			
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb="no");
?>
	<script language="javascript">
		window.location='admin.php?cmd=ya_video<?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Modifica Video Young Azzurra</div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=ya_video<?php echo $rif;?>" style="color:#7a7a7a">
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Titolo (Italiano)*" , "titolo" , "$n_tit"  , "1", 'no', "$cmd", "$id_rec");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Titolo (Inglese)</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="titolo_eng" value="<?php  echo $n_tit_eng; ?>"/>
						<a href="admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=titolo_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
			
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Italiano)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo"><?php  echo $arr_rec['testo']; ?></textarea>
						<a href="admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_eng"><?php  echo $arr_rec['testo_eng']; ?></textarea>
						<a href="admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
					
				<div class="mws-form-row">
					<label class="mws-form-label">Link video su YouTube **</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="video" value="<?php  echo $n_video; ?>"/>
						<a href="admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=video<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<?php /*<div class="mws-form-row">
					<label class="mws-form-label">Link video su YouTube (Inglese)</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="video_eng" value="<?php  echo $n_video_eng; ?>"/>
						<a href="admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=video_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>*/?>
					
				<div class="mws-form-row">
					<label class="mws-form-label">Link video su Facebook <br />(https://www.facebook.com<br />/watch/?v=xxxxxxxx)**</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="video_fb" value="<?php  echo $n_video_fb; ?>"/>
						<a href="admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=video_fb<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<?php /*<div class="mws-form-row">
					<label class="mws-form-label">Link video su Facebook (Inglese)</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="video_fb_eng" value="<?php  echo $n_video_fb_eng; ?>"/>
						<a href="admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=video_fb_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>*/?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;">** <i>almeno uno dei campi obbligatori</i></div>	
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
