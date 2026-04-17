@include('web.slideHome.assets.slide5Home_css')

<div id="slide5Home">
	<div id="sez1">
		<div style="position:absolute; top:30px; left:50%; transform:translateX(-50%); z-index:2;">
			<img src="{{ asset('web/images/Logo_YCCS_2.png') }}" class="logo-yccs-Home5" alt=""/>
		</div>
		<img src="{{ asset('web/images/Barca_Vintage_Fondo.png') }}" style="position:absolute; width:100%; height:100%; object-fit:cover; object-position:center bottom;"/>
		<img src="{{ asset('web/images/Barca_Vintage.png') }}" class="barca-vintage" alt=""/>
		
		<div class="slide5-text-blocks-wrap">
		<div class="text-block top">
			@if($lingua=='eng' || $lingua=='en')
				<span class="azzurro"><b>Yacht Club Costa Smeralda</b></span>, founded in 1967 by S.A. the Aga Khan, is renowned for organizing international regattas for superyachts, maxi yachts and one-design vessels.
			@else 
				Lo <span class="azzurro"><b>Yacht Club Costa Smeralda</b></span>, fondato nel 1967 dal Presidente S.A. l'Aga Khan, è rinomato per l’organizzazione di regate internazionali per superyacht, maxi yacht e imbarcazioni one-design.
			@endif
			<a href="<?php if($lingua=="eng"){?>en/<?php }?>la-storia.html" class="link-arrow" style="width:190px !important; gap:50px !important; margin-top:10px; justify-content:space-between;">
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
		<div class="text-block middle">
			@if($lingua=='eng' || $lingua=='en')
				Recognized by the <span class="azzurro"><b>Italian Sailing Federation</b></span>, the <span class="azzurro"><b>YCCS Sailing School of the Yacht Club Costa Smeralda</b></span> operates with the collaboration of <span class="azzurro"><b>Franco Pistone</b></span>, second level FIV instructor with great experience in navigation and regattas.
			@else 
				Riconosciuta dalla  <span class="azzurro"><b>Federazione Italiana Vela</b></span>, la  <span class="azzurro"><b>YCCS Sailing School dello Yacht Club Costa Smeralda</b></span> opera con la collaborazione di <span class="azzurro"><b>Franco Pistone</b></span>, istruttore FIV di secondo livello con grande esperienza di navigazione e regate.
			@endif
			<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs-sailing-school.html" class="link-arrow" style="width:190px !important; gap:50px !important; margin-top:10px; justify-content:space-between;">
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
		<div class="text-block bottom">
			@if($lingua=='eng' || $lingua=='en')
				In 2017, the YCCS celebrated its fiftieth anniversary, with the launch of an environmental project for the preservation of the marine environment and becoming today the <span class="azzurro"><b>One Ocean Foundation</b></span>.
			@else 
				Il 2017 ha segnato per lo YCCS il cinquantesimo anniversario, celebrato con il lancio di un progetto ambientale per la preservazione dell’ambiente marino e divenuto oggi la <span class="azzurro"><b>One Ocean Foundation</b></span>.
			@endif
			<a href="<?php if($lingua=="eng"){?>en/<?php }?>one-ocean.html" class="link-arrow" style="width:190px !important; gap:50px !important; margin-top:10px; justify-content:space-between;">
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
	</div>
	<style>
		.partner-wrap{
			padding:20px 100px;
			display:flex;
			justify-content:space-between;
			gap:150px;
		}
		.partner-logo{
			width:170px;
		}
		.logo_rr{
			width:250px;
		}
		.partner-row{
			flex:1;
			display:flex;
			justify-content:space-between;
			gap:30px;
		}
		@media screen and (max-width:1700px) {
			.partner-wrap{
				padding:20px 20px;
				gap:100px;
			}
			.partner-logo{
				width:150px;
			}
			.logo_rr{
				width:220px;
			}
			.partner-row{
				gap:20px;
			}
		}
		@media screen and (max-width:1400px) {
			.partner-wrap{
				flex-direction:column;
				align-items:center;
				justify-content:center;
				gap:10px;
			}
			#sez2{
				height:auto;
				padding:20px 20px 0px;
			}
		}
		@media screen and (max-width:1200px) {
			.partner-wrap{
				gap:50px;
		}
		@media screen and (max-width:1100px) {
			.partner-wrap{
				padding:20px 0px;
				gap:40px;
			}
		}
		@media screen and (max-width:1024px) {
			#sez2{
				padding:20px 0 50px;
			}
			.partner-wrap{
				flex-direction:column;
				gap:10px;
			}

			.partner-row{
				justify-content:center;
				gap:20px;
			}
			.partner-row.row1 .partner-logo{
				width:200px;
			}
			.partner-row.row1 .logo_rr{
				width:294px;
			}
			.partner-row.row2 .partner-logo{
				width:150px;
			}
		}
		@media screen and (max-width:750px) {
			.partner-row.row1 .partner-logo{
				width:70%;
			}
			.partner-row.row1 .logo_rr{
				width:100%;
			}
			.partner-row.row2 .partner-logo{
				width:100%;
			}
		}
		@media screen and (max-width:450px) {
			#sez2{
				height:auto;
				padding:0;
			}
			.partner-row{
				flex-direction:column;
				align-items:center;
				justify-content:center;
				gap:10px;
			}
			
		}
	}
	</style>
	<div id="sez2">
		<div class="partner-wrap">
			<div class="partner-row row1">
				<div class="partner-logo">
					<img src="{{ asset('web/images/logo_rolex_partner_2026.png') }}" style=" width:100%;" alt="Rolex - Official Timepiece"/>
				</div>
				<div class="partner-logo">
					<img src="{{ asset('web/images/logo_allianz_partner_2_2026.png') }}" style="width:100%;" alt="Allianz - Official Technical Partner"/>
				</div>
				<div class="partner-logo logo_rr">
					<img src="{{ asset('web/images/logo_range_rover_partner_3_2026.png') }}" style="width:100%;" alt="Range Rover - Official Automotive Partner"/>
				</div>
			</div>
			<div class="partner-row row2">
				<div class="partner-logo">
					<img src="{{ asset('web/images/logo_northsail_partner_2026.png') }}" style="width:100%;" alt="North Sails - Official Technical Partner"/>
				</div>
				<div class="partner-logo">
					<img src="{{ asset('web/images/logo_garmin_partner_2026.png') }}" style="width:100%;" alt="Garmin - Official Technical Partner"/>
				</div>
				<div class="partner-logo">
					<img src="{{ asset('web/images/logo_slam_partner_2026.png') }}" style="width:100%;" alt="Slam - Official Technical Partner"/>
				</div>
				<div class="partner-logo">
					<img src="{{ asset('web/images/logo_technogym_partner_2026.png') }}" style="width:100%;" alt="TechnoGym - Wellness Technical Partner"/>
				</div>
			</div>
		</div>
	</div>
</div>

@include('web.slideHome.assets.slide5Home_js')