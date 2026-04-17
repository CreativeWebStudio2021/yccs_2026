@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/ufficio_stampa.jpg";
		$page_title = "Links";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']="Links"; $breadcrumbs[$x]['link']=''; 
		
	@endphp
	@include('web.common.page_title')
	
	<style>
		.form-group label:not(.error) {font-weight: 600; color:#111111}
		.form-gray-fields .form-control {
			background-color: #f2f2f2;
			border-color: #e9e9e9;
			color: #333;
		}
	</style>
					
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-2"></div>
				<div class="content col-lg-6">
					<div class="panel-body">						
						<style>
							a.list-group-item.list-group-item-action:hover{color:#5F656C}
						</style>
						<div class="list-group">
							<a class="list-group-item list-group-item-action active" >LINKS </a>
							<a class="list-group-item list-group-item-action" href="http://www.covermedia.com/" target="_blank" title="{{ config('app.url') }} - LINKS - YCCS Magazine">YCCS Magazine </a>
							<a class="list-group-item list-group-item-action" href="https://www.acquadiparma.it/it/blumed_spacentri.html" target="_blank" title="{{ config('app.url') }} - LINKS - Spa">Spa </a>
							<a class="list-group-item list-group-item-action" href="http://www.piazzaazzurra.it/index.php" target="_blank" title="{{ config('app.url') }} - LINKS - Piazza Azzurra">Piazza Azzurra </a>
							<a class="list-group-item list-group-item-action" href="https://www.scuolavela.com/" target="_blank" title="{{ config('app.url') }} - LINKS - La Scuola della Vela">La Scuola della Vela </a>
							<a class="list-group-item list-group-item-action" href="https://www.geasar.it/" target="_blank" title="{{ config('app.url') }} - LINKS - Geasar">Geasar </a>
							<a class="list-group-item list-group-item-action" href="http://www.navimeteoharbour.com/mappe/med/med_48.png" target="_blank" title="{{ config('app.url') }} - LINKS - Eccelsa Aviation">Eccelsa Aviation </a>
						</div>
						<div class="list-group" style="margin-top:30px;">
							<a class="list-group-item list-group-item-action active" >OFFICIAL SUPPORTERS </a>
							<a class="list-group-item list-group-item-action" href="https://www.technogym.com/it/" target="_blank" title="{{ config('app.url') }} - LINKS - Technogym">Technogym </a>
						</div>
						<div class="list-group" style="margin-top:30px;">
							<a class="list-group-item list-group-item-action active" style="font-size:0.9em"> MEDIA PARTNERS </a>
							<a class="list-group-item list-group-item-action" href="https://www.boatinternationalmedia.com/" target="_blank" title="{{ config('app.url') }} - LINKS - Boat International Media">Boat International Media </a>
						</div>
						
						<div class="list-group" style="margin-top:30px;">
							<a class="list-group-item list-group-item-action active" ><?php if($lingua=="ita"){?>ALTRI CLUB<?php }else{?>RELATED CLUB<?php }?> </a>
							<a class="list-group-item list-group-item-action" href="https://www.nyyc.org/" target="_blank" title="{{ config('app.url') }} - LINKS - New York Yacht Club">New York Yacht Club </a>
							<a class="list-group-item list-group-item-action" href="https://www.ycm.org/" target="_blank" title="{{ config('app.url') }} - LINKS - Yacht Club Monaco">Yacht Club Monaco </a>
							<a class="list-group-item list-group-item-action" href="https://www.rys.org.uk/da/11572" target="_blank" title="{{ config('app.url') }} - LINKS - Royal Yacht Squadron">Royal Yacht Squadron </a>
							<a class="list-group-item list-group-item-action" href="http://www.gstaadyachtclub.com/" target="_blank" title="{{ config('app.url') }} - LINKS - Gstaad Yacht Club">Gstaad Yacht Club </a>
						</div>
						
						<div class="list-group" style="margin-top:30px;">
							<a class="list-group-item list-group-item-action active" ><?php if($lingua=="ita"){?>PREVISIONI METEO<?php }else{?>WEATHER FORECAST<?php }?> </span>
							<a class="list-group-item list-group-item-action" href="http://www.meteoam.it/" target="_blank" title="{{ config('app.url') }} - LINKS - Meteo AM">Meteo AM </a>
						</div>
						
						<div class="list-group" style="margin-top:30px;">
							<a class="list-group-item list-group-item-action active" ><?php if($lingua=="ita"){?>ASSOCIAZIONI SPORTIVE<?php }else{?>SPORTS ASSOCIATIONS<?php }?> </a>
							<a class="list-group-item list-group-item-action" href="http://www.sailing.org/ " target="_blank" title="{{ config('app.url') }} - LINKS - World Sailing">World Sailing</a>
							<a class="list-group-item list-group-item-action" href="http://www.orc.org/" target="_blank" title="{{ config('app.url') }} - LINKS - ORC">ORC</a>
							<a class="list-group-item list-group-item-action" href="http://www.federvela.it/ " target="_blank" title="{{ config('app.url') }} - LINKS - FIV">FIV</a>
							<a class="list-group-item list-group-item-action" href="http://www.uvai.it/" target="_blank" title="{{ config('app.url') }} - LINKS - UVAI">UVAI</a>
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