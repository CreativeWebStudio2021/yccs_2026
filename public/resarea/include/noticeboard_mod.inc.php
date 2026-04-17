<?php 
$table="edizioni_noticeboard";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; 
else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";

if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if($id_riferimento!="") $rif.="&id_riferimento=$id_riferimento";

if($id_rife==""){
	$query_canc = "SELECT id_regata FROM edizioni_regate where id='$id_riferimento'";
	$risu_canc = $open_connection->connection->query($query_canc);
	list($id_rife) = $risu_canc->fetch();
}

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
		window.location='admin.php?cmd=noticeboard<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		var file_old = "<?php  echo $n_file; ?>";
		
		if (document.inserimento.testo_link_eng.value=="") alert('Titolo (Inglese) obbigatorio');	
			else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("files/regate/noticeboard/$cancimg")){unlink("files/regate/noticeboard/$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=noticeboard_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['posizione']=1;
			
			
	$_POST['testo_link']=str_replace('"',"''",$_POST['testo_link']);
	$_POST['testo_link_eng']=str_replace('"',"''",$_POST['testo_link_eng']);
			
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb="no", "", "files/regate/noticeboard");		
	
	if($_POST['posizione'] && $_POST['posizione']!="") {
		if($_POST['posizione']=="ultimo") {
			$oggetto_admin->ultimo("edizioni_noticeboard", "$id_rec", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");	
		}else{
			$oggetto_admin->cambia("edizioni_noticeboard", "$id_rec", $_POST['posizione'], "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");			
		}
	}
?>
	<script language="javascript">
		window.location='admin.php?cmd=noticeboard<?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
$nome_reg = "";
$query_reg = "select nome from regate where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
if ($risu_reg) list($nome_reg) = $risu_reg->fetch();

$anno_ed = "";
$query_ed = "select anno from edizioni_regate where id='$id_riferimento'";
$risu_ed = $open_connection->connection->query($query_ed);
if ($risu_ed) list($anno_ed) = $risu_ed->fetch();
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Modifica Comunicati della regata <b><?php  echo ucfirst($nome_reg); ?></b> - <b>Edizione <?php  echo $anno_ed; ?></b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=noticeboard<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco dei comunicati</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=noticeboard_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
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
						<a href="admin.php?cmd=noticeboard_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_link<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Posizione</label>
					<div class="mws-form-item">
						<?php 
						$x=1;
						$query_ele = "select * from edizioni_noticeboard where id_regata='$id_rife' and id_edizione='$id_riferimento' order by ordine desc";
						$resu_ele = $open_connection->connection->query($query_ele);
						?>
						<select name="posizione" class="small">
							<?php 							
							while($risu_ele=$resu_ele->fetch()){
								$testo_link = $risu_ele['testo_link_eng'];
								if($risu_ele['testo_link'] && trim($risu_ele['testo_link'])!="") $testo_link = $risu_ele['testo_link'];?>								
								<option value="<?php echo $x;?>" <?php if($risu_ele['id']==$id_rec){?>selected="selected"<?php }?> ><?php echo $x;?> - <?php if($risu_ele['id']!=$id_rec){?>prima di <?php }?><?php echo $testo_link;?> (<?php echo $risu_ele['tipo_link'];?>)</option>
								<?php $x++;
							}?>
							<option value="ultimo">Ultimo</option>
						</select>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Tipo Link</label>
					<div class="mws-form-item">
						<select name="tipo_link" class="small" onchange="vedi(this.value);">
							<option value="">Seleziona</option>
							<option value="link" <?php if($n_tipo_link=="link"){?>selected="selected"<?php }?>>Link</option>
							<option value="allegato" <?php if($n_tipo_link=="allegato"){?>selected="selected"<?php }?>>Allegato</option>				
							<option value="titolo" <?php if($n_tipo_link=="titolo"){?>selected="selected"<?php }?>>Titolo</option>				
						</select>
					</div>
				</div>
				
				<div id="box_link" style="display:<?php if($n_tipo_link=="link"){?>block<?php }else{?>none<?php }?>">
					<div class="mws-form-row">
						<label class="mws-form-label">Link (Inglese)</label>
						<div class="mws-form-item">
							<input type="text" class="medium" name="link_eng" value="<?php  echo $n_link_eng; ?>"/>
							<?php if($n_link_eng && $n_link_eng!=""){?><a href="admin.php?cmd=noticeboard_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a><?php }?>
						</div>
					</div>
					<div class="mws-form-row">
						<label class="mws-form-label">Link (Italiano)</label>
						<div class="mws-form-item">
							<input type="text" class="medium" name="link" value="<?php  echo $n_link; ?>"/>
							<?php if($n_link && $n_link!=""){?><a href="admin.php?cmd=noticeboard_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a><?php }?>
						</div>
					</div>
				</div>
				<div id="box_allegato" style="display:<?php if($n_tipo_link=="allegato"){?>block<?php }else{?>none<?php }?>">
					<?php 
					$oggetto_admin->campo_mod("Allegato PDF (Inglese)" , "file_eng" , "$n_file_eng"  , "5", 'no', "$cmd", "$id_rec$rif", "", "", "", "files/regate/noticeboard");
					$oggetto_admin->campo_mod("Allegato PDF (Italiano)" , "file" , "$n_file"  , "5", 'no', "$cmd", "$id_rec$rif", "", "", "", "files/regate/noticeboard");
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
					}else if(cosa=="titolo"){
						document.getElementById('box_link').style.display='none';
						document.getElementById('box_allegato').style.display='none';
					}
				}
			</script>
		</form>
	</div>
</div>
<?php 
}
?>
