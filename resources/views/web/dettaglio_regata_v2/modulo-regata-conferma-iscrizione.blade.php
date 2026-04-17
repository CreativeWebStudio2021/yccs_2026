@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$link_back="regate-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		if($lingua=="eng") $link_back="en/regattas-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		
		$query_ed = DB::table('edizioni_regate')
			->select('*')
			->where('id','=',$id_dett)
			->get();	
			
		$colore_testo = $query_ed[0]->colore_testo;
		$luogo = $query_ed[0]->luogo;
		$data_dal = $query_ed[0]->data_dal;
		$data_al = $query_ed[0]->data_al;
		$logo_edizione = $query_ed[0]->logo_edizione;
		$nome_regata = $query_ed[0]->nome_regata;
		
		$query_mod = DB::table('edizioni_modulo_iscrizioni')
			->select('*')
			->where('id_edizione','=',$id_dett)
			->get();
		$testo_modulo_ita = $query_mod[0]->testo_modulo_ita;
		$testo_modulo_eng = $query_mod[0]->testo_modulo_eng;
	@endphp
	<section class="content" style="margin-top:30px; padding-bottom:0; background:#fff">
		<div class="container"> 
			<a href="<?php if($lingua=="eng"){?>en/<?php }?><?php echo $link_back;?>"><div style="width:300px; margin:0 auto; padding:10px 0; border:solid 1px #<?php echo $colore_testo;?>; color:#<?php echo $colore_testo;?>; text-align:center; margin-top:-25px; margin-bottom:30px"><b><?php if($lingua=="ita"){?>TORNA ALLA HOME REGATA<?php }else{?>BACK TO REGATTA<?php }?></b></div></a>		  	  				 
		</div>
	</section>
	
	<section class="content" style="padding:20px; background:#fff" id="printArea">
		<div style="width:100%; text-align:center; display:none" id="logo_stampa">
			<img src="resarea/img_up/regate/<?php echo $logo_edizione;?>" alt="" style="width:100px; border:solid 1px; margin-bottom:20px;"/>
		</div>
		
		<div class="container" style="color:#111;font-weight:600;">			
			<div class="titoliBox2" style="margin-bottom:20px; text-align:center;">
				<h1 style="line-height:35px">
					<?php echo $nome_regata;?><br/>
					<span style="font-size:0.6em"><?php echo $luogo;?>, <?php if($lingua=="ita"){?>dal<?php }else{?>from<?php }?> <?php echo $data_dal;?> <?php if($lingua=="ita"){?>al<?php }else{?>to<?php }?> <?php echo $data_al;?></span>
				</h1>
			</div>
			<div class="titoliBox2" style="margin-bottom:10px; text-align:center;"><h3><?php if($lingua=="ita"){?><?php echo $testo_modulo_ita;?><?php }else{?><?php echo $testo_modulo_eng;?><?php }?></h3></div>
		</div>
	</section>
		
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-3"></div>
				<div class="content col-lg-6">
					@if( count($errors) > 0)
						@foreach($errors->all() as $error)
							<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="background:{{ $message_color }}">
								<div style="float:left; width:90%;text-align:center;">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">{{ trans('labels.Error') }}:</span>
									{!! $error !!}
								</div>
								<div style="float:right; width:10%; text-align:right; cursor:pointer;" onclick="$('#errorMessage').fadeOut();"><b>x</b></div>
								<div style="clear:both"></div>
							</div>
						@endforeach
					@endif
					
					@if(isset($error) && ($error=="Iscrizione confermata" || $error=="Registration confirmed" || $error=="Iscrizione gi&agrave; confermata" || $error=="Registration already confirmed") && $status!=="pagato")						
						@php	$test=0		 @endphp
						@if($payment_method=="Paypal")
							<!-- pagamento tramite PAYPAL -->
							<div style="text-align:center">
								<?php if($lingua=="ita"){?>
									<b>ATTENDERE PREGO:</b><br />
									tra qualche secondo verr&agrave; reindirizzato alla pagina contenente il modulo di pagamento di Paypal...<br /><br /><br /><br />
								<?php }else{?>
									<b>PLEASE WAIT:</b><br />
									In a few seconds will be redirected to the page containing the payment form of Paypal...<br /><br /><br /><br />
								<?php }?>
								@if($test==1)
									@php $user_login_paypal="f.den_1329396923_biz@cwstudio.it"; @endphp
									<form name="form_acquisto" id="form_acquisto" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">			
								@else
									@php $user_login_paypal="amministrazione@yccs.it"; @endphp
									<form name="form_acquisto" id="form_acquisto" action="https://www.paypal.com/it/cgi-bin/webscr" method="post">
								@endif
									<input type="hidden" name="cmd" value="_cart" /> 
										<input type="hidden" name="redirect_cmd" value="_xclick" />
										<input type="hidden" name="upload" value="1" /> 
										<input type="hidden" name="rm" value="2" /> <!-- restituisce la risposta in POST -->
										<input type="hidden" name="business" value="<?php echo $user_login_paypal;?>" />
										<input type="hidden" name="currency_code" value="EUR" /> 
										<input type="hidden" name="custom" value="<?php echo $codice?>-<?php echo $id?>-iscrizione_regata" />
										<input type="hidden" name="return" value="{{config('app.url')}}/paypal_response.php" />
										<input type="hidden" name="notify_url" value="<?php echo config('app.url');?>/ipn.php" />
										<input type="hidden" name="lc" value="IT" />
										
										@if($_SERVER['REMOTE_ADDR']=='93.45.34.21') 
											<input type="hidden" name="amount_1" value="0.01" />
										@else
											<input type="hidden" name="amount_1" value="<?php if(isset($final_price)) echo $final_price; else echo $prezzo;?>" />
										@endif
										<input type="hidden" name="item_name_1" value="Registration to the regatta <?php echo $nome_regata;?> <?php echo $anno_regata;?>" />
										<input type="hidden" name="quantity_1" value="1" />
								</form>
							
								<img src="web/images/paypal-payment.PNG" style="cursor:pointer;" onclick="document.form_acquisto.submit();" alt="paga ora con Paypal"/>
							</div>
							<script type="text/javascript">
								function paga(){document.form_acquisto.submit();}
								window.setTimeout( 'paga()' , 5000);						
							</script>
						@elseif($payment_method=="Bank Transfer")
							<?php if($lingua=="ita"){?>
								<b>DETTAGLI PER IL BONIFICO</b>:<br>
								Yacht Club Costa Smeralda<br>
								Banca Intesa San Paolo - Arzachena<br>
								BIC/SWIFT: BCITITMM<br>
								IBAN: IT33F0306984902100000000071<br>
								<b>IMPORTANTE</b>:<br>Specificare nella causale: <?php echo $nome_regata;?> - <?php if(isset($boat_details) && $boat_details==1){?>Nome della barca<?php }elseif(isset($yacht_club_check) && $yacht_club_check==1 && isset($yacht_club_valore) && trim($yacht_club_valore)!=""){?><?php echo $yacht_club_valore;?><?php }?>
								<br /><br /><br /><br />
							<?php }else{?>
								<b>BANK DETAILS</b>:<br>
								Yacht Club Costa Smeralda<br>
								Banca Intesa San Paolo - Arzachena<br>
								BIC/SWIFT: BCITITMM<br>
								IBAN: IT33F0306984902100000000071<br>
								<b>IMPERATIVE</b>:<br>specify as object: <?php echo $nome_regata;?> - <?php if(isset($boat_details) && $boat_details==1){?>Name Of Boat<?php }elseif(isset($yacht_club_check) && $yacht_club_check==1 && isset($yacht_club_valore) && trim($yacht_club_valore)!=""){?><?php echo $yacht_club_valore;?><?php }?> 
								<br /><br /><br /><br />
							<?php }?>
						@endif
					@endif
					@if($stato_accettazione==1 && $payment_method=="Paypal" && $status!="pagato")
						<!-- pagamento tramite PAYPAL -->
						<div style="text-align:center">
							<strong><?php if($lingua=="ita"){?>Procedi al pagamento con<?php }else{?>Proceed to payment with<?php }?></strong><br/><br/>
							@if($test==1)
								@php $user_login_paypal=""; @endphp
								<form name="form_acquisto" id="form_acquisto" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">			
							@else
								@php $user_login_paypal="amministrazione@yccs.it"; @endphp
								<form name="form_acquisto" id="form_acquisto" action="https://www.paypal.com/it/cgi-bin/webscr" method="post">
							@endif
								<input type="hidden" name="cmd" value="_cart" /> 
									<input type="hidden" name="redirect_cmd" value="_xclick" />
									<input type="hidden" name="upload" value="1" /> 
									<input type="hidden" name="rm" value="2" /> <!-- restituisce la risposta in POST -->
									<input type="hidden" name="business" value="<?php echo $user_login_paypal;?>" />
									<input type="hidden" name="currency_code" value="EUR" /> 
									<input type="hidden" name="custom" value="<?php echo $codice?>-<?php echo $id?>-iscrizione_regata" />
									<input type="hidden" name="return" value="{{config('app.url')}}/paypal_response.php" />
									<input type="hidden" name="notify_url" value="<?php echo config('app.url');?>/ipn.php" />
									<input type="hidden" name="lc" value="IT" />
									
									@if($_SERVER['REMOTE_ADDR']=='93.45.34.21') 
										<input type="hidden" name="amount_1" value="0.01" />
									@else
										<input type="hidden" name="amount_1" value="<?php echo $prezzo;?>" />
									@endif
									<input type="hidden" name="item_name_1" value="Registration to the regatta <?php echo $nome_regata;?> <?php echo $anno_regata;?>" />
									<input type="hidden" name="quantity_1" value="1" />
							</form>
						
							<img src="web/images/paypal-payment.PNG" style="cursor:pointer;" onclick="document.form_acquisto.submit();" alt="paga ora con Paypal"/>
						</div>
					@endif
					@if($error_isc==0 && $stato_conf==0)
						<form method="post" action="{{ url()->full() }}" class="form-gray-fields" id="conferma" name="conferma" autocomplete="off">
							@csrf
							<input type="hidden" name="stato_conf" value="1"/>
							<div class="col-md-12 form-group" style="text-align:center">
								<?php if($lingua=="ita"){?>
									Per completare la procedura di iscrizione ti preghiamo di inserire il tuo indirizzo email.
								<?php }else{?>
									To complete the registration process please enter your email address
								<?php }?>
								<br/><br/>
							</div>
							<div class="col-md-12 form-group">
								<label>Email *</label>
								<input type="email" class="form-control required input-lg" placeholder="" name="email" value=""  required="required"  oninvalid="if(this.validity.typeMismatch){this.setCustomValidity('<?php if($lingua=="ita"){?>Immettere un indirizzo di posta elettronico valido<?php }else{?>Enter a valid email address<?php }?>')}else{this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')}" oninput="setCustomValidity('')">
							</div>
							<div class="col-md-12 form-group" style="text-align:centeR;">
								<button class="btn btn-primary" style="margin:0 auto;"><?php if($lingua=="ita"){?>Conferma<?php }else{?>Confirm<?php }?></button>						
							</div>
						</form>
					@endif
				</div>
				<div class="content col-lg-3"></div>
			</div>
		</div>
	</section>
				
@endsection