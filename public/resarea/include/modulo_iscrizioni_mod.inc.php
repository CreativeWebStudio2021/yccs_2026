<?php 
$table="edizioni_modulo_iscrizioni";
$rif="";

if(isset($_GET['id_rec'])) $id_rec=$_GET['id_rec']; else $id_rec='';

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif.="&id_rife=$id_rife";
if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if($id_riferimento!="") $rif.="&id_riferimento=$id_riferimento";

$query_rec = "select * from edizioni_regate where id='$id_riferimento'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_regata = $arr_rec['id_regata'];
$n_anno = $arr_rec['anno'];

$query_rec = "select * from $table where id_edizione='$id_riferimento'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

if(isset($arr_rec['data_limite'])) $n_data_limite = $arr_rec['data_limite']; else  $n_data_limite="0000-00-00";
$n_data_limite = $oggetto_admin->date_to_data($n_data_limite);
if($n_data_limite == "00-00-0000") $n_data_limite = "";
if(isset($arr_rec['testo_modulo_ita'])) $n_testo_modulo_ita = $arr_rec['testo_modulo_ita']; else $n_testo_modulo_ita = "";
if(isset($arr_rec['testo_modulo_eng'])) $n_testo_modulo_eng = $arr_rec['testo_modulo_eng']; else $n_testo_modulo_eng = "";
if(isset($arr_rec['membri'])) $n_membri = $arr_rec['membri']; else $n_membri="0";
if(isset($arr_rec['membri_valori'])) $n_membri_valori = $arr_rec['membri_valori']; else $n_membri_valori="YCCS, IMA";
if(isset($arr_rec['visibilita'])) $n_visibilita = $arr_rec['visibilita']; else $n_visibilita="0";
if(isset($arr_rec['maxi'])) $n_maxi = $arr_rec['maxi']; else $n_maxi="0";
if(isset($arr_rec['categorie'])) $n_categorie = $arr_rec['categorie']; else $n_categorie="0";
if(isset($arr_rec['boat_details'])) $n_boat_details = $arr_rec['boat_details']; else $n_boat_details="1";
if(isset($arr_rec['yacht_club'])) $n_yacht_club = $arr_rec['yacht_club']; else $n_yacht_club="1";
if(isset($arr_rec['yacht_club_valore'])) $n_yacht_club_valore = $arr_rec['yacht_club_valore']; else $n_yacht_club_valore="Yacht Club";
if(isset($arr_rec['yacht_club_valore2'])) $n_yacht_club_valore2 = $arr_rec['yacht_club_valore2']; else $n_yacht_club_valore2="Home Port";
if(isset($arr_rec['yacht_club_valore2_visib'])) $n_yacht_club_valore2_visib = $arr_rec['yacht_club_valore2_visib']; else $n_yacht_club_valore2_visib="1";
if(isset($arr_rec['charterer'])) $n_charterer = $arr_rec['charterer']; else $n_charterer="1";
if(isset($arr_rec['tipo_barca'])) $n_tipo_barca = $arr_rec['tipo_barca']; else $n_tipo_barca="0";
if(isset($arr_rec['tipo_barca_valori'])) $n_tipo_barca_valori = $arr_rec['tipo_barca_valori']; else $n_tipo_barca_valori="Offshore, Open, Cruise";
if(isset($arr_rec['captain'])) $n_captain = $arr_rec['captain']; else $n_captain="1";
if(isset($arr_rec['captain_valore'])) $n_captain_valore = $arr_rec['captain_valore']; else $n_captain_valore="Captain";
if(isset($arr_rec['captain_data_visib'])) $n_captain_data_visib = $arr_rec['captain_data_visib']; else $n_captain_data_visib="0";
if(isset($arr_rec['captain_data_obb'])) $n_captain_data_obb = $arr_rec['captain_data_obb']; else $n_captain_data_obb="0";
if(isset($arr_rec['captain_cell_visib'])) $n_captain_cell_visib = $arr_rec['captain_cell_visib']; else $n_captain_cell_visib="1";
if(isset($arr_rec['captain_cell_obb'])) $n_captain_cell_obb = $arr_rec['captain_cell_obb']; else $n_captain_cell_obb="0";
if(isset($arr_rec['captain_email_visib'])) $n_captain_email_visib = $arr_rec['captain_email_visib']; else $n_captain_email_visib="1";
if(isset($arr_rec['captain_email_obb'])) $n_captain_email_obb = $arr_rec['captain_email_obb']; else $n_captain_email_obb="0";
if(isset($arr_rec['captain_license_visib'])) $n_captain_license_visib = $arr_rec['captain_license_visib']; else $n_captain_license_visib="0";
if(isset($arr_rec['captain_license_obb'])) $n_captain_license_obb = $arr_rec['captain_license_obb']; else $n_captain_license_obb="0";
if(isset($arr_rec['helmsman'])) $n_helmsman = $arr_rec['helmsman']; else $n_helmsman="1";
if(isset($arr_rec['tactician'])) $n_tactician = $arr_rec['tactician']; else $n_tactician="1";
if(isset($arr_rec['support_boat'])) $n_support_boat = $arr_rec['support_boat']; else $n_support_boat="1";
if(isset($arr_rec['press_info'])) $n_press_info = $arr_rec['press_info']; else $n_press_info="1";
if(isset($arr_rec['partecipation'])) $n_partecipation = $arr_rec['partecipation']; else $n_partecipation="1";
if(isset($arr_rec['professional_crew'])) $n_professional_crew = $arr_rec['professional_crew']; else $n_professional_crew="1";
if(isset($arr_rec['owner_name'])) $n_owner_name = $arr_rec['owner_name']; else $n_owner_name="1";
if(isset($arr_rec['owner_name_valore'])) $n_owner_name_valore = $arr_rec['owner_name_valore']; else $n_owner_name_valore="Name of the Owner/Charterer/Boat Representative";
if(isset($arr_rec['owner_data_visib'])) $n_owner_data_visib = $arr_rec['owner_data_visib']; else $n_owner_data_visib="0";
if(isset($arr_rec['owner_data_obb'])) $n_owner_data_obb = $arr_rec['owner_data_obb']; else $n_owner_data_obb="0";
if(isset($arr_rec['owner_cell_visib'])) $n_owner_cell_visib = $arr_rec['owner_cell_visib']; else $n_owner_cell_visib="0";
if(isset($arr_rec['owner_cell_obb'])) $n_owner_cell_obb = $arr_rec['owner_cell_obb']; else $n_owner_cell_obb="0";
if(isset($arr_rec['owner_email_visib'])) $n_owner_email_visib = $arr_rec['owner_email_visib']; else $n_owner_email_visib="0";
if(isset($arr_rec['owner_email_obb'])) $n_owner_email_obb = $arr_rec['owner_email_obb']; else $n_owner_email_obb="0";
if(isset($arr_rec['owner_license_visib'])) $n_owner_license_visib = $arr_rec['owner_license_visib']; else $n_owner_license_visib="0";
if(isset($arr_rec['owner_license_obb'])) $n_owner_license_obb = $arr_rec['owner_license_obb']; else $n_owner_license_obb="0";
if(isset($arr_rec['pagamenti'])) $n_pagamenti = $arr_rec['pagamenti']; else $n_pagamenti="1";
if(isset($arr_rec['pagamenti_testo_ita'])) $n_pagamenti_testo_ita = $arr_rec['pagamenti_testo_ita']; else $n_pagamenti_testo_ita = "";
if(isset($arr_rec['pagamenti_testo_eng'])) $n_pagamenti_testo_eng = $arr_rec['pagamenti_testo_eng']; else $n_pagamenti_testo_eng = "";
if(isset($arr_rec['allegati'])) $n_allegati = $arr_rec['allegati']; else $n_allegati="1";
if(isset($arr_rec['data_team'])) $n_data_team = $arr_rec['data_team']; else $n_data_team="0";
if(isset($arr_rec['equipaggio'])) $n_equipaggio = $arr_rec['equipaggio']; else $n_equipaggio="0";
if(isset($arr_rec['disclaimer'])) $n_disclaimer = $arr_rec['disclaimer'];  else $n_disclaimer="";
if(isset($arr_rec['disclaimer_visib'])) $n_disclaimer_visib = $arr_rec['disclaimer_visib'];  else $n_disclaimer_visib="1";
if(isset($arr_rec['testo_privacy_ita'])) $n_testo_privacy_ita = $arr_rec['testo_privacy_ita'];  else $n_testo_privacy_ita="I HAVE READ THE PRIVACY POLICY (ON REVERSE) AND AUTHORISE PROCESSING OF MY PERSONAL DATA.";
if(isset($arr_rec['testo_privacy_eng'])) $n_testo_privacy_eng = $arr_rec['testo_privacy_eng'];  else $n_testo_privacy_eng="I HAVE READ THE PRIVACY POLICY (ON REVERSE) AND AUTHORISE PROCESSING OF MY PERSONAL DATA.";
if(isset($arr_rec['avviso'])) $n_avviso = $arr_rec['avviso'];  else $n_avviso = "";
if(!isset($arr_rec['testo']) || $arr_rec['testo']===NULL) $n_testo="Entries shall be received by the Organizing Authority by xx/xx/xxxx accompanied by the entry fee."; else $n_testo = $arr_rec['testo'];
if(!isset($arr_rec['testo_eng']) || $arr_rec['testo_eng']===NULL) $n_testo_eng="Entries shall be received by the Organizing Authority by xx/xx/xxxx accompanied by the entry fee."; else $n_testo_eng = $arr_rec['testo_eng'];  
if(!isset($arr_rec['intestazione_mail']) || $arr_rec['intestazione_mail']===NULL)  
	$n_intestazione_mail="<b><span style=\"color:#0079c2\">YACHT CLUB COSTA SMERALDA</span></b>
							<br/>Via della marina
							<br/>07021 Porto Cervo (Italy)
							<br/><span style=\"color:#0079c2\">Tel:</span> (+39) 0789 902200
							<br/><span style=\"color:#0079c2\">Fax:</span> (+39) 0789 91257
							<br/><a href=\"mailto:$mail_sito\" class=\"menu\">$mail_sito</a>
							<br/><a href=\"$http://$ind_sito\" class=\"menu\">$ind_sito</a>";
	else $n_intestazione_mail = $arr_rec['intestazione_mail']; 
if(isset($arr_rec['sconto'])) $n_sconto = $arr_rec['sconto']; else $n_sconto = "";
if(isset($arr_rec['valore_sconto'])) $n_valore_sconto = $arr_rec['valore_sconto'];  else $n_valore_sconto = "";
if(isset($arr_rec['prezzo_1'])) $n_prezzo_1 = $arr_rec['prezzo_1'];  else $n_prezzo_1 = "";
if(isset($arr_rec['descrizione_prezzo_1'])) $n_descrizione_prezzo_1 = $arr_rec['descrizione_prezzo_1'];  else $n_descrizione_prezzo_1 = "";
if(isset($arr_rec['prezzo_2'])) $n_prezzo_2 = $arr_rec['prezzo_2'];  else $n_prezzo_2 = "";
if(isset($arr_rec['descrizione_prezzo_2'])) $n_descrizione_prezzo_2 = $arr_rec['descrizione_prezzo_2'];  else $n_descrizione_prezzo_2 = "";
if(isset($arr_rec['prezzo_3'])) $n_prezzo_3 = $arr_rec['prezzo_3'];  else $n_prezzo_3 = "";
if(isset($arr_rec['descrizione_prezzo_3'])) $n_descrizione_prezzo_3 = $arr_rec['descrizione_prezzo_3'];  else $n_descrizione_prezzo_3 = "";
if(isset($arr_rec['prezzo_4'])) $n_prezzo_4 = $arr_rec['prezzo_4'];  else $n_prezzo_4 = "";
if(isset($arr_rec['descrizione_prezzo_4'])) $n_descrizione_prezzo_4 = $arr_rec['descrizione_prezzo_4'];  else $n_descrizione_prezzo_4 = "";
if(isset($arr_rec['prezzo_5'])) $n_prezzo_5 = $arr_rec['prezzo_5'];  else $n_prezzo_5 = "";
if(isset($arr_rec['descrizione_prezzo_5'])) $n_descrizione_prezzo_5 = $arr_rec['descrizione_prezzo_5'];  else $n_descrizione_prezzo_5 = "";
if(isset($arr_rec['prezzo_6'])) $n_prezzo_6 = $arr_rec['prezzo_6'];  else $n_prezzo_6 = "";
if(isset($arr_rec['descrizione_prezzo_6'])) $n_descrizione_prezzo_6 = $arr_rec['descrizione_prezzo_6'];  else $n_descrizione_prezzo_6 = "";
if(isset($arr_rec['prezzo_7'])) $n_prezzo_7 = $arr_rec['prezzo_7'];  else $n_prezzo_7 = "";
if(isset($arr_rec['descrizione_prezzo_7'])) $n_descrizione_prezzo_7 = $arr_rec['descrizione_prezzo_7'];  else $n_descrizione_prezzo_7 = "";
if(isset($arr_rec['prezzo_8'])) $n_prezzo_8 = $arr_rec['prezzo_8'];  else $n_prezzo_8 = "";
if(isset($arr_rec['descrizione_prezzo_8'])) $n_descrizione_prezzo_8 = $arr_rec['descrizione_prezzo_8'];  else $n_descrizione_prezzo_8 = "";
if(isset($arr_rec['prezzo_9'])) $n_prezzo_9 = $arr_rec['prezzo_9'];  else $n_prezzo_9 = "";
if(isset($arr_rec['descrizione_prezzo_9'])) $n_descrizione_prezzo_9 = $arr_rec['descrizione_prezzo_9'];  else $n_descrizione_prezzo_9 = "";
if(isset($arr_rec['prezzo_10'])) $n_prezzo_10 = $arr_rec['prezzo_10'];  else $n_prezzo_10 = "";
if(isset($arr_rec['descrizione_prezzo_10'])) $n_descrizione_prezzo_10 = $arr_rec['descrizione_prezzo_10'];  else $n_descrizione_prezzo_10 = "";
if(!isset($n_disclaimer)) 
	$n_disclaimer="
		<ol>
			<li>
				<strong>DISCLAIMER OF LIABILITY</strong>: Competitors agree to be bound by the World Sailing RRS 2017/2020, the SI and the NoR. Competitors agree that the sole and inescapable responsibility for the nautical qualities
				of any yacht participating in the Maxi Yacht Rolex Cup 2018, including her rigging, the safety equipment on board and the competence, behaviour and dress of her crew, is that of the Owner/Charterer of the yacht.
				Competitors also agree to take any and all responsibility for all damages whatsoever caused to third persons or their belongings, to themselves or to their belongings, ashore and at sea as a consequence of their
				participation in the regatta, and hereby relieve from any responsibility, and agree to indemnify on a full indemnity basis and hold harmless, the OA, YCCS, IMA and its servants, agents and sponsors (in particular but
				not limited to ROLEX SA and affiliated companies) and their representatives in respect of any claim arising there from. Competitors shall apply RRS Part 1 Fundamental Rule 4: \"A boat is solely responsible for
				deciding whether or not to start or to continue racing\". In summary, competitors agree that the OA, YCCS, IMA its servants, agents and sponsors (in particular but not only ROLEX SA and affiliated companies) and
				their representatives have no responsibility for loss of life or injury to members or others, or for the loss of, or damage to any vessel or property. As part of the registration process, each individual participating crew
				member will be required to sign a declaration accepting this disclaimer of liability.
			</li>
			<li>
				<strong>MEDIA RELEASES</strong>: Competitors and crew members on the competing yachts grant, at no cost, YCCS, IMA, ROLEX SA and affiliated companies the absolute right and permission to use their name, voice,
				image, likeness, biographical material as well as representations of the boats in any media (being television, print and internet media), including video footage, for the sole purposes of advertising, promoting, reporting
				and disseminating information relating to ROLEX SA’s involvement in sailing events, in particular the Maxi Yacht Rolex Cup (“the regatta”), and to the competitors and crew members’ participation in such event.
				Competitors and crew members on the competing yachts also grant, at no cost, ROLEX SA and affiliated companies, the absolute right and permission to use their name, image, likeness, biographical material as
				well as representations of the boats in the “Perpetual Spirit” magazine, edited by ROLEX SA. Competitors and crew members’ name, voice, image, likeness and biographical material shall not be used by ROLEX
				SA and affiliated companies in a way which constitutes an endorsement of ROLEX products by said competitors and crew members, unless the relevant competitor or crew member is engaged by ROLEX SA or
				affiliated companies to endorse ROLEX products or gives his/her prior written consent to such use. As part of the registration process, each individual participating crew member will be required to sign a declaration
				accepting this waiver of rights
			</li>
			<li>
				<strong>INSURANCE</strong>: Each participating boat shall be insured with valid third party liability insurance with adequate cover taking into account the value of the boats racing and the measure of damages likely to arise in
				the event of an accident.
			</li>
			<li>
				<strong>INDEMNITY</strong>: A competitor shall be responsible for any and all property damage and personal injury (including death) incurred by yacht, its owner, its captain, its crew members, its guests and/or any third party
				while the yacht is participating in the event which arises from the actions or inactions of the yacht, the owner, the captain or crew or guests of the yacht or which arises from the yacht’s presence at the event, and the
				competitor shall indemnify, defend and hold harmless YCCS and each of their respective affiliates, sponsors, agents, employees, officers, directors and contractors (the “Indemnified Parties”) from any and all claims,
				losses, damages and liabilities suffered or incurred by one or more of the Indemnified Parties in respect of the same.”
			</li>
		</ol>
	";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=edizioni<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if(document.inserimento.sconto.value!="no" && (!document.inserimento.valore_sconto.value || document.inserimento.valore_sconto.value=="")) alert('Inserire valore sconto');
		else if(document.inserimento.sconto.value!="no" && document.inserimento.valore_sconto.value && document.inserimento.valore_sconto.value!=""  && isNaN(document.inserimento.valore_sconto.value)) alert('Inserire un valore numerico per lo sconto');
		else if(document.inserimento.prezzo_1.value=='') alert('Inserire prezzo');
		else if(isNaN(document.inserimento.prezzo_1.value)) alert('Inserire un valore numerico per il prezzo 1');
		else if($('#pr_2').css('display')=='block' && document.inserimento.descrizione_prezzo_1.value=='') alert('Inserire descrizione prezzo 1');
		else if($('#pr_2').css('display')=='block' && document.inserimento.prezzo_2.value=='') alert('Inserire prezzo 2');
		else if($('#pr_2').css('display')=='block' && document.inserimento.descrizione_prezzo_2.value=='') alert('Inserire descrizione prezzo 2');
		else if($('#pr_3').css('display')=='block' && document.inserimento.prezzo_3.value=='') alert('Inserire prezzo 3');
		else if($('#pr_3').css('display')=='block' && document.inserimento.descrizione_prezzo_3.value=='') alert('Inserire descrizione prezzo 3');
		else if($('#pr_4').css('display')=='block' && document.inserimento.prezzo_4.value=='') alert('Inserire prezzo 4');
		else if($('#pr_4').css('display')=='block' && document.inserimento.descrizione_prezzo_4.value=='') alert('Inserire descrizione prezzo 4');
		else if($('#pr_5').css('display')=='block' && document.inserimento.prezzo_5.value=='') alert('Inserire prezzo 5');
		else if($('#pr_5').css('display')=='block' && document.inserimento.descrizione_prezzo_5.value=='') alert('Inserire descrizione prezzo 5');
		else if($('#pr_6').css('display')=='block' && document.inserimento.prezzo_6.value=='') alert('Inserire prezzo 6');
		else if($('#pr_6').css('display')=='block' && document.inserimento.descrizione_prezzo_6.value=='') alert('Inserire descrizione prezzo 6');
		else if($('#pr_7').css('display')=='block' && document.inserimento.prezzo_7.value=='') alert('Inserire prezzo 7');
		else if($('#pr_7').css('display')=='block' && document.inserimento.descrizione_prezzo_7.value=='') alert('Inserire descrizione prezzo 7');
		else if($('#pr_8').css('display')=='block' && document.inserimento.prezzo_8.value=='') alert('Inserire prezzo 8');
		else if($('#pr_8').css('display')=='block' && document.inserimento.descrizione_prezzo_8.value=='') alert('Inserire descrizione prezzo 8');
		else if($('#pr_9').css('display')=='block' && document.inserimento.prezzo_9.value=='') alert('Inserire prezzo 9');
		else if($('#pr_9').css('display')=='block' && document.inserimento.descrizione_prezzo_9.value=='') alert('Inserire descrizione prezzo 9');
		else if($('#pr_10').css('display')=='block' && document.inserimento.prezzo_10.value=='') alert('Inserire prezzo 10');
		else if($('#pr_10').css('display')=='block' && document.inserimento.descrizione_prezzo_10.value=='') alert('Inserire descrizione prezzo 10');
		else document.inserimento.submit();
	}
	
	function info(elem){
		var position = $("#"+elem).position();
		alert(position.top+" - "+position.left);
		$("#imgInfo").css({'top' : $("#"+elem).offset().top+'px', 'left' : position.left+'px'});
	}
</script>
<?php 
if($campocanc!="")
{
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	//echo $query_canc_img;
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=modulo_iscrizioni_mod<?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;	
	
	$_POST['id_edizione']=$id_riferimento;
	if (isset($_POST['data_limite'])) $_POST['data_limite'] = $oggetto_admin->date_to_data($_POST['data_limite']);
		
	$_POST['disclaimer']=str_replace('"','\"',$_POST['disclaimer']);
	//$_POST['intestazione_mail']=str_replace('"','\"',$_POST['intestazione_mail']);
	//$_POST['disclaimer_ita']=str_replace('"','\"',$_POST['disclaimer_ita']);
	
	$query="SELECT id FROM edizioni_modulo_iscrizioni WHERE id_edizione='$id_riferimento'";
	$resu=$open_connection->connection->query($query);
	$num=$resu->rowCount();
	if($num==0){
		$oggetto_admin->inserisci_campi ("$table" , $arr_no);
	}else{
		list($id_rec)=$resu->fetch();
		$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no);
		for($i=1; $i<=10; $i++){
			if(!$_POST['prezzo_'.$i]){
				$query_up="update $table set prezzo_$i=NULL where id='$id_rec'";
				$open_connection->connection->query($query_up);
			}
			if(!$_POST['descrizione_prezzo_'.$i]){
				$query_up="update $table set descrizione_prezzo_$i=NULL where id='$id_rec'";
				$open_connection->connection->query($query_up);
			}
		}
	}
?>
	<script language="javascript">
		window.location='admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php echo $id_rec;?><?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
$nome_reg = "";
$query_reg = "select nome from regate where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
if ($risu_reg) list($nome_reg) = $risu_reg->fetch();
?>

<div class="mws-panel grid_8" style="position:relative;">
	
	<div style="height:30px;font-size:1.2em;padding-top:10px">Modifica Modulo Iscrizione dell'<b>Edizione <?php  echo $n_anno; ?></b> <?php  if ($id_rife!="") echo "della regata <b>".ucfirst($nome_reg)."</b>"; ?></div>
	<div style="height:30px;text-align:right"><a style="color:#000" href="admin.php?cmd=edizioni<?php echo $rif;?>"><< Torna all'elenco delle edizioni</a></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<div style="float:left; margin-top:10px;">
						<label class="mws-form-label">Visibilità</label>
						<div class="mws-form-item" style="cursor:pointer;" onclick="changeVisibilita()">
							<input name="visibilita" type="hidden" class="medium" value="<?php echo $n_visibilita;?>">
								<?php if($n_visibilita==0){?>
									<span id="checkVisibilita"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
								<?php }else{?>
									<span id="checkVisibilita"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
								<?php }?>
							
						</div>
					</div>
					<script type="text/javascript">
						var visib=<?php echo $n_visibilita;?>;
						function changeVisibilita(){
							if(visib==0){
								visib=1;
								document.getElementById('checkVisibilita').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
								document.inserimento.visibilita.value='1';
							}else{
								visib=0;
								document.getElementById('checkVisibilita').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
								document.inserimento.visibilita.value='0';
							}
						}	
					</script>
				</div>
				
				<?php /*<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Data scadenza invio moduli</label>
						<div class="mws-form-item">
							<input type="text" name="data_limite" class="mws-datepicker large"  value="<?php echo $n_data_limite;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>*/?>
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Titolo Modulo<br/>
						<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=testo_modulo_ita<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<input type="text" name="testo_modulo_ita" class="large"  value="<?php echo $n_testo_modulo_ita;?>">
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Titolo Modulo (eng)<br/>
						<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=testo_modulo_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<input type="text" name="testo_modulo_eng" class="large"  value="<?php echo $n_testo_modulo_eng;?>">
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Testo<br/>
						<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=testo<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo"><?php  echo $n_testo; ?></textarea>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Testo (eng)<br/>
						<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=testo_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_eng"><?php  echo $n_testo_eng; ?></textarea>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Avviso<br/>
						<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=avviso<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<input type="text" name="avviso" class="large"  value="<?php echo $n_avviso;?>">
					</div>
				</div>
				
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em" onclick="changeMembri()">
						<input name="membri" type="hidden" class="medium" value="<?php echo $n_membri;?>">
							<?php if($n_membri==0){?>
								<span id="checkMembri"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
							<?php }else{?>
								<span id="checkMembri"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
							<?php }?>
						
					</div>
					<label style="float:left;">Tipologia Membri  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="members" onclick="info('members');"></i></label>
					
					<div style="clear:both; width:100%;margin-top:20px; margin-left:42px;">												
						<div style="display:<?php if($n_membri==1){?>block<?php }else{?>none<?php }?>;" id="membriValori">
							<div style=" margin-top:15px; font-size:1em; line-height:14px;">Lista Tipologie Membri (separati da virgola)</div>
							<div style="margin-top:5px; margin-left:0px;"><input type="text" class="large" style="width:80%;" name="membri_valori" value="<?php echo $n_membri_valori;?>"/></div>
						</div>						
					</div>
				</div>				
								
				<script type="text/javascript">
					var membri=<?php echo $n_membri;?>;
					function changeMembri(){
						if(membri==0){
							membri=1;
							document.getElementById('checkMembri').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.membri.value='1';
							document.getElementById('membriValori').style.display="block";
							if(pagamenti==1){
								document.getElementById('blocco_sconti').style.display="block";
							}
						}else{
							membri=0;
							document.getElementById('checkMembri').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.membri.value='0';
							document.getElementById('blocco_sconti').style.display="none";
							document.inserimento.sconto.value="no";
							document.inserimento.valore_sconto.value="";
							document.getElementById('sezValore').style.display="none";
							document.getElementById('membriValori').style.display="none";
						}
					}	
				</script>
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changeMaxi()">
						<input name="maxi" type="hidden" class="medium" value="<?php echo $n_maxi;?>">
						<?php if($n_maxi==0){?>
							<span id="checkMaxi"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkMaxi"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Supermaxi  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="maxi" onclick="info('maxi');"></i></label>
				</div>
				<script type="text/javascript">
					var maxi=<?php echo $n_maxi;?>;
					function changeMaxi(){
						if(maxi==0){
							maxi=1;
							document.getElementById('checkMaxi').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.maxi.value='1';
						}else{
							maxi=0;
							document.getElementById('checkMaxi').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.maxi.value='0';
						}
					}	
				</script>
				
				
				<div class="mws-panel grid_2" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changeCategorie()">
						<input name="categorie" type="hidden" class="medium" value="<?php echo $n_categorie;?>">
						<?php if($n_categorie==0){?>
							<span id="checkCategorie"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkCategorie"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Categorie  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="categorie" onclick="info('categorie');"></i></label>
				</div>
				<script type="text/javascript">
					var categorie=<?php echo $n_categorie;?>;
					function changeCategorie(){
						if(categorie==0){
							categorie=1;
							document.getElementById('checkCategorie').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.categorie.value='1';
						}else{
							categorie=0;
							document.getElementById('checkCategorie').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.categorie.value='0';
						}
					}	
				</script>
				
				<div style="clear:both"></div>
				
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em" onclick="changeBarca()">
						<input name="boat_details" type="hidden" class="medium" value="<?php echo $n_boat_details;?>">
							<?php if($n_boat_details==0){?>
								<span id="changeBarca"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
							<?php }else{?>
								<span id="changeBarca"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
							<?php }?>
						
					</div>
					<label style="float:left;">Dettagli Barca  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="boat_details" onclick="info('boat_details');"></i></label>					
				</div>				
								
				<script type="text/javascript">
					var boat_details=<?php echo $n_boat_details;?>;
					function changeBarca(){
						if(boat_details==0){
							boat_details=1;
							document.getElementById('changeBarca').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.boat_details.value='1';
						}else{
							boat_details=0;
							document.getElementById('changeBarca').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.boat_details.value='0';
						}
					}	
				</script>
				
				
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changeCharterer()">
						<input name="charterer" type="hidden" class="medium" value="<?php echo $n_charterer;?>">
						<?php if($n_charterer==0){?>
							<span id="checkCharterer"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkCharterer"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Charterer/Owner  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="charterer" onclick="info('charterer');"></i></label>
				</div>
				<script type="text/javascript">
					var charterer=<?php echo $n_charterer;?>;
					function changeCharterer(){
						if(charterer==0){
							charterer=1;
							document.getElementById('checkCharterer').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.charterer.value='1';
						}else{
							charterer=0;
							document.getElementById('checkCharterer').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.charterer.value='0';
						}
					}	
				</script>		

				<div class="mws-panel grid_2" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changeHelmsman()">
						<input name="helmsman" type="hidden" class="medium" value="<?php echo $n_helmsman;?>">
						<?php if($n_helmsman==0){?>
							<span id="checkHelmsman"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkHelmsman"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Helmsman  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="helmsman" onclick="info('helmsman');"></i></label>
				</div>
				<script type="text/javascript">
					var helmsman=<?php echo $n_helmsman;?>;
					function changeHelmsman(){
						if(helmsman==0){
							helmsman=1;
							document.getElementById('checkHelmsman').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.helmsman.value='1';
						}else{
							helmsman=0;
							document.getElementById('checkHelmsman').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.helmsman.value='0';
						}
					}	
				</script>
				<div style="clear:both"></div>
				
				<div class="mws-panel grid_4"  style="box-shadow:none; ">
					<div id="yachtClubContainer">
						<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changeYachtClub()">
							<input name="yacht_club" type="hidden" class="medium" value="<?php echo $n_yacht_club;?>">
							<?php if($n_yacht_club==0){?>
								<span id="checkYachtClub"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
							<?php }else{?>
								<span id="checkYachtClub"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
							<?php }?>
						</div>
						<label style="float:left;">Yacht Club/Business School  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="yacht_club" onclick="info('yacht_club');"></i></label>
						
						<div style="clear:both; width:100%;margin-top:20px; margin-left:42px;">												
							<div style="display:<?php if($n_yacht_club==1){?>block<?php }else{?>none<?php }?>;" id="yachtClubValori">
								<div style=" float:left;width:30px;">&nbsp;</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Nome campo (Yacht Club/Business School)</div>
									<div style="margin-top:5px; margin-left:0px;"><input type="text" class="large" style="width:80%;" name="yacht_club_valore" value="<?php echo $n_yacht_club_valore;?>"/></div>
								</div>
								<div style="clear:both"></div>
								
								<div style="cursor:pointer; float:left; font-size:0.8em;width:30px; margin-top:7px; font-size:0.7em" onclick="changeYachtClubValore2Visib() ">
									<input name="yacht_club_valore2_visib" type="hidden" class="medium" value="<?php echo $n_yacht_club_valore2_visib;?>">
									<?php if($n_yacht_club_valore2_visib==0){?>
										<span id="checkYachtClubValore2Visib"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkYachtClubValore2Visib"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
									<?php }?>
								</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Nome campo (Home Port/Address...)</div>
									<div style="margin-top:5px; margin-left:0px;"><input type="text" class="large" style="width:80%;" name="yacht_club_valore2" value="<?php echo $n_yacht_club_valore2;?>"/></div>
								</div>
								<div style="clear:both"></div>
								
								<script type="text/javascript">
									var yacht_club_valore2_visib=<?php echo $n_yacht_club_valore2_visib;?>;
									function changeYachtClubValore2Visib(){
										if(yacht_club_valore2_visib==0){
											yacht_club_valore2_visib=1;
											document.getElementById('checkYachtClubValore2Visib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
											document.inserimento.yacht_club_valore2_visib.value='1';
										}else{
											yacht_club_valore2_visib=0;
											document.getElementById('checkYachtClubValore2Visib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
											document.inserimento.yacht_club_valore2_visib.value='0';
										}
									}	
								</script>
							</div>						
						</div>
					</div>
				</div>
				<script type="text/javascript">
					var YachtClub=<?php echo $n_yacht_club;?>;
					function changeYachtClub(){
						if(YachtClub==0){
							YachtClub=1;
							document.getElementById('checkYachtClub').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.yacht_club.value='1';
							document.getElementById('yachtClubValori').style.display="block";
						}else{
							YachtClub=0;
							document.getElementById('checkYachtClub').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.yacht_club.value='0';
							document.getElementById('yachtClubValori').style.display="none";
						}
					}	
				</script>
				
				
				
				<div class="mws-panel grid_4" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em" onclick="changeTipoBarca()">
						<input name="tipo_barca" type="hidden" class="medium" value="<?php echo $n_tipo_barca;?>">
							<?php if($n_tipo_barca==0){?>
								<span id="checkTipoBarca"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
							<?php }else{?>
								<span id="checkTipoBarca"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
							<?php }?>
						
					</div>
					<label style="float:left;">Tipologia Barca  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="members" onclick="info('tipo_barca');"></i></label>
					
					<div style="clear:both; width:100%;margin-top:20px; margin-left:42px;">												
						<div style="display:<?php if($n_tipo_barca==1){?>block<?php }else{?>none<?php }?>;" id="tipoBarcaValori">
							<div style=" margin-top:15px; font-size:1em; line-height:14px;">Lista Tipologie Barca (separati da virgola)</div>
							<div style="margin-top:5px; margin-left:0px;"><input type="text" class="large" style="width:80%;" name="tipo_barca_valori" value="<?php echo $n_tipo_barca_valori;?>"/></div>
						</div>						
					</div>
				</div>				
								
				<script type="text/javascript">
					var tipo_barca=<?php echo $n_tipo_barca;?>;
					function changeTipoBarca(){
						if(tipo_barca==0){
							tipo_barca=1;
							document.getElementById('checkTipoBarca').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.tipo_barca.value='1';
							document.getElementById('tipoBarcaValori').style.display="block";
						}else{
							tipo_barca=0;
							document.getElementById('checkTipoBarca').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.tipo_barca.value='0';
							document.getElementById('tipoBarcaValori').style.display="none";
						}
					}	
				</script>
				<div style="clear:both"></div>
				
				<div class="mws-panel grid_8" style="box-shadow:none;">
					<div <?php if($n_captain==1){?>style="padding:10px; border:solid 1px #C5C5C5"<?php }?> id="captainContainer">
						<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em" onclick="changeCaptain()">
							<input name="captain" type="hidden" class="medium" value="<?php echo $n_captain;?>">
								<?php if($n_captain==0){?>
									<span id="checkCaptain"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
								<?php }else{?>
									<span id="checkCaptain"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
								<?php }?>
							
						</div>
						<label style="float:left;">Captain/Team Manager  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="captain" onclick="info('captain');"></i></label>		
						
						<div style="clear:both; width:100%;margin-top:20px; margin-left:42px;">												
							<div style="display:<?php if($n_captain==1){?>block<?php }else{?>none<?php }?>;" id="captainValori">
								<div style=" margin-top:15px; font-size:1em; line-height:14px;">Nome campo (Captain/Team Manager...)</div>
								<div style="margin-top:5px; margin-left:0px;"><input type="text" class="large" style="width:80%;" name="captain_valore" value="<?php echo $n_captain_valore;?>"/></div>
							</div>						
						</div>
						
						<div style="padding:10px; display:<?php if($n_captain==1){?>block<?php }else{?>none<?php }?>;" id="captainDatiAgg">
							<div class="mws-panel grid_2" style="box-shadow:none;">
								<div style="cursor:pointer; float:left; font-size:0.8em;width:30px; margin-top:7px; font-size:0.7em" onclick="changeCaptainDataVisib() ">
									<input name="captain_data_visib" type="hidden" class="medium" value="<?php echo $n_captain_data_visib;?>">
									<?php if($n_captain_data_visib==0){?>
										<span id="checkCaptainDataVisib"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkCaptainDataVisib"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
									<?php }?>
								</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Data di nascita</div>
								</div>
								<div style="float:left; width:20px; margin-left:5px; cursor:pointer;" onclick="changeCaptainDataObb();">
									<input name="captain_data_obb" type="hidden" class="medium" value="<?php echo $n_captain_data_obb;?>">
									<?php if($n_captain_data_obb==0){?>
										<span id="checkCaptainDataObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkCaptainDataObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i></span>
									<?php }?>
								</div>
							</div>
							<div class="mws-panel grid_2" style="box-shadow:none;">
								<div style="cursor:pointer; float:left; font-size:0.8em;width:30px;margin-top:7px; font-size:0.7em" onclick="changeCaptainCellVisib() ">
									<input name="captain_cell_visib" type="hidden" class="medium" value="<?php echo $n_captain_cell_visib;?>">
									<?php if($n_captain_cell_visib==0){?>
										<span id="checkCaptainCellVisib"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkCaptainCellVisib"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
									<?php }?>
								</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Cellulare</div>
								</div>
								<div style="float:left; width:20px; margin-left:5px; cursor:pointer;" onclick="changeCaptainCellObb();">
									<input name="captain_cell_obb" type="hidden" class="medium" value="<?php echo $n_captain_cell_obb;?>">
									<?php if($n_captain_cell_obb==0){?>
										<span id="checkCaptainCellObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkCaptainCellObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i></span>
									<?php }?>
								</div>
							</div>
							<div class="mws-panel grid_2" style="box-shadow:none;">
								<div style="cursor:pointer; float:left; font-size:0.8em;width:30px; margin-top:7px; font-size:0.7em" onclick="changeCaptainEmailVisib() ">
									<input name="captain_email_visib" type="hidden" class="medium" value="<?php echo $n_captain_email_visib;?>">
									<?php if($n_captain_email_visib==0){?>
										<span id="checkCaptainEmailVisib"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkCaptainEmailVisib"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
									<?php }?>
								</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Email</div>
								</div>
								<div style="float:left; width:20px; margin-left:5px; cursor:pointer;" onclick="changeCaptainEmailObb();">
									<input name="captain_email_obb" type="hidden" class="medium" value="<?php echo $n_captain_email_obb;?>">
									<?php if($n_captain_email_obb==0){?>
										<span id="checkCaptainEmailObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkCaptainEmailObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i></span>
									<?php }?>
								</div>
							</div>
							<div class="mws-panel grid_2" style="box-shadow:none;">
								<div style="cursor:pointer; float:left; font-size:0.8em;width:30px; margin-top:7px; font-size:0.7em" onclick="changeCaptainLicenseVisib() ">
									<input name="captain_license_visib" type="hidden" class="medium" value="<?php echo $n_captain_license_visib;?>">
									<?php if($n_captain_license_visib==0){?>
										<span id="checkCaptainLicenseVisib"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkCaptainLicenseVisib"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
									<?php }?>
								</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Nautical Driving License</div>
								</div>
								<div style="float:left; width:20px; margin-left:5px; cursor:pointer;" onclick="changeCaptainLicenseObb();">
									<input name="captain_license_obb" type="hidden" class="medium" value="<?php echo $n_captain_license_obb;?>">
									<?php if($n_captain_license_obb==0){?>
										<span id="checkCaptainLicenseObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkCaptainLicenseObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i></span>
									<?php }?>
								</div>
							</div>
							<div style="clear:both"></div>	
						</div>
					</div>			
				</div>				
								
				<script type="text/javascript">
					var captain=<?php echo $n_captain;?>;
					function changeCaptain(){
						if(captain==0){
							captain=1;
							document.getElementById('checkCaptain').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.captain.value='1';
							document.getElementById('captainValori').style.display="block";
							document.getElementById('captainDatiAgg').style.display="block";
							$("#captainContainer").css({padding : "10px", border : "solid 1px #C5C5C5"});
						}else{
							captain=0;
							document.getElementById('checkCaptain').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.captain.value='0';
							document.getElementById('captainValori').style.display="none";
							document.getElementById('captainDatiAgg').style.display="none";
							$("#captainContainer").css({padding : "0", border : "none"});
						}
					}
					
					var captain_data_visib=<?php echo $n_captain_data_visib;?>;
					function changeCaptainDataVisib(){
						if(captain_data_visib==0){
							captain_data_visib=1;
							document.inserimento.captain_data_visib.value='1';
							document.getElementById('checkCaptainDataVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
						}else{
							captain_data_visib=0;
							document.inserimento.captain_data_visib.value='0';
							document.getElementById('checkCaptainDataVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var captain_cell_visib=<?php echo $n_captain_cell_visib;?>;
					function changeCaptainCellVisib(){
						if(captain_cell_visib==0){
							captain_cell_visib=1;
							document.inserimento.captain_cell_visib.value='1';
							document.getElementById('checkCaptainCellVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
						}else{
							captain_cell_visib=0;
							document.inserimento.captain_cell_visib.value='0';
							document.getElementById('checkCaptainCellVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var captain_email_visib=<?php echo $n_captain_email_visib;?>;
					function changeCaptainEmailVisib(){
						if(captain_email_visib==0){
							captain_email_visib=1;
							document.inserimento.captain_email_visib.value='1';
							document.getElementById('checkCaptainEmailVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
						}else{
							captain_email_visib=0;
							document.inserimento.captain_email_visib.value='0';
							document.getElementById('checkCaptainEmailVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var captain_license_visib=<?php echo $n_captain_license_visib;?>;
					function changeCaptainLicenseVisib(){
						if(captain_license_visib==0){
							captain_license_visib=1;
							document.inserimento.captain_license_visib.value='1';
							document.getElementById('checkCaptainLicenseVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
						}else{
							captain_license_visib=0;
							document.inserimento.captain_license_visib.value='0';
							document.getElementById('checkCaptainLicenseVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
						}
					}
					
					var captain_data_obb=<?php echo $n_captain_data_obb;?>;
					function changeCaptainDataObb(){
						if(captain_data_obb==0){
							captain_data_obb=1;
							document.inserimento.captain_data_obb.value='1';
							document.getElementById('checkCaptainDataObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i>';
						}else{
							captain_data_obb=0;
							document.inserimento.captain_data_obb.value='0';
							document.getElementById('checkCaptainDataObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var captain_cell_obb=<?php echo $n_captain_cell_obb;?>;
					function changeCaptainCellObb(){
						if(captain_cell_obb==0){
							captain_cell_obb=1;
							document.inserimento.captain_cell_obb.value='1';
							document.getElementById('checkCaptainCellObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i>';
						}else{
							captain_cell_obb=0;
							document.inserimento.captain_cell_obb.value='0';
							document.getElementById('checkCaptainCellObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var captain_email_obb=<?php echo $n_captain_email_obb;?>;
					function changeCaptainEmailObb(){
						if(captain_email_obb==0){
							captain_email_obb=1;
							document.inserimento.captain_email_obb.value='1';
							document.getElementById('checkCaptainEmailObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i>';
						}else{
							captain_email_obb=0;
							document.inserimento.captain_email_obb.value='0';
							document.getElementById('checkCaptainEmailObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var captain_license_obb=<?php echo $n_captain_license_obb;?>;
					function changeCaptainLicenseObb(){
						if(captain_license_obb==0){
							captain_license_obb=1;
							document.inserimento.captain_license_obb.value='1';
							document.getElementById('checkCaptainLicenseObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i>';
						}else{
							captain_license_obb=0;
							document.inserimento.captain_license_obb.value='0';
							document.getElementById('checkCaptainLicenseObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i>';
						}
					}
				</script>
				
				
				
				<div style="clear:both"></div>
				
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changeTactician()">
						<input name="tactician" type="hidden" class="medium" value="<?php echo $n_tactician;?>">
						<?php if($n_tactician==0){?>
							<span id="checkTactician"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkTactician"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Tactician  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="tactician" onclick="info('tactician');"></i></label>
				</div>
				<script type="text/javascript">
					var tactician=<?php echo $n_tactician;?>;
					function changeTactician(){
						if(tactician==0){
							tactician=1;
							document.getElementById('checkTactician').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.tactician.value='1';
						}else{
							tactician=0;
							document.getElementById('checkTactician').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.tactician.value='0';
						}
					}	
				</script>
				
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em" onclick="changeSupportBoat()">
						<input name="support_boat" type="hidden" class="medium" value="<?php echo $n_support_boat;?>">
							<?php if($n_support_boat==0){?>
								<span id="checkSupportBoat"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
							<?php }else{?>
								<span id="checkSupportBoat"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
							<?php }?>
						
					</div>
					<label style="float:left;">Support Boat  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="support_boat" onclick="info('support_boat');"></i></label>					
				</div>				
								
				<script type="text/javascript">
					var support_boat=<?php echo $n_support_boat;?>;
					function changeSupportBoat(){
						if(support_boat==0){
							support_boat=1;
							document.getElementById('checkSupportBoat').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.support_boat.value='1';
						}else{
							support_boat=0;
							document.getElementById('checkSupportBoat').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.support_boat.value='0';
						}
					}	
				</script>
				
				<div class="mws-panel grid_2" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changePressInfo()">
						<input name="press_info" type="hidden" class="medium" value="<?php echo $n_press_info;?>">
						<?php if($n_press_info==0){?>
							<span id="checkPressInfo"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkPressInfo"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Press Info  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="press_info" onclick="info('press_info');"></i></label>
				</div>
				
				<script type="text/javascript">
					var press_info=<?php echo $n_press_info;?>;
					function changePressInfo(){
						if(press_info==0){
							press_info=1;
							document.getElementById('checkPressInfo').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.press_info.value='1';
						}else{
							press_info=0;
							document.getElementById('checkPressInfo').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.press_info.value='0';
						}
					}	
				</script>
				
				<div style="clear:both"></div>
				
				
				
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changePartecipation()">
						<input name="partecipation" type="hidden" class="medium" value="<?php echo $n_partecipation;?>">
						<?php if($n_partecipation==0){?>
							<span id="checkPartecipation"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkPartecipation"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Significant Partecipation  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="partecipation" onclick="info('partecipation');"></i></label>
				</div>
				<script type="text/javascript">
					var partecipation=<?php echo $n_partecipation;?>;
					function changePartecipation(){
						if(partecipation==0){
							partecipation=1;
							document.getElementById('checkPartecipation').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.partecipation.value='1';
						}else{
							partecipation=0;
							document.getElementById('checkPartecipation').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.partecipation.value='0';
						}
					}	
				</script>
				
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em" onclick="changeProfessionalCrew()">
						<input name="professional_crew" type="hidden" class="medium" value="<?php echo $n_professional_crew;?>">
							<?php if($n_professional_crew==0){?>
								<span id="checkProfessionalCrew"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
							<?php }else{?>
								<span id="checkProfessionalCrew"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
							<?php }?>
						
					</div>
					<label style="float:left;">Professional Crew  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="professional_crew" onclick="info('professional_crew');"></i></label>					
				</div>				
								
				<script type="text/javascript">
					var professional_crew=<?php echo $n_professional_crew;?>;
					function changeProfessionalCrew(){
						if(professional_crew==0){
							professional_crew=1;
							document.getElementById('checkProfessionalCrew').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.professional_crew.value='1';
						}else{
							professional_crew=0;
							document.getElementById('checkProfessionalCrew').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.professional_crew.value='0';
						}
					}	
				</script>
				
				
				<div class="mws-panel grid_2" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changeAllegati()">
						<input name="allegati" type="hidden" class="medium" value="<?php echo $n_allegati;?>">
						<?php if($n_allegati==0){?>
							<span id="checkAllegati"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkAllegati"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Allegati  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="allegati" onclick="info('allegati');"></i></label>
				</div>
				<script type="text/javascript">
					var allegati=<?php echo $n_allegati;?>;
					function changeAllegati(){
						if(allegati==0){
							allegati=1;
							document.getElementById('checkAllegati').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.allegati.value='1';
						}else{
							allegati=0;
							document.getElementById('checkAllegati').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.allegati.value='0';
						}
					}	
				</script>
				
				<div style="clear:both"></div>
				
				<div class="mws-panel grid_8"  style="box-shadow:none;">	
					<div style="padding:10px; border:solid 1px #C5C5C5;" id="partecipationContainer">
						<div style="float:left; margin-right:8px;  margin-left:15px; font-size:0.8em" >
							<span id="checkOwnerName"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>						
						</div>
						<label style="float:left;">Name of the Owner  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="owner_name" onclick="info('owner_name');"></i></label>		
						
						<div style="clear:both; width:100%;margin-top:20px; margin-left:42px;">												
							<div style="display:<?php if($n_owner_name==1){?>block<?php }else{?>none<?php }?>;" id="OwnerNameValori">
								<div style=" margin-top:15px; font-size:1em; line-height:14px;">Nome campo (Name of the Owner/Charterer...)</div>
								<div style="margin-top:5px; margin-left:0px;"><input type="text" class="large" style="width:80%;" name="owner_name_valore" value="<?php echo $n_owner_name_valore;?>"/></div>
							</div>						
						</div>	

						<div style="padding:10px">
							<div class="mws-panel grid_2" style="box-shadow:none;">
								<div style="cursor:pointer; float:left; font-size:0.8em;width:30px; margin-top:7px; font-size:0.7em" onclick="changeOwnerDataVisib() ">
									<input name="owner_data_visib" type="hidden" class="medium" value="<?php echo $n_owner_data_visib;?>">
									<?php if($n_owner_data_visib==0){?>
										<span id="checkOwnerDataVisib"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkOwnerDataVisib"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
									<?php }?>
								</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Data di nascita</div>
								</div>
								<div style="float:left; width:20px; margin-left:5px; cursor:pointer;" onclick="changeOwnerDataObb();">
									<input name="owner_data_obb" type="hidden" class="medium" value="<?php echo $n_owner_data_obb;?>">
									<?php if($n_owner_data_obb==0){?>
										<span id="checkOwnerDataObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkOwnerDataObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i></span>
									<?php }?>
								</div>
							</div>
							<div class="mws-panel grid_2" style="box-shadow:none;">
								<div style="cursor:pointer; float:left; font-size:0.8em;width:30px;margin-top:7px; font-size:0.7em" onclick="changeOwnerCellVisib() ">
									<input name="owner_cell_visib" type="hidden" class="medium" value="<?php echo $n_owner_cell_visib;?>">
									<?php if($n_owner_cell_visib==0){?>
										<span id="checkOwnerCellVisib"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkOwnerCellVisib"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
									<?php }?>
								</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Cellulare</div>
								</div>
								<div style="float:left; width:20px; margin-left:5px; cursor:pointer;" onclick="changeOwnerCellObb();">
									<input name="owner_cell_obb" type="hidden" class="medium" value="<?php echo $n_owner_cell_obb;?>">
									<?php if($n_owner_cell_obb==0){?>
										<span id="checkOwnerCellObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkOwnerCellObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i></span>
									<?php }?>
								</div>

							</div>
							<div class="mws-panel grid_2" style="box-shadow:none;">
								<div style="cursor:pointer; float:left; font-size:0.8em;width:30px; margin-top:7px; font-size:0.7em" onclick="changeOwnerEmailVisib() ">
									<input name="owner_email_visib" type="hidden" class="medium" value="<?php echo $n_owner_email_visib;?>">
									<?php if($n_owner_email_visib==0){?>
										<span id="checkOwnerEmailVisib"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkOwnerEmailVisib"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
									<?php }?>
								</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Email</div>
								</div>
								<div style="float:left; width:20px; margin-left:5px; cursor:pointer;" onclick="changeOwnerEmailObb();">
									<input name="owner_email_obb" type="hidden" class="medium" value="<?php echo $n_owner_email_obb;?>">
									<?php if($n_owner_email_obb==0){?>
										<span id="checkOwnerEmailObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkOwnerEmailObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i></span>
									<?php }?>
								</div>
							</div>
							<div class="mws-panel grid_2" style="box-shadow:none;">
								<div style="cursor:pointer; float:left; font-size:0.8em;width:30px; margin-top:7px; font-size:0.7em" onclick="changeOwnerLicenseVisib() ">
									<input name="owner_license_visib" type="hidden" class="medium" value="<?php echo $n_owner_license_visib;?>">
									<?php if($n_owner_license_visib==0){?>
										<span id="checkOwnerLicenseVisib"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkOwnerLicenseVisib"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
									<?php }?>
								</div>
								<div style="float:left; margin-top:-6px;">
									<div style=" margin-top:15px; font-size:1em; line-height:14px;">Nautical Driving License</div>
								</div>
								<div style="float:left; width:20px; margin-left:5px; cursor:pointer;" onclick="changeOwnerLicenseObb();">
									<input name="owner_license_obb" type="hidden" class="medium" value="<?php echo $n_owner_license_obb;?>">
									<?php if($n_owner_license_obb==0){?>
										<span id="checkOwnerLicenseObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i></span>
									<?php }else{?>
										<span id="checkOwnerLicenseObb"><i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i></span>
									<?php }?>
								</div>
							</div>
							<div style="clear:both"></div>	
						</div>
					</div>			
				</div>
				<script>					
					var owner_data_visib=<?php echo $n_owner_data_visib;?>;
					function changeOwnerDataVisib(){
						if(owner_data_visib==0){
							owner_data_visib=1;
							document.inserimento.owner_data_visib.value='1';
							document.getElementById('checkOwnerDataVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
						}else{
							owner_data_visib=0;
							document.inserimento.owner_data_visib.value='0';
							document.getElementById('checkOwnerDataVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var owner_cell_visib=<?php echo $n_owner_cell_visib;?>;
					function changeOwnerCellVisib(){
						if(owner_cell_visib==0){
							owner_cell_visib=1;
							document.inserimento.owner_cell_visib.value='1';
							document.getElementById('checkOwnerCellVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
						}else{
							owner_cell_visib=0;
							document.inserimento.owner_cell_visib.value='0';
							document.getElementById('checkOwnerCellVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var owner_email_visib=<?php echo $n_owner_email_visib;?>;
					function changeOwnerEmailVisib(){
						if(owner_email_visib==0){
							owner_email_visib=1;
							document.inserimento.owner_email_visib.value='1';
							document.getElementById('checkOwnerEmailVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
						}else{
							owner_email_visib=0;
							document.inserimento.owner_email_visib.value='0';
							document.getElementById('checkOwnerEmailVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var owner_license_visib=<?php echo $n_owner_license_visib;?>;
					function changeOwnerLicenseVisib(){
						if(owner_license_visib==0){
							owner_license_visib=1;
							document.inserimento.owner_license_visib.value='1';
							document.getElementById('checkOwnerLicenseVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
						}else{
							owner_license_visib=0;
							document.inserimento.owner_license_visib.value='0';
							document.getElementById('checkOwnerLicenseVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
						}
					}
					
					var owner_data_obb=<?php echo $n_owner_data_obb;?>;
					function changeOwnerDataObb(){
						if(owner_data_obb==0){
							owner_data_obb=1;
							document.inserimento.owner_data_obb.value='1';
							document.getElementById('checkOwnerDataObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i>';
						}else{
							owner_data_obb=0;
							document.inserimento.owner_data_obb.value='0';
							document.getElementById('checkOwnerDataObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var owner_cell_obb=<?php echo $n_owner_cell_obb;?>;
					function changeOwnerCellObb(){
						if(owner_cell_obb==0){
							owner_cell_obb=1;
							document.inserimento.owner_cell_obb.value='1';
							document.getElementById('checkOwnerCellObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i>';
						}else{
							owner_cell_obb=0;
							document.inserimento.owner_cell_obb.value='0';
							document.getElementById('checkOwnerCellObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var owner_email_obb=<?php echo $n_owner_email_obb;?>;
					function changeOwnerEmailObb(){
						if(owner_email_obb==0){
							owner_email_obb=1;
							document.inserimento.owner_email_obb.value='1';
							document.getElementById('checkOwnerEmailObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i>';
						}else{
							owner_email_obb=0;
							document.inserimento.owner_email_obb.value='0';
							document.getElementById('checkOwnerEmailObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i>';
						}
					}
					var owner_license_obb=<?php echo $n_owner_license_obb;?>;
					function changeOwnerLicenseObb(){
						if(owner_license_obb==0){
							owner_license_obb=1;
							document.inserimento.owner_license_obb.value='1';
							document.getElementById('checkOwnerLicenseObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:lime"></i>';
						}else{
							owner_license_obb=0;
							document.inserimento.owner_license_obb.value='0';
							document.getElementById('checkOwnerLicenseObb').innerHTML='<i class="fa fa-asterisk" aria-hidden="true" style="color:#000"></i>';
						}
					}
				</script>
				
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changeDataTeam()">
						<input name="data_team" type="hidden" class="medium" value="<?php echo $n_data_team;?>">
						<?php if($n_data_team==0){?>
							<span id="checkDataTeam"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkDataTeam"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Data arrivo team  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="data_team" onclick="info('data_team');"></i></label>
				</div>
				<script type="text/javascript">
					var data_team=<?php echo $n_data_team;?>;
					function changeDataTeam(){
						if(data_team==0){
							data_team=1;
							document.getElementById('checkDataTeam').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.data_team.value='1';
						}else{
							data_team=0;
							document.getElementById('checkDataTeam').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.data_team.value='0';
						}
					}	
				</script>
				
				<div class="mws-panel grid_3" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changeEquipaggio()">
						<input name="equipaggio" type="hidden" class="medium" value="<?php echo $n_equipaggio;?>">
						<?php if($n_equipaggio==0){?>
							<span id="checkEquipaggio"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkEquipaggio"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Tabella Equipaggio  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="equipaggio" onclick="info('equipaggio');"></i></label>
				</div>
				<script type="text/javascript">
					var equipaggio=<?php echo $n_equipaggio;?>;
					function changeEquipaggio(){
						if(equipaggio==0){
							equipaggio=1;
							document.getElementById('checkEquipaggio').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.equipaggio.value='1';
						}else{
							equipaggio=0;
							document.getElementById('checkEquipaggio').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.equipaggio.value='0';
						}
					}	
				</script>
				
				<div class="mws-panel grid_2" style="box-shadow:none;">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:15px; font-size:0.8em;" onclick="changePagamenti()">
						<input name="pagamenti" type="hidden" class="medium" value="<?php echo $n_pagamenti;?>">
						<?php if($n_pagamenti==0){?>
							<span id="checkPagamenti"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkPagamenti"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					<label style="float:left;">Pagamenti  <i class="fa fa-question-circle" aria-hidden="true" style="cursor:pointer;" id="pagamenti" onclick="info('pagamenti');"></i></label>
				</div>
				<script type="text/javascript">
					var pagamenti=<?php echo $n_pagamenti;?>;
					function changePagamenti(){
						if(pagamenti==0){
							pagamenti=1;
							document.getElementById('checkPagamenti').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.pagamenti.value='1';
							document.getElementById('blocco_prezzi').style.display="block";
							document.getElementById('bloccoTestoPagamenti').style.display="block";
							if(membri==1){
								document.getElementById('blocco_sconti').style.display="block";
							}
						}else{
							pagamenti=0;
							document.getElementById('checkPagamenti').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.pagamenti.value='0';
							document.getElementById('blocco_sconti').style.display="none";
							document.getElementById('bloccoTestoPagamenti').style.display="none";
							document.inserimento.sconto.value="no";
							document.inserimento.valore_sconto.value="";
							document.getElementById('sezValore').style.display="none";
							document.getElementById('blocco_prezzi').style.display="none";
						}
					}	
				</script>
				
				
				<div style="clear:both"></div>
				
				<div class="mws-form-row" style="display: <?php if($n_pagamenti==1){?>block<?php }else{?>none<?php }?>" id="bloccoTestoPagamenti">
					<label style="float:left;">
						Testo Pagamenti<br/>
						<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=pagamenti_testo_ita<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="pagamenti_testo_ita"><?php  echo $n_pagamenti_testo_ita; ?></textarea>	
					</div>
					
					<label style="float:left;">
						Testo Pagamenti (eng)<br/>
						<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=pagamenti_testo_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="pagamenti_testo_eng"><?php  echo $n_pagamenti_testo_eng; ?></textarea>	
					</div>
				</div>
				
				
				<div class="mws-form-row">
					<div style="cursor:pointer; float:left; margin-right:8px;  margin-left:7px; font-size:0.8em;" onclick="changeDisclaimer()">
						<input name="disclaimer_visib" type="hidden" class="medium" value="<?php echo $n_disclaimer_visib;?>">
						<?php if($n_disclaimer_visib==0){?>
							<span id="checkDisclaimer"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkDisclaimer"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
					
					<label style="float:left;">
						Disclaimer<br/>
						<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=disclaimer<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<script type="text/javascript">
						var disclaimer=<?php echo $n_disclaimer_visib;?>;
						function changeDisclaimer(){
							if(disclaimer==0){
								disclaimer=1;
								document.getElementById('checkDisclaimer').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
								document.inserimento.disclaimer_visib.value='1';
								document.getElementById('bloccoDisclaimer').style.display="block";
							}else{
								disclaimer=0;
								document.getElementById('checkDisclaimer').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
								document.inserimento.disclaimer_visib.value='0';
								document.getElementById('bloccoDisclaimer').style.display="none";
							}
						}	
					</script>
					<div class="mws-form-item" id="bloccoDisclaimer" style="display: <?php if($n_disclaimer_visib==1){?>block<?php }else{?>none<?php }?>">
						<textarea class="ckeditor" name="disclaimer"><?php  echo $n_disclaimer; ?></textarea>
					</div>
					<div style="clear:both"></div>
					
					<div class="mws-form-row">
						<label class="mws-form-label">
							Testo Privacy<br/>
							<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=testo_privacy_ita<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
						</label>
						<div class="mws-form-item">
							<input type="text" name="testo_privacy_ita" class="large"  value="<?php echo $n_testo_privacy_ita;?>">
						</div>
					</div>
					
					<div class="mws-form-row">
						<label class="mws-form-label">
							Testo Privacy (eng)<br/>
							<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=testo_privacy_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
						</label>
						<div class="mws-form-item">
							<input type="text" name="testo_privacy_eng" class="large"  value="<?php echo $n_testo_privacy_eng;?>">
						</div>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Intestazione Mail<br/>
						<a href="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $arr_rec['id']; ?>&campocanc=intestazione_mail<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="intestazione_mail"><?php  echo $n_intestazione_mail; ?></textarea>
					</div>
				</div>
				<?php /*<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (Italiano)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descrizione_eng"><?php  echo $n_descr_eng; ?></textarea>
						<a href="admin.php?cmd=edizioni_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=descrizione_eng<?php echo $rif;?>"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</div>
				</div>*/?>
				<div style="<?php if($n_membri==0 || $n_pagamenti==0){?>display:none<?php }?>" id="blocco_sconti">
					<div class="mws-form-row">
						<label class="mws-form-label">
							Sconto Soci<br/>
						</label>
						<div class="mws-form-item">
							<select name="sconto" onchange="vediValore();">
								<option value="no" <?php if($n_sconto=="no"){?>selected="selected"<?php }?>>No</option>
								<option value="valore" <?php if($n_sconto=="valore"){?>selected="selected"<?php }?>>Valore</option>
								<option value="percentuale" <?php if($n_sconto=="percentuale"){?>selected="selected"<?php }?>>Percentuale</option>
							</select>
						</div>
					</div>
					<div class="mws-form-inline" id="sezValore" <?php if($n_sconto=="no"){?>style="display:none"<?php }?>>
						<div class="mws-form-row">
							<label class="mws-form-label">Valore Sconto<br/><span style="font-size:0.8em; line-height:10px; letter-spacing: -0.5px;"><i>(utilizzare il punto per i decimali)</i></span></label>
							<div class="mws-form-item">
								<input type="text" name="valore_sconto" class="small"  value="<?php echo $n_valore_sconto;?>" style="width:10%"> <span id="simbolo"><?php if($n_sconto=="valore") echo "&euro;"; elseif($n_sconto=="percentuale") echo "%";?></span>
							</div>
						</div>
					</div>
				</div>
				<style>
					::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
						color: #d2d2d2;
						opacity: 1; /* Firefox */
					}

					:-ms-input-placeholder { /* Internet Explorer 10-11 */
						color: #d2d2d2;
					}

					::-ms-input-placeholder { /* Microsoft Edge */
						color: #d2d2d2;
					}
				</style>
				<div class="mws-form-inline" style="<?php if($n_pagamenti==0){?>display:none<?php }?>" id="blocco_prezzi">
					<div class="mws-form-row" style="line-height:15px;">
						<label class="mws-form-label">Prezzo<br/><span style="font-size:0.8em; line-height:10px; letter-spacing: -0.5px;"><i>(utilizzare il punto per i decimali)</i></span></label>
						<div class="mws-form-item">
							<?php 
							$num_righe=0;
							for($i=1; $i<=10; $i++){
								$var_desc="n_descrizione_prezzo_".$i;
								$var_prezzo="n_prezzo_".$i;
								if($$var_prezzo && $$var_prezzo!="") $num_righe++;
								?>
								<div id="pr_<?php echo $i;?>" <?php if($i>1 && (!$$var_prezzo || $$var_prezzo=="")){?>style="display:none;"<?php }?>>
									<div style="float:left; margin-top:5px; width:23px; <?php if($i==1 && (!$n_descrizione_prezzo_1 || $n_descrizione_prezzo_1=="")){?>display:none;<?php }?>" id="numero_<?php echo $i;?>" ><?php echo $i;?>.</div>
									<div style="float:left; margin-bottom:5px;">
										<input type="text" name="prezzo_<?php echo $i;?>" id="prezzo_<?php echo $i;?>" class="small"  value="<?php echo $$var_prezzo;?>" style="width:70px"> &euro;
									</div>	
									<div style="float:left; margin-left:10px;">
										<input type="text" name="descrizione_prezzo_<?php echo $i;?>" id="descrizione_prezzo_<?php echo $i;?>" class="small"  value="<?php echo $$var_desc;?>" placeholder="descrizione" style="width:200px; <?php if($i==1 && (!$n_descrizione_prezzo_1 || $n_descrizione_prezzo_1=="")){?>display:none<?php }?>"> 
									</div>									
									<div style="clear:both"></div>
								</div>
							<?php }?>
							<div style="float:left; margin-top:5px; <?php if($num_righe==10){?>display:none<?php }?>" id="bottAgg">
								<input type="button" value="Aggiungi" class="btn" onclick="aggiungiPrezzo()">
							</div>
							<div style="float:left; margin-top:5px;margin-left:5px; <?php if($num_righe<2){?>display:none<?php }?>" id="bottRim">
								<input type="button" value="Rimuovi" class="btn" onclick="rimuoviPrezzo()">
							</div>
						</div>
					</div>
				</div>
				
				<script>
					function vediValore(){
						if(document.inserimento.sconto.value=='no'){
							document.getElementById('sezValore').style.display="none";
						}else if(document.inserimento.sconto.value=='valore'){
							document.getElementById('sezValore').style.display="block";
							document.getElementById('simbolo').innerHTML='&euro;';
						}else if(document.inserimento.sconto.value=='percentuale'){
							document.getElementById('sezValore').style.display="block";	
							document.getElementById('simbolo').innerHTML='%';						
						}
						document.inserimento.valore_sconto.value="";
					}
					
					var ind="<?php echo $num_righe;?>";
					function aggiungiPrezzo(){
						ind++;
						document.getElementById('pr_'+ind).style.display='block';
						document.getElementById('prezzo_'+ind).valule=ind;
						if(ind==10) document.getElementById('bottAgg').style.display='none';
						if(ind>1) {
							document.getElementById('bottRim').style.display='block';
							document.getElementById('numero_1').style.display='block';
							document.getElementById('descrizione_prezzo_1').style.display='block';
						}
					}
					function rimuoviPrezzo(){
						document.getElementById('pr_'+ind).style.display='none';	
						document.getElementById('bottAgg').style.display='block';
						if(ind==2) {
							document.getElementById('bottRim').style.display='none';
							document.getElementById('numero_1').style.display='none';
							document.getElementById('descrizione_prezzo_1').style.display='none';
							document.getElementById('descrizione_prezzo_1').value="";
						}
						document.getElementById('prezzo_'+ind).value="";
						document.getElementById('descrizione_prezzo_'+ind).value="";
						ind--;				
					}
				</script>
				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
			</div>
			
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
	
</div>

<div style="position:fixed; width:600px; background:#fff; top:50%; left:50%; display:none; border:solid 1px #808080; border-radius:2px; text-align:center;  margin-left:-300px; margin-top:-100px; z-index:0000000; box-shadow:5px 5px 5px #808080" id="box_doc">
	<img src="" style="width:780px; margin-top:25px;" id="img_elem"></iframe>
	<div style="position:absolute; top:15px; right:25px; width:20px; height:20px; cursor:pointer; text-align:center;" onclick="document.getElementById('box_doc').style.display='none';">
		<i class="fa fa-times-circle fa-2x"></i>		
	</div>
</div>

<script type="text/javascript">
	function info(elem){
		$("#box_doc").css({'display':'none'});
		$("#box_doc").fadeIn();
		document.getElementById('img_elem').src="img/"+elem+".jpg";
	}
</script>
<?php 
}
?>
