@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.comunicazioni ai soci');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.comunicazioni ai soci'); $breadcrumbs[$x]['link']=''; 
			
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
						<div style="width:100%; display:flex; gap:35px;">
							<h3 class="gradient-title">{{ Lang::get('website.comunicazioni ai soci') }}</h3>
							<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
						</div>
						@php
							$num_com = 0;
							$query_com = DB::table('comunicazioni_ai_soci')
								->select('*')
								->ORDERBY('ordine','desc')
								->get();
							$num_com = $query_com->count();
						@endphp
						@if ($num_com)
							<div class="list-group">
								@foreach($query_com AS $key_com=>$value_com)
									@php
										$tit_com = ucfirst($value_com->testo_link);
										if ($lingua=="eng" && $value_com->testo_link_eng!="") $tit_com = ucfirst($value_com->testo_link_eng);
										
										$file_com = $value_com->file;
										if ($lingua=="eng" && $value_com->file_eng!="") $file_com = $value_com->file_eng;
									@endphp
									@if ($file_com!="")
										@if($value_com->sfogliabile==0)
											<a target="_blank" href="download.php?file=<?php  echo $file_com; ?>" title="<?php  echo config('app.name'); ?> - {{ Lang::get('website.area soci') }} - <?php  echo $tit_com; ?>" style="color:#555" class="list-group-item list-group-item-com list-group-item-action">
												<i class="fa fa-file-pdf"></i> &nbsp; {!! $tit_com !!}
											</a>
										@else
											<a target="_blank" id="comunicazione_<?php echo $value_com->id;?>" style="cursor:pointer" title="<?php  echo config('app.name'); ?> - {{ Lang::get('website.area soci') }} - <?php  echo $tit_com; ?>" style="color:#555" class="list-group-item list-group-item-com list-group-item-action">
												<i class="fa fa-file-pdf"></i> &nbsp; {!! $tit_com !!}
											</a>
											<script type="text/javascript">
											$(document).ready(function () {
												$("#comunicazione_<?php echo $value_com->id;?>").flipBook({
													pdfUrl:"<?php echo config('app.url');?>/vedi_pdf.php?lingua=<?php echo $lingua;?>&file=<?php echo $file_com;?>",
													lightBox:true
												});

											})
										</script>
										@endif
									@endif
								@endforeach
							</div>
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