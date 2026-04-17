<?php 
if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife="";
$table="ya_gallery";
$rif="&id_rife=$id_rife";

$query="SELECT * FROM ya_gallery WHERE id='$id_rife'";
$resu=$open_connection->connection->query($query);
$num=$resu->rowCount();
$risu=$resu->fetch();

$n_titolo = $risu['titolo'];
$n_titolo_eng = $risu['titolo_eng'];
$n_id_rife = $risu['id_rife'];
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=ya_gallery<?php  echo $rif; ?>';
	}
</script>

<?php 
if($campocanc!="")
{		
	$query_canc_img = "update $table set $campocanc=NULL where id='$id_rife'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=ya_gallery_mod&id_rife=<?php echo $id_rife;?>';
	</script>	
<?php 
}
		
if($stato=="inviato")
{
	$_POST['testo']=str_replace('"',"'",$_POST['testo']);
	$_POST['testo_eng']=str_replace('"',"'",$_POST['testo_eng']);
	$_POST['titolo']=str_replace('"',"'",$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"',"'",$_POST['titolo_eng']);

	$arr_no['stato']=1;
	$oggetto_admin->modifica_campi ("$table" ,$risu['id'] , $arr_no);	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=ya_gallery<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{

?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Modifica Gallery Young Azzurra</div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=ya_gallery<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle gallery</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=ya_gallery_mod<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">					
			<div style="height:10px">&nbsp;</div>
			
			<div class="mws-form-row">
				<label class="mws-form-label">Categoria</label>
				<div class="mws-form-item">
					<select name="id_rife">
						<option value="">Seleziona...</option>
						<?php 
						$query_cat="SELECT * FROM ya_gallery_cat ORDER BY nome ASC";
						$resu_cat=$open_connection->connection->query($query_cat);
						while($risu_cat=$resu_cat->fetch()){?>
							<option value="<?php echo $risu_cat['id'];?>" <?php if(isset($n_id_rife) && $risu_cat['id']==$n_id_rife){?>selected="selected"<?php }?>><?php echo $risu_cat['nome'];?></option>
						<?php }?>
					</select>
					<a href="admin.php?cmd=ya_gallery_mod&campocanc=id_rife<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>
			</div>
			<?php 
			$oggetto_admin->campo_mod("Titolo (Italiano)" , "titolo" , "$n_titolo"  , "1", 'no', "$cmd", "$id_rife");
			?>
			<div class="mws-form-row">
				<label class="mws-form-label">Titolo (Inglese)</label>
				<div class="mws-form-item">
					<input type="text" class="medium" name="titolo_eng" value="<?php  echo $n_titolo_eng; ?>"/>
					<a href="admin.php?cmd=ya_gallery_mod&campocanc=titolo_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>
			</div>
			
			<div class="mws-form-row">
				<label class="mws-form-label">Testo (Italiano)</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo"><?php  echo $risu['testo']; ?></textarea>
					<a href="admin.php?cmd=ya_gallery_mod&campocanc=testo<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="mws-form-row">
				<label class="mws-form-label">Testo (Inglese)</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo_eng"><?php  echo $risu['testo_eng']; ?></textarea>
					<a href="admin.php?cmd=ya_gallery_mod&campocanc=testo_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>
			</div>
			
			
			<div class="mws-button-row">
				<input type="submit" value="Modifica" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
