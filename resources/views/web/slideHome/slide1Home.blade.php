 @include('web.slideHome.assets.slide1Home_css')

<style>
	@media screen AND (max-width:1023px){
		.media-slider-container{
			width:100%
		}
	}
	@media screen AND (max-width:650px){
		.slide-content-overlay{
			width:90%;
			margin-left:-3%;
		}
	}
</style>
<div style="width:100%; min-height:calc(100vh - 130px); display:flex; flex-wrap:wrap;">
	@php
		$query_s = DB::table('slide')
			->select('*')
			->where('visibile', '=', '1')
			->orderBy('ordine', 'DESC')
			->get();
			
			$x=0;
	@endphp
	
	<div class="media-slider-container">
	  <div class="media-slider-wrapper">
		@foreach ($query_s as  $key=>$campo)
			@php 
				$rootUrl = url('/');
				$x++; 
				if(!empty($campo->link))
					$linkSlide = $campo->link;
			@endphp
			<div class="media-slide {{ $x == 1 ? 'active' : '' }}">
			  @if($campo->video && file_exists("resarea/files/slide/".$campo->video))
				  <!-- video slide -->
				  <video autoplay muted loop playsinline class="slide-background-video">
					<source src="{{ url('/') }}/resarea/files/slide/{{$campo->video}}" type="video/mp4" @if(!empty($campo->link)) style="cursor:pointer;" onclick="window.location='{{ $campo->link }}';" @endif>
				  </video>
			  @else
				@if(file_exists(public_path("resarea/img_up/slide/" . $campo->img)))  
					<img src="{{ $rootUrl }}/resarea/img_up/slide/{{$campo->img}}" class="slide-background-image" alt="{{ $campo->riga2 }} - {{ config('app.name'); }}" @if(!empty($campo->link)) style="cursor:pointer;" onclick="window.location='{{ $campo->link }}';" @endif>
				@else
					<img src="https://www.yccs.it/resarea/img_up/slide/{{$campo->img}}" class="slide-background-image" alt="{{ $campo->riga2 }} - {{ config('app.name'); }}" @if(!empty($campo->link)) style="cursor:pointer;" onclick="window.location='{{ $campo->link }}';" @endif>					
				@endif
			  @endif	
			  <div class="slide-content-overlay">
				<h2>{{ $campo->riga2 }}</h2>
				@if(!empty($linkSlide)) 
					<a href="{{ $linkSlide }}" class="slide-info-link">
				@endif
					  <div>
						<h3>{{ $campo->riga1 }}</h3>
						<div class="slide-date">{{ $campo->riga3 }}</div>
					  </div>
					  @if(!empty($campo->link))
						<img src="{{ asset('web/images/freccia_bianca.png') }}" class="slide-info-arrow" alt="">
					  @endif
				@if(!empty($linkSlide)) 
					</a>
				@endif
			  </div>
			</div>
		@endforeach
	  </div>
		
		<div style="position:absolute; width:100%; left:0; bottom:0px; z-index:2">
		  <div class="slider-nav-wrapper">
			<button class="nav-arrow-button prev-slide">
			  <img src="{{ asset('web/images/freccia_sinistra.png') }}" alt="Prev">
			</button>
			<button class="nav-arrow-button next-slide">
			  <img src="{{ asset('web/images/freccia_destra.png') }}" alt="Next">
			</button>
		  </div>
	  </div>
	</div>
	
	<style>
		.colRegate{
			padding:15px 50px 25px 50px;
		}
		.nomeRegata{
			font-size:20px; 
			font-weight:700; 
			line-height:20px;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
		}
		.nomeRegata2{
			font-size:20px; 
			font-weight:700; 
			line-height:20px;
			/*display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;*/
		}
		.logoRegataDesk{
			display:block;
		}
		.logoRegataTab{
			display:none;
		}
		.container-right{
			width:50%
		}
		
		#regata-wrapper-mob{
			display:none;
		}
		@media screen AND (max-width:1560px){
			.colRegate{
				padding:15px 20px 25px 20px;
			}
		}
		@media screen AND (max-width:1199px){
			.logoRegataDesk{
				display:none;
			}
			.logoRegataTab{
				display:block;
			}
		}
		@media screen AND (max-width:1023px){
			.container-right{
				width:100%
			}
			.logoRegataDesk{
				display:block;
			}
			.logoRegataTab{
				display:none;
			}
		}
		@media screen AND (max-width:600px){
			#regata-wrapper{
				display:none
			}
			#regata-wrapper-mob{
				display:flex;
			}
			.rigaRegataMob{flex-direction:column;}
		}
		@media screen AND (max-width:500px){
			.link-arrow-home1{
				height:45px;
			}
			.arrow-img-home1{
				margin-top:20px;
			}
		}
	</style>
	<div class="container-right">
		<div class="colRegate">
			<h3 class="gradient-title" style="margin:0; padding:0; margin-bottom:20px;">
				@if($lingua=='eng' || $lingua=='en')
					Regattas
				@else 
					Regate 
				@endif
			</h3>
			
			@include('web.slideHome.slide1HomeRigaDesk')
			@include('web.slideHome.slide1HomeRigaMob')
			<style>
				.soloDesk{display:block}
				.soloMob{display:none}
				@media screen AND (max-width:1023px){
					.soloDesk{display:none !important}
					.soloMob{display:block}
				}
			</style>
			<div style="display:flex; gap:15px; margin-top:20px; align-items:center">
				<div style="width:148px; display:flex; gap:30px;" class="soloDesk">
					<img src="{{ asset('web/images/freccia_giu.png') }}" class="arrow-btn" data-default="freccia_giu.png" data-hover="freccia_giu_on.png" style="width:43px" alt=""/>
					<img src="{{ asset('web/images/freccia_su.png') }}" class="arrow-btn" data-default="freccia_su.png" data-hover="freccia_su_on.png" style="width:43px" alt=""/>
				</div>
				@php
					$link_calendario = "regate-".date('Y').".html";
					if($lingua=='eng' || $lingua=='en') $link_calendario = "en/regate-".date('Y').".html";
				@endphp

				<a href="{{ $link_calendario }}" class="link-arrow link-arrow-home1" style="justify-content:space-between;">
					<span>
						@if($lingua=='eng' || $lingua=='en')
							Full Calendar
						@else 
							Calendario Completo 
						@endif</span>
					<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img arrow-img-home1"/>
				</a>
			</div>
		</div>
	</div>
	
</div>
 @include('web.slideHome.assets.slide1Home_js')