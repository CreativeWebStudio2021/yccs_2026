<?php 	
$table="comunicati_home";

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
		else if (document.gino.tipo.value=="link"){
			if (document.gino.id_regata.value!="" && (document.gino.id_edizione.value=="")) alert('Edizione Regata obbigatoria');
			else if (document.gino.testo_eng.value=="") alert('Testo (Inglese) obbigatorio');
			//else if (document.gino.tipo_link.value=="") alert('Tipo Link obbigatorio');
			//else if (document.gino.tipo_link.value=="link" && document.gino.link_eng.value=="") alert('Link (Inglese) obbigatorio');
			//else if (document.gino.tipo_link.value=="allegato" && document.gino.allegato_eng.value=="") alert('Allegato (Inglese) obbigatorio');
			else document.gino.submit();
		} else if (document.gino.tipo.value=="gruppo_link") {
			if (document.gino.id_regata.value=="" && document.gino.testo_gruppo_eng.value=="") alert('Inseriro Testo (Inglese) o Regata');			
			else if (document.gino.id_regata.value!="" && (document.gino.id_edizione.value=="")) alert('Edizione Regata obbigatoria');			
			else document.gino.submit();
		}
	}
</script>
<?php 
if($stato=="inviato"){

	$arr_no['stato']=1;
	
	$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	$_POST['testo_eng']=str_replace('"','\"',$_POST['testo_eng']);
	$_POST['testo_gruppo']=str_replace('"','\"',$_POST['testo_gruppo']);
	$_POST['testo_gruppo_eng']=str_replace('"','\"',$_POST['testo_gruppo_eng']);
	
	$oggetto_admin->inserisci_campi ("$table" , $arr_no);
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Comunicato Home</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
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
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine("$table");
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Tipo*</label>
					<div class="mws-form-item">
						<select name="tipo" class="small" onchange="vedi_tipo(this.value);">
							<option value="">Seleziona</option>
							<option value="link">Link</option>
							<option value="gruppo_link">Gruppo Link</option>				
						</select>
					</div>
				</div>
				<div id="box_tipo_link" style="display:none">
					<?php 
						$oggetto_admin->campo_ins("Testo (Inglese)*", "testo_eng" , "1", 'no');
						$oggetto_admin->campo_ins("Testo (Italiano)", "testo" , "1", 'no');	
					?>
					<div class="mws-form-row">
						<label class="mws-form-label">Tipo Link</label>
						<div class="mws-form-item">
							<select name="tipo_link" class="small" onchange="vedi(this.value);">
								<option value="">Seleziona</option>
								<option value="link">Link</option>
								<option value="allegato">Allegato</option>				
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
						$oggetto_admin->campo_ins("Allegato PDF (Inglese)" , "allegato_eng" , "5", 'no');
						$oggetto_admin->campo_ins("Allegato PDF (Italiano)" , "allegato" , "5", 'no');
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
							}
						}
					</script>
				</div>
				<div id="box_tipo_gruppo_link" style="display:none">
					<?php 
						$oggetto_admin->campo_ins("Testo (Inglese) **", "testo_gruppo_eng" , "1", 'no');
						$oggetto_admin->campo_ins("Testo (Italiano)", "testo_gruppo" , "1", 'no');	
					?>
					<div style="float:left; width:45%; margin-left:25px;  margin-top:10px;  margin-bottom:10px">
						<label class="mws-form-label">Regata **</label>
						<div class="mws-form-item">
							<select name="id_regata" class="small" onchange="cambia_regata(this.value);">
								<option value="">Seleziona</option>
								<?php 
								$query_reg="SELECT * FROM regate ORDER BY ordine DESC";
								$resu_reg=$open_connection->connection->query($query_reg);
								while($risu_reg=$resu_reg->fetch()){?>
									<option value="<?php echo $risu_reg['id'];?>"><?php echo $risu_reg['nome'];?></option>
								<?php }?>
							</select>
						</div>
					</div>
					
					<div style="float:right; width:45%;  margin-left:25px;  margin-top:10px;  margin-bottom:10px"id="edizioni">
						
					</div>
					<div style="clear:both"></div>
					
					<script type="text/javascript">
						function cambia_regata(id_reg){	
							$.ajax({
								url:"include/edizioni_ajax.inc.php",
								type: "GET",  
								data : {id_regata : id_reg},										
								success:function(result){
									$("div#edizioni").html(result);
								},
								error: function(richiesta,stato,errori){
									$("div#edizioni").html("<b>Chiamata fallita:</b>"+stato+" "+errori);  
								} 
							});
						};
						
						 cambia_regata(0);
					</script>
					<br/><br/>
					<div style="margin-left:25px;"><i>nel caso "Gruppo Link" i link verranno inseriti in un secondo momento. Fare quindi "inserisci" dopo aver inserito i dati richiesti</i></div>
				</div>
				<script type="text/javascript">
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
			
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;">** <i>compilare almeno uno di questi campi</i></div>
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
