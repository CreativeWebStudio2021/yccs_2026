@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = Lang::get('website.recupera password');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.recupera password'); $breadcrumbs[$x]['link']=''; 
		
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
						
						<div style="width:100%; display:flex; gap:35px;">
							<h3 class="gradient-title"><?php if($lingua=="ita"){?>Recupera Password<?php }else{?>Password Recovery<?php }?></h3>
							<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
						</div>
						<p>Se hai perso i dati per accedere all'Area Soci, inserisci il tuo indirizzo e-mail nell'apposito campo, cos&igrave; riceverai una e-mail con il link per accedere alla procedura di cambio password:<br /><br /></p>
					</div>
					
					<form action="{{ url()->full() }}" class="form-gray-fields" method="post" name="formRecupera" id="formRecupera" autocomplete="off">
						@csrf
						<input type="hidden" name="stato_rec" value="1"/>
						<div class="col-md-6 form-group">
							<label class="sr-only">Email *</label>
							<input type="text" class="form-control input-lg" placeholder="Email *" name="email_rec" value="{{ isset($email_rec) ? $email_rec : '' }}">
						</div>
									
						<div class="col-md-12 form-group">
							<?php if($lingua=="ita"){?>Codice di Verifica<?php }else{?>Verify Code<?php }?> *
							<div class="g-recaptcha" data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
						</div>
						
						<div class="col-md-12 form-group" style="font-size:0.9em">(* <?php if($lingua=="ita"){?>campi obbligatori<?php } else {?>required fields<?php }?>)<br /><br /></div>
																
						<div class="col-md-12 form-group">
							<button type="button" class="btn btn-primary" OnClick="check_recupera();"><?php if($lingua=="ita"){?>Invia<?php }else{?>Send<?php }?></button>
							<button class="btn btn-danger m-l-10" type="button"><?php if($lingua=="ita"){?>Cancella<?php }else{?>Cancel<?php }?></button>						
						</div>	
					</form>
					<script type="text/javascript">
						Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
						
						function check_recupera(){
							if (document.formRecupera.email_rec.value=="") alert('<?php if($lingua=="eng"){?>"Contact Email Address" required<?php } else {?>Campo "E-mail" obbligatorio<?php }?>');
							else if (Filtro.test(document.formRecupera.email_rec.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
							else document.formRecupera.submit();
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