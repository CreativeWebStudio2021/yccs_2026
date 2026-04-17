@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$img_background = "web/images/testate/regate.jpg";
		if($lingua=="ita") $page_title = "Richiesta Contatti";
		else $page_title = "Request for contact details";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-3"></div>
				<div class="content col-lg-6">
					@if( count($errors) > 0)
						@foreach($errors->all() as $error)
							<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="background:{{ $message_color }}; border:none; margin-bottom:30px">
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
					
					@if($post==0)
						<form method="post" action="{{ url()->full() }}" class="form-gray-fields" name="conferma" id="conferma" autocomplete="off">
							@csrf
							<input type="hidden" name="stato_conf" value="1"/>
							<div class="col-md-12 form-group" style="text-align:justify">
								<?php if($lingua=="ita"){?>
									Per confermare l'invio dei tuoi dati al richiedente ti preghiamo di inserire l'indirizzo email che ci hai fornito.
								<?php }else{?>
									To confirm the sending of your data to the applicant please enter the email address you gave us.
								<?php }?>
								<br/><br/>
							</div>
							<div class="col-md-12 form-group">
								<label>Email *</label>
								<input type="email" class="form-control required input-lg" placeholder="" name="email" value=""  required="required"  oninvalid="if(this.validity.typeMismatch){this.setCustomValidity('<?php if($lingua=="ita"){?>Immettere un indirizzo di posta elettronico valido<?php }else{?>Enter a valid email address<?php }?>')}else{this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')}" oninput="setCustomValidity('')">
							</div>
							<div class="col-md-12 form-group">
								<button class="btn btn-primary"><?php if($lingua=="ita"){?>Conferma<?php }else{?>Confirm<?php }?></button>						
							</div>
						</form>
					@endif
				</div>
				<div class="content col-lg-3"></div>
			</div>
		</div>
	</section> <!-- end: Content -->	
@endsection