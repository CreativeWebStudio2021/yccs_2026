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
			
		@endphp
		@include('web.common.page_title')
		
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
						@php
							if(!isset($id_cat)) $id_cat="";
							if(!isset($id_sottocat)) $id_sottocat="";
						@endphp
						@if($id_cat=="")
							<div class="content col-lg-7">
								<div style="width:100%;">
									<div style="padding:30px;">
										@php
											$query_foto = DB::table('fotogallery_pagine');
											$query_foto = $query_foto->select('*');
											$query_foto = $query_foto->where('pagina','=','la-boutique');
											$query_foto = $query_foto->orderby('ordine','DESC');
											$query_foto = $query_foto->get();	
											$num_foto = $query_foto->count();	
										@endphp
										@if($num_foto>0)
											<!-- CAROUSEL -->
											<section class="no-padding">
												<div class="grid-articles carousel arrows-visibile" data-items="1" data-margin="0" data-dots="false">
													@foreach($query_foto AS $key_foto=>$value_foto)
														@php
															$dir_up = "resarea/img_up";
															
															$img="$dir_up/pagine/".$value_foto->foto;
															if(is_file("$dir_up/pagine/xs_".$value_foto->foto)) $img_xs="$dir_up/pagine/xs_".$value_foto->foto; else $img_xs=$img;
															if(is_file("$dir_up/pagine/s_".$value_foto->foto)) $img_s="$dir_up/pagine/s_".$value_foto->foto; else $img_s=$img;
															if(is_file("$dir_up/pagine/m_".$value_foto->foto)) $img_m="$dir_up/pagine/m_".$value_foto->foto; else $img_m=$img;
															if(is_file("$dir_up/pagine/l_".$value_foto->foto)) $img_l="$dir_up/pagine/l_".$value_foto->foto; else $img_l=$img;
														@endphp
														<article class="post-entry">
															<a href="#" class="post-image">
																<picture>
																  <source srcset="<?php echo $img_m;?>" media="(max-width: 600px)" />
																  <source srcset="<?php echo $img_s;?>" media="(max-width: 440px)" />
																  <source srcset="<?php echo $img_xs;?>" media="(max-width: 340px)" />
																  <img src="https://www.yccs.it/<?php echo $img_l;?>"  alt="{!! $value_foto->testo !!} - {{ Lang::get('website.'.$pagina.' nome pagina') }} - {{ config('app.name') }}"/>
																</picture>
															</a>
															@if($value_foto->testo && $value_foto->testo!="")
																<div class="post-entry-overlay">
																	<div class="post-entry-meta">
																		<div class="post-entry-meta-title">
																			<h2>{!! $value_foto->testo !!}</h2>
																		</div>
																	</div>
																</div>
															@endif
														</article>		
													@endforeach
												</div>
											</section>
											<!-- end: CAROUSEL -->
										@endif
									</div>
								</div>
								
								
								<div style="width:100%;">
									<div style="padding:30px; text-align:justify">
										<?php if($lingua=="ita"){?>
											Lo store online della Boutique YCCS propone una selezione di capi di abbigliamento, accessori e borse di brand esclusivi con un’attenzione particolare ai materiali utilizzati in un’ottica di sostenibilità ambientale.
											<br/>
											Immancabile la divisa sociale con i suoi accessori oltre a numerosi gadgets, costumi da bagno e articoli da regalo.
											<br/><br/>
											Si effettuano spedizioni in tutto il mondo.
										<?php }else{?>
											The online store of the YCCS Boutique offers a selection of clothing, accessories and bags of exclusive brands with a special attention to the materials used in an environmental sustainability perspective.
											<br/>
											Unmissable the social uniform with its accessories in addition to numerous gadgets, swimsuits and gift items.
											<br/><br/>
											We make shipments worldwide.
										<?php }?>
									</div>
								</div>
								
								@php 
									if($lingua=="ita") $titolo_blocco="Catergorie"; 
									else $titolo_blocco="Catergories"; 
								@endphp
								@include('web.common.titolo_blocco')
								
								<div style="width:100%;">
									<div style="padding:10px 30px 0px 30px;">					 
										<div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
											@php																		
												$query_c = DB::table('categorie')
													->select('*')
													->orderby('ordine','DESC')
													->get();
											@endphp
											@foreach($query_c AS $key_c=>$value_c)
												@php
													$query_prod = DB::table('prodotti')
														->select('id')
														->WHERE('id_rife','=',$value_c->id)
														->WHERE('stato','=','1')
														->get();
													$num_prod = $query_prod->count();
												@endphp
												@if($num_prod>0)
													@php
														$link="";
														if($lingua=="eng") $link.="en/";
														$link.="area-soci/la-boutique/";
														if($lingua=="eng" && $value_c->nome_eng && trim($value_c->nome_eng)!="") $link.= creaSlug($value_c->nome_eng,"");
														else $link.=  creaSlug($value_c->nome,"");
														$link.="-".$value_c->id;							
														$link_cat=$link.".html";
														
														$nome_cat = $value_c->nome;
														if($lingua=="eng" && $value_c->nome_eng && trim($value_c->nome_eng)!="") $nome_cat = $value_c->nome_eng;
													@endphp
													<a href="<?php echo $link_cat;?>">
														<div class="post-item border">
															<div class="post-item-wrap" style="text-align:center;box-shadow:2px 2px 3px #BBBBBB">
																<div class="post-image" style="margin-top:20px;">
																	<img alt="" src="https://www.yccs.it/web/images/yccs_guidone.png" style="width:150px;">
																</div>
																<div class="post-item-description" style="height:90px">
																	<h2>{{ $nome_cat }}</h2>
																</div>
															</div>
														</div>
													</a>
												@endif
											@endforeach
										</div>																									
									</div>
								</div>							
							</div>							
						@elseif($id_sottocat=="")
							<div class="content col-lg-7">
								<div style="width:100%;">
									<div style="padding:30px;">							
										<div style="margin-bottom:30px;">
											<div style="float:left;width:100px; text-align:left;  margin-left:5px;">
												<div style="padding:15px 0; border-radius:5px; color:#666;">
													<b><?php if($lingua=="eng"){?>Categories<?php }else{?>Categorie<?php }?>:</b>
												</div>
											</div>
											@php
												$x=0;
												$query_cat = DB::table('categorie')
													->select('*')
													->orderby('ordine','DESC')
													->get();											
											@endphp
											@foreach($query_cat AS $key_cat=>$value_cat)
												@php
													$query_prod = DB::table('prodotti')
														->select('id')
														->where('id_rife','=',$value_cat->id)
														->where('stato','=','1')
														->get();
													$num_prod = $query_prod->count();
												@endphp
												@if($num_prod>0)
													<div style="float:left; margin-left:5px; margin-bottom:5px">
														<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/la-boutique/<?php echo creaSlug($value_cat->nome,"");?>-<?php echo $value_cat->id;?>.html">
															<div style="padding:15px; border:solid 1px #0d2443; border-radius:3px; <?php if($value_cat->id==$id_cat){?>background:#0d2443; color:#fff;<?php }else{?>color#666; cursor:pointer;<?php }?>" <?php if($value_cat->id!=$id_cat){?>onmouseover="this.style.background='#0d2443'; this.style.color='#fff';" onmouseout="this.style.background='#fbfbfb'; this.style.color='#666';"<?php }?>>
																<?php if($lingua=="eng" && $value_cat->nome_eng && trim($value_cat->nome_eng)!="") echo $value_cat->nome_eng; else echo $value_cat->nome;?>
															</div>
														</a>
													</div>
												@endif
											@endforeach
											<div style="clear:both; height:20px;"></div>
										</div>
										
										
										@php																		
											$query_c = DB::table('sottocategorie')
												->select('*')
												->where('id_rife','=',$id_cat)
												->orderby('ordine','DESC')
												->get();
											$num_sc = $query_c->count();
										@endphp
										@if($num_sc>0)
											@php 
												if($lingua=="ita") $titolo_blocco="Sottocatergorie"; 
												else $titolo_blocco="Subatergories"; 
											@endphp
											@include('web.common.titolo_blocco')
											<div style="width:100%;">
												<div style="padding:10px 30px 0px 30px;">					 
													<div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
														
														@foreach($query_c AS $key_c=>$value_c)
															@php
																$query_prod = DB::table('prodotti')
																	->select('id')
																	->WHERE('id_rife','=',$id_cat)
																	->WHERE('id_riferimento','=',$value_c->id)
																	->WHERE('stato','=','1')
																	->get();
																$num_prod = $query_prod->count();
															@endphp
															@if($num_prod>0)
																@php
																	$link_sottocat=url()->full();
																	$link_sottocat = str_replace('.html','/'.creaSlug($value_c->nome,"").'-'.$value_c->id.'.html',$link_sottocat);	
																	
																	$nome_sottocat = $value_c->nome;
																	if($lingua=="eng" && $value_c->nome_eng && trim($value_c->nome_eng)!="") $nome_sottocat = $value_c->nome_eng;
																@endphp
																<a href="<?php echo $link_sottocat;?>">
																	<div class="post-item border">
																		<div class="post-item-wrap" style="text-align:center;box-shadow:2px 2px 3px #BBBBBB">
																			<div class="post-image" style="margin-top:20px;">
																				<img alt="" src="https://www.yccs.it/web/images/yccs_guidone.png" style="width:150px;">
																			</div>
																			<div class="post-item-description" style="height:90px">
																				<h2>{{ $nome_sottocat }}</h2>
																			</div>
																		</div>
																	</div>
																</a>
															@endif
														@endforeach
													</div>																									
												</div>
											</div>
										@else
											@php 
												if($lingua=="ita") $titolo_blocco="Prodotti"; 
												else $titolo_blocco="products"; 
											@endphp
											@include('web.common.titolo_blocco')
											
											<div style="width:100%;">
												<div style="padding:10px 30px 0px 30px;">					 
													<div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
														@php																		
															$query_p = DB::table('prodotti')
																->select('*')
																->where('id_rife','=',$id_cat)
																->where('stato','=','1')
																->orderby('ordine','DESC')
																->get();
															$num_prod = $query_p->count();
														@endphp
														@if($num_prod>0)
															@foreach($query_p AS $key_p=>$value_p)
																
																@php
																	$query_cat = DB::table('categorie')
																		->select('nome','nome_eng')
																		->where('id','=',$value_p->id_rife)
																		->orderby('ordine','DESC')
																		->get();
																		
																	$nome_cat = $query_cat[0]->nome;
																	if($lingua=="eng" && isset($query_cat[0]->nome_eng) && $query_cat[0]->nome_eng!="") $nome_cat = $query_cat[0]->nome_eng;
																																																		
																	$link_prod=url()->full();
																	$link_prod = str_replace('.html','/0-0/'.creaSlug($value_p->nome,"").'-'.$value_p->id.'.html',$link_prod);	
																	
																	$nome_prod = $value_p->nome;
																	if($lingua=="eng" && $value_p->nome_eng && trim($value_p->nome_eng)!="") $nome_prod = $value_p->nome_eng;
																@endphp
																<a href="<?php echo $link_prod;?>">
																	<div class="post-item border">
																		<div class="post-item-wrap" style="text-align:center;box-shadow:2px 2px 3px #BBBBBB">
																			<div class="post-image">
																				@php
																					$query_f = DB::table('prodotti_foto');
																					$query_f = $query_f->select('img');
																					$query_f = $query_f->where('id_rife','=',$value_p->id);
																					$query_f = $query_f->orderby('ordine','DESC');
																					$query_f = $query_f->limit(1);
																					$query_f = $query_f->get();
																					foreach($query_f AS $key_f=>$value_f){
																						$img = $value_f->img;
																					}																																					
																				@endphp
																				<img src="https://www.yccs.it/resarea/img_up/prodotti/<?php if(file_exists(public_path()."/resarea/img_up/prodotti/s_".$img)) echo "s_";?><?php echo $img;?>" alt="">
																			</div>
																			<div class="post-item-description" style="text-align:left;">
																				<h4 style="text-align:left; font-size:1em">{{ $nome_prod }}</h4>
																				<span class="post-meta-date" style="color:#8D8D8D"><i class="icon-tag"> </i>{!! $nome_cat !!}</span><br/>
																				<span class="post-meta-date" style="color:#8D8D8D"><i class="fa fa-euro-sign"></i>{{ number_format($value_p->prezzo,2) }}</span>
																			</div>
																		</div>
																	</div>
																</a>
															@endforeach
														@endif
													</div>																									
												</div>
											</div>
										@endif
									</div>				
								</div>				
							</div>				
						@else
							<div class="content col-lg-7">	
								<div style="width:100%;">
									<div style="padding:30px;">																
										<div style="margin-bottom:30px;">
											<div style="float:left;width:100px; text-align:left;  margin-left:5px;">
												<div style="padding:15px 0; border-radius:5px; color:#666;">
													<b><?php if($lingua=="eng"){?>Categories<?php }else{?>Categorie<?php }?>:</b>
												</div>
											</div>
											
											@php
												$x=0;
												$query_cat = DB::table('categorie')
													->select('*')
													->orderby('ordine','DESC')
													->get();											
											@endphp
											@foreach($query_cat AS $key_cat=>$value_cat)
												@php
													$query_prod = DB::table('prodotti')
														->select('id')
														->where('id_rife','=',$value_cat->id)
														->where('stato','=','1')
														->get();
													$num_prod = $query_prod->count();
												@endphp
												@if($num_prod>0)
													<div style="float:left; margin-left:5px;; margin-bottom:5px;">
														<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/la-boutique/<?php echo creaSlug($value_cat->nome,"");?>-<?php echo $value_cat->id;?>.html">
															<div style="padding:15px; border:solid 1px #0d2443; border-radius:3px; <?php if($value_cat->id==$id_cat){?>background:#0d2443; color:#fff;<?php }else{?>color#666; cursor:pointer;<?php }?>" <?php if($value_cat->id!=$id_cat){?>onmouseover="this.style.background='#0d2443'; this.style.color='#fff';" onmouseout="this.style.background='#fbfbfb'; this.style.color='#666';"<?php }?>>
																<?php if($lingua=="eng" && $value_cat->nome_eng && trim($value_cat->nome_eng)!="") echo $value_cat->nome_eng; else echo $value_cat->nome;?>
															</div>
														</a>
													</div>
												@endif
											@endforeach
											
											<div style="clear:both; height:20px;"></div>
											
											<div style="float:left;width:120px; text-align:left;  margin-left:5px;">
												<div style="padding:15px 0; border-radius:5px; color:#666;">
													<b><?php if($lingua=="eng"){?>Subcategories<?php }else{?>Sottocategorie<?php }?>:</b>
												</div>
											</div>
											
											@php
												$x=0;
												$query_subcat = DB::table('sottocategorie')
													->select('*')
													->where('id_rife','=',$id_cat)
													->orderby('ordine','DESC')
													->get();											
											@endphp
											@foreach($query_subcat AS $key_subcat=>$value_subcat)
												@php
													$query_prod = DB::table('prodotti')
														->select('id')
														->where('id_riferimento','=',$value_subcat->id)
														->where('stato','=','1')
														->get();
													$num_prod = $query_prod->count();
												@endphp
												@if($num_prod>0)
													<div style="float:left; margin-left:5px;; margin-bottom:5px;">
														<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/la-boutique/<?php echo creaSlug($nome_cat,"");?>-<?php echo $id_cat;?>/<?php echo creaSlug($value_subcat->nome,"");?>-<?php echo $value_subcat->id;?>.html">
															<div style="padding:15px; border:solid 1px #0d2443; border-radius:3px; <?php if($value_subcat->id==$id_sottocat){?>background:#0d2443; color:#fff;<?php }else{?>color#666; cursor:pointer;<?php }?>" <?php if($value_subcat->id!=$id_sottocat){?>onmouseover="this.style.background='#0d2443'; this.style.color='#fff';" onmouseout="this.style.background='#fbfbfb'; this.style.color='#666';"<?php }?>>
																<?php if($lingua=="eng" && $value_subcat->nome_eng && trim($value_subcat->nome_eng)!="") echo $value_subcat->nome_eng; else echo $value_subcat->nome;?>
															</div>
														</a>
													</div>
												@endif
											@endforeach
											
											<div style="clear:both; height:20px;"></div>
										</div>
										
										@php 
											if($lingua=="ita") $titolo_blocco="Prodotti"; 
											else $titolo_blocco="products"; 
										@endphp
										@include('web.common.titolo_blocco')
										
										<div style="width:100%;">
											<div style="padding:10px 30px 0px 30px;">					 
												<div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
													@php																		
														$query_p = DB::table('prodotti')
															->select('*')
															->where('id_riferimento','=',$id_sottocat)
															->where('stato','=','1')
															->whereColumn('id', 'id_rife_varianti') 
															->orderby('ordine','DESC')
															->get();
														$num_prod = $query_p->count();
													@endphp
													@if($num_prod>0)
														@foreach($query_p AS $key_p=>$value_p)
															
															@php
																$query_cat = DB::table('categorie')
																	->select('nome','nome_eng')
																	->where('id','=',$value_p->id_rife)
																	->orderby('ordine','DESC')
																	->get();
																	
																$nome_cat = $query_cat[0]->nome;
																if($lingua=="eng" && isset($query_cat[0]->nome_eng) && $query_cat[0]->nome_eng!="") $nome_cat = $query_cat[0]->nome_eng;
																
																$query_sottocat = DB::table('sottocategorie')
																	->select('nome','nome_eng')
																	->where('id','=',$value_p->id_riferimento)
																	->orderby('ordine','DESC')
																	->get();
																	
																$nome_sottocat = $query_sottocat[0]->nome;
																if($lingua=="eng" && isset($query_sottocat[0]->nome_eng) && $query_sottocat[0]->nome_eng!="") $nome_sottocat = $query_sottocat[0]->nome_eng;
																
																$link_prod=url()->full();
																$link_prod = str_replace('.html','/'.creaSlug($value_p->nome,"").'-'.$value_p->id.'.html',$link_prod);	
																
																$nome_prod = $value_p->nome;
																if($lingua=="eng" && $value_p->nome_eng && trim($value_p->nome_eng)!="") $nome_prod = $value_p->nome_eng;
															@endphp
															<a href="<?php echo $link_prod;?>">
																<div class="post-item border">
																	<div class="post-item-wrap" style="text-align:center;box-shadow:2px 2px 3px #BBBBBB">
																		<div class="post-image">
																			@php
																				$query_f = DB::table('prodotti_foto');
																				$query_f = $query_f->select('img');
																				$query_f = $query_f->where('id_rife','=',$value_p->id);
																				$query_f = $query_f->orderby('ordine','DESC');
																				$query_f = $query_f->limit(1);
																				$query_f = $query_f->get();
																				foreach($query_f AS $key_f=>$value_f){
																					$img = $value_f->img;
																				}																																					
																			@endphp
																			<img src="https://www.yccs.it/resarea/img_up/prodotti/<?php if(file_exists(public_path()."/resarea/img_up/prodotti/s_".$img)) echo "s_";?><?php echo $img;?>" alt="">
																		</div>
																		<div class="post-item-description" style="text-align:left;">
																			<h4 style="text-align:left; font-size:1em">{{ $nome_prod }}</h4>
																			<span class="post-meta-date" style="color:#8D8D8D"><i class="icon-tag"> </i>{!! $nome_cat !!} / {!! $nome_sottocat !!}</span><br/>
																			<span class="post-meta-date" style="color:#8D8D8D"><i class="fa fa-euro-sign"></i>{{ number_format($value_p->prezzo,2) }}</span>
																		</div>
																	</div>
																</div>
															</a>
														@endforeach
													@endif
												</div>																									
											</div>
										</div>	
									</div>				
								</div>		
							</div>
						@endif
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