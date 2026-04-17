<?php 
$table="stampa";
$rif="";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if($conferma)
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc_img = "select img from stampa where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		$num_canc_img = $risu_canc_img->rowCount();
		for ($f=0; $f<$num_canc_img; $f++) {
			list($foto1) = $risu_canc_img->fetch();
			if (is_file("img_up/stampa/$foto1")) @unlink("img_up/stampa/$foto1");
			if (is_file("img_up/stampa/s_$foto1")) @unlink("img_up/stampa/s_$foto1");
		}
	}
	
	$query_canc_imgp = "select img from gallery_stampa where id_rife='$id_canc'";
	$risu_canc_imgp = $open_connection->connection->query($query_canc_imgp);
	if ($risu_canc_imgp) {
		$num_canc_imgp = $risu_canc_imgp->rowCount();
		for ($f=0; $f<$num_canc_imgp; $f++) {
			list($foto2) = $risu_canc_imgp->fetch();
			if (is_file("img_up/stampa/gallery/$foto2")) @unlink("img_up/stampa/gallery/$foto2");
			if (is_file("img_up/stampa/gallery/s_$foto2")) @unlink("img_up/stampa/gallery/s_$foto2");
		}
	}
	
	$query_canc_file = "select pdf,pdf_eng from documenti_stampa where id_rife='$id_canc'";
	$risu_canc_file = $open_connection->connection->query($query_canc_file);
	if ($risu_canc_file) {
		$num_canc_file = $risu_canc_file->rowCount();
		for ($f=0; $f<$num_canc_file; $f++) {
			list($file1,$file2) = $risu_canc_file->fetch();
			if (is_file("files/stampa/$file1")) @unlink("files/stampa/$file1");
			if (is_file("files/stampa/$file2")) @unlink("files/stampa/$file2");
		}
	}
				
	$query_canc = "delete from stampa where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);		
?>
	<script language="javascript">		
		window.location="admin.php?cmd=stampa<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("stampa", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("stampa", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("stampa", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("stampa", "$id_canc");	
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("stampa", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=stampa<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){				
		$query_canc_img = "select img from stampa where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			$num_canc_img = $risu_canc_img->rowCount();
			for ($f=0; $f<$num_canc_img; $f++) {
				list($foto1) = $risu_canc_img->fetch();
				if (is_file("img_up/stampa/$foto1")) @unlink("img_up/stampa/$foto1");
				if (is_file("img_up/stampa/s_$foto1")) @unlink("img_up/stampa/s_$foto1");
			}
		}
		
		$query_canc_imgp = "select img from gallery_stampa where id_rife='".$temp[$z]."'";
		$risu_canc_imgp = $open_connection->connection->query($query_canc_imgp);
		if ($risu_canc_imgp) {
			$num_canc_imgp = $risu_canc_imgp->rowCount();
			for ($f=0; $f<$num_canc_imgp; $f++) {
				list($foto2) = $risu_canc_imgp->fetch();
				if (is_file("img_up/stampa/gallery/$foto2")) @unlink("img_up/stampa/gallery/$foto2");
				if (is_file("img_up/stampa/gallery/s_$foto2")) @unlink("img_up/stampa/gallery/s_$foto2");
			}
		}
		
		$query_canc_file = "select pdf,pdf_eng from documenti_stampa where id_rife='".$temp[$z]."'";
		$risu_canc_file = $open_connection->connection->query($query_canc_file);
		if ($risu_canc_file) {
			$num_canc_file = $risu_canc_file->rowCount();
			for ($f=0; $f<$num_canc_file; $f++) {
				list($file1,$file2) = $risu_canc_file->fetch();
				if (is_file("files/stampa/$file1")) @unlink("files/stampa/$file1");
				if (is_file("files/stampa/$file2")) @unlink("files/stampa/$file2");
			}
		}
				
		$query_canc = "delete from stampa where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=stampa<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=stampa<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=stampa<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Ufficio Stampa</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=stampa_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi articolo</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header" style="clear:both">
		<span><i class="icon-table"></i> Elenco articoli</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th>Data</th>
					<th>Anteprima</th>
					<th style="text-align:left;">Titolo</th>
					<th>Foto</th>
					<th>Documenti</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from stampa order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "select * from stampa order by ordine desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$tit = ucfirst($arr_ele['titolo']);
						$visibile = $arr_ele['visibile'];
						$data = "";
						if ($arr_ele['data_stampa']!="") $data = $oggetto_admin->date_to_data($arr_ele['data_stampa']);
						$foto = "s_".$arr_ele['img'];
						
						if(file_exists("img_up/stampa/s_$foto")) $ante = "img_up/stampa/s_$foto";
						elseif(file_exists("img_up/stampa/$foto")) $ante = "img_up/stampa/$foto";
						else $ante = "https://www.yccs.it/resarea/img_up/stampa/$foto";
						
						$num_foto = 0;
						$query_foto = "select id from gallery_stampa where id_rife='$id_campo'";
						$risu_foto = $open_connection->connection->query($query_foto);
						if ($risu_foto) $num_foto = $risu_foto->rowCount();
						
						$num_doc = 0;
						$query_doc = "select id from documenti_stampa where id_rife='$id_campo'";
						$risu_doc = $open_connection->connection->query($query_doc);
						if ($risu_doc) $num_doc = $risu_doc->rowCount();
						
						$query_f="SELECT id FROM gallery_stampa WHERE id_rife='$id_campo'";
						$resu_f = $open_connection->connection->query($query_f);
						$num_f = $resu_f->rowCount();
						
						$query_d="SELECT id FROM documenti_stampa WHERE id_rife='$id_campo'";
						$resu_d = $open_connection->connection->query($query_d);
						$num_d = $resu_d->rowCount();
						?>
							<script type="text/javascript">
								lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
							</script>
							<tr>
								<td align="center" valign="center">
									<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
								</td>
								<td align="center" valign="center">
									<?php  echo $start+$x+1; ?>
								</td>
								<td style="text-align:center"><?php  echo $data; ?></td>
								<td align="center" valign="center">
									<img src="<?php  echo $ante; ?>" alt="" style="width:150px"/>
								</td>
								<td><?php  echo $tit; ?></td>
								
								<td  align="center" valign="center">
									<div style="display:flex; gap:10px; align-item:center; justify-content:center;">
										<a style="width:20px;"class="btn btn-small" href="admin.php?cmd=fotos<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_rife=<?php echo $id_campo;?>" title="Visualizza foto (<?php  echo $num_foto; ?>)"><?php echo $num_f;?></a>
										<a style="color:#111; font-size:1.5em; margin-top:3px;" href="admin.php?cmd=fotos_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_rife=<?php echo $id_campo;?>" title="Aggiungi foto"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
									</div>
								</td>	
								
								<td align="center" valign="center">
									<div style="display:flex; gap:10px; align-item:center; justify-content:center;">
										<a style="width:20px;" class="btn btn-small" href="admin.php?cmd=documentis<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_rife=<?php echo $id_campo;?>" title="Visualizza documenti (<?php  echo $num_doc; ?>)"><?php echo $num_d;?></a>
										<a style="color:#111; font-size:1.5em;  margin-top:3px;" href="admin.php?cmd=documentis_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&id_rife=<?php echo $id_campo;?>" title="Aggiungi documenti"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
									</div>
								</td>
								<td style="width:10%" align="center" valign="center">
									<span class="btn-group">
										<a class="btn btn-small" id="visibile_<?php echo $id_campo;?>" style="cursor:pointer; color:<?php if($visibile=='0'){?>red<?php }else{?>green<?php }?>" onclick="visibile('<?php echo $id_campo;?>')"><i class="fa fa-eye" aria-hidden="true"></i></a>
										<a href="admin.php?cmd=stampa&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
										<a href="admin.php?cmd=stampa&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
										<a href="admin.php?cmd=stampa&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
										<a href="admin.php?cmd=stampa&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
										<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
											<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
											<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
												<form action="admin.php" method="GET">
													<input type="hidden" name="cmd" value="stampa"/>
													<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
													<input type="hidden" name="azione" value="cambia"/>
													<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
													<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
												</form>
											</div>
										</div>
										<a href="admin.php?cmd=stampa_mod&id_rec=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
										<a href="admin.php?cmd=stampa&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
									</span>
								</td>
							</tr>
						<?php 
					}
				}
			?>
			</tbody>
		</table>
		<?php  include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
<iframe id="hiddenFrame" src="" style="display:none"></iframe>
<script>

  function visibile(id){
    if(document.getElementById('visibile_'+id).style.color=="red"){
      document.getElementById('visibile_'+id).style.color="green";  
    }else{
      document.getElementById('visibile_'+id).style.color="red";   
    }
    document.getElementById('hiddenFrame').src="frame/stampa_cambiaVisibilita.php?id_articolo="+id;
  }
</script>