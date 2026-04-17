<?php 
if(!isset($start)) $start=0;
if(!isset($rec_pag)) $rec_pag=20;
if(!isset($pag_tot)) $pag_tot=0;
?>
<!--da aggiungere in caso di multipagina manuale-->
<script type="text/javascript">	
	document.getElementById('start').innerHTML=<?php echo $start+1;?>;
	document.getElementById('end').innerHTML=<?php echo $start+$num_item;?>;
	document.getElementById('total').innerHTML=<?php echo $num_ele;?>;
</script>

<div style="width:100%; background:#444444">
	<div style="padding:10px">
		<div style="float:left; color:#fff">Elementi da <?php echo $start+1;?> a <?php if($start+$rec_pag<$num_ele) echo $start+$rec_pag; else echo $num_ele;?> di <?php echo $num_ele;?></div>
		<?php if($pag_tot>1){?>
			<div style="float:right;">
				<div class="button_pager button_pager_left button_pager_disabled">
					<?php if($pag_att==1){?>Prima Pag.
					<?php }else{?><a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=1" title="Prima Pagina" style="color:#fff">Prima Pag.</a><?php }?>
				</div>
				<div class="button_pager button_pager_disabled">
					 <?php if($pag_att<2){?>Pag. Prec
					 <?php }else{?><a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att-1;?>" title="Pagina Precedente" style="color:#fff">Pag. Prec</a><?php }?>
				</div>
				<!--<div class="button_pager button_pager_selected">1</div>-->
				<?php if($pag_tot<=3){?>
					<?php for($z=1; $z<=$pag_tot; $z++){?>
						<div class="button_pager <?php if($pag_att==$z){?>button_pager_selected<?php }?>">
							<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $z;?>" title="Vai a Pagina <?php echo $z;?>" style="color:#<?php if($pag_att==$z){?>444444<?php }else{?>fff<?php }?>"><?php echo $z;?></a>
						</div>
					<?php }?>
				<?php }else{?>
					<div class="button_pager <?php if($pag_att==1){?>button_pager_selected<?php }?>">
						<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=1" title="Vai a Pagina 1" style="color:#<?php if($pag_att==1){?>444444<?php }else{?>fff<?php }?>">1</a>
					</div>
					
					<div class="button_pager <?php if($pag_att!=1 && $pag_att!=$pag_tot){?>button_pager_selected<?php }?>">
						<div style="position:relative;">
							<span style="color:#<?php if($pag_att!=1 && $pag_att!=$pag_tot){?>444444<?php }else{?>#fff<?php }?>">
								<?php if($pag_att!=1 && $pag_att!=$pag_tot){?>... <?php echo $pag_att;?> ...<?php }else{?>...<?php }?>
							</span>
							<div style="position:absolute; top:0; left:0">
								<select onchange="window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att='+this.value" style="filter: alpha(opacity=0); -moz-opacity:0; -khtml-opacity: 0; opacity: 0;">
									<?php for($y=1; $y<=$pag_tot; $y++){?>
										<option value="<?php echo $y;?>" <?php if($pag_att==$y){?>selected="selected"<?php }?>><?php echo $y;?></option>
									<?php }?>
								</select>
							</div>
						</div>
					</div>
					
					<div class="button_pager <?php if($pag_att==$pag_tot){?>button_pager_selected<?php }?>">
						<a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_tot;?>" title="Vai a Pagina <?php echo $pag_tot;?>" style="color:#<?php if($pag_att==$pag_tot){?>444444<?php }else{?>fff<?php }?>"><?php echo $pag_tot;?></a>
					</div>
				<?php }?>
				<div class="button_pager <?php if($pag_att==$pag_tot){?>button_pager_disabled<?php }?>">
					<?php if($pag_att==$pag_tot){?>Pag. Succ.
					<?php }else{?><a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att+1;?>" title="Pagina Successiva" style="color:#fff">Pag. Succ.</a><?php }?>
				</div>
				<div class="button_pager button_pager_right <?php if($pag_att==$pag_tot){?>button_pager_disabled<?php }?>">
					<?php if($pag_att==$pag_tot){?>Ultima Pag.
					<?php }else{?><a href="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_tot;?>" title="Ultima Pagina" style="color:#fff">Ultima Pag.</a><?php }?>
				</div>
			</div>
		<?php }?>
		<div style="clear:both"></div>
	</div>
</div>