<script language="javascript">
function verifica_form(n){
	document.form_cancella.stato.value = n;
	document.form_cancella.submit();
}
</script>

<script language="javascript">
function verifica_ricerca(s){

	/*cogn = document.cerca_utente.cogn.value;
	nome = document.cerca_utente.nome.value;
	data_iscr_da = document.cerca_utente.data_iscr_da.value;
	data_iscr_a = document.cerca_utente.data_iscr_a.value;
	citta = document.cerca_utente.citta.value;
	tipo = document.cerca_utente.versione.value;
		
	if((cogn=="") && (nome=="") && (data_iscr_da=="") && (data_iscr_a=="") && (tipo=="") && (citta=="")){
		window.alert("Attenzione: occorre compilare almeno un campo!");
		document.cerca_utente.cogn.focus();
	}else{*/
		document.form_ricerca.stato_cerca.value = s;
		document.form_ricerca.submit();
	/*}*/

}
</script>
<?php 
$table="clienti";
$criterio="news='1'";
$rif="";

if(isset($_GET['ragsoc_ric'])) $ragsoc_ric=$_GET['ragsoc_ric']; else $ragsoc_ric='';
if(isset($_GET['nome_ric'])) $nome_ric=$_GET['nome_ric']; else $nome_ric='';
if(isset($_GET['citta_ric'])) $citta_ric=$_GET['citta_ric']; else $citta_ric='';
if(isset($_GET['provincia_ric'])) $provincia_ric=$_GET['provincia_ric']; else $provincia_ric='';
if(isset($_GET['dal_ric'])) $dal_ric=$_GET['dal_ric']; else $dal_ric='';
if(isset($_GET['al_ric'])) $al_ric=$_GET['al_ric']; else $al_ric='';
if(isset($_GET['cap_da_ric'])) $cap_da_ric=$_GET['cap_da_ric']; else $cap_da_ric='';
if(isset($_GET['cap_a_ric'])) $cap_a_ric=$_GET['cap_a_ric']; else $cap_a_ric='';

if($ragsoc_ric!="") { $criterio.=" AND rag_sociale like '%$ragsoc_ric%'"; $rif.="&ragsoc_ric=$ragsoc_ric"; }
if($nome_ric!="") { $criterio.=" AND nome LIKE '%$nome_ric%'"; $rif.="&nome_ric=$nome_ric"; }
if($citta_ric!="") { $criterio.=" AND citta LIKE '%$citta_ric%'"; $rif.="&citta_ric=$citta_ric"; }
if($provincia_ric!="") { $criterio.=" AND provincia LIKE '%$provincia_ric%'"; $rif.="&provincia_ric=$provincia_ric"; }
if($dal_ric!="") { 
	$temp=explode("-",$dal_ric);
	$data_dal=$temp[2]."-".$temp[1]."-".$temp[0];
	$criterio.=" AND data_iscr >= '$data_dal'"; 
	$rif.="&dal_ric=$dal_ric"; 
}
if($al_ric!="") {
	$temp=explode("-",$al_ric);
	$data_al=$temp[2]."-".$temp[1]."-".$temp[0];
	$criterio.=" AND data_iscr <= '$data_al : 23:59:59'"; 
	$rif.="&al_ric=$al_ric"; 
}
if($cap_da_ric!="") { 
	$criterio.=" AND cap >= '$cap_da_ric'"; 
	$rif.="&cap_da_ric=$cap_da_ric"; 
}
if($cap_a_ric!="") {
	$criterio.=" AND cap <= '$cap_a_ric'"; 
	$rif.="&cap_a_ric=$cap_a_ric"; 
}
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
//$rif.="&pag_att=$pag_att";

if($conferma)
{	
	if(!$id_canc) 
		$id_canc =  $_POST['conferma']; /* dal $.post di ajax */
		
	$query_canc = "delete from clienti where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
?>
	<script language="javascript">
		window.alert('Il campo e\' stato cancellato con successo.');
		window.location="admin.php?cmd=rubrica<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if ($azione=="attiva") $query_nov = $open_connection->connection->query("update clienti set selezionato='1' where id='$id_canc'");
	if ($azione=="disattiva") $query_nov = $open_connection->connection->query("update clienti set selezionato='0' where id='$id_canc'");
}

if(isset($_GET['stato_cerca'])){
	$stato_cerca = $_GET['stato_cerca'];
}elseif(isset($_POST['stato_cerca'])) {
	$stato_cerca = $_POST['stato_cerca'];
}else{
	$stato_cerca=0;
}

if(isset($_GET['stato'])){
	$stato = $_GET['stato'];
}elseif(isset($_POST['stato'])) {
	$stato = $_POST['stato'];
}else{
	$stato=0;
}

/* Parte dedicata alla cancellazione su ricerca */
if ($stato_cerca==1 || $stato_cerca==2) {
													
	/* Cancello gli utenti risultanti dalla ricerca */
	if ($stato_cerca==2) {
		$query_agg = "update clienti set selezionato='1' where $criterio";
		$risu_agg = $open_connection->connection->query($query_agg);
	}
	
	/* Aggiungo gli utenti risultanti dalla ricerca */
	if ($stato_cerca==1) {
		$query_eli = "update clienti set selezionato='0' where $criterio";
		$risu_eli = $open_connection->connection->query($query_eli);
	}
	
}

/* Parte dedicata all'eliminazione di tutti i contatti */
if($stato==3){
	$query_canc_tutti = "update clienti set selezionato='0'";
	$risu_canc_tutti  = $open_connection->connection->query($query_canc_tutti);
}

/* Parte dedicata alla selezione di tutti i contatti */
if($stato==4){
	$query_ins_tutti = "update clienti set selezionato='1'";
	$risu_ins_tutti  = $open_connection->connection->query($query_ins_tutti);
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		/*$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/$img")) @unlink("img_up/$img");
		}*/
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=rubrica<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";';
		</script>
	<?php 	
}
?>
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
			document.getElementById('cancella_sel').href='admin.php?cmd=rubrica<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
		}
	}
	
	function aggiugni_tutti(){
		start = document.getElementById('start').innerHTML;
		end = document.getElementById('end').innerHTML;
		total = document.getElementById('total').innerHTML;
		
		if(document.getElementById('check_tutti').checked){
			ind_lista = 0;
			ind_check = 1;
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[ind_lista]+";";
				ind_lista++;
			}
			for(i=start; i<=end; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=true;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=rubrica<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			ind_check = 1;
			for(i=start; i<=total; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=false;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}
</script>
<div class="mws-panel grid_8">
	<div style="height:30px;font-size:1.2em;padding-top:10px"><b>Rubrica</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
		
	<script type="text/javascript">
		var open=0;
		function apri_ricerca(){
			if(open==0){
				open=1;
				$("#searchPanel").animate({height:"375px"});
				document.getElementById('searchHeader').innerHTML='<span><i class="fa fa-search-minus" style="color:#fff"></i> Ricerca</span>';
			} else {
				open=0;
				$("#searchPanel").animate({height:"0px"});
				document.getElementById('searchHeader').innerHTML='<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca</span>';
			}
		}
	</script>
	
	<div class="mws-panel-header" style="cursor:pointer;" onclick="apri_ricerca();" id="searchHeader">
		<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca</span>
	</div>
	<div class="mws-panel-body no-padding" style="height:0px; overflow:hidden" id="searchPanel">
		<form name="form_ricerca" class="mws-form" action="admin.php" method="GET" enctype="multipart/form-data">
			<input type="hidden" name="stato_cerca" value="0">
			<input type="hidden" name="cmd" value="rubrica">
			
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Ragione sociale</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="ragsoc_ric" value="<?php echo $ragsoc_ric;?>"  style="width:90%"/>
					</div>
					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Nome referente</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="nome_ric" value="<?php echo $nome_ric;?>"  style="width:90%"/>
					</div>
					<div style="clear:both;"></div>
				</div>				
								
				<div class="mws-form-row">
					<div style="float:left; width:15%;"><label class="mws-form-label">Data iscrizione</label></div>	
					<div style="float:left; width:10%;">
						<label class="mws-form-label">Dal</label>						
					</div>
					<div style="float:left; width:25%;">
						<input type="text" name="dal_ric" class="mws-datepicker large"  value="<?php echo $dal_ric;?>" readonly="readonly" style="width:90%">
					</div>
					<div style="float:left; width:10%;">
						<label class="mws-form-label">Al</label>						
					</div>
					<div style="float:left; width:25%;">
						<input type="text" name="al_ric" class="mws-datepicker large"  value="<?php echo $al_ric;?>" readonly="readonly" style="width:90%">
					</div>
					<div style="clear:both;"></div>
				</div>	
				
				<div class="mws-form-row">
					<div style="float:left; width:15%;"><label class="mws-form-label">Cap</label></div>	
					<div style="float:left; width:10%;">
						<label class="mws-form-label">Da</label>						
					</div>
					<div style="float:left; width:25%;">
						<input type="text" name="cap_da_ric" class="mws-datepicker large"  value="<?php echo $cap_da_ric;?>" style="width:90%">
					</div>
					<div style="float:left; width:10%;">
						<label class="mws-form-label">A</label>						
					</div>
					<div style="float:left; width:25%;">
						<input type="text" name="cap_a_ric" class="mws-datepicker large"  value="<?php echo $cap_a_ric;?>" style="width:90%">
					</div>
					<div style="clear:both;"></div>
				</div>	
				
				<div class="mws-form-row">
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Citt&agrave;</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="citta_ric" value="<?php echo $citta_ric;?>"  style="width:90%"/>
					</div>
					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Provincia</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="provincia_ric" value="<?php echo $provincia_ric;?>"  style="width:90%"/>
					</div>
					<div style="clear:both;"></div>
				</div>		
				
			</div>
			<div class="mws-button-row">
				<input type="button" value="Elimina i contatti selezionati con la ricerca" class="btn btn-danger" onclick="verifica_ricerca(1)">
				<input type="button" value="Inserisci i contatti selezionati con la ricerca" class="btn" onclick="verifica_ricerca(2)" style="margin-left:20px">
			</form>
			
			<form name="form_cancella" method="post" action="admin.php?cmd=rubrica" enctype="multipart/form-data" style="margin-top:20px">
				<input type="hidden" name="stato" value="0">
				<input type="button" value="Elimina tutti i contatti" class="btn btn-danger" onclick="verifica_form(3)">
				<input type="button" value="Inserisci tutti i contatti" class="btn" onclick="verifica_form(4)" style="margin-left:20px">
			</form>
			</div>
	</div>
	<?php 
		$query_ele = "select * from clienti where $criterio order by id desc";
		$risu_ele = $open_connection->connection->query($query_ele);
		$num_ele = 0;
		if($risu_ele)
			$num_ele = $risu_ele->rowCount();
	?>
	<div class="mws-panel-header" style="clear:both;margin-top:40px">
		<span><i class="icon-table"></i> Elenco iscritti (<?php  echo $num_ele; ?>)</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<!--<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>-->
					<th style="width:20px"></th>
					<th>Data iscr.</th>
					<th>Rag. sociale</th>
					<th>Citt&agrave;</th>
					<th>E-mail</th>
					<th>Selezionato</th>
					<!--<th>Azioni</th>-->
				</tr>
			</thead>
			<tbody>
			<?php 
				if($num_ele>0)
				{	
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM clienti where $criterio ORDER BY id desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$nome = ucwords(trim($arr_ele['rag_sociale']));
						$citta = ucfirst(trim($arr_ele['citta']));
						$prov = ucfirst(trim($arr_ele['provincia']));
						$email = trim($arr_ele['email']);
						$data = $oggetto_admin->date_to_data($arr_ele['data_iscr']);
						$sel = $arr_ele['selezionato'];
						
						$str_citta = "";
						if ($citta!="" && $prov!="") $str_citta .= $citta." ($prov)";
							elseif ($citta!="") $str_citta .= $citta;
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<!--<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>-->
					<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
					<td><?php  echo $data; ?></td>
					<td><?php  echo $nome; ?></td>
					<td><?php  echo $str_citta; ?></td>
					<td><?php  echo $email; ?></td>
					<td style="text-align:center">
					<?php 
						if($sel==0) echo "<a href=\"admin.php?cmd=rubrica&id_canc=$id_campo&azione=attiva\"><img src=\"css/icons/icol32/accept_22_off.png\" alt=\"Testa\"/></a>";
							else echo "<a href=\"admin.php?cmd=rubrica&id_canc=$id_campo&azione=disattiva\"><img src=\"css/icons/icol32/accept_22.png\" alt=\"Testa di nuovo\"/></a>";
					?>
					</td>
					<!--<td style="width:10%;text-align:center">
						<span class="btn-group">
							<a href="admin.php?cmd=rubrica_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a href="admin.php?cmd=rubrica&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>-->
				</tr>
			<?php 
					}
				} 
			?>
			</tbody>
		</table>		
		<?php include("fissi/multipagina.inc.php");?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>