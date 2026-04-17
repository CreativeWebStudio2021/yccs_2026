<?php 
$table="documenti_edizioni";
$rif="";

if(isset($_GET['tipo_ric'])) $tipo_ric=$_GET['tipo_ric']; else $tipo_ric='';
if($tipo_ric!="") $rif.="&tipo_ric=$tipo_ric";

if(isset($_GET['anno_ric'])) $anno_ric=$_GET['anno_ric']; else $anno_ric='';
if($anno_ric!="") $rif.="&anno_ric=$anno_ric";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_tipo = $arr_rec['tipo'];
$n_anno = $arr_rec['anno'];
$n_file = $arr_rec['pdf'];
$n_file_eng = $arr_rec['pdf_eng'];
$n_link = $arr_rec['link'];
$n_link_eng = $arr_rec['link_eng'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=calendari<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		var file_old = "<?php  echo $n_file; ?>";
		
		if (document.inserimento.tipo.value=="") alert('Tipo obbigatorio');	
			else if (document.inserimento.anno.value=="") alert('Anno obbligatorio');
			else if (document.inserimento.pdf.value=="" && file_old=="" && document.inserimento.link.value=="") alert('Compilare uno di questi campi: Allegato o Link');
			else if ((document.inserimento.pdf.value!="" || file_old!="") && document.inserimento.link.value!="") alert('Compilare SOLO uno di questi campi: Allegato o Link');
			else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("files/edizioni/$cancimg")){unlink("files/edizioni/$cancimg");}
		
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=calendari_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
					
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb="no", "", "files/edizioni");
?>
	<script language="javascript">
		window.location='admin.php?cmd=calendari<?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Documento</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=calendari<?php echo $rif;?>" style="color:#7a7a7a">
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=calendari_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Tipo *</label>
					<div class="mws-form-item">
						<select name="tipo" class="small">
							<option value="">Seleziona</option>
							<option value="calendario" <?php  if ($n_tipo=="calendario") echo "selected=\"selected\""; ?>>Calendario regate</option>
							<option value="calendario_team" <?php  if ($n_tipo=="calendario_team") echo "selected=\"selected\""; ?>>Calendario team reacing</option>
							<option value="presentazione" <?php  if ($n_tipo=="presentazione") echo "selected=\"selected\""; ?>>Presentazione stagione</option>				
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
								<option value="<?php echo $a;?>" <?php  if ($n_anno==$a) echo "selected=\"selected\""; ?>><?php echo $a;?></option>
							<?php 
							}
							?>					
						</select>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Link (Italiano)**<br /><i>(a partire da http://...)</i></label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="link" value="<?php  echo $n_link; ?>"/>
						<a href="admin.php?cmd=calendari_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Link (Inglese)<br /><i>(a partire da http://...)</i></label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="link_eng" value="<?php  echo $n_link_eng; ?>"/>
						<a href="admin.php?cmd=calendari_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link_eng<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Allegato (Italiano)**" , "pdf" , "$n_file"  , "5", 'no', "$cmd", "$id_rec", "", "", "", "files/edizioni");
				$oggetto_admin->campo_mod("Allegato (Inglese)" , "pdf_eng" , "$n_file_eng"  , "5", 'no', "$cmd", "$id_rec", "", "", "", "files/edizioni");
				?>				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
				<div style="margin-left:20px; padding-bottom:10px;">** <i>compilare SOLO uno di questi campi</i></div>	
				<div style="margin-left:20px; padding-bottom:10px;">
					<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i> cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i>
				</div>
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
