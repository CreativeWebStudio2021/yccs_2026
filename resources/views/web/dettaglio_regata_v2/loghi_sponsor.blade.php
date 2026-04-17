<!-- LOGHI -->
<div style="width:100%; text-align:center;">
	@php	
		$query_loghi = DB::table('edizioni_loghi_new');
		$query_loghi = $query_loghi->select('*');
		$query_loghi = $query_loghi->where('id_edizione','=',$id_dett);
		$query_loghi = $query_loghi->orderby('ordine','DESC');
		$query_loghi = $query_loghi->get();
		$num_loghi = $query_loghi->count();
	@endphp
	@if($num_loghi>0)
		@if($num_loghi>1)
			@php
				$num_carousel = $num_loghi;
				if($num_loghi>4) $num_carousel = 4;
			@endphp
			<style>
				.carousel-loghi .flickity-page-dots{display:none}
				.carousel-loghi .flickity-viewport{height:100px !important;}
			</style>
			<div class="carousel team-members team-members-shadow p-t-20 m-b-0 carousel-loghi" data-items="{{ $num_carousel }}">
				@foreach($query_loghi AS $key_loghi=>$value_loghi)
					@php
						$link_eng=$value_loghi->link_eng;
						$link=$value_loghi->link_eng;
						if($value_loghi->link && trim($value_loghi->link)!="") $link=$value_loghi->link;
					@endphp
					<div class="team-member" style="border:none; box-shadow:none; background:none">
						<?php if($link_eng && trim($link_eng)!=""){?><a href="<?php if($lingua=="ita") echo $link; else echo $link_eng;?>" title="<?php echo $value_loghi->titolo;?>" target="_blank"><?php }?>
							<div class="team-image">
								<div style="position:relative; width:317px; height:80px; margin:0 auto; background:#fff; border:solid 2px #fff">
									<div style="position:absolute; top:0; left:0; width:100%; height:100%;">
										<img src="resarea/img_up/regate/loghi/<?php echo $value_loghi->img;?>" alt="<?php echo $value_loghi->titolo;?>" style="height: 100%; width: 100%; object-fit: contain;">
									</div>
								</div>
							</div>
						<?php if($link_eng && trim($link_eng)!=""){?></a><?php }?>
					</div>
				@endforeach					
			</div>					
		@else
			<style>
				#logo_singolo{max-width:317px;}
				@media (max-width: 900px) {
					#logo_singolo{max-width:250px;}
				}
				@media (max-width: 650px) {
					#logo_singolo{max-width:200px;}
				}
				@media (max-width: 450px) {
					#logo_singolo{max-width:160px;}
				}
			</style>
			<div style="padding:20px; text-align:center;">
				<?php if($query_loghi[0]->link_eng && trim($query_loghi[0]->link_eng)!=""){?><a href="<?php if($lingua=="ita") echo $query_loghi[0]->link; else echo $query_loghi[0]->link_eng;?>" title="<?php echo $query_loghi[0]->titolo;?>"><?php }?>
					<img alt="<?php echo $query_loghi[0]->titolo;?>" src="resarea/img_up/regate/loghi/<?php echo $query_loghi[0]->img;?>" style="margin:0 auto; height:auto;" id="logo_singolo"/>
				<?php if($query_loghi[0]->link_eng && trim($query_loghi[0]->link_eng)!=""){?></a><?php }?>
			</div>
		@endif
	@else
		<div style="width:100%; height:10px;"></div>
	@endif
</div>
<!-- FINE LOGHI -->