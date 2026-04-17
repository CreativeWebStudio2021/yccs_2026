<?php 
$query_rec = "select * from news where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_tit = $arr_rec['titolo'];
$n_tit_eng = $arr_rec['titolo_eng'];
$n_foto = $arr_rec['img'];
$n_data = $oggetto_admin->date_to_data($arr_rec['data_news']);
$n_testo = $arr_rec['testo'];
$n_testo_eng = $arr_rec['testo_eng'];

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=members_news<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.gino.titolo.value=="") alert('Titolo obbigatorio');
		else if (document.gino.data_mod.value=="") alert('Data obbigatoria');
		/*else if (document.gino.descrizione.value=="") alert('Testo obbigatorio');*/
		else document.gino.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from news where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}
	
	$query_canc_img = "update news set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=members_news_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['data_mod']=1;
	/*$arr_no['data_news_giorni']=1;
	$arr_no['data_news_mesi']=1;
	$arr_no['data_news_anni']=1;*/
	$arr_thumb['img']=150; 
	
	//$_POST['titolo']=str_replace('"','\"',$_POST['titolo']);
	//$_POST['titolo_eng']=str_replace('"','\"',$_POST['titolo_eng']);
	//$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	//$_POST['testo_eng']=str_replace('"','\"',$_POST['testo_eng']);
	
	if(isset($_POST['testo'])){
		$temp = explode('<img alt="" src="',$_POST['testo']);
		for($i=1; $i<count($temp); $i++){
			$temp2 = explode('"',$temp[$i]);
			$img = $temp2[0];
			$temp2 = explode(' />',$temp[$i]);
			$tag_img = '<img alt="" src="'.$temp2[0].' />';
			$tag_img_new = '<img alt="" src="'.$img.'" style="width:86%;  margin:20px 0; margin-left:7%; "/>';
			$_POST['testo'] = str_replace($tag_img,$tag_img_new,$_POST['testo']);
		}
	}
	
	if(isset($_POST['testo_eng'])){
		$temp = explode('<img alt="" src="',$_POST['testo_eng']);
		for($i=1; $i<count($temp); $i++){
			$temp2 = explode('"',$temp[$i]);
			$img = $temp2[0];
			$temp2 = explode(' />',$temp[$i]);
			$tag_img = '<img alt="" src="'.$temp2[0].' />';
			$tag_img_new = '<img alt="" src="'.$img.'" style="width:86%;  margin:20px 0; margin-left:7%; "/>';
			$_POST['testo_eng'] = str_replace($tag_img,$tag_img_new,$_POST['testo_eng']);
		}
	}
	
	if (isset($_POST['data_mod'])) $data_mod = $oggetto_admin->date_to_data($_POST['data_mod']);
		else $data_mod = "";

	$oggetto_admin->modifica_campi ("news" ,$id_rec , $arr_no ,  $arr_thumb);
	
	if ($data_mod!="") $open_connection->connection->query("update news set data_news='$data_mod' where id='$id_rec'");
	
	$query_f="SELECT img FROM news WHERE id='$id_rec'";
	$resu_f=$open_connection->connection->query($query_f);
	list($nome_f)=$resu_f->fetch();
	if($nome_f && trim($nome_f)!=""){
		$oggetto_admin->thumbjpg( "300" ,  "img_up/".$nome_f ,$nome_f, $dir_imm="img_up/", $start="m_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/".$nome_f ,$nome_f, $dir_imm="img_up/", $start="l_" );
		$oggetto_admin->thumbjpg( "650" ,  "img_up/".$nome_f ,$nome_f, $dir_imm="img_up/", $start="xl_" );
		$oggetto_admin->thumbjpg( "900" ,  "img_up/".$nome_f ,$nome_f, $dir_imm="img_up/", $start="xxl_" );
	}
?>
	<script language="javascript">
		window.location = "admin.php?cmd=members_news<?php echo $rif;?>" ;
	</script>
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica articolo</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=members_news<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco degli articoli</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=members_news_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
			<?php 
			$oggetto_admin->campo_mod("Titolo (Italiano)*" , "titolo" , "$n_tit"  , "1", 'no', "$cmd", "$id_rec");
			/*$oggetto_admin->campo_mod("Data *" , "data_news" , "$n_data"  , "7", 'no', "$cmd", "$id_rec");*/
			?>
			<div class="mws-form-row">
				<label class="mws-form-label">Titolo (Inglese)</label>
				<div class="mws-form-item">
					<input type="text" class="medium" name="titolo_eng" value="<?php  echo $n_tit_eng; ?>"/>
					<a href="admin.php?cmd=members_news_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=titolo_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Data *</label>
					<div class="mws-form-item">
						<input type="text" name="data_mod" class="mws-datepicker large"  value="<?php echo $n_data;?>" readonly="readonly" style="width:20%">
					</div>
				</div>
			</div>
			<?php 
			$oggetto_admin->campo_mod("Foto<br /><i>(Dim. 150x75 pixel)</i>" , "img" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec");
			?>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Italiano)*</label>
					<div class="mws-form-item">
						<div class="btn" style="float:left; background:#111; color:#fff; border:none;" onclick="vedi_foto('<?php echo $id_rec;?>')"><i class="fa fa-picture-o"></i> &nbsp;IMMAGINI</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_video('<?php echo $id_rec;?>')"><i class="fa fa-play"></i> &nbsp;VIDEO</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_instagram('<?php echo $id_rec;?>')"><i class="fa fa-instagram"></i> &nbsp;INSTAGRAM</div>
						<div style="clear:both; height:10px;"></div>
						<textarea class="ckeditor" name="testo"><?php  echo $n_testo; ?></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Inglese)</label>
					<div class="mws-form-item">
						<div class="btn" style="float:left; background:#111; color:#fff; border:none;" onclick="vedi_foto('<?php echo $id_rec;?>')"><i class="fa fa-picture-o"></i> &nbsp;IMMAGINI</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_video('<?php echo $id_rec;?>')"><i class="fa fa-play"></i> &nbsp;VIDEO</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_instagram('<?php echo $id_rec;?>')"><i class="fa fa-instagram"></i> &nbsp;INSTAGRAM</div>
						<div style="clear:both; height:10px;"></div>
						<textarea class="ckeditor" name="testo_eng"><?php  echo $n_testo_eng; ?></textarea>
						<a href="admin.php?cmd=members_news_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_eng<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>
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
