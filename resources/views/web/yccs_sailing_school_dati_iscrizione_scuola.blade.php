@php	
	if(isset($_GET['id_pers'])) $id_pers=$_GET['id_pers'];
	if(isset($_GET['id_ute'])) $id_ute=$_GET['id_ute'];
	if(isset($_GET['lingua'])) $lingua=$_GET['lingua'];
	if(isset($_GET['fam'])) $fam=$_GET['fam'];

	if(isset($_GET['nome'])) $nome = $_GET['nome']; else  $nome="";
	if(isset($_GET['cognome'])) $cognome = $_GET['cognome']; else  $cognome="";
	if(isset($_GET['indirizzo'])) $indirizzo = $_GET['indirizzo']; else  $indirizzo="";
	if(isset($_GET['cap'])) $cap = $_GET['cap']; else  $cap="";
	if(isset($_GET['citta'])) $citta = $_GET['citta']; else  $citta="";
	if(isset($_GET['provincia'])) $provincia = $_GET['provincia']; else  $provincia="";
	if(isset($_GET['nazione'])) $nazione = $_GET['nazione']; else  $nazione="";
	if(isset($_GET['luogo_nascita'])) $luogo_nascita = $_GET['luogo_nascita']; else  $luogo_nascita="";
	if(isset($_GET['nazione_nascita'])) $nazione_nascita = $_GET['nazione_nascita']; else  $nazione_nascita="";
	if(isset($_GET['data_nascita'])) $data_nascita = $_GET['data_nascita']; else  $data_nascita="";
	if(isset($_GET['codice_fiscale'])) $codice_fiscale = $_GET['codice_fiscale']; else  $codice_fiscale="";
	if(isset($_GET['tesseramento'])) $tesseramento = $_GET['tesseramento']; else  $tesseramento="";
	if(isset($_GET['gia_tesserato'])) $gia_tesserato = $_GET['gia_tesserato']; else  $gia_tesserato="";
	if(isset($_GET['circolo'])) $circolo = $_GET['circolo']; else  $circolo="";
	if(isset($_GET['tipo'])) $tipo = $_GET['tipo']; else $tipo="";
	if(isset($_GET['extra'])) $tipo = $_GET['extra']; else $extra="";
	if(isset($_GET['costo_settimane_in_piu'])) $costo_settimane_in_piu = $_GET['costo_settimane_in_piu']; else  $costo_settimane_in_piu="";
	if(isset($_GET['costo_giorni_in_piu'])) $costo_giorni_in_piu = $_GET['costo_giorni_in_piu']; else  $costo_giorni_in_piu="";
	if(isset($_GET['costo_mezza_settimana'])) $costo_mezza_settimana = $_GET['costo_mezza_settimana']; else  $costo_mezza_settimana="";
	if(isset($_GET['costo_prima_sett'])) $costo_prima_sett = $_GET['costo_prima_sett']; else  $costo_prima_sett="";
	if(isset($_GET['costo_extra'])) $costo_extra = $_GET['costo_extra']; else  $costo_extra="";
	if(isset($_GET['num_settimane'])) $num_settimane = $_GET['num_settimane']; else  $num_settimane="";
	if(isset($_GET['num_settimane_2'])) $num_settimane_2 = $_GET['num_settimane_2']; else  $num_settimane_2="";
	if(isset($_GET['num_giorni'])) $num_giorni = $_GET['num_giorni']; else  $num_giorni="";
	if(isset($_GET['num_giorni_2'])) $num_giorni_2 = $_GET['num_giorni_2']; else  $num_giorni_2="";
	if(isset($_GET['num_mesi'])) $num_mesi = $_GET['num_mesi']; else  $num_mesi="";
	if(isset($_GET['num_extra'])) $num_extra = $_GET['num_extra']; else  $num_extra="";
	if(isset($_GET['costo_mesi'])) $costo_mesi = $_GET['costo_mesi']; else  $costo_mesi="";
	if(isset($_GET['durata'])) $durata = $_GET['durata']; else  $durata="";
	if(isset($_GET['CI'])) $CI = $_GET['CI']; else  $CI="";
	if(isset($_GET['CF'])) $CF = $_GET['CF']; else  $CF="";
/* TEMP DISABLED: certificato medico upload
if(isset($_GET['CM'])) $CM = $_GET['CM']; else  $CM="";
*/
	
	if($id_ute!=""){ 
		$query_isc = DB::table('iscrizioni_scuola')
			->select('*')
			->where('id','=',$id_ute)
			->get();
		$num_isc = $query_isc->count();
		
		if($num_isc>0){
			foreach($query_isc[0] as $key => $value) {
				$$key = $value;				
			}
		}
		$durata = "Prima settimana";
	}
	
	function date_to_data($data){
		$temp = explode("-",$data);
		return $temp[2]."-".$temp[1]."-".$temp[0];
	}
@endphp
<div class="tabs tabs-folder" style="margin:20px 0">
	<div style="position:relative;">
		<ul class="nav nav-tabs" id="myTab3" role="tablist">
			<li class="nav-item">
				<a style="color:#8D8D8D;" class="nav-link active" id="home-tab" data-toggle="tab" href="#Le_Derive" role="tab" aria-controls="home" aria-selected="true">
					<b>
					<?php if($id_pers==1) {?>
						<?php if($lingua=="ita"){?>Dati Personali<?php }else{?>Personal Data<?php }?>
					<?php }else{?>
						<?php if($lingua=="ita"){?>Familiare Aggiuntivo <?php echo $id_pers-1;?><?php }else{?>Additional member of the family  <?php echo $id_pers-1;?><?php }?>
					<?php }?>
					</b>
				</a>
			</li>
		</ul>
		
		<?php if($id_pers>1){?>
			<div style="position:absolute; top:6px; right:5px; width:80px; height:20px; background:red;">
				<div id="annullaRadioTipoBarca" style="width:80px; text-align:center; background:#333; color:#fff; border-radius:2px; cursor:pointer;" onclick="cancellaDati('<?php echo $id_pers;?>');">
					<div style="padding:2px;"><?php if($lingua=="ita"){?>annulla<?php }else{?>remove<?php }?></div>
				</div>
			</div>
		<?php }?>
	</div>
	<div class="tab-content" id="myTabContent3">
		<div class="tab-pane fade show active" id="Le_Derive" role="tabpanel" aria-labelledby="home-tab">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Periodo<?php }else{?>Period<?php }?></label>
						<input type="text" readonly="readonly" onclick="this.removeAttribute('readonly');" class="form-control <?php echo $id_pers;?>_mws-datepicker required" style="float:left; margin-right:20px; width:150px;" value="<?php if(/*$id_pers==*/1) { if(isset($dal) && $dal!="0000-00-00") echo date_to_data($dal);}?>" name="<?php echo $id_pers;?>_dal"  id="<?php echo $id_pers;?>_dal" placeholder="<?php if($lingua=="ita"){?>Dal (gg-mm-aaaa)<?php }else{?>From (dd-mm-yyyy)<?php }?>" aria-required="true" onchange="checkDate_<?php echo $id_pers;?>(); cambioDataInizio_<?php echo $id_pers;?>()">
						<input type="text" readonly="readonly" onclick="this.removeAttribute('readonly');" class="form-control <?php echo $id_pers;?>_mws-datepicker required" style="float:left; margin-right:20px; width:150px;" value="<?php if(/*$id_pers==*/1) { if(isset($al) && $al!="0000-00-00") echo date_to_data($al);}?>" name="<?php echo $id_pers;?>_al" id="<?php echo $id_pers;?>_al" placeholder="<?php if($lingua=="ita"){?>Al (gg-mm-aaaa)<?php }else{?>To (dd-mm-yyyy)<?php }?>" aria-required="true" onchange="checkDate_<?php echo $id_pers;?>();">
						<div style="clear:both"></div>
					</div>
				</div>				
			</div>
			
			<script>
				function checkDate_<?php echo $id_pers;?>(){
					var dal = document.getElementById('<?php echo $id_pers;?>_dal').value;
					if(dal && dal!=""){
						var myarr = dal.split("-");
						dal = myarr[2] + "-" + myarr[1] + "-" + myarr[0];
					}				
					var al = document.getElementById('<?php echo $id_pers;?>_al').value;
					if(al && al!=""){
						var myarr2 = al.split("-");
						al = myarr2[2] + "-" + myarr2[1] + "-" + myarr2[0];
					}
					if(dal && dal!="" && al && al!=""){
						if(dal>al) {
							<?php if($lingua=="ita"){?>
								alert("Inserire intervallo di date corretto");
							<?php }else{?>
								alert("Please enter correct date range");							
							<?php }?>
							document.getElementById('<?php echo $id_pers;?>_al').value="";
						}
					}
				}
			</script>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Nome<?php }else{?>Name<?php }?>*</label>
						<input type="text" class="form-control required" name="<?php echo $id_pers;?>_nome" id="<?php echo $id_pers;?>_nome" value="<?php echo $nome;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Nome<?php }else{?>Enter Name<?php }?>" aria-required="true">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Cognome<?php }else{?>Surname<?php }?>*</label>
						<input type="text" class="form-control required" name="<?php echo $id_pers;?>_cognome" id="<?php echo $id_pers;?>_cognome" value="<?php echo $cognome;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Nome<?php }else{?>Enter Surname<?php }?>" aria-required="true">
					</div>
				</div>				
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="upper" for="email"><?php if($lingua=="ita"){?>Indirizzo<?php }else{?>Address<?php }?>*</label>
						<input type="email" class="form-control required" name="<?php echo $id_pers;?>_indirizzo" id="<?php echo $id_pers;?>_indirizzo" value="<?php echo $indirizzo;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Indirizzo<?php }else{?>Enter Address<?php }?>" aria-required="true">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>CAP<?php }else{?>Postcode<?php }?>*</label>
						<input type="text" class="form-control required" name="<?php echo $id_pers;?>_cap" id="<?php echo $id_pers;?>_cap" value="<?php echo $cap;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci CAP<?php }else{?>Enter Postcode<?php }?>" aria-required="true">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Citt&agrave;<?php }else{?>Town<?php }?>*</label>
						<input type="text" class="form-control required" name="<?php echo $id_pers;?>_citta" id="<?php echo $id_pers;?>_citta" value="<?php echo $citta;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Citt&agrave;<?php }else{?>Enter Town<?php }?>" aria-required="true">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Provincia<?php }else{?>County<?php }?>*</label>
						<input type="text" class="form-control required" name="<?php echo $id_pers;?>_provincia" id="<?php echo $id_pers;?>_provincia" value="<?php echo $provincia;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Provincia<?php }else{?>Enter County<?php }?>" aria-required="true">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Nazione<?php }else{?>Country<?php }?>*</label>
						
						<select style="width:100%;"  class="form-control required" required="required" name="<?php echo $id_pers;?>_nazione" id="<?php echo $id_pers;?>_nazione">
							<option value=""><?php if($lingua=="ita"){?>Inserisci Nazione<?php }else{?>Enter Country<?php }?></option>
							<option value=""></option>
							@php
								$query_prefix = DB::table('dialing_codes')
									->select('*')
									->orderby('ordine','DESC')
									->orderby('Country','ASC')
									->get();
							@endphp
							@foreach($query_prefix AS $key_prefix=>$value_prefix)
								<option value="<?php echo $value_prefix->Country;?>" <?php if($id_pers==1 && $nazione!="" && $nazione==$value_prefix->Country){?>selected="selected"<?php }?>><?php echo $value_prefix->Country;?></option>
								<?php if($value_prefix->ordine==1){?>
									<option value="">-------------------------</option>
								<?php }?>
							@endforeach
						</select>						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Luogo di nascita<?php }else{?>Place of Birth<?php }?>*</label>
						<input type="text" class="form-control required" name="<?php echo $id_pers;?>_luogo_nascita" id="<?php echo $id_pers;?>_luogo_nascita" value="<?php echo $luogo_nascita;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Luogo di nascita<?php }else{?>Enter Place of Birth<?php }?>" aria-required="true">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Nazione di nascita<?php }else{?>Birth Country<?php }?>*</label>
						<select style="width:100%;"  class="form-control required" required="required" name="<?php echo $id_pers;?>_nazione_nascita" id="<?php echo $id_pers;?>_nazione_nascita">
							<option value=""><?php if($lingua=="ita"){?>Inserisci Nazione di nascita<?php }else{?>Enter Birth Country<?php }?></option>
							<option value=""></option>
							@php
								$query_prefix = DB::table('dialing_codes')
									->select('*')
									->orderby('ordine','DESC')
									->orderby('Country','ASC')
									->get();
							@endphp
							@foreach($query_prefix AS $key_prefix=>$value_prefix)
								<option value="<?php echo $value_prefix->Country;?>" <?php if($nazione_nascita!="" && $nazione_nascita==$value_prefix->Country){?>selected="selected"<?php }?>><?php echo $value_prefix->Country;?></option>
								<?php if($value_prefix->ordine==1){?>
									<option value="">-------------------------</option>
								<?php }?>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Data di nascita<?php }else{?>Date of Birth<?php }?>*</label>
						<input type="text" readonly="readonly" onclick="this.removeAttribute('readonly');" class="form-control <?php echo $id_pers;?>_mws-datepicker required" name="<?php echo $id_pers;?>_data_nascita" id="<?php echo $id_pers;?>_data_nascita" value="<?php echo $data_nascita;?>" placeholder="<?php if($lingua=="ita"){?>gg-mm-aaaa<?php }else{?>dd-mm-yyyy<?php }?>" aria-required="true">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="upper" for="email"><?php if($lingua=="ita"){?>Codice Fiscale<?php }else{?>Tax Code<?php }?>**</label>
						<input type="email" class="form-control required" name="<?php echo $id_pers;?>_codice_fiscale" id="<?php echo $id_pers;?>_codice_fiscale" value="<?php echo $codice_fiscale;?>" placeholder="<?php if($lingua=="ita"){?>Inserisci Codice Fiscale<?php }else{?>Enter Tax Code<?php }?>" aria-required="true">
					</div>
				</div>
			</div>
			<div style="margin-bottom:15px;">
				<i  style="color:#8D8D8D; font-family:'Open Sans' !important; font-style:italic">
				<?php if($lingua=="ita"){?>
					L’Allievo neo iscritto dovrà consegnare copia di un Documento di Identità, del Codice Fiscale e un certificato medico di sana e robusta costituzione per attività non agonistica.
				<?php }else{?>
					The newly-registered student will have to deliver a copy of an identity document, a tax code and a medical certificate of healthy and robust constitution for non-competitive activities
				<?php }?>
				</i>
			</div>
			
			
			
			<?php 
			// variabili per Corsi J24
			$anno_j24 = date("Y");
			$luglio_dal = $anno_j24."-06-30";
			$luglio_al = $anno_j24."-08-03";
			$agosto_dal = $anno_j24."-08-04";
			$agosto_al = $anno_j24."-08-31";
			$mag_set_prima = $anno_j24."-06-29";
			$mag_set_dopo = $anno_j24."-09-01";
			$j24_prima_sett_set_mag = "750";
			$j24_sett_in_piu_set_mag = "690";
			$j24_prima_sett_luglio = "870";
			$j24_sett_in_piu_luglio = "800";
			$j24_prima_sett_agosto = "910";
			$j24_sett_in_piu_agosto = "840";
			
			$x=0;
			// DERIVE MAGGIO/SETTEMBRE
			$x++; $prezzi_tipo[$x]['prima']="380";$prezzi_tipo[$x]['seconda']="320";$prezzi_tipo[$x]['giorni']="60";$prezzi_tipo[$x]['mezza']="220";$prezzi_tipo[$x]['mese']="0";
			$x++; $prezzi_tipo[$x]['prima']="440";$prezzi_tipo[$x]['seconda']="380";$prezzi_tipo[$x]['giorni']="70";$prezzi_tipo[$x]['mezza']="280";$prezzi_tipo[$x]['mese']="0";
			// DERIVE OTTOBRE/APRILE
			$x++; $prezzi_tipo[$x]['prima']="0";$prezzi_tipo[$x]['seconda']="0";$prezzi_tipo[$x]['giorni']="0";$prezzi_tipo[$x]['mezza']="0";$prezzi_tipo[$x]['mese']="100";
			// CABINATI
			$x++; $prezzi_tipo[$x]['prima']="400";$prezzi_tipo[$x]['seconda']="340";$prezzi_tipo[$x]['giorni']="65";$prezzi_tipo[$x]['mezza']="240";$prezzi_tipo[$x]['mese']="0";
			$x++; $prezzi_tipo[$x]['prima']="450";$prezzi_tipo[$x]['seconda']="400";$prezzi_tipo[$x]['giorni']="75";$prezzi_tipo[$x]['mezza']="300";$prezzi_tipo[$x]['mese']="0";
			// J24 con alloggio
			$x++; $prezzi_tipo[$x]['prima']=$j24_prima_sett_set_mag;$prezzi_tipo[$x]['seconda']=$j24_sett_in_piu_set_mag;$prezzi_tipo[$x]['giorni']="0";$prezzi_tipo[$x]['mezza']="470";$prezzi_tipo[$x]['mese']="0";
			$x++; $prezzi_tipo[$x]['prima']=$j24_prima_sett_luglio;$prezzi_tipo[$x]['seconda']=$j24_sett_in_piu_luglio;$prezzi_tipo[$x]['giorni']="0";$prezzi_tipo[$x]['mezza']="0";$prezzi_tipo[$x]['mese']="0";
			$x++; $prezzi_tipo[$x]['prima']=$j24_prima_sett_agosto;$prezzi_tipo[$x]['seconda']=$j24_sett_in_piu_agosto;$prezzi_tipo[$x]['giorni']="0";$prezzi_tipo[$x]['mezza']="0";$prezzi_tipo[$x]['mese']="0";
			// J24 con alloggio
			$x++; $prezzi_tipo[$x]['prima']="0";$prezzi_tipo[$x]['seconda']="0";$prezzi_tipo[$x]['giorni']="0";$prezzi_tipo[$x]['mezza']="0";$prezzi_tipo[$x]['mese']="0";$prezzi_tipo[$x]['extra']="140";
			$ind_sel="";
			$ind=1;						
			
			?>
			<div class="row" style="margin-top:30px;">
				<div class="col-md-12">
					<div class="form-group">
						<label class="upper" for="name">
							<b><?php if($lingua=="ita"){?>Tipologia del corso<?php }else{?>Type of Courses<?php }?>*</b>
						</label>								
					</div>
					<div class="table-responsive">
						<input type="hidden" name="<?php echo $id_pers;?>_tipo" id="<?php echo $id_pers;?>_tipo" value="<?php echo $tipo;?>"/>
						<input type="hidden" name="<?php echo $id_pers;?>_extra" id="<?php echo $id_pers;?>_extra" value="<?php echo $extra;?>"/>
						<input type="hidden" name="<?php echo $id_pers;?>_costo_prima_sett" id="<?php echo $id_pers;?>_costo_prima_sett" value="<?php echo $costo_prima_sett;?>"/>
						<input type="hidden" name="<?php echo $id_pers;?>_costo_settimane_in_piu" id="<?php echo $id_pers;?>_costo_settimane_in_piu" value="<?php echo $costo_settimane_in_piu;?>"/>
						<input type="hidden" name="<?php echo $id_pers;?>_costo_giorni_in_piu" id="<?php echo $id_pers;?>_costo_giorni_in_piu" value="<?php echo $costo_giorni_in_piu;?>"/>
						<input type="hidden" name="<?php echo $id_pers;?>_costo_mezza_settimana" id="<?php echo $id_pers;?>_costo_mezza_settimana" value="<?php echo $costo_mezza_settimana;?>"/>
						<input type="hidden" name="<?php echo $id_pers;?>_costo_mesi" id="<?php echo $id_pers;?>_costo_mesi" value="<?php echo $costo_mesi;?>"/>
						<input type="hidden" name="<?php echo $id_pers;?>_costo_extra" id="<?php echo $id_pers;?>_costo_extra" value="<?php echo $costo_extra;?>"/>
						<table class="table table-striped" style="color:#8D8D8D;">
							<thead>
								<tr>
									<td></td>
									<td><?php if($lingua=="ita"){?>Prima settimana<?php }else{?>First week<?php }?></td>
									<td><?php if($lingua=="ita"){?>Seconda settimana<br/>e successive<?php }else{?>Second week and later <?php }?></td>
									<td><?php if($lingua=="ita"){?>Ogni giorno in più successivo<br/>alla prima settimana<?php }else{?>Every day more after the first week<?php }?></td>
									<td><?php if($lingua=="ita"){?>Mezza Settimana <br/>3 Giorni<?php }else{?>Half a Week<br/>3 Days<?php }?></td>
									<td><?php if($lingua=="ita"){?>Mese<?php }else{?>Month<?php }?></td>
								</tr>
							</thead>
							<tbody>
								<?php ?>
								<tr><td colspan="6"><b><?php if($lingua=="ita"){?>CORSI DERIVE (Maggio/Settembre)<?php }else{?>DINGHIES (May/September)<?php }?></b></td></tr>
								<tr>
									<td>
										<div style="float:left;width:20px; margin-top:0px;">
											<input type="radio" name="<?php echo $id_pers;?>_tipo_val" id="<?php echo $id_pers;?>_derive_6_18" class="radioPagamento" <?php if($tipo=="Corsi derive dai 6 ai 18 anni" || $tipo=="Corsi derive from 6 to 18 years" ){$ind_sel=$ind; ?>checked="checked"<?php }?> style="padding-top:3px;" value="Corsi derive <?php if($lingua=="ita"){?>dai 6 ai 18 anni<?php }else{?>from 6 to 18 years<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_tipo').value=this.value; document.getElementById('<?php echo $id_pers;?>_durata').value='<?php if($lingua=="ita"){?>Prima settimana<?php }else{?>First week<?php }?>'; vediMore_<?php echo $id_pers;?>('<?php echo $prezzi_tipo[$ind]['prima'];?>','<?php echo $prezzi_tipo[$ind]['seconda'];?>','<?php echo $prezzi_tipo[$ind]['giorni'];?>','<?php echo $prezzi_tipo[$ind]['mezza'];?>','<?php echo $prezzi_tipo[$ind]['mese'];?>')">
										</div>
										<div style="float:left;  width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<?php if($lingua=="ita"){?>Corsi derive dai 6 ai 18 anni<?php }else{?>Dinghies from 6 to 18 years<?php }?>
										</div>
										<div style="clear:both"></div>
									</td>
									<td>
										<?php echo $prezzi_tipo[$ind]['prima'];?> €
									</td>
									<td><?php echo $prezzi_tipo[$ind]['seconda'];?> €</td>
									<td><?php echo $prezzi_tipo[$ind]['giorni'];?> € <?php if($lingua=="ita"){?>al giorno<?php }else{?>per day<?php }?></td>
									<td><?php echo $prezzi_tipo[$ind]['mezza'];?> €</td>
									<td>-</td>
								</tr>
								<?php $ind++;?>
								<tr>
									<td>
										<div style="float:left;width:20px; margin-top:0px;">
											<input type="radio" name="<?php echo $id_pers;?>_tipo_val" id="<?php echo $id_pers;?>_derive_18" class="radioPagamento" <?php if($tipo=="Corsi derive oltre i 18 anni" || $tipo=="Corsi derive over 18 years" ){$ind_sel=$ind; ?>checked="checked"<?php }?> style="padding-top:3px;" value="Corsi derive <?php if($lingua=="ita"){?>oltre i 18 anni<?php }else{?>over 18 years<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_tipo').value=this.value;  document.getElementById('<?php echo $id_pers;?>_durata').value='<?php if($lingua=="ita"){?>Prima settimana<?php }else{?>First week<?php }?>'; vediMore_<?php echo $id_pers;?>('<?php echo $prezzi_tipo[$ind]['prima'];?>','<?php echo $prezzi_tipo[$ind]['seconda'];?>','<?php echo $prezzi_tipo[$ind]['giorni'];?>','<?php echo $prezzi_tipo[$ind]['mezza'];?>','<?php echo $prezzi_tipo[$ind]['mese'];?>')">
										</div>
										<div style="float:left; width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<?php if($lingua=="ita"){?>Corsi derive oltre i 18 anni<?php }else{?>Dinghies over 18 years<?php }?>
										</div>
										<div style="clear:both"></div>
									</td>
									<td>
										<?php echo $prezzi_tipo[$ind]['prima'];?> €
									</td>
									<td><?php echo $prezzi_tipo[$ind]['seconda'];?> €</td>
									<td><?php echo $prezzi_tipo[$ind]['giorni'];?> € <?php if($lingua=="ita"){?>al giorno<?php }else{?>per day<?php }?></td>
									<td><?php echo $prezzi_tipo[$ind]['mezza'];?> €</td>
									<td>-</td>
								</tr>
								<?php $ind++;?>
								<tr><td colspan="6"style="border-top:solid 2px #8D8D8D"><b><?php if($lingua=="ita"){?>CORSI DERIVE (Ottobre/Aprile)<?php }else{?>DINGHIES (October/April)<?php }?></b></td></tr>
								<tr>
									<td>
										<div style="float:left;width:20px; margin-top:0px;">
											<input type="radio" name="<?php echo $id_pers;?>_tipo_val" id="<?php echo $id_pers;?>_derive_inverno" class="radioPagamento" <?php if($tipo=="Corsi derive ottobre-aprile" || $tipo=="Corsi derive october-april" ){$ind_sel=$ind; ?>checked="checked"<?php }?> style="padding-top:3px;" value="Corsi derive <?php if($lingua=="ita"){?>ottobre-aprile<?php }else{?>october-april<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_tipo').value=this.value; document.getElementById('<?php echo $id_pers;?>_durata').value='Mensile'; vediMore_<?php echo $id_pers;?>('<?php echo $prezzi_tipo[$ind]['prima'];?>','<?php echo $prezzi_tipo[$ind]['seconda'];?>','<?php echo $prezzi_tipo[$ind]['giorni'];?>','<?php echo $prezzi_tipo[$ind]['mezza'];?>','<?php echo $prezzi_tipo[$ind]['mese'];?>')">
										</div>
										<div style="float:left;  width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<?php if($lingua=="ita"){?>Corsi derive dai 10 ai 18 anni<?php }else{?>Dinghies from 10 to 18 years<?php }?>
										</div>
										<div style="clear:both"></div>
									</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td><?php echo $prezzi_tipo[$ind]['mese'];?> €</td>
								</tr>
								<?php $ind++;?>
								<tr><td colspan="6"style="border-top:solid 2px #8D8D8D"><b><?php if($lingua=="ita"){?>CORSI CABINATI (Maggio/Settembre)<?php }else{?>KEELBOATS (May/September)<?php }?></b></td></tr>
								<tr>
									<td>
										<div style="float:left;width:20px; margin-top:0px;">
											<input type="radio" name="<?php echo $id_pers;?>_tipo_val" id="<?php echo $id_pers;?>_cabinato_12_18" class="radioPagamento" <?php if($tipo=="Corsi cabinati dai 12 ai 18 anni" || $tipo=="Corsi cabinati from 12 to 18 years" ){$ind_sel=$ind; ?>checked="checked"<?php }?> style="padding-top:3px;" value="Corsi cabinati <?php if($lingua=="ita"){?>dai 12 ai 18 anni<?php }else{?>from 12 to 18 years<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_tipo').value=this.value;  document.getElementById('<?php echo $id_pers;?>_durata').value='<?php if($lingua=="ita"){?>Prima settimana<?php }else{?>First week<?php }?>'; vediMore_<?php echo $id_pers;?>('<?php echo $prezzi_tipo[$ind]['prima'];?>','<?php echo $prezzi_tipo[$ind]['seconda'];?>','<?php echo $prezzi_tipo[$ind]['giorni'];?>','<?php echo $prezzi_tipo[$ind]['mezza'];?>','<?php echo $prezzi_tipo[$ind]['mese'];?>')">
										</div>
										<div style="float:left; width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<?php if($lingua=="ita"){?>Corsi cabinati dai 12 ai 18 anni<?php }else{?>Keelboats from 12 to 18 years<?php }?>
										</div>
										<div style="clear:both"></div>
									</td>
									<td>
										<?php echo $prezzi_tipo[$ind]['prima'];?> €
									</td>
									<td><?php echo $prezzi_tipo[$ind]['seconda'];?> €</td>
									<td><?php echo $prezzi_tipo[$ind]['giorni'];?> € <?php if($lingua=="ita"){?>al giorno<?php }else{?>per day<?php }?></td>
									<td><?php echo $prezzi_tipo[$ind]['mezza'];?> €</td>
									<td>-</td>
								</tr>
								<?php $ind++;?>
								<tr>
									<td>
										<div style="float:left;width:20px; margin-top:0px;">
											<input type="radio" name="<?php echo $id_pers;?>_tipo_val" id="<?php echo $id_pers;?>_cabinato_18" class="radioPagamento" <?php if($tipo=="Corsi cabinati oltre i 18 anni" || $tipo=="Corsi cabinati over 18 years" ){$ind_sel=$ind; ?>checked="checked"<?php }?> style="padding-top:3px;" value="Corsi cabinati <?php if($lingua=="ita"){?>oltre i 18 anni<?php }else{?>over 18 years<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_tipo').value=this.value;  document.getElementById('<?php echo $id_pers;?>_durata').value='<?php if($lingua=="ita"){?>Prima settimana<?php }else{?>First week<?php }?>';  vediMore_<?php echo $id_pers;?>('<?php echo $prezzi_tipo[$ind]['prima'];?>','<?php echo $prezzi_tipo[$ind]['seconda'];?>','<?php echo $prezzi_tipo[$ind]['giorni'];?>','<?php echo $prezzi_tipo[$ind]['mezza'];?>','<?php echo $prezzi_tipo[$ind]['mese'];?>')">
										</div>
										<div style="float:left;  width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<?php if($lingua=="ita"){?>Corsi cabinati oltre i 18 anni<?php }else{?>Keelboats over 18 years<?php }?>
										</div>
										<div style="clear:both"></div>											
									<td>
										<?php echo $prezzi_tipo[$ind]['prima'];?> €
									</td>
									<td><?php echo $prezzi_tipo[$ind]['seconda'];?> €</td>
									<td><?php echo $prezzi_tipo[$ind]['giorni'];?> € <?php if($lingua=="ita"){?>al giorno<?php }else{?>per day<?php }?> </td>
									<td><?php echo $prezzi_tipo[$ind]['mezza'];?> €</td>
									<td>-</td>
								</tr>
								<?php $ind++;?>
								<tr>
									<td style="border-top:solid 2px #8D8D8D" colspan="6">
										<div style="float:left;width:20px; margin-top:0px;">
											<input type="radio" name="<?php echo $id_pers;?>_tipo_val" id="<?php echo $id_pers;?>_alloggio" class="radioPagamento" <?php if($tipo=="Corsi j24 con alloggio" || $tipo=="Courses j24 with accommodation" ){$ind_sel=$ind; ?>checked="checked"<?php }?> style="padding-top:3px;" value="<?php if($lingua=="ita"){?>Corsi j24 con alloggio<?php }else{?>Courses j24 with accommodation<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_tipo').value=this.value; vediMore_<?php echo $id_pers;?>('<?php echo $prezzi_tipo[$ind]['prima'];?>','<?php echo $prezzi_tipo[$ind]['seconda'];?>','<?php echo $prezzi_tipo[$ind]['giorni'];?>','<?php echo $prezzi_tipo[$ind]['mezza'];?>','<?php echo $prezzi_tipo[$ind]['mese'];?>','0')">
										</div>
										<div style="float:left; width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<b><?php if($lingua=="ita"){?>CORSI J24 CON ALLOGGIO (oltre 18 anni)<?php }else{?>COURSES J24 WITH ACCOMMODATION (only adults)<?php }?></b>											
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="float:left;width:20px; margin-top:0px;">
											&nbsp;
										</div>
										<div style="float:left; width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<?php if($lingua=="ita"){?>Maggio - Giugno - Settembre<?php }else{?>May - June - September<?php }?>
										</div>
										<div style="clear:both"></div>
									</td>
									<td>
										<?php echo $prezzi_tipo[$ind]['prima'];?> €
									</td>
									<td><?php echo $prezzi_tipo[$ind]['seconda'];?> €</td>
									<td>-</td>
									<td><?php echo $prezzi_tipo[$ind]['mezza'];?> €</td>
									<td>-</td>
								</tr>
								<?php $ind++;?>
								<tr>
									<td>
										<div style="float:left;width:20px; margin-top:0px;">
											&nbsp;
										</div>
										<div style="float:left;  width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<?php if($lingua=="ita"){?>Luglio<?php }else{?>July<?php }?>
										</div>
										<div style="clear:both"></div>											
									<td>
										<?php echo $prezzi_tipo[$ind]['prima'];?> €
									</td>
									<td><?php echo $prezzi_tipo[$ind]['seconda'];?> €</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
								</tr>
								<?php $ind++;?>
								<tr>
									<td>
										<div style="float:left;width:20px; margin-top:0px;">
											&nbsp;
										</div>
										<div style="float:left;  width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<?php if($lingua=="ita"){?>Agosto<?php }else{?>August<?php }?>
										</div>
										<div style="clear:both"></div>											
									<td>
										<?php echo $prezzi_tipo[$ind]['prima'];?> €
									</td>
									<td><?php echo $prezzi_tipo[$ind]['seconda'];?> €</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
								</tr>
								<?php $ind++;?>
								<tr> 
									<td colspan="6">
										<div style="float:left;width:20px; margin-top:0px;"> 
											<?php /*<input type="radio" name="<?php echo $id_pers;?>_tipo_val_extra" id="<?php echo $id_pers;?>_extra" class="radioPagamento" <?php if($tipo=="Extra settimanale per integrazione corso full time" || $tipo=="Weekly extra for full time course integration" ){$ind_sel=$ind; ?>checked="checked"<?php }?> style="padding-top:3px;" value="<?php if($lingua=="ita"){?>Extra settimanale per integrazione corso full time<?php }else{?>Weekly extra for full time course integration<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_tipo').value=this.value; document.getElementById('<?php echo $id_pers;?>_durata').value='<?php if($lingua=="ita"){?>Extra settimanale<?php }else{?>Weekly extra<?php }?>'; vediMore_<?php echo $id_pers;?>('<?php echo $prezzi_tipo[$ind]['prima'];?>','<?php echo $prezzi_tipo[$ind]['seconda'];?>','<?php echo $prezzi_tipo[$ind]['giorni'];?>','<?php echo $prezzi_tipo[$ind]['mezza'];?>','<?php echo $prezzi_tipo[$ind]['mese'];?>','0','<?php echo $prezzi_tipo[$ind]['extra'];?>')">*/?>
											<input type="checkbox" name="<?php echo $id_pers;?>_extraJ24" id="<?php echo $id_pers;?>_extraJ24" class="radioPagamento" <?php if($extra=="1" ){$ind_sel=$ind; ?>checked="checked"<?php }?> style="padding-top:3px;" value="<?php echo $extra;?>" onclick="addExtra('<?php echo $prezzi_tipo[$x]['extra'];?>');">
										</div>
										<div style="float:left; width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
											<?php if($lingua=="ita"){?>Extra settimanale per integrazione corso full time<?php }else{?>Weekly extra for full time course integration<?php }?>: <?php echo $prezzi_tipo[$ind]['extra'];?> €
										</div>
									</td>
								</tr>	
							</tbody>
						</table>
					</div>							
				</div>
			</div>
			
			<div class="row" style="padding-bottom:20px; <?php if($durata==""){?>display:none<?php }?>" id="<?php echo $id_pers;?>_durata_box">
				<input type="hidden" name="<?php echo $id_pers;?>_durata" id="<?php echo $id_pers;?>_durata" value="<?php if(isset($durata) && $durata!="") echo $durata; /*else {if($lingua=="ita") echo "Prima settimana"; else echo "First week";}*/?>"/>
				<div class="form-group">
					<label class="upper" for="name">
						<?php if($lingua=="ita"){?>Durata<?php }else{?>Durata<?php }?>*
					</label>								
				</div>
				<div class="col-md-12" id="<?php echo $id_pers;?>_durata_ps">
					<div style="float:left;width:20px; margin-top:0px;">
						<input type="radio"  name="<?php echo $id_pers;?>_durata_val" id="<?php echo $id_pers;?>_durata_val_1" class="radioPagamento" <?php if($durata=="Prima settimana" || $durata=="First week" ){?>checked="checked"<?php }?> style="padding-top:3px;" value="<?php if($lingua=="ita"){?>Prima settimana<?php }else{?>First week<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_durata').value=this.value; vediDurata_<?php echo $id_pers;?>()">
					</div>
					
					<div style="float:left; width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
						<?php if($lingua=="ita"){?>Prima settimana (<span id="<?php echo $id_pers;?>_prima"></span> €)<?php }else{?>First week (<span id="<?php echo $id_pers;?>_prima"></span> €)<?php }?>
					</div>
					<div style="clear:both"></div>
					
					<div style="margin-left:40px;" id="<?php echo $id_pers;?>_durata_ps_succ">
						<div class="col-md-12" id="<?php echo $id_pers;?>_sett_succ">
							<label class="upper" for="name" style="font-weight:normal">
								<?php if($lingua=="ita"){?>N. settimane successive alla prima <span class="costiSettimane">(<span id="<?php echo $id_pers;?>_seconda"></span> € a settimana)</span>:<?php }else{?>Number of weeks following the first week <span class="costiSettimane">(<span id="<?php echo $id_pers;?>_seconda"></span> € per week)</span>:<?php }?>
								&nbsp;&nbsp;<input type="text" name="<?php echo $id_pers;?>_num_settimane" id="<?php echo $id_pers;?>_num_settimane"  style="width:50px; height:25px;" value="<?php echo $num_settimane;?>"/>
							</label>
						</div>				
						<div class="col-md-12" id="<?php echo $id_pers;?>_giorni_succ">
							<label class="upper" for="name" style="font-weight:normal">
								<?php if($lingua=="ita"){?>N. giorni in più successivi alla prima settimana (<span id="<?php echo $id_pers;?>_giorni"></span> € al giorno):<?php }else{?>Number of days following the first week (<span id="<?php echo $id_pers;?>_giorni"></span> € per day ):<?php }?>
								&nbsp;&nbsp;<input type="text" name="<?php echo $id_pers;?>_num_giorni" id="<?php echo $id_pers;?>_num_giorni" style="width:50px; height:25px;" value="<?php echo $num_giorni;?>"/>
							</label>
						</div>
					</div>
				</div>
				
				<div class="col-md-12" id="<?php echo $id_pers;?>_durata_gps">
					<div style="float:left;width:20px; margin-top:0px;">
						<input type="radio" name="<?php echo $id_pers;?>_durata_val" id="<?php echo $id_pers;?>_durata_val_2" class="radioPagamento" <?php if($durata=="Ho già fatto la prima settimana" || $durata=="I've already done the first week" ){ ?>checked="checked"<?php }?> style="padding-top:3px;" value="<?php if($lingua=="ita"){?>Ho già fatto la prima settimana<?php }else{?>I've already done the first week<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_durata').value=this.value; vediDurata_<?php echo $id_pers;?>()">
					</div>
					
					<div style="float:left; width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
						<?php if($lingua=="ita"){?>Ho già fatto la prima settimana<?php }else{?>I've already done the first week<?php }?>
					</div>
					<div style="clear:both"></div>
					
					<div style="margin-left:40px; display:<?php if($durata=="Ho già fatto la prima settimana" || $durata=="I've already done the first week" ){?>block<?php }else{?>none<?php }?>" id="<?php echo $id_pers;?>_blocco_gia">
						<div class="col-md-12" id="<?php echo $id_pers;?>_sett_succ_2">
							<label class="upper" for="name" style="font-weight:normal">
								<?php if($lingua=="ita"){?>N. settimane successive alla prima <span class="costiSettimane">(<span id="<?php echo $id_pers;?>_2_seconda"></span> € a settimana)</span>:<?php }else{?>Number of weeks following the first week <span class="costiSettimane">(<span id="<?php echo $id_pers;?>_2_seconda"></span> € per week)</span>:<?php }?>
								&nbsp;&nbsp;<input type="text" name="<?php echo $id_pers;?>_num_settimane_2" id="<?php echo $id_pers;?>_num_settimane_2"  style="width:50px; height:25px;" value="<?php echo $num_settimane_2;?>"/>
							</label>
						</div>				
						<div class="col-md-12" id="<?php echo $id_pers;?>_giorni_succ_2">
							<label class="upper" for="name" style="font-weight:normal">
								<?php if($lingua=="ita"){?>N. giorni in più successivi alla prima settimana <span class="costiSettimane">(<span id="<?php echo $id_pers;?>_2_giorni"></span> € al giorno)</span>:<?php }else{?>Number of days following the first week <span class="costiSettimane">(<span id="<?php echo $id_pers;?>_2_giorni"></span> € per day )</span>:<?php }?>
								&nbsp;&nbsp;<input type="text" name="<?php echo $id_pers;?>_num_giorni_2" id="<?php echo $id_pers;?>_num_giorni_2" style="width:50px; height:25px;" value="<?php echo $num_giorni_2;?>"/>
							</label>
						</div>
					</div>
				</div>
				
				<div class="col-md-12" id="<?php echo $id_pers;?>_durata_ms">
					<div style="float:left;width:20px; margin-top:0px;">
						<input type="radio" name="<?php echo $id_pers;?>_durata_val" id="<?php echo $id_pers;?>_durata_val_3" class="radioPagamento" <?php if($durata=="Solo mezza settimana" || $durata=="Only half a week" ){?>checked="checked"<?php }?> style="padding-top:3px;" value="<?php if($lingua=="ita"){?>Solo mezza settimana<?php }else{?>Only half a week<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_durata').value=this.value; vediDurata_<?php echo $id_pers;?>()">
					</div>
					
					<div style="float:left; width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
						<?php if($lingua=="ita"){?>Solo mezza settimana <span class="costiSettimane">(<span id="<?php echo $id_pers;?>_mezza"></span> €)</span><?php }else{?>Only half a week <span class="costiSettimane">(<span id="<?php echo $id_pers;?>_mezza"></span> €)</span><?php }?></span>
					</div>
					<div style="clear:both"></div>
				</div>
				
				<div class="col-md-12" id="<?php echo $id_pers;?>_un_giorno">
					<div style="float:left;width:20px; margin-top:0px;">
						<input type="radio" name="<?php echo $id_pers;?>_durata_val" id="<?php echo $id_pers;?>_durata_val_4" class="radioPagamento" <?php if($durata=="Solo un giorno" || $durata=="Only one day" ){?>checked="checked"<?php }?> style="padding-top:3px;" value="<?php if($lingua=="ita"){?>Solo un giorno<?php }else{?>Only one day<?php }?>" onclick="document.getElementById('<?php echo $id_pers;?>_durata').value=this.value; vediDurata_<?php echo $id_pers;?>()">
					</div>
					
					<div style="float:left; width: -webkit-calc(100% - 20px); width:-moz-calc(100% - 20px); width:calc(100% - 20px);">
						<?php if($lingua=="ita"){?>Solo un giorno (70 €)<?php }else{?>Only one day (70 €)<?php }?>
					</div>
					<div style="clear:both"></div>
				</div>	
				
				<div class="col-md-12" id="<?php echo $id_pers;?>_mesi">
					<label class="upper" for="name" style="font-weight:normal">
						<?php if($lingua=="ita"){?>N. mesi <span class="costiMese">(<span id="<?php echo $id_pers;?>_mese"></span> € al mese)</span>:<?php }else{?>Number of months <span class="costiMese">(<span id="<?php echo $id_pers;?>_mese"></span> € per month)</span>:<?php }?>
						&nbsp;&nbsp;<input type="text" name="<?php echo $id_pers;?>_num_mesi" id="<?php echo $id_pers;?>_num_mesi"  style="width:50px; height:25px;" value="<?php echo $num_mesi;?>"/>
					</label>
				</div>
				
			</div>
			<div class="col-md-12" id="<?php echo $id_pers;?>_extra_box" style="display:none">
				<label class="upper" for="name" style="font-weight:normal">
					<?php if($lingua=="ita"){?>N. settimane con extra per intergrazione corso full time <span class="costiExtra">(<span id="<?php echo $id_pers;?>_cifra_extra"></span> € a settimana)</span>:<?php }else{?>Number of weeks with extra for full time course integration <span class="costiExtra">(<span id="<?php echo $id_pers;?>_cifra_extra"></span> € per week)</span>:<?php }?>
					&nbsp;&nbsp;<input type="text" name="<?php echo $id_pers;?>_num_extra" id="<?php echo $id_pers;?>_num_extra"  style="width:50px; height:25px;" value="<?php echo $num_extra;?>"/>
				</label>
			</div>
			
			<input type="hidden" name="<?php echo $id_pers;?>_tesseramento" id="<?php echo $id_pers;?>_tesseramento" value="<?php echo $tesseramento;?>"/>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="upper" for="email" style="color:#8D8D8D;">
							<b><?php if($lingua=="ita"){?>Tessera FIV<?php }else{?>FIV Card<?php }?></b>
							&nbsp;&nbsp;&nbsp;
							<input type="checkbox" id="<?php echo $id_pers;?>_checkTesseramento" <?php if($tesseramento=="si"){?>checked="checked"<?php }?>/> &euro;<span id="costo_tessera_<?php echo $id_pers;?>">50</span>
						</div>						
					</div>
				</div>
			</div>
			<script>				
				var totale_<?php echo $id_pers;?> = 0;
				var num_interi_<?php echo $id_pers;?> = 1;
				<?php 						
				if($tipo!=""){
					$temp=explode("(euro ",$tipo);
					if(isset($temp[1])){
						$temp2=explode(")",$temp[1]);
						$costo=$temp2[0];
					}else{
						$costo=0;
					}
				}else $costo=0;
				?>
				var costo_<?php echo $id_pers;?> = 0;
				var tessera_<?php echo $id_pers;?> = 0;
				if(document.getElementById('<?php echo $id_pers;?>_checkTesseramento').checked==true) tessera_<?php echo $id_pers;?> = 50;
				var costo_mezza_sett_<?php echo $id_pers;?> = "0";
				var costo_prima_sett_<?php echo $id_pers;?> = "<?php if($costo_prima_sett) echo $costo_prima_sett; else {?>0<?php }?>";
				var settimane_in_piu_<?php echo $id_pers;?> = "<?php if($num_settimane) echo $num_settimane; else {?>0<?php }?>";
				var settimane_in_piu_<?php echo $id_pers;?>_2 = "<?php if($num_settimane_2) echo $num_settimane_2; else {?>0<?php }?>";
				var costo_settimane_in_piu_<?php echo $id_pers;?> = "<?php if($costo_settimane_in_piu) echo $costo_settimane_in_piu; else {?>0<?php }?>";
				var costo_settimane_in_piu_<?php echo $id_pers;?> = "<?php if($costo_settimane_in_piu) echo $costo_settimane_in_piu; else {?>0<?php }?>";
				var costo_giorni_in_piu_<?php echo $id_pers;?> = "<?php if($costo_giorni_in_piu) echo $costo_giorni_in_piu; else {?>0<?php }?>";
				var giorni_in_piu_<?php echo $id_pers;?> = "<?php if($num_giorni) echo $num_giorni; else {?>0<?php }?>";
				var giorni_in_piu_<?php echo $id_pers;?>_2 = "<?php if($num_giorni) echo $num_giorni; else {?>0<?php }?>";
				var numero_mesi_<?php echo $id_pers;?> = "<?php if($num_mesi) echo $num_mesi; else {?>0<?php }?>";
				var numero_extra_<?php echo $id_pers;?> = "<?php if($num_extra) echo $num_extra; else {?>0<?php }?>";
				var costo_mesi_<?php echo $id_pers;?> = "<?php if($costo_mesi) echo $costo_mesi; else {?>0<?php }?>";
				
				$("#<?php echo $id_pers;?>_checkTesseramento").click(function() {
					if($("#<?php echo $id_pers;?>_checkTesseramento").prop('checked')==true){
						document.getElementById('<?php echo $id_pers;?>_tesseramento').value="si";
						if(document.getElementById('<?php echo $id_pers;?>_tipo').value=="Corsi derive ottobre-aprile" || document.getElementById('<?php echo $id_pers;?>_tipo').value=="Corsi derive october-april"){
							tessera_<?php echo $id_pers;?> = 20;
						}else{
							tessera_<?php echo $id_pers;?> = 50;
						}
						$("#<?php echo $id_pers;?>_checkCircolo").attr('checked', false);
						document.getElementById('<?php echo $id_pers;?>_circolo').value = "";
						document.getElementById('<?php echo $id_pers;?>_gia_tesserato').value="no";
					}else{
						tessera_<?php echo $id_pers;?> = 0;
						document.getElementById('<?php echo $id_pers;?>_tesseramento').value="no";
					}
										
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();					
				})			
			</script>
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="hidden" name="<?php echo $id_pers;?>_gia_tesserato" id="<?php echo $id_pers;?>_gia_tesserato" value="<?php echo $gia_tesserato;?>"/>
						<label class="upper" for="name">
							<?php if($lingua=="ita"){?>Dichiaro di essere già tesserato FIV per il <?php echo date("Y");?>, con il Circolo:<?php }else{?>Current Italian Sailing Federation (FIV) membership  for current year <?php echo date("Y");?>, with the club:<?php }?>
							&nbsp;&nbsp;<input type="text" name="<?php echo $id_pers;?>_circolo" id="<?php echo $id_pers;?>_circolo" style="border:none; border-bottom:solid 1px;" value="<?php echo $circolo;?>"/>
							&nbsp;&nbsp;<input type="checkbox" id="<?php echo $id_pers;?>_checkCircolo" <?php if($gia_tesserato=="si"){?>checked="checked"<?php }?>/>
						</label>								
					</div>
				</div>			
			</div>
			<script>
				$("#<?php echo $id_pers;?>_checkCircolo").click(function() {
					if($("#<?php echo $id_pers;?>_checkCircolo").prop('checked')==true){
						document.getElementById('<?php echo $id_pers;?>_gia_tesserato').value="si";
						tessera_<?php echo $id_pers;?> = 0;
						$("#<?php echo $id_pers;?>_checkTesseramento").attr('checked', false);
						document.getElementById('<?php echo $id_pers;?>_tesseramento').value="no";
					}else{
						document.getElementById('<?php echo $id_pers;?>_circolo').value = "";
						document.getElementById('<?php echo $id_pers;?>_gia_tesserato').value="no";
					}
					
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();
				})
			</script>
			
			<script>
				function calcolaTotale_<?php echo $id_pers;?>(){
					totale_<?php echo $id_pers;?> = parseInt(costo_<?php echo $id_pers;?>);
					
					if(document.getElementById('<?php echo $id_pers;?>_tipo').value=="Corsi j24 con alloggio" || document.getElementById('<?php echo $id_pers;?>_tipo').value=="Courses j24 with accommodation"){
						var num_set = 0;
						if(document.getElementById('<?php echo $id_pers;?>_blocco_gia').style.display=='block') num_set = settimane_in_piu_<?php echo $id_pers;?>_2;
						else if(document.getElementById('<?php echo $id_pers;?>_durata_ps_succ').style.display=='block')   num_set = settimane_in_piu_<?php echo $id_pers;?>;
						
						var dal="";
						dal = document.getElementById('<?php echo $id_pers;?>_dal').value;
						if(dal!=""){
							var myarr = dal.split("-");
							dal = myarr[2] + "-" + myarr[1] + "-" + myarr[0];
							
							var new_dal = dal;
							for(var i=1; i<=num_set; i++){
								if(document.getElementById('<?php echo $id_pers;?>_durata_ps_succ').style.display=='block' || (document.getElementById('<?php echo $id_pers;?>_blocco_gia').style.display=='block' && i>1)){
									var result = new Date(new_dal);
									new_dal = new Date(result.setDate(result.getDate() + 7)).toLocaleDateString();
									
									var myarr2 = new_dal.split("/");
									//if(myarr2[0]<10) myarr2[0] = "0"+myarr2[0];
									//if(myarr2[1]<10) myarr2[1] = "0"+myarr2[1];
									new_dal = myarr2[2] + "-" + myarr2[1] + "-" + myarr2[0];
								}
								
								if(new_dal>="<?php echo date('Y');?>-06-30" && new_dal<="<?php echo date('Y');?>-08-03"){
									costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_luglio;?>;
								}else if(new_dal>="<?php echo date('Y');?>-08-04" && new_dal<="<?php echo date('Y');?>-08-31"){
									costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_agosto;?>;									
								}else{
									if(new_dal<="<?php echo date("Y");?>-06-29" || new_dal>="<?php echo date("Y");?>-09-01") 
										costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_set_mag;?>;																		
									else
										costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_luglio;?>;																		
								}
								//alert(new_dal + " - " + costo_settimane_in_piu_<?php echo $id_pers;?>);
								//alert(new_dal);
								totale_<?php echo $id_pers;?> = parseInt(totale_<?php echo $id_pers;?>) + parseInt(costo_settimane_in_piu_<?php echo $id_pers;?>);		
							}
							
						}
					}else{
						if(document.getElementById('<?php echo $id_pers;?>_durata_box').style.display=="block" && document.getElementById('<?php echo $id_pers;?>_blocco_gia').style.display=='block') {
							totale_<?php echo $id_pers;?> = parseInt(totale_<?php echo $id_pers;?>) + parseInt(costo_settimane_in_piu_<?php echo $id_pers;?>*settimane_in_piu_<?php echo $id_pers;?>_2) + parseInt(costo_giorni_in_piu_<?php echo $id_pers;?>*giorni_in_piu_<?php echo $id_pers;?>_2);		
						} else if(document.getElementById('<?php echo $id_pers;?>_durata_box').style.display=="block" && document.getElementById('<?php echo $id_pers;?>_durata_ps_succ').style.display=='block')  {
							totale_<?php echo $id_pers;?> = parseInt(totale_<?php echo $id_pers;?>) + parseInt(costo_settimane_in_piu_<?php echo $id_pers;?>*settimane_in_piu_<?php echo $id_pers;?>) + parseInt(costo_giorni_in_piu_<?php echo $id_pers;?>*giorni_in_piu_<?php echo $id_pers;?>);
						} else if(document.getElementById('<?php echo $id_pers;?>_durata_box').style.display=="block" && document.getElementById('<?php echo $id_pers;?>_mesi').style.display=='block')  {
							totale_<?php echo $id_pers;?> = parseInt(costo_mese_<?php echo $id_pers;?>*numero_mesi_<?php echo $id_pers;?>);
						}
					}
					
					if(document.getElementById('<?php echo $id_pers;?>_extra_box').style.display=="block")  {
						if(document.getElementById("<?php echo $id_pers;?>_tipo").value=='Corsi j24 con alloggio' || document.getElementById("<?php echo $id_pers;?>_tipo").value=='Courses j24 with accommodation'){
							totale_<?php echo $id_pers;?> = parseInt(totale_<?php echo $id_pers;?>) + parseInt(costo_extra_<?php echo $id_pers;?>*numero_extra_<?php echo $id_pers;?>);	
						}else{
							totale_<?php echo $id_pers;?> = parseInt(costo_extra_<?php echo $id_pers;?>*numero_extra_<?php echo $id_pers;?>);								
						}
					}
					
					totale_<?php echo $id_pers;?> = parseInt(totale_<?php echo $id_pers;?>) + parseInt(tessera_<?php echo $id_pers;?>);
				}				
				
				function calcolaTotale(){
					var tt = 0;
					var pers_att=0;
					var sconto_pers = 20; //sconto familiari a persona se più di uno
					var sconto_tot = 0;
					
					for(var cont=1; cont<=num_pers; cont++){
						if(document.getElementById('dati_personali_'+cont).style.display!='none'){
							tt = parseInt(tt)+parseInt(eval("totale_"+cont));
							pers_att++;				
						}
					}
					
					//CALCOLO SCONTO
					var num_sett = 0;
					for(var cont=1; cont<=num_pers; cont++){
						if(document.getElementById(cont+"_tipo").value!='Corsi j24 con alloggio' && document.getElementById(cont+"_tipo").value!='Courses j24 with accommodation'){
							if(document.getElementById('dati_personali_'+cont).style.display!='none'){
								if(document.getElementById(cont+"_durata").value == "Prima settimana" || document.getElementById(cont+"_durata").value == "First week"){
									num_sett = parseInt(num_sett) + 1;
									num_sett = parseInt(num_sett)+parseInt(eval("settimane_in_piu_"+cont));
								}
								if(document.getElementById(cont+"_durata").value=="Ho già fatto la prima settimana" || document.getElementById(cont+"_durata").value=="I've already done the first week"){
									num_sett = parseInt(num_sett)+parseInt(eval("settimane_in_piu_"+cont+"_2"));									
								}
							}
						}
						//alert(num_sett);
					}
					
					var num_pers_sett = 0;
					for(var cont=1; cont<=num_pers; cont++){
						if(document.getElementById(cont+"_tipo").value!="" && document.getElementById(cont+"_tipo").value!='Corsi j24 con alloggio' && document.getElementById(cont+"_tipo").value!='Courses j24 with accommodation'){
							if(document.getElementById(cont+"_durata").value == "Prima settimana" || document.getElementById(cont+"_durata").value == "First week"){
								num_pers_sett = parseInt(num_pers_sett)+1;
							}
							if(document.getElementById(cont+"_durata").value=="Ho già fatto la prima settimana" || document.getElementById(cont+"_durata").value=="I've already done the first week"){
								if(eval("settimane_in_piu_"+cont+"_2")>0) num_pers_sett = parseInt(num_pers_sett)+1;
							}
						}
					}
					if(tt>0 && num_pers_sett>1) {
						tt=tt-(num_sett*sconto_pers); sconto_tot = parseInt(sconto_tot) + parseInt((num_sett*sconto_pers));
					}
				
					if(sconto_tot>0){
						document.getElementById('scontoFamiglia').innerHTML = "Sconto Famiglia applicato:<br/><b>"+sconto_tot+" &euro;</b>";			
					}else{
						document.getElementById('scontoFamiglia').innerHTML = "";			
					}
					document.getElementById('sconto').value = sconto_tot;
					
					// STAMPA TOTALE
					document.getElementById('totale').value = tt;
					document.getElementById('tot').value = tt +  " \u20AC";
				}
				
				
				function vediMore_<?php echo $id_pers;?>(prima, seconda, giorni, mezza, mese, un_giorno='70',extra=''){
					document.getElementById('<?php echo $id_pers;?>_costo_prima_sett').value=prima;
					document.getElementById('<?php echo $id_pers;?>_mezza').innerHTML=mezza;
					document.getElementById('<?php echo $id_pers;?>_costo_mezza_settimana').value=mezza;
					document.getElementById('<?php echo $id_pers;?>_prima').innerHTML=prima;
					document.getElementById('<?php echo $id_pers;?>_seconda').innerHTML=seconda;
					document.getElementById('<?php echo $id_pers;?>_2_seconda').innerHTML=seconda;
					document.getElementById('<?php echo $id_pers;?>_costo_settimane_in_piu').value=seconda;
					document.getElementById('<?php echo $id_pers;?>_giorni').innerHTML=giorni;
					document.getElementById('<?php echo $id_pers;?>_2_giorni').innerHTML=giorni;
					document.getElementById('<?php echo $id_pers;?>_costo_giorni_in_piu').value=giorni;
					document.getElementById('<?php echo $id_pers;?>_costo_mesi').value=mese;
					document.getElementById('<?php echo $id_pers;?>_durata_box').style.display='block';
					document.getElementById('<?php echo $id_pers;?>_extra_box').style.display='none';
					
					var tp = document.getElementById('<?php echo $id_pers;?>_tipo').value;
					document.getElementById('<?php echo $id_pers;?>_durata_val_1').checked = true;
					
					document.getElementById('<?php echo $id_pers;?>_durata_ms').style.display="block";
					document.getElementById('<?php echo $id_pers;?>_durata_ps').style.display="block";
					document.getElementById('<?php echo $id_pers;?>_durata_gps').style.display="block";
					document.getElementById('<?php echo $id_pers;?>_un_giorno').style.display="block";
					document.getElementById('<?php echo $id_pers;?>_giorni_succ').style.display="block";
					document.getElementById('<?php echo $id_pers;?>_giorni_succ_2').style.display="block";
					if(document.getElementById('<?php echo $id_pers;?>_durata_val_1').checked == true)
						document.getElementById('<?php echo $id_pers;?>_durata_ps_succ').style.display="block";
					else document.getElementById('<?php echo $id_pers;?>_durata_ps_succ').style.display="none";
					if(document.getElementById('<?php echo $id_pers;?>_durata_val_2').checked == true)
						document.getElementById('<?php echo $id_pers;?>_blocco_gia').style.display="block";
					else document.getElementById('<?php echo $id_pers;?>_blocco_gia').style.display="none";
					document.getElementById('<?php echo $id_pers;?>_mesi').style.display="none";
					
					document.getElementById('<?php echo $id_pers;?>_durata_val_1').disabled = false;
					//$(".costiSettimane").show();
					
					costo_mezza_sett_<?php echo $id_pers;?> = mezza;
					costo_prima_sett_<?php echo $id_pers;?> = prima;
					costo_settimane_in_piu_<?php echo $id_pers;?> = seconda;
					costo_giorni_in_piu_<?php echo $id_pers;?> = giorni;
					costo_un_giorno_<?php echo $id_pers;?> = un_giorno;
					costo_<?php echo $id_pers;?> = prima;
					val_tessera_<?php echo $id_pers;?> = 50;
					
					var dal="";
					dal = document.getElementById('<?php echo $id_pers;?>_dal').value;
					
					if(dal!=""){
						var myarr = dal.split("-");
						dal = myarr[2] + "-" + myarr[1] + "-" + myarr[0];
					}
					
					document.getElementById('<?php echo $id_pers;?>_extraJ24').checked = false;
						
					if(tp=="Corsi j24 con alloggio" || tp=="Courses j24 with accommodation"){
						if(dal=="" || (dal!="" && myarr[1]!="05" && myarr[1]!="06" && myarr[1]!="07" && myarr[1]!="08" && myarr[1]!="09")){
							document.getElementById('<?php echo $id_pers;?>_alloggio').checked = false;
							document.getElementById('<?php echo $id_pers;?>_durata_box').style.display="none";
							costo_mezza_sett_<?php echo $id_pers;?> = 0;
							costo_prima_sett_<?php echo $id_pers;?> = 0;
							costo_settimane_in_piu_<?php echo $id_pers;?> = 0;
							costo_giorni_in_piu_<?php echo $id_pers;?> = 0;
							costo_un_giorno_<?php echo $id_pers;?> = 0;
							costo_<?php echo $id_pers;?> = 0;
							if(dal=="")
								alert("Inserisci data di inizio");
							else
								alert("Corso disponibile solo nei mesi da Maggio a Settembre");
						}else{
							//$(".costiSettimane").hide();
							document.getElementById('<?php echo $id_pers;?>_un_giorno').style.display="none";
							document.getElementById('<?php echo $id_pers;?>_giorni_succ').style.display="none";
							document.getElementById('<?php echo $id_pers;?>_giorni_succ_2').style.display="none";
							if( myarr[1]=="07" ||  myarr[1]=="08")
								document.getElementById('<?php echo $id_pers;?>_durata_ms').style.display="none";
							
							var result = new Date(dal);
							
							var new_dal = new Date(result.setDate(result.getDate() + 7)).toLocaleDateString();							
							var myarr2 = new_dal.split("/");
							//if(myarr2[0]<10) myarr2[0] = "0"+myarr2[0];
							//if(myarr2[1]<10) myarr2[1] = "0"+myarr2[1];
							new_dal = myarr2[2] + "-" + myarr2[1] + "-" + myarr2[0];
							if(dal>="<?php echo $luglio_dal;?>" && dal<="<?php echo $luglio_al;?>") {
								costo_prima_sett_<?php echo $id_pers;?> = <?php echo $j24_prima_sett_luglio;?>;
								costo_solo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_luglio;?>;
								if(new_dal>="<?php echo $luglio_dal;?>" && new_dal<="<?php echo $luglio_al;?>")
									costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_luglio;?>;
								else 
									costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_agosto;?>;
							}
							else if(dal>="<?php echo $agosto_dal;?>" && dal<="<?php echo $agosto_al;?>") {
								costo_prima_sett_<?php echo $id_pers;?> = <?php echo $j24_prima_sett_agosto;?>;
								costo_solo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_agosto;?>;
								if(new_dal>="<?php echo $agosto_dal;?>" && new_dal<="<?php echo $agosto_al;?>")
									costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_agosto;?>;
								else 
									costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_set_mag;?>;
							}else{
								costo_prima_sett_<?php echo $id_pers;?> = <?php echo $j24_prima_sett_set_mag;?>;
								costo_solo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_set_mag;?>;
								if(new_dal<="<?php echo $mag_set_prima;?>" || new_dal>="<?php echo $mag_set_dopo;?>") 
									costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_set_mag;?>;
								else
									costo_settimane_in_piu_<?php echo $id_pers;?> = <?php echo $j24_sett_in_piu_luglio;?>;
							}
							
							document.getElementById('<?php echo $id_pers;?>_costo_prima_sett').value=costo_prima_sett_<?php echo $id_pers;?>;
							document.getElementById('<?php echo $id_pers;?>_prima').innerHTML=costo_prima_sett_<?php echo $id_pers;?>;
							document.getElementById('<?php echo $id_pers;?>_seconda').innerHTML=costo_settimane_in_piu_<?php echo $id_pers;?>;
							document.getElementById('<?php echo $id_pers;?>_2_seconda').innerHTML=costo_solo_settimane_in_piu_<?php echo $id_pers;?>;
							document.getElementById('<?php echo $id_pers;?>_costo_settimane_in_piu').value=costo_settimane_in_piu_<?php echo $id_pers;?>;							
							
							costo_<?php echo $id_pers;?> =  costo_prima_sett_<?php echo $id_pers;?>;
							//controllo giorni/mese per calcolare totale
						}
					}
					else if(tp=="Corsi derive ottobre-aprile" || tp=="Corsi derive october-april"){
						if(dal=="" || (dal!="" && myarr[1]!="10" && myarr[1]!="11" && myarr[1]!="12" && myarr[1]!="01" && myarr[1]!="02" && myarr[1]!="03" && myarr[1]!="04")){
							document.getElementById('<?php echo $id_pers;?>_derive_inverno').checked = false;
							document.getElementById('<?php echo $id_pers;?>_durata_box').style.display="none";
							costo_mezza_sett_<?php echo $id_pers;?> = 0;
							costo_prima_sett_<?php echo $id_pers;?> = 0;
							costo_settimane_in_piu_<?php echo $id_pers;?> = 0;
							costo_giorni_in_piu_<?php echo $id_pers;?> = 0;
							costo_un_giorno_<?php echo $id_pers;?> = 0;
							costo_mese_<?php echo $id_pers;?> = 0;
							costo_<?php echo $id_pers;?> = 0;
							if(dal=="")
								alert("Inserisci data di inizio");
							else
								alert("Corso disponibile solo nei mesi da Ottobre ad Aprile");
						}else{				
							document.getElementById('<?php echo $id_pers;?>_durata_ps').style.display="none";
							document.getElementById('<?php echo $id_pers;?>_durata_ps_succ').style.display="none";
							document.getElementById('<?php echo $id_pers;?>_durata_gps').style.display="none";
							document.getElementById('<?php echo $id_pers;?>_durata_ms').style.display="none";
							document.getElementById('<?php echo $id_pers;?>_un_giorno').style.display="none";
							document.getElementById('<?php echo $id_pers;?>_mesi').style.display="block";
														
							costo_mese_<?php echo $id_pers;?> = mese;
							
							costo_<?php echo $id_pers;?> = costo_mese_<?php echo $id_pers;?>;
							document.getElementById('<?php echo $id_pers;?>_mese').innerHTML=costo_mese_<?php echo $id_pers;?>;
							//controllo giorni/mese per calcolare totale
							val_tessera_<?php echo $id_pers;?>=20;
							
							document.getElementById('<?php echo $id_pers;?>_num_mesi').value="1";							
							num_mesi_<?php echo $id_pers;?>()
						}
					<?php /*}else if(tp=="Extra settimanale per integrazione corso full time" || tp=="Weekly extra for full time course integration"){
						if(dal=="" || (dal!="" && myarr[1]!="05" && myarr[1]!="06" && myarr[1]!="07" && myarr[1]!="08" && myarr[1]!="09")){
							document.getElementById('<?php echo $id_pers;?>_extra').checked = false;
							document.getElementById('<?php echo $id_pers;?>_durata_box').style.display="none";
							costo_mezza_sett_<?php echo $id_pers;?> = 0;
							costo_prima_sett_<?php echo $id_pers;?> = 0;
							costo_settimane_in_piu_<?php echo $id_pers;?> = 0;
							costo_giorni_in_piu_<?php echo $id_pers;?> = 0;
							costo_un_giorno_<?php echo $id_pers;?> = 0;
							costo_mese_<?php echo $id_pers;?> = 0;
							costo_<?php echo $id_pers;?> = 0;
							if(dal=="")
								alert("Inserisci data di inizio");
							else
								alert("Corso disponibile solo nei mesi da Maggio a Settembre");
						}else{							
							<?php 
							//document.getElementById('<?php echo $id_pers;?>_durata_box').style.display="none";
							//document.getElementById('<?php echo $id_pers;?>_durata_ps').style.display="none";
							//document.getElementById('<?php echo $id_pers;?>_durata_ps_succ').style.display="none";
							//document.getElementById('<?php echo $id_pers;?>_durata_gps').style.display="none";
							//document.getElementById('<?php echo $id_pers;?>_durata_ms').style.display="none";
							//document.getElementById('<?php echo $id_pers;?>_un_giorno').style.display="none";
							//document.getElementById('<?php echo $id_pers;?>_mesi').style.display="none";
							?>
														
							costo_<?php echo $id_pers;?> =  parseInt(costo_<?php echo $id_pers;?>)+ parseInt(extra);
						}*/?>
					}else{
						if(dal=="" || (dal!="" && myarr[1]!="05" && myarr[1]!="06" && myarr[1]!="07" && myarr[1]!="08" && myarr[1]!="09")){
							document.getElementById('<?php echo $id_pers;?>_derive_6_18').checked = false;
							document.getElementById('<?php echo $id_pers;?>_derive_18').checked = false;
							document.getElementById('<?php echo $id_pers;?>_cabinato_12_18').checked = false;
							document.getElementById('<?php echo $id_pers;?>_cabinato_18').checked = false;
							document.getElementById('<?php echo $id_pers;?>_extra').checked = false;
							document.getElementById('<?php echo $id_pers;?>_durata_box').style.display="none";
							costo_mezza_sett_<?php echo $id_pers;?> = 0;
							costo_prima_sett_<?php echo $id_pers;?> = 0;
							costo_settimane_in_piu_<?php echo $id_pers;?> = 0;
							costo_giorni_in_piu_<?php echo $id_pers;?> = 0;
							costo_un_giorno_<?php echo $id_pers;?> = 0;
							costo_mese_<?php echo $id_pers;?> = 0;
							costo_<?php echo $id_pers;?> = 0;
							if(dal=="")
								alert("Inserisci data di inizio");
							else
								alert("Corso disponibile solo nei mesi da Maggio a Settembre");
						}
					}
					
					document.getElementById('costo_tessera_<?php echo $id_pers;?>').innerHTML=val_tessera_<?php echo $id_pers;?>;
					if($("#<?php echo $id_pers;?>_checkTesseramento").prop('checked')==true) tessera_<?php echo $id_pers;?> = val_tessera_<?php echo $id_pers;?>;
					
					/*if(document.getElementById('<?php echo $id_pers;?>_durata').value == "Prima settimana" || document.getElementById('<?php echo $id_pers;?>_durata').value=="First week"){
						costo_<?php echo $id_pers;?> = prima;
					}else if(document.getElementById('<?php echo $id_pers;?>_durata').value == "Ho già fatto la prima settimana" || document.getElementById('<?php echo $id_pers;?>_durata').value=="I've already done the first week"){
						costo_<?php echo $id_pers;?> = 0;
					}else if(document.getElementById('<?php echo $id_pers;?>_durata').value == "Solo mezza settimana" || document.getElementById('<?php echo $id_pers;?>_durata').value=="Only half a week"){
						costo_<?php echo $id_pers;?> = costo_mezza_sett_<?php echo $id_pers;?>;	
					}else if(document.getElementById('<?php echo $id_pers;?>_durata').value == "Solo un giorno" || document.getElementById('<?php echo $id_pers;?>_durata').value=="Only one day"){
						costo_<?php echo $id_pers;?> = costo_un_giorno_<?php echo $id_pers;?>;	
					}	*/									
									
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();
				}
				
				var costo_extra_<?php echo $id_pers;?> = 0;
				var numero_extra_<?php echo $id_pers;?> = 1;
				function addExtra(extra){
					document.getElementById('<?php echo $id_pers;?>_cifra_extra').innerHTML=extra;
					costo_extra_<?php echo $id_pers;?> = extra;
					//alert(costo_extra_<?php echo $id_pers;?>);
					var tp = document.getElementById('<?php echo $id_pers;?>_tipo').value;
					//if(tp=="Corsi j24 con alloggio" || tp=="Courses j24 with accommodation"){
						if(document.getElementById('<?php echo $id_pers;?>_extraJ24').checked == true){
							document.getElementById('<?php echo $id_pers;?>_extra_box').style.display='block';
							if(tp=="Corsi j24 con alloggio" || tp=="Courses j24 with accommodation"){
								//costo_<?php echo $id_pers;?> = parseInt(costo_<?php echo $id_pers;?>)+ parseInt(extra);	
							}else{
								document.getElementById('<?php echo $id_pers;?>_tipo').value = "";
								document.getElementById('<?php echo $id_pers;?>_alloggio').checked = false;
								document.getElementById('<?php echo $id_pers;?>_derive_inverno').checked = false;
								document.getElementById('<?php echo $id_pers;?>_derive_6_18').checked = false;
								document.getElementById('<?php echo $id_pers;?>_derive_18').checked = false;
								document.getElementById('<?php echo $id_pers;?>_cabinato_12_18').checked = false;
								document.getElementById('<?php echo $id_pers;?>_cabinato_18').checked = false;
								document.getElementById('<?php echo $id_pers;?>_durata_box').style.display="none";
								//costo_<?php echo $id_pers;?> = extra;	
							}								
							document.getElementById('<?php echo $id_pers;?>_extraJ24').value=1; 
							document.getElementById('<?php echo $id_pers;?>_num_extra').value=1; 
							numero_extra_<?php echo $id_pers;?> = 1;
						}else{
							document.getElementById('<?php echo $id_pers;?>_extra_box').style.display='none';
							//costo_<?php echo $id_pers;?> = parseInt(costo_<?php echo $id_pers;?>) - parseInt(extra);
							document.getElementById('<?php echo $id_pers;?>_extraJ24').value=0; 
							document.getElementById('<?php echo $id_pers;?>_num_extra').value=0; 
							numero_extra_<?php echo $id_pers;?> = 0;
						}
						document.getElementById('<?php echo $id_pers;?>_costo_extra').value=extra;
						
						calcolaTotale_<?php echo $id_pers;?>();
						calcolaTotale();
					/*}else{
						document.getElementById('<?php echo $id_pers;?>_extraJ24').checked = false;
						<?php if($lingua=="ita"){?>
							alert("Selezionare 'CORSI J24 CON ALLOGGIO (oltre 18 anni)'");
						<?php }else{?>
							alert("Select 'COURSES J24 WITH ACCOMMODATION (only adults)'");
						<?php }?>
					}*/
				}
				
				function cambioDataInizio_<?php echo $id_pers;?>(){
					//if(document.getElementById('<?php echo $id_pers;?>_alloggio').checked == true){
						document.getElementById('<?php echo $id_pers;?>_tipo').value = "";
						document.getElementById('<?php echo $id_pers;?>_alloggio').checked = false;
						document.getElementById('<?php echo $id_pers;?>_derive_inverno').checked = false;
						document.getElementById('<?php echo $id_pers;?>_derive_6_18').checked = false;
						document.getElementById('<?php echo $id_pers;?>_derive_18').checked = false;
						document.getElementById('<?php echo $id_pers;?>_cabinato_12_18').checked = false;
						document.getElementById('<?php echo $id_pers;?>_cabinato_18').checked = false;
						document.getElementById('<?php echo $id_pers;?>_extraJ24').checked = false;
						document.getElementById('<?php echo $id_pers;?>_durata_box').style.display="none";
						document.getElementById('<?php echo $id_pers;?>_extra_box').style.display='none';
						costo_mezza_sett_<?php echo $id_pers;?> = 0;
						costo_prima_sett_<?php echo $id_pers;?> = 0;
						costo_settimane_in_piu_<?php echo $id_pers;?> = 0;
						costo_giorni_in_piu_<?php echo $id_pers;?> = 0;
						costo_un_giorno_<?php echo $id_pers;?> = 0;
						costo_mese_<?php echo $id_pers;?> = 0;
						costo_<?php echo $id_pers;?> = 0;
						calcolaTotale_<?php echo $id_pers;?>();
						calcolaTotale();
					//}
				}
				
				function vediDurata_<?php echo $id_pers;?>(){
					var dur = document.getElementById('<?php echo $id_pers;?>_durata').value;
					if(dur=="Prima settimana" || dur=="First week"){
						document.getElementById("<?php echo $id_pers;?>_durata_ps_succ").style.display='block';
						document.getElementById("<?php echo $id_pers;?>_blocco_gia").style.display='none';
						costo_<?php echo $id_pers;?> = costo_prima_sett_<?php echo $id_pers;?>;
						num_interi_<?php echo $id_pers;?> = 1;
						num_interi_<?php echo $id_pers;?> = num_interi_<?php echo $id_pers;?> + settimane_in_piu_<?php echo $id_pers;?>
					}
					if(dur=="Ho già fatto la prima settimana" || dur=="I've already done the first week"){
						document.getElementById("<?php echo $id_pers;?>_durata_ps_succ").style.display='none';
						document.getElementById("<?php echo $id_pers;?>_blocco_gia").style.display='block';
						costo_<?php echo $id_pers;?> = 0;
						num_interi_<?php echo $id_pers;?> = 0;
					}
					if(dur=="Solo mezza settimana" || dur=="Only half a week"){
						document.getElementById("<?php echo $id_pers;?>_durata_ps_succ").style.display='none';
						document.getElementById("<?php echo $id_pers;?>_blocco_gia").style.display='none';
						costo_<?php echo $id_pers;?> = costo_mezza_sett_<?php echo $id_pers;?>;	
						num_interi_<?php echo $id_pers;?> = 0;
					}
					if(dur=="Solo un giorno" || dur=="Only one day"){
						document.getElementById("<?php echo $id_pers;?>_durata_ps_succ").style.display='none';
						document.getElementById("<?php echo $id_pers;?>_blocco_gia").style.display='none';
						costo_<?php echo $id_pers;?> = costo_un_giorno_<?php echo $id_pers;?>;	
						num_interi_<?php echo $id_pers;?> = 0;
					}		
					
					document.getElementById('<?php echo $id_pers;?>_num_giorni').value="";
					giorni_in_piu_<?php echo $id_pers;?> = 0;
					document.getElementById('<?php echo $id_pers;?>_num_giorni_2').value="";
					giorni_in_piu_<?php echo $id_pers;?>_2 = 0;
					document.getElementById('<?php echo $id_pers;?>_num_settimane').value="";
					settimane_in_piu_<?php echo $id_pers;?> = 0;
					document.getElementById('<?php echo $id_pers;?>_num_settimane_2').value="";
					settimane_in_piu_<?php echo $id_pers;?>_2 = 0;
					document.getElementById('<?php echo $id_pers;?>_num_mesi').value="";
					numero_mesi_<?php echo $id_pers;?> = 0;
					
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();
				}
				
				function calc_num_settimane_<?php echo $id_pers;?>(){
					var stringa = document.getElementById('<?php echo $id_pers;?>_num_settimane').value;
					if(isNaN(document.getElementById('<?php echo $id_pers;?>_num_settimane').value)) {
						<?php if($lingua=="ita"){?>
							alert('Inserire un numero intero');
						<?php }else{?>
							alert('Enter a whole number');
						<?php }?>
						document.getElementById('<?php echo $id_pers;?>_num_settimane').value = document.getElementById('<?php echo $id_pers;?>_num_settimane').value.substr(0, document.getElementById(id_pers+'_num_settimane').value.length-1);
					}else{
						if(document.getElementById('<?php echo $id_pers;?>_num_settimane').value=="") 
							document.getElementById('<?php echo $id_pers;?>_num_settimane').value=0;
						settimane_in_piu_<?php echo $id_pers;?> = document.getElementById('<?php echo $id_pers;?>_num_settimane').value;
					}
					
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();
				}
				$('#<?php echo $id_pers;?>_num_settimane').keyup(function(event) { calc_num_settimane_<?php echo $id_pers;?>()});
				
				function calc_num_giorni_<?php echo $id_pers;?>(){
					var stringa = document.getElementById('<?php echo $id_pers;?>_num_giorni').value;
					if(isNaN(document.getElementById('<?php echo $id_pers;?>_num_giorni').value)) {
						<?php if($lingua=="ita"){?>
							alert('Inserire un numero intero');
						<?php }else{?>
							alert('Enter a whole number');
						<?php }?>
						document.getElementById('<?php echo $id_pers;?>_num_giorni').value = document.getElementById('<?php echo $id_pers;?>_num_giorni').value.substr(0, document.getElementById('<?php echo $id_pers;?>_num_giorni').value.length-1);
					}else{
						giorni_in_piu_<?php echo $id_pers;?> = document.getElementById('<?php echo $id_pers;?>_num_giorni').value;
					}					
					
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();
				}
				$('#<?php echo $id_pers;?>_num_giorni').keyup(function(event) { calc_num_giorni_<?php echo $id_pers;?>() });

				function calc_num_settimane_2_<?php echo $id_pers;?>(){
					var stringa = document.getElementById('<?php echo $id_pers;?>_num_settimane_2').value;
					if(isNaN(document.getElementById('<?php echo $id_pers;?>_num_settimane_2').value)) {
						<?php if($lingua=="ita"){?>
							alert('Inserire un numero intero');
						<?php }else{?>
							alert('Enter a whole number');
						<?php }?>
						document.getElementById('<?php echo $id_pers;?>_num_settimane_2').value = document.getElementById('<?php echo $id_pers;?>_num_settimane_2').value.substr(0, document.getElementById(id_pers+'_num_settimane_2').value.length-1);
					}else{
						if(document.getElementById('<?php echo $id_pers;?>_num_settimane_2').value=="") 
							document.getElementById('<?php echo $id_pers;?>_num_settimane').value=0;
						settimane_in_piu_<?php echo $id_pers;?>_2 = document.getElementById('<?php echo $id_pers;?>_num_settimane_2').value;
					}
					
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();
				}					
				$('#<?php echo $id_pers;?>_num_settimane_2').keyup(function(event) { calc_num_settimane_2_<?php echo $id_pers;?>() });
				
				function calc_num_giorni_2_<?php echo $id_pers;?>(){
					var stringa = document.getElementById('<?php echo $id_pers;?>_num_giorni_2').value;
					if(isNaN(document.getElementById('<?php echo $id_pers;?>_num_giorni_2').value)) {
						<?php if($lingua=="ita"){?>
							alert('Inserire un numero intero');
						<?php }else{?>
							alert('Enter a whole number');
						<?php }?>
						document.getElementById('<?php echo $id_pers;?>_num_giorni_2').value = document.getElementById('<?php echo $id_pers;?>_num_giorni_2').value.substr(0, document.getElementById('<?php echo $id_pers;?>_num_giorni_2').value.length-1);
					}else{
						giorni_in_piu_<?php echo $id_pers;?>_2 = document.getElementById('<?php echo $id_pers;?>_num_giorni_2').value;
					}					
					
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();					
				}
				$('#<?php echo $id_pers;?>_num_giorni_2').keyup(function(event) { calc_num_giorni_2_<?php echo $id_pers;?>() });
				
				function num_mesi_<?php echo $id_pers;?>(){
					var stringa = document.getElementById('<?php echo $id_pers;?>_num_mesi').value;
					if(isNaN(document.getElementById('<?php echo $id_pers;?>_num_mesi').value)) {
						<?php if($lingua=="ita"){?>
							alert('Inserire un numero intero');
						<?php }else{?>
							alert('Enter a whole number');
						<?php }?>
						document.getElementById('<?php echo $id_pers;?>_num_mesi').value = document.getElementById('<?php echo $id_pers;?>_num_mesi').value.substr(0, document.getElementById('<?php echo $id_pers;?>_num_mesi').value.length-1);
					}else{
						numero_mesi_<?php echo $id_pers;?> = document.getElementById('<?php echo $id_pers;?>_num_mesi').value;
					}					
					
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();					
				}
				$('#<?php echo $id_pers;?>_num_mesi').keyup(function(event) { num_mesi_<?php echo $id_pers;?>() });
				
				function num_extra_<?php echo $id_pers;?>(){
					var stringa = document.getElementById('<?php echo $id_pers;?>_num_extra').value;
					
					if(isNaN(document.getElementById('<?php echo $id_pers;?>_num_extra').value)) {
						<?php if($lingua=="ita"){?>
							alert('Inserire un numero intero');
						<?php }else{?>
							alert('Enter a whole number');
						<?php }?>
						document.getElementById('<?php echo $id_pers;?>_num_extra').value = document.getElementById('<?php echo $id_pers;?>_num_extra').value.substr(0, document.getElementById('<?php echo $id_pers;?>_num_extra').value.length-1);
							
					}else{
						numero_extra_<?php echo $id_pers;?> = document.getElementById('<?php echo $id_pers;?>_num_extra').value;
					}			
					
					calcolaTotale_<?php echo $id_pers;?>();
					calcolaTotale();
				}
				$('#<?php echo $id_pers;?>_num_extra').keyup(function(event) { num_extra_<?php echo $id_pers;?>() });
				
				function mezzaSett_<?php echo $id_pers;?>(){
					if(document.getElementById('<?php echo $id_pers;?>_mezza_settimana').checked==true){					
						document.getElementById('<?php echo $id_pers;?>_mezza_settimana_val').value="si";
						
						costo_<?php echo $id_pers;?> = costo_mezza_sett_<?php echo $id_pers;?>;						
						settimane_in_piu_<?php echo $id_pers;?> = 0;
						document.getElementById('<?php echo $id_pers;?>_num_settimane').value = "";
						giorni_in_piu_<?php echo $id_pers;?> = 0;
						document.getElementById('<?php echo $id_pers;?>_num_giorni').value = "";
						
						document.getElementById('<?php echo $id_pers;?>_sett_succ').style.display="none";
						document.getElementById('<?php echo $id_pers;?>_giorni_succ').style.display="none";
						
						totale_<?php echo $id_pers;?> = parseInt(costo_<?php echo $id_pers;?>) + parseInt(tessera_<?php echo $id_pers;?>);		
					}else{
						costo_<?php echo $id_pers;?> = costo_prima_sett_<?php echo $id_pers;?>;	
						
						document.getElementById('<?php echo $id_pers;?>_sett_succ').style.display="block";
						document.getElementById('<?php echo $id_pers;?>_giorni_succ').style.display="block";
						
						calcolaTotale_<?php echo $id_pers;?>();
					}
					calcolaTotale();
				}
				
				<?php if($ind_sel!=""){?>
					vediMore_<?php echo $id_pers;?>("<?php echo $prezzi_tipo[$ind_sel]['prima'];?>","<?php echo $prezzi_tipo[$ind_sel]['seconda'];?>","<?php echo $prezzi_tipo[$ind_sel]['giorni'];?>","<?php echo $prezzi_tipo[$ind_sel]['mezza'];?>");
				<?php }?>
				<?php if($num_settimane!=""){?>
					calc_num_settimane_<?php echo $id_pers;?>()
				<?php }?>
				<?php if($num_giorni!=""){?>
					calc_num_giorni_<?php echo $id_pers;?>()
				<?php }?>
				<?php if($num_settimane_2!=""){?>
					calc_num_settimane_2_<?php echo $id_pers;?>()
				<?php }?>
				<?php if($num_giorni_2!=""){?>
					calc_num_giorni_2_<?php echo $id_pers;?>()
				<?php }?>
			</script>
			
			
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Carta D'identità<?php }else{?>Identity document<?php }?></label>
						<input type="file" class="form-control"  style="height:50px" name="<?php echo $id_pers;?>_CI" id="<?php echo $id_pers;?>_CI" value="<?php echo $CI;?>">
					</div>
				</div>	
				<div class="col-md-6">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Codice Fiscale<?php }else{?>Tax code<?php }?></label>
						<input type="file" class="form-control"  style="height:50px"  name="<?php echo $id_pers;?>_CF" id="<?php echo $id_pers;?>_CF" value="<?php echo $CF;?>">
					</div>
				</div>
				<?php /*
				<div class="col-md-4">
					<div class="form-group">
						<label class="upper" for="name"><?php if($lingua=="ita"){?>Certificato medico*<?php }else{?>Medical certificate*<?php }?></label>
						<input type="file" class="form-control" style="height:50px" name="<?php echo $id_pers;?>_CM" id="<?php echo $id_pers;?>_CM" value="<?php echo $CM;?>">
					</div>
				</div>
				*/?>
			</div>
			<?php /*
			<script>
				window["<?php echo $id_pers;?>_CM_existing"] = "<?php echo addslashes($CM);?>";
			</script>
			*/?>
		</div>		
	</div>
</div>

<?php if($id_pers==1){?><script src="resarea/jui/js/jquery-ui-1.9.2.min.js"></script><?php }?>
<script type="text/javascript">
	function cancellaDati(id){
		document.getElementById('dati_personali_'+id).style.display='none';
		document.getElementById(id+'_nome').value = "";
		//num_pers = num_pers-1;
		document.getElementById('num_pers').value=num_pers;
		
		calcolaTotale()
	}
	<?php if($id_pers==1){?>$.datepicker.setDefaults( $.datepicker.regional[ "it" ] );<?php }?>
	$( ".<?php echo $id_pers;?>_mws-datepicker" ).datepicker({ dateFormat: 'dd-mm-yy',changeYear: true,yearRange: "-110:+1" });/**/
	
	
	
	@if($fam==1)
		@php
			$query_agg = DB::table('iscrizioni_scuola')
				->select('id')
				->where('id_rife','=',$id_ute)
				->get();
			$num_agg = $query_agg->count();
		@endphp
		@if($num_agg>0)
			@php
				$timeout = 500;
			@endphp
			@foreach($query_agg AS $key_agg=>$value_agg)
				setTimeout(function(){aggiungiPersona("<?php echo $value_agg->id;?>");}, <?php echo $timeout;?>);
				@php
					$timeout = $timeout + 500;
				@endphp
			@endforeach
		@endif
	@endif
</script>