<?php 
$table="ya_video";
$rif="";

if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";

if($azione=="cancella" && $id_canc!="")
{	
				
	$query_canc = "delete from ya_video where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.location="admin.php?cmd=ya_video<?php echo $rif;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("ya_video", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("ya_video", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("ya_video", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("ya_video", "$id_canc");	
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("ya_video", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=ya_video<?php echo $rif;?>';
		</script>
	<?php }
}

if($azione=="cambia_stato") {
	$query_stato="SELECT videogallery FROM ya_elements WHERE id='1'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	
	if($stato=="1") $new_stato="0";
	else $new_stato="1";
	
	$query_up="UPDATE ya_elements SET videogallery='$new_stato' WHERE id='1'";
	echo $query_up;
	$risu_up=$open_connection->connection->query($query_up);
	
	?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){		
		$query_canc = "delete from ya_video where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=ya_video<?php echo $rif;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=ya_video<?php echo $rif;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=ya_video<?php echo $rif;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<?php 
	$query_stato="SELECT videogallery FROM ya_elements WHERE id='1'";
	$resu_stato=$open_connection->connection->query($query_stato);
	list($stato)=$resu_stato->fetch();
	?>

	<div style="width:100%; height:40px; margin-bottom:5px;">
		<div style="float:right; ">
			<a href="admin.php?cmd=<?php echo $table;?>&azione=cambia_stato<?php echo $rif;?>">
				<?php if($stato=="1"){?>
					<div class="btn" style="background:red; color:#fff">Nascondi</div>
				<?php }else{?>
					<div class="btn" style="background:green; color:#fff">Attiva</div>
				<?php }?>
			</a>
		</div>
		<div style="float:right; margin-top:5px; margin-right:10px;">
			<?php if($stato=="1"){?><span style="color:green"><b>VIDEO GALLERY VISIBILE</b></span><?php }else{?><span style="color:red"><b>VIDEO GALLERY NON VISIBILE</b></span><?php }?>
		</div>
	</div>
	
	<div style="height:50px;font-size:1.2em;padding-top:10px">Video Young Azzurra</div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
			
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=ya_video_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi video</b>
			</div>
		</a>
	</div>

	<div class="mws-panel-header" style="clear:both">
		<span><i class="icon-table"></i> Elenco video</span>
	</div>
	<div class="mws-panel-body no-padding">
		<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:220px;">Anteprima</th>
					<th>Titolo</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from ya_video order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "select * from ya_video order by ordine desc LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$arr_link = explode("?v=",$arr_ele['video']);
						if (isset($arr_link[1]) && $arr_link[1]!="") $video = substr($arr_link[1],0,11);
							else $video = $arr_ele['video'];
						$tit = ucfirst($arr_ele['titolo']);
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
					<td align="center" valign="center">
						<?php  if ($arr_ele['video']!="") { ?>
							<img src="http://i4.ytimg.com/vi/<?php  echo $video; ?>/default.jpg" style="width:220px;" border="0" alt="Anteprima" />						
						<?php } elseif ($arr_ele['video_fb']!="") {?>
							<div style="position:relative; width:220px;">
								<div style="position:absolute; width:100%; height:100%;"></div>
								<div class="fb-video" data-href="https://www.facebook.com/facebook/videos/<?php echo $arr_ele['video_fb'];?>/"  data-show-text="false" style="width:100%;">
													
								</div>
							</div>
						<?php }?>
					</td>
					<td><?php  echo $tit; ?></td>
					<td style="width:10%" align="center" valign="center">
						<span class="btn-group">
							<a href="admin.php?cmd=ya_video&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php  echo $rif; ?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=ya_video&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php  echo $rif; ?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=ya_video&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php  echo $rif; ?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=ya_video&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php  echo $rif; ?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
								<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
								<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="ya_video"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
									</form>
								</div>
							</div>
							<a href="admin.php?cmd=ya_video_mod&id_rec=<?php  echo $id_campo; ?><?php  echo $rif; ?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onclick="return confirm('Si conferma la cancellazione dell\'elemento?')" href="admin.php?cmd=ya_video&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php  echo $rif; ?>" class="btn btn-small"><i class="icon-trash"></i></a>
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
