<?php 
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=regate_esterne<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.gino.testo.value=="") alert('Testo obbigatorio');
		/*else if (document.gino.data_mod.value=="") alert('Data obbigatoria');
		else if (document.gino.descrizione.value=="") alert('Testo obbigatorio');*/
		else document.gino.submit();
	}
</script>
<?php 
if($stato=="inviato"){

	$arr_no['stato']=1;
	$arr_no['data_mod']=1;
	/*$arr_no['data_news_giorni']=1;
	$arr_no['data_news_mesi']=1;
	$arr_no['data_news_anni']=1;*/
	$arr_thumb['img']=150; 
	
	$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	$_POST['testo_eng']=str_replace('"','\"',$_POST['testo_eng']);
	
	if (isset($_POST['data_mod'])) $data_mod = $oggetto_admin->date_to_data($_POST['data_mod']);
		else $data_mod = "";
	
	$oggetto_admin->inserisci_campi ("regate_esterne" , $arr_no ,  $arr_thumb);
	
	$id_ultimo = $open_connection->connection->lastInsertId();
	if ($data_mod!="") $open_connection->connection->query("update regate_esterne set data_regate_esterne='$data_mod' where id='$id_ultimo'");
?>
	<script language="javascript">
		window.location = "admin.php?cmd=regate_esterne<?php echo $rif;?>" ;
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Regata Interclub</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=regate_esterne<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle regate</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=regate_esterne_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine("regate_esterne");
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
			<?php 
				$oggetto_admin->campo_ins("Testo*", "testo" , "1", 'no');	
				$oggetto_admin->campo_ins("Testo Eng", "testo_eng" , "1", 'no');	
				$oggetto_admin->campo_ins("Link (http://)", "link" , "1", 'no');	
				$oggetto_admin->campo_ins("Link Eng (http://)", "link_eng" , "1", 'no');	
				$oggetto_admin->campo_ins("Luogo", "luogo" , "1", 'no');	
				$oggetto_admin->campo_ins("Luogo Eng", "luogo_eng" , "1", 'no');	
				$oggetto_admin->campo_ins("Data", "data" , "1", 'no');					
				$oggetto_admin->campo_ins("Data Eng", "data_eng" , "1", 'no');					
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
<?php 
}
?>
