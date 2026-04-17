<?php 
$table="iscrizioni_scuola";
$rif="";

if(isset($_GET['nome_ric'])) $nome_ric=$_GET['nome_ric']; else $nome_ric='';
if(isset($_GET['cognome_ric'])) $cognome_ric=$_GET['cognome_ric']; else $cognome_ric='';
if(isset($_GET['tessera_ric'])) $tessera_ric=$_GET['tessera_ric']; else $tessera_ric='';
if(isset($_GET['email_ric'])) $email_ric=$_GET['email_ric']; else $email_ric='';
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['prov'])) $prov=$_GET['prov']; else $prov='';

if($nome_ric!="") { $rif.="&nome_ric=$nome_ric"; }
if($cognome_ric) { $rif.="&cognome_ric=$cognome_ric"; }
if($email_ric!="") { $rif.="&email_ric=$email_ric"; }
if($tessera_ric!="") { $rif.="&tessera_ric=$tessera_ric"; }
$rif.="&pag_att=$pag_att";

/*if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	echo $query_canc_img;
	$open_connection->connection->query($query_canc_img);
}*/

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_nome = $arr_rec['nome'];
$n_cognome = $arr_rec['cognome'];
//$n_tessera = $arr_rec['num_tessera'];
$n_email = $arr_rec['email'];
//$n_password = $arr_rec['password'];

?>
<script language="javascript">
	function annulla(){
		<?php if($prov!=""){?>
			window.location='admin.php?cmd=<?php echo $prov;?><?php echo $rif;?>';
		<?php }else{?>
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		<?php }?>
	}
</script>

<script language="javascript">
	/*function controllaPIVA( piva )
	{
		if ( piva.length == 11 )
		{
			var codiceUFFICIOiva = parseInt( piva.substr( 0, 3 ) ) ;
			if ( codiceUFFICIOiva <= 0 || codiceUFFICIOiva > 121 ) return false ;
		
			var X = 0 ;
			var Y = 0 ;
			var Z = 0 ;
		
			// cifre posto dispari ... ma per un array indicizzato a zero, la prima cifra ha indice zero ... appunto !
			X += parseInt( piva.charAt(0) ) ;
			X += parseInt( piva.charAt(2) ) ;
			X += parseInt( piva.charAt(4) ) ;
			X += parseInt( piva.charAt(6) ) ;
			X += parseInt( piva.charAt(8) ) ;

			// cifre posto pari ... ma per un array indicizzato a zero, la prima cifra ha indice uno ...
			Y += 2 * parseInt( piva.charAt(1) ) ;    if ( parseInt( piva.charAt(1) ) >= 5 ) Z++ ;
			Y += 2 * parseInt( piva.charAt(3) ) ;    if ( parseInt( piva.charAt(3) ) >= 5 ) Z++ ;
			Y += 2 * parseInt( piva.charAt(5) ) ;    if ( parseInt( piva.charAt(5) ) >= 5 ) Z++ ;
			Y += 2 * parseInt( piva.charAt(7) ) ;    if ( parseInt( piva.charAt(7) ) >= 5 ) Z++ ;
			Y += 2 * parseInt( piva.charAt(9) ) ;    if ( parseInt( piva.charAt(9) ) >= 5 ) Z++ ;
			
			var T = ( X + Y + Z ) % 10 ;

			var C = ( 10 - T ) % 10 ;

			return ( piva.charAt( piva.length - 1 ) == C ) ? true : false ;
		}
		else return false ;
	}*/
	
	Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
	/*Filtro_piva = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;*/
	function verifica(){
		if (document.inserimento.nome.value=="") alert('Nome obbigatorio');
		else if (document.inserimento.cognome.value=="") alert('Cogome obbigatorio');
		/*else if (document.inserimento.email.value=="") alert('Email obbigatoria');	
		else if (Filtro.test(document.inserimento.email.value)==false) alert("Inserire un indirizzo email corretto");*/
		else if (document.inserimento.num_tessera.value=="") alert('Tessera Socio n. obbigatorio');
		else document.inserimento.submit();
	}
</script>
<?php 
if($stato=="inviato")
{
	$arr_no['stato']=1;
	
	$_POST['nome']=str_replace('"',"''",$_POST['nome']);
	$_POST['cognome']=str_replace('"',"''",$_POST['cognome']);
	
	$oggetto_admin->modifica_campi("$table" ,$id_rec , $arr_no ,  $arr_thumb="no" );
?>
	<script language="javascript">
		<?php if($prov!=""){?>
			window.location='admin.php?cmd=<?php echo $prov;?><?php echo $rif;?>';
		<?php }else{?>
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		<?php }?>
	</script>	
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">
		<div style="float:left"><b>Dati Iscrizione</b></div>
		<!--<div style="float:right"><a href="admin.php?ric_stato=inviato&cmd=ordini&cognome_ric=<?php echo $n_cognome;?>&email_ric=<?php echo $n_email;?>" style="color:#333333"><b>Vedi Ordini</b></a></div>-->
		<div style="clear:both"></div>
	</div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=iscrizioni_scuola<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco degli iscriti</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
				<?php 
				$dati="";
				$query_dati="SELECT * FROM iscrizioni_scuola WHERE id='$id_rec'";
				$resu_dati=$open_connection->connection->query($query_dati);
				$risu_dati = $resu_dati->fetch();
				
				$nome_cliente = ucfirst($risu_dati['nome']);
				$cognome_cliente = ucfirst($risu_dati['cognome']);
				
				$dati.="
				<b>Dati Personali</b><br/>";
				if($risu_dati['dal'] &&$risu_dati['dal']!="") $dati .= "<b>Dal</b> : ".date_to_data($risu_dati['dal'])."<br>";
				if($risu_dati['al'] && $risu_dati['al']!="") $dati .= "<b>Al</b> : ".date_to_data($risu_dati['al'])."<br>";
				$dati.="
				<b>Nome</b> : ".$risu_dati['nome']."<br/>
				<b>Cognome</b> : ".$risu_dati['cognome']."<br/>
				<b>Indirizzo</b> : ".$risu_dati['indirizzo']."<br/>
				<b>Cap</b> : ".$risu_dati['cap']."<br/>
				<b>Citta</b> : ".$risu_dati['citta']."<br/>
				<b>Provincia</b> : ".$risu_dati['provincia']."<br/>
				<b>Nazione</b> : ".$risu_dati['nazione']."<br/>
				<b>Luogo di nascita</b> : ".$risu_dati['luogo_nascita']."<br/>
				<b>Nazione di nascita</b> : ".$risu_dati['nazione_nascita']."<br/>
				<b>Data di nascita</b> : ".$risu_dati['data_nascita']."<br/>
				<b>Codice fiscale</b> : ".$risu_dati['codice_fiscale']."<br/>
				<b>Tessera Fiv</b> : ".$risu_dati['tesseramento']."<br/>
				<b>Gi&agrave; tesserato</b> : ".$risu_dati['gia_tesserato']."<br/>
				";
				if($risu_dati['circolo'] && $risu_dati['circolo']!="") $dati .= "<b>Tesserato con il circolo</b> : ".$risu_dati['circolo']."<br>";
				if($risu_dati['tipo'] && $risu_dati['tipo']!=""){
					$dati .= "<b>Tipologia del corso</b> : ".$risu_dati['tipo']."<br>";
					$dati .= "<b>Durata</b> : ".$risu_dati['durata'];
					if($risu_dati['durata']=="" || $risu_dati['durata']=="Prima settimana" || $risu_dati['durata']=="First week") $dati .= " (".$risu_dati['costo_prima_sett']."  &euro;)";
					if($risu_dati['durata']=="Solo mezza settimana" || $risu_dati['durata']=="Only half a week") $dati .= " (".$risu_dati['costo_mezza_settimana']."  &euro;)";
					$dati .= "<br>";
					if($risu_dati['mezza_settimana_val'] && $risu_dati['mezza_settimana_val']!="") $dati .= "<b>Mezza Settimana</b> : ".$risu_dati['mezza_settimana_val']." (".$risu_dati['costo_mezza_settimana']." &euro;)<br>";
					if($risu_dati['num_settimane']>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$risu_dati['num_settimane']." (".$risu_dati['costo_settimane_in_piu']." &euro; a settimana)<br>";
					if($risu_dati['num_giorni']>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$risu_dati['num_giorni']." (".$risu_dati['costo_giorni_in_piu']." &euro; al giorno)<br>";
					if($risu_dati['num_settimane_2']>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$risu_dati['num_settimane_2']." (".$risu_dati['costo_settimane_in_piu']." &euro; a settimana)<br>";
					if($risu_dati['num_giorni_2']>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$risu_dati['num_giorni_2']." (".$risu_dati['costo_giorni_in_piu']." &euro; al giorno)<br>";
				}
				if(isset($risu_dati['extraJ24']) && $risu_dati['extraJ24']=="1" && $risu_dati['num_extra']>0){
					$dati .= "<b>N. settimane con extra per intergrazione corso full time</b> : ".$risu_dati['num_extra']." (".$risu_dati['costo_extra']." &euro; a settimana)<br/>";
				}
				if($risu_dati['CI'] && $risu_dati['CI']!="") $dati .= "<b>Carta d'identità: </b> : ".$risu_dati['CI']."<br/>";
				if($risu_dati['CF'] && $risu_dati['CF']!="") $dati .= "<b>Codice Fiscale: </b> : ".$risu_dati['CF']."<br/>";
				if(isset($risu_dati['CM']) && $risu_dati['CM']!="") $dati .= "<b>Certificato medico: </b> : ".$risu_dati['CM']."<br/>";
						
				$x=1;
				$query_dati2="SELECT * FROM iscrizioni_scuola WHERE id_rife='$id_rec'";
				$resu_dati2=$open_connection->connection->query($query_dati2);
				while($risu_dati2 = $resu_dati2->fetch()){
					
					$dati.="
					<br/><br/>
					<b>Dati Familiare Aggiuntivo $x</b><br/>";
					if($risu_dati2['dal'] &&$risu_dati2['dal']!="") $dati .= "<b>Dal</b> : ".date_to_data($risu_dati2['dal'])."<br>";
					if($risu_dati2['al'] && $risu_dati2['al']!="") $dati .= "<b>Al</b> : ".date_to_data($risu_dati2['al'])."<br>";
					$dati.="
					<b>Nome</b> : ".$risu_dati2['nome']."<br/>
					<b>Cognome</b> : ".$risu_dati2['cognome']."<br/>
					<b>Indirizzo</b> : ".$risu_dati2['indirizzo']."<br/>
					<b>Cap</b> : ".$risu_dati2['cap']."<br/>
					<b>Citta</b> : ".$risu_dati2['citta']."<br/>
					<b>Provincia</b> : ".$risu_dati2['provincia']."<br/>
					<b>Nazione</b> : ".$risu_dati2['nazione']."<br/>
					<b>Luogo di nascita</b> : ".$risu_dati2['luogo_nascita']."<br/>
					<b>Nazione di nascita</b> : ".$risu_dati2['nazione_nascita']."<br/>
					<b>Data di nascita</b> : ".$risu_dati2['data_nascita']."<br/>
					<b>Codice fiscale</b> : ".$risu_dati2['codice_fiscale']."<br/>
					<b>Tessera Fiv</b> : ".$risu_dati2['tesseramento']."<br/>
					<b>Gi&agrave; tesserato</b> : ".$risu_dati2['gia_tesserato']."<br/>
					";
					if($risu_dati2['circolo'] && $risu_dati2['circolo']!="") $dati .= "<b>Tesserato con il circolo</b> : ".$risu_dati2['circolo']."<br>";
					if($risu_dati2['tipo'] && $risu_dati2['tipo']!=""){
						$dati .= "<b>Tipologia del corso</b> : ".$risu_dati2['tipo']."<br>";
						$dati .= "<b>Durata</b> : ".$risu_dati2['durata'];
						if($risu_dati2['durata']=="" || $risu_dati2['durata']=="Prima settimana" || $risu_dati2['durata']=="First week") $dati .= " (".$risu_dati2['costo_prima_sett']."  &euro;)";
						if($risu_dati2['durata']=="Solo mezza settimana" || $risu_dati2['durata']=="Only half a week") $dati .= " (".$risu_dati2['costo_mezza_settimana']."  &euro;)";
						$dati .= "<br>";
						if($risu_dati2['mezza_settimana_val'] && $risu_dati2['mezza_settimana_val']!="") $dati .= "<b>Mezza Settimana</b> : ".$risu_dati2['mezza_settimana_val']." (".$risu_dati2['costo_mezza_settimana']." &euro;)<br>";
						if($risu_dati2['num_settimane']>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$risu_dati2['num_settimane']." (".$risu_dati2['costo_settimane_in_piu']." &euro; a settimana)<br>";
						if($risu_dati2['num_giorni']>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$risu_dati2['num_giorni']." (".$risu_dati2['costo_giorni_in_piu']." &euro; a settimana)<br>";
						if($risu_dati2['num_settimane_2']>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$risu_dati2['num_settimane_2']." (".$risu_dati2['costo_settimane_in_piu']." &euro; a settimana)<br>";
						if($risu_dati2['num_giorni_2']>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$risu_dati2['num_giorni_2']." (".$risu_dati2['costo_giorni_in_piu']." &euro; al giorno)<br>";
					}
					if(isset($risu_dati2['extraJ24']) && $risu_dati2['extraJ24']=="1" && $risu_dati2['num_extra']>0){
						$dati .= "<b>N. settimane con extra per intergrazione corso full time</b> : ".$risu_dati2['num_extra']." (".$risu_dati2['costo_extra']." &euro; a settimana)<br/>";
					}
					if($risu_dati2['CI'] && $risu_dati2['CI']!="") $dati .= "<b>Carta d'identità: </b> : ".$risu_dati2['CI']."<br/>";
					if($risu_dati2['CF'] && $risu_dati2['CF']!="") $dati .= "<b>Codice Fiscale: </b> : ".$risu_dati2['CF']."<br/>";
					if(isset($risu_dati2['CM']) && $risu_dati2['CM']!="") $dati .= "<b>Certificato medico: </b> : ".$risu_dati2['CM']."<br/>";
					
					$x++;
				}
				
				$dati .= "
				<br/><br/>
				<b>Cell</b> : ".$risu_dati['prefix_telefono1']." ".$risu_dati['telefono1']."<br/>
				<b>Tel 2</b> : ".$risu_dati['prefix_telefono2']." ".$risu_dati['telefono2']."<br/>
				<b>Fax</b> : ".$risu_dati['prefix_fax']." ".$risu_dati['fax']."<br/>
				<b>Email</b> : ".$risu_dati['email']."<br/>
				<b>Servizio di transfer</b> : ".$risu_dati['transfer']."<br/>";
				if($risu_dati['transfer']=="si" && $risu_dati['indirizzo_transfer'] && $risu_dati['indirizzo_transfer']!="") $dati .= "<b>Indirizzo transfer</b> : ".$risu_dati['indirizzo_transfer']."<br/>";
				if($risu_dati['sconto']>0) $dati .= "<b>Sconto applicato</b> : ".$risu_dati['sconto']." &euro;<br/>";
				$dati .= "<b>Totale dovuto</b> : ".$risu_dati['totale']." &euro;<br/>
				<b>Metodo Pagamento</b> : ".$risu_dati['pagamento']."<br/>";
				if($risu_dati['pagamento']=="Addebito" && $risu_dati['nome_socio_pagamento'] && $risu_dati['nome_socio_pagamento']!="" && $risu_dati['cognome_socio_pagamento'] && $risu_dati['cognome_socio_pagamento']!="") $dati .= "<b>Addebito sul conto del socio YCCS</b> : ".$risu_dati['nome_socio_pagamento']." ".$risu_dati['cognome_socio_pagamento']."<br/>";
				if($risu_dati['pagamento']=="Bonifico") $dati .= "<b>Coordinate bancarie per il pagamento con bonifico</b>:<br>IBAN: IT33F0306984902100000000071<br>BIC/SWIFT: BCITITMM<br>";
				$dati .= "<b>Note</b> : ".$risu_dati['note']."<br/>	<br>";
				
				echo $dati;
				
				/*$x=1;
				foreach ($arr_rec as $key => $value) {
					//$value = urlencode(stripslashes($value));
					if($x==2){						
						if($key!="id" && $key!="codice" && $key!="id_utente"){
							if($key=="CI" || $key=="CF"){
								echo "<b>".ucfirst(str_replace("_"," ",$key))."</b>: <a style='color:#000' href='../download2.php?path=resarea/files/iscrizioni/<?php echo $id_rec;?>/&file=".$value."'>".$value."</a><br/>";
							}else{
								echo "<b>".ucfirst(str_replace("_"," ",$key))."</b>: ".$value."<br/>";
							}
						}
						//$oggetto_admin->campo_mod(ucfirst(str_replace("_"," ",$key)) , "$key" , "$value"  , "1", 'no', "$cmd", "$id_rec");
					}
					$x++;
					if($x==3) $x=1;
				}*/			
				?>
				</div>			
				
				<br/><br/>
				
			</div>
			<div class="mws-button-row">
				<input type="button" value="Torna Indietro" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
