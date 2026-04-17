@extends('web.index')

@section('content')
	@include('web.assets.regate_anno_css')
	<style>
		.regate-title-break{
			display:flex;
			flex-direction:column;
			gap:0px;
		}
		.regate-title-line{
			position:absolute; 
			width:250px; 
			height:50px; 
			background:#fff; 
			left:0; 
			bottom:5px; 
			z-index:2
			
		}
		.regate-linea-anni-container{
			flex:1; 
			position:relative;
			width:341px;
			height:126px;
			overflow-x:hidden;
			z-index:10;
		}
		.regate-linea-anni{	
			position:absolute; 
			width:calc(100% - 645px); 
			padding-right:400px; 
			right:0; 
			bottom:15px; 
			height:2px; 
			background:#606060
		}
		@media screen and (max-width:1024px) {
			.regate-title-break{
				flex-direction:row;
				gap:10px;
			}
			.regate-title-line{
				display:none;
			}
			.regate-linea-anni{
				width:calc(100% - 30px);
			}
		}
		@media screen and (max-width:630px) {
			.regate-title-break{
				flex-direction:column;
				gap:0px;
			}
			.regate-title-line{
				display:none;
			}
			.regate-linea-anni-container{
				height:190px;
			}
		}
		@media screen and (max-width:400px) {
			.regate-linea-anni-container h3{
				font-size:55px;
				line-height:60px;
			}
		}
	</style>
	<div style="width:width:100%; height:520px; position:relative;">
		<div class="media-slider-container">
		  <div class="media-slider-wrapper">
			<div class="media-slide active">
			  <!-- video slide -->
			  <video autoplay muted loop playsinline class="slide-background-video">
				<source src="{{ asset('web/video/Regate-generiche-1920x500.mp4') }}" type="video/mp4">
			  </video>
			</div>
		  </div>
		</div>		
	</div>
	
	<div id="calendarioRegate" style="width:100%; margin-bottom:20px; overflow:hidden;">
		<div class="page-container">
			<div class="lista-anni-desk-container" style="display:flex;">
				<div class="regate-linea-anni-container">
					<div style="position:absolute; width:341px;  top:0; left; z-index:10;">
						<h3 class="gradient-title" style="margin:0; padding:0; padding-bottom:10px; font-weight:300; line-height:58px; <?php if($lingua=="eng"){?>font-size:55px;<?php }?>">
							<?php if($lingua=="ita"){?>
								<div class="regate-title-break">
									<span>Calendario</span>
									<span>Regate</span>
								</div>
							<?php }else{?>
									<div class="regate-title-break">
									<span>Regatta</span>
									<span>Calendar</span>
								</div>
							<?php }?>
						</h3>
					</div>
					<style>
						.lista-anni-desk-line{
							display:flex;
						}
						@media screen and (max-width:800px) {
							.lista-anni-desk-line{
								display:none;
							}
							.regate-linea-anni-container {
								height:90px;
							}
						}
						@media screen and (max-width:630px) {
							.regate-linea-anni-container {
								height:130px;
							}
						}
					</style>
					<div class="lista-anni-desk-line">
						<div class="regate-title-line"></div>
						<div class="regate-linea-anni">
							<div style="width:100%; height:100%; display:flex; justify-content:flex-end; margin-top:-39px; ">
								<?php for($i=1996; $i<=date("Y"); $i++){?>
									<div class="anno-container start" data-year="{{ $i }}">
										<div class="year-label">{{ $i }}</div>
										<div class="pallino-anno" ></div>
										
									</div>
								<?php } ?>
									<div class="cursor-anno">
										<img src="{{ asset('web/images/freccina_sinistra.png') }}" style="width:6px; height:14px;" alt=""/>
										<img src="{{ asset('web/images/freccina_destra.png') }}" style="width:6px; height:14px;" alt=""/>
									</div>
								<div style="flex:3"></div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<style>
				.lista-anni-mob-container{
					display:none;
					justify-content:center;
					align-items:center;
					width:100%; 
					position:relative;
					overflow-x:scroll;
					scrollbar-width:none;
					-ms-overflow-style:none;
					-webkit-overflow-scrolling:touch;
					cursor:grab;
					user-select:none;
				}
				.lista-anni-mob-container:active{
					cursor:grabbing;
				}
				.lista-anni-mob-container::-webkit-scrollbar{
					display:none;
				}
				.lista-anni-mob{
					position:relative;
					display:flex;
					gap:30px;
				}
				.anno-container-mob{
					display:flex;
					flex-direction:column;
					gap:5px;
					
					cursor:pointer;
					transition:all 0.3s ease;
					align-items:center;
					justify-content:center;
				}
				@media screen and (max-width:800px) {
					.lista-anni-mob-container{
						display:block;
					}
				}
			</style>
			<div class="lista-anni-mob-container" data-current-anno="{{ $anno_regata }}">
				<div class="lista-anni-mob">
					<?php 
					$x=0;
					for($i=1996; $i<=date("Y"); $i++){?>
						<div class="anno-container-mob" data-anno="{{ $i }}">
							<a href="regate-{{ $i }}.html">
								<div class="year-label" 
									<?php 
										if($i==$anno_regata){?>
											style="font-weight:600; margin-top:6px;"
										<?php }?>>
										{{ $i }}
								</div>
							</a>
							<?php 
								if($i==$anno_regata){?>
									<div class="cursor-anno" style="z-index:2; position:relative !important; opacity:1 !important; right:0 !important; top:-3px !important; transform: translateX(0);">
										<img src="{{ asset('web/images/freccina_sinistra.png') }}" style="width:6px; height:14px;" alt=""/>
										<img src="{{ asset('web/images/freccina_destra.png') }}" style="width:6px; height:14px;" alt=""/>
									</div>
								<?php } else {?>
									<div class="pallino-anno" style="z-index:2;"></div>
								<?php }?>
						</div>
					<?php $x++;
					} ?>
					<div class="lista-anni-mob-line" style="width:<?php echo (80*$x);?>px !important; height:2px; background:#606060; position:absolute; bottom:13px; left:0; width:100%; min-width:100%;"></div>
				</div>
			</div>
			<style>
				#listaRegate {
					display:flex;
					gap:40px;
					margin-top:50px;
					position:relative;
				}
				#listaRegate .colLeft {
					flex:40%;
				}
				#listaRegate .colRight {
					flex:60%;
					margin-top:30px;
					position:relative;
				}
				@media screen and (max-width:800px) {
					#listaRegate {
						flex-direction:column;
					}
					#listaRegate .colLeft {
						flex:100%;
					}
					#listaRegate .colRight {
						flex:100%;
						margin-top:0;
					}
				}
			</style>
			<div id="listaRegate">
				<div class="colLeft" id="listaRegateNomi">
					<div id="boxRegate">
						<div class="boxRegateAnno boxRegateAnno1"></div>
						<div class="boxRegateAnno boxRegateAnno2"></div>
						<div class="boxRegateAnno boxRegateAnno3"></div>
					</div>
					
					<!-- BOTTONE CALENDARIO REGATA -->
					<div id="bottone_calendario_regate"></div>
					<!-- LOGHI REGATA -->
					<div id="loghi_regate"></div>					
				</div>
				
				<div class="colRight" id="listaRegateFoto">
					<div id="listaRegateFoto1"></div>
					<!-- <div id="listaRegateFoto2"></div>		-->	
					
					<div class="blocco-bottoni blocco-bottoni-1" style="width:100px;  display:flex; gap:15px; top:0px; position:absolute; right:0;">
						<img src="{{ asset('web/images/freccia_giu.png') }}" onclick="sali('<?php echo $anno_regata;?>')" class="arrow-btn arrow-down" data-el="0"  data-default="freccia_giu.png" data-hover="freccia_giu_on.png" style="width:43px; cursor:pointer; transition: all 1s;" alt=""/>
						<img src="{{ asset('web/images/freccia_su.png') }}" onclick="scendi('<?php echo $anno_regata;?>')" class="arrow-btn arrow-up" data-el="0" data-default="freccia_su.png" data-hover="freccia_su_on.png" style="width:43px; opacity:0.5;  transition: all 1s;" alt=""/>
					</div>
					<div class="blocco-bottoni blocco-bottoni-2" style="width:100px;  display:flex; gap:15px; top:0px; position:absolute; right:0;">
						<img src="{{ asset('web/images/freccia_giu.png') }}" onclick="sali('<?php echo $anno_regata;?>')" class="arrow-btn arrow-down" data-el="0"  data-default="freccia_giu.png" data-hover="freccia_giu_on.png" style="width:43px; cursor:pointer; transition: all 1s;" alt=""/>
						<img src="{{ asset('web/images/freccia_su.png') }}" onclick="scendi('<?php echo $anno_regata;?>')" class="arrow-btn arrow-up" data-el="0" data-default="freccia_su.png" data-hover="freccia_su_on.png" style="width:43px; opacity:0.5;  transition: all 1s;" alt=""/>
					</div>
				</div>
			</div>
		</div>
	</div>
	 
	@include('web.assets.regate_anno_js')
@endsection