<?php 
if(isset($_GET['azione']) && $_GET['azione']=="cancella" && isset($id_canc))
{	
		
	$quer_canc = "delete from users where id='$id_canc' ";
	$risu_del = $open_connection->connection->query($quer_canc);
?>
	<script language="javascript">
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=utenti";
	</script>
<?php 	
}

if($azione=="attiva"){
	$quer_canc = "update users set attivo='1' where id='$id_ute' ";
	$risu_del = $open_connection->connection->query($quer_canc);
}

if($azione=="disattiva"){
	$quer_canc = "update users set attivo='0' where id='$id_ute' ";
	$risu_del = $open_connection->connection->query($quer_canc);
}
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Gestione Utenti</b></div>
	<div style="height:30px;width:100%;text-align:right"><a href="admin.php?cmd=utenti_ins" style="color:#7a7a7a"><b>Aggiungi utente</b></a> &nbsp; </div>
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco utenti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Username</th>
					<th>Livello</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$quer = "select * from users";
				$risu = $open_connection->connection->query($quer);
				$num_quer = $risu->rowCount();
				
				for ($x=0;$x<$num_quer;$x++){
					$arr_ding 	= $risu->fetch();
					$nome_ute	= $arr_ding['identificativo'];
					$user_adm_ute 	= $arr_ding['user_adm'];
					$level_ute 	= $arr_ding['livello'];
					$stato_ute 	= $arr_ding['attivo'];
					$id_ute  		= $arr_ding['id'];
					if($level_ute=="300")$stringa_lev = "CWS";
					if($level_ute=="200")$stringa_lev = "Amministratore";
					if($level_ute=="100")$stringa_lev = "Scuola Vela";
			?>
				<tr>
					<td><?php  echo $nome_ute; ?></td>
					<td><?php  echo $user_adm_ute; ?></td>
					<td><?php  echo $stringa_lev; ?></td>
					<td style="width:15%">
						<span class="btn-group">
							<?php /*?> if ($stato_ute==1) { ?><a href="admin.php?cmd=utenti&azione=disattiva&id_ute=<?php  echo $id_ute; ?>" class="btn btn-small"><i class="icol-shape-square"></i></a><?php  } else { ?><a href="admin.php?cmd=utenti&azione=attiva&id_ute=<?php  echo $id_ute; ?>" class="btn btn-small"><i class="icol-stop"></i></a><?php  } */?>
							<a href="admin.php?cmd=utenti_mod&id_ute=<?php  echo $id_ute; ?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onclick="return confirm ('Confermi la cancellazione?');" href="admin.php?cmd=utenti&azione=cancella&id_canc=<?php  echo $id_ute; ?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
				}
			?>
			</tbody>
		</table>
	</div>
</div>