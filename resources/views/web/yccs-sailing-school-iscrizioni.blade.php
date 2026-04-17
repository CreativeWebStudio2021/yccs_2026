@php
	if(isset($_GET['codice_iscrizione'])) $codice_iscrizione=$_GET['codice_iscrizione']; else $codice_iscrizione="";
	if(isset($_GET['id_ute'])) $id_ute=$_GET['id_ute']; else $id_ute="";
	if(isset($_GET['fam'])) $fam=$_GET['fam']; else $fam="";
	if(isset($_GET['admin'])) $admin=$_GET['admin']; else $admin="0";
	if(isset($_GET['conferma'])) $conferma=$_GET['conferma']; else $conferma="0";
	if(isset($variables)){
		$temp = explode("&",$variables);
		$x=1;
		foreach($temp AS $key=>$value){
			if($value!=""){
				$temp2=explode("=",$value);
				$nome_var = $temp2[0];
				$$nome_var = $temp2[1];
			}
		}
	}
	
	if(isset($pag_dett)) $codice_iscrizione=$pag_dett; else $codice_iscrizione="";
	if(isset($id_dett)) $id_ute=$id_dett; else $id_ute="";
	
	$num_iscr = 0;
	if($codice_iscrizione!="" && $id_ute!=""){
		$query_iscr = DB::table('iscrizioni_scuola')
			->select('*')
			->where('codice','=',$codice_iscrizione)
			->where('id','=',$id_ute)
			->get();
		$num_iscr = $query_iscr->count();
	}
	
	if(!isset($stato)) $stato="";
	if(!isset($recupero))  $recupero="";
	if(!isset($recuperopassword))  $recuperopassword="";
	if(!isset($nome)) $nome="";
	if(!isset($cognome)) $cognome="";
	if(!isset($indirizzo)) $indirizzo="";
	if(!isset($cap)) $cap="";
	if(!isset($citta)) $citta="";
	if(!isset($provincia)) $provincia="";
	if(!isset($nazione)) $nazione="";
	if(!isset($luogo_nascita)) $luogo_nascita="";
	if(!isset($nazione_nascita)) $nazione_nascita="";
	if(!isset($data_nascita)) $data_nascita="";
	if(!isset($codice_fiscale)) $codice_fiscale="";
	if(!isset($telefono1)) $telefono1="";
	if(!isset($prefix_telefono1)) $prefix_telefono1="";
	if(!isset($telefono2)) $telefono2="";
	if(!isset($prefix_telefono2)) $prefix_telefono2="";
	if(!isset($fax)) $fax="";
	if(!isset($prefix_fax)) $prefix_fax="";
	if(!isset($email)) $email="";
	if(!isset($telefono)) $telefono="";
	if(!isset($tipo)) $tipo="";
	if(!isset($durata)) $durata="";
	if(!isset($note)) $note="";
	if(!isset($dal)) $dal="";
	if(!isset($al)) $al="";
	if(!isset($tesseramento)) $tesseramento="no";
	if(!isset($transfer)) $transfer="no";
	if(!isset($indirizzo_transfer)) $indirizzo_transfer="";
	if(!isset($totale)) $totale="0";
	if(!isset($gia_tesserato)) $gia_tesserato="";
	if(!isset($circolo)) $circolo="";
	if(!isset($pagamento)) $pagamento="";
	if(!isset($nome_socio_pagamento)) $nome_socio_pagamento="";
	if(!isset($cognome_socio_pagamento)) $cognome_socio_pagamento="";
	if(!isset($costo_prima_sett)) $costo_prima_sett="0";
	if(!isset($costo_mezza_settimana)) $costo_mezza_settimana="0";
	if(!isset($costo_settimane_in_piu)) $costo_settimane_in_piu="0";
	if(!isset($costo_giorni_in_piu)) $costo_giorni_in_piu="0";
	if(!isset($num_settimane)) $num_settimane="0";
	if(!isset($num_giorni)) $num_giorni="0";
	if(!isset($costo_mesi)) $costo_mesi="0";
	if(!isset($num_mesi)) $num_mesi="0";
	if(!isset($password)) $password="";
	if(!isset($CI)) $CI="";
	if(!isset($CF)) $CF="";
	if(!isset($CM)) $CM="";

	$data=date("Y-m-d H:i:s");
@endphp

@extends('web.index')

@section('content')	
	@if($codice_iscrizione!="" && $id_ute!="" && $num_iscr==0)
		<script>
			<?php if($lingua=="ita"){?>
				alert('Nessun dato da recuperare');
				window.location="<?php echo config('app.url');?>/yccs-sailing-school-iscrizioni.html";
			<?php }else{?>
				alert('No data to recover');
				window.location="<?php echo config('app.url');?>/en/yccs-sailing-school-iscrizioni.html";
			<?php }?>
		</script>
	@endif
	@if($num_iscr>0)
		@php			
			foreach($query_iscr[0] as $key => $value) {				
				$$key = $value;
				//echo "$key is at $value<br/>";				
			}
		@endphp
	@endif
	@include('web.common.yccs_sailing_school_slide')
	<section>
		<div class="container">	
			@if( count($errors) > 0)
				@foreach($errors->all() as $error)
					<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="margin-bottom:40px; background:{{ $message_color }}">
						<div style="float:left; width:90%;">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">{{ trans('labels.Error') }}:</span>
							{!! $error !!}
						</div>
						<div style="float:right; width:10%; text-align:right; cursor:pointer;" onclick="$('#errorMessage').fadeOut();"><b>x</b></div>
						<div style="clear:both"></div>
					</div>
					@if($error=="Nuova iscrizione salvata")
						<script>
							function loc(){
								window.location='<?php echo config('app.url');?>/resarea/admin.php?cmd=iscrizioni_scuola';
							}
							window.setTimeout('loc()' , 3000);
						</script>
					@endif
					@if($error=="Nuova iscrizione salvata e mail inviata")
						<script>
							window.location='<?php echo config('app.url');?>/mail_invio_dati.php?codice_iscrizione=<?php echo $codice;?>&id_rife=<?php echo $id_rife;?>&lingua=<?php echo $lingua;?>';
							function loc(){
								window.location='<?php echo config('app.url');?>/resarea/admin.php?cmd=iscrizioni_scuola';
							}
							window.setTimeout('loc()' , 3000);
							
						</script>
					@endif
				@endforeach
			@endif
			@if(1)
				<div class="row">
					<div class="col-md-12">
						<div style="width:100%; display:flex; gap:35px;">
							<h4 class="gradient-title" style="font-size:30px;"><?php if($lingua=="ita"){?>ISCRIZIONE/TESSERAMENTO AI CORSI VELA<?php }else{?>REGISTRATION FOR SAILING COURSES<?php }?></h4>
							<div class="link-arrow" style="flex:1; margin-top:20px; border-bottom:solid 2px;"></div>
						</div>
					</div>
					<div class="col-md-12" >
						<?php if($lingua=="ita"){?>
							<h3 style=" font-size:30px; line-height:40px;">Modulo iscrizione  per Corsi di vela <?php echo date("Y");?><br/>
							YCCS Sailing School</h3>
							 
							Richiedo di partecipare ai corsi di vela organizzati dalla YCCS Sailing School.<br/>
							<span style="font-weight:bold; text-decoration:underline;">E' obbligatorio consegnare un certificato medico di sana e robusta costituzione per attivit&agrave; sportiva non agonistica</span> prima dell'inizio del corso.
						<?php }else{?>
							<h3 >Registration form <?php echo date("Y");?><br/>
							YCCS Sailing School</h3>
							 
							I request to take part in the sailing courses organized by YCCS Sailing School.<br/>
							<span style="font-weight:bold; text-decoration:underline;">It is mandatory to deliver a medical certificate of sound and robust constitution for non-competitive sports activities</span> before the start of the course..
						
						<?php }?>
					</div>

				</div>
				<script>
					function scrollToAnchor(){
						var url = window.location.href;
						var w = $( window ).width();
						if(url.substr(-11, 11)=="#iscrizione")	{			
							if(w>=992){
								$('html,body').animate({scrollTop: '570'},'slow');
							}else if(w>=768){
								$('html,body').animate({scrollTop: '650'},'slow');
							}else if(w<768){
								$('html,body').animate({scrollTop: '740'},'slow');
							}
						}
					}

					scrollToAnchor();
				</script>
				<style>
					.form-gray-fields .form-control {
						background-color: #dadada;
						border-color: #cfcfcf;
						color: #333;
					}
					.form-group label:not(.error) {
					  font-size: 13px;
					  letter-spacing: 0.04em;
					  font-weight: 400;
					  margin-bottom: 4px;
					  color: #000;
					}
				</style>
									
				<div class="row" style="margin-top:60px;">
					<div class="col-md-12">
						<?php if(isset($num_iscr) && $num_iscr==0){?>
							<div id="recuperaDati">
								<div class="row">	
									<div class="col-md-2"></div>
									<div class="col-md-8 col-md-offset-2" style="border:solid 1px #cfcfcf; margin-bottom:20px;">
										<div style="padding:10px;">
											<div >
												<?php if($lingua=="ita"){?>
													Se vuoi recuperare i dati da una precedente iscrizione inserisci:
												<?php }else{?>
													If you want to retrieve data from a previous registration, enter the following data
												<?php }?>
											</div>
											<form action="{{ url()->full() }}" method="post" name="recoverRequest" autocomplete="off">
												@csrf
												<input type="hidden" name="recupero" value="inviato"/>
												<div class="row" style="margin-top:10px;">
													<div class="col-md-4">
														<div class="form-group">
															<label class="upper" for="name"><b>Email</b></label>
															<input type="text" class="form-control required" name="email" value=""  aria-required="true">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="upper" for="name"><b>Password</b></label>
															<input type="password" class="form-control required" name="password" value=""  aria-required="true">
															<div  style=" text-align:right; font-size:0.8em; cursor:pointer;" onclick="document.getElementById('recuperaDati').style.display='none'; document.getElementById('recuperoPassword').style.display='block';">Recupera Password</div>
														</div>
													</div>										
													<div class="col-md-4">
														<div class="form-group text-center">
															<label class="upper" for="name">&nbsp;</label>
															<button class="btn btn-danger" type="button" onclick="checkRecoverForm()"><?php if($lingua=="ita"){?>RECUPERA DATI<?php }else{?>SUBMIT<?php }?></button>
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
									<div class="col-md-2"></div>
								</div>
							</div>
							
							<div style="display:none" id="recuperoPassword">
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8" style="border:solid 1px #cfcfcf; margin-bottom:20px;">
										<div style="padding:10px;">
											<div>
											<b>RECUPERA PASSWORD</b><br/>
											Se hai dimenticato la password per inserire automaticamente i dati da una precedente iscrizione inserisci il tuo indirizzo email e ti invieremo la procedura per impostarne una nuova:</div>
											
											<form action="{{ url()->full() }}" method="post" name="recoverPassword" autocomplete="off">
												@csrf
												<input type="hidden" name="recuperopassword" value="inviato"/>
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
									<div class="col-md-2"></div>
								</div>
							</div>
						<?php }?>
						@php
							$link_form = "yccs-sailing-school-iscrizioni.html";
							if($lingua=="eng") $link_form = "en/yccs-sailing-school-iscrizioni.html";
						@endphp
						<form action="{{ $link_form }}" method="post" name="sendRequest" autocomplete="off" class="form-gray-fields" enctype="multipart/form-data">
							@csrf
						
							<input type="hidden" name="stato" value="inviato"/>
							<input type="hidden" name="num_pers" id="num_pers" value=""/>
							<input type="hidden" name="sconto" id="sconto" value="0"/>
							@if(isset($codice_iscrizione) && $codice_iscrizione!="")
								<input type="hidden" name="codice_old" id="codice_old" value="{{$codice_iscrizione}}"/>
							@endif
						
							<div id="dati_personali">
								<div id="dati_personali_1"></div>
								<div id="dati_personali_2"></div>
							</div>
							
							<div class="row" style="padding-top:0; margin-top:0; margin-bottom:10px;">
								<div class="col-md-12" style="padding-top:0; margin-top:0; text-align:right;">
									<button class="btn btn-danger" type="button" onclick="aggiungiPersona('')"><?php if($lingua=="ita"){?>AGGIUNGI FAMILIARE<?php }else{?>ADD FAMILY MEMBER<?php }?></button>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper" for="phone"><?php if($lingua=="ita"){?>Cellulare<?php }else{?>Telephone 1<?php }?>*</label>
										<div style="float:left; width:80px; height:30px; position:relative;">									
											<input type="text" class="form-control required" readonly="readonly" placeholder="<?php if($lingua=="ita"){?>prefisso<?php }else{?>prefix<?php }?>" name="prefix_telefono1" id="prefix_telefono1" required="required" value="<?php echo $prefix_telefono1;?>" aria-required="true">
											<select style="position:absolute; width:100%; height:40px; top:0; left:0; opacity: 0; filter: alpha(opacity=0);" onchange="document.getElementById('prefix_telefono1').value=this.value" class="form-control required">
												<option value=""></option>
												@php
													$query_prefix = DB::table('dialing_codes')
														->select('*')
														->orderby('ordine','DESC')
														->orderby('Country','ASC')
														->get();
												@endphp
												@foreach($query_prefix AS $key_prefix=>$value_prefix)
													<option value="<?php echo $value_prefix->Code;?>" <?php if($prefix_telefono1==$value_prefix->Code){?>selected="selected"<?php }?>><?php echo $value_prefix->Country;?> (<?php echo $value_prefix->Code;?>)</option>
													<?php if($value_prefix->ordine==1){?>
														<option value="">-------------------------</option>
													<?php }?>
												@endforeach
											</select>
										</div>
										<div style="float:left; width: -webkit-calc(100% - 90px); width:-moz-calc(100% - 90px); width:calc(100% - 90px); margin-left:10px;">
											<input type="text" class="form-control required" name="telefono1" id="telefono1" value="<?php echo $telefono1;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Cellulare<?php }else{?>Enter Telephone 1<?php }?>" aria-required="true">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper" for="phone"><?php if($lingua=="ita"){?>Tel casa<?php }else{?>Telephone 2<?php }?></label>
										<div style="float:left; width:80px; height:30px; position:relative;">									
											<input type="text" class="form-control required" readonly="readonly" placeholder="<?php if($lingua=="ita"){?>prefisso<?php }else{?>prefix<?php }?>" name="prefix_telefono2" id="prefix_telefono2" required="required" value="<?php echo $prefix_telefono2;?>" aria-required="true">
											<select style="position:absolute; width:100%; height:40px; top:0; left:0; opacity: 0; filter: alpha(opacity=0);" onchange="document.getElementById('prefix_telefono2').value=this.value" class="form-control required">
												<option value=""></option>
												@php
													$query_prefix = DB::table('dialing_codes')
														->select('*')
														->orderby('ordine','DESC')
														->orderby('Country','ASC')
														->get();
												@endphp
												@foreach($query_prefix AS $key_prefix=>$value_prefix)
													<option value="<?php echo $value_prefix->Code;?>" <?php if($prefix_telefono2==$value_prefix->Code){?>selected="selected"<?php }?>><?php echo $value_prefix->Country;?> (<?php echo $value_prefix->Code;?>)</option>
													<?php if($value_prefix->ordine==1){?>
														<option value="">-------------------------</option>
													<?php }?>
												@endforeach
											</select>
										</div>
										<div style="float:left; width: -webkit-calc(100% - 90px); width:-moz-calc(100% - 90px); width:calc(100% - 90px); margin-left:10px;">
											<input type="text" class="form-control required" name="telefono2" id="telefono2" value="<?php echo $telefono2;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Tel casa<?php }else{?>Enter Telephone 2<?php }?>" aria-required="true">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper" for="phone"><?php if($lingua=="ita"){?>Fax<?php }else{?>Fax<?php }?></label>
										<div style="float:left; width:80px; height:30px; position:relative;">									
											<input type="text" class="form-control required" readonly="readonly" placeholder="<?php if($lingua=="ita"){?>prefisso<?php }else{?>prefix<?php }?>" name="prefix_fax" id="prefix_fax" required="required" value="<?php echo $prefix_fax;?>" aria-required="true">
											<select style="position:absolute; width:100%; height:40px; top:0; left:0; opacity: 0; filter: alpha(opacity=0);" onchange="document.getElementById('prefix_fax').value=this.value" class="form-control required">
												<option value=""></option>
												@php
													$query_prefix = DB::table('dialing_codes')
														->select('*')
														->orderby('ordine','DESC')
														->orderby('Country','ASC')
														->get();
												@endphp
												@foreach($query_prefix AS $key_prefix=>$value_prefix)
													<option value="<?php echo $value_prefix->Code;?>" <?php if($prefix_fax==$value_prefix->Code){?>selected="selected"<?php }?>><?php echo $value_prefix->Country;?> (<?php echo $value_prefix->Code;?>)</option>
													<?php if($value_prefix->ordine==1){?>
														<option value="">-------------------------</option>
													<?php }?>
												@endforeach
											</select>
										</div>
										<div style="float:left; width: -webkit-calc(100% - 90px); width:-moz-calc(100% - 90px); width:calc(100% - 90px); margin-left:10px;">
											<input type="text" class="form-control required" name="fax" id="fax" value="<?php echo $fax;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Fax<?php }else{?>Enter Fax<?php }?>" aria-required="true">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="upper" for="email"><?php if($lingua=="ita"){?>Email<?php }else{?>Email<?php }?>*</label>
										<input type="email" class="form-control required" name="email" id="email" value="<?php echo $email;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Email<?php }else{?>Enter Email<?php }?>" aria-required="true">
									</div>
									<div class="form-group">
										<label class="upper" for="email"><?php if($lingua=="ita"){?>Conferma Email<?php }else{?>Confirm Email<?php }?>*</label>
										<input type="email" class="form-control required" name="email_conf" id="email_conf" value="<?php echo $email;?>" placeholder="<?php if($lingua=="ita"){?>Conferma Email<?php }else{?>Confirm Email<?php }?>" aria-required="true">
									</div>
								</div>
							</div>
							<input type="hidden" name="transfer" id="transfer" value="<?php echo $transfer;?>"/>
							<?php /*<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="upper" for="name">
											<?php if($lingua=="ita"){?>Richiedo, se disponibile, il servizio gratuito di transfert da casa alla scuola<?php }else{?>If available I would like the free transfer service from home to the school.<?php }?>
											&nbsp;&nbsp;<input type="checkbox" id="checkTransfer" <?php if($transfer=="si"){?>checked="checked"<?php }?>/>
										</label>								
									</div>
								</div>			
							</div>*/?>
							<div class="row" <?php if($transfer=="no"){?>style="display:none"<?php }?> id="indirizzoTransfer">
								<div class="col-md-12">
									<div class="form-group">
										<label class="upper" for="name"><?php if($lingua=="ita"){?>In caso di risposta affermativa il mio indirizzo è <?php }else{?>My address is <?php }?></label>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" class="form-control" name="indirizzo_transfer" id="indirizzo_transfer" value="<?php echo $indirizzo_transfer;?>" placeholder="<?php if($lingua=="ita"){?>Indirizzo<?php }else{?>Address<?php }?>" id="indirizzo_transfer3">
									</div>
								</div>				
							</div>
							<script>
								$("#checkTransfer").click(function() {
									if($("#checkTransfer").prop('checked')==true){
										document.sendRequest.transfer.value="si";
										$("#indirizzoTransfer").show();
									}else{
										$("#indirizzoTransfer").hide();
										document.getElementById('indirizzo_transfer3').value="";
										document.sendRequest.transfer.value="no";
									}
								})
							</script>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="upper" for="name"><?php if($lingua=="ita"){?>Totale dovuto<?php }else{?>Total to be paid<?php }?></label>
										<div style="float:left;">
											<input type="text" class="form-control" disabled="disabled" style="margin-right:20px; width:100px;" value="<?php /*if($totale && $totale!="") echo $totale." &euro;"; else*/ echo "0 &euro;"?>" name="tot" id="tot">
										</div>
										<div style="float:left; margin-top:-3px;" id="scontoFamiglia"></div>
										<div style="clear:both"></div>
										<input type="hidden" name="totale" id="totale" value="<?php echo $totale;?>"/>
										
									</div>
								</div>				
							</div>
							
							<div class="row"  style=" font-size:0.9em; line-height:17px;">
								<input type="hidden" name="pagamento" id="pagamento" value="<?php echo $pagamento;?>"/>
								<div class="col-md-2">
									<label class="upper" for="pagamento_val"><?php if($lingua=="ita"){?>Che viene pagato<?php }else{?>Payment method<?php }?></label>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										<input type="radio" name="pagamento_val" class="radioPagamento" <?php if($pagamento=="Paypal"){?>checked="checked"<?php }?> value="Paypal" onclick="document.sendRequest.pagamento.value=this.value;"><br/>On-line (Paypal/<?php if($lingua=="ita"){?>Carta di credito<?php }else{?>Credit Card<?php }?>)
									</div>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										<input type="radio" name="pagamento_val" class="radioPagamento" <?php if($pagamento=="Carta di Credito Presso la Scuola Vela"){?>checked="checked"<?php }?> value="Carta di Credito Presso la Scuola Vela" onclick="document.sendRequest.pagamento.value=this.value;"><br/><?php if($lingua=="ita"){?>Carta di credito presso la Scuola Vela<?php }else{?>Credit Card at the Sailing School<?php }?>
									</div>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										<input type="radio" name="pagamento_val" class="radioPagamento" <?php if($pagamento=="Bonifico"){?>checked="checked"<?php }?> value="Bonifico" id="checkBonifico" onclick="document.sendRequest.pagamento.value=this.value;"><br/><?php if($lingua=="ita"){?>Bonifico<?php }else{?>Bank transfer<?php }?>
									</div>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										<input type="radio" name="pagamento_val" class="radioPagamento" <?php if($pagamento=="Contanti/Assegno presso la Scuola Vela"){?>checked="checked"<?php }?> value="Contanti/Assegno presso la Scuola Vela" onclick="document.sendRequest.pagamento.value=this.value;"><br/><?php if($lingua=="ita"){?>Contanti/Assegno presso la Scuola Vela<?php }else{?>Cash/Check  at the Sailing School<?php }?>
									</div>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										<input type="radio" name="pagamento_val" class="radioPagamento" <?php if($pagamento=="Addebito"){?>checked="checked"<?php }?> value="Addebito" id="checkSocio" onclick="document.sendRequest.pagamento.value=this.value;"><br/><?php if($lingua=="ita"){?>Chiedo addebito sul conto del Socio YCCS<?php }else{?>Please charge to YCCS member’s account<?php }?>
									</div>
								</div>
								<div style="clear:both;"></div>
								<div style="width:100%; display:<?php if($pagamento=="Addebito"){?>block<?php }else{?>none<?php }?>" id="nome_socio">									
									<div style="float:right;">
										<input type="text" name="nome_socio_pagamento" id="nome_socio_pagamento" value="<?php echo $nome_socio_pagamento;?>" style="border:none; border-bottom:solid 1px;"/><br/>
									</div>
									<div style="float:right; width:70px; margin-top:10px; text-align:left;">
										<?php if($lingua=="ita"){?>Nome<?php }else{?>Name<?php }?>:
									</div>
									<div style="clear:both"></div>
									
									<div style="float:right;">
										<input type="text" name="cognome_socio_pagamento" id="cognome_socio_pagamento" value="<?php echo $cognome_socio_pagamento;?>" style="border:none; border-bottom:solid 1px;"/>
									</div>
									<div style="float:right; width:70px; margin-top:10px; text-align:left;">
										<?php if($lingua=="ita"){?>Cognome<?php }else{?>Surname<?php }?>:
									</div>
									<div style="clear:both"></div>										
								</div>
							</div>
							
							<div style="display:<?php if($pagamento=="Bonifico"){?>block<?php }else{?>none<?php }?>;" id="datiBonifico">
								<div class="row">
									<div class="col-md-6"></div>
									<div class="col-md-6">
										<div style=" padding:15px;">
										<b><?php if($lingua=="ita"){?>Coordinate bancarie per il pagamento con bonifico<?php }else{?>Wire transfer details<?php }?></b>:<br/>
										IBAN: IT33F0306984902100000000071<br/>
										BIC/SWIFT: BCITITMM<br/>
										</div>
									</div>
								</div>
							</div>
							
							<script>
								$(".radioPagamento").click(function() {
									if($("#checkSocio").prop('checked')==true){
										$("#nome_socio").css({"display":"block"});
									}else{
										$("#nome_socio").css({"display":"none"});
										document.sendRequest.nome_socio_pagamento.value = "";
										document.sendRequest.cognome_socio_pagamento.value = "";
									}
									if($("#checkBonifico").prop('checked')==true){
										$("#datiBonifico").css({"display":"block"});
									}else{
										$("#datiBonifico").css({"display":"none"});
									}
								})
							</script>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="upper" for="email"><?php if($lingua=="ita"){?>Note<?php }else{?>Note<?php }?></label>
										<textarea class="form-control required" name="note" id="note" rows="9" placeholder="" aria-required="true"><?php echo $note;?></textarea>						
									</div>
								</div>
							</div>
							<?php if(isset($admin) && $admin!=1){?>
								<div class="row" style="margin-top:20px;">
									<div class="col-md-12" >
										<?php if($lingua=="ita"){?>
											Se vuoi salvare i dati forniti per recuperarli in una prossima iscizione inserisci:
										<?php }else{?>
											If you want to save the data provided to retrieve them in a next inscription, enter a password:
										<?php }?>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="upper" for="name">Password</label>
											<input type="password" class="form-control required" name="password" id="password" value="" aria-required="true">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="upper" for="name"><?php if($lingua=="ita"){?>Conferma<?php }else{?>Confirm<?php }?> Password</label>
											<input type="password" class="form-control required" name="checkpassword" id="checkpassword" value="" aria-required="true">								
										</div>
									</div>
								</div>
								
								<div class="row" style="margin-top:20px;">
									<div class="col-md-12">
										<div class="form-group">
											<label class="upper" for="email"><?php if($lingua=="ita"){?>PRIVACY - Informativa ai sensi del GDPR 679/16<?php }else{?>PRIVACY POLICY pursuant to GDPR 679/16<?php }?></label>
											<?php if($lingua=="ita"){?>
												<textarea class="form-control required" name="commento"  id="commento" aria-required="true" style="text-align:left; width:100%; height:100px; " readonly>Gentile Allievo,&#13;&#10;&#13;&#10;ai sensi dell’art. 13 del “Codice in materia di protezione dei dati personali” e del Regolamento sulla protezione dei dati (GDPR, General Data Protection Regulation UE 2016/679), Yacht Club Costa Smeralda - Associazione Sportiva Dilettantistica (YCCS) in qualità di titolare del trattamento, Le fornisce l’informativa riguardante il trattamento dei dati personali degli Utenti che si iscrivono alla Scuola Vela, anche tramite i siti https://www.yccs.it/yccs-porto-cervo/yccs-sailing-school.html o http://www.yccssailingschool.it/ &#13;&#10;&#13;&#10; 1. La informiamo che i dati personali da lei forniti saranno trattati per le finalità relative all&#39;esecuzione del contratto relativo all&#39;iscrizione al corso di vela, e relativo tesseramento alla Federazione Italiana Vela (FIV). I suoi dati potranno essere trattati per le finalità interne di compilazione di liste anagrafiche, tenuta della contabilità, la fatturazione, la gestione del credito, per la soddisfazione di tutti gli obblighi previsti dalle normative vigenti, scopi statistici, per comunicazioni, e servizi da Lei esplicitamente richiesti. Riceverà le informazioni e comunicazioni inerenti le attività svolte dall’Associazione e gli inviti ad eventi dalla stessa organizzati o partecipati. &#13;&#10;&#13;&#10; 2. In relazione al rapporto che si instaura con la sottoscrizione, i dati personali in questione saranno trattati nel rispetto delle disposizioni di legge in materia di sicurezza dei dati, su supporto informatico e cartaceo da soggetti autorizzati all&#39;assolvimento di tali compiti, costantemente identificati, opportunamente istruiti e resi edotti dei vincoli imposti dal Regolamento europeo (GDPR) 679/16; con l&#39;impiego di misure di sicurezza atte a garantire la riservatezza del soggetto interessato cui i dati si riferiscono e di evitare l&#39;indebito accesso a soggetti terzi o a personale non autorizzato. &#13;&#10;&#13;&#10; 3. Il trattamento sarà effettuato, in via principale dall’organizzazione interna della azienda sotto la direzione e il controllo del Titolare del trattamento e da società da essa controllate e ad essa collegate. La conservazione dei dati avverrà in una forma che consenta l’identificazione dell’interessato per un periodo di tempo non superiore a quello necessario agli scopi per cui sono stati raccolti o successivamente trattati &#13;&#10;&#13;&#10; 4. I dati potranno essere comunicati a terze parti, esclusivamente per esigenze tecniche ed operative strettamente collegate alle finalità sopraelencate ed in particolare alle seguenti categorie di soggetti: a. Enti, professionisti, società o altre strutture da noi incaricate dei trattamenti connessi all&#39;adempimento degli obblighi amministrativi, contabili, commerciali e gestionali legati all&#39;ordinario svolgimento della nostra attività economica, anche per finalità di recupero credito; b. Alle pubbliche autorità ed amministrazioni per le finalità connesse all&#39;adempimento di obblighi legali; c. Banche, istituti finanziari o altri soggetti ai quali il trasferimento dei dati risulti necessario allo svolgimento delle attività della nostra Società in relazione all&#39;assolvimento, da parte nostra, delle obbligazioni contrattuali assunte nei Vs. confronti; d. Soggetti incaricati da Yacht Club Costa Smeralda - Associazione Sportiva Dilettantistica (YCCS) dell’esecuzione di attività direttamente connesse o strumentali all’erogazione e alla distribuzione dei servizi offerti tramite il sito WEB. &#13;&#10;&#13;&#10; 5. Il Suo rifiuto al trattamento dei dati comporterà l&#39;impossibilità, da parte nostra, di erogare i servizi richiesti ed di adempiere agli obblighi di legge. &#13;&#10;&#13;&#10; 6. Il titolare del trattamento è Yacht Club Costa Smeralda - Associazione Sportiva Dilettantistica (YCCS) nella persona del Segretario Generale pro tempore, E-mail: privacy@yccs.it. &#13;&#10;&#13;&#10; 7. Trasferimento dei dati personali: i suoi dati non saranno trasferiti né in Stati membri dell’Unione Europea né in Paesi terzi non appartenenti all’Unione Europea. &#13;&#10;&#13;&#10; 8. Diritti dell’interessato: in ogni momento, Lei potrà esercitare, ai sensi dell’art. 7 del D. Lgs. 196/2003 e degli articoli dal 15 al 22 del Regolamento UE n. 2016/679, ed in particolare il diritto di: a. chiedere la conferma dell’esistenza o meno di propri dati personali; b. ottenere le indicazioni circa le finalità del trattamento, le categorie dei dati personali, i destinatari o le categorie di destinatari a cui i dati personali sono stati o saranno comunicati e, quando possibile, il periodo di conservazione; c. ottenere la rettifica e la cancellazione dei dati; d. proporre reclamo a un’autorità di controllo. &#13;&#10;&#13;&#10; Può esercitare i Suoi diritti con richiesta scritta inviata a Yacht Club Costa Smeralda - Associazione Sportiva Dilettantistica (YCCS) Loc. Porto Cervo Marina-Edificio Yacht Club-07021-Porto Cervo (OT), oppure una e-mail all’indirizzo: privacy@yccs.it; oppure una PEC: yachtcostasmeralda@pec.it </textarea>								
											<?php }else{?>
												<textarea class="form-control required" name="commento"  id="commento" aria-required="true" style="text-align:left; width:100%; height:100px; " readonly>Dear Student,&#13;&#10;&#13;&#10; pursuant to art. 13 of the Data Protection Law and of the GDPR (General Data Protection EU Regulation 2016/679), the Yacht Club Costa Smeralda - Amateur Sporting Association (YCCS) as data controller provides the following information regarding the processing of personal data for users who enrol in the sailing school, including through the websites https://www.yccs.it/yccs-porto-cervo/yccs-sailing-school.html or http://www.yccssailingschool.it/ &#13;&#10; We inform you that the personal information you provide will be processed for the purposes relating to the execution of the contract of enrolment in the sailing course, and relative membership of the Italian Sailing Federation (FIV). Your data may be used for the internal purposes of compiling registry lists, bookkeeping, invoicing, credit management, to satisfy all legal obligations, for statistical purposes, for communications and for services explicitly requested by you. You will receive information and communications regarding the activities of the association and invitations to events organised by or participated in by the same. &#13;&#10; With regards to the relationship that is established through enrolment, your personal data will be processed in compliance with the legal provisions on data security in electronic and paper form by those authorised to carry out such tasks, who are constantly identified, suitably trained and made aware of the constraints imposed by the European regulation (GDPR) 679/16; with the use of security measures to guarantee confidentiality for the person to whom the information relates and to avoid undue access by third parties or unauthorised personnel. &#13;&#10; The treatment will be carried out primarily by the company's internal structures under the direction and control of the data controller and by subsidiaries and affiliates. Data retention will be in a form which permits identification of data for a period of time not exceeding that necessary for the purposes for which it was collected or subsequently processed.&#13;&#10; The data may be disclosed to third parties, exclusively for technical and operational requirements closely related to the purposes listed above and in particular to the following categories:&#13;&#10; Organisations, professionals, companies or other structures charged by us with processing in relation to the fulfilment of administrative, accounting, commercial and management obligations relating to our ordinary business activities, as well as for credit recovery purposes;&#13;&#10; Public authorities and administrations for purposes related to the fulfilment of legal obligations;&#13;&#10; Banks, financial institutions or other parties to whom the transfer of data is necessary to carry out our company activities in relation to the fulfilment of our contractual obligations towards you;&#13;&#10; Parties appointed by the Yacht Club Costa Smeralda - Amateur Sports Association (YCCS) to execute activities directly connected with or instrumental to the provision and delivery of services offered via the website.&#13;&#10; Your refusal to allow processing of the data referred to in clause 1 of this policy will render it impossible for us to provide the services requested and to fulfil our legal obligations.&#13;&#10; The data controller is the Yacht Club Costa Smeralda  - Amateur Sporting Association (YCCS), in the person of the Secretary General pro-tempore, e-mail: privacy@yccs.it.&#13;&#10; Transfer of personal data: your data will not be transferred to EU Member States or third countries outside of the European Union.&#13;&#10; Data subject's rights: you may exercise you rights at any time, pursuant to art. 7 of Law Decree 196/2003 and articles 15 to 22 of EU Regulation no. 2016/679, in particular the right to:&#13;&#10; request confirmation of the existence or otherwise of your personal data;&#13;&#10; obtain information about the purposes of the processing, the categories of personal data, the recipients or categories of recipients to whom the personal data have been or will be disclosed and, whenever possible, the retention period;&#13;&#10;rectification and erasure of data;&#13;&#10;lodge a complaint with a supervising authority.&#13;&#10; You may exercise your rights via written request to the Yacht Club Costa Smeralda - Amateur Sporting Association (YCCS), loc. Porto Cervo - Yacht Club Building - Porto Cervo 07021 – (OT, Italy), or by e-mail to: privacy@yccs.it; or certified email: yachtcostasmeralda@pec.it&#13;&#10;
												</textarea>							
											<?php }?>			
										</div>
									</div>
								</div>
								
								<div class="row" style="text-align:center; margin-top:20px;">
									<div class="col-md-12" >
										<input type="hidden" name="privacy" id="privacy" value='0'/>
										<?php if($lingua=="ita"){?>
											<b>Si precisa che il conferimento dei suoi dati personali è obbligatorio al fine di adempiere agli obblighi derivanti dal contratto. Il Titolare del trattamento dei dati è lo Yacht Club Costa Smeralda. La diffusione ed il trattamento dei propri dati è necessario per le finalità informative e/o connesse o comunque utili alla prestazione della attività di cui sopra da parte della YCCS Sailing School, sia su carta stampata che mediante strumenti elettronici.</b>
										<?php }else{?>
											<b>Please be aware that provision of your personal data is mandatory inorder to fulfil our contractual obligations. The data controller is Yacht Club Costa Smeralda. Disclosure andprocessing of your data is necessary for informative purposes and/or purposesrelating to provision of the abovementioned service or activity by the YCCSSailing School, either through print or electronic instruments.</b>
										<?php }?>
										<br/><br/>
										<input type="radio" name="diffusione_dati_val" onclick="document.sendRequest.privacy.value='1'"/><?php if($lingua=="ita"){?>&nbsp;Autorizzo<?php }else{?>&nbsp;Accept<?php }?>
										<input type="radio" name="diffusione_dati_val" onclick="document.sendRequest.privacy.value='0'"/><?php if($lingua=="ita"){?>&nbsp;Non Autorizzo<?php }else{?>&nbsp;Refuse<?php }?>
									</div>
								</div>
								<div style="text-align:left; margin-top:10px;">
									<span style="  font-style:italic; font-size:0.9em">*<?php if($lingua=="ita"){?>campi obbligatori<?php }else{?>required fields<?php }?></span>
									<br/>
									<span style="  font-style:italic; font-size:0.9em">**<?php if($lingua=="ita"){?>Il Codice Fiscale è obbligatorio solo se sei nato in italia<?php }else{?>The tax code is required only for those born in Italy<?php }?></span>
								</div>
							<?php }?>
							<div class="row" style="margin-top:10px;">
								<div class="col-md-12">
									<div class="form-group text-center">
										<div class="g-recaptcha" data-callback="recaptchaCallback"  style="width:305px; margin:0 auto; margin-bottom:20px;" data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
										<?php if($admin!=1){?>
											<?php if($conferma==1){?>
												<script>
													document.sendRequest.stato.value='conferma';
												</script>
												<button class="btn btn-primary buttSubmit" disabled="disabled" type="button" onclick="checkForm()"><?php if($lingua=="ita"){?>CONFERMA DATI<?php }else{?>CONFIRM<?php }?></button>
											<?php }else{?>
												<button class="btn btn-danger buttSubmit" disabled="disabled" type="button" onclick="checkForm()"><?php if($lingua=="ita"){?>INVIA DATI<?php }else{?>SUBMIT<?php }?></button>
											<?php }?>
										<?php }elseif($admin==1){?>
											<button class="btn btn-primary buttSubmit" disabled="disabled" type="button" onclick="document.sendRequest.stato.value='salva'; checkForm()">SALVA</button>
											<button class="btn btn-primary buttSubmit" disabled="disabled" type="button" onclick="document.sendRequest.stato.value='salva_e_invia'; checkForm()"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;SALVA E INVIA</button>
										<?php }?>
										<script>
											function recaptchaCallback(){
												$(".buttSubmit").prop("disabled", false);
											}
										</script>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				<script>
					var num_pers=0;
					var num_mezza=0;
					function aggiungiPersona(id_ute='',fam='0'){
						num_pers++;							
						if(num_pers>1) {
							var txt = '<div id="dati_personali_'+num_pers+'"></div>';
							$("#dati_personali").append(txt); 
						}
						document.getElementById('num_pers').value=num_pers;
						if(num_pers>1) {
							$.ajax({
								url: "ajax/dati_iscrizione_scuola.php", 
								type: "GET",
								data: {
										id_pers : num_pers, 
										lingua : '<?php echo $lingua;?>',
										id_ute : id_ute, 
										fam : fam
									}, 
								success: function(result){
								$("#dati_personali_"+num_pers).html(result);
								document.getElementById(num_pers+'_dal').value = document.getElementById('1_dal').value;
								document.getElementById(num_pers+'_al').value = document.getElementById('1_al').value;
								document.getElementById(num_pers+'_indirizzo').value = document.getElementById('1_indirizzo').value;
								document.getElementById(num_pers+'_cap').value = document.getElementById('1_cap').value;
								document.getElementById(num_pers+'_citta').value = document.getElementById('1_citta').value;
								document.getElementById(num_pers+'_provincia').value = document.getElementById('1_provincia').value;
								document.getElementById(num_pers+'_nazione').value = document.getElementById('1_nazione').value;
							}});
						}else{
							$.ajax({
								url: "ajax/dati_iscrizione_scuola.php", 
								type: "GET",
								data: {
										id_pers : num_pers, 
										lingua : '<?php echo $lingua;?>',
										id_ute : id_ute, 
									
										nome : '<?php echo str_replace("'","\'",$nome);?>',
										cognome : '<?php echo str_replace("'","\'",$cognome);?>',
										indirizzo : '<?php echo str_replace("'","\'",$indirizzo);?>',
										cap : '<?php echo $cap;?>',
										citta : '<?php echo str_replace("'","\'",$citta);?>',
										provincia : '<?php echo $provincia;?>',
										nazione : '<?php echo $nazione;?>',
										luogo_nascita : '<?php echo $luogo_nascita;?>',
										nazione_nascita : '<?php echo $nazione_nascita;?>',
										data_nascita : '<?php echo $data_nascita;?>',
										codice_fiscale : '<?php echo $codice_fiscale;?>',
										tesseramento : '<?php echo $tesseramento;?>',
										gia_tesserato : '<?php echo $gia_tesserato;?>',
										circolo : '<?php echo $circolo;?>',
										tipo : '<?php echo $tipo;?>',
										costo_settimane_in_piu : '<?php echo $costo_settimane_in_piu;?>',
										costo_giorni_in_piu : '<?php echo $costo_giorni_in_piu;?>',
										costo_mezza_settimana : '<?php echo $costo_mezza_settimana;?>',
										costo_prima_sett : '<?php echo $costo_prima_sett;?>',
										num_settimane : '<?php echo $num_settimane;?>',
										<?php if(isset($num_settimane_2)){?>num_settimane_2 : '<?php echo $num_settimane_2;?>',<?php }?>
										num_giorni : '<?php echo $num_giorni;?>',
										<?php if(isset($num_settimane_2)){?>num_giorni_2 : '<?php echo $num_giorni_2;?>',<?php }?>
										durata : '<?php echo $durata;?>',
										CI : '<?php echo $CI;?>',
										CF : '<?php echo $CF;?>',
										CM : '<?php echo $CM;?>',
										
										fam : '<?php echo $fam;?>'
									}, 
								success: function(result){
								$("#dati_personali_"+num_pers).html(result);
								document.getElementById(num_pers+'_dal').value = document.getElementById('1_dal').value;
								document.getElementById(num_pers+'_al').value = document.getElementById('1_al').value;
								document.getElementById(num_pers+'_indirizzo').value = document.getElementById('1_indirizzo').value;
								document.getElementById(num_pers+'_cap').value = document.getElementById('1_cap').value;
								document.getElementById(num_pers+'_citta').value = document.getElementById('1_citta').value;
								document.getElementById(num_pers+'_provincia').value = document.getElementById('1_provincia').value;
								document.getElementById(num_pers+'_nazione').value = document.getElementById('1_nazione').value;
							}});
						}
					}
					aggiungiPersona( '<?php if(isset($id)) echo $id;?>','<?php echo $fam;?>');
					
					function isValidDate(dateString) {
					  var regEx = /^\d{2}-\d{2}-\d{4}$/;
					  if(!dateString.match(regEx)) return false;  // Invalid format
					  var res = dateString.split("-");
					  var dataNew = res[2]+"-"+res[1]+"-"+res[0];
					 // return dataNew;
					  var d = new Date(dataNew);
					  var dNum = d.getTime();
					  if(!dNum && dNum !== 0) return false; // NaN value, Invalid date
					  return d.toISOString().slice(0,10) === dataNew;			  
					}

					Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
					function checkForm(){		
						var check = 0;
						var ind=1;
						if (document.getElementById(ind+'_dal').value!="" && isValidDate(document.getElementById(ind+'_dal').value)==false) alert('<?php if($lingua=="eng"){?>Insert a valid date for "Period from" (dd-mm-yyyy)<?php } else {?>Inserisci data valida per "Periodo dal" (gg-mm-aaaa)<?php }?>');			
						else if (document.getElementById(ind+'_al').value!="" && isValidDate(document.getElementById(ind+'_al').value)==false) alert('<?php if($lingua=="eng"){?>Insert a valid date for "Period to" (dd-mm-yyyy)<?php } else {?>Inserisci data valida per "Periodo al" (gg-mm-aaaa)<?php }?>');			
						else if (document.getElementById(ind+'_nome').value=="") alert('<?php if($lingua=="eng"){?>"Name" required<?php } else {?>Campo "Nome" obbligatorio<?php }?>');			
						else if (document.getElementById(ind+'_cognome').value=="") alert('<?php if($lingua=="eng"){?>"Surname" required<?php } else {?>Campo "Cognome" obbligatorio<?php }?>');			
						else if (document.getElementById(ind+'_indirizzo').value=="") alert('<?php if($lingua=="eng"){?>"Address" required<?php } else {?>Campo "Indirizzo" obbligatorio<?php }?>');			
						else if (document.getElementById(ind+'_cap').value=="") alert('<?php if($lingua=="eng"){?>"ZIP code" required<?php } else {?>Campo "Cap" obbligatorio<?php }?>');			
						else if (document.getElementById(ind+'_citta').value=="") alert('<?php if($lingua=="eng"){?>"City" required<?php } else {?>Campo "Citta" obbligatorio<?php }?>');			
						else if (document.getElementById(ind+'_provincia').value=="") alert('<?php if($lingua=="eng"){?>"Prov" required<?php } else {?>Campo "provincia" obbligatorio<?php }?>');			
						else if (document.getElementById(ind+'_nazione').value=="") alert('<?php if($lingua=="eng"){?>"Nation" required<?php } else {?>Campo "nazione" obbligatorio<?php }?>');			
						else if (document.getElementById(ind+'_luogo_nascita').value=="") alert('<?php if($lingua=="eng"){?>"Birth place" required<?php } else {?>Campo "Luogo Nascita" obbligatorio<?php }?>');			
						else if (document.getElementById(ind+'_nazione_nascita').value=="") alert('<?php if($lingua=="eng"){?>"Prov" required<?php } else {?>Campo "Nazione Nascita" obbligatorio<?php }?>');			
						else if (document.getElementById(ind+'_data_nascita').value=="") alert('<?php if($lingua=="eng"){?>"Birth Date" required<?php } else {?>Campo "Data Nascita" obbligatorio<?php }?>');			
						else if (isValidDate(document.getElementById(ind+'_data_nascita').value)==false)  alert('<?php if($lingua=="eng"){?>Insert a valid Birth Date (dd-mm-yyyy)<?php } else {?>Inserisci una Data Nascita valida (gg-mm-aaaa)<?php }?>');			
						else if (document.getElementById(ind+'_codice_fiscale').value=="" && document.getElementById(ind+'_nazione_nascita').value=="Italy") alert('<?php if($lingua=="eng"){?>"Tax Code" required<?php } else {?>Campo "Codice Fiscale" obbligatorio<?php }?>');
						else if ((document.getElementById(ind+'_gia_tesserato').value=="" || document.getElementById(ind+'_gia_tesserato').value=="no") && (document.getElementById(ind+'_tesseramento').value=="no" || document.getElementById(ind+'_tesseramento').value=="")) alert('<?php if($lingua=="eng"){?>Inserire la richiesta della Tessera FIV o specificare di essere già tesserati FIV<?php }else{?>Inserire la richiesta della Tessera FIV o specificare di essere già tesserati FIV<?php }?>');
						else if (document.getElementById(ind+'_gia_tesserato').value=="si" && document.getElementById(ind+'_circolo').value=="") alert('<?php if($lingua=="eng"){?>Inserisci il nome del Circolo con il quale sei tesserato<?php } else {?>Inserisci il nome del Circolo con il quale sei tesserato<?php }?>');
						else if ((document.getElementById(ind+'_durata').value=="Ho già fatto la prima settimana" || document.getElementById(ind+'_durata').value=="I've already done the first week") &&  document.getElementById(ind+'_num_settimane_2').value==""  &&  document.getElementById(ind+'_num_giorni_2').value=="" ) alert('<?php if($lingua=="eng"){?>Please insert number of weeks or days following the first week<?php } else {?>Inserire settimane o giorni successivi alla prima settimana<?php }?>');
						else if (document.getElementById(ind+'_CM').value=="" && (!window[ind+'_CM_existing'] || window[ind+'_CM_existing']=="")) alert('<?php if($lingua=="eng"){?>"Medical certificate" required<?php } else {?>Campo "Certificato medico" obbligatorio<?php }?>');
						else if (document.getElementById(ind+'_tesseramento').value!="si" && document.getElementById(ind+'_tipo').value=="" && (document.getElementById(ind+'_extra_box').style.display=='none' || (document.getElementById(ind+'_extra_box').style.display=='block' && parseInt(document.getElementById(ind+'_num_extra').value)<1))) alert('<?php if($lingua=="eng"){?>"Type of Courses" or "FIV Card" required<?php } else {?>Campo "Tipologia del corso" o "Tessera FIV" obbligatorio<?php }?>');
						else check++;
								
						// FAMILIARI AGGIUNTIVI
						if(num_pers>1){
							for(ind=2; ind<=num_pers; ind++){
								if(document.getElementById('dati_personali_'+ind).style.display!="none"){
									if (document.getElementById(ind+'_dal').value!="" && isValidDate(document.getElementById(ind+'_dal').value)==false) alert('<?php if($lingua=="eng"){?>Insert a valid date for "Period from" (dd-mm-yyyy) for Additional member of the family'+(ind-1)+'<?php } else {?>Inserisci data valida per "Periodo dal" (gg-mm-aaaa)<?php }?> per Familiare Aggiuntivo '+(ind-1)+'');			
									else if (document.getElementById(ind+'_al').value!="" && isValidDate(document.getElementById(ind+'_al').value)==false) alert('<?php if($lingua=="eng"){?>Insert a valid date for "Period to" (dd-mm-yyyy) for Additional member of the family'+(ind-1)+'<?php } else {?>Inserisci data valida per "Periodo al" (gg-mm-aaaa)<?php }?> per Familiare Aggiuntivo '+(ind-1)+'');			
									else if (document.getElementById(ind+'_nome').value=="") alert('<?php if($lingua=="eng"){?>"Name" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "Nome" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (document.getElementById(ind+'_cognome').value=="") alert('<?php if($lingua=="eng"){?>"Surname" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "Cognome" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (document.getElementById(ind+'_indirizzo').value=="") alert('<?php if($lingua=="eng"){?>"Address" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "Indirizzo" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (document.getElementById(ind+'_cap').value=="") alert('<?php if($lingua=="eng"){?>"ZIP code" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "Cap" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (document.getElementById(ind+'_citta').value=="") alert('<?php if($lingua=="eng"){?>"City" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "Citta" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (document.getElementById(ind+'_provincia').value=="") alert('<?php if($lingua=="eng"){?>"County" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "provincia" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (document.getElementById(ind+'_nazione').value=="") alert('<?php if($lingua=="eng"){?>"Country" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "nazione" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (document.getElementById(ind+'_luogo_nascita').value=="") alert('<?php if($lingua=="eng"){?>"Place of Birth" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "Luogo Nascita" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (document.getElementById(ind+'_nazione_nascita').value=="") alert('<?php if($lingua=="eng"){?>"Birth Country" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "Nazione Nascita" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (document.getElementById(ind+'_data_nascita').value=="") alert('<?php if($lingua=="eng"){?>"Birth Date" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "Data Nascita" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');			
									else if (isValidDate(document.getElementById(ind+'_data_nascita').value)==false)  alert('<?php if($lingua=="eng"){?>Insert a valid Birth Date for Additional member of the family'+(ind-1)+' (dd-mm-yyyy)<?php } else {?>Inserisci una Data Nascita valida per Familiare Aggiuntivo '+(ind-1)+' obbligatorio (gg-mm-aaaa)<?php }?>');			
									else if (document.getElementById(ind+'_codice_fiscale').value=="" && document.getElementById(ind+'_nazione_nascita').value=="Italy") alert('<?php if($lingua=="eng"){?>"Tax Code" required for Additional member of the family'+(ind-1)+'<?php } else {?>Campo "Codice Fiscale" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');
									else if ((document.getElementById(ind+'_gia_tesserato').value=="" || document.getElementById(ind+'_gia_tesserato').value=="no") && (document.getElementById(ind+'_tesseramento').value=="no" || document.getElementById(ind+'_tesseramento').value=="")) alert('<?php if($lingua=="eng"){?>Fiv Card or Club Name for Additional member of the family'+(ind-1)+'<?php }else{?>Inserire la richiesta della Tessera FIV o specificare di essere già tesserati FIV per Familiare Aggiuntivo'+(ind-1)+'<?php }?>');
									else if (document.getElementById(ind+'_gia_tesserato').value=="si" && document.getElementById(ind+'_circolo').value=="") alert('<?php if($lingua=="eng"){?>Club Name for Additional member of the family'+(ind-1)+'<?php } else {?>Inserisci il nome del Circolo con il quale sei tesserato<?php }?>');
									else if ((document.getElementById(ind+'_durata').value=="Ho già fatto la prima settimana" || document.getElementById(ind+'_durata').value=="I've already done the first week") &&  document.getElementById(ind+'_num_settimane_2').value==""  &&  document.getElementById(ind+'_num_giorni_2').value=="" ) alert('<?php if($lingua=="eng"){?>Please insert number of weeks or days following the first week for Additional member of the family'+(ind-1)+'<?php } else {?>Inserire settimane o giorni successivi alla prima settimana per Familiare Aggiuntivo'+(ind-1)+'<?php }?>');
									else if (document.getElementById(ind+'_CM').value=="" && (!window[ind+'_CM_existing'] || window[ind+'_CM_existing']=="")) alert('<?php if($lingua=="eng"){?>"Medical certificate" required for Additional member of the family '+(ind-1)+'<?php } else {?>Campo "Certificato medico" Familiare Aggiuntivo '+(ind-1)+' obbligatorio<?php }?>');
									else if (document.getElementById(ind+'_tesseramento').value!="si" && document.getElementById(ind+'_tipo').value=="" && (document.getElementById(ind+'_extra_box').style.display=='none' || (document.getElementById(ind+'_extra_box').style.display=='block' && parseInt(document.getElementById(ind+'_num_extra').value)<1))) alert('<?php if($lingua=="eng"){?>"Type of Courses" or "FIV Card" required<?php } else {?>Campo "Tipologia del corso" o "Tessera FIV" obbligatorio<?php }?>');
									else check++;
								}
							}
						}
						if(check != num_pers) {}
						//if(0) {}
						else if (document.getElementById('prefix_telefono1').value=="") alert('<?php if($lingua=="eng"){?>"Phone 1 prefix" required<?php } else {?>Campo "Prefisso Cellulare" obbligatorio<?php }?>');			
						else if (document.getElementById('telefono1').value=="") alert('<?php if($lingua=="eng"){?>"Phone 1" required<?php } else {?>Campo "Cellulare" obbligatorio<?php }?>');			
						else if (isNaN(document.getElementById('telefono1').value) && document.getElementById('telefono1').value!="") alert('<?php if($lingua=="eng"){?>Enter a valid phone number (only digits)<?php } else {?>Inserisci un numero di telefono corretto (solo numeri)<?php }?>');
						else if (document.getElementById('telefono2').value!="" && document.getElementById('prefix_telefono2').value=="") alert('<?php if($lingua=="eng"){?>"Phone 2 prefix" required<?php } else {?>Campo "Prefisso Tel casa" obbligatorio<?php }?>');			
						else if (document.getElementById('fax').value!="" && document.getElementById('prefix_fax').value=="") alert('<?php if($lingua=="eng"){?>"Fax prefix" required<?php } else {?>Campo "Prefisso Fax" obbligatorio<?php }?>');			
						else if (document.getElementById('email').value=="") alert('<?php if($lingua=="eng"){?>"Email" required<?php } else {?>Campo "Email" obbligatorio<?php }?>');			
						else if (Filtro.test(document.getElementById('email').value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
						else if (document.getElementById('email_conf').value=="") alert('<?php if($lingua=="eng"){?>"Confirm Email" required<?php } else {?>Campo "Conferma Email" obbligatorio<?php }?>');			
						else if (document.getElementById('email_conf').value!=document.getElementById('email').value) alert('<?php if($lingua=="eng"){?>"Eamil" and "Confirm Email" must be the same<?php } else {?>I Campi "Email" e "Conferma Email" devono essere uguali<?php }?>');			
						else if (document.getElementById('transfer').value=="si" && document.getElementById('indirizzo_transfer').value=="") alert('<?php if($lingua=="eng"){?>Enter transfer address)<?php } else {?>Inserisci l\'indirizzo per il servizio di transfer<?php }?>');				
						<?php if($admin!=1){?>
							else if (document.getElementById('pagamento').value=="") alert('<?php if($lingua=="eng"){?>"Type of payment" required<?php } else {?>Inserire il metodo di pagamento<?php }?>');
							else if (document.getElementById('pagamento').value=="Addebito" && (document.getElementById('nome_socio_pagamento').value=="" || document.getElementById('cognome_socio_pagamento').value=="")) alert('<?php if($lingua=="eng"){?>"Type of payment" required<?php } else {?>Inserire Nome e Cognome del socio YCCS sul cui conto si addebita il pagamento<?php }?>');
							else if (document.getElementById('password').value!="" && document.getElementById('checkpassword').value=="") alert('<?php if($lingua=="eng"){?>"Confirm Password" required<?php } else {?>Campo "Conferma Password" obbligatorio<?php }?>');
							else if (document.getElementById('password').value!=document.getElementById('checkpassword').value) alert('<?php if($lingua=="eng"){?>"Password" and "Conferma Password" doesn\'t match<?php } else {?>"Password" e "Conferma Password" non corrispondono<?php }?>');
							else if (document.getElementById('privacy').value=="0") alert('<?php if($lingua=="eng"){?>Privacy required<?php } else {?>Autorizzazione della privacy obbligatoria<?php }?>');
						<?php }?>
						else document.sendRequest.submit();			
					}
				</script>
				<!--END: Default Form-->
				<hr class="space">
			@else
				<div style="text-align:center; font-size:1.8em"><br/><br/><br/><b>Coming soon...</b><br/><br/><br/></div>
			@endif
		</div>
	</section>
@endsection