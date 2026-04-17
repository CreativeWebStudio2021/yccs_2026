<div id="regata-wrapper" style="height:calc(100vh - 315px); overflow:hidden; position:relative;">
	<div id="regata-scroller" style="display:flex; gap:4px; flex-direction:column; transition:transform 0.3s ease;">		
		@php			
			$mesi = [
				'01' => 'Gennaio',
				'02' => 'Febbraio',
				'03' => 'Marzo',
				'04' => 'Aprile',
				'05' => 'Maggio',
				'06' => 'Giugno',
				'07' => 'Luglio',
				'08' => 'Agosto',
				'09' => 'Settembre',
				'10' => 'Ottobre',
				'11' => 'Novembre',
				'12' => 'Dicembre'
			];

			$id_edh="";
			$query_edh = DB::table('edizioni_regate');
			$query_edh = $query_edh->select('*');
			$query_edh = $query_edh->where('visibile', '=', '1');
			$query_edh = $query_edh->where('anno', '=', date('Y'));	
			$query_edh = $query_edh->orderby('data_dal','ASC');
			$query_edh = $query_edh->get();					
			$num_r = $query_edh->count();
		@endphp
		@foreach($query_edh AS $key_c=>$value_c)
			@php
			$id_edh = $value_c->id;
			$anno_edh = $value_c->anno;
			$luogo_edh = $value_c->luogo;
			$data_dal_edh = $value_c->data_dal;
			$data_al_edh = $value_c->data_al;
			$nome_regata_edh = $value_c->nome_regata;
			$logo_edh = $value_c->logo_edizione;
			$lista_iscritti = $value_c->lista_iscritti;
			$modulo_iscrizioni = $value_c->modulo_iscrizioni;
			
			$perc_logo = "images/loghi/burgee_only_200.jpg";
			$dir_up = "resarea/img_up";				
			if ($logo_edh!="") {
				$perc_logo = "$dir_up/regate/$logo_edh";
				if(file_exists(public_path()."/$dir_up/regate/xs_$logo_edh")) $perc_logo = "$dir_up/regate/xs_$logo_edh";
			}	
			$link_regata="regate-";
			if($lingua=="eng") $link_regata="en/regattas-";
			$link_regata.=$anno_edh."/".creaSlug($nome_regata_edh,"")."-".$id_edh.".html";
			@endphp
			<div class="border-animated regata-row-animate" style="min-height:95px !important; height:calc((100vh - 315px - 11px)/5); overflow:hidden;">
				<div style="display:flex; gap:15px; padding-top:10px;">
					<div style="width:55px;" class="logoRegataDesk">
						<img src="{{ $perc_logo }}" style="width:100%" alt=""/>
					</div>
					<div style="width:130px; display:flex; flex-direction:column;">
						<div style="width:35px;" class="logoRegataTab">
							<img src="{{ $perc_logo }}" style="width:100%" alt=""/>
						</div>
						@php
							$dal_g = $data_dal_edh ? convertDateFormat($data_dal_edh,"Y-m-d","d") : '';
							$al_g  = $data_al_edh  ? convertDateFormat($data_al_edh,"Y-m-d","d")  : '';
							$dal_m = $data_dal_edh ? convertDateFormat($data_dal_edh,"Y-m-d","m") : null;
							$al_m  = $data_al_edh  ? convertDateFormat($data_al_edh,"Y-m-d","m")  : null;
						@endphp
						@if($dal_g && $al_g)
							<span style="font-weight:700; font-size:24px; line-height:20px;">{{ $dal_g }}-{{ $al_g }}</span>
						@endif
						@if($dal_m && isset($mesi[$dal_m]))
							<span style="font-weight:700; font-size:14px;">
								{{ $mesi[$dal_m] }}
								@if($al_m && $dal_m != $al_m && isset($mesi[$al_m]))
									/ {{ $mesi[$al_m] }}
								@endif
							</span>
						@endif
						<span style="font-weight:500; font-size:14px;">{{ $anno_edh }}</span>
					</div>
					<div style="flex:1; border-left:solid 1px;">
						<div style="padding:0 15px ; height:85px; display:flex; flex-direction:column; justify-content:space-between;">
							<div>
								<div class="nomeRegata">{{ $nome_regata_edh }}</div>
								<div style="font-size:14px;">{{ $luogo_edh }}</div>
							</div>
							<a href="{{ $link_regata }}">
								<div class="list-link">
									<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
									<span style="font-size:12px;">
										@if($lingua=='eng' || $lingua=='en')
											Discover the event
										@else 
											Scopri l’evento 
										@endif
									</span>
									<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
								</div>
							</a>
						</div>
					</div>
					<div style="width:185px; margin-top:20px; justify-content:flex-end; display:flex; gap:2px; flex-direction:column">
						@php
							$query_prog = DB::table('edizioni_info');
							$query_prog = $query_prog->select('*');
							$query_prog = $query_prog->where('id_edizione','=',$id_edh);
							$query_prog = $query_prog->where('programma','=','1');
							$query_prog = $query_prog->get();
							$num_prog = $query_prog->count();
						@endphp	
						
						@if($num_prog>0)
							@php								
								if($lingua=="ita" && isset($query_prog[0]->link) && $query_prog[0]->link!="") $link=$query_prog[0]->link; 
									else  $link=$query_prog[0]->link_eng;
								if($lingua=="ita" && isset($query_prog[0]->file) && $query_prog[0]->file!="") $pdf=$query_prog[0]->file; 
									else  $pdf=$query_prog[0]->file_eng;
								$pdf=str_replace("admin/","resarea/",$pdf);
							@endphp			
							
							@if($query_prog[0]->tipo_link=="link" && $link!="")
								<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank">
									<div class="list-link">
										<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
										<span style="font-size:12px;"><?php if($lingua=="ita"){?>Programma<?php }else{?>Programme<?php }?></span>
									</div>
								</a>		
							@elseif($query_prog[0]->tipo_link=="allegato" && $pdf!="")
								@php
									$link_p = "resarea/files/regate/info/".$pdf;
									if($query_prog[0]->link_fisso=="1"){
										$link_p = "regate-";
										$testo_link = $query_prog[0]->testo_link_eng;
										if($lingua=="ita" && isset($query_prog[0]->testo_link) && $query_prog[0]->testo_link!="") $testo_link = $query_prog[0]->testo_link;
										if($lingua=="eng") $link_p = "en/regattas-";
										$link_p .= $anno_edh."/".creaSlug($nome_regata_edh,"")."-".$id_dett."/info-".$query_prog[0]->id."/".creaSlug($testo_link,"");
									}
								@endphp
								<a href="<?php echo $link_p?>" target="_blank">
									<div class="list-link">
										<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
										<span style="font-size:12px;"><?php if($lingua=="ita"){?>Programma<?php }else{?>Programme<?php }?></span>
									</div>
								</a>	
							@endif		
						@else
							<div class="list-link no-hover" style="opacity:0.5; pointer-events: none;">
								<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
								<span style="font-size:12px;"><?php if($lingua=="ita"){?>Programma<?php }else{?>Programme<?php }?></span>
							</div>
						@endif
						
						
						@php
							$query_iscritti = DB::table('edizioni_iscritti');
							$query_iscritti = $query_iscritti->select('*');
							$query_iscritti = $query_iscritti->where('id_edizione','=',$id_edh);
							$query_iscritti = $query_iscritti->orderby('ordine','DESC');
							$query_iscritti = $query_iscritti->get();
							$num_iscritti = $query_iscritti->count();
						@endphp	
						
						@if($num_iscritti==1 && $lista_iscritti=='0')
							@php
								if($lingua=="ita" && $query_iscritti[0]->link &&  $query_iscritti[0]->link!="") $link= $query_iscritti[0]->link; 
									else  $link= $query_iscritti[0]->link_eng;
								if($lingua=="ita" &&  $query_iscritti[0]->file && $query_iscritti[0]->file!="") $pdf=$query_iscritti[0]->file; 
									else  $pdf=$query_iscritti[0]->file_eng;
							@endphp	
							
							@if ($query_iscritti[0]->tipo_link=="link" && $link!="")
								<a href="<?php if(str_replace("http://","",$link)==$link && str_replace("https://","",$link)==$link){?><?php echo config('app.url');?><?php }?><?php echo $link?>" target="_blank">
									<div class="list-link">
										<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
										<span style="font-size:12px;"><?php if($lingua=="ita"){?>Elenco Iscritti Preliminare<?php }else{?>Preliminary Entry List<?php }?></span>
									</div>
								</a>		
							@elseif($query_iscritti[0]->tipo_link=="allegato" && $pdf!="")
								@php
									$link_i = "resarea/files/regate/iscritti/".$pdf;
									if($query_iscritti[0]->link_fisso=="1"){
										$link_i = "regate-";
										$testo_link = $query_iscritti[0]->testo_link_eng;
										if($lingua=="ita" && isset($query_iscritti[0]->testo_link) && $query_iscritti[0]->testo_link!="") $testo_link = $query_iscritti[0]->testo_link;
										if($lingua=="eng") $link_i = "en/regattas-";
										$link_i .= $anno_edh."/".creaSlug($nome_regata_edh,"")."-".$id_dett."/allegato-".$query_iscritti[0]->id."/".creaSlug($testo_link,"");
									}
								@endphp
								<a href="<?php echo $link_i?>" target="_blank">
									<div class="list-link">
										<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
										<span style="font-size:12px;"><?php if($lingua=="ita"){?>Elenco Iscritti Preliminare<?php }else{?>Preliminary Entry List<?php }?></span>
									</div>
								</a>	
							@endif		
						@else
							<div class="list-link no-hover" style="opacity:0.5; pointer-events: none;">
								<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
								<span style="font-size:12px;"><?php if($lingua=="ita"){?>Elenco Iscritti Preliminare<?php }else{?>Preliminary Entry List<?php }?></span>
							</div>
						@endif
						
						@php
							$query_documenti = DB::table('edizioni_doc')
								->where('id_edizione', '=', $id_edh)
								->where('testo_link', '=', 'Bando di Regata')
								->first();
						@endphp
						
						@if($query_documenti)
							@php
								// Link
								if ($lingua=="ita" && $query_documenti->link && $query_documenti->link!="") {
									$link = $query_documenti->link; 
								} else {
									$link = $query_documenti->link_eng;
								}
	
								// PDF
								if ($lingua=="ita" && $query_documenti->file && $query_documenti->file!="") {
									$pdf = $query_documenti->file; 
								} else {
									$pdf = $query_documenti->file_eng;
								}
	
								// Testo link
								$testo_link = $query_documenti->testo_link_eng; 
								if ($lingua=="ita" && $query_documenti->testo_link && $query_documenti->testo_link!="") {
									$testo_link = $query_documenti->testo_link;
								}
	
								// Costruzione URL
								$link_bando = null;
								if ($query_documenti->tipo_link == "link" && $link) {
									if (str_starts_with($link, "http://") || str_starts_with($link, "https://")) {
										$link_bando = $link;
									} else {
										$link_bando = config('app.url').$link;
									}
								} elseif ($query_documenti->tipo_link == "allegato" && $pdf!="") {
									$link_bando = "https://www.yccs.it/resarea/files/regate/doc/".$pdf;
								}
							@endphp
							<a href="{{ $link_bando }}" target="_blank">
								<div class="list-link">
									<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
									<span style="font-size:12px;">{{ $testo_link }}</span>
								</div>
							</a>
						@else
							<div class="list-link no-hover" style="opacity:0.5; pointer-events: none;">
								<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
								<span style="font-size:12px;"><?php if($lingua=="ita"){?>Bando di Regata<?php }else{?>Notice of Race<?php }?></span>
							</div>
						@endif
						
						@php
							$modulo_iscrizioni=0;
							$visibilita=0;
							$query_mod = DB::table('edizioni_modulo_iscrizioni');
							$query_mod = $query_mod->select('*');
							$query_mod = $query_mod->where('id_edizione','=',$id_edh);
							$query_mod = $query_mod->get();
							if($query_mod->count()>0){
								$modulo_iscrizioni=1;
								$visibilita=$query_mod[0]->visibilita;		
							}
						@endphp
						@if($modulo_iscrizioni==1 && $visibilita==1)
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>regate-<?php echo $anno_edh;?>/modulo_iscrizione/<?php echo creaSlug($nome_regata_edh,"");?>-<?php echo $id_edh;?>.html" target="_blank">	
								<div class="list-link">
									<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
									<span style="font-size:12px;"><?php if($lingua=="ita"){?><?php echo $query_mod[0]->testo_modulo_ita;?> Online<?php }else{?>Online <?php echo $query_mod[0]->testo_modulo_eng;?><?php }?></span>
								</div>
							</a>
						@else
							<div class="list-link no-hover" style="opacity:0.5; pointer-events: none;">
								<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
								<span style="font-size:12px;">
									@if($lingua=='eng' || $lingua=='en')
										Registration Form
									@else 
										Modulo  di Iscrizione
									@endif
								</span>
							</div>
						@endif
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>