<?php 
$table="immagini";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";

/*$num_s = 0;
$query_s = "select id from slide";
$risu_s = $open_connection->connection->query($query_s);
if ($risu_s) $num_s = $risu_s->rowCount();*/

if($conferma)
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc_img = "select immagine from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/images/$img")) @unlink("img_up/images/$img");
		if (is_file("img_up/images/s_$img")) @unlink("img_up/images/s_$img");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc");
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select immagine from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/images/$img")) @unlink("img_up/images/$img");
			if (is_file("img_up/images/s_$img")) @unlink("img_up/images/s_$img");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?>';
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
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[i]+";";
			}
			for(i=start; i<=end; i++){
				document.getElementById('check_'+i).checked=true;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			for(i=start; i<=total; i++){
				document.getElementById('check_'+i).checked=false;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}
</script>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b><?php echo ucfirst($table);?></b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="display:flex; justify-content:space-between;">
		<div></div>
		<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" style="color:#7a7a7a">
			<div class="newAdminBott">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> 
				<b>Aggiungi <?php echo $table;?></b>
			</div>
		</a>
	</div>	
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Immagini</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:100px">Immagine</th>
					<th style="text-align:left">Link</th>
					<th style="text-align:left">Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "SELECT * FROM $table ORDER BY id DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{						  
					$rec_pag=100;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table ORDER BY id DESC LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)			
					{						
						$arr_ele = $risu_ele->fetch();
						$immagine = $arr_ele['immagine'];
						$id_campo = $arr_ele['id'];
						
						if(file_exists("img_up/images/s_$immagine")) $ante = "img_up/gallery/s_$immagine";
						elseif(file_exists("img_up/images/$immagine")) $ante = "img_up/images/$immagine";
						else $ante = "https://www.yccs.it/resarea/img_up/images/$immagine";
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>
					<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
					<td style="position:relative">
						<img src="<?php  echo $ante; ?>" style="width:150px"/>
					</td>
					<td>
						<?php  echo $ante; ?>
						<div style="height:5px; overflow:hidden; opacity:0;"><input type="text" value="<?php  echo $ante; ?>" id="link_<?php echo $x;?>"></div>
					</td>
					<td style="width:10%">
						<span class="btn-group">
							<span  class="btn btn-small" style="cursor:pointer;" onclick="copy('link_<?php echo $x;?>');<?php /*window.clipboardData.setData('Text','<?php  echo $link; ?>');*/?>" title="Copia" alt="Copia"><i class="fa fa-clipboard"></i></span>
							<a href="admin.php?cmd=<?php echo $table;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
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
		$table="immagini";
		include("fissi/multipagina.inc.php"); ?>
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