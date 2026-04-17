<?php 
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

if(isset($_GET['id_campo'])) $id_campo=$_GET['id_campo']; else $id_campo="";
if(isset($_GET['val'])) $val=$_GET['val']; else $val="";

$query="SELECT id_edizione FROM edizioni_doc WHERE id='$id_campo'";
$resu=$open_connection->connection->query($query);
list($id_edizione)=$resu->fetch();

$query_up="UPDATE edizioni_doc SET modulo='0' WHERE id_edizione='$id_edizione'";
$risu_up=$open_connection->connection->query($query_up);

$query_up2="UPDATE edizioni_doc SET modulo='$val' WHERE id='$id_campo'";
$risu_up2=$open_connection->connection->query($query_up2);

?>