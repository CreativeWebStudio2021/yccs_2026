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
	
		@keyframes slideInFromRight {
		from {
			transform: translateX(100%);
			opacity: 0;
		}
		to {
			transform: translateX(0);
			opacity: 1;
		}
	}

	@keyframes fadeIn {
		from {
			opacity: 0;
		}
		to {
			opacity: 1;
		}
	}

	.slide-in-right {
		animation: slideInFromRight 1.5s ease-out forwards;
	}

	.fade-in {
		animation: fadeIn 1.5s ease-out forwards;
	}

	.year-group-animate {
		opacity: 0;
		transform: translateX(-400px);
		transition: opacity 1.2s ease, transform 1.2s ease;
		/*will-change: opacity, transform;*/
	}
	.year-group-animate.visible {
		opacity: 1;
		transform: translateX(0);
	}
	.pallino-anno {
		background: #009fe3;
		width:15px; 
		height:15px;
		border-radius:50%;
	}
	
	.year-label{
		font-size:22px;
		cursor:pointer;
	}
	.year-label.selected{
		font-weight:600;
	}
	.anno-container{
		height:50px; 
		width:50px; 
		margin:0; 
		padding:0 75px; 
		display:flex; 
		flex-direction:column; 
		align-items:center; 
		gap:5px;
		position:relative;
		transform:translateX(-1000px);
		opacity:0;
		transition: all 1s ease;
	}
	.anno-container.visible{
		transform:translateX(0px);
		opacity:1;
	}
	
	.bigAnno{
		font-family: Arial;
		font-size: 160px; 
		font-weight: 900; 
		color: #ffffff; /* fallback */
		-webkit-text-stroke: 1px #D9D9D9;
		-webkit-text-fill-color: transparent;
		line-height:1;
	}
	.cursor-anno{
		position:absolute; 
		width:55px ;
		padding:3.5px 8px; 
		display:flex; 
		gap:24px; 
		top:-10px; 
		right:460px; 
		align-items:center; 
		justify-content:space-between; 
		background:var(--azzurro); 
		border-radius:10px;
		transform:translateX(-1000px);
		opacity:0;
		transition: all 1s ease;
	}
	.cursor-anno.visible{
		transform:translateX(0px);
		opacity:1;
	}
	
	.colLeft, .regata{
		transform:translateY(400px);
		opacity:0;
		transition: all 1s ease;
	}
	.colLeft.visible, .regata.visible{
		transform:translateY(0px);
		opacity:1;
	}
	.regata.upShow{
		transform:translateY(-454px);
		opacity:1;
	}
	.regata.up{
		transform:translateY(-454px);
		opacity:0;
	}
	.regata.downShow{
		transform:translateY(0px);
		opacity:1;
	}
	.regata.down{
		transform:translateY(0px);
		opacity:0;
	}
	#listaRegateFoto1, #listaRegateFoto2{
		position:absolute; 
		width:100%; 
		height:100%; 
		top:100%; 
		left:0; 
		opacity:0;
		visibility:hidden;
		display:flex; 
		gap:20px; 
		transition: all 1s ease;
	}

	/* Sotto 800px: lista regate foto in unica colonna full width, tutte visibili senza script scorrimento, fade-in slide-up al scroll */
	@media screen and (max-width: 800px) {
		#listaRegateFoto {
			position: relative;
			min-height: 0;
		}
		#listaRegateFoto1 {
			position: relative;
			top: 0;
			left: 0;
			opacity: 1;
			visibility: visible;
			display: flex;
			flex-direction: column;
			flex-wrap: wrap;
			gap: 20px;
			align-items: stretch;
		}
		#listaRegateFoto1 .colRegLeft,
		#listaRegateFoto1 .colRegRight {
			display: contents;
		}
		#listaRegateFoto1 .regata {
			visibility: visible !important;
			width: 100%;
			box-sizing: border-box;
			opacity: 0;
			transform: translateY(28px);
			transition: opacity 0.5s ease-out, transform 0.5s ease-out;
		}
		#listaRegateFoto1 .regata.regata-inview {
			opacity: 1;
			transform: translateY(0);
		}
		#bottone_calendario_regate {
			/*display: none;*/
			margin-top:20px;
		}
		.blocco-bottoni-1,
		.blocco-bottoni-2 {
			display: none !important;
		}
	}
	
	#boxRegate{
		transition: all 1s ease;
	}
	.boxRegateAnno{
		position:absolute; 
		width:100%; 
		transition: all 1s ease;
	}
	.boxRegateAnno.boxRegateAnno1{
		left:0; 
		top:0;
		opacity:1;
	}
	.boxRegateAnno.boxRegateAnno2{
		left:-100%;
		top:0;
		opacity:0;
	}
	.boxRegateAnno.boxRegateAnno3{
		left:0; 
		top:-300px;
		opacity:0;
	}
	
	.arrow-btn{
		transform:scale(1);
		transition:all 0.3s;
	}
	
	.arrow-btn:hover{
		transform:scale(1.1);
	}
	
	@media screen AND (max-width:1300px){
		.page-container{
			width:calc(100% - 120px) !important;
			margin:65px 60px 36px 60px !important;
		}
	}
	
	@media screen AND (max-width:1200px){
		.page-container{
			width:calc(100% - 30px) !important;
			margin:65px 0px 36px 0px !important;
			padding:0px 15px;
		}
	}
	
	@media screen AND (max-width:1050px){
		.bigAnno{
			font-size: 150px; 
		}
	}
	
	.listaRegateDesk{display:block}
	.listaRegateMob{display:none}
	.regataDesk{display:block}
	.regataMob{display:none}
	
	@media screen AND (max-width:1024px){
		.bigAnno{
			font-size: 14vw; 
		}
		.listaRegateDesk{display:none}
		.listaRegateMob{display:block}
	}
	@media screen AND (max-width:1024px){
		.bigAnno{
			font-size: 120px; 
		}
	}
	@media screen AND (max-width:799px){
		#listaRegate {
			gap:60px;
		}
		.regataDesk{display:none}
		.regataMob{display:block}
	}

	/* Blocco bottoni: nascosti inizialmente, appaiono in fade con ritardo dopo le immagini regate */
	.blocco-bottoni {
		opacity: 0;
		transition: opacity 0.5s ease;
		transition-delay: 0s;
		pointer-events: none;
	}
	.blocco-bottoni.blocco-bottoni-visible {
		opacity: 1;
		pointer-events: auto;
		transition-delay: 0.7s;
	}
</style>