<?php 
$table="press";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";

if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if($id_riferimento!="") $rif.="&id_riferimento=$id_riferimento";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=press<?php  echo $rif; ?>';
	}
</script>

<script language="javascript">
	function verifica(){
		/*if (document.inserimento.titolo.value=="") alert('Titolo obbigatorio');	
			else*/ if (document.inserimento.data_mod.value=="") alert('Data obbligatoria');
			/*else if (document.inserimento.testo.value=="") alert('Testo obbligatorio');*/
			else document.inserimento.submit();
	}
</script>
<?php 
		
if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['data_mod']=1;
	$arr_thumb['foto1']=150;
	$arr_thumb['foto2']=150;
	
	$_POST['titolo']=str_replace('"',"''",$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"',"''",$_POST['titolo_eng']);
	
	//$_POST['testo']=str_replace('"',"'",$_POST['testo']);
	//$_POST['testo_eng']=str_replace('"',"'",$_POST['testo_eng']);
	
	if (isset($_POST['data_mod'])) $data_mod = $oggetto_admin->date_to_data($_POST['data_mod']);
		else $data_mod = "";
	
	$id_ultimo = $oggetto_admin->inserisci_campi ("press" , $arr_no ,  $arr_thumb, "img_up/regate/press");
		
	if ($data_mod!="") $open_connection->connection->query("update press set data='$data_mod' where id='$id_ultimo'");
	
	/* aggiungo una news con lo stesso contenuto della press appena inserita */
	$ord_n = $oggetto_admin->trova_ordine("news");
	
	$foto1_n = "";
	$query_f = "select foto1 from press where id='$id_ultimo'";
	$risu_f = $open_connection->connection->query($query_f);
	if ($risu_f) list($foto1_n) = $risu_f->fetch();
	
	if ($data_mod!="") $query_n = "insert into news (ordine,id_rife,data_news,titolo,titolo_eng,img,testo,testo_eng) values ('$ord_n','$id_ultimo','$data_mod',\"".$_POST['titolo']."\",\"".$_POST['titolo_eng']."\",'$foto1_n',\"".str_replace('"','\"',$_POST['testo'])."\",\"".str_replace('"','\"',$_POST['testo_eng'])."\")";
		else $query_n = "insert into news (ordine,id_rife,titolo,titolo_eng,img,testo,testo_eng) values ('$ord_n','$id_ultimo',\"".$_POST['titolo']."\",\"".$_POST['titolo_eng']."\",'$foto1_n',\"".str_replace('"','\"',$_POST['testo'])."\",\"".str_replace('"','\"',$_POST['testo_eng'])."\")";
	$risu_n = $open_connection->connection->query($query_n);
	
	echo $query_n."<br/>";
?>
	<script language="javascript">
		window.location = "admin.php?cmd=press<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{
$nome_reg = "";
$query_reg = "select nome from regate where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
if ($risu_reg) list($nome_reg) = $risu_reg->fetch();

$anno_ed = "";
$query_ed = "select anno from edizioni_regate where id='$id_riferimento'";
$risu_ed = $open_connection->connection->query($query_ed);
if ($risu_ed) list($anno_ed) = $risu_ed->fetch();
?>

<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci Articolo della regata <b><?php  echo ucfirst($nome_reg); ?></b> - <b>Edizione <?php  echo $anno_ed; ?></b><!-- (Dim. img 1920 x 1280 pixel)--></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=press<?php echo $rif;?>" style="color:#7a7a7a">
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=press_ins<?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<input type="hidden" name="id_regata" value="<?php echo $id_rife;?>">
			<input type="hidden" name="id_edizione" value="<?php echo $id_riferimento;?>">
			<?php 
			/*$ord_ev = $oggetto_admin->trova_ordine2("$table", "id_regata", $id_rife, "id_edizione", $id_riferimento);
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';*/
			?>
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_ins("Titolo (Italiano)" , "titolo" , "1", 'no');
				$oggetto_admin->campo_ins("Titolo (Inglese)" , "titolo_eng" , "1", 'no');
				?>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Data *</label>
						<div class="mws-form-item">
							<input type="text" name="data_mod" class="mws-datepicker large"  value="" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Foto 1" , "foto1" , "4", 'no');
				$oggetto_admin->campo_ins("Foto 2" , "foto2" , "4", 'no');
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Italiano)</label>
					<div class="mws-form-item">
						<div class="btn" style="float:left; background:#111; color:#fff; border:none;" onclick="vedi_foto('<?php echo $id_rec;?>')"><i class="fa fa-picture-o"></i> &nbsp;IMMAGINI</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_video('<?php echo $id_rec;?>')"><i class="fa fa-play"></i> &nbsp;VIDEO</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_instagram('<?php echo $id_rec;?>')"><i class="fa fa-instagram"></i> &nbsp;INSTAGRAM</div>
						<div style="clear:both; height:10px;"></div>
						<textarea class="ckeditor" name="testo"></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Inglese)</label>
					<div class="mws-form-item">
						<div class="btn" style="float:left; background:#111; color:#fff; border:none;" onclick="vedi_foto('<?php echo $id_rec;?>')"><i class="fa fa-picture-o"></i> &nbsp;IMMAGINI</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_video('<?php echo $id_rec;?>')"><i class="fa fa-play"></i> &nbsp;VIDEO</div>
						<div class="btn" style="float:left; margin-left:10px; background:#111; color:#fff; border:none;" onclick="vedi_instagram('<?php echo $id_rec;?>')"><i class="fa fa-instagram"></i> &nbsp;INSTAGRAM</div>
						<div style="clear:both; height:10px;"></div>
						<textarea class="ckeditor" name="testo_eng"></textarea>
					</div>
				</div>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>	
			</div>
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
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
