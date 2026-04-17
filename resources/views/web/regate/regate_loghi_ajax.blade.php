<?php
$_GET['anno'] ? $anno_regata = $_GET['anno'] : '';
?>
<style>
	.regate-loghi-wrap { padding: 10px; display: flex; flex-direction: column; gap: 0; }
	.regate-loghi-row1-labels { display: flex; justify-content: space-between; text-align: center; }
	.regate-loghi-row1-labels > div { flex: 1; display: flex; flex-direction: column; gap: 5px; }
	.regate-loghi-row1-labels .regate-loghi-solo { flex: 1; }
	.regate-loghi-row1-imgs { display: flex; justify-content: space-between; margin-bottom: 20px; align-items: center; }
	.regate-loghi-row1-imgs > div { flex: 1; display: flex; flex-direction: column; gap: 5px; text-align: center; }
	.regate-loghi-row1-imgs .regate-loghi-solo { flex: 1; display: flex; justify-content: center; }
	.regate-loghi-rolex { width: 150px; max-width: 55%; margin: 0 auto; }
	.regate-loghi-second { width: 250px; max-width: 90%; margin: 15px auto 0; }
	.regate-loghi-row2 { display: flex; justify-content: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; }
	.regate-loghi-cell { display: flex; flex-direction: column; gap: 5px; align-items: center; text-align: center; flex: 0 1 140px; max-width: 140px; min-width: 70px; font-size: 12px; }
	.regate-loghi-cell img { width: 100%; max-width: 140px; }
	@media screen and (max-width: 1600px) { .regate-loghi-rolex { width: 55%; } .regate-loghi-second { width: 90%; } }
</style>
<div style="padding-right:0px;">
	<div style="width:100%; margin-top:50px; background:#f1f1f1">
		<div style="padding:10px;">
			<div style="background:#fff;">
				<?php if($anno_regata<=2007){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels"><div class="regate-loghi-solo"><span style="font-size:14px;">Official Timepiece</span></div></div>
						<div class="regate-loghi-row1-imgs"><div class="regate-loghi-solo"><img src="{{ asset('web/images/rolex_logo.jpg') }}" alt="" class="regate-loghi-rolex" style="width:180px; max-width:180px;"></div></div>
					</div>
				<?php }?>

				<?php if($anno_regata>2007 && $anno_regata<2017){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ asset('web/images/rolex_logo.jpg') }}" alt="" class="regate-loghi-rolex"/></div>
							<div><img src="{{ asset('web/images/audi_logo.jpg') }}" alt="" class="regate-loghi-second"/></div>
						</div>
					</div>
				<?php }?>

				<?php if($anno_regata=="2017"){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ smartAsset('web/images/partner_rolex.jpg') }}" alt="" class="regate-loghi-rolex"/></div>
							<div><img src="{{ smartAsset('web/images/partner_audi.jpg') }}" alt="" class="regate-loghi-second"/></div>
						</div>
						<div class="regate-loghi-row2">
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_garmin.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Preferred Supplier</span><img src="{{ smartAsset('web/images/partner_meridiana.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Technical Partner</span><img src="{{ smartAsset('web/images/partner_quantum_sails.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Official Supporter</span><img src="{{ smartAsset('web/images/partner_technogym.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Official Partner</span><img src="{{ smartAsset('web/images/partner_oakley.jpg') }}" alt=""/></div>
						</div>
					</div>
				<?php }?>

				<?php if($anno_regata=="2018"){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ smartAsset('web/images/partner_rolex.jpg') }}" alt="" class="regate-loghi-rolex"/></div>
							<div><img src="{{ smartAsset('web/images/partner_audi.jpg') }}" alt="" class="regate-loghi-second"/></div>
						</div>
						<div class="regate-loghi-row2">
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_garmin.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Technical Partner</span><img src="{{ smartAsset('web/images/partner_quantum_sails.jpg') }}" alt=""/></div>
						</div>
					</div>
				<?php }?>
				<?php if($anno_regata==2019){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ smartAsset('web/images/partner_rolex.jpg') }}" alt="" class="regate-loghi-rolex"/></div>
							<div><img src="{{ smartAsset('web/images/partner_audi.jpg') }}" alt="" class="regate-loghi-second"/></div>
						</div>
						<div class="regate-loghi-row2">
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_garmin.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Technical Partner</span><img src="{{ smartAsset('web/images/partner_quantum_sails.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Wellness Technical Partner</span><img src="{{ smartAsset('web/images/partner_technogym2.jpg') }}" alt=""/></div>
						</div>
					</div>
				<?php }?>
				<?php if($anno_regata==2020){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ smartAsset('web/images/partner_rolex.jpg') }}" alt="" class="regate-loghi-rolex"/></div>
							<div><img src="{{ smartAsset('web/images/partner_audi.jpg') }}" alt="" class="regate-loghi-second"/></div>
						</div>
						<div class="regate-loghi-row2">
							<div class="regate-loghi-cell"><span>Wellness Technical Partner</span><img src="{{ smartAsset('web/images/partner_technogym2.jpg') }}" alt=""/></div>
						</div>
					</div>
				<?php }?>
				<?php if($anno_regata==2021){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ smartAsset('web/images/partner_rolex.jpg') }}" alt="" class="regate-loghi-rolex"/></div>
							<div><img src="{{ asset('web/images/logo_jaguar_land_rover.jpg') }}" alt="" class="regate-loghi-second"/></div>
						</div>
						<div class="regate-loghi-row2">
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_garmin.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Technical Partner</span><img src="{{ smartAsset('web/images/partner_quantum_sails.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Wellness Technical Partner</span><img src="{{ smartAsset('web/images/partner_technogym2.jpg') }}" alt=""/></div>
						</div>
					</div>
				<?php }?>
				<?php if($anno_regata==2022){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ smartAsset('web/images/partner_rolex.jpg') }}" alt="" class="regate-loghi-rolex"/></div>
							<div><img src="{{ asset('web/images/logo_jaguar_land_rover.jpg') }}" alt="" class="regate-loghi-second"/></div>
						</div>
						<div class="regate-loghi-row2">
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_garmin.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_slam2.png') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Technical Partner</span><img src="{{ smartAsset('web/images/partner_quantum_sails.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Wellness Technical Partner</span><img src="{{ smartAsset('web/images/partner_technogym2.jpg') }}" alt=""/></div>
						</div>
					</div>
				<?php }?>
				<?php if($anno_regata==2023 || $anno_regata==2024){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ smartAsset('web/images/partner_rolex2.jpg') }}" alt="" class="regate-loghi-rolex"/></div>
							<div><a href="https://www.landrover.it/families/range-rover.html" title="Range Rover - Land Rover Italia" target="_blank" rel="noopener"><img src="{{ smartAsset('web/images/logo_range_rover_v3.jpg') }}" alt="" class="regate-loghi-second"/></a></div>
						</div>
						<div class="regate-loghi-row2">
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_garmin.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_slam2.png') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Technical Partner</span><img src="{{ smartAsset('web/images/partner_quantum_sails.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Wellness Technical Partner</span><img src="{{ smartAsset('web/images/partner_technogym2.jpg') }}" alt=""/></div>
						</div>
					</div>
				<?php }?>

				<?php /* if($anno_regata==2025){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ smartAsset('web/images/partner_rolex2.jpg') }}" alt="" class="regate-loghi-rolex"/></div>
							<div><img src="{{ smartAsset('web/images/logo_range_rover.jpg') }}" alt="" class="regate-loghi-second"/></div>
						</div>
						<div class="regate-loghi-row2">
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_garmin.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_slam2.png') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_north_sails.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Wellness Technical Partner</span><img src="{{ smartAsset('web/images/partner_technogym2.jpg') }}" alt=""/></div>
						</div>
					</div>
				<?php }*/?>
				
				<?php if($anno_regata>=2025){?>
					<div class="regate-loghi-wrap">
						<div class="regate-loghi-row1-labels">
							<div><span style="font-size:14px;">Official Timepiece</span></div>
							<div><span style="font-size:14px;">Official Partner</span></div>
							<div><span style="font-size:14px;">Official Automotive Partner</span></div>
						</div>
						<div class="regate-loghi-row1-imgs">
							<div><img src="{{ smartAsset('web/images/partner_rolex_2026.png') }}" alt="" class="regate-loghi-rolex" style="width:90%; max-width:90%"/></div>
							<div><img src="{{ smartAsset('web/images/LOGO_ALLIANZ_2026.png') }}" alt="" class="regate-loghi-rolex" style="width:90%; max-width:90%"/></div>
							<div><img src="{{ smartAsset('web/images/logo_range_rover_2026.png') }}" alt="" class="regate-loghi-rolex" style="width:90%; max-width:90%"/></div>
						</div>
						<div class="regate-loghi-row2" style="flex-wrap: nowrap; margin-top: 10px;">
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_garmin_2026.png') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_slam2.png') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Official Technical Partner</span><img src="{{ smartAsset('web/images/partner_north_sails.jpg') }}" alt=""/></div>
							<div class="regate-loghi-cell"><span>Wellness Technical Partner</span><img src="{{ smartAsset('web/images/partner_technogym_2026.png') }}" alt=""/></div>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>