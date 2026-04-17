<!-- LOGHI PARTNERS -->		
<div  id="partners_logo"></div>
<div style="width:100%; text-align:center;">
	@php	
		$query_loghi_p = DB::table('edizioni_loghi_partners');
		$query_loghi_p = $query_loghi_p->select('*');
		$query_loghi_p = $query_loghi_p->where('id_edizione','=',$id_dett);
		$query_loghi_p = $query_loghi_p->orderby('ordine','DESC');	
		$query_loghi_p = $query_loghi_p->get();
		$num_loghi_p = $query_loghi_p->count();
	@endphp
	@if($num_loghi_p>0)
		<div class="container" style="padding-top:60px;">
			<div style="position:relative; width:100%; border-bottom:solid 2px #<?php echo $colore_testo;?>">
				<div style="position:absolute; width:100px; height:25px; left:50%; margin-left:-50px; background:#fff; text-align:center; top:-12px;"><strong>PARTNERS</strong></div>
			</div>
		</div>
		@if($num_loghi_p>0)
			<style>
				.loghiPartners{max-width:180px;}
				@media (max-width: 500px) {
					.loghiPartners{max-width:130px;}
				}
				@media (max-width: 400px) {
					.loghiPartners{max-width:110px;}
				}
			</style>
			<div style="padding:0px;">
				
				<style>
					.carousel-loghi_p .flickity-page-dots{display:none}
					.carousel-loghi_p .flickity-viewport{height:100px !important;}
				</style>
				<div class="<?php if($num_loghi_p>1){?>carousel<?php }?> team-members team-members-shadow p-t-20 m-b-0" data-items="{{ $num_loghi_p }}" data-dots="false">
					@foreach($query_loghi_p AS $key_loghi_p=>$value_loghi_p)
						@foreach($value_loghi_p AS $key_risu=>$value_risu)
							@php
								$risu_loghi[$key_risu]=$value_risu;
							@endphp
						@endforeach
						
						@php
							$link_eng=$risu_loghi['link_eng'];
							$link=$risu_loghi['link_eng'];
							if($risu_loghi['link'] && trim($risu_loghi['link'])!="") $link=$risu_loghi['link'];
						@endphp
						
						<div class="team-member" style="border:none; box-shadow:none; background:none; margin-bottom:0">
							<?php if($link_eng && trim($link_eng)!=""){?><a href="<?php if($lingua=="ita") echo $link; else echo $link_eng;?>" title="<?php echo $value_loghi_p->titolo;?>" target="_blank"><?php }?>
								<div class="team-image p-b-0">
									<div style="position:relative; width:180px; height:128px; margin:0 auto; background:#fff; border:solid 2px #fff">
										<div style="position:absolute; top:0; left:0; width:100%; height:100%;">
											<img src="resarea/img_up/regate/loghi/<?php echo $value_loghi_p->img;?>" alt="<?php echo $value_loghi_p->titolo;?>" style="height: 100%; width: 100%; object-fit: contain;">
										</div>
									</div>
								</div>
							<?php if($link_eng && trim($link_eng)!=""){?></a><?php }?>
						</div>
					@endforeach				
				</div>
			</div>
			
			
			
			<script>
				$(document).ready(function() {
				  var owl = $('.loghi_partners');
				  owl.owlCarousel({
					items: 1,
					loop: true,
					autoplay: false,
					autoplayTimeout: 2000,
					autoplayHoverPause: true,
					dots: false,
					nav: true,
					navText: ['<i class="fa fa-chevron-left icon-white" style="color:#<?php echo $colore_testo;?>"></i>','<i class="fa fa-chevron-right icon-white" style="color:#<?php echo $colore_testo;?>"></i>'],
					responsive : {
						// breakpoint from 0 up
						0 : {
							items: <?php if($num_loghi_p==1){?>1<?php }else{?>2<?php }?>
						},
						321 : {
							items: <?php if($num_loghi_p==1){?>1<?php }elseif($num_loghi_p==2){?>2<?php }else{?>3<?php }?>
						},
						// breakpoint from 480 up
						550 : {
							items: <?php if($num_loghi_p==1){?>1<?php }elseif($num_loghi_p==2){?>2<?php }elseif($num_loghi_p==3){?>3<?php }else{?>4<?php }?>
						},
						// breakpoint from 768 up
						768 : {
							items: <?php if($num_loghi_p==1){?>1<?php }elseif($num_loghi_p==2){?>2<?php }elseif($num_loghi_p==3){?>3<?php }elseif($num_loghi_p==4){?>4<?php }else{?>5<?php }?>
						},
						// breakpoint from 1024 up
						1024 : {
							items: <?php if($num_loghi_p==1){?>1<?php }elseif($num_loghi_p==2){?>2<?php }elseif($num_loghi_p==3){?>3<?php }elseif($num_loghi_p==4){?>4<?php }elseif($num_loghi_p==5){?>5<?php }else{?>6<?php }?>
						}
					}
				  });
				})
			</script>
		@else
			$risu_loghi = $resu_loghi->fetch();?>
			<style>
				#logo_singolo{max-width:180px;}
				@media (max-width: 900px) {
					#logo_singolo{max-width:180px;}
				}
				@media (max-width: 650px) {
					#logo_singolo{max-width:160px;}
				}
				@media (max-width: 450px) {
					#logo_singolo{max-width:130px;}
				}
			</style>
			<div style="padding:20px; text-align:center;">
				<?php if($risu_loghi['link_eng'] && trim($risu_loghi['link_eng'])!=""){?><a href="<?php if($lingua=="ita") echo $risu_loghi['link']; else echo $risu_loghi['link_eng'];?>" title="<?php echo $risu_loghi['titolo'];?>"><?php }?>
					<img alt="<?php echo $risu_loghi['titolo'];?>" src="resarea/img_up/regate/loghi/<?php echo $risu_loghi['img'];?>" style="margin:0 auto; height:auto;" id="logo_singolo"/>
				<?php if($risu_loghi['link_eng'] && trim($risu_loghi['link_eng'])!=""){?></a><?php }?>
			</div>
		@endif
		<div class="container" style="margin-bottom:30px;">
			<div style="position:relative; width:100%; border-bottom:solid 1px #eee"></div>
		</div>
	@else
		<div style="width:100%; height:10px;"></div>
	@endif
</div>

<!-- FINE LOGHI PARTNERS-->