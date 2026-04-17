<?php  use App\Http\Controllers\CustomController; ?>
@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/centro_sportivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = "Paypal Response";
		$x=0;
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
					@if( count($errors) > 0)
						@foreach($errors->all() as $error)
							<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="background:{{ $message_color }}">
								<div style="float:left; width:100%;text-align:center;">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">{{ trans('labels.Error') }}:</span>
									{!! $error !!}
								</div>
								<div style="clear:both"></div>
							</div>
						@endforeach
					@endif
				</div>

				<div class="content col-lg-1"></div>					
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-9">
							@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
								@include('web.common.laterale-area-soci')
							@else
								@include('web.common.laterale')
							@endif
						</div>
						<div class="content col-lg-3"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection