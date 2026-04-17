<?php  use App\Http\Controllers\CustomController; ?>
@extends('web.index')
@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/centro_sportivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.carrello');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.carrello'); $breadcrumbs[$x]['link']=''; 
			
		@endphp
		@include('web.common.page_title')
		
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-8">				
						@include('web.common.lista_carrello')
					</div>	
					<div class="content col-lg-1"></div>				
					<!-- end: post content -->
					<!-- Sidebar-->
					<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
						<div class="row">
							<div class="content col-lg-9">
								@include('web.common.laterale-area-soci')
							</div>
							<div class="content col-lg-3"></div>
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