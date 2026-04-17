<?php 
$table="sail_talk_articolo";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['id_cat_ric'])) $id_cat_ric=$_GET['id_cat_ric']; else $id_cat_ric="";
if(isset($_GET['id_sottocat_ric'])) $id_sottocat_ric=$_GET['id_sottocat_ric']; else $id_sottocat_ric="";

$rif="";
$criterio="";

if($id_cat_ric!=""){$criterio .= " AND id_cat='$id_cat_ric'"; $rif.="&id_cat_ric=$id_cat_ric";}
if($id_sottocat_ric!=""){$criterio .= " AND id_sottocat='$id_sottocat_ric'"; $rif.="&id_sottocat_ric=$id_sottocat_ric";}

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc");
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos");			
	}
	
	if($azione=="cancella"){
		$query_canc_img = "select immagine from $table where id='$id_canc'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($logo) = $risu_canc_img->fetch();
			if (is_file("img_up/$logo")) @unlink("img_up/$logo");
			if (is_file("img_up/s_$logo")) @unlink("img_up/s_$logo");
		}
		
		$query_canc = "delete from $table where id='$id_canc'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia" || $azione=="cancella"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cambia_stato") {
	$query_stato="SELECT stato FROM sail_talk_stato WHERE id='1'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	
	if($stato=="1") $new_stato="0";
	else $new_stato="1";
	
	$query_up="UPDATE sail_talk_stato SET stato='$new_stato' WHERE id='1'";
	echo $query_up;
	$risu_up=$open_connection->connection->query($query_up);
	
	?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($logo) = $risu_canc_img->fetch();
			if (is_file("img_up/$logo")) @unlink("img_up/$logo");
			if (is_file("img_up/s_$logo")) @unlink("img_up/s_$logo");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=$table<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<?php 
	$query_stato="SELECT stato FROM sail_talk_stato WHERE id='1'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	?>

	<div style="width:100%; height:40px; margin-bottom:5px;">
		<div style="float:right; ">
			<a href="admin.php?cmd=<?php echo $table;?>&azione=cambia_stato<?php echo $rif;?>">
				<?php if($stato=="1"){?>
					<div class="btn" style="background:red; color:#fff" onclick="annulla()">Nascondi</div>
				<?php }else{?>
					<div class="btn" style="background:green; color:#fff" onclick="annulla()">Attiva</div>
				<?php }?>
			</a>
		</div>
		<div style="float:right; margin-top:5px; margin-right:10px;">
			<?php if($stato=="1"){?><span style="color:green"><b>SAIL TALK VISIBILE</b></span><?php }else{?><span style="color:red"><b>SAIL TALK NON VISIBILE</b></span><?php }?>
		</div>
	</div>
	
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Articoli</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="display:flex; justify-content:space-between; align-items:center;">
		<div style="height:30px;display:flex; gap:10px;">
			<div><b>Argomento</b></div>
			<div style="margin-top:-5px; ">
				<select name="id_cat_ric" class="small" onchange="window.location='admin.php?cmd=sail_talk_articolo&id_cat_ric='+this.value">
					<option value="">Seleziona</option>
					<?php 
					$query_m="SELECT * FROM sail_talk_macrocategorie ORDER BY ordine DESC";
					$resu_m=$open_connection->connection->query($query_m);
					while($risu_m=$resu_m->fetch()){?>
						<option value="<?php echo $risu_m['id'];?>" <?php if($risu_m['id']==$id_cat_ric){?>selected="selected"<?php }?>><?php echo $risu_m['nome'];?></option>
					<?php }?>					
				</select>
			</div>
			
			<div style=" margin-left:10px"><b>Categoria</b></div>
			<div style="margin-top:-5px;">
				<select name="id_sottocat_ric" class="small" onchange="window.location='admin.php?cmd=sail_talk_articolo&id_cat_ric=<?php echo $id_cat_ric;?>&id_sottocat_ric='+this.value">
					<option value="">Seleziona</option>
					<?php 
					$query_c="SELECT * FROM sail_talk_categorie WHERE id_cat='$id_cat_ric' ORDER BY ordine DESC";
					$resu_c=$open_connection->connection->query($query_c);
					while($risu_c=$resu_c->fetch()){?>
						<option value="<?php echo $risu_c['id'];?>" <?php if($risu_c['id']==$id_sottocat_ric){?>selected="selected"<?php }?>><?php echo $risu_c['nome'];?></option>
					<?php }?>					
				</select>
			</div>								
			<div style="clear:both"></div>
		</div>								
		
		
		<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi articolo</b>
			</div>
		</a>
	</div>
	<div style="clear:both; height:10px;"></div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Articoli</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:80px">Data</th>
					<th style="width:150px">Foto</th>
					<th style="text-align:left">Titolo</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from $table WHERE 1 $criterio order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{		
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY ordine DESC LIMIT $start,$rec_pag";
					//echo $query_ele;
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$foto = $arr_ele['immagine'];
						$tit = $oggetto_admin->puntini(ucfirst($arr_ele['titolo']));
						$data = $oggetto_admin->date_to_data($arr_ele['data_articolo']);
						$id_cat = $arr_ele['id_cat'];
						$id_sottocat = $arr_ele['id_sottocat'];
						$visibile = $arr_ele['visibile'];
						$evidenza = $arr_ele['evidenza'];
						$id_campo = $arr_ele['id'];
						$codice = $arr_ele['codice'];
						
						if($id_cat){
							$query_c="SELECT nome FROM sail_talk_macrocategorie WHERE id='$id_cat'";
							$resu_c=$open_connection->connection->query($query_c);
							list($nome_cat)=$resu_c->fetch();
						}
						
						if($id_sottocat){
							$query_c2="SELECT nome FROM sail_talk_categorie WHERE id='$id_sottocat'";
							$resu_c2=$open_connection->connection->query($query_c2);
							list($nome_sottocat)=$resu_c2->fetch();
						}
						
						if(file_exists("img_up/sail_talk/s_$foto")) $ante = "img_up/sail_talk/s_$foto";
						elseif(file_exists("img_up/sail_talk/$foto")) $ante = "img_up/sail_talk/$foto";
						else $ante = "https://www.yccs.it/resarea/img_up/sail_talk/$foto";
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
					<td align="center" valign="center"><?php  echo $data; ?></td>
					<td align="center" valign="center">
						<img src="<?php  echo $ante; ?>" alt=""/>
					</td>
					<td>
						<?php  echo $tit; ?><br/>
						<span style="font-size:0.9em"><i><?php if($id_cat){?><?php echo $nome_cat;?><?php }?><?php if($id_sottocat){?> - <?php echo $nome_sottocat;?><?php }?></i></span>
						<?php 
						$link_sail_talk ="../sail_talk/";							
						if($id_cat) $link_sail_talk.=to_htaccess_url($nome_cat,"")."/";							
						if($id_sottocat) $link_sail_talk.=to_htaccess_url($nome_sottocat,"")."/";							
						$link_sail_talk.=to_htaccess_url($tit,"");
						$link_sail_talk.="-".$id_campo.".html";
						
						$link_sail_talk_code = "$http://$ind_sito/sail_talk/$codice-$id_campo";
						?>
						
						<div id="testo_link_<?php echo $id_campo;?>" style="<?php if($stato==1 && $visibile=='1'){?>display:none;<?php }?>">
							<input type="text" id="link_<?php echo $id_campo;?>" style="width:80%" readonly value="<?php echo $link_sail_talk_code;?>"/><a class="btn btn-small"  style="cursor:pointer;" onclick="copyLink('<?php echo $id_campo;?>');"><i class="fa fa fa-clipboard" aria-hidden="true"></i></a>
						</div>
						
					</td>
					<td style="width:350px">
						
						<span class="btn-group">
							
							<a class="btn btn-small" href="<?php echo $link_sail_talk;?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>
						</span>
						<span class="btn-group">
							<a class="btn btn-small" id="visibile_<?php echo $id_campo;?>" style="cursor:pointer; color:<?php if($visibile=='0'){?>red<?php }else{?>green<?php }?>" onclick="visibile('<?php echo $id_campo;?>')"><i class="fa fa-eye" aria-hidden="true"></i></a>
							<a class="btn btn-small" id="evidenza_<?php echo $id_campo;?>" style="cursor:pointer; color:<?php if($evidenza=='0'){?>red<?php }else{?>green<?php }?>" onclick="evidenza('<?php echo $id_campo;?>')"><i class="fa fa-home" aria-hidden="true"></i></a>
							<?php if($id_cat_ric=="" && $id_sottocat_ric==""){?>
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
											<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
											<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
										</form>
									</div>
								</div>
							<?php }?>
							<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onClick="return confirm('Cancellare l\'elemento?')" href="admin.php?cmd=<?php echo $table;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
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

<iframe id="hiddenFrame" src="" style="display:none"></iframe>
<script>

  function visibile(id){
    if(document.getElementById('visibile_'+id).style.color=="red"){
      document.getElementById('visibile_'+id).style.color="green";      
      <?php if($stato==1){?>document.getElementById('testo_link_'+id).style.display="none";<?php }?>
    }else{
      document.getElementById('visibile_'+id).style.color="red";   
       <?php if($stato==1){?>document.getElementById('testo_link_'+id).style.display="block";  <?php }?>
    }
    document.getElementById('hiddenFrame').src="frame/sail_talk_cambiaVisibilita.php?id_articolo="+id;
  }

  function evidenza(id){
    if(document.getElementById('evidenza_'+id).style.color=="red"){
      document.getElementById('evidenza_'+id).style.color="green";      
    }else{
      document.getElementById('evidenza_'+id).style.color="red";
    }
    document.getElementById('hiddenFrame').src="frame/sail_talk_cambiaEvidenza.php?id_articolo="+id;
  }
  
  function copyLink(id) {
	  /* Get the text field */
	  var copyText = document.getElementById("link_"+id);

	  /* Select the text field */
	  copyText.select();

	  /* Copy the text inside the text field */
	  document.execCommand("copy");

	  /* Alert the copied text */
	  alert("Link copiato negli appunti");
	}
</script>
