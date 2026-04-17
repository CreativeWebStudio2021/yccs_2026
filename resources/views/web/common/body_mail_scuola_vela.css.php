<?php
$body = $body1 = "
<html><head>

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\"/>
<meta http-equiv=\"content-language\" content=\"IT\"/>

<style type=\"text/css\">
	body{ 
		padding: 30px 20px;
		margin:0px;
		width:800px;
		background-color:#ffffff;
		text-align:left;	
		font-family: arial;
		font-size: 12px;
		line-height:160%;
		color: black;
	}

	img{border:0px}
		
	a{text-decoration:none;}
	a:hover{color: #0079c2; border-color:#0079c2}
	a.menu{text-decoration:none;color: #0079c2;}
	a.menu:hover{color: #0079c2; border-color:#0079c2}

	.big{	font-size: 13px;}
</style>

</head>

<body class=\"testo\">

<div style=\"position:relative;top:0px;left:0px;\">
	<img src=\"".config('app.url')."/web/images/logo.png\">
</div>";

$body .= "<div style=\"position:relative;left:0px;z-index:20;margin:20px 0px 0px 0px\">CONTENUTO_DA_SOSTITUIRE</div>
 
<div style=\"position:relative;left:0px\"><br/>";
	if(isset($intestazione_mail) && trim($intestazione_mail)!=""){
		$body .= $intestazione_mail;
	}else{
		$body .= "<b><span style=\"color:#0079c2\">YACHT CLUB COSTA SMERALDA</span></b>
				<br/>Via della marina
				<br/>07021 Porto Cervo (Italy)
				<br/><span style=\"color:#0079c2\">Tel:</span> (+39) 0789 902200
				<br/><span style=\"color:#0079c2\">Fax:</span> (+39) 0789 91257
				<br/><a href=\"mailto:secretariat@yccs.it\" class=\"menu\">secretariat@yccs.it</a>
				<br/><a href=\"".config('app.url')."\" class=\"menu\">$ind_sito</a>
				";
	}
	$body .= "<br><br><p class=\"menu\" style=\"border-top:1px solid #c1c1c1;padding-top:20px;width:700px;\">
	Avviso di riservatezza - Il testo e gli eventuali documenti trasmessi contengono informazioni riservate al destinatario indicato. La seguente e-mail è confidenziale e la sua riservatezza è tutelata dal GDPR 679/16. La lettura, copia o altro uso non autorizzato o qualsiasi altra azione derivante dalla conoscenza di queste informazioni sono rigorosamente vietate. Qualora abbiate ricevuto questo documento per errore siete cortesemente pregati di darne immediata comunicazione al mittente, ai numeri qui indicati e/o all'indirizzo dello stesso e di provvedere immediatamente alla sua distruzione.
	</p>
</div>

</body>
</html>";

$body1 .= "<div style=\"position:relative;left:0px;z-index:20;margin:20px 0px 0px 0px\">CONTENUTO_DA_SOSTITUIRE</div>
 
</body>
</html>";
?>
