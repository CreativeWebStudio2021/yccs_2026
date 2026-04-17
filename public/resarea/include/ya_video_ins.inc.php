<?php 
$table="ya_video";
$rif="";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=ya_video<?php  echo $rif; ?>';
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
		
if($stato=="inviato")
{
	$arr_no['stato']=1;
	
	$_POST['testo']=str_replace('"',"'",$_POST['testo']);
	$_POST['testo_eng']=str_replace('"',"'",$_POST['testo_eng']);
	$_POST['titolo']=str_replace('"',"'",$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"',"'",$_POST['titolo_eng']);
	
	if(!isset($_POST['video'])) $_POST['video']="";
	
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
	
	$oggetto_admin->inserisci_campi ("ya_video" , $arr_no ,  $arr_thumb="no");
?>
	<script language="javascript">
		window.location = "admin.php?cmd=ya_video<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
?>

<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Video Young Azzurra</div>
	
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=ya_video_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<?php 
			$ord_ev = $oggetto_admin->trova_ordine2("$table");
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';
			?>
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_ins("Titolo (Italiano)*" , "titolo" , "1", 'no');
				$oggetto_admin->campo_ins("Titolo (Inglese)" , "titolo_eng" , "1", 'no');
				?>				
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Italiano)*</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo"></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_eng"></textarea>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Link video su YouTube **" , "video" , "2", 'no');
				//$oggetto_admin->campo_ins("Link video su YouTube (Inglese)" , "video_eng" , "2", 'no');
				$oggetto_admin->campo_ins("Link video su Facebook <br />(https://www.facebook.com<br/>/watch/?v=xxxxxxxx)**", "video_fb" , "1", 'no');	
				//$oggetto_admin->campo_ins("Link video su Facebook (Inglese)<br />", "video_fb_eng" , "1", 'no');	
				?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
				<div style="margin-left:20px; padding-bottom:10px;">** <i>almeno uno dei campi obbligatori</i></div>	
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
