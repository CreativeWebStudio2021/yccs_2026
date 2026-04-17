@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = Lang::get('website.registrazione');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.registrazione'); $breadcrumbs[$x]['link']=''; 
		
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					<div class="panel-body">
						@if( count($errors) > 0)
							@foreach($errors->all() as $error)
								<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="background:{{ $message_color }}">
									<div style="float:left; width:90%;">
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
										<span class="sr-only">{{ trans('labels.Error') }}:</span>
										{!! $error !!}
									</div>
									<div style="float:right; width:10%; text-align:right; cursor:pointer;" onclick="$('#errorMessage').fadeOut();"><b>x</b></div>
									<div style="clear:both"></div>
								</div>
							@endforeach
						@endif
						
						<div style="width:100%; display:flex; gap:35px;">
							<h3 class="gradient-title"><?php if($lingua=="ita"){?>Registrazione<?php }else{?>Registration<?php }?></h3>
							<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
						</div>
						
						<form action="{{ url()->full() }}" class="form-gray-fields" method="post" name="registrazione" id="registrazione" autocomplete="off">
							@csrf
							<input type="hidden" name="stato_req" value="1"/>
							<div class="row">
								<div class="col-md-6 form-group">
									<label class="sr-only"><?php if($lingua=="ita"){?>Nome<?php }else{?>First Name<?php }?> *</label>
									<input type="text" class="form-control input-lg" placeholder="<?php if($lingua=="ita"){?>Nome<?php }else{?>First Name<?php }?> *" name="nome" value="{{ isset($nome) ? $nome : '' }}">
								</div>
								<div class="col-md-6 form-group">
									<label class="sr-only"><?php if($lingua=="ita"){?>Cognome<?php }else{?>Last Name<?php }?> *</label>
									<input type="text" class="form-control input-lg" placeholder="<?php if($lingua=="ita"){?>Cognome<?php }else{?>Last Name<?php }?> *" name="cognome" value="{{ isset($cognome) ? $cognome : '' }}">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label class="sr-only">Email *</label>
									<input type="text" class="form-control input-lg" placeholder="Email *" name="email" value="{{ isset($email) ? $email : '' }}">
								</div>
								<div class="col-md-6 form-group">
									<label class="sr-only"><?php if($lingua=="ita"){?>Tessera Socio n.<?php }else{?>Tessera Socio n.<?php }?> *</label>
									<input type="text" class="form-control input-lg" placeholder="<?php if($lingua=="ita"){?>Tessera Socio n.<?php }else{?>Tessera Socio n.<?php }?> *" name="num_socio" value="{{ isset($num_socio) ? $num_socio : '' }}">							
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label class="sr-only">Password *</label>
									<input type="password" class="form-control input-lg" placeholder="Password *" name="password" value="{{ isset($password) ? $password : '' }}">
								</div>
								<div class="col-md-6 form-group">
									<label class="sr-only"><?php if($lingua=="ita"){?>Verifica Password<?php }else{?>Verify Password<?php }?> *</label>
									<input type="password" class="form-control input-lg" placeholder="<?php if($lingua=="ita"){?>Verifica Password<?php }else{?>Verify Password<?php }?> *" name="password_conf" value="{{ isset($password_conf) ? $password_conf : '' }}">
								</div>
							</div>
							
							<?php /*
							<div class="col-md-12 form-group">
								<?php if($lingua=="ita"){?>Codice di Verifica<?php }else{?>Verify Code<?php }?> *
								<div class="g-recaptcha" data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
							</div>*/?>
							<div class="form-group">								
								<div class="cf-turnstile" data-sitekey="0x4AAAAAAADV4yijBiyuxQm9" data-callback="javascriptCallback"></div>
								<?php /*<div class="g-recaptcha"
									 data-sitekey="6Lc8Fu0aAAAAAIfZHQ78s8gUAJnZC65HF47xCIdF"
									 data-callback="onSubmit"
									 data-badge="inline"
									 data-size="invisible">
								</div>*/?>
							</div>
							
							<div class="col-md-12 form-group" style="margin-top:20px">
								<?php /*<?php if($lingua=="eng"){?><p>In accordance with d.lgs. 196/2003 (Italy) I authorize the Data Controller to treat this data for the purposes herein indicated. The Data Controller shall not release this information to third parties unless obliged to do so by law.</p><?php }?>*/?>
								<label><input type="checkbox" id="privacy" name="privacy" value="{{ isset($privacy) ? $privacy : '0' }}" onclick="check_privacy()" /> &nbsp; <a href="<?php if($lingua=="en"){?>en/<?php }?>privacy.html"><?php if($lingua=="ita"){?>Dichiaro di aver preso visione dell’informativa sul trattamento dei dati personali (GDPR 679/16), e di autorizzarne il trattamento<?php } else {?>I declare to have read the notice on processing of personal data (GDPR 679/16), and I authorise processing.<?php }?> *</a></label>
								
								<script type="text/javascript">
									var pr=0;
									function check_privacy(){
										if(pr==0) pr=1;
										else pr=0;
										document.registrazione.privacy.value=pr;
									}
								</script>
							</div>
							<div class="col-md-12 form-group" style="font-size:0.9em">(* <?php if($lingua=="ita"){?>campi obbligatori<?php } else {?>required fields<?php }?>)<br /><br /></div>
																	
							<div class="col-md-12 form-group">
								<button type="button" class="btn btn-primary" id="sendForm" OnClick="check_form();"<?php /**/?>><?php if($lingua=="ita"){?>Registrati<?php }else{?>Register<?php }?></button>
							</div>	
						</form>
						<script type="text/javascript">
							Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
							
							function check_form(){
								if (document.registrazione.nome.value=="") alert('<?php if($lingua=="eng"){?>"Name" required<?php } else {?>Campo "Nome" obbligatorio<?php }?>');			
								else if (document.registrazione.cognome.value=="") alert('<?php if($lingua=="eng"){?>"Surname" required<?php } else {?>Campo "Cognome" obbligatorio<?php }?>');		
								else if (document.registrazione.email.value=="") alert('<?php if($lingua=="eng"){?>"Contact Email Address" required<?php } else {?>Campo "E-mail" obbligatorio<?php }?>');
								else if (Filtro.test(document.registrazione.email.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
								else if (document.registrazione.num_socio.value=="") alert('<?php if($lingua=="eng"){?>"Tessera Socio n." required<?php } else {?>Campo "Tessera Socio n." obbligatorio<?php }?>');
								else if (document.registrazione.password.value=="") alert('<?php if($lingua=="eng"){?>"Password" required<?php } else {?>Campo "Password" obbligatorio<?php }?>');
								else if (document.registrazione.password_conf.value=="") alert('<?php if($lingua=="eng"){?>"Verify Password" required<?php } else {?>Campo "Verifica Password" obbligatorio<?php }?>');
								else if (document.registrazione.password_conf.value!=document.registrazione.password.value) alert('<?php if($lingua=="eng"){?>Attenzione: i campi "Password" e "Verifica Password" non coincidono<?php } else {?>Attenzione: i campi "Password" e "Verifica Password" non coincidono<?php }?>');
								else if (document.registrazione.privacy.value=="0") alert('<?php if($lingua=="eng"){?>Privacy required<?php } else {?>Autorizzazione della privacy obbligatoria<?php }?>');
								else document.registrazione.submit();
							}
						</script>
						<?php /*<script type="text/javascript">
							Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
							
							function onSubmit(token) {
								if (document.registrazione.nome.value=="") alert('<?php if($lingua=="eng"){?>"Name" required<?php } else {?>Campo "Nome" obbligatorio<?php }?>');			
								else if (document.registrazione.cognome.value=="") alert('<?php if($lingua=="eng"){?>"Surname" required<?php } else {?>Campo "Cognome" obbligatorio<?php }?>');		
								else if (document.registrazione.email.value=="") alert('<?php if($lingua=="eng"){?>"Contact Email Address" required<?php } else {?>Campo "E-mail" obbligatorio<?php }?>');
								else if (Filtro.test(document.registrazione.email.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
								else if (document.registrazione.num_socio.value=="") alert('<?php if($lingua=="eng"){?>"Tessera Socio n." required<?php } else {?>Campo "Tessera Socio n." obbligatorio<?php }?>');
								else if (document.registrazione.password.value=="") alert('<?php if($lingua=="eng"){?>"Password" required<?php } else {?>Campo "Password" obbligatorio<?php }?>');
								else if (document.registrazione.password_conf.value=="") alert('<?php if($lingua=="eng"){?>"Verify Password" required<?php } else {?>Campo "Verifica Password" obbligatorio<?php }?>');
								else if (document.registrazione.password_conf.value!=document.registrazione.password.value) alert('<?php if($lingua=="eng"){?>Attenzione: i campi "Password" e "Verifica Password" non coincidono<?php } else {?>Attenzione: i campi "Password" e "Verifica Password" non coincidono<?php }?>');
								else if (document.registrazione.privacy.value=="0") alert('<?php if($lingua=="eng"){?>Privacy required<?php } else {?>Autorizzazione della privacy obbligatoria<?php }?>');
								else document.registrazione.submit();
							}
							function validate(event) {
								event.preventDefault();
								grecaptcha.execute();							
							}
							function onload() {
								var element = document.getElementById('sendForm');
								element.onclick = validate;
							}
							onload();
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
	
@endsection