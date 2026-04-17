<?php 
$table="ya_gallery_cat";

$criterio="1";
$rif="";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
//$rif.="&pag_att=$pag_att";

if($azione=="cancella" && $id_canc!="")
{
	$query_canc_img = "select img from $table where id='".$id_canc."'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/ya_gallery_foto/$img")) @unlink("img_up/ya_gallery_foto/$img");
		if (is_file("img_up/ya_gallery_foto/250_$img")) @unlink("img_up/ya_gallery_foto/250_$img");
		if (is_file("img_up/ya_gallery_foto/360_$img")) @unlink("img_up/ya_gallery_foto/360_$img");
		if (is_file("img_up/ya_gallery_foto/450_$img")) @unlink("img_up/ya_gallery_foto/450_$img");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);

?>
	<script language="javascript">		
		window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {	
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos") ;	
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
	
	/*if ($azione=="attiva") $query_agg = $open_connection->connection->query("update $table set visibile='1' where id='$id_canc'");
	if ($azione=="disattiva") $query_agg = $open_connection->connection->query("update $table set visibile='0' where id='$id_canc'");*/
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/ya_gallery_foto/$img")) @unlink("img_up/ya_gallery_foto/$img");
			if (is_file("img_up/ya_gallery_foto/250_$img")) @unlink("img_up/ya_gallery_foto/250_$img");
			if (is_file("img_up/ya_gallery_foto/360_$img")) @unlink("img_up/ya_gallery_foto/360_$img");
			if (is_file("img_up/ya_gallery_foto/450_$img")) @unlink("img_up/ya_gallery_foto/450_$img");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<div style="height:30px;font-size:1.2em;padding-top:10px"><b>Categorie Photogallery</b></div>
	</p>
		
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
			
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi Categoria</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Categorie</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:200px">Immagine</th>
					<th align="left">Nome</th>
					<th style="width:80px">Photogallery</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "SELECT * FROM $table WHERE $criterio ORDER BY ordine DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();		
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE $criterio ORDER BY ordine DESC LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();	
					
					$cont=1;
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$nome = ucfirst($arr_ele['nome']);
						$img = ucfirst($arr_ele['img']);
						$id_campo = $arr_ele['id'];
						/*$vis = $arr_ele['visibile'];*/
						
						$query_p = "SELECT * FROM ya_gallery WHERE id_rife='$id_campo'";
						$risu_p = $open_connection->connection->query($query_p);
						$num_p=$risu_p->rowCount();
								
						$ante = "";
						if(file_exists("img_up/ya_gallery_foto/s_$img")) $ante = "img_up/ya_gallery_foto/s_$img";
						elseif(file_exists("img_up/ya_gallery_foto/$img")) $ante = "img_up/ya_gallery_foto/$img";
						//else $ante = "img_up/ya_gallery_foto/$img";
						?>
						<script type="text/javascript">
							lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";               
						</script>
						<tr <?php if($cont==2){?>style="background:#ddd"<?php }?>>
							<td align="center" valign="center">
								<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
							<td>
								 <?php if(!empty($img)){?>
									<img src="<?php echo $ante;?>" style="width:200px"/></td>
								 <?php }?>
							</td>
							<td><?php echo $nome; ?></td>
							<td align="center">
								<a href="admin.php?cmd=ya_gallery&ric_cat=<?php echo $id_campo;?>" class="btn btn-small"><?php echo $num_p;?></a>					
							</td>
							<td style="width:10%">
								<span class="btn-group">
									<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
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
												<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
												<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
											</form>
										</div>
									</div>
									<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
									<?php  if ($num_p==0) { ?>
										<a OnClick="return confirm('Sei sicuro di voler cancellare questo elemento?');" href="admin.php?cmd=<?php echo $table;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
									<?php  }else{ ?>
										<a OnClick="return confirm('Prima di rimuovere la categoria cancellare o riassegnare tutte le photogallery');" disabled="disabled" class="btn btn-small"><i class="icon-trash"></i></a>
									<?php }?>
								</span>
							</td>
						</tr>
					<?php $cont++; if($cont==3) $cont=1;
					}
				}
			?>
			</tbody>
		</table>	
		<?php  include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
