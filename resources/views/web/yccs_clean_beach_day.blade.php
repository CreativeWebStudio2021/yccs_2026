@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/loYCCSoggi.jpg";
		$video_background = "web/video/blue-sea.mp4";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.YCCS e Sostenibilita');; $breadcrumbs[$x]['link']=''; 
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
					@php
						$query_foto = DB::table('fotogallery_pagine');
						$query_foto = $query_foto->select('*');
						$query_foto = $query_foto->where('pagina','=','yccs_clean_beach_day');
						$query_foto = $query_foto->get();	
						$num_foto = $query_foto->count();	
					@endphp
					@if($num_foto>0)
						<!-- CAROUSEL -->
						<section class="no-padding">
							<div class="grid-articles carousel arrows-visibile" data-items="1" data-margin="0" data-dots="false" <?php if($num_foto==1){?>data-arrows="false"<?php }?>>
								@foreach($query_foto AS $key_foto=>$value_foto)
									@php
										$dir_up = "resarea/img_up";
										
										$img="$dir_up/pagine/".$value_foto->foto;
										if(is_file("$dir_up/pagine/xs_".$value_foto->foto)) $img_xs="$dir_up/pagine/xs_".$value_foto->foto; else $img_xs=$img;
										if(is_file("$dir_up/pagine/s_".$value_foto->foto)) $img_s="$dir_up/pagine/s_".$value_foto->foto; else $img_s=$img;
										if(is_file("$dir_up/pagine/m_".$value_foto->foto)) $img_m="$dir_up/pagine/m_".$value_foto->foto; else $img_m=$img;
										if(is_file("$dir_up/pagine/l_".$value_foto->foto)) $img_l="$dir_up/pagine/l_".$value_foto->foto; else $img_l=$img;
									@endphp
									<article class="post-entry">
										<a href="#" class="post-image">
											<picture>
											  <source srcset="<?php echo $img_m;?>" media="(max-width: 600px)" />
											  <source srcset="<?php echo $img_s;?>" media="(max-width: 440px)" />
											  <source srcset="<?php echo $img_xs;?>" media="(max-width: 340px)" />
											  <img src="<?php echo $img_l;?>"  alt="{!! $value_foto->testo !!} - {{ Lang::get('website.'.$pagina.' nome pagina') }} - {{ config('app.name') }}"/>
											</picture>
										</a>
										@if($value_foto->testo && $value_foto->testo!="")
											<div class="post-entry-overlay">
												<div class="post-entry-meta">
													<div class="post-entry-meta-title">
														<h2>{!! $value_foto->testo !!}</h2>
													</div>
												</div>
											</div>
										@endif
									</article>		
								@endforeach
							</div>
						</section>
						<!-- end: CAROUSEL -->
					@endif
					
					<style>
						ul{margin-left:30px}
					</style>
					<div style="margin-top:30px;">
						@php
							$query_testo = DB::table('testo_pagine')
								->select('*')
								->WHERE('pagina','=','yccs_clean_beach_day')
								->get();
							$num_testo = $query_testo->count();
						@endphp
						@if($num_testo>0)
							@php
								$testo = $query_testo[0]->testo;
								if($lingua=="eng" && isset($query_testo[0]->testo_eng) && $query_testo[0]->testo_eng!="")  $testo = $query_testo[0]->testo_eng;
							@endphp
						@endif
						{!! $testo !!}
					</div>
				</div>
				<div class="content col-lg-1"></div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-12">
							@include('web.common.laterale')
						</div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection