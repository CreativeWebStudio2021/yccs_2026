<?php
session_start();  

require_once('ForceDownload.class.php');
$dir = "resarea/files/comunicati-ai-soci/";  
$file = isset($_GET['file']) ?  $_GET['file']  : ''; 
$download = New ForceDownload($dir, $file);
$download->download() or die ($download->get_error());

?>