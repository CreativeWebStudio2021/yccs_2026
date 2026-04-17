<?php 
$table="edizioni_regate";

$criterio="1";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") {
	$criterio.=" AND id_regata='$id_rife'";
	$rif.="&id_rife=$id_rife";
}
if(isset($_GET['anno_ric'])) $anno_ric=$_GET['anno_ric']; else $anno_ric='';
if($anno_ric!="") {
	$criterio.=" AND anno='$anno_ric'";
	$rif.="&anno_ric=$anno_ric";
}
if(isset($_GET['luogo_ric'])) $luogo_ric=$_GET['luogo_ric']; else $luogo_ric='';
if($luogo_ric!="") {
	$criterio.=" AND luogo='$luogo_ric'";
	$rif.="&luogo_ric=$luogo_ric";
}
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if($conferma)
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc_img = "select foto from edizioni_foto where id_regata='$id_rife' and id_edizione='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		$num_canc_img = $risu_canc_img->rowCount();
		for ($f=0; $f<$num_canc_img; $f++) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/regate/foto/$img")) @unlink("img_up/regate/foto/$img");
			if (is_file("img_up/regate/foto/s_$img")) @unlink("img_up/regate/foto/s_$img");
			if (is_file("img_up/regate/foto/xs_$img")) @unlink("img_up/regate/foto/xs_$img");
		}
	}
	
	$query_canc_imgp = "select foto1,foto2 from press where id_regata='$id_rife' and id_edizione='$id_canc'";
	$risu_canc_imgp = $open_connection->connection->query($query_canc_imgp);
	if ($risu_canc_imgp) {
		$num_canc_imgp = $risu_canc_imgp->rowCount();
		for ($f=0; $f<$num_canc_imgp; $f++) {
			list($foto1,$foto2) = $risu_canc_imgp->fetch();
			if (is_file("img_up/regate/press/$foto1")) @unlink("img_up/regate/press/$foto1");
			if (is_file("img_up/regate/press/s_$foto1")) @unlink("img_up/regate/press/s_$foto1");
			if (is_file("img_up/regate/press/$foto2")) @unlink("img_up/regate/press/$foto2");
			if (is_file("img_up/regate/press/s_$foto2")) @unlink("img_up/regate/press/s_$foto2");
		}
	}
	
	$query_canc_doc = "select file,file_eng from edizioni_doc where id_regata='$id_rife' and id_edizione='$id_canc'";
	$risu_canc_doc = $open_connection->connection->query($query_canc_doc);
	if ($risu_canc_doc) {
		$num_canc_doc = $risu_canc_doc->rowCount();
		for ($f=0; $f<$num_canc_doc; $f++) {
			list($doc,$doc_eng) = $risu_canc_doc->fetch();
			if (is_file("files/regate/doc/$doc")) @unlink("files/regate/doc/$doc");
			if (is_file("files/regate/doc/$doc_eng")) @unlink("files/regate/doc/$doc_eng");
		}
	}
	
	$query_canc_info = "select file,file_eng from edizioni_info where id_regata='$id_rife' and id_edizione='$id_canc'";
	$risu_canc_info = $open_connection->connection->query($query_canc_info);
	if ($risu_canc_info) {
		$num_canc_info = $risu_canc_info->rowCount();
		for ($f=0; $f<$num_canc_info; $f++) {
			list($info,$info_eng) = $risu_canc_info->fetch();
			if (is_file("files/regate/info/$info")) @unlink("files/regate/info/$info");
			if (is_file("files/regate/info/$info_eng")) @unlink("files/regate/info/$info_eng");
		}
	}
	
	$query_canc_iscr = "select file,file_eng from edizioni_iscritti where id_regata='$id_rife' and id_edizione='$id_canc'";
	$risu_canc_iscr = $open_connection->connection->query($query_canc_iscr);
	if ($risu_canc_iscr) {
		$num_canc_iscr = $risu_canc_iscr->rowCount();
		for ($f=0; $f<$num_canc_iscr; $f++) {
			list($iscr,$iscr_eng) = $risu_canc_iscr->fetch();
			if (is_file("files/regate/iscritti/$iscr")) @unlink("files/regate/iscritti/$iscr");
			if (is_file("files/regate/iscritti/$iscr_eng")) @unlink("files/regate/iscritti/$iscr_eng");
		}
	}
	
	$query_canc_ris = "select file,file_eng from edizioni_risultati where id_regata='$id_rife' and id_edizione='$id_canc'";
	$risu_canc_ris = $open_connection->connection->query($query_canc_ris);
	if ($risu_canc_ris) {
		$num_canc_ris = $risu_canc_ris->rowCount();
		for ($f=0; $f<$num_canc_ris; $f++) {
			list($ris,$ris_eng) = $risu_canc_ris->fetch();
			if (is_file("files/regate/risultati/$ris")) @unlink("files/regate/risultati/$ris");
			if (is_file("files/regate/risultati/$ris_eng")) @unlink("files/regate/risultati/$ris_eng");
		}
	}
	
	$query_canc_doc = "select img from edizioni_loghi where id_regata='$id_rife' and id_edizione='$id_canc'";
	$risu_canc_doc = $open_connection->connection->query($query_canc_doc);
	if ($risu_canc_doc) {
		$num_canc_doc = $risu_canc_doc->rowCount();
		for ($f=0; $f<$num_canc_doc; $f++) {
			list($img) = $risu_canc_doc->fetch();
			if (is_file("files/regate/loghi/$img")) @unlink("files/regate/loghi/$img");
			if (is_file("files/regate/loghi/s_$img")) @unlink("files/regate/loghi/s_$img");
		}
	}
	
	$query_canc_doc = "select img from edizioni_loghi_new where id_regata='$id_rife' and id_edizione='$id_canc'";
	$risu_canc_doc = $open_connection->connection->query($query_canc_doc);
	if ($risu_canc_doc) {
		$num_canc_doc = $risu_canc_doc->rowCount();
		for ($f=0; $f<$num_canc_doc; $f++) {
			list($img) = $risu_canc_doc->fetch();
			if (is_file("files/regate/loghi/$img")) @unlink("files/regate/loghi/$img");
			if (is_file("files/regate/loghi/s_$img")) @unlink("files/regate/loghi/s_$img");
		}
	}
	
	$query_canc_img = "select logo_edizione,img_documenti,img_risultati,img_informazioni,img_informazioni,banner_img,banner_img_eng from edizioni_regate where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	
	list($logo_edizione,$img_documenti,$img_documenti,$img_risultati,$img_informazioni,$banner_img,$banner_img_eng,) = $risu_canc_img->fetch();
	if (is_file("img_up/regate/$logo_edizione")) @unlink("img_up/regate/$img");
	if (is_file("img_up/regate/s_$logo_edizione")) @unlink("img_up/regate/s_$img");
	if (is_file("img_up/regate/xs_$logo_edizione")) @unlink("img_up/regate/xs_$img");
	
	if(isset($img_testata)){
		if (is_file("img_up/regate/$img_testata")) @unlink("img_up/regate/$img_testata");
		if (is_file("img_up/regate/s_$img_testata")) @unlink("img_up/regate/s_$img_testata");
		if (is_file("img_up/regate/1200_$img_testata")) @unlink("img_up/regate/1200_$img_testata");
		if (is_file("img_up/regate/800_$img_testata")) @unlink("img_up/regate/800_$img_testata");
		if (is_file("img_up/regate/400_$img_testata")) @unlink("img_up/regate/400_$img_testata");
	}
	if(isset($img_documenti)){
		if (is_file("img_up/regate/$img_documenti")) @unlink("img_up/regate/$img_documenti");
		if (is_file("img_up/regate/s_$img_documenti")) @unlink("img_up/regate/s_$img_documenti");
		if (is_file("img_up/regate/1200_$img_documenti")) @unlink("img_up/regate/1200_$img_documenti");
		if (is_file("img_up/regate/800_$img_documenti")) @unlink("img_up/regate/800_$img_documenti");
		if (is_file("img_up/regate/400_$img_documenti")) @unlink("img_up/regate/400_$img_documenti");
	}
	if(isset($img_risultati)){
		if (is_file("img_up/regate/$img_risultati")) @unlink("img_up/regate/$img_risultati");
		if (is_file("img_up/regate/s_$img_risultati")) @unlink("img_up/regate/s_$img_risultati");
		if (is_file("img_up/regate/1200_$img_risultati")) @unlink("img_up/regate/1200_$img_risultati");
		if (is_file("img_up/regate/800_$img_risultati")) @unlink("img_up/regate/800_$img_risultati");
		if (is_file("img_up/regate/400_$img_risultati")) @unlink("img_up/regate/400_$img_risultati");
	}
	if(isset($img_informazioni)){
		if (is_file("img_up/regate/$img_informazioni")) @unlink("img_up/regate/$img_informazioni");
		if (is_file("img_up/regate/s_$img_informazioni")) @unlink("img_up/regate/s_$img_informazioni");
		if (is_file("img_up/regate/1200_$img_informazioni")) @unlink("img_up/regate/1200_$img_informazioni");
		if (is_file("img_up/regate/800_$img_informazioni")) @unlink("img_up/regate/800_$img_informazioni");
		if (is_file("img_up/regate/400_$img_informazioni")) @unlink("img_up/regate/400_$img_informazioni");
	}
	if(isset($banner_img)){
		if (is_file("img_up/regate/$banner_img")) @unlink("img_up/regate/$banner_img");
		if (is_file("img_up/regate/s_$banner_img")) @unlink("img_up/regate/s_$banner_img");
		if (is_file("img_up/regate/1200_$banner_img")) @unlink("img_up/regate/1200_$banner_img");
		if (is_file("img_up/regate/800_$banner_img")) @unlink("img_up/regate/800_$banner_img");
		if (is_file("img_up/regate/400_$banner_img")) @unlink("img_up/regate/400_$banner_img");
	}
	if(isset($banner_img_eng)){
		if (is_file("img_up/regate/$banner_img_eng")) @unlink("img_up/regate/$banner_img_eng");
		if (is_file("img_up/regate/s_$banner_img_eng")) @unlink("img_up/regate/s_$banner_img_eng");
		if (is_file("img_up/regate/1200_$banner_img_eng")) @unlink("img_up/regate/1200_$banner_img_eng");
		if (is_file("img_up/regate/800_$banner_img_eng")) @unlink("img_up/regate/800_$banner_img_eng");
		if (is_file("img_up/regate/400_$banner_img_eng")) @unlink("img_up/regate/400_$banner_img_eng");
	}
		
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">				
		window.location="admin.php?cmd=edizioni<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 


if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select foto from edizioni_foto where id_regata='$id_rife' and id_edizione='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			$num_canc_img = $risu_canc_img->rowCount();
			for ($f=0; $f<$num_canc_img; $f++) {
				list($img) = $risu_canc_img->fetch();
				if (is_file("img_up/regate/foto/$img")) @unlink("img_up/regate/foto/$img");
				if (is_file("img_up/regate/foto/s_$img")) @unlink("img_up/regate/foto/s_$img");
			}
		}
		
		$query_canc_imgp = "select foto1,foto2 from press where id_regata='$id_rife' and id_edizione='".$temp[$z]."'";
		$risu_canc_imgp = $open_connection->connection->query($query_canc_imgp);
		if ($risu_canc_imgp) {
			$num_canc_imgp = $risu_canc_imgp->rowCount();
			for ($f=0; $f<$num_canc_imgp; $f++) {
				list($foto1,$foto2) = $risu_canc_imgp->fetch();
				if (is_file("img_up/regate/press/$foto1")) @unlink("img_up/regate/press/$foto1");
				if (is_file("img_up/regate/press/s_$foto1")) @unlink("img_up/regate/press/s_$foto1");
				if (is_file("img_up/regate/press/$foto2")) @unlink("img_up/regate/press/$foto2");
				if (is_file("img_up/regate/press/s_$foto2")) @unlink("img_up/regate/press/s_$foto2");
			}
		}
		
		$query_canc_doc = "select file,file_eng from edizioni_doc where id_regata='$id_rife' and id_edizione='".$temp[$z]."'";
		$risu_canc_doc = $open_connection->connection->query($query_canc_doc);
		if ($risu_canc_doc) {
			$num_canc_doc = $risu_canc_doc->rowCount();
			for ($f=0; $f<$num_canc_doc; $f++) {
				list($doc,$doc_eng) = $risu_canc_doc->fetch();
				if (is_file("files/regate/doc/$doc")) @unlink("files/regate/doc/$doc");
				if (is_file("files/regate/doc/$doc_eng")) @unlink("files/regate/doc/$doc_eng");
			}
		}
		
		$query_canc_info = "select file,file_eng from edizioni_info where id_regata='$id_rife' and id_edizione='".$temp[$z]."'";
		$risu_canc_info = $open_connection->connection->query($query_canc_info);
		if ($risu_canc_info) {
			$num_canc_info = $risu_canc_info->rowCount();
			for ($f=0; $f<$num_canc_info; $f++) {
				list($info,$info_eng) = $risu_canc_info->fetch();
				if (is_file("files/regate/info/$info")) @unlink("files/regate/info/$info");
				if (is_file("files/regate/info/$info_eng")) @unlink("files/regate/info/$info_eng");
			}
		}
		
		$query_canc_iscr = "select file,file_eng from edizioni_iscritti where id_regata='$id_rife' and id_edizione='".$temp[$z]."'";
		$risu_canc_iscr = $open_connection->connection->query($query_canc_iscr);
		if ($risu_canc_iscr) {
			$num_canc_iscr = $risu_canc_iscr->rowCount();
			for ($f=0; $f<$num_canc_iscr; $f++) {
				list($iscr,$iscr_eng) = $risu_canc_iscr->fetch();
				if (is_file("files/regate/iscritti/$iscr")) @unlink("files/regate/iscritti/$iscr");
				if (is_file("files/regate/iscritti/$iscr_eng")) @unlink("files/regate/iscritti/$iscr_eng");
			}
		}
		
		$query_canc_ris = "select file,file_eng from edizioni_risultati where id_regata='$id_rife' and id_edizione='".$temp[$z]."'";
		$risu_canc_ris = $open_connection->connection->query($query_canc_ris);
		if ($risu_canc_ris) {
			$num_canc_ris = $risu_canc_ris->rowCount();
			for ($f=0; $f<$num_canc_ris; $f++) {
				list($ris,$ris_eng) = $risu_canc_ris->fetch();
				if (is_file("files/regate/risultati/$ris")) @unlink("files/regate/risultati/$ris");
				if (is_file("files/regate/risultati/$ris_eng")) @unlink("files/regate/risultati/$ris_eng");
			}
		}
						
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=edizioni<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 	
}

if($azione=="visibile") {
	$query_up="UPDATE $table SET visibile='1' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script type="text/javascript">
		window.location='admin.php?cmd=edizioni<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
	</script>
	<?php 
}
if($azione=="non_visibile") {
	$query_up="UPDATE $table SET visibile='0' WHERE id='$id_canc'";
	$risu_up=$open_connection->connection->query($query_up);
	?>
	<script type="text/javascript">
		window.location='admin.php?cmd=edizioni<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
	</script>
	<?php 
}

$query_reg = "select nome from regate where id='$id_rife'";
$risu_reg = $open_connection->connection->query($query_reg);
list($nome_reg) = $risu_reg->fetch();

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
			document.getElementById('cancella_sel').href='admin.php?cmd=edizioni<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=edizioni<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Edizioni</b><?php  if ($id_rife!="") echo " della regata <b>".ucfirst($nome_reg)."</b>"; ?></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
		
	<!--<script type="text/javascript">
		var open=0;
		function apri_ricerca(){
			if(open==0){
				open=1;
				$("#searchPanel").animate({height:"320px"});
				document.getElementById('searchHeader').innerHTML='<span><i class="fa fa-search-minus" style="color:#fff"></i> Ricerca</span>';
			} else {
				open=0;
				$("#searchPanel").animate({height:"0px"});
				document.getElementById('searchHeader').innerHTML='<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca</span>';
			}
		}
	</script>-->
	
	<div class="mws-panel-header" style="cursor:pointer;" onclick="apri_ricerca();" id="searchHeader">
		<span><i class="fa fa-search-plus" style="color:#fff"></i> Ricerca edizioni</span>
	</div>
	<div class="mws-panel-body no-padding" id="searchPanel">
		<form name="ricerca" class="mws-form" action="admin.php" method="GET" enctype="multipart/form-data">
			<input type="hidden" name="cmd" value="<?php echo $table;?>">
			<input type="hidden" name="id_rife" value="<?php echo $id_rife;?>">
			<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>">
			
			<div class="mws-form-inline">					
				<div class="mws-form-row">					
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Anno</label>
					</div>
					<div style="float:left; width:35%;">
						<select name="anno_ric" style="width:95%">
							<option value="">Seleziona</option>
							<?php 
							$oggi = date('Y');
							for($a=2008; $a<=($oggi+1);$a++){
							?>
								<option value="<?php echo $a;?>"><?php echo $a;?></option>
							<?php }?>					
						</select>
					</div>
					<div style="float:left; width:15%;">
						<label class="mws-form-label">Luogo</label>
					</div>
					<div style="float:left; width:35%;">
						<input type="text" name="luogo_ric" value="<?php echo $luogo_ric;?>" style="width:95%"/>
					</div>
					<div style="clear:both;"></div>
				</div>	
			</div>
			<div class="mws-button-row">
				<input type="submit" value="Cerca" class="btn btn-danger">
				<input type="button" value="Annulla" class="btn" onclick="window.location='admin.php?cmd=edizioni&id_rife=<?php echo $id_rife;?>&pag_att=<?php echo $pag_att;?>'">
			</div>
		</form>
	</div>
	
	<div style="clear:both;height:30px">&nbsp;</div>
	
	
	<div style="display:flex; justify-content:space-between;">
		<a href="admin.php?cmd=regate<?php echo $rif;?>" style="color:#7a7a7a">
			<div class="newAdminBott2">
				<i class="fa fa-caret-left" aria-hidden="true"></i>
				&nbsp;
				<b>Torna all'elenco delle regate</b>
			</div>
		</a>
		<a href="admin.php?cmd=edizioni_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi edizione</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header" style="position:relative;">
		<span><i class="icon-table"></i> Elenco edizioni</span>
		<div style="position:absolute; top:13px; right:20px; z-index:11">
			<?php 
			$query_ele = "select * from edizioni_regate where $criterio order by anno desc";
			/*echo $query_ele;*/
			$risu_ele = $open_connection->connection->query($query_ele);
				
			$num_ele = 0;
			if($risu_ele)
				$num_ele = $risu_ele->rowCount();	
			
			if($num_ele>0)
			{	
				$rec_pag=20;					
				$pag_tot=ceil($num_ele/$rec_pag);					
				$start=($pag_att-1)*$rec_pag;
				$query_ele = "select * from edizioni_regate where $criterio order by anno desc LIMIT $start,$rec_pag";
				$risu_ele = $open_connection->connection->query($query_ele);
				$num_item=$risu_ele->rowCount();
			}
			?>
		</div>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:100px">Anno</th>
					<th style="text-align:left;">Regata</th>
					<th style="text-align:left">Sezioni</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 			
				if($num_ele>0)
				{		
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$luogo = ucfirst($arr_ele['luogo']);
						$id_campo = $arr_ele['id'];
						$anno = $arr_ele['anno'];
						$old = $arr_ele['old'];
						$new = $arr_ele['new'];
						$new2 = $arr_ele['new2'];
						if($old==1) $versione=1;
						if($new==1) $versione=2;
						if($new2==1) $versione=3;
						$nome_regata = $arr_ele['nome_regata'];
						$dal = substr($oggetto_admin->date_to_data($arr_ele['data_dal']),0,-5);
						$al = substr($oggetto_admin->date_to_data($arr_ele['data_al']),0,-5);
						$periodo = "Dal $dal al $al";
						
						$num_foto = 0;
						$query_foto = "select id from edizioni_foto where id_regata='$id_rife' and id_edizione='$id_campo'";
						$risu_foto = $open_connection->connection->query($query_foto);
						if ($risu_foto) $num_foto = $risu_foto->rowCount();
						
						$num_video = 0;
						$query_video = "select id from edizioni_video where id_regata='$id_rife' and id_edizione='$id_campo'";
						$risu_video = $open_connection->connection->query($query_video);
						if ($risu_video) $num_video = $risu_video->rowCount();
						
						$num_info = 0;
						$query_info = "select id from edizioni_info where id_regata='$id_rife' and id_edizione='$id_campo'";
						$risu_info = $open_connection->connection->query($query_info);
						if ($risu_info) $num_info = $risu_info->rowCount();
						
						$num_doc = 0;
						$query_doc = "select id from edizioni_doc where id_regata='$id_rife' and id_edizione='$id_campo'";
						$risu_doc = $open_connection->connection->query($query_doc);
						if ($risu_doc) $num_doc = $risu_doc->rowCount();
						
						$num_iscr = 0;
						$query_iscr = "select id from edizioni_iscritti where id_regata='$id_rife' and id_edizione='$id_campo'";
						$risu_iscr = $open_connection->connection->query($query_iscr);
						if ($risu_iscr) $num_iscr = $risu_iscr->rowCount();
						
						$num_ris = 0;
						$query_ris = "select id from edizioni_risultati where id_regata='$id_rife' and id_edizione='$id_campo'";
						$risu_ris = $open_connection->connection->query($query_ris);
						if ($risu_ris) $num_ris = $risu_ris->rowCount();
						
						$num_press = 0;
						$query_press = "select id from press where id_regata='$id_rife' and id_edizione='$id_campo'";
						$risu_press = $open_connection->connection->query($query_press);
						if ($risu_press) $num_press = $risu_press->rowCount();
			?>
						<script type="text/javascript">
							lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
						</script>
			<?php 
						if ($id_campo==$id_rec) echo "<tr style=\"background:#7e9edb\">";
							else echo "<tr>";
			?>
							<td align="center" valign="center" style="text-align:center;">
								<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
							</td>
							<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
							<td style="text-align:center;">
								<span style="font-weight:600; font-size:1.2em"><?php  echo $anno; ?></span>
								<div style="width:50px; margin:0 auto; margin-top:5px;display:flex; gap:8px; align-items:center;">
									<div style="display:flex; flex-direction:column">
										<i class="fa fa-certificate" style="<?php if($old=='1'){?>color:#fbc444<?php }?>; font-size:1.2em" aria-hidden="true" ></i> 
										<span style="font-size:1em;">v1</span>
									</div>
									<div style="display:flex; flex-direction:column">
										<i class="fa fa-certificate" style="<?php if($new=='1'){?>color:#fbc444<?php }?>; font-size:1.2em" aria-hidden="true" ></i> 
										<span style="font-size:1em;">v2</span>
									</div>
									<div style="display:flex; flex-direction:column">
										<i class="fa fa-certificate" style="<?php if($new2=='1'){?>color:#fbc444<?php }?>; font-size:1.2em" aria-hidden="true"></i> 
										<span style="font-size:1em;">v3</span>
									</div>
								</div>
							</td>
							
							<td>
								<b style="font-size:1.2em"><?php  echo $nome_regata ?></b><br/>
								<span style="font-size:0.9em"><?php  echo $luogo ?><br/><i><?php echo $periodo;?></i></span>
							</td>
							
							<td>
								<div style="display:flex; gap:80px;">
									<div style="display:flex; flex-direction:column; gap:10px;">
										<div style="display:flex; align-items:center;">
											<span style="width:50px; text-align:50px; margin-right:10px;"><b>Generale</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=edizioni_mod<?php echo $rif;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
										</div>
										<div style="display:flex; align-items:center;">
											<span style="width:50px; text-align:50px; margin-right:10px;"><b>Foto</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=foto<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=foto_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
										<div style="display:flex; align-items:center;">
											<span style="width:50px; text-align:50px; margin-right:10px;"><b>Video</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=video<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=video_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
										
									</div>
									<div style="display:flex; flex-direction:column; gap:10px;">
										<div style="display:flex; align-items:center;">
											<span style="width:112px; margin-right:10px; text-align:right"><b>Info</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=info<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=info_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
										<div style="display:flex; align-items:center;">
											<span style="width:112px; margin-right:10px; text-align:right"><b>Albo dei Comunicati</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=noticeboard<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=noticeboard_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
										<div style="display:flex; align-items:center;">
											<span style="width:112px; margin-right:10px; text-align:right"><b>Documenti</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=documenti<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=documenti_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
									</div>
									
									<div style="display:flex; flex-direction:column; gap:10px;">
										<div style="display:flex; align-items:center;">
											<span style="width:50px; text-align:right; margin-right:10px;"><b>Iscritti</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=iscritti<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=iscritti_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
										<div style="display:flex; align-items:center;">
											<span style="width:50px; text-align:right; margin-right:10px;"><b>Risultati</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=risultati<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=risultati_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
										<div style="display:flex; align-items:center;">
											<span style="width:50px; text-align:right; margin-right:10px;"><b>Stampa</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=press<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=press_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
									</div>
									
									<div style="display:flex; flex-direction:column; gap:10px;">
										<div style="display:flex; align-items:center;">
											<span style="width:85px; text-align:right; margin-right:10px;"><b>Crew Board</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=crew_board<?php echo $rif;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
										</div>
										<div style="display:flex; align-items:center;">
											<span style="width:85px; text-align:right; margin-right:10px;"><b>Title Sponsor</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=loghi_new<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=loghi_new_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
										<div style="display:flex; align-items:center;">
											<span style="width:85px; text-align:right; margin-right:10px;"><b>Loghi Partners</b></span>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=loghi_partners<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<a class="btn" style="color:#000; font-size:1.5em;" href="admin.php?cmd=loghi_partners_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_riferimento=<?php echo $id_campo;?>">
												<i class="fa fa-plus-square-o" aria-hidden="true"></i>
											</a>
										</div>
									</div>
								
								</div>
							</td>
							
							<td style="width:10%" valign="center">
								<span class="btn-group">
									<!--<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
									<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
									<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
									<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
									<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
										<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
										<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
											<form action="admin.php" method="GET">
												<input type="hidden" name="cmd" value="<?php echo $table;?>"/>
												<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
												<input type="hidden" name="azione" value="cambia"/>
												<input type="hidden" name="id_rife" value="<?php echo $id_rife;?>"/>
												<input type="hidden" name="id_riferimento" value="<?php echo $id_riferimento;?>"/>
												<input type="hidden" name="id_gruppo" value="<?php echo $id_gruppo;?>"/>
												<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
												<input type="text" name="new_pos" value="<?php echo $x+1;?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
											</form>
										</div>
									</div>-->
									<a href="admin.php?cmd=edizioni&id_canc=<?php  echo $id_campo; ?>&azione=<?php if($arr_ele['visibile']==1){?>non_<?php }?>visibile<?php echo $rif;?>" class="btn btn-small"><?php if($arr_ele['visibile']==1){?><i style="color:green" class="fa fa-circle"></i><?php }else{?><i style="color:red" class="fa fa-circle-o"></i><?php }?></a>
									<a href="admin.php?cmd=edizioni_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
									<a href="admin.php?cmd=edizioni&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
								</span>
							</td>
						</tr>
					<?php }
				}?>
			</tbody>
		</table>		
		<?php include("fissi/multipagina.inc.php");?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>	
</div>
