<div style="display:flex; gap:10px; justify-content:center; margin-bottom:50px;">
	@if($anno_regata<=2020)
		<div style="width:675px; position:relative;">
			<img src="https://www.yccs.it/web/images/new/loghi.jpg" alt="" style="width:100%;"/>
			<div style="position:absolute; width:100%; height:100%; top:0; left:0; display:flex;">
				<a style="flex:1" href="https://www.rolex.com/" title="Rolex" target="_blank">
					<img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%;" alt="Rolex"/>
				</a>
				<a style="flex:1" href="https://www.1ocean.org/" title="One Ocean" target="_blank">
					<img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%;" alt="One Ocean"/>
				</a>
				<a style="flex:1" href="https://www.audi.it/it/web/it.html" title="Audi" target="_blank">
					<img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%;" alt="Audi"/>
				</a>
			</div>
		</div>	
	@elseif($anno_regata<=2021)	
		<div style="width:675px; position:relative;">
			<img src="https://www.yccs.it/web/images/new/loghi2.jpg" alt="" style="width:100%;"/>
			<div style="position:absolute; width:100%; height:100%; top:0; left:0; display:flex;">
				<a style="flex:1" href="https://www.rolex.com/" title="Rolex" target="_blank">
					<img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%;" alt="Rolex"/>
				</a>
				<div style="flex:1"></div>
				<a style="flex:1" href="https://www.1ocean.org/" title="One Ocean" target="_blank">
					<img src="https://www.yccs.it/web/images/new/blank.png" style="width:100%;" alt="One Ocean"/>
				</a>
			</div>
		</div>	
	@else	
		<a href="https://www.rolex.com/" title="Rolex" target="_blank">
			<img src="https://www.yccs.it/web/images/new/logo_rolex.jpg" alt=""/>					
		</a>
	@endif
</div>