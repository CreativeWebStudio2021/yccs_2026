<?php 
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['ric_anno'])) $ric_anno=$_GET['ric_anno']; else $ric_anno=date("Y");

$rif="";
$rif.="&ric_anno=$ric_anno";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=ya_team<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.gino.titolo.value=="") alert('Titolo obbigatorio');
		else if (document.gino.nome.value=="") alert('Nome obbigatorio');
		else if (document.gino.cognome.value=="") alert('Cognome obbigatorio');
		else document.gino.submit();
	}
</script>
<?php 
if($stato=="inviato"){

	$arr_no['stato']=1;
	$arr_no['data_mod']=1;
	$arr_thumb['foto']=400; 
	
	$_POST['titolo']=str_replace('"','\"',$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"','\"',$_POST['titolo_eng']);
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);
	$_POST['cognome']=str_replace('"','\"',$_POST['cognome']);
	
	$_POST['ordine'] = $oggetto_admin->trova_ordine("ya_team","anno",$_POST['anno']);	
		
	$oggetto_admin->inserisci_campi ("ya_team" , $arr_no ,  $arr_thumb, "img_up/ya_team");
	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=ya_team<?php echo $rif;?>" ;
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Atleti Young Azzurra</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=ya_team<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco degli atleti</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=ya_team_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">

			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Anno</label>
					<div class="mws-form-item">
						<select name="anno">
							<?php for($i="2020"; $i<=date("Y")+3; $i++){?>
								<option value="<?php echo $i;?>" <?php if($i==$ric_anno){?>selected="selected"<?php }?>><?php echo $i;?></option>
							<?php }?>
						</select>
					</div>
				</div>
			<?php 
				$oggetto_admin->campo_ins("Titolo (Italiano)*", "titolo" , "1", 'no');	
				$oggetto_admin->campo_ins("Titolo (Inglese)", "titolo_eng" , "1", 'no');
				$oggetto_admin->campo_ins("Nome*", "nome" , "1", 'no');	
				$oggetto_admin->campo_ins("Cognome*", "cognome" , "1", 'no');	
				$oggetto_admin->campo_ins("Foto", "foto" , "4", 'no');	
			?>
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (Italiano)*</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descrizione"></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descrizione_eng"></textarea>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Profilo Facebook", "facebook" , "1", 'no');	
				$oggetto_admin->campo_ins("Profilo Instagram", "instagram" , "1", 'no');	
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
