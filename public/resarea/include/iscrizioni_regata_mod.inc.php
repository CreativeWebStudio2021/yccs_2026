<?php 
$table="edizioni_iscrizioni_regata";
$pagina="iscrizioni_regata";
$rif="";

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento='';
if(isset($_GET['boat_name_ric'])) $boat_name_ric=$_GET['boat_name_ric']; else $boat_name_ric='';
if(isset($_GET['charterer_ric'])) $charterer_ric=$_GET['charterer_ric']; else $charterer_ric='';
if(isset($_GET['charterer_email_ric'])) $charterer_email_ric=$_GET['charterer_email_ric']; else $charterer_email_ric='';
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

if($id_rife!="") {  $rif.="&id_rife=$id_rife"; }
if($id_riferimento!="") { $rif.="&id_riferimento=$id_riferimento"; }
if($boat_name_ric!="") { $rif.="&boat_name_ric=$boat_name_ric"; }
if($charterer_ric) {$rif.="&charterer_ric=$charterer_ric"; }
if($charterer_email_ric!="") { $rif.="&charterer_email_ric=$charterer_email_ric"; }
$rif.="&pag_att=$pag_att";


$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();


?>
<script language="javascript">
	function annulla(){
		//window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
		window.location='<?php echo $_SERVER['HTTP_REFERER'];?>';
	}
</script>

<?php 
if($stato=="inviato")
{
	$arr_no['stato']=1;
	
	$_POST['nome']=str_replace('"',"''",$_POST['nome']);
	$_POST['cognome']=str_replace('"',"''",$_POST['cognome']);
	
	$oggetto_admin->modifica_campi("$table" ,$id_rec , $arr_no ,  $arr_thumb="no" );
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
	</script>	
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px">
		<div style="float:left"><b>Dati Iscrizione</b></div>
		<!--<div style="float:right"><a href="admin.php?ric_stato=inviato&cmd=ordini&cognome_ric=<?php echo $n_cognome;?>&email_ric=<?php echo $n_email;?>" style="color:#333333"><b>Vedi Ordini</b></a></div>-->
		<div style="clear:both"></div>
	</div>
	<div class="mws-panel-header">
		<span>Dati</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
				<?php 
				$x=1;
				foreach ($arr_rec as $key => $value) {
					//$value = urlencode(stripslashes($value));
					if($x==1){						
						if($key!="id" && $key!="ordine" && $key!="categories" && $key!="maxi" && $key!="codice" && $key!="id_utente"  && $value && $value!=""){
							if($key=="CI" || $key=="CF"){
								echo "<b>".ucfirst(str_replace("_"," ",$key))."</b>: <a style='color:#000' href='../download2.php?path=resarea/files/iscrizioni/<?php echo $id_rec;?>/&file=".$value."'>".$value."</a><br/>";
							}else{								
								if($key=="yccs_member" && $value=="on") $value="yes";
								if($key=="eta") $key="E.T.A.";
								
								if($key=="yacht_club" && $value && $value!=""){
									$query_y="SELECT yacht_club_valore FROM edizioni_modulo_iscrizioni WHERE id_edizione='$id_riferimento'";
									$resu_y=$open_connection->connection->query($query_y);
									list($yc_value)=$resu_y->fetch();
									$key=$yc_value;
								}
								if($key=="home_port" && $value && $value!=""){
									$query_y="SELECT yacht_club_valore2 FROM edizioni_modulo_iscrizioni WHERE id_edizione='$id_riferimento'";
									$resu_y=$open_connection->connection->query($query_y);
									list($yc_value2)=$resu_y->fetch();
									$key=$yc_value2;
								}
								if($key=="boat_captain" && $value && $value!=""){
									$query_c="SELECT captain_valore FROM edizioni_modulo_iscrizioni WHERE id_edizione='$id_riferimento'";
									$resu_c=$open_connection->connection->query($query_c);
									list($cp_value)=$resu_c->fetch();
									$key=$cp_value;
								}
								if($key=="captain_cell" && $value && $value!=""){
									$query_c="SELECT captain_valore FROM edizioni_modulo_iscrizioni WHERE id_edizione='$id_riferimento'";
									$resu_c=$open_connection->connection->query($query_c);
									list($cp_value)=$resu_c->fetch();
									$key=$cp_value;
								}
								if($key=="captain_email" && $value && $value!=""){
									$query_c="SELECT captain_valore FROM edizioni_modulo_iscrizioni WHERE id_edizione='$id_riferimento'";
									$resu_c=$open_connection->connection->query($query_c);
									list($cp_value)=$resu_c->fetch();
									$key=$cp_value;
								}
								if($key=="owner_name" && $value && $value!=""){
									$query_o="SELECT owner_name_valore FROM edizioni_modulo_iscrizioni WHERE id_edizione='$id_riferimento'";
									$resu_o=$open_connection->connection->query($query_o);
									list($o_value)=$resu_o->fetch();
									$key=$o_value;
								}
								if($key == "captain_nautical_driving_license_att" || $key == "owner_nautical_driving_license_att" || $key == "rating_certificate" || $key == "crew_list"){
									echo "<b>".ucfirst(str_replace("_"," ",$key))."</b>: <a style='text-decoration:underline; color:#111' href='../download2.php?path=resarea/files/iscrizioni_regate/$id_rec/&file=$value' target='_blank'>".$value."</a><br/>";
								}else{
									echo "<b>".ucfirst(str_replace("_"," ",$key))."</b>: ".$value."<br/>";
								}
							}
						}
						
						//$oggetto_admin->campo_mod(ucfirst(str_replace("_"," ",$key)) , "$key" , "$value"  , "1", 'no', "$cmd", "$id_rec");
					}
					$x++;
					if($x==3) $x=1;
				}			
				?>
				</div>			
				
				<br/><br/>
				
			</div>
			<div class="mws-button-row">
				<input type="button" value="Torna Indietro" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
