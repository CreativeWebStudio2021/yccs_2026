@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/storia.jpg";
		$page_title = "ERROR 404";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']="Page not found"; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- 404 PAGE -->
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-2"></div>
				<div class="content col-lg-6">
					<div class="row">
						<div class="col-lg-6">
							<div class="page-error-404">404</div>
						</div>
						<div class="col-lg-6">
							<div class="text-left">
								<h1 class="text-medium">Ooops, This Page Could Not Be Found!</h1>
								<p class="lead">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
								<div class="seperator m-t-20 m-b-20"></div>
							</div>
						</div>
					</div>
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
	
	<script>
		function loc(){window.location='{{$lingua=="eng" ? "en" : ""}}/'}
		setTimeout(loc, 3000);
	</script>
@endsection