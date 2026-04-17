<?php 
require_once '../config/dbnew.php';	

if(isset($_GET['anno'])) $anno = $_GET['anno']; else $anno = "";
if(isset($_GET['id_regata'])) $id_regata = $_GET['id_regata']; else $id_regata = "";
if(isset($_GET['cmd'])) $cmd = $_GET['cmd']; else $cmd = "";
?>

<select name="id_regata" class="small">
	<option value="">Seleziona</option>
	<?php 
	$query_c="SELECT * FROM edizioni_regate WHERE anno='$anno' ORDER BY data_dal ASC";
	$resu_c=$open_connection->connection->query($query_c);
	while($risu_c=$resu_c->fetch()){?>
		<option value="<?php echo $risu_c['id'];?>" <?php if($risu_c['id']==$id_regata){?>selected="selected"<?php }?>><?php echo $risu_c['nome_regata'];?></option>
	<?php }?>					
</select>
<?php if($cmd=="sail_talk_articolo_mod"){?>
&nbsp;<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=id_regata<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
<?php }?>