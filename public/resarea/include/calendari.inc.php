<?php 
$table="documenti_edizioni";

$criterio="";
$rif="";

if(isset($_GET['anno_ric'])) $anno_ric=$_GET['anno_ric']; else $anno_ric='';
if($anno_ric!="") {
	$criterio.=" and anno='$anno_ric'";
	$rif.="&anno_ric=$anno_ric";
}

if(isset($_GET['tipo_ric'])) $tipo_ric=$_GET['tipo_ric']; else $tipo_ric='';
if($tipo_ric!="") {
	$criterio.=" and tipo='$tipo_ric'";
	$rif.="&tipo_ric=$tipo_ric";
}
	
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if($conferma)
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc_doc = "select pdf,pdf_eng from documenti_edizioni where id='$id_canc'";
	$risu_canc_doc = $open_connection->connection->query($query_canc_doc);
	if ($risu_canc_doc) {
		$num_canc_doc = $risu_canc_doc->rowCount();
		for ($f=0; $f<$num_canc_doc; $f++) {
			list($doc,$doc_eng) = $risu_canc_doc->fetch();
			if (is_file("files/edizioni/$doc")) @unlink("files/edizioni/$doc");
			if (is_file("files/edizioni/$doc_eng")) @unlink("files/edizioni/$doc_eng");
		}
	}
				
	$query_canc = "delete from documenti_edizioni where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=calendari<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("documenti_edizioni", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento") ;
	if($azione=="scendi") $oggetto_admin->scendi("documenti_edizioni", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento") ;
	if($azione=="primo") $oggetto_admin->primo("documenti_edizioni", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");
	if($azione=="ultimo") $oggetto_admin->ultimo("documenti_edizioni", "$id_canc", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");	
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("documenti_edizioni", "$id_canc", "$new_pos", "id_regata" , "$id_rife", "id_edizione", "$id_riferimento");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=calendari<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){		
		$query_canc_doc = "select pdf,pdf_eng from documenti_edizioni where id='".$temp[$z]."'";
		$risu_canc_doc = $open_connection->connection->query($query_canc_doc);
		if ($risu_canc_doc) {
			$num_canc_doc = $risu_canc_doc->rowCount();
			for ($f=0; $f<$num_canc_doc; $f++) {
				list($doc,$doc_eng) = $risu_canc_doc->fetch();
				if (is_file("files/edizioni/$doc")) @unlink("files/edizioni/$doc");
				if (is_file("files/edizioni/$doc_eng")) @unlink("files/edizioni/$doc_eng");
			}
		}
				
		$query_canc = "delete from documenti_edizioni where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=calendari<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 	
}

?>
<script type="text/javascript">
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
			document.getElementById('cancella_sel').href='admin.php?cmd=calendari<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
		}
	}
	
	function aggiugni_tutti(){
		start = document.getElementById('start').innerHTML;
		end = document.getElementById('end').innerHTML;
		total = document.getElementById('total').innerHTML;
		
		if(document.getElementById('check_tutti').checked){
			ind_lista = 0;
			ind_check = 1;
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[ind_lista]+";";
				ind_lista++;
			}
			for(i=start; i<=end; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=true;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=calendari<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			ind_check = 1;
			for(i=start; i<=total; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=false;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}
</script>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Documenti delle edizioni</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<iframe src="" style="display:none" id="hiddenFrame"></iframe>
	
	<div class="mws-panel-header" style="cursor:pointer;" onclick="apri_ricerca();" id="searchHeader">
		<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca documenti</span>
	</div>
	<div class="mws-panel-body no-padding" id="searchPanel">
		<form name="ricerca" class="mws-form" action="admin.php" method="GET" enctype="multipart/form-data">
			<input type="hidden" name="cmd" value="calendari">
			<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>">
			
			<div class="mws-form-inline">									
				<div class="mws-form-row">		
					<div style="float:left;width:20%">Tipo</div>
					<div style="float:left;width:30%">
						<select name="tipo_ric">
							<option value="">- Seleziona -</option>
							<option value="calendario" <?php if($tipo_ric=="calendario"){?>selected="selected"<?php }?>>Calendario regate</option>
							<option value="calendario_team" <?php if($tipo_ric=="calendario_team"){?>selected="selected"<?php }?>>Calendario team reacing</option>
							<option value="presentazione" <?php if($tipo_ric=="presentazione"){?>selected="selected"<?php }?>>Presentazione stagione</option>
						</select>
					</div>
					<div style="float:left;width:20%">Anno</div>
					<div style="float:left;width:30%">
						<input type="text" name="anno_ric" value="<?php  echo $anno_ric; ?>" />
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Cerca" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="window.location='admin.php?cmd=calendari'">
			</div>
		</form>
	</div>
			
	<div style="clear:both;height:20px">&nbsp;</div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=calendari_ins<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" style="color:#7a7a7a">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi documento</b>
			</div>
		</a>
	</div>	
	
	<div class="mws-panel-header" style="clear:both">
		<span><i class="icon-table"></i> Elenco documenti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th>Tipo</th>
					<th>Anno</th>
					<th>Allegato</th>
					<th style="width:80px">Link Fisso</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from documenti_edizioni WHERE 1 $criterio order by anno desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "select * from documenti_edizioni WHERE 1 $criterio order by anno desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$anno = $arr_ele['anno'];
						$tipo = ucfirst($arr_ele['tipo']);
						if ($tipo=="Calendario") $tipo = "Calendario regate";
							elseif ($tipo=="Calendario_team") $tipo = "Calendario team reacing";
							else $tipo = "Presentazione stagione";
						$file = $arr_ele['pdf'];
						$file_eng = $file;
						if(isset($arr_ele['pdf_eng']) && $arr_ele['pdf_eng']!="") $file_eng = $arr_ele['pdf_eng'];
						$fisso = $arr_ele['link_fisso'];
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>
					<td align="center" valign="center">
						<?php  echo $start+$x+1; ?>
					</td>
					<td><?php  echo $tipo; ?></td>
					<td><?php  echo $anno; ?></td>
					<td>
						<?php if(isset($arr_ele['pdf']) && $arr_ele['pdf']!=""){?>
							<div id="allegati_<?php echo $x;?>" style="display:<?php if($fisso==0){?>block<?php }else{?>none<?php }?>">
								Allegato ITA: <?php  echo $file; ?><br/>
								Allegato ENG: <?php  echo $file_eng; ?>
							</div>
							<div style="width:500px; display:<?php if($fisso==1){?>block<?php }else{?>none<?php }?>" id="links_<?php echo $x;?>">
								<?php 								
								$link_ita = $http."://".$ind_sito."/regate-$anno/calendario_regate";
								$link_eng = $http."://".$ind_sito."/en/regate-$anno/sporting_calendar";
								?>
								<div style="float:left; width:55px;  margin-top:6px;">
									Link Ita:
								</div>
								<div style="float:left;">
									<input type="text" style="width:400px;" value="<?php echo $link_ita;?>" id="link_fisso_ita_<?php echo $x;?>"/>
								</div>
								<div style="float:left; margin-left:5px; margin-top:2px;">
									<span  class="btn btn-small" style="cursor:pointer;" onclick="copy('link_fisso_ita_<?php echo $x;?>');" title="Copia" alt="Copia"><i class="fa fa-clipboard"></i></span>
								</div>
								<div style="clear:both; height:5px;"></div>
								
								<div style="float:left; width:55px;  margin-top:6px;">
									Link Eng:
								</div>
								<div style="float:left;">
									<input type="text" style="width:400px;" value="<?php echo $link_eng;?>" id="link_fisso_eng_<?php echo $x;?>"/>
								</div>
								<div style="float:left; margin-left:5px; margin-top:2px;">
									<span  class="btn btn-small" style="cursor:pointer;" onclick="copy('link_fisso_eng_<?php echo $x;?>');" title="Copia" alt="Copia"><i class="fa fa-clipboard"></i></span>
								</div>
								<div style="clear:both; height:5px;"></div>
							</div>
						<?php }?>
					</td>
					<td style="text-align:center;">
						<span id="fisso_<?php echo $x;?>" style="cursor:pointer;" <?php if(isset($arr_ele['pdf']) && $arr_ele['pdf']!=""){?>onclick="linkFisso_<?php echo $x;?>();"<?php }else{?>onclick="alert('Attivabile solo su documenti con allegato');"<?php }?>><i class="fa fa-circle" style="color:<?php if($fisso==1){?>green<?php }else{?>grey<?php }?>"></i></span>
						
						<script>
							var fisso_<?php echo $x;?>="<?php echo $fisso;?>";
							function linkFisso_<?php echo $x;?>(){
								if(document.getElementById("fisso_<?php echo $x;?>").innerHTML=='<i class="fa fa-circle" style="color:green"></i>'){									
									$("#fisso_<?php echo $x;?>").html('<i class="fa fa-circle" style="color:grey"></i>');
									document.getElementById('links_<?php echo $x;?>').style.display="none";
									document.getElementById('allegati_<?php echo $x;?>').style.display="block";
									document.getElementById('hiddenFrame').src="frame/link_fisso.php?tabella=documenti_edizioni&id_campo=<?php echo $id_campo;?>&val=0";
								}else{
									$("#fisso_<?php echo $x;?>").html('<i class="fa fa-circle" style="color:green"></i>');
									document.getElementById('links_<?php echo $x;?>').style.display="block";
									document.getElementById('allegati_<?php echo $x;?>').style.display="none";
									document.getElementById('hiddenFrame').src="frame/link_fisso.php?tabella=documenti_edizioni&id_campo=<?php echo $id_campo;?>&val=1";
								}
							}
						</script>
					</td>
					<td style="width:10%" align="center" valign="center">
						<span class="btn-group">
							<!--<a href="admin.php?cmd=calendari&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=calendari&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=calendari&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=calendari&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
								<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
								<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="calendari"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
									</form>
								</div>
							</div>-->
							<a href="admin.php?cmd=calendari_mod&id_rec=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a href="admin.php?cmd=calendari&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>
		<?php  include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
