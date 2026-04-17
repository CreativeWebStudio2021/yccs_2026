<?php 
	include("fissi/body_mail.css.php");
	
	$oggetto_ut    = "Yacht Club Costa Smeralda - Approvazione della Registrazione - Your Registration is Pending Approval";
	$intestazioni  = "From: $nome_del_sito <$mail_sito>\n";
	$intestazioni .= "MIME-Version: 1.0\n";
	$intestazioni .= "Content-type: text/html; \n charset=iso-8859-1\n";
	
	$nome_cliente = ucfirst($nome);
	$cognome_cliente = ucfirst($cognome);
	
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
	
	$testo_azi = "<br><br><br>Un nuovo utente (<b>$cognome_cliente $nome_cliente</b>) si è iscritto al sito.
	<br><br>
	Email : $email<br>
	Tessera Socio n. : $num_socio
	<br/><br/>
	";
	
	$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi, $body);
	$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);
	echo $body_cli;
	
	// mail inviata alla persona
	if(mail($email, $oggetto_ut, $body_cli, $intestazioni, "-fvalidfromaddress@mydomain.com")){
		echo "AAAAAA";
	}else{
		echo "BBBBBBB";
	}
	
	// mail inviata all'azienda 
	mail($mail_sito, "Iscrizione nuovo utente", $body_azi, $intestazioni);
			
?>
			