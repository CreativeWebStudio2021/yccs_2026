<?php 
$table="members_eventi_link";
$file="link_members_eventi";
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';
require_once '../css/custom_css.php';

$oggetto_frame = new Functions_adm($array_sito);


if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";
if(isset($_GET['id_comm'])) $id_comm=$_GET['id_comm']; else $id_comm="";
if(isset($_GET['campocanc'])) $campocanc=$_GET['campocanc']; else $campocanc="";

$rif="";
if($id_comm!="") $rif="&id_comm=$id_comm";

$query_rec = "select * from $table where id='$id_canc'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_testo = $arr_rec['testo'];
$n_testo_eng = $arr_rec['testo_eng'];
$n_tipo = $arr_rec['tipo_link'];
$n_link = $arr_rec['link'];
$n_link_eng = $arr_rec['link_eng'];
$n_allegato = $arr_rec['allegato'];
$n_allegato_eng = $arr_rec['allegato_eng'];
				
if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";

$oggetto_admin = new Functions_adm($array_sito);

if($stato=="inviato"){
	$arr_no['stato']=1;
	
	$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	$_POST['testo_eng']=str_replace('"','\"',$_POST['testo_eng']);

	$oggetto_admin->modifica_campi ("$table" ,$id_canc , $arr_no, "", "", "../files");
	?>
		<script language="javascript">
			window.location = "<?php echo $http;?>://<?php  echo $ind_sito?>/resarea/frame/link_members_eventi.php?id_comm=<?php echo $id_comm;?>" ;
		</script>
	<?php 
}

if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_canc'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("../files/$cancimg")){unlink("../files/$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_canc'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='<?php echo $http;?>://<?php  echo $ind_sito?>/resarea/frame/llink_members_eventi_mod.php?id_comm=<?php echo $id_comm;?>&id_canc=<?php echo $id_canc;?>';
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

<style>
	a{color:#333}
	a:hover{color:#333}
</style>

<script src="ckeditor/ckeditor.js"></script>

<script language="javascript">
	function verifica(){
		if (document.invia_comm.tipo_link.value=="") alert('Tipo Link obbigatorio');
		else if (document.invia_comm.testo_eng.value=="") alert('Testo (Inglese) obbigatorio');
		//else if (document.invia_comm.tipo_link.value=="link" && document.invia_comm.link_eng.value=="") alert('Link (Inglese) obbigatorio');
		//else if (document.invia_comm.tipo_link.value=="allegato" && document.invia_comm.allegato_eng.value=="") alert('Allegato (Inglese) obbigatorio');
		else document.invia_comm.submit();
	}

	function annulla(){
		window.location='<?php echo $http;?>://<?php echo $ind_sito?>/resarea/frame/link_members_eventi.php?id_comm=<?php echo $id_comm;?>';
	}
</script>
</head>

<body style="background:#fff">
 
	<div class="mws-panel grid_8">
		<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Eventi Young Azzurra - Link</b></div>

		<div id="start" style="display:none"></div>
		<div id="end" style="display:none"></div>
		<div id="total" style="display:none"></div>
		
		<div id="inserisci">
			<div class="mws-panel-header">
				<span>Modifica Link Evento</span>
			</div>
			<div class="mws-panel-body no-padding" style="margin-top:40px">
				<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
					<input type="hidden" name="stato" value="inviato"/>
					<div class="mws-form-inline">
						<script type="text/javascript">
							function vedi(cosa){
								if(cosa=="link"){
									document.getElementById('box_link').style.display='block';
									document.getElementById('box_allegato').style.display='none';
									document.getElementById('bott').style.display='block';
									document.getElementById('box_testo').style.display='block';
								}else if(cosa=="allegato"){
									document.getElementById('box_link').style.display='none';
									document.getElementById('box_allegato').style.display='block';
									document.getElementById('bott').style.display='block';
									document.getElementById('box_testo').style.display='block';
								}else if(cosa==""){
									document.getElementById('box_link').style.display='none';
									document.getElementById('box_allegato').style.display='none';
									document.getElementById('bott').style.display='none';
									document.getElementById('box_testo').style.display='none';
								}
							}
						</script>
						

						<div class="mws-form-row">
							<label class="mws-form-label">Tipo </label>
							<div class="mws-form-item">
								<select name="tipo_link" class="small" onchange="vedi(this.value);">
									<option value="">Seleziona</option>
									<option value="link" <?php if($n_tipo=="link"){?>selected="selected"<?php }?>>Link</option>
									<option value="allegato" <?php if($n_tipo=="allegato"){?>selected="selected"<?php }?>>Allegato</option>				
								</select>
							</div>
						</div>
						<div style="display:block" id="box_testo">
							<div class="mws-form-row">
								<label class="mws-form-label">Testo (Inglese)*</label>
								<div class="mws-form-item">
									<input type="text" class="medium" name="testo_eng" value="<?php  echo $n_testo_eng; ?>"/>
								</div>
							</div>
							<div class="mws-form-row">
								<label class="mws-form-label">Testo (Italiano)</label>
								<div class="mws-form-item">
									<input type="text" class="medium" name="testo" value="<?php  echo $n_testo; ?>"/>
									<?php if($n_testo && $n_testo!=""){?><a href="frame/link_members_eventi_mod.php?id_comm=<?php echo $id_comm;?>&id_canc=<?php  echo $id_canc; ?>&campocanc=testo<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a><?php }?>
								</div>
							</div>
						</div>
						<div id="box_link" style="display:<?php if($n_tipo=="link"){?>block<?php }else{?>none<?php }?>">
							<div class="mws-form-row">
								<label class="mws-form-label">Link (Inglese)</label>
								<div class="mws-form-item">
									<input type="text" class="medium" name="link_eng" value="<?php  echo $n_link_eng; ?>"/>
									<a href="frame/link_members_eventi_mod.php?id_comm=<?php echo $id_comm;?>&id_canc=<?php  echo $id_canc; ?>&campocanc=link_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
								</div>
							</div>
							<div class="mws-form-row">
								<label class="mws-form-label">Link (Italiano)</label>
								<div class="mws-form-item">
									<input type="text" class="medium" name="link" value="<?php  echo $n_link; ?>"/>
									<?php if($n_link && $n_link!=""){?><a href="frame/link_members_eventi_mod.php?id_comm=<?php echo $id_comm;?>&id_canc=<?php  echo $id_canc; ?>&campocanc=link<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a><?php }?>
								</div>
							</div>
						</div>
						<div id="box_allegato" style="display:<?php if($n_tipo=="allegato"){?>block<?php }else{?>none<?php }?>">
							<?php 
							$oggetto_admin->campo_mod("Allegato PDF (Inglese)" , "allegato_eng" , "$n_allegato_eng"  , "5", 'no', "$cmd", "$id_rec");
							$oggetto_admin->campo_mod("Allegato PDF (Italiano)" , "allegato" , "$n_allegato"  , "5", 'no', "$cmd", "$id_rec");
							?>
						</div>
						
						<div class="mws-button-row" id="bott" style="display:block">
							<input type="button" value="modifica" class="btn btn-danger" onclick="verifica()">
							<input type="button" value="Annulla" class="btn" onclick="annulla()">
						</div>
					</div>
				</form>
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
	
	<?php  if ($cmd!="" && is_file("js/table/$cmd.table.php")) {include("js/table/$cmd.table.php"); }?>
	
    <!-- Login Script -->
    <script src="js/core/login.js"></script>
	
</body>
</html>
