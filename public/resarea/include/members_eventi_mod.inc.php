<?php 
$table="members_eventi";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();


$n_testo_gruppo = $arr_rec['testo_gruppo'];
$n_testo_gruppo_eng = $arr_rec['testo_gruppo_eng'];
$n_tipo = $arr_rec['tipo'];
$n_socio = $arr_rec['socio'];
$n_luogo = $arr_rec['luogo'];

$n_data = $oggetto_admin->date_to_data($arr_rec['data']);
$n_data_al = $oggetto_admin->date_to_data($arr_rec['data_al']);

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
if($campocanc!="")
{
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;	
	$arr_no['data']=1;
	$arr_no['data_al']=1;
	
	if (isset($_POST['data'])) $data = $oggetto_admin->date_to_data($_POST['data']);
		else $data = "";
	if (isset($_POST['data_al'])) $data_al = $oggetto_admin->date_to_data($_POST['data_al']);
		else $data_al = "";
	
	$_POST['testo_gruppo']=str_replace('"','\"',$_POST['testo_gruppo']);
	$_POST['testo_gruppo_eng']=str_replace('"','\"',$_POST['testo_gruppo_eng']);
	$_POST['socio']=str_replace('"','\"',$_POST['socio']);
	$_POST['luogo']=str_replace('"','\"',$_POST['luogo']);

	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no);
	if ($data!="") $open_connection->connection->query("update $table set data='$data' where id='$id_rec'");
	if ($data_al!="") $open_connection->connection->query("update $table set data_al='$data_al' where id='$id_rec'");
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
	<div style="float:left; width:45%; height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Evento</b></div>	
	<div style="clear:both"></div>
	
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
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
			
			<input type="hidden" name="tipo" value="gruppo_link">
			
			<div id="box_tipo_gruppo_link">
				<div class="mws-form-row">
					<label class="mws-form-label">Nome Evento (Inglese)**</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_gruppo_eng" value="<?php  echo $n_testo_gruppo_eng; ?>"/>
						<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_gruppo_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Nome Evento (Italiano)**</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_gruppo" value="<?php  echo $n_testo_gruppo; ?>"/>
						<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_gruppo<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Socio Partecipante*</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="socio" value="<?php  echo $n_socio; ?>"/>
						<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=socio<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Dal *</label>
						<div class="mws-form-item">
							<input type="text" name="data" class="mws-datepicker large"  value="<?php echo $n_data;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Al *</label>
						<div class="mws-form-item">
							<input type="text" name="data_al" class="mws-datepicker large"  value="<?php echo $n_data_al;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Luogo</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="luogo" value="<?php  echo $n_luogo; ?>"/>
						<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=luogo<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div style="float:right; width:45%;  margin-left:25px;  margin-top:10px;  margin-bottom:10px"id="edizioni">
					
				</div>
				<div style="clear:both"></div>
			</div>
			
			
			<br/><br/>
			<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
			<div style="margin-left:20px; padding-bottom:10px;">** <i>compilare almeno uno di questi campi</i></div>
			
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
