<?php 
$table="members_gallery";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";

$query_rec = "select * from members_gallery where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_foto = $arr_rec['img'];
$n_testo_link = $arr_rec['testo_link'];
$n_testo_link_eng = $arr_rec['testo_link_eng'];
$n_testo1 = $arr_rec['testo1_link'];
$n_testo1_eng = $arr_rec['testo1_link_eng'];
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=members_gallery<?php  echo $rif; ?>';
	}
</script>

<script language="javascript">
	function verifica(){
		var foto = document.gino.img.value;
		var foto_old = "<?php  echo $n_foto; ?>";
				
		if (foto=="" && foto_old=="") alert('Foto obbigatoria');
						
		else document.gino.submit();
	}
</script>
<?php 

if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from members_gallery where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/members_gallery/$cancimg")){unlink("img_up/members_gallery/$cancimg");}
	if(is_file("img_up/members_gallery/s_$cancimg")){unlink("img_up/members_gallery/s_$cancimg");}
	if (is_file("img_up/members_gallery/xs_$foto")) @unlink("img_up/members_gallery/xs_$foto");
	if (is_file("img_up/members_gallery/m_$foto")) @unlink("img_up/members_gallery/m_$foto");
	if (is_file("img_up/members_gallery/l_$foto")) @unlink("img_up/members_gallery/l_$foto");
	if (is_file("img_up/members_gallery/xl_$foto")) @unlink("img_up/members_gallery/xl_$foto");
	
	$query_canc_img = "update members_gallery set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=members_gallery_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['img']="400"; 
	
	$_POST['testo_link']=str_replace('"','\"',$_POST['testo_link']);
	$_POST['n_testo_link_eng']=str_replace('"','\"',$_POST['n_testo_link_eng']);
	$_POST['n_testo1']=str_replace('"','\"',$_POST['n_testo1']);
	$oggetto_admin->modifica_campi ("members_gallery" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/members_gallery");
	
	
	$query_f="SELECT img FROM members_gallery WHERE id='$id_rec'";
	$resu_f=$open_connection->connection->query($query_f);
	list($nome_f)=$resu_f->fetch();
	$oggetto_admin->thumbjpg( "300" ,  "img_up/members_gallery/".$nome_f ,$nome_f, $dir_imm="img_up/members_gallery", $start="xs_" );
	$oggetto_admin->thumbjpg( "600" ,  "img_up/members_gallery/".$nome_f ,$nome_f, $dir_imm="img_up/members_gallery", $start="m_" );
	$oggetto_admin->thumbjpg( "800" ,  "img_up/members_gallery/".$nome_f ,$nome_f, $dir_imm="img_up/members_gallery", $start="l_" );
	$oggetto_admin->thumbjpg( "1200" ,  "img_up/members_gallery/".$nome_f ,$nome_f, $dir_imm="img_up/members_gallery", $start="xl_" );
	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=members_gallery<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Foto della Gallery per Young Azzurra</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=members_gallery_mod&id_rec=<?php  echo $id_rec; ?><?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
			<?php 
			$oggetto_admin->campo_mod("Foto *<br /><i>(Dim. 1920 x 1280 pixel)</i>" , "img" , $n_foto  , "4", 'no', $cmd, "$id_rec", "", "", "img_up/members_gallery");
			?>
				<div class="mws-form-row">
					<label class="mws-form-label">Titolo (Italiano)<br /><i>Max. 25 caratteri</i></label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_link" value="<?php  echo $n_testo_link; ?>" maxlength="25"/>
						<a href="admin.php?cmd=members_gallery_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_link<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Titolo (Inglese)<br /><i>Max. 25 caratteri</i></label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo_link_eng" value="<?php  echo $n_testo_link_eng; ?>" maxlength="25"/>
						<a href="admin.php?cmd=members_gallery_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo_link_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Nome fotografo<br /><i>Max. 25 caratteri</i></label>
					<div class="mws-form-item">
						<input type="text" class="medium" name="testo1_link" value="<?php  echo $n_testo1; ?>" maxlength="25"/>
						<a href="admin.php?cmd=members_gallery_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=testo1_link<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
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
<?php 
}
?>
