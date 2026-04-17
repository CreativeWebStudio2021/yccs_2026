@php
	$query_risultati = DB::table('edizioni_risultati');
	$query_risultati = $query_risultati->select('*');
	$query_risultati = $query_risultati->where('id_edizione','=',$id_dett);
	$query_risultati = $query_risultati->where('albodoro','=','0');
	$query_risultati = $query_risultati->orderby('ordine','DESC');
	$query_risultati = $query_risultati->get();
	$num_risultati = $query_risultati->count();	
@endphp
<div>
	@if($num_risultati > 0)
		<div style="z-index:13;transform:translateY(105px); width:500px;" data-title="Risultati" data-margin="530" data-space="1-1" class="link-regata">
			<div style="display:flex;  align-items:center; justify-content:space-between;">
				<h4>{{ $lingua == "ita" ? "Risultati" : "Results" }}</h4>
				<img src="{{ asset('web/images/freccia_thin_up.png') }}" class="arrow-link-regata">
				<img src="{{ asset('web/images/close.png') }}" class="close-link-regata">
			</div>
		</div>
	@else
		<div style="z-index:13;transform:translateY(105px); width:500px; pointer-events: none; color:var(--greyHalfDark) !important; border-color:var(--greyHalfDark) !important;" data-title="Risultati" data-margin="530" data-space="1-1"  class="link-regata">
			<div style="display:flex;  align-items:center; justify-content:space-between;">
				<h4>{{ $lingua == "ita" ? "Risultati" : "Results" }}</h4>
			</div>
		</div>
	@endif
	
	<div style="width:100%; height:1px; position:relative;">
		<div style="z-index:12;visibility:visible !important; top:100%;" class="text-link-regata text-link-regata-Risultati">
			<div style="padding:0 20px">
				@if($num_risultati>0)
					@php
						$chunks = $query_risultati->chunk(ceil($query_risultati->count() / 2));
					@endphp
					<div style="display:flex; gap:20px;">
						@foreach($chunks as $chunk)
							<div style="flex:1;">
								<div style="display:flex; gap:5px; flex-direction:column;  padding-top:20px; padding-bottom:20px;">
									@foreach($chunk as $value_risultati)
										@php
											$link = $lingua=="ita" && $value_risultati->link ? $value_risultati->link : $value_risultati->link_eng;
											$pdf  = $lingua=="ita" && $value_risultati->file ? $value_risultati->file : $value_risultati->file_eng;
											$titolo = $lingua=="ita" && $value_risultati->testo_link ? $value_risultati->testo_link : $value_risultati->testo_link_eng;
										@endphp

										<div class="list-link">
											<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
											@if ($value_risultati->tipo_link=="link" && $link!="")
												<a href="{{ str_starts_with($link,'http') ? $link : config('app.url').'/'.$link }}" target="_blank">
													<span style="font-size:12px;">{{ $titolo }}</span>
												</a>
											@elseif ($value_risultati->tipo_link=="allegato" && $pdf)
												<a href="{{ asset('resarea/files/regate/risultati/'.$pdf) }}" target="_blank">
													<span style="font-size:12px;">{{ $titolo }}</span>
												</a>
											@else
												<span style="font-size:12px;">{{ $titolo }}</span>
											@endif
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