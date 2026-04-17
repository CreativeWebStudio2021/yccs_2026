<?php 
$table="documenti_edizioni";
$rif="";

if(isset($_GET['tipo_ric'])) $tipo_ric=$_GET['tipo_ric']; else $tipo_ric='';
if($tipo_ric!="") $rif.="&tipo_ric=$tipo_ric";

if(isset($_GET['anno_ric'])) $anno_ric=$_GET['anno_ric']; else $anno_ric='';
if($anno_ric!="") $rif.="&anno_ric=$anno_ric";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=calendari<?php  echo $rif; ?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.tipo.value=="") alert('Tipo obbigatorio');	
			else if (document.inserimento.anno.value=="") alert('Anno obbligatorio');
			else if (document.inserimento.pdf.value=="" && document.inserimento.link.value=="") alert('Compilare uno di questi campi: Allegato o Link');
			else if (document.inserimento.pdf.value!="" && document.inserimento.link.value!="") alert('Compilare SOLO uno di questi campi: Allegato o Link');
			else document.inserimento.submit();
	}
</script>
<?php 
		
if($stato=="inviato")
{
	$arr_no['stato']=1;
		
	$oggetto_admin->inserisci_campi ("documenti_edizioni" , $arr_no ,  $arr_thumb="no", "", "files/edizioni");
?>
	<script language="javascript">
		window.location = "admin.php?cmd=calendari<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
?>

<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Documento</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=calendari<?php  echo $rif; ?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco dei documenti</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=calendari_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<?php 
			$ord_ev = $oggetto_admin->trova_ordine("$table");
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';
			?>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Tipo *</label>
					<div class="mws-form-item">
						<select name="tipo" class="small">
							<option value="">Seleziona</option>
							<option value="calendario">Calendario regate</option>
							<option value="calendario_team">Calendario team reacing</option>
							<option value="presentazione">Presentazione stagione</option>				
						</select>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Anno *</label>
					<div class="mws-form-item">
						<select name="anno" class="small">
							<option value="">Seleziona</option>
							<?php 
							$oggi = date('Y');
							for($a=1996; $a<=$oggi+1; $a++){
							?>
								<option value="<?php echo $a;?>"><?php echo $a;?></option>
							<?php 
							}
							?>					
						</select>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Link (Italiano)**<br /><i>(a partire da http://...)</i>" , "link" , "1", 'no');
				$oggetto_admin->campo_ins("Link (Inglese)<br /><i>(a partire da http://...)</i>" , "link_eng" , "1", 'no');
				$oggetto_admin->campo_ins("Allegato (Italiano)**" , "pdf" , "5", 'no');
				$oggetto_admin->campo_ins("Allegato (Inglese)" , "pdf_eng" , "5", 'no');
				?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
				<div style="margin-left:20px; padding-bottom:10px;">** <i>compilare SOLO uno di questi campi</i></div>	
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
