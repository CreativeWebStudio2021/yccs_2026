@extends('web.index')

@if($stato==1)
	@section('content')
		@php
			$video_background = "web/video/Regate-generiche-1920x500.mp4";
			$img_background = "web/images/testate/ufficio_stampa.jpg";
			$page_title = "Magazine";
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']="Magazine"; $breadcrumbs[$x]['link']=''; 
			if($anno_ric!="" && $nome_arg!=""){
				$x++; $breadcrumbs[$x]['titolo']=$anno_ric; $breadcrumbs[$x]['link']=''; 
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
						@php
							$query_anno = DB::table('magazine_articolo');
							$query_anno = $query_anno->select('anno');
							$query_anno = $query_anno->distinct();
							$query_anno = $query_anno->where('visibile','=','1');
							if($arg_ric!="") $query_anno = $query_anno->where('id_cat','=',$arg_ric);
							if($cat_ric!="") $query_anno = $query_anno->where('id_sottocat','=',$cat_ric);
							if($anno_ric!="") $query_anno = $query_anno->where('anno','=',$anno_ric);
							$query_anno = $query_anno->orderby('anno','DESC');
							$query_anno = $query_anno->orderby('ordine','DESC');
							$query_anno = $query_anno->get();
						@endphp
						
						<style>
							.imgHover{opacity:0;background:#fff;transition: 0.5s;}
							.imgHover:hover{opacity:0.3;}
						</style>
						
						@foreach($query_anno AS $key_anno=>$value_anno)
							@php 
								$titolo_blocco=$value_anno->anno; 
								$color_titolo_2 = "#FFF";
							@endphp
							@include('web.common.titolo_blocco')
							<div class="grid-layout post-3-columns m-b-10" data-item="post-item">
								@php
									$query_magazine = DB::table('magazine_articolo');
									$query_magazine = $query_magazine->select('*');
									$query_magazine = $query_magazine->where('visibile','=','1');
									if($arg_ric!="") $query_magazine = $query_magazine->where('id_cat','=',$arg_ric);
									if($cat_ric!="") $query_magazine = $query_magazine->where('id_sottocat','=',$cat_ric);
									$query_magazine = $query_magazine->where('anno','=',$value_anno->anno);
									$query_magazine = $query_magazine->orderby('ordine','DESC');
									$query_magazine = $query_magazine->get();
									
									$num_magazine = $query_magazine->count();
									
									$rec_pag=12;
									$pag_tot=ceil($num_magazine/$rec_pag);
									$start=($pag_att-1)*$rec_pag;
									
									$query_magazine = DB::table('magazine_articolo');
									$query_magazine = $query_magazine->select('*');
									$query_magazine = $query_magazine->where('visibile','=','1');
									if($arg_ric!="") $query_magazine = $query_magazine->where('id_cat','=',$arg_ric);
									if($cat_ric!="") $query_magazine = $query_magazine->where('id_sottocat','=',$cat_ric);
									$query_magazine = $query_magazine->where('anno','=',$value_anno->anno);
									$query_magazine = $query_magazine->orderby('ordine','DESC');
									$query_magazine = $query_magazine->offset($start);
									$query_magazine = $query_magazine->limit($rec_pag);
									$query_magazine = $query_magazine->get();
								@endphp
								
								@foreach($query_magazine AS $key_magazine=>$value_magazine)
									@php
										$nome_a = "";
										$nome_c = "";
										$link_magazine="";
										if($lingua=="eng") $link_magazine.="en/"; 
										$link_magazine.="magazine/";
										if($value_magazine->anno && $value_magazine->anno!="") $link_magazine.=$value_magazine->anno."/";
										
										if($value_magazine->id_cat){
											$query_a = DB::table('magazine_macrocategorie')
												->select('id', 'nome', 'nome_eng')
												->where('id', '=', $value_magazine->id_cat)
												->get();
											
											$nome_a = $query_a[0]->nome;
											if($lingua=="eng" && $query_a[0]->nome_eng && trim($query_a[0]->nome_eng)!="") $nome_a = $query_a[0]->nome_eng;
											$link_magazine.=creaSlug($nome_a,"")."/";
										}
										
										if($value_magazine->id_sottocat){
											$query_c = DB::table('magazine_macrocategorie')
												->select('id', 'nome', 'nome_eng')
												->where('id', '=', $value_magazine->id_sottocat)
												->get();
												
											$nome_c = $query_c[0]->nome;
											if($lingua=="eng" && $query_c[0]->nome_eng && trim($query_c[0]->nome_eng)!="") $nome_c = $query_c[0]->nome_eng;
											$link_magazine.=creaSlug($nome_c,"")."/";
										}
										
										$titolo = $value_magazine->titolo;
										if ($lingua=="eng" && $value_magazine->titolo_eng && $value_magazine->titolo_eng!="") $titolo = $value_magazine->titolo_eng;
										$link_magazine.=creaSlug($titolo,"");
										$link_magazine.="-".$value_magazine->id.".html";
									
										$img="";
										if($value_magazine->immagine && $value_magazine->immagine!=""){
											$img="$dir_up/magazine/".$value_magazine->immagine;
											if(is_file("$dir_up/magazine/s_".$value_magazine->immagine)) $img="$dir_up/magazine/s_".$value_magazine->immagine;
										}
									@endphp
									
									<div class="post-item border">
										<div class="post-item-wrap">
											<a href="<?php  echo $link_magazine; ?>" title="<?php  echo $titolo; ?> - Magazine"> 
												<div class="post-image" style="position:relative;"> 
													<div style="position:absolute; width:100%; background:rgba(0,0,0,0.7); bottom:0; left:0; z-index:10;">
														<div style="padding:8px; color:#fff; font-size:14px; line-height:14px">
															<?php echo $titolo;?>
															<br/>
															<span style="font-size:0.7em;color:#fff;"><?php if($nome_a!=""){?><?php echo $nome_a;?><?php }?><?php if($nome_c!=""){?> / <?php echo $nome_c;?><?php }?>&nbsp;</span>
														</div>
													</div>
													<div style="position:relative;">
														<img src="https://www.yccs.it/web/images/blank_4_3.png" style="width:100%;"/>
														<img alt="<?php echo $titolo;?> - MAGAZINE - {{ config('app.name') }}" src="https://www.yccs.it/<?php echo $img;?>" style="position:absolute; top:0; left:0; object-fit: cover; width:100%; height:100%;">
													</div>
													<div class="imgHover" style="position:absolute; width:100%; height:100%; top:0; left:0; z-index:5;"></div>
												</div>							
											</a>
										</div>
									</div>
								@endforeach
							</div>
						@endforeach
					</div>			
					<!-- end: post content -->
					<!-- Sidebar-->
					<div class="sidebar sticky-sidebar sidebar-modern col-lg-4" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
						<div class="row">
							<div class="content col-lg-7">
								@include('web.common.laterale_magazine')
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