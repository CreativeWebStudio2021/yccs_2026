<li style="margin-top:20px; width:200px" <?php  if (!empty($blocco) && $blocco=="regate") { ?>class="active"<?php  } ?>>
	<a href="#"style="display:flex; align-items:center;">
		<i class="icon-boat"></i>
		<span class="scritte_menu">Sezione Regate</span>
	</a>
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=lista" <?php if($cmd=="lista"){?>style="font-weight:bold"<?php }?>>Documento Lista Regate</a></li>
	</ul>
	<ul class="scritte_menu">
		<li><a href="admin.php?cmd=regate">Elenco completo</a></li>
	</ul>
</li>

<?php  if (($cmd=="edizioni_mod" || $cmd=="edizioni_ins" || $cmd=="edizioni" || $cmd=="info" || $cmd=="foto" || $cmd=="video" || $cmd=="documenti" || $cmd=="noticeboard" || $cmd=="noticeboard_ins" || $cmd=="noticeboard_mod" || $cmd=="iscritti" || $cmd=="risultati" || $cmd=="press" || $cmd=="crew_board" || $cmd=="loghi_mod" || $cmd=="loghi_ins" || $cmd=="loghi" || $cmd=="loghi_new_mod" || $cmd=="loghi_new_ins" || $cmd=="loghi_new" || $cmd=="loghi_partners_mod" || $cmd=="loghi_partners_ins" || $cmd=="loghi_partners" || $cmd=="modulo_iscrizioni_mod" || $cmd=="iscrizioni_regata" || $cmd=="iscrizioni_regata_mod" || $cmd=="lista_iscritti_regata") && $id_rife!="") { ?>
	<li style="margin-top:20px" class="scritte_menu">
		<?php 
			$num_reg = 0;
			$query_reg = "select nome from regate where id='$id_rife'";
			$risu_reg = $open_connection->connection->query($query_reg);
			if ($risu_reg) list($nome_reg) = $risu_reg->fetch();
			?>
			
			<a href="#" style="display:flex; align-items:center; margin-left:20px; gap:10px;">
				<i class="fa fa-th-list fa-2x" aria-hidden="true"></i>
				<span class="scritte_menu"> <?php echo $nome_reg;?></span>
			</a>
			
			<?php
			$num_edr = 0;
			$query_edr = "select id,anno,new, new2, modulo_iscrizioni from edizioni_regate where id_regata='$id_rife' order by anno desc";
			$risu_edr = $open_connection->connection->query($query_edr);
			if ($risu_edr) $num_edr = $risu_edr->rowCount();
			
			if ($num_edr>0) {
				echo "<ul>";
				for ($er=0; $er<$num_edr; $er++) {
					list($id_edr,$anno_edr,$new_edr,$new2_edr,$modulo_iscrizioni) = $risu_edr->fetch();
					if ($id_edr==$id_rec || ($cmd!="edizioni" && $id_edr==$id_riferimento)) {
						echo "<li><a><span style=\"color:#7e9edb\">Edizione $anno_edr $new_edr</span></a>";
						
						if ($cmd=="edizioni_mod") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">GENERALE</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=edizioni_mod&id_rec=$id_edr&id_rife=$id_rife\">GENERALE</a></div>";
						if ($cmd=="foto") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">FOTO</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=foto&id_rife=$id_rife&id_riferimento=$id_edr\">FOTO</a></div>";
						if ($cmd=="video") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">VIDEO</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=video&id_rife=$id_rife&id_riferimento=$id_edr\">VIDEO</a></div>";
						if ($cmd=="info") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">INFO</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=info&id_rife=$id_rife&id_riferimento=$id_edr\">INFO</a></div>";
						if ($cmd=="noticeboard") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">ALBO DEI COMUNICATI</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=noticeboard&id_rife=$id_rife&id_riferimento=$id_edr\">ALBO DEI COMUNICATI</a></div>";
						if ($cmd=="documenti") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">DOCUMENTI</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=documenti&id_rife=$id_rife&id_riferimento=$id_edr\">DOCUMENTI</a></div>";
						if ($cmd=="iscritti") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">ISCRITTI</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=iscritti&id_rife=$id_rife&id_riferimento=$id_edr\">ISCRITTI</a></div>";
						if ($cmd=="risultati") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">RISULTATI</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=risultati&id_rife=$id_rife&id_riferimento=$id_edr\">RISULTATI</a></div>";
						if ($cmd=="press") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">STAMPA</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=press&id_rife=$id_rife&id_riferimento=$id_edr\">STAMPA</a></div>";
						if ($cmd=="crew_board") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">CREW BOARD</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=crew_board&id_rife=$id_rife&id_riferimento=$id_edr\">CREW BOARD</a></div>";
						if($new_edr==0){
							if ($cmd=="loghi" || $cmd=="loghi_ins" || $cmd=="loghi_mod" ) echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">LOGHI</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=loghi&id_rife=$id_rife&id_riferimento=$id_edr\">LOGHI</a></div>";
						}
						if($new_edr==1 || $new2_edr==1){
							if ($cmd=="loghi_new" || $cmd=="loghi_new_ins" || $cmd=="loghi_new_mod") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">TITLE SPONSOR</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=loghi_new&id_rife=$id_rife&id_riferimento=$id_edr\">TITLE SPONSOR</a></div>";
							if ($cmd=="loghi_partners" || $cmd=="loghi_partners_ins" || $cmd=="loghi_partners_mod") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">LOGHI PARTNERS</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=loghi_partners&id_rife=$id_rife&id_riferimento=$id_edr\">LOGHI PARTNERS</a></div>";
						}
						
						if($modulo_iscrizioni==1){
							if ($cmd=="modulo_iscrizioni_mod") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">MODULO ISCRIZIONI</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=modulo_iscrizioni_mod&id_rife=$id_rife&id_riferimento=$id_edr\">MODULO ISCRIZIONI</a></div>";
							if ($cmd=="iscrizioni_regata" || $cmd=="iscrizioni_regata_mod") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">ELENCO ISCRITTI</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=iscrizioni_regata&id_rife=$id_rife&id_riferimento=$id_edr\">ELENCO RICHIESTE</a></div>";
							//if ($cmd=="lista_iscritti_regata") echo "<div style=\"padding-left:65px;color:#7e9edb;font-size:0.98em\">LISTA ISCRITTI</div>"; else echo "<div style=\"padding-left:65px\"><a style=\"color:#fff;font-size:0.98em\" href=\"admin.php?cmd=lista_iscritti_regata&id_rife=$id_rife&id_riferimento=$id_edr\">LISTA ISCRITTI</a></div>";
						}
						
						echo "</li>";
					};
					//else echo "<li><a href=\"admin.php?cmd=edizioni_mod&id_rife=$id_rife&id_rec=$id_edr\">Edizione $anno_edr</a></li>";
				}
				if ($cmd=="edizioni") echo "<li><a><span style=\"color:#7e9edb\">Vedi tutte le edizioni</span></a></li>";
					else echo "<li><a href=\"admin.php?cmd=edizioni&id_rife=$id_rife\">Vedi tutte le edizioni</a></li>";
				if ($cmd=="edizioni_ins") echo "<li><a><span style=\"color:#7e9edb\">Aggiungi Nuova Edizione</span></a></li>";
					else echo "<li><a href=\"admin.php?cmd=edizioni_ins&id_rife=$id_rife\">Aggiungi Nuova Edizione</a></li>";
				echo "</ul>";
			}
		?>
	</li>
<?php  } ?>