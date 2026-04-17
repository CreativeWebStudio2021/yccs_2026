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
	<img src=\"$http://www.yccs.it/images/logo-scuola-vela-mail.jpg\" alt=\"YCCS Sailing School\" style=\"width:150px;\">
</div>";

$body .= "<div style=\"position:relative;left:0px;z-index:20;margin:20px 0px 0px 0px\">CONTENUTO_DA_SOSTITUIRE</div>
 
<div style=\"position:relative;left:0px\">
	<br/><b><span style=\"color:#0079c2\">YCCS Sailing School</span></b>
	<br/>Via della marina,Edificio Yacht Club Costa Smeralda
	<br/><span style='font-style:italic'>Sede Operativa c/o Centro Sportivo YCCS</span>
	<br/>07021 Porto Cervo (SS)
	<br/><span style=\"color:#0079c2\">Tel:</span> (+39) 0789 902200
	<br/><span style=\"color:#0079c2\">Cell:</span> (+39) 347 079 5547
	<br/><a href=\"mailto:sailingschool@yccs.it\" class=\"menu\">sailingschool@yccs.it</a>
	<br/><a href=\"$http://$ind_sito\" class=\"menu\">$ind_sito</a>
	<br><br>
	<p class=\"menu\" style=\"border-top:1px solid #c1c1c1;padding-top:20px;width:700px;\">
	Informativa Privacy - Ai sensi del Regolamento (UE) 2016/679 si precisa che le informazioni contenute in questo messaggio sono riservate e ad uso esclusivo del destinatario. Qualora il messaggio in parola Le fosse pervenuto per errore, La preghiamo di eliminarlo senza copiarlo e di non inoltrarlo a terzi, dandocene gentilmente comunicazione. Grazie.
	</p>
</div>

</body>
</html>";

$body1 .= "<div style=\"position:relative;left:0px;z-index:20;margin:20px 0px 0px 0px\">CONTENUTO_DA_SOSTITUIRE</div>
 
</body>
</html>";
?>
