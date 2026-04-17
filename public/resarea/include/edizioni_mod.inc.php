<?php 
$table="edizioni_regate";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") $rif="&id_rife=$id_rife";


if($id_rife==""){
	$query_canc = "SELECT id_regata FROM edizioni_regate where id='$id_riferimento'";
	$risu_canc = $open_connection->connection->query($query_canc);
	list($id_rife) = $risu_canc->fetch();
}

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_regata = $arr_rec['id_regata'];
$n_anno = $arr_rec['anno'];
$n_luogo = $arr_rec['luogo'];
$n_data_dal = $oggetto_admin->date_to_data($arr_rec['data_dal']);
$n_data_al = $oggetto_admin->date_to_data($arr_rec['data_al']);
$n_descr = $arr_rec['descrizione'];
$n_descr_eng = $arr_rec['descrizione_eng'];
$n_nome_regata = $arr_rec['nome_regata'];
$n_logo = $arr_rec['logo'];
$n_crew = $arr_rec['crew_board'];
$n_modulo = $arr_rec['modulo_iscrizioni'];
$n_new = $arr_rec['new'];
$n_new2 = $arr_rec['new2'];
$n_logo_img = $arr_rec['logo_img'];
$n_logo_edizione = $arr_rec['logo_edizione'];
$n_img_testata = $arr_rec['img_testata'];
$n_img_testata = $arr_rec['img_testata'];
$n_img_documenti = $arr_rec['img_documenti'];
$n_img_testata_v3 = $arr_rec['img_testata_v3']; 
$n_img_documenti_v3 = $arr_rec['img_documenti_v3'];
$n_img_noticeboard = $arr_rec['img_noticeboard'];
$n_img_risultati = $arr_rec['img_risultati'];
$n_img_informazioni = $arr_rec['img_informazioni'];
$n_banner_img = $arr_rec['banner_img'];
$n_banner_img_eng = $arr_rec['banner_img_eng'];
$n_banner_link = $arr_rec['banner_link'];
$n_banner_link_eng = $arr_rec['banner_link_eng'];
$n_colore = $arr_rec['colore'];
$n_colore_testo = $arr_rec['colore_testo'];
$n_visibile = $arr_rec['visibile'];
$n_link_esterno = $arr_rec['link_esterno'];
$n_link_esterno_eng = $arr_rec['link_esterno_eng'];
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=edizioni<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.nome_regata.value=="") alert('Nome Regata obbigatorio');	
		else if (document.inserimento.luogo.value=="") alert('Luogo obbigatorio');	
			/*else if (document.inserimento.data_dal.value=="") alert('Dal obbigatorio');	
			else if (document.inserimento.data_al.value=="") alert('Al obbigatorio');*/
			else document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/regate/$cancimg")){unlink("img_up/regate/$cancimg");}
	if(is_file("img_up/regate/s_$cancimg")){unlink("img_up/regate/s_$cancimg");}
	if(is_file("img_up/regate/1200_$cancimg")){unlink("img_up/regate/1200_$cancimg");}
	if(is_file("img_up/regate/800_$cancimg")){unlink("img_up/regate/800_$cancimg");}
	if(is_file("img_up/regate/400_$cancimg")){unlink("img_up/regate/400_$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=edizioni_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['data_dal_mod']=1;
	$arr_no['data_al_mod']=1;
	
	$img_l=0;
	$img_t=0;
	$img_d=0;
	$img_c=0;
	$img_r=0;
	$img_i=0;
	$img_b=0;
	$img_be=0;
	
	$num_file = count($_FILES) ;
	reset($_FILES);
	for($x=0; $x<$num_file; $x++){
		
		$key = key($_FILES);
		$nome_campo = $key;
		$nome_file = $_FILES[$key]['name'];
		$dim = $_FILES[$key]['size'];
		$tmp_file    = $_FILES[$key]['tmp_name'];
		//echo "FILE : $key - $nome_campo - $nome_file <br/>";
		
		if($nome_file!="" && $key=="logo_edizione") $img_l=1;
		if($nome_file!="" && $key=="img_testata") $img_t=1;
		if($nome_file!="" && $key=="img_documenti") $img_d=1;
		if($nome_file!="" && $key=="img_noticeboard") $img_c=1;
		if($nome_file!="" && $key=="img_risultati") $img_r=1;
		if($nome_file!="" && $key=="img_informazioni") $img_i=1;
		if($nome_file!="" && $key=="banner_img") $img_b=1;
		if($nome_file!="" && $key=="banner_img_eng") $img_be=1;
		
		next($_FILES); 
	}
	reset($_FILES);
	/*echo "logo_img ".$img_l."<br/>";
	echo "img_testata ".$img_t."<br/>";
	echo "img_documenti ".$img_d."<br/>";
	echo "img_risultati ".$img_r."<br/>";
	echo "img_informazioni ".$img_i."<br/>";
	echo "banner_img ".$img_b."<br/>";
	echo "banner_img_eng ".$img_be."<br/>";*/
	
	$arr_thumb['logo_img']=250;
	$arr_thumb['banner_img']=250;
	$arr_thumb['banner_img_eng']=250;
	$arr_thumb['img_testata']=250;
	$arr_thumb['img_documenti']=250;
	$arr_thumb['img_noticeboard']=250;
	$arr_thumb['img_risultati']=250;
	$arr_thumb['img_informazioni']=250;
		
	$_POST['luogo']=str_replace('"',"''",$_POST['luogo']);
	
	if (isset($_POST['data_dal_mod'])) $data_dal_mod = $oggetto_admin->date_to_data($_POST['data_dal_mod']);
		else $data_dal_mod = "";
		
	if (isset($_POST['data_al_mod'])) $data_al_mod = $oggetto_admin->date_to_data($_POST['data_al_mod']);
		else $data_al_mod = "";
	
	$_POST['descrizione']=str_replace('"','"',$_POST['descrizione']);
	$_POST['descrizione_eng']=str_replace('"','"',$_POST['descrizione_eng']);
	

	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/regate");
	
	if ($data_dal_mod!="") $open_connection->connection->query("update edizioni_regate set data_dal='$data_dal_mod' where id='$id_rec'");
	if ($data_al_mod!="") $open_connection->connection->query("update edizioni_regate set data_al='$data_al_mod' where id='$id_rec'");
	
	$query_f="SELECT logo_edizione,img_testata,img_documenti,img_noticeboard,img_risultati,img_informazioni,banner_img,banner_img_eng FROM edizioni_regate WHERE id='$id_rec'";
	$resu_f=$open_connection->connection->query($query_f);
	list($nome_f,$img_testata_f,$img_documenti_f,$img_noticeboard_f,$img_risultati_f,$img_informazioni_f,$banner_img_f,$banner_img_eng_f)=$resu_f->fetch();
	
	if($img_l==1 && $nome_f && trim($nome_f)!=""){
		$oggetto_admin->thumbjpg( "100" ,  "img_up/regate/".$nome_f ,$nome_f, $dir_imm="img_up/regate", $start="xs_" );
	}
	if($img_t==1 && $img_testata_f && trim($img_testata_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_testata_f ,$img_testata_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_testata_f ,$img_testata_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_testata_f ,$img_testata_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_d==1 && $img_documenti_f && trim($img_documenti_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_documenti_f ,$img_documenti_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_documenti_f ,$img_documenti_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_documenti_f ,$img_documenti_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_c==1 && $img_noticeboard_f && trim($img_noticeboard_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_noticeboard_f ,$img_noticeboard_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_noticeboard_f ,$img_noticeboard_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_noticeboard_f ,$img_noticeboard_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_r==1 && $img_risultati_f && trim($img_risultati_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_risultati_f ,$img_risultati_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_risultati_f ,$img_risultati_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_risultati_f ,$img_risultati_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_i==1 && $img_informazioni_f && trim($img_informazioni_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$img_informazioni_f ,$img_informazioni_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$img_informazioni_f ,$img_informazioni_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$img_informazioni_f ,$img_informazioni_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_b==1 && $banner_img_f && trim($banner_img_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$banner_img_f ,$banner_img_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$banner_img_f ,$banner_img_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$banner_img_f ,$banner_img_f, $dir_imm="img_up/regate", $start="400_" );
	}
	if($img_be==1 && $banner_img_eng_f && trim($banner_img_eng_f)!=""){
		$oggetto_admin->thumbjpg( "1200" ,  "img_up/regate/".$banner_img_eng_f ,$banner_img_eng_f, $dir_imm="img_up/regate", $start="1200_" );
		$oggetto_admin->thumbjpg( "800" ,  "img_up/regate/".$banner_img_eng_f ,$banner_img_eng_f, $dir_imm="img_up/regate", $start="800_" );
		$oggetto_admin->thumbjpg( "400" ,  "img_up/regate/".$banner_img_eng_f ,$banner_img_eng_f, $dir_imm="img_up/regate", $start="400_" );
	}
?>
	<script language="javascript">
		window.location='admin.php?cmd=edizioni_mod&id_rec=<?php echo $id_rec;?><?php echo $rif;?>';
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
	<div style="height:50px;font-size:1.2em;padding-top:10px">Modifica <b>Edizione <?php  echo $n_anno; ?></b> <?php  if ($id_rife!="") echo "della regata <b>".ucfirst($nome_reg)."</b>"; ?></div>
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
		<form name="inserimento" class="mws-form" action="admin.php?cmd=edizioni_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Nome Regata *" , "nome_regata" , "$n_nome_regata"  , "1", 'no', "$cmd", "$id_rec");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Visibilità Edizione</label>
					<div class="mws-form-item">
						<input name="visibile" type="hidden" class="medium" value="<?php echo $n_visibile;?>">
						<span id="checkVisib" style="cursor:pointer;" onclick="changeVisib()">
						<?php if($n_visibile==0){?>
							<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>
						<?php }else{?>
							<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>
						<?php }?>
						</span>
					</div>
				</div>
				
				<script type="text/javascript">
					var cv=<?php echo $n_visibile;?>;
					function changeVisib(){
						if(cv==0){
							cv=1;
							document.getElementById('checkVisib').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.visibile.value='1';
						}else{
							cv=0;
							document.getElementById('checkVisib').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.visibile.value='0';
						}
					}	
				</script>
				<?php 
				$oggetto_admin->campo_mod("Luogo *" , "luogo" , "$n_luogo"  , "1", 'no', "$cmd", "$id_rec");
				$oggetto_admin->campo_mod("Logo Edizione" , "logo_edizione" , "$n_logo_edizione"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");
				?>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Dal *</label>
						<div class="mws-form-item">
							<input type="text" name="data_dal_mod" class="mws-datepicker large"  value="<?php echo $n_data_dal;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Al *</label>
						<div class="mws-form-item">
							<input type="text" name="data_al_mod" class="mws-datepicker large"  value="<?php echo $n_data_al;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Link Esterno<br/><i>(include http o https)</i>" , "link_esterno" , "$n_link_esterno"  , "1", 'no', "$cmd", "$id_rec","","","img_up/regate");
				$oggetto_admin->campo_mod("Link Esterno (Inglese)" , "link_esterno_eng" , "$n_link_esterno_eng"  , "1", 'no', "$cmd", "$id_rec","","","img_up/regate");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (Italiano)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descrizione"><?php  echo $n_descr; ?></textarea>
						<a href="admin.php?cmd=edizioni_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=descrizione<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="descrizione_eng"><?php  echo $n_descr_eng; ?></textarea>
						<a href="admin.php?cmd=edizioni_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=descrizione_eng<?php echo $rif;?>">
							<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				
				<?php				
				$oggetto_admin->campo_mod("Immagine Banner<br/><i>(larghezza 1920)</i>" , "banner_img" , "$n_banner_img"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");			
				$oggetto_admin->campo_mod("Link Banner<br/><i>(include http o https)</i>" , "banner_link" , "$n_banner_link"  , "1", 'no', "$cmd", "$id_rec");						
				$oggetto_admin->campo_mod("Immagine Banner (eng)<br/><i>(larghezza 1920)</i>" , "banner_img_eng" , "$n_banner_img_eng"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");
				$oggetto_admin->campo_mod("Link Banner (eng)<br/><i>(include http o https)</i>" , "banner_link_eng" , "$n_banner_link_eng"  , "1", 'no', "$cmd", "$id_rec");										
				?>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Crew/Boat Board</label>
					<div class="mws-form-item" style="cursor:pointer;" onclick="changeBoard()">
						<input name="crew_board" type="hidden" class="medium" value="<?php echo $n_crew;?>">
						<?php if($n_crew==0){?>
							<span id="checkBoard"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkBoard"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
				</div>
				<script type="text/javascript">
					var cb=<?php echo $n_crew;?>;
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
				
				<div class="mws-form-row">
					<label class="mws-form-label">Modulo Iscrizioni</label>
					<div class="mws-form-item" style="cursor:pointer;" onclick="changeModulo()">
						<input name="modulo_iscrizioni" type="hidden" class="medium" value="<?php echo $n_modulo;?>">
						<?php if($n_modulo==0){?>
							<span id="checkModulo"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkModulo"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
				</div>
				<script type="text/javascript">
					var modulo=<?php echo $n_modulo;?>;
					function changeModulo(){
						if(modulo==0){
							modulo=1;
							document.getElementById('checkModulo').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
							document.inserimento.modulo_iscrizioni.value='1';
						}else{
							modulo=0;
							document.getElementById('checkModulo').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
							document.inserimento.modulo_iscrizioni.value='0';
						}
					}	
				</script>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Template V.2</label>
					<div class="mws-form-item" style="cursor:pointer;" onclick="changeV2()">
						<input name="new" type="hidden" class="medium" value="<?php echo $n_new;?>">
						<?php if($n_new==0){?>
							<span id="checkV2"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkV2"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
				</div>
				<script type="text/javascript">
					var v2=<?php echo $n_new;?>;
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
						<input name="new2" type="hidden" class="medium" value="<?php echo $n_new2;?>">
						<?php if($n_new2==0){?>
							<span id="checkV3"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
						<?php }else{?>
							<span id="checkV3"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
						<?php }?>
					</div>
				</div>
				<script type="text/javascript">
					var v3=<?php echo $n_new2;?>;
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
				
				
				<div <?php if($n_new==0){?>style="display:none"<?php }?> id="TemplateV2">
					<div class="mws-button-row">
						<div style="font-weight:bold">Campi per Template V.2</div>
					</div>
					<div class="mws-form-inline">						
						<?php 
						$oggetto_admin->campo_mod("Immagine Testata<br/><i>(1920x600)</i>" , "img_testata" , "$n_img_testata"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");
						
						$oggetto_admin->campo_mod("Immagine Documenti<br/><i>(1920x1100)</i>" , "img_documenti" , "$n_img_documenti"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");
						$oggetto_admin->campo_mod("Immagine Comunicati<br/><i>(1920x1100)</i>" , "img_noticeboard" , "$n_img_noticeboard"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");
						$oggetto_admin->campo_mod("Immagine Risulrati<br/><i>(1920x1100)</i>" , "img_risultati" , "$n_img_risultati"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");
						$oggetto_admin->campo_mod("Immagine Informazioni<br/><i>(1920x1100)</i>" , "img_informazioni" , "$n_img_informazioni"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");
						?>
					</div>
				</div>
				
				<div <?php if($n_new2==0){?>style="display:none"<?php }?> id="TemplateV3">
					<div class="mws-button-row">
						<div style="font-weight:bold">Campi per Template V.3</div>
					</div>
					<div class="mws-form-inline">						
						<?php 
						$oggetto_admin->campo_mod("Immagine Testata<br/><i>(1920x600)</i>" , "img_testata_v3" , "$n_img_testata_v3"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");						
						$oggetto_admin->campo_mod("Immagine Documenti<br/><i>(1920x1100)</i>" , "img_documenti_v3" , "$n_img_documenti_v3"  , "4", 'no', "$cmd", "$id_rec","","","img_up/regate");						
						?>
					</div>
				</div>
				
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;">
					<i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i> cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i>
				</div>
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
