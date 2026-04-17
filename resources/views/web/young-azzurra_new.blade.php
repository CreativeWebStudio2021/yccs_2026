@php
	$num_s = 0;
	$query_s = DB::table('ya_slide')
		->select('*')
		->where('visibile', '=', '1')				
		//->where('id', '>', '11')
		->orderBy('ordine', 'DESC')
		->get();
		
	$num_s = $query_s->count();
@endphp

@if ($num_s>0) 
	<style>
		.solo_desk{display:block}
		.solo_mob{display:none}
		@media screen AND (max-width:779px){
			.solo_desk{display:block}
			.solo_mob{display:none}
		}
	</style>
	<!-- Inspiro Slider -->
	<div id="slider" class="inspiro-slider slider-fullscreen dots-creative solo_desk" data-fade="true">
		@foreach ($query_s as  $key=>$campo)
			<!-- Slide 1 -->
			<div class="slide kenburns" data-bg-image="{{ smartAsset('/resarea/img_up/ya_slide/'.$campo->img) }}">
				<?php /*<div class="bg-overlay"></div>*/?>
				<div class="container" {!! (isset($campo->link) && $campo->link!="") ? 'style="cursor:pointer;" onclick="window.location=\''.$campo->link.'\'"' : '' !!}>
					
					<div class="slide-captions text-left text-light" style="text-shadow:3px 3px 2px #111">
						<!-- Captions -->
						@if($campo->riga1)
							<h2>{{ $campo->riga1 }}</h2>
						@endif
						@if($campo->riga2)
							<h1>{{ $campo->riga2 }}</h1>
						@endif
						@if($campo->riga3)
							<h3>{{ $campo->riga3 }}</h3>
						@endif
						
						</span>
						<!-- end: Captions -->
					</div>
				</div>
			</div>
			<!-- end: Slide 1 -->
		@endforeach
	</div>
	<!--end: Inspiro Slider -->
	
	<div style="position:relative;" class="solo_mob">
		@php
			$num_s = 0;
			$query_s = DB::table('ya_slide')
				->select('*')
				->where('visibile', '=', '1')				
				//->where('id', '>', '11')
				->orderBy('ordine', 'DESC')
				->limit('1')
				->get();
		@endphp
		<?php 
		$sfondo_s = $query_s[0]->img;
		?>
		<div id="boxSlide" style="position:relative;">
			<img  id="boxImgSlide" src="resarea/img_up/ya_slide/<?php echo $sfondo_s;?>" style="width:100%;" alt=""/>
		</div>
		
		<script>
			var n=1;
			
			@php
				$num_s = 0;
				$query_s = DB::table('ya_slide')
					->select('*')
					->where('visibile', '=', '1')			
					//->where('id', '>', '11')
					->orderBy('ordine', 'DESC')
					->get();
				$num_s = $query_s->count();
				$x=1;
				$string_foto = "";
				foreach($query_s AS $key_s=>$value_s){
					$string_foto.='"'.$value_s->img.'", ';
				}
			@endphp				
			
			var foto = [<?php echo substr($string_foto,0,-2);?>];
			function cambiaFoto(){
				n++;
				if(n==<?php echo $num_s+1;?>) n=1;
				$("#boxImgSlide").hide();
				document.getElementById('boxImgSlide').src="resarea/img_up/ya_slide/"+foto[n-1];
				$("#boxImgSlide").fadeIn();
				window.setTimeout('cambiaFoto()' , 3000);
			}
			cambiaFoto(1);
		</script>
	</div>
	<div style="width:100%; height:9px; background:#00AEEF;"></div>
@endif


@php
	$query_t = DB::table('ya_testo_home')
		->select('*')
		->where('id', '=', '1')
		->get();
		
	$testo_home=$query_t[0]->testo;
	if($lingua=="eng" && $query_t[0]->testo_eng && trim($query_t[0]->testo_eng)!="") $testo_home=$query_t[0]->testo_eng;
@endphp	
@if($testo_home && trim($testo_home)!="")
	<section style="background:#F7F7F7; padding:60px 0 40px;">	
		<div class="row" id="testoHome" >	
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div style="padding:0 20px;" class="solo_desk">
					<?php echo $testo_home;?>
				</div>
				<div style="padding:0 20px;" class="solo_mob">
					<div id="testoHomeYAClose">
						<?php 
						$testo_home = str_replace('text-align: center','text-align: justify',$testo_home);
						$testo_home_sub = substr($testo_home,0,250);
						echo $testo_home_sub;
						?>
						<div style="clear:both; width:120px; margin:0 auto; margin-top:10px; background:#8c8c8c; color:#fff; border-radius:4px; text-align:center; cursor:pointer;" onclick="apriTesto();">
							<div style="padding:3px;"><?php if($lingua=="ita"){?>Leggi Tutto<?php }else{?>Read All<?php }?></div>
						</div>
					</div>
					<div id="testoHomeYAOpen" style="display:none">
						<?php 
						echo $testo_home;
						?>
					</div>
					<script>
						function apriTesto(){
							document.getElementById('testoHomeYAClose').style.display='none';
							document.getElementById('testoHomeYAOpen').style.display='block';
						}
					</script>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
		</div>	
	</section>	
@endif
<section class="p-t-20 p-b-0">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">		
				@php 
					if($lingua=="ita") $titolo_blocco="Eventi"; 
					else $titolo_blocco="Events"; 
				@endphp
				@include('web.common.titolo_blocco')			
				<div class="col-md-12">
					<div style="position:relative;  margin-bottom:20px;width:100%;" id="box_info_regate">
						<div style=" " id="info_regate">			
							@php
								$query_com = DB::table('members_eventi')
									->select('*')
									->where('visibile', '=', '1')
									->orderBy('ordine', 'DESC')
									->get();
									
								$x=1;	
							@endphp
							<style>
								i:not(.fa):not(.fab):not(.far):not(.fas) {
									font-family:Raleway !important;
									font-style: italic;
								}
								.hiddenEvent{display:none}
							</style>
							@foreach($query_com AS $key_com=>$value_com)
								<div class="list-group-item <?php if($x==1){?>active<?php }?> <?php if($x>5){?>hiddenEvent<?php }?>" <?php if($x!=1){?>onmouseover="this.className = this.className.replace(' active',''); this.className = this.className + ' active';" onmouseout="this.className = this.className.replace(' active','');"<?php }?>> 
									<i class="fa fa-caret-right"></i> 
									@php
									if($lingua=="ita" && $value_com->testo_gruppo && $value_com->testo_gruppo!="") $testo_gruppo = ucfirst($value_com->testo_gruppo); 
									else $testo_gruppo = ucfirst($value_com->testo_gruppo_eng); 
									
									$temp=explode("-",$value_com->data);
									$anno = $temp[0];
									if($lingua=="ita"){
										$dal="dal ".$temp[2]."/".$temp[1];
										if($value_com->data_al && $value_com->data_al!="")
											$al="al ".substr($value_com->data_al,-2)."/".substr($value_com->data_al,5,-3);
										else $al="";
									}else{
										$dal="from ".$temp[2]."/".$temp[1];
										if($value_com->data_al && $value_com->data_al!="")
											$al="to ".substr($value_com->data_al,-2)."/".substr($value_com->data_al,5,-3);
										else $al="";
									}	
									@endphp
									@if($testo_gruppo && $testo_gruppo!="")
										<span ><b><?php echo $testo_gruppo;?></b></span><br/>
									@endif										
									<span style="font-size:0.9em"><?php echo $value_com->luogo;?> <?php echo $dal;?> <?php echo $al;?> <?php echo $anno;?></span>
									<br/>
									@php
										$link_comm=1;		
										$query_link_comm = DB::table('members_eventi_link')
											->select('*')
											->where('id_rife', '=', $value_com->id)
											->where('visibile', '=', '1')
											->orderBy('ordine', 'DESC')
											->get();	
										$num_link_comm = $query_link_comm->count();
									@endphp
									@foreach($query_link_comm AS $key_link_comm=>$value_link_comm)
										@php
											if($lingua=="ita" && isset($value_link_comm->testo) && $value_link_comm->testo!="") $testo = ucfirst($value_link_comm->testo); else $testo = ucfirst($value_link_comm->testo_eng); 
											if($value_link_comm->tipo_link=="link"){
												if($lingua=="ita" && isset($value_link_comm->link) && $value_link_comm->link!="") $link = ucfirst(str_replace("admin/","resarea/",$value_link_comm->link)); else $link = ucfirst(str_replace("admin/","resarea/",$value_link_comm->link_eng)); 
											}elseif($value_link_comm->tipo_link=="allegato"){
												if($lingua=="ita" && isset($value_link_comm->allegato) && $value_link_comm->allegato!="") $link = "resarea/files/".$value_link_comm->allegato; else $link = "resarea/files/".$value_link_comm->allegato_eng; 
											}	
										@endphp
										<span <?php if($link && $link!=""){?>style="cursor:pointer;" onclick="window.open('<?php echo $link;?>','_blank');"<?php }?>>
											<i style="font-family='Arial' !important"><?php echo $testo;?></i><?php if($link_comm!=$num_link_comm){?>&nbsp;|&nbsp;<?php }?>
										</span>
										@php $link_comm++;	@endphp									
									@endforeach									
								</div>							
								@php $x++; @endphp
							@endforeach
						</div>
						<div style="clear:both; width:100%; height:10px;"></div>
						<a style="cursor:pointer;" onclick="this.style.display='none'; $('.hiddenEvent').css({'display':'block'});">
							<div style="clear:both; width:120px; margin:0 auto; background:#8c8c8c; color:#fff; border-radius:4px; text-align:center; cursor:pointer; margin-bottom:15px;">
								<div style="padding:3px;"><?php if($lingua=="ita"){?>Tutti gli Eventi<?php }else{?>All Events<?php }?></div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				@php $titolo_blocco="News"; @endphp
				@include('web.common.titolo_blocco')
				<div class="row">
					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<div class="col-lg-12 col-md-12 col-xs-12" style="padding:0;">
							@php
								$query_news = DB::table('news');
								$query_news = $query_news->select('*');
								$query_news = $query_news->where('tipo', '=', 'news_young');
								$query_news = $query_news->where('YA', '=', '1');
								$query_news = $query_news->orderBy('ordine_YA', 'DESC');
								$query_news = $query_news->offset('0');
								$query_news = $query_news->limit('1');
								//dd($query_news->toSql(), $query_news->getBindings());	
								$query_news = $query_news->get();
									
								$x=1;	
							@endphp
							@foreach($query_news AS $key_news=>$value_news)
								@php
									if($lingua=="ita" && $value_news->titolo && $value_news->titolo!="") $titolo = ucfirst($value_news->titolo); else $titolo = ucfirst($value_news->titolo_eng); 
										
									$link_news="";
									if($lingua=="eng") $link_news="en/"; 
									$link_news.="young-azzurra/news-pag".$pag_att."/";
									
									if($lingua=="ita" && $value_news->titolo && $value_news->titolo!="") $link_news.=creaSlug($value_news->titolo,"");
										else $link_news.=creaSlug($value_news->titolo_eng,"");
									$link_news.="-".$value_news->id.".html";
									$dir_up = "resarea/img_up";						
									$img = $img_s = $img_m = $img_l = $img_xl = $img_xxl = "";
									
									if($value_news->img && $value_news->img!="" && file_exists(public_path()."/$dir_up/".$value_news->img)){
										$img="$dir_up/".$value_news->img;
										if(file_exists(public_path()."/$dir_up/s_".$value_news->img)) $img_s="$dir_up/s_".$value_news->img; else $img_s=$img;
										if(file_exists(public_path()."/$dir_up/m_".$value_news->img)) $img_m="$dir_up/m_".$value_news->img; else $img_m=$img;
										if(file_exists(public_path()."/$dir_up/l_".$value_news->img)) $img_l="$dir_up/l_".$value_news->img; else $img_l=$img;
										if(file_exists(public_path()."/$dir_up/xl_".$value_news->img)) $img_xl="$dir_up/xl_".$value_news->img; else $img_xl=$img;
										if(file_exists(public_path()."/$dir_up/xxl_".$value_news->img)) $img_xxl="$dir_up/xxl_".$value_news->img; else $img_xxl=$img;
									}elseif($value_news->img && $value_news->img!="" && file_exists(public_path()."/$dir_up/regate/press/".$value_news->img)){
										$img="$dir_up/regate/press/".$value_news->img;
										if(file_exists(public_path()."/$dir_up/regate/press/s_".$value_news->img)) $img_s="$dir_up/regate/press/s_".$value_news->img; else $img_s=$img;
										if(file_exists(public_path()."/$dir_up/regate/press/m_".$value_news->img)) $img_m="$dir_up/regate/press/m_".$value_news->img; else $img_m=$img;
										if(file_exists(public_path()."/$dir_up/regate/press/l_".$value_news->img)) $img_l="$dir_up/regate/press/l_".$value_news->img; else $img_l=$img;
										if(file_exists(public_path()."/$dir_up/regate/press/xl_".$value_news->img)) $img_xl="$dir_up/regate/press/xl_".$value_news->img; else $img_xl=$img;
										if(file_exists(public_path()."/$dir_up/regate/press/xxl_".$value_news->img)) $img_xxl="$dir_up/regate/press/xxl_".$value_news->img; else $img_xxl=$img;
									}else{
										$temp=explode('src="',$value_news->testo);
										if(count($temp)>1){
											$temp2=explode('"',$temp[1]);
											$img=$temp2[0];
											if($img==""){
												$temp=explode('src="',$value_news->testo_eng);
												$temp2=explode('"',$temp[1]);
												$img=$temp2[0];									
											}
										}
									}
								@endphp
								<div class="portfolio-item img-zoom">
									<div class="portfolio-item-wrap">
										@if($img!="")
											<div class="portfolio-image" style="margin-bottom:10px;" onclick="window.location='{{ $link_news }}'">
												<a href="{{ $link_news }}" title="{{ $titolo }} - NEWS - {{ config('app.name') }}">
													<picture>
													  <?php /*<source srcset="<?php echo $img_m;?>" media="(max-width: 350px)" />
													  <source srcset="<?php echo $img_l;?>" media="(max-width: 450px)" />
													  <source srcset="<?php echo $img_xl;?>" media="(max-width: 700px)" />
													  <source srcset="<?php echo $img_xxl;?>" media="(max-width: 991px)" />
													  <source srcset="<?php echo $img_m;?>" media="(max-width: 1020px)" />
													  <source srcset="<?php echo $img_l;?>" media="(max-width: 1320px)" />
													  <source srcset="<?php echo $img_xl;?>" media="(max-width: 1920px)" />*/?>
													  <img src="<?php echo $img;?>"  alt="{{ $titolo }} - NEWS - {{ config('app.name') }}"/>
													</picture>	
												</a>
											</div>
										@endif								
										
										<p class="medium" style="text-align:center;">
											&nbsp;<i class="fa fa-calendar" aria-hidden="true"></i> <?php  echo convertDateFormat($value_news->data_news,"Y-m-d","d/m"); ?>
										</p>
										<div style="width:100%; text-align:left; margin-bottom:3px">
											<a href="{{ $link_news }}" title="{{ $titolo }} - NEWS - {{ config('app.name') }}">
												<h4 class="title" style="text-transform: uppercase; font-size:18px; line-height:22px">
													<?php echo $titolo;?>
												</h4>
											</a>
										</div>
										
										<div class="post-info" style="width:100%; text-align:left; font-size:11px">
											<a class="read-more" title="{{ $titolo }} - NEWS - {{ config('app.name') }}" href="{{ $link_news }}"><?php if($lingua=="ita"){?>LEGGI<?php }else{?>READ MORE<?php }?><i class="fa fa-long-arrow-right"></i></a>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
					
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">					
						@php
							$query_news = DB::table('news');
							$query_news = $query_news->select('*');
							$query_news = $query_news->where('tipo', '=', 'news_young');
							$query_news = $query_news->where('YA', '=', '1');
							$query_news = $query_news->orderBy('ordine_YA', 'DESC');
							$query_news = $query_news->offset('1');
							$query_news = $query_news->limit('3');
							//dd($query_news->toSql(), $query_news->getBindings());	
							$query_news = $query_news->get();
							$num_news = $query_news->count();
						@endphp
						
						@if($num_news>0)
							@php $limit_news=1; @endphp
						@endif
						
						<div class="col-lg-12 col-md-12 col-xs-12">
							@foreach($query_news AS $key_news=>$value_news)
								@php
									if($lingua=="ita" && $value_news->titolo && $value_news->titolo!="") $titolo = ucfirst($value_news->titolo); else $titolo = ucfirst($value_news->titolo_eng); 
										
									$link_news="";
									if($lingua=="eng") $link_news="en/"; 
									$link_news.="young-azzurra/news-pag".$pag_att."/";
									
									if($lingua=="ita" && $value_news->titolo && $value_news->titolo!="") $link_news.=creaSlug($value_news->titolo,"");
										else $link_news.=creaSlug($value_news->titolo_eng,"");
									$link_news.="-".$value_news->id.".html";
									$dir_up = "resarea/img_up";						
									$img = $img_s = $img_m = $img_l = $img_xl = $img_xxl = "";
									
									if($value_news->img && $value_news->img!="" && file_exists(public_path()."/$dir_up/".$value_news->img)){
										$img="$dir_up/".$value_news->img;
										if(file_exists(public_path()."/$dir_up/s_".$value_news->img)) $img_s="$dir_up/s_".$value_news->img; else $img_s=$img;
										if(file_exists(public_path()."/$dir_up/m_".$value_news->img)) $img_m="$dir_up/m_".$value_news->img; else $img_m=$img;
										if(file_exists(public_path()."/$dir_up/l_".$value_news->img)) $img_l="$dir_up/l_".$value_news->img; else $img_l=$img;
										if(file_exists(public_path()."/$dir_up/xl_".$value_news->img)) $img_xl="$dir_up/xl_".$value_news->img; else $img_xl=$img;
										if(file_exists(public_path()."/$dir_up/xxl_".$value_news->img)) $img_xxl="$dir_up/xxl_".$value_news->img; else $img_xxl=$img;
									}elseif($value_news->img && $value_news->img!="" && file_exists(public_path()."/$dir_up/regate/press/".$value_news->img)){
										$img="$dir_up/regate/press/".$value_news->img;
										if(file_exists(public_path()."/$dir_up/regate/press/s_".$value_news->img)) $img_s="$dir_up/regate/press/s_".$value_news->img; else $img_s=$img;
										if(file_exists(public_path()."/$dir_up/regate/press/m_".$value_news->img)) $img_m="$dir_up/regate/press/m_".$value_news->img; else $img_m=$img;
										if(file_exists(public_path()."/$dir_up/regate/press/l_".$value_news->img)) $img_l="$dir_up/regate/press/l_".$value_news->img; else $img_l=$img;
										if(file_exists(public_path()."/$dir_up/regate/press/xl_".$value_news->img)) $img_xl="$dir_up/regate/press/xl_".$value_news->img; else $img_xl=$img;
										if(file_exists(public_path()."/$dir_up/regate/press/xxl_".$value_news->img)) $img_xxl="$dir_up/regate/press/xxl_".$value_news->img; else $img_xxl=$img;
									}else{
										$temp=explode('src="',$value_news->testo);
										if(count($temp)>1){
											$temp2=explode('"',$temp[1]);
											$img=$temp2[0];
											if($img==""){
												$temp=explode('src="',$value_news->testo_eng);
												$temp2=explode('"',$temp[1]);
												$img=$temp2[0];									
											}
										}
									}
								@endphp
								<div class="portfolio-item img-zoom">
									<div class="portfolio-item-wrap" style="">
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-4bis col-xs-4">
												@if($img!="")
													<div class="portfolio-image" style="margin-bottom:5px;" onclick="window.location='{{ $link_news }}'">
														<a href="{{ $link_news }}" title="{{ $titolo }} - NEWS - {{ config('app.name') }}">
															<picture>
															  <?php /*<source srcset="https://www.yccs.it/<?php if(str_replace("http://","",$img_m)==$img_m){?>{{ config('app.url') }}/<?php }?><?php echo $img_m;?>" media="(max-width: 350px)" />
															  <source srcset="https://www.yccs.it/<?php if(str_replace("http://","",$img_l)==$img_l){?>{{ config('app.url') }}/<?php }?><?php echo $img_l;?>" media="(max-width: 450px)" />
															  <source srcset="https://www.yccs.it/<?php if(str_replace("http://","",$img_xl)==$img_xl){?>{{ config('app.url') }}/<?php }?><?php echo $img_xl;?>" media="(max-width: 700px)" />
															  <source srcset="https://www.yccs.it/<?php if(str_replace("http://","",$img_xxl)==$img_xxl){?>{{ config('app.url') }}/<?php }?><?php echo $img_xxl;?>" media="(max-width: 991px)" />
															  <source srcset="https://www.yccs.it/<?php if(str_replace("http://","",$img_m)==$img_m){?>{{ config('app.url') }}/<?php }?><?php echo $img_m;?>" media="(max-width: 1020px)" />
															  <source srcset="https://www.yccs.it/<?php if(str_replace("http://","",$img_l)==$img_l){?>{{ config('app.url') }}/<?php }?><?php echo $img_l;?>" media="(max-width: 1320px)" />
															  <source srcset="https://www.yccs.it/<?php if(str_replace("http://","",$img_xl)==$img_xl){?>{{ config('app.url') }}/<?php }?><?php echo $img_xl;?>" media="(max-width: 1920px)" />*/?>
															  <img src="<?php echo $img;?>"  alt="{{ $titolo }} - NEWS - {{ config('app.name') }}"/>
															</picture>	
														</a>
													</div>
												@endif
											</div>
											<div class="col-lg-8 col-md-8 col-sm-8bis col-xs-8">
												<div style="text-align:left; font-size:11px">&nbsp;<i class="fa fa-calendar" aria-hidden="true"></i> <?php  echo convertDateFormat($value_news->data_news,"Y-m-d","d/m"); ?></div>
												<div style="width:100%; text-align:left;">
													<a class="read-more" title="{{ $titolo }} - NEWS - {{ config('app.name') }}" href="{{ $link_news }}">
														<h4 class="title" style="text-transform: uppercase; font-size:0.9em; line-height:15px;">
														<?php echo $titolo;?>
														</h4>
													</a>
												</div>
												
												<div class="post-info" style="width:100%; text-align:left; font-size:11px">
													<a class="read-more" title="{{ $titolo }} - NEWS - {{ config('app.name') }}" href="{{ $link_news }}"><?php if($lingua=="ita"){?>LEGGI<?php }else{?>READ MORE<?php }?><i class="fa fa-long-arrow-right"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							<div style="clear:both; height:10px"></div>
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/news.html">
								<div style="clear:both; width:120px; margin:0 auto; background:#8c8c8c; color:#fff; border-radius:4px; text-align:center; cursor:pointer; margin-bottom:15px;">
									<div style="padding:3px;" class="tutte_le_news"><?php if($lingua=="ita"){?>Tutte le News<?php }else{?>All News<?php }?></div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div style="width:100%; background:#00AEEF; border-bottom:solid 1px #DDDDDD; border-top:solid 1px #DDDDDD">
				<div style="padding:20px">
					<div style="width:400px; margin:0 auto; text-align:center">
						<h4 class="title" style="color:#fff"><?php if($lingua=="ita"){?>SEGUICI ANCHE SU<?php }else{?>FOLLOW US ON<?php }?></h4>
						<a class="btn btn-facebook" href="https://www.facebook.com/youngazzurra" target="_blank" style="color:#fff; background:#3B5998">
							<i class="fab fa-facebook m-r-5"></i> <b>Facebook</b>
						</a>
						<a class="btn btn-instagram" href="https://www.instagram.com/youngazzurra/" target="_blank" style="color:#fff; background: #f09433; 
							background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
							background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
							background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
							filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );">
							<i class="fab fa-instagram m-r-5"></i> <b>Instagram</b>
						</a>
					</div>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
</section>

<div class="row" style="padding-top:30px; background:#F7F7F7">		
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div style=" padding:20px 40px; margin:0; border:0;padding-bottom:20px; background:#F7F7F7">
			@php 
				$titolo_blocco=Lang::get('website.young-azzurra-atleti nome pagina'); 
				$color_titolo_2 = "#F7F7F7";
			@endphp
			@include('web.common.titolo_blocco')
			
			@php 
				$query_anno = DB::table('ya_team')
					->select('anno')
					->distinct()
					->orderby('anno','DESC')
					->limit('1')
					->get();
				$anno_atleti = $query_anno[0]->anno;
				
				$num_team = 4;
				$query_gal = DB::table('ya_team')
					->select('*')
					->where('anno','=',$anno_atleti)
					->orderBy('ordine', 'DESC')
					->limit($num_team)
					->get();
				$num_gal = $query_gal->count();
				
				$col1=0; $col2=12;
				if($num_gal==4){$col1=2; $col2=8; $col3=3;}
				if($num_gal==3){$col1=3; $col2=6; $col3=4;}
				if($num_gal==2){$col1=3; $col2=6; $col3=6;}
				if($num_gal==1){$col1=5; $col2=2; $col3=12;}
			@endphp
			
			<div class="row">
				@if($col1>0)
					<div class="col-lg-<?php echo $col1;?> col-md-<?php echo $col1;?> col-sm-<?php echo $col1;?>bis col-xs-<?php echo $col1;?>"></div>
				@endif
				<div class="col-lg-<?php echo $col2;?> col-md-<?php echo $col2;?> col-sm-<?php echo $col2;?>bis col-xs-<?php echo $col2;?>">
					<div class="row team-members">
						@foreach($query_gal AS $key_gal=>$value_gal)
							@php
								$nome = $value_gal->nome;
								$cognome = $value_gal->cognome;
								$foto = $value_gal->foto;
								$titolo = $value_gal->titolo;
								$anno = $value_gal->anno;
								if($lingua=="eng" && $value_gal->titolo_eng && trim($value_gal->titolo_eng)!="") $titolo = $value_gal->titolo_eng;
								$link_gal="young-azzurra/atleti-".$anno."/".creaSlug($value_gal->nome,"")."_".creaSlug($value_gal->cognome,"")."-".$value_gal->id.".html";							
							@endphp
							<div class="col-lg-{{ $col3 }}">
								<div class="team-member">
									<div class="team-image" style="position:relative; overflow: hidden; display: flex; justify-content: center; align-items: center;">
										<a href="<?php echo $link_gal;?>" title="<?php echo $nome;?> <?php echo $cognome;?>, <?php echo $titolo;?> - {!! Lang::get('website.young-azzurra-atleti nome pagina') !!} - Young Azzurra">
											<img src="{{ smartAsset($dir_up . '/ya_team/' . (file_exists(public_path() . '/resarea/img_up/ya_team/s_' . $foto) ? 's_' : '') . $foto) }}" 
												 alt="{{ $nome }} {{ $cognome }}, {{ $titolo }} - {!! Lang::get('website.young-azzurra-atleti nome pagina') !!} - Young Azzurra" 
												 style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" />
										</a>
										<img src="{{ smartAsset('/web/images/foto_atleti_blank.png') }}" style="width:100%" alt=""/>
									</div>
									<div class="team-desc">
										<span style="color:#222; font-weight:600"><?php echo $titolo;?></span>
										<a href="<?php echo $link_gal;?>" title="<?php echo $nome;?> <?php echo $cognome;?>, <?php echo $titolo;?> - {!! Lang::get('website.young-azzurra-atleti nome pagina') !!} - Young Azzurra">
											<h3 style="font-size:20px"><?php echo $nome;?> <?php echo $cognome;?></h3>
										</a>
										<a class="read-more" style="font-size:14px; color:#111; font-family:'Open Sans'; font-weight:700" title="<?php echo $nome;?> <?php echo $cognome;?>, <?php echo $titolo;?> - {!! Lang::get('website.young-azzurra-atleti nome pagina') !!} - Young Azzurra" href="<?php echo $link_gal;?>"><?php if($lingua=="ita"){?>VEDI PROFILO<?php }else{?>SEE PROFILE<?php }?></a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
				@if($col1>0)
					<div class="col-lg-<?php echo $col1;?> col-md-<?php echo $col1;?> col-sm-<?php echo $col1;?>bis col-xs-<?php echo $col1;?>"></div>
				@endif
				<div style="width:100%">
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/atleti.html">
						<div style="clear:both; width:120px; margin:0 auto; background:#8c8c8c; color:#fff; border-radius:4px; text-align:center; cursor:pointer; margin-bottom:15px;">
							<div style="padding:3px;"><?php if($lingua=="ita"){?>Vedi Tutti<?php }else{?>See All<?php }?></div>
						</div>
					</a>
				</div>
			</div>	
		</div>			
	</div>
</div>

@php
	$query_stato = DB::table('ya_elements')
		->select('risultati', 'risultati_home', 'videogallery')
		->where('id', '=', '1')
		->get();
		
	$stato = $query_stato[0]->risultati;
	$stato_home = $query_stato[0]->risultati_home;
	$stato_video = $query_stato[0]->videogallery;
	
	if($stato!=0 && $stato_home!=0) $ris=1; else $ris=0;
	
	$num_gal = 0;
		
	$query_cat = DB::table('ya_gallery_cat')
		->select('*')
		->where('num_foto','>','0')
		->orderBy('ordine', 'DESC')
		->limit('3')
		->get();
	$num_cat = $query_cat->count();	
	$num_tot = $num_cat; 
	
	
	if($num_tot<4){
		$limit_gal = (4-$num_tot);
		$query_gal = DB::table('ya_gallery')
			->select('*')				
			->where('num_foto','>','0')
			->where('id_rife','=','0')
			->orderBy('ordine', 'DESC')
			->limit($limit_gal)
			->get();
		$num_gal = $query_gal->count();	
		$num_tot = $num_tot+$num_gal; 
	}

	if($ris==1) $foto_riga=2; else $foto_riga=$num_tot;
	if($ris==1) {$col_foto = "6";$col_foto_span = "";}
	else{
		if($num_tot==4){$col_foto = "12";$col_foto_span = "";}
		elseif($num_tot==3){$col_foto = "8";$col_foto_span = "2";}
		elseif($num_tot==2){$col_foto = "6";$col_foto_span = "3";}
		elseif($num_tot==1){$col_foto = "4";$col_foto_span = "4";}
	}
@endphp

<section class="p-t-30 p-b-0">
	<div class="container-fluid">
		<div class="row">
			@if($col_foto_span != "")
				<div id="foto_span" class="col-lg-{{ $col_foto_span }} col-md-12 col-sm-12 col-xs-12"></div>
			@endif
			<div class="col-lg-{{ $col_foto }} col-md-12 col-sm-12 col-xs-12">		
				@php 
					$titolo_blocco="Photogallery"; 
					$color_titolo_2 = "#FFF";
				@endphp
				@include('web.common.titolo_blocco')			
				
				<div class="grid-layout post-{{ $foto_riga }}-columns m-b-10" data-item="post-item">
					@foreach($query_cat AS $key_cat=>$value_cat)
						@php
							$titolo_gal = $value_cat->nome;
							if($lingua=="eng" && $value_cat->nome_eng && trim($value_cat->nome_eng)!="") $titolo_gal = $value_cat->nome_eng;
							$link_gal="young-azzurra/photogallery-category/".creaSlug($value_cat->nome,"")."-".$value_cat->id.".html";
							
							$foto_gal="";
							if(isset($value_cat->img) && $value_cat->img!=""){
								$foto_gal=$value_cat->img;
							}else{
								$query_g = DB::table('ya_gallery')
									->select('id')
									->where('num_foto', '>', '0')
									->where('id_rife', '=', $value_cat->id)
									->orderBy('ordine', 'DESC')
									->limit('1')
									->get();
								$num_g = $query_g->count();
									
								if($num_g>0){
										$query_f = DB::table('ya_gallery_foto')
										->select('foto')
										->where('id_rife', '=', $query_g[0]->id)
										->orderBy('ordine', 'DESC')
										->limit('1')
										->get();
									$foto_gal=$query_f[0]->foto;
								}
							}
							
						@endphp
						@if ($foto_gal!="")
							@php
								if (file_exists(public_path()."/$dir_up/ya_gallery_foto/l_$foto_gal")) $foto_gal_l="l_$foto_gal"; else $foto_gal_l=$foto_gal;
								if (file_exists(public_path()."/$dir_up/ya_gallery_foto/450_$foto_gal")) $foto_gal_m="450_$foto_gal"; else $foto_gal_m=$foto_gal;
								if (file_exists(public_path()."/$dir_up/ya_gallery_foto/360_$foto_gal")) $foto_gal_s="360_$foto_gal"; else $foto_gal_s=$foto_gal;
								if (file_exists(public_path()."/$dir_up/ya_gallery_foto/250_$foto_gal")) $foto_gal_xs="250_$foto_gal"; else $foto_gal_xs=$foto_gal;
							@endphp
							<div class="post-item border">
								<div class="post-item-wrap">
									<a href="<?php if($lingua=="eng") echo "en/";?><?php  echo $link_gal; ?>" title="<?php  echo $titolo_gal; ?> - Photogallery - Young Azzurra"> 
										<div class="post-image" style="position:relative; overflow: hidden; display: flex; justify-content: center; align-items: center;"> 											
											<picture>
											  <?php /*<source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_xs;?>" media="(max-width: 640px)" />
											  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_s;?>" media="(max-width: 840px)" />
											  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_m;?>" media="(max-width: 991px)" />
											  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_s;?>" media="(max-width: 1199px)" />
											  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_xs;?>" media="(max-width: 1425px)" />
											  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_s;?>" media="(max-width: 1920px)" />*/?>
											  <img src="{{ smartAsset($dir_up.'/ya_gallery_foto/'.$foto_gal_l) }}"  alt="<?php  echo $titolo_gal; ?> - Photogallery - Young Azzurra" style="min-width: 100%; min-height: 100%; object-fit: cover; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"/>
											</picture>
																						
											<div style="position:absolute; width:100%; height:40px; background:rgba(0,0,0,0.7); bottom:0; left:0">
												<div style="padding:10px; padding-left:20px; color:#fff"><?php echo $titolo_gal;?></div>
											</div>
											<img src="{{ smartAsset('/web/images/gallery_blank.jpg') }}" style="width:100%" alt=""/>
										</div>							
									</a>
								</div>
							</div>
						@endif
					@endforeach	
					@if($num_cat<4)
						@foreach($query_gal AS $key_gal=>$value_gal)
							@php
								$titolo_gal = $value_gal->titolo;
								if($lingua=="eng" && $value_gal->titolo_eng && trim($value_gal->titolo_eng)!="") $titolo_gal = $value_gal->titolo_eng;
								$link_gal="young-azzurra/photogallery/".creaSlug($value_gal->titolo,"")."-".$value_gal->id.".html";
								
								$query_f = DB::table('ya_gallery_foto')
									->select('foto')
									->where('id_rife', '=', $value_gal->id)
									->orderBy('ordine', 'DESC')
									->limit('1')
									->get();
								$num_gal = $query_f->count();									
							@endphp
							@if ($num_gal>0)
								@php
									$foto_gal=$query_f[0]->foto;
									if (file_exists(public_path()."/$dir_up/ya_gallery_foto/l_$foto_gal")) $foto_gal_l="l_$foto_gal"; else $foto_gal_l=$foto_gal;
									if (file_exists(public_path()."/$dir_up/ya_gallery_foto/450_$foto_gal")) $foto_gal_m="450_$foto_gal"; else $foto_gal_m=$foto_gal;
									if (file_exists(public_path()."/$dir_up/ya_gallery_foto/360_$foto_gal")) $foto_gal_s="360_$foto_gal"; else $foto_gal_s=$foto_gal;
									if (file_exists(public_path()."/$dir_up/ya_gallery_foto/250_$foto_gal")) $foto_gal_xs="250_$foto_gal"; else $foto_gal_xs=$foto_gal;
								@endphp
								<div class="post-item border">
									<div class="post-item-wrap">
										<a href="<?php if($lingua=="eng") echo "en/";?><?php  echo $link_gal; ?>" title="<?php  echo $titolo_gal; ?> - Photogallery - Young Azzurra"> 
											<div class="post-image" style="position:relative;"> 
												<div style="position:absolute; width:100%; height:40px; background:rgba(0,0,0,0.7); bottom:0; left:0">
													<div style="padding:10px; padding-left:20px; color:#fff"><?php echo $titolo_gal;?></div>
												</div>
												<picture>
												  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_xs;?>" media="(max-width: 640px)" />
												  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_s;?>" media="(max-width: 840px)" />
												  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_m;?>" media="(max-width: 991px)" />
												  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_s;?>" media="(max-width: 1199px)" />
												  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_xs;?>" media="(max-width: 1425px)" />
												  <source srcset="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_s;?>" media="(max-width: 1920px)" />
												  <img src="https://www.yccs.it/<?php  echo $dir_up; ?>/ya_gallery_foto/<?php echo $foto_gal_l;?>"  alt="<?php  echo $titolo_gal; ?> - Photogallery - Young Azzurra"/>
												</picture>
											</div>							
										</a>
									</div>
								</div>
							@endif
						@endforeach	
					@endif					
				</div>
				
				<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/photogallery.html">
					<div style="clear:both; width:120px; margin:0 auto; background:#8c8c8c; color:#fff; border-radius:4px; text-align:center; cursor:pointer; margin-bottom:15px;">
						<div style="padding:3px;"><?php if($lingua=="ita"){?>Vedi Tutte<?php }else{?>See All<?php }?></div>
					</div>
				</a>
			</div>
			@if($ris==1)
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">		
					@php 
						if($lingua=="ita") $titolo_blocco="Risultati"; 
						else $titolo_blocco="Results"; 
					@endphp
					@include('web.common.titolo_blocco')			
					<div class="col-md-12">
						@php
							$query_com = DB::table('ya_risultati')
									->select('*')
									->where('visibile', '=', '1')
									->orderBy('data_dal', 'DESC')
									->limit('6')
									->get();
							$x=1;
						@endphp

						@foreach($query_com AS $key_com=>$value_com)
							<div class="list-group-item <?php if($x==1){?>active<?php }?> <?php if($x>5){?>hiddenEvent<?php }?>" <?php if($x!=1){?>onmouseover="this.className = this.className.replace(' active',''); this.className = this.className + ' active';" onmouseout="this.className = this.className.replace(' active','');"<?php }?>> 
								<i class="fa fa-caret-right"></i> 
								@php
									$anno = $value_com->anno;
									$nome_evento = $value_com->nome_evento;
									$risultato = $value_com->risultato;
									
									if($lingua=="ita"){
										$dal="dal ".$temp[2]."/".$temp[1];
										if($value_com->data_al && $value_com->data_al!="")
											$al="al ".substr($value_com->data_al,-2)."/".substr($value_com->data_al,5,-3);
										else $al="";
									}else{
										$dal="from ".$temp[2]."/".$temp[1];
										if($value_com->data_al && $value_com->data_al!="")
											$al="to ".substr($value_com->data_al,-2)."/".substr($value_com->data_al,5,-3);
										else $al="";
									}	
								@endphp
								@if($nome_evento && $nome_evento!="")
									<span ><b><?php echo $nome_evento;?></b></span><br/>
								@endif										
								<div style="font-size:0.9em; margin:2px 0"><?php echo $value_com->luogo;?> <?php echo $dal;?> <?php echo $al;?> <?php echo $anno;?></div>
														
								<div >
									<i><?php echo $risultato;?></i>
								</div>					
							</div>							
							@php $x++; @endphp
						@endforeach
					</div>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/risultati.html">
						<div style="clear:both; width:120px; margin:0 auto; margin-top:20px;background:#8c8c8c; color:#fff; border-radius:4px; text-align:center; cursor:pointer; margin-bottom:15px;">
							<div style="padding:3px;"><?php if($lingua=="ita"){?>Vedi Tutti<?php }else{?>See All<?php }?></div>
						</div>
					</a>
				</div>
			@endif
		</div>
	</div>
</section>

@if($stato_video==1)
	@php
		$query_gal = DB::table('ya_video')
				->select('*')
				->orderBy('ordine', 'DESC')
				->limit('4')
				->get();
		$num_v = $query_gal->count();
		$x=1;
	@endphp
	@if ($num_v>0)
		<div class="row" style="padding-top:30px; background:#F7F7F7">		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div style=" padding:20px 40px; margin:0; border:0;padding-bottom:20px; background:#F7F7F7">
					@php 
						$titolo_blocco="VIDEOGALLERY"; 
						$color_titolo_2 = "#F7F7F7";
					@endphp
					@include('web.common.titolo_blocco')
					<style>
						/* Griglia responsive 3 / 2 / 1 come pagina video */
						.ya-home-videos .video-card {
							margin-bottom: 30px;
						}
						@media (min-width: 1200px) {
							.ya-home-videos .video-card {
								flex: 0 0 25%;
								max-width: 25%;
							}
						}
						@media (min-width: 768px) and (max-width: 1199.98px) {
							.ya-home-videos .video-card {
								flex: 0 0 50%;
								max-width: 50%;
							}
						}
						@media (max-width: 767.98px) {
							.ya-home-videos .video-card {
								flex: 0 0 100%;
								max-width: 100%;
							}
						}

						/* Box anteprima 16:9 uniforme */
						.ya-home-videos .video-thumb-wrapper {
							width: 100%;
							position: relative;
							aspect-ratio: 16 / 9;
							overflow: hidden;
							border-radius: 4px;
							background: #000;
						}
						.ya-home-videos .video-thumb-wrapper img {
							width: 100%;
							height: 100%;
							object-fit: cover;
							display: block;
						}
						.ya-home-videos .video-thumb-wrapper .fb-video {
							width: 100% !important;
							height: 100% !important;
						}

						/* Loader */
						.ya-home-videos .video-loading-spinner {
							position: absolute;
							inset: 0;
							display: flex;
							align-items: center;
							justify-content: center;
							background: rgba(0,0,0,0.02);
							z-index: 5;
						}
						.ya-home-videos .video-loading-spinner::before {
							content: "";
							width: 28px;
							height: 28px;
							border-radius: 50%;
							border: 3px solid rgba(255,255,255,0.6);
							border-top-color: #00AEEF;
							animation: ya-home-spin 0.8s linear infinite;
						}
						@keyframes ya-home-spin {
							to { transform: rotate(360deg); }
						}
					</style>

					<div id="fb-root"></div>
					<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>

					<div class="row ya-home-videos">
						@foreach($query_gal as $value_gal)
							@php
								$titolo = $value_gal->titolo;
								if($lingua=="eng" && $value_gal->titolo_eng && trim($value_gal->titolo_eng)!="") $titolo = $value_gal->titolo_eng;											
								
								$link_gal = "young-azzurra/video_gallery";
								if($pag_att>1) $link_gal .= "-pag".$pag_att;
								$link_gal .= "/".creaSlug($value_gal->titolo,"")."-".$value_gal->id.".html";
							@endphp

							<div class="video-card col-sm-6 col-xs-12">
								<a href="<?php if($lingua=='eng') echo 'en/'; ?>{{ $link_gal }}" title="{{ $titolo }} - Video Gallery - Young Azzurra">
									<div class="video-thumb-wrapper">
										<div class="video-loading-spinner"></div>
										@if($value_gal->video_fb)
											<div style="position:absolute; width:100%; height:100%; z-index:100"></div>
											<div class="fb-video" data-href="https://www.facebook.com/facebook/videos/{{ $value_gal->video_fb }}/" data-show-text="false"></div>
										@else
											@php
												$video = $value_gal->video;								
												$arr_link = explode("?v=", $video);
												if (isset($arr_link[1]) && $arr_link[1]!="") $codice_video = substr($arr_link[1],0,11);
													else $codice_video = $video;
												$foto_gal = "http://i4.ytimg.com/vi/".$codice_video."/hqdefault.jpg";
											@endphp
											<img src="{{ $foto_gal }}" alt="{{ $titolo }} - Video Gallery - Young Azzurra">
										@endif
									</div>
									<div style="text-align:center; padding-top:10px; background:#F7F7F7;">
										<h3 style="font-size:20px; margin-bottom:5px;">{{ $titolo }}</h3>
										<span style="font-size:14px; color:#111; font-family:'Open Sans'; font-weight:700;">
											@if($lingua=='ita')
												Guarda il Video
											@else
												See Video
											@endif
										</span>
									</div>
								</a>
							</div>
						@endforeach
					</div>
					<script>
					document.addEventListener("DOMContentLoaded", function () {
						// Nasconde lo spinner quando la thumb YouTube è caricata
						document.querySelectorAll(".ya-home-videos .video-thumb-wrapper img").forEach(function (img) {
							var wrapper = img.closest(".video-thumb-wrapper");
							if (!wrapper) return;
							var spinner = wrapper.querySelector(".video-loading-spinner");
							if (!spinner) return;

							function hideSpinner() {
								spinner.style.display = "none";
							}

							if (img.complete) {
								hideSpinner();
							} else {
								img.addEventListener("load", hideSpinner);
								img.addEventListener("error", hideSpinner);
							}
						});

						// Facebook video: fallback con timeout
						document.querySelectorAll(".ya-home-videos .video-thumb-wrapper .fb-video").forEach(function (fb) {
							var wrapper = fb.closest(".video-thumb-wrapper");
							if (!wrapper) return;
							var spinner = wrapper.querySelector(".video-loading-spinner");
							if (!spinner) return;

							setTimeout(function () {
								spinner.style.display = "none";
							}, 2500);
						});
					});
					</script>
					<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/video_gallery.html">
						<div style="clear:both; width:120px; margin:0 auto; margin-bottom:20px;background:#8c8c8c; color:#fff; border-radius:4px; text-align:center; cursor:pointer; margin-bottom:15px;">
							<div style="padding:3px;"><?php if($lingua=="ita"){?>Vedi Tutti<?php }else{?>See All<?php }?></div>
						</div>
					</a>
				</div>			
			</div>
		</div>
	@endif
@endif