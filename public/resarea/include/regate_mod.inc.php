<?php 
$table="regate";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_nome = $arr_rec['nome'];
$n_img = $arr_rec['logo'];

$rif="";
if(isset($_GET['nome_ric'])) $nome_ric=$_GET['nome_ric']; else $nome_ric='';
if($nome_ric!="") $rif.="&nome_ric=$nome_ric";
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
		var foto = '<?php echo $n_img;?>';
		if (document.inserimento.nome.value=="") alert('Nome obbigatorio');
			/*else if (foto=="" && document.inserimento.logo.value=="") alert('Logo obbigatorio');*/
			else document.inserimento.submit();
	}
</script>
<?php 

if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/regate/$cancimg")){unlink("img_up/regate/$cancimg");}
	if(is_file("img_up/regate/s_$cancimg")){unlink("img_up/regate/s_$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['logo']=250;
	
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);

	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/regate");
	
	$query_f="SELECT logo FROM regate WHERE id='$id_rec'";
	$resu_f=$open_connection->connection->query($query_f);
	list($nome_f)=$resu_f->fetch();
	$oggetto_admin->thumbjpg( "100" ,  "img_up/regate/".$nome_f ,$nome_f, $dir_imm="img_up/regate", $start="xs_" );
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica regata</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
			<?php 
				$oggetto_admin->campo_mod("Nome *" , "nome" , "$n_nome"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Logo" , "logo" , "$n_img"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/regate");
			?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
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
