<?php 
require_once '../config/db.php';	

$query="SELECT * FROM edizioni_regate";
$resu=mysql_query($query);
while($risu=mysql_fetch_array($resu)){
	$query_ins="INSERT INTO edizioni_loghi (id_regata, id_edizione, ordine, img) VALUES ('".$risu['id_regata']."','".$risu['id']."','2','rolex_logo.jpg')";
	$risu_ins=mysql_query($query_ins);
	//echo $query_ins."<br/>";
	$query_ins="INSERT INTO edizioni_loghi (id_regata, id_edizione, ordine, img) VALUES ('".$risu['id_regata']."','".$risu['id']."','1','audi_logo.jpg')";
	$risu_ins=mysql_query($query_ins);
	//echo $query_ins."<br/><br/>";
}
?>