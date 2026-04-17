<?php 

$stringa="User-agent: *\n";
$stringa.="Disallow: /area-soci/\n\n";
$stringa.="Disallow: /documenti/\n\n";
$stringa.="Disallow: /resarea/img_up/news_private/\n\n";
$stringa.="Disallow: /public/virgin_gorda/\n\n";

//require_once '../config/db.php';
//require_once '../config/dbnew.php';
//require_once '../fissi/functions.php';

$rec_pag="12";

$query="SELECT * FROM news_private";
$resu=$open_connection->connection->query($query);
$num=$resu->rowCount();
$pag_tot=ceil($num/$rec_pag);
for($i=1; $i<=$pag_tot; $i++){
	$stringa.="Disallow: /news_private_pag".$i.".html\n";
	$stringa.="Disallow: /en/news_private_pag".$i.".html\n";
	$start=($i-1)*$rec_pag;
	$query2="SELECT * FROM news_private LIMIT $start, $rec_pag";
	$resu2=$open_connection->connection->query($query2);
	while($risu2=$resu2->fetch()){
		//echo $risu['email']."<br/>";
		$link="news_private-pag".$i."/".to_htaccess_url($risu2['titolo'],"")."-".$risu2['id'].".html";
		$link_eng="news_private-pag".$i."/".to_htaccess_url($risu2['titolo_eng'],"")."-".$risu2['id'].".html";
		$stringa.="Disallow: /".$link."\n";
		$stringa.="Disallow: /"."en/".$link."\n";
		$stringa.="Disallow: /".$link_eng."\n";
		$stringa.="Disallow: /"."en/".$link_eng."\n";
	}
}

$query_stato="SELECT stato FROM magazine_stato WHERE id='1'";
$resu_stato=$open_connection->connection->query($query_stato);
list($stato)=$resu_stato->fetch();

$query_ele = "SELECT * FROM magazine_articolo WHERE 1";
$risu_ele = $open_connection->connection->query($query_ele);
$num_item=$risu_ele->rowCount();

for($x=0;$x<$num_item;$x++){	
	$arr_ele = $risu_ele->fetch();
	$tit = $arr_ele['titolo'];
	$visibile = $arr_ele['visibile'];
	$id_campo = $arr_ele['id'];
	$codice = $arr_ele['codice'];
	
	$stringa.="Disallow: /magazine/".$codice."-".$id_campo."\n";
	$stringa.="Disallow: /en/magazine/".$codice."-".$id_campo."\n";
}



	$fp = fopen("../robots.txt", "w+");
	fwrite($fp, $stringa);
	fclose($fp);

?>