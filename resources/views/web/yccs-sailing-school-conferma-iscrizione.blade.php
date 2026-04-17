@php
	$error_isc=0;
	if(isset($id_dett)) $codice=$id_dett; else $codice="";

	if($codice!=""){
		$query_cod = DB::table('iscrizioni_scuola')
			->select('*')
			->where('id_rife','=','0')
			->where('codice','=',$codice)
			->get();
		$num_cod = $query_cod->count();
		
		if($num_cod>0) $error_isc=0;
		else $error_isc=1;
	}else{$error_isc=1;}
@endphp

@extends('web.index')

@section('content')	
	
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
				@endforeach
			@endif	
			@if($pagamento=="Paypal" && $status!="pagato")
				@php	$test=0;	@endphp
				<!-- pagamento tramite PAYPAL -->
				<div style="text-align:center">
					<strong><?php if($lingua=="ita"){?>Procedi al pagamento con<?php }else{?>Proceed to payment with<?php }?></strong><br/><br/>
					@if($test==1)
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="form_acquisto" id="form_acquisto">
							@csrf
					@else
						<form action="https://www.paypal.com/it/cgi-bin/webscr" method="post" name="form_acquisto" id="form_acquisto">
							@csrf
					@endif
						<input type="hidden" name="cmd" value="_cart" /> 
						<input type="hidden" name="redirect_cmd" value="_xclick" />
						<input type="hidden" name="upload" value="1" /> 
						<input type="hidden" name="rm" value="2" /> <!-- restituisce la risposta in POST -->
						<input type="hidden" name="return" value="<?php echo config('app.url');?>/paypal_response.php">
						@if($test==1)
							<input type="hidden" name="business" value="f.den_1329396923_biz@cwstudio.it" />
						@else
							<input type="hidden" name="business" value="amministrazione@yccs.it" />
						@endif
						<input type="hidden" name="currency_code" value="EUR" /> 
						<input type="hidden" name="custom" value="<?php echo $codice?>-<?php echo $id_dett?>-iscrizione_scuola" />
						
						<input type="hidden" name="notify_url" value="{{config('app.url')}}/ipn.php" />
						<input type="hidden" name="return" value="{{config('app.url')}}/paypal_response.php" />
						
						<input type="hidden" name="lc" value="IT" />						
						<input type="hidden" name="country" value="IT" />
						@if(isset($email_sped))
							<input type="hidden" name="email_address" value="{{ $email_sped }" />
						@endif
						
						@if($_SERVER['REMOTE_ADDR']=='93.45.34.21') 
							<input type="hidden" name="amount_1" value="0.01" />
						@else
							<input type="hidden" name="amount_1" value="<?php echo $totale;?>" />
						@endif
						<input type="hidden" name="item_name_1" value="Registraition for Sailing Courses" />
						<input type="hidden" name="quantity_1" value="1" />							
						
					</form>
				
					<img src="web/images/paypal-payment.PNG" style="cursor:pointer;" onclick="document.form_acquisto.submit();" alt="paga ora con Paypal"/>
				</div>	
			@endif
		</div>
	</section>
@endsection