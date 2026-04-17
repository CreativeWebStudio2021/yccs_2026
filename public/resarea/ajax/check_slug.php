<?php 
require_once '../config/dbnew.php';	
require_once '../fissi/functions.php';	

if(isset($_GET['slug'])) $slug = $_GET['slug']; else $slug = "";
if(isset($_GET['id_riferimento'])) $id_riferimento = $_GET['id_riferimento']; else $id_riferimento = "";
if(isset($_GET['id_rec'])) $id_rec = $_GET['id_rec']; else $id_rec = "";

$new_slug = to_htaccess_url($slug,"");

$query_ed = "SELECT anno, nome_regata FROM edizioni_regate WHERE id='$id_riferimento'";
$resu_ed = $open_connection->connection->query($query_ed);
list($anno_ed, $nome_ed) = $resu_ed->fetch();

$query_slug = "SELECT slug FROM edizioni_iscritti WHERE id_edizione='$id_riferimento' AND slug='$new_slug'";
if($id_rec!="") $query_slug .= " AND id<>'$id_rec'";
/*echo $query_slug;*/
$resu_slug = $open_connection->connection->query($query_slug);
$num_slug = $resu_slug->rowCount();


echo $http."://".$ind_sito."/regate-$anno_ed/".to_htaccess_url($nome_ed,"")."-1212/entry_list/".to_htaccess_url($new_slug,"")."<br/>";
echo "<b>CHECK:</b> ";
if($num_slug==0){
	echo '<span style="color:green"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
	echo '<input name="slugcheck" type="hidden" value="1" id="slugcheck">';
}else{
	echo '<span style="color:red"><i class="fa fa-circle" aria-hidden="true"></i></span>';
	echo '<input name="slugcheck" type="hidden" value="0" id="slugcheck">';
}
?>