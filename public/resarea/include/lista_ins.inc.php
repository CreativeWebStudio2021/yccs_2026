<?php 
$table="lista";
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
		window.location='admin.php?cmd=lista<?php  echo $rif; ?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.link_eng.value=="" && document.inserimento.link.value=="") alert('Inserire Testo (inglese)');
		else if (document.inserimento.pdf_eng.value=="") alert('Inserire Allegato (inglese)');
		else document.inserimento.submit();
	}
</script>
<?php 
		
if($stato=="inviato")
{
	$arr_no['stato']=1;
		
	$oggetto_admin->inserisci_campi ("lista" , $arr_no ,  $arr_thumb="no", "");
?>
	<script language="javascript">
		window.location = "admin.php?cmd=lista<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
?>

<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Documento</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=lista_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<?php 
			//$ord_ev = $oggetto_admin->trova_ordine("$table");
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';
			?>
				<?php 
				$oggetto_admin->campo_ins("Testo (Inglese)*<br /><i>(a partire da http://...)</i>" , "link_eng" , "1", 'no');
				$oggetto_admin->campo_ins("Testo (Italiano)<br /><i>(a partire da http://...)</i>" , "link" , "1", 'no');
				$oggetto_admin->campo_ins("Allegato (Inglese)*" , "pdf_eng" , "5", 'no');
				$oggetto_admin->campo_ins("Allegato (Italiano)" , "pdf" , "5", 'no');
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
