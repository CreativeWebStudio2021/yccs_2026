<?php 
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

$oggetto_frame = new Functions_adm($array_sito);

if(isset($_GET['id_prod'])) $id_prod=$_GET['id_prod']; else $id_prod="";
if(isset($_GET['quant'])) $quant=$_GET['quant']; else $quant="";

$query_up="UPDATE prodotti SET quantita='$quant' WHERE id='$id_prod'";
//echo "@@".$query_up;
$risu_up=$open_connection->connection->query($query_up);
?>