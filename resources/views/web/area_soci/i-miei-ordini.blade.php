@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.i miei ordini');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.i miei ordini'); $breadcrumbs[$x]['link']=''; 
			
		@endphp
		@include('web.common.page_title')
		
		@php
			if(isset($id_dett)) $status=$id_dett; else $status="in-corso";
			
			if($status=="in-corso") $criterio =" AND status<>'annullato' AND status<>'cancellato' AND status<>'spedito'";
			elseif($status=="evasi") $criterio =" AND status='spedito'";
			elseif($status=="annullati") $criterio =" AND (status='annullato')";
			elseif($status=="tutti") $criterio =" AND status<>'cancellato' ";
		@endphp
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-7">						
						<div style="width:100%; display:flex; gap:35px;">
							<h3 class="gradient-title" style="line-height:1.2">{{ Lang::get('website.i miei ordini') }}</h3>
							<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
						</div>
						
						<div style="float:left; margin-right:15px; margin-bottom:15px;">
							<div style="padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px; <?php if($status=="in-corso"){?>background:#14a54a<?php }else{?>background:#323a45<?php }?>; color:#fff">
								<a href="area-soci/i-miei-ordini-in-corso.html" style="color:#fff" title="Ordini in Corso"><b>Ordini in Corso</b></a>
							</div>
						</div>
						<div style="float:left; margin-right:15px; margin-bottom:15px;">
							<div style="padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px; <?php if($status=="evasi"){?>background:#14a54a<?php }else{?>background:#323a45<?php }?>; color:#fff">
								<a href="area-soci/i-miei-ordini-evasi.html" style="color:#fff" title="Ordini Evasi"><b>Ordini Evasi</b></a>
							</div>
						</div>
						<div style="float:left;">
							<div style="padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px; <?php if($status=="tutti"){?>background:#14a54a<?php }else{?>background:#323a45<?php }?>; color:#fff">
								<a href="area-soci/i-miei-ordini-tutti.html" style="color:#fff" title="Tutti gli ordini"><b>Tutti</b></a>
							</div>
						</div>
						<div style="clear:both; height:20px"></div>
						
						@php
							$query_ord = DB::table('ordini');
							$query_ord = $query_ord->select('*');
							$query_ord = $query_ord->where('id_cliente','=',$_SESSION['user_id_login']);
							$query_ord = $query_ord->where('data_ord','<>',NULL);
							if($status=="in-corso"){
								$query_ord = $query_ord->where('status','<>','annullato');								
								$query_ord = $query_ord->where('status','<>','cancellato');								
								$query_ord = $query_ord->where('status','<>','spedito');								
							}
							if($status=="annullati"){
								$query_ord = $query_ord->where('status','=','annullati');								
							}
							if($status=="evasi"){
								$query_ord = $query_ord->where('status','=','spedito');								
							}
							if($status=="tutti"){
								$query_ord = $query_ord->where('status','<>','cancellato');								
							}
							$query_ord = $query_ord->ORDERBY('id','DESC');
							$query_ord = $query_ord->get();
						@endphp
						
						@foreach($query_ord AS $key_ord=>$value_ord)
							@php
								$temp=explode(" ",$value_ord->data_ord);
								$temp2=explode("-",$temp[0]);
								$data_ord=$temp2[2]."-".$temp2[1]."-".$temp2[0];
								
								$indirizzo_spe = $value_ord->indirizzo_spe;
								$cap_spe = $value_ord->cap_spe;
								$citta_spe = $value_ord->citta_spe;
								$prov_spe = $value_ord->prov_spe;
								$paese_spe = $value_ord->paese_spe;
								
								$inviato_a = "";
								$query_cli = DB::table('clienti')
									->select('*')
									->where('id','=',$_SESSION["user_id_login"])
									->get();
								
								if (isset($value_ord->azienda_spe) && $value_ord->azienda_spe!="") {
									$inviato_a_top = ucfirst($value_ord->azienda_spe);
									$inviato_a .= ucfirst($value_ord->azienda_spe);
								} else {
									$inviato_a_top = ucfirst($value_ord->nome_spe);
									$inviato_a .= ucfirst($value_ord->nome_spe);
								}
								if (isset($indirizzo_spe) && $indirizzo_spe=="") $indirizzo_spe = $query_cli[0]->indirizzo;
								if (isset($cap_spe) && $cap_spe=="") $cap_spe = $query_cli[0]->cap;
								if (isset($citta_spe) && $citta_spe=="") $citta_spe = $query_cli[0]->citta;
								if (isset($prov_spe) && $prov_spe=="") $prov_spe = $query_cli[0]->provincia;
								if (isset($paese_spe) && $paese_spe=="") $paese_spe = $query_cli[0]->nazione;
								
								$nome_spe = $value_ord->nome_spe;
								
								if ($nome_spe!="") $inviato_a = "<br />".$nome_spe;
								
								$totale = $value_ord->totale;
								if ($totale=="") {
									$totale = 0;
									$totale_imp = 0;
									$iva_tot = 0;
									
									$num_prod = 0;
									$query_tutti = DB::table('prodotti_ordinati')
										->select('id_prodotto','quantita')
										->where('id_rife','=',$value_ord->id)
										->get();
									$num_prod = $query_tutti->count();
									if ($num_prod>0) {
										for ($p=0; $p<$num_prod; $p++) {							
											$id_prod = $query_tutti[0]->id_prodotto;
											$qta_prod = $query_tutti[0]->quantita;
											$prezzo_prod = 0;
											
											$query_prod = DB::table('prodotti')
												->select('prezzo','id_rife','quantita')
												->where('id','=',$id_prod)
												->get();
											
											$prezzo_prod = $query_prod[0]->prezzo;
											$id_cat = $query_prod[0]->id_rife;
											$confp = $query_prod[0]->quantita;
											
											$sub_totale = ($prezzo_prod * $qta_prod * $confp);
											$totale_imp += $sub_totale;
											
											$nome_catv = "";
											$query_catv = DB::table('categorie')
												->select('nome')
												->where('id','=',$idcat)
												->get();
											$nome_catv = $query_catv[0]->nome;
											
											if ($nome_catv=="Edizioni Specializzate" || $nome_catv=="edizioni specializzate" || $_SESSION['nazione_utente_sud']!="Italia") {
												/* se il prodotto appartiene alla categoria "edizioni specializzate" non applico l'iva... */
												$iva_prod = 0;
												$iva_tot += 0;
											} elseif ($nome_catv=="Confetti" || $nome_catv=="confetti" || $nome_catv=="confetti & dolcetti" || $nome_catv=="Confetti & Dolcetti") {
												/* se il prodotto appartiene alla categoria "confetti" applico l'iva del 10%... */
												$iva_prod = (($prezzo_prod * $qta_prod * $confp) / 100) * 10;
												$iva_tot += $iva_prod;
											} else {
												/* ...altrimenti applico l'iva del 22% */
												$iva_prod = (($prezzo_prod * $qta_prod * $confp) / 100) * 22;
												$iva_tot += $iva_prod;
											}									
										}
										$totale = $totale_imp + $iva_tot;
									}
								}
							@endphp
							
							<table class="table table-bordered">
								<tr style="background:#7e9edb;color:#fff">
									<td class="data_ord">
										ORDINE EFFETTUATO IL <b><?php echo $data_ord;?></b>
									</td>
									<td>TOTALE<br/><b>&euro; <?php echo number_format($totale, 2, ',', '.');?></b></td>
									<td class="dest_ord" style="cursor:pointer" onclick="apri_invio_<?php echo $value_ord->id;?>()" id="bott_invio_<?php echo $value_ord->id;?>">INVIATO A<br/><b><?php  echo $inviato_a_top;?></b> &nbsp; <i class="fa fa-sort-down" style="font-size:1.3em"></i></td>
									<td style="cursor:pointer" onclick="apri_prodotti_<?php echo $value_ord->id;?>()" id="bott_dett_<?php echo $value_ord->id;?>">Dettagli &nbsp; <i class="fa fa-sort-down" style="font-size:1.3em"></i></td>
									<td>
									Ordine n. <b><?php echo $value_ord->id;?></b><br/><b>
									<?php 
									if($value_ord->status=="nuovo") echo "in corso";
									if($value_ord->status=="pagato") echo "pagato";
									if($value_ord->status=="spedito") echo "<span style=\"color:green\">evaso</span>";
									if($value_ord->status=="annullato") echo "<span style=\"color:red\">annullato</span>";
									?></b>
									</td>
								</tr>
												
								<tr style="display:none" id="prod_invio_<?php echo $value_ord->id;?>">
									<td colspan="5" style="background:#ecf0f1">
										INVIATO A:<br/>
										<b><?php  echo $inviato_a;?></b><br/>
										<?php echo $indirizzo_spe;?><br/>
										<?php echo $cap_spe;?> <?php echo $citta_spe;?><br/>
										<?php echo $paese_spe;?><br/>
										<?php if($value_ord->status=="evaso"){?>
											<span style="color:green"><b>Spedito<!-- il <?php echo $data_sped;?>--></b></span>
										<?php }?>
									</td>
								</tr>
								
								<tr style="display:none" id="prod_ord_<?php echo $value_ord->id;?>">
									<td colspan="5">
										<div style="padding-top:5px">
											<table class="table table-bordered" style="background:#ecf0f1">
												<tr>
													<td class="nome_prod" style="border-bottom:1px solid #b8bfbd"><b>Cod. Art.</b></td>
													<td class="nome_prod" style="border-bottom:1px solid #b8bfbd"><b>Descrizione</b></td>
													<td style="border-bottom:1px solid #b8bfbd"><b>Qta</b></td>
													<td class="prezzo_prod" style="border-bottom:1px solid #b8bfbd"><b>Prezzo</b></td>
													<td style="border-bottom:1px solid #b8bfbd"><b>Totale</b></td>
												</tr>
												@php
													$totale_imp = 0;
													$query_prod = DB::table('ordini_prod')
														->select('*')
														->where('id_ord','=',$value_ord->id)
														->get();
												@endphp
												@foreach($query_prod AS $key_prod=>$value_prod)
													@php
														$nomep = $value_prod->nome;
														$prezzo = $value_prod->prezzo;
														$sub_totale = $value_prod->prezzo_f;
														$qg = $value_prod->quantita;
														$tg = $value_prod->taglia;
														$colore = $value_prod->colore;
																									
														if ($nomep=="" ||  $prezzo=="" || $sub_totale=="") {
															$query_dati = DB::table('prodotti')
																->select('id_rife','id_riferimento','nome','prezzo')
																->where('id','=',$value_prod->id_prod)
																->get();
															$idcat = $query_dati[0]->id_rife;
															$ids = $query_dati[0]->id_riferimento;
															$nomep = $query_dati[0]->nome;
															$prezzo = $query_dati[0]->prezzo;
															
															$sub_totale = ($prezzo * $qg);
															$totale_imp += $sub_totale;
															
															$nome_catv = "";
															$query_catv = DB::table('categorie')
																->select('nome')
																->where('id','=',$idcat)
																->get();
															$nome_catv = $query_catv[0]->nome;
															
														} else {
															$totale_imp += $sub_totale;
														}
													@endphp
													<tr>
														<td class="nome_prod" style="background:#fff"><?php echo $value_prod->id_prod;?></td>
														<td class="nome_prod" style="background:#fff">
															<?php echo $nomep;?>
															<?php if($colore && $colore!="") echo " (".$colore.")";?>
															<?php if($tg && $tg!="" && $tg!="0") echo " - ".$tg;?>
															<br />															
														</td>
														<td style="background:#fff"><?php echo $qg;?></td>
														<td class="prezzo_prod" style="background:#fff;text-align:right"><?php echo number_format($prezzo, 2, ',', '.');?>&euro;</td>
														<td style="background:#fff;text-align:right"><?php echo number_format($sub_totale, 2, ',', '.');?>&euro;</td>
													</tr>
												@endforeach
												<tr>
													<td colspan="2" style="border-top:1px solid #b8bfbd;border-right:none" class="col_sotto"></td>
													<td colspan="4" style="border-top:1px solid #b8bfbd;border-left:none">
														<div style="padding-top:10px">
															<table class="table wishlist table-bordered" style="background:#fff">
															  <tr>
																<td>Totale imp:</td>
																<td style="text-align:right"><?php echo number_format($totale_imp, 2, ',', '.');?>&euro;</td>
															  </tr>
															  <tr>
																<td><b>Spedizione:</b></td>
																<td style="text-align:right"><b><?php echo number_format($value_ord->spese, 2, ',', '.');?> &euro;</b></td>
															  </tr>
															  <tr>
																<td><span class="totale_ord" style="color:#2459a5"><b>Totale:</b></span></td>
																<td style="text-align:right"><span class="totale_ord" style="color:#2459a5"><b><?php echo number_format($totale, 2, ',', '.');?>&euro;</b></span></td>
															  </tr>	
															</table>
														</div>
													</td>
												</tr>
											</table>
										</div>
										<script type="text/javascript">
											var open_<?php echo $value_ord->id;?>=0;
											var open_invio_<?php echo $value_ord->id;?>=0;
											
											function apri_prodotti_<?php echo $value_ord->id;?>(){
												if(open_<?php echo $value_ord->id;?>==0){
													open_<?php echo $value_ord->id;?>=1;
													$("#prod_ord_<?php echo $value_ord->id;?>").fadeIn();
													document.getElementById('bott_dett_<?php echo $value_ord->id;?>').innerHTML='Dettagli &nbsp; <i class="fa fa-sort-up" style="font-size:1.3em;vertical-align:-5px"></i>';
												} else {
													open_<?php echo $value_ord->id;?>=0;
													$("#prod_ord_<?php echo $value_ord->id;?>").fadeOut();
													document.getElementById('bott_dett_<?php echo $value_ord->id;?>').innerHTML='Dettagli &nbsp; <i class="fa fa-sort-down" style="font-size:1.3em"></i>';
												}
											}
											function apri_invio_<?php echo $value_ord->id;?>(){
												if(open_invio_<?php echo $value_ord->id;?>==0){
													open_invio_<?php echo $value_ord->id;?>=1;
													$("#prod_invio_<?php echo $value_ord->id;?>").fadeIn();
													document.getElementById('bott_invio_<?php echo $value_ord->id;?>').innerHTML="INVIATO A<br/><b><?php echo $inviato_a_top;?></b> &nbsp; <i class=\"fa fa-sort-up\" style=\"font-size:1.3em;vertical-align:-5px\"></i></div>";
												} else {
													open_invio_<?php echo $value_ord->id;?>=0;
													$("#prod_invio_<?php echo $value_ord->id;?>").fadeOut();
													document.getElementById('bott_invio_<?php echo $value_ord->id;?>').innerHTML="INVIATO A<br/><b><?php echo $inviato_a_top;?></b> &nbsp; <i class=\"fa fa-sort-down\" style=\"font-size:1.3em\"></i>";
												}
											}
										</script>
									</td>
								</tr>
							</table>
						@endforeach
					</div>		
					<div class="content col-lg-1"></div>			
					<!-- end: post content -->
					<!-- Sidebar-->
					<div class="sidebar sticky-sidebar sidebar-modern col-lg-3" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
						<div class="row">
							<div class="content col-lg-12">
								@include('web.common.laterale-area-soci')
							</div>
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