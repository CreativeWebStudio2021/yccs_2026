<?
require_once '../config/dbnew.php';	

if(isset($_GET['id_gal'])) $id_gal=$_GET['id_gal']; else $id_gal="";
if(isset($_GET['id_cat'])) $id_cat=$_GET['id_cat']; else $id_cat="";

$ordine = $oggetto_admin->trova_ordine("ya_gallery",'id_rife',$id_cat);

$query_up="UPDATE ya_gallery SET id_rife='$id_cat', ordine='$ordine' WHERE id='$id_gal'";
$risu_up = $open_connection->connection->query($query_up);
echo $query_up;
?>