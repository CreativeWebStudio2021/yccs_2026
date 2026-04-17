<?php 
require_once '../config/dbnew.php';
if(isset($_GET['id_dett'])) $id_dett=$_GET['id_dett']; else $id_dett="";
if(isset($_GET['lingua'])) $lingua=$_GET['lingua']; else $lingua="";

$query_ed = "SELECT * FROM edizioni_regate WHERE id='$id_dett' AND visibile='1' AND new='1'";
$resu_ed = $open_connection->connection->query($query_ed);	
$risu_ed = $resu_ed->fetch();

$id_regata  = $risu_ed['id_regata'];
$logo_edizione  = $risu_ed['logo_edizione'];
$nome_regata   = $risu_ed['nome_regata'];
$luogo    = $risu_ed['luogo'];
$data_dal   = $risu_ed['data_dal'];
$data_al   = $risu_ed['data_al'];
$lista_iscritti   = $risu_ed['lista_iscritti'];
$footer   = $risu_ed['lista_iscritti_footer'];

if($logo_edizione && trim($logo_edizione!="")) $logo = "resarea/img_up/regate/".$logo_edizione;
else {
	$query_r="SELECT logo FROM regate WHERE id='".$id_regata."'";
	$resu_r=$open_connection->connection->query($query_r);
	list($logo_reg)=$resu_r->fetch();
	if($logo_reg && trim($logo_reg!="")) $logo = "resarea/img_up/regate/".$logo_reg;
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<base href="<?php echo $http;?>://<?php  echo $ind_sito ?>/" /> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		
			  <link rel="shortcut icon" href="images/favicon-yccs/favicon.ico" type="image/x-icon" />
		  <link rel="apple-touch-icon" href="images/favicon-yccs/apple-touch-icon.png" />
		  <link rel="apple-touch-icon" sizes="57x57" href="images/favicon-yccs/apple-touch-icon-57x57.png" />
		  <link rel="apple-touch-icon" sizes="72x72" href="images/favicon-yccs/apple-touch-icon-72x72.png" />
		  <link rel="apple-touch-icon" sizes="76x76" href="images/favicon-yccs/apple-touch-icon-76x76.png" />
		  <link rel="apple-touch-icon" sizes="114x114" href="images/favicon-yccs/apple-touch-icon-114x114.png" />
		  <link rel="apple-touch-icon" sizes="120x120" href="images/favicon-yccs/apple-touch-icon-120x120.png" />
		  <link rel="apple-touch-icon" sizes="144x144" href="images/favicon-yccs/apple-touch-icon-144x144.png" />
		  <link rel="apple-touch-icon" sizes="152x152" href="images/favicon-yccs/apple-touch-icon-152x152.png" />
		  <link rel="apple-touch-icon" sizes="180x180" href="images/favicon-yccs/apple-touch-icon-180x180.png" />
		<title>Yacht Club Costa Smeralda - New Entry List</title>
	<meta name="description" content="Yacht Club Costa Smeralda - New Entry List">
	
	<meta name="google-site-verification" content="oviuscgVLiHveSpTHFkdoRyN6grYl0CcOun1UbKtiz4" />
	
	
	<!-- Bootstrap Core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="vendor/fontawesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
	<link href="vendor/animateit/animate.min.css" rel="stylesheet">

	<!-- Vendor css -->
	<link href="vendor/owlcarousel/owl.carousel.css" rel="stylesheet">
	<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

	<!-- Template base -->
			<link href="css/theme-base.css" rel="stylesheet">
	
	<!-- Template elements -->
	<link href="css/theme-elements.css" rel="stylesheet">	
	
	<!-- Responsive classes -->
	<link href="css/responsive.css" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->	

	<!-- Template color -->
			<link href="css/color-variations/blue.css" rel="stylesheet" type="text/css" media="screen" title="blue">
	
	<!-- LOAD GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,800,700,600%7CRaleway:100,300,600,700,800" rel="stylesheet" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700italic,700,900,900italic' rel='stylesheet' type='text/css'>
	
	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
	<link rel="stylesheet" property="stylesheet" href="vendor/rs-plugin/css/settings.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/rs-plugin-styles.css" type="text/css" />
	
	<link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet" type="text/css">
		
	<!-- CSS CUSTOM STYLE -->
	<link rel="stylesheet" type="text/css" href="css/custom.css" media="screen" />
			<link rel="stylesheet" type="text/css" href="css/regate.css" media="screen" />
		
		
	
	<!--fine link iconee per telefoni-->
	<script src="vendor/jquery/jquery-1.11.2.min.js"></script>
		
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-40605968-36', 'auto');
	  ga('send', 'pageview');
	  
	  ga('create', 'UA-4499527-1', 'auto', 'clientTracker');
	  ga('clientTracker.send', 'pageview');

	</script>	
	
</head>

<body class="wide"  >	

	<!-- WRAPPER -->
	<div class="wrapper">

	<section class="content" style="padding:20px; background:#fff" id="printArea">
		<div style="width:100%; text-align:center;" id="logo_stampa">
			<img src="<?php echo $logo;?>" alt="" style="width:100px; border:solid 1px; margin-bottom:20px;"/>
		</div>
		
		<div class="container" style="">
			<div class="row">				
				<div class="titoliBox2" style="margin-bottom:10px; text-align:center;">
					<h1 style="line-height:35px">
						<?php echo $nome_regata;?><br/>
						<span style="font-size:0.6em"><?php echo $luogo;?>, <?php if($lingua=="ita"){?>dal<?php }else{?>from<?php }?> <?php echo $data_dal;?> <?php if($lingua=="ita"){?>al<?php }else{?>to<?php }?> <?php echo $data_al;?></span>
					</h1>
				</div>
				<div class="titoliBox2" style="margin-bottom:10px; text-align:center;"><h3><?php if($lingua=="ita"){?>Lista Iscritti<?php }else{?>Entry List<?php }?></h3></div>
				
				<div class="table-responsive" style="margin-top:40px;">
					<style>
						.table-striped>tbody>tr:nth-of-type(odd){
							background-color: #b8cce4;
						}
					</style>
					<table class="table table-striped" style="border-bottom:solid 3px #002060">
						<thead>
							<tr style="background:#002060; color:#fff">
								<th>YACHT NAME</th>
								<th>LH (m)</th>
								<th>Beam (m)</th>
								<th>Draft (m)</th>
								<th>Builder</th>
								<th>Designer</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$query_ele = "SELECT * FROM edizioni_iscrizioni_regata WHERE 1 AND visibile='1' AND id_edizione='$id_dett'  order by ordine DESC";
							$risu_ele =$open_connection->connection->query($query_ele);
							$num_item=$risu_ele->rowCount();
							for($x=0;$x<$num_item;$x++)
							{						
								$arr_ele = $risu_ele->fetch();
								$boat_name = ucwords(trim($arr_ele['boat_name']));
								$builder = ucwords(trim($arr_ele['builder']));
								$designer = ucwords(trim($arr_ele['designer']));						
								
								$lh = $arr_ele['lh'];
								$beam = $arr_ele['beam'];
								$min_draft = $arr_ele['min_draft'];
								?>
							
								<tr>
									<td><?php echo ($x+1);?> <b><?php echo $boat_name;?></b></td>
									<td><b><?php echo $lh;?></b></td>
									<td><?php echo $beam;?></td>
									<td><?php echo $min_draft;?></td>
									<td><i><?php echo $builder;?></i></td>
									<td><i><?php echo $designer;?></i></td>
								</tr>
							<?php }?>
						</tbody>
					</table>
					
				</div>
				
			</div>
		</div>
		
		<?php if($footer==1){?>
			<div class="footer-content" id="loghi_stampa">
				<div class="container" >
					<div class="row" style="text-align:center; padding:20px 0">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div style="position:relative; text-align:center; margin:0 auto;" id="partnerUfficiali">
								<img src="images/new/loghi.jpg" alt="" style="width:100%;"/>					
								<div style="position:absolute; top:0; left:0; width:30%; height:100%;">
									<img src="images/new/blank.png" style="width:100%; height:100%;" alt="Rolex"/>
								</div>
								<div style="position:absolute; top:0; left:30%; width:40%; height:100%;">
									<img src="images/new/blank.png" style="width:100%; height:100%;" alt="One Ocean"/>
								</div>
								<div style="position:absolute; top:0; left:70%; width:30%; height:100%;">
									<img src="images/new/blank.png" style="width:100%; height:100%;" alt="Audi"/>
								</div>
							</div>
						</div>
											
					</div>
				</div>
			</div>
		<?php }?>
	</section>				
		
	</div>
	<!-- END: WRAPPER -->

	<!--VENDOR SCRIPT-->
	
	<script src="vendor/plugins-compressed.js"></script>
	
	<!-- SLIDER REVOLUTION 5.x SCRIPTS  -->
	<script type="text/javascript" src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    
    
</body>
</html>

