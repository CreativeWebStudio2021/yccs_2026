<?php 
$table="news_video";
$file="video_news";
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
	$arr_no['stato']=1;
	$arr_thumb['img']=400;
	$_POST['id_rife']=$id_news;	
	$oggetto_admin->inserisci_campi ("$table" , $arr_no, $arr_thumb, "../img_up/news_foto");
	?>
	<script language="javascript">
		//window.location = "<?php echo $_SERVER['REQUEST_URI'];?>" ;
	</script>
	<?php 	
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
	
	$query_canc_img = "select video from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	/*if ($risu_canc_img) {
		list($foto) = $risu_canc_img->fetch();
		if (is_file("../img_up/news_foto/$foto")) @unlink("../img_up/news_foto/$foto");
		if (is_file("../img_up/news_foto/$foto")) @unlink("../img_up/news_foto/s_$foto");
	}*/
	
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
		<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Codice Instagram</b></div>

		<div id="start" style="display:none"></div>
		<div id="end" style="display:none"></div>
		<div id="total" style="display:none"></div>
		
		<div id="inserisci" style=" margin-top:10px;">
			<div class="mws-panel-header">
				<span>Codice Instagram</span>
			</div>
			<div class="mws-panel-body no-padding" style="margin-top:40px">
				<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_foto" enctype="multipart/form-data" style="margin-top:-40px">			
					<input type="hidden" name="stato" value="inviato"/>
					<div class="mws-form-inline">
						<div class="mws-form-row">
							<label class="mws-form-label">Incolla Codice Instagram</label>
							<div class="mws-form-item">
								<textarea id="codice_instagram" style="width:100%"></textarea>
							</div>
						</div>						
						<div class="mws-button-row" id="bott">
							<div class="btn btn-danger" onclick="procedi()">Procedi</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div style="margin:40px 0; text-align:Center; display:none" id="bottoneCopia">
			<div style="height:5px; overflow:hidden; opacity:0;"><input type="text" value='' id="codice_new"></div>
			<div class="btn" onclick="copy('codice_new');"><i class="fa fa-clipboard" aria-hidden="true"></i> COPIA CODICE GENERATO</div>
		</div>
		<div style="margin:40px 0; text-align:Center; display:none" id="errore">
			<b>ERRORE!</b><br/> 
			Provare ad inserire nuovamente il codice Instagram
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
		function procedi() {
			document.getElementById('bottoneCopia').style.display="none";
			document.getElementById('errore').style.display="none";
			var cod_insta = document.getElementById('codice_instagram').value;
			var myarr = cod_insta.split("https://www.instagram.com/p/");
			if(myarr.length>1){
				var myarrR = myarr[1].split("/");
				var code = myarr2[0];
				document.getElementById('bottoneCopia').style.display="block";
				document.getElementById('codice_new').value='<img src="<?php echo $http;?>://<?php echo $ind_sito;?>/resarea/img/default_instagram.jpg?'+code+'" alt=""/>';
			}else{
				var myarrReel = cod_insta.split("https://www.instagram.com/reel/");
				if(myarrReel.length>1){
					var myarr2 = myarrReel[1].split("/");
					var code = myarr2[0];
					document.getElementById('bottoneCopia').style.display="block";
					document.getElementById('codice_new').value='<img src="<?php echo $http;?>://<?php echo $ind_sito;?>/resarea/img/default_instagram.jpg?reel##'+code+'" alt=""/>';
				}else{
					document.getElementById('errore').style.display="block";
				}
			}
			
		}
		function copy(myId) {
		  var copyText = document.getElementById(myId);
		  copyText.select();
		  document.execCommand("copy");
		  alert("Codice copiato negli appunti");
		}
	</script>
</body>
</html>
