<div style="flex-direction:column; gap:20px;" id="regata-wrapper-mob">
	@php
        // Recuperiamo le edizioni filtrando per data, ma agganciamo i dati della regata base
		$query_edh = DB::table('edizioni_regate as ed')
			->join('regate as r', 'ed.id_regata', '=', 'r.id')
			->select('ed.*', 'r.nome as nome_base', 'r.logo as logo_base') // r.logo_base è il fallback
			->where('ed.anno', '=', date('Y'))
			->where('ed.visibile', '=', '1')
			->where(function($q) {
				$q->where('ed.data_al', '>=', date('Y-m-d'))
				  ->orWhere('ed.data_dal', '>=', date('Y-m-d'));
			})
			->orderBy('ed.data_dal', 'ASC')
			
			->get();

        // Se non ci sono regate future quest'anno, puoi decidere di caricare le ultime passate
        if ($query_edh->isEmpty()){
            $query_edh = DB::table('edizioni_regate as ed')
                ->join('regate as r', 'ed.id_regata', '=', 'r.id')
                ->select('ed.*', 'r.nome as nome_base', 'r.logo as logo_base')
                ->where('ed.visibile', '=', '1')
                ->orderBy('ed.data_dal', 'DESC')
                
                ->get();
        }

        $mesi = [
            '01' => 'Gennaio', '02' => 'Febbraio', '03' => 'Marzo', '04' => 'Aprile',
            '05' => 'Maggio', '06' => 'Giugno', '07' => 'Luglio', '08' => 'Agosto',
            '09' => 'Settembre', '10' => 'Ottobre', '11' => 'Novembre', '12' => 'Dicembre'
        ];
	@endphp

	@foreach($query_edh as $value_edh)
		@php
            // Alias per comodità
            $id_edh = $value_edh->id;
            $anno_edh = $value_edh->anno;
			$logo_edh = $value_edh->logo_edizione;
            $nome_regata_edh = $value_edh->nome_regata;
            
			$perc_logo = "web/images/loghi/burgee_only_200.jpg";
			$dir_up = "resarea/img_up";

			if ($logo_edh!="") {
				$perc_logo = "$dir_up/regate/$logo_edh";
				if(file_exists(public_path()."/$dir_up/regate/xs_$logo_edh")) $perc_logo = "$dir_up/regate/xs_$logo_edh";
			}

            $link_regata = ($lingua == "eng" ? "en/regattas-" : "regate-") . 
                           $anno_edh . "/" . creaSlug($nome_regata_edh, "") . "-" . $id_edh . ".html";
		@endphp

		<div id="regata-scroller-mob" style="display:flex; gap:0px; padding-bottom:10px; border-bottom:solid 1px;" class="rigaRegataMob">
			<div style="flex:1;">
				<div style="display:flex; flex-direction:column; gap:0px;">
					<div style="display:flex; gap:15px;">
						<a href="{{ $link_regata }}" class="link-regata" title="{{ $nome_regata_edh }} - {{ $value_edh->luogo }}">
							<div style="width:55px;">
								<img src="{{ $perc_logo }}" style="width:100%" alt=""/>
							</div>
						</a>
						<div style="display:flex; flex-direction:column;">
							<span style="font-weight:500; font-size:14px;">{{ $anno_edh }}</span>										
							<span style="display:flex; align-items:center; gap:10px;" >
								<span style="font-weight:600; font-size:20px; line-height:20px;">
                                    {{ \Carbon\Carbon::parse($value_edh->data_dal)->format('d') }}-{{ \Carbon\Carbon::parse($value_edh->data_al)->format('d') }}
                                </span>
								<span style="font-weight:600; font-size:14px;">
									{{ $mesi[\Carbon\Carbon::parse($value_edh->data_dal)->format('m')] }}
									@if(\Carbon\Carbon::parse($value_edh->data_dal)->format('m') != \Carbon\Carbon::parse($value_edh->data_al)->format('m'))
										/ {{ $mesi[\Carbon\Carbon::parse($value_edh->data_al)->format('m')] }}
									@endif
								</span>
							</span>
						</div>
					</div>
					<a href="{{ $link_regata }}" class="link-regata" title="{{ $nome_regata_edh }} - {{ $value_edh->luogo }}">
						<div>
							<div class="nomeRegata2">{{ $nome_regata_edh }}</div>
							<div style="font-size:14px;">{{ $value_edh->luogo }}</div>
						</div>
					</a>
				</div>
			</div>

        </div>
	@endforeach	
</div>