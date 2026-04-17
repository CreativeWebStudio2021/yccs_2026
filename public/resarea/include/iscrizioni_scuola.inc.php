<?php 
$table="iscrizioni_scuola";

$query="SELECT id FROM $table WHERE id_rife='0'";
$resu=$open_connection->connection->query($query);
while($risu=$resu->fetch()){
	$query2="SELECT nome, cognome, codice_fiscale FROM $table WHERE id_rife='".$risu['id']."'";
	$resu2=$open_connection->connection->query($query2);
	$num2 = $resu2->rowCount();
	if($num2>0){
		$string_nome="";
		$string_cognome="";
		$string_codice_fiscale="";
		while($risu2=$resu2->fetch()){
			$string_nome.="@".str_replace("'","\'",$risu2['nome'])."@";
			$string_cognome.="@".str_replace("'","\'",$risu2['cognome'])."@";
			$string_codice_fiscale.="@".$risu2['codice_fiscale']."@";
		}
		$query_up = "UPDATE $table SET nomi_familiari='$string_nome', cognomi_familiari='$string_cognome', codici_fiscali_familiari='$string_codice_fiscale' WHERE id='".$risu['id']."'";
		$risu_up=$open_connection->connection->query($query_up);
	}
}

$criterio="";
$rif="";

if(isset($_GET['nome_ric'])) $nome_ric=$_GET['nome_ric']; else $nome_ric='';
if(isset($_GET['cognome_ric'])) $cognome_ric=$_GET['cognome_ric']; else $cognome_ric='';
if(isset($_GET['tessera_ric'])) $tessera_ric=$_GET['tessera_ric']; else $tessera_ric='';
if(isset($_GET['email_ric'])) $email_ric=$_GET['email_ric']; else $email_ric='';
if(isset($_GET['codice_fiscale_ric'])) $codice_fiscale_ric=$_GET['codice_fiscale_ric']; else $codice_fiscale_ric='';
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if($nome_ric!="") { $criterio.=" AND (nome LIKE '%$nome_ric%' OR nomi_familiari LIKE '%$nome_ric%')"; $rif.="&nome_ric=$nome_ric"; }
if($cognome_ric) { $criterio.=" AND (cognome LIKE '%$cognome_ric%' OR cognomi_familiari LIKE '%$cognome_ric%')"; $rif.="&cognome_ric=$cognome_ric"; }
if($codice_fiscale_ric) { $criterio.=" AND (codice_fiscale LIKE '%$codice_fiscale_ric%' OR codici_fiscali_familiari LIKE '%$codice_fiscale_ric%')"; $rif.="&cognome_ric=$cognome_ric"; }
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

if($azione=="cancella" && $id_canc!="")
{	
		
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
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos") ;	
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
			<input type="hidden" name="cmd" value="<?php echo $table;?>">
			
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
						<label class="mws-form-label">Email</label>									
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="email_ric" value="<?php echo $email_ric;?>"  style="width:90%"/>
					</div>
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Codice Fiscale</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="codice_fiscale_ric" value="<?php echo $codice_fiscale_ric;?>"  style="width:90%"/>
					</div>
					<div style="clear:both;height:20px"></div>
					<div style="clear:both;"></div>
				</div>								
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Cerca" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="window.location='admin.php?cmd=<?php echo $table;?>'">
			</div>
		</form>
	</div>
	<div style="clear:both;height:30px">&nbsp;</div>
	<?php 
		$query_ele = "SELECT * FROM $table WHERE id_rife='0' $criterio $pezzo_ord";			
		$risu_ele = $open_connection->connection->query($query_ele);
		$num_ele = 0;
		if($risu_ele)
			$num_ele = $risu_ele->rowCount();
	?>
	<div style="float:left;width:50%;text-align:left;height:30px"></div>
	<div style="clear:both;height:0px">&nbsp;</div>
	<div class="mws-panel-header" style="position:relative;">
		<span><i class="icon-table"></i>Elenco iscritti (<?php  echo $num_ele; ?>)</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"></th>
					<th style="width:90px;"><a style="color:#333;text-decoration:none">Periodo</th>
					<th style="width:80px; text-align:left">Data iscr.</th>		
					<th style="width:80px; text-align:left; text-align:center;">Num Iscritti</th>		
					<th style="text-align:left">Nome</th>			
					<th style="width:120px; text-align:left">Codice Fiscale</th>			
					<th><a style="color:#333;text-decoration:none">Email / Telefono</th>
					<th>Duplica Iscrizioni</th>
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
					$query_ele = "SELECT * FROM $table WHERE id_rife='0' $criterio $pezzo_ord LIMIT $start,$rec_pag";
					
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					for($x=0;$x<$num_item;$x++)
					{	
						$arr_ele = $risu_ele->fetch();
						$nome = ucwords(trim($arr_ele['nome']));
						if(isset($nome_ric) && $nome_ric!=""){
							$pos = ""; $lng = "";
							$pos = stripos($nome, $nome_ric); 
							if($pos!==false){
								$lng = strlen($nome_ric);
								$nome =substr($nome, 0, $pos)."<span style='background:yellow'>".substr($nome, $pos, $lng)."</span>".substr($nome, ($pos+$lng));
							}
						}
						//$nome = str_replace($nome_ric,"<span style='background:yellow'>".$nome_ric."</span>",$nome);
						$cognome = ucwords(trim($arr_ele['cognome']));
						if(isset($cognome_ric) && $cognome_ric!=""){
							$pos = ""; $lng = "";
							$pos = stripos($cognome, $cognome_ric); 
							if($pos!==false){
								$lng = strlen($cognome_ric);
								$cognome =substr($cognome, 0, $pos)."<span style='background:yellow'>".substr($cognome, $pos, $lng)."</span>".substr($cognome, ($pos+$lng));
							}
						}
						//$cognome = str_replace($cognome_ric,"<span style='background:yellow'>".$cognome_ric."</span>",$cognome);
						$email = trim($arr_ele['email']);
						if(isset($email_ric) && $email_ric!=""){
							$pos = ""; $lng = "";
							$pos = stripos($email, $email_ric); 
							if($pos!==false){
								$lng = strlen($email_ric);
								$email =substr($email, 0, $pos)."<span style='background:yellow'>".substr($email, $pos, $lng)."</span>".substr($email, ($pos+$lng));
							}
						}
						//$email = str_replace($email_ric,"<span style='background:yellow'>".$email_ric."</span>",$email);
						$telefono = trim($arr_ele['telefono1']);
						$codice_fiscale = $arr_ele['codice_fiscale'];
						if(isset($codice_fiscale_ric) && $codice_fiscale_ric!=""){
							$pos = ""; $lng = "";
							$pos = stripos($codice_fiscale, $codice_fiscale_ric); 
							if($pos!==false){
								$lng = strlen($codice_fiscale_ric);
								$codice_fiscale =substr($codice_fiscale, 0, $pos)."<span style='background:yellow'>".substr($codice_fiscale, $pos, $lng)."</span>".substr($codice_fiscale, ($pos+$lng));
							}
						}
						//$codice_fiscale = str_replace($codice_fiscale_ric,"<span style='background:yellow'>".$codice_fiscale_ric."</span>",$codice_fiscale);						
						//$tessera = $arr_ele['num_tessera'];
						$dal = $arr_ele['dal'];
						$al = $arr_ele['al'];
						//$status = $arr_ele['approvato'];
						$id_campo = $arr_ele['id'];
						$data_invio = $oggetto_admin->date_to_data(substr($arr_ele['data_invio'],0,10));
						
						$query_n="SELECT id FROM $table WHERE id_rife='$id_campo'";
						$resu_n=$open_connection->connection->query($query_n);
						$num_n=$resu_n->rowCount();
								
						/*$num_visite = 0;
						$query_visite = "select * from visite_prod where id_cli='$id_campo'";
						$risu_visite = $open_connection->connection->query($query_visite);
						if ($risu_visite) $num_visite = $risu_visite->rowCount();*/
						
						$query_sub = "SELECT * FROM $table WHERE id_rife='$id_campo'";
						$risu_sub = $open_connection->connection->query($query_sub);
						$num_sub=$risu_sub->rowCount();
			?>
						<tr style="background:#F2F2F2; border-top:solid 1px #ccc">
							<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
							<td valign="center">
								<?php if($dal && trim($dal)!=""){?>Dal <?php echo date_to_data($dal);?><br/><?php }?>
								<?php if($al && trim($al)!=""){?>Al <?php echo date_to_data($al);?><?php }?>
							</td>
							<td valign="center"><?php  echo $data_invio;?></td>
							<td valign="center" align="center"><?php  echo $num_n+1;?></td>
							<td  style="line-height:14px"><?php  echo $cognome;?> <?php  echo $nome;?></td>
							<td  style="line-height:14px"><?php  echo $codice_fiscale;?></td>
													
							<td >
								<i class="fa fa-envelope"></i>&nbsp;&nbsp;<a style="color:#000" href="mailto:<?php echo $email;?>"><?php echo $email;?></a><br/>
								<i class="fa fa-phone"></i>&nbsp;&nbsp;<a style="color:#000" href="tel:<?php echo $telefono;?>"><?php echo $telefono;?></a>
							</td>
							
							
							<td style="width:10%" valign="center">
								<span class="btn-group">
									<a title="Duplica singola iscrizione" href="<?php echo $http;?>://<?php echo $ind_sito;?>/yccs-sailing-school-iscrizioni-<?php echo $arr_ele['codice'];?>-<?php echo $id_campo;?>-0-1" target="_blank" class="btn btn-small"><i class="fa fa-file-o" aria-hidden="true"></i></a>
									<?php if($num_sub>0){?>
										<a title="Duplica tutte le iscrizioni" href="<?php echo $http;?>://<?php echo $ind_sito;?>/yccs-sailing-school-iscrizioni-<?php echo $arr_ele['codice'];?>-<?php echo $id_campo;?>-1-1" target="_blank" class="btn btn-small"><i class="fa fa-files-o" aria-hidden="true"></i></a>
									<?php }?>
									<a onclick="return confirm('Inviare l'email con il link al form di iscrizione precompilato?');" href="<?php echo $http;?>://<?php echo $ind_sito;?>/mail_invio_dati.php?codice_iscrizione=<?php echo $arr_ele['codice'];?>&id_rife=<?php echo $id_campo;?>&admin=1" class="btn btn-small"  title="Invia link Iscrizione"  <?php if($arr_ele['mail_iscrizione']=="1"){?>style="color:green"<?php }?> ><i class="fa fa-envelope" aria-hidden="true"></i></a>
								</span>
							</td>
							
							
							<td style="width:10%" valign="center">
								<span class="btn-group">
									<span class="btn btn-small" style="cursor:default; <?php if($arr_ele['stato_accettazione']==1){?>color:green<?php }?>" title="<?php if($arr_ele['stato_accettazione']==0){?>Non <?php }?>Confermato"><i class="fa fa-circle"></i></span>
									<span class="btn btn-small" style="cursor:pointer; <?php if($arr_ele['status']=="pagato"){?>color:green<?php }?>" title="<?php if($arr_ele['status']!="pagato"){?>Non <?php }?>Pagato" onclick="ins_doc('pagamento','<?php echo $id_campo;?>')"><i class="fa fa-euro"></i></span>									
									<span class="btn btn-small"  title="Carta d'identità  <?php if(!$arr_ele['CI'] || trim($arr_ele['CI'])==""){?>non<?php }?> inviata" <?php if($arr_ele['CI'] && trim($arr_ele['CI'])!=""){?>style="color:green"<?php }?> onclick="ins_doc('CI','<?php echo $id_campo;?>')"><i class="fa fa-id-card" aria-hidden="true"></i></span>									
									<span class="btn btn-small"  title="Codice Fiscale <?php if(!$arr_ele['CF'] || trim($arr_ele['CF'])==""){?>non<?php }?> inviato" <?php if($arr_ele['CF'] && trim($arr_ele['CF'])!=""){?>style="color:green"<?php }?> onclick="ins_doc('CF','<?php echo $id_campo;?>')"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></span>									
									<span class="btn btn-small"  title="Certificato medico <?php if(!$arr_ele['CM'] || trim($arr_ele['CM'])==""){?>non<?php }?> inviato" style="color:<?php if($arr_ele['CM'] && trim($arr_ele['CM'])!=""){?>green<?php }else{?>#808080<?php }?>;" onclick="ins_doc('CM','<?php echo $id_campo;?>')"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
									<span class="btn btn-small"  title="Invia link Pagamento" onclick="ins_doc('invio_pagamento','<?php echo $id_campo;?>');"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
									
									<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" title="Vedi dati" class="btn btn-small"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
									<a onClick="return confirm('Cancellare l\'elemento selezionato?')"  title="Cancella" href="admin.php?cmd=iscrizioni_scuola&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-trash"></i></a>
								</span>
							</td>
						</tr>
						
						<?php 						
						for($z=0;$z<$num_sub;$z++)
						{
							$arr_sub = $risu_sub->fetch();
							$dal_sub = $arr_sub['dal'];
							$al_sub = $arr_sub['al'];
							$id_campo_sub = $arr_sub['id'];
							$nome_sub = ucwords(trim($arr_sub['nome']));
							if(isset($nome_ric) && $nome_ric!=""){
								$pos = ""; $lng = "";
								$pos = stripos($nome_sub, $nome_ric); 
								if($pos!==false){
									$lng = strlen($nome_ric);
									$nome_sub =substr($nome_sub, 0, $pos)."<span style='background:yellow'>".substr($nome_sub, $pos, $lng)."</span>".substr($nome_sub, ($pos+$lng));
								}
							}
							//$nome_sub = ucwords(str_ireplace($nome_ric,"<span style='background:yellow'>".$nome_ric."</span>",$nome_sub));
							$cognome_sub = ucwords(trim($arr_sub['cognome']));
							if(isset($cognome_ric) && $cognome_ric!=""){
								$pos = ""; $lng = "";
								$pos = stripos($cognome_sub, $cognome_ric); 
								if($pos!==false){
									$lng = strlen($cognome_ric);
									$cognome_sub =substr($cognome_sub, 0, $pos)."<span style='background:yellow'>".substr($cognome_sub, $pos, $lng)."</span>".substr($cognome_sub, ($pos+$lng));
								}
							}
							//$cognome_sub = ucwords(str_ireplace($cognome_ric,"<span style='background:yellow'>".$cognome_ric."</span>",$cognome_sub));
							$codice_fiscale_sub = $arr_sub['codice_fiscale'];							
							if(isset($codice_fiscale_ric) && $codice_fiscale_ric!=""){
								$pos = ""; $lng = "";
								$pos = stripos($codice_fiscale_sub, $codice_fiscale_ric); 
								if($pos!==false){
									$lng = strlen($codice_fiscale_ric);
									$codice_fiscale_sub =substr($codice_fiscale_sub, 0, $pos)."<span style='background:yellow'>".substr($codice_fiscale_sub, $pos, $lng)."</span>".substr($codice_fiscale_sub, ($pos+$lng));
								}
							}
							//$codice_fiscale_sub = str_ireplace($codice_fiscale_ric,"<span style='background:yellow'>".$codice_fiscale_ric."</span>",$codice_fiscale_sub);
							?>
							
							<tr class="iscrittiSub_<?php echo $id_campo;?>" style="background:#fff">
								<td align="center" valign="center"></td>
								<td valign="center">
									<?php if($dal && trim($dal_sub)!=""){?>Dal <?php echo date_to_data($dal_sub);?><br/><?php }?>
									<?php if($al && trim($al_sub)!=""){?>Al <?php echo date_to_data($al_sub);?><?php }?>
								</td>
								<td valign="center"></td>
								<td valign="center" align="center"></td>
								<td  style="line-height:14px"><?php  echo $cognome_sub;?> <?php  echo $nome_sub;?></td>
								<td  style="line-height:14px"><?php  echo $codice_fiscale_sub;?></td>
														
								<td >
									
								</td>
								
								
								<td style="width:10%" valign="center">
									<span class="btn-group">
										<a class="btn btn-small"  title="Duplica singola iscrizione" href="<?php echo $http;?>://<?php echo $ind_sito;?>/yccs-sailing-school-iscrizioni-<?php echo $arr_ele['codice'];?>-<?php echo $id_campo_sub;?>-0-1" target="_blank"><i class="fa fa-file-o" aria-hidden="true"></i></a>
									</span>
								</td>
								
								
								<td style="width:10%" valign="center">
									<span class="btn-group">
										<span class="btn btn-small"  title="Carta d'identità  <?php if(!$arr_sub['CI'] || trim($arr_sub['CI'])==""){?>non<?php }?> inviata" <?php if($arr_sub['CI'] && trim($arr_sub['CI'])!=""){?>style="color:green"<?php }?> onclick="ins_doc('CI','<?php echo $id_campo_sub;?>')"><i class="fa fa-id-card" aria-hidden="true"></i></span>										
										<span class="btn btn-small"  title="Codice Fiscale <?php if(!$arr_sub['CF'] || trim($arr_sub['CF'])==""){?>non<?php }?> inviato" <?php if($arr_sub['CF'] && trim($arr_sub['CF'])!=""){?>style="color:green"<?php }?> onclick="ins_doc('CF','<?php echo $id_campo_sub;?>')"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
										<span class="btn btn-small"  title="Certificato medico <?php if(!$arr_sub['CM'] || trim($arr_sub['CM'])==""){?>non<?php }?> inviato" style="color:<?php if($arr_sub['CM'] && trim($arr_sub['CM'])!=""){?>green<?php }else{?>#808080<?php }?>;" onclick="ins_doc('CM','<?php echo $id_campo_sub;?>')"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
									</span>
								</td>
							</tr>
						<?php }
					}
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
		$("#box_doc").fadeIn();
		document.getElementById('frame_link').src="frame/iscrizioni_scuola_doc.php?tipo="+tipo+"&id_doc="+id_doc;	
	}
</script>
