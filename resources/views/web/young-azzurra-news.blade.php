@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/storia.jpg";
		$video_background = "web/video/Young-Azzurra-1920x500.mp4";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Young Azzurra'; $breadcrumbs[$x]['link']='young-azzurra.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					<div class="row team-members">
						@php
							$query_news = DB::table('news');
							$query_news = $query_news->select('*');
							$query_news = $query_news->where('tipo','=','news_young');
							$query_news = $query_news->where('YA','=','1');
							if ($lingua=="eng") $query_news = $query_news->where('titolo_eng','<>','');
							$query_news = $query_news->get();
							$num_news = $query_news->count();
							
							$rec_pag=12;
							$pag_tot=ceil($num_news/$rec_pag);				
							$start=($pag_att-1)*$rec_pag;
							
							$query_news = DB::table('news');
							$query_news = $query_news->select('*');
							$query_news = $query_news->where('tipo','=','news_young');
							$query_news = $query_news->where('YA','=','1');
							if ($lingua=="eng") $query_news = $query_news->where('titolo_eng','<>','');
							$query_news = $query_news->orderby('data_news','DESC');
							$query_news = $query_news->limit($rec_pag);
							$query_news = $query_news->offset($start);
							$query_news = $query_news->get();
							
							$dir_up = "resarea/img_up";		
						@endphp
						
						@foreach($query_news AS $key_news=>$value_news)
							@php
								$titolo = $value_news->titolo;
								if($lingua=="eng" && $value_news->titolo_eng && trim($value_news->titolo_eng)!="") $titolo = $value_news->titolo_eng;
								$testo = $value_news->testo;
								if($lingua=="eng" && $value_news->testo_eng && trim($value_news->testo_eng)!="") $testo = $value_news->testo_eng;
								$testo = substr(trim(strip_tags(str_replace("admin/","resarea/",$testo))),0,100)."...";
								
								
								$link_news="";
								if($lingua=="eng") $link_news.="en/"; 
								$link_news.="young-azzurra/news-pag".$pag_att."/";
								if($lingua=="ita" && $value_news->titolo && $value_news->titolo!="") $link_news.=creaSlug($value_news->titolo,"");
									else $link_news.=creaSlug($value_news->titolo_eng,"");
								$link_news.="-".$value_news->id.".html";
								
								$img="";
								if($value_news->img && $value_news->img!=""){
									$img="$dir_up/".$value_news->img;
								}elseif($value_news->img && $value_news->img!="" && is_file("$dir_up/regate/press/".$value_news->img)){
									$img="$dir_up/regate/press/".$value_news->img;
								}else{
									$img=="";
									$temp=explode('src="',$value_news->testo);
									if(isset($temp[1])){
										$temp2=explode('"',$temp[1]);
										$img=$temp2[0];
									}
									if($img==""){
										$temp=explode('src="',$value_news->testo_eng);
										if(isset($temp[1])){
											$temp2=explode('"',$temp[1]);
											$img=$temp2[0];									
										}
									}
								}
							@endphp
							
							<div class="col-lg-4">
								<div class="team-member">
									<div class="team-image">
										<a href="<?php echo $link_news;?>" title="<?php echo $titolo;?> - News - Young Azzurra">
											<img alt="<?php echo $titolo;?> - News - {{ config('app.name') }}" style="width:100%" src="https://www.yccs.it/<?php echo $img;?>">
										</a>
									</div>
									<div class="team-desc" style="text-align:left;">
										<div style="margin-bottom:15px;">
											<?php  echo convertDateFormat($value_news->data_news,"Y-m-d","d/m"); ?>
										</div>
										<a href="<?php echo $link_news;?>" title="<?php echo $titolo;?> - News - Young Azzurra">
											<h3 style="font-size:20px; line-height:20px; text-transform: uppercase;">{!! $titolo !!}</h3>
										</a>
										@if(isset($testo) && $testo!="")
											<p style="line-height:18px">
											{!! $testo !!}
											</p>										
										@endif
										<a class="read-more" style="font-size:14px; color:#111; font-family:'Open Sans'; font-weight:700" title="<?php echo $titolo;?> - News - Young Azzurra" href="<?php echo $link_news;?>"><?php if($lingua=="ita"){?>LEGGI<?php }else{?>READ MORE<?php }?></a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					@if($pag_tot>1)
						@php
							$root_link="young-azzurra/news_pag";
							$num_elem=4; //dimensione multipagina: sempre num pari
						@endphp
						<style>
							activePag(background:red;)
						</style>
						<ul class="pagination pagination-lg justify-content-center">							
							<li class="page-item<?php if($pag_att==1){?> disabled<?php }?>">
								<a class="page-link" href="<?php echo $root_link;?>1.html" tabindex="-1"><i class="fa fa-angle-double-left"></i></a>
							</li>
							<li class="page-item<?php if($pag_att==1){?> disabled<?php }?>">
								<a class="page-link" href="<?php echo $root_link;?><?php echo $pag_att-1;?>.html"><i class="fa fa-angle-left"></i></a>
							</li>
							@if($pag_att>((ceil($num_elem/2))+1) && $pag_tot>$num_elem)
								<li class="page-item disabled"><a href="#">...</a></li>	
							@endif
							
							
							@if($pag_tot>$num_elem)
								@if($pag_att<=(($num_elem/2)+1))
									@for($i=1; $i<=$num_elem; $i++)
										<li class="page-item <?php if($pag_att==$i){?> active<?php }?>">
											<a class="page-link" <?php if($pag_att==$i){?>style="background:#00AEEF; color:#fff;"<?php }?> href="<?php echo $root_link;?><?php echo $i;?>.html"><?php echo $i;?></a>
										</li>
									@endfor										
								@elseif($pag_att>(($num_elem/2)+1) && $pag_att<($pag_tot-(($num_elem/2)-1)))
									@for($i=($pag_att-($num_elem/2)); $i<=($pag_att+(($num_elem/2)-1)); $i++)
										<li class="page-item <?php if($pag_att==$i){?> active<?php }?>">
											<a class="page-link" <?php if($pag_att==$i){?>style="background:#00AEEF; color:#fff;"<?php }?> href="<?php echo $root_link;?><?php echo $i;?>.html"><?php echo $i;?></a>
										</li>
									@endfor			
								@else
									@for($i=($pag_tot-($num_elem-1)); $i<=$pag_tot; $i++)
										<li class="page-item <?php if($pag_att==$i){?> active<?php }?>">	
											<a class="page-link" <?php if($pag_att==$i){?>style="background:#00AEEF; color:#fff;"<?php }?> href="<?php echo $root_link;?><?php echo $i;?>.html"><?php echo $i;?></a>
										</li>
									@endfor			
								@endif
							@else
								@for($i=1; $i<=$pag_tot; $i++)
									<li class="page-item <?php if($pag_att==$i){?> active<?php }?>">
										<a class="page-link" <?php if($pag_att==$i){?>style="background:#00AEEF; color:#fff;"<?php }?> href="<?php echo $root_link;?><?php echo $i;?>.html" <?php if($pag_att==$i){?>style="pointer-events: none; cursor: default;"<?php }?>><?php echo $i;?></a>
									</li>
								@endfor			
							@endif
							
							@if($pag_att<($pag_tot-(ceil($num_elem/2))+1) && $pag_tot>$num_elem)
								<li class="page-item disabled"><a href="#">...</a></li>	
							@endif
							<li class="page-item<?php if($pag_att==$pag_tot){?> disabled<?php }?>">
								<a class="page-link" href="<?php echo $root_link;?><?php echo $pag_att+1;?>.html"><i class="fa fa-angle-right"></i></a>
							</li>			
							<li class="page-item<?php if($pag_att==$pag_tot){?> disabled<?php }?>">
								<a class="page-link" href="<?php echo $root_link;?><?php echo $pag_tot;?>.html" ><i class="fa fa-angle-double-right"></i></a>
							</li>
						</ul>
					@endif
				</div>
				<div class="content col-lg-1"></div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-9">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-3"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection