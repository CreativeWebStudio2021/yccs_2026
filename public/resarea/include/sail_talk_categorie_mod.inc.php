<?php 
$table="sail_talk_categorie";

$rif="";
if(isset($_GET['id_cat'])) $id_cat=$_GET['id_cat']; else $id_cat='';
if($id_cat!="") $rif="&id_cat=$id_cat";
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_nome = $arr_rec['nome'];
$n_nome_eng = $arr_rec['nome_eng'];
$n_macro = $arr_rec['id_cat'];
/*$n_foto = $arr_rec['img'];
if ($campocanc!="descr") $n_descr = $arr_rec['descr'];	*/
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		/*var foto_old = "<?php echo $n_foto;?>";*/
		
		if (document.inserimento.id_cat.value=="") alert('Srgomento obbigatorio');
		else if (document.inserimento.nome.value=="") alert('Nome obbigatorio');
		/*else if (foto_old=="" && document.inserimento.img.value=="") alert('Immagine obbigatoria');*/
		else document.inserimento.submit();
	}
</script>
<?php 

/*if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/prodotti/categorie/$cancimg")){unlink("img_up/prodotti/categorie/$cancimg");}
	if(is_file("img_up/prodotti/categorie/s_$cancimg")){unlink("img_up/prodotti/categorie/s_$cancimg");}
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
}*/

if($stato=="inviato")
{
	$arr_no['stato']=1;
	/*$arr_thumb['img']=150;*/
		
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);
	$_POST['nome'] = str_replace("è", "&egrave;", $_POST['nome']);
	$_POST['nome'] = str_replace("é", "&eacute;", $_POST['nome']);
	$_POST['nome'] = str_replace("à", "&agrave;", $_POST['nome']);
	$_POST['nome'] = str_replace("ì", "&igrave;", $_POST['nome']);
	$_POST['nome'] = str_replace("ò", "&ograve;", $_POST['nome']);
	$_POST['nome'] = str_replace("ù", "&ugrave;", $_POST['nome']);
	
	$_POST['nome_eng']=str_replace('"','\"',$_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("è", "&egrave;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("é", "&eacute;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("à", "&agrave;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("ì", "&igrave;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("ò", "&ograve;", $_POST['nome_eng']);
	$_POST['nome_eng'] = str_replace("ù", "&ugrave;", $_POST['nome_eng']);		
	
	/*$_POST['descr']=str_replace('"','\"',$_POST['descr']);*/
	
	$oggetto_admin->modifica_campi ("$table", $id_rec, $arr_no, $arr_thumb="no");
	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" ;
	</script>
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica categoria</b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle categorie</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Argomento *</label>
					<div class="mws-form-item">
						<select name="id_cat" class="small">
							<option value="">Seleziona</option>
							<?php 
							$query_m="SELECT * FROM sail_talk_macrocategorie ORDER BY ordine DESC";
							$resu_m=$open_connection->connection->query($query_m);
							while($risu_m=$resu_m->fetch()){?>
								<option value="<?php echo $risu_m['id'];?>" <?php if($risu_m['id']==$n_macro) echo "selected=\"selected\"";?>><?php echo $risu_m['nome'];?></option>
							<?php }?>					
						</select>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Nome *" , "nome" , "$n_nome"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Nome (eng)" , "nome_eng" , "$n_nome_eng"  , "1", 'no', "$cmd", "$id_rec");
				/*$oggetto_admin->campo_mod("Immagine<br /><i>(Dim. ...x... pixel)</i>" , "img" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/prodotti/$table");*/
				?>
				<!--<div class="mws-form-row">
					<label class="mws-form-label">Descrizione</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descr"><?php  echo $n_descr; ?></textarea>
						<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php echo $id_rec;?>&campocanc=descr<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
					</div>
				</div>-->
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<!--<div style="margin-left:20px; padding-bottom:10px;"><i class="fa fa-eraser" aria-hidden="true"></i> <i>clicca sulla gomma a fianco dei campi non obbligatori per cancellarne il contenuto</i></div>-->
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
