<style>
	.media-slider-container {
	  position: relative;
	  width: 100%;
	  height: 520px;
	  overflow: hidden;
	}

	.media-slider-wrapper {
	  position: relative;
	  width: 100%;
	  height: 100%;
	}

	.media-slide {
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  opacity: 0;
	  transition: opacity 1s ease;
	  z-index: 0;
	}

	.media-slide.active {
	  opacity: 1;
	  z-index: 1;
	}

	.slide-background-video,
	.slide-background-image {
	  width: 100%;
	  height: 100%;
	  object-fit: cover;
	}
	.slide-background-image {
	  position: absolute;
	  top: 0;
	  left: 0;
	}

	.slide-content-overlay {
	  position: absolute;
	  width:50%;
	  bottom: 100px;
	  left: 115px;
	  color: #fff;
	  z-index: 2;
	}
	.slide-content-overlay h1 {
	  font-size: 64px;
	  line-height: 1;
	  margin: 0;
	  font-weight:800;
	}
	.slide-content-overlay h3 {
	  font-size: 32px;
	  margin: 0;
	}
	
	.slide-content-overlay .slide-date { font-size: 15px; }

	.slide-info-link {
	  display: flex; 
	  gap:42px;
	  align-items: center;
	  color: #fff; text-decoration: none;
	  margin-top: 10px;
	  padding-top: 10px;
	  border-top:solid 1px #fff;
	}
	.slide-info-arrow {
	  width: 29px; height: 42px;
	  margin-right: -10px;
	  transition: transform 0.4s ease;
	}
	.slide-info-link:hover .slide-info-arrow {
	  transform: translateX(15px);
	}
	
	.row-doc{
		width:100%; 
		border-bottom: solid 1px #000; 
		display:flex; 
		justify-content:space-between;
		align-items:center;
		margin-bottom:10px;
		cursor:pointer;
	}
	.row-doc h4 {
	  font-size: 40px;
	  margin: 0;
	  padding-bottom:10px;
	  font-weight:300;
	}
	.row-doc-arrow {
		width:42px;
		height:18px;
	}
	.row-doc-arrow {
		transform: rotate(180deg);
		transition: transform 0.6s ease;
	}

	.row-doc-arrow.rotate {
		transform: rotate(0deg);
	}

	.list-container {
	  max-height: 0;
	  overflow: hidden;
	  transition: max-height 0.4s ease;
	}
	.list-container.open {
	  /* l'altezza viene gestita via JS */
	}
	
	.link-regata{
		 padding-bottom:5px; 
		 width:400px; 
		 border-bottom:solid 1px #1d1d1b;
		 background:#fff;
		 color: #1d1d1b;
		 transition: all 1s ease;
		 cursor:pointer;
		 position:relative;
	}
	
	.link-regata h4 {
	  color: inherit;
	  transition: color 0.6s ease;
	}

	.link-regata .arrow-link-regata {
	  width:42px; 
	  height:17px; 
	  transform: rotate(90deg);
	  filter: grayscale(100%) brightness(0.2); /* per renderla nera di base */
	  transition: all 0.6s ease;
	}

	.link-regata .close-link-regata {
	  width:42px; 
	  height:42px; 
	  display:none;
	  opacity:0.8;
	  filter: grayscale(100%) brightness(0.2); /* per renderla nera di base */
	  transition: all 0.6s ease;
	}

	.link-regata:hover {
	  width: 550px !important; /* estensione */ 
	  border-bottom-color: var(--azzurro);
	  color: var(--azzurro);
	}

	.link-regata:hover h4 {
	  color:var(--azzurro);
	}

	.link-regata:hover .arrow-link-regata {
	  filter: none; /* rimuove il filtro per vedere il colore originale */
	  content: url("{{ asset('web/images/freccia_thin_up_azzurro.png') }}"); /* immagine azzurra */
	}
	
	.text-link-regata{
		position:absolute; 
		width:100%; 
		background:rgba(255,255,255,0.95);  
		top:0; 
		left:0; 
		visibility:hidden;
		overflow-y:hidden;
		transition: all 1s ease;
	}
	
	.colLeft{flex:1; transition: all 1s ease}
	.colRight{flex:1; transition: all 1s ease}
	
	.news-scroll-container {
		position: relative;
		height: 752px;
		overflow: hidden;
	  }
	  .news-scroll-wrapper {
		display: flex;
		flex-direction: column;
		transition: transform 0.6s ease;
	  }
	  .scroll-arrow-btn {
		width: 64px;
		height: 26px;
		opacity: 1;
		transition: opacity 0.3s ease;
		cursor: pointer;
	  }
	  .scroll-arrow-btn.disabled {
		opacity: 0.3;
		pointer-events: none;
	  }
	  .scroll-arrows-container {
		position: absolute;
		width: 105px;
		height:30px;
		left: 50%;
		transform:translateX(-50%);
		bottom: 30px;
		display: flex;
		gap: 20px;
		justify-content: space-between;
		align-items: center;
	  }
	  
	  
	  
	  .news-hero-container {
		  width: 100%;
		  height: calc(100vh - 37px - 290px);
		  position: relative;
		  overflow: hidden;
		  cursor:pointer;
		}
		.news-hero-container2 {
			height: auto !important
		}
		.news-hero-container3 {
			height: auto !important
		}
	  
		.news-hero-content {
		  position: absolute;
		  left: 40px;
		  bottom: 40px;
		  width: 75%;
		  color: #fff;
		}
		.news-hero-date {
		  border: solid 1px #fff;
		  font-size: 12px;
		  width: 80px;
		  text-align: center;
		  border-radius: 12px;
		  padding: 2px 6px;
		  margin-bottom: 8px;
		}
		.news-hero-title {
		  font-size: 20px;
		  margin-bottom: 0px;
		  transition: transform 0.3s ease, text-shadow 0.3s ease;
		  transform-origin: left center;
		}
		
		.news-hero-container:hover .news-hero-title {
		  transform: scale(1.03);
		  text-shadow: 0 0 1px #000;
		}
		
		.news-hero-container:hover .news-hero-title-w {
		  transform: scale(1.05);
		  text-shadow: 0 0 1.5px #fff;
		}
		.news-hero-text {
		  font-size: 12px;
		}
		
	    .news-scroll-container {
		  position: relative;
		  overflow: hidden;
		  height: 2 * 300px; /* altezza per due righe visibili (adatta alla tua grafica) */
		}

		.news-scroll-wrapper {
		  display: flex;
		  flex-direction: column;
		  transition: transform 0.6s ease;
		}

		.news-row {
		  display: flex;
		  gap: 24px;
		}

		.news-item {
		  flex: calc(33.33% - 24px);
		  max-width: calc(33.33% - 24px);
		  opacity: 0;
		  transform: translateY(407px);
		  transition: opacity 0.6s ease, transform 0.6s ease;
		}

		.news-item.visible {
		  opacity: 1 !important;
		  //transform: translateY(0) !important;
		}

		.box-img-news {
		  width: 100%;
		  height: 180px;
		  overflow: hidden;
		  position: relative;
		}

		.news-hero-date {
		  margin-top: 10px;
		  font-size: 12px;
		}

		.news-hero-title {
		  color: #000;
		  margin-top: 5px;
		}

		/* ✅ Sfalsamento */
		.news-row .news-item:nth-child(1) .box-img-news,
		.news-row .news-item:nth-child(3) .box-img-news {
		  margin-top: 60px;
		}

		/* ✅ Animazioni uscita */
		.news-item.slide-up-out {
		  opacity: 0;
		  transform: translateY(-30px);
		}

		.news-item.slide-down-out {
		  opacity: 0;
		  transform: translateY(30px);
		}

		/* ✅ Animazioni entrata */
		.news-item.slide-up-in {
		  opacity: 1;
		  //transform: translateY(0);
		}

		.news-item.slide-down-in {
		  opacity: 1;
		 // transform: translateY(0);
		}

		/* ✅ Frecce */
		.scroll-arrows-container {
		  position: absolute;
		  bottom: 30px;
		  left: 50%;
		  transform: translateX(-50%);
		  display: flex;
		  gap: 20px;
		}

		.scroll-arrow-btn.disabled {
		  opacity: 0.3;
		  pointer-events: none;
		}
		
		.masonry {
		  position:relative;
		  width:100%;
		  height:600px;
		}

		.item {
		  position:absolute;	
		  background: #ccc;
		  display: flex;
		  align-items: center;
		  justify-content: center;
		  font-size: 18px;
		  font-weight: bold;
		  color: #333;
		}
		
		.gallery-overlay {
		  position: absolute;
		  top: 0;
		  left: 0;
		  height: 100%;
		  width: 150%; /* 1.5 volte la larghezza della gallery */
		  background: linear-gradient(
			to right,
			rgba(255, 255, 255, 1) 0%,
			rgba(255, 255, 255, 1) 70%,
			rgba(255, 255, 255, 0) 100%
		  );
		  z-index: 10; /* sopra le immagini */
		  transform: translateX(0);
		  transition: transform 3.5s ease;
		}

		
		/* Larghezze */
		.w591 {width: 591px; }
		.w285 { width: 285px; }
		.w182 {width: 182px; }

		/* Altezze basate sull'unità di 20px (grid-auto-rows) */
		.h182 {height:182px; }
		.h385 {height:385px; }
		
		.gprev.gbtn, .gnext.gbtn{
			border-radius:25px !important;
		}
		.glightbox-clean .gprev, .glightbox-clean .gnext{
			width:50px !important;
			background:#fff !important;
			transition: all 0.3s ease;
		}
		.glightbox-clean .gprev:hover, .glightbox-clean .gnext:hover{
			background:var(--azzurro) !important;
		}
		.glightbox-clean .gclose path, .glightbox-clean .gprev path, .glightbox-clean .gnext path{
			 fill: var(--azzurro) !important;
			 transition: all 0.3s ease;
		}
		.glightbox-clean .gprev:hover path, .glightbox-clean .gnext:hover path{
			 fill: white !important;
		}
		.glightbox-clean .gclose {
			width:75px!important;
			height:75px!important;
			opacity:1 !important;
			border-radius:0 !important;
			background:#fff!important;
			transition: all 0.3s ease;			
		}
		.glightbox-clean .gclose svg {
			transform:scale(2,2) !important;
		}
		
		.slider-nav-wrapper {
		  position:absolute;
		  bottom:-50px;
		  width:126px;
		  left:50%; 
		  transform:translateX(-50%);
		  display: flex;
		  justify-content: space-between;
		  gap: 20px;
		}
		.nav-arrow-button {
		  background: transparent;
		  border: none;
		  cursor: pointer;
		  padding: 5px;
		}
				
		.nav-arrow-button img {
		  width: 43px;
		  height: 43px;
		  transform: rotate(90deg); /* Rotazione iniziale */
		  transition: transform 0.3s ease, opacity 0.3s ease, filter 0.3s ease;
		}

		.nav-arrow-button.disabled img {
		  opacity: 0.3;
		  pointer-events: none;
		}
		
		.scroll_equipaggio{
			height:calc(100vh - 260px) !important; 
			overflow-y:scroll;
		}
		.scroll_equipaggio {
			overflow-y: scroll;
			scrollbar-width: none;      /* Firefox */
			-ms-overflow-style: none;   /* IE 10+ */
		}
		.scroll_equipaggio::-webkit-scrollbar {
			display: none;              /* Chrome, Safari */
		}
		
		#regataCrew{
			opacity:1;
			transition: all 1s ease;
		}	
		#regataForm{
			opacity:0;
			transition: all 1s ease;
		}	
		
		#boxContattiLeft, #boxContattiRight{
			transform:translateY(300px);
			opacity:0;
			visibility:hidden;
			transition:all 1s ease;
		}
		#boxContattiLeft.active, #boxContattiRight.active{
			transform:translateY(0px);
			opacity:1;
			visibility:visible;
		}

	@media screen and (max-width: 1450px) {
		.slide-content-overlay {
			width:60%;
		}
	}
	@media screen and (max-width: 1200px) {
		.slide-content-overlay {
			width:75%;
		}
	}
	@media screen and (max-width: 1024px) {
		.slide-content-overlay {
			width:75%;
			left:10%;
		}
		.slide-content-overlay h1 {
			font-size: 48px;
		}
		.slide-content-overlay h3 {
			font-size: 24px;
		}
		.slide-content-overlay .slide-date {
			font-size: 12px;
		}
		.link-regata{
			width:calc(100% - 40px);
		}
		.link-regata:hover {
			width:calc(100% - 10px) !important;
		}
	}
	@media screen and (max-width: 800px) {
		.slide-content-overlay {
			width:90%;
			left:5%;
		}
		.slide-content-overlay h1 {
			font-size: 42px;
		}
		.slide-content-overlay h3 {
			font-size: 20px;
			line-height: 1;
		}
		.slide-content-overlay .slide-date {
			font-size: 12px;
		}

		.page-container {
			width: calc(100% - 120px);
			margin-left:60px;
		}
		.link-regata{
			width:calc(100% - 60px);
			margin-left:20px;
		}
		.link-regata:hover {
			width:calc(100% - 20px) !important;
		}
	}
	@media screen and (max-width: 600px) {
		.page-container {
			width: calc(100% - 40px);
			margin-left:20px;
		}	
		.row-doc h4{
			line-height: 1;
			font-size: 32px;
		}	
		.colRight h4{
			line-height: 1;
			font-size: 32px;
		}
	}
</style>