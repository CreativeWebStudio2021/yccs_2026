<?php
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['codice_iscrizione'])) $codice_iscrizione=$_GET['codice_iscrizione']; else $codice_iscrizione="";
if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife="";
if(isset($_GET['lingua'])) $lingua=$_GET['lingua']; else $lingua="ita";
if(isset($_GET['admin'])) $admin=$_GET['admin']; else $admin="ita";

if($codice_iscrizione!="" && $id_rife!=""){
	
	require_once 'resarea/config/dbnew.php';

	
	$query_dati="SELECT email, nome, cognome FROM iscrizioni_scuola WHERE id='$id_rife'";
	$resu_dati=$open_connection->connection->query($query_dati);
	$num_dati = $resu_dati->rowCount();
	if($num_dati>0){
	

		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';
		require 'PHPMailer/src/Exception.php';

		$send_mail_cli = new PHPMailer(TRUE);
		
		include("resarea/fissi/body_mail_scuola_vela.css.php");
		
		if($lingua=="ita" ) $oggetto_ut = "YCCS Sailing School - Conferma nuova richiesta d'iscrizione";
		else $oggetto_ut = "YCCS Sailing School - Confirm new registration";
		
		$dati="";
		$risu_dati = $resu_dati->fetch();
		$email = $risu_dati['email'];
		$nome = $risu_dati['nome'];
		$cognome = $risu_dati['cognome'];
		
		$link = "$http://$ind_sito/yccs-sailing-school-iscrizioni-$codice_iscrizione-$id_rife.html";
		$link_eng = "$http://$ind_sito/en/yccs-sailing-school-iscrizioni-$codice_iscrizione-$id_rife.html";
			
		if($lingua=="ita"){
			$testo_cli = "<br><br><br>Gentile <b>$nome</b><br/>è stata creata una nuova richiesta di iscrizione.</b>
			<br><br>
			 Per confermare i dati e la presa visione dell'informativa ai sensi del Regolamento (UE) 2016/679 premere il pulsante sotto riportato.<br/>
			 <br/><br/>
			<a href='$link'><div style='width:200px; border-radius:3px; background:#005cb9; text-align:center;'><div style='padding:4px 0px; color:#fff'><b>CONFERMA ISCRIZIONE</b></div></div></a>";
			
			
		}elseif($lingua=="eng"){
			$testo_cli = "<br><br><br>Dear <b>$nome</b><br/>a new registration request has been created.</b>
			<br><br>
			To confirm the data and confirm having read the informative note pursuant to EU Regulation 2016/679 click the button below.<br/>
			<br/><br/>
			<a href='$link_eng'><div style='width:250px; border-radius:3px; background:#005cb9; text-align:center;'><div style='padding:4px 0px; color:#fff'><b>CONFIRM YOUR REGISTRATION</b></div></div></a>";
			
		}

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
			
			$query_up="UPDATE iscrizioni_scuola SET mail_iscrizione = '1' WHERE id='$id_rife'";
			$risu_up=$open_connection->connection->query($query_up);
			?>
			<script>
				<?if($admin==1){?>
					alert('Email con link a nuova iscrizione inviata');
				<?}else{?>
					alert('Nuova iscrizione salvata ed email con link inviata');
				<?}?>
				window.location='<?=$http;?>://<?=$ind_sito;?>/resarea/admin.php?cmd=iscrizioni_scuola';
			</script>
			<?
		} catch (Exception $e) {
			echo 'Sorry Dear, Message could not be sent.';
			echo 'Mailer Error: ' . $send_mail_cli->ErrorInfo;
		}
	}	
}	
?>
			