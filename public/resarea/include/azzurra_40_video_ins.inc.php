<?php 
$table="azzurra_40_video";
$rif="";

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=azzurra_40_video<?php  echo $rif; ?>';
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
		
if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['anteprima']=400;
	
	$_POST['titolo']=str_replace('"',"''",$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"',"''",$_POST['titolo_eng']);
	
	/* aggiungo una news con lo stesso contenuto della azzurra_40_video appena inserita */
	$_POST['ordine'] = $oggetto_admin->trova_ordine("azzurra_40_video");
	$oggetto_admin->inserisci_campi ($table , $arr_no ,  $arr_thumb, "img_up/azzurra_40");
	
	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=azzurra_40_video<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
?>

<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Video Azzurra 40</b></div>
	
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=azzurra_40_video_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_ins("Codice Video Vimeo" , "video" , "1", 'no');
				$oggetto_admin->campo_ins("Titolo (Italiano)" , "titolo" , "1", 'no');
				$oggetto_admin->campo_ins("Titolo (Inglese)" , "titolo_eng" , "1", 'no');				
				//$oggetto_admin->campo_ins("Anteprima" , "anteprima" , "4", 'no');
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

<div style="position:fixed; width:1100px; height:700px; background:#fff; top:50%; left:50%; display:none; border:solid 1px #808080; border-radius:2px; text-align:center;  margin-left:-550px; margin-top:-320px; z-index:0000000; box-shadow:5px 5px 5px #808080" id="box_img">
	<iframe src="" style="width:1100px; height:700px; margin-top:5px;" id="frame_img" frameborder=0 ></iframe>
	<div style="position:absolute; top:15px; right:25px; width:20px; height:20px; cursor:pointer; text-align:center;" onclick="document.getElementById('box_img').style.display='none';">
		<i class="fa fa-times-circle fa-2x"></i>		
	</div>
</div>
<?php 
}
?>
