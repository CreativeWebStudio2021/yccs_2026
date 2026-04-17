@extends('web.index')

@section('content')
	@php		
		$video_background = "web/video/blue-sea.mp4";
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='YCCS Porto Cervo'; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	@include('web.assets.la_storia_css')

	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-1"></div>
				<div class="content col-lg-8">	
					<style>
						.iframe-wrapper {
						  position: relative;
						  width: 100%;
						  padding-top: 56.25%; /* 16:9 default */
						  overflow: hidden;
						}

						.fade-out {
						  opacity: 0 !important;
						}

						@media (max-width: 1700px) {
						  .allerte-responsive {
							padding-top: 40vw !important;
						  }
						}
						@media (max-width: 1024px) {
						  .allerte-responsive {
							padding-top: 60vw !important;
						  }
						}
						@media (max-width: 768px) {
						  .allerte-responsive {
							padding-top: 80% !important;
						  }
						}

						@media (max-width: 580px) {
						  .allerte-responsive {
							padding-top: 100% !important;
						  }
						}

						@media (max-width: 480px) {
						  .allerte-responsive {
							padding-top: 200vw !important;
						  }
						}
					</style>
					<div id="iframeContainer" class="iframe-wrapper allerte-responsive">
						<iframe 
							id="meteomedFrame" 
							style="
								position: absolute;
								  top: 0;
								  left: 0;
								  width: 100%;
								  height: 100%;
								  border: none;
								  opacity: 1;
								  transition: opacity 1s ease-in-out;
							" 
							src="https://www.meteomed.it/marine/index.php?akey=yccs"  
							allowfullscreen>
						</iframe>
						<div style="position:absolute; width:100%; height:15px; background:#fff; bottom:0; z-index:2">
						  <div id="progressBar" style="height:100%; width:0; background:#2196F3; transition: width linear;"></div>
						</div>

					</div>
					
					<script>
						const iframe = document.getElementById("meteomedFrame");
						const container = document.getElementById("iframeContainer");
						const progressBar = document.getElementById("progressBar");


						// Tutti gli URL con il tempo di visualizzazione in millisecondi
						const pages = [
						  { url: "https://www.meteomed.it/marine/landing.php?akey=yccs", duration: 5000 },
						  { url: "https://www.meteomed.it/marine/allerte.php?akey=yccs", duration: 5000 },
						  { url: "https://www.meteomed.it/marine/sat.php?akey=yccs", duration: 20000 },
						  { url: "https://www.meteomed.it/marine/vento.php?akey=yccs", duration: 40000 },
						  { url: "https://www.meteomed.it/marine/mare.php?akey=yccs", duration: 40000 }
						];

						let currentIndex = 0;
						let firstRun = true;

						function changeSlide() {
						  // Determina prossimo URL
						  if (!firstRun && currentIndex === 0) {
							currentIndex = 0; // salta index.php dal secondo giro
						  }

						  const { url, duration } = pages[currentIndex];

						  // fade out
						  iframe.classList.add("fade-out");

						  setTimeout(() => {
							iframe.src = url;

							// Adatta altezza per allerte.php
							if (url.includes("allerte.php")) {
							  container.classList.add("allerte-responsive");
							} else {
							  container.classList.remove("allerte-responsive");
							}

							// fade in
							iframe.onload = () => {
							  iframe.classList.remove("fade-out");
							};

							// Prepara prossimo ciclo
							currentIndex = (currentIndex + 1) % pages.length;
							if (currentIndex === 0) firstRun = false;
							
							// Reset & animate progress bar
							progressBar.style.transition = "none";
							progressBar.style.width = "0%";

							// Trigger reflow per riavviare l'animazione
							void progressBar.offsetWidth;

							progressBar.style.transition = `width ${duration}ms linear`;
							progressBar.style.width = "100%";

							setTimeout(changeSlide, duration);
						  }, 1000); // tempo per effetto fade-out
						}

						// Partenza dopo N secondi
						setTimeout(changeSlide, pages[0].duration);
					</script>

					<div style="margin-top:30px;">
						<h2>Live Webcam</h2>
						<div class="col-md-12">							
							<a href="il-meteo-livewebcam.html" target="_blank">
								<img src="http://www.yccsfiles.com/webcam/livecamportocervo.jpg" style="width:100%" class="img-responsive img-rounded" alt="Live Webcam" id="webcam">
							</a> 
						</div>
						<div style="clear:both"></div>
						<script type="text/javascript">
							var cont=0;
							function update_webcam(){
								document.getElementById('webcam').src='http://www.yccsfiles.com/webcam/livecamportocervo.jpg?time='+cont;
								cont++;
								window.setTimeout('update_webcam()' , 36000);
							}
							window.setTimeout('update_webcam()' , 5000);
						</script>
					</div>
				</div>
				<div class="content col-lg-1"></div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-2" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-9">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-3"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
			
@endsection