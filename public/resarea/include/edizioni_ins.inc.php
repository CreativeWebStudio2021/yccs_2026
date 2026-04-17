<?php 
$table="edizioni_regate";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";
	
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=edizioni<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){		
		if (document.inserimento.anno.value=="") alert('Anno obbigatorio');	
			else if (document.inserimento.nome_regata.value=="") alert('Nome Regata obbigatorio');	
			else if (document.inserimento.luogo.value=="") alert('Luogo obbigatorio');	
			else document.inserimento.submit();
	}
</script>
<?php 
if($stato=="inviato")
{
	$arr_no['stato']=1;
	//$arr_no['data_dal_mod']=1;
	//$arr_no['data_al_mod']=1;
	
	$arr_thumb['logo_img']=250;
	$arr_thumb['banner_img']=250;
	$arr_thumb['banner_img_eng']=250;
	$arr_thumb['img_testata']=250;
	$arr_thumb['img_documenti']=250;
	$arr_thumb['img_noticeboard']=250;
	$arr_thumb['img_risultati']=250;
	$arr_thumb['img_informazioni']=250;
	$arr_thumb['logo_edizione']=250;
		
	$_POST['luogo']=str_replace('"',"''",$_POST['luogo']);
	
	$_POST['descrizione']=str_replace('"','\"',$_POST['descrizione']);
	$_POST['descrizione_eng']=str_replace('"','\"',$_POST['descrizione_eng']);
	
	if (isset($_POST['data_dal'])) $_POST['data_dal']= $oggetto_admin->date_to_data($_POST['data_dal']);
		else $_POST['data_dal'] = "";
		
	if (isset($_POST['data_al'])) $_POST['data_al'] = $oggetto_admin->date_to_data($_POST['data_al']);
		else $_POST['data_al'] = "";
					
	$oggetto_admin->inserisci_campi ("$table" , $arr_no ,  $arr_thumb, "img_up/regate");
	
	$query = "SELECT id FROM $table ORDER BY id DESC LIMIT 0,1";
	$resu = $open_connection->connection->query($query);
	list($id_ultimo)=$resu->fetch();
	
	//$id_ultimo = mysql_insert_id();
	//if ($data_dal_mod!="") $open_connection->connection->query("update edizioni_regate set data_dal='$data_dal_mod' where id='$id_ultimo'");
	//if ($data_al_mod!="") $open_connection->connection->query("update edizioni_regate set data_al='$data_al_mod' where id='$id_ultimo'");
	
	$query_f="SELECT logo_edizione,img_testata,img_documenti,img_noticeboard,img_risultati,img_informazioni,banner_img,banner_img_eng FROM edizioni_regate WHERE id='$id_ultimo'";
	$resu_f=$open_connection->connection->query($query_f);
	list($nome_f,$img_testata_f,$img_documenti_f,$img_noticeboard_f,$img_risultati_f,$img_informazioni_f,$banner_img_f,$banner_img_eng_f)=$resu_f->fetch();
	if($nome_f && trim($nome_f)!=""){
		$oggetto_admin->thumbjpg( "100" ,  "img_up/regate/".$nome_f ,$nome_f, $dir_imm="img_up/regate", $start="xs_" );
	}
	if($img_testata_f && trim($img_testata_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_testata_f ,$img_testata_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_testata_f ,$img_testata_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_testata_f ,$img_testata_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_documenti_f && trim($img_documenti_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_documenti_f ,$img_documenti_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_documenti_f ,$img_documenti_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_documenti_f ,$img_documenti_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_noticeboard_f && trim($img_noticeboard_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_noticeboard_f ,$img_noticeboard_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_noticeboard_f ,$img_noticeboard_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_noticeboard_f ,$img_noticeboard_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_risultati_f && trim($img_risultati_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_risultati_f ,$img_risultati_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_risultati_f ,$img_risultati_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_risultati_f ,$img_risultati_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_informazioni_f && trim($img_informazioni_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_informazioni_f ,$img_informazioni_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_informazioni_f ,$img_informazioni_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_informazioni_f ,$img_informazioni_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($banner_img_f && trim($banner_img_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$banner_img_f ,$banner_img_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$banner_img_f ,$banner_img_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$banner_img_f ,$banner_img_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($banner_img_eng_f && trim($banner_img_eng_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$banner_img_eng_f ,$banner_img_eng_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$banner_img_eng_f ,$banner_img_eng_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$banner_img_eng_f ,$banner_img_eng_f, $dir_imm="img_up/regate", $start="400_" );
	}
?>
	<script language="javascript">
		window.location='admin.php?cmd=edizioni_mod&id_rec=<?php echo $id_ultimo;?><?php echo $rif;?>';
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
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">Inserisci <b>Nuova edizione</b> <?php  if ($id_rife!="") echo "della regata <b>".ucfirst($nome_reg)."</b>"; ?></div>
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=edizioni<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle edizioni</b>
			</div>
		</a>
		<div></div>
	</div>
	
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=edizioni_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<?php 
			/*$ord_ev = $oggetto_admin->trova_ordine("$table");
			echo '<input type="hidden" name="ordine" value="'.$ord_ev.'">';*/
			?>
			<div class="mws-form-inline">
				<input type="hidden" name="id_regata" value="<?php  echo $id_rife; ?>">
				<div class="mws-form-row">
					<label class="mws-form-label">Anno *</label>
					<div class="mws-form-item">
						<select name="anno" class="small">
							<option value="">Seleziona</option>
							<?php 
							$oggi = date('Y');
							for($a=2008; $a<=($oggi+1); $a++){
								$num_gia = 0;
								$query_gia = "select id from edizioni_regate where id_regata='$id_rife' and anno='$a'";
								$risu_gia = $open_connection->connection->query($query_gia);
								if ($risu_gia) $num_gia = $risu_gia->rowCount();
								
								if ($num_gia==0) {
							?>
								<option value="<?php echo $a;?>"><?php echo $a;?></option>
							<?php 
								}
							}
							?>					
						</select>
					</div>
				</div>
	<?php 
				/*$oggetto_admin->campo_ins("Anno *" , "anno" , "6", $oggetto_admin->mega_anni);*/
				$oggetto_admin->campo_ins("Nome Regata *" , "nome_regata" , "1", 'no','',"$nome_reg");	
				$oggetto_admin->campo_ins("Luogo *" , "luogo" , "1", 'no');		
				$oggetto_admin->campo_ins("Logo Edizione" , "logo_edizione" , "4", 'no');		
	?>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Dal *</label>
						<div class="mws-form-item">
							<input type="text" name="data_dal" class="mws-datepicker large"  value="" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Al *</label>
						<div class="mws-form-item">
							<input type="text" name="data_al" class="mws-datepicker large"  value="" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Link Esterno<br/><i>(include http o https)</i>" , "link_esterno"  , "1", 'no');
				$oggetto_admin->campo_ins("Link Esterno (Inglese)<br/><i>(include http o https)</i>" , "link_esterno_eng"  , "1", 'no');
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (Italiano)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descrizione"></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descrizione_eng"></textarea>
					</div>
				</div>
				<?php				
					$oggetto_admin->campo_ins("Immagine Banner<br/><i>(larghezza 1920)</i>" , "banner_img"  , "4", 'no');			
					$oggetto_admin->campo_ins("Link Banner<br/><i>(include http o https)</i>" , "banner_link"  , "1", 'no');
					$oggetto_admin->campo_ins("Immagine Banner (eng)<br/><i>(larghezza 1920)</i>" , "banner_img_eng"  , "4");		
					$oggetto_admin->campo_ins("Link Banner (eng)<br/><i>(include http o https)</i>" , "banner_link_eng"   , "1", 'no');	
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Crew/Boat Board</label>
					<div class="mws-form-item" style="cursor:pointer;" onclick="changeBoard()">
						<input name="crew_board" type="hidden" class="medium" value="0">
						<span id="checkBoard"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
					</div>
					
					<script type="text/javascript">
						var cb=0;
						function changeBoard(){
							if(cb==0){
								cb=1;
								document.getElementById('checkBoard').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
								document.inserimento.crew_board.value='1';
							}else{
								cb=0;
								document.getElementById('checkBoard').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
								document.inserimento.crew_board.value='0';
							}
						}	
					</script>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Template V.2</label>
					<div class="mws-form-item" style="cursor:pointer;" onclick="changeV2()">
						<input name="new" type="hidden" class="medium" value="0">
						<span id="checkV2"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
					</div>
				</div>
				<script type="text/javascript">
					var v2=0;
					function changeV2(){
						if(v2==0){
							v2=1;
							document.getElementById('checkV2').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.new.value='1';
							$("#TemplateV2").fadeIn();
							
							document.getElementById('checkV3').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.new2.value='0';
							$("#TemplateV3").css({"display":"none"});
						}else{
							v2=0;
							document.getElementById('checkV2').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.new.value='0';
							$("#TemplateV2").css({"display":"none"});
							
							document.getElementById('checkV3').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.new3.value='1';
							$("#TemplateV3").fadeIn();
						}
					}	
				</script>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Template V.3</label>
					<div class="mws-form-item" style="cursor:pointer;" onclick="changeV3()">
						<input name="new2" type="hidden" class="medium" value="1">
						<span id="checkV3"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
					</div>
				</div>
				<script type="text/javascript">
					var v3=1;
					function changeV3(){
						if(v3==0){
							v3=1;
							document.getElementById('checkV2').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.new.value='0';
							$("#TemplateV2").css({"display":"none"});
							
							document.getElementById('checkV3').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.new2.value='1';
							$("#TemplateV3").fadeIn();
						}else{
							v3=0;
							document.getElementById('checkV2').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.new.value='1';
							$("#TemplateV2").fadeIn();
							
							document.getElementById('checkV3').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.new2.value='0';
							$("#TemplateV3").css({"display":"none"});
						}
					}	
				</script>
				
				<div style="display:none" id="TemplateV2">
					<div class="mws-button-row">
						<div style="font-weight:bold">Campi per Template V.2</div>
					</div>
					<div class="mws-form-inline">
						<?php 
						$oggetto_admin->campo_ins("Immagine Testata<br/><i>(1920x600)</i>" , "img_testata"  , "4", 'no');
						
						$oggetto_admin->campo_ins("Immagine Documenti<br/><i>(1920x1100)</i>" , "img_documenti"  , "4", 'no');
						$oggetto_admin->campo_ins("Immagine Comunicati<br/><i>(1920x1100)</i>" , "img_noticeboard"  , "4", 'no');
						$oggetto_admin->campo_ins("Immagine Risulrati<br/><i>(1920x1100)</i>" , "img_risultati"  , "4", 'no');
						$oggetto_admin->campo_ins("Immagine Informazioni<br/><i>(1920x1100)</i>" , "img_informazioni"  , "4");
						?>
					</div>
				</div>
				
				
				
				<div id="TemplateV3">
					<div class="mws-button-row">
						<div style="font-weight:bold">Campi per Template V.3</div>
					</div>
					<div class="mws-form-inline">
						<?php 
						$oggetto_admin->campo_ins("Immagine Testata<br/><i>(1920x600)</i>" , "img_testata"  , "4", 'no');						
						$oggetto_admin->campo_ins("Immagine Documenti<br/><i>(1920x1100)</i>" , "img_documenti"  , "4", 'no');				
						?>
					</div>
				</div>
				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="window.history.back()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
