<style>
	.video-container {
		width: 50%;
		height:calc(100vh - 130px);
		position: relative;
		overflow: hidden;
	}

	.bg-video {
		position: absolute;
		top: 50%;
		left: 50%;
		min-width: 100%;
		min-height: 100%;
		width: auto;
		height: auto;
		transform: translate(-50%, -50%);
		object-fit: cover;
		z-index: 1;
	}
	
	.arrow-disabled {
		opacity: 0.3;
		pointer-events: none;
	}
	
	.regata-link {
		display: flex;
		gap: 5px;
		align-items: center;
		cursor: pointer;
	}

	.regata-link span {
		font-size: 12px;
		font-weight: 500;
		transition: font-weight 0.2s ease;
	}

	.regata-link:hover span {
		font-weight: 700;
	}

	.regata-link:hover .regata-icon {
		content: url("web/images/star_red.png");
	}
	
	.regata-icon{
		width:13px;
	}
	
	.border-animated {
		position: relative;
	}

	.border-animated::before {
		content: "";
		position: absolute;
		top: 0;
		right: 0;
		width: 100%;
		height: 1px;
		background-color: #000; /* stesso colore del border-top */
		transform: scaleX(0);
		transform-origin: right;
		transition: transform 1.2s ease-out;
	}

	.border-animated.visible::before {
		transform: scaleX(1);
	}

	.info-arrow {
		width: 29px;
		height: 42px;
		margin-top: 5px;
		margin-right: -10px;
		transition: transform 0.4s ease;
	}

	.info-link:hover .info-arrow {
		transform: translateX(15px);
	}
	
	.media-slider-container {
	  position: relative;
	  width: 100%;
	  height: 600px;
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
	  width:550px;
	  bottom: 60px;
	  left: 20px;
	  color: #fff;
	  z-index: 2;
	}
	
	.slide-content-color-overlay{
		position:absolute; width:100%; 
		height:100%; 
		background:rgba(0,0,0,0.2); 
		top:0; 
		left:0;
	}
	
	.slide-content-overlay h2 {
	  font-size: 44px;
	  font-weight:300;
	  margin: 0;
	}
	.slide-content-overlay h3 { font-size: 32px; margin: 10px 0 0; }
	.slide-content-overlay .slide-date { font-size: 15px; }

	.slide-info-link {
	  display: flex; justify-content: space-between;
	  align-items: center;
	  color: #fff; text-decoration: none;
	  margin-top: 10px;
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

	/* Pulsanti sotto slider */
	.slider-nav-wrapper {
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
	  width: 43px; height: 43px;
	  transition: transform 0.3s ease, opacity 0.3s ease;
	}
	.nav-arrow-button:hover img {
	  transform: scale(1.1);
	}

.regata-row-animate {
  opacity: 0;
  transform: translateY(120px);
  transition: opacity 1s ease, transform 1.1s ease;
  will-change: opacity, transform;
}
.regata-row-animate.visible {
  opacity: 1;
  transform: translateY(0);
}

.multi-column {
			  column-count: 2;
			  column-gap: 50px;
			  text-align: justify;
			}

			@media (max-width: 768px) {
			  .multi-column {
				column-count: 1;
			  }
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
			  font-size:25px;
			}

			.link-regata .arrow-link-regata {
			  width:30px; 
			  height:10px; 
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
</style>