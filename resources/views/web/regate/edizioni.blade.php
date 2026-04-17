@php
	$query_anni = DB::table('edizioni_regate');
	$query_anni = $query_anni->select('id', 'anno', 'nome_regata');
	$query_anni = $query_anni->where('id_regata', $value_ed->id_regata);
	$query_anni = $query_anni->where('visibile', '=', '1');
	$query_anni = $query_anni->orderby('anno','DESC');
	$query_anni = $query_anni->get();

	$num_anni = $query_anni->count();	
@endphp
<div>
	@if($num_anni > 0)
		<div style="z-index:13;transform:translateY(105px); width:500px;" data-title="Edizioni" data-margin="615" data-space="1-1" class="link-regata">
			<div style="display:flex;  align-items:center; justify-content:space-between;">
				<h4 style="font-size:30px">{{ $lingua == "ita" ? "Altre Edizioni" : "Other Editions" }}</h4>
				<img src="{{ asset('web/images/freccia_thin_up.png') }}" class="arrow-link-regata" style="width:30px; height:auto;">
				<img src="{{ asset('web/images/close.png') }}" class="close-link-regata">
			</div>
		</div>
	@else
		<div style="z-index:13;transform:translateY(105px); width:500px; pointer-events: none; color:var(--greyHalfDark) !important; border-color:var(--greyHalfDark) !important;" data-title="Edizioni" data-margin="615" data-space="1-1">
			<div style="display:flex;  align-items:center; justify-content:space-between;">
				<h4 style="font-size:30px>{{ $lingua == "ita" ? "Altre Edizioni" : "Other Editions" }}</h4>
			</div>
		</div>
	@endif
	
	<div style="width:100%; height:1px; position:relative;">
		<div style="z-index:12;visibility:visible !important; top:100%;" class="text-link-regata text-link-regata-Edizioni">
			<div style="padding:0 20px">
				@if($num_anni>0)
					@php
						$chunks = $query_anni->chunk(ceil($query_anni->count() / 4));
					@endphp
					<div style="display:flex; gap:20px;">
						@foreach($chunks as $chunk)
							<div style="flex:1;">
								<div style="display:flex; gap:5px; flex-direction:column;  padding-top:20px; padding-bottom:20px;">
									@foreach($chunk as $value_risultati)
										@php
											$link = "regate-".$value_risultati->anno."/".creaSlug($value_risultati->nome_regata)."-".$value_risultati->id.".html";
											if($lingua=="eng") $link = "en/".$link;
											$title = "";
										@endphp

										<div class="list-link">
											<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
											<a href="{{ $link }}" title="{{ $title }}">
												<span style="font-size:12px;">{{ $value_risultati->anno }}</span>
											</a>
										</div>
									@endforeach
								</div>
							</div>
						@endforeach
					</div>
				@endif
			</div>
		</div>
	</div>
</div>