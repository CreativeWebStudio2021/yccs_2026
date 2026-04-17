<?php 
$table="edizioni_richieste_contatti";
$file="link_comunicati";
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

$oggetto_frame = new Functions_adm($array_sito);

$rec_pag=20;

if(isset($_GET['id_richiesta'])) $id_richiesta=$_GET['id_richiesta']; else $id_richiesta="";

				
if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";

$oggetto_admin = new Functions_adm($array_sito);

if($stato=="inviato_link"){
	$query="SELECT codice FROM $table WHERE id='$id_doc'";	
	$resu=$open_connection->connection->query($query);
	list($codice)=$resu->fetch();
	
	
	if(isset($_POST['email'])) $email_invio=$_POST['email']; else $email_invio="";
	
	$link_pagamento="$http://$ind_sito/regate-".$anno_edizione."/modulo_iscrizione/".to_htaccess_url($nome_edizione,"")."-".$id_edizione."/link-pagamento_".$codice."_".$id_doc.".html";
	include("../../fissi/mail_link_pagamento_regate.inc.php");	
	?>
	<script>
		alert("Email inviata");
		//parent.location.reload();
	</script>
	<?php 
}

if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";

if($azione=="cancella" && $id_canc!=""){
	$query_del="DELETE FROM $table WHERE id='$id_canc'";
	$risu_del=$open_connection->connection->query($query_del);
	?>
	<script>
		window.location="richieste_contatti.php?id_richiesta=<?php echo $id_richiesta;?>";
	</script>	
<?php }?>

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
	<div class="mws-panel grid_8">
		<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Richieste Contatti</b></div>
		
		<div id="inserisci">
			
			<div class="mws-panel-body no-padding">
				<table class="mws-datatable-fn mws-table">
					<thead>
						<tr>
							<th style="width:20px"></th>
							<th style="text-align:left;">Data</th>
							<th style="text-align:left;">Nome</th>
							<th style="text-align:left;">Contatti</th>
							<th style="text-align:left;">Messaggio</th>
							<th style="text-align:left;">Azioni</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						
							$query_ele = "select * from $table where id_richiesta='$id_richiesta' order by data desc";
							//echo $query_ele;
							$risu_ele = $open_connection->connection->query($query_ele);
							$num_item=$risu_ele->rowCount();
							
							for($x=0;$x<$num_item;$x++)
							{						
								$arr_ele = $risu_ele->fetch();
								$id_campo = $arr_ele['id'];
								$nome = $arr_ele['nome'];
								$cognome = $arr_ele['cognome'];
								$email = $arr_ele['email'];
								$telefono = $arr_ele['telefono'];
								$accettato = $arr_ele['accettato'];
								$messaggio = $arr_ele['messaggio'];
								$codice = $arr_ele['codice'];
								$data = $arr_ele['data'];
								?>
								<script type="text/javascript">
									lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
								</script>
								<tr>
									<td align="center" valign="center">
										<?php  echo $start+$x+1; ?>
									</td>
									<td>
										<?php  
										$temp=explode(" ",$data);
										$temp2=explode("-",$temp[0]);
										echo $temp2[2]."-".$temp2[1]."-".$temp2[0]."<br/>";
										echo $temp[1]; ?>
									</td>
									<td>
										<?php  echo $nome; ?> <?php  echo $cognome; ?>
									</td>
									<td>
										<?php  echo $email; ?><br/>
										<?php  echo $telefono; ?>
									</td>
									<td>
										<?php  echo $messaggio; ?>
									</td>
									
									<td style="width:10%" align="center" valign="center">
										<span class="btn-group">
											<a href="../crew_boat_accept_request-<?php echo $codice;?>" target="_blank"><span class="btn btn-small"><i class="fa fa-envelope" aria-hidden="true" style="color:<?php if($accettato==0){?>red<?php }else{?>green<?php }?>" id="checkStato_<?php echo $x;?>" ></i></span></a>
											<a onclick="return confirm('Confermare cancellazione?')" href="frame/richieste_contatti.php?id_richiesta=<?php echo $id_richiesta;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?>" class="btn btn-small"><i class="icon-trash"></i></a>
										</span>
									</td>
								</tr>
							<?php }?>
					</tbody>
				</table>				
			</div>
		</div>
	</div>
	
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
