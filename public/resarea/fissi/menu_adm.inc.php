<?php if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si"){?>
	<!-- Necessary markup, do not remove -->
	
	

	<!-- Sidebar Wrapper -->
	<div id="mws-sidebar" style="height:100%">

		<!-- Hidden Nav Collapse Button -->
		<div id="mws-nav-collapse">
			<span></span>
			<span></span>
			<span></span>
		</div>
		
		<!-- Searchbox 
		<div id="mws-searchbox" class="mws-inset">
			<form action="typography.html">
				<input type="text" class="mws-search-input" placeholder="Search...">
				<button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
			</form>
		</div>-->
		<?php  
		switch (true) {
			case in_array($cmd, ["utenti", "utenti_ins", "utenti_mod"]):
				$blocco = "utenti";
				break;

			case in_array($cmd, ["gallery", "gallery_ins", "gallery_mod", 
								"slide", "slide_ins", "slide_mod", 
								"instagram", "instagram_ins", "instagram_mod"]):
				$blocco = "home";
				break;

			case in_array($cmd, ["comunicati_home", "comunicati_home_ins", "comunicati_home_mod"]):
				$blocco = "comunicati_home";
				break;

			case in_array($cmd, ["pagine", "pagine_ins", "pagine_mod",
								"fotogallery_pagine","fotogallery_pagine_ins","fotogallery_pagine_mod"]):
				$blocco = "pagine";
				break;

			case in_array($cmd, ["testo_pagine", "testo_pagine_ins", "testo_pagine_mod"]):
				$blocco = "testo_pagine";
				break;

			case in_array($cmd, ["immagini", "immagini_ins", "immagini_mod"]):
				$blocco = "immagini";
				break;

			case in_array($cmd, ["calendari", "calendari_ins", "calendari_mod"]):
				$blocco = "calendari";
				break;

			case in_array($cmd, ["regate", "regate_ins", "regate_mod",
								"lista", "lista_ins", "lista_mod",
								"edizioni", "edizioni_ins", "edizioni_mod",
								"info", "info_ins", "info_mod",
								"foto", "foto_ins", "foto_mod",
								"video", "video_ins", "video_mod",
								"documenti", "documenti_ins", "documenti_mod",
								"noticeboard", "noticeboard_ins", "noticeboard_mod",
								"iscritti", "iscritti_ins", "iscritti_mod",
								"risultati", "risultati_ins", "risultati_mod",
								"press", "press_ins", "press_mod",
								"crew_board", "crew_board_ins", "crew_board_mod",
								"loghi", "loghi_ins", "loghi_mod",
								"loghi_new", "loghi_new_ins", "loghi_new_mod",
								"loghi_partners", "loghi_partners_ins", "loghi_partners_mod",
								"modulo_iscrizioni", "modulo_iscrizioni_ins", "modulo_iscrizioni_mod",
								"iscrizioni_regata", "iscrizioni_regata_ins", "iscrizioni_regata_mod",
								"lista_iscritti_regata", "lista_iscritti_regata_ins", "lista_iscritti_regata_mod"]):
				$blocco = "regate";
				break;

			case in_array($cmd, ["regate_esterne", "regate_esterne_ins", "regate_esterne_mod"]):
				$blocco = "regate_esterne";
				break;

			case in_array($cmd, ["news", "news_ins", "news_mod"]):
				$blocco = "news";
				break;

			case in_array($cmd, ["news_private", "news_private_ins", "news_private_mod"]):
				$blocco = "news_private";
				break;

			case in_array($cmd, ["stampa", "stampa_ins", "stampa_mod",
								"rassegna", "rassegna_ins", "rassegna_mod",
								"rassegna_doc", "rassegna_doc_ins", "rassegna_doc_mod",
								"rassegna_foto", "rassegna_foto_ins", "rassegna_foto_mod",
								"rassegna_video", "rassegna_video_ins", "rassegna_video_mod",
								"rassegna_stampa", "rassegna_stampa_ins", "rassegna_stampa_mod"]):
				$blocco = "stampa";
				break;

			case in_array($cmd, ["clienti", "clienti_ins", "clienti_mod",
								"comunicazioni_ai_soci", "comunicazioni_ai_soci_ins", "comunicazioni_ai_soci_mod",
								"statuto_mod",
								"regolamento_interno_mod"]):
				$blocco = "area_soci";
				break;

			case in_array($cmd, ["iscrizioni_scuola", "iscrizioni_scuola_ins", "iscrizioni_scuola_mod"]):
				$blocco = "iscrizioni_scuola";
				break;

			case (
				str_starts_with($cmd, "ya_") ||
				in_array($cmd, [
					"members_eventi", "members_eventi_ins", "members_eventi_mod",
					"members_news", "members_news_ins", "members_news_mod"
				])
			):
				$blocco = "young_azzurra";
				break;

			case (
				str_starts_with($cmd, "azzurra_pagine") ||
				str_starts_with($cmd, "azzurra_pagine_ins") ||
				str_starts_with($cmd, "azzurra_pagine_mod") ||
				str_starts_with($cmd, "azzurra_40") ||
				str_starts_with($cmd, "azzurra_40_ins") ||
				str_starts_with($cmd, "azzurra_40_mod")
			):
				$blocco = "azzurra";
				break;

			case in_array($cmd, ["magazine_macrocategorie", "magazine_macrocategorie_ins", "magazine_macrocategorie_mod",
								"magazine_categorie", "magazine_categorie_ins", "magazine_categorie_mod",
								"magazine_articolo", "magazine_articolo_ins", "magazine_articolo_mod"]):
				$blocco = "magazine";
				break;

			case in_array($cmd, ["sail_talk_macrocategorie", "sail_talk_macrocategorie_ins", "sail_talk_macrocategorie_mod",
								"sail_talk_categorie", "sail_talk_categorie_ins", "sail_talk_categorie_mod",
								"sail_talk_articolo", "sail_talk_articolo_ins", "sail_talk_articolo_mod"]):
				$blocco = "sail_talk";
				break;

			case in_array($cmd, ["categorie", "categorie_ins", "categorie_mod",
								 "sottocategorie", "sottocategorie_ins", "sottocategorie_mod",
								 "tipo_taglia", "tipo_taglia_ins", "tipo_taglia_mod",
								 "valori_taglia", "valori_taglia_ins", "valori_taglia_mod",
								 "colori", "colori_ins", "colori_mod",
								 "prodotti", "prodotti_ins", "prodotti_mod"]):
				$blocco = "negozio";
				break;

			case in_array($cmd, ["ordini", "ordini_ins", "ordini_mod"]):
				$blocco = "ordini";
				break;

			case in_array($cmd, ["lavora_con_noi", "lavora_con_noi_ins", "lavora_con_noi_mod"]):
				$blocco = "lavora_con_noi";
				break;
		}
		//$$active = 1;
		?>
		
		
		<!-- Main Navigation -->
		<div id="mws-navigation">						
			<ul style="margin-bottom:10px" id="duplicaMenuActive"></ul>
			
			<ul>
				<?php 			
				if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="300"){
					include("fissi/blocchi_menu/utenti.inc.php");	
				}
				
				if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="200"){				
					include("fissi/blocchi_menu/home.inc.php");	
					include("fissi/blocchi_menu/comunicati_home.inc.php");	
					include("fissi/blocchi_menu/pagine.inc.php");	
					include("fissi/blocchi_menu/testo_pagine.inc.php");	
					include("fissi/blocchi_menu/immagini.inc.php");	
					include("fissi/blocchi_menu/calendari.inc.php");	
					include("fissi/blocchi_menu/regate.inc.php");					
					include("fissi/blocchi_menu/regate_esterne.inc.php");					
					include("fissi/blocchi_menu/news.inc.php");					
					include("fissi/blocchi_menu/news_private.inc.php");					
					include("fissi/blocchi_menu/stampa.inc.php");					
					include("fissi/blocchi_menu/area_soci.inc.php");	
				}
				
				include("fissi/blocchi_menu/iscrizioni_scuola.inc.php");			
				
				if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="200"){
					include("fissi/blocchi_menu/young_azzurra.inc.php");			
					include("fissi/blocchi_menu/azzurra.inc.php");			
					include("fissi/blocchi_menu/magazine.inc.php");			
					include("fissi/blocchi_menu/sail_talk.inc.php");			
					include("fissi/blocchi_menu/negozio.inc.php");			
					include("fissi/blocchi_menu/ordini.inc.php");	
					include("fissi/blocchi_menu/lavora_con_noi.inc.php");	
				}
				?>		
				<li style="margin-top:50px">
					<a href="../home.html" target="_blank" style="display:flex; align-items:center; margin-left:15px; gap:10px;">
						<i class="icon-bended-arrow-left"></i>
						<i class="scritte_menu">Torna al sito</i>
					</a>
				</li>
			</ul>
		</div>         
	</div>
	
	<script>
		function cambiaMenu(blocco=""){
			$.ajax({
				url: "ajax/cambiaMenu.php", 
				type: "GET",
				data: {
					blocco : blocco, 
					cmd : '<?php echo $cmd;?>' <?php if(isset($id_rife) && $id_rife!=""){?>, 
					id_rife : <?php echo $id_rife;?><?php }?> <?php if(isset($id_riferimento) && $id_riferimento!=""){?>, 
					id_riferimento : <?php echo $id_riferimento;?><?php }?> <?php if(isset($id_rec) && $id_rec!=""){?>, 
					id_rec : <?php echo $id_rec;?><?php }?>
				}, 
				success: function(result){
					$("#duplicaMenuActive").html(result);
				}
			});
		}
		<?php if(!empty($blocco)){?>
			cambiaMenu ("<?php echo $blocco;?>");
		<?php }?>
	</script>
<?php }?>

