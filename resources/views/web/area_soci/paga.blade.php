<?php  use App\Http\Controllers\CustomController; ?>
@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/centro_sportivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.pagamento');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.pagamento'); $breadcrumbs[$x]['link']=''; 
			
		@endphp
		@include('web.common.page_title')
		
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-8">				
						@if( count($errors) > 0)
							@foreach($errors->all() as $error)
								<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="background:{{ $message_color }}">
									<div style="float:left; width:90%; text-align:center;">
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
										<span class="sr-only">{{ trans('labels.Error') }}:</span>
										{!! $error !!}
									</div>
									<div style="float:right; width:10%; text-align:right; cursor:pointer;" onclick="$('#errorMessage').fadeOut();"><b>x</b></div>
									<div style="clear:both"></div>
								</div>
							@endforeach
						@endif
						@if ($tipo_pagamento=="2" && $message_color!="red")
							<div style="" class="testo">
								<b>ATTENDERE PREGO:</b><br />
								tra qualche secondo verr&agrave; reindirizzato alla pagina contenente il modulo di pagamento di Paypal...<br /><br /><br /><br />
							</div>
							@php $test=0 @endphp
							
							@if($test==1) 
								<?php /* NOTA: https://www.sandbox.paypal.com/it/cgi-bin/webscr (cio� la parte italiana!) mi da automaticamente 'carrello vuoto' :( */?>
								<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="form_acquisto" name="form_acquisto">
									@csrf
							@else
								<form action="https://www.paypal.com/it/cgi-bin/webscr" method="post" id="form_acquisto" name="form_acquisto">
									@csrf
							@endif
								
								<input type="hidden" name="cmd" value="_cart" /> 
								<input type="hidden" name="redirect_cmd" value="_xclick" />
								<input type="hidden" name="upload" value="1" /> 
								<input type="hidden" name="rm" value="2" /> <?php /* restituisce la risposta in POST */?>
								@if($test==1) 
									<input type="hidden" name="business" value="f.den_1329396923_biz@cwstudio.it" />
								@else
									<input type="hidden" name="business" value="amministrazione@yccs.it" />
								@endif
								<input type="hidden" name="currency_code" value="EUR" /> 
								<input type="hidden" name="custom" value="<?php echo $id_ordine?>-<?php echo $mysidname?>-pagaora" />	
								<input type="hidden" name="first_name" value="<?php  echo $nome_sped;?>" />
								<input type="hidden" name="last_name" value="<?php  echo $cognome_sped;?>" />
								<input type="hidden" name="address1" value="<?php  echo $indirizzo_sped;?>" />
								<input type="hidden" name="zip" value="<?php  echo $cap_sped;?>" />
								<input type="hidden" name="city" value="<?php  echo $citta_sped;?>" />
								<input type="hidden" name="state" value="<?php  echo $nazione_sped;?>" />
								<input type="hidden" name="notify_url" value="{{config('app.url')}}/ipn.php" />
								<input type="hidden" name="return" value="{{config('app.url')}}/paypal_response.php" />
								<input type="hidden" name="lc" value="IT" />
								<input type="hidden" name="country" value="IT" />
								<input type="hidden" name="H_PhoneNumber" value="<?php echo $telefono_sped?>" />	
								<input type="hidden" name="email_address" value="<?php echo $email?>" />
												
								@php $x=1; @endphp
								@foreach($carrello as $idg => $qg)									
									@foreach($carrello[$idg] as $id_taglia => $qg)
										@php
											$query_dati = DB::table('ordini_prod')
												->select('nome', 'prezzo')
												->where('id_ord','=',$id_ordine)
												->where('id_prod','=',$idg)
												->get();
											$nomep = $query_dati[0]->nome;
											$prezzo_uni = $query_dati[0]->prezzo;
											
											$query_col = DB::table('prodotti')
												->select('colore')
												->where('id','=',$idg)
												->get();
											$id_col = $query_col[0]->colore;
											
											$nome_col = "";
											if(isset($id_col)){
												$query_col = DB::table('colori')
													->select('nome')
													->where('id','=',$id_col)
													->get();
												$nome_col = $query_col[0]->nome;
											}
											
											$nome_tg = "";
											if(isset($id_taglia) && $id_taglia!="0" && $id_taglia!=""){
												$query_tg = DB::table('valori_taglia')
													->select('valore')
													->where('id','=',$id_taglia)
													->get();
												$nome_tg = $query_tg[0]->valore;
											}
										@endphp
										@if($_SERVER['REMOTE_ADDR']=='93.45.34.21') 
											<input type="hidden" name="amount_<?php echo $x?>" value="0.01" />
										@else
											<input type="hidden" name="amount_<?php echo $x?>" value="<?php echo number_format($prezzo_uni, 2)?>" />
										@endif
										<input type="hidden" name="item_name_<?php echo $x?>" value="<?php echo $nomep?><?php if($nome_col!=""){?> (<?php echo $nome_col;?>)<?php }?><?php if($nome_tg!=""){?> - <?php echo $nome_tg?><?php }?>" />
										<input type="hidden" name="quantity_<?php echo $x?>" value="<?php echo $qg?>" />
										@php $x++; @endphp
									@endforeach
								@endforeach
								
								@if($_SERVER['REMOTE_ADDR']=='93.45.34.21') 
									<input type="hidden" name="handling_cart" value="0.00" />
								@else
									<input type="hidden" name="handling_cart" value="<?php echo number_format($spese, 2)?>" />
								@endif
								</form>
							<script type="text/javascript">
								function paga(){document.form_acquisto.submit();}
								window.setTimeout( 'paga()' , 5000);						
							</script>
						@endif
					</div>	
					<div class="content col-lg-1"></div>				
					<!-- end: post content -->
					<!-- Sidebar-->
					<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
						<div class="row">
							<div class="content col-lg-9">
								@include('web.common.laterale-area-soci')
							</div>
							<div class="content col-lg-3"></div>
						</div>
					</div>
					<!-- end: Sidebar-->
				</div>
			</div>
		</section> <!-- end: Content -->
		
	@endsection
@else	
	<script language="javascript">
		window.location = "<?php echo config('app.url');?>/<?php if($lingua=="eng"){?>en/<?php }?>area-soci/login.html";
	</script>
@endif