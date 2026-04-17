<?php 
$table="iscrizioni_scuola";
$file="link_comunicati";
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

$oggetto_frame = new Functions_adm($array_sito);

$rec_pag=20;

if(isset($_GET['id_doc'])) $id_doc=$_GET['id_doc']; else $id_doc="";
if(isset($_GET['tipo'])) $tipo=$_GET['tipo']; else $tipo="";
if(isset($_GET['campocanc'])) $campocanc=$_GET['campocanc']; else $campocanc="";

if(isset($_GET['nome_ric'])) $nome_ric=$_GET['nome_ric']; else $nome_ric="";
if(isset($_GET['cognome_ric'])) $cognome_ric=$_GET['cognome_ric']; else $cognome_ric="";
if(isset($_GET['codice_fiscale_ric'])) $codice_fiscale_ric=$_GET['codice_fiscale_ric']; else $codice_fiscale_ric="";
if(isset($_GET['email_ric'])) $email_ric=$_GET['email_ric']; else $email_ric="";
$rif = "";
if($nome_ric!="") { $rif.="&nome_ric=$nome_ric"; }
if($cognome_ric) { $rif.="&cognome_ric=$cognome_ric"; }
if($codice_fiscale_ric) { $rif.="&codice_fiscale_ric=$codice_fiscale_ric"; }
if($email_ric!="") { $rif.="&email_ric=$email_ric"; }

if($campocanc!=""){
	$query_up="UPDATE $table SET $campocanc = NULL WHERE id='$id_doc'";
	$risu_up=$open_connection->connection->query($query_up);
	
	if($campocanc=="data_pagamento"){
		$query_up="UPDATE $table SET status = NULL WHERE id='$id_doc'";
		$risu_up=$open_connection->connection->query($query_up);
	}
	?>
	<script language="javascript">
		window.location = "<?php echo str_replace("&campocanc=$campocanc","",$_SERVER['REQUEST_URI']);?>" ;
	</script>
	<?php 
}
				
if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";

$oggetto_admin = new Functions_adm($array_sito);

if($stato=="inviato"){
	$arr_no['stato']=1;
	$path ="../files/iscrizioni/$id_doc";
	if(!is_dir ($path)) {
		mkdir($path);
	}
	$oggetto_admin->modifica_campi ("$table" ,$id_doc , $arr_no, "", "$path" ,"$path");
	?>
	<script language="javascript">
		parent.location.reload();
	</script>
	<?php 
}

if($stato=="inviato_pagamento"){
	$arr_no['stato']=1;
	$_POST['status']="pagato";
	$_POST['data_pagamento'] = date_to_data ($_POST['data_pagamento']);
	$oggetto_admin->modifica_campi ("$table" ,$id_doc , $arr_no);
	?>
	<script language="javascript">
		parent.location.reload();
	</script>
	<?php 
}

if($stato=="inviato_link"){
	$query="SELECT nome, cognome, codice FROM iscrizioni_scuola WHERE id='$id_doc'";	
	$resu=$open_connection->connection->query($query);
	list($nome, $cognome,$codice)=$resu->fetch();
	$nome_cliente = $nome." ".$cognome;
	
	if(isset($_POST['email'])) $email_invio=$_POST['email']; else $email_invio="";
	
	$link_pagamento="$http://$ind_sito/yccs-sailing-school-conferma-iscrizione_".$codice.".html";
	include("../../fissi/mail_link_pagamento_sailing_school.inc.php");	
	?>
	<script>
		window.location='<?php echo $http;?>://<?php echo $ind_sito;?>/mail_link_pagamento_sailing_school.php?email_invio=<?php echo $email_invio;?>&codice=<?php echo $codice;?>&id_doc=<?php echo $id_doc;?>&nome=<?php echo $nome;?>&cognome=<?php echo $cognome;?><?php echo $rif;?>';
		alert("Email inviata");
		parent.location.reload();
	</script>
	<?php 
}

if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<title><?php  echo strtoupper($nome_del_sito);?> - admin</title>

<base href="<?php echo $http;?>://<?php  echo $ind_sito ?>/resarea/" /> 
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<link rel="icon" href="../img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon"/>

<script src="js/jquery.js"></script>

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="custom-plugins/wizard/wizard.css" media="screen">

<link rel="stylesheet" type="text/css" href="plugins/cleditor/jquery.cleditor.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol32.css" media="screen">

<link rel="stylesheet" type="text/css" href="css/login.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/themer.css" media="screen">

<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<script src="ckeditor/ckeditor.js"></script>

</head>

<body style="background:#fff">
	<?php if($tipo=="CI"){
		$query="SELECT CI FROM iscrizioni_scuola WHERE id='$id_doc'";	
		$resu=$open_connection->connection->query($query);
		list($n_CI)=$resu->fetch();
		?>
		<div class="mws-panel grid_8">
			<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Carta d'identità</b></div>
			
			<div id="inserisci">
				<div class="mws-panel-header">
					<span>Inserisci Carta d'identità</span>
				</div>
				<div class="mws-panel-body no-padding" style="margin-top:40px">
					<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
						<input type="hidden" name="stato" value="inviato"/>
						<div class="mws-form-inline">
							
								<div class="mws-form-row">
									<label class="mws-form-label">Carta d'identità</label>
									<div class="mws-form-item">
										<?php if($n_CI!=""){?>
											<a style="color:#000" href="../download2.php?path=resarea/files/iscrizioni/<?php echo $id_doc;?>/&file=<?php echo $n_CI;?>" target="_blank" class="$stile">Documento attuale : <b><?php echo $n_CI;?></b></a>
											&nbsp;&nbsp;<a style="color:#000" href="<?php echo $_SERVER['REQUEST_URI'];?>&campocanc=CI" class="testo10" ><i class="fa fa-trash" aria-hidden="true"></i></a>
										<?php }?>
										<br>
										<input name="CI" type="file" class="medium" size="60">
									</div>
								</div>
								
							<div class="mws-button-row" id="bott">
								<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
								<input type="button" value="Annulla" class="btn" onclick="parent.document.getElementById('box_doc').style.display='none';">
							</div>
						</div>
					</form>
				</div>
				
				<script language="javascript">
					function verifica(){
						if (document.invia_comm.CI.value=="") alert('Carta d\'identità obbigatoria');
						else document.invia_comm.submit();
					}
				</script>
			</div>
		</div>
	<?php } elseif($tipo=="CF"){
		$query="SELECT CF FROM iscrizioni_scuola WHERE id='$id_doc'";	
		$resu=$open_connection->connection->query($query);
		list($n_CF)=$resu->fetch();
		?>
		<div class="mws-panel grid_8">
			<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Codice Fiscale</b></div>
			
			<div id="inserisci">
				<div class="mws-panel-header">
					<span>Inserisci Codice Fiscale</span>
				</div>
				<div class="mws-panel-body no-padding" style="margin-top:40px">
					<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
						<input type="hidden" name="stato" value="inviato"/>
						<div class="mws-form-inline">
							
								<div class="mws-form-row">
									<label class="mws-form-label">Codice Fiscale</label>
									<div class="mws-form-item">
										<?php if($n_CF!=""){?>
											<a style="color:#000" href="../download2.php?path=resarea/files/iscrizioni/<?php echo $id_doc;?>/&file=<?php echo $n_CF;?>" target="_blank" class="$stile">Documento attuale : <b><?php echo $n_CF;?></b></a>
											&nbsp;&nbsp;<a style="color:#000" href="<?php echo $_SERVER['REQUEST_URI'];?>&campocanc=CF" class="testo10" ><i class="fa fa-trash" aria-hidden="true"></i></a>
										<?php }?>
										<br>
										<input name="CF" type="file" class="medium" size="60">
									</div>
								</div>
								
							<div class="mws-button-row" id="bott">
								<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
								<input type="button" value="Annulla" class="btn" onclick="parent.document.getElementById('box_doc').style.display='none';">
							</div>
						</div>
					</form>
				</div>
				
				<script language="javascript">
					function verifica(){
						if (document.invia_comm.CF.value=="") alert('Codice Fiscale obbigatoria');
						else document.invia_comm.submit();
					}
				</script>
			</div>
		</div>
	<?php } elseif($tipo=="CM"){
		$query="SELECT CM FROM iscrizioni_scuola WHERE id='$id_doc'";	
		$resu=$open_connection->connection->query($query);
		list($n_CM)=$resu->fetch();
		?>
		<div class="mws-panel grid_8">
			<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Certificato medico</b></div>
			
			<div id="inserisci">
				<div class="mws-panel-header">
					<span>Inserisci Certificato medico</span>
				</div>
				<div class="mws-panel-body no-padding" style="margin-top:40px">
					<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
						<input type="hidden" name="stato" value="inviato"/>
						<div class="mws-form-inline">
							
								<div class="mws-form-row">
									<label class="mws-form-label">Certificato medico</label>
									<div class="mws-form-item">
										<?php if($n_CM!=""){?>
											<a style="color:#000" href="../download2.php?path=resarea/files/iscrizioni/<?php echo $id_doc;?>/&file=<?php echo $n_CM;?>" target="_blank" class="$stile">Documento attuale : <b><?php echo $n_CM;?></b></a>
											&nbsp;&nbsp;<a style="color:#000" href="<?php echo $_SERVER['REQUEST_URI'];?>&campocanc=CM" class="testo10" ><i class="fa fa-trash" aria-hidden="true"></i></a>
										<?php }?>
										<br>
										<input name="CM" type="file" class="medium" size="60">
									</div>
								</div>
								
							<div class="mws-button-row" id="bott">
								<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
								<input type="button" value="Annulla" class="btn" onclick="parent.document.getElementById('box_doc').style.display='none';">
							</div>
						</div>
					</form>
				</div>
				
				<script language="javascript">
					function verifica(){
						if (document.invia_comm.CM.value=="") alert('Certificato medico obbligatorio');
						else document.invia_comm.submit();
					}
				</script>
			</div>
		</div>
	<?php } elseif($tipo=="pagamento"){
		if(isset($_GET['metodo'])) $metodo=$_GET['metodo']; else $metodo="";
		if($metodo!=""){
			$query_up="UPDATE iscrizioni_scuola SET pagamento='$metodo' WHERE id='$id_doc'";
			$risu_up=$open_connection->connection->query($query_up);?>
			<script>
				window.location="<?php echo $http;?>://<?php echo $ind_sito;?>/resarea/frame/iscrizioni_scuola_doc.php?tipo=pagamento&id_doc=<?php echo $id_doc;?>";
			</script>
		<?php }
		
		$query="SELECT status, pagamento, nome_socio_pagamento, cognome_socio_pagamento, data_pagamento FROM iscrizioni_scuola WHERE id='$id_doc'";	
		$resu=$open_connection->connection->query($query);
		list($status,$pagamento, $nome_socio_pagamento, $cognome_socio_pagamento, $data_pagamento)=$resu->fetch();
		
		?>	
		<div class="mws-panel grid_8">
			<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Pagamento</b></div>
			
			<div id="inserisci">
				<div class="mws-panel-header">
					<span>Stato Pagamento</span>
				</div>
				<div class="mws-panel-body no-padding" style="margin-top:40px">
					<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
						<input type="hidden" name="stato" value="inviato_pagamento"/>
						<div class="mws-form-inline">
								
								<div class="mws-form-row">
									<div style="float:left"><b>Metodo di Pagamento</b>:</div> 
									<div style="float:left; margin-left:5px; cursor:pointer;" id="selectClose" onclick="this.style.display='none'; document.getElementById('selectOpen').style.display='block';"><?php echo $pagamento;?>&nbsp;&nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></div> 
									<div style="float:left; margin-left:5px; display:none;" id="selectOpen">
										<select onchange="window.location='<?php echo $_SERVER['REQUEST_URI'];?>&metodo='+this.value">
											<option value="Paypal" <?php if($pagamento=="Paypal"){?>selected="selected"<?php }?>>Paypal</option>
											<option value="Carta di Credito Presso la Scuola Vela"<?php if($pagamento=="Carta di Credito Presso la Scuola Vela"){?>selected="selected"<?php }?>>Carta di Credito Presso la Scuola Vela</option>
											<option value="Bonifico"<?php if($pagamento=="Bonifico"){?>selected="selected"<?php }?>>Bonifico</option>
											<option value="Contanti"<?php if($pagamento=="Contanti"){?>selected="selected"<?php }?>>Contanti</option>
											<option value="Addebito"<?php if($pagamento=="Addebito"){?>selected="selected"<?php }?>>Addebito sul conto di un Socio YCCS</option>
										</select>
										&nbsp;&nbsp;
										<i class="fa fa-times-circle" aria-hidden="true" style="cursor:pointer;" onclick="document.getElementById('selectOpen').style.display='none'; document.getElementById('selectClose').style.display='block';"></i>
									</div>
									<div style="clear:both; height:20px;"></div>
									<?php if($pagamento=="Addebito"){?>
										<b>Addebitato sul conto del Socio YCCS</b>: <?php echo $nome_socio_pagamento;?> <?php echo $cognome_socio_pagamento;?><br/>
									<?php }?>
									<b>Stato</b>: <?php if($status=="pagato") echo "<span style='color:green'>Pagato</span>"; else echo "<span style='color:red'>Non Pagato</span>"?><br/>
								</div>
								
								<div class="mws-form-row">
									<label class="mws-form-label">Data Pagamento</label>
									<div class="mws-form-item">										
										<input type="text" name="data_pagamento" class="mws-datepicker large"  value="<?php if($data_pagamento) echo date_to_data(substr($data_pagamento,0,10));?>" readonly="readonly" style="width:20%">
										<?php if($data_pagamento){?>
											&nbsp;&nbsp;<a style="color:#000" href="<?php echo $_SERVER['REQUEST_URI'];?>&campocanc=data_pagamento" class="testo10" ><i class="fa fa-trash" aria-hidden="true"></i></a>
										<?php }?>
									</div>
								</div>
								
							<div class="mws-button-row" id="bott">
								<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
								<input type="button" value="Annulla" class="btn" onclick="parent.document.getElementById('box_doc').style.display='none';">
							</div>
						</div>
					</form>
				</div>
				
				<script language="javascript">
					function verifica(){
						if (document.invia_comm.data_pagamento.value=="") alert('Data Pagamento obbigatoria');
						else document.invia_comm.submit();
					}
				</script>
			</div>
		</div>		
	<?php } elseif($tipo=="invio_pagamento") {
		$query="SELECT nome, cognome, dal, al , email, codice, status  FROM iscrizioni_scuola WHERE id='$id_doc'";	
		$resu=$open_connection->connection->query($query);
		list($nome, $cognome, $dal, $al, $email, $codice, $status)=$resu->fetch();
		
		$link_pagamento="$http://$ind_sito/yccs-sailing-school-conferma-iscrizione_".$codice.".html";
		?>
		<div class="mws-panel grid_8">
			<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Invio Link Pagamento</b></div>
			
			<div id="inserisci">
				<div class="mws-panel-header">
					<span></span>
				</div>
				<?php if($status!="pagato"){?>
					<div class="mws-panel-body no-padding" style="margin-top:40px">
						<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
							<input type="hidden" name="stato" value="inviato_link"/>
							<div class="mws-form-inline">
									
									<div class="mws-form-row">
										<div style="margin-bottom:15px; position:relative;">
											<b>Link Pagamento</b>: <?php echo $link_pagamento;?>
											&nbsp;&nbsp;
											<i class="fa fa-clipboard" aria-hidden="true" style="cursor:pointer;" onclick="copyLink();"></i>
											&nbsp;&nbsp;
											<a href="<?php echo $link_pagamento;?>" target="_blank" style="color:#333"><i class="fa fa-external-link" aria-hidden="true"></i></a><br/>		
											<div style="position:absolute; top:0; left:0;">
												<input type="text" name="" style="opacity:0;" value="<?php echo $link_pagamento;?>"  id="link"/>
											</div>
										</div>
										<div style="margin-bottom:15px;">
											<b>Email</b>: <input type="text" name="email" value="<?php echo $email;?>"/>
										</div>
										Inviare il link per procedere al pagamento su Paypal dell'iscrizione di <b><?php echo $nome;?> <?php echo $cognome;?></b> <?php if($dal && trim($dal)!=""){?>dal <b><?php echo date_to_data($dal);}?></b>	<?php if($al && trim($al)!=""){?>fino al <b><?php echo date_to_data($al);}?></b> all'indirizzo email indicato?
									</div>
									
								<div class="mws-button-row" id="bott">
									<input type="button" value="Invia" class="btn btn-danger" onclick="verifica()">
									<input type="button" value="Annulla" class="btn" onclick="parent.document.getElementById('box_doc').style.display='none';">
								</div>
							</div>
						</form>
					</div>
					
					<script language="javascript">
						Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
						function verifica(){
							if (document.invia_comm.email.value=="") alert('Data Pagamento obbigatoria');
							else if (Filtro.test(document.invia_comm.email.value)==false) alert('Inserisci un indirizzo e-mail corretto');
							else document.invia_comm.submit();
						}
						
						function copyLink() {
						  /* Get the text field */
						  var copyText = document.getElementById("link");

						  /* Select the text field */
						  copyText.select();

						  /* Copy the text inside the text field */
						  document.execCommand("copy");

						  /* Alert the copied text */
						  alert("Link copiato negli appunti");
						}
					</script>
				<?php }else{?>
					<div class="mws-panel-body no-padding" style="padding:40px; text-align:center;">
						<div class="mws-form-inline">									
							<div class="mws-form-row">
								Il pagamento risulta già effettuato
							</div>
						</div>
					</div>
				<?php }?>
			</div>
		</div>		
	<?php }?>
 
		
	<!-- JavaScript Plugins -->
    <script src="js/libs/jquery-1.8.3.min.js"></script>
	
    <script src="js/libs/jquery.mousewheel.min.js"></script>
    <script src="js/libs/jquery.placeholder.min.js"></script>
    <script src="custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="jui/jquery-ui.custom.min.js"></script>
    <script src="jui/js/jquery.ui.touch-punch.js"></script>
	<script src="jui/js/jquery-ui-effects.min.js"></script>
	

	<script src="plugins/datatables/jquery.dataTables.js"></script>
	
    <script src="plugins/colorpicker/colorpicker-min.js"></script>
	<script src="plugins/validate/jquery.validate-min.js"></script>
	
    <!-- Core Script -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="js/core/themer.js"></script>
	
	<script src="js/demo/demo.widget.js"></script>
	
	<?php if($tipo=="pagamento"){?>
		<script type="text/javascript">
			$.datepicker.setDefaults( $.datepicker.regional[ "it" ] );
			$( ".mws-datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
		</script>
	<?php }?>
	
	<?php  if ($cmd!="" && is_file("js/table/$cmd.table.php")) {include("js/table/$cmd.table.php"); }?>
	
    <!-- Login Script -->
    <script src="js/core/login.js"></script>
	
</body>
</html>
