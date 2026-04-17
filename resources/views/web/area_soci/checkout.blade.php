<?php  use App\Http\Controllers\CustomController; ?>
@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/centro_sportivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = "Checkout";
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']="Checkout"; $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']="Step $step"; $breadcrumbs[$x]['link']=''; 
			
		@endphp
		@include('web.common.page_title')
		
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-8">
						<h3 style="text-transform:uppercase">Checkout</h3>
						@if($step==1)
							@php
								$query_cl = DB::table('clienti')
									->select('*')
									->where('id','=',$_SESSION["user_id_login"])
									->get();
								
								foreach($query_cl[0] AS $key_cl=>$value_cl){
									$risu_cl[$key_cl] = $value_cl;
								}
								
								if($risu_cl['nome_sped'] && $risu_cl['nome_sped']!="") $nome_sped=$risu_cl['nome_sped']; else $nome_sped=$risu_cl['nome'];
								if($risu_cl['cognome_sped'] && $risu_cl['cognome_sped']!="") $cognome_sped=$risu_cl['cognome_sped']; else $cognome_sped=$risu_cl['cognome'];
								if($risu_cl['telefono_sped'] && $risu_cl['telefono_sped']!="") $telefono_sped=$risu_cl['telefono_sped']; else $telefono_sped="";
								if($risu_cl['nazione_sped'] && $risu_cl['nazione_sped']!="") $paese_sped=$risu_cl['nazione_sped']; else $paese_sped="";
								if($risu_cl['indirizzo_sped'] && $risu_cl['indirizzo_sped']!="") $indirizzo_sped=$risu_cl['indirizzo_sped']; else $indirizzo_sped="";
								if($risu_cl['citta_sped'] && $risu_cl['citta_sped']!="") $citta_sped=$risu_cl['citta_sped']; else $citta_sped="";
								if($risu_cl['cap_sped'] && $risu_cl['cap_sped']!="") $cap_sped=$risu_cl['cap_sped']; else $cap_sped="";
								
								$nome_fatt=$risu_cl['nome_fatt'];
								$cognome_fatt=$risu_cl['cognome_fatt'];
								$email_fatt=$risu_cl['email_fatt'];
								$telefono_fatt=$risu_cl['telefono_fatt'];
								$paese_fatt=$risu_cl['nazione_fatt'];
								$indirizzo_fatt=$risu_cl['indirizzo_fatt'];
								$citta_fatt=$risu_cl['citta_fatt'];
								$cap_fatt=$risu_cl['cap_fatt'];
								$ragione_sociale_fatt=$risu_cl['ragione_sociale_fatt'];
								$partita_iva_fatt=$risu_cl['partita_iva_fatt'];
								if($risu_cl['nome_fatt'] == NULL && $risu_cl['cognome_fatt'] == NULL && $risu_cl['email_fatt'] == NULL && $risu_cl['telefono_fatt'] == NULL && $risu_cl['nazione_fatt'] == NULL && $risu_cl['indirizzo_fatt'] == NULL && $risu_cl['citta_fatt'] == NULL && $risu_cl['cap_fatt'] == NULL && $risu_cl['ragione_sociale_fatt'] == NULL && $risu_cl['partita_iva_fatt'] == NULL){
									$nome_fatt=$risu_cl['nome'];
									$cognome_fatt=$risu_cl['cognome'];
									$email_fatt=$risu_cl['email'];
									$telefono_fatt="";
									$paese_fatt="";
									$indirizzo_fatt="";
									$citta_fatt="";
									$cap_fatt="";
									$ragione_sociale_fatt="";
									$partita_iva_fatt="";
								}								
							@endphp
							<a name="step2"></a>
							<div id="step_titolo_2">Step 1 <?php if($lingua=="ita"){?>di<?php }else{?>of<?php }?> 3: <?php if($lingua=="ita"){?>Dettagli Spedizione/Fatturazione<?php }else{?>Shipping/Invoice Details<?php }?><a class="modify"></a> </div>
							<div id="step_2">
								<div class="m-t-30">
									<span style="font-size:1.3em; font-family:'Open Sans'; font-style:italic"><b><?php if($lingua=="ita"){?>Dettagli Spedizione<?php }else{?>Shipping Details<?php }?></b></span><br/><br/>
									@php  
										$link_form = "area-soci/checkout-step2.html";
										if($lingua=="eng") $link_form = "en/".$link_form;
									@endphp
									<form method="post" action="{{ $link_form }}" class="form-gray-fields" name="formSped" autocomplete="off">
										@csrf
										<div class="row">
											<input type="hidden" name="stato_sped" value="inviato"/>
											<input type="hidden" name="fattura" value="0"/>
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="nome"><?php if($lingua=="ita"){?>Nome<?php } else {?>Name<?php }?> *</label>
															<input type="text" class="form-control" id="nome_sped" name="nome_sped" value="<?php  echo $nome_sped; ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="cognome"><?php if($lingua=="ita"){?>Cognome<?php } else {?>Surname<?php }?> *</label>
															<input type="text" class="form-control" id="cognome_sped" name="cognome_sped" value="<?php  echo $cognome_sped; ?>">
														</div>
													</div>
												</div>
												
												<div class="row">	
													<div class="form-group col-sm-6">
														<label for="citta"><?php if($lingua=="ita"){?>Citt&agrave;<?php } else {?>City<?php }?> *</label>
														<input type="text" class="form-control" id="citta_sped" name="citta_sped" value="<?php  echo $citta_sped; ?>">
													</div>
													
													<div class="form-group col-sm-6">
														<label for="cap"><?php if($lingua=="ita"){?>Cap<?php } else {?>Postcode<?php }?> *</label>
														<input type="text" class="form-control" id="cap_sped" name="cap_sped" value="<?php  echo $cap_sped; ?>">
													</div>
												</div>
												
												<div class="row">	
													<div class="form-group col-sm-6">
														<label for="indirizzo"><?php if($lingua=="ita"){?>Indirizzo<?php } else {?>Address<?php }?> *</label>
														<input type="text" class="form-control" id="indirizzo_sped" name="indirizzo_sped" value="<?php  echo $indirizzo_sped; ?>">
													</div>
													
													<div class="form-group col-sm-6">
														<label for="paese"><?php if($lingua=="ita"){?>Paese di Residenza<?php } else {?>Country of Residence<?php }?> *</label>
														<select name="paese_sped">
															<?php if($lingua=="ita"){?>
																<option value="Italia" <?php if(isset($paese_sped) && ($paese_sped=="Italia" || $paese_sped=="Italy")){?>selected="selected"<?php }?>>Italia</option>
																@php
																	$query_com = DB::table('nazioni')
																		->select('*')
																		->orderBy('nome_italiano', 'DESC')
																		->get();
																@endphp
																@foreach($query_com AS $key_com=>$value_com)
																	<option value="{{ $value_com->nome_italiano }}" <?php if(isset($paese_sped) && ($paese_sped==$value_com->nome_italiano || $paese_sped==$value_com->nome_inglese)){?>selected="selected"<?php }?>>{{ $value_com->nome_italiano }}</option>
																@endforeach
															<?php } else {?>
																<option value="Italy" <?php if(isset($paese_sped) && ($paese_sped=="Italia" || $paese_sped=="Italy")){?>selected="selected"<?php }?>>Italy</option>
																@php
																	$query_com = DB::table('nazioni')
																		->select('*')
																		->orderBy('nome_inglese', 'DESC')
																		->get();
																@endphp
																@foreach($query_com AS $key_com=>$value_com)
																	<option value="{{ $value_com->nome_inglese }}" <?php if(isset($paese_sped) && ($paese_sped==$value_com->nome_italiano || $paese_sped==$value_com->nome_inglese)){?>selected="selected"<?php }?>>{{ $value_com->nome_inglese }}</option>
																@endforeach
															<?php }?>
														</select>
														<?php /*<input type="text" class="form-control" id="paese_sped" name="paese_sped" value="<?php  echo $paese_sped; ?>">*/?>
													</div>
												</div>
												
												<div class="row">	
													<div class="form-group col-sm-6">
														<label for="telefono"><?php if($lingua=="ita"){?>Telefono<?php } else {?>Phone<?php }?></label>
														<input type="text" class="form-control" id="telefono_sped" name="telefono_sped" value="<?php  echo $telefono_sped; ?>">
													</div>
													<div style="clear:both"></div>
												</div>
											  
												<div class="row">
													<div class="form-group col-sm-6">
													 <label for="fattura"><?php if($lingua=="ita"){?>Fattura<?php } else {?>Invoice<?php }?></label>
													  <div class="controls">
															<img src="web/images/scegli_no.jpg" alt="" style="cursor:pointer" id="imgFatt" onclick="vediFatt()"/>
													  </div>
													</div>
													<div style="clear:both"></div>
												</div>  
											</div>
										</div>
										
										<script type="text/javascript">
											var fatt=0;
											function vediFatt(){
												if(fatt==0){
													fatt=1;
													document.getElementById('datiFatt').style.display="block";
													document.getElementById('bottSped').style.display="block";
													document.getElementById('imgFatt').src="web/images/scegli_si.jpg";
													document.formSped.fattura.value="1";
												}else{
													fatt=0;
													document.getElementById('datiFatt').style.display="none";
													document.getElementById('bottSped').style.display="none";
													document.getElementById('imgFatt').src="web/images/scegli_no.jpg";
													document.formSped.fattura.value="0";
												}
											}
										</script>
										
										<div style="width:100%; height:20px;"></div>
										
										<div class="row" style="display:none;" id="datiFatt">
											
											<span style="font-size:1.3em; font-family:'Open Sans'; font-style:italic"><b><?php if($lingua=="ita"){?>Dettagli Fatturazione<?php } else {?>Invoice Details<?php }?></b></span><br/><br/>
											<input type="hidden" name="stato_fatt" value="inviato"/>				
											
											<div class="row">
												<div class="form-group col-sm-6">
													<label for="nome_fatt"><?php if($lingua=="ita"){?>Nome<?php } else {?>Name<?php }?> *</label>
													<input type="text" class="form-control" id="nome_fatt" name="nome_fatt" value="<?php  echo $nome_fatt; ?>">
												</div>
												
												<div class="form-group col-sm-6">
													<label for="cognome_fatt"><?php if($lingua=="ita"){?>Cognome<?php } else {?>Surname<?php }?> *</label>
													<input type="text" class="form-control" id="cognome_fatt" name="cognome_fatt" value="<?php  echo $cognome_fatt; ?>">
												</div>
											</div>
											
											<div class="row">	
												<div class="form-group col-sm-6">
													<label for="citta_fatt"><?php if($lingua=="ita"){?>Citt&agrave;<?php } else {?>City<?php }?> *</label>
													<input type="text" class="form-control" id="citta_fatt" name="citta_fatt" value="<?php  echo $citta_fatt; ?>">
												</div>
												
												<div class="form-group col-sm-6">
													<label for="cap_fatt"><?php if($lingua=="ita"){?>Cap<?php } else {?>Postcode<?php }?> *</label>
													<input type="text" class="form-control" id="cap_fatt" name="cap_fatt" value="<?php  echo $cap_fatt; ?>">
												</div>
											</div>
											
											<div class="row">	
												<div class="form-group col-sm-6">
													<label for="indirizzo_fatt"><?php if($lingua=="ita"){?>Indirizzo<?php } else {?>Address<?php }?> *</label>
													<input type="text" class="form-control" id="indirizzo_fatt" name="indirizzo_fatt" value="<?php  echo $indirizzo_fatt; ?>">
												</div>
												
												<div class="form-group col-sm-6">
													<label for="paese_fatt"><?php if($lingua=="ita"){?>Paese di Residenza<?php } else {?>Country of Residence<?php }?> *</label>
													<input type="text" class="form-control" id="paese_fatt" name="paese_fatt" value="<?php  echo $paese_fatt; ?>">
												</div>
											</div>
											
											<div class="row">	
												<div class="form-group col-sm-6">
													<label for="telefono_fatt"><?php if($lingua=="ita"){?>Telefono<?php } else {?>Phone<?php }?></label>
													<input type="text" class="form-control" id="telefono_fatt" name="telefono_fatt" value="<?php  echo $telefono_fatt; ?>">
												</div>
												
												<div class="form-group col-sm-6">
													<label for="email_fatt">E-mail *</label>
													<input type="text" class="form-control" id="email_fatt" name="email_fatt" value="<?php  echo $email_fatt; ?>">
												</div>
											</div>
											
											<div class="row">	
												<div class="form-group col-sm-6">
													<label for="rag_sociale"><?php if($lingua=="ita"){?>Ragione Sociale<?php } else {?>Business Name<?php }?> **</label>
													<input type="text" class="form-control" id="ragione_sociale_fatt" name="ragione_sociale_fatt" value="<?php  echo $ragione_sociale_fatt; ?>">
												</div>
												
												<div class="form-group col-sm-6">
													<label for="p_iva"><?php if($lingua=="ita"){?>Partita Iva<?php } else {?>VAT number<?php }?> **</label>
													<input type="text" class="form-control" id="partita_iva_fatt" name="partita_iva_fatt" value="<?php  echo $partita_iva_fatt; ?>">
												</div>
											</div>
											
											<script language="javascript">
												Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
												Filtro_piva = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
												function controllaPIVA( piva )
													{
														if ( piva.length == 11 )
														{
															var codiceUFFICIOiva = parseInt( piva.substr( 0, 3 ) ) ;
															if ( codiceUFFICIOiva <= 0 || codiceUFFICIOiva > 121 ) return false ;
														
															var X = 0 ;
															var Y = 0 ;
															var Z = 0 ;
														
															// cifre posto dispari ... ma per un array indicizzato a zero, la prima cifra ha indice zero ... appunto !
															X += parseInt( piva.charAt(0) ) ;
															X += parseInt( piva.charAt(2) ) ;
															X += parseInt( piva.charAt(4) ) ;
															X += parseInt( piva.charAt(6) ) ;
															X += parseInt( piva.charAt(8) ) ;

															// cifre posto pari ... ma per un array indicizzato a zero, la prima cifra ha indice uno ...
															Y += 2 * parseInt( piva.charAt(1) ) ;    if ( parseInt( piva.charAt(1) ) >= 5 ) Z++ ;
															Y += 2 * parseInt( piva.charAt(3) ) ;    if ( parseInt( piva.charAt(3) ) >= 5 ) Z++ ;
															Y += 2 * parseInt( piva.charAt(5) ) ;    if ( parseInt( piva.charAt(5) ) >= 5 ) Z++ ;
															Y += 2 * parseInt( piva.charAt(7) ) ;    if ( parseInt( piva.charAt(7) ) >= 5 ) Z++ ;
															Y += 2 * parseInt( piva.charAt(9) ) ;    if ( parseInt( piva.charAt(9) ) >= 5 ) Z++ ;
															
															var T = ( X + Y + Z ) % 10 ;

															var C = ( 10 - T ) % 10 ;

															return ( piva.charAt( piva.length - 1 ) == C ) ? true : false ;
														}
														else return false ;
													}
														
												function check_formSped(){
													if (document.formSped.nome_sped.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Nome" obbigatorio'<?php }else{?>'"Name" field is required'<?php }?>);			
													else if (document.formSped.cognome_sped.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Cognome" obbigatorio'<?php }else{?>'"Surname" field is required'<?php }?>);
													else if (document.formSped.citta_sped.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Citta\'" obbigatorio'<?php }else{?>'"City" field is required'<?php }?>);
													else if (document.formSped.cap_sped.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Cap" obbigatorio'<?php }else{?>'"Postcode" field is required'<?php }?>);
													else if (isNaN(document.formSped.cap_sped.value)) alert(<?php if($lingua=="ita"){?>'Il Cap deve essere composto di soli numeri'<?php }else{?>'"Postcode" field is wrong (only numbers allowed)'<?php }?>);
													else if (document.formSped.indirizzo_sped.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Indirizzo" obbigatorio'<?php }else{?>'"Address" field is required'<?php }?>);
													else if (document.formSped.paese_sped.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Paese di Residenza" obbigatorio'<?php }else{?>'"Country of Residence" field is required'<?php }?>);
													else if (isNaN(document.formSped.telefono_sped.value) && document.formSped.telefono_sped.value!="") alert(<?php if($lingua=="ita"){?>'Inserire un numero telefonico corretto (solo numeri)'<?php }else{?>'"Phone" field is wrong (only numbers allowed)'<?php }?>);
													else {
														if(document.formSped.fattura.value=="1"){					
															if (document.formSped.nome_fatt.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Nome" obbigatorio'<?php }else{?>'"Name" field is required in "Invoice Details"'<?php }?>);			
															else if (document.formSped.cognome_fatt.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Cognome" obbigatorio'<?php }else{?>'"Surname" field is required in "Invoice Details"'<?php }?>);
															else if (document.formSped.citta_fatt.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Citta\'" in Dettagli Fatturazione obbigatorio'<?php }else{?>'"City" field is required in "Invoice Details"'<?php }?>);
															else if (document.formSped.cap_fatt.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Cap" in Dettagli Fatturazione  obbigatorio'<?php }else{?>'"Postcode" field is required in "Invoice Details"'<?php }?>);
															else if (isNaN(document.formSped.cap_fatt.value)) alert(<?php if($lingua=="ita"){?>'Il Cap in Dettagli Fatturazione deve essere composto di soli numeri'<?php }else{?>'"Postcode" field in "Invoice Details is wrong (only numbers allowed)'<?php }?>);
															else if (document.formSped.indirizzo_fatt.value=="") alert(<?php if($lingua=="ita"){?>'Campo in Dettagli Fatturazione "Indirizzo" obbigatorio'<?php }else{?>'"Address" field is required in "Invoice Details"'<?php }?>);
															else if (document.formSped.paese_fatt.value=="") alert(<?php if($lingua=="ita"){?>'Campo in Dettagli Fatturazione "Paese di Residenza" obbigatorio'<?php }else{?>'"Country of Residence" field is required in "Invoice Details"'<?php }?>);
															//else if (document.formSped.telefono.value=="") alert('Campo "Telefono" obbigatorio');
															else if (isNaN(document.formSped.telefono_fatt.value) && document.formSped.telefono_fatt.value!="") alert(<?php if($lingua=="ita"){?>'Inserire un numero telefonico corretto (solo numeri)'<?php }else{?>'"Phone" field in "Invoice Details is wrong (only numbers allowed)'<?php }?>);
															else if (document.formSped.email_fatt.value=="") alert(<?php if($lingua=="ita"){?>'Campo in Dettagli Fatturazione "E-Mail" obbigatorio'<?php }else{?>'"E-mail" field is required in "Invoice Details"'<?php }?>);
															else if (Filtro.test(document.formSped.email_fatt.value)==false) alert(<?php if($lingua=="ita"){?>"Inserire un indirizzo email corretto in Dettagli Fatturazione"<?php }else{?>'"E-Mail" field in "Invoice Details is wrong'<?php }?>);
															//else if (isNaN(document.formSped.fax_fatt.value) && document.formSped.fax_fatt.value!="") alert('Inserire un numero di fax corretto (solo numeri)');
															else if(document.formSped.ragione_sociale_fatt.value!="" && document.formSped.partita_iva_fatt.value=="") alert(<?php if($lingua=="ita"){?>'Se presente la Ragione Sociale inserire una Partita Iva'<?php }else{?>'Both "Business Name" field and "VAT number" field are required'<?php }?>);
															else if(document.formSped.partita_iva_fatt.value!="" && document.formSped.ragione_sociale_fatt.value=="") alert(<?php if($lingua=="ita"){?>'Se presente la Partita Iva inserire una Ragione Sociale'<?php }else{?>'Both "Business Name" field and "VAT number" field are required'<?php }?>);
															else if(document.formSped.partita_iva_fatt.value!="" && controllaPIVA(document.formSped.partita_iva_fatt.value)==false) alert(<?php if($lingua=="ita"){?>'Inserire una partita iva corretta'<?php }else{?>'"VAT number" field in "Invoice Details is wrong (only numbers allowed)'<?php }?>);
															else document.formSped.submit();
														} else document.formSped.submit();
													}
												}
												function usaSped(){
													var x = confirm(<?php if($lingua=="ita"){?>"Sicuro di voler sostituire gli attuali dati di fatturazione con quelli di spedizione?"<?php }else{?>'Do you really want to modify your Invoice Details?'<?php }?>);
													if (x){
														document.formSped.nome_fatt.value=document.formSped.nome_sped.value;
														document.formSped.cognome_fatt.value=document.formSped.cognome_sped.value;
														//document.formSped.email_fatt.value=document.formSped.email_sped.value;
														document.formSped.telefono_fatt.value=document.formSped.telefono_sped.value;
														document.formSped.paese_fatt.value=document.formSped.paese_sped.value;
														document.formSped.indirizzo_fatt.value=document.formSped.indirizzo_sped.value;
														document.formSped.citta_fatt.value=document.formSped.citta_sped.value;
														document.formSped.cap_fatt.value=document.formSped.cap_sped.value;
													}
												}
											</script>
											<div style="width:100%; height:20px;"></div>
										</div>
										<input type="button" value="<?php if($lingua=="ita"){?>Procedi all'Acquisto<?php }else{?>Next Step<?php }?>" class="btn btn-orange" onclick="check_formSped()" style="float:right">
										<input value="<?php if($lingua=="ita"){?>Usa Dati Spedizione<?php }else{?>Use Shipping Details<?php }?>" class="btn btn btn-outline mr10" style="float:right; margin-bottom:10px; display:none; margin-right:20px" onclick="usaSped()" id="bottSped">
									</form>
								</div>
							</div>
						@elseif($step==2)
							<a name="step3"></a>
							<div id="step_titolo_2">Step 2 <?php if($lingua=="ita"){?>di<?php }else{?>of<?php }?> 3: <?php if($lingua=="ita"){?>Metodo di pagamento e spedizione<?php }else{?>Payment/Shipping Method<?php }?><a class="modify"></a> </div>
							<br/><br/>
							<div class="checkoutstep" id="step_3">
								@php  
									$link_form = "area-soci/checkout-step3.html";
									if($lingua=="eng") $link_form = "en/".$link_form;
								@endphp
								<form role="form" name="formSpedMod" method="POST" action="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/checkout-step4.html">
									@csrf
									<span style="font-size:1.3em; font-family:'Open Sans'; font-style:italic"><b><?php if($lingua=="ita"){?>Metodo di Pagamento<?php } else {?>Payment Method<?php }?></b></span><br/><br/>
									<?php if($lingua=="ita"){?>
										<p>Selezionare il <b>metodo di pagamento</b> preferito per quest'ordine</p>
									<?php }else{?>
										<p>Select <b>payment method</b> for this order</p>
									<?php }?>
									<input type="hidden" name="pag_mod" value="inviato"/>
									
									<label class="inline">
										<input type="radio" name="tipo_pagamento" value="2" checked="checked">
										Paypal o Carta di credito
									</label>
									
									<br/><br/>								
											
									<input type="hidden" name="stato_sped_mod" value="inviato"/>
									<input type="hidden" name="tipo_spedizione" value="Corriere Espresso"/>
									
									<div class="row">	
										<div class="form-group col-sm-12">
											<label for="rag_sociale"><?php if($lingua=="ita"){?>Aggiungi qui un commento<?php } else {?>Add a comment<?php }?></label>
											<textarea class="form-control" name="comm_spedizione" style="height:150px"><?php if(!isset($_SESSION['comm_spedizione']) || $_SESSION['comm_spedizione']==""){?><?php }else{ echo $_SESSION['comm_spedizione'];}?></textarea>
										</div>
									</div>
									<br>
									<input type="submit" value="<?php if($lingua=="ita"){?>Procedi all'Acquisto<?php }else{?>Next Step<?php }?>" class="btn btn-orange" style="float:right" onclick="check_formSpedMod()">
								</form>
								<script language="javascript">
									function check_formSpedMod(){
										document.formSpedMod.submit();
									}
								</script>
							</div>
						@elseif($step==3)
							@include('web.common.lista_carrello')
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