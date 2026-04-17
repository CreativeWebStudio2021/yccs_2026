<style>
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
	.news-hero-image {
	  width: 100%;
	  height: 100%;
	  object-fit: cover;
	  transition: transform 0.9s ease;
	  transform-origin: center center;
	}

	.news-hero-container:hover .news-hero-image {
	  transform: scale(1.15);
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
	  width: 72px;
	  text-align: center;
	  border-radius: 12px;
	  padding: 2px 6px;
	  margin-bottom: 8px;
	}
	.news-hero-title {
	  font-size: 20px;
	  margin-bottom: 10px;
      transition: transform 0.3s ease, text-shadow 0.3s ease;
	  transform-origin: left center;
	}

	/* Hero titolo: 3 righe con ellissi, da 1400px 2 righe */
	.news-hero-content .news-hero-title {
	  display: -webkit-box;
	  -webkit-box-orient: vertical; /* necessario per line-clamp, non rimuovere */
	  overflow: hidden;
	  text-overflow: ellipsis;
	  -webkit-line-clamp: 3;
	  line-height: 1.3;
	  max-height: 3.9em; /* 3 righe × 1.3 */
	}

	/* Card news lista: stesso comportamento titolo + testo */
	.news-hero-container2 .news-hero-title {
	  display: -webkit-box;
	  -webkit-box-orient: vertical; /* necessario per line-clamp, non rimuovere */
	  overflow: hidden;
	  text-overflow: ellipsis;
	  -webkit-line-clamp: 3;
	  line-height: 1.3;
	  max-height: 3.9em;
	}

	.news-scroll-container {
	  position: relative;
	  height: 752px;
	  overflow: hidden;
	}
	.news-scroll-wrapper {
	  display: flex;
	  flex-direction: column;
	  gap: 29px;
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
	  
	  width: 100%;
	  height: 46px;
	  display: flex;
	  gap: 29px;
	  justify-content: center;
	  align-items: flex-start;
	  padding-top: 20px;
	}

	@media screen and (max-width: 1400px) {
	   .news-scroll-wrapper {
			gap: 5px;
		}
	  .news-hero-content .news-hero-title {
	    -webkit-line-clamp: 2;
	    max-height: 2.6em; /* 2 righe × 1.3 */
	  }
	  .news-hero-content .news-hero-text {
	    display: none;
	  }
	  .news-hero-container2 .news-hero-title {
	    -webkit-line-clamp: 2;
	    max-height: 2.6em;
	  }
	  .news-hero-container2 .news-hero-text {
	    display: none;
	  }
	}

	@media screen and (max-width: 500px) {
	  .news-hero-title {
	    font-size: 14px;
		line-height: 1;
	  }
	  .news-hero-container2 > div:first-child {
	    aspect-ratio: 1 / 1;
	    height: auto !important;
	  }
	  .news-hero-container2 > div:first-child .news-hero-image {
	    object-fit: cover;
	    object-position: center;
	  }
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


  
  .news-item-left, .news-item-right {
	  transform: translateY(380px);
	  transition: transform 1s ease;
	}

	.news-item-visible {
	  transform: translateY(0);
	}
  
  .news-scroll-wrapper.animate .news-item-left,
	.news-scroll-wrapper.animate .news-item-right {
	  opacity: 0;
	  transform: translateY(20px);
	  transition: all 0.6s ease-out;
	}

	.news-scroll-wrapper.animate .news-item-left.visible {
	  opacity: 1;
	  transform: translateY(0);
	  transition-delay: 0.1s;
	}

	.news-scroll-wrapper.animate .news-item-right.visible {
	  opacity: 1;
	  transform: translateY(0);
	  transition-delay: 0.3s;
	}

</style>