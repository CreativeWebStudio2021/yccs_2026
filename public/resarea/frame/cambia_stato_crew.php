<?php 
require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

if(isset($_GET['id_crew'])) $id_crew=$_GET['id_crew']; else $id_crew="";
if($id_crew!=""){
	$query="SELECT attivo FROM crew_board WHERE id='$id_crew'";
	$resu=$open_connection->connection->query($query);
	list($stato)=$resu->fetch();
	
	if($stato==0)
		$query_up="UPDATE crew_board SET attivo='1' WHERE id='$id_crew'";
	else $query_up="UPDATE crew_board SET attivo='0' WHERE id='$id_crew'";
	echo $query_up;
	$risu_up=$open_connection->connection->query($query_up);
}
?>