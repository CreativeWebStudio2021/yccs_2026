<?php 
$table="comunicazioni_ai_soci";
$rif="";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_tit = $arr_rec['testo_link'];
$n_tit_eng = $arr_rec['testo_link_eng'];
$n_file = $arr_rec['file'];
$n_file_eng = $arr_rec['file_eng'];
$n_sfogliabile = $arr_rec['sfogliabile'];
/*$n_link = $arr_rec['link'];
$n_link_eng = $arr_rec['link_eng'];*/

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		var file_old = "<?php  echo $n_file; ?>";
		
		if (document.inserimento.testo_link.value=="") alert('Titolo obbigatorio');	
			else if (document.inserimento.file.value=="" && file_old=="") alert('Allegato obbigatorio');
			else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("files/comunicati-ai-soci/$cancimg")){unlink("files/comunicati-ai-soci/$cancimg");}
	
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
			
	$_POST['testo_link']=str_replace('"',"''",$_POST['testo_link']);
	$_POST['testo_link_eng']=str_replace('"',"''",$_POST['testo_link_eng']);
			
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb="no", "", "files/comunicati-ai-soci");
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Comunicazione ai Soci</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle comunicazioni</b>
			</div>
		</a>
		<div></div>
	</div>
	
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Titolo (Italiano)*" , "testo_link" , "$n_tit"  , "1", 'no', "$cmd", "$id_rec");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Titolo (Inglese)</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_link_eng" value="<?php  echo $n_tit_eng; ?>"/>
						<a href="admin.php?cmd=documenti_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_link_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<!--<div class="mws-form-row">
					<label class="mws-form-label">Link (Italiano)**<br /><i>(a partire da http://...)</i></label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="link" value="<?php  echo $n_link; ?>"/>
						<a href="admin.php?cmd=documenti_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Link (Inglese)<br /><i>(a partire da http://...)</i></label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="link_eng" value="<?php  echo $n_link_eng; ?>"/>
						<a href="admin.php?cmd=documenti_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>-->
				<?php 
				$oggetto_admin->campo_mod("Allegato (Italiano)*" , "file" , "$n_file"  , "5", 'no', "$cmd", "$id_rec", "", "", "", "files/comunicati-ai-soci");
				$oggetto_admin->campo_mod("Allegato (Inglese)" , "file_eng" , "$n_file_eng"  , "5", 'no', "$cmd", "$id_rec", "", "", "", "files/comunicati-ai-soci");
				?>		
				<div class="mws-form-row">
					<label class="mws-form-label">Sfogliabile</label>
					<div class="mws-form-item">
						<input name="sfogliabile" type="hidden" class="medium" value="<?php echo $n_sfogliabile;?>">
						<span id="checkSfogliabile" style="cursor:pointer;" onclick="changesSfogliabile()">
						<?php if($n_sfogliabile==0){?>
							<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>
						<?php }else{?>
							<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>
						<?php }?>
						</span>
					</div>
				</div>
				
				<script type="text/javascript">
					var sf=<?php echo $n_sfogliabile;?>;
					function changesSfogliabile(){
						if(sf==0){
							sf=1;
							document.getElementById('checkSfogliabile').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.sfogliabile.value='1';
						}else{
							sf=0;
							document.getElementById('checkSfogliabile').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.sfogliabile.value='0';
						}
					}	
				</script>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
				<!--<div style="margin-left:20px; padding-bottom:10px;">** <i>compilare SOLO uno di questi campi</i></div>-->
				<div style="margin-left:20px; padding-bottom:10px;"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
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
