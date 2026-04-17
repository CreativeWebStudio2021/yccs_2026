<?php 
$table="ordini";

$criterio="";
$rif="";
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['stato_ric'])) $stato_ric=$_GET['stato_ric']; else $stato_ric='';
if(isset($_GET['num_ric'])) $num_ric=$_GET['num_ric']; else $num_ric='';
if(isset($_GET['cognome_ric'])) $cognome_ric=$_GET['cognome_ric']; else $cognome_ric='';
if(isset($_GET['email_ric'])) $email_ric=$_GET['email_ric']; else $email_ric='';
if(isset($_GET['dal_ric'])) $dal_ric=$_GET['dal_ric']; else $dal_ric='';
if(isset($_GET['al_ric'])) $al_ric=$_GET['al_ric']; else $al_ric='';

if($stato_ric!="") { 
	if($stato_ric=="aperti") $criterio.=" AND ( status = 'nuovo' OR status = 'pagato' )"; 
	if($stato_ric=="evasi") $criterio.=" AND status = 'spedito'"; 
	if($stato_ric=="annullati") $criterio.=" AND status = 'annullato'"; 
	if($stato_ric=="cancellati") $criterio.=" AND status = 'cancellato'"; 
	$rif.="&stato_ric=$stato_ric"; 
}
if($num_ric!="") { $criterio.=" AND id = '$num_ric'"; $rif.="&num_ric=$num_ric"; }
if($cognome_ric!="") { $criterio.=" AND nome LIKE '%$cognome_ric%'"; $rif.="&cognome_ric=$cognome_ric"; }
if($email_ric!="") { $criterio.=" AND email LIKE '%$email_ric%'"; $rif.="&email_ric=$email_ric"; }
if($dal_ric!="") { echo $dal_ric;
	$temp=explode("-",$dal_ric);
	$data_dal=$temp[2]."-".$temp[1]."-".$temp[0];
	$criterio.=" AND data_ord >= '$data_dal'"; 
	$rif.="&dal_ric=$dal_ric"; 
}
if($al_ric!="") {
	$temp=explode("-",$al_ric);
	$data_al=$temp[2]."-".$temp[1]."-".$temp[0];
	$criterio.=" AND data_ord <= '$data_al : 23:59:59'"; 
	$rif.="&al_ric=$al_ric"; 
}
$rif.="&pag_att=$pag_att";

if($_SESSION["acl_login"]<300)
	$criterio.=" AND status <> 'cancellato'"; 

if($conferma)
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc", "id_rife", "$id_rife") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc", "id_rife", "$id_rife") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc", "id_rife", "$id_rife") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc", "id_rife", "$id_rife") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos", "id_rife", "$id_rife") ;	
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	
	$stato_orig = "cancellato";
	
	$query_disev = "update ordini set status='$stato_orig', data_mod='".date('Y-m-d H:i:s')."' where id='$id_rec'";
	$open_connection->connection->query($query_disev);	
	
	/* ripristino le quantità del prodotto*/
	$query_prod="SELECT id_prod, quantita FROM ordini_prod WHERE id_ord='$id_rec'";
	$resu_prod=$open_connection->connection->query($query_prod);
	while($risu_prod=$resu_prod->fetch()){
		$query_quant="SELECT quantita FROM prodotti WHERE id='".$risu_prod['id_prod']."'";
		$resu_quant=$open_connection->connection->query($query_quant);
		list($quant)=$resu_quant->fetch();
		
		$query_up="UPDATE prodotti SET quantita='".($quant + $risu_prod['quantita'])."' WHERE id='".$risu_prod['id_prod']."'";
		//echo $query_up."<br/>";
		$risu_up=$open_connection->connection->query($query_up);
	}
	
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){		
		$query_disev = "update ordini set status='$stato_orig', data_mod='".date('Y-m-d H:i:s')."' where id='".$temp[$z]."'";
		//echo $query_disev."<br/>";
		$open_connection->connection->query($query_disev);	
		
		/* ripristino le quantità del prodotto*/
		$query_prod="SELECT id_prod, quantita FROM ordini_prod WHERE id_ord='".$temp[$z]."'";
		//echo $query_prod."<br/>";
		$resu_prod=$open_connection->connection->query($query_prod);
		while($risu_prod=$resu_prod->fetch()){
			$query_quant="SELECT quantita FROM prodotti WHERE id='".$risu_prod['id_prod']."'";
			$resu_quant=$open_connection->connection->query($query_quant);
			list($quant)=$resu_quant->fetch();
			
			$query_up="UPDATE prodotti SET quantita='".($quant + $risu_prod['quantita'])."' WHERE id='".$risu_prod['id_prod']."'";
			//echo $query_up."<br/>";
			$risu_up=$open_connection->connection->query($query_up);
		}
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		</script>
	<?php 	
}

if($azione=="annulla_sel") {
	$stato_orig = "annullato";
	$data_pagato = "";
	
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){		
		$query_disev = "update ordini set status='$stato_orig', data_pagato= NULL , data_mod='".date('Y-m-d H:i:s')."' where id='".$temp[$z]."'";
		//echo $query_disev;
		$open_connection->connection->query($query_disev);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		</script>
	<?php 	
}


if($azione=="evadi")
{
	$query_ev = "update ordini set status='spedito',data_mod='".date('Y-m-d H:i:s')."' where id=$id_rec";
	$open_connection->connection->query($query_ev);	
	?>
	<script>
		window.location='<?php echo $http;?>://<?php echo $ind_sito;?>/mail_evadi.php?id_rec=<?php echo $id_rec;?><?php echo $rif;?>';
	</script>
	<?php 
}

if($azione=="disevadi")
{
	$stato_orig = "nuovo";
	
	$data_pagato = "";
	$query_pagato = "select data_pagato from ordini where id='$id_rec'";
	$risu_pagato = $open_connection->connection->query($query_pagato);
	if ($risu_pagato) list($data_pagato) = $risu_pagato->fetch();
	
	if ($data_pagato!="") $stato_orig = "pagato";
	
	$query_disev = "update ordini set status='$stato_orig',data_mod='".date('Y-m-d H:i:s')."' where id='$id_rec'";
	$open_connection->connection->query($query_disev);	
}

if($azione=="annulla")
{
	$stato_orig = "annullato";
	
	$data_pagato = "";
	
	$query_disev = "update ordini set status='$stato_orig', data_pagato= NULL , data_mod='".date('Y-m-d H:i:s')."' where id='$id_rec'";
	echo $query_disev;
	$open_connection->connection->query($query_disev);	
}

if($azione=="canc")
{	
	$stato_orig = "cancellato";
	
	$query_disev = "update ordini set status='$stato_orig', data_mod='".date('Y-m-d H:i:s')."' where id='$id_rec'";
	$risu_disev=$open_connection->connection->query($query_disev);	
	
	/* ripristino le quantità del prodotto */
	$query_prod="SELECT id_prod, quantita, taglia FROM ordini_prod WHERE id_ord='$id_rec'";
	$resu_prod=$open_connection->connection->query($query_prod);
	while($risu_prod=$resu_prod->fetch()){
		if($risu_prod['taglia'] && $risu_prod['taglia']!=""){
			$query_p="SELECT tipo_taglia FROM prodotti WHERE id='".$risu_prod['id_prod']."'";
			$resu_p=$open_connection->connection->query($query_p);
			list($tipo_taglia)=$resu_p->fetch();
			$query_t="SELECT id FROM valori_taglia WHERE id_tipo='$tipo_taglia' AND valore='".$risu_prod['taglia']."'";
			$resu_t=$open_connection->connection->query($query_t);
			list($id_taglia)=$resu_t->fetch();
			if($id_taglia){ //se non c'è, il nome della taglia potrebbe essere stata modificata ma la considero comunque un'altra taglia
				$query_quant="SELECT quantita FROM quantita_taglie WHERE id_prodotto='".$risu_prod['id_prod']."' AND id_valore='$id_taglia'";
				$resu_quant=$open_connection->connection->query($query_quant);
				list($quant)=$resu_quant->fetch();
			}
		}else{
			$query_quant="SELECT quantita FROM prodotti WHERE id='".$risu_prod['id_prod']."'";
			$resu_quant=$open_connection->connection->query($query_quant);
			list($quant)=$resu_quant->fetch();			
		}
		if($risu_prod['taglia'] && $id_taglia!="" && $id_taglia!="0"){
			$query_up="UPDATE quantita_taglie SET quantita='".($quant + $risu_prod['quantita'])."' WHERE id_prodotto='".$risu_prod['id_prod']."' AND id_valore='".$id_taglia."'";
		}else{
			$query_up="UPDATE prodotti SET quantita='".($quant + $risu_prod['quantita'])."' WHERE id='".$risu_prod['id_prod']."'";
		}
		$risu_up=$open_connection->connection->query($query_up);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?>&azione=cancella_sel&lista='+lista_del;
			
			document.getElementById('annulla_sel').style.display="block";
			document.getElementById('annulla_sel').href='admin.php?cmd=<?php echo $table;?>&azione=annulla_sel&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
			document.getElementById('annulla_sel').style.display="none";
		}
	}
	
	function aggiugni_tutti(){
		start = document.getElementById('start').innerHTML;
		end = document.getElementById('end').innerHTML;
		total = document.getElementById('total').innerHTML;

		if(document.getElementById('check_tutti').checked){
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[i]+";";
			}
			for(i=start; i<=end; i++){
				document.getElementById('check_'+i).checked=true;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?>&azione=cancella_sel&lista='+lista_tutti;
			document.getElementById('annulla_sel').style.display="block";
			document.getElementById('annulla_sel').href='admin.php?cmd=<?php echo $table;?>&azione=annulla_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			for(i=start; i<=total; i++){
				document.getElementById('check_'+i).checked=false;
			}
			document.getElementById('cancella_sel').style.display="none";
			document.getElementById('annulla_sel').style.display="none";
		}	
	}
	
	function set_sotto(id_cat){
		var stringa="";
		<?php 
		$query_ct="SELECT id FROM categorie ORDER BY id ASC";
		$resu_ct=$open_connection->connection->query($query_ct);
		while($risu_ct=$resu_ct->fetch()){?>
			if (id_cat=='<?php echo $risu_ct['id'];?>'){
				stringa+='<select name="ric_sottocat" class="small" style="width:90%">';
				stringa+='<option value="">Seleziona</option>';		
				<?php 
				$query_sc="SELECT * FROM sottocategorie WHERE id_rife='".$risu_ct['id']."'";
				$resu_sc=$open_connection->connection->query($query_sc);
				$num_sc=$resu_sc->rowCount();
				if($num_sc>0){
					while($risu_sc=$resu_sc->fetch()){?>
						stringa+='<option value="<?php echo $risu_sc['id'];?>"><?php echo $risu_sc['nome'];?></option>';		
					<?php }?>
					stringa+='</select>';
				<?php }else{?>
					stringa='<select name="ric_sottocat" class="small" style="width:90%" disabled>';
					stringa+='<option value=""></option>';		
					stringa+='</select>';
				<?php }?>
			}
		<?php }?>
		if(id_cat==""){
			stringa+='<select name="ric_sottocat" class="small" style="width:90%" disabled>';
			stringa+='<option value=""></option>';		
			stringa+='</select>';
		}
		document.getElementById('select_sottocat').innerHTML=stringa;
	}
</script>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b><?php echo ucfirst($table);?></b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<iframe src="" style="display:none" id="frame_action"></iframe>
	<iframe src="" style="display:none" id="frame_action2"></iframe>
	
	<script type="text/javascript">
		var open=0;
		function apri_ricerca(){
			if(open==0){
				open=1;
				$("#searchPanel").animate({height:"260px"});
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
		<form name="ricerca" class="mws-form" action="admin.php" method="GET" enctype="multipart/form-data">
			<input type="hidden" name="ric_stato" value="inviato">
			<input type="hidden" name="cmd" value="<?php echo $table;?>">
			
			<div class="mws-form-inline">
				
				<div class="mws-form-row">
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Stato Ordine</label>						
					</div>
					<div style="float:left; width:35%;">
						<select name="stato_ric" class="small" style="width:90%">
								<option value="">Tutti</option>		
							<option value="aperti" <?php if($stato_ric=="aperti"){?>selected="selected"<?php }?>>Ordini Aperti</option>		
							<option value="evasi" <?php if($stato_ric=="evasi"){?>selected="selected"<?php }?>>Ordini Evasi</option>		
							<option value="annullati" <?php if($stato_ric=="annullati"){?>selected="selected"<?php }?>>Ordini Annullati</option>	
							<?php if($_SESSION["acl_login"]>200){?>
								<option value="cancellati" <?php if($stato_ric=="cancellati"){?>selected="selected"<?php }?>>Ordini Cancellati (solo Admin)</option>	
							<?php }?>
							
						</select>
					</div>
					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Num. Ordine</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="num_ric" value="<?php echo $num_ric;?>"  style="width:20%"/>
					</div>
					<div style="clear:both;"></div>
				</div>				
				
				<div class="mws-form-row">
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Dal</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="dal_ric" class="mws-datepicker large"  value="<?php echo $dal_ric;?>" readonly="readonly" style="width:90%">
					</div>
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Al</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="al_ric" class="mws-datepicker large"  value="<?php echo $al_ric;?>" readonly="readonly" style="width:90%">
					</div>
					<div style="clear:both;"></div>
				</div>		
				
				<div class="mws-form-row">
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Cognome</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="cognome_ric" value="<?php echo $cognome_ric;?>"  style="width:90%"/>
					</div>
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Email</label>						
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="email_ric" value="<?php echo $email_ric;?>"  style="width:90%"/>
					</div>
					<div style="clear:both;"></div>
				</div>
				
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Cerca" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="window.location='admin.php?cmd=<?php echo $table;?>'">
			</div>
		</form>
	</div>
	<?php 
	$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY data_ord DESC";			
	//echo $query_ele;
	?>
	<div style="height:30px;width:100%;text-align:right; margin-top:15px"></div>
	
	<?php 
	$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY data_ord DESC";			
	$risu_ele = $open_connection->connection->query($query_ele);
	
	$num_ele = 0;
	if($risu_ele){
		$num_ele = $risu_ele->rowCount();
		$num_ord=0;
		$tot_ord=0;
		while($risu_tot=$risu_ele->fetch()){
			$totale = $risu_tot['totale'];
			$tot_ord=$tot_ord + $totale;
		}
	}
	?>
	<?php if($stato_ric=="aperti" || $stato_ric=="evasi"){?>
		<div style="float:left;" id="num_ord"><b>Numero ordini</b>: <?php echo $num_ele;?></div>
		<div style="float:left;margin-left:20px;" id="tot_ord"><b>Totale</b>: <?php echo number_format($tot_ord, 2, ',', '.');?></div>
		<div style="clear:both"></div>
	<?php }?>
	
	<div class="mws-panel-header" style="position:relative;">
		<span><i class="icon-table"></i> Elenco <?php echo $table;?></span>
		<div style="position:absolute; top:13px; right:20px; z-index:11">
			
		</div>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="text-align:center; width:40px">Cod.</th>			
					<th style="min-width:30px" id="blocco_5">Data Invio</th>
					<th style="" id="blocco_5">Cliente</th>
					<th style="min-width:30px" id="blocco_6">Totale</th>
					<th style="min-width:30px" id="blocco_6">Stato</th>
					<th style="min-width:30px" id="blocco_6">Pagato il</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 			
				if($num_ele>0)
				{				
									
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY data_ord DESC LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						if(isset($arr_ele['data_ord'])){
							$temp=explode(" ",$arr_ele['data_ord']);
							$temp2=explode("-",$temp[0]);
							$data_ord = $temp2[2]."-".$temp2[1]."-".$temp2[0];
						}else $data_ord = "0000-00-00";
						$nome = $arr_ele['nome'];
						$email = $arr_ele['email'];
						$totale = $arr_ele['totale'];
						$spese = $arr_ele['spese'];
						$status = $arr_ele['status'];
						$pagamento = $arr_ele['pagamento'];
						if($arr_ele['data_pagato'] && $arr_ele['data_pagato']!=""){
							$temp=explode(" ",$arr_ele['data_pagato']);
							$temp2=explode("-",$temp[0]);
							$data_pagato = $temp2[2]."-".$temp2[1]."-".$temp2[0];
						}else $data_pagato = "";
						$id_campo = $arr_ele['id'];
						?>
						
						<script type="text/javascript">
							lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
						</script>
						<tr>
							<td align="center" valign="center">
								<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
							</td>
							<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
							<td valign="center" style="line-height:14px; text-align:center;">
								<b><?php echo $id_campo;?></b>
							</td>
							
							<td  align="center" valign="center" id="vis_<?php echo $id_campo;?>">
								<?php echo $data_ord;?>
							</td>
							
							<td  align="left" valign="center" id="vis_<?php echo $id_campo;?>">
								<a href="admin.php?cmd=clienti_mod&id_rec=<?php echo $arr_ele['id_cliente'];?>" style="text-decoration:underline; color:#333333">
									<?php echo $nome;?><br/>
								</a>
								<a href="mailto:<?php echo $email;?>" style="color:#111"><?php echo $email;?></a>
							</td>
							
							<td  align="right" valign="center" id="vis_ing_<?php echo $id_campo;?>">
								<?php echo number_format($totale, 2, ',', '.');?> &euro;
							</td>
							
							<td  align="center" valign="center" id="vis_ing_<?php echo $id_campo;?>" style="<?php if($status=="annullato" || $status=="cancellato"){?>color:red;<?php }elseif($status=="pagato" || $status=="spedito"){?>color:green;<?php }?> <?php if($status=="cancellato" || $status=="spedito"){?>font-weight:bold;<?php }?>">
								<?php echo $status;?>
							</td>
							
							<td  align="center" valign="center" id="vis_ing_<?php echo $id_campo;?>">
								<?php echo $data_pagato;?>
							</td>							
							
							<td style="width:10%" valign="center">
								<span class="btn-group">
									<a href="admin.php?cmd=<?php echo $table;?>-dett&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="fa fa-search"></i></a>
									<?php if($status!='cancellato'){?>
										<?php if($status!='spedito' && $status!='annullato'){
											if ($status=="pagato" || $pagamento=="Contrassegno"){?>
												<a href="admin.php?cmd=ordini&azione=evadi&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small" title="Evadi"><i class="fa fa-paper-plane-o"></i></a>
											<?php }else{?>
												<a href="" style="pointer-events: none; cursor: default;" class="btn btn-small">&nbsp;&nbsp;&nbsp;</a>
											<?php }?>
										<?php }elseif($status=='spedito'){?>									
											<a href="admin.php?cmd=ordini&azione=disevadi&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small" title="Riporta tra gli ordini aperti"><i class="fa fa-refresh"></i></a>
										<?php }else{?>
											<a href="" style="pointer-events: none; cursor: default;" class="btn btn-small">&nbsp;&nbsp;&nbsp;</a>
										<?php }?>
										<?php if($status!='annullato'){?>
											<a href="admin.php?cmd=<?php echo $table;?>&azione=annulla&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small" onclick="return confirm('L\'ordine verrà spostato nella sezione \'Ordini Annullati\' e verranno persi eventuali riferimenti a pagamenti effettuati. Confermi l\'annullamento?');"><i class="fa fa-times"></i></a>
										<?php }else{?>
											<a href="" style="pointer-events: none; cursor: default;" class="btn btn-small">&nbsp;&nbsp;&nbsp;</a>
										<?php }?>
										<a href="admin.php?cmd=<?php echo $table;?>&azione=canc&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small" onclick="return confirm('L\'ordine verrà definitivamente cancellato e le quantità di magazzino dei prodotti verranno ripristinate. Confermi la cancellazione?');"><i class="icon-trash"></i></a>
									<?php }else{?>
										<a href="" style="pointer-events: none; cursor: default;" class="btn btn-small">&nbsp;&nbsp;&nbsp;</a>
										<a href="" style="pointer-events: none; cursor: default;" class="btn btn-small">&nbsp;&nbsp;&nbsp;</a>
										<a href="" style="pointer-events: none; cursor: default;" class="btn btn-small">&nbsp;&nbsp;&nbsp;</a>
									<?php }?>
								</span>
							</td>
						</tr>
						<?php /*$num_ord++; $tot_ord=$tot_ord + $totale;*/
					}
				}?>
				<?php /*if($stato_ric=="aperti" || $stato_ric=="evasi"){?>
					<script type="text/javascript">
						document.getElementById('num_ord').innerHTML='<b>Numero ordini</b>: <?php echo $num_ord;?>';
						document.getElementById('tot_ord').innerHTML='<b>Totale</b>: <?php echo  number_format($tot_ord, 2, ',', '.');?> &euro;';
					</script>
				<?php }*/?>
			</tbody>
		</table>
		
		<?php include("fissi/multipagina.inc.php");?>
		
		<a href=""  onClick="return confirm('Gli ordini verranno spostati nella sezione \'Ordini Annullati\' e verranno persi eventuali riferimenti a pagamenti effettuati. Confermi l\'annullamento?')" id="annulla_sel" style="display:none;"><div style="padding:5px"><input type="button" value="ANNULLA SELEZIONATI"/></div></a>
		<a href=""  onClick="return confirm('Gli ordini verranno definitivamente cancellati e le quantità di magazzino dei prodotti verranno ripristinate. Confermi la cancellazione?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>