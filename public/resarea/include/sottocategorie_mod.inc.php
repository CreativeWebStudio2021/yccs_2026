<?php 
$table="sottocategorie";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_nome = $arr_rec['nome'];
$n_nome_eng = $arr_rec['nome_eng'];
$n_rife = $arr_rec['id_rife'];
/*$n_img = $arr_rec['img'];*/
$n_cat = $arr_rec['categoria_google'];

$rif="";
if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";
?>

<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.nome.value=="") alert('Nome obbigatorio');					
		else document.inserimento.submit();
	}
</script>
<?php 


if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['foto']="120"; 
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);

	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb );
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica <?php echo $table;?></b></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle <?php echo $table;?></b>
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
					<label class="mws-form-label">Categoria *</label>
					<div class="mws-form-item">
						<select name="id_rife" class="small">
							<option value="">Seleziona</option>
							<?php 
							$query_cat="SELECT * FROM categorie ORDER BY ordine DESC";
							$resu_cat=$open_connection->connection->query($query_cat);
							while($risu_cat=$resu_cat->fetch()){?>
								<option value="<?php echo $risu_cat['id'];?>" <?php if($n_rife==$risu_cat['id']){?>selected="selected"<?php }?>><?php echo $risu_cat['nome'];?></option>
							<?php }?>					
						</select>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Nome (in Italiano) *" , "nome" , "$n_nome"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Nome (in Inglese) *" , "nome_eng" , "$n_nome_eng"  , "1", 'no', "$cmd", "$id_rec");
				?>
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
