<?php 
require_once '../config/dbnew.php';	

if(isset($_GET['argomento'])) $argomento = $_GET['argomento']; else $argomento = "";
if(isset($_GET['id_sottocat_ric'])) $id_sottocat_ric = $_GET['id_sottocat_ric']; else $id_sottocat_ric = "";
if(isset($_GET['rif'])) $rif = $_GET['rif']; else $rif = "";
if(isset($_GET['id_rec'])) $id_rec = $_GET['id_rec']; else $id_rec = "";
?>

<select name="id_sottocat" class="small">
	<option value="">Seleziona</option>
	<?php 
	$query_c="SELECT * FROM sail_talk_categorie WHERE id_cat='$argomento' ORDER BY ordine DESC";
	$resu_c=$open_connection->connection->query($query_c);
	while($risu_c=$resu_c->fetch()){?>
		<option value="<?php echo $risu_c['id'];?>" <?php if($risu_c['id']==$id_sottocat_ric){?>selected="selected"<?php }?>><?php echo $risu_c['nome'];?></option>
	<?php }?>					
</select>
&nbsp;<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=id_sottocat<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>