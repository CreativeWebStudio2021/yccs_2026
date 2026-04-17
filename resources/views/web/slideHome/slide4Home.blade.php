@include('web.slideHome.assets.slide4Home_css')

<div id="slide4Home" class="slide4-bg-video-container">
  <!-- VIDEO SFONDO FISSO -->
  <video class="slide4-bg-video" src="{{ asset('web/video/blue-sea.mp4') }}" autoplay loop muted playsinline></video>
  
  <!-- CONTENUTO SCROLLABILE -->
  <div class="slide4-scroll-content">
    <!-- PRIMO BLOCCO (white-box) -->
    <div class="slide4-content-wrapper">
      <div class="slide4-white-box">
        <img src="{{ asset('web/images/young_azzurra_logo_home2.png') }}" class="slide4-logo" alt="Young Azzurra Logo">
        <img src="{{ asset('web/images/young_azzurra_home.png') }}" class="slide4-main-img" alt="Young Azzurra Home" />
        <div class="slide4-text-box">
          @if($lingua=='eng' || $lingua=='en')
            Young Azzurra is the sports project launched in 2020 by the Yacht Club Costa Smeralda dedicated to the Italian sailing talent
            in an equal opportunity perspective. The project is born and develops in continuità with the name and the history of Azzurra.
          @else 
            Young Azzurra è il progetto sportivo lanciato nel 2020 dallo Yacht Club Costa Smeralda dedicato ai giovani talenti della vela italiana 
            in un'ottica di pari opportunità. Il progetto nasce e si sviluppa in continuità con il nome e la storia di Azzurra.
          @endif
        </div>
        <a href="<?php if($lingua=="eng"){?>en/<?php }?>young-azzurra.html" class="slide4-link-arrow">
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
    
    <!-- SECONDO BLOCCO (due card animate) -->
    <div class="slide4-extra-section">
      <div class="slide4-block left">
		<div class="slide4-block-content">
			<h3 class="gradient-title" style="font-size:40px; margin-bottom:20px;">Magazine</h3>
			<div style="padding:0 30px">
				<img src="{{ asset('web/images/magazine2.jpg') }}" alt="Magazine" style="width:100%" />
			</div>
			<div class="slide4-block-content-title">
				@if($lingua=='eng' || $lingua=='en')
					Insights,<br/>
					news and curiosities!
				@else 
					Approfondimenti,<br/>
					novità e curiosità!
				@endif
				novità e curiosità!
			</div>
			<div class="slide4-block-content-text">
				@if($lingua=='eng' || $lingua=='en')
					Explore our articles to stay always updated on trends, innovation and sector insights.
				@else 
					Esplora i nostri articoli per restare sempre aggiornato su tendenze, innovazione e approfondimenti di settore.
				@endif
			</div>
			<a href=<?php if($lingua=="eng"){?>en/<?php }?>"magazine.html" class="slide4-link-arrow slide4-link-arrow2"	>
			  <span>
				@if($lingua=='eng' || $lingua=='en')
					Discover more
				@else 
					Scopri di più
				@endif
			  </span>
			  <img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
			</a>
		</diV>
	  </div>
      <div class="slide4-block right">		
		<div class="slide4-block-content">
			<h3 class="gradient-title" style="font-size:40px; margin-bottom:20px;">Sail Talk</h3>
			<div style="padding:0 30px">
				<img src="{{ asset('web/images/sail_talk.png') }}" alt="Magazine" style="width:100%" />
			</div>
			<div class="slide4-block-content-title">
				@if($lingua=='eng' || $lingua=='en')
					The voices of sailing<br/>
					await you!
				@else 
					Le voci della vela<br/>
					ti aspettano!
				@endif
			</div>
			<div class="slide4-block-content-text">
				@if($lingua=='eng' || $lingua=='en')
					Discover the exclusive interviews with experts, champions and enthusiasts of the sailing world.
				@else 
					Scopri le interviste esclusive con esperti, campioni e appassionati del mondo della vela.
				@endif
			</div>
			<a href="<?php if($lingua=="eng"){?>en/<?php }?>sail_talk.html" class="slide4-link-arrow slide4-link-arrow2">
			  <span>
				@if($lingua=='eng' || $lingua=='en')
					Discover more
				@else 
					Scopri di più
				@endif
			  </span>
			  <img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
			</a>
		</diV>
	  </div>
    </div>
    
  </div>
</div>


@include('web.slideHome.assets.slide4Home_js')