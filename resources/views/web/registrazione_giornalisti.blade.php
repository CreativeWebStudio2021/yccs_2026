@extends('web.index')

@section('content')
	@php		
		$video_background = "web/video/Regate-generiche-1920x500.mp4";
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='YCCS Porto Cervo'; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.comunicati nome pagina'); $breadcrumbs[$x]['link']='yccs-porto-cervo/comunicati.html'; if($lingua=="eng") $breadcrumbs[$x]['link'] = "en/".$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	@include('web.assets.la_storia_css')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">					
					<div style="width:100%; display:flex; gap:35px;">
						<h3 class="gradient-title"><?php if($lingua=="ita"){?>Registrazione Giornalisti<?php }else{?>Journalist Registration<?php }?></h3>
						<div style="flex:1;">
							<div class="link-arrow" style="width:163px !important; gap:47px !important; margin-top:50px; padding-left:calc(100% - 163px); padding-bottom:7px; border-bottom:solid 2px;">
							 
							</div>
						</div>
					</div>
					
					@if( count($errors) > 0)
						@foreach($errors->all() as $error)
							<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="background:{{ $message_color }}">
								<div style="float:left; width:90%;">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">{{ trans('labels.Error') }}:</span>
									{{ $error }}
								</div>
								<div style="float:right; width:10%; text-align:right; cursor:pointer;" onclick="$('#errorMessage').fadeOut();"><b>x</b></div>
								<div style="clear:both"></div>
							</div>
						@endforeach
					@endif
					
					<div style="margin-top:30px">
						<?php if($lingua=="ita"){?>
							<p>
								Tramite il seguente modulo è possibile richiedere l’accredito media per gli eventi sportivi in calendario.
								<br/>
								Per ulteriori informazioni contattare l’Ufficio Stampa YCCS: mail <a href="mailto:pressoffice@yccs.it" class="azzurro">pressoffice@yccs.it</a> , tel. <a href="tel:+390789902223" class="azzurro">+39  0789 902223</a>.
								
							</p>
						<?php }else{?>
							<p>
								Please complete the form below to request media accreditation for sporting events.
								<br/>
								For more information, please contact the YCCS Press Office: mail <a href="mailto:pressoffice@yccs.it" class="azzurro">pressoffice@yccs.it</a> , tel. <a href="tel:+390789902223" class="azzurro">+39  0789 902223</a>.
							
							</p>
						<?php }?>
						<div style="clear:both;height:30px;border-bottom:1px solid #eee;margin-bottom:50px;">&nbsp;</div>
						
						@php
							if(!isset($nome)) $nome = "";
							if(!isset($cognome)) $cognome = "";
							if(!isset($pubblicazione)) $pubblicazione = "";
							if(!isset($regata)) $regata = "";
							if(!isset($indirizzo)) $indirizzo = "";
							if(!isset($cap)) $cap = "";
							if(!isset($paese)) $paese = "";
							if(!isset($email)) $email = "";
							if(!isset($email2)) $email2 = "";
							if(!isset($telefono)) $telefono = "";
							if(!isset($cellulare)) $cellulare = "";
							if(!isset($fax)) $fax = "";
							if(!isset($privacy)) $privacy="0";
							
							$link_form = "registrazione-giornalisti-conferma.html";
							if($lingua=="eng")$link_form = "en/registrazione-giornalisti-conferma.html";
						@endphp
						
						<style>
							.form-group label:not(.error) {font-weight: 600; color:#111111}
							.form-gray-fields .form-control {
								background-color: #f2f2f2;
								border-color: #e9e9e9;
								color: #333;
							}
						</style>
						
						<form action="{{ $link_form }}" class="form-gray-fields" method="post" name="registrationForm" id="registrationForm" autocomplete="off">
							@csrf
							<input type="hidden" name="stato_reg" value="1"/>
							<div class="row">
								<div class="form-group col-sm-12">
									<label for="regata"><?php if($lingua=="ita"){?>Regata<?php } else {?>Regatta<?php }?> *</label>
									<input type="text" class="form-control" id="regata" name="regata"  required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" value="<?php  echo $regata; ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="nome"><?php if($lingua=="ita"){?>Nome<?php } else {?>Name<?php }?> *</label>
									<input type="text" class="form-control" id="nome" name="nome" required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" value="<?php  echo $nome; ?>">
								</div>
								
								<div class="form-group col-sm-6">
									<label for="cognome"><?php if($lingua=="ita"){?>Cognome<?php } else {?>Surname<?php }?> *</label>
									<input type="text" class="form-control" id="cognome" name="cognome" required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" value="<?php  echo $cognome; ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-12">
									<label for="pubblicazione"><?php if($lingua=="ita"){?>Testata<?php } else {?>Company name<?php }?> *</label>
									<input type="text" class="form-control" id="pubblicazione" name="pubblicazione" required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" value="<?php  echo $pubblicazione; ?>">
								</div>
							</div>
							<div class="row">	
								<div class="form-group col-sm-6">
									<label for="indirizzo"><?php if($lingua=="ita"){?>Indirizzo<?php } else {?>Address<?php }?></label>
									<input type="text" class="form-control" id="indirizzo" name="indirizzo" value="<?php  echo $indirizzo; ?>">
								</div>
								
								<div class="form-group col-sm-6">
									<label for="cap"><?php if($lingua=="ita"){?>Cap<?php } else {?>Postcode<?php }?></label>
									<input type="text" class="form-control" id="cap" name="cap" value="<?php  echo $cap; ?>">
								</div>
							</div>	
							<div class="row">
								<div class="form-group col-sm-12">
									<label for="paese"><?php if($lingua=="ita"){?>Paese di Residenza<?php } else {?>Country of Residence<?php }?></label>
									<input type="text" class="form-control" id="paese" name="paese" value="<?php  echo $paese; ?>">
								</div>
							</div>
							
							
							<div class="row">
								<input type="hidden" name="ruolo" value=""/>
								<div class="form-group col-md-4">
									<label for="esperienza_val"><?php if($lingua=="ita"){?>Ruolo<?php }else{?>Occupation<?php }?></label>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										@php if($lingua=="ita") $value="Giornalista"; else $value="Journalist" @endphp										
										<input type="radio" name="ruolo_val" value="{!! $value !!}" onclick="document.registrationForm.ruolo.value=this.value;"><br/>{!! $value !!}
									</div>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										@php if($lingua=="ita") $value="Fotografo"; else $value="Photographer" @endphp	
										<input type="radio" name="ruolo_val" value="{!! $value !!}" onclick="document.registrationForm.ruolo.value=this.value;"><br/>{!! $value !!}
									</div>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										@php if($lingua=="ita") $value="Operatore"; else $value="Cameraman" @endphp	
										<input type="radio" name="ruolo_val" value="{!! $value !!}" onclick="document.registrationForm.ruolo.value=this.value;"><br/>{!! $value !!}
									</div>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										@php if($lingua=="ita") $value="Altro"; else $value="Other" @endphp	
										<input type="radio" name="ruolo_val" value="{!! $value !!}" onclick="document.registrationForm.ruolo.value=this.value;"><br/>{!! $value !!}
									</div>
								</div>
							</div>
							
							<div style="clear:both;height:20px;border-bottom:1px solid #eee;margin-bottom:20px;">&nbsp;</div>
							
							<div class="row">
								<input type="hidden" name="comunicazioni" value=""/>
								<div class="form-group col-md-8">
									<label for="esperienza_val">
										<?php if($lingua=="ita"){?>
											Vorrei ricevere i comunicati stampa  per questo e per altri eventi YCCS
										<?php }else{?>
											I would like to receive YCCS press releases for this and other events
										<?php }?>
										</label>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										@php if($lingua=="ita") $value="Sì"; else $value="Yes" @endphp										
										<input type="radio" name="comunicazioni_val" value="{!! $value !!}" onclick="document.registrationForm.comunicazioni.value=this.value;"><br/>{!! $value !!}
									</div>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										@php if($lingua=="ita") $value="No"; else $value="No" @endphp	
										<input type="radio" name="comunicazioni_val" value="{!! $value !!}" onclick="document.registrationForm.comunicazioni.value=this.value;"><br/>{!! $value !!}
									</div>
								</div>								
							</div>
							
							<div style="clear:both;height:20px;border-bottom:1px solid #eee;margin-bottom:20px;">&nbsp;</div>
							
							<div class="row" style="padding-bottom:10px;">
								<div class="col-md-6">
									<div class="form-group">
										<label class="upper">
											<?php if($lingua=="ita"){?>
												Giorno di arrivo
											<?php }else{?>
												Arrival Date
											<?php }?>
										</label>
										<input type="text" class="form-control mws-datepicker required"  name="data_arrivo" id="data_arrivo" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="upper">
											<?php if($lingua=="ita"){?>
												Giorno di partenza
											<?php }else{?>
												Departure Date
											<?php }?>
										</label>
										<input type="text" class="form-control mws-datepicker required"  name="data_partenza" id="data_partenza" value="">
									</div>
								</div>
							</div>
							
							<div class="row" style="padding-bottom:10px;">
								<input type="hidden" name="barca_stampa" value=""/>
								<div class="form-group col-md-8">
									<label for="esperienza_val">
										<?php if($lingua=="ita"){?>
											Richiesta  barca stampa<br/>
										<?php }else{?>
											Request press boat<br/>											
										<?php }?>
										</label>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										@php if($lingua=="ita") $value="Sì"; else $value="Yes" @endphp										
										<input type="radio" name="barca_stampa_val" value="{!! $value !!}" onclick="document.registrationForm.barca_stampa.value=this.value; document.getElementById('giornate_box').style.display='block'; document.getElementById('giornate').setAttribute('required','required');"><br/>{!! $value !!}
									</div>
								</div>
								<div class="col-md-2" style="text-align:center;">
									<div style="text-align:center;">
										@php if($lingua=="ita") $value="No"; else $value="No" @endphp	
										<input type="radio" name="barca_stampa_val" value="{!! $value !!}" onclick="document.registrationForm.barca_stampa.value=this.value; document.getElementById('giornate_box').style.display='none';document.getElementById('giornate').removeAttribute('required');document.getElementById('giornate').value='';"><br/>{!! $value !!}
									</div>
								</div>	
								<div class="form-group col-md-8">
									<?php if($lingua=="ita"){?>
										<span style="font-size:0.8em">Si ricorda ai gentili giornalisti accreditati che avranno qui segnalato il loro interesse, che per ragioni organizzative i posti sulla barca stampa vanno prenotati la sera prima della regata presso la Sala Stampa. I posti verranno assegnati in base alla disponibilità.</span>
									<?php }else{?>
										<span style="font-size:0.8em">Please be aware that, for organizational purposes, requests for places on the Press Boat must be made the evening before the regatta in the Media Centre. Places will be assigned on the basis of availability.</span>
									<?php }?>
								</div>
							</div>
							
							<div class="row" id="giornate_box" style="display:none">
								<div class="form-group col-sm-12">
									<label for="paese">
										<?php if($lingua=="ita"){?>
											Specificare per quali giornate si ha necessità della barca stampa *
										<?php } else {?>
											Specify for which days you need the press boat *
										<?php }?>
									</label>
									<textarea class="form-control" id="giornate" name="giornate"></textarea>
								</div>
							</div>
							
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="email">E-mail *</label>
									<input type="email" class="form-control" id="email" name="email" required="required" oninvalid="if(this.validity.typeMismatch){this.setCustomValidity('<?php if($lingua=="ita"){?>Immettere un indirizzo di posta elettronico valido<?php }else{?>Enter a valid email address<?php }?>')}else{this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')}" oninput="setCustomValidity('')" value="<?php  echo $email; ?>">
								</div>
								
								<div class="form-group col-sm-6">
									<label for="email2">E-mail 2</label>
									<input type="email" class="form-control" id="email2" name="email2" value="<?php  echo $email2; ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="telefono"><?php if($lingua=="ita"){?>Tel. (Uff.)<?php } else {?>Phone<?php }?></label>
									<input type="tel" class="form-control" id="telefono" name="telefono" value="<?php  echo $telefono; ?>">
								</div>
								<div class="form-group col-sm-6">
									<label for="cellulare"><?php if($lingua=="ita"){?>Tel. (Cell.)<?php } else {?>Tel. Mobile<?php }?></label>
									<input type="tel" class="form-control" id="cellulare" name="cellulare" value="<?php  echo $cellulare; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<?php if($lingua=="ita"){?>Codice di Verifica<?php } else {?>Verify Code<?php }?> *:<br/>
								<div class="g-recaptcha" data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
							</div>
							
							<div class="form-group" style="margin-top:20px">
								<?php /*<?php if($lingua=="eng"){?><p>In accordance with d.lgs. 196/2003 (Italy) I authorize the Data Controller to treat this data for the purposes herein indicated. The Data Controller shall not release this information to third parties unless obliged to do so by law.</p><?php }?>*/?>
								<label><input type="checkbox" id="privacy" name="privacy" value="0" required="required"  onchange="this.setCustomValidity(validity.valueMissing ? '<?php if($lingua=="ita"){?>Autorizzazione della privacy obbligatoria<?php }else{?>Privacy Required<?php }?>' : '');" oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Autorizzazione della privacy obbligatoria<?php }else{?>Privacy Required<?php }?>')" oninput="setCustomValidity('')"/> &nbsp; <a href="<?php if($lingua=="en"){?>en/<?php }?>privacy.html"><?php if($lingua=="ita"){?>Dichiaro di aver preso visione dell’informativa sul trattamento dei dati personali (GDPR 679/16), e di autorizzarne il trattamento<?php } else {?>I declare to have read the notice on processing of personal data (GDPR 679/16), and I authorise processing.<?php }?> *</a></label>
								
								<script type="text/javascript">
									var pr=0;
									function check_privacy(){
										if(pr==0) pr=1;
										else pr=0;
										document.registrationForm.privacy.value=pr;
									}
								</script>
							</div>
							<div class="form-group" style="font-size:0.9em">(* <?php if($lingua=="ita"){?>campi obbligatori<?php } else {?>required fields<?php }?>)<br /><br /></div>
							
							<div class="form-group text-left">
								<button 
									class="btn btn-primary " <?php /*onclick="checkForm();"*/?>>
									<?php if($lingua=="ita"){?>INVIA<?php }else{?>SEND<?php }?>
								</button>
							</div>
						</form>
						<?php /*<script type="text/javascript">
							Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
							
							function check_form(){
								if (document.registrationForm.regata.value=="") alert('<?php if($lingua=="eng"){?>"Regatta" required<?php } else {?>Campo "Regata" obbligatorio<?php }?>');			
								else if (document.registrationForm.nome.value=="") alert('<?php if($lingua=="eng"){?>"Name" required<?php } else {?>Campo "Nome" obbligatorio<?php }?>');			
								else if (document.registrationForm.cognome.value=="") alert('<?php if($lingua=="eng"){?>"Surname" required<?php } else {?>Campo "Cognome" obbligatorio<?php }?>');		
								else if (document.registrationForm.pubblicazione.value=="") alert('<?php if($lingua=="eng"){?>"Publication" required<?php } else {?>Campo "Pubblicazione" obbligatorio<?php }?>');		
								else if (document.registrationForm.email.value=="") alert('<?php if($lingua=="eng"){?>"Contact Email Address" required<?php } else {?>Campo "E-mail" obbligatorio<?php }?>');
								else if (Filtro.test(document.registrationForm.email.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
								else if (isNaN(document.registrationForm.telefono.value) && document.registrationForm.telefono.value!="") alert('<?php if($lingua=="eng"){?>Enter a valid phone number (only digits)<?php } else {?>Inserisci un numero di telefono corretto (solo numeri)<?php }?>');
								else if (isNaN(document.registrationForm.cellulare.value) && document.registrationForm.cellulare.value!="") alert('<?php if($lingua=="eng"){?>Enter a valid phone number (only digits)<?php } else {?>Inserisci un numero di cellulare corretto (solo numeri)<?php }?>');
								else if (isNaN(document.registrationForm.fax.value) && document.registrationForm.fax.value!="") alert('<?php if($lingua=="eng"){?>Enter a valid fax number (only digits)<?php } else {?>Inserisci un numero di fax corretto (solo numeri)<?php }?>');
								else if (document.registrationForm.privacy.value=="0") alert('<?php if($lingua=="eng"){?>Privacy required<?php } else {?>Autorizzazione della privacy obbligatoria<?php }?>');
								else document.registrationForm.submit();
							}
						</script>*/?>
					</div>
				</div>
				<div class="content col-lg-1"></div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-9">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-3"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	@include('web.assets.la_storia_js')
@endsection