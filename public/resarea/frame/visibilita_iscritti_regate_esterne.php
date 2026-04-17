<?
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

if(isset($_GET['id_campo'])) $id_campo=$_GET['id_campo']; else $id_campo="";
if(isset($_GET['val'])) $val=$_GET['val']; else $val="";

$query_up="UPDATE regate_esterne SET visibile='$val' WHERE id='$id_campo'";
//echo $query_up;
$risu_up=$open_connection->connection->query($query_up);
?>