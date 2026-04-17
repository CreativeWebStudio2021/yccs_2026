<?php 
$table="ya_risultati";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";
if(isset($_GET['anno'])) $anno=$_GET['anno']; else $anno="";

$rif="";
$criterio="";
if($anno!=""){
	$rif="&anno=$anno";
	$criterio.=" AND anno='$anno'";
}

if($azione=="cancella" && $id_canc!="")
{	
	
	$query_canc_img = "select img from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/ya_risultati/$img")) @unlink("img_up/ya_risultati/$img");
		if (is_file("img_up/ya_risultati/s_$img")) @unlink("img_up/ya_risultati/s_$img");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc");
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
	
	if($azione=="attiva") $open_connection->connection->query("update ya_risultati set visibile='1' where id='$id_canc'") ;
	if($azione=="disattiva") $open_connection->connection->query("update ya_risultati set visibile='0' where id='$id_canc'") ;
}

if($azione=="cambia_stato") {
	$query_stato="SELECT risultati FROM ya_elements WHERE id='1'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	
	if($stato=="1") $new_stato="0";
	else $new_stato="1";
	
	$query_up="UPDATE ya_elements SET risultati='$new_stato' WHERE id='1'";
	echo $query_up;
	$risu_up=$open_connection->connection->query($query_up);
	
	?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 
}

if($azione=="cambia_stato_home") {
	$query_stato="SELECT risultati_home FROM ya_elements WHERE id='1'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	
	if($stato=="1") $new_stato="0";
	else $new_stato="1";
	
	$query_up="UPDATE ya_elements SET risultati_home='$new_stato' WHERE id='1'";
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
		$query_canc_img = "select img,video from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img,$video) = $risu_canc_img->fetch();
			if (is_file("img_up/ya_risultati/$img")) @unlink("img_up/ya_risultati/$img");
			if (is_file("img_up/ya_risultati/s_$img")) @unlink("img_up/ya_risultati/s_$img");
			if (is_file("files/ya_risultati/$video")) @unlink("files/ya_risultati/$video");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?>';
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
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[i]+";";
			}
			for(i=start; i<=end; i++){
				document.getElementById('check_'+i).checked=true;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			for(i=start; i<=total; i++){
				document.getElementById('check_'+i).checked=false;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}
</script>
<div class="mws-panel grid_8">
	<?php 
	$query_stato="SELECT risultati FROM ya_elements WHERE id='1'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	?>

	<div style="width:100%; height:40px; margin-bottom:5px;">
		<div style="float:right; ">
			<a href="admin.php?cmd=<?php echo $table;?>&azione=cambia_stato<?php echo $rif;?>">
				<?php if($stato=="1"){?>
					<div class="btn" style="background:red; color:#fff">Nascondi</div>
				<?php }else{?>
					<div class="btn" style="background:green; color:#fff">Attiva</div>
				<?php }?>
			</a>
		</div>
		<div style="float:right; margin-top:5px; margin-right:10px;">
			<?php if($stato=="1"){?><span style="color:green"><b>PAGINA RISULTATI VISIBILE</b></span><?php }else{?><span style="color:red"><b>PAGINA RISULTATI NON VISIBILE</b></span><?php }?>
		</div>
	</div>
	<?php 
	$query_stato="SELECT risultati_home FROM ya_elements WHERE id='1'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	?>

	<div style="width:100%; height:40px; margin-bottom:5px;">
		<div style="float:right; ">
			<a href="admin.php?cmd=<?php echo $table;?>&azione=cambia_stato_home<?php echo $rif;?>">
				<?php if($stato=="1"){?>
					<div class="btn" style="background:red; color:#fff">Nascondi</div>
				<?php }else{?>
					<div class="btn" style="background:green; color:#fff">Attiva</div>
				<?php }?>
			</a>
		</div>
		<div style="float:right; margin-top:5px; margin-right:10px;">
			<?php if($stato=="1"){?><span style="color:green"><b>RISULTATI IN HOME VISIBILE</b></span><?php }else{?><span style="color:red"><b>RISULTATI IN HOME NON VISIBILE</b></span><?php }?>
		</div>
	</div>
	
	
	
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Risultati Young Azzurra</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="height:30px;width:50%;float:left; text-align:left">
		<select name="anno" onchange="window.location='admin.php?cmd=ya_risultati&anno='+this.value+'&pag_att=1'">
			<option value="">Seleziona Anno</option>
			<option value="">Tutti</option>
			<?php 
			$query_a="SELECT DISTINCT anno FROM ya_risultati ORDER BY anno ASC";
			$resu_a=$open_connection->connection->query($query_a);
			while($risu_a=$resu_a->fetch()){?>
				<option value="<?php echo $risu_a['anno'];?>" <?php if($anno==$risu_a['anno']){?>selected="selected"<?php }?>><?php echo $risu_a['anno'];?></option>
			<?php }?>
		</select>
	</div>
	<div style="height:30px;width:150px;float:right; text-align:right">
		<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" style="color:#7a7a7a">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi risultato</b>
			</div>
		</a>
	</div>
	<div style="clear:both; height:20px"></div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Risultati Young Azzurra</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:200px">Foto</th>
					<th style="text-align:left">Evento</th>
					<th style="text-align:left">Risultato</th>
					<th>Visibile</th>
					<th style="text-align:left">Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY data_dal DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				$start = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					for($x=0;$x<$num_ele;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$nome_evento = $arr_ele['nome_evento'];
						$risultato = $arr_ele['risultato'];
						$luogo = $arr_ele['luogo'];
						$anno = $arr_ele['anno'];
						$data_dal = $arr_ele['data_dal'];
						$data_al = $arr_ele['data_al'];
						$id_campo = $arr_ele['id'];
						$foto = $arr_ele['img'];
						$vis = $arr_ele['visibile'];
						
						if(file_exists("img_up/ya_risultati/s_$foto")) $ante = "img_up/ya_risultati/s_$foto";
						elseif(file_exists("img_up/ya_risultati/$foto")) $ante = "img_up/ya_risultati/$foto";
						else $ante = "https://www.yccs.it/resarea/img_up/ya_risultati/$foto";
						
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>
					<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
					<td style="position:relative">
						<img src="<?php  echo $ante; ?>" style="width:200px"/>
					</td>
					<td>
						<?php  echo $nome_evento; ?><br/>
						da: <?php echo  $oggetto_admin->date_to_data($data_dal);?>, a: <?php echo  $oggetto_admin->date_to_data($data_al);?><br/>
						Luogo: <?php  echo $luogo; ?><br/>
						
					</td>
					<td><?php  echo $risultato; ?></td>
					<td align="center" valign="center">
						<?php   
						if ($vis==1) {?> 
							<a href="admin.php?cmd=ya_risultati&azione=disattiva&id_canc=<?php echo $id_campo.$rif;?>&pag_att=<?php echo $pag_att;?>" title="Rendi non visibile">
								<i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
							</a>
						<?php }else{?>
							<a href="admin.php?cmd=ya_risultati&azione=attiva&id_canc=<?php echo $id_campo.$rif;?>&pag_att=<?php echo $pag_att;?>" title="Rendi visibile">
								<i class="fa fa-circle-o fa-2x" aria-hidden="true"></i>
							</a>
						<?php }?>					
					</td>
					<td style="width:10%">
						<span class="btn-group">
							<?php /*<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
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
							</div>*/?>
							<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onclick="return confirm('Si conferma la cancellazione dell\'elemento?')" href="admin.php?cmd=<?php echo $table;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>	
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
