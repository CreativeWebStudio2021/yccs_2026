<?php
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'resarea/config/dbnew.php';
require_once 'resarea/fissi/functions.php';

if(isset($_GET['codice'])) $codice=$_GET['codice']; else $codice='';
if(isset($_GET['id_doc'])) $id_doc=$_GET['id_doc']; else $id_doc='';
if(isset($_GET['nome'])) $nome=$_GET['nome']; else $nome='';
if(isset($_GET['cognome'])) $cognome=$_GET['cognome']; else $cognome='';
if(isset($_GET['email_invio'])) $email_invio=$_GET['email_invio']; else $email_invio='';

$nome_cliente = ucfirst($nome);
$cognome_cliente = ucfirst($cognome);

$link_pagamento="$http://$ind_sito/yccs-sailing-school-conferma-iscrizione_".$codice.".html";

if(isset($_GET['boat_name_ric'])) $boat_name_ric=$_GET['boat_name_ric']; else $boat_name_ric='';
if(isset($_GET['charterer_ric'])) $charterer_ric=$_GET['charterer_ric']; else $charterer_ric='';
if(isset($_GET['charterer_email_ric'])) $charterer_email_ric=$_GET['charterer_email_ric']; else $charterer_email_ric='';
$rif="";
if($boat_name_ric!="") {$rif.="&boat_name_ric=$boat_name_ric"; }
if($charterer_ric!="") {$rif.="&charterer_ric=$charterer_ric"; }
if($charterer_email_ric!="") {$rif.="&charterer_email_ric=$charterer_email_ric"; }

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$send_mail_cli = new PHPMailer(TRUE);

include("resarea/fissi/body_mail_scuola_vela.css.php");

$testo_cli = "<br><br><br>Gentile <b>$nome_cliente $cognome_cliente</b><br/>
		<br><br>
		Per procedere al pagamento dell'iscrizione cliccare sul seguente link.
		<br/><br/>
		<a href='".$link_pagamento."'><div style='width:200px; border-radius:3px; background:#005cb9; text-align:center;'><div style='padding:4px 0px; color:#fff'><b>VAI AL PAGAMENTO</b></div></div></a>
		<br><br>		
		";
		
$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);
$oggetto_ut	= "YCCS Sailing School - Link Pagamento";

/**/
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
	$send_mail_cli->addAddress($email_invio, $nome_del_sito);
	//$send_mail_cli->addAddress("test-bxkyek56u@srv1.mail-tester.com", $nome." ".$cognome);
	$send_mail_cli->addReplyTo($mail_sito, $nome_del_sito);
	
	$send_mail_cli->isHTML(true); 
	$send_mail_cli->Subject = $oggetto_ut;
	$send_mail_cli->Body    = $body_cli; 
	$send_mail_cli->AltBody  =  strip_tags($body_cli);
	$send_mail_cli->send();
	
} catch (Exception $e) {
	echo 'Sorry Dear, Message could not be sent.';
	echo 'Mailer Error: ' . $send_mail_cli->ErrorInfo;
}
?>