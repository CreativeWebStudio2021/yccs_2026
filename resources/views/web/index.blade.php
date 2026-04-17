@php
	if($cmd=="404"){
		header("HTTP/1.0 404 Not Found");
	}
@endphp
<!DOCTYPE html>
<html class="no-js" lang="{{ $lingua }}">
<head>
	@include('web.common.meta')
	@include('web.common.favicon')
	@include('web.common.scripts.analytics')
	@if($cmd!="registrazione")
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	@else
		<script src="https://challenges.cloudflare.com/turnstile/v0/api.js?compat=recaptcha" async defer></script>		
	@endif
	
	<style>
		.inspiro-slider .slide .slide-captions h1{font-size:65px; line-height:60px}
		@media screen AND (max-width:800px){
			.inspiro-slider .slide .slide-captions h1{font-size:8vw; line-height:7vw}
			.inspiro-slider .slide .slide-captions h2{font-size:5vw; line-height:4vw}
			.inspiro-slider .slide .slide-captions h3{font-size:4vw; line-height:3vw}
		}
	</style>

	@if($lingua=="ita")
		<script type="text/javascript">
		var _iub = _iub || [];
		_iub.csConfiguration = {"consentOnContinuedBrowsing":false,"invalidateConsentWithoutLog":true,"siteId":2492859,"whitelabel":false,"cookiePolicyId":25678502,"lang":"it", "banner":{ "acceptButtonCaptionColor":"white","acceptButtonColor":"#00aeef","acceptButtonDisplay":true,"backgroundColor":"#808080","closeButtonRejects":true,"customizeButtonCaptionColor":"white","customizeButtonColor":"#212121","customizeButtonDisplay":true,"explicitWithdrawal":true,"position":"bottom","textColor":"white" }};
		</script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
	@else
		<script type="text/javascript">
		var _iub = _iub || [];
		_iub.csConfiguration = {"consentOnContinuedBrowsing":false,"invalidateConsentWithoutLog":true,"siteId":2492859,"whitelabel":false,"cookiePolicyId":80257802,"lang":"en-GB", "banner":{ "acceptButtonCaptionColor":"white","acceptButtonColor":"#00aeef","acceptButtonDisplay":true,"backgroundColor":"#808080","closeButtonRejects":true,"customizeButtonCaptionColor":"white","customizeButtonColor":"#212121","customizeButtonDisplay":true,"explicitWithdrawal":true,"position":"bottom","textColor":"white" }};
		</script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
	@endif
		
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-40605968-36"></script>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-4499527-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-40605968-36');
		gtag('config', 'UA-4499527-1');
	</script>
</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">
		<!-- Header -->				
		@include('web.common.header')			
		<!-- end: Header -->    

		@yield('content')
		
		<!-- Footer content -->
		@include('web.common.footer')
		<!-- End Footer content -->
	</div>      
	
	<!-- Scroll top -->
    <a id="scrollTop"><i class="fa fa-chevron-up" aria-hidden="true"></i><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
	
	
	<!-- Include js plugin -->
	@include('web.common.scripts')	
</body>
</html>
