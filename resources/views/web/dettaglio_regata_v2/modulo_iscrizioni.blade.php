@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";
		if(isset($_POST['recupero'])) $recupero=$_POST['recupero']; else $recupero="";
		if(isset($_POST['recuperopassword'])) $recuperopassword=$_POST['recuperopassword']; else $recuperopassword="";

		$query_ed = DB::table('edizioni_regate');
		$query_ed = $query_ed->select('*');
		$query_ed = $query_ed->where('id','=',$id_dett);
		$query_ed = $query_ed->where('visibile','=','1');
		$query_ed = $query_ed->where('new','=','1');
		$query_ed = $query_ed->get();
		$num_ed = $query_ed->count();
	@endphp

	@if($num_ed>0)
		@php	
			$nome_regata = $query_ed[0]->nome_regata;
			$luogo    =  $query_ed[0]->luogo;
			$anno_regata   =  $query_ed[0]->anno;
			$titolo_regata=$nome_regata." - ".$luogo." ".$anno_regata;
			
			$logo_edizione  = $query_ed[0]->logo_edizione;
			
			$data_dal   = $query_ed[0]->data_dal;
			$data_al   = $query_ed[0]->data_al;
			$modulo_iscrizioni   = $query_ed[0]->modulo_iscrizioni;
			
			$link_back="regate-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
			if($lingua=="eng") $link_back="en/regattas-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
			
			
			$query_mod = DB::table('edizioni_modulo_iscrizioni');
			$query_mod = $query_mod->select('*');
			$query_mod = $query_mod->where('id_edizione','=',$id_dett);
			$query_mod = $query_mod->get();
			
			$data_limite=$query_mod[0]->data_limite;
			$testo_modulo_ita=$query_mod[0]->testo_modulo_ita;
			$testo_modulo_eng=$query_mod[0]->testo_modulo_eng;
			$membri=$query_mod[0]->membri;
			$membri_valori=$query_mod[0]->membri_valori;
			$maxi_select=$query_mod[0]->maxi;
			$categorie_check=$query_mod[0]->categorie;
			$boat_details=$query_mod[0]->boat_details;
			$yacht_club_check=$query_mod[0]->yacht_club;
			$yacht_club_valore=$query_mod[0]->yacht_club_valore;
			$yacht_club_valore2=$query_mod[0]->yacht_club_valore2;
			$yacht_club_valore2_visib=$query_mod[0]->yacht_club_valore2_visib;
			$charterer_check=$query_mod[0]->charterer;
			$tipo_barca=$query_mod[0]->tipo_barca;
			$tipo_barca_valori=$query_mod[0]->tipo_barca_valori;
			$captain=$query_mod[0]->captain;
			$captain_valore=$query_mod[0]->captain_valore;
			$captain_data_visib=$query_mod[0]->captain_data_visib;
			$captain_data_obb=$query_mod[0]->captain_data_obb;
			$captain_cell_visib=$query_mod[0]->captain_cell_visib;
			$captain_cell_obb=$query_mod[0]->captain_cell_obb;
			$captain_email_visib=$query_mod[0]->captain_email_visib;
			$captain_email_obb=$query_mod[0]->captain_email_obb;
			$captain_license_visib=$query_mod[0]->captain_license_visib;
			$captain_license_obb=$query_mod[0]->captain_license_obb;
			$helmsman_check=$query_mod[0]->helmsman;
			$tactician_check=$query_mod[0]->tactician;
			$support_boat=$query_mod[0]->support_boat;
			$press_info=$query_mod[0]->press_info;
			$partecipation=$query_mod[0]->partecipation;
			$professional_crew_check=$query_mod[0]->professional_crew;
			$owner_name_check=$query_mod[0]->owner_name;
			$owner_name_valore=$query_mod[0]->owner_name_valore;
			$owner_data_visib=$query_mod[0]->owner_data_visib;
			$owner_data_obb=$query_mod[0]->owner_data_obb;
			$owner_cell_visib=$query_mod[0]->owner_cell_visib;
			$owner_cell_obb=$query_mod[0]->owner_cell_obb;
			$owner_email_visib=$query_mod[0]->owner_email_visib;
			$owner_email_obb=$query_mod[0]->owner_email_obb;
			$owner_license_visib=$query_mod[0]->owner_license_visib;
			$owner_license_obb=$query_mod[0]->owner_license_obb;
			$pagamenti=$query_mod[0]->pagamenti;
			$pagamenti_testo_ita=$query_mod[0]->pagamenti_testo_ita;
			$pagamenti_testo_eng=$query_mod[0]->pagamenti_testo_eng;
			$allegati=$query_mod[0]->allegati;
			$equipaggio=$query_mod[0]->equipaggio;
			//$dichiarazione_tesseramento_equipaggio=$query_mod[0]->dichiarazione_tesseramento_equipaggio;
			$dichiarazione_tesseramento_equipaggio="";
			$data_team=$query_mod[0]->data_team;
			$disclaimer=$query_mod[0]->disclaimer;
			$disclaimer_visib=$query_mod[0]->disclaimer_visib;
			$testo_privacy_ita=$query_mod[0]->testo_privacy_ita;
			$testo_privacy_eng=$query_mod[0]->testo_privacy_eng;
			$intestazione_mail=$query_mod[0]->intestazione_mail;
			$avviso=$query_mod[0]->avviso;
			$testo=$query_mod[0]->testo;
			$testo_eng=$query_mod[0]->testo_eng;
			$visibilita=$query_mod[0]->visibilita;
			
		@endphp	
		@if($modulo_iscrizioni==1 && $visibilita==1)
			@php		
				$prezzo_1=$query_mod[0]->prezzo_1; 
				$descrizione_prezzo_1=$query_mod[0]->descrizione_prezzo_1;
				$prezzo_2=$query_mod[0]->prezzo_2; 
				$descrizione_prezzo_2=$query_mod[0]->descrizione_prezzo_2;
				$prezzo_3=$query_mod[0]->prezzo_3; 
				$descrizione_prezzo_3=$query_mod[0]->descrizione_prezzo_3;
				$prezzo_4=$query_mod[0]->prezzo_4; 
				$descrizione_prezzo_4=$query_mod[0]->descrizione_prezzo_4;
				$prezzo_5=$query_mod[0]->prezzo_5; 
				$descrizione_prezzo_5=$query_mod[0]->descrizione_prezzo_5;
				$prezzo_6=$query_mod[0]->prezzo_6; 
				$descrizione_prezzo_6=$query_mod[0]->descrizione_prezzo_6;
				$prezzo_7=$query_mod[0]->prezzo_7; 
				$descrizione_prezzo_7=$query_mod[0]->descrizione_prezzo_7;
				$prezzo_8=$query_mod[0]->prezzo_8; 
				$descrizione_prezzo_8=$query_mod[0]->descrizione_prezzo_8;
				$prezzo_9=$query_mod[0]->prezzo_9;
				$descrizione_prezzo_9=$query_mod[0]->descrizione_prezzo_9;
				$prezzo_10=$query_mod[0]->prezzo_10; 
				$descrizione_prezzo_10=$query_mod[0]->descrizione_prezzo_10;
				$sconto=$query_mod[0]->sconto; 
				$valore_sconto=$query_mod[0]->valore_sconto;
	
				//SCONTI SPECIALI
				$text_under_price="";
				$stringa_js1="";
				$stringa_js2="";
				if($id_dett==270){ //NOME ED EDIZIONE REGATA
					if(date("Y-m-d")<="2019-02-28"){
						$text_under_price='<span style="font-size:0.8em"><i>30% discount for entries received by 28 February 2019</i></span>';
						$stringa_js1="
							if($('input[name=\"members_of\"]:checked').val()!='YCCS'){
								document.getElementById('text_under_price').style.display='block';
							}else{
								document.getElementById('text_under_price').style.display='none';
							}
						";
						$stringa_js2="
							if($('input[name=\"members_of\"]:checked').val()!='YCCS'){
								pz = pz - ((pz/100)*30);
							}
						";
					}
				}
				
				//RECUPERO DATI DA PRECEDENTE ISCRIZIONE
				if(isset($query_isc)){					
					foreach($query_isc as $key => $value) {
						
						$$key = $value;
						if($key=="captain_cell"){
							$temp=explode(" ",$value);
							$captain_cell_prefix = $temp[0];
							$captain_cell="";
							for($i=1; $i<count($temp); $i++){
								$captain_cell.=" ".$temp[$i];
							}
						}						
					}
				}
			@endphp
			<section class="content" style="margin-top:30px; padding-bottom:0; background:#fff">
				<div class="container"> 
					<a href="<?php if($lingua=="eng"){?>en/<?php }?><?php echo $link_back;?>"><div style="width:300px; margin:0 auto; padding:10px 0; border:solid 1px #<?php echo $colore_testo;?>; color:#<?php echo $colore_testo;?>; text-align:center; margin-top:-25px; margin-bottom:30px"><b><?php if($lingua=="ita"){?>TORNA ALLA HOME REGATA<?php }else{?>BACK TO REGATTA<?php }?></b></div></a>		  	  				 
				</div>
			</section>
			<section class="content" style="padding:20px; background:#fff" id="printArea">
				<div style="width:100%; text-align:center; display:none" id="logo_stampa">
					<img src="resarea/img_up/regate/<?php echo $logo_edizione;?>" alt="" style="width:100px; border:solid 1px; margin-bottom:20px;"/>
				</div>
				
				<div class="container" style="color:#111;font-weight:600;">
					
						<div class="titoliBox2" style="margin-bottom:20px; text-align:center;">
							<h1 style="line-height:35px">
								<?php echo $nome_regata;?><br/>
								<span style="font-size:0.6em"><?php echo $luogo;?>, <?php if($lingua=="ita"){?>dal<?php }else{?>from<?php }?> <?php echo $data_dal;?> <?php if($lingua=="ita"){?>al<?php }else{?>to<?php }?> <?php echo $data_al;?></span>
							</h1>
						</div>
						<div class="titoliBox2" style="margin-bottom:10px; text-align:center;"><h3><?php if($lingua=="ita"){?><?php echo $testo_modulo_ita;?><?php }else{?><?php echo $testo_modulo_eng;?><?php }?></h3></div>
						
						@if(isset($message) && $message!="")
							<script>
								alert('{{ $message }}');
							</script>
						@endif
						@if($recupero=="inviato")
							
						@endif
						
						@if($recuperopassword=="inviato")
						
						@endif
						
						@if($stato=="inviato")
							<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="margin-bottom:40px; text-align:center; background:#81c868">								
								@if($lingua=="ita")
									Grazie per la sua richiesta di iscrizione<br/>
									A breve riceverà una mail con un link che dovrà seguire per completare la richiesta
								@else
									Thanks for your request<br/>
									Shortly you will receive an email with a link that will have to follow to complete the request
								@endif
							</div>
							<script language="javascript" type="text/JavaScript"> 
								function loc(){
									window.location = "{{ config('app.url') }}/<?php if($lingua=="eng"){?>en/<?php }?><?php echo $link_back;?>";
								}
							</script>
						@else
							<style>
								.form-group label:not(.error) {
									color:#111; font-weight:600;
								}
								.form-control {background-color:#F2F2F2}
								label{font-weight:800;}
							</style>						
							@if($testo && trim($testo!="") && $lingua=="ita")
								<div style="text-align:center;"><p><?php echo $testo;?></p></div>
							@endif
							@if($testo_eng && trim($testo_eng!="") && $lingua=="eng")
								<div style="text-align:center;"><p style="text-align:center;"><?php echo $testo_eng;?></p>	</div>
							@endif
							
							@if($avviso && trim($avviso!=""))
								<hr>
								<p style="text-align:center;">
									<strong>
										<?php echo $avviso;?>
									</strong>
								</p>
								<hr>
							@endif
							
							<div class="row" style="padding:10px 0; margin-top:20px;">
								<div class="col-md-12">
									<div id="recuperaDati">
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-8 col-md-offset-2" style="border:solid 1px #cfcfcf; margin-bottom:20px;">
												<div style="padding:10px;">
													<div><?php if($lingua=="ita"){?>Se vuoi recuperare i dati da una precedente iscrizione inserisci<?php }else{?>If you want to recover the data from a previous inscription enter the following data<?php }?>:</div>
													<form method="post" action="{{ url()->full() }}" class="form-validate" id="recoverRequest" name="recoverRequest" autocomplete="off">
														@csrf
														{!! Form::hidden('recupero', 'inviato')!!}													
														<div class="row" style="margin-top:10px;">
															<div class="col-md-4">
																<div class="form-group">
																	<label class="upper" for="name">Email</label>
																	<input type="text" class="form-control required" name="email" value=""  aria-required="true">
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label class="upper" for="name">Password</label>
																	<input type="password" class="form-control required" name="password" value=""  aria-required="true">
																	<div style="text-align:right; font-size:0.8em; cursor:pointer;" onclick="document.getElementById('recuperaDati').style.display='none'; document.getElementById('recuperoPassword').style.display='block';"><?php if($lingua=="ita"){?>Recupera Password<?php }else{?>Recover Password<?php }?></div>
																</div>
															</div>										
															<div class="col-md-4">
																<div class="form-group text-center">
																	<label class="upper" for="name">&nbsp;</label>
																	<button class="btn btn-primary" type="button" onclick="checkRecoverForm()"><?php if($lingua=="ita"){?>RECUPERA DATI<?php }else{?>SUBMIT<?php }?></button>
																</div>
															</div>
														</div>
													</form>
													<script type="text/javascript">
														Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
														function checkRecoverForm(){
															if (document.recoverRequest.email.value=="") alert('<?php if($lingua=="eng"){?>"Email" required<?php } else {?>Campo "Email" obbligatorio<?php }?>');			
															else if (Filtro.test(document.recoverRequest.email.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
															else if (document.recoverRequest.password.value=="") alert('<?php if($lingua=="eng"){?>"Password" required<?php } else {?>Campo "Password" obbligatorio<?php }?>');
															else document.recoverRequest.submit();
														}
													</script>
												</div>
											</div>
										</div>
									</div>
									<div  style="display:none" id="recuperoPassword">
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-8 col-md-offset-2" style="border:solid 1px #cfcfcf; margin-bottom:20px;">
												<div style="padding:10px;">
													<div>
													<b>RECUPERA PASSWORD</b><br/>
													Se hai dimenticato la password per inserire automaticamente i dati da una precedente iscrizione inserisci il tuo indirizzo email e ti invieremo la procedura per impostarne una nuova:</div>
													<form method="post" action="{{ url()->full() }}" class="form-validate" id="recoverPassword" name="recoverPassword" autocomplete="off">
														@csrf
														{!! Form::hidden('recuperopassword', 'inviato')!!}
														<div class="row" style="margin-top:10px;">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="upper" for="name">Email</label>
																	<input type="text" class="form-control required" name="email" value=""  aria-required="true">
																</div>
															</div>										
															<div class="col-md-3">
																<div class="form-group text-center">
																	<label class="upper" for="name">&nbsp;</label>
																	<button class="btn btn-primary" type="button" style="background:#1c5cb9" onclick="checkRecoverPassword()"><?php if($lingua=="ita"){?>INVIA<?php }else{?>SUBMIT<?php }?></button>
																</div>
															</div>									
															<div class="col-md-3">
																<div class="form-group text-center">
																	<label class="upper" for="name">&nbsp;</label>
																	<button class="btn btn-danger" type="button"  onclick="document.getElementById('recuperoPassword').style.display='none'; document.getElementById('recuperaDati').style.display='block';"><?php if($lingua=="ita"){?>CANCELLA<?php }else{?>CANCEL<?php }?></button>
																</div>
															</div>
														</div>
													</form>
													<script type="text/javascript">
														Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
														function checkRecoverPassword(){
															if (document.recoverPassword.email.value=="") alert('<?php if($lingua=="eng"){?>"Email" required<?php } else {?>Campo "Email" obbligatorio<?php }?>');			
															else if (Filtro.test(document.recoverPassword.email.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
															else document.recoverPassword.submit();
														}
													</script>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
				
				
					<div class="footer-content" style="display:none" id="loghi_stampa">
						<div class="container" >
							<div class="row" style="text-align:center; padding:20px 0">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div style="position:relative; text-align:center; margin:0 auto;" id="partnerUfficiali">
										<img src="web/images/new/loghi.jpg" alt="" style="width:100%;"/>					
										<div style="position:absolute; top:0; left:0; width:30%; height:100%;">
											<img src="web/images/new/blank.png" style="width:100%; height:100%;" alt="Rolex"/>
										</div>
										<div style="position:absolute; top:0; left:30%; width:40%; height:100%;">
											<img src="web/images/new/blank.png" style="width:100%; height:100%;" alt="One Ocean"/>
										</div>
										<div style="position:absolute; top:0; left:70%; width:30%; height:100%;">
											<img src="web/images/new/blank.png" style="width:100%; height:100%;" alt="Audi"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<form method="post" action="{{ url()->full() }}" class="form-validate" id="sendRequest" name="sendRequest" enctype="multipart/form-data" autocomplete="off" onsubmit="return checkForm(this);">
						@csrf
						{!! Form::hidden('stato', 'inviato')!!}
						
						<?php if($membri==1){
							$valori=explode(",",$membri_valori);									
							?>
							<div class="row" style="padding:10px 0;">
								<div style="float:left; width:200px; margin-left:15px; line-height:20px;">
									<label class="upper">Members of<?php if(count($valori)>1){?>*<?php }?>:</label>
									<div id="annullaRadio" style="width:80px; text-align:center; background:#333; color:#fff; <?php if(!isset($members_of) || $members_of==""){?>display:none;<?php }?> border-radius:2px; cursor:pointer;" onclick="cancellaRadio();">
										<div style="padding:2px;"><?php if($lingua=="ita"){?>annulla<?php }else{?>cancel<?php }?></div>
									</div>
								</div>
								<?php 
								for($i=0; $i<count($valori); $i++){
									if(trim($valori[$i])!=""){
										$val = strtoupper(trim($valori[$i]));?>
										<div style="float:left; width:230px; margin-left:20px;">
											<div style="float:left; margin-top:2px;"><input type="radio" name="members_of" <?php if(count($valori)>1){?>required="required"<?php }?> value="<?php echo $val;?>" <?php if(isset($members_of) && $members_of==$val){?>checked="checked"<?php }?> onclick="document.getElementById('annullaRadio').style.display='block'; calcolaPrezzo();document.getElementById('sconto_membri').style.display='<?php if($val=="YCCS"){?>block<?php }else{?>none<?php }?>';"></div>
											<div style="float:left; margin-left:10px;"><?php echo $val;?></div>
											<div style="clear:both;"></div>
										</div>
									<?php }?>
								<?php }?>
								
								<script>
									function cancellaRadio(){
										$('input[name="members_of"]').prop('checked',false);
										document.getElementById('annullaRadio').style.display='none';
										document.getElementById('sconto_membri').style.display='none';
										calcolaPrezzo();
									}
								</script>
							</div>
						<?php }?>
						
						<?php if(isset($categorie_check) && $categorie_check==1){?>
							<div class="row" style="padding:10px 0;">
								<div style="float:left; width:200px; margin-left:15px;">
									<label class="upper">Categories*:</label>
								</div>
								<div style="float:left; width:230px; margin-left:20px;">
									<div style="float:left; margin-top:2px;"><input type="radio" name="categorie_valori" required="required" value="Racing Entry" <?php if(isset($categories) && $categories=="Racing Entry"){?>checked="checked"<?php }?>></div>
									<div style="float:left;margin-left:10px;">Racing Entry</div>
									<div style="clear:both;"></div>
								</div>
								<div style="float:left; width:230px; margin-left:20px;">
									<div style="float:left; margin-top:2px;"><input type="radio" name="categorie_valori" required="required" value="Not Racing Entry" <?php if(isset($categories) && $$categories=="Not Racing Entry"){?>checked="checked"<?php }?>></div>
									<div style="float:left; margin-left:10px;">
										<span  data-toggle="tooltip" data-placement="top" title="ONLY for yachts wishing to participate in the social events but NOT in the racing programme">Not Racing Entry</span> <i class="fa fa-question-circle-o" aria-hidden="true" style="cursor:pointer;" data-container="body" data-toggle="popover" data-placement="top" title="" data-content="ONLY for yachts wishing to participate in the social events but NOT in the racing programme."></i>
									</div>
									<div style="clear:both;"></div>
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($maxi_select) && $maxi_select==1){?>
							<div class="row" style="padding:10px 0;">
								<div style="float:left; width:200px; margin-left:15px;">
									<label class="upper">Supermaxi's up to LH 35,5m<br/>(NoR 3.1 / 3.2 and 11.2)*:</label>
								</div>
								<div style="float:left; width:230px; margin-left:20px;">
									<div style="float:left; margin-top:2px;"><input type="radio" name="maxi"  required="required" value="SUPERMAXI start / ORCsy cert" <?php if(isset($maxi) && $maxi=="SUPERMAXI start / ORCsy cert"){?>checked="checked"<?php }?>></div>
									<div style="float:left;margin-left:10px;">SUPERMAXI start / ORCsy cert</div>
									<div style="clear:both;"></div>
								</div>
								<div style="float:left; width:230px; margin-left:20px;">
									<div style="float:left; margin-top:2px;"><input type="radio" name="maxi"  required="required" value="MAXI RACER start / IRC cert" <?php if(isset($maxi) && $maxi=="MAXI RACER start / IRC cert"){?>checked="checked"<?php }?>></div>
									<div style="float:left;margin-left:10px;">MAXI RACER start / IRC cert</div>
									<div style="clear:both;"></div>
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($boat_details) && $boat_details==1){?>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Boat Name<?php }else{?>Boat Name<?php }?>*</label>
										<input type="text" class="form-control required" name="boat_name" required="required" value="<?php if(isset($boat_name)) echo $boat_name;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Sail N.<?php }else{?>Sail N.<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="sail_n" value="<?php if(isset($sail_n)) echo $sail_n;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>L.H.<?php }else{?>L.H.<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="lh" value="<?php if(isset($lh)) echo $lh;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Beam<?php }else{?>Beam<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="beam" value="<?php if(isset($beam)) echo $beam;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Min Draft<?php }else{?>Min Draft<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="min_draft" value="<?php if(isset($min_draft)) echo $min_draft;?>">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Model<?php }else{?>Model<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="model" value="<?php if(isset($model)) echo $model;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Designer<?php }else{?>Designer<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="designer" value="<?php if(isset($designer)) echo $designer;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Builder<?php }else{?>Builder<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="builder" value="<?php if(isset($builder)) echo $builder;?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Boat Advertising (if any)<?php }else{?>Boat Advertising (if any)<?php }?></label>
										<input type="text" class="form-control" name="boat_advertising" value="<?php if(isset($boat_advertising)) echo $boat_advertising;?>">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Flag<?php }else{?>Flag<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="flag" value="<?php if(isset($flag)) echo $flag;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>N. of Crew<?php }else{?>N. of Crew<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="n_of_crew" value="<?php if(isset($n_of_crew)) echo $n_of_crew;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>E.T.A.<?php }else{?>E.T.A.<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="eta" value="<?php if(isset($eta)) echo $eta;?>">
									</div>
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($yacht_club_check) && $yacht_club_check==1){?>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?><?php echo $yacht_club_valore;?><?php }else{?><?php if(isset($yacht_club_valore)) echo $yacht_club_valore;?><?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="yacht_club" value="<?php if(isset($yacht_club)) echo $yacht_club;?>">
									</div>
								</div>
								<?php if($yacht_club_valore2_visib=='1'){?>
									<div class="col-md-4">
										<div class="form-group">
											<label class="upper"><?php if($lingua=="ita"){?><?php if(isset($yacht_club_valore2)) echo $yacht_club_valore2;?><?php }else{?><?php if(isset($yacht_club_valore2)) echo $yacht_club_valore2;?><?php }?>*</label>
											<input type="text" class="form-control required" required="required" name="home_port" value="<?php if(isset($home_port)) echo $home_port;?>">
										</div>
									</div>
								<?php }?>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Country<?php }else{?>Country<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="country" value="<?php if(isset($country)) echo $country;?>">
									</div>
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($charterer_check) && $charterer_check==1){?>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Charterer/Owner<?php }else{?>Charterer/Owner<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="charterer" value="<?php if(isset($charterer)) echo $charterer;?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Address<?php }else{?>Address<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="charterer_address" value="<?php if(isset($charterer_address)) echo $charterer_address;?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>City<?php }else{?>City<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="charterer_city" value="<?php if(isset($charterer_city)) echo $charterer_city;?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Country<?php }else{?>Country<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="charterer_country" value="<?php if(isset($charterer_country)) echo $charterer_country;?>">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Fax<?php }else{?>Fax<?php }?></label>
										<input type="text" class="form-control" name="charterer_fax" value="<?php if(isset($charterer_fax)) echo $charterer_fax;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Email<?php }else{?>Email<?php }?>*</label>
										<input type="email" class="form-control required" required="required" name="charterer_email" value="<?php if(isset($charterer_email)) echo $charterer_email;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Tel on Site<?php }else{?>Tel on Site<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="charterer_tel" value="<?php if(isset($charterer_tel)) echo $charterer_tel;?>">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<strong>IMPERATIVE</strong>: Contact details to be reached ON - SITE for any daily communication from the O.A.
									</div>
								</div>
							</div>								
						<?php }?>
						
						<?php if(isset($captain) && $captain==1){?>
							<div class="row" style="padding:10px; border:solid 1px #F1F1F1; margin-top:20px;">
								<div class="col-md-6">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?><?php if(isset($captain_valore)) echo $captain_valore;?><?php }else{?><?php if(isset($captain_valore)) echo $captain_valore;?><?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="boat_captain" value="<?php if(isset($boat_captain)) echo $boat_captain;?>">
									</div>
								</div>
								<?php if($captain_data_visib==1){?>
									<div class="col-md-2">
										<div class="form-group">
											<label class="upper"><?php if($lingua=="ita"){?>Birth Date<?php }else{?>Birth Date<?php }?><?php if($captain_data_obb==1){?>*<?php }?></label>
											<input type="text" class="form-control mws-datepicker required" <?php if(isset($captain_data_obb) && $captain_data_obb==1){?>required="required<?php }?>"  name="captain_birth_data" id="captain_birth_data" value="<?php if(isset($captain_birth_data)) echo $captain_birth_data;?>">
										</div>
									</div>
								<?php }?>
								<div style="clear:both"></div>
								<?php if($captain_cell_visib==1){?>
									<div class="col-md-4">
										<div class="form-group">
											<label class="upper"><?php if($lingua=="ita"){?>Mobile<?php }else{?>Mobile<?php }?><?php if(isset($captain_cell_obb) && $captain_cell_obb==1){?>*<?php }?></label>
											<div style="float:left; width:160px; height:30px;">
												<select style="width:100%;"  class="form-control required" <?php if($captain_cell_obb==1){?>required="required"<?php }?> name="captain_cell_prefix">
													<option value=""></option>
													@php
														$query_prefix = DB::table('dialing_codes');
														$query_prefix = $query_prefix->select('*');
														$query_prefix = $query_prefix->orderby('ordine', 'DESC');
														$query_prefix = $query_prefix->orderby('Country', 'ASC');
														$query_prefix = $query_prefix->get();
													@endphp
													@foreach($query_prefix AS $key_prefix=>$value_prefix)
														@foreach($value_prefix AS $key_risu=>$value_risu)
															@php
																$risu_prefix[$key_risu]=$value_risu;
															@endphp
														@endforeach
														<option value="<?php echo $risu_prefix['Code'];?>" <?php if(isset($captain_cell_prefix) && $captain_cell_prefix==$risu_prefix['Code']){?>selected="selected"<?php }?>><?php echo $risu_prefix['Country'];?> (<?php echo $risu_prefix['Code'];?>)</option>
														@if($risu_prefix['ordine']==1)
															<option value="">-------------------------</option>
														@endif
													@endforeach
												</select>
											</div>
											<div style="float:left; width: -webkit-calc(100% - 170px); width:-moz-calc(100% - 170px); width:calc(100% - 170px); margin-left:10px;">
												<input type="text" class="form-control required" <?php if($captain_cell_obb==1){?>required="required"<?php }?> name="captain_cell" style="width:100%;" value="<?php if(isset($captain_cell)) echo $captain_cell;?>">
											</div>
											<div style="clear:both"></div>
										</div>
									</div>
								<?php }?>
								<?php if($captain_email_visib==1){?>
									<div class="col-md-4">
										<div class="form-group">
											<label class="upper"><?php if($lingua=="ita"){?>Email<?php }else{?>Email<?php }?><?php if($captain_email_obb==1){?>*<?php }?></label>
											<input type="email" class="form-control required" <?php if($captain_email_obb==1){?>required="required"<?php }?> name="captain_email" value="<?php if(isset($captain_email)) echo $captain_email;?>">
										</div>
									</div>
								<?php }?>										
									
								<?php if($captain_license_visib==1){?>
									<div style="clear:both"></div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="upper">Nautical Driving License<?php if($captain_license_obb==1){?>*<?php }?>:</label>
											
											<div style="margin-top:10px;">
												<div style="float:left;">
													<div style="float:left; margin-top:2px;">
														<input type="radio" name="captain_nautical_driving_license" <?php if($captain_license_obb==1){?>required="required"<?php }?> value="Yes" <?php if(isset($captain_nautical_driving_license) && $captain_nautical_driving_license=="Yes"){?>checked="checked"<?php }?> onclick="document.getElementById('annullaCaptainRadioLicense').style.display='block';document.getElementById('boxCaptainLicenseAtt').style.display='block'; $('#captain_nautical_driving_license_att').prop('required', true);">
													</div>
													<div style="float:left; margin-left:10px;">Yes</div>
													<div style="clear:both;"></div>
												</div>
												<div style="float:left; margin-left:20px;">
													<div style="float:left; margin-top:2px;">
														<input type="radio" name="captain_nautical_driving_license" <?php if($captain_license_obb==1){?>required="required"<?php }?> value="No" <?php if(isset($captain_nautical_driving_license) && $captain_nautical_driving_license=="No"){?>checked="checked"<?php }?> onclick="document.getElementById('annullaCaptainRadioLicense').style.display='block';document.getElementById('boxCaptainLicenseAtt').style.display='none'; $('#captain_nautical_driving_license_att').removeAttr('required');">
													</div>
													<div style="float:left; margin-left:10px;">No</div>
													<div style="clear:both;"></div>
												</div>
												<div style="float:left; margin-left:20px;">
													<div id="annullaCaptainRadioLicense" style="width:80px; text-align:center; background:#333; color:#fff; <?php if(!isset($captain_nautical_driving_license) || $captain_nautical_driving_license==""){?>display:none;<?php }?> border-radius:2px; cursor:pointer;" onclick="cancellaCaptainRadioLicense();">
														<div style="padding:2px;"><?php if($lingua=="ita"){?>annulla<?php }else{?>cancel<?php }?></div>
													</div>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>
										
										<script>
											function cancellaCaptainRadioLicense(){
												$('input[name="captain_nautical_driving_license"]').prop('checked', false);
												document.getElementById('annullaCaptainRadioLicense').style.display='none';		
												document.getElementById('boxCaptainLicenseAtt').style.display='none';														
											}
										</script>
									</div>
									<div class="col-md-4">
										<div class="form-group" style="display:none;" id="boxCaptainLicenseAtt">
											<label>if yes, must be attached</label>													
											<div style="margin-top:10px;">
												<input type="file" name="captain_nautical_driving_license_att" id="captain_nautical_driving_license_att"/>
											</div>
										</div>
									</div>
									<div style="clear:both"></div>
								<?php }?>							
							</div>
						<?php }?>
						
						<?php if(isset($tipo_barca) && $tipo_barca==1){
							$valori=explode(",",$tipo_barca_valori);									
							?>
							<div class="row" style="padding:10px 0;">
								<div style="float:left; width:200px; margin-left:15px; line-height:20px;">
									<label class="upper">Type of boat requested<?php if(count($valori)>1){?>*<?php }?>:</label>
									<div id="annullaRadioTipoBarca" style="width:80px; text-align:center; background:#333; color:#fff; <?php if(!isset($type_of_boat) || $type_of_boat==""){?>display:none;<?php }?> border-radius:2px; cursor:pointer;" onclick="cancellaRadioBarca();">
										<div style="padding:2px;"><?php if($lingua=="ita"){?>annulla<?php }else{?>cancel<?php }?></div>
									</div>
								</div>
								<?php 
								for($i=0; $i<count($valori); $i++){
									if(trim($valori[$i])!=""){
										$val = strtoupper(trim($valori[$i]));?>
										<div style="float:left; width:230px; margin-left:20px;">
											<div style="float:left; margin-top:2px;"><input type="radio" name="type_of_boat" <?php if(count($valori)>1){?>required="required"<?php }?> value="<?php echo $val;?>" <?php if(isset($type_of_boat) && $type_of_boat==$val){?>checked="checked"<?php }?> onclick="document.getElementById('annullaRadioTipoBarca').style.display='block';"></div>
											<div style="float:left; margin-left:10px;"><?php echo $val;?></div>
											<div style="clear:both;"></div>
										</div>
									<?php }?>
								<?php }?>
								
								<script>
									function cancellaRadioBarca(){
										$('input[name="type_of_boat"]').prop('checked', false);
										document.getElementById('annullaRadioTipoBarca').style.display='none';
									}
								</script>
							</div>
						<?php }?>
						
						<?php if(isset($helmsman_check) && $helmsman_check==1){?>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Helmsman<?php }else{?>Helmsman<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="helmsman" value="<?php if(isset($helmsman)) echo $helmsman;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Country<?php }else{?>Country<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="helmsman_country" value="<?php if(isset($helmsman_country)) echo $helmsman_country;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Email<?php }else{?>Email<?php }?>*</label>
										<input type="email" class="form-control required" required="required" name="helmsman_email" value="<?php if(isset($helmsman_email)) echo $helmsman_email;?>">
									</div>
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($tactician_check) && $tactician_check==1){?>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Tactician<?php }else{?>Tactician<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="tactician" value="<?php if(isset($tactician)) echo $tactician;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Country<?php }else{?>Country<?php }?>*</label>
										<input type="text" class="form-control required" required="required" name="tactician_country" value="<?php if(isset($tactician_country)) echo $tactician_country;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Email<?php }else{?>Email<?php }?>*</label>
										<input type="email" class="form-control required" required="required" name="tactician_email" value="<?php if(isset($tactician_email)) echo $tactician_email;?>">
									</div>
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($support_boat) && $support_boat==1){?>
							<div style="margin-top:20px;"> 
								<?php if($lingua=="ita"){?><strong style="font-weight:800">SUPPORT BOAT</strong> (if any)<?php }else{?><strong style="font-weight:800">SUPPORT BOAT</strong> (if any)<?php }?>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Boat Name<?php }else{?>Boat Name<?php }?></label>
										<input type="text" class="form-control required" name="support_boat_name" value="<?php if(isset($support_boat_name)) echo $support_boat_name;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>LOA<?php }else{?>LOA<?php }?></label>
										<input type="text" class="form-control required" name="support_boat_loa" value="<?php if(isset($support_boat_loa)) echo $support_boat_loa;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>BEAM<?php }else{?>BEAM<?php }?></label>
										<input type="text" class="form-control required" name="support_boat_beam" value="<?php if(isset($support_boat_beam)) echo $support_boat_beam;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>DRAFT<?php }else{?>DRAFT<?php }?></label>
										<input type="text" class="form-control required" name="support_boat_draft" value="<?php if(isset($support_boat_draft)) echo $support_boat_draft;?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>ETA<?php }else{?>ETA<?php }?></label>
										<input type="text" class="form-control required" name="support_boat_eta" value="<?php if(isset($support_boat_eta)) echo $support_boat_eta;?>">
									</div>
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($press_info) && $press_info==1){?>
							<div style="margin-top:20px;"> 
								<?php if($lingua=="ita"){?><strong style="font-weight:800">PRESS INFOS</strong><?php }else{?><strong style="font-weight:800">PRESS INFOS</strong><?php }?>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Press Representative (for internal use only)<?php }else{?>Press Representative (for internal use only)<?php }?></label>
										<input type="text" class="form-control required" name="press_representative" value="<?php if(isset($press_representative)) echo $press_representative;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Tel. on site<?php }else{?>Tel. on site<?php }?></label>
										<input type="text" class="form-control required" name="press_representative_tel" value="<?php if(isset($press_representative_tel)) echo $press_representative_tel;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Email<?php }else{?>Email<?php }?></label>
										<input type="text" class="form-control required" name="press_representative_email" value="<?php if(isset($press_representative_email)) echo $press_representative_email;?>">
									</div>
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($partecipation) && $partecipation==1){?>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Significant regatta partecipation / victories<?php }else{?>Press Representative (for internal use only)<?php }?></label>
										<textarea class="form-control required" name="significant_partecipation" rows="9"><?php if(isset($significant_partecipation)) echo $significant_partecipation;?></textarea>
									</div>
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($professional_crew_check) && $professional_crew_check==1){?>	
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Professional Crew on board and roles<?php }else{?>Professional Crew on board and roles<?php }?></label>
										<textarea class="form-control required" name="professional_crew" rows="9"><?php if(isset($professional_crew)) echo $professional_crew;?></textarea>
									</div>
								</div>
							</div>
						<?php }?>
														
						<?php if(isset($data_team) && $data_team==1){?>
							<div class="row"  style=" margin-top:20px;">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Data arrivo del team <?php }else{?>Team ETA Estimated time of arrival <?php }?></label>
										<input type="text" style="width:150px;" readonly="readonly" onclick="this.removeAttribute('readonly');" class="form-control mws-datepicker3"  name="data_team_value" id="data_team_value" value="<?php if(isset($data_team_value)) echo $data_team_value;?>">
									</div>
								</div>
								<div class="col-md-2">	
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Ora<?php }else{?>Hour<?php }?></label>
										<select name="data_team_hours_value" id="data_team_hours_value" style="height:40px; padding:10px;" onchange="calcolaPrezzo()">											
											<option selected="selected"></option>
											<?php for ( $hours = 0 ; $hours <= 23 ; $hours++ ){
												if($hours<10) $hours="0".$hours;
												for ( $minutes = 0 ; $minutes <= 45 ; $minutes += 15 ){ 
													?>
													<option value="<?php  echo $hours.':'.$minutes.':00';?>" <?php if(isset($data_team_hours_value) && $data_team_hours_value==$hours.':'.$minutes.':00'){?>selected="selected"<?php }?>>
														<?php  
														if($minutes<10) $minutes="0".$minutes;
														echo $hours.':'.$minutes; 
														?>
													</option>   
												<?php }
											}?>  
										</select>
									</div>											
								</div>
							</div>
						<?php }?>
						
						<?php if(isset($equipaggio) && $equipaggio==1){?>
							<style>
								.tabMob{display:none; width:100%; text-align:left;}
								.eqCol1{float:left; width:3%; text-align:center;}
								.eqCol2{float:left; width:30%; text-align:left;}
								.eqCol3{float:left; width:30%; text-align:left;}
								.eqCol4{float:left; width:25%; text-align:left;}
								.eqCol5{float:left; width:12%; text-align:left;}
								
								@media screen and (max-width:600px){
									#eqHead{display:none;}
									.tabMob{display:block;}
									.eqCol1{display:none;}
									.eqCol2{width:100%;}
									.eqCol3{width:100%;}
									.eqCol4{width:100%;}
									.eqCol5{width:100%;}
								}
							</style>
							<div  class="col-md-12">
								<div style="text-align:left; width:100%; margin-bottom:5px">
									<b>Crew list</b>
								</div>
								<div class="form-group">
									<div >
										<div id="eqHead">
											<div style="float:left; width:3%; text-align:center;"><div style="padding:5px"></div></div>
											<div style="float:left; width:30%; text-align:left;"><div style="padding:5px"><b><?php if($lingua=="ita"){?>Nome<?php }else{?>Name<?php }?></b></div></div>
											<div style="float:left; width:30%; text-align:left;"><div style="padding:5px"><b><?php if($lingua=="ita"){?>Cognome<?php }else{?>Surname<?php }?></b></div></div>
											<div style="float:left; width:25%; text-align:left;"><div style="padding:5px"><b><?php if($lingua=="ita"){?>Tessera FIV<?php }else{?>National Sailing Membership Card<?php }?></b></div></div>
											<div style="float:left; width:12%; text-align:left;"><div style="padding:5px"><b><?php if($lingua=="ita"){?>Taglia T-Shirt<?php }else{?>T-Shirt Size<?php }?></b></div></div>
											<div style="clear:both"></div>
										</div>
										<?php for($eq=1; $eq<=10; $eq++){?>												
											<div style="padding:5px 0px; background:<?php if ( $eq & 1 ) { ?>#F2F2F2<?php }else{?>#fff<?php }?>">
												<div class="eqCol1"><div style="padding:5px"><?php echo $eq;?></div></div>
												<div class="eqCol2">
													<div style="padding:5px">
														<div class="tabMob"><?php echo $eq;?>. <b><?php if($lingua=="ita"){?>Nome <?php if($eq==1){?>Skipper<?php }else{?>Membro<?php }?><?php }else{?><?php if($eq==1){?>Skipper<?php }else{?>Member's<?php }?> Name<?php }?></b></div>
														<input type="text" style="width:90%; padding:0 5px" name="member<?php echo $eq;?>_nome" value="" placeholder="<?php if($eq==1){?>Skipper<?php }else{?><?php if($lingua=="ita"){?>Membro<?php }else{?>Member<?php }?><?php }?>"/>
													</div>
												</div>
												<div class="eqCol3">
													<div style="padding:5px">
														<div class="tabMob"><?php echo $eq;?>. <b><?php if($lingua=="ita"){?>Cognome <?php if($eq==1){?>Skipper<?php }else{?>Membro<?php }?><?php }else{?><?php if($eq==1){?>Skipper<?php }else{?>Member's<?php }?> Surname<?php }?></b></div>
														<input type="text" style="width:90%; padding:0 5px" name="member<?php echo $eq;?>_cognome" value="" placeholder="<?php if($eq==1){?>Skipper<?php }else{?><?php if($lingua=="ita"){?>Membro<?php }else{?>Member<?php }?><?php }?>"/>
													</div>
												</div>
												<div class="eqCol4">
													<div style="padding:5px">
														<div class="tabMob"><?php echo $eq;?>. <b><?php if($lingua=="ita"){?>Tessera FIV <?php if($eq==1){?>Skipper<?php }else{?>Membro<?php }?><?php }else{?><?php if($eq==1){?>Skipper<?php }else{?>Member's<?php }?> National Sailing Membership Card<?php }?></b></div>
														<input type="text" style="width:90%; padding:0 5px" name="member<?php echo $eq;?>_tessera" value="" placeholder="<?php if($eq==1){?>Skipper<?php }else{?><?php if($lingua=="ita"){?>Membro<?php }else{?>Member<?php }?><?php }?>"/>
													</div>
												</div>
												<div class="eqCol5">
													<div style="padding:5px">
														<div class="tabMob"><?php echo $eq;?>. <b><?php if($lingua=="ita"){?>Taglia T-Shirt <?php if($eq==1){?>Skipper<?php }else{?>Membro<?php }?><?php }else{?><?php if($eq==1){?>Skipper<?php }else{?>Member's<?php }?> T-shirt Size<?php }?></b></div>
														<input type="text" style="width:90%; padding:0 5px" name="member<?php echo $eq;?>_taglia" value="" placeholder="<?php if($eq==1){?>Skipper<?php }else{?><?php if($lingua=="ita"){?>Membro<?php }else{?>Member<?php }?><?php }?>"/>
													</div>
												</div>
												<div style="clear:both;"></div>
											</div>												
										<?php }?>
										<div style="padding:10px 0;">
											<input type="hidden" id="dichiarazione_tesseramento_equipaggio" name="dichiarazione_tesseramento_equipaggio" value="<?php echo $dichiarazione_tesseramento_equipaggio;?>"/>
											<input type="checkbox" id="dichiarazione_tesseramento_equipaggio_check" name="dichiarazione_tesseramento_equipaggio_check"  onclick="dichiarazione_tesseramento();"/>
											&nbsp;&nbsp;<b>
												<?php if($lingua=="ita"){?>
													In qualit&agrave; di skipper dichiaro che tutti i membri dell'equipaggio sono regolarmente tesserati presso la propria autorit&agrave; nazionale.
												<?php }else{?>
													As skipper of the boat I hereby declare that all crew members are currently affiliated to their sailing national autorities.
												<?php }?>
											</b>
											<script>
												var dt = <?php if(isset($dichiarazione_tesseramento_equipaggio) && $dichiarazione_tesseramento_equipaggio!="") echo $dichiarazione_tesseramento_equipaggio; else echo '0'?>;
												function dichiarazione_tesseramento(){
													if(dt==0) dt=1; else dt=0;
													document.getElementById('dichiarazione_tesseramento_equipaggio').value=dt;
												}
											</script>
										</div>
									</div>								
								</div>								
							</div>
							<div style="clear:both"></div>
						<?php }?>
						
						<div class="row"  style="padding:10px; border:solid 1px #F1F1F1; margin-top:20px;">
							<div class="col-md-6">
								<div class="form-group">
									<label class="upper"><?php if($lingua=="ita"){?><?php echo $owner_name_valore;?><?php }else{?><?php echo $owner_name_valore;?><?php }?>*</label>
									<input type="text" class="form-control required" required="required" name="owner_name" value="<?php if(isset($owner_name)) echo $owner_name;?>">
								</div>
							</div>
							<?php if($owner_data_visib==1){?>
								<div class="col-md-2">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>Birth Date<?php }else{?>Birth Date<?php }?><?php if(isset($owner_data_obb) && $owner_data_obb==1){?>*<?php }?></label>
										<input type="text" class="form-control mws-datepicker2" <?php if(isset($owner_data_obb) && $owner_data_obb==1){?>required="required"<?php }?>  name="owner_birth_data" id="owner_birth_data" value="<?php if(isset($owner_birth_data)) echo $owner_birth_data;?>">
									
									</div>
								</div>
							<?php }?>
							<input type="hidden" name="data" value="<?php echo date('d-m-Y');?>">
							<div style="clear:both"></div>
							
							<?php if($owner_cell_visib==1){?>
									<div class="col-md-4">
										<div class="form-group">
											<label class="upper"><?php if($lingua=="ita"){?>Mobile<?php }else{?>Mobile<?php }?><?php if($owner_cell_obb==1){?>*<?php }?></label>
											<div style="float:left; width:160px; height:30px;">
												<select style="width:100%;"  class="form-control required" <?php if($owner_cell_obb==1){?>required="required"<?php }?> name="owner_cell_prefix">
													<option value=""></option>
													@php
														$query_prefix = DB::table('dialing_codes');
														$query_prefix = $query_prefix->select('*');
														$query_prefix = $query_prefix->orderby('ordine', 'DESC');
														$query_prefix = $query_prefix->orderby('Country', 'ASC');
														$query_prefix = $query_prefix->get();
													@endphp
													@foreach($query_prefix AS $key_prefix=>$value_prefix)
														@foreach($value_prefix AS $key_risu=>$value_risu)
															@php
																$risu_prefix[$key_risu]=$value_risu;
															@endphp
														@endforeach
														<option value="<?php echo $risu_prefix['Code'];?>" <?php if(isset($captain_cell_prefix) && $captain_cell_prefix==$risu_prefix['Code']){?>selected="selected"<?php }?>><?php echo $risu_prefix['Country'];?> (<?php echo $risu_prefix['Code'];?>)</option>
														@if($risu_prefix['ordine']==1)
															<option value="">-------------------------</option>
														@endif
													@endforeach
												</select>
											</div>
											<div style="float:left; width: -webkit-calc(100% - 170px); width:-moz-calc(100% - 170px); width:calc(100% - 170px); margin-left:10px;">
												<input type="text" class="form-control required" <?php if($owner_cell_obb==1){?>required="required"<?php }?> name="owner_cell" style="width:100%;" value="<?php if(isset($owner_cell)) echo $owner_cell;?>">
											</div>
											<div style="clear:both"></div>
										</div>
									</div>
								<?php }?>
								<?php if($owner_email_visib==1){?>
									<div class="col-md-4">
										<div class="form-group">
											<label class="upper"><?php if($lingua=="ita"){?>Email<?php }else{?>Email<?php }?><?php if($owner_email_obb==1){?>*<?php }?></label>
											<input type="email" class="form-control required" <?php if($owner_email_obb==1){?>required="required"<?php }?> name="owner_email" value="<?php if(isset($owner_email)) echo $owner_email;?>">
										</div>
									</div>
								<?php }?>										
									
								<?php if($owner_license_visib==1){?>
									<div style="clear:both"></div>							
									<div class="col-md-4">
										<div class="form-group">
											<label class="upper">Nautical Driving License<?php if($owner_license_obb==1){?>*<?php }?>:</label>
											
											<div style="margin-top:10px;">
												<div style="float:left;">
													<div style="float:left; margin-top:2px;">
														<input type="radio" name="owner_nautical_driving_license" <?php if($owner_license_obb==1){?>required="required"<?php }?> value="Yes" <?php if(isset($owner_nautical_driving_license) && $owner_nautical_driving_license=="Yes"){?>checked="checked"<?php }?> onclick="document.getElementById('annullaOwnerRadioLicense').style.display='block';document.getElementById('boxOwnerLicenseAtt').style.display='block'; $('#owner_nautical_driving_license_att').prop('required', true);">
													</div>
													<div style="float:left; margin-left:10px;">Yes</div>
													<div style="clear:both;"></div>
												</div>
												<div style="float:left; margin-left:20px;">
													<div style="float:left; margin-top:2px;">
														<input type="radio" name="owner_nautical_driving_license" <?php if($owner_license_obb==1){?>required="required"<?php }?> value="Yes" <?php if(isset($owner_nautical_driving_license) && $owner_nautical_driving_license=="No"){?>checked="checked"<?php }?> onclick="document.getElementById('annullaOwnerRadioLicense').style.display='block';document.getElementById('boxOwnerLicenseAtt').style.display='none'; $('#owner_nautical_driving_license_att').removeAttr('required');">
													</div>
													<div style="float:left; margin-left:10px;">No</div>
													<div style="clear:both;"></div>
												</div>
												<div style="float:left; margin-left:20px;">
													<div id="annullaOwnerRadioLicense" style="width:80px; text-align:center; background:#333; color:#fff; <?php if(!isset($owner_nautical_driving_license) || $owner_nautical_driving_license==""){?>display:none;<?php }?> border-radius:2px; cursor:pointer;" onclick="cancellaOwnerRadioLicense();">
														<div style="padding:2px;"><?php if($lingua=="ita"){?>annulla<?php }else{?>cancel<?php }?></div>
													</div>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>
										
									</div>
									<div class="col-md-4">
										<div class="form-group" style="display:none;" id="boxOwnerLicenseAtt">
											<label>if yes, must be attached</label>													
											<div style="margin-top:10px;">
												<input type="file" id="owner_nautical_driving_license_att" name="owner_nautical_driving_license_att"/>
											</div>
										</div>
									</div>
									<div style="clear:both"></div>	
									
									<script>
										function cancellaOwnerRadioLicense(){
											$('input[name="owner_nautical_driving_license"]').prop('checked', false);
											document.getElementById('annullaOwnerRadioLicense').style.display='none';
											document.getElementById('boxOwnerLicenseAtt').style.display='none';
										}
									</script>									
								<?php }?>
						</div>
						
						
						<?php if($pagamenti==1){?>
							<hr>
							<div class="row" style="margin-top:20px">
								<div class="col-md-4">
									<div style="float:left; margin-left:15px; ">
										<label class="upper">PRICE<?php if(!$prezzo_2 || $prezzo_2==""){?>*<?php }?>:</label>
									</div>
									<div style="float:left;margin-left:20px;">
										<?php if(!$prezzo_2 || $prezzo_2==""){?>
											<strong><?php echo $prezzo_1;?> &euro;</strong>
											<input type="hidden" name="prezzo" id="prezzo" value="<?php echo $prezzo_1;?>"/>
										<?php }else{?>
											<select name="prezzo" id="prezzo" style="margin-top:-10px;"  calss="required" required="required" onchange="calcolaPrezzo()">											
												<option value="">- Select Price -</option>
												<?php for($i=1; $i<=10; $i++){
													$var_prezzo="prezzo_".$i;
													$var_desc="descrizione_prezzo_".$i;
													if($$var_prezzo && $$var_prezzo!=""){?>
														<option value="<?php echo $$var_prezzo;?>" <?php if(isset($prezzo) && $$var_prezzo==$prezzo){?>selected="selected"<?php }?>><?php echo $$var_desc;?> - <?php echo $$var_prezzo;?> &euro;</option>
													<?php }?>
												<?php }?>
											</select>
										<?php }?>
									</div>
								</div>
								<div class="col-md-4">
									<div id="sconto_membri" <?php if(isset($significant_partecipation) && $members_of!="YCCS"){?>style="display:none"<?php }?>>
										<?php if($membri==1){?>
											<?php if($sconto!="no"){?>
												<div style="float:left; margin-left:10px;line-height:15px;">YCCS MEMBER<br/><span style="font-size:0.8em"><i>Discount: <?php echo $valore_sconto;?><?php if($sconto=="valore"){?>&euro;<?php }else{?>%<?php }?></i></span></div>
												<div style="clear:both;"></div>
											<?php }?>
										<?php }?>
									</div>
								</div>
								<div class="col-md-4" style="line-height:15px;">
									<input type="hidden" name="final_price" id="final_price" value=""/>
									<div style="float:left; margin-left:15px; ">
										<label class="upper">FINAL PRICE:</label>
									</div>
									<div style="float:left;margin-left:20px;">
										<strong id="final_price_txt"><?php if(isset($final_price)) echo $final_price;?> &euro;</strong>										
									</div>
									<div style="clear:both; margin-left:15px;" id="text_under_price"><?php if(isset($text_under_price)) echo $text_under_price;?></div>
								</div>
								<div style="clear:both;"></div>
								<script>
									function calcolaPrezzo(){
										<?php echo $stringa_js1;?>
										var pz = document.getElementById('prezzo').value;									
										if (pz!="") {
											if($('input[name="members_of"]:checked').val()=="YCCS"){
												<?php if($sconto=="valore"){?>
													pz = pz - <?php echo $valore_sconto;?>;
												<?php }elseif($sconto=="percentuale"){?>
													pz = pz - ((pz/100)*<?php echo $valore_sconto;?>);
												<?php }?>
											}
											<?php echo $stringa_js2;?>
											if (parseInt(Number(pz)) == pz) pz = pz;
											else  pz = pz.toFixed(2);
											document.getElementById('final_price_txt').innerHTML = pz +" &euro;";
										}
										document.getElementById('final_price').value = pz;
									}
									calcolaPrezzo();
								</script>
							</div>
							<hr>
						
						
							<div class="row" style="margin-top:20px">
								<div class="col-md-3">
									<label class="upper">PAYMENT METHOD*:</label>
								</div>
								<div class="col-md-3">
									<div style="float:left; margin-top:2px;"><input type="radio" name="payment_method" required="required" value="Paypal" <?php if(isset($payment_method) && $payment_method=="Paypal"){?>checked="checked"<?php }?> onclick="changeBT();"></div>
									<div style="float:left; margin-left:10px;">Credit Card/Paypal</div>
									<div style="clear:both;"></div>
								</div>
								
								<div class="col-md-6">
									<div style="float:left; margin-top:2px;"><input type="radio" name="payment_method" required="required" id="method_BT" value="Bank Transfer" <?php if(isset($payment_method) && $payment_method=="Bank Transfer"){?>checked="checked"<?php }?> onclick="changeBT();"></div>
									<div style="float:left; margin-left:10px;">Bank Transfer</div>
									<div style="clear:both;"></div>
									<div style="margin-left:23px; font-size:0.8em; line-height:17px; <?php if(isset($payment_method) && $payment_method!="Bank Transfer"){?>display:none;<?php }?>" id="bankData">
										BANK DETAILS:<br/>
										Yacht Club Costa Smeralda<br/>
										Banca Intesa San Paolo - Arzachena<br/>
										BIC/SWIFT: BCITITMM<br/>
										IBAN: IT33F0306984902100000000071<br/>
										<b>IMPERATIVE</b>:<br/>specify as object: <?php echo $nome_regata;?> - <?php if($boat_details==1){?>Name Of Boat<?php }elseif(isset($yacht_club_check) && $yacht_club_check==1 && isset($yacht_club_valore) && trim($yacht_club_valore)!=""){?><?php echo $yacht_club_valore;?><?php }?>
									</div>
								</div>
								<div style="clear:both"></div>	
								<script>
									function changeBT(){
										if(document.getElementById("method_BT").checked){
											document.getElementById('bankData').style.display="block";
										}else{
											document.getElementById('bankData').style.display="none";
										}
									}
									changeBT();
								</script>
								
								<?php if($pagamenti_testo_ita && trim($pagamenti_testo_ita!="") && $lingua=="ita"){?>
									<div class="col-md-12" style="padding-top:15px; padding-bottom:15px">				
										<p>
											<?php echo $pagamenti_testo_ita;?>
										</p>
									</div>
								<?php }?>
								<?php if($pagamenti_testo_eng && trim($pagamenti_testo_eng!="") && $lingua=="eng"){?>
									<div class="col-md-12" style="padding-top:15px; padding-bottom:15px">				
										<p>
											<?php echo $pagamenti_testo_eng;?>
										</p>
									</div>
								<?php }?>
							</div>	
						<?php }?>
						
						<?php if($allegati==1){?>
							<div style="margin-top:20px;"> 
								<?php if($lingua=="ita"){?><strong style="font-weight:800">ATTACHMENTS</strong><?php }else{?><strong style="font-weight:800">ATTACHMENTS</strong><?php }?>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>RATING CERTIFICATE<?php }else{?>RATING CERTIFICATE<?php }?></label>
										<input type="file" class="form-control required" name="rating_certificate">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper"><?php if($lingua=="ita"){?>CREW LIST<?php }else{?>CREW LIST<?php }?></label>
										<input type="file" class="form-control required" name="crew_list">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group" style="display:none;" id="bankTransfer">
										<label class="upper"><?php if($lingua=="ita"){?>COPY OF BANK TRANSFER<?php }else{?>COPY OF BANK TRANSFER<?php }?></label>
										<input type="file" class="form-control required" name="bank_transfer">
									</div>
								</div>
							</div>
							
							
						<?php }?>
						
						
						
						<div class="row" style="margin-top:20px;">
							<div class="col-md-12">
								<?php if($lingua=="ita"){?>
									Se vuoi salvare i dati forniti per recuperarli in una prossima iscizione inserisci:
								<?php }else{?>
									If you want to save the data provided to retrieve them in a next inscription, enter a password:
								<?php }?>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="upper" for="name">Password</label>
									<input type="password" class="form-control required" id="password" name="password" value="" onclick="this.style.border='none';">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="upper" for="name"><?php if($lingua=="ita"){?>Conferma<?php }else{?>Confirm<?php }?> Password</label>
									<input type="password" class="form-control required" id="checkpassword" name="checkpassword" value=""  onclick="this.style.border='none';document.getElementById('password').style.border='none';">								
								</div>
							</div>
							<script language='javascript' type='text/javascript'>
								function checkPass() {
									if (document.getElementById('checkpassword').value != document.getElementById('password').value) {
										document.getElementById('checkpassword').setCustomValidity('Password Must be Matching.');
									} else {
										// input is valid -- reset the error message
										document.getElementById('checkpassword').setCustomValidity('');
									}
								}
							</script>
						</div>
						
						<?php if($disclaimer_visib=='1'){?>
							<div style="margin-top:20px;"> 
								<?php if($lingua=="ita"){?><strong style="font-weight:800">DISCLAIMER</strong><?php }else{?><strong style="font-weight:800">DISCLAIMER</strong><?php }?>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div style="padding:20px 10px; background:#f2f2f2; height:200px; overflow-y:scroll;">
											<?php echo $disclaimer;?>												
										</div>
									</div>
								</div>
							</div>
						<?php }?>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group" style="font-size:0.8em; line-height:15px">
									<label>
										<input type="checkbox" id="privacy" name="privacy" value="0" required="required" <?php /*onclick="check_privacy()"*/?>/>
										<?php if($disclaimer_visib=='0'){?>&nbsp; <a href="<?php if($lingua=="en"){?>en/<?php }?>privacy.html" target="_blank"><?php }?>
											<?php if($lingua=="ita"){?>
												<?php echo $testo_privacy_ita;?>
											<?php } else {?>
												<?php echo $testo_privacy_eng;?>
											<?php }?>
										<?php if($disclaimer_visib=='0'){?></a><?php }?>
									</label>
								</div>
							</div>
						</div>
						
						<div class="g-recaptcha" style="width:305px; margin:0 auto; margin-bottom:20px;" data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
						<div class="row" style="margin-top:20px">
							<div class="col-md-12">
								<div class="form-group text-center">
									<button class="btn btn-primary" type="submit" id="form-submit">SEND</button>
									<button class="btn btn-primary" type="button" onclick="window.location='<?php echo config('app.url');?>/<?php echo $link_back;?>'" style="background:red; border:none;"><?php if($lingua=="ita"){?>ANNULLA<?php }else{?>BACK<?php }?></button>
								</div>
							</div>
						</div>
						</form>
					
					<script type="text/javascript">
						Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
						function checkForm(){
							if(document.getElementById('password').value!="" && document.getElementById('checkpassword').value=="") {
								document.getElementById('checkpassword').style.border="solid 4px red";
								alert("Inserire Conferma Password");
								return false;
							} else if(document.getElementById('password').value!="" && document.getElementById('checkpassword').value!=""  && document.getElementById('password').value!=document.getElementById('checkpassword').value) {
								document.getElementById('checkpassword').style.border="solid 4px red";
								document.getElementById('password').style.border="solid 4px red";
								alert("Password e Conferma Password non coincidono");
								return false;
							} else if(document.getElementById('captain_nautical_driving_license') && document.getElementById('captain_nautical_driving_license').value=="Yes" && document.getElementById('captain_nautical_driving_license_att').value=="") {
								document.getElementById('boxCaptainLicenseAtt').style.border="solid 4px red";
								alert("Attache the Nautical Driving License");
								return false;
							} else if(document.getElementById('owner_nautical_driving_license') && document.getElementById('owner_nautical_driving_license').value=="Yes" && document.getElementById('owner_nautical_driving_license_att').value=="") {
								document.getElementById('boxOwnerLicenseAtt').style.border="solid 4px red";
								alert("Attache the Nautical Driving License");
								return false;
							} else {return true;}
						}
					</script>
				</div>
			</section>
		@else
			<script>
				window.location='<?php echo config('app.url');?>/<?php echo $link_back;?>';
			</script>
		@endif
			
	@else
		<script>
			window.location="<?php echo config('app.url');?>/home.html";
		</script>
	@endif	
@endsection