@php
	$query_video = DB::table('edizioni_video');
	$query_video = $query_video->select('*');
	$query_video = $query_video->where('id_edizione','=',$id_dett);
	$query_video = $query_video->orderby('ordine','DESC');
	$query_video = $query_video->get();
	$num_video = $query_video->count();
@endphp
@if($num_video>0)
	<!-- VIDEO -->
	<div style="margin-top:60px; position:relative; width:100%;">
		<div  id="video" style="position:absolute; top:-100px;"></div>
		<div class="row" style="width:100%; padding:20px 0; padding-bottom:0; text-align:center;">
			<div style="width:100%; color:#<?php echo $colore_testo;?>"><span class="titoliBox">VIDEO GALLERY</span></div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													
				<div <?php if($num_video>1){?>class="carousel" data-items="1" data-dots="false" <?php }?> data-lightbox-type="gallery" style="padding:35px; padding-bottom:0;">
					@foreach($query_video AS $key_video=>$value_video)					
						@foreach($value_video AS $key_risu=>$value_risu)
							@php
								$risu_video[$key_risu]=$value_risu;
							@endphp
						@endforeach
						@php
							$temp=explode("v=",$risu_video['video']);							
							if(count($temp)>1) $codice = substr($temp[1],0,11);							
							else $codice = $risu_video['video'];
							$titolo_eng=$risu_video['titolo_eng'];
							$titolo_ita=$titolo_eng; 
							if($risu_video['titolo'] && trim($risu_video['titolo'])!="") $titolo_ita=$risu_video['titolo'];
							
							if($lingua=="ita") $titolo=$titolo_ita; else $titolo=$titolo_eng;
						@endphp
						<div class="portfolio-item">
							<div class="portfolio-item-wrap" style="width:100%; height:auto;">
								<div class="portfolio-image" style="width:100%">
									<img src="https://i.ytimg.com/vi/<?php echo $codice;?>/hqdefault.jpg" alt=""  style="width:100%;" class="imgSlide"/>
								</div>
								<div class="portfolio-description">
									<a title="<?php echo $titolo;?>" data-lightbox="iframe" href="https://www.youtube.com/watch?v=<?php echo $codice;?>" class="btn btn-light btn-sm" style="background:none; border:none; "><i class="icon-play" aria-hidden="true" style="color:#fff; background:#ff0000; border:none"></i></a>
								</div>
								<div style="width:100%; text-align:center; padding:15px 10px 0px;">
									<h3 class="titoliBox" style="color:#<?php echo $colore_testo;?>"><?php echo $titolo;?></h3>
								</div>
							</div>
						</div>
					@endforeach					
				</div>	
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
			<div style="clear:both;"></div>
		</div>
	</div>
@endif