<?php 
$table="ya_risultati";
$rif="";

	
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['anno'])) $anno=$_GET['anno']; else $anno="";

$rif.="&pag_att=$pag_att";
if($anno!="") $rif.="&anno=$anno";

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=ya_risultati<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){		
		 if (document.inserimento.nome_evento.value=="") alert('Nome Evento obbigatorio');	
			else if (document.inserimento.data_dal.value=="") alert('Data inizio Evento obbigatoria');	
			else if (document.inserimento.data_al.value=="") alert('Data fine Evento obbigatoria');	
			else if (document.inserimento.risultato.value=="") alert('Risultato obbigatorio');	
			else document.inserimento.submit();
	}
</script>
<?php 
if($stato=="inviato")
{
	$arr_no['stato']=1;
	//$arr_no['data_dal_mod']=1;
	//$arr_no['data_al_mod']=1;
	
	$arr_thumb['img']=400;
		
	$_POST['luogo']=str_replace('"',"''",$_POST['luogo']);	
	$_POST['nome_evento']=str_replace('"','\"',$_POST['nome_evento']);
	$_POST['risultato']=str_replace('"','\"',$_POST['risultato']);
	
	if (isset($_POST['data_dal'])) $_POST['data_dal'] = $oggetto_admin->date_to_data($_POST['data_dal']);
		else $_POST['data_dal'] = "";
		
	if (isset($_POST['data_al'])) $_POST['data_al'] = $oggetto_admin->date_to_data($_POST['data_al']);
		else $_POST['data_al'] = "";
					
	$_POST['anno']=substr($_POST['data_dal'],0,4);
					
	$oggetto_admin->inserisci_campi ("$table" , $arr_no ,  $arr_thumb, "img_up/ya_risultati");
	
?>
	<script language="javascript">
		window.location='admin.php?cmd=ya_risultati<?php echo $rif;?>';
	</script>
<?php 
}
else
{
$nome_reg = "";
$query_reg = "select nome_evento from ya_risultati where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
if ($risu_reg) list($nome_reg) = $risu_reg->fetch();
?>
<div class="mws-panel grid_8">
	<div style="height:30px;font-size:1.2em;padding-top:10px">Inserisci Risultato</div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=ya_risultati<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco dei risultati</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=ya_risultati_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<?php 
			?>
			<div class="mws-form-inline">
	<?php 
				//$oggetto_admin->campo_ins("Anno *" , "anno" , "6", $oggetto_admin->mega_anni);
				$oggetto_admin->campo_ins("Nome Evento *" , "nome_evento" , "1", 'no','',"$nome_reg");	
				$oggetto_admin->campo_ins("Immagine" , "img"  , "4", 'no');
				$oggetto_admin->campo_ins("Luogo *" , "luogo" , "1", 'no');			
	?>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Dal *</label>
						<div class="mws-form-item">
							<input type="text" name="data_dal" class="mws-datepicker large"  value="" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Al *</label>
						<div class="mws-form-item">
							<input type="text" name="data_al" class="mws-datepicker large"  value="" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<?php $oggetto_admin->campo_ins("Risultato *" , "risultato" , "1", 'no');	?>
				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
		<!--<script type="text/javascript">
			function calcola_prezzo(){
				var pu = document.inserimento.prezzo_listino.value;
				var sc = document.inserimento.sconto.value;
				var ps = pu - (pu*(sc/100));
				document.inserimento.prezzo.value = ps;
			}	
		</script>-->	
	</div>
</div>
<?php 
}
?>
