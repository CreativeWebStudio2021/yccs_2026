<?php 
$table="documentis";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=documentis<?php  echo $rif; ?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.testo_link_eng.value=="") alert('Titolo (Inglese) obbigatorio');	
			//else if (document.inserimento.file.value=="" && document.inserimento.link.value=="") alert('Compilare uno di questi campi: Allegato o Link');
			//else if (document.inserimento.file.value!="" && document.inserimento.link.value!="") alert('Compilare SOLO uno di questi campi: Allegato o Link');
			//else if (document.inserimento.tipo_link.value=="") alert('Tipo Link obbligatorio');
			else document.inserimento.submit();
	}
</script>
<?php 
		
if($stato=="inviato")
{
	$arr_no['stato']=1;
	
	$_POST['testo_link']=str_replace('"',"''",$_POST['testo_link']);
	$_POST['testo_link_eng']=str_replace('"',"''",$_POST['testo_link_eng']);
	
	$oggetto_admin->inserisci_campi ("documenti_stampa" , $arr_no ,  $arr_thumb="no", "", "files/stampa");
?>
	<script language="javascript">
		window.location = "admin.php?cmd=documentis<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
$nome_reg = "";
$query_reg = "select titolo from stampa where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
if ($risu_reg) list($nome_reg) = $risu_reg->fetch();
?>

<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Documento per l'articolo <b><?php  echo ucfirst($nome_reg); ?></b> in <b>Ufficio Stampa</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=documentis<?php echo $rif;?>" style="color:#7a7a7a">
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=documentis_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<input type="hidden" name="id_rife" value="<?php echo $id_rife;?>">
			<?php 
			$ord_ev = $oggetto_admin->trova_ordine("documenti_stampa", "id_rife", $id_rife);
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';
			?>
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_ins("Titolo (Inglese)*" , "testo_link_eng" , "1", 'no');
				$oggetto_admin->campo_ins("Titolo (Italiano)" , "testo_link" , "1", 'no');
				?>
				<div id="box_allegato">
					<?php 
					$oggetto_admin->campo_ins("Allegato PDF (Inglese)" , "pdf_eng" , "5", 'no');
					$oggetto_admin->campo_ins("Allegato PDF (Italiano)" , "pdf" , "5", 'no');
					?>
				</div>
				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
				<?php /*<div style="margin-left:20px; padding-bottom:10px;">** <i>compilare SOLO uno di questi campi</i></div>		*/?>
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
