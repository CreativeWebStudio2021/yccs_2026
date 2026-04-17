<?php 
$table="ya_slide";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
?>

<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.img.value=="") alert('Immagine obbigatoria');	
		else document.inserimento.submit();
	}
</script>
<?php 
if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['img']=150;
	
	$_POST['riga1']=str_replace('"','\"',$_POST['riga1']);
	$_POST['riga2']=str_replace('"','\"',$_POST['riga2']);
	$_POST['riga3']=str_replace('"','\"',$_POST['riga3']);

	$oggetto_admin->inserisci_campi("$table" , $arr_no ,  $arr_thumb, "img_up/ya_slide", "files/ya_slide");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci ya_slide Young Azzurra</b></div>
	
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine("$table");
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
	<?php 
				$oggetto_admin->campo_ins("Foto *<br /><i>(Dim. 1920x1080 pixel)</i>" , "img" , "4", 'no');
				$oggetto_admin->campo_ins("Video<br /><i>(formato mp4, max 30Mb)</i>" , "video" , "5", 'no');
				$oggetto_admin->campo_ins("Didascalia - Riga 1" , "riga1" , "1", 'no');
				$oggetto_admin->campo_ins("Didascalia - Riga 2" , "riga2" , "1", 'no');
				$oggetto_admin->campo_ins("Didascalia - Riga 3" , "riga3" , "1", 'no');
				$oggetto_admin->campo_ins("Link<br /><i>(a partire da http://...)</i>" , "link" , "1", 'no');
	?>
				<!--<div class="mws-form-row">
					<label class="mws-form-label">Didascalia<br /><i>(Max. 40 caratteri)</i></label>
					<div class="mws-form-item">
						<input type="text" name="titolo" class="medium" maxlength="40"/>
					</div>
				</div>-->
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
<script language="javascript">
function MaxCaratteri(Object, MaxLen)
{
    return (Object.value.length <= MaxLen);
}
</script>
<?php 
}
?>
