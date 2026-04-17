<?php 
$table="comunicati_home";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_testo = $arr_rec['testo'];
$n_testo_eng = $arr_rec['testo_eng'];
$n_testo_gruppo = $arr_rec['testo_gruppo'];
$n_testo_gruppo_eng = $arr_rec['testo_gruppo_eng'];
$n_tipo = $arr_rec['tipo'];
$n_tipo_link = $arr_rec['tipo_link'];
$n_link = str_replace("admin/","resarea/",$arr_rec['link']);
$n_link_eng = str_replace("admin/","resarea/",$arr_rec['link_eng']);
$n_allegato = $arr_rec['allegato'];
$n_allegato_eng = $arr_rec['allegato_eng'];
$n_id_regata  = $arr_rec['id_regata'];
$n_id_edizione = $arr_rec['id_edizione'];

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
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	/*if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}*/
	if($campocanc=="id_regata"){
		$query_canc_img = "update $table set id_regata=NULL, id_edizione=NULL where id='$id_rec'";
		$open_connection->connection->query($query_canc_img);
	}else{
		$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
		$open_connection->connection->query($query_canc_img);
	}
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	
	$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	$_POST['testo_eng']=str_replace('"','\"',$_POST['testo_eng']);

	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no);
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
	<div style="float:left; width:45%; height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Comunicati Home</b></div>	
	<div style="clear:both"></div>
	
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
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
			
			<div class="mws-form-row">
				<label class="mws-form-label">Tipo *</label>
				<div class="mws-form-item">
					<select name="tipo" class="small" onchange="vedi_tipo(this.value);">
						<option value="">Seleziona</option>
						<option value="link" <?php if($n_tipo=="link"){?>selected="selected"<?php }?>>Link</option>
						<option value="gruppo_link" <?php if($n_tipo=="gruppo_link"){?>selected="selected"<?php }?>>Gruppo Link</option>				
					</select>
				</div>
			</div>
			
			<div id="box_tipo_link" style="display:<?php if($n_tipo=="link"){?>block<?php }else{?>none<?php }?>">
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Inglese)*</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_eng" value="<?php  echo $n_testo_eng; ?>"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Italiano)</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo" value="<?php  echo $n_testo; ?>"/>
						<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
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
							<?php if($n_link_eng && $n_link_eng!=""){?>
								<a href="admin.php?cmd=comunicati_home_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link_eng<?php echo $rif;?>">
									<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
								</a>
							<?php }?>
						</div>
					</div>
					<div class="mws-form-row">
						<label class="mws-form-label">Link (Italiano)</label>
						<div class="mws-form-item">
							<input type="text" class="medium" name="link" value="<?php  echo $n_link; ?>"/>
							<?php if($n_link && $n_link!=""){?>
								<a href="admin.php?cmd=comunicati_home_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=link<?php echo $rif;?>">
									<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
								</a>
							<?php }?>
						</div>
					</div>
				</div>
				<div id="box_allegato" style="display:<?php if($n_tipo_link=="allegato"){?>block<?php }else{?>none<?php }?>">
					<?php 
					$oggetto_admin->campo_mod("Allegato PDF (Inglese)" , "allegato_eng" , "$n_allegato_eng"  , "5", 'no', "$cmd", "$id_rec");
					$oggetto_admin->campo_mod("Allegato PDF (Italiano)" , "allegato" , "$n_allegato"  , "5", 'no', "$cmd", "$id_rec");
					?>
				</div>
			</div>
			
			<div id="box_tipo_gruppo_link"  style="display:<?php if($n_tipo=="gruppo_link"){?>block<?php }else{?>none<?php }?>">
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Inglese)**</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_gruppo_eng" value="<?php  echo $n_testo_gruppo_eng; ?>"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Italiano)</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_gruppo" value="<?php  echo $n_testo_gruppo; ?>"/>
						<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				
				<div style="float:left; width:45%; margin-left:25px;  margin-top:10px;  margin-bottom:10px">
					<label class="mws-form-label">Regata**</label>
					<div class="mws-form-item">
						<select name="id_regata" class="small" onchange="cambia_regata(this.value);">
							<option value="">Seleziona</option>
							<?php 
							$query_reg="SELECT * FROM regate ORDER BY ordine DESC";
							$resu_reg=$open_connection->connection->query($query_reg);
							while($risu_reg=$resu_reg->fetch()){?>
								<option value="<?php echo $risu_reg['id'];?>" <?php if($risu_reg['id']==$n_id_regata){?>selected="selected"<?php }?>><?php echo $risu_reg['nome'];?></option>
							<?php }?>
						</select>
						
						<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=id_regata<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				
				<div style="float:right; width:45%;  margin-left:25px;  margin-top:10px;  margin-bottom:10px"id="edizioni">
					
				</div>
				<div style="clear:both"></div>
			</div>
			
			<script type="text/javascript">
				function cambia_regata(id_reg,id_ed){	
					$.ajax({
						url:"include/edizioni_ajax.inc.php",
						type: "GET",  
						data : {id_regata : id_reg, id_edizione : id_ed},										
						success:function(result){
							$("div#edizioni").html(result);
						},
						error: function(richiesta,stato,errori){
							$("div#edizioni").html("<b>Chiamata fallita:</b>"+stato+" "+errori);  
						} 
					});
				};
				
				<?php if($n_id_regata && $n_id_regata!="" && $n_id_regata!=0){?>cambia_regata(<?php echo $n_id_regata;?>,<?php echo $n_id_edizione;?>)<?php }else{?>cambia_regata(0)<?php }?>;
			</script>
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
