<?php 
$table="crew_board";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";

if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if($id_riferimento!="") $rif.="&id_riferimento=$id_riferimento";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_nome = $arr_rec['nome'];
$n_email = $arr_rec['email'];
$n_telefono = $arr_rec['telefono'];
$n_tipo = $arr_rec['tipo'];
$n_nome_barca = $arr_rec['nome_barca'];
$n_tipo_barca = $arr_rec['tipo_barca'];
$n_esperienza = $arr_rec['esperienza'];
$n_posizione = $arr_rec['posizione'];
$n_sailing_status = $arr_rec['sailing_status'];
$n_commento = $arr_rec['commento'];
$n_attivo = $arr_rec['attivo'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=crew_board<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		/*var file_old = "<?php  echo $n_file; ?>";
		
		if (document.inserimento.testo_link_eng.value=="") alert('Titolo (Inglese) obbigatorio');	
			//else if (document.inserimento.file.value=="" && file_old=="" && document.inserimento.link.value=="") alert('Compilare uno di questi campi: Allegato o Link');
			//else if ((document.inserimento.file.value!="" || file_old!="") && document.inserimento.link.value!="") alert('Compilare SOLO uno di questi campi: Allegato o Link');
			else*/ document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("files/regate/crew_board/$cancimg")){unlink("files/regate/crew_board/$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=crew_board_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['esperienza_val']=1;
	$arr_no['sailing_val']=1;
	$arr_no['posizione_val']=1;
			
	$_POST['commento']=str_replace('"',"''",$_POST['commento']);
	$_POST['nome']=str_replace('"',"''",$_POST['nome']);
			
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb="no", "", "files/regate/crew_board");
?>
	<script language="javascript">
		window.location='admin.php?cmd=crew_board<?php echo $rif;?>';
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
	<div style="height:50px;font-size:1.2em;padding-top:10px">Modifica Crew Board della regata <b><?php  echo ucfirst($nome_reg); ?></b> - <b>Edizione <?php  echo $anno_ed; ?></b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=crew_board<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna alla Crew Board</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=crew_board_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				
				<div class="mws-form-row">
					<label class="mws-form-label">Nome</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="nome" value="<?php  echo $n_nome; ?>"/>
						<a href="admin.php?cmd=crew_board_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=nome<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Email</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="email" value="<?php  echo $n_email; ?>"/>
						<a href="admin.php?cmd=crew_board_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=email<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Telefono</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="telefono" value="<?php  echo $n_telefono; ?>"/>
						<a href="admin.php?cmd=crew_board_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=telefono<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Tipo di iscrizione</label>
					<div class="mws-form-item">
						<select name="tipo" class="small">
							<option value="">Seleziona</option>
							<option value="Cerco equipaggio" <?php if($n_tipo=="Cerco equipaggio"){?>selected="selected"<?php }?>>Cerco equipaggio</option>
							<option value="Cerco barca" <?php if($n_tipo=="Cerco barca"){?>selected="selected"<?php }?>>Cerco una barca</option>				
						</select>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Esperienza</label>
					<div class="mws-form-item">
						<input type="hidden" name="esperienza" value="<?php echo $n_esperienza;?>"/>
						<div class="grid_1" style="text-align:center;">
							<div style="text-align:center;">
								<input type="radio" name="esperienza_val" <?php if($n_esperienza=="Novice"){?>checked="checked"<?php }?> value="Novice" onclick="document.inserimento.esperienza.value=this.value;"><br/>Novizio
							</div>
						</div>
						<div class="grid_1" style="text-align:center;">
							<div style="text-align:center;">
								<input type="radio" name="esperienza_val" <?php if($n_esperienza=="Beginner"){?>checked="checked"<?php }?> value="Beginner" onclick="document.inserimento.esperienza.value=this.value;"><br/>Principiante
							</div>
						</div>
						<div class="grid_1" style="text-align:center;">
							<div style="text-align:center;">
								<input type="radio" name="esperienza_val" <?php if($n_esperienza=="Intermediate"){?>checked="checked"<?php }?> value="Intermediate" onclick="document.inserimento.esperienza.value=this.value;"><br/>Intermedia
							</div>
						</div>
						<div class="grid_1" style="text-align:center;">
							<div style="text-align:center;">
								<input type="radio" name="esperienza_val" <?php if($n_esperienza=="Advanced"){?>checked="checked"<?php }?> value="Advanced" onclick="document.inserimento.esperienza.value=this.value;"><br/>Avanzata
							</div>
						</div>
						<div class="grid_1" style="text-align:center;">
							<div style="text-align:center;">
								<input type="radio" name="esperienza_val" <?php if($n_esperienza=="Professional"){?>checked="checked"<?php }?> value="Professional" onclick="document.inserimento.esperienza.value=this.value;"><br/>Professionista
							</div>
						</div>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Nome della barca</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="nome_barca" value="<?php  echo $n_nome_barca; ?>"/>
						<a href="admin.php?cmd=crew_board_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=nome_barca<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Tipo della barca</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="tipo_barca" value="<?php  echo $n_tipo_barca; ?>"/>
						<a href="admin.php?cmd=crew_board_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=tipo_barca<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Sailing Status</label>
					<div class="mws-form-item">
						<input type="hidden" name="sailing_status" value="<?php echo $n_sailing_status;?>"/>
						<div class="grid_1" style="text-align:center;">
							<div style="text-align:center;">
								<input type="radio" name="sailing_val" <?php if($n_sailing_status=="Gruppo 1"){?>checked="checked"<?php }?> value="Gruppo 1" onclick="document.inserimento.sailing_status.value=this.value;"><br/>Gruppo 1
							</div>
						</div>
						<div class="grid_1" style="text-align:center;">
							<div style="text-align:center;">
								<input type="radio" name="sailing_val" <?php if($n_sailing_status=="Gruppo 3"){?>checked="checked"<?php }?> value="Gruppo 3" onclick="document.inserimento.sailing_status.value=this.value;"><br/>Gruppo 3
							</div>
						</div>						
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Posizione</label>
					<input type="hidden" name="posizione" value="<?php echo $n_posizione;?>"/>
					<div class="mws-form-item">
						<fieldset style="font-size:0.8em">
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="Foredeck" onclick="addPos('Foredeck')" id="chack1" <?php if($n_posizione!=str_replace("Foredeck","",$n_posizione)){?>checked="checked"<?php }?>/>&nbsp;&nbsp;Foredeck 
							</div>
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="Mast" onclick="addPos('Mast')" id="chack2" <?php if($n_posizione!=str_replace("Mast","",$n_posizione)){?>checked="checked"<?php }?>/>&nbsp;&nbsp;Mast 
							</div>
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="Pit" onclick="addPos('Pit')" id="chack3" <?php if($n_posizione!=str_replace("Pit","",$n_posizione)){?>checked="checked"<?php }?>/>&nbsp;&nbsp;Pit
							</div>
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="Sewer" onclick="addPos('Sewer')" id="chack4" <?php if($n_posizione!=str_replace("Sewer","",$n_posizione)){?>checked="checked"<?php }?>/>&nbsp;&nbsp;Sewer
							</div>
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="Grinder" onclick="addPos('Grinder')" id="chack5" <?php if($n_posizione!=str_replace("Grinder","",$n_posizione)){?>checked="checked"<?php }?>/>&nbsp;&nbsp;Grinder 
							</div>
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="Trimmer" onclick="addPos('Trimmer')" id="chack6" <?php if($n_posizione!=str_replace("Trimmer","",$n_posizione)){?>checked="checked"<?php }?>/>&nbsp;&nbsp;Trimmer
							</div>
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="Main" onclick="addPos('Main')" id="chack7" <?php if($n_posizione!=str_replace("Main","",$n_posizione)){?>checked="checked"<?php }?>/>&nbsp;&nbsp;Main 
							</div>
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="Tactician" onclick="addPos('Tactician')" id="chack8" <?php if($n_posizione!=str_replace("Tactician","",$n_posizione)){?>checked="checked"<?php }?>/>&nbsp;&nbsp;Tactician 
							</div>
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="Helm" onclick="addPos('Helm')" id="chack9" <?php if($n_posizione!=str_replace("Helm","",$n_posizione)){?>checked="checked"<?php }?>/>&nbsp;&nbsp;Helm 
							</div>
							<div class="grid_1">
								<input type="checkbox" name="posizione_val" value="All" onclick="addPos('All')" id="chack10"/>&nbsp;&nbsp;All
							</div>
						</fieldset>
						<script type="text/javascript">
							val=document.inserimento.posizione.value;
							function addPos(pos){
								if(pos=="All"){
									if(document.getElementById('chack10').checked==1){
										<?php for($i=1; $i<=9; $i++){?>
											val=val+"@@"+document.getElementById('chack<?php echo $i;?>').value;
											document.getElementById('chack<?php echo $i;?>').checked=1;
										<?php }?>
									}else{
										val="";
										<?php for($i=1; $i<=9; $i++){?>
											document.getElementById('chack<?php echo $i;?>').checked=0;
										<?php }?>
									}
								}else{
									if(val==val.replace(pos,""))
										val=val+"@@"+pos;
									else val=val.replace("@@"+pos,"");
									document.getElementById('chack10').checked=0;
								}
								document.inserimento.posizione.value=val;
							}	
						</script>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Commento</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="commento"><?php  echo $n_commento; ?></textarea>
						<a href="admin.php?cmd=edizioni_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=commento<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Stato</label>
					<div class="mws-form-item">
						<select name="attivo" class="small">
							<option value="">Seleziona</option>
							<option value="1" <?php if($n_attivo=="1"){?>selected="selected"<?php }?>>Attivo</option>
							<option value="0" <?php if($n_attivo=="0"){?>selected="selected"<?php }?>>Disattivo</option>				
						</select>
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
