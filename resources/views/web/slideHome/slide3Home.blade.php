@include('web.slideHome.assets.slide3Home_css')

<style>
	.slide3-title{
		margin:0; 
		padding:0; 
		padding-bottom:10px; 
		font-weight:300; 
		line-height:58px;
	}
	.slide3-text-block{
		width:350px;
		padding-top:39px;
		position:relative;
	}
	.slide3-timeline-row{
		padding-top:110px;
		display:flex;
	}
	.slide3-image-block{
		width:calc(100% - 20px);
		margin-left:20px;
		height:100%;
	}
	.slide3-text-row{
		padding-top:46px;
		display:flex;
	}
	@media screen and (max-width: 900px) {
		.slide3-title{
			margin-bottom:30px
		}
		.slide3-text-block{
			width:50%;
		}
	}
	.slide3-text-block-link{
		width:100%;
		margin-top:102px;
	}
	@media screen and (max-width: 500px) {
		.slide3-image-block{
			margin-left:20px;
			width:calc(100% -20px);
		}
		.slide3-text-row{
			flex-direction: column-reverse;
		}
		.slide3-text-block{
			width:calc(100% - 40px);
			margin-left:20px;
		}
		.slide3-text-block-link{
			margin-top:20px;
		}
	}
</style>
<div id="slide3Home" class="@if($lingua=='eng' || $lingua=='en')slide3-lang-en @endif" style="width:100%; height:100vh; ">
	<div class="slide3-timeline-row">
		<div class="slide3-spacer"></div>
		<div class="slide3-header-block" style="flex:1; position:relative;">
			<h3 class="gradient-title slide3-title">
				<span class="slide3-title-line1">
					@if($lingua=='eng' || $lingua=='en')
						Calendar
					@else 
						Calendario 
					@endif</span>
				<span class="slide3-title-line2">
					@if($lingua=='eng' || $lingua=='en')
						Regattas
					@else 
						Regate 
					@endif
				</span>
			</span>
			</h3>
			<div class="slide3-timeline-wrap">
				<div class="slide3-timeline-line">
					<div class="year-group-animate bgAzzurro pallino-anno pallino-anno-1">
						<div style="width:100%; height:100%; position:relative;">
							<a href="{{ ($lingua=='eng' || $lingua=='en') ? 'en/' : '' }}regate-{{ date('Y')-4 }}.html" class="year-label">{{ date('Y')-4 }}</a>
						</div>
					</div>
					<div class="year-group-animate bgAzzurro pallino-anno pallino-anno-2">
						<div style="width:100%; height:100%; position:relative;">
							<a href="{{ ($lingua=='eng' || $lingua=='en') ? 'en/' : '' }}regate-{{ date('Y')-3 }}.html" class="year-label">{{ date('Y')-3 }}</a>
						</div>
					</div>
					<div class="year-group-animate bgAzzurro pallino-anno pallino-anno-3">
						<div style="width:100%; height:100%; position:relative;">
							<a href="{{ ($lingua=='eng' || $lingua=='en') ? 'en/' : '' }}regate-{{ date('Y')-2 }}.html" class="year-label">{{ date('Y')-2 }}</a>
						</div>
					</div>
					<div class="year-group-animate bgAzzurro pallino-anno pallino-anno-4">
						<div style="width:100%; height:100%; position:relative;">
							<a href="{{ ($lingua=='eng' || $lingua=='en') ? 'en/' : '' }}regate-{{ date('Y')-1 }}.html" class="year-label">{{ date('Y')-1 }}</a>
						</div>
					</div>
					<div class="year-group-animate bgAzzurro pallino-anno-current">
						<div style="width:100%; height:100%; position:relative;">
							<div style="padding:3.5px 8px; display:flex; gap:24px; align-items:center; justify-content:space-between;">
								<img src="{{ asset('web/images/freccina_sinistra.png') }}" style="wisth:6px; height:14px;" alt=""/>
								<img src="{{ asset('web/images/freccina_destra.png') }}" style="wisth:6px; height:14px;" alt=""/>
							</div>
							<a href="{{ ($lingua=='eng' || $lingua=='en') ? 'en/' : '' }}regate-{{ date('Y') }}.html" class="year-label year-label-current">{{ date('Y') }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="slide3-text-row">
		<div class="slide3-spacer"></div>
		<div class="slide3-text-block">
			<div style="width:100%; font-size:14px;">
			@if($lingua=='eng' || $lingua=='en')
				The Yacht Club organizes <b class="azzurro">regattas</b> during the summer season and offers its members, their guests, and boat owners premium services at the Porto Cervo facility.
			@else 
				Lo Yacht Club organizza <b class="azzurro">regate</b> durante la stagione estiva e offre ai propri soci, ai loro ospiti e agli armatori servizi pregiati presso la struttura di Porto Cervo.
			@endif
			</div>
			<div class="slide3-text-block-link">
				<a href="{{ ($lingua=='eng' || $lingua=='en') ? 'en/' : '' }}regate-{{ date('Y'); }}.html" class="link-arrow fade-in" style="width:155px; margin-top:12px; margin-right:20px; justify-content:space-between;">
					<span>
						@if($lingua=='eng' || $lingua=='en')
							All regattas
						@else 
							Tutte le regate 
						@endif
					</span>
					<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
				</a>
			</div>
		</div>
		<div style="flex:1; height:calc(100vh - 300px);">
			<div class="slide3-image-block">
				<img src="{{ asset('web/images/calendario_regate.jpeg') }}" style="object-fit:cover; width:100%; height:100%;" alt="" id="calendarioImg"/>
			</div>
		</div>
	</div>
</div>
@include('web.slideHome.assets.slide3Home_js')