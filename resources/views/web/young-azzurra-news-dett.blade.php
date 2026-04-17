@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/storia.jpg";
		$video_background = "web/video/Young-Azzurra-1920x500.mp4";
		$page_title = "Young Azzurra News";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Young Azzurra'; $breadcrumbs[$x]['link']='young-azzurra.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']='News'; $breadcrumbs[$x]['link']='young-azzurra/news.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']=$query_dett[0]->titolo; $breadcrumbs[$x]['link']=''; 
		$dir_up = "resarea/img_up";		
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">
					<div class="row">
						<div class="col-lg-2">
							@php
								$temp=explode("-",$query_dett[0]->data_news);
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
							<div class="row">
								<div class="col-lg-12 col-md-6 col-sm-6 col-6 " style="margin-bottom:20px">
									<div style="font-family:'Open Sans'; font-size:42px; color:#111; text-align:center; font-weight:900"><?php echo $temp[2];?></div>
									<div style="color:#111; text-align:center; margin-top:12px;"><?php echo $mega_mesi1[$temp[1]];?></div>
									<div style="font-family:'Open Sans'; font-size:14px; color:#111; text-align:center; font-weight:900" style="font-size:1em"><?php echo $temp[0];?></div>
								</div>
								<div class="col-lg-12 col-md-6 col-sm-6 col-6" style="margin-bottom:20px">
									<div style="width:100%; text-align:center;">
										<a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/news<?php if($pag_att && $pag_att>1){?>_pag<?php echo $pag_att;?><?php }?>.html" title="Young Azzurra - Photogallery">
											<i class="fa fa-arrow-left fa-2x"></i><br/>BACK
										</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-10">							
							@php
								$img="";
								if($query_dett[0]->img && $query_dett[0]->img!=""){
									$img="$dir_up/".$query_dett[0]->img;
								}elseif($query_dett[0]->img && $query_dett[0]->img!="" && is_file("$dir_up/regate/press/".$query_dett[0]->img)){
									$img="$dir_up/regate/press/".$query_dett[0]->img;
								}else{
									$img=="";
									$temp=explode('src="',$query_dett[0]->testo);
									if(isset($temp[1])){
										$temp2=explode('"',$temp[1]);
										$img=$temp2[0];
									}
									if($img==""){
										$temp=explode('src="',$query_dett[0]->testo_eng);
										if(isset($temp[1])){
											$temp2=explode('"',$temp[1]);
											$img=$temp2[0];									
										}
									}
								}					
							@endphp
							@if($img!="")
								<img alt="{!! $page_title !!} - NEWS - YOUNG AZZURRA - {{ config('app.name') }}" src="https://www.yccs.it/<?php echo $img;?>" style="width:100%; margin-bottom:20px">
							@endif
							
							<h2>
							@php
								$titolo = $query_dett[0]->titolo;
								if($lingua=="eng" && $query_dett[0]->titolo_eng && trim($query_dett[0]->titolo_eng)!="") $titolo = $query_dett[0]->titolo_eng;
							
								 echo $titolo;
							@endphp
							</h2>					
							@php
								$testo_gal = $query_dett[0]->testo;
								if($lingua=="eng" && $query_dett[0]->testo_eng && trim($query_dett[0]->testo_eng)!="") $testo_gal = $query_dett[0]->testo_eng;
							@endphp
							@if(isset($testo_gal) && $testo_gal!="")
								@include('web.common.testo_gal')
							@endif

							@php
								
								$ind_fb=url()->full();
								function get_tiny_url($url)  {  
									$ch = curl_init();  
									$timeout = 5;  
									curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
									curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
									curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
									$data = curl_exec($ch);  
									curl_close($ch);  
									return $data;  
								}
								$new_url = get_tiny_url($ind_fb);
								
							@endphp
							
							<div style="">
								@include('web.common.share_buttons')								
							</div>
						</div>
						
					</div>
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