<style>
	.foooterText{
		color:#fff;
		font-family: 'Montserrat', sans-serif;
		font-size: 12px;
		background:url({{ asset('web/images/bg_footer.png') }}) center center; 
		background-size:cover;
	}	
	.foooterText a{
		color:#fff;
		text-decoration:underline;
	}
	.foooterText .footerTitle{
		font-size: 20px;
	}
	
	.footerInner{
		width:calc(100% - 200px); 
		padding:26px 100px; 
		display:flex; 
		gap:40px; 
		justify-content:space-between;
	}
	.subFooter{
		width:calc(100% - 200px); 
		padding:10px 100px 20px 100px;
	}
		
	.footer1{
		width:223px;
	}
	.footer2{
		width:315px; display:flex; justify-content:center
	}
	.footer3{
		width:223px; display:flex; justify-content:center
	}
	.footer4{
		width:223px; display:flex; justify-content:flex-end
	}
	
	.subFooter1{
		width:210px
	}
	.subFooter2{
		flex:1; text-align:right
	}
	
	@media screen AND (max-width:1300px){
		.footerInner{
			width:calc(100% - 50px); 
			padding:26px 25px; 
			gap:15px; 
		}
		.subFooter{
			width:calc(100% - 50px); 
			padding:10px 25px 20px 25px;
		}
	}
	
	@media screen AND (max-width:1023px){
		.foooterText{
			background:url({{ asset('web/images/bg_footer.png') }}) center left; 
			background-size:cover;
		}
		.footerInner{
			flex-wrap: wrap;
		}
		.footer1{
			width:calc(50% - 25px);
			justify-content:space-between;
		}
		.footer2{
			width:calc(50% - 25px);
			justify-content:space-between;
		}
		.footer3{
			width:calc(50% - 25px);
			justify-content:space-between;
		}
		.footer4{
			width:calc(50% - 25px);
			justify-content:space-between;
			
		}
	}
	
	@media screen AND (max-width:800px){
		.foooterText{
			background:url({{ asset('web/images/bg_footer.png') }}) -50vw center; 
			background-size:cover;
		}
		.subFooterContainer{
			flex-direction:column;
		}
		.subFooter1{
			width:100%
		}
		.subFooter2{
			width:100%;
			text-align:left;
			margin-top:10px;
		}
	}
	
	@media screen AND (max-width:540px){
		.foooterText{
			background:url({{ asset('web/images/bg_footer.png') }}) -120vw center; 
			background-size:cover;
		}
		.footerInner{
			flex-direction:column;
			gap:30px;
		}
		.footer1{
			width:100%;
			justify-content:space-between;
		}
		.footer2{
			width:100%;
			justify-content:space-between;
		}
		.footer3{
			width:100%;
			justify-content:space-between;
		}
		.footer4{
			width:100%;
			justify-content:space-between;
			
		}
	}
	@media screen AND (max-width:430px){
		.foooterText{
			background:url({{ asset('web/images/bg_footer.png') }}) -180vw center; 
			background-size:cover;
		}
	}
</style>
<div class="foooterText">
	<div class="footerInner">		
		<div class="footer1">
			<div style="padding-bottom:7px; border-bottom:solid 1px #fff; margin-bottom:14px;" class="footerTitle">
				Contatti
			</div>
			
			<div style="width:100%; height:18px; display:flex; align-items:center;">
				Via della marina
			</div>
			<div style="width:100%; height:18px; display:flex; align-items:center;">
				07021, Porto Cervo (Italy)
			</div>
			<div style="width:100%; height:18px; display:flex; align-items:center;">
				Tel:&nbsp;&nbsp;<a href="">+39 0789 902200</a>
			</div>
			<div style="width:100%; height:18px; display:flex; align-items:center;">
				Email:&nbsp;&nbsp;<a href="">info@yccs.it</a>
			</div>
			<div style="width:100%; height:18px; display:flex; align-items:center;">
				Pec:&nbsp;&nbsp;<a href="">yachtclubcostasmeralda@pec.it</a>
			</div>
			<div style="width:100%; height:18px; display:flex; align-items:center;">
				P.Iva: 00333630903
			</div>
			
			<div style="width:100%; margin-top:18px; display:flex; gap:10px; align-items:center;">
				<img src="{{ asset('web/images/icon_instagram_w.png') }}" style="width:13.6px;" alt="Instagram"/>
				<img src="{{ asset('web/images/icon_youtube_w.png') }}" style="width:12px;" alt="YouTube"/>
				<img src="{{ asset('web/images/icon_x_w.png') }}" style="width:12px;" alt="X"/>
			</div>
		</div>		
		
		<div class="footer2">
			<div>
				<div style="width:223px;">
					<div style="padding-bottom:7px; border-bottom:solid 1px #fff; margin-bottom:14px;" class="footerTitle">
						Prossime Regate
					</div>
				</div>
				<div style="display:flex; flex-direction:column; gap:10px;">	
					@php
						$query_c = DB::table('edizioni_regate')
							->select('*')
							->where('anno', '=', date('Y')) // Parentesi chiusa correttamente
							->where('visibile', '=', '1')
							->where(function($q) {
								$q->where('data_al', '>=', date('Y-m-d'))
								  ->orWhere('data_dal', '>=', date('Y-m-d'));
							})
							->orderBy('data_dal', 'ASC')
							->orderBy('ordine', 'DESC')
							->limit(5)
							->get();
					@endphp

					@foreach($query_c as $value_c)
						@php
							// Nota: Assicurati che $anno_regata e $lingua siano definite prima
							if(isset($lingua) && $lingua == "eng") {
								$link_regata = "en/regattas-".$value_c->anno."/".creaSlug($value_c->nome_regata)."-".$value_c->id.".html";
							} else {
								$link_regata = "regate-".$value_c->anno."/".creaSlug($value_c->nome_regata)."-".$value_c->id.".html";
							}
						@endphp
						
						<div>
							<a href="{{ $link_regata }}" title="{{ $value_c->nome_regata . " - " . config('app.name') }}" style="text-decoration:none">	
								{!! $value_c->nome_regata !!}<br/>
								<span style="font-style:italic">{{ ucfirst($value_c->luogo ?? '') }}</span>
								&nbsp;|&nbsp;
								<span style="font-style:italic">
								@if(($lingua ?? 'ita') == "ita")
									dal {{ \Carbon\Carbon::parse($value_c->data_dal)->format('d/m') }} 
									@if(!empty($value_c->data_al)) 
										al {{ \Carbon\Carbon::parse($value_c->data_al)->format('d/m') }} 
									@endif
								@else
									from {{ \Carbon\Carbon::parse($value_c->data_dal)->format('d/m') }} 
									@if(!empty($value_c->data_al)) 
										to {{ \Carbon\Carbon::parse($value_c->data_al)->format('d/m') }} 
									@endif
								@endif
								</span> 
							</a>
						</div>		
					@endforeach
				</div>
			</div>
		</div>
		
		<div class="footer3">
			<div>
				<div style="padding-bottom:7px; border-bottom:solid 1px #fff; margin-bottom:14px;" class="footerTitle">
					Aiuti di Stato
				</div>
				
				<div>
					Informazioni sui contributi ricevuti (Rif. Art.1, commi 125 e seguenti della Legge 124/2017)
				</div>
				<div style="width:100%; height:18px; display:flex; align-items:center;">
					<a href="aiuti-di-stato/2024.html">2024</a>
				</div>
				<div style="width:100%; height:18px; display:flex; align-items:center;">
					<a href="aiuti-di-stato/2023.html">2023</a>
				</div>
				<div style="width:100%; height:18px; display:flex; align-items:center;">
					<a href="aiuti-di-stato/2022.html">2022</a>
				</div>
				<div style="width:100%; height:18px; display:flex; align-items:center;">
					<a href="aiuti-di-stato/2021.html">2021</a>
				</div>
				<div style="width:100%; height:18px; display:flex; align-items:center;">
					<a href="aiuti-di-stato/2020.html">2020</a>
				</div>
				
				<div style="width:100%; margin-top:18px; margin-bottom:9px; display:flex; align-items:center; line-height:1.3;">
					{!! $lingua=='ita' ? 'CODICE DI COMPORTAMENTO ETICO E MODELLO ORGANIZZATIVO E DI CONTROLLO YCCS' : 'YCCS CODE OF ETHICAL CONDUCT AND ORGANIZATIONAL CONTROL MODEL' !!}
				</div>
				<button id="codice_comportamento" class="btnRoundedWhite">{!! $lingua=='ita' ? 'Scarica' : 'Download' !!}</button>
				<script type="text/javascript">
					$(document).ready(function () {
						$("#codice_comportamento").flipBook({
							pdfUrl:"{{ config('app.url') }}/vedi_pdf_public.php?file={{ $lingua=='ita' ? 'Codice_di_comportamento_Etico_e_MOG_YCCS.pdf' : 'Codice_di_comportamento_Etico_e_MOG_YCCS(en-GB).pdf' }}",
							lightBox:true
						});
					})
				</script>
			</div>
		</div>
		
		<div class="footer4">
			<div>
				<div style="width:223px;">
					<div style="padding-bottom:7px; border-bottom:solid 1px #fff; margin-bottom:14px;" class="footerTitle">
						YCCS Yearbook
					</div>
				</div>
				<a href="
					https://online.fliphtml5.com/xygx/YB_2025/#p=1" 
					target="_blank" 
					title="YCCS Yearbook">	
					<img src="{{ asset('web/images/yccs_yearbook.png') }}" alt="YCCS Yearbook" style="width:224px;" />
				</a>
			</div>
		</div>
		
		<?php /*<div class="footer4">
			<div style="width:223px; margin:0 auto;">
				<div style="padding-bottom:7px; border-bottom:solid 1px #fff; margin-bottom:14px;" class="footerTitle">
					YCCS Yearbook
				</div>
				<img src="{{ asset('web/images/yccs_yearbook.png') }}" alt="YCCS Yearbook" style="width:224px;" />
			</div>
		</div>*/?>
	</div>
	
	<div class="subFooter">
		<div style="padding-top:10px;  border-top:solid 1px #fff; display:flex;" class="subFooterContainer">
			<div class="subFooter1">
				Privacy | Cookie Policy<br/>
				Designed By Creative Web Studio
			</div>
			<div class="subFooter2">
				Ove si fa riferimento allo Yacht Club Costa Smeralda (YCCS)<br/>
				è da intendersi anche le società e/o associazioni ad esso collegate e/o da esso controllate
			</div>
		</div>
	</div>
</div>