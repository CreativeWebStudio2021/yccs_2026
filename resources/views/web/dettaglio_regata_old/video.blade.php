@if($num_video>0)
	<div class="accordion">
		@foreach($query_video AS $key_video=>$value_video)
			@php
				$arr_link = explode("?v=",$value_video->video);
				if (isset($arr_link[1]) && $arr_link[1]!="") $video = substr($arr_link[1],0,11);
				else $video = $value_video->video;
				
				$titolo_video = $value_video->titolo;
				if($lingua=="eng" && $value_video->titolo_eng && $value_video->titolo_eng!="") $titolo_video = $value_video->titolo_eng; 
			@endphp
			<div class="ac-item">
				<h5 class="ac-title">{!! $titolo_video !!}</h5>
				<div class="ac-content">
					<div class="video-container">
						<iframe width="640" height="352" src="https://www.youtube.com/embed/<?php echo $video?>?rel=0" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		@endforeach		
	</div>
@endif