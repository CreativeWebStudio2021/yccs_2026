<div>
	<div style="z-index:4;" data-title="Crew" data-margin="255" data-space="0.4-1.6" class="link-regata">
		<div style="display:flex; z-index:4; align-items:center; justify-content:space-between;">
			<h4>Crew/Boat Board</h4>
			<img src="{{ asset('web/images/freccia_thin_up.png') }}" class="arrow-link-regata">
			<img src="{{ asset('web/images/close.png') }}" class="close-link-regata">
		</div>
	</div>
	<div style="width:100%; height:1px; position:relative;">
		<div style="z-index:12; " class="text-link-regata text-link-regata-Crew">
			<div style="padding:0 20px">
				<div id="regataCrew">
					@include('web.regate.regate_equipaggio')
				</div>
				<div style="width:80%; margin-left:10%;" id="regataForm">
					@include('web.regate.crew_form')
				</div>
			</div>
		</div>
	</div>
</div>