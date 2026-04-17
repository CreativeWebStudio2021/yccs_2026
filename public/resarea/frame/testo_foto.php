<?php 
require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";
if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['testo'])) $testo=$_GET['testo']; else $testo="";

/*$testo=str_replace("'","\'",$testo);
$testo=str_replace('"','\"',$testo);*/

if($azione=="modifica"){
	$query_up="UPDATE edizioni_foto SET testo='$testo' WHERE id='$id_canc'";
	echo $query_up;
	$risu_up=$open_connection->connection->query($query_up);
}

if($azione=="cancella"){
	$query_up="UPDATE edizioni_foto SET testo=NULL WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
}
?>
<script type="text/javascript">
	parent.document.getElementById('testo_<?php echo $id_canc;?>').innerHTML='<?php echo $testo;?> &nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i>';
</script>