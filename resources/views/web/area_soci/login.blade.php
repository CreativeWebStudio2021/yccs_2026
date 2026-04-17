@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = Lang::get('website.accedi');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.accedi'); $breadcrumbs[$x]['link']=''; 
		
	@endphp
	@include('web.common.page_title')
	
	<style>
		.form-group label:not(.error) {font-weight: 600; color:#111111}
		.form-gray-fields .form-control {
			background-color: #f2f2f2;
			border-color: #e9e9e9;
			color: #333;
		}
	</style>
					
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-3"></div>
				<div class="content col-lg-4">
					<div class="panel-body">
						@if( count($errors) > 0)
							@foreach($errors->all() as $error)
								<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="background:{{ $message_color }}">
									<div style="float:left; width:90%;">
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
										<span class="sr-only">{{ trans('labels.Error') }}:</span>
										{!! $error !!}
									</div>
									<div style="float:right; width:10%; text-align:right; cursor:pointer;" onclick="$('#errorMessage').fadeOut();"><b>x</b></div>
									<div style="clear:both"></div>
								</div>
							@endforeach
						@endif
						
						@if(isset($message_color) && $message_color == "green")
							<script>
								function loc(){
									window.location='<?php if($lingua=="eng") echo "en/";?>area-soci/benvenuto.html';
								}
								window.setTimeout('loc()' , 3000);
							</script>
						@endif
						
						<div style="width:100%; display:flex; gap:35px;">
							<h3 class="gradient-title"><?php if($lingua=="ita"){?>ACCEDI<?php }else{?>LOGIN<?php }?></h3>
							<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
						</div>
						
						<p>
							<?php if($lingua=="ita"){?>
								Benvenuto nella nuova Area Soci YCCS. Per il primo accesso, sarà necessario reimpostare la password, facendo click su 'Recupera Password'.
							<?php }else{?>
								Welcome to the new YCCS Members' Area. For your first log in, you should change your password, please click 'Password Recovery'.
							<?php }?>
						</P>
						
						<form action="{{ url()->full() }}" class="form-gray-fields" method="post" name="invia_login" autocomplete="off">						
							@csrf
							<input type="hidden" name="stato" value="inviato"/>
							<div class="form-group">
								<label class="sr-only">Email</label>
								<input 
									type="text" 
									name="user_login" 
									id="username" 
									class="form-control" 
									required="required" 
									placeholder="Email" 
									value="{{ Cookie::get('mio_user_yccs') !== null ? Cookie::get('mio_user_yccs') : '' }}"
								>

							</div>
							<div class="form-group m-b-5" style="margin-bottom:10px">
								<label class="sr-only">Password</label>
								<input type="password" placeholder="Password" value="{{ Cookie::get('mio_user_yccs')!==null ? 'xxxxxxxx' : '' }}" class="form-control" name="pass_login"  required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')">
								
							</div>
							
								
							<div style="float:left"style="height:20px; background:lime">
								<label>
									<input type="checkbox" name="memorizza" id="memorizza">&nbsp; <small><?php if($lingua=="ita"){?>Ricordami<?php }else{?>Remember me<?php }?></small>
								</label>
							</div>
							<div style="float:right">
								<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/recupera-password.html"><small><?php if($lingua=="ita"){?>Recupera Password<?php }else{?>Password Recovery<?php }?></small></a>
							</div>
							<div style="clear:both; height:20px"></div>
							
							<div class="form-group">
								<button class="btn btn-primary">Login</button>								
							</div>
						</form>
						
						<?php if($lingua=="ita"){?>
							<p>Non hai ancora un account? <a href="area-soci/registrazione.html">Registra un nuovo Account</a></p>
						<?php }else{?>
							<p>Don't have an account yet? <a href="en/area-soci/registrazione.html">Register New Account</a></p>
						<?php }?>
						
					</div>
				</div>
				<div class="content col-lg-3"></div>				
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-12">
							@include('web.common.laterale-area-soci')
						</div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection