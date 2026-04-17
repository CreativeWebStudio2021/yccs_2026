@extends('web.index')

@section('content')
	@php
		
		if(isset($anno_risultati) && $anno_risultati!="") $anno_atleti = $anno_risultati;
		else { 
			$query_anno = DB::table('ya_team')
				->distinct('anno')
				->orderby('anno','DESC')
				->limit('1')
				->get();
			$anno_atleti = $query_anno[0]->anno;
		}
		
		$img_background = "web/images/testate/storia.jpg";
		$video_background = "web/video/Young-Azzurra-1920x500.mp4";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Young Azzurra'; $breadcrumbs[$x]['link']='young-azzurra.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
		if(isset($anno_atleti) && $anno_atleti!="")
			$x++; $breadcrumbs[$x]['titolo']=$anno_atleti; $breadcrumbs[$x]['link']=''; 
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
						$query_anni = DB::table('ya_team')
							->select('anno')
							->distinct()
							->orderby('anno', 'DESC')
							->get();
						$num_anni = $query_anni->count();						
					@endphp
					@if($num_anni>0)
						<div style="float:left; width:50px; height:30px; margin-top:5px;">
							<?php if($lingua=="ita"){?>Anno<?php }else{?>Year<?php }?>:
						</div>
						<div style="float:left; width:calc(100% - 50px);">
							@foreach($query_anni AS $key_anni=>$value_anni)
								@php
									$link_anno = "young-azzurra/atleti-".$value_anni->anno.".html";
									if($lingua=="eng") $link_anno = "en/".$link_anno;
								@endphp
								<div style="float:left;">
									<div style="padding:5px 3px">
										<a href="{{$link_anno}}" type="button" class="btn <?php if($value_anni->anno==$anno_atleti){?>btn-info<?php }else{?> btn-light<?php }?> btn-sm" >{{$value_anni->anno}}</a>
									</div>
								</div>
							@endforeach
						</div>
						<div style="clear:both; height:20px;"></div>
					@endif
					
					@php
						if($id_dett==""){
							$query_team = DB::table('ya_team')
								->select('*')
								->where('anno','=',$anno_atleti)
								->ORDERBY('ordine','DESC')
								->LIMIT(1)
								->get();
							$id_dett = $query_team[0]->id;
						}
						$query_team = DB::table('ya_team')
							->select('*')							
							->where('anno','=',$anno_atleti)
							//->WHERE('id','<>',$id_dett)
							->ORDERBY('ordine','DESC')
							->get();
						$num_team = $query_team->count();
						
						$data_items="4";
						//if($num_team<4) $data_items=$num_team;
					@endphp
					@if($num_team>0)
						<h4 class="mb-4">{!! Lang::get('website.young-azzurra-atleti nome pagina') !!}</h4>
						<div class="carousel team-members" <?php if($data_items<5){?>data-dots="false" data-arrows="false" data-autoplay="false"<?php }?> data-items="{{  $data_items }}" data-items-xs="2">
							@foreach($query_team AS $key_team=>$value_team)
								@php
									$nome = $value_team->nome;
									$cognome = $value_team->cognome;
									$titolo = $value_team->titolo;
									$foto = $value_team->foto;
									$anno = $value_team->anno;
									if($lingua=="eng" && $value_team->titolo_eng && trim($value_team->titolo_eng)!="") $titolo = $value_team->titolo_eng;
								@endphp
								<a href="<?php if($lingua=="eng") echo "en/";?>young-azzurra/atleti-<?php echo $anno;?>/<?php echo creaSlug($nome,"");?>_<?php echo creaSlug($cognome,"");?>-<?php echo $value_team->id;?>.html" title="<?php echo $nome;?> <?php echo $cognome;?>, <?php echo $titolo;?> - {!! Lang::get('website.young-azzurra-atleti nome pagina') !!}">
									<div class="team-member" <?php if($id_dett==$value_team->id){?>style="background:#E5E5E5"<?php }?>>
										<div class="team-image">
											<div style="padding:10px 10px 0 10px">
												<div style="position:relative; overflow: hidden; display: flex; justify-content: center; align-items: center;">
													<img src="https://www.yccs.it/resarea/img_up/ya_team/<?php if(is_file("resarea/img_up/ya_team/s_".$foto)) echo "s_";?><?php echo $foto;?>"  style="width: 100%; min-height: 100%; object-fit: cover; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
													<img src="https://www.yccs.it/web/images/foto_atleti_blank.png" style="width:100%" alt=""/>
												</div>
											</div>
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
											<img style="width:100%" src="https://www.yccs.it/resarea/img_up/ya_team/<?php echo $foto_dett;?>" alt="<?php echo $titolo_dett;?> <?php echo $nome_dett;?> <?php echo $cognome_dett;?> - {!! Lang::get('website.young-azzurra-atleti nome pagina') !!}">
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
				<div class="content col-lg-1"></div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-9">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-3"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
@endsection