<?php 
$table="rassegna_doc";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; 
else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";

if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if($id_riferimento!="") $rif.="&id_riferimento=$id_riferimento";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_tit = $arr_rec['testo_link'];
$n_tit_eng = $arr_rec['testo_link_eng'];
$n_file = $arr_rec['file'];
$n_file_eng = $arr_rec['file_eng'];
$n_link = $arr_rec['link'];
$n_link_eng = $arr_rec['link_eng'];
$n_tipo_link = $arr_rec['tipo_link'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=rassegna_doc<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		var file_old = "<?php  echo $n_file; ?>";
		
		if (document.inserimento.testo_link_eng.value=="") alert('Titolo (Inglese) obbigatorio');	
			//else if (document.inserimento.file.value=="" && file_old=="" && document.inserimento.link.value=="") alert('Compilare uno di questi campi: Allegato o Link');
			//else if ((document.inserimento.file.value!="" || file_old!="") && document.inserimento.link.value!="") alert('Compilare SOLO uno di questi campi: Allegato o Link');
			else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("files/rassegna/doc/$cancimg")){unlink("files/rassegna/doc/$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=rassegna_doc_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
			
			
	$_POST['testo_link']=str_replace('"',"''",$_POST['testo_link']);
	$_POST['testo_link_eng']=str_replace('"',"''",$_POST['testo_link_eng']);
			
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb="no", "", "files/rassegna/doc");		
?>
	<script language="javascript">
		window.location='admin.php?cmd=rassegna_doc<?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
$nome_reg = "";
$query_reg = "select titolo from rassegna where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
if ($risu_reg) list($nome_reg) = $risu_reg->fetch();

?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Modifica Documento della conferenza stampa <b><?php  echo ucfirst($nome_reg); ?></b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=rassegna_doc<?php echo $rif;?>" style="color:#7a7a7a">
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=rassegna_doc_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Titolo (Inglese)*</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_link_eng" value="<?php  echo $n_tit_eng; ?>"/>
						
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Titolo (Italiano)</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_link" value="<?php  echo $n_tit; ?>"/>
						<a href="admin.php?cmd=rassegna_doc_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_link<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Tipo Link</label>
					<div class="mws-form-item">
						<select name="tipo_link" class="small" onchange="vedi(this.value);">
							<option value="">Seleziona</option>
							<option value="link" <?php if($n_tipo_link=="link"){?>selected="selected"<?php }?>>Link</option>
							<option value="allegato" <?php if($n_tipo_link=="allegato"){?>selected="selected"<?php }?>>Allegato</option>				
						</select>
					</div>
				</div>
				
				<div id="box_link" style="display:<?php if($n_tipo_link=="link"){?>block<?php }else{?>none<?php }?>">
					<div class="mws-form-row">
						<label class="mws-form-label">Link (Inglese)</label>
						<div class="mws-form-item">
							<input type="text" class="medium" name="link_eng" value="<?php  echo $n_link_eng; ?>"/>
							<?php if($n_link_eng && $n_link_eng!=""){?><a href="admin.php?cmd=rassegna_doc_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a><?php }?>
						</div>
					</div>
					<div class="mws-form-row">
						<label class="mws-form-label">Link (Italiano)</label>
						<div class="mws-form-item">
							<input type="text" class="medium" name="link" value="<?php  echo $n_link; ?>"/>
							<?php if($n_link && $n_link!=""){?><a href="admin.php?cmd=rassegna_doc_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a><?php }?>
						</div>
					</div>
				</div>
				<div id="box_allegato" style="display:<?php if($n_tipo_link=="allegato"){?>block<?php }else{?>none<?php }?>">
					<?php 
					$oggetto_admin->campo_mod("Allegato PDF (Inglese)" , "file_eng" , "$n_file_eng"  , "5", 'no', "$cmd", "$id_rec$rif", "", "", "", "files/rassegna/doc");
					$oggetto_admin->campo_mod("Allegato PDF (Italiano)" , "file" , "$n_file"  , "5", 'no', "$cmd", "$id_rec$rif", "", "", "", "files/rassegna/doc");
					?>
				</div>
				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
				
				<div style="margin-left:20px; padding-bottom:10px;"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
			<script type="text/javascript">
				function vedi(cosa){
					if(cosa=="link"){
						document.getElementById('box_link').style.display='block';
						document.getElementById('box_allegato').style.display='none';
					}else if(cosa=="allegato"){
						document.getElementById('box_link').style.display='none';
						document.getElementById('box_allegato').style.display='block';
					}
				}
				function vedi_tipo(cosa){
					if(cosa=="link"){
						document.getElementById('box_tipo_link').style.display='block';
						document.getElementById('box_tipo_gruppo_link').style.display='none';
					}else if(cosa=="gruppo_link"){
						document.getElementById('box_tipo_link').style.display='none';
						document.getElementById('box_tipo_gruppo_link').style.display='block';
					}
				}
			</script>
		</form>
		<!--<script type="text/javascript">
			function calcola_prezzo(){
				var pu = document.inserimento.prezzo_listino.value;
				var sc = document.inserimento.sconto.value;
				var ps = pu - (pu*(sc/100));
				document.inserimento.prezzo.value = ps;
			}	
		</script>-->
	</div>
</div>
<?php 
}
?>
