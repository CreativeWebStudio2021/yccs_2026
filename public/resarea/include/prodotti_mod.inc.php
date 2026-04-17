<?php 
$table="prodotti";


$rif="";
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['ric_cat'])) $ric_cat=$_GET['ric_cat']; else $ric_cat='';
if(isset($_GET['ric_sottocat'])) $ric_sottocat=$_GET['ric_sottocat']; else $ric_sottocat='';
if(isset($_GET['ric_nome'])) $ric_nome=$_GET['ric_nome']; else $ric_nome='';
if(isset($_GET['ric_marca'])) $ric_marca=$_GET['ric_marca']; else $ric_marca='';
if(isset($_GET['ric_codice'])) $ric_codice=$_GET['ric_codice']; else $ric_codice='';

$rif.="&pag_att=$pag_att";
if($ric_cat!="") { $rif.="&ric_cat=$ric_cat"; }
if($ric_sottocat!="") { $rif.="&ric_sottocat=$ric_sottocat"; }
if($ric_marca!="") { $rif.="&ric_marca=$ric_marca"; }
if($ric_nome!="") { $rif.="&ric_nome=$ric_nome"; }
if($ric_codice!="") { $rif.="&ric_codice=$ric_codice"; }

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_nome = $arr_rec['nome'];
$n_nome_eng = $arr_rec['nome_eng'];
$n_colore = $arr_rec['colore'];
$n_descrizione = $arr_rec['descr'];
$n_descrizione_eng = $arr_rec['descr_eng'];
$n_prezzo = $arr_rec['prezzo'];
$n_quantita = $arr_rec['quantita'];
$n_cat = $arr_rec['id_rife'];
$n_sottocat = $arr_rec['id_riferimento'];
$n_foto = $arr_rec['img'];
$n_tipo_taglia = $arr_rec['tipo_taglia'];


?>

<script language="javascript">
	function annulla(){
		<?php if($prov!=""){?>
			window.location='admin.php?cmd=<?php echo $prov;?><?php echo $rif;?>';
		<?php }else{?>
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		<?php }?>
	}
</script>

<script language="javascript">
	function is_numeric(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}
	function is_int(n){
	  if (!is_numeric(n)) return false
	  else return (n % 1 == 0);
	}

	function is_float(n){
	  if (!is_numeric(n)) return false
	  else return (n % 1 != 0);
	}
	
	function verifica(){
		if (document.inserimento.id_rife.value=="") alert('Categoria obbigatoria');
		//else if (document.inserimento.id_riferimento.value=="") alert('Sottocategoria obbigatoria');
		else if (document.inserimento.nome.value=="") alert('Nome obbigatorio');		
		else if (document.inserimento.prezzo.value=="") alert('Prezzo obbligatorio');		
		else if (document.inserimento.prezzo.value!="" && (!is_int(document.inserimento.prezzo.value) && !is_float(document.inserimento.prezzo.value))) alert('Inserire un valore corretto per il Prezzo (utilizzare il punto per indicare i decimali)');
		else if (document.inserimento.tipo_taglia.value=="" && document.inserimento.quantita.value=="") alert('Pezzi disponibili obbigatorio');	
		else if (document.inserimento.quantita.value!="" && !is_int(document.inserimento.quantita.value)) alert('Per i Pezzi disponibili inserire un numero intero');
		else document.inserimento.submit();
	}
	
	function set_sotto(id_cat){
		var stringa="";
		<?php 
		$query_ct="SELECT id FROM categorie ORDER BY id ASC";
		$resu_ct=$open_connection->connection->query($query_ct);
		while($risu_ct=$resu_ct->fetch()){?>
			if (id_cat=='<?php echo $risu_ct['id'];?>'){
				stringa+='<select name="id_riferimento" class="small">';
				stringa+='<option value="">Seleziona</option>';		
				<?php 
				$query_sc="SELECT * FROM sottocategorie WHERE id_rife='".$risu_ct['id']."'";
				$resu_sc=$open_connection->connection->query($query_sc);
				$num_sc=$resu_sc->rowCount();
				if($num_sc>0){
					while($risu_sc=$resu_sc->fetch()){?>
						stringa+='<option value="<?php echo $risu_sc['id'];?>"><?php echo $risu_sc['nome'];?></option>';		
					<?php }?>
					stringa+='</select>';
				<?php }else{?>
					stringa='<select name="id_riferimento" class="small" disabled>';
					stringa+='<option value=""></option>';		
					stringa+='</select>';
				<?php }?>
			}
		<?php }?>
		if(id_cat==""){
			stringa+='<select name="id_riferimento" class="small" disabled>';
			stringa+='<option value=""></option>';		
			stringa+='</select>';
		}
		document.getElementById('select_sottocat').innerHTML=stringa;
	}
	
	function set_taglia(id_tipo){
		var stringa_t="";
		<?php 
		$query_tipo="SELECT id FROM tipo_taglia ORDER BY nome ASC";
		$resu_tipo=$open_connection->connection->query($query_tipo);
		$x=0;
		while($risu_tipo=$resu_tipo->fetch()){?>
			<?php if($x!=0) echo "else";?> if (id_tipo=='<?php echo $risu_tipo['id'];?>'){	
				document.getElementById('box_taglia').style.display="block";
				document.getElementById('campo_quantita').style.display="none";
				<?php 
				$query_taglia="SELECT * FROM valori_taglia WHERE id_tipo='".$risu_tipo['id']."'";
				$resu_taglia=$open_connection->connection->query($query_taglia);
				$num_taglia=$resu_taglia->rowCount();
				if($num_taglia>0){
					while($risu_taglia=$resu_taglia->fetch()){
						$query_q="SELECT quantita FROM quantita_taglie WHERE id_prodotto='$id_rec' AND id_valore='".$risu_taglia['id']."'";
						
						$resu_q=$open_connection->connection->query($query_q);
						list($quant)=$resu_q->fetch();
						?>
						stringa_t+='<div style="float:left; width:50px; margin-bottom:10px;"><?php echo $risu_taglia['valore'];?></div>';
						stringa_t+='<div style="float:left;"><input type="text" name="taglia_<?php echo $risu_taglia['id'];?>" value="<?php if($quant && $quant!="") echo $quant; else echo "0";?>" style="width:50px"/></div>';
						stringa_t+='<div style="clear:both; height:10px"></div>';
						document.getElementById('campo_taglia').innerHTML=stringa_t;/**/
					<?php }?>
				<?php }else{?>
				
				<?php }?>
			}
			<?php $x++;
		}?>
		else{
			document.getElementById('box_taglia').style.display="none";
			document.getElementById('campo_quantita').style.display="block";
			document.getElementById('campo_taglia').innerHTML="";
		}		
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['img']="250"; 
	
	$_POST['descr']=str_replace('"','\"',$_POST['descr']);
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);
	
	if($_POST['tipo_taglia'] && $_POST['tipo_taglia']!=""){
		$query_tt="SELECT * FROM valori_taglia WHERE id_tipo='".$_POST['tipo_taglia']."'";
		$resu_tt=$open_connection->connection->query($query_tt);
		while($risu_t=$resu_tt->fetch()){
			$arr_no['taglia_'.$risu_t['id']]=1;
		}
	}
	
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/prodotti");
	
	
	if($_POST['tipo_taglia'] && $_POST['tipo_taglia']!=""){
		$query_del="DELETE FROM quantita_taglie WHERE id_prodotto='$id_rec'";
		$risu_del=$open_connection->connection->query($query_del);
		$query_tt="SELECT * FROM valori_taglia WHERE id_tipo='".$_POST['tipo_taglia']."'";
		$resu_tt=$open_connection->connection->query($query_tt);
		while($risu_t=$resu_tt->fetch()){
			$query_ins="INSERT INTO quantita_taglie (id_prodotto, id_valore, quantita) VALUES ('$id_rec','".$risu_t['id']."','".$_POST['taglia_'.$risu_t['id']]."')";
			//echo $query_ins."<br/>";
			$risu_ins=$open_connection->connection->query($query_ins);	
		}
	}
	
	$query_var="SELECT id FROM prodotti WHERE id_rife_varianti='$id_rec' AND id<>'$id_rec'";
	$resu_var=$open_connection->connection->query($query_var);
	while($risu_var=$resu_var->fetch()){
		$_FILES['img']=NULL;
		$arr_no['img']=1;
		$arr_no['colore']=1;
		$oggetto_admin->modifica_campi ("$table" ,$risu_var['id'] , $arr_no );
	}
?>
	<script language="javascript">
		<?php if($prov!=""){?>
			window.location='admin.php?cmd=<?php echo $prov;?><?php echo $rif;?>';
		<?php }else{?>
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&id_rec=<?php  echo $id_rec; ?>';
		<?php }?>
	</script>	
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica <?php echo $table;?></b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco dei prodotti</b>
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
				<div class="mws-form-row">
					<label class="mws-form-label">Categoria *</label>
					<div class="mws-form-item">
						<select name="id_rife" class="small" onchange="set_sotto(this.value);">
							<option value="">Seleziona</option>
							<?php 
							$query_cat="SELECT * FROM categorie ORDER BY ordine DESC";
							$resu_cat=$open_connection->connection->query($query_cat);
							while($risu_cat=$resu_cat->fetch()){?>
								<option value="<?php echo $risu_cat['id'];?>" <?php if($n_cat==$risu_cat['id']){?>selected="selected"<?php }?>><?php echo $risu_cat['nome'];?></option>
							<?php }?>					
						</select>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Sottocategoria</label>
					<div class="mws-form-item" id="select_sottocat">
						<?php 						
						$query_sottocat="SELECT * FROM sottocategorie WHERE id_rife='$n_cat' ORDER BY ordine DESC";
						$resu_sottocat=$open_connection->connection->query($query_sottocat);
						$num_sottocat=$resu_cat->rowCount();
						?>
						<select name="id_riferimento" class="small" <?php if($num_sottocat==0){?>disabled<?php }?>>
							<option value=""><?php if($num_sottocat!=0){?>Seleziona<?php }?></option>	
							<?php 
							while($risu_sottocat=$resu_sottocat->fetch()){?>
								<option value="<?php echo $risu_sottocat['id'];?>" <?php if($n_sottocat==$risu_sottocat['id']){?>selected="selected"<?php }?>><?php echo $risu_sottocat['nome'];?></option>	
							<?php }?>
						</select>
					</div>
				</div>
				<?php 				
				$oggetto_admin->campo_mod("Nome (in Italiano)*" , "nome" , "$n_nome"  , "1", 'no', "$cmd", "$id_rec", "", "", "", "", "1");
				$oggetto_admin->campo_mod("Nome  (in Inglese)" , "nome_eng" , "$n_nome_eng"  , "1", 'no', "$cmd", "$id_rec");
								
				$oggetto_admin->campo_mod("Foto" , "img" , $n_foto  , "4", 'no', $cmd, "$id_rec", "", "", "img_up/prodotti");
				?>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (in Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descr_eng"><?php  echo $n_descrizione_eng; ?></textarea>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (in Italiano)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descr"><?php  echo $n_descrizione; ?></textarea>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Prezzo *<br /><i>(in euro, usando il punto solo per i centesimi)</i></label>
					<div class="mws-form-item">
						<input type="text" name="prezzo" id="prezzo" value="<?php echo $n_prezzo;?>" OnFocus="calcola_prezzo();">
					</div>
				</div>
				
				<div>
					<div class="mws-form-row">
						<label class="mws-form-label">Colore</label>
						<div class="mws-form-item">
							<select name="colore" class="small">
								<option value="">Seleziona Colore</option>	
								<?php 
								$query_c="SELECT * FROM colori ORDER BY nome ASC";
								$resu_c=$open_connection->connection->query($query_c);
								while($risu_c=$resu_c->fetch()){?>
									<option value="<?php echo $risu_c['id'];?>" <?php if($risu_c['id']==$n_colore){?>selected="selected"<?php }?>><?php echo $risu_c['nome'];?></option>		
								<?php }?>
							</select>
						</div>
					</div>
				</div>	
				
				<div>
					<div class="mws-form-row">
						<label class="mws-form-label">Tipo Taglia<br/><i>Se esistono variazioni di tagila indicare la tipologia della taglia</i></label>
						<div class="mws-form-item">
							<select name="tipo_taglia" class="small" onchange="set_taglia(this.value);">
								<option value="">Seleziona Tipo Taglia</option>	
								<?php 
								$query_t="SELECT * FROM tipo_taglia ORDER BY nome ASC";
								$resu_t=$open_connection->connection->query($query_t);
								while($risu_t=$resu_t->fetch()){?>
									<option value="<?php echo $risu_t['id'];?>" <?php if($risu_t['id']==$n_tipo_taglia){?>selected="selected"<?php }?>><?php echo $risu_t['nome'];?></option>		
								<?php }?>
							</select>
						</div>
					</div>
				</div>				
				
				<div class="mws-form-row" id="box_taglia" style="display:none;">
					<label class="mws-form-label">Quantit&agrave; Taglia *</label>
					<div class="mws-form-item" id="campo_taglia">
					 
					</div>
				</div>
				
				
				<div id="campo_quantita">
					<?php 
					$oggetto_admin->campo_mod("Pezzi disponibili *" , "quantita" , $n_quantita  , "2", 'no', $cmd, "$id_rec");		
					?>
				</div>
				
				<?php if($n_tipo_taglia && $n_tipo_taglia!=""){?>
					<script type="text/javascript">
						set_taglia('<?php echo $n_tipo_taglia;?>');
					</script>
				<?php }?>
			
				<!--<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>obbligatorio</i> <br/>** <i>Almeno uno obbligatorio</i></div>-->
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
		<script type="text/javascript">
			function calcola_prezzo(){
				var pu = document.inserimento.prezzo_listino.value;
				var sc = document.inserimento.sconto.value;
				var ps = pu - (pu*(sc/100));
				document.inserimento.prezzo.value = ps;
			}	
		</script>	
	</div>
</div>
<?php 
}
?>
