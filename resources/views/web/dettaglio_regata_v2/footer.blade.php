<style>
	#partnerUfficiali{
		width: 675px;
	}
	@media (max-width: 675px) {
		#partnerUfficiali{
			width:100%;
		}
	}
</style>
<!-- FOOTER -->
<footer class="text-grey p-t-0" id="footer" style="font-family:'Open Sans'; background:#fff">
	<div class="footer-content" style="padding:0">
		<div class="container" >
			<div class="row" style="text-align:center; padding:20px 0">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php if($anno_regata<=2020){?>
						<div style="position:relative; text-align:center; margin:0 auto;" id="partnerUfficiali">
							<img src="https://www.yccs.it/web/images/new/loghi.jpg" alt="" style="width:100%;"/>					
							<div style="position:absolute; top:0; left:0; width:30%; height:100%;">
								<a href="https://www.rolex.com/" title="Rolex" target="_blank"><img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%; height:100%;" alt="Rolex"/></a>
							</div>
							<div style="position:absolute; top:0; left:30%; width:40%; height:100%;">
								<a href="https://www.1ocean.org/" title="One Ocean" target="_blank"><img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%; height:100%;" alt="One Ocean"/></a>
							</div>
							<div style="position:absolute; top:0; left:70%; width:30%; height:100%;">
								<a href="https://www.audi.it/it/web/it.html" title="Audi" target="_blank"><img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%; height:100%;" alt="Audi"/></a>
							</div>
						</div>
					<?php }elseif($anno_regata<=2021){?>
						<div style="position:relative; text-align:center; margin:0 auto;" id="partnerUfficiali">
							<img src="https://www.yccs.it/web/images/new/loghi2.jpg" alt="" style="width:100%;"/>					
							<div style="position:absolute; top:0; left:0; width:30%; height:100%;">
								<a href="https://www.rolex.com/" title="Rolex" target="_blank"><img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%; height:100%;" alt="Rolex"/></a>
							</div>
							<div style="position:absolute; top:0; right:0%; width:40%; height:100%;">
								<a href="https://www.1ocean.org/" title="One Ocean" target="_blank"><img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%; height:100%;" alt="One Ocean"/></a>
							</div>
						</div>
					<?php }else{?>
						<div style="position:relative; text-align:center; margin:0 auto;" id="partnerUfficiali">
							<a href="https://www.rolex.com/" title="Rolex" target="_blank">
								<img src="https://www.yccs.it/web/images/new/logo_rolex.jpg" alt=""/>					
							</a>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- END: FOOTER -->