<?php 
$table="sail_talk_macrocategorie";

$rif="";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.nome.value=="") alert('Nome obbigatorio');
		/*else if (document.inserimento.img.value=="") alert('Immagine obbigatoria');*/
		else document.inserimento.submit();
	}
</script>
<?php 
if($stato=="inviato")
{
	$arr_no['stato']=1;
	//$arr_thumb['img']=400;
	
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);
	$_POST['nome'] = str_replace("è", "&egrave;", $_POST['nome']);
	$_POST['nome'] = str_replace("é", "&eacute;", $_POST['nome']);
	$_POST['nome'] = str_replace("à", "&agrave;", $_POST['nome']);
	$_POST['nome'] = str_replace("ì", "&igrave;", $_POST['nome']);
	$_POST['nome'] = str_replace("ò", "&ograve;", $_POST['nome']);
	$_POST['nome'] = str_replace("ù", "&ugrave;", $_POST['nome']);	
	
	$_POST['nome_eng']=str_replace('"','\"',$_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("è", "&egrave;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("é", "&eacute;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("à", "&agrave;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("ì", "&igrave;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("ò", "&ograve;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("ù", "&ugrave;", $_POST['nome_eng']);	
	
	/*$_POST['descr']=str_replace('"','\"',$_POST['descr']);*/
		
	$oggetto_admin->inserisci_campi ("$table" , $arr_no ,  "", "img_up/sail_talk");
	
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci argomento Sail Talk</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco degli articoli</b>
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
				$oggetto_admin->campo_ins("Nome *" , "nome" , "1", 'no');
				$oggetto_admin->campo_ins("Nome (eng)" , "nome_eng" , "1", 'no');
	?>
				<!--<div class="mws-form-row">
					<label class="mws-form-label">Descrizione</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descr"></textarea>
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
<?php 
}
?>
