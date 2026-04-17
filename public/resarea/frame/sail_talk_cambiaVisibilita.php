<?php 
require_once '../config/dbnew.php';	

if(isset($_GET['id_articolo'])) $id_articolo=$_GET['id_articolo']; else $id_articolo="";

$query="SELECT visibile FROM sail_talk_articolo WHERE id='$id_articolo'";
$resu = $open_connection->connection->query($query);
list($visibile)=$resu->fetch();
if($visibile==0) $query2="UPDATE sail_talk_articolo SET visibile='1' WHERE id='$id_articolo'";
else  $query2="UPDATE sail_talk_articolo SET visibile='0' WHERE id='$id_articolo'";
$risu = $open_connection->connection->query($query2);
?>