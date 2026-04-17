@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.la boutique');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.la boutique'); $breadcrumbs[$x]['link']=''; 
			
			$title = $metatag['title'];
		@endphp
		@include('web.common.page_title')
		
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-7">
						<div style="margin-bottom:10px">
							<a href="<?php echo request()->headers->get('referer');?>">
								<button type="button" class="btn btn-outline btn-dark btn-sm" style=""><i class="fa fa-backward"></i> <?php if($lingua=="ita"){?>Torna Indietro<?php }else{?>Back<?php }?></button>
							</a>
						</div>
						<div class="product">
                            <div class="row m-b-40">
                                @php
									$query_img = DB::table('prodotti_foto')
										->select('img')
										->where('id_rife','=',$query_dett[0]->id)
										->orderby('ordine','DESC')
										->get();
									$num_img = $query_img->count();
								@endphp
								@if($num_img>0)
									<div class="col-lg-5">
										<div class="product-image">
											<!-- Carousel slider -->
											<div class="carousel dots-inside dots-dark arrows-visible" data-items="1" <?php if($num_img==1){?>data-arrows="false"<?php }?> data-dots="false" data-loop="true" data-autoplay="true" data-animate-in="fadeIn" data-animate-out="fadeOut" data-autoplay="2500" data-lightbox="gallery">
												@foreach($query_img AS $key_img=>$value_img)
													@php	
														$img = $value_img->img;
													@endphp
													@if(!empty($img))
														<a href="https://www.yccs.it/resarea/img_up/prodotti/<?php echo $img;?>" data-lightbox="image" title="{!! $title !!}">
															<img alt="{!! $title !!}" src="https://www.yccs.it/resarea/img_up/prodotti/<?php if(file_exists(public_path()."resarea/img_up/prodotti/s_".$img)) echo "s_";?><?php echo $img;?>">
														</a>
													@endif
												@endforeach																																					
											</div>
											<!-- Carousel slider -->
										</div>
									</div>
								@endif
                                <div class="col-lg-{{$num_img>0 ? '7' : '12'}}">
                                    <div class="product-description">
                                        <div class="product-title">
                                            @php
												$nome_prod = $query_dett[0]->nome;
												if($lingua=="eng" && isset($query_dett[0]->nome_eng) && $query_dett[0]->nome_eng!="") $nome_prod = $query_dett[0]->nome_eng;
											@endphp
											<h3>{!!  $nome_prod !!}</h3>
                                        </div>
                                        <div class="product-category">
											@php
												$query_c = DB::table('categorie')
													->select('nome','nome_eng')
													->where('id','=',$id_cat)
													->get();
												$nome_c = $query_c[0]->nome;
												if($lingua=="eng" && isset($query_c[0]->nome_eng) && $query_c[0]->nome_eng!="") $nome_c = $query_c[0]->nome_eng;
												
												echo $nome_c;
												if(isset($id_sottocat) && $id_sottocat!="" && $id_sottocat!="0"){
													$query_s = DB::table('sottocategorie')
														->select('nome','nome_eng')
														->where('id','=',$id_sottocat)
														->get();
													$nome_s = $query_s[0]->nome;
													if($lingua=="eng" && isset($query_s[0]->nome_eng) && $query_s[0]->nome_eng!="") $nome_s = $query_s[0]->nome_eng;
													echo " / ".$nome_s;
												}
											@endphp
										</div>
                                        <div class="product-price">
											<ins>&euro; {{number_format($query_dett[0]->prezzo,2)}}</ins>
                                        </div>
                                        <div class="seperator m-b-10"></div>
                                        @php
											$descr_prod = "";
											if(isset($query_dett[0]->descr) && $query_dett[0]->descr!="") $descr_prod = $query_dett[0]->descr;
											if($lingua=="eng" && isset($query_dett[0]->descr_eng) && $query_dett[0]->descr_eng!="") $descr_prod = $query_dett[0]->descr_eng;
										@endphp
                                        @if($descr_prod != "")
											{!!  $descr_prod !!}
											<div class="seperator m-t-20 m-b-10"></div>
										@endif
                                    </div>
                                    <div class="row">
                                        @php
											$query_var = DB::table('prodotti')
												->select('*')
												->where('id_rife_varianti','=',$query_dett[0]->id_rife_varianti)
												->get();
											$num_var = $query_var->count();
										@endphp
										@if($num_var>1)
											 <div class="col-lg-12">
												<h6><?php if($lingua=="ita"){?>Seleziona Colore<?php }else{?>Select Color<?php }?></h6>
												<label class="sr-only"><?php if($lingua=="ita"){?>Colore<?php }else{?>Color<?php }?></label>
												<select style="padding:10px"  onchange="window.location=this.value;">
													<option value=""><?php if($lingua=="ita"){?>Seleziona Colore<?php }else{?>Select Color<?php }?>…</option>
													@foreach($query_var AS $key_var=>$value_var)
														@php
															$query_col = DB::table('colori')
																->select('nome', 'nome_eng')
																->where('id','=',$value_var->colore)
																->get();
															$nome_col = "";
															if(isset($query_col[0]->nome) && $query_col[0]->nome!="") $nome_col = $query_col[0]->nome;
															if($lingua=="eng" && isset($query_col[0]->nome_eng) && $query_col[0]->nome_eng!="") $nome_col = $query_col[0]->nome_eng;
															
															$link_var=str_replace("-".$query_dett[0]->id.".html","-".$value_var->id.".html",url()->full());
														@endphp
														<option value="<?php echo $link_var;?>"  <?php if($value_var->colore==$query_dett[0]->colore){?>selected="selected"<?php }?>>{!! $nome_col !!}</option>
													@endforeach
												</select>
											</div>											
										@endif
                                        @if(isset($query_dett[0]->tipo_taglia) && $query_dett[0]->tipo_taglia!="")
											<div class="col-lg-12">
												<h6><?php if($lingua=="ita"){?>Seleziona Taglia<?php }else{?>Select the size<?php }?></h6>
													
													@php
														$query_t = DB::table('valori_taglia')
															->select('*')
															->where('id_tipo','=',$query_dett[0]->tipo_taglia)
															->orderby('ordine','DESC')
															->get();
													@endphp
													@foreach($query_t AS $key_t=>$value_t)
														@php
															$query_tg = DB::table('quantita_taglie')
																->select('quantita')
																->where('id_prodotto','=',$query_dett[0]->id)
																->where('id_valore','=',$value_t->id)
																->get();
															$quantita = 0;
															if(isset($query_tg[0]->quantita)) $quantita = $query_tg[0]->quantita;
														@endphp
														<div style="float:left; margin-right:10px; margin-bottom:5px;  <?php if($quantita!=0){?>cursor:pointer;<?php }else{?>cursor:default;<?php }?> border: solid 1px #e3e3e3" id="blocco_taglia_<?php echo $value_t->id;?>" <?php if($quantita!=0){?>onmouseover="taglia_over_<?php echo $value_t->id;?>();" onmouseout="taglia_out_<?php echo $value_t->id;?>();" onclick="taglia_click_<?php echo $value_t->id;?>();"<?php }?>>
															<div style="padding:5px 10px; color:#9c96a2; font-size:1.1em; <?php if($quantita==0){?>background:#f0f0f0; opacity: 0.4; filter: alpha(opacity=40);<?php }?>" id="taglia_<?php echo $value_t->id;?>">
																{!! $value_t->valore !!}
															</div>
														</div>
														<script type="text/javascript">
															var id_tg="";
															function taglia_over_<?php echo $value_t->id;?>(){
																document.getElementById('blocco_taglia_<?php echo $value_t->id;?>').style.border='solid 1px #444444';
															}
															function taglia_out_<?php echo $value_t->id;?>(){
																document.getElementById('blocco_taglia_<?php echo $value_t->id;?>').style.border='solid 1px #e3e3e3';
															}
															function taglia_click_<?php echo $value_t->id;?>(){
																@php
																	$query_t2 = DB::table('valori_taglia')
																		->select('*')
																		->where('id_tipo','=',$query_dett[0]->tipo_taglia)
																		->orderby('ordine','DESC')
																		->get();
																@endphp
																@foreach($query_t2 AS $key_t2=>$value_t2)
																	if(document.getElementById('blocco_taglia_<?php echo $value_t2->id;?>')){
																		document.getElementById('blocco_taglia_<?php echo $value_t2->id;?>').style.background='#fff';
																		document.getElementById('taglia_<?php echo $value_t2->id;?>').style.color='#9c96a2';
																	}
																@endforeach
																document.getElementById('blocco_taglia_<?php echo $value_t->id;?>').style.background='#8c8c8c';
																document.getElementById('taglia_<?php echo $value_t->id;?>').style.color='#fff';
																document.getElementById('quant_prod').value=0;
																id_tg='<?php echo $value_t->id;?>';
															}
														</script>
													@endforeach
												
											</div>
										@endif
										<div style="width:100%; height:20px; clear:both"></div>
										
                                        <div class="col-lg-6">
                                            <h6><?php if($lingua=="ita"){?>Seleziona quantit&agrave;<?php }else{?>Select quantity<?php }?></h6>
                                            <div class="cart-product-quantity">
                                                <div class="quantity m-l-5">
                                                    <input type="button" class="minus" value="-" onclick="modifica_quant('minus')">
                                                    <input type="text" class="qty" value="0" id="quant_prod" disabled="disabled" style="padding:0; background:#fff">
                                                    <input type="button" class="plus" value="+" onclick="modifica_quant('plus')">
                                                </div>
                                            </div>
											<script type="text/javascript">
												var id_tg='0';
												function modifica_quant(azione){
													<?php if(isset($query_dett[0]->tipo_taglia) && $query_dett[0]->tipo_taglia!=""){?>if(id_tg!="0"){<?php }else{?>if(id_tg!=""){<?php }?>
														if(azione=='plus'){
															document.getElementById('quant_prod').value++; 
															$.ajax({
																url : "ajax/quantitaAdd.php",
																type: "GET",
																data : 'id_prod=<?php echo $id_dett;?>&tipo_taglia=<?php echo $query_dett[0]->tipo_taglia;?>&id_tg='+ id_tg +'&quantita='+document.getElementById('quant_prod').value,
																success : function (result) {
																	if((result - document.getElementById('quant_prod').value)<0){
																		alert('Prodotto non disponibile nella quantità indicata');
																		document.getElementById('quant_prod').value--; 
																	}
																},
																error : function (richiesta,stato,errori) {
																	alert("E' evvenuto un errore. lo stato della chiamata: "+stato);
																}
															});
														}else if(azione=='minus'){
															if(document.getElementById('quant_prod').value>1){
																document.getElementById('quant_prod').value--;
															}
														}
													}else{
														alert("Selezionare una taglia");
													}
												}
											</script>
                                        </div>
										
                                        <div class="col-lg-6">
                                            <h6>&nbsp;</h6>
											<div class="btn" href="#" onclick="checkAdd();">
												<i class="icon-shopping-cart"></i> <?php if($lingua=="ita"){?>Aggiungi al Carrello<?php }else{?>Add to cart<?php }?>
											</div>											
                                        </div>
                                    </div>
									<iframe id="frameCarrello" src="" style="display:none"></iframe>
									<script>
										function checkAdd(){
											<?php if(isset($query_dett[0]->tipo_taglia) && $query_dett[0]->tipo_taglia!=""){?>
											if(id_tg=='0') alert('Selezionare una taglia'); 
											else<?php }?> if(document.getElementById('quant_prod').value=='0') alert('Selezionare quantità'); 
											else add1Prod(<?php echo $query_dett[0]->id;?>,id_tg, document.getElementById('quant_prod').value);
										}
										
										function add1Prod(id_prodotto, taglia, quantita) {
											document.getElementById('frameCarrello').src='carrelloFrame.php?azione_carr=mod_'+id_prodotto+'&q_'+id_prodotto+'='+quantita+'&taglia_'+id_prodotto+'='+taglia+'&tipo_carr=prodotto';
											/*if (document.getElementById('divCart_'+id_prodotto)) {
												document.getElementById('addCart_'+id_prodotto).innerHTML='<i class="fa fa-shopping-cart"></i>'; 
												document.getElementById('divCart_'+id_prodotto).style.background='#ff6400'; 
												document.getElementById('divCart_'+id_prodotto).style.cursor='default';
												document.getElementById('addCart_'+id_prodotto).style.cursor='default';
												document.getElementById('addCart_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('divCart_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('addCart_'+id_prodotto).removeEventListener("click", getClickPosition, false);
												document.getElementById('divCart_'+id_prodotto).removeEventListener("click", getClickPosition, false);
											}
											if (document.getElementById('addCart_lat_off_'+id_prodotto)) {
												document.getElementById('addCart_lat_off_'+id_prodotto).style.color='#ff6400'; 
												document.getElementById('addCart_lat_off_'+id_prodotto).style.cursor='default';
												document.getElementById('addCart_lat_off_'+id_prodotto).onclick='';
												document.getElementById('addCart_lat_off_'+id_prodotto).innerHTML='<i class="fa fa-shopping-cart" title="Già nel Carrello" alt="Già nel Carrello"></i>';
												document.getElementById('addCart_lat_off_'+id_prodotto).removeEventListener("click", getClickPosition, false);												
											}
											if (document.getElementById('addCart_lat_occ_'+id_prodotto)) {
												document.getElementById('addCart_lat_occ_'+id_prodotto).style.color='#ff6400'; 
												document.getElementById('addCart_lat_occ_'+id_prodotto).style.cursor='default';
												document.getElementById('addCart_lat_occ_'+id_prodotto).onclick='';
												document.getElementById('addCart_lat_occ_'+id_prodotto).innerHTML='<i class="fa fa-shopping-cart" title="Già nel Carrello" alt="Già nel Carrello"></i>';
												document.getElementById('addCart_lat_occ_'+id_prodotto).removeEventListener("click", getClickPosition, false);												
											}
											if (document.getElementById('addCart_lat_ven_'+id_prodotto)) {
												document.getElementById('addCart_lat_ven_'+id_prodotto).style.color='#ff6400'; 
												document.getElementById('addCart_lat_ven_'+id_prodotto).style.cursor='default';
												document.getElementById('addCart_lat_ven_'+id_prodotto).onclick='';
												document.getElementById('addCart_lat_ven_'+id_prodotto).innerHTML='<i class="fa fa-shopping-cart" title="Già nel Carrello" alt="Già nel Carrello"></i>';
												document.getElementById('addCart_lat_ven_'+id_prodotto).removeEventListener("click", getClickPosition, false);												
											}
											if (document.getElementById('divCartCor_'+id_prodotto)) {
												document.getElementById('addCartCor_'+id_prodotto).innerHTML='GI&Agrave; NEL CARRELLO'; 
												document.getElementById('divCartCor_'+id_prodotto).style.background='#ff6400'; 
												document.getElementById('divCartCor_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartCor_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartCor_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('divCartCor_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('addCartCor_'+id_prodotto).removeEventListener("click", getClickPosition, false);
												document.getElementById('divCartCor_'+id_prodotto).removeEventListener("click", getClickPosition, false);
											}
											if (document.getElementById('divCartRec_'+id_prodotto)) {
												document.getElementById('addCartRec_'+id_prodotto).innerHTML='GI&Agrave; NEL CARRELLO'; 
												document.getElementById('divCartRec_'+id_prodotto).style.background='#ff6400'; 
												document.getElementById('divCartRec_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartRec_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartRec_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('divCartRec_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('addCartRec_'+id_prodotto).removeEventListener("click", getClickPosition, false);
												document.getElementById('divCartRec_'+id_prodotto).removeEventListener("click", getClickPosition, false);
											}
											if (document.getElementById('divCartDett_'+id_prodotto)) {
												document.getElementById('addCartDett_'+id_prodotto).innerHTML='<div style="float:left"><img src="img/cart2.png" alt="Già nel Carrello"/></div><div style="float:left; margin-left:20px; margin-top:10px; font-weight:normal; font-size:0.9em">GI&Agrave; NEL CARRELLO</div>'; 
												document.getElementById('divCartDett_'+id_prodotto).style.background='#ff6400'; 
												document.getElementById('divCartDett_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartDett_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartDett_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('divCartDett_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('addCartDett_'+id_prodotto).removeEventListener("click", getClickPosition, false);
												document.getElementById('divCartDett_'+id_prodotto).removeEventListener("click", getClickPosition, false);
											}
											if (document.getElementById('divCartOcc_'+id_prodotto)) {
												document.getElementById('addCartOcc_'+id_prodotto).innerHTML='GI&Agrave; NEL CARRELLO'; 
												document.getElementById('divCartOcc_'+id_prodotto).style.background='#ff6400'; 
												document.getElementById('divCartOcc_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartOcc_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartOcc_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('divCartOcc_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('addCartOcc_'+id_prodotto).removeEventListener("click", getClickPosition, false);
												document.getElementById('divCartOcc_'+id_prodotto).removeEventListener("click", getClickPosition, false);
											}
											if (document.getElementById('divCartVen_'+id_prodotto)) {
												document.getElementById('addCartVen_'+id_prodotto).innerHTML='GI&Agrave; NEL CARRELLO'; 
												document.getElementById('divCartVen_'+id_prodotto).style.background='#ff6400'; 
												document.getElementById('divCartVen_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartVen_'+id_prodotto).style.cursor='default';
												document.getElementById('addCartVen_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('divCartVen_'+id_prodotto).setAttribute( "onClick", "" );
												document.getElementById('addCartVen_'+id_prodotto).removeEventListener("click", getClickPosition, false);
												document.getElementById('divCartVen_'+id_prodotto).removeEventListener("click", getClickPosition, false);
											}*/
										}
									</script>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="content col-lg-1"></div>	
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
					<!-- end: post content -->				
				</div>
			</div>
		</section> <!-- end: Content -->
		
	@endsection
@else	
	<script language="javascript">
		window.location = "<?php echo config('app.url');?>/<?php if($lingua=="eng"){?>en/<?php }?>area-soci/login.html";
	</script>
@endif