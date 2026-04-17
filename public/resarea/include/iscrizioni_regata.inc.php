<?php 
$table="edizioni_iscrizioni_regata";
$pagina="iscrizioni_regata";

$criterio="1";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if(isset($_GET['boat_name_ric'])) $boat_name_ric=$_GET['boat_name_ric']; else $boat_name_ric='';
if(isset($_GET['charterer_ric'])) $charterer_ric=$_GET['charterer_ric']; else $charterer_ric='';
if(isset($_GET['charterer_email_ric'])) $charterer_email_ric=$_GET['charterer_email_ric']; else $charterer_email_ric='';
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;


if($id_rife!="") {  $rif.="&id_rife=$id_rife"; }
if($id_riferimento!="") { $rif.="&id_riferimento=$id_riferimento"; }
if($boat_name_ric!="") { $criterio.=" AND boat_name LIKE '%$boat_name_ric%'"; $rif.="&boat_name_ric=$boat_name_ric"; }
if($charterer_ric) { $criterio.=" AND (charterer LIKE '%$charterer_ric%' OR boat_captain  LIKE '%$charterer_ric%')"; $rif.="&charterer_ric=$charterer_ric"; }
if($charterer_email_ric!="") { $criterio.=" AND (charterer_email LIKE '%$charterer_email_ric%' OR captain_email  LIKE '%$charterer_email_ric%')"; $rif.="&charterer_email_ric=$charterer_email_ric"; }
/*$rif.="&pag_att=$pag_att";*/

$query_e="SELECT nome_regata,anno FROM edizioni_regate WHERE id='$id_riferimento'";
$resu_e=$open_connection->connection->query($query_e);
list($nome_edizione, $anno_edizione)=$resu_e->fetch();

if(isset($_POST['statoins'])) $statoins=$_POST['statoins']; else $statoins="";
if($statoins=="inviato"){	
	if(isset($_POST['boat_name'])) $boat_name=$_POST['boat_name']; else $boat_name="";
	if(isset($_POST['charterer'])) $charterer=$_POST['charterer']; else $charterer="";
	if(isset($_POST['charterer_email'])) $charterer_email=$_POST['charterer_email']; else $charterer_email="";
	if(isset($_POST['charterer_tel'])) $charterer_tel=$_POST['charterer_tel']; else $charterer_tel="";
	if(isset($_POST['builder'])) $builder=$_POST['builder']; else $builder="";
	if(isset($_POST['designer'])) $designer=$_POST['designer']; else $designer="";
	if(isset($_POST['lh'])) $lh=$_POST['lh']; else $lh="";
	if(isset($_POST['beam'])) $beam=$_POST['beam']; else $beam="";
	if(isset($_POST['min_draft'])) $min_draft=$_POST['min_draft']; else $min_draft="";
	
	$ord = $oggetto_admin->trova_ordine ("$table", "id_edizione", $id_riferimento);
	
	$query_ins="INSERT INTO edizioni_iscrizioni_regata (ordine, provenienza, id_edizione, data, stato_accettazione, status, visibile, boat_name,charterer,charterer_email,charterer_tel,builder,designer,lh,beam,min_draft) VALUES ('$ord', 'backoffice','$id_riferimento', '".date('Y-m-d')."', '1', 'pagato', '1','$boat_name','$charterer','$charterer_email','$charterer_tel','$builder','$designer','$lh','$beam','$min_draft')";
	$risu_ins=$open_connection->connection->query($query_ins);
}

/* Questa è la parte che effettua l'ordinamento */
if(isset($_GET['ascdesc'])){
	$ascdesc = $_GET['ascdesc'];
 }else{
	$ascdesc="desc";
 }
 
if(isset($_GET['ordinato']))
	$ordinato = $_GET['ordinato'];
else $ordinato = 0;

if(isset($_GET['neword'])){
	$neword = $_GET['neword'];
	if ($ordinato==1) {
		$ord = $ascdesc;
	}
	else {
		if($ascdesc=="asc"){$ascdesc="desc";}else{$ascdesc="asc";}
	}
	$pezzo_ord = "order by $neword $ascdesc";
}else{
	$ord = "desc";
	$neword = "id";
	$pezzo_ord="order by id desc";
}
/* fine ordinamento */

if($azione=="cancella" && $id_canc!="")
{	
		
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos") ;	
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		/*$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/$img")) @unlink("img_up/$img");
		}*/
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Iscritti Regata <?php echo $nome_edizione;?> del <?php echo $anno_edizione;?></b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<iframe src="" style="display:none" id="frame_action"></iframe>
	<iframe src="" style="display:none" id="frame_action2"></iframe>
	
	<!--<script type="text/javascript">
		var open=0;
		function apri_ricerca(){
			if(open==0){
				open=1;
				$("#searchPanel").animate({height:"195px"});
				document.getElementById('searchHeader').innerHTML='<span><i class="fa fa-search-minus" style="color:#fff"></i> Ricerca</span>';
			} else {
				open=0;
				$("#searchPanel").animate({height:"0px"});
				document.getElementById('searchHeader').innerHTML='<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca</span>';
			}
		}
	</script>-->
	
	<div class="mws-panel-header" style="cursor:pointer;" id="searchHeader">
		<div style="float:left; color:#6e8bbb" onclick="document.getElementById('insPanel').style.display='none';document.getElementById('searchPanel').style.display='block';"><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca iscritti</div>
		<div style="float:right; color:#6e8bbb" onclick="document.getElementById('insPanel').style.display='block';document.getElementById('searchPanel').style.display='none';">Inserisci iscritto <i class="fa fa-plus-square" style="color:#fff"></i></div>
		<div style="clear:both"></div>
	</div>
	<div class="mws-panel-body no-padding" id="searchPanel" style="display:none">
		<form name="ricerca" class="mws-form" action="admin.php" method="GET" enctype="multipart/form-data">
			<input type="hidden" name="cmd" value="<?php echo $pagina;?>">
			
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Nome Barca</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="boat_name_ric" value="<?php echo $boat_name_ric;?>"  style="width:90%"/>
					</div>
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Charterer/Owner</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="charterer_ric" value="<?php echo $charterer_ric;?>"  style="width:90%"/>
					</div>
					<div style="clear:both;height:20px"></div>
					
					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Email</label>									
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="charterer_email_ric" value="<?php echo $charterer_email_ric;?>"  style="width:90%"/>
					</div>
					<div style="clear:both;"></div>
				</div>								
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Cerca" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="document.getElementById('searchPanel').style.display='none'">
			</div>
		</form>
	</div>
	
	<div class="mws-panel-body no-padding" id="insPanel"  style="display:none">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>&id_rife=<?php echo $id_rife;?>&id_riferimento=<?php echo $id_riferimento;?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="statoins" value="inviato">
			
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Nome Barca</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="boat_name" value=""  style="width:90%"/>
					</div>
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Charterer/Owner</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="charterer" value=""  style="width:90%"/>
					</div>
					<div style="clear:both;height:20px"></div>
					
					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Email</label>									
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="charterer_email" value=""  style="width:90%"/>
					</div>
					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Telefono</label>									
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="charterer_tel" value=""  style="width:90%"/>
					</div>
					<div style="clear:both;height:20px"></div>
					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Builder</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="builder" value=""  style="width:90%"/>
					</div>
					
					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Designer</label>									
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="designer" value=""  style="width:90%"/>
					</div>
					<div style="clear:both;height:20px"></div>
					
					
					<div style="float:left; width:10%;">
						<label class="mws-form-label">LH (m)</label>									
					</div>
					<div style="float:left; width:23%;">
						<input type="text" name="lh" value=""  style="width:90%"/>
					</div>
					
					<div style="float:left; width:10%;">
						<label class="mws-form-label">Beam (m)</label>									
					</div>
					<div style="float:left; width:23%;">
						<input type="text" name="beam" value=""  style="width:90%"/>
					</div>
					
					<div style="float:left; width:10%;">
						<label class="mws-form-label">Draft (m)</label>									
					</div>
					<div style="float:left; width:23%;">
						<input type="text" name="min_draft" value=""  style="width:90%"/>
					</div>
					<div style="clear:both;"></div>
				</div>								
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Inserisci" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="document.getElementById('insPanel').style.display='none'">
			</div>
		</form>
	</div>
	<div style="clear:both;height:30px">&nbsp;</div>
	<?php 
		$query_ele = "SELECT * FROM $table WHERE $criterio $pezzo_ord";			
		$risu_ele = $open_connection->connection->query($query_ele);
		
		$num_ele = 0;
		if($risu_ele)
			$num_ele = $risu_ele->rowCount();
	?>
	<div style="float:left;width:50%;text-align:left;height:30px"></div>
	<div style="clear:both;height:0px">&nbsp;</div>
	<div style="float:right; margin-right:10px;"><i>inseriti da backoffice</i></div>
	<div style="float:right; margin-right:5px;"><i class="fa fa-circle" aria-hidden="true"style="color:#a8bad7"></i></div>
	<div style="clear:both; height:2px;"></div>
	<div class="mws-panel-header" style="position:relative;">
		<span><i class="icon-table"></i>Elenco iscritti (<?php  echo $num_ele; ?>)</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="text-align:left">Data iscr.</th>		
					<th style="text-align:left">Nome Barca</th>			
					<th><a style="color:#333;text-decoration:none">Charterer/Owner</th>
					<th><a style="color:#333;text-decoration:none">Email / Telefono</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 			
				if($num_ele>0)
				{		
					$rec_pag=100;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE $criterio $pezzo_ord LIMIT $start,$rec_pag";
					
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$boat_name = ucwords(trim($arr_ele['boat_name']));
						if($arr_ele['charterer'] && $arr_ele['charterer']!="") $charterer = ucwords(trim($arr_ele['charterer']));
						else $charterer = ucwords(trim($arr_ele['boat_captain']));
						if($arr_ele['charterer_email'] && $arr_ele['charterer_email']!="") $charterer_email = trim($arr_ele['charterer_email']);
						else $charterer_email = trim($arr_ele['captain_email']);
						if($arr_ele['charterer_tel'] && $arr_ele['charterer_tel']!="") $telefono = trim($arr_ele['charterer_tel']);
						else $telefono = ucwords(trim($arr_ele['captain_cell']));
						
						$status = $arr_ele['status'];
						$id_campo = $arr_ele['id'];
						$visibile = $arr_ele['visibile'];
						$data = $oggetto_admin->date_to_data($arr_ele['data']);
			?>
						<script type="text/javascript">
							lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
						</script>
						<tr <?php if($arr_ele['provenienza']=="backoffice"){?>style="background:#d3dceb"<?php }?>>
							<td align="center" valign="center">
								<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
							</td>
							<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
							<td valign="center">
								<?php echo $data;?>
							</td>
							<td valign="center"><?php echo $boat_name;?></td>
							<td  style="line-height:14px"><?php  echo $charterer;?></td>
													
							<td >
								<i class="fa fa-envelope"></i>&nbsp;&nbsp;<a style="color:#000" href="mailto:<?php echo $charterer_email;?>"><?php echo $charterer_email;?></a><br/>
								<i class="fa fa-phone"></i>&nbsp;&nbsp;<a style="color:#000" href="tel:<?php echo $telefono;?>"><?php echo $telefono;?></a>
							</td>
							
							<td style="width:10%" valign="center">
								<span class="btn-group">
									<span class="btn btn-small" style="cursor:default; <?php if($arr_ele['stato_accettazione']==1){?>color:green<?php }?>" title="<?php if($arr_ele['stato_accettazione']==0){?>Non <?php }?>Confermato"><i class="fa fa-circle"></i></span>
									<?php /*<span class="btn btn-small" id="visibile_<?php echo $id_campo;?>" style="cursor:default; <?php if($arr_ele['visibile']==1){?>color:green<?php }else{?>color:red<?php }?>" title="<?php if($arr_ele['visibile']==0){?>Non <?php }?>Visibile" onclick="ins_doc('visibile','<?php echo $id_campo;?>')"><i class="fa fa-eye"></i></span>*/?>
									<span class="btn btn-small" style="cursor:pointer; <?php if($arr_ele['status']=="pagato"){?>color:green<?php }else{?>color:red<?php }?>" title="<?php if($arr_ele['status']!="pagato"){?>Non <?php }?>Pagato" onclick="ins_doc('pagamento','<?php echo $id_campo;?>')"><i class="fa fa-euro"></i></span>
									
									<span class="btn btn-small"  title="Rating Certificate  <?php if(!$arr_ele['rating_certificate'] || trim($arr_ele['rating_certificate'])==""){?>non<?php }?> inviato" <?php if($arr_ele['rating_certificate'] && trim($arr_ele['rating_certificate'])!=""){?>style="color:green"<?php }?> onclick="ins_doc('rating_certificate','<?php echo $id_campo;?>')"><i class="fa fa-certificate" aria-hidden="true"></i></span>
									
									<span class="btn btn-small"  title="Crew List <?php if(!$arr_ele['crew_list'] || trim($arr_ele['crew_list'])==""){?>non<?php }?> inviata" <?php if($arr_ele['crew_list'] && trim($arr_ele['crew_list'])!=""){?>style="color:green"<?php }?> onclick="ins_doc('crew_list','<?php echo $id_campo;?>')"><i class="fa fa-list" aria-hidden="true"></i></span>
									
									<span class="btn btn-small"  title="Invia link Pagamento" onclick="ins_doc('invio_pagamento','<?php echo $id_campo;?>');"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
									
									<a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" title="Vedi dati" class="btn btn-small"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
									<a onClick="return confirm('Cancellare l\'elemento selezionato?')"  title="Cancella" href="admin.php?cmd=<?php echo $pagina;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-trash"></i></a>
								</span>
							</td>
						</tr>
					<?php }
				}?>
			</tbody>
		</table>		
		<?php include("fissi/multipagina.inc.php");?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>

</div>

<div style="position:fixed; width:780px; height:400px; background:#fff; top:50%; left:50%; display:none; border:solid 1px #808080; border-radius:2px; text-align:center;  margin-left:-390px; margin-top:-200px; z-index:0000000; box-shadow:5px 5px 5px #808080" id="box_doc">
	<iframe src="" style="width:780px; height:400px; margin-top:5px;" id="frame_link" frameborder=0 ></iframe>
	<div style="position:absolute; top:15px; right:25px; width:20px; height:20px; cursor:pointer; text-align:center;" onclick="document.getElementById('box_doc').style.display='none'; window.location='<?php echo $_SERVER['REQUEST_URI'];?>';">
		<i class="fa fa-times-circle fa-2x"></i>		
	</div>
</div>

<script type="text/javascript">
	function ins_doc(tipo, id_doc){
		if(tipo!="visibile") $("#box_doc").fadeIn();
		document.getElementById('frame_link').src="frame/iscrizioni_regata_doc.php?tipo="+tipo+"&id_doc="+id_doc+'<?php echo $rif;?>';	
	}
</script>
