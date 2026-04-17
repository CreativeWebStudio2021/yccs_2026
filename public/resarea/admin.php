<?php 
set_time_limit (0);
session_start();

header('X-XSS-Protection: 0');

//require_once 'config/db.php';
require_once 'config/dbnew.php';
require_once 'config/array.php';	
require_once 'fissi/functions_adm.php';
require_once 'fissi/all_posts.php';
require_once 'fissi/functions.php';

if($cmd=="destroy"){
	unset($_SESSION["loggato"]);
	unset($_SESSION["acl_login"]);
	unset($_SESSION["nome_login"]);
}

if(!isset($_SESSION["loggato"]) ){
	$_SESSION["loggato"] = "no";
	/*$_SESSION["loggato"] = "si";*/
}

if(!isset($_SESSION["nome_login"]) ){
	$_SESSION["nome_login"] = "";
}

if(isset($_POST['memorizza'])) {
	$memorizza=$_POST['memorizza'];
} else $memorizza=false;

if(isset($_COOKIE['mio_user_yccs'])) $prev_user = $_COOKIE['mio_user_yccs']; else $prev_user = "";
if(isset($_COOKIE['mio_pass_yccs'])) $prev_pass = $_COOKIE['mio_pass_yccs']; else $prev_pass = "";

$user_login = $pass_login = $log = "";

$val_user = "";
if(isset($_COOKIE['mio_user_yccs'])) $val_user = $_COOKIE['mio_user_yccs'];
$val_pass = "";
if(isset($_COOKIE['mio_pass_yccs'])) $val_pass = $_COOKIE['mio_pass_yccs'];

if( isset($_POST["user_login"]) && isset($_POST["pass_login"]) )
{
	$user_login = $_POST["user_login"];
	$pass_login = $_POST["pass_login"];
	$user_login=str_replace("'","\'",$user_login);
	//$pass_login=str_replace("'","\'",$pass_login);
	
	/*if ($memorizza && $user_login && $pass_login) {
	// memorizza comunque 
		$expires = time()+60*60*24*60; // exp in due mesi 
		setcookie  ( "mio_user_yccs", $user_login,  "$expires" );
		setcookie  ( "mio_pass_yccs", $pass_login,  "$expires" );
	}*/
	
	$query_login = "select  *  from users where user_adm=:user_login";
	$risu_login = $open_connection->connection->prepare($query_login);
	$risu_login->execute(array(':user_login'=>$user_login));
	
	$log = "no";
	if($risu_login)
	{
		$num_login = $risu_login->rowCount();
		if($num_login>0)
		{
			$arr_login = $risu_login->fetch();
			$acl_log = $arr_login['livello'];
			if($arr_login['pass_adm']===crypt($pass_login,$pass_login)){
				$nome_log = ucwords($arr_login['identificativo']);
				
				$_SESSION["acl_login"] = $acl_log ;
				$_SESSION["loggato"] = "si";
				$_SESSION["nome_login"] = $nome_log;
				
				$log = "si";
			}
		}
	}
} 

$oggetto_admin = new Functions_adm($array_sito);

$data_att = date("Y-m-d");

if($cmd=="ya_gallery_foto" || $cmd=="ya_gallery"){
	$query2="SELECT * FROM ya_gallery";
	$resu2 = $open_connection->connection->query($query2);
	while($risu2=$resu2->fetch()){
		$query3="SELECT * FROM ya_gallery_foto WHERE id_rife='".$risu2['id']."'";
		$resu3 = $open_connection->connection->query($query3);
		$num3 = $resu3->rowCount();
		
		$query_up = "UPDATE ya_gallery SET num_foto = '$num3' WHERE id='".$risu2['id']."'";
		$risu_up = $open_connection->connection->query($query_up);
	}
	
	$query = "SELECT * FROM ya_gallery_cat";
	$resu = $open_connection->connection->query($query);
	while($risu = $resu->fetch()){
		$query2="SELECT * FROM ya_gallery WHERE id_rife='".$risu['id']."'";
		$resu2 = $open_connection->connection->query($query2);
		$num_gal = $resu2->rowCount();
		$num_tot = 0;
		while($risu2=$resu2->fetch()){
			$num_tot = $num_tot+$risu2['num_foto'];
		}
		
		$query_up = "UPDATE ya_gallery_cat SET num_foto = '$num_tot' WHERE id='".$risu['id']."'";
		$risu_up = $open_connection->connection->query($query_up);
	}
}

$data_conferenza = "2022-04-06 09:00:00";
if(date("Y-m-d H:i:s")<$data_conferenza) $conferenza=0;
else $conferenza=1;
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

<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="plugins/colorpicker/colorpicker.css" media="screen">
<?php if ($cmd=="gallery_ins" || $cmd=="foto_ins" || $cmd=="fotogallery_pagine_ins" || $cmd=="fotos_ins") { ?>
	<link rel="stylesheet" type="text/css" href="plugins/prettyphoto/css/prettyPhoto.css" media="screen">
	<link rel="stylesheet" href="plugins/plupload/jquery.plupload.queue.css" media="screen">
	<link rel="stylesheet" href="plugins/elfinder/css/elfinder.css"media="screen" >
<?php }?>
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

<script src="ckeditor/ckeditor.js"></script>

 <script src="js/libs/jquery-1.8.3.min.js"></script>
 
  <?php 
		include("css/custom_css.php");
	?>
</head>

<body>
	<!-- Header -->
	<div id="mws-header" class="clearfix" style="background-color:#fff">
	<?php 
		include("fissi/testata_adm.inc.php");
	?>
	</div>
	<div style="width:100%; height:84px;"></div>
	
	<!-- Start Main Wrapper -->
    <div id="mws-wrapper">	
	<?php 
	include("fissi/menu_adm.inc.php");
	
	if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si")
	{
	?>
	
		<!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
			<!-- Inner Container Start -->
            <div class="container">
				<?php 
				if(isset($_SESSION["acl_login"]) && ($_SESSION["acl_login"]=="300" || ($_SESSION["acl_login"]=="200" && $cmd!="utenti" && $cmd!="utenti_ins" && $cmd!="utenti_mod") || ($_SESSION["acl_login"]=="100" && ($cmd=="iscrizioni_scuola" || $cmd=="iscrizioni_scuola_mod")))){					
					if(is_file("include/".$cmd.".inc.php")){
						include("include/".$cmd.".inc.php");
					}else{
						include("include/home.inc.php");
					}
				}else{
					include("include/home.inc.php");
				}
				
		
				include("robots_generator.php");
				?>
			</div>
		
			<!-- Footer -->
			<div id="mws-footer">
				Creative Web Studio 2025
			</div>
		</div>
	
	<?php 
	}
	else
	{
		include("login.inc.php");
	}
	?>
	</div>
	
	<!-- JavaScript Plugins -->
    
    <script src="js/libs/jquery.mousewheel.min.js"></script>
    <script src="js/libs/jquery.placeholder.min.js"></script>
    <script src="custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="jui/jquery-ui.custom.min.js"></script>
    <script src="jui/js/jquery.ui.touch-punch.js"></script>
	<script src="jui/js/jquery-ui-effects.min.js"></script>
	
    <!-- Plugin Scripts -->	
	<?php 	if ($cmd=="gallery_ins" || $cmd=="foto_ins" || $cmd=="fotogallery_pagine_ins" || $cmd=="fotos_ins") { ?>
		<script src="plugins/plupload/plupload.js"></script>
		<script src="plugins/plupload/plupload.flash.js"></script>
		<script src="plugins/plupload/plupload.html4.js"></script>
		<script src="plugins/plupload/plupload.html5.js"></script>
		<script src="plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
		<script type="text/javascript" src="plugins/plupload/i18n/it.js"></script>
		<!--<script src="plugins/elfinder/js/elfinder.min.js"></script>-->
		
		<!-- Demo Scripts (remove if not needed) 
		<script src="js/demo/demo.files.js"></script>-->
		<script language="javascript">
		/*
		 * MWS Admin v2.1 - Files Demo JS
		 * This file is part of MWS Admin, an Admin template build for sale at ThemeForest.
		 * All copyright to this file is hold by Mairel Theafila <maimairel@yahoo.com> a.k.a nagaemas on ThemeForest.
		 * Last Updated:
		 * December 08, 2012
		 *
		 */

		;(function( $, window, document, undefined ) {

			$(document).ready(function() {

				/*if( $.fn.elfinder) {
					$("#elfinder").elfinder({
						url: 'plugins/elfinder/connectors/php/connector.php',
						lang: 'en',
						docked: true,
						height: 300
					});
				}*/

				if( $.fn.pluploadQueue ) {
					$("#uploader").pluploadQueue({
						// General settings
						runtimes: 'html5, html4',
						<?php  if ($cmd=="gallery_ins") { ?>
							url: 'upload_gal.php?id_canc=<?php  echo $id_canc; ?><?php  echo $rif; ?>',
						<?php  } elseif ($cmd=="foto_ins") { ?>
							url: 'upload.php?id_canc=<?php  echo $id_canc; ?><?php  echo $rif; ?>',
						<?php  } elseif ($cmd=="fotogallery_pagine_ins") { ?>
							url: 'upload_pagine.php?id_canc=<?php  echo $id_canc; ?>&pagina=<?php echo $pagina;?><?php  echo $rif; ?>',
						<?php  } elseif ($cmd=="fotos_ins") { ?>
							url: 'upload_stampa.php?id_canc=<?php  echo $id_canc; ?><?php  echo $rif; ?>',
						<?php  } ?>
						/*post_params: {"tipo":"nuovo", "id_rife":"1"},*/
						max_file_size: '10000mb',
						chunk_size: '10mb',
						unique_names: true,
						multiple_queues: true,

						/* Resize images on clientside if we can
						resize : {width : 900, quality : 72},*/

						// Rename files by clicking on their titles
						rename: true,

						// Sort files
						sortable: true,

						// Specify what files to browse for
						filters: [{
							title: "Image files",
							extensions: "jpg,gif,png"
						}, 
						{
							title: "Zip files",
							extensions: "zip,avi"
						}]
					});
					
					
					$('#form_add').submit(function (e) {
						  var uploader = $("#uploader").pluploadQueue();
						  // Files in queue upload them first
						  if (uploader.files.length > 0) {
							  // When all files are uploaded submit form
							  uploader.bind('StateChanged', function () {
								  if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
										// $('form')[0].submit();
										<?php  if ($cmd=="gallery_ins") { ?>
										window.location="admin.php?cmd=gallery<?php echo $rif;?>";
										<?php  } elseif ($cmd=="foto_ins") { ?>
										window.location="admin.php?cmd=foto<?php echo $rif;?>";
										<?php  } elseif ($cmd=="fotogallery_pagine_ins") { ?>
										window.location="admin.php?cmd=fotogallery_pagine<?php echo $rif;?>";
										<?php  } elseif ($cmd=="fotos_ins") { ?>
										window.location="admin.php?cmd=fotos<?php echo $rif;?>";
										<?php  } ?>
								  }
							  });
							  uploader.start();

						  } else {

							  alert('Aggiungi almeno un file.');

						  }
						  return false;
					});					
				}
			});

		}) (jQuery, window, document);
		</script>
	<?php }?>

	<script src="plugins/datatables/jquery.dataTables.js"></script>
	
    <script src="plugins/colorpicker/colorpicker-min.js"></script>
	<script src="plugins/validate/jquery.validate-min.js"></script>
	<?php if($cmd=="edizioni_ins" || $cmd=="edizioni_mod"){?>
		<script src="plugins/jscolor/jscolor.js"></script>
	<?php }?>
    <!-- Core Script -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="js/core/themer.js"></script>
	
	<script src="js/demo/demo.widget.js"></script>
	
	<?php if($cmd=="edizioni_ins" || $cmd=="edizioni_mod" || $cmd=="press_ins" || $cmd=="press_mod" || $cmd=="news_ins" || $cmd=="news_mod" || $cmd=="members_news_ins" || $cmd=="members_news_mod" || $cmd=="members_eventi_ins" || $cmd=="members_eventi_mod" || $cmd=="news_private_ins" || $cmd=="news_private_mod" || $cmd=="stampa_ins" || $cmd=="stampa_mod" || $cmd=="ya_risultati_ins" || $cmd=="ya_risultati_mod" || $cmd=="modulo_iscrizioni_mod" || $cmd=="ordini"){?>
		<script type="text/javascript">
			$.datepicker.setDefaults( $.datepicker.regional[ "it" ] );
			$( ".mws-datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
		</script>
	<?php }?>
	
	<?php  if ($cmd!="" && is_file("js/table/$cmd.table.php")) include("js/table/$cmd.table.php"); ?>
	
    <!-- Login Script -->
    <script src="js/core/login.js"></script>
	
	<!-- Demo Scripts (remove if not needed) 
    <script src="js/demo/demo.formelements.js"></script>-->
	<script src="plugins/cleditor/jquery.cleditor.min.js"></script>
	<script src="plugins/cleditor/jquery.cleditor.table.min.js"></script>
    <script src="plugins/cleditor/jquery.cleditor.xhtml.min.js"></script>
    <script src="plugins/cleditor/jquery.cleditor.icon.min.js"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {	
				// CLEditor
				$.fn.cleditor && $('.cleditor').cleditor({ width: '100%' });
			});
		}) (jQuery);	
	</script>
	<?php  
	if($log == "no")
	{
	?>
	<script language="javascript">
		(function($) {
			$(document).ready(function() {	
				window.alert('Non ci sono utenti attivi che possano accedere con queste username e password');
				document.login.user_login.value = '';
				document.login.pass_login.value = '';
				});
		}) (jQuery);
	</script>
	<?php 	
	}
	?>
	
	<script>
		const nav = document.getElementById("mws-navigation");
		const scritte = document.querySelectorAll(".scritte_menu");
		const container = document.getElementById("mws-container");
		const cancella_sel = document.getElementById("cancella_sel");		

		nav.addEventListener("mouseenter", () => {console.log("AAA");
		  nav.style.width = "200px";
		  container.style.marginLeft = "200px";
		  document.querySelectorAll(".scritte_menu").forEach(el => el.style.opacity = "1");
		  if (cancella_sel) cancella_sel.style.left = "205px";
		});
		nav.addEventListener("mouseleave", () => {console.log("BBBB");
		  nav.style.width = "60px";
		  container.style.marginLeft = "60px";
		  document.querySelectorAll(".scritte_menu").forEach(el => el.style.opacity = "0");
		  if (cancella_sel) cancella_sel.style.left = "65px";
		});

	  </script>
</body>
</html>
