@extends('web.index')

@php
	$codiceCheck=0;
	if($codice!="" && $id_dett!=""){
		$query_check = DB::table('magazine_articolo')
			->select('id')
			->where('id','=',$id_dett)
			->where('codice','=',$codice)
			->get();
		$num_check = $query_check->count();
		if($num_check>0) $codiceCheck=1;
	}
	
@endphp

@if($stato==1 || ($stato==0 && isset($_SESSION["loggato"]) && $_SESSION["loggato"] == "si") || ($stato==0 && $codiceCheck==1))
	@section('content')
		@php
			$query_dett = DB::table('magazine_articolo');
			$query_dett = $query_dett->select('*');
			$query_dett = $query_dett->where('id','=',$id_dett);
			if((isset($_SESSION["loggato"]) && $_SESSION["loggato"] == "si") || $codiceCheck==1){ 
			}else{
				$query_dett = $query_dett->where('visibile','=','1');				
			}
			$query_dett = $query_dett->first();
			$num_dett = $query_dett ? 1 : 0;
			
			$link_magazine="magazine/$anno_ric/";
		@endphp
		
		@if($num_dett>0 && $id_dett!="")
			@if($stato==1 && $query_dett->visibile==1 && $codiceCheck==1)
			
				@if(isset($query_dett->id_cat))
					@php
						$query_a = DB::table('magazine_macrocategorie')
							->select('id', 'nome', 'nome_eng')
							->where('id','=',$query_dett->id_cat)
							->first();
						$nome_a = $query_a->nome;
						if($lingua=="eng" && $query_a->nome_eng && trim($query_a->nome_eng)!="") $nome_a = $query_a->nome_eng;
						$link_magazine.=creaSlug($nome_a,"")."/";
					@endphp
				@endif
				@if(isset($query_dett->id_sottocat) && $query_dett->id_sottocat!="")
					@php
						$query_c = DB::table('magazine_categorie')
							->select('id', 'nome', 'nome_eng')
							->where('id','=',$query_dett->id_sottocat)
							->first();
						$nome_c = $query_c->nome;
						if($lingua=="eng" && $query_c->nome_eng && trim($query_c->nome_eng)!="") $nome_c = $query_c->nome_eng;
						$link_magazine.=creaSlug($nome_a,"")."/";
					@endphp
				@endif
				
				@php
					$titolo_mag = $query_dett->titolo;
					if ($lingua=="eng" && $query_dett->titolo_eng && $query_dett->titolo_eng!="") $titolo_mag = $query_dett->titolo_eng;
					$link_magazine.=creaSlug($titolo_mag,"");
					$link_magazine.="-".$query_dett->id.".html";
				@endphp
				<script>
					window.location='<?php echo $link_magazine?>';
				</script>
			@else
				@php
					$s=1;
					$sfondo_s = "resarea/img_up/magazine/".$query_dett->immagine;
				@endphp
				
				<style>				
					p{font-size:18px; line-height:24px; font-family:'Open Sans'}
					.tp-tabs, .tp-thumbs, .tp-bullets{display:none;}
					
					.testoMagazine{font-size:1.3em; line-height:1.3em}
					.testoLato{padding:150px}
					.halfMagazine{float:left; width:50%;}
					.prx{margin:30px 0px;}
					
					#magazine_tit{font-size:4em; line-height:1em}
					#magazine_sottotit{font-size:2em;}
					#magazine_bcrumbs{font-size:1em;}
					#blockSlide{padding:20px 30px;}
							
					@media screen AND (min-width:1025px){
						.prx{margin:80px 0px;}
					}
					
					@media screen AND (max-width:1200px){
						.testoLato{padding:75px}
					}
					@media screen AND (max-width:800px){
						.testoMagazine{font-size:1.3em; line-height:1.3em}
						.testoLato{padding:50px}
					}
					@media screen AND (max-width:600px){
						.testoMagazine{font-size:1.2em; line-height:1.25em}
						.testoLato{padding:40px}
						#magazine_tit{font-size:2em;}
						#magazine_sottotit{font-size:1.3em;}
						#blockSlide{padding:8px 10px;}
					}
					@media screen AND (max-width:478px){
						.halfMagazine{width:100%;}
						.testoLato{padding:50px 20px}
					}					
				</style>
				
				@php
					$titolo = $query_dett->titolo;
					if($lingua=="eng" && $query_dett->titolo_eng && trim($query_dett->titolo_eng)!="") $titolo = $query_dett->titolo_eng;
					$sottotitolo = $query_dett->sottotitolo;
					if($lingua=="eng" && $query_dett->sottotitolo_eng && trim($query_dett->sottotitolo_eng)!="") $sottotitolo = $query_dett->sottotitolo_eng;
				@endphp
				@if(isset($query_dett->id_cat))
					@php
						$query_a = DB::table('magazine_macrocategorie')
							->select('id', 'nome', 'nome_eng')
							->where('id','=',$query_dett->id_cat)
							->first();
						$nome_a = $query_a->nome;
						if($lingua=="eng" && $query_a->nome_eng && trim($query_a->nome_eng)!="") $nome_a = $query_a->nome_eng;
					@endphp
				@endif
				
				@if(isset($query_dett) && isset($query_dett->id_sottocat) && $query_dett->id_sottocat!="")
					@php
						$query_c = DB::table('magazine_categorie')
							->select('id', 'nome', 'nome_eng')
							->where('id','=',$query_dett->id_sottocat)
							->first();
						$nome_c = "";
						if(isset($query_c->nome) && $query_c->nome!="") $nome_c = $query_c->nome;
						if($lingua=="eng" && $query_c->nome_eng && trim($query_c->nome_eng)!="") $nome_c = $query_c->nome_eng;
					@endphp
				@endif
				
				<style>
					#sliderMob{display:none}
					#slider{display:block}
					@media screen AND (max-width:850px){
						#sliderMob{display:block}
						#slider{display:none}
					}
				</style>
				<div id="sliderMob" style="position:relative">
					<img src="https://www.yccs.it/<?php  echo $sfondo_s; ?>" alt="" style="width:100%"/>
				
					<?php if($query_dett->visibile=='0'){?>
						<div style="position:fixed; top:110px; right:10px; width:100px; background:red; text-align:center; color:#fff; border-radius:4px; z-index:1000000">
							<div style="padding:5px;">
								ANTEPRIMA
							</div>
						</div>
					<?php }?>
					
					<div style="margin-bottom:40px; background:grey">
						<div style="padding:20px;; color:#fff; text-align:center;">
							<div>
								<span style="font-size:1.8em"><?php echo $titolo;?></span>
							</div>
							<div style="margin:10px 0">
								<span style="font-size:1.3em"><?php echo $sottotitolo;?></span>
							</div>
							<div>
								<a href="<?php if($lingua=="eng") echo "en/";?>home.html" style="color:#fff">
									<i class="fa fa-home"></i></a>
									- <a href="<?php if($lingua=="eng") echo "en/";?>magazine.html" style="color:#fff">MAGAZINE</a>
									<?php if(isset($query_dett->anno)){?> - <a style="color:#fff"><?php echo $query_dett->anno;?></a><?php }?>
									<?php if(isset($query_dett->id_cat)){?> - <a href="<?php if($lingua=="eng") echo "en/";?>magazine-pag1/<?php if($query_dett->anno){ echo $query_dett->anno."/";}?><?php echo creaSlug($nome_a,"");?>-<?php echo $query_a->id;?>.html" style="color:#fff"><?php echo $nome_a;?></a><?php }?>
									<?php if(isset($query_dett->id_sottocat) && $query_dett->id_sottocat!="" && isset($query_c->id)){?> - <a href="<?php if($lingua=="eng") echo "en/";?>magazine-pag1/<?php if($query_dett->anno){ echo $query_dett->anno."/";}?><?php echo creaSlug($nome_a,"");?>-<?php echo $query_a->id;?>/<?php echo creaSlug($nome_c,"");?>-<?php echo $query_c->id;?>.html" style="color:#fff"><?php echo $nome_c;?></a><?php }?>
							</div>
						</div>
					</div>
				</div>
				
				<!-- SECTION REVOLUTION SLIDER -->
				<div id="slider" style="position:relative; height:100vh; min-height:100vh; top:-130px; background:url(https://www.yccs.it/<?php  echo $sfondo_s; ?>) center center; background-size:cover;">
					<?php if($query_dett->visibile=='0'){?>
						<div style="position:fixed; top:150px; right:10px; width:100px; background:red; text-align:center; color:#fff; border-radius:4px; z-index:1000000">
							<div style="padding:5px;">
								ANTEPRIMA
							</div>
						</div>
					<?php }?>
					<div id="blockSlide" style="background:rgba(0,0,0,0.5); margin:0 auto;  position:absolute; display: inline-block; text-align:centeR; top:50%; left:50%;-ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%); color:#fff;">
						<?php 
						
						?>
						<div id="magazine_tit" style=" font-weight: 900; ">
							<span><?php echo $titolo;?></span>
						</div>
						<div id="magazine_sottotit" style=" font-weight: 300; margin-top:20px;text-align:center; text-transform:uppercase">
							<?php echo $sottotitolo;?>
						</div>						
						
						<div id="magazine_bcrumbs" style="font-weight: 500; margin-top:15px; text-align:center;">
							<a href="<?php if($lingua=="eng") echo "en/";?>home.html" style="color:#fff">
								<i class="fa fa-home"></i></a>
								- <a href="<?php if($lingua=="eng") echo "en/";?>magazine.html" style="color:#fff">MAGAZINE</a>
								<?php if(isset($query_dett->anno)){?> - <a style="color:#fff"><?php echo $query_dett->anno;?></a><?php }?>
								<?php if(isset($query_dett->id_cat)){?> - <a href="<?php if($lingua=="eng") echo "en/";?>magazine-pag1/<?php if($query_dett->anno){ echo $query_dett->anno."/";}?><?php echo creaSlug($nome_a,"");?>-<?php echo $query_a->id;?>.html" style="color:#fff"><?php echo $nome_a;?></a><?php }?>
								<?php if(isset($query_dett->id_sottocat) && $query_dett->id_sottocat!="" && isset($query_c->id)){?> - <a href="<?php if($lingua=="eng") echo "en/";?>magazine-pag1/<?php if($query_dett->anno){ echo $query_dett->anno."/";}?><?php echo creaSlug($nome_a,"");?>-<?php echo $query_a->id;?>/<?php echo creaSlug($nome_c,"");?>-<?php echo $query_c->id;?>.html" style="color:#fff"><?php echo $nome_c;?></a><?php }?>
						</div>
					</div>
				</div>
				<!-- END SECTION REVOLUTION SLIDER -->
				
				<div class="testoMagazine">
					@php
						$dir_up = "resarea/img_up";		
						$b=1;
						$query_blocchi = DB::table('magazine_blocchi')
							->select('*')
							->where('id_articolo','=',$id_dett)
							->orderby('ordine','ASC')
							->get();
					@endphp
					@foreach($query_blocchi AS $key_blocchi=>$value_blocchi)
						@php
							foreach($value_blocchi as $key => $value) {
							  $risu_blocchi[$key] = $value;							  
							}							
						@endphp
						
						@if($risu_blocchi['tipo']=="solo_testo")
							<section class="content" style="padding-top:0; <?php if($b!=1){?>margin-top:80px; <?php }else{?>margin-bottom:20px;<?php }?>">
								<div class="container">
									<?php 
									$testo = $risu_blocchi['testo'];
									if($lingua=="eng" && $risu_blocchi['testo_eng'] && trim($risu_blocchi['testo'])!="") $testo = $risu_blocchi['testo_eng'];
									?>
									{!! $testo !!}
								</div>
							</section>
						@endif
						
						@if($risu_blocchi['tipo']=="solo_immagine")
							<?php 
							$sfondo_s="resarea/img_up/magazine/".$risu_blocchi['immagine'];
							?>
							<?php /*<section id="solo_immagine_<?php echo $risu_blocchi['id'];?>"; data-bg-parallax="<?php echo $sfondo_s;?>" style=" margin:100px 0;"></section>
							<script>
								<?php 
								list($width, $height, $type, $attr) = getimagesize("".$sfondo_s);
								?>
								var win_w = $( window ).width();
								var alt_block_<?php echo $risu_blocchi['id'];?> = <?php echo $height;?>*win_w/<?php echo $width;?>/100*70/2;
								
								document.getElementById("solo_immagine_<?php echo $risu_blocchi['id'];?>").style.padding=alt_block_<?php echo $risu_blocchi['id'];?>+"px 0";
							</script>
							*/?>
							<?php /*<style>
								#solo_immagine_<?php echo $risu_blocchi['id'];?> {
								  background-image: url("<?php echo $sfondo_s;?>");

								   min-height: 500px;

								  background-attachment: fixed;
								  background-position: center;
								  background-repeat: no-repeat;
								  background-size: cover;
								  margin:100px 0;
								}
							</style>

							<!-- Container element -->
							<div id="solo_immagine_<?php echo $risu_blocchi['id'];?>" style=" margin:100px 0;"></div>*/?>
							<div class="img-holder prx" data-image="https://www.yccs.it/<?php echo $sfondo_s;?>"></div>
						@endif
						
						@if($risu_blocchi['tipo']=="gallery")
							<section class="content" style="">
								<div class="container">
									<div id="portfolio" class="grid-layout portfolio-2-columns" data-margin="20" data-lightbox="gallery">
										@php
											$query_gal = DB::table('magazine_gallery')
												->select('*')
												->where('id_gallery','=',$risu_blocchi['id_gallery'])
												->orderby('ordine','DESC')
												->get();
											$x=1;
										@endphp
										@foreach($query_gal AS $key_gal=>$value_gal)										
											@foreach($value_gal as $key => $value)
												@php  $risu_gal[$key] = $value; @endphp						  
											@endforeach
											
											@php
												$foto = "resarea/img_up/magazine/".$risu_gal['immagine'];
												$ante = $foto;
												if(is_file("resarea/img_up/magazine/s_".$risu_gal['immagine'])) $ante = "resarea/img_up/magazine/s_".$risu_gal['immagine'];
												$title_ga=$titolo." - Magazine - Foto $x - ".config('app.name');
											@endphp
											
											<div class="portfolio-item shadow img-zoom">
												<div class="portfolio-item-wrap">
													<div class="portfolio-image">
														<a href="#">
															<img src="https://www.yccs.it/<?php echo $ante;?>"  alt="<?php  echo $title_ga; ?>"/>
														</a>
													</div>
													<div class="portfolio-description">
														<a title="{{ $title_ga }}" data-lightbox="gallery-image" href="https://www.yccs.it/<?php echo $foto;?>"><i class="icon-maximize"></i></a>
													</div>
												</div>
											</div>
											
											
											@php $x++ @endphp
										@endforeach						
									</div>
								</div>
							</section>
						@endif
						
						@if($risu_blocchi['tipo']=="immagine_testo")
							<div style="">
								<div class="halfMagazine" style="">
									<img src="https://www.yccs.it/resarea/img_up/magazine/<?php echo $risu_blocchi['immagine'];?>" style="width:100%" alt=""/>
								</div>
								<div class="halfMagazine" style="">
									<div class="testoLato" style="">
										<?php 
										$testo = $risu_blocchi['testo'];
										if($lingua=="eng" && $risu_blocchi['testo_eng'] && trim($risu_blocchi['testo'])!="") $testo = $risu_blocchi['testo_eng'];
										?>
										<?php echo $testo;?>
									</div>
								</div>
								<div style="clear:both"></div>
							</div>
						@endif
						
						@if($risu_blocchi['tipo']=="testo_immagine")
							<div style="">
								<div class="halfMagazine" style="">
									<div class="testoLato" style="">
										<?php 
										$testo = $risu_blocchi['testo'];
										if($lingua=="eng" && $risu_blocchi['testo_eng'] && trim($risu_blocchi['testo'])!="") $testo = $risu_blocchi['testo_eng'];
										?>
										<?php echo $testo;?>
									</div>
								</div>
								<div class="halfMagazine" style="">
									<img src="https://www.yccs.it/resarea/img_up/magazine/<?php echo $risu_blocchi['immagine'];?>" style="width:100%" alt=""/>
								</div>
								<div style="clear:both"></div>
							</div>
						@endif			
						@php $b++; @endphp
					@endforeach					
				</div>
			@endif
		@else
			<script>
				window.location="<?php echo config('app.url');?>/<?php if($lingua=='eng') echo 'en/';?>magazine.html";
			</script>
		@endif
	@endsection	
@else
	<script>
		window.location="<?php echo config('app.url');?>/<?php if($lingua=='eng') echo 'en/';?>home.html";
	</script>
@endif