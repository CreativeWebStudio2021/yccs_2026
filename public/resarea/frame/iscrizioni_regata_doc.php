<?php 
$table="edizioni_iscrizioni_regata";
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

if(isset($_GET['boat_name_ric'])) $boat_name_ric=$_GET['boat_name_ric']; else $boat_name_ric='';
if(isset($_GET['charterer_ric'])) $charterer_ric=$_GET['charterer_ric']; else $charterer_ric='';
if(isset($_GET['charterer_email_ric'])) $charterer_email_ric=$_GET['charterer_email_ric']; else $charterer_email_ric='';
$rif="";
if($boat_name_ric!="") {$rif.="&boat_name_ric=$boat_name_ric"; }
if($charterer_ric!="") {$rif.="&charterer_ric=$charterer_ric"; }
if($charterer_email_ric!="") {$rif.="&charterer_email_ric=$charterer_email_ric"; }

$query_r="SELECT id_edizione FROM $table WHERE id='$id_doc'";
$resu_r=$open_connection->connection->query($query_r);
list($id_edizione)=$resu_r->fetch();

$query_e="SELECT nome_regata, anno FROM edizioni_regate WHERE id='$id_edizione'";
$resu_e=$open_connection->connection->query($query_e);
list($nome_edizione, $anno_edizione)=$resu_e->fetch();

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

if($tipo=="visibile"){
	$query="SELECT visibile,stato_accettazione,status FROM $table WHERE id='$id_doc'";
	$resu = $open_connection->connection->query($query);
	list($visibile,$stato_accettazione,$status)=$resu->fetch();
	if($stato_accettazione=="1" && $status=="pagato"){
		if($visibile==0){
			$ord = $oggetto_admin->trova_ordine ("$table", "id_edizione", $id_edizione);
			$query_up="UPDATE $table SET visibile='1', ordine='$ord' WHERE id='$id_doc'";
			$risu_up = $open_connection->connection->query($query_up);
			?>
			<script>
			//	alert('<?php echo $query_up;?>');
				parent.document.getElementById('visibile_<?php echo $id_doc;?>').style.color='green';
				parent.document.getElementById('visibile_<?php echo $id_doc;?>').title='Visibile';
			</script>
			<?php 
		}else{
			$query_up="UPDATE $table SET visibile='0' WHERE id='$id_doc'";
			$risu_up=$open_connection->connection->query($query_up);
			?>
			<script>
			//	alert('<?php echo $query_up;?>');
				parent.document.getElementById('visibile_<?php echo $id_doc;?>').style.color='red';
				parent.document.getElementById('visibile_<?php echo $id_doc;?>').title='Non Visibile';
			</script>
			<?php 
		}
	}else{?>
		<script>
			alert('Per essere visibile l\'iscrizione deve essere confermata e pagata');
		</script>
	<?php }
}

if($tipo=="lista"){
	$query_list="SELECT lista_iscritti FROM edizioni_regate WHERE id='$id_doc'";
	$resu_list=$open_connection->connection->query($query_list);
	list($lista)=$resu_list->fetch();
	if($lista==0) $query_up="UPDATE edizioni_regate SET lista_iscritti='1' WHERE id='$id_doc'";
	else $query_up="UPDATE edizioni_regate SET lista_iscritti='0' WHERE id='$id_doc'";
	//echo $query_up;
	$risu_up=$open_connection->connection->query($query_up);
}

if($tipo=="footer"){
	$query_list="SELECT lista_iscritti_footer FROM edizioni_regate WHERE id='$id_doc'";
	$resu_list=$open_connection->connection->query($query_list);
	list($footer)=$resu_list->fetch();
	if($footer==0) $query_up="UPDATE edizioni_regate SET lista_iscritti_footer='1' WHERE id='$id_doc'";
	else $query_up="UPDATE edizioni_regate SET lista_iscritti_footer='0' WHERE id='$id_doc'";
	echo $query_up;
	$risu_up=$open_connection->connection->query($query_up);
}

if($stato=="inviato"){
	$arr_no['stato']=1;
	$path ="../files/iscrizioni_regate/$id_doc";
	if(!is_dir ($path)) {
		mkdir($path, 0777, true);
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
	$query="SELECT codice FROM $table WHERE id='$id_doc'";	
	$resu=$open_connection->connection->query($query);
	list($codice)=$resu->fetch();
	
	
	if(isset($_POST['email'])) $email_invio=$_POST['email']; else $email_invio="";
	
	$link_pagamento="$http://$ind_sito/regate-".$anno_edizione."/modulo_iscrizione/".to_htaccess_url($nome_edizione,"")."-".$id_edizione."/conferma-iscrizione_".$codice.".html";
	//include("../../fissi/mail_link_pagamento_regate.inc.php");	
	?>
	<script>
		window.location='<?php echo $http;?>://<?php echo $ind_sito;?>/mail_link_pagamento_regate.php?email_invio=<?php echo $email_invio;?>&anno_edizione=<?php echo $anno_edizione;?>&nome_edizione=<?php echo $nome_edizione;?>&id_edizione=<?php echo $id_edizione;?>&codice=<?php echo $codice;?>&id_doc=<?php echo $id_doc;?><?php echo $rif;?>';
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
	<?php if($tipo=="rating_certificate"){
		$query="SELECT rating_certificate FROM $table WHERE id='$id_doc'";	
		$resu=$open_connection->connection->query($query);
		list($n_rating_certificate)=$resu->fetch();
		?>
		<div class="mws-panel grid_8">
			<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Rating Certificate</b></div>
			
			<div id="inserisci">
				<div class="mws-panel-header">
					<span>Inserisci Rating Certificate</span>
				</div>
				<div class="mws-panel-body no-padding" style="margin-top:40px">
					<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
						<input type="hidden" name="stato" value="inviato"/>
						<div class="mws-form-inline">
							
								<div class="mws-form-row">
									<label class="mws-form-label">Rating Certificate</label>
									<div class="mws-form-item">
										<?php if($n_rating_certificate!=""){?>
											<a style="color:#000" href="../download2.php?path=resarea/files/iscrizioni_regate/<?php echo $id_doc;?>/&file=<?php echo $n_rating_certificate;?>" target="_blank" class="$stile">Documento attuale : <b><?php echo $n_rating_certificate;?></b></a>
											&nbsp;&nbsp;<a style="color:#000" href="<?php echo $_SERVER['REQUEST_URI'];?>&campocanc=rating_certificate" class="testo10" ><i class="fa fa-trash" aria-hidden="true"></i></a>
										<?php }?>
										<br>
										<input name="rating_certificate" type="file" class="medium" size="60">
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
						if (document.invia_comm.rating_certificate.value=="") alert('Rating Certificate obbigatorio');
						else document.invia_comm.submit();
					}
				</script>
			</div>
		</div>
	<?php } elseif($tipo=="crew_list"){
		$query="SELECT crew_list FROM $table WHERE id='$id_doc'";	
		$resu=$open_connection->connection->query($query);
		list($n_crew_list)=$resu->fetch();
		?>
		<div class="mws-panel grid_8">
			<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Crew List</b></div>
			
			<div id="inserisci">
				<div class="mws-panel-header">
					<span>Inserisci Crew List</span>
				</div>
				<div class="mws-panel-body no-padding" style="margin-top:40px">
					<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
						<input type="hidden" name="stato" value="inviato"/>
						<div class="mws-form-inline">
							
								<div class="mws-form-row">
									<label class="mws-form-label">Crew List</label>
									<div class="mws-form-item">
										<?php if($n_crew_list!=""){?>
											<a style="color:#000" href="../download2.php?path=resarea/files/iscrizioni_regate/<?php echo $id_doc;?>/&file=<?php echo $n_crew_list;?>" target="_blank" class="$stile">Documento attuale : <b><?php echo $n_crew_list;?></b></a>
											&nbsp;&nbsp;<a style="color:#000" href="<?php echo $_SERVER['REQUEST_URI'];?>&campocanc=crew_list" class="testo10" ><i class="fa fa-trash" aria-hidden="true"></i></a>
										<?php }?>
										<br>
										<input name="crew_list" type="file" class="medium" size="60">
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
						if (document.invia_comm.crew_list.value=="") alert('Crew List obbigatoria');
						else document.invia_comm.submit();
					}
				</script>
			</div>
		</div>
	<?php } elseif($tipo=="pagamento"){
		if(isset($_GET['metodo'])) $metodo=$_GET['metodo']; else $metodo="";
		if($metodo!=""){
			$query_up="UPDATE $table SET payment_method='$metodo' WHERE id='$id_doc'";
			$risu_up=$open_connection->connection->query($query_up);?>
			<script>
				window.location="<?php echo http;?>://<?php echo $ind_sito;?>/resarea/frame/iscrizioni_regata_doc.php?tipo=pagamento&id_doc=<?php echo $id_doc;?>";
			</script>
		<?php }
		
		$query="SELECT status, payment_method, data_pagamento FROM $table WHERE id='$id_doc'";	
		$resu=$open_connection->connection->query($query);
		list($status,$pagamento, $data_pagamento)=$resu->fetch();
		
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
											<?php /*<option value="Carta di Credito Presso la Scuola Vela"<?php if($pagamento=="Carta di Credito Presso la Scuola Vela"){?>selected="selected"<?php }?>>Carta di Credito Presso la Scuola Vela</option>*/?>
											<option value="Bonifico"<?php if($pagamento=="Bonifico"){?>selected="selected"<?php }?>>Bonifico</option>
											<option value="Contanti"<?php if($pagamento=="Contanti"){?>selected="selected"<?php }?>>Contanti</option>
											<?php /*<option value="Addebito"<?php if($pagamento=="Addebito"){?>selected="selected"<?php }?>>Addebito sul conto di un Socio YCCS</option>*/?>
										</select>
										&nbsp;&nbsp;
										<i class="fa fa-times-circle" aria-hidden="true" style="cursor:pointer;" onclick="document.getElementById('selectOpen').style.display='none'; document.getElementById('selectClose').style.display='block';"></i>
									</div>
									<div style="clear:both; height:20px;"></div>									
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
		$query="SELECT charterer_email, captain_email, boat_name, codice, status  FROM $table WHERE id='$id_doc'";	
		$resu=$open_connection->connection->query($query);
		list($charterer_email, $captain_email, $boat_name, $codice, $status)=$resu->fetch();
		
		if($charterer_email && $charterer_email!="") $email = trim($charterer_email);
		else $email = trim($captain_email);
		
		$link_pagamento="$http://$ind_sito/regate-".$anno_edizione."/modulo_iscrizione/".to_htaccess_url($nome_edizione,"")."-".$id_edizione."/conferma-iscrizione_".$codice.".html";
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
											<b>Link Pagamento</b>:<br/><?php echo $link_pagamento;?>
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
										Inviare il link per procedere al pagamento su Paypal dell'iscrizione par la barca <b><?php echo $boat_name;?></b> all'indirizzo email indicato?
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
