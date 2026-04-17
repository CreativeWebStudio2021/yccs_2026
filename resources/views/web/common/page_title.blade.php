<style>
	.media-slider-container-title {
	  position: relative;
	  width: 100%;
	  height: 300px;
	  overflow: hidden;
	}

	.media-slider-wrapper-title {
	  position: relative;
	  width: 100%;
	  height: 100%;
	}

	.media-slide-title {
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  opacity: 0;
	  transition: opacity 1s ease;
	  z-index: 0;
	}

	.media-slide-title.active {
	  opacity: 1;
	  z-index: 1;
	}

	.slide-background-video-title,
	.slide-background-image-title {
	  width: 100%;
	  height: 100%;
	  object-fit: cover;
	}
	.slide-background-image-title {
	  position: absolute;
	  top: 0;
	  left: 0;
	}

	.slide-content-overlay-title {
	  position: absolute;
	  width:650px;
	  bottom: 100px;
	  left: 115px;
	  color: #fff;
	  z-index: 2;
	}
	.slide-content-overlay-title h1 {
	  font-size: 64px;
	  line-height:1 !important;
	  margin: 0;
	  font-weight:800;
	}
	.slide-content-overlay-title h3 {
	  font-size: 32px;
	  margin: 0;
	}
	
	.slide-content-overlay-title .slide-date-title { font-size: 15px; }

	.slide-info-link-title {
	  display: flex; 
	  gap:42px;
	  align-items: center;
	  color: #fff; text-decoration: none;
	  margin-top: 10px;
	  padding-top: 10px;
	  border-top:solid 1px #fff;
	}
	.slide-info-arrow-title {
	  width: 29px; height: 42px;
	  margin-right: -10px;
	  transition: transform 0.4s ease;
	}
	.slide-info-link-title:hover .slide-info-arrow-title {
	  transform: translateX(15px);
	}
	@media screen and (max-width: 1200px) {
		.slide-content-overlay-title {
			left:60px !important;
		}
		.slide-content-overlay-title h1 {
			font-size: 54px !important;
		}
		.slide-content-overlay-title h3 {
			font-size: 28px !important;
		}
	}
	@media screen and (max-width: 800px) {
		.slide-content-overlay-title {
			left:30px !important;
			width:calc(100% - 60px) !important;
		}
	}
</style>

@php
	if(empty($image_background)) $image_background= "web/images/coppa-europa-smeralda-888.jpg";

	$current_url = URL::current();
	$logo_azzurra = "";
	$title_azzurra = "";
	
	$altTitle="300";
	
	if(str_replace("/azzurra/","",$current_url)!=$current_url && str_replace("la-piazza-azzurra","",$current_url)==$current_url){
		$logo_azzurra = "web/images/azzurra_logo_w.png";
		$title_azzurra = "Azzurra";
		$altTitle="450";
	}
	if(str_replace("/young-azzurra/","",$current_url)!=$current_url){
		$logo_azzurra = "web/images/young_azzurra_logo_w.png";
		$title_azzurra = "Young Azzurra";
		$altTitle="450";
	}
@endphp

<div style="width:width:100%; height:{{ $altTitle }}px; position:relative;">
	<div class="media-slider-container-title" style="height:{{ $altTitle }}px;">
	  <div class="media-slider-wrapper-title">
		<div class="media-slide-title active">
		  @if(!empty($video_background))
			  <video autoplay muted loop playsinline class="slide-background-video-title">
				<source src="{{ asset($video_background) }}" type="video/mp4">
			  </video>
		  @else
			  <img class="slide-background-image-title" src="{{ asset($image_background) }}" alt="{!! $page_title !!} - {{ config('app.name'); }}"/>
		  @endif
		  <div class="slide-content-overlay-title">
			@if($logo_azzurra!="")
				<style>
					#logoAzzurra{width:200px; height:86px; margin-bottom:10px;}
					@media screen AND (max-width:1024px){
						#logoAzzurra{width:150px; height:65px;}
						.breadcrumb{display:none}
					}
				</style>
				<div id="logoAzzurra">
					<img src="https://www.yccs.it/<?=$logo_azzurra;?>" style="width:100%" alt="<?=$title_azzurra;?>"/>
				</div>
			@endif
			<h1 style="color:#fff">{!! $page_title !!}</h1>
			<div style="display:flex; gap:10px;">
				<a class="slide-info-link-title" href="/" style="gap:5px; border:none; margin-top:5px; padding-top:0;" title="Home  - {{ config('app.name'); }}">
				   <div class="slide-date-title">Home </div>
				  <img src="web/images/freccia_bianca.png" style="transform:scale(0.5);" class="slide-info-arrow-title" alt="">
				</a>
				@for($i=1; $i<=$x; $i++)
					<a {!! $breadcrumbs[$i]['link']!="" ? 'href="'.$breadcrumbs[$i]['link'].'"' : '' !!} class="slide-info-link-title" title="{{ $breadcrumbs[$i]['titolo'] }} - {{ config('app.name'); }}" style="gap:5px; border:none; margin-top:5px; padding-top:0;">
						<div class="slide-date-title" style="color:#fff">{{ $breadcrumbs[$i]['titolo'] }}</div> 
					    {!! $i!=$x ? '<img src="web/images/freccia_bianca.png" style="transform:scale(0.5);" class="slide-info-arrow-title" alt="">' : '' !!}
					</a>
				@endfor
			</div>
		  </div>
		</div>
	  </div>
	</div>		
</div>