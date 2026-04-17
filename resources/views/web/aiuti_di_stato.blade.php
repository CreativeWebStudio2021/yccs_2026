@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$page_title = Lang::get('website.aiuti di stato')." ".$anno;
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.aiuti di stato'); $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=$anno; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<div class="content col-lg-1"></div>
				<div class="content col-lg-7">					
					<div style="margin-top:30px;">
						<div style="width:100%; display:flex; gap:15px;">
							<h4 class="gradient-title" style="line-height:1.2">ASD Yacht Club Costa Smeralda</h4>
							<div class="link-arrow" style="flex:1; margin-top:20px; border-bottom:solid 2px;"></div>
						</div>
						<p>						
							Informazioni su contributi e/o agevolazioni ricevuti<br/>
							<span style="font-size:0.8em">(Rif. Art.1, commi 125 e seguenti della Legge 124/2017)</span>
						</p>
						
						@php
							$year = "2024";
							$x=0;
							$x++; 
							$dati[$year][$x]['data']='Gen-Dic 2024'; 
							$dati[$year][$x]['contributi']='Decontribuzione INPS SUD 30% periodo Gen-Dic 2024:<br/>(DL n.104 del 14 agosto 2020, art 27 ACAS, convertito in legge n.126 del 13 ottobre 2020)'; 
							$dati[$year][$x]['ente']='INPS'; 
							$dati[$year][$x]['importo']='40.279,11 €';
							
							$year = "2023";
							$x=0;
							$x++; 
							$dati[$year][$x]['data']='Gen-Dic 2023'; 
							$dati[$year][$x]['contributi']='Decontribuzione INPS SUD 30% periodo Gen-Dic 2023:<br/>(DL n.104 del 14 agosto 2020, art 27 ACAS, convertito in legge n.126 del 13 ottobre 2020)'; 
							$dati[$year][$x]['ente']='INPS'; 
							$dati[$year][$x]['importo']='38.531,41 €';
							$x++; 
							$dati[$year][$x]['data']='06/06/2023'; 
							$dati[$year][$x]['contributi']='Bando TVB Bonus Occupazionale 2020'; 
							$dati[$year][$x]['ente']='RAS'; 
							$dati[$year][$x]['importo']='5.833,00 €';
							
							$year = "2022";
							$x=0;
							$x++; 
							$dati[$year][$x]['data']='Gen-Dic 2022'; 
							$dati[$year][$x]['contributi']='Decontribuzione INPS SUD 30% periodo Gen-Dic 2022:<br/>(DL n.104 del 14 agosto 2020, art 27 ACAS, convertito in legge n.126 del 13 ottobre 2020)'; 
							$dati[$year][$x]['ente']='INPS'; 
							$dati[$year][$x]['importo']='35.980,85 €';
							
							$year = "2021";
							$x=0;
							$x++; 
							$dati[$year][$x]['data']='30/06/2021'; 
							$dati[$year][$x]['contributi']='Acconto figurativo IRAP non versato art. 24 D.L. 34/2020'; 
							$dati[$year][$x]['ente']='Agenzia delle Entrate'; 
							$dati[$year][$x]['importo']='5.032,50 €';
							$x++; 
							$dati[$year][$x]['data']='12/11/2021'; 
							$dati[$year][$x]['contributi']='Credito di Imposta 30% su DPI/Tamponi - art 32 DL 73-2021 conv. in legge n. 106 del 23/07/2021'; 
							$dati[$year][$x]['ente']='Agenzia delle Entrate'; 
							$dati[$year][$x]['importo']='161,00 €';
							$x++; 
							$dati[$year][$x]['data']='Gen-Dic 2021'; 
							$dati[$year][$x]['contributi']='Decontribuzione INPS SUD 30% periodo Gen-Dic 2021:<br/>(DL n.104 del 14 agosto 2020, art 27 ACAS, convertito in legge n.126 del 13 ottobre 2020)'; 
							$dati[$year][$x]['ente']='INPS'; 
							$dati[$year][$x]['importo']='38.466,33 €';
							
							$year = "2020";
							$x=0;
							$x++; 
							$dati[$year][$x]['data']='05/10/2020'; 
							$dati[$year][$x]['contributi']='Credito Imposta art 120 Adeg.Amb.Lav Decr. Rilancio (DL n. 34 del 19 maggio 2020)'; 
							$dati[$year][$x]['ente']='Agenzia delle Entrate'; 
							$dati[$year][$x]['importo']='1.726,00 €';
							$x++; 
							$dati[$year][$x]['data']='14/12/2020'; 
							$dati[$year][$x]['contributi']='Credito Imposta art 125 DPI e Sanific. Amb.Lav Decr. Rilancio (DL n. 34 del 19 maggio 2020)'; 
							$dati[$year][$x]['ente']='Agenzia delle Entrate'; 
							$dati[$year][$x]['importo']='637,00 €';
							$x++; 
							$dati[$year][$x]['data']='14/12/2020'; 
							$dati[$year][$x]['contributi']='Credito Imposta art 125 DPI e Sanific. Amb.Lav Decr. Rilancio (DL n. 34 del 19 maggio 2020)'; 
							$dati[$year][$x]['ente']='Agenzia delle Entrate'; 
							$dati[$year][$x]['importo']='1.275,00 €';
							$x++; 
							$dati[$year][$x]['data']='30/11/2020'; 
							$dati[$year][$x]['contributi']='Esonero contributivo INPS Decreto-legge 14 agosto 2020, n. 104, art 3'; 
							$dati[$year][$x]['ente']='INPS'; 
							$dati[$year][$x]['importo']='3.371,00 €';
							$x++; 
							$dati[$year][$x]['data']='31/12/2020'; 
							$dati[$year][$x]['contributi']='Esonero contributivo INPS Decreto-legge 14 agosto 2020, n. 104, art 3'; 
							$dati[$year][$x]['ente']='INPS'; 
							$dati[$year][$x]['importo']='5.377,00 €';
							$x++; 
							$dati[$year][$x]['data']='Ott-Dic 2020'; 
							$dati[$year][$x]['contributi']='Decontribuzione INPS SUD 30% periodo Ott-Dic 2020:<br/>Decreto-legge 14 agosto 2020, n. 104 art 27 ACAS, convertito dalla legge 13 ottobre 2020, n. 126 '; 
							$dati[$year][$x]['ente']='INPS'; 
							$dati[$year][$x]['importo']='9.549,33 €';
							$x++; 
							$dati[$year][$x]['data']='Mar-Giu 2020'; 
							$dati[$year][$x]['contributi']='Credito CIG/FIS periodo Mar-Giu 2020:<br/>(DL n.18 del 17 marzo 2020, art 19, convertito in legge n.27 del 24 aprile 2020 e succesivamente modificata con DL n.34 del 19 maggio 2020, art 68 c.1, a sua volta convertito in legge n.77 del 17 luglio 2020)'; 
							$dati[$year][$x]['ente']='INPS'; 
							$dati[$year][$x]['importo']='15.128,63 €';
							
							
						@endphp
						<table class="table table-striped table-bordered" style="margin-top:20px;">
							<thead>
								<tr>
									<th scope="col" style="width:120px;"><b>Data</b></th>
									<th scope="col"><b>Contributi e/o agevolazioni esercizi {{$anno}}</b></th>
									<th scope="col" style="width:130px;"><b>Ente Erogatore</b></th>
									<th scope="col" style="width:120px;"><b>Importo</b></th>
								</tr>
							</thead>
							<tbody>
								@for($i=1; $i<=count($dati[$anno]); $i++)
									<tr>
										<th scope="row">{!! $dati[$anno][$i]['data'] !!}</th>
										<td>{!! $dati[$anno][$i]['contributi'] !!}</td>
										<td>{!! $dati[$anno][$i]['ente'] !!}</td>
										<td>{!! $dati[$anno][$i]['importo'] !!}</td>
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>
				<div class="content col-lg-1"></div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-3" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-12">
							<style>
								.list-group-item{background:#fff;  transition: 0.3s;}
								.list-group-item:hover{background:#00AEEF; color:#fff}
							</style>
							<div class="widget clearfix widget-blog-articles">
								<div style="width:100%; display:flex; gap:10px;">
									<h4 class="gradient-title" style="font-size:25px;">{{ Lang::get('website.archivio aiuti di stato') }}</h4>
									<div class="link-arrow" style="flex:1; margin-top:10px; border-bottom:solid 1px;"></div>
								</div>
								<ul class="list-group" style="padding-top:20px">
									@for($y=2024; $y>=2020; $y--)
										<a href="{{$lingua=='eng' ? 'en/' : ''}}aiuti-di-stato/{{$y}}.html" {!!$anno==$y ? 'style="font-weight:bold"' : ''!!} title="{!! Lang::get('website.aiuti di stato') !!} {{$y}} - {{ config('app.name') }}">
											<li class="list-group-item {{ ($cmd=='benvenuto') ? 'active' : ''}}">
												<b>{{$y}}</b>
											</li>
										</a>
									@endfor
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- end: Sidebar-->			
			</div>
		</div>
	</section> <!-- end: Content -->
@endsection