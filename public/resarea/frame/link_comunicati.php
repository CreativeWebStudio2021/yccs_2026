<?php 
$table="comunicati_home_link";
$file="link_comunicati";
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

$oggetto_frame = new Functions_adm($array_sito);

$rec_pag=20;

if(isset($_GET['id_comm'])) $id_comm=$_GET['id_comm']; else $id_comm="";

$rif="";
if($id_comm!="") $rif="&id_comm=$id_comm";

$query_ele = "select * from comunicati_home WHERE id='$id_comm'";
$resu_ele = $open_connection->connection->query($query_ele);
$risu_ele=$resu_ele->fetch();
				
if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";

$oggetto_admin = new Functions_adm($array_sito);

if($stato=="inviato"){
	$arr_no['stato']=1;
	$_POST['id_rife']=$id_comm;
	$_POST['visibile']='1';
	$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	$_POST['testo_eng']=str_replace('"','\"',$_POST['testo_eng']);
	$_POST['testo_gruppo']=str_replace('"','\"',$_POST['testo_gruppo']);
	$_POST['testo_gruppo_eng']=str_replace('"','\"',$_POST['testo_gruppo_eng']);
	
	$oggetto_admin->inserisci_campi ("$table" , $arr_no, "", "", "../files");
	?>
	<script language="javascript">
		window.location = "<?php echo $_SERVER['REQUEST_URI'];?>" ;
	</script>
	<?php 
}

if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";



if ($id_canc) {
	if($azione=="sali") $oggetto_frame->sali("$table", "$id_canc", "id_rife", "$id_comm") ;
	if($azione=="scendi") $oggetto_frame->scendi("$table", "$id_canc", "id_rife", "$id_comm") ;
	if($azione=="primo") $oggetto_frame->primo("$table", "$id_canc", "id_rife", "$id_comm") ;
	if($azione=="ultimo") $oggetto_frame->ultimo("$table", "$id_canc", "id_rife", "$id_comm") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_frame->cambia("$table", "$id_canc", "$new_pos", "id_rife", "$id_comm") ;	
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
	
	$query_canc_img = "select allegato, allegato_eng from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($allegato, $allegato_eng) = $risu_canc_img->fetch();
		if (is_file("../files/$allegato")) @unlink("../files/$allegato");
		if (is_file("../files/$allegato_eng")) @unlink("../files/s_$allegato_eng");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
	</script>
<?php 
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select allegato, allegato_eng from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($allegato, $allegato_eng) = $risu_canc_img->fetch();
			if (is_file("../files/$allegato")) @unlink("../files/$allegato");
			if (is_file("../files/$allegato_eng")) @unlink("../files/s_$allegato_eng");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			//window.location='http://<?php if($local) echo str_replace("yccs/","",$ind_sito); else echo $ind_sito?>/resarea/frame/link_comunicati.php?id_comm=<?php echo $id_comm;?>';
		</script>
	<?php 	
}

if($azione=="visibile") {
	$query_up="UPDATE $table SET visibile='1' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script type="text/javascript">
		window.location='<?php echo $http;?>://<?php if($local) echo str_replace("yccs/","",$ind_sito); else echo $ind_sito?>/resarea/frame/link_comunicati.php?id_comm=<?php echo $id_comm;?>';
	</script>
	<?php 
}
if($azione=="non_visibile") {
	$query_up="UPDATE $table SET visibile='0' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script type="text/javascript">
		window.location='<?php echo $http;?>://<?php if($local) echo str_replace("yccs/","",$ind_sito); else echo $ind_sito?>/resarea/frame/link_comunicati.php?id_comm=<?php echo $id_comm;?>';
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

<script type="text/javascript">
	var lista_ind=new Array();
	var lista_del="";
	var lista_tutti="";
	function aggiungi_lista(id_check, id_campo){
		if(document.getElementById('check_'+id_check).checked){
			lista_del+=""+id_campo+";";
		} else {
			lista_del = lista_del.replace(id_campo+";", "");
		}
		if(lista_del!=""){ 
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='<?php echo $http;?>://<?php if($local) echo str_replace("yccs/","",$ind_sito); else echo $ind_sito?>/resarea/frame/<?php echo $file;?>.php?azione=cancella_sel&id_comm=<?php echo $id_comm;?>&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
		}
	}	
</script>
</head>

<body style="background:#fff">
 
	<div class="mws-panel grid_8">
		<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Comunicati Home - Link</b></div>

		<div id="start" style="display:none"></div>
		<div id="end" style="display:none"></div>
		<div id="total" style="display:none"></div>
		
		<div id="inserisci">
			<div class="mws-panel-header">
				<span><i class="fa fa-plus-circle" aria-hidden="true"></i> Inserisci Link Comunicato Home</span>
			</div>
			<div class="mws-panel-body no-padding" style="margin-top:40px">
				<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
					<input type="hidden" name="stato" value="inviato"/>
					<div class="mws-form-inline">
						<script type="text/javascript">
							function vedi(cosa){
								if(cosa=="link"){
									document.getElementById('box_link').style.display='block';
									document.getElementById('box_allegato').style.display='none';
									document.getElementById('bott').style.display='block';
									document.getElementById('box_testo').style.display='block';
								}else if(cosa=="allegato"){
									document.getElementById('box_link').style.display='none';
									document.getElementById('box_allegato').style.display='block';
									document.getElementById('bott').style.display='block';
									document.getElementById('box_testo').style.display='block';
								}else if(cosa==""){
									document.getElementById('box_link').style.display='none';
									document.getElementById('box_allegato').style.display='none';
									document.getElementById('bott').style.display='none';
									document.getElementById('box_testo').style.display='none';
								}
							}
							function annulla(){
								document.invia_comm.tipo_link.value="";
								document.getElementById('box_link').style.display='none';
								document.getElementById('box_allegato').style.display='none';
								document.getElementById('box_testo').style.display='none';
							}
						</script>
						
						<?php 
						$ord = $oggetto_admin->trova_ordine("$table", "id_rife", "$id_comm");
						echo "<input type=hidden name=ordine value=$ord>";	
						?>

						<div class="mws-form-row">
							<label class="mws-form-label">Tipo </label>
							<div class="mws-form-item">
								<select name="tipo_link" class="small" onchange="vedi(this.value);">
									<option value="">Seleziona</option>
									<option value="link">Link</option>
									<option value="allegato">Allegato</option>				
								</select>
							</div>
						</div>
						<div style="display:none" id="box_testo">
							<?php 
								$oggetto_admin->campo_ins("Testo (Inglese)*", "testo_eng" , "1", 'no');
								$oggetto_admin->campo_ins("Testo (Italiano)", "testo" , "1", 'no');	
							?>
						</div>
						<div id="box_link" style="display:none">
							<?php 
							$oggetto_admin->campo_ins("Link (Inglese)<br /><i>(a partire da http://...)</i>" , "link_eng" , "1", 'no');
							$oggetto_admin->campo_ins("Link (Italiano)<br /><i>(a partire da http://...)</i>" , "link" , "1", 'no');
							?>
						</div>
						<div id="box_allegato" style="display:none">
							<?php 
							$oggetto_admin->campo_ins("Allegato PDF (Inglese)" , "allegato_eng" , "5", 'no');
							$oggetto_admin->campo_ins("Allegato PDF (Italiano)" , "allegato" , "5", 'no');
							?>
						</div>
						
						<div class="mws-button-row" id="bott" style="display:none">
							<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
							<input type="button" value="Annulla" class="btn" onclick="annulla()">
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="mws-panel-header" style="margin-top:20px;">
			<span><i class="icon-table"></i> Elenco Link/Allegati</span>
		</div>
		<?php 
		$criterio = " AND id_rife='$id_comm'";
		?>
		
		<div class="mws-panel-body no-padding">
			<table class="mws-datatable-fn mws-table">
				<thead>
					<tr>
						<th style="width:20px"></th>
						<th style="width:20px"></th>
						<th style="width:300px">Testo</th>
						<th style="width:100px">Tipo</th>
						<th></th>
						<th style="width:300px">Azioni</th>
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
							$tipo = $arr_ele['tipo_link'];
							$tit = $oggetto_admin->puntini(ucfirst($arr_ele['testo']));
							$tit_eng = $oggetto_admin->puntini(ucfirst($arr_ele['testo_eng']));
							$id_campo = $arr_ele['id'];
							?>
							<tr style="cursor:pointer">
								<td align="center" valign="center">
									<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
								</td>
								<td>	
									<?php  echo $x+1; ?>										
								</td>
								<td >
									<?php if($arr_ele['testo'] && $arr_ele['testo']!=""){?><img src="../images/it.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $tit; ?><br/><?php }?>
									<?php if($arr_ele['testo_eng'] && $arr_ele['testo_eng']!=""){?><img src="../images/en.gif" alt="" style="width:10px;"/>&nbsp;<?php  echo $tit_eng; ?><?php }?>
								</td>
								<td>	
									<?php  echo $arr_ele['tipo_link']; ?>										
								</td>
								<td></td>
								<td>
									<span class="btn-group">
										<a href="frame/<?php echo $file;?>.php?id_canc=<?php  echo $id_campo; ?>&azione=<?php if($arr_ele['visibile']==1){?>non_<?php }?>visibile<?php echo $rif;?>" class="btn btn-small"><?php if($arr_ele['visibile']==1){?><i style="color:green" class="fa fa-circle"></i><?php }else{?><i style="color:red" class="fa fa-circle-o"></i><?php }?></a>
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
													<input type="hidden" name="id_comm" value="<?php echo $id_comm;?>"/>
													<input type="text" name="new_pos" value="<?php echo $x+1;?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
												</form>
											</div>
										</div>
										<a href="frame/<?php echo $file;?>_mod.php?id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
										<a href="frame/<?php echo $file;?>.php?azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" onClick="return confirm('Si vuole procedere alla cancellazione dell'elemento?')" class="btn btn-small"><i class="icon-trash"></i></a>
									</span>
								</td>								
							</tr>								
						<?php }?>
					<?php }?>						
				</tbody>	
			</table>
			
			<?php include("../fissi/multipagina.inc.php");?>
			<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
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
	
</body>
</html>
