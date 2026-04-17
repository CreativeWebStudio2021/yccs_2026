<?php 
set_time_limit (0);
session_start();

if(isset($_GET['ind'])) $ind = $_GET['ind']; else $ind=0;

require_once '../config/db.php';
require_once '../config/dbnew.php';
require_once '../config/array.php';	
require_once 'fissi/functions_adm.php';
require_once 'fissi/all_posts.php';
require_once 'fissi/functions.php';

$oggetto_admin = new Functions_adm($array_sito);

$query_foto="SELECT foto, id FROM edizioni_foto WHERE thumb='0' ORDER BY id DESC LIMIT 0,1";
$resu_foto=$open_connection->connection->query($query_foto);
$num_foto=$resu_foto->rowCount();
echo $query_foto;
if($num_foto>0){
	while($risu_foto=$resu_foto->fetch()){
		$foto = $risu_foto['foto'];
		$id = $risu_foto['id'];
		$foto=str_replace("admin/","resarea/",$foto);
		echo $foto."<br/>";
		if(str_replace("/resarea/img_up/regate/foto/","",$foto)!=$foto){
			$nome_file=str_replace("/resarea/img_up/regate/foto/","",$foto);
			$temp_file = "img_up/regate/foto/".$nome_file;
			echo $nome_file." - ".$temp_file."<br/>";
			$oggetto_admin->thumbjpg(220,$temp_file,$nome_file,"img_up/regate/foto/thumb","220_");
			$oggetto_admin->thumbjpg(325,$temp_file,$nome_file,"img_up/regate/foto/thumb","325_");
			$oggetto_admin->thumbjpg(400,$temp_file,$nome_file,"img_up/regate/foto/thumb","400_");
			$oggetto_admin->thumbjpg(710,$temp_file,$nome_file,"img_up/regate/foto/thumb","710_");
		}
		$query_up="UPDATE edizioni_foto SET thumb='1' WHERE id='$id'";
		$risu_up=$open_connection->connection->query($query_up);
	}
}
$ind++;
?>
<script>
	window.location='thumb_foto.php?ind=<?php echo $ind;?>'
</script>