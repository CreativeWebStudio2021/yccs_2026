<?php 
$query_rec = "select * from sail_talk_articolo where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_tit = $arr_rec['titolo'];
$n_tit_eng = $arr_rec['titolo_eng'];
$n_sottotit = $arr_rec['sottotitolo'];
$n_sottotit_eng = $arr_rec['sottotitolo_eng'];
$n_cat = $arr_rec['id_cat'];
$n_sottocat = $arr_rec['id_sottocat'];
$n_foto = $arr_rec['immagine'];
$n_data = $arr_rec['data_articolo'];
$n_anno_regata = $arr_rec['anno_regata'];
if( $arr_rec['id_regata']) $n_id_regata = $arr_rec['id_regata']; else $n_id_regata = "";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['id_cat_ric'])) $id_cat_ric=$_GET['id_cat_ric']; else $id_cat_ric="";
if(isset($_GET['id_sottocat_ric'])) $id_sottocat_ric=$_GET['id_sottocat_ric']; else $id_sottocat_ric="";

if(isset($_GET['id_rec_blocco'])) $id_rec_blocco=$_GET['id_rec_blocco']; else $id_rec_blocco="";
if(isset($_GET['campocanc_blocco'])) $campocanc_blocco=$_GET['campocanc_blocco']; else $campocanc_blocco="";

if(isset($_GET['id_canc_blocco'])) $id_canc_blocco=$_GET['id_canc_blocco']; else $id_canc_blocco="";
if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";

$rif="";
$rif.="&pag_att=$pag_att";
if($id_cat_ric!=""){$rif.="&id_cat_ric=$id_cat_ric";}
if($id_sottocat_ric!=""){$rif.="&id_sottocat_ric=$id_sottocat_ric";}

$ind=0;
$ind++; $array_stili[$ind]="solo_testo";
$ind++; $array_stili[$ind]="solo_immagine";
$ind++; $array_stili[$ind]="immagine_testo";
$ind++; $array_stili[$ind]="testo_immagine";
$ind++; $array_stili[$ind]="gallery";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=sail_talk_articolo<?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		/*if (document.gino.id_cat.value=="") alert('Argomento obbigatorio');
		else if (document.gino.id_sottocat.value=="") alert('Categoria obbigatoria');
		else*/ if (document.gino.titolo.value=="") alert('Titolo obbigatorio');
		else if (document.gino.data_articolo.value=="") alert('Data obbigatoria');
		/*else if (document.gino.descrizione.value=="") alert('Testo obbigatorio');*/
		else document.gino.submit();
	}
	
	function verifica_blocco(){
		if (document.nuovo_blocco.testo.value=="") alert('Testo obbigatorio');
		else document.nuovo_blocco.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from sail_talk_articolo where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/sail_talk/$cancimg")){unlink("img_up/sail_talk/$cancimg");}
	if(is_file("img_up/sail_talk/s_$cancimg")){unlink("img_up/sail_talk/s_$cancimg");}
	
	$query_canc_img = "update sail_talk_articolo set $campocanc=NULL where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
	
	if($campocanc=="id_cat"){
		$query_canc_img = "update sail_talk_articolo set id_sottocat=NULL where id='$id_rec'";
		$open_connection->connection->query($query_canc_img);
	}
?>
	<script language="javascript">
		window.location='admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($campocanc_blocco!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc_blocco from sail_talk_blocchi where id='$id_rec_blocco'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/sail_talk/$cancimg")){unlink("img_up/sail_talk/$cancimg");}
	if(is_file("img_up/sail_talk/s_$cancimg")){unlink("img_up/sail_talk/s_$cancimg");}
	
	$query_canc_img = "update sail_talk_blocchi set $campocanc_blocco='' where id='$id_rec_blocco'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("sail_talk_blocchi", "$id_canc", "id_articolo", "$id_rec") ;
	if($azione=="scendi") $oggetto_admin->scendi("sail_talk_blocchi", "$id_canc", "id_articolo", "$id_rec") ;
	if($azione=="primo") $oggetto_admin->primo("sail_talk_blocchi", "$id_canc", "id_articolo", "$id_rec");
	if($azione=="ultimo") $oggetto_admin->ultimo("sail_talk_blocchi", "$id_canc", "id_articolo", "$id_rec");
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo"){?>
		<script type="text/javascript">
			//window.location='admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
		</script>
	<?php }
}

if($id_canc_blocco!="" && $azione=="cancella"){
	$query_b="SELECT * FROM sail_talk_blocchi WHERE id='$id_canc_blocco'";
	$resu_b=$open_connection->connection->query($query_b);
	$risu_b=$resu_b->fetch();
	
	if($risu_b['tipo']=="gallery"){
		$query_g="SELECT * FROM sail_talk_gallery WHERE id_gallery='".$risu_b['id_gallery']."'";
		$resu_g=$open_connection->connection->query($query_g);
		while($risu_g=$resu_g->fetch()){
			$cancimg = $risu_g['immagine'];
			if($cancimg && $cancimg!=""){
				if(is_file("img_up/sail_talk/$cancimg")){unlink("img_up/sail_talk/$cancimg");}
				if(is_file("img_up/sail_talk/s_$cancimg")){unlink("img_up/sail_talk/s_$cancimg");}
			}
			$query_del="DELETE from sail_talk_gallery WHERE id='".$risu_g['id']."'";
			$risu_del=$open_connection->connection->query($query_del);
		}
	}
	
	$cancimg = $risu_b['immagine'];
	if($cancimg && $cancimg!=""){
		if(is_file("img_up/sail_talk/$cancimg")){unlink("img_up/sail_talk/$cancimg");}
		if(is_file("img_up/sail_talk/s_$cancimg")){unlink("img_up/sail_talk/s_$cancimg");}
	}
	
	$query_del="DELETE from sail_talk_blocchi WHERE id='$id_canc_blocco'";
	$risu_del=$open_connection->connection->query($query_del);
	?>
		<script language="javascript">
			window.location = "admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?><?php echo $rif;?>" ;
		</script>
	<?php 	
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_no['data_articolo_giorni']=1;
	$arr_no['data_articolo_mesi']=1;
	$arr_no['data_articolo_anni']=1;
	$arr_thumb['immagine']=400; 
	
	$_POST['titolo']=str_replace('"','\"',$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"','\"',$_POST['titolo_eng']);
	//$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	//$_POST['testo_eng']=str_replace('"','\"',$_POST['testo_eng']);

	$oggetto_admin->modifica_campi ("sail_talk_articolo" ,$id_rec , $arr_no ,  $arr_thumb, "img_up/sail_talk");
?>
	<script language="javascript">
		window.location = "admin.php?cmd=sail_talk_articolo<?php echo $rif;?>" ;
	</script>
<?php 
}elseif($stato=="nuovo_blocco_inviato"){
	$arr_no['stato']=1;
	$arr_thumb['immagine']=400; 
	$oggetto_admin->inserisci_campi ("sail_talk_blocchi" , $arr_no ,  $arr_thumb, "img_up/sail_talk");
	?>
	<script language="javascript">
		window.location = "admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?><?php echo $rif;?>" ;
	</script>
<?php 	
}elseif($stato=="nuovo_blocco_gallery_inviato"){
	$id_gallery = $oggetto_admin->trova_ordine2("sail_talk_blocchi", "", "","","","id_gallery");
	$query_ins="INSERT INTO sail_talk_blocchi (id_articolo, ordine, tipo, id_gallery) VALUES ('$id_rec','".$_POST['ordine']."','".$_POST['tipo']."','$id_gallery')";
	$risu_in = $open_connection->connection->query($query_ins);
	
	for($x=0; $x<count ($_FILES['immagine']['name']); $x++){
		//echo "@".$_FILES['immagine']['name'][$x]."<br/>";
		
		$nome_file = $_FILES['immagine']['name'][$x];
		$temp_file = $_FILES['immagine']['tmp_name'][$x];
		
		if ($nome_file) {		
			
			$nome_file =  $oggetto_admin->scrivi_img($nome_file , $temp_file, "img_up/sail_talk");
			
			list($larghezza_gr , $height, $type, $attr) = getimagesize($temp_file);
			if ($larghezza_gr>1000) $oggetto_admin->thumbjpg_new(1000,$temp_file,$nome_file,"img_up/sail_talk");			
			
			$ord_gallery = $oggetto_admin->trova_ordine2("sail_talk_gallery", "id_gallery", "$id_gallery");
			
			$query_ins_file = "insert into sail_talk_gallery (id_gallery, ordine, immagine) values ('$id_gallery','$ord_gallery','$nome_file')";
			//echo $query_ins_file."<br/>";
			$risu_ins_file = $open_connection->connection->query($query_ins_file);
		}
	}
	?>
	<script language="javascript">
		window.location = "admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?><?php echo $rif;?>" ;
	</script>
	<?php 
}elseif($stato=="modifica_blocco_inviato"){
	$arr_no['stato']=1;
	$arr_thumb['immagine']=400; 
	$oggetto_admin->modifica_campi ("sail_talk_blocchi" ,$id_rec_blocco , $arr_no ,  $arr_thumb, "img_up/sail_talk");
	?>
	<script language="javascript">
		window.location = "admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?><?php echo $rif;?>" ;
	</script>
	
<?php }elseif($stato=="modifica_blocco_gallery_inviato"){
	if(isset($_POST['id_gallery'])) $id_gallery=$_POST['id_gallery']; else $id_gallery="";
	if($id_gallery==""){
		$id_gallery = $oggetto_admin->trova_ordine2("sail_talk_blocchi", "id_articolo", "$id_rec","","","id_gallery");
	}
	$query_up="UPDATE sail_talk_blocchi SET tipo='gallery', id_gallery='$id_gallery' WHERE id='$id_rec_blocco'";
	//echo $query_up."<br/>";
	$risu_up = $open_connection->connection->query($query_up);
	for($x=0; $x<count ($_FILES['immagine']['name']); $x++){
		//echo "@".$_FILES['immagine']['name'][$x]."<br/>";
		
		$nome_file = $_FILES['immagine']['name'][$x];
		$temp_file = $_FILES['immagine']['tmp_name'][$x];
		
		if ($nome_file) {		
			
			$nome_file =  $oggetto_admin->scrivi_img($nome_file , $temp_file, "img_up/sail_talk");
			
			list($larghezza_gr , $height, $type, $attr) = getimagesize($temp_file);
			if ($larghezza_gr>1000) $oggetto_admin->thumbjpg_new(1000,$temp_file,$nome_file,"img_up/sail_talk");			
			
			$ord_gallery = $oggetto_admin->trova_ordine2("sail_talk_gallery", "id_gallery", "$id_gallery");
			
			$query_ins_file = "insert into sail_talk_gallery (id_gallery, ordine, immagine) values ('$id_gallery','$ord_gallery','$nome_file')";
			//echo $query_ins_file."<br/>";
			$risu_ins_file = $open_connection->connection->query($query_ins_file);
		}
	}
	?>
	<script language="javascript">
		window.location = "admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?><?php echo $rif;?>" ;
	</script>
	<?php 
}else{?>
	<div class="mws-panel grid_8">
		<div style="float:left; margin-top:5px; height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Articolo</b></div>
		<div style="float:left; margin-left:20px; height:50px;font-size:1.2em;padding-top:10px">
			<?php 
			$link_sail_talk ="../sail_talk/";							
			
			if($n_cat){
				$query_a="SELECT id, nome FROM sail_talk_macrocategorie WHERE id='".$n_cat."'";
				$resu_a=$open_connection->connection->query($query_a);
				$risu_a = $resu_a->fetch();
				$nome_cat = $risu_a['nome'];
				$link_sail_talk.=to_htaccess_url($nome_cat,"")."/";							
			}
			
			if($n_sottocat){
				$query_c="SELECT id, nome FROM sail_talk_categorie WHERE id='".$n_sottocat."'";
				$resu_c=$open_connection->connection->query($query_c);
				$risu_c = $resu_c->fetch();
				$nome_sottocat = $risu_c['nome'];
				$link_sail_talk.=to_htaccess_url($nome_sottocat,"")."/";							
			}
			
			$link_sail_talk.=to_htaccess_url($n_tit,"");
			$link_sail_talk.="-".$id_rec.".html";
			?>
			<a href="<?php echo $link_sail_talk;?>" target="_blank" style="text-decoration: none">
				<div style="width:140px; background:red; text-align:center; color:#fff; z-index:1000000">
					<div style="padding:5px;">
						VEDI ANTEPRIMA
					</div>
				</div>
			</a>
		</div>
		<div style="clear:both"></div>
		
		<div style="display:flex; justify-content:space-between;">
			<a href="admin.php?cmd=sail_talk_articolo<?php echo $rif;?>" style="color:#7a7a7a">
				<div class="newAdminBott2">
					<i class="fa fa-caret-left" aria-hidden="true"></i>
					&nbsp;
					<b>Torna all'elenco degli articoli</b>
				</div>
			</a>
			<div></div>
		</div>
		
		<div class="mws-panel-header">
			<span>Dati richiesti</span>
		</div>
		<div class="mws-panel-body no-padding">
			<form name="gino" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
				<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
				<input type="hidden" name="stato" value="inviato">
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Argomento</label>
						<div class="mws-form-item">
							<select name="id_cat" class="small" onchange="cambiaCat(this.value,'','<?php echo $id_rec;?>','<?php echo $rif;?>')">
								<option value="">Seleziona</option>
								<?php 
								$query_m="SELECT * FROM sail_talk_macrocategorie ORDER BY ordine DESC";
								$resu_m=$open_connection->connection->query($query_m);
								while($risu_m=$resu_m->fetch()){?>
									<option value="<?php echo $risu_m['id'];?>" <?php if($risu_m['id']==$n_cat){?>selected="selected"<?php }?>><?php echo $risu_m['nome'];?></option>
								<?php }?>					
							</select>
							&nbsp;<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?>&campocanc=id_cat<?php echo $rif;?>"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i></a>
						</div>
					</div>
					
					<div class="mws-form-row">
						<label class="mws-form-label">Categoria</label>
						<div class="mws-form-item" id="listaCat"></div>					
			
						<script>
							function cambiaCat(argomento, id_sottocat_ric, id_rec, rif){
								$.ajax({
									url: "ajax/sail_talk_categorie.php", 
									type: "GET",
									data: {argomento : argomento, id_sottocat_ric : id_sottocat_ric, id_rec : id_rec, rif : rif}, 
									success: function(result){
										$("#listaCat").html(result);
									}
								});
							}
							
							cambiaCat('<?php echo $n_cat;?>','<?php echo $n_sottocat;?>','<?php echo $id_rec;?>','<?php echo $rif;?>');
						</script>	
					</div>
				
					<div class="mws-form-row">
						<label class="mws-form-label">Anno Regata <?php echo $n_anno_regata;?></label>
						<div class="mws-form-item">
							<select name="anno_regata" class="small" onchange="cambiaAnno(this.value)">
								<option value="">Seleziona</option>
								<?php 
								$query_m="SELECT DISTINCT anno FROM edizioni_regate ORDER BY anno DESC";
								$resu_m=$open_connection->connection->query($query_m);
								while($risu_m=$resu_m->fetch()){?>
									<option value="<?php echo $risu_m['anno'];?>" <?php if($risu_m['anno']==$n_anno_regata){?>selected="selected"<?php }?>><?php echo $risu_m['anno'];?></option>
								<?php }?>					
							</select>
						</div>
					</div>
					
					<div class="mws-form-row">
						<label class="mws-form-label">Regata</label>
						<div class="mws-form-item" id="listaRegate"></div>					
			
						<script>
							function cambiaAnno(anno, id_regata=""){
								$.ajax({
									url: "ajax/sail_talk_regate.php", 
									type: "GET",
									data: {anno : anno, id_regata : id_regata}, 
									success: function(result){
										$("#listaRegate").html(result);
									}
								});
							}
							
							<?php if($n_anno_regata && $n_anno_regata!=""){?>
								cambiaAnno("<?php echo $n_anno_regata;?>","<?php echo $n_id_regata;?>");
							<?php }?>
						</script>	
					</div>
					<?php 
					$oggetto_admin->campo_mod("Titolo (Italiano)*" , "titolo" , "$n_tit"  , "1", 'no', "$cmd", "$id_rec");
					$oggetto_admin->campo_mod("Titolo (Inglese)" , "titolo_eng" , "$n_tit_eng"  , "1", 'no', "$cmd", "$id_rec");
					$oggetto_admin->campo_mod("Sottoitolo (Italiano)" , "sottotitolo" , "$n_sottotit"  , "1", 'no', "$cmd", "$id_rec");
					$oggetto_admin->campo_mod("Sottoitolo (Inglese)" , "sottotitolo_eng" , "$n_sottotit_eng"  , "1", 'no', "$cmd", "$id_rec");
					$oggetto_admin->campo_mod("Data *" , "data_articolo" , "$n_data"  , "7", 'no', "$cmd", "$id_rec");
					?>
					<?php 
					$oggetto_admin->campo_mod("Foto" , "immagine" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/sail_talk");
					?>
					<br/><br/>
					<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
					<div style="margin-left:20px; padding-bottom:10px;"><i style="font-size:1.5em;" class="fa fa-eraser" aria-hidden="true"></i> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
				</div>
				<div class="mws-button-row">
					<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
					<input type="button" value="Annulla" class="btn" onclick="annulla()">
				</div>
			</form>
			
			
			<div style="background:#000; color:#fff">
				<div style="padding:15px 25px"><b>BLOCCHI PAGINA</b></div>
			</div>
			
			<style>
				.tronca-testo {
				  white-space: nowrap;       /* Il testo non va a capo */
				  overflow: hidden;          /* Nasconde il testo in eccesso */
				  text-overflow: ellipsis;   /* Mostra i puntini di sospensione */
				  width: 80%;              /* Definisci una larghezza specifica */
				}
			</style>
			
			<?php 
			$x=1;
			$query_b="SELECT * FROM sail_talk_blocchi WHERE id_articolo='$id_rec' ORDER BY ordine ASC";
			$resu_b=$open_connection->connection->query($query_b);
			while($risu_b=$resu_b->fetch()){
				$n_testo = $risu_b['testo'];
				$n_testo_eng = $risu_b['testo_eng'];
				$n_tipo = $risu_b['tipo'];
				$n_immagine = $risu_b['immagine'];
				$n_id_gallery = $risu_b['id_gallery'];
				$id_blocco = $risu_b['id'];
				?>
				<form class="mws-form">
					<div class="mws-button-row" style="display:flex; justify-content:space-between; align-items:center; <?php if($x % 2 === 0){?>background:#fff<?php }?>">
						<div style="width: -webkit-calc(100% - 200px); width:-moz-calc(100% - 200px); width:calc(100% - 200px); cursor:pointer;" onclick="vedi_blocco('<?php echo $id_blocco;?>');">
							<span id="blocco_bott_<?php echo $id_blocco;?>">
								<i class="fa fa-plus" aria-hidden="true"></i>
							</span>&nbsp;&nbsp;<b>Blocco Pagina <?php echo $x;?> (<?php echo ucWords(str_replace("_"," ",$n_tipo));?>)</b>
							<?php if($n_tipo!="solo_immagine" && $n_tipo!="gallery"){?>
								<div style="margin-left:20px;" class="tronca-testo">
									<?php echo strip_tags($n_testo);?>
								</div>
							<?php }?>
							<?php if($n_tipo!="solo_testo"){?>
								<div style="margin-left:20px; difplay:flex; gap:10px; margin-top:5px;">
									<?php if($n_tipo!="gallery"){
											if(file_exists("img_up/sail_talk/s_$n_immagine")) $ante = "img_up/sail_talk/s_$n_immagine";
											elseif(file_exists("img_up/sail_talk/$n_immagine")) $ante = "img_up/sail_talk/$n_immagine";
											else $ante = "https://www.yccs.it/resarea/img_up/sail_talk/$n_immagine";
											?>
											<img src="<?php echo $ante;?>" style="height:50px; width:auto;" alt=""/>
									<?php }else{		
											$query_ele = "SELECT * FROM magazine_gallery WHERE id_gallery = '$n_id_gallery' ORDER BY ordine DESC";
											$risu_ele = $open_connection->connection->query($query_ele);
											$num_item=$risu_ele->rowCount();
											
											for($x=0;$x<$num_item;$x++)			
											{						
												$arr_ele = $risu_ele->fetch();
												$immagine = $arr_ele['immagine'];
												
												if(file_exists("img_up/sail_talk/s_$immagine")) $ante = "img_up/sail_talk/s_$immagine";
												elseif(file_exists("img_up/sail_talk/$immagine")) $ante = "img_up/sail_talk/$immagine";
												else $ante = "https://www.yccs.it/resarea/img_up/sail_talk/$immagine";
												?>
												<img src="<?php echo $ante;?>" style="height:50px; width:auto;" alt=""/> <?php
											 }?>
									<?php }?>							
								</div>
							<?php }?>
						</div>
						<div style="width:200px;">
							<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?>&id_canc=<?php  echo $id_blocco; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?>&id_canc=<?php  echo $id_blocco; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?>&id_canc=<?php  echo $id_blocco; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?>&id_canc=<?php  echo $id_blocco; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
						</div>
						<div style="clear:both"></div>
					</div>
				</form>
				<div class="mws-form-inline" id="blocco_<?php echo $id_blocco;?>" style="display:none">
					<form class="mws-form">
						<div class="mws-form-row">
							<label class="mws-form-label">Stile Blocco</label>
							<div class="mws-form-item">
								<?php 
								for($i=1; $i<=count($array_stili); $i++){?>							
									<div style="float:left; text-align:center; border:solid 1px; margin-right:10px; <?php if($n_tipo==$array_stili[$i]){?>background:#D2D2D2<?php }?>" id="<?php echo $array_stili[$i];?>_mod_<?php echo $id_blocco;?>">
										<div style="padding:5px 15px; cursor:pointer" onclick="modificaStile('<?php echo $array_stili[$i];?>','<?php echo $id_blocco;?>')">
											<?php echo ucWords(str_replace("_"," ",$array_stili[$i]));?><br/>
										</div>
									</div>
								<?php }?>
							</div>
						</div>
					</form>
					
					<form style="display:<?php if($n_tipo=="solo_testo"){?>block<?php }else{?>none<?php }?>" name="mod_blocco_solo_testo_<?php echo $id_blocco;?>" id="mod_blocco_solo_testo_<?php echo $id_blocco;?>" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?>&id_rec_blocco=<?php echo $id_blocco;?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="stato" value="modifica_blocco_inviato">
						<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
						<input type="hidden" name="tipo" value="solo_testo">
						
						<div class="mws-form-row">
							<label class="mws-form-label">Testo (Italiano)*</label>
							<div class="mws-form-item">
								<textarea class="ckeditor" name="testo" id="testo_solo_testo_<?php echo $id_blocco;?>"><?php echo $n_testo;?></textarea>
							</div>
						</div>
						<div class="mws-form-row">
							<label class="mws-form-label">Testo (Inglese)</label>
							<div class="mws-form-item">
								<textarea class="ckeditor" name="testo_eng" ><?php echo $n_testo_eng;?></textarea>
							</div>
						</div>
						
						<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
							<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica_mod_blocco_solo_testo_<?php echo $id_blocco;?>()">
							<input type="button" value="Cancella" class="btn" onclick="if(confirm('Eliminare blocco?')){cancellaBlocco('<?php echo $id_blocco;?>')}">
						</div>
						
						<script>
							function verifica_mod_blocco_solo_testo_<?php echo $id_blocco;?>(){
								var testo = CKEDITOR.instances.testo_solo_testo_<?php echo $id_blocco;?>.getData();
								if (testo=="") alert('Testo obbigatorio');
								else document.mod_blocco_solo_testo_<?php echo $id_blocco;?>.submit();
							}
						</script>
					</form>
				
					<!-- SOLO IMMAGINE -->
					<form style="display:<?php if($n_tipo=="solo_immagine"){?>block<?php }else{?>none<?php }?>"  name="mod_blocco_solo_immagine_<?php echo $id_blocco;?>" id="mod_blocco_solo_immagine_<?php echo $id_blocco;?>" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?>&id_rec_blocco=<?php echo $id_blocco;?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="stato" value="modifica_blocco_inviato">
						<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
						<input type="hidden" name="tipo" value="solo_immagine">
						<div class="mws-form-row">
							<label class="mws-form-label">Foto<br /><i>(Dim. 1920 pixel)</i></label>
							<div class="mws-form-item">
								<?php if($n_immagine && $n_immagine!=""){?>
								<img  style="margin-left:20px; margin-right:10px; width:150px" src="img_up/sail_talk/<?php if(is_file("img_up/sail_talk/s_".$n_immagine)) echo "s_";?><?php echo $n_immagine;?>" border="0" align="absmiddle">
								<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?>&id_rec_blocco=<?php echo $id_blocco;?>&campocanc_blocco=immagine" class="testo10" > 
									<i style="color:#29292c; font-size:1.3em" class="fa fa-trash" aria-hidden="true"></i>
								</a>
								<?php }?>
								<input name="immagine" type="file" class="medium" size="60" id="immagine">
							</div>
						</div>
						
						<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
							<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica_mod_blocco_solo_immagine_<?php echo $id_blocco;?>()">
							<input type="button" value="Cancella" class="btn" onclick="if(confirm('Eliminare blocco?')){cancellaBlocco('<?php echo $id_blocco;?>')}">
						</div>
						
						<script>
							function verifica_mod_blocco_solo_immagine_<?php echo $id_blocco;?>(){
								<?php if(!$n_immagine || $n_immagine==""){?>
								if (document.mod_blocco_solo_immagine_<?php echo $id_blocco;?>.immagine.value=="") alert('Immagine obbigatoria');
								else <?php }?>document.mod_blocco_solo_immagine_<?php echo $id_blocco;?>.submit();
							}
						</script>
					</form>
					
					<!-- IMMAGINE/TESTO -->
					<form style="display:<?php if($n_tipo=="immagine_testo"){?>block<?php }else{?>none<?php }?>"  name="mod_blocco_immagine_testo_<?php echo $id_blocco;?>" id="mod_blocco_immagine_testo_<?php echo $id_blocco;?>" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?>&id_rec_blocco=<?php echo $id_blocco;?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="stato" value="modifica_blocco_inviato">
						<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
						<input type="hidden" name="tipo" value="immagine_testo">
						
						<div class="mws-form-row">
							<label class="mws-form-label">Foto<br /><i>(Dim. 1000 pixel)</i></label>
							<div class="mws-form-item">
								<?php if($n_immagine && $n_immagine!=""){?>
								<img  style="margin-left:20px; margin-right:10px; width:150px" src="img_up/sail_talk/<?php if(is_file("img_up/sail_talk/s_".$n_immagine)) echo "s_";?><?php echo $n_immagine;?>" border="0" align="absmiddle">
								<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?>&id_rec_blocco=<?php echo $id_blocco;?>&campocanc_blocco=immagine" class="testo10" > 
									<i style="color:#29292c; font-size:1.3em" class="fa fa-trash" aria-hidden="true"></i>
								</a>
								<?php }?>
								<input name="immagine" type="file" class="medium" size="60" id="immagine">
							</div>
						</div>
						
						<div class="mws-form-row">
							<label class="mws-form-label">Testo (Italiano)*</label>
							<div class="mws-form-item">
								<textarea class="ckeditor" name="testo" id="testo_immagine_testo_<?php echo $id_blocco;?>"><?php echo $n_testo;?></textarea>
							</div>
						</div>
						<div class="mws-form-row">
							<label class="mws-form-label">Testo (Inglese)</label>
							<div class="mws-form-item">
								<textarea class="ckeditor" name="testo_eng"><?php echo $n_testo_eng;?></textarea>
							</div>
						</div>
						
						<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
							<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica_mod_blocco_immagine_testo_<?php echo $id_blocco;?>()">
							<input type="button" value="Cancella" class="btn" onclick="if(confirm('Eliminare blocco?')){cancellaBlocco('<?php echo $id_blocco;?>')}">
						</div>
						
						<script>
							function verifica_mod_blocco_immagine_testo_<?php echo $id_blocco;?>(){
								var testo = CKEDITOR.instances.testo_immagine_testo_<?php echo $id_blocco;?>.getData();
								<?php if(!$n_immagine || $n_immagine==""){?>
								if (document.mod_blocco_immagine_testo_<?php echo $id_blocco;?>.immagine.value=="") alert('Immagine obbigatoria');
								else <?php }?> if (testo=="") alert('Testo obbigatorio');
								else document.mod_blocco_immagine_testo_<?php echo $id_blocco;?>.submit();
							}
						</script>
					</form>
				
					<!-- TESTO/IMMAGINE -->
					<form style="display:<?php if($n_tipo=="testo_immagine"){?>block<?php }else{?>none<?php }?>"  name="mod_blocco_testo_immagine_<?php echo $id_blocco;?>" id="mod_blocco_testo_immagine_<?php echo $id_blocco;?>" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?>&id_rec_blocco=<?php echo $id_blocco;?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="stato" value="modifica_blocco_inviato">
						<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
						<input type="hidden" name="tipo" value="testo_immagine">
						
						<div class="mws-form-row">
							<label class="mws-form-label">Testo (Italiano)*</label>
							<div class="mws-form-item">
								<textarea class="ckeditor" name="testo" id="testo_testo_immagine_<?php echo $id_blocco;?>"><?php echo $n_testo;?></textarea>
							</div>
						</div>
						<div class="mws-form-row">
							<label class="mws-form-label">Testo (Inglese)</label>
							<div class="mws-form-item">
								<textarea class="ckeditor" name="testo_eng"><?php echo $n_testo_eng;?></textarea>
							</div>
						</div>
						<div class="mws-form-row">
							<label class="mws-form-label">Foto<br /><i>(Dim. 1000 pixel)</i></label>
							<div class="mws-form-item">
								<?php if($n_immagine && $n_immagine!=""){?>
								<img  style="margin-left:20px; margin-right:10px; width:150px" src="img_up/sail_talk/<?php if(is_file("img_up/sail_talk/s_".$n_immagine)) echo "s_";?><?php echo $n_immagine;?>" border="0" align="absmiddle">
								<a href="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_rec;?>&id_rec_blocco=<?php echo $id_blocco;?>&campocanc_blocco=immagine" class="testo10" > 
									<i style="color:#29292c; font-size:1.3em" class="fa fa-trash" aria-hidden="true"></i>
								</a>
								<?php }?>
								<input name="immagine" type="file" class="medium" size="60" id="immagine">
							</div>
						</div>
						
						<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
							<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica_mod_blocco_testo_immagine_<?php echo $id_blocco;?>()">
							<input type="button" value="Cancella" class="btn" onclick="if(confirm('Eliminare blocco?')){cancellaBlocco('<?php echo $id_blocco;?>')}">
						</div>
						
						<script>
							function verifica_mod_blocco_testo_immagine_<?php echo $id_blocco;?>(){
								var testo = CKEDITOR.instances.testo_testo_immagine_<?php echo $id_blocco;?>.getData();
								if (testo=="") alert('Testo obbigatorio');
								<?php if(!$n_immagine || $n_immagine==""){?>
									else if (document.mod_blocco_testo_immagine_<?php echo $id_blocco;?>.immagine.value=="") alert('Immagine obbigatoria');
								<?php }?>
								else document.mod_blocco_testo_immagine_<?php echo $id_blocco;?>.submit();
							}
						</script>
					</form>
				
					<!-- GALLERY -->
					<form style="display:<?php if($n_tipo=="gallery"){?>block<?php }else{?>none<?php }?>"  name="mod_blocco_gallery_<?php echo $id_blocco;?>" id="mod_blocco_gallery_<?php echo $id_blocco;?>" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?>&id_rec_blocco=<?php echo $id_blocco;?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="stato" value="modifica_blocco_gallery_inviato">
						<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
						<input type="hidden" name="id_gallery" value="<?php echo $n_id_gallery;?>">
						<input type="hidden" name="tipo" value="gallery">		
						
						<?php 
						$oggetto_admin->campo_ins("Immagini *<br />" , "immagine" , "42", 'no');
						?>
						
						<div id="lista_gallery_<?php echo $id_blocco;?>"></div>
						<script>
							function vediGallery(id_articolo, id_blocco, id_gallery, id_immagine, azione){
								$.ajax({
									url: "ajax/sail_talk_gallery.php", 
									type: "GET",
									data: {id_articolo : id_articolo, id_blocco : id_blocco, id_gallery : id_gallery, id_immagine : id_immagine, azione : azione}, 
									success: function(result){
										$("#lista_gallery_"+id_blocco).html(result);
									}
								});
							}
							
							vediGallery('<?php echo $id_rec;?>','<?php echo $id_blocco;?>','<?php echo $n_id_gallery;?>','','');
						</script>
						
						<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
							<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica_blocco_testo_gallery_<?php echo $id_blocco;?>()">
							<input type="button" value="Cancella" class="btn" onclick="if(confirm('Eliminare blocco?')){cancellaBlocco('<?php echo $id_blocco;?>')}">
						</div>
						
						<script>
							function verifica_blocco_testo_gallery_<?php echo $id_blocco;?>(){
								document.mod_blocco_gallery_<?php echo $id_blocco;?>.submit();
							}
						</script>
					</form>				
				</div>
				<?php $x++;
			}?>
			
			<script>
				function cancellaBlocco(id_blocco){
					window.location='admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?>&id_canc_blocco='+id_blocco+'&azione=cancella<?php echo $rif;?>';
				}
				function modificaStile(stile, id_blocco){
					document.getElementById('solo_testo_mod_'+id_blocco).style.background='#fff';
					document.getElementById('solo_immagine_mod_'+id_blocco).style.background='#fff';
					document.getElementById('immagine_testo_mod_'+id_blocco).style.background='#fff';
					document.getElementById('testo_immagine_mod_'+id_blocco).style.background='#fff';
					document.getElementById('gallery_mod_'+id_blocco).style.background='#fff';
					
					document.getElementById('mod_blocco_solo_testo_'+id_blocco).style.display='none';
					document.getElementById('mod_blocco_solo_immagine_'+id_blocco).style.display='none';
					document.getElementById('mod_blocco_immagine_testo_'+id_blocco).style.display='none';
					document.getElementById('mod_blocco_testo_immagine_'+id_blocco).style.display='none';
					document.getElementById('mod_blocco_gallery_'+id_blocco).style.display='none';
					
					document.getElementById(stile+"_mod_"+id_blocco).style.background='#D2D2D2';					
					document.getElementById('mod_blocco_'+stile+"_"+id_blocco).style.display='block';

				}
				
				function vedi_blocco(id_blocco){
					$('#blocco_'+id_blocco).toggle();
					var bott = document.getElementById('blocco_bott_'+id_blocco).innerHTML;
					if(bott=='<i class="fa fa-plus" aria-hidden="true"></i>'){
						document.getElementById('blocco_bott_'+id_blocco).innerHTML='<i class="fa fa-minus" aria-hidden="true"></i>'
					}else{
						document.getElementById('blocco_bott_'+id_blocco).innerHTML='<i class="fa fa-plus" aria-hidden="true"></i>'
					}
				}
			</script>
			
			<a name="blocchi"></a>
			<form class="mws-form">
				<div class="mws-button-row" style="border-top: solid 2px #000; border-bottom: solid 2px #000">
					<b>NUOVO BLOCCO PAGINA</b>
				</div>
			</form>
			<div class="mws-form-inline" id="blocco_<?php echo $x;?>">
				<form class="mws-form">
					<div class="mws-form-row">
						<label class="mws-form-label">Stile Blocco</label>
						<div class="mws-form-item">
							<?php 
							for($i=1; $i<=count($array_stili); $i++){?>
								<div style="float:left; text-align:center; border:solid 1px; margin-right:10px;" id="<?php echo $array_stili[$i];?>">
									<div style="padding:5px 15px; cursor:pointer;" onclick="cambiaStile('<?php echo $array_stili[$i];?>')">
										<?php echo ucWords(str_replace("_"," ",$array_stili[$i]));?><br/>									
									</div>
								</div>
							<?php }?>							
							
						</div>
					</div>
					<?php $ord = $oggetto_admin->trova_ordine("sail_talk_blocchi", "id_articolo", "$id_rec");?>
				</form>
				<script>
					function cambiaStile(stile){
						document.getElementById('solo_testo').style.background='#fff';
						document.getElementById('solo_immagine').style.background='#fff';
						document.getElementById('immagine_testo').style.background='#fff';
						document.getElementById('testo_immagine').style.background='#fff';
						document.getElementById('gallery').style.background='#fff';
						
						document.getElementById('nuovo_blocco_solo_testo').style.display='none';
						document.getElementById('nuovo_blocco_solo_immagine').style.display='none';
						document.getElementById('nuovo_blocco_immagine_testo').style.display='none';
						document.getElementById('nuovo_blocco_testo_immagine').style.display='none';
						document.getElementById('nuovo_blocco_gallery').style.display='none';
						
						document.getElementById(stile).style.background='#D2D2D2';					
						document.getElementById('nuovo_blocco_'+stile).style.display='block';

					}
				</script>
				
				<!-- SOLO TESTO -->
				<form name="nuovo_blocco_solo_testo" id="nuovo_blocco_solo_testo" style="display:none" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="stato" value="nuovo_blocco_inviato">
					<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
					<input type="hidden" name="tipo" value="solo_testo">
					<input type="hidden" name="ordine" value="<?php echo $ord;?>">
					
					<div class="mws-form-row">
						<label class="mws-form-label">Testo (Italiano)*</label>
						<div class="mws-form-item">
							<textarea class="ckeditor" name="testo" id="testo_solo_testo"></textarea>
						</div>
					</div>
					<div class="mws-form-row">
						<label class="mws-form-label">Testo (Inglese)</label>
						<div class="mws-form-item">
							<textarea class="ckeditor" name="testo_eng"></textarea>
						</div>
					</div>
					
					<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
						<input type="button" value="Aggiungi Blocco" class="btn" id="blocco_<?php echo $x;?>_button" onclick="verifica_blocco_solo_testo();">
					</div>
				</form>
				<script>
					function verifica_blocco_solo_testo(){
						var testo = CKEDITOR.instances.testo_solo_testo.getData();
						if (testo=="") alert('Testo obbigatorio');
						else document.nuovo_blocco_solo_testo.submit();
					}
				</script>
				
				<!-- SOLO IMMAGINE -->
				<form name="nuovo_blocco_solo_immagine" id="nuovo_blocco_solo_immagine" style="display:none" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="stato" value="nuovo_blocco_inviato">
					<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
					<input type="hidden" name="tipo" value="solo_immagine">
					<input type="hidden" name="ordine" value="<?php echo $ord;?>">
					<?php 
					$oggetto_admin->campo_ins("Foto<br /><i>(Dim. 1920 pixel)</i>", "immagine" , "4", 'no');
					?>
					<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
						<input type="button" value="Aggiungi Blocco" class="btn" id="blocco_<?php echo $x;?>_button" onclick="verifica_blocco_solo_immagine();">
					</div>
				</form>
				<script>
					function verifica_blocco_solo_immagine(){
						if (document.nuovo_blocco_solo_immagine.immagine.value=="") alert('Immagine obbigatoria');
						else document.nuovo_blocco_solo_immagine.submit();
					}
				</script>
				
				<!-- IMMAGINE/TESTO -->
				<form name="nuovo_blocco_immagine_testo" id="nuovo_blocco_immagine_testo" style="display:none" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="stato" value="nuovo_blocco_inviato">
					<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
					<input type="hidden" name="tipo" value="immagine_testo">
					<input type="hidden" name="ordine" value="<?php echo $ord;?>">
					<?php 				
					$oggetto_admin->campo_ins("Foto<br /><i>(Dim. 1000 pixel)</i>", "immagine" , "4", 'no');
					?>
					<div class="mws-form-row">
						<label class="mws-form-label">Testo (Italiano)*</label>
						<div class="mws-form-item">
							<textarea class="ckeditor" name="testo" id="testo_immagine_testo"></textarea>
						</div>
					</div>
					<div class="mws-form-row">
						<label class="mws-form-label">Testo (Inglese)</label>
						<div class="mws-form-item">
							<textarea class="ckeditor" name="testo_eng"></textarea>
						</div>
					</div>
					
					<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
						<input type="button" value="Aggiungi Blocco" class="btn" id="blocco_<?php echo $x;?>_button" onclick="verifica_blocco_immagine_testo();">
					</div>
					
					<script>
						function verifica_blocco_immagine_testo(){
							var testo = CKEDITOR.instances.testo_immagine_testo.getData();
							if (document.nuovo_blocco_immagine_testo.immagine.value=="") alert('Immagine obbigatoria');
							else if (testo=="") alert('Testo obbigatorio');
							else document.nuovo_blocco_immagine_testo.submit();
						}
					</script>
				</form>
				
				<!-- TESTO/IMMAGINE -->
				<form name="nuovo_blocco_testo_immagine" id="nuovo_blocco_testo_immagine" style="display:none" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="stato" value="nuovo_blocco_inviato">
					<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
					<input type="hidden" name="tipo" value="testo_immagine">
					<input type="hidden" name="ordine" value="<?php echo $ord;?>">
					
					<div class="mws-form-row">
						<label class="mws-form-label">Testo (Italiano)*</label>
						<div class="mws-form-item">
							<textarea class="ckeditor" name="testo" id="testo_testo_immagine"></textarea>
						</div>
					</div>
					<div class="mws-form-row">
						<label class="mws-form-label">Testo (Inglese)</label>
						<div class="mws-form-item">
							<textarea class="ckeditor" name="testo_eng"></textarea>
						</div>
					</div>
					<?php $oggetto_admin->campo_ins("Foto<br /><i>(Dim. 1000 pixel)</i>", "immagine" , "4", 'no');?>
					<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
						<input type="button" value="Aggiungi Blocco" class="btn" id="blocco_<?php echo $x;?>_button" onclick="verifica_blocco_testo_immagine();">
					</div>
					
					<script>
						function verifica_blocco_testo_immagine(){
							var testo = CKEDITOR.instances.testo_testo_immagine.getData();
							if (testo=="") alert('Testo obbigatorio');
							else if (document.nuovo_blocco_testo_immagine.immagine.value=="") alert('Immagine obbigatoria');
							else document.nuovo_blocco_testo_immagine.submit();
						}
					</script>
				</form>
				
				<!-- GALLERY -->
				<form name="nuovo_blocco_gallery" id="nuovo_blocco_gallery" style="display:none" class="mws-form" action="admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="stato" value="nuovo_blocco_gallery_inviato">
					<input type="hidden" name="id_articolo" value="<?php echo $id_rec;?>">
					<input type="hidden" name="tipo" value="gallery">				
					<input type="hidden" name="ordine" value="<?php echo $ord;?>">
					<?php 
					$oggetto_admin->campo_ins("Immagini *<br />" , "immagine" , "42", 'no');
					?>
					<div class="mws-button-row" id="blocco_<?php echo $x;?>_button_box">
						<input type="button" value="Aggiungi Blocco" class="btn" id="blocco_<?php echo $x;?>_button" onclick="verifica_blocco_testo_gallery();">
					</div>
					
					<script>
						function verifica_blocco_testo_gallery(){
							document.nuovo_blocco_gallery.submit();
						}
					</script>
				</form>
			</div>
		</div>
	</div>
<?php }?>
