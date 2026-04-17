@extends('web.index')

@section('content')
	@php		
		$video_background = "web/video/Club_e_varie_regate-1920x500.mp4";
		$img_background = "web/images/testate/storia.jpg";
		$page_title = Lang::get('website.'.$pagina.' nome pagina');
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.il club'); $breadcrumbs[$x]['link']='';
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	@include('web.assets.la_storia_css')
	
	<?php
	function boxCarica($foto, $nome, $carica, $carica_eng, $lingua){
		if($lingua=="eng")
			$carica = $carica_eng;
		
		return '
			<img src="images/organico/'.$foto.'" class="img-carica" alt="">
			<h4 class="nome-carica">'.$nome.'</h4>
			<div style="width:120px; height:1px; background:#000; margin:5px auto;"></div>
			<span class="carica-carica">'.$carica.'</span>
		';
	}
	?>
	<style>
		.page-title-container{
			width:100%; display:flex; gap:35px;	
		}
		.row-cariche.row-cariche-mob{
			display:none !important;
		}
		.cariche-left-col{
			flex:80%;
		}
		.img-carica{
			width:120px;
		}
		.nome-carica{
			font-size:16px;
			font-weight:600;
			line-height:20px;
			margin-top:5px;
		}
		.carica-carica{
			font-size:14px;
		}
		.commodore-box{
			margin-top:190px;
		}
		@media screen and (max-width: 1400px) {
			.img-carica{
				width:100px;
			}
			.nome-carica{
				font-size:15px;
				line-height:19px;
			}
			.carica-carica{
				font-size:13px;
			}
		}
		@media screen and (max-width: 1024px) {
		
			.row-cariche > div{
				flex:0 0 50% !important;
				max-width:50%;
			}
			.row-cariche.row-cariche-mob{
				display:flex !important;
			}
			.row-cariche.row-cariche-desk{
				display:none !important;
			}
			.cariche-left-col{
				flex:60% !important;
			}
		}
		@media screen and (max-width: 800px) {
			.page-title-container{
				flex-direction:column;
				gap:10px;
			}
			.link-arrow{
				margin-top:0px !important;
				height:0px !important;
			}
			.img-carica{
				width:80px;
			}
			.nome-carica{
				font-size:14px;
				line-height:18px;
			}
			.carica-carica{
				font-size:12px;
			}
			.commodore-box{
				margin-top:170px;
			}
		}
		@media screen and (max-width: 600px) {
			.gradient-title{
				font-size:50px !important;
				line-height:1 !important;
			}
			.cariche-left-col{
				flex:50% !important;
			}
			.row-cariche.row-cariche-mob{
				flex-direction:column !important;
				gap:10px !important;
				align-items:center !important;
			}
			.row-cariche.row-cariche-mob > div{
				width:100% !important;
			}
			.cariche-left-col{
				width:0px !important;
			}
		}
	</style>
	<div id="pagContainer">
		<div class="page-title-container">
			<h3 class="gradient-title">{{ $page_title }}</h3>
			<div style="flex:1;">
				<div class="link-arrow" style="width:163px !important; gap:47px !important; margin-top:30px; padding-left:calc(100% - 163px); padding-bottom:7px; border-bottom:solid 2px;">
				 
				</div>
			</div>
		</div>	
			
		<div style="width:100%; margin-bottom:30px;">
			<div style="padding:50px 0; display:flex; ">
				<div class="cariche-left-col" style="flex:80%; display:flex; flex-direction:column; gap:30px; text-align:center;">
					<div style="">
						<?php echo boxCarica('zahraagakhan.jpg','P.ssa Zahra Aga Khan','Presidente','President',$lingua);?>
					</div>
					<div style="display:flex; gap:20px;" class="row-cariche row-cariche-desk">
						<div style="flex:1">
							<?php echo boxCarica('tamburi2.jpg','Dott. Giovanni Tamburi','Vicepresidente','Vice President',$lingua);?>
						</div>
						<div style="flex:1">
							<?php echo boxCarica('trifiro.jpg','Avv. Salvatore Trifirò','Consigliere','Board Member',$lingua);?>
						</div>
						<div style="flex:1">
							<?php echo boxCarica('traglio.jpg','Dott. Maurizio Traglio','Consigliere','Board Member',$lingua);?>
						</div>
					</div>
					
					<div style="display:flex; gap:20px;" class="row-cariche  row-cariche-desk">
						<div style="flex:1">
							<?php echo boxCarica('irene_macchiarelli.jpg','Dott.ssa Irene  Macchiarelli','Consigliere','Board Member',$lingua);?>
						</div>
						<div style="flex:1">
							<?php echo boxCarica('Achermann.png','Dott. Stefano Achermann','Consigliere','Board Member',$lingua);?>
						</div>
						<div style="flex:1">
							<?php echo boxCarica('Giacomo-Loro-Piana.jpg','Dott. Giacomo Loro Piana','Consigliere','Board Member',$lingua);?>
						</div>
					</div>

					
					<div style="display:flex;" class="row-cariche row-cariche-mob">
						<div style="flex:1">
							<?php echo boxCarica('tamburi2.jpg','Dott. Giovanni Tamburi','Vicepresidente','Vice President',$lingua);?>
						</div>
						<div style="flex:1">
							<?php echo boxCarica('trifiro.jpg','Avv. Salvatore Trifirò','Consigliere','Board Member',$lingua);?>
						</div>
					</div>
					
					<div style="display:flex;" class="row-cariche  row-cariche-mob">
						<div style="flex:1">
							<?php echo boxCarica('traglio.jpg','Dott. Maurizio Traglio','Consigliere','Board Member',$lingua);?>
						</div>
						<div style="flex:1">
							<?php echo boxCarica('irene_macchiarelli.jpg','Dott.ssa Irene  Macchiarelli','Consigliere','Board Member',$lingua);?>
						</div>
					</div>

					<div style="display:flex;" class="row-cariche  row-cariche-mob">
						<div style="flex:1">
							<?php echo boxCarica('Achermann.png','Dott. Stefano Achermann','Consigliere','Board Member',$lingua);?>
						</div>
						<div style="flex:1">
							<?php echo boxCarica('Giacomo-Loro-Piana.jpg','Dott. Giacomo Loro Piana','Consigliere','Board Member',$lingua);?>
						</div>
					</div>


					<div style="display:flex; gap:20px; text-align: center; flex-wrap:wrap;" >
						<div style="flex:1; text-align:center;">
							<span style="font-size:14px;"><?php if($lingua=="ita"){?>Revisori<?php }else{?>Auditors<?php }?></span>
							<div style="width:120px; height:1px; background:#000; margin:5px auto;"></div>
							
							<div style="font-size:13px">
								Dott. Mario Tardini<br/>
								Notaio Loredana Bocca<br/>
								Dott. Antonio Marchese
							</div>
						</div>
						
						<div style="flex:1; text-align:center;">
							<span style="font-size:14px;"><?php if($lingua=="ita"){?>Probiviri<?php }else{?>Arbitrators<?php }?></span>
							<div style="width:120px; height:1px; background:#000; margin:5px auto;"></div>
							
							<div style="font-size:13px">
								Dott. Paolo Merloni<br/>
								Dott. Lucio Stanca<br/>
								Ing. Elio Cosimo Catania
							</div>
						</div>
						
						<div style="flex:2; text-align:center; justify-content:start;">
							<span style="font-size:14px;"><?php if($lingua=="ita"){?>Segretario Generale e Direttore Sportivo<?php }else{?>Secretary General & Sports Director<?php }?></span>
							<div style="width:120px; height:1px; background:#000; margin:5px auto;"></div>
							
							<div style="font-size:13px">
								Giorgio Benussi
							</div>
						</div>
					</div>
				</div>
				<div style="flex:1; hight:540px; border-left:solid 1px; text-align:center;">
					<div class="commodore-box">
						<?php echo boxCarica('recordati.jpg','Dott. Andrea Recordati','Commodoro','Commodore',$lingua);?>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection