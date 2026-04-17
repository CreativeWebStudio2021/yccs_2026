<style>
	.instagram-wrap{
		width:100%;
	}
	.instagram-wrap-inner{
			padding:50px 128px 0;
	}
	.instagram-header{
		width:100%;
		display:flex;
		gap:35px;
	}
	.instagram-container{
		padding-top:20px;
	}
	.instagram-link-arrow{
		width:190px !important;
		gap:40px !important;
		margin-top:30px;
		padding-left:calc(100% - 163px);
		padding-bottom:7px;
		justify-content:space-between;
	}
	@media screen and (max-width:1200px) {
		.instagram-wrap-inner{
			padding:50px 20px 0;
		}
	}
	
	@media screen and (max-width:550px) {
		.instagram-wrap-inner{
			padding:50px 0 0;
		}
		.instagram-header{
			flex-direction:column;
			align-items:center;
			justify-content:center;
			gap:5px;
		}
		.gradient-title{
			margin-bottom:0px;
		}
		.instagram-link-arrow{
			margin-top:0px;
		}
		.instagram-container{
			padding-top:40px;
		}
	}
</style>
<div class="instagram-wrap">
	<div class="instagram-wrap-inner">
		<div class="instagram-header">
			<h3 class="gradient-title">Instagram</h3>
			<div style="flex:1;">
				<a href="https://www.instagram.com/yccs_portocervo/" target="_blank" class="link-arrow instagram-link-arrow">
				  <span>
					@if($lingua=='eng' || $lingua=='en')
						Discover more
					@else 
						Scopri di più
					@endif
				  </span>
				  <img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
				</a>
			</div>
		</div>
		<div style="width:100%;">
			<div class="instagram-container">
				<!-- Elfsight Instagram Feed | YCCS New Site -->
				<script src="{{ asset('https://static.elfsight.com/platform/platform.js') }}" async></script>
				<div class="elfsight-app-7039271f-9739-4cfe-b594-d8f2ffa0953a" data-elfsight-app-lazy></div>
			</div>
		</div>
	</div>
</div>