<?php 
$table="edizioni_iscrizioni_regata";
$pagina="lista_iscritti_regata";

$criterio="1 AND visibile='1'";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';


if($id_rife!="") {  $rif.="&id_rife=$id_rife"; }
if($id_riferimento!="") { $rif.="&id_riferimento=$id_riferimento"; $criterio.=" AND id_edizione='$id_riferimento'"; }

$query_e="SELECT nome_regata,anno FROM edizioni_regate WHERE id='$id_riferimento'";
$resu_e=$open_connection->connection->query($query_e);
list($nome_edizione, $anno_edizione)=$resu_e->fetch();


if($azione=="cancella" && $id_canc!="")
{	
		
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc", "id_edizione","$id_riferimento") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc", "id_edizione","$id_riferimento") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc", "id_edizione","$id_riferimento") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc", "id_edizione","$id_riferimento") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos", "id_edizione","$id_riferimento") ;	
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}
?>

<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Lista Iscritti Regata <?php echo $nome_edizione;?> del <?php echo $anno_edizione;?></b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<iframe src="" style="display:none" id="hiddenFrame"></iframe>
	
	<?php 
		$query_ele = "SELECT * FROM $table WHERE $criterio order by ordine DESC";			
		$risu_ele = $open_connection->connection->query($query_ele);
		
		$num_ele = 0;
		if($risu_ele)
			$num_ele = $risu_ele->rowCount();
	?>
	<div style="float:left;width:50%;text-align:left;height:30px"></div>
	<div style="clear:both;height:0px">&nbsp;</div>
	
	<div style="float:right; background:grey; cursor:pointer; border-radius:3px; width:120px; margin-left:10px;text-align:center; color:#fff" onclick="printFrameEng();">
		<div style="padding:5px 8px;">
			<i class="fa fa-print" aria-hidden="true"></i> STAMPA ENG	
		</div>
	</div>
	<div style="float:right; background:grey; cursor:pointer; border-radius:3px; width:120px; text-align:center; color:#fff" onclick="printFrameIta();">
		<div style="padding:5px 8px;">
			<i class="fa fa-print" aria-hidden="true"></i> STAMPA ITA	
		</div>
	</div>
	<div style="clear:both;height:10px">&nbsp;</div>
	
	<div class="mws-panel-header" style="position:relative;">
		<span><i class="icon-table"></i>Elenco iscritti (<?php  echo $num_ele; ?>)</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<?php 
			$query_list="SELECT lista_iscritti, lista_iscritti_footer FROM edizioni_regate WHERE id='$id_riferimento'";
			$resu_list=$open_connection->connection->query($query_list);
			list($lista, $footer)=$resu_list->fetch();
			?>
			<div class="mws-form">
				<div class="mws-button-row">
					<div style="font-weight:bold; float:left;">Abilita lista</div>
					<div style="float:left; margin-left:10px; margin-top:-1px; font-size:0.8em; cursor:pointer;" onclick="abilitaLista()"><i class="fa fa-circle fa-2x" aria-hidden="true" id="buttonList" style="<?php if($lista==1){?>color:green;<?php }else{?>color:grey<?php }?>"></i></div>
					
					<div style="float:right;  margin-top:-1px; font-size:0.8em; cursor:pointer;" onclick="abilitaFooter()"><i class="fa fa-circle fa-2x" aria-hidden="true" id="buttonListFoot" style="<?php if($footer==1){?>color:green;<?php }else{?>color:grey<?php }?>"></i></div>
					<div style="font-weight:bold; float:right;margin-right:10px;">Footer stampa</div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<script type="text/javascript">
				function abilitaLista(){
					var col = document.getElementById('buttonList').style.color;
					if(col=="grey"){
						document.getElementById('buttonList').style.color="green";
					}else{
						document.getElementById('buttonList').style.color="grey";
					}
					document.getElementById('hiddenFrame').src="frame/iscrizioni_regata_doc.php?tipo=lista&id_doc=<?php echo $id_riferimento;?>";	
				}
				function abilitaFooter(){
					var colf = document.getElementById('buttonListFoot').style.color;
					if(colf=="grey"){
						document.getElementById('buttonListFoot').style.color="green";
					}else{
						document.getElementById('buttonListFoot').style.color="grey";
					}
					document.getElementById('hiddenFrame').src="frame/iscrizioni_regata_doc.php?tipo=footer&id_doc=<?php echo $id_riferimento;?>";	
				}
			</script>
			<thead>
				<tr>
					<th style="width:20px"></th>
					<th style="text-align:left">Nome Barca</th>			
					<th><a style="color:#333;text-decoration:none">Builder</th>
					<th><a style="color:#333;text-decoration:none">Designer</th>
					<th><a style="color:#333;text-decoration:none">LH/Beam/Draft</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 			
				if($num_ele>0)
				{		
					$rec_pag=100;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE $criterio  order by ordine DESC";
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$boat_name = ucwords(trim($arr_ele['boat_name']));
						$builder = ucwords(trim($arr_ele['builder']));
						$designer = ucwords(trim($arr_ele['designer']));						
						
						$lh = $arr_ele['lh'];
						$beam = $arr_ele['beam'];
						$min_draft = $arr_ele['min_draft'];
						
						$id_campo = $arr_ele['id'];
						$visibile = $arr_ele['visibile'];
			?>
						<script type="text/javascript">
							lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
						</script>
						<tr>
							<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
							<td valign="center">
								<?php echo $boat_name;?>
							</td>
							<td valign="center"><?php echo $builder;?></td>
							<td  style="line-height:14px"><?php  echo $designer;?></td>
													
							<td >
								<b>LH</b>:&nbsp;&nbsp;<?php echo $lh;?><br/>
								<b>Beam</b>:&nbsp;&nbsp;<?php echo $beam;?><br/>
								<b>Draft</b>:&nbsp;&nbsp;<?php echo $min_draft;?>
							</td>
							
							<td style="width:10%" valign="center">
								<span class="btn-group">
									<span class="btn btn-small" id="visibile_<?php echo $id_campo;?>" style="cursor:default; <?php if($arr_ele['visibile']==1){?>color:green<?php }?>" title="<?php if($arr_ele['visibile']==0){?>Non <?php }?>Visibile" onclick="ins_doc('visibile','<?php echo $id_campo;?>')"><i class="fa fa-eye"></i></span>									
									<a href="admin.php?cmd=iscrizioni_regata_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" title="Vedi dati" class="btn btn-small"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
									<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
									<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
									<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
									<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php  echo $rif; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
									<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
										<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
										<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
											<form action="admin.php" method="GET">
												<input type="hidden" name="cmd" value="<?php echo $pagina;?>"/>
												<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
												<input type="hidden" name="azione" value="cambia"/>
												<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
												<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
											</form>
										</div>
									</div>
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

<div style="position:fixed; width:780px; height:400px; background:#fff; top:50%; left:50%; display:none; border:solid 1px #808080; border-radius:2px; text-align:center;  margin-left:-390px; margin-top:-200px; z-index:0000000; box-shadow:5px 5px 5px #808080" id="box_doc">
	<iframe src="" style="width:780px; height:400px; margin-top:5px;" id="frame_link" frameborder=0 ></iframe>
	<div style="position:absolute; top:15px; right:25px; width:20px; height:20px; cursor:pointer; text-align:center;" onclick="document.getElementById('box_doc').style.display='none'; window.location='<?php echo $_SERVER['REQUEST_URI'];?>';">
		<i class="fa fa-times-circle fa-2x"></i>		
	</div>
</div>

<script type="text/javascript">
	function ins_doc(tipo, id_doc){
		document.getElementById('frame_link').src="frame/iscrizioni_regata_doc.php?tipo="+tipo+"&id_doc="+id_doc;	
	}
</script>

<?php $time=time();?>
<iframe src="frame/print_list.php?id_dett=<?php echo $id_riferimento;?>&lingua=ita&time=<?php echo $time;?>"  style="display:none" id="frameListIta" name="frameListIta"/></iframe>
<iframe src="frame/print_list.php?id_dett=<?php echo $id_riferimento;?>&lingua=eng&time=<?php echo $time;?>"  style="display:none" id="frameListEng" name="frameListEng"/></iframe>
<script>
	function printFrameIta(){
		document.title = "lista_iscritti_<?php echo to_htaccess_url($nome_edizione,"");?>_<?php echo $anno_edizione;?>.pdf?<?php echo $time;?>";
		window.frames['frameListIta'].focus();
		window.frames['frameListIta'].print();
		document.title = "<?php echo $nome_del_sito;?> - admin";
	}
	function printFrameEng(){
		document.title = "entry_list_<?php echo to_htaccess_url($nome_edizione,"");?>_<?php echo $anno_edizione;?>.pdf?<?php echo $time;?>";
		window.frames['frameListEng'].focus();
		window.frames['frameListEng'].print();
		document.title = "<?php echo $nome_del_sito;?> - admin";
	}
</script>