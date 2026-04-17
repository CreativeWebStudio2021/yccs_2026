<?php
session_start();	

require_once 'resarea/config/dbnew.php';
require_once 'resarea/fissi/functions_adm.php';
require_once 'resarea/fissi/functions.php';

if(isset($mysidname)){	
	if(isset($_SESSION["carrello_$mysidname"]))
		$carrello = $_SESSION["carrello_$mysidname"];
}

// Namespace alias. 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';		

function inviaMail($email, $oggetto_mail, $testo_mail, $mail_sito, $nome_del_sito, $smtp_host, $smtp_user, $smtp_psw, $http, $ind_sito, $css="body_mail.css.php"){
	
	include("resarea/fissi/$css");
	
	$body_mail = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_mail, $body);
	
	$send_mail = new PHPMailer(TRUE);
	$send_mail->CharSet = "text/html; charset=UTF-8;";
	try {
		$send_mail->isSMTP();
		$send_mail->Host = $smtp_host;
		$send_mail->Port = 465;
		$send_mail->SMTPSecure = 'ssl';
		$send_mail->SMTPAuth = true;
		$send_mail->Username = $smtp_user;
		$send_mail->Password = $smtp_psw;

		//Content
		$send_mail->setFrom($mail_sito, $nome_del_sito);
		$send_mail->addAddress($email, $nome_del_sito);
		//$send_mail->addAddress("test-bxkyek56u@srv1.mail-tester.com", $nome." ".$cognome);
		$send_mail->addReplyTo($mail_sito, $nome_del_sito);
		
		$send_mail->isHTML(true); 
		$send_mail->Subject = $oggetto_mail;
		$send_mail->Body    = $body_mail; 
		$send_mail->AltBody  =  strip_tags($body_mail);
		$send_mail->send();
	} catch (Exception $e) {
		echo 'Sorry Dear, Message could not be sent.';
		echo 'Mailer Error: ' . $send_mail->ErrorInfo;
	}
}

/////////////////////////////////////////////////
/////////////Begin Script below./////////////////
/////////////////////////////////////////////////

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
$req2 ="";
foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
	$req2 .= "&$key=$value<br/>";
}
/*
$int  = "From:  $nome_del_sito <$mail_sito>\n";
$int .= "MIME-Version: 1.0\n";
$int .= "Content-type: text/html; \n charset=iso-8859-1\n";
//@mail("f.denegri@cwstudio.it", "Prova IPN", "Test<br/>$req2", $int);

$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
if ($local || $cws)
	$header .= "Host: www.sandbox.paypal.com\r\n";  // www.paypal.com for a live site
else
	$header .= "Host: www.paypal.com\r\n";  // www.paypal.com for a live site
$header .= "Content-Length: " . strlen($req) . "\r\n";
$header .= "Connection: close\r\n\r\n";

// If testing on Sandbox use:
if ($local || $cws)
	$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
else
	$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);*/


$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
//$url = 'https://www.paypal.com/cgi-bin/webscr';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

if (!($res = curl_exec($ch))) {
  //invalid response
  curl_close($ch);
  return;
}
curl_close($ch);

// assign posted variables to local variables
if(isset($_POST['item_name'])) $item_name = $_POST['item_name1'];
if(isset($_POST['business'])) $business = $_POST['business'];
if(isset($_POST['item_number'])) $item_number = $_POST['item_number'];
if(isset($_POST['payment_status'])) $payment_status = $_POST['payment_status'];
if(isset($_POST['mc_gross1'])) $mc_gross = $_POST['mc_gross1'];
if(isset($_POST['mc_currency'])) $payment_currency = $_POST['mc_currency'];
if(isset($_POST['txn_id'])) $txn_id = $_POST['txn_id'];
if(isset($_POST['receiver_email'])) $receiver_email = $_POST['receiver_email'];
if(isset($_POST['receiver_id'])) $receiver_id = $_POST['receiver_id'];
if(isset($_POST['quantity'])) $quantity = $_POST['quantity1'];
if(isset($_POST['num_cart_items'])) $num_cart_items = $_POST['num_cart_items'];
if(isset($_POST['payment_date'])) $payment_date = $_POST['payment_date'];
if(isset($_POST['first_name'])) $first_name = $_POST['first_name'];
if(isset($_POST['last_name'])) $last_name = $_POST['last_name'];
if(isset($_POST['payment_type'])) $payment_type = $_POST['payment_type'];
if(isset($_POST['payment_gross'])) $payment_gross = $_POST['payment_gross'];
if(isset($_POST['payment_fee'])) $payment_fee = $_POST['payment_fee'];
if(isset($_POST['settle_amount'])) $settle_amount = $_POST['settle_amount'];
if(isset($_POST['memo'])) $memo = $_POST['memo'];
if(isset($_POST['payer_email'])) $payer_email = $_POST['payer_email'];
if(isset($_POST['txn_type'])) $txn_type = $_POST['txn_type'];
if(isset($_POST['payer_status'])) $payer_status = $_POST['payer_status'];
if(isset($_POST['address_street'])) $address_street = $_POST['address_street'];
if(isset($_POST['address_city'])) $address_city = $_POST['address_city'];
if(isset($_POST['address_state'])) $address_state = $_POST['address_state'];
if(isset($_POST['address_zip'])) $address_zip = $_POST['address_zip'];
if(isset($_POST['address_country'])) $address_country = $_POST['address_country'];
if(isset($_POST['address_status'])) $address_status = $_POST['address_status'];
if(isset($_POST['item_number'])) $item_number = $_POST['item_number'];
if(isset($_POST['tax'])) $tax = $_POST['tax'];
if(isset($_POST['option_name1'])) $option_name1 = $_POST['option_name1'];
if(isset($_POST['option_selection1'])) $option_selection1 = $_POST['option_selection1'];
if(isset($_POST['option_name2'])) $option_name2 = $_POST['option_name2'];
if(isset($_POST['option_selection2'])) $option_selection2 = $_POST['option_selection2'];
if(isset($_POST['for_auction'])) $for_auction = $_POST['for_auction'];
if(isset($_POST['invoice'])) $invoice = $_POST['invoice'];
if(isset($_POST['custom'])) $custom = $_POST['custom'];
if(isset($_POST['notify_version'])) $notify_version = $_POST['notify_version'];
if(isset($_POST['verify_sign'])) $verify_sign = $_POST['verify_sign'];
if(isset($_POST['payer_business_name'])) $payer_business_name = $_POST['payer_business_name'];
if(isset($_POST['payer_id'])) $payer_id =$_POST['payer_id'];
if(isset($_POST['mc_currency'])) $mc_currency = $_POST['mc_currency'];
if(isset($_POST['mc_fee'])) $mc_fee = $_POST['mc_fee'];
if(isset($_POST['exchange_rate'])) $exchange_rate = $_POST['exchange_rate'];
if(isset($_POST['settle_currency'])) $settle_currency  = $_POST['settle_currency'];
if(isset($_POST['parent_txn_id'])) $parent_txn_id  = $_POST['parent_txn_id'];
if(isset($_POST['pending_reason'])) $pending_reason = $_POST['pending_reason'];
if(isset($_POST['reason_code'])) $reason_code = $_POST['reason_code'];


// subscription specific vars

if(isset($_POST['subscr_id'])) $subscr_id = $_POST['subscr_id'];
if(isset($_POST['subscr_date'])) $subscr_date = $_POST['subscr_date'];
if(isset($_POST['subscr_effective'])) $subscr_effective  = $_POST['subscr_effective'];
if(isset($_POST['period1'])) $period1 = $_POST['period1'];
if(isset($_POST['period2'])) $period2 = $_POST['period2'];
if(isset($_POST['period3'])) $period3 = $_POST['period3'];
if(isset($_POST['amount1'])) $amount1 = $_POST['amount1'];
if(isset($_POST['amount2'])) $amount2 = $_POST['amount2'];
if(isset($_POST['amount3'])) $amount3 = $_POST['amount3'];
if(isset($_POST['mc_amount1'])) $mc_amount1 = $_POST['mc_amount1'];
if(isset($_POST['mc_amount2'])) $mc_amount2 = $_POST['mc_amount2'];
if(isset($_POST['mcamount3'])) $mc_amount3 = $_POST['mcamount3'];
if(isset($_POST['recurring'])) $recurring = $_POST['recurring'];
if(isset($_POST['reattempt'])) $reattempt = $_POST['reattempt'];
if(isset($_POST['retry_at'])) $retry_at = $_POST['retry_at'];
if(isset($_POST['recur_times'])) $recur_times = $_POST['recur_times'];
if(isset($_POST['username'])) $username = $_POST['username'];
if(isset($_POST['password'])) $password = $_POST['password'];

//auction specific vars

if(isset($_POST['for_auction'])) $for_auction = $_POST['for_auction'];
if(isset($_POST['auction_closing_date'])) $auction_closing_date  = $_POST['auction_closing_date'];
if(isset($_POST['auction_multi_item'])) $auction_multi_item  = $_POST['auction_multi_item'];
if(isset($_POST['auction_buyer_id'])) $auction_buyer_id  = $_POST['auction_buyer_id'];


$notify_email =  "f.denegri@cwstudio.it";         //email address to which debug emails are sent to

if (strcmp($res, "VERIFIED") == 0) {	
	$fecha = date("m")."/".date("d")."/".date("Y");
	$fecha = date("Y").date("m").date("d");

	//check if transaction ID has been processed before
	$checkquery = "select txnid from paypal_payment_info where txnid='".$txn_id."'";
	$sihay = $open_connection->connection->query($checkquery);			
	$nm = $sihay->rowCount();
	if ($nm == 0){					
		// send an email in any case
		//echo "Verified";
		
		
		//mail($notify_email, "VERIFIED IPN - $nome_del_sito", "$res\n $req\n $strQuery\n $struery\n  $strQuery2");
		
		$custom = urldecode($custom);
		
		if($custom) {	
			$response_array = explode("-",$custom);
			if(count($response_array)==3) 
			{
				if($response_array[2]=="iscrizione_scuola"){ //SCUOLA VELA
					$codice_iscrizione = $response_array[0];
					$id_iscrizione = $response_array[1];
					
					$query_cod="SELECT * FROM iscrizioni_scuola WHERE id=:id_iscrizione AND id_rife='0'";
					$resu_cod = $open_connection->connection->prepare($query_cod);
					$resu_cod->execute(array(':id_iscrizione'=>$id_iscrizione));
					$num_cod = $resu_cod->rowCount();
					$risu_cod = $resu_cod->fetch();
					
					$status=$risu_cod['status'];
					if($status!="pagato"){
						$nome=$risu_cod['nome'];
						$cognome=$risu_cod['cognome'];
						$totale=$risu_cod['totale'];
						$data=$risu_cod['data_invio'];							
						$email=$risu_cod['email'];							
						$id=$risu_cod['id'];
						
						//include("fissi/postmail_iscrizione_scuola.subinc.php");
						
						$oggetto_azi   = "Notifica Pagamento Iscrizione $nome $cognome";
						$oggetto_ut    = "Notifica Pagamento Iscrizione YCCS Sailing School";						
						
						$dati_ita="";
						
						$testo_azi ="<p class=\"menu\">Report di Notifica pagamento iscrizione YCCS Sailing School - <b>$nome $cognome</b> ha effettuato un pagamento.
									<br /><br />
									<b>Nome:</b> $nome $cognome<br/>
									<b>Ordine n.:</b> $id_iscrizione <br/>
									<b>Data:</b> $data<br/>
									<b>Totale:</b> $totale &euro;<br/>
									";
						$testo_cli ="<p class=\"menu\">
									Dear <b>$nome</b>,<br/>
									<br><br>Thank you for making the payment.				
									<br><br>
									<b>Name:</b> $nome $cognome<br/>
									<b>Order n.:</b> $id_iscrizione <br/>
									<b>Date:</b> $data<br/>
									<b>Total:</b> $totale &euro;
									";	
											
						$testo_azi .= "<br /><br />";			
						$testo_cli .="<br/><br/>,";
						
						inviaMail($mail_sito,$oggetto_azi,$testo_azi,$mail_sito, $nome_del_sito, $smtp_host, $smtp_user, $smtp_psw, $http, $ind_sito, "body_mail_scuola_vela.css.php");
						inviaMail($email,$oggetto_ut,$testo_cli,$mail_sito, $nome_del_sito, $smtp_host, $smtp_user, $smtp_psw, $http, $ind_sito, "body_mail_scuola_vela.css.php");
						
						$query_up="UPDATE iscrizioni_scuola SET status='pagato', data_pagamento='".date("Y-m-d H:i:s")."' WHERE id='$id_iscrizione'";
						$risu_up=$open_connection->connection->query($query_up);
					}
				}elseif($response_array[2]=="iscrizione_regata"){ //REGATE
					//inviaMail($mail_sito,"AAAAA","AAAAA",$mail_sito, $nome_del_sito, $smtp_host, $smtp_user, $smtp_psw, $http, $ind_sito);
					$codice_iscrizione = $response_array[0];
					$id_iscrizione = $response_array[1];
					
					$query_cod="SELECT * FROM edizioni_iscrizioni_regata WHERE codice=:codice";
					$resu_cod = $open_connection->connection->prepare($query_cod);
					$resu_cod->execute(array(':codice'=>$codice_iscrizione));
					$num_cod = $resu_cod->rowCount();
					$risu_cod = $resu_cod->fetch();
					
					$status=$risu_cod['status'];
					if($status!="pagato"){							
						
						$query_ed="SELECT 	nome_regata, anno FROM edizioni_regate WHERE id='".$risu_cod['id_edizione']."'";
						$resu_ed=$open_connection->connection->query($query_ed);
						$risu_ed = $resu_ed->fetch();
						$nome_regata = $risu_ed['nome_regata'];
						$anno_regata = $risu_ed['anno'];
						if(isset($risu_cod['charterer_email']) && trim($risu_cod['charterer_email'])!="") $email = $risu_cod['charterer_email'];
							else $email = $risu_cod['captain_email'];
						$prezzo = $risu_cod['prezzo'];
						$final_price = $risu_cod['final_price'];
						if(isset($final_price)) $prezzo = $final_price;
						$nome = $risu_cod['owner_name'];
						$data = $risu_cod['data'];
						$boat_name = $risu_cod['boat_name'];
						
						$oggetto_azi   = "Notifica Pagamento Iscrizione Regata $boat_name - $nome_regata ($anno_regata)";
						$oggetto_ut    = "Notifica Pagamento Iscrizione Regata";
										
						$testo_azi ="<p class=\"menu\">Report di Notifica pagamento iscrizione Regata - <b>$nome $cognome</b> ha effettuato un pagamento.<br/>
									<br /><br />
									<b>Nome:</b> $nome<br/>
									<b>Regata:</b> $nome_regata - $anno_regata<br/>
									<b>Ordine n.:</b> $id_iscrizione <br/>
									<b>Data:</b> $data<br/>
									<b>Totale:</b> $prezzo &euro;<br/>
									";
						$testo_cli ="<p class=\"menu\">
									Dear <b>$nome</b>,<br/>
									<br><br>Thank you for making the payment.				
									<br><br>
									<b>Name:</b> $nome<br/>
									<b>Regatta:</b> $nome_regata - $anno_regata<br/>
									<b>Order n.:</b> $id_iscrizione <br/>
									<b>Date:</b> $data<br/>
									<b>Total:</b> $prezzo &euro;<br/>				
									";
								
						$testo_azi .= "<br /><br />";
						$testo_cli .="<br/><br/>Distinti saluti,";
	
						inviaMail($mail_sito,$oggetto_azi,$testo_azi,$mail_sito, $nome_del_sito, $smtp_host, $smtp_user, $smtp_psw, $http, $ind_sito, "body_mail_scuola_vela.css.php");
						inviaMail($email,$oggetto_ut,$testo_cli,$mail_sito, $nome_del_sito, $smtp_host, $smtp_user, $smtp_psw, $http, $ind_sito, "body_mail_scuola_vela.css.php");
						//include("fissi/postmail_iscrizione_regata.subinc.php");
						
						$query_up="UPDATE edizioni_iscrizioni_regata SET status='pagato', data_pagamento='".date("Y-m-d H:i:s")."' WHERE id='$id_iscrizione'";
						$risu_up=$open_connection->connection->query($query_up);
					}/**/
				}else{ //BOUTIQUE					
					$mysidname = $response_array[1];
					$id_ordine = $response_array[0];
					
					if($id_ordine)
					{
						$risu_c = $open_connection->connection->prepare("select c.nome, c.cognome, c.email, c.telefono_fatt, c.telefono_sped, c.id, o.nome_fatt, o.piva_fatt, o.azienda_fatt, o.indirizzo_fatt, o.citta_fatt, o.cap_fatt, o.paese_fatt, o.nome_spe, o.indirizzo_spe, o.citta_spe, o.cap_spe, o.paese_spe, o.totale, o.spese, o.pagamento, o.spedizione, o.note, o.ipn from clienti as c, ordini as o where c.id =o.id_cliente and o.id =:id_ordine ");
						$risu_c->execute(array(':id_ordine'=>$id_ordine));
						list($nome, $cognome, $email, $telefono_fatt, $telefono_sped, $id_cliente, $nome_fatt, $partita_iva_fatt, $ragione_sociale_fatt, $indirizzo_fatt, $citta_fatt, $cap_fatt, $paese_fatt, $nome_sped, $indirizzo_sped, $citta_sped, $cap_sped, $paese_sped, $totale, $spese, $pagamento, $spedizione, $note, $ipn) = $risu_c->fetch();
						//echo "select c.nome, c.cognome, c.email, c.telefono_fatt, c.telefono_sped, c.id, o.nome_fatt, o.piva_fatt, o.azienda_fatt, o.indirizzo_fatt, o.citta_fatt, o.cap_fatt, o.nazione_fatt, o.nome_spe, o.indirizzo_spe, o.citta_spe, o.cap_spe, o.nazione_spe, o.totale, o.spese, o.pagamento, o.spedizione, o.note, o.ipn from clienti as c, ordini as o where c.id =o.id_cliente and o.id ='$id_ordine' ";
						$fattura_vedi = "No";
						if ($fattura=="1") $fattura_vedi = "S?";
						
						if ($ipn=="0") {							
							$dati_ordine = "
							<b>Ordine effettuato da:</b> $nome $cognome <br />
							<b>E-mail:</b> $email <br /><br /><br /><br />";
							
							if ($fattura=="1") {
								$dati_ordine .= "
								<b>Dati di fatturazione:</b><br /><br />
								<b>Nome:</b> $nome_fatt<br />
								<b>Ragione sociale:</b> $ragione_sociale_fatt<br />
								<b>Partita iva:</b> $partita_iva_fatt <br />
								<b>Telefono:</b> $telefono_fatt<br />
								<b>Indirizzo:</b> $indirizzo_fatt<br />
								<b>Citta':</b> $citta_fatt<br />
								<b>CAP:</b> $cap_fatt<br /><br /><br /><br />";
							}
							
							$dati_ordine .= "
							<b>Dati per la spedizione:</b><br /><br />
							<b>Nome:</b> $nome_sped<br />
							<b>Telefono:</b> $telefono_sped<br />
							<b>Indirizzo:</b> $indirizzo_sped<br />
							<b>Citta':</b> $citta_sped<br />
							<b>CAP:</b> $cap_sped<br /><br /><br /><br />";
							
							$dati_ordine .= "<table width=\"600\" style=\"font-size:11px\"><tr><td width=\"80px\"><b>CODICE ART.</b></td> <td width=\"220px\"><b>DESCRIZ.</b></td> <td width=\"100px\"><b>QUANTITA'</b></td> <td width=\"100px\"><b>PREZZO</b></td> <td width=\"100px\"><b>SUBTOTALE</b></td></tr>";
							
							$tot_parziale = 0;
							$peso_tot = 0;
							$risu_pro = $open_connection->connection->prepare("select * from ordini_prod where id_ord='$id_ordine' ");
							$risu_pro->execute(array(':id_ordine'=>$id_ordine));
							$num_pro = $risu_pro->rowCount();
							for ($p=0; $p<$num_pro; $p++) {
								$arr_dati = $risu_pro->fetch();
								$nomep = $arr_dati['nome'];
								if($arr_dati['colore'] && $arr_dati['colore']!=""){
									$nomep .= " (".$arr_dati['colore'].")";
								}
								$prezzo_uni = $arr_dati['prezzo'];
								$prezzo_parz = $arr_dati['prezzo_f'];
								$pezzi = $arr_dati['quantita'];
								$id_articolo = $arr_dati['id_prod'];
								
								$tot_parziale += $prezzo_parz;
								$peso_tot += $prezzo_parz;
								
								$dati_ordine .=" <tr><td>$id_articolo</td> <td>$nomep</td> <td align=center >$pezzi</td> <td align=center>".number_format($prezzo_uni, 2, ',', '.')." &euro; </td> <td align=center>".number_format($prezzo_parz, 2, ',', '.')." &euro; </td></tr>";
							}
							
							
							$tipo_pagamento = "";
							$dati_ordine .= "</table><br /><b>Totale parziale:</b> ".number_format($tot_parziale, 2)." &euro;<br /><b>Spese di spedizione:</b> $spese &euro;<br /><b>Importo totale ordine:</b> $totale &euro;<br /><br /><b>Metodo di pagamento:</b> Paypal o Carta di credito<br /><b>Note:</b> $note <br /><br />";
							
							$newquery=$open_connection->connection->prepare("update ordini set data_pagato='".date('Y-m-d H:i:s')."',data_mod='".date('Y-m-d H:i:s')."',status='pagato',ipn='1' where id='$id_ordine' ");
							@$newquery->execute(array(':id_ordine'=>$id_ordine));
							
							$oggetto_cli    = "Notifica di pagamento ordine num. $id_ordine - $nome_del_sito";
							$oggetto_azi    = "Notifica di pagamento ordine dal sito num. $id_ordine - $nome_del_sito";
							
							$nome_cliente = ucfirst($nome);
							$cognome_cliente = ucfirst($cognome);
	
							$testo_cliente ="<br><br><br>Gentile <b>$nome_cliente</b> <b>$cognome_cliente</b>,
								<br><br>Grazie per aver effettuato il pagamento dell'ordine.
								<br/>Segue riepilogo dei suoi dati e dettaglio degli articoli ordinati:
								<br><br>
								$dati_ordine
								<br><br>";
								
							$testo_azienda = "<br><br><br><b>$nome_cliente</b> <b>$cognome_cliente</b> ha effettuato il pagamento dell'ordine; tutti i dettagli nell'amministrazione.<br/>
								Di seguito i dati dell'ordine:
								<br /><br />
								$dati_ordine
								<br /><br />";
							
							inviaMail($email,$oggetto_cli,$testo_cliente,$mail_sito, $nome_del_sito, $smtp_host, $smtp_user, $smtp_psw, $http, $ind_sito);
							inviaMail($mail_sito,$oggetto_azi,$testo_azienda,$mail_sito, $nome_del_sito, $smtp_host, $smtp_user, $smtp_psw, $http, $ind_sito);
						
						}
						
						// pulisci carrello e recupera giacenze di QUESTO CLIENTE -- TUTTE 
						$risu_carr1 = $open_connection->connection->prepare("select id from carrelli where sessione=:mysidname");
						$risu_carr1->execute(array(':mysidname'=>$mysidname));
						$num_carr1=$risu_carr1->rowCount();
						if($num_carr1>0)
						{
							list($mio_carr_id1) = $risu_carr1->fetch(); 		
							@$open_connection->connection->query("delete from carrelli where id='$mio_carr_id1' ");
							@$open_connection->connection->query("delete from prodotti_carr where id_carrello='$mio_carr_id1' ");
						}
					}
				}
			}
		}
	} else {
		inviaMail("f.denegri@cwstudio.it","KO","SSSSSS",$mail_sito, $nome_del_sito, $smtp_host, $smtp_user, $smtp_psw);
		// send an email
		//mail($notify_email, "VERIFIED DUPLICATED TRANSACTION - $nome_del_sito", "$res\n $req \n $strQuery\n $struery\n  $strQuery2");
	}
	/*
	//subscription handling branch
	if ( $txn_type == "subscr_signup"  ||  $txn_type == "subscr_payment"  ) {

		// insert subscriber payment info into paypal_payment_info table
		$strQuery = "insert into paypal_payment_info(paymentstatus,buyer_email,firstname,lastname,street,city,state,zipcode,country,mc_gross,mc_fee,memo,paymenttype,paymentdate,txnid,pendingreason,reasoncode,tax,datecreation) values ('".$payment_status."','".$payer_email."','".$first_name."','".$last_name."','".$address_street."','".$address_city."','".$address_state."','".$address_zip."','".$address_country."','".$mc_gross."','".$mc_fee."','".$memo."','".$payment_type."','".$payment_date."','".$txn_id."','".$pending_reason."','".$reason_code."','".$tax."','".$fecha."')";
		$result = mysql_query($strQuery) or die("Subscription - paypal_payment_info, Query failed:<br>" . mysql_error() . "<br>" . mysql_errno());

		// insert subscriber info into paypal_subscription_info table
		$strQuery2 = "insert into paypal_subscription_info(subscr_id , sub_event, subscr_date ,subscr_effective,period1,period2, period3, amount1 ,amount2 ,amount3,  mc_amount1,  mc_amount2,  mc_amount3, recurring, reattempt,retry_at, recur_times, username ,password, payment_txn_id, subscriber_emailaddress, datecreation) values ('".$subscr_id."', '".$txn_type."','".$subscr_date."','".$subscr_effective."','".$period1."','".$period2."','".$period3."','".$amount1."','".$amount2."','".$amount3."','".$mc_amount1."','".$mc_amount2."','".$mc_amount3."','".$recurring."','".$reattempt."','".$retry_at."','".$recur_times."','".$username."','".$password."', '".$txn_id."','".$payer_email."','".$fecha."')";
		$result = mysql_query($strQuery2) or die("Subscription - paypal_subscription_info, Query failed:<br>" . mysql_error() . "<br>" . mysql_errno());

		//mail($notify_email, "VERIFIED IPN - $nome_del_sito", "$res\n $req\n $strQuery\n $struery\n  $strQuery2");

	}*/
		
}

// if the IPN POST was 'INVALID'...do this
else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation
	//mail($notify_email, "INVALID IPN - $nome_del_sito", "$res\n $req");
}
?>

