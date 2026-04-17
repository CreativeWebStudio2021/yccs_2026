<?php
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['id_cli'])) $id_cli=$_GET['id_cli']; else $id_cli="";

if($id_cli!=""){
	
	require_once 'resarea/config/dbnew.php';
	
	$query_dati = "select nome,cognome,email,num_tessera from clienti where id='$id_cli'";
	$resu_dati = $open_connection->connection->query($query_dati);
	$num_dati = $resu_dati->rowCount();
	if($num_dati>0){
		list($nome,$cognome,$email,$num_socio) = $resu_dati->fetch();

		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';
		require 'PHPMailer/src/Exception.php';		

		$send_mail_cli = new PHPMailer(TRUE);
		
		include("resarea/fissi/body_mail.css.php");
		
		$nome_cliente = ucfirst($nome);
		$cognome_cliente = ucfirst($cognome);
		
		$oggetto_ut = "Yacht Club Costa Smeralda - Approvazione della Registrazione - Your Registration is Pending Approval";
		
		
		$testo_cli ="<br><br><br>Gentile <b>$nome_cliente</b> <b>$cognome_cliente</b>,
		<br><br>
		Abbiamo il piacere di informarLa che la Sua registrazione è stata approvata dal nostro team amministrativo, quindi, a partire da questo momento, potrà utilizzare i suoi dati per accedere all'Area Soci.
		<br><br>			
		Il Suo account ha i seguenti dettagli:<br>
		Email : $email<br>
		Tessera Socio n. : $num_socio
		<br/><br/>
		Cordiali saluti,<br>
		Segreteria Soci
		<br><br>
		----------------------------------------------
		<br><br>
		Dear <b>$nome_cliente</b> <b>$cognome_cliente</b>,
		<br><br>
		We are pleased to inform you that application has been activated by our administration team.
		<br><br>
		The details of your account are:<br>
		Email : $email<br>
		Tessera Socio n. : $num_socio
		<br><br>
		Kind regards,<br>
		Members Secretariat
		<br><br>
		NOTA: Questa email è stata generata automaticamente da Yacht Club Costa Smeralda (<a href='".$ind_sito."'>".$http."://".$ind_sito."</a>).
		";

		$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);
				
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
				window.location='<?=$http;?>://<?=$ind_sito;?>/resarea/admin.php?cmd=clienti';
			</script>
			<?
		} catch (Exception $e) {
			echo 'Sorry Dear, Message could not be sent.';
			echo 'Mailer Error: ' . $send_mail_cli->ErrorInfo;
		}
	}	
}	
?>
			