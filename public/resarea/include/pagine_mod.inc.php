<?php 
$table="testi_pagine";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";

if(isset($_GET['pagina'])) $pagina=$_GET['pagina']; else $pagina="";
$rif="&pagina=$pagina";

if($pagina=="storia") $titolo_pagina="Il Club - La Storia";
if($pagina=="yccs_oggi") $titolo_pagina="Il Club - Lo YCCS Oggi";
if($pagina=="consiglio_direttivo") $titolo_pagina="Il Club - Consiglio Direttivo";
if($pagina=="clubhouse") $titolo_pagina="YCCS Porto Cervo - La Clubhouse";
if($pagina=="scuola_vela") $titolo_pagina="YCCS Porto Cervo - Scuola di Vela";
if($pagina=="centro_sportivo") $titolo_pagina="YCCS Porto Cervo - Centro Sportivo";
if($pagina=="clubhouse_vg") $titolo_pagina="YCCS Virgin Gorda - La Clubhouse";

$query_rec = "select * from $table where pagina='$pagina'";
$risu_rec    = $open_connection->connection->query($query_rec);
$num_rec=$risu_rec->rowCount();
if($num_rec==0){
	$query_ins="INSERT INTO $table (pagina) VALUES ('$pagina')";
	$risu_ins=$open_connection->connection->query($query_ins);
	$query_rec = "select * from $table where pagina='$pagina'";
	$risu_rec    = $open_connection->connection->query($query_rec);	
}
$arr_rec = $risu_rec->fetch();

$id_rec=$arr_rec['id'];

$n_testo = $arr_rec['testo'];
$n_testo_eng = $arr_rec['testo_eng'];

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=pagine<?php  echo $rif; ?>';
	}
</script>

<script language="javascript">
	function verifica(){
		document.gino.submit();
	}
</script>
<?php 


if($stato=="inviato")
{
	$arr_no['stato']=1;
	
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no );
?>
	<script language="javascript">
		window.location = "admin.php?cmd=pagine<?php  echo $rif; ?>" ;
	</script>
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Testo della pagina <b><?php echo $titolo_pagina;?></b></b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=pagine_mod&id_rec=<?php  echo $id_rec; ?><?php  echo $rif; ?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
			
			
			<div class="mws-form-row">
				<label class="mws-form-label">Testo</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo"><?php  echo $n_testo; ?></textarea>
				</div>
			</div>
				
			<br/><br/>
				
			<div class="mws-form-row">
				<label class="mws-form-label">Testo Inglese</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" name="testo_eng"><?php  echo $n_testo_eng; ?></textarea>
				</div>
			</div>
				
			<br/><br/>
			
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
