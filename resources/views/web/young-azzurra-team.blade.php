@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Young Azzurra'; $breadcrumbs[$x]['link']='young-azzurra.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
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
						if($id_dett==""){
							$query_team = DB::table('ya_team')
								->select('*')
								->where('anno','=','2021')
								->ORDERBY('ordine','DESC')
								->LIMIT(1)
								->get();
							$id_dett = $query_team[0]->id;
						}
						$query_team = DB::table('ya_team')
							->select('*')
							->where('anno','=','2021')
							->WHERE('id','<>',$id_dett)
							->ORDERBY('ordine','DESC')
							->get();
						$num_team = $query_team->count();
						
						$data_items="4";
						if($num_team<4) $data_items=$num_team;
					@endphp
					@if($num_team>0)
						<h4 class="mb-4"><?php if($lingua=="ita"){?>Membri Team<?php }else{?>Team Members<?php }?></h4>
						<div class="carousel team-members" data-dots="false" data-items="{{  $data_items }}">
							@foreach($query_team AS $key_team=>$value_team)
								@php
									$nome = $value_team->nome;
									$cognome = $value_team->cognome;
									$titolo = $value_team->titolo;
									$foto = $value_team->foto;
									if($lingua=="eng" && $value_team->titolo_eng && trim($value_team->titolo_eng)!="") $titolo = $value_team->titolo_eng;
								@endphp
								<a href="<?php if($lingua=="eng") echo "en/";?>young-azzurra/team/<?php echo to_htaccess_url($nome,"");?>_<?php echo to_htaccess_url($cognome,"");?>-<?php echo $value_team->id;?>.html" title="<?php echo $nome;?> <?php echo $cognome;?>, <?php echo $titolo;?> - Young Azzurra Team">
									<div class="team-member">
										<div class="team-image">
											<img src="resarea/img_up/ya_team/<?php if(is_file("resarea/img_up/ya_team/s_".$foto)) echo "s_";?><?php echo $foto;?>">
										</div>
										<div class="team-desc">
											<span style="color:#111">{!! $titolo !!}</span>
											<h3>{!! $nome !!} {!! $cognome !!}</h3>
										</div>
									</div>
								</a>
							@endforeach							
						</div>
					@endif
					
					<hr>
					@php
						$query_dett = DB::table('ya_team')
							->select('*')
							->WHERE('id','=',$id_dett)
							->ORDERBY('ordine','DESC')
							->get();
							
						$nome_dett = $query_dett[0]->nome;
						$cognome_dett = $query_dett[0]->cognome;
						$titolo_dett = $query_dett[0]->titolo;
						if($lingua=="eng" && $query_dett[0]->titolo_eng && trim($query_dett[0]->titolo_eng)!="") $titolo_dett = $query_dett[0]->titolo_eng;
						$foto_dett = $query_dett[0]->foto;
						$descrizione_dett = $query_dett[0]->descrizione;
						if($lingua=="eng" && $query_dett[0]->descrizione_eng && trim($query_dett[0]->descrizione_eng)!="") $descrizione_dett = $query_dett[0]->descrizione_eng;
						$facebook_dett = $query_dett[0]->facebook;
						$instagram_dett = $query_dett[0]->instagram;
					@endphp
					<div id="blog" class="single-post">
						<div class="post-item">
							<div class="post-item-wrap">
								<div class="post-item-description">
									<h4><?php echo $titolo_dett;?></h4>
									<h2><?php echo $nome_dett;?> <?php echo $cognome_dett;?></h2>
								</div>
								<div class="post-image" style="text-align:center;">
									<div class="row">
										<div class="col-lg-1"></div>	
										<div class="col-lg-9">
											<a href="#">
												<img style="width:100%" src="resarea/img_up/ya_team/<?php echo $foto_dett;?>">
											</a>
										</div>	
									</div>	
								</div>
								<div class="post-item-description">
									<div class="post-meta">
										<div class="post-meta-share">
											<?php if($facebook_dett && trim($facebook_dett)!=""){?>
												<a class="btn btn-xs btn-slide btn-facebook" href="<?php echo $facebook_dett;?>">
													<i class="fab fa-facebook-f"></i>
													<span>Facebook</span>
												</a>
											<?php }?>
											<?php if($instagram_dett && trim($instagram_dett)!=""){?>
												<a class="btn btn-xs btn-slide btn-instagram" href="<?php echo $instagram_dett;?>" data-width="118">
													<i class="fab fa-instagram"></i>
													<span>Instagram</span>
												</a>
											<?php }?>
										</div>
									</div>
									<p>
										<?php echo $descrizione_dett;?>
									</p>								
								</div>
							</div>
						</div>
					</div>
					<hr>
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