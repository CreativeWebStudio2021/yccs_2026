<?php 	
$table="members_eventi";

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
		if (document.gino.tipo.value=="") alert('Tipo obbigatorio');
		else if (document.gino.testo_gruppo_eng.value=="" && document.gino.testo_gruppo.value=="") alert('Nome Evento obbigatorio');			
		else if (document.gino.socio.value=="") alert('Socio Partecipante obbigatorio');			
		else document.gino.submit();		
	}
</script>
<?php 
if($stato=="inviato"){

	$arr_no['stato']=1;	
	
	$_POST['testo_gruppo']=str_replace('"','\"',$_POST['testo_gruppo']);
	$_POST['testo_gruppo_eng']=str_replace('"','\"',$_POST['testo_gruppo_eng']);
	$_POST['socio']=str_replace('"','\"',$_POST['socio']);
	print_r($_POST);
	
	if (isset($_POST['data'])) $_POST['data'] = $oggetto_admin->date_to_data($_POST['data']);
		else $data = "";
	if (isset($_POST['data_al'])) $_POST['data_al'] = $oggetto_admin->date_to_data($_POST['data_al']);
		else $data_al = "";
	echo $_POST['data']."@@@@";
	echo $_POST['data_al']."@@@@";
	$oggetto_admin->inserisci_campi ("$table" , $arr_no);
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Evento</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=members_eventi<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco degli eventi</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine("$table");
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<input type="hidden" name="tipo" value="gruppo_link">
			
				<div id="box_tipo_gruppo_link">
					<?php 
						$oggetto_admin->campo_ins("Nome Evento (Inglese) **", "testo_gruppo_eng" , "1", 'no');
						$oggetto_admin->campo_ins("Nome Evento (Italiano) **", "testo_gruppo" , "1", 'no');	
						$oggetto_admin->campo_ins("Socio Partecipante *", "socio" , "1", 'no');	
					?>
					<div class="mws-form-inline">
						<div class="mws-form-row">
							<label class="mws-form-label">Dal</label>
							<div class="mws-form-item">
								<input type="text" name="data" class="mws-datepicker large"  value="" readonly="readonly" style="width:20%">
							</div>
						</div>
					</div>
					<div class="mws-form-inline">
						<div class="mws-form-row">
							<label class="mws-form-label">Al</label>
							<div class="mws-form-item">
								<input type="text" name="data_al" class="mws-datepicker large"  value="" readonly="readonly" style="width:20%">
							</div>
						</div>
					</div>
					<?php 
					$oggetto_admin->campo_ins("Luogo", "luogo" , "1", 'no');	
					?>
					<br/><br/>
					<div style="margin-left:25px;"><i>I link verranno inseriti in un secondo momento. Fare quindi "inserisci" dopo aver inserito i dati richiesti</i></div>
				</div>

			
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;">** <i>compilare almeno uno di questi campi</i></div>

				<div class="mws-button-row">
					<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
					<input type="button" value="Annulla" class="btn" onclick="annulla()">
				</div>
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
