<?php 
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

if(isset($_GET['id_campo'])) $id_campo=$_GET['id_campo']; else $id_campo="";
if(isset($_GET['ver'])) $ver=$_GET['ver']; else $ver="";


$query_up="UPDATE edizioni_regate SET old='0', new='0', new2='0' WHERE id='$id_campo'";
$risu_up=$open_connection->connection->query($query_up);

if($ver==1) $nome_ver="old";
if($ver==2) $nome_ver="new";
if($ver==3) $nome_ver="new2";

$query_up="UPDATE edizioni_regate SET {$nome_ver}='1' WHERE id='$id_campo'";
$risu_up=$open_connection->connection->query($query_up);
?>