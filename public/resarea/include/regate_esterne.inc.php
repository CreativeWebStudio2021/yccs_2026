<?php 
$table="regate_esterne";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if(isset($_POST['stato_modifica'])) $stato_modifica=$_POST['stato_modifica']; else $stato_modifica="";
if($stato_modifica=="inviato"){
	if(isset($_POST['testo'])) $testo=$_POST['testo']; else $testo="";
	if(isset($_POST['testo_eng'])) $testo_eng=$_POST['testo_eng']; else $testo_eng="";
	$query_up="UPDATE regate_esterne_testo SET testo='$testo',testo_eng='$testo_eng' WHERE 1";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script>
		window.location="admin.php?cmd=regate_esterne<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
	<?php 
}

$rif="";

if($azione=="cancella")
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
		
	$query_canc = "delete from regate_esterne where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=regate_esterne<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("regate_esterne", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("regate_esterne", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("regate_esterne", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("regate_esterne", "$id_canc");
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("regate_esterne", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=regate_esterne';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from regate_esterne where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($logo) = $risu_canc_img->fetch();
			if (is_file("img_up/$logo")) @unlink("img_up/$logo");
			if (is_file("img_up/s_$logo")) @unlink("img_up/s_$logo");
		}
		
		$query_canc = "delete from regate_esterne where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=regate_esterne';
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Regate Interclub</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<iframe src="" style="display:none" id="hiddenFrame"></iframe>
	<?php 
	$query_testo="SELECT testo, testo_eng FROM regate_esterne_testo WHERE id='1'";
	$resu_testo=$open_connection->connection->query($query_testo);
	list($testo, $testo_eng)=$resu_testo->fetch();
	?>
	<div class="mws-panel-header" style="cursor:pointer" id="bottTesto">
		<span><i class="icon-font"></i> Testo Pagina <i class="fa fa-caret-down" aria-hidden="true"></i></span>
	</div>
	<div class="mws-panel-body no-padding" style="display:none" id="testoPagina">
		<div style="padding:10px">
			<form name="modifica" method="POST" action="admin.php?cmd=regate_esterne">
				<input type="hidden" name="stato_modifica" value="inviato"/>
				<div style="padding-bottom:5px;"><b>Testo Ita</b></div>
				<div class="mws-form-inline">
					<textarea class="ckeditor" name="testo"><?php echo $testo;?></textarea>
				</div>	
				<div style="padding-top:15px; padding-bottom:5px;"><b>Testo Eng</b></div>				
				<div class="mws-form-inline">
					<textarea class="ckeditor" name="testo_eng"><?php echo $testo_eng;?></textarea>
				</div>
				<div class="mws-button-row" style="background:#d2d2d2">
					<div style="padding:10px;">
						<input type="button" value="Modifica" class="btn btn-danger" onclick="modificaTesto()">
						<input type="button" value="Annulla" class="btn" id="annullaTesto">
					</div>
				</div>
			</form>
		</div>
	</div>
	<script>
		$("#bottTesto").click(function(){
			$("#testoPagina").slideToggle();
		});
		$("#annullaTesto").click(function(){
			$("#testoPagina").slideToggle();
		});
		
		function modificaTesto(){
			document.modifica.submit();
		}
	</script>
	
	<div style="display:flex; justify-content:space-between; margin-top:20px;">
		<div></div>
		<a href="admin.php?cmd=regate_esterne_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi regata</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Regate Interclub</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="text-align:left;">Regata</th>
					<th style="text-align:left;">Link</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from regate_esterne order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{		
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM regate_esterne ORDER BY ordine DESC";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++){						
						$arr_ele = $risu_ele->fetch();
						$testo = $arr_ele['testo'];
						$luogo = $arr_ele['luogo'];
						$data = $arr_ele['data'];
						$link = $arr_ele['link'];
						$visibile = $arr_ele['visibile'];
						$id_campo = $arr_ele['id'];
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
							
							<td valign="center">
								<b><?php echo $testo;?></b><br/>
								<?php echo $luogo;?>, <i><?php echo $data;?></i>
							</td>
							<td>
								<a href="<?php echo $link;?>" target="_blank" style="color:#333333">
									<?php  echo substr($link,0,50); if($link!=substr($link,0,50)) echo "...";?>&nbsp;&nbsp;<i class="fa fa-external-link"></i>
								</a>
							</td>
							<td style="width:10%">
								<span class="btn-group">
									<a class="btn btn-small" id="visib_<?php echo $x;?>" onclick="visibFunct_<?php echo $x;?>();"><i class="fa fa-circle" style="color:<?php if($visibile==1){?>green<?php }else{?>red<?php }?>"></i></a>
									<script>
										var visib_<?php echo $x;?>="<?php echo $visibile;?>";
										function visibFunct_<?php echo $x;?>(){
											if(visib_<?php echo $x;?>=="1"){
												visib_<?php echo $x;?>=0;
												$("#visib_<?php echo $x;?>").html('<i class="fa fa-circle" style="color:red"></i>');
											}else{
												visib_<?php echo $x;?>=1;
												$("#visib_<?php echo $x;?>").html('<i class="fa fa-circle" style="color:green"></i>');
											}
											document.getElementById('hiddenFrame').src="frame/visibilita_iscritti_regate_esterne.php?id_campo=<?php echo $id_campo;?>&val="+visib_<?php echo $x;?>;
										}
									</script>
									
									<a href="admin.php?cmd=regate_esterne&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
									<a href="admin.php?cmd=regate_esterne&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
									<a href="admin.php?cmd=regate_esterne&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
									<a href="admin.php?cmd=regate_esterne&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
									<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
										<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
										<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
											<form action="admin.php" method="GET">
												<input type="hidden" name="cmd" value="regate_esterne"/>
												<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
												<input type="hidden" name="azione" value="cambia"/>
												<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
												<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
											</form>
										</div>
									</div>
									<a href="admin.php?cmd=regate_esterne_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
									<a href="admin.php?cmd=regate_esterne&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small" onclick="return confirm ('Confermi la cancellazione del campo?');"><i class="icon-trash"></i></a>
								</span>
							</td>
						</tr>						
					<?php }
				}?>
			</tbody>
		</table>
		<?php  include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
