<?php 
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

if(isset($_GET['id_campo'])) $id_campo=$_GET['id_campo']; else $id_campo="";

$query="SELECT news FROM news WHERE id='$id_campo'";
$resu=$open_connection->connection->query($query);
list($news)=$resu->fetch();
if($news==0) $new=1;
elseif($news==1) $new=0;
/*
if($new==1){
	$oggetto_admin = new Functions_adm($array_sito);
	$ord = $oggetto_admin->trova_ordine("news");
}else{
	$ord = '0';
}*/

//$query_up="UPDATE news SET news='$new', ordine='$ord' WHERE id='$id_campo'";
$query_up="UPDATE news SET news='$new' WHERE id='$id_campo'";
//echo $query_up;
$risu_up=$open_connection->connection->query($query_up);
?>