<?php 
$query_rec = "select * from ya_team where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_tit = $arr_rec['titolo'];
$n_tit_eng = $arr_rec['titolo_eng'];
$n_nome = $arr_rec['nome'];
$n_cognome = $arr_rec['cognome'];
$n_foto = $arr_rec['foto'];
$n_descrizione = $arr_rec['descrizione'];
$n_descrizione_eng = $arr_rec['descrizione_eng'];
$n_facebook = $arr_rec['facebook'];
$n_instagram = $arr_rec['instagram'];
$n_anno = $arr_rec['anno'];

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
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
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from ya_team where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/ya_team/$cancimg")){unlink("img_up/ya_team/$cancimg");}
	if(is_file("img_up/ya_team/s_$cancimg")){unlink("img_up/ya_team/s_$cancimg");}
	
	$query_canc_img = "update ya_team set $campocanc='' where id='$id_rec'";
	//echo $query_canc_img;
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=ya_team_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['foto']=400; 
	
	$_POST['titolo']=str_replace('"','\"',$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"','\"',$_POST['titolo_eng']);
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);
	$_POST['cognome']=str_replace('"','\"',$_POST['cognome']);
	

	$oggetto_admin->modifica_campi ("ya_team" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/ya_team");
		
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Atleti Young Azzurra</b></div>
	
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
		<form name="gino" class="mws-form" action="admin.php?cmd=ya_team_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Anno</label>
					<div class="mws-form-item">
						<select name="anno">
							<?php for($i="2020"; $i<=date("Y")+3; $i++){?>
								<option value="<?php echo $i;?>" <?php if($i==$n_anno){?>selected="selected"<?php }?>><?php echo $i;?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Titolo (Italiano)*" , "titolo" , "$n_tit"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Titolo (Inglese) *" , "titolo_eng" , "$n_tit_eng"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Nome*" , "nome" , "$n_nome"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Cognome*" , "cognome" , "$n_cognome"  , "1", 'no', "$cmd", "$id_rec");			
				$oggetto_admin->campo_mod("Foto" , "foto" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/ya_team");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (Italiano)*</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descrizione"><?php  echo $n_descrizione; ?></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descrizione_eng"><?php  echo $n_descrizione_eng; ?></textarea>
						<a href="admin.php?cmd=ya_team_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=descrizione_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Profilo Facebook</label>
					<div class="mws-form-item">
						<input name="facebook" type="text" class="medium" value="<?php echo $n_facebook;?>" id="facebook">
						<a href="admin.php?cmd=ya_team_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=facebook<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Profilo Instagram</label>
					<div class="mws-form-item">
						<input name="instagram" type="text" class="medium" value="<?php echo $n_instagram;?>" id="instagram">
						
						<a href="admin.php?cmd=ya_team_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=instagram<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
