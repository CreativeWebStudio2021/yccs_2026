@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.il club'); $breadcrumbs[$x]['link']='';
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	
	<div style="position:relative;">
		<!-- PAGE TITLE -->
		<section class="no-padding" style="height:400px;" id="mapDisplayVG">
			<!-- Google map sensor -->
		</section>	
		
		<div style="position:absolute; width:100%; height:100%; top:0; left:0;">
			<section class="no-padding" id="mapDisplayYccs" style=" width:100%; height:100%;">
				<div id="map"></div>
				<script>
				  var map;
				  function initMap() {
					map = new google.maps.Map(document.getElementById('mapDisplayYccs'), {
					  zoom: 16,
					  center: new google.maps.LatLng(41.1358357,9.5293227),
					  mapTypeId: 'roadmap'
					});

					var iconBase = 'https://www.yccs.it/';
					var icons = {				 
					  info: {
						icon: iconBase + 'images/markers/marker1.png'
					  }
					};

					var features = [
					  {
						position: new google.maps.LatLng(41.1358357,9.5293227),
						type: 'info'
					  }
					];

					// Create markers.
					features.forEach(function(feature) {
					  var marker = new google.maps.Marker({
						position: feature.position,
						icon: icons[feature.type].icon,
						map: map
					  });
					});
				  }
				</script>
			</section>
			
		</div>
		<!-- END: PAGE TITLE -->
		<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEZDccllBqRLf9KNn5C64HoNE3UuZtXiI&callback=initMap">
		</script>
	</div>
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right" style="">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-2"></div>
				<div class="content col-lg-6">
					<h3 class="text-uppercase"><?php if($lingua=="ita"){?>Contatti<?php }else{?>Contacts<?php }?></h3>
					<div class="row" style="border:solid 1px #DDDDDD; padding:30px 20px">
						<div class="col-md-4">	
							<address>
								<strong>Yacht Club Costa Smeralda</strong><br>
								Via della Marina<br>
								07021 Porto Cervo (OT)<br>
								Italia<br><br>
								<abbr title="Phone">Tel:</abbr> +39 0789 902 200<br>
								<?php /*<abbr title="Fax">Fax:</abbr> +39 0789 91257 / 91213*/?>
								<br><br>
								<abbr title="<?php if($lingua=="ita"){?>Coordinate<?php }else{?>Coordinates<?php }?>"><?php if($lingua=="ita"){?>Coordinate<?php }else{?>Coordinates<?php }?>:</abbr> <br/>
								
								41&ordm; 8' 9.0085'' N<br/>
								9&ordm; 31' 45.5617'' E
							</address>
						</div>
						<div class="col-md-4">	
							<i style="font-family:'Open Sans' !important; font-style:italic !important;"><?php if($lingua=="ita"){?>Segreteria Soci<?php }else{?>Members Secretariat<?php }?></i><br />
							<abbr title="Phone">Tel:</abbr> +39 0789 902205<br />
							<?php /*<abbr title="Fax">Fax:</abbr> +39 0789 91257<br />*/?>
							<abbr title="Email">Email:</abbr> <span id="cloak95862">Questo indirizzo email è protetto dagli spambots. È necessario abilitare JavaScript per vederlo.</span>
							<script type='text/javascript'>
								//<!--
								document.getElementById('cloak95862').innerHTML = '';
								var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
								var path = 'hr' + 'ef' + '=';
								var addy95862 = 'm&#101;mb&#101;rs' + '&#64;';
								addy95862 = addy95862 + 'yccs' + '&#46;' + '&#105;t';
								var addy_text95862 = 'm&#101;mb&#101;rs' + '&#64;' + 'yccs' + '&#46;' + '&#105;t';
								document.getElementById('cloak95862').innerHTML += '<a ' + path + '\'' + prefix + ':' + addy95862 + '\'>'+addy_text95862+'<\/a>';
								//-->
							</script>
							<br><br>
							
							<i style="font-family:'Open Sans' !important; font-style:italic !important;"><?php if($lingua=="ita"){?>Segreteria Regate<?php }else{?>Race Office<?php }?></i><br />
							<abbr title="Phone">Tel:</abbr> +39 0789 902237<br />
							<?php /*<abbr title="Fax">Fax:</abbr> +39 0789 91213<br />*/?>
							<abbr title="Email">Email:</abbr> <span id="cloak72967">Questo indirizzo email è protetto dagli spambots. È necessario abilitare JavaScript per vederlo.</span>
							<script type='text/javascript'>
								 //<!--
								 document.getElementById('cloak72967').innerHTML = '';
								 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
								 var path = 'hr' + 'ef' + '=';
								 var addy72967 = 's&#101;cr&#101;t&#97;r&#105;&#97;t' + '&#64;';
								 addy72967 = addy72967 + 'yccs' + '&#46;' + '&#105;t';
								 var addy_text72967 = 's&#101;cr&#101;t&#97;r&#105;&#97;t' + '&#64;' + 'yccs' + '&#46;' + '&#105;t';
								 document.getElementById('cloak72967').innerHTML += '<a ' + path + '\'' + prefix + ':' + addy72967 + '\'>'+addy_text72967+'<\/a>';
								 //-->
							 </script>
							 <br /> <br />
							 
							<i style="font-family:'Open Sans' !important; font-style:italic !important;"><?php if($lingua=="ita"){?>Marketing e Eventi<?php }else{?>Marketing and Events<?php }?></i><br />
							<abbr title="Phone">Tel:</abbr> +39 0789 902215<br />
							<?php /*<abbr title="Fax">Fax:</abbr> +39 0789 91257<br />*/?>
							<abbr title="Email">Email:</abbr> <a href="mailto:events@yccs.it">events@yccs.it</a><?php /*<span id="cloak38204">Questo indirizzo email è protetto dagli spambots. È necessario abilitare JavaScript per vederlo.</span>*/?>
							 <br /> <br />
							 
							<i style="font-family:'Open Sans' !important; font-style:italic !important;"><?php if($lingua=="ita"){?>Ufficio Stampa<?php }else{?>Press Office<?php }?></i><br />
							<abbr title="Phone">Tel:</abbr> +39 0789 902223 <br />
							<?php /*<abbr title="Fax">Fax:</abbr> +39 0789 91213 <br />*/?>
							<abbr title="Email">Email:</abbr> <span id="cloak58474">Questo indirizzo email è protetto dagli spambots. È necessario abilitare JavaScript per vederlo.</span>
							<script type='text/javascript'>
								 //<!--
								 document.getElementById('cloak58474').innerHTML = '';
								 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
								 var path = 'hr' + 'ef' + '=';
								 var addy58474 = 'pr&#101;ss&#111;ff&#105;c&#101;' + '&#64;';
								 addy58474 = addy58474 + 'yccs' + '&#46;' + '&#105;t';
								 var addy_text58474 = 'pr&#101;ss&#111;ff&#105;c&#101;' + '&#64;' + 'yccs' + '&#46;' + '&#105;t';
								 document.getElementById('cloak58474').innerHTML += '<a ' + path + '\'' + prefix + ':' + addy58474 + '\'>'+addy_text58474+'<\/a>';
								 //-->
							</script>
						</div>
						<div class="col-md-4">	
							<i style="font-family:'Open Sans' !important; font-style:italic !important;">Reception</i><br />
							<abbr title="Phone">Tel:</abbr> +39 0789 902200<br />
							<?php /*<abbr title="Fax">Fax:</abbr> +39 0789 973280<br />*/?>
							<abbr title="Email">Email:</abbr> <span id="cloak11390">Questo indirizzo email è protetto dagli spambots. È necessario abilitare JavaScript per vederlo.</span>
							<script type='text/javascript'>
									 //<!--
									 document.getElementById('cloak11390').innerHTML = '';
									 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
									 var path = 'hr' + 'ef' + '=';
									 var addy11390 = 'r&#101;c&#101;pt&#105;&#111;n' + '&#64;';
									 addy11390 = addy11390 + 'yccs' + '&#46;' + '&#105;t';
									 var addy_text11390 = 'r&#101;c&#101;pt&#105;&#111;n' + '&#64;' + 'yccs' + '&#46;' + '&#105;t';
									 document.getElementById('cloak11390').innerHTML += '<a ' + path + '\'' + prefix + ':' + addy11390 + '\'>'+addy_text11390+'<\/a>';
									 //-->
							 </script>
							 <br /> <br />
							 
							<i style="font-family:'Open Sans' !important; font-style:italic !important;"><?php if($lingua=="ita"){?>Amministrazione<?php }else{?>Administration Office<?php }?></i><br />
							<abbr title="Phone">Tel:</abbr> +39 0789 902222 <br />
							<?php /*<abbr title="Fax">Fax:</abbr> +39 0789 957033 <br />*/?>
							<abbr title="Email">Email:</abbr> <span id="cloak31035">Questo indirizzo email è protetto dagli spambots. È necessario abilitare JavaScript per vederlo.</span>
							<script type='text/javascript'>
								 //<!--
								 document.getElementById('cloak31035').innerHTML = '';
								 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
								 var path = 'hr' + 'ef' + '=';
								 var addy31035 = '&#97;mm&#105;n&#105;str&#97;z&#105;&#111;n&#101;' + '&#64;';
								 addy31035 = addy31035 + 'yccs' + '&#46;' + '&#105;t';
								 var addy_text31035 = '&#97;mm&#105;n&#105;str&#97;z&#105;&#111;n&#101;' + '&#64;' + 'yccs' + '&#46;' + '&#105;t';
								 document.getElementById('cloak31035').innerHTML += '<a ' + path + '\'' + prefix + ':' + addy31035 + '\'>'+addy_text31035+'<\/a>';
								 //-->
							 </script>
							<br><br>
								
							<i style="font-family:'Open Sans' !important; font-style:italic !important;"><?php if($lingua=="ita"){?>Centro Sportivo<?php }else{?>Sports Center<?php }?></i><br />
							<?php /*<abbr title="Phone">Tel:</abbr> +39 0789 1931000<br />
							<abbr title="Fax">Fax:</abbr> +39 0789 1931001<br />*/?>
							<abbr title="Email">Email:</abbr> <span id="cloak83698">Questo indirizzo email è protetto dagli spambots. È necessario abilitare JavaScript per vederlo.</span>
							<script type='text/javascript'>
								 //<!--
								 document.getElementById('cloak83698').innerHTML = '';
								 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
								 var path = 'hr' + 'ef' + '=';
								 var addy83698 = 'c&#101;ntr&#111;sp&#111;rt&#105;v&#111;' + '&#64;';
								 addy83698 = addy83698 + 'yccs' + '&#46;' + '&#105;t';
								 var addy_text83698 = 'c&#101;ntr&#111;sp&#111;rt&#105;v&#111;' + '&#64;' + 'yccs' + '&#46;' + '&#105;t';
								 document.getElementById('cloak83698').innerHTML += '<a ' + path + '\'' + prefix + ':' + addy83698 + '\'>'+addy_text83698+'<\/a>';
								 //-->
							</script>
						</div>
					</div>
				</div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-4" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-7">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-5"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection