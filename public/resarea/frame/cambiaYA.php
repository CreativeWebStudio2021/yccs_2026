<?php 
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

if(isset($_GET['id_campo'])) $id_campo=$_GET['id_campo']; else $id_campo="";

$query="SELECT YA FROM news WHERE id='$id_campo'";
$resu=$open_connection->connection->query($query);
list($YA)=$resu->fetch();
if($YA==0) $new=1;
elseif($YA==1) $new=0;
/*
if($new==1){
	$oggetto_admin = new Functions_adm($array_sito);
	$ord = $oggetto_admin->trova_ordine2("news","","","","","ordine_YA");
}else{
	$ord = '0';
}*/

//$query_up="UPDATE news SET YA='$new', ordine_YA='$ord' WHERE id='$id_campo'";
$query_up="UPDATE news SET YA='$new' WHERE id='$id_campo'";
//echo $query_up;
$risu_up=$open_connection->connection->query($query_up);
?>