<?php 
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

$oggetto_frame = new Functions_adm($array_sito);

if(isset($_GET['id_isc'])) $id_isc=$_GET['id_isc']; else $id_isc="";
if(isset($_GET['id_edizione'])) $id_edizione=$_GET['id_edizione']; else $id_edizione="";
if(isset($_GET['new_val'])) $new_val=$_GET['new_val']; else $new_val="";

$query_up="UPDATE edizioni_iscritti SET link_fisso='0' WHERE id_edizione='$id_edizione'";
$risu_up = $open_connection->connection->query($query_up);

$query_up="UPDATE edizioni_iscritti SET link_fisso='$new_val' WHERE id='$id_isc'";
$risu_up = $open_connection->connection->query($query_up);

