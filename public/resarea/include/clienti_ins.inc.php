<?php 
$table="clienti";
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
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
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
		else if (document.inserimento.email.value=="") alert('Email obbigatoria');	
		else if (Filtro.test(document.inserimento.email.value)==false) alert("Inserire un indirizzo email corretto");
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
					
	$oggetto_admin->inserisci_campi ("$table" , $arr_no ,  $arr_thumb="no");
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci dati Socio</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=clienti<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco degli iscritti</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<?php 
			/*$ord_ev = $oggetto_admin->trova_ordine("$table");
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';*/
			echo '<input type="hidden" name="data_registrazione" value="'.$data_att.'">';	
			echo '<input type="hidden" name="approvato" value="1">';	
			echo '<input type="hidden" name="livello" value="Registered">';	
			?>
			<div class="mws-form-inline">
	<?php 
				$oggetto_admin->campo_ins("Nome *" , "nome" , "1", 'no');
				$oggetto_admin->campo_ins("Cognome *" , "cognome" , "1", 'no');
				$oggetto_admin->campo_ins("Email *" , "email" , "1", 'no');		
				$oggetto_admin->campo_ins("Tessera Socio n. *" , "num_tessera" , "2", 'no');
				$oggetto_admin->campo_ins("Password *" , "password" , "2", 'no');
	?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
		<!--<script type="text/javascript">
			function calcola_prezzo(){
				var pu = document.inserimento.prezzo_listino.value;
				var sc = document.inserimento.sconto.value;
				var ps = pu - (pu*(sc/100));
				document.inserimento.prezzo.value = ps;
			}	
		</script>-->	
	</div>
</div>
<?php 
}
?>
