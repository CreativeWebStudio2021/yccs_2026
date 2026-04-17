<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=utenti';
	}
</script>

<script language="javascript">
	function verifica(){
		var user = document.gino.user_adm.value;
		var pass = document.gino.pass_adm.value;
		var ident = document.gino.identificativo.value;
		
		if (ident=="") alert('Nome utente obbigatorio');
		else if (user=="") alert('Username obbigatorio');
		else if (pass=="") alert('Password obbigatoria');
		
		else document.gino.submit();
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
	$query = "select * from users where user_adm='$user_adm' and pass_adm='$pass_adm'";
	$risu_contr = $open_connection->connection->query($query);
	$num_contr = $risu_contr->rowCount();
	if($num_contr==0)
	{
		$_POST['pass_adm'] = crypt($_POST['pass_adm'],$_POST['pass_adm']);
		$arr_no['stato']=1;
		$oggetto_admin->inserisci_campi ("users", $arr_no);
	}
	else
	{
		echo "Attenzione esiste già un utente con la username e la password specificata";
	}
	?>
	<script language="javascript">
		window.location = "admin.php?cmd=utenti";
	</script>
	<?php 	
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Utente</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=utenti_ins" method="post">
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Nome *</label>
					<div class="mws-form-item">
						<input name="identificativo" type="text" class="small">
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Username *</label>
					<div class="mws-form-item">
						<input name="user_adm" type="text" class="small">
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Password *</label>
					<div class="mws-form-item">
						<input name="pass_adm" type="text" class="small">
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Livello di accesso</label>
					<div class="mws-form-item">
						<select name="livello" class="small">
							<option value="300">CWS</option>
							<option value="200">Amministratore</option>
							<option value="100">Scuola Vela</option>
						</select>
					</div>
				</div>
				<!--<div class="mws-form-row">
					<label class="mws-form-label">Medium text field</label>
					<div class="mws-form-item">
						<input type="text" class="medium">
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Large text field</label>
					<div class="mws-form-item">
						<input type="text" class="large">
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Textarea</label>
					<div class="mws-form-item">
						<textarea rows="" cols="" class="large"></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Dropdown List</label>
					<div class="mws-form-item">
						<select class="large">
							<option>Option 1</option>
							<option>Option 3</option>
							<option>Option 4</option>
							<option>Option 5</option>
						</select>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Checkboxes</label>
					<div class="mws-form-item clearfix">
						<ul class="mws-form-list inline">
							<li><input type="checkbox"> <label>Checkbox 1</label></li>
							<li><input type="checkbox"> <label>Checkbox 2</label></li>
							<li><input type="checkbox"> <label>Checkbox 3</label></li>
							<li><input type="checkbox"> <label>Checkbox 4</label></li>
						</ul>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Radio Buttons</label>
					<div class="mws-form-item clearfix">
						<ul class="mws-form-list inline">
							<li><input type="radio"> <label>Radio 1</label></li>
							<li><input type="radio"> <label>Radio 1</label></li>
							<li><input type="radio"> <label>Radio 1</label></li>
							<li><input type="radio"> <label>Radio 1</label></li>
						</ul>
					</div>
				</div>-->
			</div>
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
				<!--<input type="reset" value="Reset" class="btn ">-->
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>    	
</div>
				
<!--<table cellspacing="0" cellpadding="0" border="0" width="100%" class="testo11">
<form name="gino" method="post" action="admin.php?cmd=utenti_ins" enctype="multipart/form-data">
<input type="hidden" name="stato" value="inviato">
		<tr>
			<td colspan="2" height="10px"></td>
		</tr>
		<tr>
			<td colspan="2" height="10px" class="celeste">INSERISCI UTENTE</td>
		</tr>		
		<tr>
			<td colspan="2" height="10px"></td>
		</tr>	
		<tr>
			<td class="testo10"><b>Identificativo</b></td>
			<td><input type="text" name="identificativo" class="campitesto"></td>
		</tr>
		<tr>
			<td colspan="2" height="10px"></td>
		</tr>
		<tr>
			<td class="testo10"><b>username</b></td>
			<td><input type="text" name="user_adm" class="campitesto"></td>
		</tr>
		<tr>
			<td colspan="2" height="10px"></td>
		</tr>
		<tr>
			<td class="testo10"><b>password</b></td>
			<td><input type="text" name="pass_adm" class="campitesto"></td>
		</tr>
		<tr>
			<td colspan="2" height="10px"></td>
		</tr>
		<tr>
			<td class="testo10"><b>Access Level</b></td>
			<td>
				<select name="livello" class="campitesto">
					<option value="300">CWS</option>
					<option value="200">Amministratore</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" height="20"></td>
		</tr>
		<tr>
			<td colspan="2">
				<table border="0" cellpadding="0" cellspacing="0" width="60%" align="left">
				<tr>
					<td width="30%" align="right" style="padding-right:10px"><input type="submit" value="Inserisci" class="bottone" /></td>
					<td width="30%" align="left" style="padding-left:10px"><input type="button" value="Annulla" class="bottone" onclick="annulla()" /></td>
				</tr>
				</table>
			</td>
		</tr>
	</form>
</table>
<script type="text/javascript">
	var field1 = new LiveValidation( 'identificativo', {onlyOnSubmit: true } );
	field1.add( Validate.Presence , {failureMessage: " obbligatorio"});
	var field2 = new LiveValidation( 'user_adm', {onlyOnSubmit: true } );
	field2.add( Validate.Presence , {failureMessage: " obbligatorio"});
	var field3 = new LiveValidation( 'pass_adm', {onlyOnSubmit: true } );
	field3.add( Validate.Presence , {failureMessage: " obbligatorio"});
	
	var automaticOnSubmit = field1.form.onsubmit;
    field1.form.onsubmit = function(){
		var valid = automaticOnSubmit();
	    if(valid)document.gino.submit();
		return false;
	}	
</script>-->		
<?php 
}
?>



