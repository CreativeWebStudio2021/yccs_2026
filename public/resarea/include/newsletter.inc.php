<!--<script language="javascript">
function stampa_errori(id_news) {
	window.open('resarea/stampa_errori.inc.php?id_invio='+id_news,'miaFinestra','width=650,height=600,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
}
</script>-->
<?php 
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if($conferma)
{	
	if(!$id_canc) 
		$id_canc =  $_POST['conferma']; /* dal $.post di ajax */
		
	$query_canc = " delete from newsletter where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
?>
	<script language="javascript">
		window.alert('Il campo e\' stato cancellato con successo.');
		window.location="admin.php?cmd=newsletter<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

$errore_news = 0;

if(isset($_GET['id_test'])){
	$id_test = $_GET['id_test'];
}elseif(isset($_POST['id_test'])){
	$id_test = $_POST['id_test'];
}else $id_test = "";

if(isset($_GET['id_invio'])){
	$id_invio = $_GET['id_invio'];
}elseif(isset($_POST['id_invio'])){
	$id_invio = $_POST['id_invio'];
}else $id_invio = "";

if(isset($_GET['intestazioni'])){
	$intestazioni = $_GET['intestazioni'];
}elseif(isset($_POST['intestazioni'])){
	$intestazioni = $_POST['intestazioni'];
}else $intestazioni = "";

if($azione=="testa") {
	$query_news = "select * from newsletter where id='$id_test'";
	$risu_news = $open_connection->connection->query($query_news);
	$arr_news = $risu_news->fetch();
	$titolo_news = ucfirst($arr_news['oggetto']);
	$data_news = $oggetto_admin->date_to_data($arr_news['data_news']);
	$testo_news = ucfirst($arr_news['testo']);
	$email_news = $arr_news['email_test'];
	$testo_news = str_replace("''",'"',$testo_news); 
	
	$img_news = $arr_news['img'];
		
	if ($email_news=="") $email_news = $mail_sito;
	
	$intestazioni .= "From: $nome_del_sito <".$mail_sito.">\n";
	$intestazioni .= "MIME-Version: 1.0\n";
	$intestazioni .= "Content-type: text/html; \n charset=iso-8859-1\n";

	$sopra ="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
	<html>
	<head>
	<meta http-equiv=Content-Type content=\"text/html; charset=windows-1252\">
	<meta content=\"MSHTML 6.00.2730.1700\" name=GENERATOR>
	<style>
	body { 
		text-align: center;
		margin-left: 0px; 
		margin-top: 0px; 
		margin-bottom: 4px;
	}
		
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
	
	.rosso_grande{
			font-size: 12px; 
			font-family: tahoma; 
			font-weight: bold;   
			color: #ff0000; 
	}
	
	a.rosso{
			font-size: 12px; 
			font-family: tahoma; 
			font-weight: normal;   
			color: #ff0000; 
	}
	
	.titolo{
			color:#d03f3a;
			font-family:Tahoma;
			font-size:16px;
			font-weight:bold;
			text-decoration:none;
	}
	
	.footer{
			color:#707070;
			font-family:Tahoma;
			font-size:10px;
			font-weight:normal;
			text-decoration:none;
			line-height:12pt;
			letter-spacing:1px;
	}
	
	a.email{
			color:#26BAF8;
			font-family:Tahoma;
			font-size:10px;
			font-weight:normal;
			text-decoration:none;
			line-height:12pt;
			letter-spacing:1px;
	}
	
	</style>
	</head>
	<body>
	<div align=\"left\" style=\"padding-top:10px\"><a href=\"http://$ind_sito\"><img src=\"http://$ind_sito/asset/img/logo.jpg\" border=\"0\" alt=\"\"></a>"; 
	
	$sotto =
	"</div>
	<div align=\"left\" width=\"800px\" style=\"padding-top:30px;padding-left:10px\" valign=\"top\" class=\"testo11\">
		<br><br>					
		<div align=\"justify\">
		<p class=\"descr_catalogo\" style=\"border-top:1px solid #9e9f91;padding-top:20px;color:#9e9f91;font-size:11px\">
		Avviso di riservatezza - Il testo e gli eventuali documenti trasmessi contengono informazioni riservate al destinatario indicato. La seguente e-mail è confidenziale e la sua riservatezza è tutelata dal Dlgs 196/2003. La lettura, copia o altro uso non autorizzato o qualsiasi altra azione derivante dalla conoscenza di queste informazioni sono rigorosamente vietate. Qualora abbiate ricevuto questo documento per errore siete cortesemente pregati di darne immediata comunicazione al mittente, ai numeri qui indicati e/o all'indirizzo dello stesso e di provvedere immediatamente alla sua distruzione.
		</p>
		</div>
	</div>";
	
	$fine =
	"</body>
	</html>
	";
	
	$titolo_news = "<div width=\"800px\" align=\"left\" valign=\"top\" style=\"padding-top:10px\">
						<div align=\"left\">
							<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\">
							<tr>
								<td align=\"left\" style=\"padding-left:15px\" class=\"titolo\" valign=\"bottom\">$titolo_news</td>
							</tr>
							</table>
						</div>
					</div>";
			
	$testo_news = "<div width=\"800px\" align=\"left\" style=\"padding-top:5px;\" valign=\"top\">
						<div align=\"left\">
							<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\">
							<tr>
								<td align=\"left\" style=\"padding-left:15px;padding-right:10px\" valign=\"top\">$testo_news</td>
							</tr>
							</table>
						</div>
					</div>";
					
	$foto_news = "<div width=\"800px\" align=\"left\" style=\"padding-top:15px;padding-left:15px;\" valign=\"top\">
						<div align=\"left\">
							<img src=\"http://$ind_sito/resarea/img_up/$img_news\" border=\"0\" alt=\"\"/>
						</div>
					</div>";
		
	if ($img_news!="" && is_file("img_up/$img_news")) $testo_email = $sopra.$testo_news.$foto_news.$sotto.$fine;
		else $testo_email = $sopra.$testo_news.$sotto.$fine;
							
	/*Questa è la parte che invia la mail di test*/
	$risu_test = mail ($email_news,"Test Newsletter Sud Ingrosso Bomboniere",$testo_email,$intestazioni);
				
	if ($risu_test) {
		/* Questa è la parte che imposta il valore del campo testata a 1 */
		$query_finale = "update newsletter set testata='1' where id='$id_test'"; 
		$risu_finale = $open_connection->connection->query($query_finale); 
	}

}


if($azione=="invia") {
	$query_news = "select * from newsletter where id='$id_invio'";
	$risu_news = $open_connection->connection->query($query_news);
	$arr_news = $risu_news->fetch();
	$id_news = $arr_news['id'];
	$titolo_news = ucfirst($arr_news['oggetto']);
	$data_news = $oggetto_admin->date_to_data($arr_news['data_news']);
	$testo_news = ucfirst($arr_news['testo']);
	$testo_news = str_replace("''",'"',$testo_news); 
	
	$img_news = $arr_news['img'];
		
	$intestazioni .= "From: $nome_del_sito <".$mail_sito.">\n";
	$intestazioni .= "Return-Path: <".$mail_sito.">\n";
	$intestazioni .= "MIME-Version: 1.0\n";
	$intestazioni .= "Content-type: text/html; \n charset=iso-8859-1\n";
	 
	$sopra ="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
	<html>
	<head>
	<meta http-equiv=Content-Type content=\"text/html; charset=windows-1252\">
	<meta content=\"MSHTML 6.00.2730.1700\" name=GENERATOR>
	<style>
	body { 
		text-align: center;
		margin-left: 0px; 
		margin-top: 0px; 
		margin-bottom: 4px;
	}
		
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
	
	.rosso_grande{
			font-size: 12px; 
			font-family: tahoma; 
			font-weight: bold;   
			color: #ff0000; 
	}
	
	a.rosso{
			font-size: 12px; 
			font-family: tahoma; 
			font-weight: normal;   
			color: #ff0000; 
	}
	
	.titolo{
			color:#d03f3a;
			font-family:Tahoma;
			font-size:16px;
			font-weight:bold;
			text-decoration:none;
	}
	
	.footer{
			color:#707070;
			font-family:Tahoma;
			font-size:10px;
			font-weight:normal;
			text-decoration:none;
			line-height:12pt;
			letter-spacing:1px;
	}
	
	a.email{
			color:#26BAF8;
			font-family:Tahoma;
			font-size:10px;
			font-weight:normal;
			text-decoration:none;
			line-height:12pt;
			letter-spacing:1px;
	}
	
	</style>
	</head>
	<body>
	<div align=\"left\" style=\"padding-top:10px\"><a href=\"http://$ind_sito\"><img src=\"http://$ind_sito/asset/img/logo.jpg\" border=\"0\" alt=\"\"></a>"; 
		
	$sotto =
	"</div>
	<div align=\"left\" width=\"750px\" style=\"padding-top:20px;padding-left:10px\" valign=\"top\" class=\"testo11\">
		<br><br>						
		<div align=\"justify\">
		<p class=\"descr_catalogo\" style=\"border-top:1px solid #9e9f91;padding-top:20px;color:#9e9f91;font-size:11px\">
		Avviso di riservatezza - Il testo e gli eventuali documenti trasmessi contengono informazioni riservate al destinatario indicato. La seguente e-mail è confidenziale e la sua riservatezza è tutelata dal Dlgs 196/2003. La lettura, copia o altro uso non autorizzato o qualsiasi altra azione derivante dalla conoscenza di queste informazioni sono rigorosamente vietate. Qualora abbiate ricevuto questo documento per errore siete cortesemente pregati di darne immediata comunicazione al mittente, ai numeri qui indicati e/o all'indirizzo dello stesso e di provvedere immediatamente alla sua distruzione.
		</p>
		</div>
	</div>";
	
	$fine =
	"</body>
	</html>
	";
	
	$titolo_news = "<div width=\"800px\" align=\"left\" valign=\"top\" style=\"padding-top:15px;\">
						<div align=\"left\">
							<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\">
							<tr>
								<td align=\"left\" style=\"padding-left:15px\" class=\"titolo\" valign=\"bottom\">$titolo_news</td>
							</tr>
							</table>
						</div>
					</div>";
					
	$testo_news = "<div width=\"800px\" align=\"left\" style=\"padding-top:15px;\" valign=\"top\">
						<div align=\"left\">
							<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\">
							<tr>
								<td align=\"left\" style=\"padding-left:15px;padding-right:10px\" valign=\"top\">$testo_news</td>
							</tr>
							</table>
						</div>
					</div>";
					
	$foto_news = "<div width=\"800px\" align=\"left\" style=\"padding-top:15px;padding-left:15px;\" valign=\"top\">
						<div align=\"left\">
							<img src=\"http://$ind_sito/resarea/img_up/$img_news\" border=\"0\" alt=\"\"/>
						</div>
					</div>";
					
	$lettura_sito = "<div width=\"800px\" align=\"left\" valign=\"top\" style=\"padding-left:160px\">
						<span class=\"testo11\" style=\"font-size:10px\" valign=\"bottom\">Se non visualizzi correttamente la Newsletter <a class=\"testo11\" style=\"font-size:10px;text-decoration:underline\" href=\"http://$ind_sito/newsletter/vedi.php?id_newsletter=$id_invio\">clicca qui</a></span>
					</div>";
										
	/* Seleziono gli utenti a cui voglio inviare la newsletter */
	$query_utenti = "select id,email from clienti where news='1' and selezionato='1'";
	$risu_utenti = $open_connection->connection->query($query_utenti);
	$num_utenti = $risu_utenti->rowCount();
		
	for($x=0; $x<$num_utenti;$x++){
		list($id_utente,$email_utente) = $risu_utenti->fetch();
						
		$cancellati = "<br/><br/><div align=\"center\" style=\"padding-left:15px;padding-right:15px;font-size:10px\" class=\"testo11\">Se non desideri ricevere più questa newsletter <a style=\"font-size:10px;text-decoration:underline\" href=\"http://$ind_sito/index.php?cmd=cancella_newsletter&id_utente=$id_utente\" class=\"testo11\">clicca qui</a><br/></div>";
				
		if ($img_news!="" && is_file("img_up/$img_news")) $testo_email = $sopra.$lettura_sito.$testo_news.$foto_news.$cancellati.$sotto.$fine;
		else $testo_email = $sopra.$lettura_sito.$testo_news.$cancellati.$sotto.$fine;
										
		/*Questa è la parte che invia la mail*/
		$risu_invio = mail ($email_utente,"Newsletter Sud Ingrosso Bomboniere",$testo_email,$intestazioni);
				
		if ($risu_invio) {
		
			/* Questa è la parte che imposta il valore del campo inviata a 1 */
			$query_fin = "update newsletter set inviata='1' where id='$id_invio'"; 
			$risu_fin = $open_connection->connection->query($query_fin);
									
		} else {
			$errore_news += 1;
		}
	}
	
	/* Questa è la parte che imposta il valore degli errori di invio */
	$query_errori = "update newsletter set errori='$errore_news' where id='$id_invio'"; 
	$risu_errori = $open_connection->connection->query($query_errori);
	
	if($errore_news!=0) { ?><script language="javascript">alert('Numero di mail non inviate : <?php  echo $errore_news; ?>!');</script><?php  } 
	else { ?><script language="javascript">alert('Email inviate correttamente a tutti gli utenti selezionati nella Mailing List.');</script><?php  }

}

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("newsletter", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("newsletter", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("newsletter", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("newsletter", "$id_canc");	
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/$img")) @unlink("img_up/$img");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location="admin.php?cmd=newsletter<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
		</script>
	<?php 	
}
?>
<script type="text/javascript">
	var lista_ind=new Array();
	var lista_del="";
	var lista_tutti="";
	function aggiungi_lista(id_check, id_campo){
		if(document.getElementById('check_'+id_check).checked){
			lista_del+=""+id_campo+";";
		} else {
			lista_del = lista_del.replace(id_campo+";", "");
		}
		if(lista_del!=""){
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=newsletter<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
		}
	}
	
	function aggiugni_tutti(){
		start = document.getElementById('start').innerHTML;
		end = document.getElementById('end').innerHTML;
		total = document.getElementById('total').innerHTML;
		
		if(document.getElementById('check_tutti').checked){
			ind_lista = 0;
			ind_check = 1;
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[ind_lista]+";";
				ind_lista++;
			}
			for(i=start; i<=end; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=true;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=newsletter<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			ind_check = 1;
			for(i=start; i<=total; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=false;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}
</script>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Newsletter</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="height:30px;width:100%;text-align:right"><a href="admin.php?cmd=newsletter_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" style="color:#7a7a7a"><b>Aggiungi newsletter</b></a> &nbsp; </div>
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco newsletter</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th>Data</th>
					<th>Titolo</th>
					<th>E-mail di test</th>
					<th>Elenco utenti</th>
					<th>Num. utenti</th>
					<!--<th>Non inviati</th>-->
					<th>Testata</th>
					<th>Inviata</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from newsletter order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM newsletter ORDER BY id desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$titolo = $oggetto_admin->puntini(ucfirst($arr_ele['oggetto']),80);
						$data = $oggetto_admin->date_to_data($arr_ele['data_news']);
						
						$email=$arr_ele['email_test'];
						if ($email=="") $email = $mail_sito;
												
						$testato=$arr_ele['testata'];
						$inviato=$arr_ele['inviata'];
						$errori=$arr_ele['errori'];
						
						$query_utenti_sel = "select * from clienti where selezionato='1' and news='1'";
						$risu_utenti_sel = $open_connection->connection->query($query_utenti_sel);
						$num_utenti_sel = $risu_utenti_sel->rowCount();
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>
					<td align="center" valign="center"><?php  echo $x+1; ?></td>
					<td><?php  echo $data; ?></td>
					<td><?php  echo $titolo; ?></td>
					<td><?php  echo $email; ?></td>
					<td style="text-align:center"><a style="color:#35353a" href="admin.php?cmd=rubrica"><u>Modifica</u></a></td>
					<td style="text-align:center"><?php  echo $num_utenti_sel; ?></td>
					<!--<td><?php  echo $errori; ?></td>-->
					<td style="text-align:center">
					<?php 
						if($testato==0) echo "<a href=\"admin.php?cmd=newsletter&id_test=$id_campo&azione=testa$rif&pag_att=$pag_att\"><img src=\"css/icons/icol32/accept_22_off.png\" alt=\"Testa\"/></a>";
							else echo "<a href=\"admin.php?cmd=newsletter&id_test=$id_campo&azione=testa$rif&pag_att=$pag_att\"><img src=\"css/icons/icol32/accept_22.png\" alt=\"Testa di nuovo\"/></a>";
					?>
					</td>
					<td style="text-align:center">
					<?php 
						if($inviato==0) echo "<a href=\"admin.php?cmd=newsletter&id_invio=$id_campo&azione=invia$rif&pag_att=$pag_att\"><img src=\"css/icons/icol32/accept_22_off.png\" alt=\"Invia\"/></a>";
							else echo "<a href=\"admin.php?cmd=newsletter&id_invio=$id_campo&azione=invia$rif&pag_att=$pag_att\"><img src=\"css/icons/icol32/accept_22.png\" alt=\"Invia di nuovo\"/></a>";
					?>
					</td>
					<td style="width:10%">
						<span class="btn-group">
							<!--<a href="admin.php?cmd=newsletter&id_canc=<?php  echo $id_campo; ?>&azione=primo" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=newsletter&id_canc=<?php  echo $id_campo; ?>&azione=sali" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=newsletter&id_canc=<?php  echo $id_campo; ?>&azione=scendi" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=newsletter&id_canc=<?php  echo $id_campo; ?>&azione=ultimo" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>-->
							<a href="admin.php?cmd=newsletter_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a href="admin.php?cmd=newsletter&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
					}
				} 
			?>
			</tbody>
		</table>
		<?php include("fissi/multipagina.inc.php");?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>