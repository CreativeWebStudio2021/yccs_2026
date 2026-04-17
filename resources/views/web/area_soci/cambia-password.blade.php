@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = Lang::get('website.cambia password');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.cambia password'); $breadcrumbs[$x]['link']=''; 
		
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					<div class="col-md-12">
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
						@if(isset($message_color) && $message_color == "#81c868")
							<script>
								function loc(){
									window.location='<?php if($lingua=="eng") echo "en/";?>area-soci/login.html';
								}
								window.setTimeout('loc()' , 3000);
							</script>
						@endif
						
						<h3><?php if($lingua=="ita"){?>Cambia Password<?php }else{?>Change Password<?php }?></h3>	<br/>		
					</div>
					
					
					<form method="post" action="{{ url()->full() }}" class="form-gray-fields" name="formCambiaPsw" id="formCambiaPsw" autocomplete="off">
						@csrf
						<input type="hidden" name="stato" value="inviato" />
						<div class="row">
							<div class="col-md-12 form-group">
								<label class="sr-only">Email *</label>
								<input type="text" class="form-control input-lg" placeholder="Email *" name="email" value="{{ isset($email) ? $email : '' }}">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label class="sr-only"><?php if($lingua=="ita"){?>Nuova Password<?php }else{?>New Password<?php }?> *</label>
								<input type="password" class="form-control input-lg" placeholder="Password *" name="password" value="{{ isset($password) ? $password : '' }}">
							</div>
							<div class="col-md-6 form-group">
								<label class="sr-only"><?php if($lingua=="ita"){?>Verifica Password<?php }else{?>Verify Password<?php }?> *</label>
								<input type="password" class="form-control input-lg" placeholder="<?php if($lingua=="ita"){?>Verifica Password<?php }else{?>Verify Password<?php }?>" name="password_conf" value="{{ isset($password_conf) ? $password_conf : '' }}">
							</div>
						</div>
						
						<!--<div class="col-md-12 form-group">
							<label class="sr-only"><?php if($lingua=="ita"){?>Codice di Verifica<?php }else{?>Verify Code<?php }?></label>
							<div class="g-recaptcha" data-sitekey="6LeVIRgTAAAAAHftg6GwFusnrAznhf2qlij1Ryq-"></div>
						</div>-->
						
						<div class="col-md-12 form-group" style="font-size:0.9em">(* <?php if($lingua=="ita"){?>campi obbligatori<?php } else {?>required fields<?php }?>)<br /><br /></div>
										
						<div class="col-md-12 form-group">
							<button type="button" class="btn btn-primary" OnClick="check_form();"><?php if($lingua=="ita"){?>Modifica<?php }else{?>Update<?php }?> </button>
							<button class="btn btn-danger m-l-10" type="button"><?php if($lingua=="ita"){?>Annulla<?php }else{?>Cancel<?php }?></button>						
						</div>
					</form>
					<script type="text/javascript">
						Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
						
						function check_form(){
							if (document.formCambiaPsw.email.value=="") alert('<?php if($lingua=="eng"){?>"Contact Email Address" required<?php } else {?>Campo "E-mail" obbligatorio<?php }?>');
							else if (Filtro.test(document.formCambiaPsw.email.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
							else if (document.formCambiaPsw.password.value=="") alert('<?php if($lingua=="eng"){?>"Password" required<?php } else {?>Campo "Password" obbligatorio<?php }?>');
							else if (document.formCambiaPsw.password_conf.value=="") alert('<?php if($lingua=="eng"){?>"Verify Password" required<?php } else {?>Campo "Verifica Password" obbligatorio<?php }?>');
							else if (document.formCambiaPsw.password_conf.value!=document.formCambiaPsw.password.value) alert('<?php if($lingua=="eng"){?>Attenzione: i campi "Password" e "Verifica Password" non coincidono<?php } else {?>Attenzione: i campi "Password" e "Verifica Password" non coincidono<?php }?>');
							else document.formCambiaPsw.submit();
						}
					</script>					
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