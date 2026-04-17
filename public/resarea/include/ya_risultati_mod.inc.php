<?php 
$table="ya_risultati";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";


if(isset($_GET['anno'])) $anno=$_GET['anno']; else $anno="";
if($anno!="") $rif.="&anno=$anno";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_anno = $arr_rec['anno'];
$n_luogo = $arr_rec['luogo'];
$n_data_dal = $oggetto_admin->date_to_data($arr_rec['data_dal']);
$n_data_al = $oggetto_admin->date_to_data($arr_rec['data_al']);
$n_visibile = $arr_rec['visibile'];
$n_nome_evento = $arr_rec['nome_evento'];
$n_risultato = $arr_rec['risultato'];
$n_img = $arr_rec['img'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=ya_risultati<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		 if (document.inserimento.nome_evento.value=="") alert('Nome Evento obbigatorio');	
			else if (document.inserimento.data_dal_mod.value=="") alert('Data inizio Evento obbigatoria');	
			else if (document.inserimento.data_al_mod.value=="") alert('Data fine Evento obbigatoria');	
			else if (document.inserimento.risultato.value=="") alert('Risultato obbigatorio');	
			else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/ya_risultati/$cancimg")){unlink("img_up/ya_risultati/$cancimg");}
	if(is_file("img_up/ya_risultati/s_$cancimg")){unlink("img_up/ya_risultati/s_$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=ya_risultati_mod&id_rec=<?php echo $id_rec;?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['data_dal_mod']=1;
	$arr_no['data_al_mod']=1;
			
	$arr_thumb['img']=400;
		
	$_POST['luogo']=str_replace('"',"''",$_POST['luogo']);	
	$_POST['nome_evento']=str_replace('"','\"',$_POST['nome_evento']);
	$_POST['risultato']=str_replace('"','\"',$_POST['risultato']);
	
	if (isset($_POST['data_dal_mod'])) {
		$data_dal_mod = $oggetto_admin->date_to_data($_POST['data_dal_mod']);
		$_POST['anno']=substr($data_dal_mod,0,4);
	}else $data_dal_mod = "";
		
		
	if (isset($_POST['data_al_mod'])) $data_al_mod = $oggetto_admin->date_to_data($_POST['data_al_mod']);
		else $data_al_mod = "";	

	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/ya_risultati");
	
	if ($data_dal_mod!="") $open_connection->connection->query("update ya_risultati set data_dal='$data_dal_mod' where id='$id_rec'");
	if ($data_al_mod!="") $open_connection->connection->query("update ya_risultati set data_al='$data_al_mod' where id='$id_rec'");	
	
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
	<div style="height:50px;font-size:1.2em;padding-top:10px">Modifica Risultato</div>
	
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=ya_risultati_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Nome Evento *" , "nome_evento" , "$n_nome_evento"  , "1", 'no', "$cmd", "$id_rec");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Visibilità</label>
					<div class="mws-form-item">
						<input name="visibile" type="hidden" class="medium" value="<?php echo $n_visibile;?>">
						<span id="checkVisib" style="cursor:pointer;" onclick="changeVisib()">
						<?php if($n_visibile==0){?>
							<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>
						<?php }else{?>
							<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>
						<?php }?>
						</span>
					</div>
				</div>
				
				<script type="text/javascript">
					var cv=<?php echo $n_visibile;?>;
					function changeVisib(){
						if(cv==0){
							cv=1;
							document.getElementById('checkVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.visibile.value='1';
						}else{
							cv=0;
							document.getElementById('checkVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.visibile.value='0';
						}
					}	
				</script>
				<?php 
				$oggetto_admin->campo_mod("Immagine" , "img" , "$n_img"  , "4", 'no', "$cmd", "$id_rec","","","img_up/ya_risultati");
				$oggetto_admin->campo_mod("Luogo *" , "luogo" , "$n_luogo"  , "1", 'no', "$cmd", "$id_rec");
				?>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Dal *</label>
						<div class="mws-form-item">
							<input type="text" name="data_dal_mod" class="mws-datepicker large"  value="<?php echo $n_data_dal;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Al *</label>
						<div class="mws-form-item">
							<input type="text" name="data_al_mod" class="mws-datepicker large"  value="<?php echo $n_data_al;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Risultato" , "risultato" , "$n_risultato"  , "1", 'no', "$cmd", "$id_rec");
				?>
				
				
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
