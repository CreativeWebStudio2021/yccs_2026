<style>
	.torna-crew-boat-board {
		
	}
	.link-arrow3.link-arrow3-torna {
		cursor:pointer; 
		width:300px !important;
		margin-top:13px;
		border:none;
	}
	@media screen and (max-width: 1500px) {
		.link-arrow3.link-arrow3-torna {
			width:200px !important;
			line-height:1;
			margin-top:-5px;
			text-align:right;
		}
	}
	@media screen and (max-width: 1430px) {
		.torna-crew-boat-board {
			flex:0.75;
		}
		.link-arrow2 {
			margin-top:50px !important;
		}
	}
	@media screen and (max-width: 800px) {
		.torna-crew-boat-board{
			line-height:1;
		}
		.link-arrow2 {
			margin-top:30px !important;
		}
	}
</style>
<div id="crewForm">
	<div style="display:flex; justify-content:flex-end; width:100%; margin-bottom:15px;">			
		
		<div style="width:100%; display:flex; gap:35px; margin-bottom:10px;">
			<h3 class="gradient-title torna-crew-boat-board" style="font-size:22px; margin-top:10px;">Crew / Boat Board Signup Sheet</h3>
			<div style="flex:1;">
				<div class="link-arrow2" style="margin-top:15px; padding-left:calc(100% - 200px); padding-bottom:10px; justify-content:flex-end;">
					<div>
						<a onclick="vediCrew()" class="link-arrow3 link-arrow3-torna">
							<span>
								<?php if($lingua=="ita"){?>
									Torna alla Crew/ Boat Board
								<?php }else{?>
									Back to the Crew/ Boat Board
								<?php }?>
							</span>
							<img src="web/images/arrow.png" alt="freccia" class="arrow-img"/>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form name="sendRequest" action="{{ url()->full() }}" method="post" autocomplete="off">
		@csrf
		<input type="hidden" name="stato" value="inviato"/>
		<div style="display:flex; flex-direction:column; gap:10px">
			<div style="display:flex; gap:50px">
				<div style="flex:1">
					<div style="display:flex; flex-direction:column; gap:5px">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Nome<?php }else{?>Your Name<?php }?></label>
						<input type="text" class="form-control required" name="nome" placeholder="<?php if($lingua=="ita"){?>Inserisci Nome<?php }else{?>Enter Name<?php }?>" id="name3" aria-required="true">
					</div>
				</div>
				<div style="flex:1">
					<div style="display:flex; flex-direction:column; gap:5px">
						<label class="upper" for="email"><?php if($lingua=="ita"){?>Email<?php }else{?>Your Email<?php }?></label>
						<input type="email" class="form-control required" name="email" placeholder="<?php if($lingua=="ita"){?>Inserisci Email<?php }else{?>Enter email<?php }?>" id="email3" aria-required="true">
					</div>
				</div>
			</div>
			<div style="display:flex; gap:50px">
				<div style="flex:1">
					<div style="display:flex; flex-direction:column; gap:5px">
						<label class="upper" for="phone"><?php if($lingua=="ita"){?>Telefono<?php }else{?>Your Phone<?php }?></label>
						<input type="text" class="form-control required" name="telefono" placeholder="<?php if($lingua=="ita"){?>Inserisci Telefono<?php }else{?>Enter phone<?php }?>" id="phone3" aria-required="true">
					</div>
				</div>
				<div style="flex:1">
					<div style="display:flex; flex-direction:column; gap:5px">
						<label class="upper" for="company"><?php if($lingua=="ita"){?>Tipo di Iscrizione<?php }else{?>Type of posting you would like to make<?php }?></label>
						<select class="form-control" name="tipo" onchange="vediBarca();">
							<option value=""><?php if($lingua=="ita"){?>Seleziona<?php }else{?>Select...<?php }?></option>
							<option value="Cerco equipaggio"><?php if($lingua=="ita"){?>Cerco equipaggio<?php }else{?>I have a Boat and I'm looking for Crew<?php }?></option>
							<option value="Cerco barca"><?php if($lingua=="ita"){?>Cerco una barca<?php }else{?>I'm a Crew looking for a Boat to race<?php }?></option>
						</select>

					</div>
				</div>
				<script>
					function vediBarca(){
						if(document.sendRequest.tipo.value=="Cerco equipaggio") document.getElementById('boatRow').style.display='block';
						else if(document.sendRequest.tipo.value=="Cerco barca") document.getElementById('boatRow').style.display='none';
					}
				</script>
			</div>
		</div>
		
		<div  id="boatRow" style="display:none">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="upper" for="nome_barca"><?php if($lingua=="ita"){?>Nome della barca<?php }else{?>Boat Name<?php }?></label>
						<input type="text" class="form-control required" name="nome_barca" placeholder="<?php if($lingua=="ita"){?>Inserisci Nome Barca<?php }else{?>Enter Boat Name<?php }?>" id="name3" aria-required="true">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="upper" for="tipo_barca"><?php if($lingua=="ita"){?>Tipo della barca<?php }else{?>Boat Type<?php }?></label>
						<input type="text" class="form-control required" name="tipo_barca" placeholder="<?php if($lingua=="ita"){?>Inserisci Tipo della barca<?php }else{?>Enter Boat Type<?php }?>" id="email3" aria-required="true">
					</div>
				</div>
			</div>
		</div>
		
		<input type="hidden" name="esperienza" value=""/>
		<div style="display:flex; gap:20px; align-items:center; margin-top:20px;">
			<div style="width:110px;">
				<label class="upper" for="esperienza_val"><?php if($lingua=="ita"){?>Esperienza<?php }else{?>Experience<?php }?></label>
			</div>		
			<div style="text-align:center;">
				<input type="radio" name="esperienza_val" value="Novice" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Novizio<?php }else{?>Novice<?php }?>
			</div>
		
			<div style="text-align:center;">
				<input type="radio" name="esperienza_val" value="Beginner" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Principiante<?php }else{?>Beginner<?php }?>
			</div>
		
			<div style="text-align:center;">
				<input type="radio" name="esperienza_val" value="Intermediate" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Intermedia<?php }else{?>Intermediate<?php }?>
			</div>
		
			<div style="text-align:center;">
				<input type="radio" name="esperienza_val" value="Advanced" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Avanzata<?php }else{?>Advanced<?php }?>
			</div>
		
			<div style="text-align:center;">
				<input type="radio" name="esperienza_val" value="Professional" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Professionista<?php }else{?>Professional<?php }?>
			</div>
			
		</div>
		
		
		
		<input type="hidden" name="sailing_status" value=""/>
		<div style="display:flex; gap:20px; align-items:center;margin-top:20px;">
			<div style="width:110px;">
				<label class="upper" for="sailing_val"><?php if($lingua=="ita"){?>Sailing Status<?php }else{?>Sailing Status<?php }?></label>
			</div>
			<div style="text-align:center;">
				<div style="text-align:center;">
					<input type="radio" name="sailing_val" value="Gruppo 1" onclick="document.sendRequest.sailing_status.value=this.value;"><br/><?php if($lingua=="ita"){?>Gruppo 1<?php }else{?>Group 1<?php }?>
				</div>
			</div>
			<div style="text-align:center;">
				<div style="text-align:center;">
					<input type="radio" name="sailing_val" value="Gruppo 3" onclick="document.sendRequest.sailing_status.value=this.value;"><br/><?php if($lingua=="ita"){?>Gruppo 3<?php }else{?>Group 3<?php }?>
				</div>
			</div>								
		</div>
		
		<input type="hidden" name="posizione" value=""/>
		<div style="display:flex; gap:20px; margin-top:10px">
			<div >
				<label class="upper" for="email"><?php if($lingua=="ita"){?>Seleziona posizione (anche più di uno)<?php }else{?>Check crew position - your experience or what you're looking for (Select all that apply):<?php }?> </label>
			</div>
			<div>							
				<fieldset style="font-size:0.8em; border:none; display:flex; flex-direction:column; gap:10px;">
					<div style="display:flex; gap:20px;">
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="Foredeck" onclick="addPos('Foredeck')" id="chack1"/>&nbsp;&nbsp;Foredeck</div>
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="Mast" onclick="addPos('Mast')" id="chack2"/>&nbsp;&nbsp;Mast </div>
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="Pit" onclick="addPos('Pit')" id="chack3"/>&nbsp;&nbsp;Pit</div>
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="Sewer" onclick="addPos('Sewer')" id="chack4"/>&nbsp;&nbsp;Sewer</div>
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="Grinder" onclick="addPos('Grinder')" id="chack5"/>&nbsp;&nbsp;Grinder </div>										
					</div>
					<div style="display:flex; gap:20px;">					
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="Trimmer" onclick="addPos('Trimmer')" id="chack6"/>&nbsp;&nbsp;Trimmer</div>
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="Main" onclick="addPos('Main')" id="chack7"/>&nbsp;&nbsp;Main </div>
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="Tactician" onclick="addPos('Tactician')" id="chack8"/>&nbsp;&nbsp;Tactician </div>
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="Helm" onclick="addPos('Helm')" id="chack9"/>&nbsp;&nbsp;Helm </div>				
						<div style="width:90px;"><input type="checkbox" name="posizione_val" value="All" onclick="addPos('All')" id="chack10"/>&nbsp;&nbsp;<b>All</b></div>
					</div>				
				</fieldset>
				<?php /*<script type="text/javascript">
					val=document.sendRequest.posizione.value;
					function addPos(pos){
						if(pos=="All"){
							if(document.getElementById('chack10').checked==1){
								<?php for($i=1; $i<=9; $i++){?>
									val=val+"@@"+document.getElementById('chack<?php echo $i;?>').value;
									document.getElementById('chack<?php echo $i;?>').checked=1;
								<?php }?>
							}else{
								val="";
								<?php for($i=1; $i<=9; $i++){?>
									document.getElementById('chack<?php echo $i;?>').checked=0;
								<?php }?>
							}
						}else{
							if(val==val.replace(pos,""))
								val=val+"@@"+pos;
							else val=val.replace("@@"+pos,"");
							document.getElementById('chack10').checked=0;
						}
						document.sendRequest.posizione.value=val;
					}	
				</script>*/?>
			</div>
		</div>
		<div class="row" style="margin-top:30px">
			<div class="col-md-12">
				<div class="form-group">
					<label class="upper" for="comment"><?php if($lingua=="ita"){?>Commento<?php }else{?>Your comment<?php }?></label>
					<div style="margin-top:5px; margin-bottom:8px; font-size:12px; font-weight:600">
						<?php if($lingua=="ita"){?>
							Si consiglia di non scrivere in questo campo dati particolari che renda il richiedente identificabile e profilabile (nome, email, telefono, social, ecc.). Leggere attentamente i termini, le condizioni di utilizzo e la politica sulla privacy:
						<?php }else{?>
							It is recommended that you do not enter data in this field that would make the applicant identifiable and profilable (name, email, phone, social media, etc.). Read the terms, conditions of use and privacy policy carefully:
						<?php }?>
					</div>
					<textarea onkeyup="countText();" class="form-control required" id="commentoCB" name="commento" style="width:50%; height:80px;" placeholder="<?php if($lingua=="ita"){?>Inserisci Commento<?php }else{?>Enter comment<?php }?>" id="comment3" aria-required="true"></textarea>
					<div style="font-size:12px">
						Num. <?php if($lingua=="ita"){?>caratteri<?php }else{?>of characters<?php }?>: <span id="numCar">0</span>/400
					</div>
					<div style="margin-top:20px; margin-bottom:20px; font-size:12px;">
						<?php if($lingua=="ita"){?>
							Ricordiamo agli utenti di non scrivere contenuti inappropriati o offensivi altrimenti potrebbero essere rimossi o non approvati dal moderatore; si invitano gli utenti a pubblicare contenuti brevi, che non contengano riferimenti a dati particolari che li riguardano e che rendano la persona identificabile e profilabile, in particolare Nome e Cognome, email, numero di telefono, profili social, ecc.. Lo Yacht Club Costa Smeralda non si assume nessuna responsabilità in caso di pubblicazione autonoma di informazioni di contenuto personale da parte dell’utente che possa ledere il diritto alla riservatezza.
						<?php }else{?>
							We remind our users not to write inappropriate or offensive content otherwise they may be removed or not approved by the moderator; we invite users to post content that is short, which does not contain references to specific data concerning them, and which would make the person identifiable and profilable, in particular name and surname, email, telephone number, social media profiles, etc. The Yacht Club Costa Smeralda assumes no responsibility in the case of independent publication of personal information by the user which may violate the right to privacy.
						<?php }?>
					</div>
				</div>
			</div>
		</div>
		<script>
			function countText(){
				var numMax=400;
				var stringa= document.getElementById('commentoCB').value;
				if (stringa.length>numMax){
					alert("Numero massimo di caratteri:"+numMax);
					stringa=stringa.substr(0, numMax);
					document.getElementById('commentoCB').value=stringa;
					stringa= document.getElementById('commentoCB').value;
				}
				document.getElementById('numCar').innerHTML=stringa.length;
			}
		</script>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group" style="font-size:0.8em; line-height:15px">
					<label style="display:flex; gap:10px; align-items:center;">
						<input type="checkbox" id="privacy" name="privacy" value="0" onclick="check_privacy()"/>
						<a href="<?php if($lingua=="en"){?>en/<?php }?>privacy.html" target="_blank">
							<?php if($lingua=="ita"){?>
								Dichiaro di aver preso visione dell’informativa sul trattamento dei dati personali (GDPR 679/16), e di autorizzarne il trattamento
							<?php } else {?>
								I declare to have read the notice on processing of personal data (GDPR 679/16), and I authorise processing.
							<?php }?> *
						</a>
					</label>
				</div>
				<script type="text/javascript">
					var pr=0;
					function check_privacy(){
						if(pr==0) pr=1;
						else pr=0;
						document.sendRequest.privacy.value=pr;
					}
				</script>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group text-center">
					<div class="g-recaptcha" style="width:305px; margin:0 auto; margin-top:20px; margin-bottom:20px;" data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
					<div style="display:flex; gap:10px">
						<button class="btnYccsWhite" style="width:80px;" type="button" id="inviaCrew" onclick="checkForm();"><?php if($lingua=="ita"){?>INVIA<?php }else{?>SEND<?php }?></button>
						<button class="btnYccsAnnulla" style="width:100px;" type="button" onclick="vediBoardRequest();"><?php if($lingua=="ita"){?>ANNULLA<?php }else{?>BACK<?php }?></button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>