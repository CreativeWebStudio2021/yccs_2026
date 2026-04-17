<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=utenti';
	}
</script>

<script language="javascript">
	function verifica(){
		var user = document.gino.user_adm.value;
		var ident = document.gino.identificativo.value;
		
		if (ident=="") alert('Nome utente obbigatorio');
		else if (user=="") alert('Username obbigatorio');
		
		else document.gino.submit();
	}
	function verifica_pass(){
		var pass = document.gino2.pass_adm.value;
		
		if (pass=="") alert('Password obbigatoria');
		
		else document.gino2.submit();
	}
</script>
<?php 
$user_adm = "";
if(isset($_POST['user_adm'])) $user_adm = $_POST['user_adm'];
$pass_adm = "";
if(isset($_POST['pass_adm'])) $pass_adm = $_POST['pass_adm'];
$livello = "";
if(isset($_POST['livello'])) $livello = $_POST['livello'];
$identificativo = "";
if(isset($_POST['identificativo'])) $identificativo = $_POST['identificativo'];
$attivo = "";
if(isset($_POST['attivo'])) $attivo = $_POST['attivo'];

if($stato=="inviato")
{		
	$arr_no['stato']=1;
		
	$oggetto_admin->modifica_campi ("users", $id_ute , $arr_no);
	?>
	<script language="javascript">
		window.location = "admin.php?cmd=utenti";
	</script>
	<?php 
}elseif($stato=="pass_inviato"){print_r($_POST);
	$arr_no['stato']=1;
	$_POST['pass_adm'] = crypt($_POST['pass_adm'],$_POST['pass_adm']);
		
	$oggetto_admin->modifica_campi ("users", $id_ute , $arr_no);
	?>
	<script language="javascript">
		window.location = "admin.php?cmd=utenti";
	</script>
	<?php 
}
else
{
	$query = "select * from users where id='$id_ute'";
	$risu    = $open_connection->connection->query($query);
	$arr_risu = $risu->fetch();
	$identificativo_mod = $arr_risu['identificativo'];
	$user_adm_mod = $arr_risu['user_adm'];
	$pass_adm_mod = $arr_risu['pass_adm'];
	$level_mod = $arr_risu['livello'];
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Utente</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=utenti_mod&id_ute=<?php  echo $id_ute; ?>" method="post">
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Nome *</label>
					<div class="mws-form-item">
						<input name="identificativo" type="text" class="small" value="<?php  echo $identificativo_mod; ?>">
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Username *</label>
					<div class="mws-form-item">
						<input name="user_adm" type="text" class="small" value="<?php  echo $user_adm_mod; ?>">
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Livello di accesso</label>
					<div class="mws-form-item">
						<select name="livello" class="small">
							<option value="300" <?php  if ($level_mod==300) echo "selected=\"selected\""; ?>>CWS</option>
							<option value="200" <?php  if ($level_mod==200) echo "selected=\"selected\""; ?>>Amministratore</option>
							<option value="100" <?php  if ($level_mod==100) echo "selected=\"selected\""; ?>>Scuola Vela</option>
						</select>
					</div>
				</div>
				
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<!--<input type="reset" value="Reset" class="btn ">-->
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>    	
</div>

<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Password</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino2" class="mws-form" action="admin.php?cmd=utenti_mod&id_ute=<?php  echo $id_ute; ?>" method="post">
			<input type="hidden" name="stato" value="pass_inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Nuova Password *</label>
					<div class="mws-form-item">
						<input name="pass_adm" type="text" class="small" value="">
					</div>
				</div>
				
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica_pass()">
				<!--<input type="reset" value="Reset" class="btn ">-->
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>    	
</div>
			
<?php 
}
?>



