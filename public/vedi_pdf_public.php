<?php
if(isset($_GET['file'])) $file = $_GET['file']; else $file="";
if($file!=""){
	$pdf = file_get_contents('files/'.$file);
	header("Content-Type: application/pdf");
	//Display it
	echo $pdf;
}?>