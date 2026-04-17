<?php 
$query_rec = "select * from instagram_feed where id='1'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_attivo = $arr_rec['attivo']; if(!$n_attivo) $n_attivo="0";
?>
<div class="mws-panel grid_8" style="position:relative;">
	<iframe src="" id="hiddenFrame" style="display:none;"></iframe>
	<div style="height:30px;font-size:1.2em;padding-top:10px">Modifica Visibilità Feed Instagram in Homepage</div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=modulo_iscrizioni_mod&id_rec=<?php  echo $id_rec; ?><?php if(isset($rif)) echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<p>Se la visibilità è attiva (verde) le foto di instagram sostituiranno la fotogallery in homepage</p>
					<div style="float:left; margin-top:10px;">
						<label class="mws-form-label">Visibilità</label>
						<div class="mws-form-item" style="cursor:pointer;" onclick="changeVisibilita()">
							<input name="visibilita" type="hidden" class="medium" value="<?php echo $n_attivo;?>">
								<?php if($n_attivo==0){?>
									<span id="checkVisibilita"><i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i></span>
								<?php }else{?>
									<span id="checkVisibilita"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i></span>
								<?php }?>
							
						</div>
					</div>
					<script type="text/javascript">
						var visib=<?php echo $n_attivo;?>;
						function changeVisibilita(){
							if(visib==0){
								visib=1;
								document.getElementById('checkVisibilita').innerHTML='<i class="fa fa-circle fa-2x" aria-hidden="true" style="color:green"></i>';
								document.getElementById('hiddenFrame').src='frame/cambiaInstagram.php?val=1';
							}else{
								visib=0;
								document.getElementById('checkVisibilita').innerHTML='<i class="fa fa-circle-o fa-2x" aria-hidden="true" style="color:#000"></i>';
								document.getElementById('hiddenFrame').src='frame/cambiaInstagram.php?val=0';
							}
						}	
					</script>
				</div>
			</div>
		</form>
	</div>
</div>