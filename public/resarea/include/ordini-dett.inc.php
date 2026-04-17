<?php 
$table="ordini";

$data_oggi = date("d-m-Y");

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['stato_ric'])) $stato_ric=$_GET['stato_ric']; else $stato_ric='';
if(isset($_GET['num_ric'])) $num_ric=$_GET['num_ric']; else $num_ric='';
if(isset($_GET['cognome_ric'])) $cognome_ric=$_GET['cognome_ric']; else $cognome_ric='';
if(isset($_GET['email_ric'])) $email_ric=$_GET['email_ric']; else $email_ric='';
if(isset($_GET['dal_ric'])) $dal_ric=$_GET['dal_ric']; else $dal_ric='';
if(isset($_GET['al_ric'])) $al_ric=$_GET['al_ric']; else $al_ric='';

$rif="";
if($stato_ric!="") { $rif.="&stato_ric=$stato_ric"; }
if($num_ric!="") { $rif.="&num_ric=$num_ric"; }
if($cognome_ric!="") { $rif.="&cognome_ric=$cognome_ric"; }
if($email_ric!="") { $rif.="&email_ric=$email_ric"; }
if($dal_ric!="") { $rif.="&dal_ric=$dal_ric"; }
if($al_ric!="") { $rif.="&al_ric=$al_ric"; }
$rif.="&pag_att=$pag_att";

if (isset($_POST['stato_mod']) && $_POST['stato_mod']=="1") {
	if (isset($_POST['note_mod'])) $note_mod = $_POST['note_mod'];
		else $note_mod = "";
	
	$query_mod = "update ordini set note='$note_mod' where id='$id_rec'";
	$risu_mod = $open_connection->connection->query($query_mod);
}		

if (isset($_POST['data_pag'])) $data_pag = $_POST['data_pag'];
	else $data_pag = $data_oggi;

if (isset($_POST['stato_pagato']) && $_POST['stato_pagato']=="inviato") {
	if (isset($_POST['data_pag'])) $data_pagam = $_POST['data_pag'];
	else $data_pagam = "";
	
	$query_stato = "select status from ordini where id='$id_rec'";
	$risu_stato = $open_connection->connection->query($query_stato);
	list($stato_old) = $risu_stato->fetch();
	
	if ($data_pagam!="") {
		$temp=explode("-",$data_pagam);
		$data_pagam=$temp[2]."-".$temp[1]."-".$temp[0];
		$data_pagam .= " 00:00:00";
		
		if ($stato_old=="spedito") $query_agg = "update ordini set data_pagato='$data_pagam',data_mod='".date('Y-m-d H:i:s')."' where id='$id_rec'";
		else $query_agg = "update ordini set data_pagato='$data_pagam',status='pagato',data_mod='".date('Y-m-d H:i:s')."' where id='$id_rec'";
		//echo $query_agg;
		$risu_agg = $open_connection->connection->query($query_agg);
	}
}


$query_ord = "select * from ordini where id='$id_rec' ";
$risu_ord = $open_connection->connection->query($query_ord);
$arr_ord = $risu_ord->fetch();

$id_cliente = $arr_ord['id_cliente'];
$nome_cli = $arr_ord['nome'];
$stato_ord = $arr_ord['status'];
$data_pagato = $arr_ord['data_pagato'];
$pagamento = $arr_ord['pagamento'];
$spedizione = $arr_ord['spedizione'];
$totale = $arr_ord['totale'];
$spese = $arr_ord['spese'];
$nome_fatt = $arr_ord['nome_fatt'];
$rag_sociale_fatt = $arr_ord['azienda_fatt'];
$piva_fatt = $arr_ord['piva_fatt'];
$fattura = $arr_ord['fattura'];
$indirizzo_fatt = $arr_ord['indirizzo_fatt'];
$cap_fatt = $arr_ord['cap_fatt'];
$citta_fatt = $arr_ord['citta_fatt'];
$prov_fatt = $arr_ord['prov_fatt'];
$nazione_fatt = $arr_ord['paese_fatt'];
$nome_cons = $arr_ord['nome_spe'];
$rag_sociale_cons = $arr_ord['azienda_spe'];
$indirizzo_cons = $arr_ord['indirizzo_spe'];
$cap_cons = $arr_ord['cap_spe'];
$citta_cons = $arr_ord['citta_spe'];
$prov_cons = $arr_ord['prov_spe'];
$nazione_cons = $arr_ord['paese_spe'];
$note = $arr_ord['note'];

$fattura_vedi = "No";
if ($fattura=="1") $fattura_vedi = "Sì";

$data_ord = $arr_ord['data_ord'];
if($data_ord != "") {
	//$arr_data_ord = explode(" ",$data_ord);
	//$data_ord = date_to_data($arr_data_ord[0]);
}

$evaso = "NO";
if($stato_ord=="pagato" || $stato_ord=="spedito")
{
	if($data_pagato != "") {
		$arr_data = explode(" ",$data_pagato);
		$temp=explode("-",$arr_data[0]);
		$data_pagato = $temp[2]."-".$temp[1]."-".$temp[0];
		
		$pagato = "il $data_pagato";
	}
	else $pagato = "il ( data non disponibile )";
	
	if ($stato_ord=="spedito") $evaso = "SI";
}
else $pagato = "NO";
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">
		<div style="float:left"><b>Dettaglio <?php echo $table;?><?php if(isset($_POST['stato_pagato'])) echo $_POST['stato_pagato'];?></b></div>
		<div style="clear:both"></div>
	</div>
		
		<div style="display:flex; justify-content:space-between;">
			<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
				<div class="newAdminBott2">
					<i class="fa fa-caret-left" aria-hidden="true"></i>
					&nbsp;
					<b>Torna all'elenco degli ordini</b>
				</div>
			</a>
			<div></div>
		</div>
	
	<div class="mws-panel-header">
		<span><i class="fa fa-file-text-o" style="color:#fff"></i> Dati ordine</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table cellspacing="0" cellpadding="0" border="0" width="100%" class="testo11" style="padding:20px">
			
			<tr><td height="20px" class="testo11"><span class="celeste">Codice:</span> <b><?php echo $arr_ord['id']?></b></td></tr>
			<tr><td height="20px" class="testo11"><span class="celeste">Del:</span> <b><?php echo $data_ord?></b></td></tr>
			<tr><td height="20px" class="testo11"><span class="celeste">Stato:</span> <b><?php echo ucfirst($stato_ord);?></b><br/><br/></td></tr>
			<tr><td height="20px" class="testo11"><span class="celeste">Pagamento scelto:</span> <b><?php echo $pagamento?></b></td></tr>
			<tr><td height="20px" class="testo11"><span class="celeste">Pagato:</span> <b><?php echo $pagato?></b></td></tr>
			<tr><td height="20px" class="testo11"><span class="celeste">Metodo di spedizione:</span> <b><?php echo $spedizione?></b></td></tr>
			<tr><td height="20px" class="testo11"><span class="celeste">Spese di spedizione:</span> <b><?php  echo number_format($spese, 2, ',', '.')." &euro;"; ?></b></td></tr>
			<tr><td height="20px" class="testo11"><span class="celeste">Evaso:</span> <b><?php echo $evaso?></b></td></tr>
			<?php  if ($stato_ord=="sospeso") { ?>
				<tr><td height="20px" class="testo11"><span class="celeste">Totale parziale:</span> <b><?php echo number_format($totale, 2, ',', '.');?> &euro;</b><br/><br/></td></tr>
			<?php  } else { ?>
				<tr><td height="20px" class="testo11"><span class="celeste">Totale:</span> <b><?php echo number_format($totale, 2, ',', '.');?> &euro;</b><br/><br/></td></tr>
			<?php  } ?>
			<tr>
				<td height="20px" class="testo11">
					<span class="celeste">Cliente:</span>
					<a class="celeste" href="admin.php?cmd=clienti_mod&id_rec=<?php echo $id_cliente;?>" style="color:#333333; text-decoration:underline"><b><?php  echo strtoupper($nome_cli); ?></b></a>
				</td>
			</tr>		
			
			<tr><td height="20px" class="testo11"><span class="celeste">Indirizzo per la spedizione:</span> <b><?php  echo ucwords($nome_cons)." - ".ucwords($indirizzo_cons)." - ".$cap_cons." ".ucwords($citta_cons); ?></b></td></tr>
			
			<?php if(isset($note_spe) && $note_spe!=""){?>
				<tr><td class="testo11" style="padding-top:10px"><span class="celeste">Note Spedizione:</span><br /><b><?php  echo ucfirst($note_spe); ?></b><br /><br /></td></tr>
			<?php }?>
			
			<tr><td height="20px" class="testo11"><span class="celeste">Fattura:</span> <b><?php echo $fattura_vedi?></b></td></tr>
			<?php  if ($fattura_vedi=="Sì") { ?>
				<tr><td height="20px" class="testo11"><span class="celeste">Indirizzo di fatturazione:</span> <b><?php  echo ucwords($nome_fatt)." - ".ucwords($indirizzo_fatt)." - ".$cap_fatt." ".ucwords($citta_fatt); ?></b></td></tr>
				<?php if($rag_sociale_fatt && $rag_sociale_fatt!=""){?><tr><td height="20px" class="testo11"><span class="celeste">Ragione sociale:</span> <b><?php  echo ucwords($rag_sociale_fatt); ?></b></tr><?php }?>
				<?php if($piva_fatt && $piva_fatt!=""){?><tr><td height="20px" class="testo11"><span class="celeste">Partita IVA:</span> <b><?php  echo $piva_fatt; ?></b></tr><?php }?>
			<?php  } ?>
			
			<form name="form_note" action="admin.php?cmd=ordini-dett&id_rec=<?php echo $arr_ord['id']?><?php echo $rif?>" method="post">
				<input type="hidden" name="stato_mod" value="1"/>
				<tr><td class="testo11" style="padding-top:10px"><span class="celeste">Note:</span><br /><textarea name="note_mod" cols="110" rows="6" class="campitesto2"><?php  echo ucfirst($note); ?></textarea><br /><br /></td></tr>
				<tr><td><input type="submit" class="bottone" value="MODIFICA NOTE" style="width:150px" /></td></tr>
			</form>						
			<tr><td height="30px"></td></tr>
		</table>
	</div>
	
	<div class="mws-panel-header" style="margin-top:20px;">
		<span><i class="icon-table"></i> Elenco Prodotti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>					
					<th style="width:50px"><i class="fa fa-camera"></i></th>
					<th style="text-align:left">Cod.</th>			
					<th style="text-align:left">Prodotto</th>			
					<th style="text-align:left">Quantità</th>		
					<!--<th style="text-align:left">Peso</th>	
					<th style="text-align:left">Peso Parz</th>-->
					<th style="text-align:left">Prezzo</th>		
					<th style="text-align:left">Totale parz.</th>	
				</tr>
			</thead>
			<tbody>
				<?php 
				$query_ele = "select * from ordini_prod where id_ord='$id_rec'";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$tot_ordinati = 0.00;

				while($arr_ele = $risu_ele->fetch())
				{
					echo "<tr>";

					$id_campo = $arr_ele['id'];
					$id_prodotto = $arr_ele['id_prod'];
					$quantita = $arr_ele['quantita'];
					/*$peso = number_format($arr_ele['peso'], 2);
					$peso_f = number_format($arr_ele['peso_f'], 2);*/
					$prezzo = number_format($arr_ele['prezzo'], 2);
					$prezzo_f = number_format($arr_ele['prezzo_f'],2);
					$tipo = $arr_ele['tipo'];
					$colore = $arr_ele['colore'];
					
					$tabella = "prodotti";
					if ($tipo=="offerta") $tabella = "offerte";
					
					$cod_prod = $id_prodotto;
					$nome_prod = $arr_ele['nome'];
					$tot_ordinati += $prezzo_f;
					
					$foto = "";
					$query_foto = "select img from $tabella where id='$id_prodotto'";
					$risu_foto = $open_connection->connection->query($query_foto);
					if ($risu_foto) list($foto) = $risu_foto->fetch();
					
					/*$prezzo_f = number_format($arr_ele['prezzo_f'], 2);*/
					?>
					<td valign="center" align="center">
						<?php  
						if ($foto!="") { 
							if(file_exists("img_up/prodotti/s_$foto")) $ante = "img_up/prodotti/s_$foto";
							elseif(file_exists("img_up/prodotti/$foto")) $ante = "img_up/prodotti/$foto";
							else $ante = "https://www.yccs.it/resarea/img_up/prodotti/$foto";
							?>
							<img src="<?php echo $ante?>" alt="" style="width:70px;"/>
						<?php  } ?>				
					</td>					
					<td valign="center"><?php echo $cod_prod;?></td>
					<td valign="center">
						<?php echo $nome_prod;?>
						<?php if($colore && trim($colore)!=""){?>&nbsp;(<?php echo $colore;?>)<?php }?>
						<?php if($arr_ele['taglia'] && $arr_ele['taglia']!="" && $arr_ele['taglia']!="0"){
							 echo " - ".$arr_ele['taglia'];
						}?>
					</td>
					<td valign="center"><?php echo $quantita;?></td>
					<!--<td valign="center"><?php echo $peso;?> Kg</td>
					<td valign="center"><?php echo $peso_f;?> Kg</td>-->
					<td valign="center"><?php echo $prezzo;?> &euro;</td>
					<td valign="center"><?php echo $prezzo_f;?> &euro;</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<?php if ($stato_ord=="nuovo" || $stato_ord=="annullato" || ($stato_ord=="spedito" && $data_pagato=="")) {?>
		<div class="mws-panel-header" style="margin-top:20px;">
			<span><i class="fa fa-eur" style="color:#fff"></i> Registra Pagamento</span>
		</div>
		
		<div class="mws-panel-body no-padding">
			<form name="pagamento_ins" class="mws-form" action="admin.php?cmd=<?php echo $table;?>-dett&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
				<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
				<input type="hidden" name="stato_pagato" value="inviato">
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Data Pagamento</label>
						<div class="mws-form-item">
							<input type="text" name="data_pag" class="mws-datepicker large"  value="<?php echo $data_pag;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<div class="mws-button-row">
					<input type="submit" value="Inserisci" class="btn btn-danger">
				</div>
			</form>
		</div>
	<?php }?>
	
	<div style="width:100%; padding:20px; text-align:Center;"><a href="admin.php?cmd=ordini<?php echo $rif;?>" style="color:#333333" class="btn btn-sm"><b>Torna Indietro</b></a></div>
</div>
