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
					@if($message_color=="#81c868")
						<script>
							function loc(){
									window.location = "<?php echo config('app.url');?><?php if($lingua=="eng"){?>en/<?php }?>/yccs-sailing-school-iscrizioni.html";
								}
								window.setTimeout('loc()' , 5000);	
						</script>
					@endif
				@endforeach
			@endif	
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<h3><?php if($lingua=="ita"){?>Cambia Password<?php }else{?>Cambia Password<?php }?></h3>
					<form method="post" action="{{ url()->full() }}" class="form-gray-fields" id="formCambiaPsw" name="formCambiaPsw" autocomplete="off">
						@csrf
						<input type="hidden" name="stato" value="inviato" />
						<div class="row">
							<div class="col-md-12 form-group">
								<label class="sr-only">Email *</label>
								<input type="text" class="form-control input-lg" placeholder="Email *" name="email" value="">
							</div>
							<div class="col-md-6 form-group">
								<label class="sr-only"><?php if($lingua=="ita"){?>Nuova Password<?php }else{?>New Password<?php }?> *</label>
								<input type="password" class="form-control input-lg" placeholder="Password *" name="password" value="">
							</div>
							<div class="col-md-6 form-group">
								<label class="sr-only"><?php if($lingua=="ita"){?>Verifica Password<?php }else{?>Verify Password<?php }?> *</label>
								<input type="password" class="form-control input-lg" placeholder="<?php if($lingua=="ita"){?>Verifica Password<?php }else{?>Verify Password<?php }?>" name="password_conf" value="">
							</div>
						</div>
						
						<div class="col-md-12 form-group" style="font-size:0.9em">(* <?php if($lingua=="ita"){?>campi obbligatori<?php } else {?>required fields<?php }?>)<br /><br /></div>
										
						<div class="col-md-12 form-group">
							<button type="button" class="btn btn-primary" OnClick="check_form();"><?php if($lingua=="ita"){?>Modifica<?php }else{?>Update<?php }?> </button>
							<button class="btn btn-danger m-l-10" type="button"><?php if($lingua=="ita"){?>Annulla<?php }else{?>Cancel<?php }?></button>						
						</div>
					</form>
				</div>
				<div class="col-md-2"></div>
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
		</div>
	</section>
@endsection