<?php 
$table="news_private";

include("robots_generator.php");

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";

if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";

if($azione=="cancella" && $id_canc!="")
{	
	
	$query_canc_img = "select img from news_private where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/$img")) @unlink("img_up/$img");
		if (is_file("img_up/s_$img")) @unlink("img_up/s_$img");
		if (is_file("img_up/m_$img")) @unlink("img_up/m_$img");
		if (is_file("img_up/l_$img")) @unlink("img_up/l_$img");
		if (is_file("img_up/xl_$img")) @unlink("img_up/xl_$img");
		if (is_file("img_up/xxl_$img")) @unlink("img_up/xxl_$img");
	}
	
	$query_canc = "delete from news_private where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=news_private<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("news_private", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("news_private", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("news_private", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("news_private", "$id_canc");
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("news_private", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=news_private<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from news_private where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($logo) = $risu_canc_img->fetch();
			if (is_file("img_up/$logo")) @unlink("img_up/$logo");
			if (is_file("img_up/s_$logo")) @unlink("img_up/s_$logo");
			if (is_file("img_up/xs_$logo")) @unlink("img_up/xs_$logo");
		}
		
		$query_canc = "delete from news_private where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=news_private<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>News Private</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=news_private_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi articolo</b>
			</div>
		</a>
	</div>

	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco News</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th>Data</th>
					<th style="width:150px">Foto</th>
					<th>Titolo</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from news_private order by ordine desc";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{		
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM news_private ORDER BY ordine DESC LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					$pag=1;
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$foto = $arr_ele['img'];
						$tit = $oggetto_admin->puntini(ucfirst($arr_ele['titolo']));
						$tit_eng = $oggetto_admin->puntini(ucfirst($arr_ele['titolo_eng']));
						$data = $oggetto_admin->date_to_data($arr_ele['data_news']);
						$id_campo = $arr_ele['id'];
						$link=$http."://".$ind_sito."/news_private-pag".$pag."/".to_htaccess_url($arr_ele['titolo'],"")."-".$arr_ele['id'].".html";
						$link_eng=$http."://".$ind_sito."/en/news_private-pag".$pag."/".to_htaccess_url($arr_ele['titolo_eng'],"")."-".$arr_ele['id'].".html";
						if($x%12==0) $pag++;
						
						
						
						if(file_exists("img_up/news_private/s_$foto")) $ante = "img_up/news_private/s_$foto";
						elseif(file_exists("img_up/news_private/$foto")) $ante = "img_up/news_private/$foto";
						if(file_exists("img_up/news_private/s_$foto")) $ante = "img_up/news_private/s_$foto";
						if(file_exists("img_up/news_private/$foto")) $ante = "img_up/news_private/s_$foto";
						else $ante = "https://www.yccs.it/resarea/img_up/news_private/$foto";
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
					<td><?php  echo $data; ?></td>
					<td align="center" valign="center">
						<img src="<?php  echo $ante; ?>" alt="" style="width:150px"/>
					</td>
					<td>
						<img src="../images/it.gif" alt="" style="width:10px;"/>&nbsp;
						<?php  echo $tit; ?>&nbsp;
						<i style="cursor:pointer;" onclick="copy('link_ita_<?php echo $x;?>');<?php /*window.clipboardData.setData('Text','<?php  echo $link; ?>'); alert('Link copiato negli appunti');*/?>" class="fa fa-clipboard" alt="Copia Link" title="Copia Link"></i><br/>						
						<div style="height:5px; overflow:hidden; opacity:0;"><input type="text" value="<?php  echo $link; ?>" id="link_ita_<?php echo $x;?>"></div>
						<img src="../images/en.gif" alt="" style="width:10px;"/>&nbsp;
						<?php  echo $tit_eng; ?>&nbsp;
						<i style="cursor:pointer;" onclick="copy('link_eng_<?php echo $x;?>');<?php /*window.clipboardData.setData('Text','<?php  echo $link_eng; ?>'); alert('Link eng copiato negli appunti');*/?>" class="fa fa-clipboard" alt="Copia Link Eng" title="Copia Link Eng"></i>
						<div style="height:5px; overflow:hidden; opacity:0;"><input type="text" value="<?php  echo $link_eng; ?>" id="link_eng_<?php echo $x;?>"></div>
					</td>
				
					<td style="width:10%">
						<span class="btn-group">
							<a href="admin.php?cmd=news_private&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=news_private&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=news_private&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=news_private&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
								<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
								<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="news_private"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
									</form>
								</div>
							</div>
							<a href="admin.php?cmd=news_private_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onclick="return confirm('Cancellare l\'elemento?')" href="admin.php?cmd=news_private&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
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

<script>
	function copy(myId) {
	  var copyText = document.getElementById(myId);
	  copyText.select();
	  document.execCommand("copy");
	  alert("Link copiato negli appunti");
	}
</script>