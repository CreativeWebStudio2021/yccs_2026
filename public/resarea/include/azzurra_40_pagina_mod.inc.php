<?php 
$id_rec=1;
$query_rec = "select * from azzurra_40 where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_foto_testata = $arr_rec['foto_testata'];
$n_testo_1 = $arr_rec['testo_1'];
$n_testo_1_eng = $arr_rec['testo_1_eng'];
$n_testo_2 = $arr_rec['testo_2'];
$n_testo_2_eng = $arr_rec['testo_2_eng'];
$n_testo_3 = $arr_rec['testo_3'];
$n_testo_3_eng = $arr_rec['testo_3_eng'];
$n_video = $arr_rec['video'];
$n_foto_sotto = $arr_rec['foto_sotto'];

$rif="";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=azzurra_40_pagina_mod<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		/*if (document.gino.titolo.value=="") alert('Titolo obbigatorio');
		else if (document.gino.data_mod.value=="") alert('Data obbigatoria');
		else if (document.gino.descrizione.value=="") alert('Testo obbigatorio');
		else*/ document.gino.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from azzurra_40 where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/azzurra_40/$cancimg")){unlink("img_up/azzurra_40/$cancimg");}
	if(is_file("img_up/azzurra_40/s_$cancimg")){unlink("img_up/azzurra_40/s_$cancimg");}
	
	$query_canc_img = "update azzurra_40 set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=azzurra_40_pagina_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['foto_testata']=400; 
	$arr_thumb['foto_sotto']=400; 

	$oggetto_admin->modifica_campi ("azzurra_40" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/azzurra_40");
?>
	<script language="javascript">
		window.location = "admin.php?cmd=azzurra_40_pagina_mod<?php echo $rif;?>" ;
	</script>
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Azzurra 40</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=azzurra_40_pagina_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Foto Testata<br /><i>(Dim. 150x75 pixel)</i>" , "foto_testata" , "$n_foto_testata"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/azzurra_40");
				?>
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Testo 1 (Italiano)
						<?php if($n_testo_1!=""){?>
							<br/><a href="admin.php?cmd=azzurra_40_pagina_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_1<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
						<?php }?>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_1"><?php  echo $n_testo_1; ?></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">
						Testo 1 (Inglese)
						<?php if($n_testo_1_eng!=""){?>
							<br/><a href="admin.php?cmd=azzurra_40_pagina_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_1_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
						<?php }?>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_1_eng"><?php  echo $n_testo_1_eng; ?></textarea>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Codice Vimeo Video Grande" , "video" , "$n_video"  , "1", 'no', "$cmd", "$id_rec", "", "", "","",'0');
				?>
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Testo 2 (Italiano)
						<?php if($n_testo_2!=""){?>
							<br/><a href="admin.php?cmd=azzurra_40_pagina_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_2<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
						<?php }?>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_2"><?php  echo $n_testo_2; ?></textarea>
					</div>
				</div>
				
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Testo 2 (Inglese)
						<?php if($n_testo_2_eng!=""){?>
							<br/><a href="admin.php?cmd=azzurra_40_pagina_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_2_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
						<?php }?>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_2_eng"><?php  echo $n_testo_2_eng; ?></textarea>
					</div>
				</div>
												
								
				<div class="mws-form-row">
					<label class="mws-form-label">
						Testo 3 (Italiano)				
						<?php if($n_testo_3!=""){?>
							<br/>	<a href="admin.php?cmd=azzurra_40_pagina_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_3<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
						<?php }?>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_3"><?php  echo $n_testo_3; ?></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">
						Testo 3 (Inglese)
						<?php if($n_testo_3_eng!=""){?>
							<br/><a href="admin.php?cmd=azzurra_40_pagina_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_3_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
						<?php }?>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_3_eng"><?php  echo $n_testo_3_eng; ?></textarea>
					</div>
				</div>
				
				<?php $oggetto_admin->campo_mod("Foto<br /><i>(Dim. 150x75 pixel)</i>" , "foto_sotto" , "$n_foto_sotto"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/azzurra_40");?>
				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
	
</div>

<div style="position:fixed; width:1100px; height:700px; background:#fff; top:50%; left:50%; display:none; border:solid 1px #808080; border-radius:2px; text-align:center;  margin-left:-550px; margin-top:-320px; z-index:0000000; box-shadow:5px 5px 5px #808080" id="box_img">
	<iframe src="" style="width:1100px; height:700px; margin-top:5px;" id="frame_img" frameborder=0 ></iframe>
	<div style="position:absolute; top:15px; right:25px; width:20px; height:20px; cursor:pointer; text-align:center;" onclick="document.getElementById('box_img').style.display='none';">
		<i class="fa fa-times-circle fa-2x"></i>		
	</div>
</div>

<?php 
}
?>
