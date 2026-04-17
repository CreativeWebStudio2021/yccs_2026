<?php 
$table="clienti";

$criterio="1";
$rif="";

if(isset($_GET['nome_ric'])) $nome_ric=$_GET['nome_ric']; else $nome_ric='';
if(isset($_GET['cognome_ric'])) $cognome_ric=$_GET['cognome_ric']; else $cognome_ric='';
if(isset($_GET['tessera_ric'])) $tessera_ric=$_GET['tessera_ric']; else $tessera_ric='';
if(isset($_GET['email_ric'])) $email_ric=$_GET['email_ric']; else $email_ric='';
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if($nome_ric!="") { $criterio.=" AND nome LIKE '%$nome_ric%'"; $rif.="&nome_ric=$nome_ric"; }
if($cognome_ric) { $criterio.=" AND cognome LIKE '%$cognome_ric%'"; $rif.="&cognome_ric=$cognome_ric"; }
if($email_ric!="") { $criterio.=" AND email LIKE '%$email_ric%'"; $rif.="&email_ric=$email_ric"; }
if($tessera_ric!="") { $criterio.=" AND num_tessera like '%$tessera_ric%'"; $rif.="&tessera_ric=$tessera_ric"; }
/*$rif.="&pag_att=$pag_att";*/

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

if($conferma)
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
		
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);	
?>
	<script language="javascript">		
		window.location="admin.php?cmd=clienti<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
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
			window.location='admin.php?cmd=clienti<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
	
	if ($azione=="approva") {
		$open_connection->connection->query("update clienti set approvato='1' where id='$id_canc'");
	
		$query_dati = "select nome,cognome,email,num_tessera from clienti where id='$id_canc'";
		$risu_dati = $open_connection->connection->query($query_dati);
		if ($risu_dati) list($nome,$cognome,$email,$num_socio) = $risu_dati->fetch();
	
		?>
		<script>
			window.location='<?php echo $http;?>://<?php echo $ind_sito;?>/mail_approvazione.php?id_cli=<?php echo $id_canc;?>';
		</script>
		<?php 
	}
	if ($azione=="disapprova") $open_connection->connection->query("update clienti set approvato='0' where id='$id_canc'");
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
			window.location='admin.php?cmd=clienti<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 	
}

/*if ($azione=="scarica_clienti") {
	$data_f = $oggetto_admin->date_to_data($data_att);
	include("include/scarica_clienti.inc.php");
?>
	<script type="text/javascript">
		window.location='http://<?php  echo $ind_sito; ?>/csv/clienti/clienti_<?php echo $data_f;?>.csv';
		
		function loc(){
			window.location = "admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
		}
		window.setTimeout('loc()' , 2000);
	</script>
<?php 
}*/
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
			document.getElementById('cancella_sel').href='admin.php?cmd=clienti<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=clienti<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Iscritti Area Soci</b></div>
	
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
	
	<div class="mws-panel-header" style="cursor:pointer;" onclick="apri_ricerca();" id="searchHeader">
		<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca iscritti</span>
	</div>
	<div class="mws-panel-body no-padding" id="searchPanel">
		<form name="ricerca" class="mws-form" action="admin.php" method="GET" enctype="multipart/form-data">
			<input type="hidden" name="cmd" value="clienti">
			
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Nome</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="nome_ric" value="<?php echo $nome_ric;?>"  style="width:90%"/>
					</div>
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Cognome</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="cognome_ric" value="<?php echo $cognome_ric;?>"  style="width:90%"/>
					</div>
					<div style="clear:both;height:20px"></div>
					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Tessera n.</label>									
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="tessera_ric" value="<?php echo $tessera_ric;?>"  style="width:90%"/>
					</div>
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Email</label>									
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="email_ric" value="<?php echo $email_ric;?>"  style="width:90%"/>
					</div>
					<div style="clear:both;"></div>
				</div>								
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Cerca" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="window.location='admin.php?cmd=clienti'">
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
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=clienti_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi iscritto</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header" style="position:relative;">
		<span><i class="icon-table"></i>Elenco iscritti (<?php  echo $num_ele; ?>)</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="text-align:left"><a style="color:#333;text-decoration:none" href="admin.php?cmd=clienti&neword=data_registrazione&ascdesc=<?php  echo $ascdesc; ?><?php echo $rif;?>">Data iscr.</a><?php  if ($neword=="data_registrazione" && $ascdesc=="asc") echo "&nbsp; <img src=\"images/core/sort_desc.png\">"; elseif ($neword=="data_registrazione" && $ascdesc=="desc") echo "&nbsp; <img src=\"images/core/sort_asc.png\">"; else echo "&nbsp; <img src=\"images/core/sort.png\">"; ?></th>		
					<th style="text-align:left"><a style="color:#333;text-decoration:none" href="admin.php?cmd=clienti&neword=cognome&ascdesc=<?php  echo $ascdesc; ?><?php echo $rif;?>">Cognome</a><?php  if ($neword=="cognome" && $ascdesc=="asc") echo "&nbsp; <img src=\"images/core/sort_desc.png\">"; elseif ($neword=="cognome" && $ascdesc=="desc") echo "&nbsp; <img src=\"images/core/sort_asc.png\">"; else echo "&nbsp; <img src=\"images/core/sort.png\">"; ?></th>			
					<th style="text-align:left"><a style="color:#333;text-decoration:none" href="admin.php?cmd=clienti&neword=nome&ascdesc=<?php  echo $ascdesc; ?><?php echo $rif;?>">Nome</a><?php  if ($neword=="nome" && $ascdesc=="asc") echo "&nbsp; <img src=\"images/core/sort_desc.png\">"; elseif ($neword=="nome" && $ascdesc=="desc") echo "&nbsp; <img src=\"images/core/sort_asc.png\">"; else echo "&nbsp; <img src=\"images/core/sort.png\">"; ?></th>			
					<th style="text-align:left"><a style="color:#333;text-decoration:none" href="admin.php?cmd=clienti&neword=num_tessera&ascdesc=<?php  echo $ascdesc; ?><?php echo $rif;?>">Tessera n.</a><?php  if ($neword=="num_tessera" && $ascdesc=="asc") echo "&nbsp; <img src=\"images/core/sort_desc.png\">"; elseif ($neword=="num_tessera" && $ascdesc=="desc") echo "&nbsp; <img src=\"images/core/sort_asc.png\">"; else echo "&nbsp; <img src=\"images/core/sort.png\">"; ?></th>			
					<th style="text-align:left"><a style="color:#333;text-decoration:none" href="admin.php?cmd=clienti&neword=email&ascdesc=<?php  echo $ascdesc; ?><?php echo $rif;?>">Email</a><?php  if ($neword=="email" && $ascdesc=="asc") echo "&nbsp; <img src=\"images/core/sort_desc.png\">"; elseif ($neword=="email" && $ascdesc=="desc") echo "&nbsp; <img src=\"images/core/sort_asc.png\">"; else echo "&nbsp; <img src=\"images/core/sort.png\">"; ?></th>
					<th style="text-align:left">Ultimo Accesso</th>
					<th>Approvato</th>
					<th style="text-align:left">Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 			
				if($num_ele>0)
				{		
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE $criterio $pezzo_ord LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$nome = ucwords(trim($arr_ele['nome']));
						$cognome = ucwords(trim($arr_ele['cognome']));
						$email = trim($arr_ele['email']);
						$tessera = $arr_ele['num_tessera'];
						$data_ultimo_accesso = $arr_ele['data_ultimo_accesso'];
						$status = $arr_ele['approvato'];
						$id_campo = $arr_ele['id'];
						$data = $oggetto_admin->date_to_data($arr_ele['data_registrazione']);
								
						/*$num_visite = 0;
						$query_visite = "select * from visite_prod where id_cli='$id_campo'";
						$risu_visite = $open_connection->connection->query($query_visite);
						if ($risu_visite) $num_visite = $risu_visite->rowCount();*/
			?>
						<script type="text/javascript">
							lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
						</script>
						<tr>
							<td align="center" valign="center">
								<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
							</td>
							<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
							<td valign="center"><?php  echo $data;?></td>
							<td valign="center" style="line-height:14px"><?php  echo $cognome;?></td>
							<td valign="center" style="line-height:14px"><?php  echo $nome;?></td>
							
							<td valign="center" style="line-height:14px"><?php  echo $tessera;?></td>
														
							<td  style="text-align:left">
								<a style="color:#000" href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
							</td>
							<td valign="center">
								<?php 
								if(isset($data_ultimo_accesso)){
									$temp = explode(" ",$data_ultimo_accesso);
									$temp2 = explode("-",$temp[0]);
									$data_ultimo_accesso = $temp2[2]."-".$temp2[1]."-".$temp2[0]." ".$temp[1];
									echo $data_ultimo_accesso;
								}?>
							</td>
							<!--<td  align="center" valign="center" id="vis_ing_<?php echo $id_campo;?>">
							<?php  if ($num_visite>0) { ?>
								<div style="position:relative; width:100%; margin-top:2px; cursor:pointer;"  onclick="apri_box_visite_<?php echo $id_campo;?>();">
									<b>Visualizza</b>
								</div>
								<script type="text/javascript">
									function apri_box_visite_<?php echo $id_campo;?>(){
										$("#mask").fadeIn();
										var marg = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
										marg=(marg-700)/2;
										$("#box_add").animate({left : marg});
										document.getElementById('frame_news').src="visite.php?id_rife=<?php echo $id_campo;?>";
									}
								</script>
							<?php 	
								}
							?>
							</td>-->
							
							<td  align="center" valign="center">
							<?php 	
								if ($status==1) {?>
									<a href="admin.php?cmd=clienti&azione=disapprova&id_canc=<?php echo $id_campo.$rif;?>" title="Disattiva socio">
										<i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
									</a>
							<?php }else{ ?>
									<a href="admin.php?cmd=clienti&azione=approva&id_canc=<?php echo $id_campo.$rif;?>" title="Attiva socio">
										<i class="fa fa-circle-o fa-2x" aria-hidden="true"></i>
									</a>
							<?php }	?>
							</td>
							
							<td style="width:10%" valign="center">
								<span class="btn-group">
									<a href="admin.php?cmd=clienti_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
									<a href="admin.php?cmd=clienti&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-trash"></i></a>
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
	<?php /*<div class="">
		<br/>
		LEGENDA<br/>
		<div style="float:left; width:33%">		
			<i class="fa fa-camera"></i> - Foto<br/>	
			<i class="fa fa-eur"></i> - Prezzi per Privati<br/>		
			<i class="fa fa-eur"></i> <i class="fa fa-suitcase"></i> - Prezzi per Grossisti<br/>
			<b>%</b> - Offerte per Privati <br/>
			<b>%</b> <i class="fa fa-suitcase"></i> - Offerte per Grossisti<br/>
			<i class="fa fa-eye"></i> - Visibilità<br/>
		</div>
		<div style="float:left; width:33%">
			<i class="fa fa-eye"></i> - Prodotto Visibile per Privati<br/>
			<i class="fa fa-eye"></i> <i class="fa fa-suitcase"></i> - Prodotto Visibile per Grossisti<br/>
			<i class="fa fa-search"></i> - Prodotto in Evidenza per Privati<br/>
			<i class="fa fa-search"></i> <i class="fa fa-suitcase"></i> - Prodotto in Evidenza per Grossisti<br/>
			<i class="fa fa-dollar"></i> - Prezzi<br/>		
		</div>
		<div style="clear:both"></div>
		<br/>
	</div>*/?>
</div>
