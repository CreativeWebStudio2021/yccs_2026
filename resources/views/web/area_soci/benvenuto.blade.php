@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.area soci');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.benvenuto'); $breadcrumbs[$x]['link']=''; 
			
		@endphp
		@include('web.common.page_title')
		
		<div id="pagContainer">
			<!-- Content -->
			<section style="padding-bottom:0">
				<div class="container-fluid">
					<div class="row">									
						<div class="col-md-12">
							<div style="width:100%; display:flex; gap:35px;">
								<h3 class="gradient-title"><?php if($lingua=="ita"){?>BENVENUTO<?php }else{?>WELCOME<?php }?></h3>
								<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom:80px">				
							<p>
								<?php if($lingua=="ita"){?>									
									<strong>Benvenuto nell'Area Soci!</strong><br/>
									Qui puoi accedere a tutte le risorse riservate, gestire il tuo profilo e restare aggiornato sulle ultime novità.<br/>
									Esplora le sezioni disponibili e contattaci se hai bisogno di assistenza.
								<?php }else{?>
									<strong>Welcome to the Members' Area!</strong><br/>
									Here, you can access exclusive resources, manage your profile, and stay updated on the latest news.<br/>
									Explore the available sections and contact us if you need any assistance.
								<?php }?>											
							</p>	
						</div>
					</div>
				</div>
			</section>
			
			<style>
				.btnStore{width:40%; margin:0 auto;  margin-bottom:15px; border-radius:5px; border: solid 2px #fff; background:rgba(0,0,0,0.2); transition:all 0.3s;}
				.btnStore {padding:10px;  text-align:center; text-shadow:#000 1px 1px 2px; transition:all 0.3s;}
				.btnStore strong{color:#fff; transition:all 0.3s;}
				
				.btnStore:hover{background:rgba(255,255,255,0.8)}
				.btnStore:hover div{text-shadow:rgba(255,255,255,0.2) 1px 1px 2px}
				.btnStore:hover strong{color:#000;}
			</style>
			<section class="text-light" data-bg-parallax="https://www.yccs.it/web/images/boutique_x_benvenuto.jpg" <?php /*style="background: url(web/images/boutique_x_home.jpg) center -180px; padding:120px 0 40px"*/?>>
				<div class="bg-overlay" data-style="10"></div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12" style="padding:50px 0;">			
							<a href="<?php if($lingua=="en"){?>eng/<?php }?>area-soci/la-boutique.html">
								<div class="btnStore" style="">
									<div style="">
										<strong>{{ strtoupper(Lang::get('website.store online boutique')) }}</strong>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</section>

			<section>
				<div class="container-fluid" >
					<div class="row">
						<div class="col-md-12">
							<div style="width:100%; display:flex; gap:35px;">
								<h3 class="gradient-title">{{ strtoupper(Lang::get('website.sezioni')) }}</h3>
								<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="tabs tabs-folder">
								<ul class="nav nav-tabs" id="myTab3" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="home-tab" data-toggle="tab" href="#Derive" role="tab" aria-controls="home" aria-selected="true" style="color:#2e343c"><b>{{ strtoupper(Lang::get('website.area personale')) }}</b></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="profile-tab" data-toggle="tab" href="#Cabinati" role="tab" aria-controls="profile" aria-selected="false" style="color:#2e343c"><b>{{ strtoupper(Lang::get('website.la boutique')) }}</b></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="profile-tab" data-toggle="tab" href="#Corsi_con_alloggio" role="tab" aria-controls="profile" aria-selected="false" style="color:#2e343c"><b>{{ strtoupper(Lang::get('website.comunicati e documenti')) }}</b></a>
									</li>
								</ul>
								<style>
									.list-group-item.list-group-item-action{border-radius:0; transition:all 0.3s;}
									.list-group-item.list-group-item-action:hover{background:#00AEEF; color:#fff !important}
								</style>
								<div class="tab-content" id="myTabContent3" style="padding:0; border-left:none; border-left:none; border-right:none; border-bottom:none">
									<div class="tab-pane fade show active" style="text-align:justify" id="Derive" role="tabpanel" aria-labelledby="home-tab">
										<div class="list-group">
											<?php 
											$items = [
												[
													'title' => 'profilo socio',
													'link'  => 'area-soci/profilo-socio.html',
													'flip' => '0'
												],
												[
													'title' => 'pagamento quota',
													'link'  => 'area-soci/pagamento-quota.html',
													'flip' => '0'
												]
											];
											foreach ($items as $item) {?>
												<a href="<?php if($lingua=="eng"){?>en/<?php }?>{{$item['link']}}" class="list-group-item list-group-item-action" title="{{ Lang::get('website.'.$item['title']) }} - {{ Lang::get('website.area soci') }} - {{ config('app.name') }}">
													{{ Lang::get('website.'.$item['title']) }}
												</a>
											<?php }?>
										</div>																		
									</div>
									<div class="tab-pane fade" style="text-align:justify" id="Cabinati" role="tabpanel" aria-labelledby="profile-tab">
										<div class="list-group">
											<?php 
											$items = [
												[
													'title' => 'la boutique',
													'link'  => 'area-soci/la-boutique.html',
													'flip' => '0'
												],
												[
													'title' => 'carrello',
													'link'  => 'area-soci/carrello.html',
													'flip' => '0'
												],
												[
													'title' => 'i miei ordini',
													'link'  => 'area-soci/i-miei-ordini.html',
													'flip' => '0'
												]
											];
											foreach ($items as $item) {?>
												<a href="<?php if($lingua=="eng"){?>en/<?php }?>{{$item['link']}}" class="list-group-item list-group-item-action" title="{{ Lang::get('website.'.$item['title']) }} - {{ Lang::get('website.area soci') }} - {{ config('app.name') }}">
													{{ Lang::get('website.'.$item['title']) }}
												</a>
											<?php }?>
										</div>
									</div>
									<div class="tab-pane fade" style="text-align:justify" id="Corsi_con_alloggio" role="tabpanel" aria-labelledby="profile-tab">
										<div class="list-group">
											<?php 
											$items = [
												[
													'title' => 'comunicazioni ai soci',
													'link'  => 'area-soci/comunicazioni-ai-soci.html',
													'flip' => '0'
												],
												/*[
													'title' => 'regate interclub',
													'link'  => 'area-soci/regate-interclub.html',
													'flip' => '0'
												],
												[
													'title' => 'centro_sportivo nome pagina',
													'link'  => 'area-soci/centro-sportivo.html',
													'flip' => '0'
												],*/
												[
													'title' => 'statuto',
													'link'  => '',
													'flip' => 'openStatuto'
												],
												[
													'title' => 'regolamento interno',
													'link'  => '',
													'flip' => 'openReg'
												],
												[
													'title' => 'orari servizi',
													'link'  => '',
													'flip' => 'openOrariServizi'
												],
												[
													'title' => 'codice di comportamento etico',
													'link'  => '',
													'flip' => 'openCodiceComportamento'
												],
												[
													'title' => 'certificato di guidone',
													'link'  => 'area-soci/certificato-di-guidone.html',
													'flip' => '0'
												]
											];
											foreach ($items as $item) {?>
												<a <?php if($item['flip']=='0'){?>href="<?php if($lingua=="eng"){?>en/<?php }?>{{$item['link']}}"<?php }?> style="cursor:pointer;" class="list-group-item list-group-item-action <?php if($item['flip']!='0'){?>{{ $item['flip'] }}<?php }?>" title="{{ Lang::get('website.'.$item['title']) }} - {{ Lang::get('website.area soci') }} - {{ config('app.name') }}">
													{{ Lang::get('website.'.$item['title']) }}
												</a>
											<?php }?>
										</div>
									</div>
								</div>
							</div>					
						</div>
					</div>
				</div>
			</section>		
		<!-- end: Content -->
										</div>	
	@endsection
@else	
	<script language="javascript">
		window.location = "<?php echo config('app.url');?>/<?php if($lingua=="eng"){?>en/<?php }?>area-soci/login.html";
	</script>
@endif