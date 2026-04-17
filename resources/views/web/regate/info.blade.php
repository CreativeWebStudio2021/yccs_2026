@php
	$query_info = DB::table('edizioni_info');
	$query_info = $query_info->select('*');
	$query_info = $query_info->where('id_edizione','=',$id_dett);
	$query_info = $query_info->where('programma','=','0');
	$query_info = $query_info->orderby('ordine','DESC');
	$query_info = $query_info->get();
	$num_info = $query_info->count();
@endphp
<div>
	@if($num_info > 0)
		<div style="z-index:11;transform:translateY(105px); width:500px;" data-title="Info" data-margin="445" data-space="1-1" class="link-regata">
			<div style="display:flex;  align-items:center; justify-content:space-between;">
				<h4>{{ $lingua == "ita" ? "Informazioni generali" : "Info" }}</h4>
				<img src="{{ asset('web/images/freccia_thin_up.png') }}" class="arrow-link-regata">
				<img src="{{ asset('web/images/close.png') }}" class="close-link-regata">
			</div>
		</div>
	@else
		<div style="z-index:11;transform:translateY(105px); width:500px; pointer-events: none; color:var(--greyHalfDark) !important; border-color:var(--greyHalfDark) !important;" data-title="Info" data-margin="445" data-space="1-1" class="link-regata">
			<div style="display:flex;  align-items:center; justify-content:space-between;">
				<h4 style="color:var(--greyHalfDark) !important; border-color:var(--greyHalfDark) !important;">{{ $lingua == "ita" ? "Informazioni generali" : "Info" }}</h4>
			</div>
		</div>
	@endif
	
	<div style="width:100%; height:1px; position:relative;">
		<div style="z-index:10;visibility:visible !important; top:100%;" class="text-link-regata text-link-regata-Info">
			<div style="padding:0 20px">
				@if($num_info>0)
					@php
						$chunks = $query_info->chunk(ceil($query_info->count() / 2));
					@endphp
					<div style="display:flex; gap:20px;">
						@foreach($chunks as $chunk)
							<div style="flex:1;">
								<div style="display:flex; gap:5px; flex-direction:column;  padding-top:20px; padding-bottom:20px;">
									@foreach($chunk as $value_info)
										@php
											$link = $lingua=="ita" && $value_info->link ? $value_info->link : $value_info->link_eng;
											$pdf  = $lingua=="ita" && $value_info->file ? $value_info->file : $value_info->file_eng;
											$titolo = $lingua=="ita" && $value_info->testo_link ? $value_info->testo_link : $value_info->testo_link_eng;
										@endphp

										<div class="list-link">
											<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
											@if ($value_info->tipo_link=="link" && $link!="")
												<a href="{{ str_starts_with($link,'http') ? $link : config('app.url').'/'.$link }}" target="_blank">
													<span style="font-size:12px;">{{ $titolo }}</span>
												</a>
											@elseif ($value_info->tipo_link=="allegato" && $pdf)
												<a href="{{ asset('resarea/files/regate/info/'.$pdf) }}" target="_blank">
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