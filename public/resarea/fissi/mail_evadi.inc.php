<?php 
if($email && trim($email)!=""){
	$oggetto_ut    = "Comunicazione evasione ordine num. $id_rec - $nome_del_sito";
	$intestazioni  = "From: $nome_del_sito <$mail_sito>\n";
	$intestazioni .= "MIME-Version: 1.0\n";
	$intestazioni .= "Content-type: text/html; \n charset=iso-8859-1\n";
	
	$nome_cliente = ucfirst($nome);
	$cognome_cliente = ucfirst($cognome);
		
			$sopra = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
					<HTML><HEAD>
					<META http-equiv=Content-Type content=\"text/html; charset=windows-1252\">
					<META content=\"MSHTML 6.00.2730.1700\" name=GENERATOR>
					<STYLE>
					.testo11b{ font-family: tahoma;
						   font-size: 12 px;
						   font-style: normal;
						   font-weight: bold;
						   color:#334663;
						   text-decoration: none
					}

					.testo11b:hover{ font-family: tahoma;
						   font-size: 12 px;
						   font-style: normal;
						   font-weight: bold;
						   color:#000000;
						   text-decoration: underline
					}
					.testo10{ font-family: tahoma;
						   font-size: 12 px;
						   font-style: normal;
						   font-weight: normal;
						   color:#000000;
						   text-decoration: none
					}
					.testo10u{ font-family: tahoma;
						   font-size: 12 px;
						   font-style: normal;
						   font-weight: normal;
						   color:#000000;
						   text-decoration: underline
					}

					.testo11{ font-family: tahoma;
						   font-size: 12 px;
						   font-style: normal;
						   font-weight: normal;
						   color:#000000;
						   text-decoration: none
					}
										
					a.rosso{
							font-size: 12px; 
							font-family: tahoma; 
							font-weight: normal;   
							color: #db2a33; 
							text-decoration: none
					}
					
					a.rosso:hover{ 
						   text-decoration: underline;
					}
					
					body {
						background-position: 0px 0px; 
						background-repeat: no-repeat;
						margin-left: 5px; 
						margin-top: 4px; 
						margin-bottom: 4px;
					}
					</STYLE>
					</HEAD>
					<BODY bgColor=#ffffff leftmargin=0>
					<DIV class=testo11><img src=\"$ind_logo\" border=\"0\">
					";
					/* ind_logo è definita in config.php */

			$testo_cliente ="<br><br><br>Gentile <b>$nome_cliente</b> <b>$cognome_cliente</b>,
			<br><br>le comunichiamo che il suo ordine num. $id_rec è stato evaso e la relativa merce spedita.
			<br/>Segue riepilogo dei suoi dati e dettaglio degli articoli ordinati:
			<br><br>
			$dati_ordine
			<br><br>";

			$sotto =$email_sotto;
			/* email_sotto è definita in config.php */

			$testo_cli = $sopra . $testo_cliente . $sotto;
												
			/* mail inviata alla persona*/
			mail($email, $oggetto_ut, $testo_cli, $intestazioni);
}					
?>
			