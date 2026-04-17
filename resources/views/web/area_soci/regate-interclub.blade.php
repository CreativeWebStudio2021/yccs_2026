@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/consiglio_direttivo.jpg";
		    $video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.regate interclub');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.regate interclub'); $breadcrumbs[$x]['link']=''; 
			
		@endphp
		@include('web.common.page_title')
		
		<style>
			.list-group-item.list-group-item-com {
				background:#fff;
				color:#555555;
			}
			.list-group-item.list-group-item-com:hover{
				background:#F5F5F5;
				color:#555555;
			}
		</style>
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-7">
						@if(1)
							<div class="alert alert-warning" style="font-size:1.3em; text-align:center;">
								{{ $lingua=="ita" ? "Pagina non disponibile al momento." : "Page not available at the moment." }}
							</div>
						@else
							@php
								$query_text = DB::table('regate_esterne_testo')
									->select('*')
									->where('id','=','1')
									->get();
								$testo =  $query_text[0]->testo;
								if($lingua=="eng" && trim($query_text[0]->testo_eng!="")) $testo = $query_text[0]->testo_eng;
							@endphp
							{!! $testo !!}
							
							@php
								$num_com = 0;
								$query_com = DB::table('regate_esterne')
									->select('*')
									->where('visibile','=','1')
									->orderby('ordine','DESC')
									->get();
								$num_com = $query_com->count();
							@endphp
							@if ($num_com)
								<div class="list-group" style="padding:20px;">
									@foreach($query_com AS $key_com=>$value_com)
										@php
											$tit_com = ucfirst($value_com->testo);
											if ($lingua=="eng" && $value_com->testo_eng!="") $tit_com = ucfirst($value_com->testo_eng);
											$link_com = $value_com->link;
											if ($lingua=="eng" && trim($value_com->link_eng!="")) $link_com = $value_com->link_eng;
											$luogo_com = $value_com->luogo;
											if ($lingua=="eng" && $value_com->luogo_eng!="") $luogo_com = $value_com->luogo_eng;
											$data_com = $value_com->data;
											if($lingua=="eng" && trim($value_com->data_eng!="")) $data_com = $value_com->data_eng;
										@endphp
										
										<a target="_blank" href="<?php  echo $link_com; ?>" title="<?php  echo config('app.name'); ?> - {{ Lang::get('website.area soci') }} - <?php  echo $tit_com; ?>" style="color:#555" class="list-group-item list-group-item-com list-group-item-action">
											<b>{!! $tit_com !!}</b>, <?php  echo $luogo_com;?>, <span style="font-size:0.9em; font-family:'Open Sans'; font-style: italic;"><?php  echo $data_com;?>
										</a>
									@endforeach
								</div>
							@endif
						@endif
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