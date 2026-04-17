<?php 
set_time_limit (0);
session_start();

require_once '../config/db.php';
require_once '../config/dbnew.php';
require_once '../config/array.php';	
require_once 'fissi/functions_adm.php';
require_once 'fissi/all_posts.php';
require_once 'fissi/functions.php';

$oggetto_admin = new Functions_adm($array_sito);
/*
$query_foto="SELECT logo_edizione FROM edizioni_regate WHERE logo_edizione is not NULL";
$resu_foto=$open_connection->connection->query($query_foto);
$num_foto=$resu_foto->rowCount();
echo $query_foto;
if($num_foto>0){
	while($risu_foto=$resu_foto->fetch()){
		$foto = $risu_foto['logo_edizione'];
		echo $foto."<br/>";
		$temp_file = "img_up/regate/".$foto;
		$oggetto_admin->thumbjpg(100,$temp_file,$foto,"img_up/regate","xs_");
	}
}*/

$query_foto="SELECT logo FROM regate WHERE logo is not NULL AND logo<>''";
$resu_foto=$open_connection->connection->query($query_foto);
$num_foto=$resu_foto->rowCount();
echo $query_foto."<br/>";
if($num_foto>0){
	while($risu_foto=$resu_foto->fetch()){
		$foto = $risu_foto['logo'];
		echo $foto."<br/>";
		$temp_file = "img_up/regate/".$foto;
		$oggetto_admin->thumbjpg(100,$temp_file,$foto,"img_up/regate","xs_");
	}
}
?>