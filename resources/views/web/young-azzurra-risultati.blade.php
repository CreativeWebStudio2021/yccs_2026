@extends('web.index')

@section('content')
	@php
		if(!isset($anno_risultati) || $anno_risultati == "") $anno_risultati = date('Y');
	
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Young Azzurra'; $breadcrumbs[$x]['link']='young-azzurra.html'; if($lingua=="eng") $breadcrumbs[$x]['link']='en/'.$breadcrumbs[$x]['link'];
		$x++; $breadcrumbs[$x]['titolo']=$page_title." ".$anno_risultati; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
		
	@php
		$query_stato = DB::table('ya_elements')
				->select('risultati')
				->WHERE('id','=','1')
				->get();
				
		$stato = $query_stato[0]->risultati;
	@endphp
	
	@if($stato==1)		
		<style>
			.soloDeskReg{display:block !important}
			.soloMobReg{display:none !important}
			.txtDxReg{text-align:left}
			@media screen AND (max-width:1100px){
				.imgDeskReg{text-align:left}
			}
			@media screen AND (max-width:991px){
				.soloDeskReg{display:none !important}
				.soloMobReg{display:block !important}
				.txtDxReg{text-align:right}
			}
		</style>
		@php
			if($lingua=="ita"){
				$mega_mesi1['01'] = "Gennaio";
				$mega_mesi1['02'] = "Febbraio" ;
				$mega_mesi1['03'] = "Marzo" ;
				$mega_mesi1['04'] = "Aprile" ;
				$mega_mesi1['05'] = "Maggio" ;
				$mega_mesi1['06'] = "Giugno" ;
				$mega_mesi1['07'] = "Luglio" ;
				$mega_mesi1['08'] = "Agosto" ;
				$mega_mesi1['09'] = "Settembre" ;
				$mega_mesi1['10'] = "Ottobre" ;
				$mega_mesi1['11'] = "Novembre" ;
				$mega_mesi1['12'] = "Dicembre" ;
			}else{
				$mega_mesi1['01'] = "January";
				$mega_mesi1['02'] = "February" ;
				$mega_mesi1['03'] = "March" ;
				$mega_mesi1['04'] = "April" ;
				$mega_mesi1['05'] = "May" ;
				$mega_mesi1['06'] = "June" ;
				$mega_mesi1['07'] = "July" ;
				$mega_mesi1['08'] = "August" ;
				$mega_mesi1['09'] = "September" ;
				$mega_mesi1['10'] = "October" ;
				$mega_mesi1['11'] = "November" ;
				$mega_mesi1['12'] = "December" ;
			}
		@endphp
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-7">
						@php
							$query_ya_risultati = DB::table('ya_risultati')
								->select('*')
								->WHERE('visibile','=','1')
								->WHERE('anno','=',$anno_risultati)
								->ORDERBY('data_dal','ASC')
								->get();
							$num_ris = $query_ya_risultati->count();
							$x=1;
							$y=1;
						@endphp
						
						@if($num_ris>0)						
							<div class="timeline">
								<ul class="timeline-circles">
									@foreach($query_ya_risultati AS $key_risultati=>$value_risultati)									
										<style>
										  .timeline-circles:before,
											.timeline-circles:after {
											content: "<?php echo substr($anno_risultati,0,4);?>";
										  }
										</style>								
										@php	
											$titolo_regata=$value_risultati->nome_evento." - ".$value_risultati->luogo." ".$anno_risultati;	
										@endphp
										
										<li></li>
										<li></li>
										<li>
											<div id="regata_<?php echo $value_risultati->id;?>" class="timeline-block" <?php if($x==1){?>style="margin-top:20px;"<?php }else{?>style="margin-top:-100px;"<?php }?>>
												<!-- Blog image post-->
												<div class="post-item">
													<div class="row">
														@if($y==1)
															<div class="col-lg-3" style="margin-bottom:20px;">
																<div class="post-meta <?php if($x==2){?>post-meta-custom<?php }?>">
																	<div class="post-date">
																		<div <?php if($y==1){?>class="txtDxReg"<?php }?> style="font-family:'Open Sans'; font-size:42px; color:#111;  font-weight:900"><?php echo substr($value_risultati->data_dal,-2);?></div>
																		<div <?php if($y==1){?>class="txtDxReg"<?php }?> style="color:#111;  margin-top:12px;"><?php echo $mega_mesi1[''.substr($value_risultati->data_dal,5,-3).''];?></div>
																	</div>	
																</div>
															</div>
														@endif
														
														@if($y==2)
															<div class="col-lg-3 soloMobReg" style="margin-bottom:20px;">
																<div class="post-meta <?php if($x==2){?>post-meta-custom<?php }?>">
																	<div class="post-date">
																		<div style="text-align:left; font-family:'Open Sans'; font-size:42px; color:#111;  font-weight:900"><?php echo substr($value_risultati->data_dal,-2);?></div>
																		<div style="text-align:left; color:#111;  margin-top:12px;"><?php echo $mega_mesi1[''.substr($value_risultati->data_dal,5,-3).''];?></div>
																	</div>	
																</div>
															</div>
														@endif
													
														<div class="col-lg-9">
													
															<div class="post-image">
																<img style="width:100%" src="resarea/img_up/ya_risultati/<?php if(is_file("resarea/img_up/ya_risultati/s_".$value_risultati->img)) echo "s_";?><?php echo $value_risultati->img;?>" style="border: solid 3px #cbcbcb" alt="<?php echo $titolo_regata;?>"/>
															</div>
															<div class="post-content-details">
																<div class="post-title">
																	<h3><?php echo ucfirst($value_risultati->nome_evento);?></h3>
																</div>
																<div class="post-info">
																	<span class="post-autor"><?php echo ucfirst($value_risultati->luogo);?> </span>
																	&nbsp;|&nbsp;
																	<?php 
																	$temp=explode("-",$value_risultati->data_dal);
																	?>
																	<?php if($lingua=="ita"){?>
																		<span class="post-category">
																			<?php if($value_risultati->data_dal!=$value_risultati->data_al && $value_risultati->data_al!="0000-00-00"){?>
																				dal <?php echo $temp[2]."/".$temp[1];?><?php if($value_risultati->data_al && $value_risultati->data_al!=""){?> al <?php echo substr($value_risultati->data_al,-2);?>/<?php echo substr($value_risultati->data_al,5,-3);?><?php }?>
																			<?php }else{?>
																				<?php echo date_to_data($value_risultati->data_dal,"/");;?>
																			<?php }?>
																		</span>
																	<?php }else{?>
																		<span class="post-category">
																			<?php if($value_risultati->data_dal!=$value_risultati->data_al && $value_risultati->data_al!="0000-00-00"){?>
																				from <?php echo $temp[2]."/".$temp[1];?><?php if($value_risultati->data_al && $value_risultati->data_al!=""){?> to <?php echo substr($value_risultati->data_al,-2);?>/<?php echo substr($value_risultati->data_al,5,-3);?><?php }?>
																			<?php }else{?>
																				<?php echo date_to_data($value_risultati->data_dal,"/");;?>
																			<?php }?>
																		</span>
																	<?php }?>
																</div>
																<div class="post-description">
																	<p>
																		<b><?php if($lingua=="ita"){?>Risultato<?php }else{?>Result<?php }?></b>:<br/>
																		<?php echo $value_risultati->risultato;?>
																	</p>
																</div>
															</div>
														</div>
														@if($y==2)
															<div class="col-lg-3 soloDeskReg">
																<div class="post-meta <?php if($x==2){?>post-meta-custom<?php }?>">
																	<div class="post-date">
																		<div class="txtDxReg" style="font-family:'Open Sans'; font-size:42px; color:#111;  font-weight:900"><?php echo substr($value_risultati->data_dal,-2);?></div>
																		<div class="txtDxReg" style="color:#111;  margin-top:12px;"><?php echo $mega_mesi1[''.substr($value_risultati->data_dal,5,-3).''];?></div>
																	</div>	
																</div>
															</div>
														@endif
													</div>
												</div>
											</div>
										</li>
										<li></li>
										@php
											$x++; if($x==4) $x=2;
											$y++; if($y==3) $y=1;
										@endphp
									@endforeach
							</ul>
						</div>
						@else	
							@php
								$query_ya_risultati = DB::table('ya_risultati')
									->select('*')
									->WHERE('visibile','=','1')
									->ORDERBY('data_dal','ASC')
									->LIMIT('1')
									->get();
								$anno_risultati = $query_ya_risultati[0]->anno;
							@endphp
							<script>
								window.location="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra/risultati-<?php echo $anno_risultati;?>.html";
							</script>
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
	@else
		<script>
			window.location="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra.html";
		</script>
	@endif	
@endsection