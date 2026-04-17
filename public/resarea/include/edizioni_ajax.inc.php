<?php 
session_start();

require_once '../config/dbnew.php';	


if(isset($_GET['id_regata'])) $id_regata=$_GET['id_regata']; else $id_regata="";
if(isset($_GET['id_edizione'])) $id_edizione=$_GET['id_edizione']; else $id_edizione="";

$num_sotto=0;
if($id_regata!="" && $id_regata!=0){
	$query_ed="SELECT anno, id FROM edizioni_regate WHERE id_regata='$id_regata' ORDER BY anno DESC";
	$resu_ed=$open_connection->connection->query($query_ed);
	$num_ed=$resu_ed->rowCount();
}

if($id_regata!="" && $id_regata!=0 && $num_ed>0){?>

	<label class="mws-form-label">Edizione Regata *</label>
		<div class="mws-form-item" >						
			<select name="id_edizione">
				<option value="">Seleziona</option>
				<?php 
				while($risu_ed=$resu_ed->fetch()){?>
					<option value="<?php echo $risu_ed['id'];?>" <?php if($id_edizione==$risu_ed['id']){?>selected="selected"<?php }?>><?php echo $risu_ed['anno'];?></option>
				<?php }?>					
			</select>
		</div>

<?php }else{?>
	
<?php }?>