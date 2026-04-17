<?php 
$table="edizioni_noticeboard";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
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
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=noticeboard<?php  echo $rif; ?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.testo_link_eng.value=="") alert('Titolo (Inglese) obbigatorio');	
			else document.inserimento.submit();
	}
</script>
<?php 
		
if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['posizione']=1;
	
	$_POST['testo_link']=str_replace('"',"''",$_POST['testo_link']);
	$_POST['testo_link_eng']=str_replace('"',"''",$_POST['testo_link_eng']);
	
	$id_rec = $oggetto_admin->inserisci_campi ("edizioni_noticeboard" , $arr_no ,  $arr_thumb="no", "", "files/regate/noticeboard");
	
	if($_POST['posizione'] && $_POST['posizione']!="") {
		if($_POST['posizione']=="ultimo") {
			$oggetto_admin->ultimo("edizioni_noticeboard", "$id_rec", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");	
		}else{
			$oggetto_admin->cambia("edizioni_noticeboard", "$id_rec", $_POST['posizione'], "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");			
		}
	}
?>
	<script language="javascript">
		window.location = "admin.php?cmd=noticeboard<?php  echo $rif; ?>" ;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Comunicati della regata <b><?php  echo ucfirst($nome_reg); ?></b> - <b>Edizione <?php  echo $anno_ed; ?></b><!-- (Dim. img 1920 x 1280 pixel)--></div>
	
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=noticeboard_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<input type="hidden" name="id_regata" value="<?php echo $id_rife;?>">
			<input type="hidden" name="id_edizione" value="<?php echo $id_riferimento;?>">
			<?php 
			$ord_ev = $oggetto_admin->trova_ordine2("$table", "id_regata", $id_rife, "id_edizione", $id_riferimento);
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';
			?>
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_ins("Titolo (Inglese)*" , "testo_link_eng" , "1", 'no');
				$oggetto_admin->campo_ins("Titolo (Italiano)" , "testo_link" , "1", 'no');
				?>
				
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
								if($risu_ele['testo_link'] && trim($risu_ele['testo_link'])!="") $testo_link = $risu_ele['testo_link'];
								?>								
								<option value="<?php echo $x;?>"><?php echo $x;?> - <?php if($risu_ele['id']!=$id_rec){?>prima di <?php }?><?php echo $testo_link;?> (<?php echo $risu_ele['tipo_link'];?>)</option>
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
							<option value="link">Link</option>
							<option value="allegato">Allegato</option>				
							<option value="titolo">Titolo</option>				
						</select>
					</div>
				</div>
				<div id="box_link" style="display:none">
					<?php 
					$oggetto_admin->campo_ins("Link (Inglese)<br /><i>(a partire da http://...)</i>" , "link_eng" , "1", 'no');
					$oggetto_admin->campo_ins("Link (Italiano)<br /><i>(a partire da http://...)</i>" , "link" , "1", 'no');
					?>
				</div>
				<div id="box_allegato" style="display:none"> 
					<?php 
					$oggetto_admin->campo_ins("Allegato PDF (Inglese)" , "file_eng" , "5", 'no');
					$oggetto_admin->campo_ins("Allegato PDF (Italiano)" , "file" , "5", 'no');
					?>
				</div>
				<script type="text/javascript">
					function vedi(cosa){
						if(cosa=="link"){
							document.getElementById('box_link').style.display='block';
							document.getElementById('box_allegato').style.display='none';
						}else if(cosa=="allegato"){
							document.getElementById('box_link').style.display='none';
							document.getElementById('box_allegato').style.display='block';
						}else if(cosa=="titolo"){
							document.getElementById('box_link').style.display='none';
							document.getElementById('box_allegato').style.display='none';
						}
					}
				</script>
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
