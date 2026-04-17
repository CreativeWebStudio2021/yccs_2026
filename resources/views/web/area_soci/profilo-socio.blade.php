@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.profilo socio');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.profilo socio'); $breadcrumbs[$x]['link']=''; 
			
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
		
		
		@php
			$query_dati = DB::table('clienti')
				->select('*')
				->where('id','=', $_SESSION["user_id_login"])
				->get();
				
			$nome = $query_dati[0]->nome;
			if(isset($_POST['nome'])) $nome=$_POST['nome'];
			
			$cognome = $query_dati[0]->cognome;
			if(isset($_POST['cognome'])) $cognome=$_POST['cognome'];
			
			$num_tessera = $query_dati[0]->num_tessera;
			if(isset($_POST['num_tessera'])) $num_tessera=$_POST['num_tessera'];
		@endphp
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-7">	
						<div style="width:100%; display:flex; gap:35px;">
							<h3 class="gradient-title">{{ Lang::get('website.profilo socio') }}</h3>
							<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
						</div>
						
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
						
						<form id="modifica" role="form" name="modifica" action="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/profilo-socio.html" method="post">
							<input type="hidden" name="stato_mod" value="1"/>
							<div class="row">
								<div class="col-md-6 form-group">
									<label ><?php if($lingua=="ita"){?>Nome<?php }else{?>First Name<?php }?> *</label>
									<input type="text" class="form-control input-lg" name="nome" value="{{ isset($nome) ? $nome : ''}}">
								</div>
								<div class="col-md-6 form-group">
									<label ><?php if($lingua=="ita"){?>Cognome<?php }else{?>Last Name<?php }?> *</label>
									<input type="text" class="form-control input-lg" name="cognome" value="{{ isset($cognome) ? $cognome : ''}}">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label><?php if($lingua=="ita"){?>Tessera Socio n.<?php }else{?>Tessera Socio n.<?php }?> *</label>
									<input type="text" class="form-control input-lg"  name="num_tessera" value="{{ isset($num_tessera) ? $num_tessera : ''}}">							
								</div>
							</div>
							
							<div class="col-md-12 form-group" style="font-size:0.9em">(* <?php if($lingua=="ita"){?>campi obbligatori<?php } else {?>required fields<?php }?>)<br /><br /></div>
											
							<div class="col-md-12 form-group">
								<button type="button" class="btn btn-primary" OnClick="check_form();"><?php if($lingua=="ita"){?>Modifica<?php }else{?>Update<?php }?> </button>
							</div>
						</form>
						<script type="text/javascript">
							Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
							
							function check_form(){
								if (document.modifica.nome.value=="") alert('<?php if($lingua=="eng"){?>"Name" required<?php } else {?>Campo "Nome" obbligatorio<?php }?>');			
								else if (document.modifica.cognome.value=="") alert('<?php if($lingua=="eng"){?>"Surname" required<?php } else {?>Campo "Cognome" obbligatorio<?php }?>');		
								else if (document.modifica.num_tessera.value=="") alert('<?php if($lingua=="eng"){?>"Tessera Socio n." required<?php } else {?>Campo "Tessera Socio n." obbligatorio<?php }?>');
								else document.modifica.submit();
							}
						</script>
					</div>		
					<div class="content col-lg-1"></div>			
					<!-- end: post content -->
					<!-- Sidebar-->
					<div class="sidebar sticky-sidebar sidebar-modern col-lg-3" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
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
@else	
	<script language="javascript">
		window.location = "<?php echo config('app.url');?>/<?php if($lingua=="eng"){?>en/<?php }?>area-soci/login.html";
	</script>
@endif