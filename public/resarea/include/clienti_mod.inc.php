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
$n_tessera = $arr_rec['num_tessera'];
$n_email = $arr_rec['email'];
$n_password = $arr_rec['password'];

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
		<div style="float:left"><b>Modifica dati Socio</b></div>
		<!--<div style="float:right"><a href="admin.php?ric_stato=inviato&cmd=ordini&cognome_ric=<?php echo $n_cognome;?>&email_ric=<?php echo $n_email;?>" style="color:#333333"><b>Vedi Ordini</b></a></div>-->
		<div style="clear:both"></div>
	</div>
	
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Nome *" , "nome" , "$n_nome"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Cognome *" , "cognome" , "$n_cognome"  , "1", 'no', "$cmd", "$id_rec");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Email *</label>
					<div class="mws-form-item">
						<input name="email" type="text" class="medium" value="<?php echo $n_email;?>" disabled="disabled" style="background:#e5e5e5">
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Tessera Socio n. *" , "num_tessera" , $n_tessera  , "2", 'no', $cmd, "$id_rec");
				/*$oggetto_admin->campo_mod("Password" , "password" , $n_password  , "2", 'no', $cmd, "$id_rec");*/
				?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica();">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
