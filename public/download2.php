<?php
session_start();  

if($_SESSION["loggato"]=="si"){
	require_once('ForceDownload.class.php');
	$dir = "resarea/files/comunicati-ai-soci/";  
	$file = isset($_GET['file']) ?  $_GET['file']  : ''; 
	$path = isset($_GET['path']) ?  $_GET['path']  : ''; 
	$download = New ForceDownload($path, $file);
	$download->download() or die ($download->get_error());
}else{?>
	<script>
		alert("Per poter scaricare il file loggarsi nel backoffice e cliccare nuovamente sul link");
		window.location="resarea/admin.php";
	</script>
<?php }?>