<?php 
$rif="";
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=newsletter<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		var tit = document.gino.oggetto.value;
						
		if (tit=="") alert('Oggetto obbigatorio');
						
		else document.gino.submit();
	}
</script>
<?php 						
if($stato=="inviato")
{	
	$arr_no['stato']=1;
	$arr_no['data_news_anni']=1;
	$arr_no['data_news_mesi']=1;
	$arr_no['data_news_giorni']=1;
	$arr_thumb['img']=120;
	
	$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	$_POST['oggetto']=str_replace('"','\"',$_POST['oggetto']);
	$oggetto_admin->inserisci_campi("newsletter", $arr_no, $arr_thumb);
?>
	<script language="javascript">				
		window.location = "admin.php?cmd=newsletter<?php echo $rif;?>";
	</script>
<?php 
}else{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Newsletter</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=newsletter_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine("newsletter");
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
<?php 
			$oggetto_admin->campo_ins("Data" , "data_news" , "7", 'no');
			$oggetto_admin->campo_ins("Oggetto *" , "oggetto" , "1", 'no');
			$oggetto_admin->campo_ins("Foto", "img" , "4", 'no');	
?>
				<div class="mws-form-row">	
					<label class="mws-form-label">Testo</label>
					<div class="mws-form-item">
						<textarea name="testo" class="ckeditor"></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Indirizzo email per il test</label>
					<div class="mws-form-item">
						<input name="email_test" type="text" class="medium" value="<?php  echo $mail_sito; ?>" id="email_test">
					</div>
				</div>
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
