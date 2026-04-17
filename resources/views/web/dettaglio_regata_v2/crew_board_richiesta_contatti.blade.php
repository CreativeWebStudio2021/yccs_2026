<section class="content" style="width:100%">
	<div class="container"style="width:100%">
		<div class="row">				
				<div class="titoliBox2" style="width:100%; text-aling:center; margin-bottom:10px; margin-top:-40px">
					<?php if($lingua=="ita"){?>Richiesta Contatti<?php }else{?>Contact Details Request<?php }?>
				</div>
			
				<div class="row">
					<div class="col-md-2 ajaxMob">	</div>
					<div class="col-md-10 ajaxMob">							
						<div style="padding:0 20px; text-align:center;">
							<p>
							<?php if($lingua=="ita"){?>
								Compila il seguente form per richiedere i dati. Se la richiesta verr&agrave; accettata riceverai i dati per email.
							<?php }else{?>
								Fill in the following form to request contact details. If the request is accepted you will receive the data by email.
							<?php }?>
							</p>
						</div>
						<form method="post" action="{{ $ind }}" class="form-gray-fields" name="sendAsk" autocomplete="off">
							@csrf
							<input type="hidden" name="statoAsk" value="inviato"/>
							<input type="hidden" name="id_richiesta" value="<?php echo $id_dett;?>"/>
							<div class="row ajaxMob">
								<div class="col-md-6">
									<div class="form-group">
										<label class="upper" for="name"><?php if($lingua=="ita"){?>Nome<?php }else{?>Your Name<?php }?>*</label>
										<input type="text" class="form-control required" name="nomeAsk" placeholder="<?php if($lingua=="ita"){?>Inserisci Nome<?php }else{?>Enter Name<?php }?>" id="nomeAsk" aria-required="true">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="upper" for="cognome"><?php if($lingua=="ita"){?>Cognome<?php }else{?>Your Surname<?php }?>*</label>
										<input type="text" class="form-control required" name="cognomeAsk" placeholder="<?php if($lingua=="ita"){?>Inserisci Cognome<?php }else{?>Enter Surname<?php }?>" id="cognomeAsk" aria-required="true">
									</div>
								</div>
							</div>
							<div class="row ajaxMob">
								<div class="col-md-6">
									<div class="form-group">
										<label class="upper" for="email"><?php if($lingua=="ita"){?>Email<?php }else{?>Your Email<?php }?>*</label>
										<input type="email" class="form-control required" name="emailAsk" placeholder="<?php if($lingua=="ita"){?>Inserisci Email<?php }else{?>Enter email<?php }?>" id="emailAsk" aria-required="true">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="upper" for="telefono"><?php if($lingua=="ita"){?>Telefono<?php }else{?>Your Phone<?php }?></label>
										<input type="text" class="form-control required" name="telefonoAsk" placeholder="<?php if($lingua=="ita"){?>Inserisci Telefono<?php }else{?>Enter Phone<?php }?>" id="telefonoAsk" aria-required="true">
									</div>
								</div>
							</div>
							<div class="row ajaxMob">
								<div class="col-md-12">
									<div class="form-group">
										<label class="upper" for="messaggio"><?php if($lingua=="ita"){?>Messaggio<?php }else{?>Message<?php }?></label>
										<textarea name="messaggioAsk" class="form-control required" rows="4" placeholder="<?php if($lingua=="ita"){?>Inserisci Messaggio<?php }else{?>Enter Message<?php }?>" id="messaggio"></textarea>
									</div>
								</div>
							</div>
							<div class="row ajaxMob">
								<div class="col-md-12">
									<div class="form-group" style="font-size:0.8em; line-height:15px">
										<label><input type="checkbox" id="privacy" name="privacy" value="0" onclick="check_privacy()"/> &nbsp; <a target="_blank" href="<?php if($lingua=="en"){?>en/<?php }?>privacy.html" target="_blank"><?php if($lingua=="ita"){?>Dichiaro di aver preso visione dell’informativa sul trattamento dei dati personali (GDPR 679/16), e di autorizzarne il trattamento<?php } else {?>I declare to have read the notice on processing of personal data (GDPR 679/16), and I authorise processing.<?php }?> *</a></label>
									</div>
									<script type="text/javascript">
										var pr=0;
										function check_privacy(){
											if(pr==0) pr=1;
											else pr=0;
											document.sendAsk.privacy.value=pr;
										}
									</script>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group text-center">
										<script src="https://www.google.com/recaptcha/api.js" async defer></script>
										<div class="g-recaptcha" style="width:305px; margin:0 auto; margin-bottom:20px;" data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
									
										<?php /*<button class="btn btn-primary" type="button" id="inviaRichiesta" style="background:#<?php echo $colore;?>; border:none;"><?php if($lingua=="ita"){?>INVIA<?php }else{?>SEND<?php }?></button>*/?>
										<button class="btn btn-primary" type="button" id="inviaRichiesta" style="; border:none;" onclick="checkForm();"><?php if($lingua=="ita"){?>INVIA<?php }else{?>SEND<?php }?></button>
										<button class="btn btn-primary" type="button" onclick="nascondiAsk();" style="background:red; border:none;"><?php if($lingua=="ita"){?>ANNULLA<?php }else{?>BACK<?php }?></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				<script type="text/javascript">
					Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
					function checkForm(){
						if (document.sendAsk.nomeAsk.value=="") alert('<?php if($lingua=="eng"){?>"Name" required<?php } else {?>Campo "Nome" obbligatorio<?php }?>');			
						else if (document.sendAsk.cognomeAsk.value=="") alert('<?php if($lingua=="eng"){?>"Surname" required<?php } else {?>Campo "Cognome" obbligatorio<?php }?>');			
						else if (document.sendAsk.emailAsk.value=="") alert('<?php if($lingua=="eng"){?>"Email" required<?php } else {?>Campo "E-mail" obbligatorio<?php }?>');
						else if (Filtro.test(document.sendAsk.emailAsk.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
						else if (isNaN(document.sendAsk.telefonoAsk.value) && document.sendAsk.telefonoAsk.value!="") alert('<?php if($lingua=="eng"){?>Enter a valid phone number (only digits)<?php } else {?>Inserisci un numero di telefono corretto (solo numeri)<?php }?>');	
						else if (document.sendAsk.privacy.value=="0") alert('<?php if($lingua=="eng"){?>Privacy required<?php } else {?>Autorizzazione della privacy obbligatoria<?php }?>');						
						else document.sendAsk.submit();
					}
				</script>
		</div>
	</div>
</section>