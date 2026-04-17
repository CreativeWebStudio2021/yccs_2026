<section id="page-title" style="padding-bottom:0;">
	<style>
		.grid-articles .post-entry:before {
			background:none
		}
		.topSlider{margin-top:-200px}
		@media screen AND (max-width:1024px){
			.topSlider{margin-top:-40px}
		}
	</style>
	<div class="grid-articles carousel arrows-visibile topSlider" data-items="1" data-margin="0" data-fade="true"  data-dots="false"  data-hover="false">			
		@php
			$ind1=rand(1,4);
			$ind2=$ind1;
			while($ind2==$ind1){$ind2=rand(1,4);}
			$ind3=$ind1;
			while($ind1==$ind3 || $ind2==$ind3){$ind3=rand(1,4);}
			$ind4=$ind1;
			while($ind1==$ind4 || $ind2==$ind4 || $ind3==$ind4){$ind4=rand(1,4);}
		@endphp
		<article class="post-entry">
			<a href="#" class="post-image">
				 <img src="https://www.yccs.it/web/images/scuola/gallery/slide/<?php echo $ind1;?>.jpg"  alt="YCCS Sailing School - 1 - {{ config('app.name') }}"/>
			</a>
		</article>	
		<article class="post-entry">
			<a href="#" class="post-image">
				 <img src="https://www.yccs.it/web/images/scuola/gallery/slide/<?php echo $ind2;?>.jpg"  alt="YCCS Sailing School - 2 - {{ config('app.name') }}"/>
			</a>
		</article>	
		<article class="post-entry">
			<a href="#" class="post-image">
				 <img src="https://www.yccs.it/web/images/scuola/gallery/slide/<?php echo $ind3;?>.jpg"  alt="YCCS Sailing School - 3 - {{ config('app.name') }}"/>
			</a>
		</article>	
		<article class="post-entry">
			<a href="#" class="post-image">
				 <img src="https://www.yccs.it/web/images/scuola/gallery/slide/<?php echo $ind4;?>.jpg"  alt="YCCS Sailing School - 4 - {{ config('app.name') }}"/>
			</a>
		</article>		
		
	</div>
</section>