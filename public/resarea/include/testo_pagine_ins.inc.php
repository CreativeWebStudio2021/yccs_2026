<?php 
if(isset($_GET['pagina'])) $pagina=$_GET['pagina']; else $pagina="";
$table="testo_pagine";
$rif="&pagina=$pagina";

$query="SELECT * FROM testo_pagine WHERE pagina='$pagina'";
$resu=$open_connection->connection->query($query);
$num=$resu->rowCount();
$risu=$resu->fetch();
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=testo_pagine<?php  echo $rif; ?>';
	}
</script>

<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/regate/$cancimg")){unlink("img_up/regate/$cancimg");}
	if(is_file("img_up/regate/s_$cancimg")){unlink("img_up/regate/s_$cancimg");}
	if(is_file("img_up/regate/1200_$cancimg")){unlink("img_up/regate/1200_$cancimg");}
	if(is_file("img_up/regate/800_$cancimg")){unlink("img_up/regate/800_$cancimg");}
	if(is_file("img_up/regate/400_$cancimg")){unlink("img_up/regate/400_$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=testo_pagine_ins&pagina=<?php echo $pagina;?>';
	</script>	
<?php 
}
		
if($stato=="inviato")
{
	$_POST['testo']=str_replace('"',"'",$_POST['testo']);
	$_POST['testo_eng']=str_replace('"',"'",$_POST['testo_eng']);

	$arr_no['stato']=1;
	if($num==0){
		$oggetto_admin->inserisci_campi ("$table" , $arr_no ,  $arr_thumb="no");
	}else{		
		$oggetto_admin->modifica_campi ("$table" ,$risu['id'] , $arr_no ,  $arr_thumb);	
	}	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=testo_pagine<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{

?>



<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Testo della pagina <b><?php echo str_replace("_"," ",$pagina);?></b><!-- (Dim. img 1920 x 1280 pixel)--></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=testo_pagine<?php  echo $rif; ?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle pagine</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=testo_pagine_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">			
			<input type="hidden" name="pagina" value="<?php echo $pagina;?>">			
			<div style="height:10px">&nbsp;</div>
			<?php if($num==0){?>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo Pagina (Italiano)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo"></textarea>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Testo Pagina (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_eng"></textarea>
					</div>
				</div>
			<?php }else{?>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo Pagina (Italiano)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo"><?php  echo $risu['testo']; ?></textarea>
						<a href="admin.php?cmd=testo_pagine_ins&id_rec=<?php  echo $risu['id']; ?>&campocanc=testo<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo Pagina (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_eng"><?php  echo $risu['testo_eng']; ?></textarea>
						<a href="admin.php?cmd=testo_pagine_ins&id_rec=<?php  echo $risu['id']; ?>&campocanc=testo_eng<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			<?php }?>
			
			<div class="mws-button-row">
				<input type="submit" value="<?php if($num==0){?>Inserisci<?php }else{?>Modifica<?php }?>" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
