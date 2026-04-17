<?php
session_start();
if($_SESSION["user_loggato"] == "si"){
	if(isset($_GET['file'])) $file = $_GET['file']; else $file="";
	if(isset($_GET['lingua'])) $lingua = $_GET['lingua']; else $lingua="";
	if($file!=""){		

		$pdf = file_get_contents('resarea/files/comunicati-ai-soci/'.$file);
		header("Content-Type: application/pdf");
		//Display it
		echo $pdf;
	}
}else{
	$_SESSION['pag_login'] = "comunicazioni-ai-soci";
	?>
	<script language="javascript">
		window.location = "<?php echo $http;?>://<?=$ind_sito;?>/<?php if($lingua=='eng'){?>en/<?php } ?>area-soci/login.html";
	</script>
<?php } ?>