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
	  width: 50%;
	  height: calc(100vh - 130px);
	  overflow: hidden;
	  background:#333;
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
	  opacity:0.8;
	}

	.slide-content-overlay {
	  position: absolute;
	  width:550px;
	  bottom: 100px;
	  left: 42px;
	  color: #fff;
	  z-index: 2;
	}
	.slide-content-overlay h2 {
	  font-size: 44px;
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
</style>