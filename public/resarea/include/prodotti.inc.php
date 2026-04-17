<?php 
/*$query="SELECT * FROM prodotti";
$resu=$open_connection->connection->query($query);
while($risu=$resu->fetch()){
	if($risu['img'] && trim($risu['img'])!=""){
		$query_ins="INSERT INTO prodotti_foto (img,id_rife,ordine) VALUE ('".$risu['img']."','".$risu['id']."','1')";
		$risu_ins=$open_connection->connection->query($query_ins);
	}
}*/

$table="prodotti";

$criterio="";
$rif="";


if (isset($_POST['id_rife_sotto'])) $id_rife_sotto = $_POST['id_rife_sotto'];
	if (isset($_GET['id_rife_sotto'])) $id_rife_sotto = $_GET['id_rife_sotto'];
		else $id_rife_sotto = "";

if(isset($_GET['ric_cat'])) $ric_cat=$_GET['ric_cat']; else $ric_cat='';
if(isset($_GET['ric_sottocat'])) $ric_sottocat=$_GET['ric_sottocat']; else $ric_sottocat='';
if(isset($_GET['ric_nome'])) $ric_nome=$_GET['ric_nome']; else $ric_nome='';
if(isset($_GET['ric_marca'])) $ric_marca=$_GET['ric_marca']; else $ric_marca='';
if(isset($_GET['ric_codice'])) $ric_codice=$_GET['ric_codice']; else $ric_codice='';

if($ric_cat!="") { $criterio.=" AND id_rife='$ric_cat'"; $rif.="&ric_cat=$ric_cat"; }
if($ric_sottocat!="") { $criterio.=" AND id_riferimento='$ric_sottocat'"; $rif.="&ric_sottocat=$ric_sottocat"; }
if($ric_nome!="") { $criterio.=" and nome like '%$ric_nome%'"; $rif.="&ric_nome=$ric_nome"; }

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

if($azione=="cancella" && $id_canc!="")
{	
		
	$query_canc_img = "select img from prodotti where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/prodotti/$img")) @unlink("img_up/prodotti/$img");
		if (is_file("img_up/prodotti/s_$img")) @unlink("img_up/prodotti/s_$img");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>";
	</script>
<?php 
} 

if ($azione=="attivas") $query_nov = $open_connection->connection->query("update prodotti set stato='1' where id='$id_canc'");
if ($azione=="disattivas") $query_nov = $open_connection->connection->query("update prodotti set stato='0' where id='$id_canc'");

if ($azione=="attiva_dem") {
	$query_nov = $open_connection->connection->query("update prodotti set dem='1' where id='$id_canc'");
	//$last_id=$id_canc;
	include("genera_html_newsletter.php");
}
if ($azione=="disattiva_dem") {
	$query_nov = $open_connection->connection->query("update prodotti set dem='0' where id='$id_canc'");
	//$last_id=$id_canc;
	include("genera_html_newsletter.php");
}

if ($azione=="attiva") $query_nov = $open_connection->connection->query("update prodotti set vetrina='1' where id='$id_canc'");
if ($azione=="disattiva") $query_nov = $open_connection->connection->query("update prodotti set vetrina='0' where id='$id_canc'");

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc", "id_rife", "$ric_cat", "id_riferimento", "$ric_sottocat") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc", "id_rife", "$ric_cat", "id_riferimento", "$ric_sottocat") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc", "id_rife", "$ric_cat", "id_riferimento", "$ric_sottocat") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc", "id_rife", "$ric_cat", "id_riferimento", "$ric_sottocat") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos", "id_rife", "$ric_cat", "id_riferimento", "$ric_sottocat") ;
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		</script>
	<?php }
}

if ($azione=="modifica_cat" && $id_canc) {
	if (isset($_POST['id_rife_'.$id_canc])) $id_rife_cat = $_POST['id_rife_'.$id_canc];
			else $id_rife_cat = "";
			
	$query_agg_cat = "update prodotti set id_rife='$id_rife_cat' where id='$id_canc'";
	$risu_agg_cat = $open_connection->connection->query($query_agg_cat);
}

if ($azione=="modifica_sotto" && $id_canc) {
	if (isset($_POST['id_riferimento_'.$id_canc])) $id_rife_sotto = $_POST['id_riferimento_'.$id_canc];
			else $id_rife_sotto = "";
			
	$query_agg_sotto = "update prodotti set id_riferimento='$id_rife_sotto' where id='$id_canc'";
	$risu_agg_sotto = $open_connection->connection->query($query_agg_sotto);
}

if ($azione=="offerta" && $id_canc) {
	$query_dett = "select * from prodotti where id='$id_canc'";
	$risu_dett = $open_connection->connection->query($query_dett);
	$arr_rec = $risu_dett->fetch();
	
	$n_nome = $arr_rec['nome'];
	$n_cat = $arr_rec['id_rife'];
	$n_sotto = $arr_rec['id_riferimento'];
	$n_codice = $arr_rec['codice'];
	$n_foto = $arr_rec['img'];
	$n_descr = htmlentities($arr_rec['descr'], ENT_QUOTES);
	$n_pezzi = $arr_rec['quantita'];
	$n_prezzo = $arr_rec['prezzo'];
	$n_prezzo_list = $arr_rec['prezzo_listino'];
	$n_sconto = $arr_rec['sconto'];
	$n_forn = $arr_rec['marca'];
	
	$ord_off = $oggetto_admin->trova_ordine("offerte");
	$query_off = "insert into offerte (ordine, nome, codice, id_rife, id_riferimento, marca, img, descr, quantita, prezzo_listino, sconto, prezzo, stato) values ('$ord_off', \"$n_nome\", '$n_codice', '$n_cat', '$n_sotto', \"$n_forn\", \"$n_foto\", \"$n_descr\", '$n_pezzi', '$n_prezzo_list', '$n_sconto', '$n_prezzo', '0')";
	$risu_off = $open_connection->connection->query($query_off);
	
	if ($risu_off) {
		$id_ultima = mysql_insert_id();
				
		$query_agg = "update prodotti set stato='0' where id='$id_canc'";
		$risu_agg = $open_connection->connection->query($query_agg);
?>
		<script language="javascript">
			window.location = "admin.php?cmd=offerte_mod&id_rec=<?php  echo $id_ultima; ?>";
		</script>
<?php 
	}
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/prodotti/$img")) @unlink("img_up/prodotti/$img");
			if (is_file("img_up/prodotti/s_$img")) @unlink("img_up/prodotti/s_$img");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		</script>
	<?php 	
}
?>
<script type="text/javascript">
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
	
	var lista_ind=new Array();
	var lista_del="";
	var lista_tutti="";
	function aggiungi_lista(id_check, id_campo){
		if(document.getElementById('check_'+id_check).checked){
			lista_del+=""+id_campo+";";
		} else {
			lista_del = lista_del.replace(id_campo+";", "");
		}
		if(lista_del!=""){
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?>&azione=cancella_sel&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
		}
	}
	
	function aggiugni_tutti(){
		start = document.getElementById('start').innerHTML;
		end = document.getElementById('end').innerHTML;
		total = document.getElementById('total').innerHTML;

		if(document.getElementById('check_tutti').checked){
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[i]+";";
			}
			for(i=start; i<=end; i++){
				document.getElementById('check_'+i).checked=true;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			for(i=start; i<=total; i++){
				document.getElementById('check_'+i).checked=false;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}
	
	function set_sotto(id_cat){
		var stringa="";
		<?php 
		$query_ct="SELECT id FROM categorie ORDER BY id ASC";
		$resu_ct=$open_connection->connection->query($query_ct);
		while($risu_ct=$resu_ct->fetch()){?>
			if (id_cat=='<?php echo $risu_ct['id'];?>'){
				stringa+='<select name="ric_sottocat" class="small" style="width:90%">';
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
					stringa='<select name="ric_sottocat" class="small" style="width:90%" disabled>';
					stringa+='<option value=""></option>';		
					stringa+='</select>';
				<?php }?>
			}
		<?php }?>
		if(id_cat==""){
			stringa+='<select name="ric_sottocat" class="small" style="width:90%" disabled>';
			stringa+='<option value=""></option>';		
			stringa+='</select>';
		}
		document.getElementById('select_sottocat').innerHTML=stringa;
	}
</script>
<div class="mws-panel grid_8">

	<iframe src="" style="display:none; width:200px; height:200px; margin-top:5px;" id="frame_inv" frameborder=0 ></iframe>
	
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b><?php echo ucfirst($table);?></b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<iframe src="" style="display:none" id="frame_action"></iframe>
	<iframe src="" style="display:none" id="frame_action2"></iframe>
	
	<script type="text/javascript">
		var open=0;
		function apri_ricerca(){
			if(open==0){
				open=1;
				$("#searchPanel").animate({height:"190px"});
				document.getElementById('searchHeader').innerHTML='<span><i class="fa fa-search-minus" style="color:#fff"></i> Ricerca</span>';
			} else {
				open=0;
				$("#searchPanel").animate({height:"0px"});
				document.getElementById('searchHeader').innerHTML='<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca</span>';
			}
		}
	</script>
	
	<div class="mws-panel-header" style="cursor:pointer;" onclick="apri_ricerca();" id="searchHeader">
		<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca</span>
	</div>
	<div class="mws-panel-body no-padding" style="height:0px; overflow:hidden" id="searchPanel">
		<form name="ricerca" class="mws-form" action="admin.php" method="GET" enctype="multipart/form-data">
			<input type="hidden" name="ric_stato" value="inviato">
			<input type="hidden" name="cmd" value="<?php echo $table;?>">
			
			<div class="mws-form-inline">
								
				<div class="mws-form-row">
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Categoria</label>						
					</div>
					<div style="float:left; width:35%;">
							<select name="ric_cat" class="small" style="width:90%" onchange="set_sotto(this.value);">
								<option value="">Seleziona</option>
								<?php 
								$query_cat="SELECT * FROM categorie ORDER BY ordine DESC";
								$resu_cat=$open_connection->connection->query($query_cat);
								while($risu_cat=$resu_cat->fetch()){?>
									<option value="<?php echo $risu_cat['id'];?>" <?php if($ric_cat==$risu_cat['id']){?>selected="selected"<?php }?>><?php echo $risu_cat['nome'];?></option>
								<?php }?>					
							</select>
					</div>
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Sottocategoria</label>						
					</div>
					<div style="float:left; width:35%;" id="select_sottocat">
						
						<?php 
						$num_sottocat=0;
						if($ric_cat!=""){
							$query_sottocat="SELECT * FROM sottocategorie WHERE id_rife='$ric_cat' ORDER BY ordine DESC";
							$resu_sottocat=$open_connection->connection->query($query_sottocat);
							$num_sottocat=$resu_sottocat->rowCount();
						}?>
						<select name="ric_sottocat" class="small" style="width:90%" <?php if($num_sottocat=="0"){?>disabled<?php }?>>
							<?php if($num_sottocat>0){
								while($risu_sottocat=$resu_sottocat->fetch()){?>
									<option value="<?php echo $risu_sottocat['id'];?>" <?php if($ric_sottocat==$risu_sottocat['id']){?>selected="selected"<?php }?>><?php echo $risu_sottocat['nome'];?></option>
								<?php }
							}?>
						</select>
					</div>
					<div style="clear:both;"></div>
				</div>
				
				<div class="mws-form-row">					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Nome</label>
					</div>
					<div style="float:left; width:85%;">
						<input type="text" name="ric_nome" value="<?php echo $ric_nome;?>" style="width:95%"/>
					</div>
					<div style="clear:both;"></div>
				</div>	
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Cerca" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="window.location='admin.php?cmd=prodotti'">
			</div>
		</form>
	</div>
	
	<div style="display:flex; justify-content:space-between; margin-top:20px;">
		<div></div>
		<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi prodotto</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header" style="position:relative;">
		<span><i class="icon-table"></i> Elenco <?php echo $table;?></span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th></th>
					<th style="width:150px">Foto</th>
					<!--<th>Categoria</th>
					<th>Sottocategoria</th>-->
					<th style="text-align:left">Nome</th>	
					<th style="text-align:left">Colore</th>			
					<th style="width:250px;" id="blocco_5">Qta</th>
					<th id="blocco_6">Prezzo</th>				
					<th style="width:20px">Colori</th>	
					<?php /*<th style="width:15px" id="blocco_8">Visibile</th>*/?>
					<th style="text-align:left;">Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 	
				$query_ele = "SELECT * FROM $table WHERE 1 AND (id_rife_varianti IS NULL OR id_rife_varianti=id) $criterio";
				//echo $query_ele;
				$risu_ele = $open_connection->connection->query($query_ele);
				$num_item=$risu_ele->rowCount();
				
				$rec_pag=20;					
				$pag_tot=ceil($num_item/$rec_pag);					
				$start=($pag_att-1)*$rec_pag;
				
				$query_ele = "SELECT * FROM $table WHERE 1 AND (id_rife_varianti IS NULL OR id_rife_varianti=id) $criterio ORDER BY ordine DESC LIMIT $start,$rec_pag";
				//echo $query_ele;
				$risu_ele = $open_connection->connection->query($query_ele);
				$num_ele=$risu_ele->rowCount();
				
				
				$cont=0;
				for($x=0;$x<$num_ele;$x++)
				{						
					$arr_ele = $risu_ele->fetch();
					$nome = ucfirst($arr_ele['nome']);
					$id_cat = $arr_ele['id_rife'];
					$id_sotto = $arr_ele['id_riferimento'];
					$id_campo = $arr_ele['id'];
					$stato = $arr_ele['stato'];
					$quantita = $arr_ele['quantita'];
					$prezzo = $arr_ele['prezzo'];
					
					if (isset(${"id_rife_".$id_campo}) && ${"id_rife_".$id_campo}=="") ${"id_rife_".$id_campo} = $id_cat;
					if (isset(${"id_riferimento_".$id_campo}) && ${"id_riferimento_".$id_campo}=="") ${"id_riferimento_".$id_campo} = $id_sotto;
					
					$query_cat1 = "select nome from categorie where id='$id_cat'";
					$risu_cat1 = $open_connection->connection->query($query_cat1);
					list($nome_cat1) = $risu_cat1->fetch();
					$nome_cat1 = ucfirst($nome_cat1);
					
					$query_sotto1 = "select nome from sottocategorie where id='$id_sotto'";
					$risu_sotto1 = $open_connection->connection->query($query_sotto1);
					list($nome_sotto1) = $risu_sotto1->fetch();
					$nome_sotto1 = ucfirst($nome_sotto1);
		?>
					<script type="text/javascript">
						lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
					</script>
		<?php 
					if ($id_campo==$id_rec) echo "<tr style=\"background:#d8f8b5\">";
					elseif($cont==1) echo "<tr style=\"background:#F1F1F1\">";
						else echo "<tr>";
		?>
						<td align="center" valign="center">
							<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
						</td>
						<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
						<td align="center" valign="center">
							<div style="position:relative; cursor:pointer;" onclick="vedi_foto('<?php echo $id_campo;?>')">
								<?php 
								$query_f="SELECT img FROM prodotti_foto WHERE id_rife='$id_campo' ORDER BY ordine DESC LIMIT 0,1";
								$resu_f=$open_connection->connection->query($query_f);
								list($img)=$resu_f->fetch();
					
								if(file_exists("img_up/prodotti/s_$img")) $ante = "img_up/prodotti/s_$img";
								elseif(file_exists("img_up/prodotti/$img")) $ante = "img_up/prodotti/$img";
								else $ante = "https://www.yccs.it/resarea/img_up/prodotti/$img";
								?>
								<?php if($img){?>
									<img src="<?php echo $ante;?>" alt="" style="width:100%"/>
								<?php }else{?>
									<div style="width:100%; height:80px;"></div>
								<?php }?>
								<div style="position:absolute; width:20px; height:20px; border-radius:10px; bottom:2px; right:2px; background:#000; cursor:pointer;" onclick="vedi_foto('<?php echo $id_campo;?>')">
									<div style="position:absolute; color:#fff; width:100%; text-align:center; font-size:0.8em">
										<?php 
										$query_f="SELECT id FROM prodotti_foto WHERE id_rife='$id_campo'";
										$resu_f=$open_connection->connection->query($query_f);
										$num_f=$resu_f->rowCount();
										?>
										<b><?php echo $num_f;?></b>
									</div>
								</div>
							</div>
						</td>
						<td>
							<?php if($arr_ele['nome'] && $arr_ele['nome']!=""){?><img src="../images/it.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $arr_ele['nome']; ?><br/><?php }?>
							<?php if($arr_ele['nome_eng'] && $arr_ele['nome_eng']!=""){?><img src="../images/en.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $arr_ele['nome_eng']; ?><br/><?php }?>
							<?php /*<span style="font-size:0.9em"><?php echo $nome_cat1;?></span><br/>
							<span style="font-size:0.9em"><?php echo $nome_sotto1;?></span>*/?>
						</td>
						
						<td>
							<?php 
							$query_col = "select nome from colori where id='".$arr_ele['colore']."'";
							$risu_col = $open_connection->connection->query($query_col);
							list($nome_col) = $risu_col->fetch();
							echo $nome_col;
							?>
						</td>
						
						<td  align="center" valign="center" id="vis_<?php echo $id_campo;?>">
							<?php if(!$arr_ele['tipo_taglia'] || $arr_ele['tipo_taglia']==""){?>
								<div style="cursor:pointer;" class="btn btn-sm" id="testo_quant_<?php echo $id_campo;?>" onclick="this.style.display='none'; document.getElementById('campo_quant_<?php echo $id_campo;?>').style.display='block';"><?php echo $quantita;?></div>
								<div style="display:none" id="campo_quant_<?php echo $id_campo;?>">
									<input type="text" name="" id="valore_quant_<?php echo $id_campo;?>" value="<?php echo $quantita;?>" style="width:40px;"/>
									<span style="cursor:pointer;" onclick="modifica_quant_<?php echo $id_campo;?>(document.getElementById('valore_quant_<?php echo $id_campo;?>').value)"><i class="fa fa-pencil"></i></span>
									<span style="cursor:pointer;" onclick="modifica_quant_<?php echo $id_campo;?>('0')"><i class="fa fa-eraser"></i></span>
									<span style="cursor:pointer;" onclick="modifica_quant_<?php echo $id_campo;?>('<?php echo $quantita;?>')"><i class="fa fa-times-circle"></i></span>
									<script type="text/javascript">
										function modifica_quant_<?php echo $id_campo;?>(val){
											if(is_int(val)){
												document.getElementById('testo_quant_<?php echo $id_campo;?>').style.display='block'; 
												document.getElementById('campo_quant_<?php echo $id_campo;?>').style.display='none';
												document.getElementById('valore_quant_<?php echo $id_campo;?>').value=val;
												document.getElementById('testo_quant_<?php echo $id_campo;?>').innerHTML=val;
												document.getElementById('frame_inv').src="frame/modifica_quant2.php?id_prod=<?php echo $id_campo;?>&quant="+val;
											} else alert('inserire un numero intero');
										}
									</script>
								</div>
							<?php }else{?>
								<div style="display:none; width:250px;" id="qta_taglie_<?php echo $id_campo;?>"> 
									<?php 
									$query_tg="SELECT * FROM valori_taglia WHERE id_tipo='".$arr_ele['tipo_taglia']."' ORDER BY ordine DESC";
									$resu_tg=$open_connection->connection->query($query_tg);
									while($risu_tg=$resu_tg->fetch()){
										$query_q="SELECT quantita,id FROM quantita_taglie WHERE id_prodotto='$id_campo' AND id_valore='".$risu_tg['id']."'";
										//echo $query_q;
										$resu_q=$open_connection->connection->query($query_q);
										$risu_q=$resu_q->fetch();
										$num_q = $resu_q->rowCount();
										?>
										<div style="float:left; margin-right:7px; margin-top:5px; width:150px; text-align:right;text-align:right;"><?php echo $risu_tg['valore'];?>:</div>
										<div style="float:left; width:90px; text-align:left;">
											<div style="margin-top:5px; cursor:pointer;" onclick="this.style.display='none'; document.getElementById('q_taglia_mod_<?php echo $risu_q['id'];?>').style.display='block';" id="q_taglia_<?php echo $risu_q['id'];?>">
												<b><?php if(isset($risu_q['quantita']) && $risu_q['quantita']!="") echo $risu_q['quantita']; else echo "0";?></b>
											</div>
											<div style="display:none" id="q_taglia_mod_<?php echo $risu_q['id'];?>">
												<?php 												
												if(isset($risu_q['quantita']) && $risu_q['quantita']!="") $quant = $risu_q['quantita']; 
												else $quant = "0";
												?>
												<input type="text" name="" id="valore_<?php echo $risu_q['id'];?>" value="<?php echo $quant;?>" style="width:40px;"/>
												<span style="cursor:pointer;" onclick="modifica_<?php echo $risu_q['id'];?>(document.getElementById('valore_<?php echo $risu_q['id'];?>').value)"><i class="fa fa-pencil"></i></span>
												<span style="cursor:pointer;" onclick="modifica_<?php echo $risu_q['id'];?>('0')"><i class="fa fa-eraser"></i></span>
												<span style="cursor:pointer;" onclick="modifica_<?php echo $risu_q['id'];?>('<?php echo $quant;?>')"><i class="fa fa-times-circle"></i></span>
												<script type="text/javascript">
													function modifica_<?php echo $risu_q['id'];?>(val){
														if(is_int(val)){
															document.getElementById('q_taglia_<?php echo $risu_q['id'];?>').style.display='block'; 
															document.getElementById('q_taglia_mod_<?php echo $risu_q['id'];?>').style.display='none';
															document.getElementById('valore_<?php echo $risu_q['id'];?>').value=val;
															document.getElementById('q_taglia_<?php echo $risu_q['id'];?>').innerHTML='<b>'+val+'</b>';
															document.getElementById('frame_inv').src="frame/modifica_quant.php?id_taglia=<?php echo $risu_q['id'];?>&quant="+val;
														} else alert('inserire un numero intero');
													}
												</script>
											</div>
										</div>
										<div style="clear:both; height:5px"></div>										
									<?php }?>
								</div>
								<div style="font-size:0.9em; cursor:pointer" onclick="apri_taglie_<?php echo $id_campo;?>()" id="testo_taglie_<?php echo $id_campo;?>">vedi Qta taglie <i class="fa fa-caret-down"></i></div>
								<script type="text/javascript">
									var taglie_<?php echo $id_campo;?>='0';
									function apri_taglie_<?php echo $id_campo;?>(){
										if(taglie_<?php echo $id_campo;?>=='0'){
											taglie_<?php echo $id_campo;?>='1';
											document.getElementById('qta_taglie_<?php echo $id_campo;?>').style.display='block';
											document.getElementById('testo_taglie_<?php echo $id_campo;?>').innerHTML='<i class="fa fa-angle-up fa-2x"></i>';
										}else{
											taglie_<?php echo $id_campo;?>='0';
											document.getElementById('qta_taglie_<?php echo $id_campo;?>').style.display='none';
											document.getElementById('testo_taglie_<?php echo $id_campo;?>').innerHTML='vedi Qta taglie <i class="fa fa-caret-down"></i>';
										}
									}
								</script>
							<?php }?>
						</td>
						
						<td align="center" valign="center" id="vis_ing_<?php echo $id_campo;?>">							
							<div style="" id="campo2_prezzo_<?php echo $x;?>"><?php echo $prezzo;?> &euro;</div>
						</td>
						
						<td align="center">
								<?php 
								$query_var="SELECT id FROM prodotti WHERE id_rife_varianti='$id_campo'";
								$resu_var=$open_connection->connection->query($query_var);
								$num_var=$resu_var->rowCount();
								if($num_var>1){?>
									<span style="color:#000; cursor:pointer;" onclick="vedi_varianti('<?php echo $id_campo;?>')"><u><?php echo $num_var;?></u></span>
								<?php }else{?>
									<i class="fa fa-plus-circle" style="cursor:pointer" onclick="vedi_varianti('<?php echo $id_campo;?>')"></i>
								<?php }?>
							
						</td>	
						<?php /*
						<td  align="center" valign="center" id="ev_ing_<?php echo $id_campo;?>">
							<div style="" id="campo4_prezzo_<?php echo $x;?>">
							<?php 
								if ($stato==0) echo "<a href=\"admin.php?cmd=prodotti&azione=attivas&id_canc=$id_campo&pag_att=$pag_att$rif\"><img src=\"css/icons/icol32/accept_22_off.png\" alt=\"Rendi visibile\"/></a>";
									else echo "<a href=\"admin.php?cmd=prodotti&azione=disattivas&id_canc=$id_campo&pag_att=$pag_att$rif\"><img src=\"css/icons/icol32/accept_22.png\" alt=\"Rendi non visibile\"/></a>";
	
							?>
							</div>
						</td>*/?>
						
						
						<td style="width:10%" valign="center">
							<span class="btn-group">
								<?php if($num_var==1){?>
									<?php if ($stato==0){?>
										<a href="admin.php?cmd=prodotti&azione=attivas&id_canc=<?php echo $id_campo;?>&pag_att=<?php echo $pag_att;?><?php echo $rif;?>" title="Rendi visibile" class="btn btn-small"><i class="fa fa-circle-o"></i></a>
									<?php }else{?>
										<a href="admin.php?cmd=prodotti&azione=disattivas&id_canc=<?php echo $id_campo;?>&pag_att=<?php echo $pag_att;?><?php echo $rif;?>" title="Rendi non visibile" class="btn btn-small" style="color:green"><i class="fa fa-circle"></i></a>
									<?php }?>
								<?php }else{?>
									<span  class="btn btn-small">&nbsp;&nbsp;</span>
								<?php }?>
								
								<?php if($ric_cat!="" && $ric_sottocat!=""){?>
									<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
									<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
									<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
									<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
									<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
										<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
										<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
											<form action="admin.php" method="GET">
												<input type="hidden" name="cmd" value="<?php echo $table;?>"/>
												<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
												<input type="hidden" name="azione" value="cambia"/>
												<input type="hidden" name="ric_cat" value="<?php echo $ric_cat;?>"/>
												<input type="hidden" name="ric_sottocat" value="<?php echo $ric_sottocat;?>"/>
												<input type="text" name="new_pos" value="<?php echo $x+1;?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
											</form>
										</div>
									</div>
								<?php }?>
								
								<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
								<?php if($num_var==1){?>
									<a  href="admin.php?cmd=<?php echo $table;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" onClick="return confirm('Cancellare l\'elemento?')" class="btn btn-small"><i class="icon-trash"></i></a>
								<?php }else{?>
									<span  class="btn btn-small">&nbsp;&nbsp;</span>
								<?php }?>
							</span>
						</td>
					</tr>
					<?php $cont++;
					if($cont==2) $cont=0;
				}?>
			</tbody>
		</table>
		
		<?php include("fissi/multipagina.inc.php");?>
		
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>

<div class="popup" id="box_var">
	<iframe src="" style="width:100%; height:100%; margin-top:5px;" id="frame_var" frameborder=0 ></iframe>
	<div style="position:absolute; top:15px; right:25px; width:20px; height:20px; cursor:pointer; text-align:center;" onclick="document.getElementById('box_var').style.display='none'; window.location='<?php echo $_SERVER['REQUEST_URI'];?>';">
		<i class="fa fa-times-circle fa-2x"></i>		
	</div>
</div>

<script type="text/javascript">
	function vedi_varianti(id_var){
		$("#box_var").fadeIn();
		document.getElementById('frame_var').src="frame/varianti.php?id_var="+id_var;	
	}
	function vedi_foto(id_prod){
		$("#box_var").fadeIn();
		document.getElementById('frame_var').src="frame/foto_prodotti.php?id_prod="+id_prod;	
	}
</script>


