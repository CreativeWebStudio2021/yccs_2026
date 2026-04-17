<?php 
$table="news_foto";
$file="foto_news";
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

$oggetto_frame = new Functions_adm($array_sito);

$rec_pag=20;

if(isset($_GET['id_news'])) $id_news=$_GET['id_news']; else $id_news="";

$rif="";
if($id_news!="") $rif="&id_news=$id_news";

$query_ele = "select * from news WHERE id='$id_news'";
$resu_ele = $open_connection->connection->query($query_ele);
$risu_ele=$resu_ele->fetch();
				
if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";

$oggetto_admin = new Functions_adm($array_sito);

if($stato=="inviato"){
	/*
	$arr_no['stato']=1;
	$arr_thumb['img']=400;
	$_POST['id_rife']=$id_news;	
	$oggetto_admin->inserisci_campi ("$table" , $arr_no, $arr_thumb, "../img_up/news_foto");
	?>
	<script language="javascript">
		//window.location = "<?php echo $_SERVER['REQUEST_URI'];?>" ;
	</script>
	<?php */
	for($x=0; $x<count ($_FILES['img']['name']); $x++){
		//echo "@".$_FILES['img']['name'][$x]."<br/>";
		
		$nome_file = $_FILES['img']['name'][$x];
		$temp_file = $_FILES['img']['tmp_name'][$x];
		
		if ($nome_file) {		
			
			$nome_file =  $oggetto_admin->scrivi_img($nome_file , $temp_file, "../img_up/news_foto");
			
			list($larghezza_gr , $height, $type, $attr) = getimagesize($temp_file);
			if ($larghezza_gr>1920) $oggetto_admin->thumbjpg_new(1920,$temp_file,$nome_file,"../img_up/news_foto");			
			if ($larghezza_gr>400) $oggetto_admin->thumbjpg(400,$temp_file,$nome_file,"../img_up/news_foto","s_");			
			
			$ord = $oggetto_admin->trova_ordine("$table");
			
			$query_ins_file = "insert into $table (img, id_rife, ordine) values ('$nome_file','0','$ord')";
			//echo $query_ins_file."<br/>";
			$risu_ins_file = $open_connection->connection->query($query_ins_file);
		}
	}
}

if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";



if ($id_canc) {
	if($azione=="sali") $oggetto_frame->sali("$table", "$id_canc", "id_rife", "$id_news") ;
	if($azione=="scendi") $oggetto_frame->scendi("$table", "$id_canc", "id_rife", "$id_news") ;
	if($azione=="primo") $oggetto_frame->primo("$table", "$id_canc", "id_rife", "$id_news") ;
	if($azione=="ultimo") $oggetto_frame->ultimo("$table", "$id_canc", "id_rife", "$id_news") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_frame->cambia("$table", "$id_canc", "$new_pos", "id_rife", "$id_news") ;	
	}
	/*
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $file;?><?php echo $rif;?>';
		</script>
	<?php }*/
}

if($azione=="cancella" && $id_canc!="") 
{	
	
	$query_canc_img = "select img from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($foto) = $risu_canc_img->fetch();
		if (is_file("../img_up/news_foto/$foto")) @unlink("../img_up/news_foto/$foto");
		if (is_file("../img_up/news_foto/$foto")) @unlink("../img_up/news_foto/s_$foto");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
	</script>
<?php 
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<title><?php  echo strtoupper($nome_del_sito);?> - admin</title>

<base href="<?php echo $http;?>://<?php  echo $ind_sito ?>/resarea/" /> 
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<link rel="icon" href="../img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon"/>

<script src="js/jquery.js"></script>

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="custom-plugins/wizard/wizard.css" media="screen">

<link rel="stylesheet" type="text/css" href="plugins/cleditor/jquery.cleditor.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol32.css" media="screen">

<link rel="stylesheet" type="text/css" href="css/login.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/themer.css" media="screen">

<script src="ckeditor/ckeditor.js"></script>

<script language="javascript">
	function verifica(){
		if (document.invia_comm.tipo_link.value=="") alert('Tipo Link obbigatorio');
		else if (document.invia_comm.testo_eng.value=="") alert('Testo (Inglese) obbigatorio');
		//else if (document.invia_comm.tipo_link.value=="link" && document.invia_comm.link_eng.value=="") alert('Link (Inglese) obbigatorio');
		//else if (document.invia_comm.tipo_link.value=="allegato" && document.invia_comm.allegato_eng.value=="") alert('Allegato (Inglese) obbigatorio');
		else document.invia_comm.submit();
	}
</script>

</head>

<body style="background:#fff">
 
	<div class="mws-panel grid_8">
		<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Foto News</b></div>

		<div id="start" style="display:none"></div>
		<div id="end" style="display:none"></div>
		<div id="total" style="display:none"></div>
		
		<div class="btn" onclick="annulla();"><i class="fa fa-plus-circle"></i> Inserisci Foto</div>
		<div id="inserisci" style="display:none; margin-top:10px;">
			<div class="mws-panel-header">
				<span>Inserisci Foto</span>
			</div>
			<div class="mws-panel-body no-padding" style="margin-top:40px">
				<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_foto" enctype="multipart/form-data" style="margin-top:-40px">			
					<input type="hidden" name="stato" value="inviato"/>
					<div class="mws-form-inline">
						<script type="text/javascript">
							function annulla(){
								document.invia_foto.img.value="";
								$('#inserisci').slideToggle();
							}
						</script>
						
						<?php 
						$ord = $oggetto_admin->trova_ordine("$table");
						echo "<input type=hidden name=ordine value=$ord>";	
						?>
						<?php 
							$oggetto_admin->campo_ins("Foto" , "img" , "42", 'no');
						?>
												
						<div class="mws-button-row" id="bott">
							<input type="submit" value="Inserisci" class="btn btn-danger">
							<input type="button" value="Annulla" class="btn" onclick="annulla()">
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="mws-panel-header" style="margin-top:20px;">
			<span><i class="icon-table"></i> Elenco Foto</span>
		</div>
		<?php 
		//$criterio = " AND id_rife='$id_news'";
		$criterio = "";
		?>
		
		<div class="mws-panel-body no-padding">
			<table class="mws-datatable-fn mws-table">
				<thead>
					<tr>
						<?php /*<th style="width:20px"></th>*/?>
						<th style="width:150px">Foto</th>
						<th>link</th>
						<th style="text-align:left">Azioni</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$query_ele = "select * from $table WHERE 1 $criterio ORDER BY ordine DESC";
					//echo $query_ele;
					$risu_ele = $open_connection->connection->query($query_ele);
					
					$num_ele = 0;
					if($risu_ele)
						$num_ele = $risu_ele->rowCount();	
					
					if($num_ele>0)
					{		
						$query_ele = "select * from $table WHERE 1 $criterio ORDER BY ordine DESC";
						$risu_ele = $open_connection->connection->query($query_ele);
						$num_item=$risu_ele->rowCount();
						for($x=0;$x<$num_item;$x++)
						{						
							$arr_ele = $risu_ele->fetch();
							$img = $arr_ele['img'];
							$id_campo = $arr_ele['id'];
							
							$link=$http.'://'.$ind_sito.'/resarea/img_up/news_foto/'.$img;
							$embed = '<img src="'.$link.'" alt="" style="width:86%; margin:20px 0; margin-left:7%;"/>';
							?>
							<tr style="cursor:pointer">
								<?php /*<td align="center" valign="center">
									<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
								</td>*/?>
								<td>	
									<img src="img_up/news_foto/<?php  echo $arr_ele['img']; ?>" alt="" style="width:150px;"/>
								</td>
								<td>	
									<?php  echo $link; ?>
									&nbsp;<span  class="btn btn-small" style="cursor:pointer;" onclick="copy('link_<?php echo $x;?>');" title="Copia" alt="Copia"><i class="fa fa-clipboard"></i></span>
									<div style="height:5px; overflow:hidden; opacity:0;"><input type="text" value='<?php  echo $embed; ?>' id="link_<?php echo $x;?>"></div>
								</td>
								<td>
									<span class="btn-group">
										<a href="frame/<?php echo $file;?>.php?id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
										<a href="frame/<?php echo $file;?>.php?id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
										<a href="frame/<?php echo $file;?>.php?id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
										<a href="frame/<?php echo $file;?>.php?id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
										<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
											<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
											<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
												<form action="frame/<?php echo $file;?>.php" method="GET">
													<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
													<input type="hidden" name="azione" value="cambia"/>
													<input type="hidden" name="id_news" value="<?php echo $id_news;?>"/>
													<input type="text" name="new_pos" value="<?php echo $x+1;?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
												</form>
											</div>
										</div>
										<a href="frame/<?php echo $file;?>.php?azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" onClick="return confirm('Cancellare gli elementi selezionati?')" class="btn btn-small"><i class="icon-trash"></i></a>
									</span>
								</td>								
							</tr>								
						<?php }?>
					<?php }?>						
				</tbody>	
			</table>
			
			<?php include("../fissi/multipagina.inc.php");?>			
		</div>

	</div>
 
 
	<!-- JavaScript Plugins -->
    <script src="js/libs/jquery-1.8.3.min.js"></script>
    <script src="js/libs/jquery.mousewheel.min.js"></script>
    <script src="js/libs/jquery.placeholder.min.js"></script>
    <script src="custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="jui/jquery-ui.custom.min.js"></script>
    <script src="jui/js/jquery.ui.touch-punch.js"></script>
	<script src="jui/js/jquery-ui-effects.min.js"></script>
	

	<script src="plugins/datatables/jquery.dataTables.js"></script>
	
    <script src="plugins/colorpicker/colorpicker-min.js"></script>
	<script src="plugins/validate/jquery.validate-min.js"></script>
	
    <!-- Core Script -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="js/core/themer.js"></script>
	
	<script src="js/demo/demo.widget.js"></script>
	
	<?php  if ($cmd!="" && is_file("js/table/$cmd.table.php")) {include("js/table/$cmd.table.php"); }?>
	
    <!-- Login Script -->
    <script src="js/core/login.js"></script>
	
	<script>
		function copy(myId) {
		  var copyText = document.getElementById(myId);
		  copyText.select();
		  document.execCommand("copy");
		  alert("Link copiato negli appunti");
		}
	</script>
</body>
</html>
