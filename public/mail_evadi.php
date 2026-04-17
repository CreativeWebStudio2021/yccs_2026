<?php
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['id_rec'])) $id_rec=$_GET['id_rec']; else $id_rec="";
if(isset($_GET['stato_ric'])) $stato_ric=$_GET['stato_ric']; else $stato_ric="";
if(isset($_GET['num_ric'])) $num_ric=$_GET['num_ric']; else $num_ric="";
if(isset($_GET['cognome_ric'])) $cognome_ric=$_GET['cognome_ric']; else $cognome_ric="";
if(isset($_GET['email_ric'])) $email_ric=$_GET['email_ric']; else $email_ric="";

if($id_rec!=""){
	
	require_once 'resarea/config/dbnew.php';
	
	$risu_cli = $open_connection->connection->query("select c.nome, c.cognome, c.email, c.id, o.nome_fatt, o.azienda_fatt, o.piva_fatt, o.indirizzo_fatt, o.citta_fatt, o.cap_fatt, o.paese_fatt, o.nome_spe, o.indirizzo_spe, o.citta_spe, o.cap_spe,o.paese_spe, o.totale, o.spese, o.spedizione, o.pagamento, o.note, o.fattura from clienti as c, ordini as o where c.id =o.id_cliente and o.id ='$id_rec' ");
	$num_dati = $risu_cli->rowCount();
	if($num_dati>0){
		list($nome, $cognome, $email, $id_cliente, $nome_fatt, $azienda_fatt, $partita_iva_fatt, $indirizzo_fatt, $citta_fatt, $cap_fatt, $paese_fatt, $nome_spe, $indirizzo_spe, $citta_spe, $cap_spe, $paese_spe, $totale, $spese, $spedizione, $pagamento, $note, $fattura) = $risu_cli->fetch();

		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';
		require 'PHPMailer/src/Exception.php';		

		$send_mail_cli = new PHPMailer(TRUE);
		
		include("resarea/fissi/body_mail.css.php");
		
		$nome_cliente = ucfirst($nome);
		$cognome_cliente = ucfirst($cognome);
		
		$dati_ordine = "
		<b>Ordine effettuato da:</b> $nome $cognome <br />
		<b>E-mail:</b> $email <br /><br /><br /><br />";
		
		if($fattura==1){
			$dati_ordine .= "
			<b>Dati di fatturazione:</b><br /><br />
			<b>Nome:</b> $nome_fatt<br />
			<b>Ragione sociale:</b> $azienda_fatt<br />
			<b>Partita iva:</b> $partita_iva_fatt <br />
			<b>Indirizzo:</b> $indirizzo_fatt<br />
			<b>Citta':</b> $citta_fatt<br />
			<b>CAP:</b> $cap_fatt<br /><br /><br /><br />";
		}
		
		$dati_ordine .= "
		<b>Dati per la spedizione:</b><br /><br />
		<b>Nome:</b> $nome_spe<br />
		<b>Indirizzo:</b> $indirizzo_spe<br />
		<b>Citta':</b> $citta_spe<br />
		<b>CAP:</b> $cap_spe<br /><br /><br /><br />
		
		<b>Dettagli ordine:</b><br /><br />";
		
		$dati_ordine .= "<table width=\"600\" style=\"font-size:11px\"><tr><td width=\"80px\"><b>CODICE ART.</b></td> <td width=\"220px\"><b>DESCRIZ.</b></td> <td width=\"100px\"><b>QUANTITA'</b></td> <td width=\"100px\"><b>PREZZO</b></td> <td width=\"100px\"><b>SUBTOTALE</b></td></tr>";
		
		$tot_parziale = 0;
		$peso_tot=0;
		$risu_pro = $open_connection->connection->query("select * from ordini_prod where id_ord='$id_rec' ");
		$num_pro = $risu_pro->rowCount();
		for ($p=0; $p<$num_pro; $p++) {
			$arr_dati = $risu_pro->fetch();
			$nomep = $arr_dati['nome'];
			if($arr_dati['colore'] && $arr_dati['colore']!=""){
				$nomep .= " (".$arr_dati['colore'].")";
			}
			$pezzi = $arr_dati['quantita'];
			$prezzo_uni = $arr_dati['prezzo'];
			$prezzo_parz = $arr_dati['prezzo_f'];
			
			$tot_parziale += $prezzo_parz;
			$dati_ordine .="<tr><td>".$arr_dati['id_prod']."</td> <td>$nomep</td> <td>$pezzi</td> <td>".number_format($prezzo_uni, 2)." &euro; </td> <td>".number_format($prezzo_parz, 2)." &euro; </td></tr>";
		}
				
		$dati_ordine .= "</table><br /><b>Totale parziale:</b> ".number_format($tot_parziale, 2)." &euro;<br /><b>Spese di spedizione:</b> ".number_format($spese, 2)." &euro;<br /><b>Importo totale ordine:</b> ".number_format($totale, 2)." &euro;<br /><br /><b>Metodo di spedizione:</b> $spedizione<br /><br /><b>Metodo di pagamento:</b> $pagamento<br /><b>Note:</b> $note <br /><br />";
		
		$testo_cli ="<br><br><br>Gentile <b>$nome_cliente</b> <b>$cognome_cliente</b>,
			<br><br>le comunichiamo che il suo ordine num. $id_rec è stato evaso e la relativa merce spedita.
			<br/>Segue riepilogo dei suoi dati e dettaglio degli articoli ordinati:
			<br><br>
			$dati_ordine
			<br><br>";
		
		$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);
		$oggetto_ut = "Comunicazione evasione ordine num. $id_rec - $nome_del_sito";
				
		$send_mail_cli->CharSet = "text/html; charset=UTF-8;";
		try {
			$send_mail_cli->isSMTP();
			$send_mail_cli->Host = $smtp_host;
			$send_mail_cli->Port = 465;
			$send_mail_cli->SMTPSecure = 'ssl';
			$send_mail_cli->SMTPAuth = true;
			$send_mail_cli->Username = $smtp_user;
			$send_mail_cli->Password = $smtp_psw;
		
			//Content
			$send_mail_cli->setFrom($mail_sito, $nome_del_sito);
			$send_mail_cli->addAddress($email, $nome_del_sito);
			//$send_mail_cli->addAddress("test-bxkyek56u@srv1.mail-tester.com", $nome." ".$cognome);
			$send_mail_cli->addReplyTo($mail_sito, $nome_del_sito);
			
			$send_mail_cli->isHTML(true); 
			$send_mail_cli->Subject = $oggetto_ut;
			$send_mail_cli->Body    = $body_cli; 
			$send_mail_cli->AltBody  =  strip_tags($body_cli);
			$send_mail_cli->send();
			?>
			<script>
				window.location='<?=$http;?>://<?=$ind_sito;?>/resarea/admin.php?cmd=ordini&stato_ric=<?=$stato_ric;?>&num_ric=<?=$num_ric;?>&cognome_ric=<?=$cognome_ric;?>&email_ric=<?=$email_ric;?>';
			</script>
			<?
		} catch (Exception $e) {
			echo 'Sorry Dear, Message could not be sent.';
			echo 'Mailer Error: ' . $send_mail_cli->ErrorInfo;
		}
	}	
}	
?>
			