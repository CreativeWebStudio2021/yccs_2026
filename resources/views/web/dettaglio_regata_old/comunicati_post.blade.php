@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$query_ed = DB::table('edizioni_regate');
		$query_ed = $query_ed->select('*');
		$query_ed = $query_ed->where('id','=',$value_press->id_edizione);
		$query_ed = $query_ed->where('visibile','=','1');
		$query_ed = $query_ed->get();
		$num_ed = $query_ed->count();

		$nome_regata = $query_ed[0]->nome_regata;
		$luogo    =  $query_ed[0]->luogo;
		$anno_regata   =  $query_ed[0]->anno;
		$id_dett   =  $query_ed[0]->id;
		$titolo_regata=$nome_regata." - ".$luogo." ".$anno_regata;
		
		$link_regata="regate-";
		if($lingua=="eng") $link_regata="en/regattas-";
		$link_regata.=$anno_regata."/stampa/".to_htaccess_url('$titolo_regata')."-".$id_dett.".html";
		
		$link_anno="regate-".$anno_regata.".html";
		if($lingua=="eng") $link_anno="en/regattas-".$anno_regata.".html";
		
		$link_back="regate-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		if($lingua=="eng") $link_back="en/regattas-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		$link_com="regate-".$anno_regata."/press/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		if($lingua=="eng") $link_com="en/regattas-".$anno_regata."/press/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
				
		foreach($value_press AS $key_risu=>$value_risu){
			$risu_press[$key_risu]=$value_risu;
		}
		
		if($lingua=="ita") {
			if($risu_press['titolo'] && $risu_press['titolo']!="") $titolo = ucfirst($risu_press['titolo']); else $titolo = ucfirst($risu_press['titolo_eng']);
			if($risu_press['testo'] && $risu_press['testo']!="") $testo = trim($risu_press['testo']); else $testo = trim($risu_press['testo_eng']);
		} else {
			if($risu_press['titolo_eng'] && $risu_press['titolo_eng']!="") $titolo = ucfirst($risu_press['titolo_eng']); else $titolo = $risu_press['titolo']; 
			if($risu_press['testo_eng'] && $risu_press['testo_eng']!="") $testo = trim($risu_press['testo_eng']); else $testo = $risu_press['testo'];
		}
		
		$img_background = "web/images/testate/regate.jpg";
		$page_title = Lang::get('website.comunicati stampa');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.regate title')." ".$anno_regata; $breadcrumbs[$x]['link']=$link_anno; 
		$x++; $breadcrumbs[$x]['titolo']=$nome_regata; $breadcrumbs[$x]['link']=$link_regata; 
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=$titolo; $breadcrumbs[$x]['link']=''; 
		
		$dir_up = "resarea/img_up";
	@endphp
	@include('web.common.page_title')
	<!-- CONTENT -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">			
				<!-- Blog post-->
				<style>
					.txtButt{width:300px;}
					@media screen AND (max-width:991px){
						.txtButt{width:240px;}
					}
				</style>
				<div class="content col-lg-2"></div>
				<div class="content col-lg-6">						
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
							<div style="margin-top:20px;">
								<a href="<?php echo $link_regata;?>">
									<i class="fa fa-arrow-left fa-2x"></i><br/>
									<span class="post-comments-number">BACK</span>
								</a>
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="padding:0;">
							<div class="post-item">						
								<div class="post-content-details">
									<div class="post-title p-b-20" style="text-align:center;">
										<h2><span style="font-size:0.8em"><?php echo $titolo;?></span></h2>
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
									   <?php echo str_replace('src="/images','src="'.config('app.url').'/web/images',$testo);?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-4" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-7">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-5"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section>
@endsection