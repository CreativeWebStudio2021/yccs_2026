<?php 
$table = "sail_talk_gallery";
require_once '../config/dbnew.php';
require_once '../config/array.php';		
require_once '../fissi/functions_adm.php';

$oggetto_ajax = new Functions_adm($array_sito);

if(isset($_GET['id_articolo'])) $id_articolo = $_GET['id_articolo']; else $id_articolo = "";
if(isset($_GET['id_blocco'])) $id_blocco = $_GET['id_blocco']; else $id_blocco = "";
if(isset($_GET['id_gallery'])) $id_gallery = $_GET['id_gallery']; else $id_gallery = "";
if(isset($_GET['id_immagine'])) $id_immagine = $_GET['id_immagine']; else $id_immagine = "";
if(isset($_GET['azione'])) $azione = $_GET['azione']; else $azione = "";

if ($id_immagine) {
	if($azione=="sali") $oggetto_ajax->sali("$table", "$id_immagine", "id_gallery", "$id_gallery") ;
	if($azione=="scendi") $oggetto_ajax->scendi("$table", "$id_immagine", "id_gallery", "$id_gallery") ;
	if($azione=="primo") $oggetto_ajax->primo("$table", "$id_immagine", "id_gallery", "$id_gallery");
	if($azione=="ultimo") $oggetto_ajax->ultimo("$table", "$id_immagine", "id_gallery", "$id_gallery");
	if($azione=="cancella"){
		$query_canc_img = "select immagine from $table where id='$id_immagine'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($logo) = $risu_canc_img->fetch();
			if (is_file("img_up/sail_talk/$logo")) @unlink("img_up/sail_talk/$logo");
			if (is_file("img_up/sail_talk/s_$logo")) @unlink("img_up/sail_talk/s_$logo");
		}
		
		$query_canc = "delete from $table where id='$id_immagine'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cancella"){?>
		<script type="text/javascript">
			//window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}
?>

<div style="padding:10px 20px 20px 20px">
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Immagini</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"></th>
					<th style="width:100px">Immagine</th>
					<th style="text-align:left;">Link</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "SELECT * FROM sail_talk_gallery WHERE id_gallery = '$id_gallery' ORDER BY ordine DESC";
				//echo $query_ele;
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{						  
					$rec_pag=100;		
					$pag_att = 1;
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM sail_talk_gallery WHERE id_gallery = '$id_gallery' ORDER BY ordine DESC LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)			
					{						
						$arr_ele = $risu_ele->fetch();
						$immagine = $arr_ele['immagine'];
						$id_campo = $arr_ele['id'];
						
						//$link=$http.'://'.$ind_sito.'/resarea/img_up/sail_talk/'.$immagine;
						$link="/resarea/img_up/sail_talk/'.$immagine";
			?>
				<tr>
					<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
					<td style="position:relative; width:150px">
						<img src="img_up/sail_talk/<?php if(is_file("img_up/sail_talk/s_".$immagine)) echo "s_";?><?php  echo $immagine; ?>" style="width:150px"/>
					</td>
					<td>
						<?php  echo $link; ?>
						<div style="height:5px; overflow:hidden; opacity:0;"><input type="text" value="<?php  echo $link; ?>" id="link_<?php echo $x;?>"></div>
					</td>
					<td style="width:10%">
						<span class="btn-group">
							<a class="btn btn-small" onclick="vediGallery('<?php echo $id_articolo;?>','<?php echo $id_blocco;?>','<?php echo $id_gallery;?>','<?php echo $id_campo;?>','primo')"><i class="icon-arrow-up-2"></i></a>
							<a class="btn btn-small" onclick="vediGallery('<?php echo $id_articolo;?>','<?php echo $id_blocco;?>','<?php echo $id_gallery;?>','<?php echo $id_campo;?>','sali')"><i class="icon-arrow-up"></i></a>
							<a class="btn btn-small" onclick="vediGallery('<?php echo $id_articolo;?>','<?php echo $id_blocco;?>','<?php echo $id_gallery;?>','<?php echo $id_campo;?>','scendi')"><i class="icon-arrow-down"></i></a>
							<a class="btn btn-small" onclick="vediGallery('<?php echo $id_articolo;?>','<?php echo $id_blocco;?>','<?php echo $id_gallery;?>','<?php echo $id_campo;?>','ultimo')"><i class="icon-arrow-down-2"></i></a>
							<a class="btn btn-small" onclick="if(confirm('Eliminare l\'elemento?')){vediGallery('<?php echo $id_articolo;?>','<?php echo $id_blocco;?>','<?php echo $id_gallery;?>','<?php echo $id_campo;?>','cancella')}"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>	
	</div>
</div>