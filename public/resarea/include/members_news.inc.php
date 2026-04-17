<?php 
$table="news";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['azione'])) $azione=$_GET['azione']; else $azione="";
if(isset($_GET['tipo_ordine'])) $tipo_ordine=$_GET['tipo_ordine']; else $tipo_ordine="personalizzato";

if($tipo_ordine=="personalizzato") $ordine = " ordine_YA DESC";
else if(($tipo_ordine=="data")) $ordine = " data_news DESC";

$rif="&tipo_ordine=$tipo_ordine";

if($azione=="cancella" && $id_canc!="")
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc_img = "select img from news where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($logo) = $risu_canc_img->fetch();
		if (is_file("img_up/$logo")) @unlink("img_up/$logo");
		if (is_file("img_up/s_$logo")) @unlink("img_up/s_$logo");
		if (is_file("img_up/xs_$logo")) @unlink("img_up/xs_$logo");
	}
	
	$query_canc = "delete from news where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.location="admin.php?cmd=members_news<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali2("news", "ordine_YA", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi2("news", "ordine_YA", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo2("news", "ordine_YA", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo2("news", "ordine_YA", "$id_canc");
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia2("news", "ordine_YA", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=members_news<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from news where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($logo) = $risu_canc_img->fetch();
			if (is_file("img_up/$logo")) @unlink("img_up/$logo");
			if (is_file("img_up/s_$logo")) @unlink("img_up/s_$logo");
			if (is_file("img_up/xs_$logo")) @unlink("img_up/xs_$logo");
		}
		
		$query_canc = "delete from news where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=members_news<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
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
			document.getElementById('cancella_sel').href='admin.php?cmd=members_news<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=members_news<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>News Young Azzurra</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<?php 
	// Recupera il protocollo (http o https)
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

	// Recupera il nome del server
	$serverName = $_SERVER['SERVER_NAME'];

	// Recupera la porta (se diversa dalla porta standard)
	$port = ($_SERVER['SERVER_PORT'] != '80' && $_SERVER['SERVER_PORT'] != '443') ? ":" . $_SERVER['SERVER_PORT'] : "";

	// Recupera l'URI della richiesta
	$requestUri = $_SERVER['REQUEST_URI'];

	// Combina tutti i componenti per ottenere la URL completa
	$fullUrl = $protocol . $serverName . $port . $requestUri;
	$fullUrl = str_replace("&tipo_ordine=$tipo_ordine","",$fullUrl);
	?>
	<div style="float:left; margin-right:5px;">Ordine: </div>
	<div style="float:left; margin-top:-5px;">
		<select onchange="window.location='<?php echo $fullUrl;?>&tipo_ordine='+this.value">
			<option value="personalizzato" <?php if($tipo_ordine=="personalizzato"){?>selected="selected"<?php }?>>Personalizzato (nella HOME di Young Azzurra) </option>
			<option value="data" <?php if($tipo_ordine=="data"){?>selected="selected"<?php }?>>Per data (nella pagina News di Young Azzurra)</option>			
		</select>
	</div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=members_news_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi articolo</b>
			</div>
		</a>
	</div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco news</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:80px">Data</th>
					<th style="width:150px;">Foto</th>
					<th style="text-align:left;">Titolo</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from news WHERE tipo='news_young' order by $ordine";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{		
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM news WHERE tipo='news_young' order by $ordine LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$foto = $arr_ele['img'];
						$tit = $oggetto_admin->puntini(ucfirst($arr_ele['titolo']));
						$data = $oggetto_admin->date_to_data($arr_ele['data_news']);
						$id_campo = $arr_ele['id'];
						$news = $arr_ele['news'];
						$YA = $arr_ele['YA'];
						
						if(file_exists("img_up/s_$foto")) $ante = "img_up/s_$foto";
						elseif(file_exists("img_up/$foto")) $ante = "img_up/$foto";
						else $ante = "https://www.yccs.it/resarea/img_up/$foto";
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
					<td align="center" valign="center"><?php  echo $data; ?></td>
					<td align="center" valign="center">
						<img src="<?php  echo $ante; ?>" alt="" style="width:150px;"/>
					</td>
					<td><?php  echo $tit; ?></td>
					<td style="width:10%">
						<span class="btn-group">
							<a title="Visibilità in sezioni NEWS/HOME" onclick="cambiaNews('<?php echo $id_campo;?>')" id="news_<?php echo $id_campo;?>" class="btn btn-small" style="cursor:pointer; color:<?php if($news==0){?>red<?php }else{?>green<?php }?>"><i class="icon-newspaper"></i></a>
							<a  title="Visibilità in sezioni Young Azzurra" onclick="cambiaYA('<?php echo $id_campo;?>')" id="YA_<?php echo $id_campo;?>" class="btn btn-small" style="cursor:pointer; color:<?php if($YA==0){?>red<?php }else{?>green<?php }?>"><b>YA</b></a>
							<?php if($tipo_ordine=="personalizzato"){?>
								<a href="admin.php?cmd=members_news&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
								<a href="admin.php?cmd=members_news&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
								<a href="admin.php?cmd=members_news&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
								<a href="admin.php?cmd=members_news&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
								<?php /*<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
									<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
									<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
										<form action="admin.php" method="GET">
											<input type="hidden" name="cmd" value="members_news"/>
											<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
											<input type="hidden" name="azione" value="cambia"/>
											<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
											<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
										</form>
									</div>
								</div>*/?>
							<?php }?>
							<a href="admin.php?cmd=members_news_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onclick="return confirm('Cancellare l\'elemento?')" href="admin.php?cmd=members_news&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>
		<?php  		
		$table="members_news";
		include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>

<iframe id="frameNews" src="" style="display:none"></iframe>
<script>
	function cambiaNews(id){
		var color = document.getElementById('news_'+id).style.color;
		if (color=="red") document.getElementById('news_'+id).style.color="green";
		else  document.getElementById('news_'+id).style.color="red";
		document.getElementById('frameNews').src="frame/cambiaNews.php?id_campo="+id;
	}
	function cambiaYA(id){
		var color = document.getElementById('YA_'+id).style.color;
		if (color=="red") document.getElementById('YA_'+id).style.color="green";
		else  document.getElementById('YA_'+id).style.color="red";
		document.getElementById('frameNews').src="frame/cambiaYA.php?id_campo="+id;
	}
</script>
