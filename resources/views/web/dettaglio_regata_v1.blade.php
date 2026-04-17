@php 
	foreach($value_ed AS $key=>$value){
		$$key = $value;
	}
	foreach($value_reg AS $key=>$value){
		$risu_reg[$key] = $value;
	}
@endphp
@include('web.common.v1.functions')
@extends('web.index')

@section('content')
	@php
		$link_anno="regate-".$anno_regata.".html";
		if($lingua=="eng") $link_anno="en/regattas-".$anno_regata.".html";
		
		$img_background = "web/images/testate/regate.jpg";
		$page_title = $nome_regata;
		$x=0; 
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.regate title')." ".$anno_regata; $breadcrumbs[$x]['link']=$link_anno; 
		$x++; $breadcrumbs[$x]['titolo']=$value_ed->nome_regata; $breadcrumbs[$x]['link']=''; 
		
		$dir_up = "resarea/img_up";
		
		if($logo==1 && isset($logo_img) && file_exists(public_path()."/resarea/img_up/regate/".$logo_img)) $logo_plus = 1;
		else $logo_plus = 0;
	@endphp
	@include('web.common.page_title')	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<style>
					@media (max-width: 1024px)
						.testimonial.testimonial-left .testimonial-item > img {
							margin:0;
						}
				</style>
				<!-- post content -->
				<div class="content col-lg-2"></div>
				<div class="content col-lg-6">										
					<div style="float:left;width:80px;">
						<?php 
						$logo_regata="web/images/loghi/burgee_only_200.jpg";
						if ($logo_edizione!="" && file_exists(public_path()."/$dir_up/regate/".$logo_edizione)) $logo_regata="$dir_up/regate/".$logo_edizione;
						elseif ($risu_reg['logo']!="" && file_exists(public_path()."/$dir_up/regate/".$risu_reg['logo'])) $logo_regata="$dir_up/regate/".$risu_reg['logo'];
						?>
						<img src="https://www.yccs.it/<?php echo $logo_regata;?>" style="width:80px; height:auto; border: solid 1px #cbcbcb;" alt="{{ config('app.url') }} - Le Regate - <?php echo ucfirst($nome_regata);?>">							
					</div>
					<div style="float:left; width:calc(100% - {{$logo_plus==1 ? '250' : '100'}}px); text-align:left; text-align:left;">
						<div style="padding:0 20px">
							<div style="margin-top:15px;  font-size:18px; font-weight:700"><?php echo ucfirst(strip_tags($nome_regata));?></div>
							<span style="font-size:14px;">
								@if($lingua=="ita")
									<?php echo ucfirst($luogo);?>
									&nbsp;|&nbsp;
									<?php if($data_dal!=$data_al && $data_al!="0000-00-00"){?>
										dal <?php echo substr(date_to_data($data_dal,"/"),0,5);?> <?php if($data_al && $data_al!=""){?> al <?php echo substr(date_to_data($data_al,"/"),0,5);?><?php }?> 
									<?php }else{?>
										<?php echo date_to_data($data_dal,"/");?>
									<?php }?>								
								@else
									<?php echo ucfirst($luogo);?>
									&nbsp;|&nbsp;
									<?php if($data_dal!=$data_al && $data_al!="0000-00-00"){?>
										from <?php echo substr(date_to_data($data_dal,"/"),0,5);?> <?php if($data_al && $data_al!=""){?> to <?php echo substr(date_to_data($data_al,"/"),0,5);?><?php }?>
									<?php }else{?>
										<?php echo date_to_data($data_dal,"/");?>
									<?php }?>
								@endif
							</span>
						</div>
					</div>
					@if($logo_plus==1)
						<style>
							#logoPlus{width:150px}
							@media screen AND (max-width:550px){
								#logoPlus{width:100%; margin-top:20px;}
							}
						</style>
						<div style="float:left;" id="logoPlus">
							<img id="imgLogoPlus" src="resarea/img_up/regate/<?php echo $logo_img;?>" style="width:150px; border:solid 1px #cbcbcb" alt=""/>							
						</div>		
					@endif
					<div style="clear:both; height:20px;"></div>
					
					@php
						$query_anni = DB::table('edizioni_regate')
							->select('id', 'anno')
							->where('id_regata', '=', $risu_reg['id'])
							->orderby('anno', 'DESC')
							->get();
						$num_anni = $query_anni->count();						
					@endphp
					@if($num_anni>0)
						<div style="float:left; width:100px; height:30px; margin-top:5px;">
							<?php if($lingua=="ita"){?>Altre Edizioni<?php }else{?>Other Editions<?php }?>:
						</div>
						<div style="float:left; width:calc(100% - 100px);">
							@foreach($query_anni AS $key_anni=>$value_anni)
								@php
									$link_edizioni = "regate-".$value_anni->anno."/".to_htaccess_url($nome_regata,"")."-".$value_anni->id.".html";
									if($lingua=="eng") $link_edizioni = "en/".$link_edizioni;
								@endphp
								<div style="float:left;">
									<div style="padding:5px 3px">
										<a href="{{$link_edizioni}}" type="button" class="btn btn-light btn-sm"  <?php if($value_anni->anno==$anno){?>style="background:#e8e8e8"<?php }?>>{{$value_anni->anno}}</a>
									</div>
								</div>
							@endforeach
						</div>
						<div style="clear:both; height:20px;"></div>
					@endif
				
					<div style="margin-top:10px;">
						@php
							$descrizione_edizione = $descrizione;
							if($lingua=="eng" && isset($descrizione_eng) && $descrizione_eng!="") $descrizione_edizione = $descrizione_eng;
						@endphp
						{!! $descrizione_edizione !!}
					</div>
				
					@php				
						$query_foto = DB::table('edizioni_foto')
							->select('*')
							->where('id_edizione','=',$id)
							->where('id_regata','=',$risu_reg['id'])
							->orderby('ordine','DESC')
							->get();
						$num_foto = $query_foto->count();
						
						$query_video = DB::table('edizioni_video')
							->select('*')
							->where('id_edizione','=',$id)
							->where('id_regata','=',$risu_reg['id'])
							->orderby('ordine','DESC')
							->get();
						$num_video = $query_video->count();
						
						$query_info = DB::table('edizioni_info')
							->select('*')
							->where('id_edizione','=',$id)
							->where('id_regata','=',$risu_reg['id'])
							->orderby('ordine','DESC')
							->get();
						$num_info = $query_info->count();
						
						$query_documenti = DB::table('edizioni_doc')
							->select('*')
							->where('id_edizione','=',$id)
							->where('id_regata','=',$risu_reg['id'])
							->orderby('ordine','DESC')
							->get();
						$num_documenti = $query_documenti->count();
						
						$query_iscritti = DB::table('edizioni_iscritti')
							->select('*')
							->where('id_edizione','=',$id)
							->where('id_regata','=',$risu_reg['id'])
							->orderby('ordine','DESC')
							->get();
						$num_iscritti = $query_iscritti->count();
						
						$query_risultati = DB::table('edizioni_risultati')
							->select('*')
							->where('id_edizione','=',$id)
							->where('id_regata','=',$risu_reg['id'])
							->orderby('ordine','DESC')
							->get();
						$num_risultati = $query_risultati->count();
						
						$query_stampa = DB::table('press');
						$query_stampa = $query_stampa->select('*');
						if ($lingua=="eng") $query_stampa = $query_stampa->where('titolo_eng','<>', '');
						$query_stampa = $query_stampa->where('id_edizione','=',$id);
						$query_stampa = $query_stampa->where('id_regata','=',$risu_reg['id']);
						$query_stampa = $query_stampa->orderby('data','DESC');
						$query_stampa = $query_stampa->get();
						$num_stampa = $query_stampa->count();
				
						if(!isset($active) || $active==""){
							if($num_video>0) $active="video";
							if($num_foto>0) $active="foto";
							if($num_stampa>0) $active="stampa";
							if($num_risultati>0) $active="risultati";
							if($num_iscritti>0) $active="iscritti";
							if($num_documenti>0) $active="documenti";
							if($num_info>0) $active="info";
						}
						
						
						if(isset($_SESSION['tab_edizione_'.$id]) && $_SESSION['tab_edizione_'.$id]!="") $active = $_SESSION['tab_edizione_'.$id];
						
						$link_tab="regate-";
						if($lingua=="eng") $link_tab="en/regattas-";
						$link_tab.=$anno."/".$active."/".to_htaccess_url($nome_regata,"")."-".$id.".html";
						
					@endphp
				
					<style>
						#tabsMob{display:none;}
						#tabsDesk{display:block;}
						
						@media screen AND (max-width:1024px){
							#tabsMob{display:block;}
							#tabsDesk{display:none;}
						}
					</style>
					<div class="tabs tabs-vertical" style="margin-top:40px;" id="tabsMob">
						<div class="row">
							<div class="col-md-3">
								<ul class="nav flex-column nav-tabs" id="myTab4" role="tablist" aria-orientation="vertical">
									@php $tipo="_mob"; @endphp
									@include('web.dettaglio_regata_old.list_sez_regata')
								</ul>
							</div>
							<div class="col-md-9">
								<div class="tab-content" id="myTabContent4">
									@include('web.dettaglio_regata_old.list_sez_regata_body')
								</div>
							</div>
						</div>
					</div>
				
					<div class="tabs tabs-folder" style="margin-top:40px;" id="tabsDesk">
						<ul class="nav nav-tabs" id="myTab3" role="tablist">							
							@php $tipo=""; @endphp
							@include('web.dettaglio_regata_old.list_sez_regata')
						</ul>
						
						<a name="tabContainer"></a>
						<div class="tab-content" id="myTabContent3">
							@include('web.dettaglio_regata_old.list_sez_regata_body')
						</div>
					</div>
				
					<script type="text/javascript">
						function cambia_tab(tab,refresh){
							//document.getElementById('tab_regata').src='tab_regata.php?id_edizione=<?php echo $id;?>&tab='+tab;
						}
						cambia_tab('<?php echo $active;?>',0);
					</script>
					
					@php
						$query_loghi = DB::table('edizioni_loghi')
							->select('*')
							->where('id_edizione','=',$id)
							->orderby('ordine','DESC')
							->get();
						$num_loghi = $query_loghi->count();
					@endphp
					<style>
						.logo_reg_old{width:90%; margin:0 auto;}
						@media screen AND (max-width:767px){
							.logo_reg_old{width:300px;}
						}
					</style>
					@if($num_loghi==1)
						<div class="row">
							<div class="post-content post-modern col-md-4 solo_desk2"></div>
							<div class="post-content post-modern col-md-4" style="margin-bottom:20px; text-align:center">
								<?php $risu_loghi=$resu_loghi->fetch();?>
								<?php if($query_loghi[0]->link_eng && trim($query_loghi[0]->link_eng)!=""){?>
									<a target="_blank" href="<?php if($lingua=="ita" && $query_loghi[0]->link && trim($query_loghi[0]->link)!="") echo $query_loghi[0]->link; else echo $query_loghi[0]->link_eng?>">
								<?php }?>
									<img src="resarea/img_up/regate/loghi/<?php echo $query_loghi[0]->img;?>" alt="" style="width:90%">					
								<?php if($query_loghi[0]->link_eng && trim($query_loghi[0]->link_eng)!=""){?></a><?php }?>
							</div>
							<div class="post-content post-modern col-md-4 solo_desk2"></div>
							<div style="clear:both"></div>
						</div>
					@elseif($num_loghi==2)						
						@php $x=1; @endphp
						<div class="row">
							<div class="col-md-1"></div>
							@foreach($query_loghi AS $key_loghi=>$value_loghi)
								<div class="post-content post-modern col-md-4" style="margin-bottom:20px; padding:0; text-align:center">
									<?php if($value_loghi->link_eng && trim($value_loghi->link_eng)!=""){?>
										<a target="_blank" href="<?php if($lingua=="ita" && $value_loghi->link && trim($value_loghi->link)!="") echo $value_loghi->link; else echo $value_loghi->link_eng?>">
									<?php }?>
										<img src="resarea/img_up/regate/loghi/<?php echo $value_loghi->img;?>" alt="" class="logo_reg_old" style="">					
									<?php if($value_loghi->link_eng && trim($value_loghi->link_eng)!=""){?></a><?php }?>
								</div>
								<?php if($x==1){?><div class="post-content post-modern col-md-2 solo_desk2"></div><?php }?>
								@php $x++; @endphp
							@endforeach
							<div class="col-md-1"></div>
						</div>
						<div style="clear:both"></div>
					@else
						<div class="row">
							@foreach($query_loghi AS $key_loghi=>$value_loghi)
								<div class="post-content post-modern col-md-4" style="margin-bottom:20px; text-align:center">
									<?php if($value_loghi->link_eng && trim($value_loghi->link_eng)!=""){?>
										<a target="_blank" href="<?php if($lingua=="ita" && $value_loghi->link && trim($value_loghi->link)!="") echo $value_loghi->link; else echo $value_loghi->link_eng?>">
									<?php }?>
										<img src="resarea/img_up/regate/loghi/<?php echo $value_loghi->img;?>" class="logo_reg_old" alt="">					
									<?php if($value_loghi->link_eng && trim($value_loghi->link_eng)!=""){?></a><?php }?>
								</div>
							@endforeach
						</div>
						<div style="clear:both"></div>
					@endif
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