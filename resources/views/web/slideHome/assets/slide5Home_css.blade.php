<style>
	.slide5Home {
	  position: relative;
	  width: 100vw;
	  height: 100vh;
	  overflow: hidden;
	}

	#sez1{
		position:relative;
		width:100%;
		height:calc(100vh - 140px);
	}
	#sez2{
		width:100%;
		height: 140px;
	}
	
	/* ---- Barca Vintage ---- */
	.barca-vintage {
	  position: absolute;
	  bottom: 35px;
	  left: calc(50% + 100px);
	  aspect-ratio: 427 / 719;
	  height: calc(100% - 175px);
	  width: auto;
	  object-fit: cover;

	  transform: translateX(300px); /* parte fuori a destra */
	  transition: transform 1.2s ease;
	}

	.barca-vintage.animate-in {
	  transform: translateX(0); /* entra in posizione */
	}

	/* ---- Blocchi Testuali ---- */
	.text-block {
	  transform: translateX(-300px); /* posizione di partenza generica */
	  transition: transform 1.2s ease;
	}

	.text-block.animate-in {
	  transform: translateX(0) !important; /* entra in posizione finale */
	}

	/* Distanze diverse in entrata */
	.text-block.top {
	  transform: translateX(-450px); /* più lontano */
	  transition-duration: 1.4s; /* più tempo */
	  position:absolute;
	  top:155px;
	  left:50px;
	  width:550px;
	  height:120px;
	  padding:10px 10px 0;
	  background:rgba(255,255,255,0.5);
	}
	.text-block.middle {
	  transform: translateX(-350px);
	  transition-duration: 1.3s;
	  position:absolute;
	  top:290px;
	  left:90px;
	  width:550px;
	  height:120px;
	  padding:10px 10px 0;
	  background:rgba(255,255,255,0.5);
	}
	.text-block.bottom {
	  transform: translateX(-200px); /* più vicino */
	  transition-duration: 1.1s;
	  position:absolute;
	  top:430px;
	  left:130px;
	  width:550px;
	  height:120px;
	  padding:10px 10px 0;
	  background:rgba(255,255,255,0.5);
	}

	.logo-yccs-Home5 {
		width:400px;
	}
 @media screen and (max-width:1200px) {
	.text-block.top {
		left:20px;
	}
	.text-block.middle {
		left:60px;
	}
	.text-block.bottom {
		left:90px;
	}

	.barca-vintage {	
	  left: auto;
	  right:50px;
	}
}
@media screen and (max-width:1024px) {
	#sez1{
		height:100vh;
	}
	.text-block.top {		
		height:140px;
		left:20px;
		width:350px;
		top:155px;
	}
	.text-block.middle {
		height:160px;
		top:315px;
		left:40px;
		width:350px;
	}
	.text-block.bottom {
		height:140px;
		top:495px;
		left:60px;
		width:350px;
	}
}
@media screen and (max-width:500px) {
	#sez1{
		height:calc(100vh + 50px);
	}
	.slide5-text-blocks-wrap {
		position: absolute;
		top: 155px;
		left: 2%;
		width: 90%;
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
	.slide5-text-blocks-wrap .text-block {
		position: static;
		height: auto;
		padding-bottom: 10px;
		left: auto;
		width: 100%;
	}
	.barca-vintage {	
		left: auto;
		right: 0px;
		height: calc(100% - 280px);
	}
	.logo-yccs-Home5 {
		width:80vw;
		margin:0 auto;
	}
}
</style>