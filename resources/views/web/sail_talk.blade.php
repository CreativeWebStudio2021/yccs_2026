@extends('web.index')

@if($stato==1)
	@section('content')
		@php
			$video_background = "web/video/Regate-generiche-1920x500.mp4";
			$img_background = "web/images/testate/ufficio_stampa.jpg";
			$page_title = "Sail Talk";
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']="Sail Talk"; $breadcrumbs[$x]['link']=''; 
			if(isset($nome_arg) && $nome_arg!=""){
				$x++; $breadcrumbs[$x]['titolo']=$nome_arg; $breadcrumbs[$x]['link']=''; 				
			}
			
			$dir_up = "resarea/img_up";				
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
					<div class="content col-lg-2"></div>
					<div class="content col-lg-6">
						<style>
							.imgHover{opacity:0;background:#fff;transition: 0.5s;}
							.imgHover:hover{opacity:0.3;}
						</style>
						
						
						<div class="grid-layout post-3-columns m-b-10" data-item="post-item">
							@php
								$query_sail_talk = DB::table('sail_talk_articolo');
								$query_sail_talk = $query_sail_talk->select('*');
								$query_sail_talk = $query_sail_talk->where('visibile','=','1');
								if($arg_ric!="") $query_sail_talk = $query_sail_talk->where('id_cat','=',$arg_ric);
								if($cat_ric!="") $query_sail_talk = $query_sail_talk->where('id_sottocat','=',$cat_ric);
								$query_sail_talk = $query_sail_talk->orderby('ordine','DESC');
								$query_sail_talk = $query_sail_talk->get();
								
								$num_sail_talk = $query_sail_talk->count();
								
								$rec_pag=12;
								$pag_tot=ceil($num_sail_talk/$rec_pag);
								$start=($pag_att-1)*$rec_pag;
								
								$query_sail_talk = DB::table('sail_talk_articolo');
								$query_sail_talk = $query_sail_talk->select('*');
								$query_sail_talk = $query_sail_talk->where('visibile','=','1');
								if($arg_ric!="") $query_sail_talk = $query_sail_talk->where('id_cat','=',$arg_ric);
								if($cat_ric!="") $query_sail_talk = $query_sail_talk->where('id_sottocat','=',$cat_ric);
								$query_sail_talk = $query_sail_talk->orderby('ordine','DESC');
								$query_sail_talk = $query_sail_talk->offset($start);
								$query_sail_talk = $query_sail_talk->limit($rec_pag);
								$query_sail_talk = $query_sail_talk->get();
							@endphp
							
							@foreach($query_sail_talk AS $key_sail_talk=>$value_sail_talk)
								@php
									$nome_a = "";
									$nome_c = "";
									$link_sail_talk="";
									if($lingua=="eng") $link_sail_talk.="en/"; 
									$link_sail_talk.="sail_talk/";
									
									if($value_sail_talk->id_cat){
										$query_a = DB::table('sail_talk_macrocategorie')
											->select('id', 'nome', 'nome_eng')
											->where('id', '=', $value_sail_talk->id_cat)
											->get();
										
										$nome_a = $query_a[0]->nome;
										if($lingua=="eng" && $query_a[0]->nome_eng && trim($query_a[0]->nome_eng)!="") $nome_a = $query_a[0]->nome_eng;
										$link_sail_talk.=creaSlug($nome_a,"")."/";
									}
									
									if($value_sail_talk->id_sottocat){
										$query_c = DB::table('sail_talk_categorie')
											->select('id', 'nome', 'nome_eng')
											->where('id', '=', $value_sail_talk->id_sottocat)
											->get();
											
										$nome_c = $query_c[0]->nome;
										if($lingua=="eng" && $query_c[0]->nome_eng && trim($query_c[0]->nome_eng)!="") $nome_c = $query_c[0]->nome_eng;
										$link_sail_talk.=creaSlug($nome_c,"")."/";
									}
									
									$titolo = $value_sail_talk->titolo;
									if ($lingua=="eng" && $value_sail_talk->titolo_eng && $value_sail_talk->titolo_eng!="") $titolo = $value_sail_talk->titolo_eng;
									$link_sail_talk.=creaSlug($titolo,"");
									$link_sail_talk.="-".$value_sail_talk->id.".html";
								
									$img="";
									if($value_sail_talk->immagine && $value_sail_talk->immagine!=""){
										$img="$dir_up/sail_talk/".$value_sail_talk->immagine;
										if(is_file("$dir_up/sail_talk/s_".$value_sail_talk->immagine)) $img="$dir_up/sail_talk/s_".$value_sail_talk->immagine;
									}
								@endphp
								
								<div class="post-item border">
									<div class="post-item-wrap">
										<a href="<?php  echo $link_sail_talk; ?>" title="<?php  echo $titolo; ?> - Sail Talk"> 
											<div class="post-image" style="position:relative;"> 
												<div style="position:absolute; width:100%; background:rgba(0,0,0,0.7); bottom:0; left:0; z-index:10;">
													<div style="padding:8px; color:#fff; font-size:14px; line-height:14px">
														<?php echo $titolo;?>
														<br/>
														<span style="font-size:0.7em;color:#fff;"><?php if($nome_a!=""){?><?php echo $nome_a;?><?php }?><?php if($nome_c!=""){?> / <?php echo $nome_c;?><?php }?>&nbsp;</span>
													</div>
												</div>
												<div style="position:relative;">
													<img src="https://www.yccs.it/web/images/blank_16_9.png" style="width:100%;"/>
													<img alt="<?php echo $titolo;?> - Sail Talk - {{ config('app.name') }}" src="https://www.yccs.it/<?php echo $img;?>" style="position:absolute; top:0; left:0; object-fit: cover; width:100%; height:100%;">
												</div>
												<div class="imgHover" style="position:absolute; width:100%; height:100%; top:0; left:0; z-index:5;"></div>
											</div>							
										</a>
									</div>
								</div>
							@endforeach
						</div>						
					</div>			
					<!-- end: post content -->
					<!-- Sidebar-->
					<div class="sidebar sticky-sidebar sidebar-modern col-lg-4" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
						<div class="row">
							<div class="content col-lg-7">
								@include('web.common.laterale_sail_talk')
							</div>
							<div class="content col-lg-5"></div>
						</div>
					</div>
					<!-- end: Sidebar-->
				</div>
			</div>
		</section> <!-- end: Content -->
		
	@endsection	
@else
	<script>
		window.location="<?php if($lingua=='eng') echo 'en/';?>home.html";
	</script>
@endif	