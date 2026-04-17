<?php
$_GET['anno'] ? $anno_regata = $_GET['anno'] : '';
$_GET['lingua'] ? $lingua = $_GET['lingua'] : '';

$calendario_ed = $presentazione_ed = "";
$link_fisso_calendario=0;

$query_cal = DB::table('documenti_edizioni')
	->select('link','pdf','pdf_eng','link_fisso')
	->where('anno','=',$anno_regata)
	->where('tipo','=','calendario')
	->orderby('ordine','DESC')
	->limit('1')
	->get();
$num_cal = $query_cal->count();
if($num_cal>0){
	$link_cal = $query_cal[0]->link;
	$pdf_cal = $query_cal[0]->pdf;
	
	if ($pdf_cal!="") {
		if($lingua=="eng" && isset($query_cal[0]->pdf_eng) && $query_cal[0]->pdf_eng!="" && file_exists(public_path()."/resarea/files/edizioni/".$query_cal[0]->pdf_eng))
			$pdf_cal = $query_cal[0]->pdf_eng;
		
		$calendario_ed = "resarea/files/edizioni/$pdf_cal";
		
		if($query_cal[0]->link_fisso==1){
			if($lingua=="ita") $calendario_ed ="regate-$anno_regata/calendario_regate";
			else $calendario_ed = "en/regate-$anno_regata/sporting_calendar";
		}
	}elseif ($link_cal!="") $calendario_ed = "$link_cal";
	
	
	$link_fisso_calendario=$query_cal[0]->link_fisso;
}

$query_pre = DB::table('documenti_edizioni')
	->select('link','pdf','pdf_eng','link_fisso')
	->where('anno','=',$anno_regata)
	->where('tipo','=','presentazione')
	->orderby('ordine','DESC')
	->limit('1')
	->get();
$num_pre = $query_pre->count();
if($num_pre>0){
	$link_pre = $query_pre[0]->link;
	$pdf_pre = $query_pre[0]->pdf;				
	
	if ($pdf_pre!=""){
		if($lingua=="eng" && isset($query_pre[0]->pdf_eng) && $query_pre[0]->pdf_eng!="" && file_exists(public_path()."/resarea/files/edizioni/".$query_pre[0]->pdf_eng))
			$pdf_cal = $query_pre[0]->pdf_eng;
		
		$presentazione_ed = "resarea/files/edizioni/$pdf_pre";
		
		if($query_pre[0]->link_fisso==1){
			if($lingua=="ita") $presentazione_ed ="regate-$anno_regata/presentazione";
			else $presentazione_ed = "en/regate-$anno_regata/presentation";
		}
	}elseif ($link_pre!="") $presentazione_ed = "$link_pre";
}

$query_lista = DB::table('lista')
	->select('*')
	->get();
$num_lista = $query_lista->count();

if($num_lista>0){
	$testo_lista=$query_lista[0]->link_eng;
	if($lingua=="ita" && $query_lista[0]->link && $query_lista[0]->link!="" && $query_lista[0]->link!=" ") $testo_lista=$query_lista[0]->link;
	$pdf_lista=$query_lista[0]->pdf_eng;
	if($lingua=="ita" && $query_lista[0]->pdf && $query_lista[0]->pdf!="") $pdf_lista=$query_lista[0]->pdf;
}
?>

<div style="padding-right:0px;">	
	<div style="margin-top:15px; width:100%;  padding-top:10px; border-top:solid 2px var(--azzurro);">
		<div class="bottoni-calendario-container" style="display:flex; flex-wrap:wrap; gap:8px; justify-content:space-between;">
			@if(!empty($calendario_ed))
				<a href="<?php  echo $calendario_ed; ?>" target="_blank">	
					<div style="width:200px; font-size:13px; padding-top:7px; padding-bottom:7px;" class="btnYccsGradient">
						{{ $lingua=="ita" ? 'Scarica il Calendario' : 'Download the Sporting Calendar'}} {{ $anno_regata }}
					</div>								
				</a>
			@endif
			@if(!empty($predentazione_ed))
				<a href="<?php  echo $predentazione_ed; ?>" target="_blank">	
					<div style="width:200px; font-size:13px; padding-top:7px; padding-bottom:7px;" class="btnYccsGradient">
						{{ $lingua=="ita" ? 'Presentazione Stagione' : 'Presentation'}} {{ $anno_regata }}
					</div>								
				</a>
			@endif
			@if(!empty($testo_lista) && !empty($pdf_lista))
				<a href="{!! $lingua=='ita' ?  'regate/yccs-sporting-calendar' : 'en/regattas/yccs-sporting-calendar' !!}" target="_blank">	
					<div style="width:200px; font-size:13px; padding-top:7px; padding-bottom:7px;" class="btnYccsGradient">
						<?php echo $testo_lista;?>
					</div>								
				</a>
			@endif
		</div>								
		<?php /*
		<div style="width:100px;  display:flex; gap:15px;">
			<img src="{{ asset('web/images/freccia_giu.png') }}" onclick="sali('<?php echo $anno_regata;?>')" class="arrow-btn" id="arrow-down" data-el="0"  data-default="freccia_giu.png" data-hover="freccia_giu_on.png" style="width:43px; cursor:pointer; transition: all 1s;" alt=""/>
			<img src="{{ asset('web/images/freccia_su.png') }}" onclick="scendi('<?php echo $anno_regata;?>')" class="arrow-btn" id="arrow-up" data-el="0" data-default="freccia_su.png" data-hover="freccia_su_on.png" style="width:43px; opacity:0.5;  transition: all 1s;" alt=""/>
		</div> */?>
	</div>
</div>