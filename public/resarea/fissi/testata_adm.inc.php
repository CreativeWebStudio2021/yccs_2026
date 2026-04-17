<style>
	#mws-user-tools #mws-user-info {
		padding:8px 12px;
		height:auto; 
		margin-top:10px;
	}
</style>
<!-- Logo Container -->
<div id="mws-logo-container" style="background-color:#fff">

	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
	<div id="mws-logo-wrap" style="background-color:#fff">
		<a href="../home.html" target="_blank">
			<img src="img/logo.png" alt="<?php echo $nome_del_sito?>">
		</a>
	</div>
</div>

<!-- User Tools (notifications, logout, profile, change password) -->
<div id="mws-user-tools" class="clearfix">
	<?php 
		if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si") {
	?>
	<!-- User Information and functions section -->
	<div id="mws-user-info" class="mws-inset">
	
		<!-- User Photo -->
		<div id="mws-user-photo" style="margin-top:5px;">
			<i class="fa fa-user fa-2x"></i>
		</div>
		
		<!-- Username and Functions -->
		<div id="mws-user-functions" style="font-size:16px;">
			<div id="mws-username" style="color:var(--azzurro);">
				Ciao, <?php  echo $_SESSION["nome_login"]; ?>
			</div>
			<ul>
				<li><a href="admin.php?cmd=destroy" style="color:#333">Logout</a></li>
			</ul>
		</div>
	</div>
	<?php 
		}
	?>
</div>
