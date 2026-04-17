<?php 
$table="rassegna_stampa_testate";
$file="testate";
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';
require_once '../fissi/functions.php';

$oggetto_frame = new Functions_adm($array_sito);

$rec_pag=20;

if(isset($_GET['id_var'])) $id_var=$_GET['id_var']; else $id_var="";

$rif="";
if($id_var!="") $rif="&id_var=$id_var";

$query_ele = "select * from prodotti WHERE id='$id_var'";
$resu_ele = $open_connection->connection->query($query_ele);
$risu_ele=$resu_ele->fetch();
				
if(isset($_POST['stato_invio'])) $stato_invio=$_POST['stato_invio']; else $stato_invio="";

$oggetto_admin = new Functions_adm($array_sito);

if($stato_invio=="inviato"){
	$arr_no['stato_invio']=1;
	//$_POST['nome']=$risu_ele['nome'];
	
	$oggetto_admin->inserisci_campi ("$table" , $arr_no);
	
	?>
	<script language="javascript">
		//window.location = "<?php echo $_SERVER['REQUEST_URI'];?>" ;
	</script>
	<?php 
}

if($stato_invio=="inviato_mod"){
	if(isset($_POST['id_rec'])) $id_rec=$_POST['id_rec']; else $id_rec="";
	$arr_no['stato_invio']=1;
	$arr_no['id_rec']=1;
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no);
}

if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";



if ($id_canc) {
	if($azione=="sali") $oggetto_frame->sali("$table", "$id_canc", "id_rife", "$id_var") ;
	if($azione=="scendi") $oggetto_frame->scendi("$table", "$id_canc", "id_rife", "$id_var") ;
	if($azione=="primo") $oggetto_frame->primo("$table", "$id_canc", "id_rife", "$id_var") ;
	if($azione=="ultimo") $oggetto_frame->ultimo("$table", "$id_canc", "id_rife", "$id_var") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_frame->cambia("$table", "$id_canc", "$new_pos", "id_rife", "$id_var") ;	
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
		$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($foto) = $risu_canc_img->fetch();
			if (is_file("../img_up/prodotti/$foto")) @unlink("../img_up/prodotti/$foto");
		if (is_file("../img_up/prodotti/s_$foto")) @unlink("../img_up/prodotti/s_$foto");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='<?php echo $http;?>://<?php if($local) echo str_replace("yccs/","",$ind_sito); else echo $ind_sito?>/resarea/frame/varianti.php?id_var=<?php echo $id_var;?>';
		</script>
	<?php 	
}

if($azione=="visibile") {
	$query_up="UPDATE $table SET stato='1' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script type="text/javascript">
		window.location='<?php echo $http;?>://<?php if($local) echo str_replace("yccs/","",$ind_sito); else echo $ind_sito?>/resarea/frame/varianti.php?id_var=<?php echo $id_var;?>';
	</script>
	<?php 
}
if($azione=="non_visibile") {
	$query_up="UPDATE $table SET stato='0' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script type="text/javascript">
		window.location='<?php echo $http;?>://<?php if($local) echo str_replace("yccs/","",$ind_sito); else echo $ind_sito?>/resarea/frame/varianti.php?id_var=<?php echo $id_var;?>';
	</script>
	<?php 
}
if($azione=="cambia_col") {
	if(isset($_GET['new_col'])) $new_col=$_GET['new_col']; else $new_col="";
	$query_up="UPDATE $table SET colore='$new_col' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script type="text/javascript">
		window.location='<?php echo $http;?>://<?php if($local) echo str_replace("yccs/","",$ind_sito); else echo $ind_sito?>/resarea/frame/varianti.php?id_var=<?php echo $id_var;?>';
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
		if (document.invia_comm.nome.value=="") alert('Nome Testata obbigatorio');
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
			document.getElementById('cancella_sel').href='<?php echo $http;?>://<?php if($local) echo str_replace("yccs/","",$ind_sito); else echo $ind_sito?>/resarea/frame/<?php echo $file;?>.php?azione=cancella_sel&id_var=<?php echo $id_var;?>&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
		}
	}	
	
	function is_numeric(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}
	function is_int(n){
	  if (!is_numeric(n)) return false
	  else return (n % 1 == 0);
	}

	function is_float(n){
	  if (!is_numeric(n)) return false
	  else return (n % 1 != 0);
	}
</script>
</head>

<body style="background:#fff">
 
	<div class="mws-panel grid_8">
		<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Testate per Rassegna Stampa</b></div>

		<div id="start" style="display:none"></div>
		<div id="end" style="display:none"></div>
		<div id="total" style="display:none"></div>
		
		<div id="inserisci">
			<script type="text/javascript">
				var apertoIns=0;
				function vediIns(){
					if(apertoIns==0){
						apertoIns=1;
						$("#campi_ins").fadeIn();
						document.getElementById('testo_ins').innerHTML='Inserisci Testata&nbsp;&nbsp;<i class="fa fa-minus-circle"></i>';
					}else{
						apertoIns=0;
						$("#campi_ins").fadeOut();
						document.getElementById('testo_ins').innerHTML='Inserisci Testata&nbsp;&nbsp;<i class="fa fa-plus-circle"></i>';
					}
				}
			</script>
			<div class="mws-panel-header" style="cursor:pointer;" onclick="vediIns(); set_taglia('<?php echo $risu_ele['tipo_taglia'];?>');">
				<span id="testo_ins">Inserisci Testata&nbsp;&nbsp;<i class="fa fa-plus-circle"></i></span>
			</div>
			<div class="mws-panel-body no-padding" style="margin-top:40px">
				<form class="mws-form"  action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="invia_comm" enctype="multipart/form-data" style="margin-top:-40px">			
					<input type="hidden" name="stato_invio" value="inviato"/>
					<div class="mws-form-inline">
						<script type="text/javascript">
							function annulla(){
								apertoIns=0;
								$("#campi_ins").fadeOut();
								document.getElementById('testo_ins').innerHTML='Inserisci Testata&nbsp;&nbsp;<i class="fa fa-plus-circle"></i>';
							}
						</script>
						<div style="display:none" id="campi_ins">
							<?php 						
							$oggetto_admin->campo_ins("Nome Testata" , "nome" , "1", 'no');
							?>
											
							
							<div class="mws-button-row" id="bott">
								<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
								<input type="button" value="Annulla" class="btn" onclick="annulla()">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="mws-panel-header" style="margin-top:20px;">
			<span><i class="icon-table"></i> Elenco Testate</span>
		</div>
		
		
		<div class="mws-panel-body no-padding">
			<table class="mws-datatable-fn mws-table">
				<thead>
					<tr>
						<th style="width:20px"></th>
						<th>Nome</th>				
						<th style="width:40px">Azioni</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$query_ele = "select * from $table ORDER BY nome ASC";
					//echo $query_ele;
					$risu_ele = $open_connection->connection->query($query_ele);
					
					$num_ele = 0;
					if($risu_ele)
						$num_ele = $risu_ele->rowCount();	
					
					if($num_ele>0)
					{		
						$query_ele = "select * from $table ORDER BY nome ASC";
						$risu_ele = $open_connection->connection->query($query_ele);
						$num_item=$risu_ele->rowCount();
						for($x=0;$x<$num_item;$x++)
						{						
							$arr_ele = $risu_ele->fetch();
							$id_campo = $arr_ele['id'];
							$nome = $arr_ele['nome'];
							?>
							<tr style="cursor:pointer">
								<td>	
									<?php  echo $x+1; ?>										
								</td>
									
								<td>	
									<div style="" id="text_<?php echo $id_campo;?>"><?php  echo $nome; ?></div>
									<div style="display:none" id="mod_<?php echo $id_campo;?>">
										<form name="modifica_nome_<?php echo $id_campo;?>" action="" method="POST">
											<input type="hidden" name="stato_invio" value="inviato_mod"/>
											<input type="hidden" name="id_rec" value="<?php echo $id_campo;?>"/>
											<input type="text" name="nome" value="<?php  echo $nome; ?>"/>&nbsp;&nbsp;&nbsp;
											<i class="fa fa-check" aria-hidden="true" onclick="document.modifica_nome_<?php echo $id_campo;?>.submit();"></i>&nbsp;&nbsp;&nbsp;
											<i class="fa fa-times-circle-o" aria-hidden="true"  onclick="document.getElementById('text_<?php echo $id_campo;?>').style.display='block'; document.getElementById('mod_<?php echo $id_campo;?>').style.display='none';"></i>
										</form>
									</div>
								</td>
								
								<td>
									<span class="btn-group">
										<span class="btn btn-small" style="cursor:pointer;" onclick="document.getElementById('text_<?php echo $id_campo;?>').style.display='none'; document.getElementById('mod_<?php echo $id_campo;?>').style.display='block';">
											<i class="fa fa-pencil"></i>
										</span>
										<?php /*<a href="frame/<?php echo $file;?>.php?id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
										<a href="frame/<?php echo $file;?>.php?id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
										<a href="frame/<?php echo $file;?>.php?id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
										<a href="frame/<?php echo $file;?>.php?id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
										<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
											<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
											<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
												<form action="frame/<?php echo $file;?>.php" method="GET">
													<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
													<input type="hidden" name="azione" value="cambia"/>
													<input type="hidden" name="id_var" value="<?php echo $id_var;?>"/>
													<input type="text" name="new_pos" value="<?php echo $x+1;?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
												</form>
											</div>
										</div>*/?>
										<!--<a href="frame/<?php echo $file;?>_mod.php?id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-pencil"></i></a>-->
										
										<a href="frame/<?php echo $file;?>.php?azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" onClick="return confirm('Cancellare gli elementi selezionati?')" class="btn btn-small">
											<i class="fa fa-trash-o" aria-hidden="true"></i>
										</a>
										
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
	
	<iframe src="" style="display:none" id="frame_inv" frameborder=0 ></iframe>
 
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
	
	<script type="text/javascript">
		function set_taglia(id_tipo){
			var stringa_t="";
			<?php 
			$query_tipo="SELECT id FROM tipo_taglia ORDER BY nome ASC";
			$resu_tipo=$open_connection->connection->query($query_tipo);
			$x=0;
			while($risu_tipo=$resu_tipo->fetch()){?>
				<?php if($x!=0) echo "else";?> if (id_tipo=='<?php echo $risu_tipo['id'];?>'){	
					document.getElementById('box_taglia').style.display="block";
					document.getElementById('campo_quantita').style.display="none";
					<?php 
					$query_taglia="SELECT * FROM valori_taglia WHERE id_tipo='".$risu_tipo['id']."'";
					$resu_taglia=$open_connection->connection->query($query_taglia);
					$num_taglia=$resu_taglia->rowCount();
					if($num_taglia>0){
						while($risu_taglia=$resu_taglia->fetch()){?>
							stringa_t+='<div style="float:left; width:50px; margin-bottom:10px;"><?php echo $risu_taglia['valore'];?></div>';
							stringa_t+='<div style="float:left;"><input type="text" name="taglia_<?php echo $risu_taglia['id'];?>" value="0" style="width:50px"/></div>';
							stringa_t+='<div style="clear:both; height:10px"></div>';
							document.getElementById('campo_taglia').innerHTML=stringa_t;/**/
						<?php }?>
					<?php }else{?>
					
					<?php }?>
				}
				<?php $x++;
			}?>
			else{
				document.getElementById('box_taglia').style.display="none";
				document.getElementById('campo_quantita').style.display="block";
				document.getElementById('campo_taglia').innerHTML="";
			}		
		}
	</script>
	
</body>
</html>
