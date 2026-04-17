@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$query_ed = DB::table('edizioni_regate');
		$query_ed = $query_ed->select('*');
		$query_ed = $query_ed->where('id','=',$id_dett);
		$query_ed = $query_ed->where('visibile','=','1');
		$query_ed = $query_ed->where('new','=','1');
		$query_ed = $query_ed->get();
		$num_ed = $query_ed->count();

		$nome_regata = $query_ed[0]->nome_regata;
		$luogo    =  $query_ed[0]->luogo;
		$anno_regata   =  $query_ed[0]->anno;
		$titolo_regata=$nome_regata." - ".$luogo." ".$anno_regata;

		$link_back="regate-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		if($lingua=="eng") $link_back="en/regattas-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		$link_com="regate-".$anno_regata."/press/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		if($lingua=="eng") $link_com="en/regattas-".$anno_regata."/press/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";

		
		$query_press = DB::table('press');
		$query_press = $query_press->select('*');
		$query_press = $query_press->where('id','=',$id_press);
		$query_press = $query_press->get();
		
		foreach($query_press[0] AS $key_risu=>$value_risu){
			$risu_press[$key_risu]=$value_risu;
		}
		
		if($lingua=="ita") {
			if(isset($risu_press['titolo']) && $risu_press['titolo']!="") $titolo = ucfirst($risu_press['titolo']); else $titolo = ucfirst($risu_press['titolo_eng']);
			if(isset($risu_press['testo']) && $risu_press['testo']!="") $testo = trim($risu_press['testo']); else $testo = trim($risu_press['testo_eng']);
		} else {
			if(isset($risu_press['titolo_eng']) && $risu_press['titolo_eng']!="") $titolo = ucfirst($risu_press['titolo_eng']); else $titolo = $risu_press['titolo']; 
			if(isset($risu_press['testo_eng']) && $risu_press['testo_eng']!="") $testo = trim($risu_press['testo_eng']); else $testo = $risu_press['testo'];
		}
	@endphp
	<!-- CONTENT -->
	<section class="content" style="margin-top:30px; padding-bottom:0;">
		<div class="container">
			<div class="row">			
				<!-- Blog post-->
				<style>
					.txtButt{width:300px;}
					@media screen AND (max-width:991px){
						.txtButt{width:240px;}
					}
				</style>
				<div class="post-content post-modern col-md-9">		
					<div class="row">			
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:0;">
							<a href="<?php echo $link_com;?>"><div class="txtButt" style=" margin:0 auto; padding:10px 0; border:solid 1px #<?php echo $colore_testo;?>; color:#<?php echo $colore_testo;?>; text-align:center; margin-top:-25px; margin-bottom:30px"><b><?php if($lingua=="ita"){?>TORNA AI COMUNICATI STAMPA<?php }else{?>BACK TO PRESS RELEASE<?php }?></b></div></a>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:0;">
							<a href="<?php echo $link_back;?>"><div class="txtButt" style=" margin:0 auto; padding:10px 0; border:solid 1px #<?php echo $colore_testo;?>; color:#<?php echo $colore_testo;?>; text-align:center; margin-top:-25px; margin-bottom:30px"><b><?php if($lingua=="ita"){?>TORNA ALLA HOME REGATA<?php }else{?>BACK TO REGATTA<?php }?></b></div></a>
						</div>
					</div>
					<div class="row">			
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="padding:0; text-align:center;">
							@php
							$temp=explode("-",$risu_press['data']);
							if($lingua=="ita"){
								$mega_mesi1['01'] = "Gennaio";
								$mega_mesi1['02'] = "Febbraio" ;
								$mega_mesi1['03'] = "Marzo" ;
								$mega_mesi1['04'] = "Aprile" ;
								$mega_mesi1['05'] = "Maggio" ;
								$mega_mesi1['06'] = "Giugno" ;
								$mega_mesi1['07'] = "Luglio" ;
								$mega_mesi1['08'] = "Agosto" ;
								$mega_mesi1['09'] = "Settembre" ;
								$mega_mesi1['10'] = "Ottobre" ;
								$mega_mesi1['11'] = "Novembre" ;
								$mega_mesi1['12'] = "Dicembre" ;
							}else{
								$mega_mesi1['01'] = "January";
								$mega_mesi1['02'] = "February" ;
								$mega_mesi1['03'] = "March" ;
								$mega_mesi1['04'] = "April" ;
								$mega_mesi1['05'] = "May" ;
								$mega_mesi1['06'] = "June" ;
								$mega_mesi1['07'] = "July" ;
								$mega_mesi1['08'] = "August" ;
								$mega_mesi1['09'] = "September" ;
								$mega_mesi1['10'] = "October" ;
								$mega_mesi1['11'] = "November" ;
								$mega_mesi1['12'] = "December" ;
							}
						@endphp
						<span class="post-date-day" style="font-size:42px; font-family:'Open Sans'; font-weight:900; color:#111"><?php echo $temp[2];?></span><br/>
						<span class="post-date-month" style="font-size:13px; font-family:'Open Sans'; color:#111"><?php echo $mega_mesi1[$temp[1]];?></span><br/>
					   <span class="post-date-day" style="font-size:14px; font-family:'Open Sans'; font-weight:900; color:#111"><?php echo $temp[0];?></span>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="padding:0;">
							<div class="post-item">						
								<div class="post-content-details">
									<div class="post-title p-b-20" style="text-align:center;">
										<h2><span style="font-size:0.8em">{!! $titolo!!}</span></h2>
									</div>
									@if(($risu_press['foto1'] && $risu_press['foto1']!="") || ($risu_press['foto2'] && $risu_press['foto2']!=""))
										<div style="width:100%; padding-bottom:20px;">
											<?php if($risu_press['foto1']!="" && $risu_press['foto2']!=""){?>
												<div class="col-md-12">		
													<div class="post-slider">
														<div class="carousel" data-items="1" data-dots="false"> 
															<img alt="image" src="resarea/img_up/regate/press/<?php echo $risu_press['foto1'];?>"> 
															<img alt="image" src="resarea/img_up/regate/press/<?php echo $risu_press['foto2'];?>"> 
														</div>
													</div>
												</div>
											<?php }else{?>
												<div class="col-md-12">		
													<img src="resarea/img_up/regate/press/<?php if($risu_press['foto1'] && $risu_press['foto1']!="") echo $risu_press['foto1'];?><?php if($risu_press['foto2'] && $risu_press['foto2']!="") echo $risu_press['foto2'];?>" alt="" style="width:100%;"/>
												</div>
												<div style="clear:both; height:20px;"></div>
											<?php }?>
										</div>
									@endif
									<div class="post-description">
										@php 
											$testo = str_replace('src="/images','src="'.config('app.url').'/web/images',$testo);
											$testo_gal = $testo; 
										@endphp
										@if(isset($testo_gal) && $testo_gal!="")
											@include('web.common.testo_gal')								
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="sidebar sidebar-modern col-md-3">
					<style>
						.heading-text.heading-section h2:before{
							background-color:#111; height:4px; bottom:-20px;
						}
					</style>
					<div class="widget clearfix widget-blog-articles">
						<div class="heading-text heading-section">
							<h2 style="font-size:18px; font-family:'Open Sans'; line-height:10px; font-weight:600">
								<?php if($lingua=="ita"){?>Comunicati Stampa<?php }else{?>Press Release<?php }?>
							</h2>
						</div>
						@php
							$query_news = DB::table('press');
							$query_news = $query_news->select('*');
							$query_news = $query_news->where('id_edizione','=',$id_dett);
							$query_news = $query_news->where('foto1','<>',NULL);
							$query_news = $query_news->where('id','<>',$id_press);
							$query_news = $query_news->orderby('data','DESC');
							$query_news = $query_news->limit('5');
							$query_news = $query_news->get();
						@endphp
						@foreach($query_news AS $key_news=>$value_news)
							@foreach($value_news AS $key_risu=>$value_risu)
								@php	
									$risu_news[$key_risu]=$value_risu;
								@endphp
							@endforeach
							@php
								if($risu_news['titolo_eng'] && $risu_news['titolo_eng']!="") $titolo = ucfirst($risu_news['titolo_eng']); 
								elseif($risu_news['titolo'] && $risu_news['titolo']!="") $titolo = ucfirst($risu_news['titolo']);
								if($lingua=="ita") {
									if($risu_news['titolo'] && $risu_news['titolo']!="") $titolo = ucfirst($risu_news['titolo']);
									elseif($risu_news['titolo_eng'] && $risu_news['titolo_eng']!="") $titolo = ucfirst($risu_news['titolo_eng']);
								}
								
								$link_news="";
								if($lingua=="eng") $link_news.="en/"; 
								$link_news.="news-pag1/";
								
								if($lingua=="ita" && $risu_news['titolo'] && $risu_news['titolo']!="") $link_news.=to_htaccess_url($risu_news['titolo'],"");
									else $link_news.=to_htaccess_url($risu_news['titolo_eng'],"");
								$link_news.="-".$risu_news['id'].".html";
								
								
								$img="";
								if($risu_news['foto1'] && $risu_news['foto1']!="" && file_exists(public_path()."/resarea/img_up/regate/press/".$risu_news['foto1'])){
									$img="resarea/img_up/regate/press/".$risu_news['foto1'];
									if(file_exists(public_path()."/resarea/img_up/regate/press/s_".$risu_news['foto1'])) $img_s="resarea/img_up/regate/press/s_".$risu_news['foto1']; else $img_s=$img;
									if(file_exists(public_path()."/resarea/img_up/regate/press/m_".$risu_news['foto1'])) $img_m="resarea/img_up/regate/press/m_".$risu_news['foto1']; else $img_m=$img;
									if(file_exists(public_path()."/resarea/img_up/regate/press/l_".$risu_news['foto1'])) $img_l="resarea/img_up/regate/press/l_".$risu_news['foto1']; else $img_l=$img;
									if(file_exists(public_path()."/resarea/img_up/regate/press/xl_".$risu_news['foto1'])) $img_xl="resarea/img_up/regate/press/xl_".$risu_news['foto1']; else $img_xl=$img;
									if(file_exists(public_path()."/resarea/img_up/regate/press/xxl_".$risu_news['foto1'])) $img_xxl="resarea/img_up/regate/press/xxl_".$risu_news['foto1']; else $img_xxl=$img;
								}
								
								$link_p='regate-'.$anno_regata.'/press/'.to_htaccess_url($nome_regata,"").'-'.$id_dett.'/'.to_htaccess_url($titolo,"").'-'.$risu_news['id'].'.html';
								if($lingua=="eng") $link_p='en/regattas-'.$anno_regata.'/press/'.to_htaccess_url($nome_regata,"").'-'.$id_dett.'/'.to_htaccess_url($titolo,"").'-'.$risu_news['id'].'.html';
							@endphp
							<div class="post-item border">
								<div class="post-item-wrap">
									@if($risu_news['foto1'] && trim($risu_news['foto1'])!="" && file_exists(public_path()."/resarea/img_up/regate/press/".$risu_news['foto1']) )
										<div class="post-image">
											<a  href="<?php echo $link_p;?>" title="<?php echo $titolo;?> - <?php echo Lang::get('website.comunicati stampa');?> - <?php echo config('app.name');?>">
												<picture>
												  <source srcset="<?php if(str_replace("http://","",$img_s)==$img_s){?><?php echo config('app.url');?>/<?php }?><?php echo $img_s;?>" media="(max-width: 450px)" />
												  <source srcset="<?php if(str_replace("http://","",$img_l)==$img_m){?><?php echo config('app.url');?>/<?php }?><?php echo $img_m;?>" media="(max-width: 700px)" />
												  <source srcset="<?php if(str_replace("http://","",$img_l)==$img_l){?><?php echo config('app.url');?>/<?php }?><?php echo $img_l;?>" media="(max-width: 991px)" />
												  <source srcset="<?php if(str_replace("http://","",$img_s)==$img_s){?><?php echo config('app.url');?>/<?php }?><?php echo $img_s;?>" media="(max-width: 1500px)" />
												  <img src="<?php if(str_replace("http://","",$img_m)==$img_m){?><?php echo config('app.url');?>/<?php }?><?php echo $img_m;?>"  alt="<?php echo $titolo;?> - <?php echo Lang::get('website.comunicati stampa');?> - <?php echo config('app.name');?>"/>
												</picture>	
											</a>
										</div>
									@endif
									<div class="post-item-description">
										<span class="post-meta-date" style="color:#111"><i class="icon-calendar"></i><?php  echo date_to_data($risu_news['data'],"/"); ?></span>
										<h2><a href="<?php echo $link_p;?>"><?php echo $titolo;?></a></h2>
										<a href="<?php echo $link_p;?>" class="item-link"><b><?php if($lingua=="ita"){?>leggi<?php }else{?>read more<?php }?></b> <i class="icon-chevron-right"></i></a>
									</div>
								</div>
							</div>
						@endforeach					
					</div>					
				</div>
			</div>
		</div>
	</section>
@endsection