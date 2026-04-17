<?php 
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['id_cat_ric'])) $id_cat_ric=$_GET['id_cat_ric']; else $id_cat_ric="";
if(isset($_GET['id_sottocat_ric'])) $id_sottocat_ric=$_GET['id_sottocat_ric']; else $id_sottocat_ric="";


$rif="";
$rif.="&pag_att=$pag_att";
if($id_cat_ric!=""){$rif.="&id_cat_ric=$id_cat_ric";}
if($id_sottocat_ric!=""){$rif.="&id_sottocat_ric=$id_sottocat_ric";}
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
</script>
<?php 
if($stato=="inviato"){

	$arr_no['stato']=1;
	//$arr_no['data_mod']=1;
	$arr_no['data_articolo_giorni']=1;
	$arr_no['data_articolo_mesi']=1;
	$arr_no['data_articolo_anni']=1;
	$arr_thumb['immagine']=400; 
	
	$_POST['titolo']=str_replace('"','\"',$_POST['titolo']);
	$_POST['titolo_eng']=str_replace('"','\"',$_POST['titolo_eng']);
	//$_POST['testo']=str_replace('"','\"',$_POST['testo']);
	//$_POST['testo_eng']=str_replace('"','\"',$_POST['testo_eng']);
	
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$codice = '';
	for ($i = 0; $i < 15; $i++) {
		$codice .= $characters[rand(0, strlen($characters))];
	}
	$_POST['codice']=$codice;
	
	//if (isset($_POST['data_mod'])) $data_mod = $oggetto_admin->date_to_data($_POST['data_mod']);
		//else $data_mod = "";
	
	$oggetto_admin->inserisci_campi ("sail_talk_articolo" , $arr_no ,  $arr_thumb, "img_up/sail_talk");
	
	$query_rec = "select id from sail_talk_articolo ORDER BY id DESC LIMIT 0,1";
	$risu_rec    = $open_connection->connection->query($query_rec);
	list($id_ultimo) = $risu_rec->fetch();
	//if ($data_mod!="") $open_connection->connection->query("update sail_talk_articolo set data_news='$data_mod' where id='$id_ultimo'");
?>
	<script language="javascript">
		window.location = "admin.php?cmd=sail_talk_articolo_mod&id_rec=<?php echo $id_ultimo;?><?php echo $rif;?>#blocchi" ;
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Articolo</b></div>
	
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
		<form name="gino" class="mws-form" action="admin.php?cmd=sail_talk_articolo_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine("sail_talk_articolo");
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Argomento</label>
					<div class="mws-form-item">
						<select name="id_cat" class="small" onchange="cambiaCat(this.value)">
							<option value="">Seleziona</option>
							<?php 
							$query_m="SELECT * FROM sail_talk_macrocategorie ORDER BY ordine DESC";
							$resu_m=$open_connection->connection->query($query_m);
							while($risu_m=$resu_m->fetch()){?>
								<option value="<?php echo $risu_m['id'];?>" <?php if($risu_m['id']==$id_cat_ric){?>selected="selected"<?php }?>><?php echo $risu_m['nome'];?></option>
							<?php }?>					
						</select>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Categoria</label>
					<div class="mws-form-item" id="listaCat"></div>					
		
					<script>
						function cambiaCat(argomento, id_sottocat_ric, cmd=""){
							$.ajax({
								url: "ajax/sail_talk_categorie.php", 
								type: "GET",
								data: {argomento : argomento, id_sottocat_ric : id_sottocat_ric, cmd : cmd}, 
								success: function(result){
									$("#listaCat").html(result);
								}
							});
						}
						
						cambiaCat('<?php echo $id_cat_ric;?>','<?php echo $id_sottocat_ric;?>','<?php echo $cmd;?>');
					</script>	
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Anno Regata</label>
					<div class="mws-form-item">
						<select name="anno_regata" class="small" onchange="cambiaAnno(this.value)">
							<option value="">Seleziona</option>
							<?php 
							$query_m="SELECT DISTINCT anno FROM edizioni_regate ORDER BY anno DESC";
							$resu_m=$open_connection->connection->query($query_m);
							while($risu_m=$resu_m->fetch()){?>
								<option value="<?php echo $risu_m['anno'];?>"><?php echo $risu_m['anno'];?></option>
							<?php }?>					
						</select>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Regata</label>
					<div class="mws-form-item" id="listaRegate"></div>					
		
					<script>
						function cambiaAnno(anno){
							$.ajax({
								url: "ajax/sail_talk_regate.php", 
								type: "GET",
								data: {anno : anno}, 
								success: function(result){
									$("#listaRegate").html(result);
								}
							});
						}
						
						//cambiaAnno("<?php echo date('Y');?>");
					</script>	
				</div>
			<?php 
				$oggetto_admin->campo_ins("Titolo (Italiano)*", "titolo" , "1", 'no');	
				$oggetto_admin->campo_ins("Titolo (Inglese)", "titolo_eng" , "1", 'no');	
				$oggetto_admin->campo_ins("Sottotitolo (Italiano)", "sottotitolo" , "1", 'no');	
				$oggetto_admin->campo_ins("Sottotitolo (Inglese)", "sottotitolo_eng" , "1", 'no');	
				$oggetto_admin->campo_ins("Data *", "data_articolo" , "7", 'no');	
				?>
				<?php /*<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Data *</label>
						<div class="mws-form-item">
							<input type="text" name="data_mod" class="mws-datepicker large"  value="<?php echo $n_data;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>*/?>
				<?php 
				$oggetto_admin->campo_ins("Foto", "immagine" , "4", 'no');	
			?>
				<?php /*
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Italiano)*</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo"></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo (Inglese)</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" name="testo_eng"></textarea>
					</div>
				</div>*/?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
			</div>
			
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
