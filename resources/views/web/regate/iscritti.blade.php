<div>
	@php
		$items = collect();
		if($value_ed->lista_iscritti=='1'){
			$link_entry = "regate-".$anno_regata."/entry_list/".creaSlug($nome_regata,"")."-".$id_dett.".html";
			if($lingua=="eng") $link_entry = "en/".$link_entry;
			$items->push([
				'tipo'   => 'link',
				'titolo' => $titolo,
				'href'   => $link_entry,
			]);
		}
		
		$query_iscritti = DB::table('edizioni_iscritti');
		$query_iscritti = $query_iscritti->select('*');
		$query_iscritti = $query_iscritti->where('id_edizione','=',$id_dett);
		$query_iscritti = $query_iscritti->orderby('ordine','DESC');
		$query_iscritti = $query_iscritti->get();
		$num_iscritti = $query_iscritti->count();
	@endphp	
	@if($num_iscritti > 0)
		<div style="z-index:2;" data-title="Iscritti" data-margin="85" data-space="1-1" id="iscritti" class="link-regata">
			<div style="display:flex;  align-items:center; justify-content:space-between;">
				<h4><?php if($lingua=="ita"){?>Iscritti<?php }else{?>Entry List<?php }?></h4>
				<img src="{{ asset('web/images/freccia_thin_up.png') }}" class="arrow-link-regata">
				<img src="{{ asset('web/images/close.png') }}" class="close-link-regata">
			</div>
		</div>
	@else
		<div style="z-index:2; pointer-events: none; color:var(--greyHalfDark) !important; border-color:var(--greyHalfDark) !important;" data-space="1-1"  id="iscritti" class="link-regata">
			<div style="display:flex;  align-items:center; justify-content:space-between;">
				<h4><?php if($lingua=="ita"){?>Iscritti<?php }else{?>Entry List<?php }?></h4>
			</div>
		</div>
	@endif
	@if($num_iscritti > 0)
		@php	
			foreach ($query_iscritti as $iscritti) {
				$link   = $lingua=="ita" && $iscritti->link ? $iscritti->link : $iscritti->link_eng;
				$pdf    = $lingua=="ita" && $iscritti->file ? $iscritti->file : $iscritti->file_eng;
				$titolo = $lingua=="ita" && $iscritti->testo_link ? $iscritti->testo_link : $iscritti->testo_link_eng;

				if ($iscritti->tipo_link=="link" && $link) {
					$items->push([
						'tipo'   => 'link',
						'fisso'  => $iscritti->link_fisso,
						'titolo' => $titolo,
						'href'   => str_starts_with($link,"http") ? $link : config('app.url').'/'.$link,
					]);
				}
				elseif ($iscritti->tipo_link=="allegato" && $pdf) {
					$items->push([
						'tipo'   => 'allegato',
						'fisso'  => $iscritti->link_fisso,
						'titolo' => $titolo,
						'href'   => asset("resarea/files/regate/noticeboard/$pdf"),
					]);
				}
				else {
					$items->push([
						'tipo'   => 'testo',
						'fisso'  => $iscritti->link_fisso,
						'titolo' => $titolo,
						'href'   => null,
					]);
				}
			}

			// 🔹 Divide in 2 colonne
			$chunks = $items->chunk( ceil($items->count() / 2) );
		@endphp
		
		@if($items->count() > 0)
			<div style="width:100%; height:1px; position:relative;">
				<div style="z-index:12;" class="text-link-regata text-link-regata-Iscritti">
					<div style="padding:0 20px">
						<div style="display:flex; gap:20px;">
							@foreach($chunks as $chunk)
								<div style="flex:1;">
									<div style="display:flex; gap:5px; flex-direction:column;  padding-top:20px; padding-bottom:20px;">
										@foreach($chunk as $item)
											<div class="list-link">
												<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
												@if($item['href'])
													@php
														$link_allegato = $item['href'];
														if($item['fisso']==1){
															$link_allegato = "regate-";
															if($lingua=="eng") $link_allegato = "en/regattas-";
															$link_allegato .= $anno_regata."/".creaSlug($nome_regata,"")."-".$id_dett."/iscritti-".$iscritti->id."/".creaSlug($item['titolo'],"");
														}
													@endphp	
													<a href="{{ $link_allegato }}" target="_blank">
														<span style="font-size:12px;">{{ $item['titolo'] }}</span>
													</a>
												@else
													<span style="font-size:12px;">{{ $item['titolo'] }}</span>
												@endif
											</div>
										@endforeach
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		@endif
	@endif
</div>