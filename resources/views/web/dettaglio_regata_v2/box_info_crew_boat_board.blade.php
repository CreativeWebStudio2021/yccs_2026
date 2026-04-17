<style>
	.hvr-fade {
		display: inline-block;
		cursor:pointer;
		vertical-align: middle;
		-webkit-transform: perspective(1px) translateZ(0);
		transform: perspective(1px) translateZ(0);
		box-shadow: 0 0 1px rgba(0, 0, 0, 0);
		overflow: hidden;
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: color, background-color;
		transition-property: color, background-color;
	}
	.hvr-fade:hover, .hvr-fade:focus, .hvr-fade:active {
		background-color: #979797;
		color: white;
	}
	
	.crew-ask{text-align:center;}
	.crew-left{float:left; width:75%}
	.crew-right{float:right; width:25%}
	
	@media (max-width: 600px) {
		.crew-ask{text-align:left;}
		.crew-left{width:100%}
		.crew-right{width:100%}
	}
</style>
<script>
	function vediAsk(id_ask){
		$('#crewBoardAsk').fadeIn();
		$.ajax({
			url: "ajaxRichiestaContatti", 
			type: "GET",
			data: {id_dett : id_ask, lingua : '<?php echo $lingua;?>', ind : '<?php echo url()->full();?>'}, 
			success: function(result){
			$("#crewBoardAskBox").html(result);
		}});
	}
	function nascondiAsk(){
		$("#crewBoardAskBox").html("");
		$('#crewBoardAsk').hide();
	}
</script>
<div style="width:100%; display:none; border-top:solid 1px #<?php echo $colore;?>; margin-bottom:20px;" id="crewBoat">
	<div id="crewBoatList">
		<div style="text-align:center; width:100%; border-bottom:solid 1px #dddddd; padding-bottom:15px; margin-bottom:15px; margin-top:20px;">			
			<div style="width:300px; margin:0 auto; background:#8c8c8c; color:#ffffff; text-align:center; padding:5px 0px; font-weight:bold; border-radius:4px; font-size:0.9em; cursor:pointer;" onclick="vediBoardRequest();">
				<?php if($lingua=="ita"){?>
					Aggiungi il tuo nome alla Crew/Boat Board
				<?php }else{?>
					Add your name to the Crew/Boat Board
				<?php }?>
			</div>			
		</div>
		<div class="row">
			<div class="col-md-6" style="padding:0 10px 0 20px; margin:0;">							
				<div data-lightbox-type="gallery" class="row col-no-margin list-group">
					<span class="list-group-item active" style="font-size:0.9em; background:#<?php echo $colore;?>; border:none;"> <?php if($lingua=="ita"){?>EQUIPAGGIO IN CERCA DI UNA BARCA<?php }else{?>CREW LOOKING FOR A BOAT<?php }?> </span>
					@php
						$query_c = DB::table('crew_board');
						$query_c = $query_c->select('*');
						$query_c = $query_c->where('id_rife','=',$id_dett);
						$query_c = $query_c->where('tipo','=','Cerco barca');
						$query_c = $query_c->where('attivo','=','1');
						$query_c = $query_c->orderby('data','ASC');
						$query_c = $query_c->get();
						$x=1;
					@endphp
					@foreach($query_c AS $key_c=>$value_c)
						@foreach($value_c AS $key_risu=>$value_risu)
							@php
								$risu_c[$key_risu]=$value_risu;
							@endphp
						@endforeach
						<div class="list-group-item" style="background:#<?php if($x==1){?>f9f9f9<?php }else{?>fff<?php }?>; font-size:0.8em; line-height:14px">
							<div class="crew-left" style="padding:0; margin:0;">					
								<i><?php if($lingua=="ita"){?><?php echo date_to_data(substr($risu_c['data'],0,10));?><?php }else{?><?php echo substr($risu_c['data'],0,10);?><?php }?></i><br/>
								@php
									$temp=explode("@@",$risu_c['posizione']);
									$num_pos=count($temp);
								@endphp
								<b><?php if($lingua=="ita"){?>Posizione<?php }else{?>Position<?php }?></b>: <?php if($num_pos==10){?><?php if($lingua=="ita"){?>Tutte<?php }else{?>All<?php }?><?php }else{?><?php echo substr(str_replace("@@",", ",$risu_c['posizione']),2);?><?php }?><br/>
								<b><?php if($lingua=="ita"){?>Esperienza<?php }else{?>Experience<?php }?></b>: <?php echo $risu_c['esperienza'];?><br/>
								<b><?php if($lingua=="ita"){?>Commenti<?php }else{?>Comments<?php }?></b>: <?php echo $risu_c['commento'];?>
							</div>
							<div class="crew-right crew-ask" style="padding:0; margin:0; ">	
								<div style="width:100%; height:20px;"></div>
								<div style="margin-top:20px; border-radius:4px; border:solid 2px #979797; display: inline-block; margin:0 auto;" class="hvr-fade" onclick="vediAsk('<?php echo $risu_c['id'];?>');"><div style="padding:5px 10px;"><b><?php if($lingua=="ita"){?>RICHIEDI CONTATTI<?php }else{?>REQUEST CONTACT DETAILS<?php }?></b></div></div>
							</div>
							<div style="clear:both"></div>
						</div>
						@php $x++; if($x==3) $x=1; @endphp
					@endforeach				
				</div>
			</div>
			
			<div class="col-md-6" style="padding:0 20px 0 10px; margin:0;">							
				<div data-lightbox-type="gallery" class="row col-no-margin list-group">
					<span class="list-group-item active" style="font-size:0.9em; background:#<?php echo $colore;?>; border:none;"> <?php if($lingua=="ita"){?>BARCHE IN CERCA DI EQUIPAGGIO<?php }else{?>BOATS LOOKING FOR CREW<?php }?> </span>
					@php
						$query_c = DB::table('crew_board');
						$query_c = $query_c->select('*');
						$query_c = $query_c->where('id_rife','=',$id_dett);
						$query_c = $query_c->where('tipo','=','Cerco equipaggio');
						$query_c = $query_c->where('attivo','=','1');
						$query_c = $query_c->orderby('data','ASC');
						$query_c = $query_c->get();
						$x=1;
					@endphp
					@foreach($query_c AS $key_c=>$value_c)
						@foreach($value_c AS $key_risu=>$value_risu)
							@php
								$risu_c[$key_risu]=$value_risu;
							@endphp
						@endforeach
						<div class="list-group-item" style="background:#<?php if($x==1){?>f9f9f9<?php }else{?>fff<?php }?>; font-size:0.8em; line-height:14px">
							<div class="crew-left" style="padding:0; margin:0;">					
								<i><?php if($lingua=="ita"){?><?php echo date_to_data(substr($risu_c['data'],0,10));?><?php }else{?><?php echo substr($risu_c['data'],0,10);?><?php }?></i><br/>
								<b>"<i><?php echo $risu_c['nome_barca'];?></i>" - <?php echo $risu_c['tipo_barca'];?></b><br/>							
								@php
									$temp=explode("@@",$risu_c['posizione']);
									$num_pos=count($temp);
								@endphp
								<b><?php if($lingua=="ita"){?>Posizioni Cercate<?php }else{?>Positions Needed<?php }?></b>: <?php if($num_pos==10){?><?php if($lingua=="ita"){?>Tutte<?php }else{?>All<?php }?><?php }else{?><?php echo substr(str_replace("@@",", ",$risu_c['posizione']),2);?><?php }?><br/>
								<b><?php if($lingua=="ita"){?>Esperienza Richiesta<?php }else{?>Experience Desired<?php }?></b>: <?php echo $risu_c['esperienza'];?><br/>
								<b><?php if($lingua=="ita"){?>Commenti<?php }else{?>Comments<?php }?></b>: <?php echo $risu_c['commento'];?>
							</div>
							<div class="crew-right crew-ask" style="padding:0; margin:0; ">	
								<div style="width:100%; height:20px;"></div>
								<div style="margin-top:20px; border-radius:4px; border:solid 2px #979797; display: inline-block; margin:0 auto;" class="hvr-fade" onclick="vediAsk('<?php echo $risu_c['id'];?>');"><div style="padding:5px 10px;"><b><?php if($lingua=="ita"){?>RICHIEDI CONTATTI<?php }else{?>REQUEST CONTACT DETAILS<?php }?></b></div></div>
							</div>
							<div style="clear:both"></div>
						</div>
						@php $x++; if($x==3) $x=1; @endphp
					@endforeach				
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
	<style>
		#boxAsk{overflow: scroll; background:#fff; position:fixed; width:60%; height:90%; top:5%; margin-top:0px;left:20%;}
		@media (max-width: 840px) {
			#boxAsk{width:90%; height:90%; top:5%; margin-top:0px;left:5%; margin-left:0px;}
		}
	</style>
	<div style="width:100%; height:100%; background:rgba(0,0,0,0.8); position:absolute; top:0; left:0; z-index:100000; display:none;" id="crewBoardAsk">
		<div style=" " id="boxAsk">
			<div style="position:relative; width:100%; height:100%; background:#fff;" id="crewBoardAskBox">
			</div>
			<div style="position:absolute; width:30px; height:30px; background:#fff; text-align:Center; top:5px; right:5px; border-radius:15px; cursor:pointer; z-index:1000001;" onclick="nascondiAsk();">
				<div style="margin-top:3px;"><i class="fa fa-times" aria-hidden="true" style="font-size:1.5em"></i></div>
			</div>
		</div>
	</div>
	
	<div id="boardRequest" style="display:none;">
		<section class="content">
			<div class="container" style=" margin-top:-60px;">
					<style>
						.form-group label:not(.error){
							color:#111;
							font-weight:bold
						}
						label.upper{color:#111;font-weight:bold}
					</style>
					<div class="row">				
						<div class="titoliBox2" style="width:100%; text-align:center; margin-top:20px; margin-bottom:30px;">Crew / Boat Board Signup Sheet</div>
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<form action="{{ url()->full() }}" method="post" class="form-gray-fields" name="sendRequest" autocomplete="off">
									@csrf
									<input type="hidden" name="stato" value="inviato"/>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="upper" for="name"><?php if($lingua=="ita"){?>Nome<?php }else{?>Your Name<?php }?></label>
												<input type="text" class="form-control required" name="nome" placeholder="<?php if($lingua=="ita"){?>Inserisci Nome<?php }else{?>Enter Name<?php }?>" id="name3" aria-required="true">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="upper" for="email"><?php if($lingua=="ita"){?>Email<?php }else{?>Your Email<?php }?></label>
												<input type="email" class="form-control required" name="email" placeholder="<?php if($lingua=="ita"){?>Inserisci Email<?php }else{?>Enter email<?php }?>" id="email3" aria-required="true">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="upper" for="phone"><?php if($lingua=="ita"){?>Telefono<?php }else{?>Your Phone<?php }?></label>
												<input type="text" class="form-control required" name="telefono" placeholder="<?php if($lingua=="ita"){?>Inserisci Telefono<?php }else{?>Enter phone<?php }?>" id="phone3" aria-required="true">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
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
									
									<div class="row">
										<input type="hidden" name="esperienza" value=""/>
										<div class="col-md-2">
											<label class="upper" for="esperienza_val"><?php if($lingua=="ita"){?>Esperienza<?php }else{?>Experience<?php }?></label>
										</div>
										<div class="col-md-2" style="text-align:center;">
											<div style="text-align:center;">
												<input type="radio" name="esperienza_val" value="Novice" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Novizio<?php }else{?>Novice<?php }?>
											</div>
										</div>
										<div class="col-md-2" style="text-align:center;">
											<div style="text-align:center;">
												<input type="radio" name="esperienza_val" value="Beginner" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Principiante<?php }else{?>Beginner<?php }?>
											</div>
										</div>
										<div class="col-md-2" style="text-align:center;">
											<div style="text-align:center;">
												<input type="radio" name="esperienza_val" value="Intermediate" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Intermedia<?php }else{?>Intermediate<?php }?>
											</div>
										</div>
										<div class="col-md-2" style="text-align:center;">
											<div style="text-align:center;">
												<input type="radio" name="esperienza_val" value="Advanced" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Avanzata<?php }else{?>Advanced<?php }?>
											</div>
										</div>
										<div class="col-md-2" style="text-align:center;">
											<div style="text-align:center;">
												<input type="radio" name="esperienza_val" value="Professional" onclick="document.sendRequest.esperienza.value=this.value;"><br/><?php if($lingua=="ita"){?>Professionista<?php }else{?>Professional<?php }?>
											</div>
										</div>
									</div>
									
									
									
									<div class="row" style="margin-top:20px; margin-bottom:20px">
										<input type="hidden" name="sailing_status" value=""/>
										<div class="col-md-2">
											<label class="upper" for="sailing_val"><?php if($lingua=="ita"){?>Sailing Status<?php }else{?>Sailing Status<?php }?></label>
										</div>
										<div class="col-md-2" style="text-align:center;">
											<div style="text-align:center;">
												<input type="radio" name="sailing_val" value="Gruppo 1" onclick="document.sendRequest.sailing_status.value=this.value;"><br/><?php if($lingua=="ita"){?>Gruppo 1<?php }else{?>Group 1<?php }?>
											</div>
										</div>
										<div class="col-md-2" style="text-align:center;">
											<div style="text-align:center;">
												<input type="radio" name="sailing_val" value="Gruppo 3" onclick="document.sendRequest.sailing_status.value=this.value;"><br/><?php if($lingua=="ita"){?>Gruppo 3<?php }else{?>Group 3<?php }?>
											</div>
										</div>								
									</div>
									
									<div class="row" style="margin-top:10px">
										<div class="col-md-5">
											<label class="upper" for="email"><?php if($lingua=="ita"){?>Seleziona posizione (anche più di uno)<?php }else{?>Check crew position - your experience or what you're looking for (Select all that apply):<?php }?> </label>
										</div>
										<input type="hidden" name="posizione" value=""/>
										<div class="col-md-7">							
											<fieldset style="font-size:0.8em">
												<div class="row">
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="Foredeck" onclick="addPos('Foredeck')" id="chack1"/>&nbsp;&nbsp;Foredeck 
													</div>
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="Mast" onclick="addPos('Mast')" id="chack2"/>&nbsp;&nbsp;Mast 
													</div>
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="Pit" onclick="addPos('Pit')" id="chack3"/>&nbsp;&nbsp;Pit
													</div>
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="Sewer" onclick="addPos('Sewer')" id="chack4"/>&nbsp;&nbsp;Sewer
													</div>
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="Grinder" onclick="addPos('Grinder')" id="chack5"/>&nbsp;&nbsp;Grinder 
													</div>
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="Trimmer" onclick="addPos('Trimmer')" id="chack6"/>&nbsp;&nbsp;Trimmer
													</div>
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="Main" onclick="addPos('Main')" id="chack7"/>&nbsp;&nbsp;Main 
													</div>
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="Tactician" onclick="addPos('Tactician')" id="chack8"/>&nbsp;&nbsp;Tactician 
													</div>
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="Helm" onclick="addPos('Helm')" id="chack9"/>&nbsp;&nbsp;Helm 
													</div>
													<div class="col-md-4">
														<input type="checkbox" name="posizione_val" value="All" onclick="addPos('All')" id="chack10"/>&nbsp;&nbsp;All
													</div>
												</div>
											</fieldset>
											<script type="text/javascript">
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
											</script>
										</div>
									</div>
									<div class="row" style="margin-top:30px">
										<div class="col-md-12">
											<div class="form-group">
												<label class="upper" for="comment"><?php if($lingua=="ita"){?>Commento<?php }else{?>Your comment<?php }?></label>
												<div style="margin-top:5px; margin-bottom:8px;">
													<?php if($lingua=="ita"){?>
														<b>Si consiglia di non scrivere in questo campo dati particolari che renda il richiedente identificabile e profilabile (nome, email, telefono, social, ecc.). Leggere attentamente i termini, le condizioni di utilizzo e la politica sulla privacy:</b>
													<?php }else{?>
														<b>It is recommended that you do not enter data in this field that would make the applicant identifiable and profilable (name, email, phone, social media, etc.). Read the terms, conditions of use and privacy policy carefully:</b>
													<?php }?>
												</div>
												<textarea onkeyup="countText();" class="form-control required" id="commentoCB" name="commento" rows="7" placeholder="<?php if($lingua=="ita"){?>Inserisci Commento<?php }else{?>Enter comment<?php }?>" id="comment3" aria-required="true"></textarea>
												<div style="font-size:0.9em">
													Num. <?php if($lingua=="ita"){?>caratteri<?php }else{?>of characters<?php }?>: <span id="numCar">0</span>/400
												</div>
												<div style="margin-top:30px; margin-bottom:30px;">
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
												<label><input type="checkbox" id="privacy" name="privacy" value="0" onclick="check_privacy()"/> &nbsp; <a href="<?php if($lingua=="en"){?>en/<?php }?>privacy.html" target="_blank"><?php if($lingua=="ita"){?>Dichiaro di aver preso visione dell’informativa sul trattamento dei dati personali (GDPR 679/16), e di autorizzarne il trattamento<?php } else {?>I declare to have read the notice on processing of personal data (GDPR 679/16), and I authorise processing.<?php }?> *</a></label>
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
												
												<button class="btn btn-primary" type="button" id="inviaCrew" style="background:#<?php echo $colore;?>; border:none;" onclick="checkForm();"><?php if($lingua=="ita"){?>INVIA<?php }else{?>SEND<?php }?></button>
												<button class="btn btn-primary" type="button" onclick="vediBoardRequest();" style="background:red; border:none;"><?php if($lingua=="ita"){?>ANNULLA<?php }else{?>BACK<?php }?></button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<script type="text/javascript">
							Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
							
							function checkForm(){
								if (document.sendRequest.nome.value=="") alert('<?php if($lingua=="eng"){?>"Name" required<?php } else {?>Campo "Nome" obbligatorio<?php }?>');			
								else if (document.sendRequest.email.value=="") alert('<?php if($lingua=="eng"){?>"Email" required<?php } else {?>Campo "E-mail" obbligatorio<?php }?>');
								else if (Filtro.test(document.sendRequest.email.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
								else if (isNaN(document.sendRequest.telefono.value) && document.sendRequest.telefono.value!="") alert('<?php if($lingua=="eng"){?>Enter a valid phone number (only digits)<?php } else {?>Inserisci un numero di telefono corretto (solo numeri)<?php }?>');
								else if (document.sendRequest.tipo.value=="") alert('<?php if($lingua=="eng"){?>"Type of posting" required<?php } else {?>Campo "Tipo di Iscrizione" obbligatorio<?php }?>');
								else if (document.sendRequest.esperienza.value=="") alert('<?php if($lingua=="eng"){?>"Experience" required<?php } else {?>Campo "Esperienza" obbligatorio<?php }?>');
								else if (document.sendRequest.tipo.value=="Cerco equipaggio" && document.sendRequest.nome_barca.value=="") alert('<?php if($lingua=="eng"){?>"Boat Name" required<?php } else {?>Campo "Nome della barca" obbligatorio<?php }?>');
								else if (document.sendRequest.tipo.value=="Cerco equipaggio" && document.sendRequest.tipo_barca.value=="") alert('<?php if($lingua=="eng"){?>"Boat Type" required<?php } else {?>Campo "Tipo della barca" obbligatorio<?php }?>');
								else if (document.sendRequest.sailing_status.value=="") alert('<?php if($lingua=="eng"){?>"Sailing Status" required<?php } else {?>Campo "Sailing Status" obbligatorio<?php }?>');
								else if (document.sendRequest.posizione.value=="") alert('<?php if($lingua=="eng"){?>"Crew position" required<?php } else {?>Campo "Posizione" obbligatorio<?php }?>');
								
								else if (document.sendRequest.privacy.value=="0") alert('<?php if($lingua=="eng"){?>Privacy required<?php } else {?>Autorizzazione della privacy obbligatoria<?php }?>');
								else document.sendRequest.submit();
							}
						</script>
				</div>
			</div>
		</section>
	</div>
	<script>
		var boardRequest=0;
		function vediBoardRequest(){
			if(boardRequest==0){
				boardRequest=1;
				$("#crewBoatList").css({"display":"none"});
				$("#boardRequest").fadeIn();
			}else{
				boardRequest=0;
				$("#boardRequest").css({"display":"none"});
				$("#crewBoatList").fadeIn();
			}
		}
	</script>
</div>
<!-- END CREW/BOAT BOARD -->