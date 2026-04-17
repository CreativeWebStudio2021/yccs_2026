<?php 
$table="comunicazioni_ai_soci";
$rif="";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php  echo $rif; ?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.testo_link.value=="") alert('Titolo obbigatorio');	
		else if (document.inserimento.file.value=="") alert('Allegato obbigatorio');
		else document.inserimento.submit();
	}
</script>
<?php 
		
if($stato=="inviato")
{
	$arr_no['stato']=1;
	
	$_POST['testo_link']=str_replace('"',"''",$_POST['testo_link']);
	$_POST['testo_link_eng']=str_replace('"',"''",$_POST['testo_link_eng']);
	
	$oggetto_admin->inserisci_campi ("$table" , $arr_no ,  $arr_thumb="no", "", "files/comunicati-ai-soci");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Comunicazione ai Soci</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle comunicazioni</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<?php 
			$ord_ev = $oggetto_admin->trova_ordine("$table");
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';
			?>
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_ins("Titolo (Italiano)*" , "testo_link" , "1", 'no');
				$oggetto_admin->campo_ins("Titolo (Inglese)" , "testo_link_eng" , "1", 'no');
				$oggetto_admin->campo_ins("Allegato (Italiano)*" , "file" , "5", 'no');
				$oggetto_admin->campo_ins("Allegato (Inglese)" , "file_eng" , "5", 'no');
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Sfogliabile</label>
					<div class="mws-form-item">
						<input name="sfogliabile" type="hidden" class="medium" value="0">
						<span id="checkSfogliabile" style="cursor:pointer;" onclick="changesSfogliabile()">
						<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>
						</span>
					</div>
				</div>
				
				<script type="text/javascript">
					var sf=0;
					function changesSfogliabile(){
						if(sf==0){
							sf=1;
							document.getElementById('checkSfogliabile').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.sfogliabile.value='1';
						}else{
							sf=0;
							document.getElementById('checkSfogliabile').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.sfogliabile.value='0';
						}
					}	
				</script>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
				<?php /*<div style="margin-left:20px; padding-bottom:10px;">** <i>compilare SOLO uno di questi campi</i></div>	*/?>
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
