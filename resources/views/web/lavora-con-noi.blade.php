@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.lavora con noi');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-2"></div>
				<div class="content col-lg-6">
					@php
						$query_l = DB::table('lavora_con_noi')
							->select('*')
							->where('id','=','1')
							->get();							
					
						$img = $query_l[0]->img;
						if(isset($img) && trim($img)!="" && file_exists("resarea/img_up/".$img)){
							$cl1 = "8";
							$cl2 = "4";
						}else{
							$cl1 = "12";
							$cl2 = "12";
						}
						$testo = $query_l[0]->testo;
						if($lingua=="eng" && isset($query_l[0]->testo_eng) && trim($query_l[0]->testo_eng)!="") $testo = $query_l[0]->testo_eng;
					@endphp
					
					@if($img && file_exists("resarea/img_up/".$img))
						<div style="float:left; width:40%; margin:0 20px 10px 0">
							<img src="resarea/img_up/<?php if(file_exists("resarea/img_up/s_".$img)) echo "s_";?><?php echo $img;?>" style="width:100%" alt="{{Lang::get('websita.lavora con noi')}} - <?php echo config('app.name');?>"/>
						</div>
					@endif
					{!! $testo !!}
				</div>
				<!-- end: post content -->
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
	</section> <!-- end: Content -->
	
@endsection