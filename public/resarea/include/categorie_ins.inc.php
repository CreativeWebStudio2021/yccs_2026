<?php 
$table="categorie";
?>

<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.nome.value=="") alert('Nome obbigatorio');			
		else document.inserimento.submit();
	}
</script>
<?php 
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['img']="120" ; 
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);

	$oggetto_admin->inserisci_campi("$table" , $arr_no ,  $arr_thumb, "img_up/categorie");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci <?php echo $table;?></b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle categorie</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine("$table");
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
	<?php 
				$oggetto_admin->campo_ins("Nome (in Italiano)*" , "nome" , "1", 'no');
				$oggetto_admin->campo_ins("Nome (in Inglese)" , "nome_eng" , "1", 'no');
	?>
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
