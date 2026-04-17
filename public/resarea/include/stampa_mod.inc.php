<?php 
$table="stampa";
$rif="";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_tit = $arr_rec['titolo'];
$n_tit_eng = $arr_rec['titolo_eng'];
$n_testo = $arr_rec['descr'];
$n_testo_eng = $arr_rec['descr_eng'];
$n_data = $oggetto_admin->date_to_data($arr_rec['data_stampa']);
$n_foto = $arr_rec['img'];
$n_video = $arr_rec['video'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=stampa<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){		
		if (document.inserimento.titolo.value=="") alert('Titolo obbigatorio');	
			/*else if (document.inserimento.data_mod.value=="") alert('Data obbligatoria');
			else if (document.inserimento.testo.value=="") alert('Testo obbligatorio');*/
			else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/stampa/$cancimg")){unlink("img_up/stampa/$cancimg");}
	if(is_file("img_up/stampa/s_$cancimg")){unlink("img_up/stampa/s_$cancimg");}
	if(is_file("files/stampa/$cancimg")){unlink("files/stampa/$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=stampa_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['data_mod']=1;
	$arr_thumb['img']=150;
		
	$_POST['titolo']=str_replace('"',"''",$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"',"''",$_POST['titolo_eng']);
	
	$_POST['descr']=str_replace('"',"'",$_POST['descr']);
	$_POST['descr_eng']=str_replace('"',"'",$_POST['descr_eng']);
	
	if (isset($_POST['data_mod'])) $data_mod = $oggetto_admin->date_to_data($_POST['data_mod']);
		else $data_mod = "";
			
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/stampa");
	
	if ($data_mod!="") $open_connection->connection->query("update stampa set data_stampa='$data_mod' where id='$id_rec'");
	
?>
	<script language="javascript">
		window.location='admin.php?cmd=stampa<?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:30px;font-size:1.2em;padding-top:10px">Modifica Articolo in <b>Ufficio Stampa</b></div>
	<!--<div style="height:30px;text-align:right"><a style="color:#000" href="admin.php?cmd=edizioni<?php echo $rif;?>"><< Torna all'elenco delle edizioni</a></div>-->
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=stampa_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Titolo (Italiano)" , "titolo" , "$n_tit"  , "1", 'no', "$cmd", "$id_rec");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Titolo (Inglese)</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="titolo_eng" value="<?php  echo $n_tit_eng; ?>"/>
						<a href="admin.php?cmd=stampa_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=titolo_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</div>
				</div>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Data</label>
						<div class="mws-form-item">
							<input type="text" name="data_mod" class="mws-datepicker large"  value="<?php echo $n_data;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Foto generale (Anteprima)" , "img" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/stampa");
				?>		
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Italiano)</label>
					<div class="mws-form-item">
						<div class="btn" style="float:left; background:#111; color:#fff; border:none;" onclick="vedi_foto('<?php echo $id_rec;?>')"><i class="fa fa-picture-o"></i> &nbsp;IMMAGINI</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_video('<?php echo $id_rec;?>')"><i class="fa fa-play"></i> &nbsp;VIDEO</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_instagram('<?php echo $id_rec;?>')"><i class="fa fa-instagram"></i> &nbsp;INSTAGRAM</div>
						<div style="clear:both; height:10px;"></div>
						<textarea class="ckeditor" name="descr"><?php  echo $n_testo; ?></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Inglese)</label>
					<div class="mws-form-item">
						<div class="btn" style="float:left; background:#111; color:#fff; border:none;" onclick="vedi_foto('<?php echo $id_rec;?>')"><i class="fa fa-picture-o"></i> &nbsp;IMMAGINI</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_video('<?php echo $id_rec;?>')"><i class="fa fa-play"></i> &nbsp;VIDEO</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_instagram('<?php echo $id_rec;?>')"><i class="fa fa-instagram"></i> &nbsp;INSTAGRAM</div>
						<div style="clear:both; height:10px;"></div>
						<textarea class="ckeditor" name="descr_eng"><?php  echo $n_testo_eng; ?></textarea>
						<a href="admin.php?cmd=stampa_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=descr_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Link video su YouTube</label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="video" value="<?php  echo $n_video; ?>"/>
						<a href="admin.php?cmd=stampa_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=video<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</div>
				</div>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
				<div style="margin-left:20px; padding-bottom:10px;"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
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

<script type="text/javascript">
	function vedi_foto(id_news){
		$("#box_img").fadeIn();
		document.getElementById('frame_img').src="frame/foto_news.php?id_news="+id_news;	
	}
	function vedi_video(id_news){
		$("#box_img").fadeIn();
		document.getElementById('frame_img').src="frame/video_news.php?id_news="+id_news;	
	}
	function vedi_instagram(id_news){
		$("#box_img").fadeIn();
		document.getElementById('frame_img').src="frame/instagram_news.php?id_news="+id_news;	
	}
</script>
<?php 
}
?>
