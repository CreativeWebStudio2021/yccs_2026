<?php 
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

if(isset($_GET['id_campo'])) $id_campo=$_GET['id_campo']; else $id_campo="";
if(isset($_GET['val'])) $val=$_GET['val']; else $val="";

$query="SELECT id_edizione FROM edizioni_risultati WHERE id='$id_campo'";
$resu=$open_connection->connection->query($query);
list($id_edizione)=$resu->fetch();

$query_up="UPDATE edizioni_risultati SET albodoro='0' WHERE id_edizione='$id_edizione'";
//echo $query_up;
$risu_up=$open_connection->connection->query($query_up);

if($val==1){
	$query_up="UPDATE edizioni_risultati SET albodoro='$val' WHERE id='$id_campo'";
	//echo $query_up;
	$risu_up=$open_connection->connection->query($query_up);
}
?>