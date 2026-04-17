<?php 
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

if(isset($_GET['val'])) $val=$_GET['val']; else $val="";

$query_up="UPDATE instagram_feed SET attivo='$val' WHERE id='1'";
echo $query_up;
$risu_up=$open_connection->connection->query($query_up);
?>