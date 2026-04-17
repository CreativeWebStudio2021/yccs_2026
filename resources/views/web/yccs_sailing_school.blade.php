@extends('web.index')

@section('content')	
	
	@include('web.common.yccs_sailing_school_slide')
	
	<section>
		<div class="container">
			<div class="row">
				@if( count($errors) > 0)
					@foreach($errors->all() as $error)
						<div class="col-lg-12 alert alert-success" style="margin-bottom:20px" role="alert" id="errorMessage" style="background:{{ $message_color }}">
							<div style="float:left; width:90%;">
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								<span class="sr-only">{{ trans('labels.Error') }}:</span>
								{!! $error !!}
							</div>
							<div style="float:right; width:10%; text-align:right; cursor:pointer;" onclick="$('#errorMessage').fadeOut();"><b>x</b></div>
							<div style="clear:both"></div>
						</div>
					@endforeach
				@endif
				
				<div class="col-md-12">
					<div style="width:100%; display:flex; gap:35px;">
						<h3 class="gradient-title"><?php if($lingua=="ita"){?>CHI SIAMO<?php }else{?>ABOUT US<?php }?></h3>
						<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
					</div>
				</div>
								
				<div class=" col-md-12">	
					<div class="row">
						<div class=" col-md-6">		
							<p style="text-align:justify">
								<?php if($lingua=="ita"){?>
									Riconosciuta dalla <b>Federazione Italiana Vela</b>,  la <b>YCCS Sailing School</b> dello <b>Yacht Club Costa Smeralda</b> opera con la collaborazione di <b>Franco Pistone</b>, istruttore FIV di secondo livello con grande esperienza di navigazione e regate.<br/>
									<b>La scuola è attiva dal 1978</b> ed è aperta da maggio a ottobre. <b>Le lezioni si svolgono a Porto Cervo, in Sardegna</b>, nella suggestiva cornice della <b>Costa Smeralda</b> e vengono organizzati <b>corsi su derive e cabinati</b> coordinati da un gruppo di esperti istruttori.<br/> 
									La sede operativa della Scuola Vela si trova presso il <b>Centro sportivo dello YCCS</b> mentre le uscite in mare si svolgono dalla <b>spiaggia del Giglio</b>.
									<?php /*<b>La Scuola della Vela</b>, riconosciuta dalla <b>Federazione Italiana Vela</b>, è diretta da <b>Franco Pistone</b> istruttore FIV di secondo livello con grande esperienza di navigazione e regate.<br/>
									<b>La scuola è attiva dal 1978</b> ed è aperta da maggio a ottobre. <b>Le lezioni si svolgono in Sardegna</b> nella suggestiva cornice della <b>Costa Smeralda</b> e vengono organizzati <b>corsi su derive e cabinati</b> coordinati da un gruppo di esperti istruttori.*/?>
									<br/><br/>
									Per adulti e ragazzi sono consigliati i corsi su <b>J24 (barche di 7 metri)</b>. Entrambe barche tecniche e veloci con le quali si organizzano equipaggi per partecipare a regate nazionali ed internazionali.
									<br/><br/>
									La flotta a disposizione è sempre in ordine, con <b>attrezzatura e vele in perfette condizioni</b> e una cura scrupolosa della manutenzione e pulizia delle imbarcazioni.
									<br/><br/>
								<?php }else{?>
									<b>The Sailing School</b>, recognised by the <b>Italian Sailing Federation</b>, is run in collaboration with <b>Franco Pistone</b>, 2nd level FIV instructor, with a wealth of sailing and regatta experience.<br/>
									<b>The school has been running since 1978</b> and is open from May to October. <b>Classes are held in Porto Cervo, Sardinia</b>, in the enchanting surroundings of the <b>Costa Smeralda</b>.<br/>
									The Sailing School has its operational base at the <b>YCCS Sports Centre</b>, while practical lessons at sea depart from the <b>Giglio beach</b>.
									<?php /*<b>The Sailing School</b>, recognized by the <b>Italian Sailing Federation</b>, is directed by <b>Franco Pistone</b>  2nd level FIV instructor with great sailing experience and regattas.<br/>
									<b>We manage the school since 1978</b> and we are open from May to October. <b>Classes are held in Sardinia</b> in the suggestive surroundings of the <b>Emerald Coast</b>.*/?>
									<br/><br/>
									For adults we suggest the <b>7.2 meter J-24’s</b> more challenging, fun and stable.
									<br/><br/>
									The fleet is always clean with <b>equipment and sails in perfect condition</b> with scrupulous care and maintenance of the boats.
									<br/><br/>
								<?php }?>		
							</p>
							<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs-sailing-school-iscrizioni.html">
								<div style="float:left; width:320px; height:37px;  background:Red; margin-bottom:15px;; color:#fff; border:solid 2px #e2001a; border-radius:4px; text-align:center;" onmouseover="this.style.color='#000'; this.style.background='#fff'" onmouseout="this.style.color='#fff'; this.style.background='#e2001a'">
									<div style="padding:4px 10px; font-size:<?php if($lingua=="ita"){?>0.9em<?php }else{?>0.7em<?php }?>">
										<strong><?php if($lingua=="ita"){?>TESSERAMENTO E ISCRIZIONE CORSI <?php echo date("Y");?><?php }else{?>MEMBERSHIP AND REGISTRATION OF THE COURSES <?php echo date("Y");?><?php }?></strong>
									</div>
								</div>
							</a>
						</div>
						<div class=" col-md-6">	
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1502.4797841713125!2d9.525768114996383!3d41.135408585296204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12d9410059b6b46d%3A0xd949907962adc5d1!2sYCCS%20Sailing%20School!5e0!3m2!1sit!2sit!4v1716385901550!5m2!1sit!2sit" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>
		</div>
	</section>	
		
	<section class="text-light" style="background: url(https://www.yccs.it/web/images/scuola/gallery/sf-scuola-1.jpg) center center; margin:0; padding:0px">
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12 fotoCircle" style="padding:20px 20px; ">
							<div class="image-box circle-image circle-custom"> <img  style="border-radius:125px; width:250px; border:solid 6px #EEEEEE;" alt="" src="https://www.yccs.it/web/images/scuola/Franco-150x150.jpg" class=""> </div>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12" style="padding:30px 10px; text-shadow:#000 1px 1px 3px;">
							<h4 style="color:#fff; line-height:40px; margin-top:30px;">Franco Pistone</h4>	
							<p style="line-height:18px; color:#fff;"><i style="font-style:italic"><?php if($lingua=="ita"){?>Istruttore Nazionale FIV<?php }else{?>FIV instructor<?php }?></i></p>
							<p style="line-height:18px;  color:#fff">
								<a href="mailto:sailingschool@yccs.it" style="color:#fff;"><i class="fa fa-envelope" aria-hidden="true"></i> sailingschool@yccs.it</a><br/>
								<a href="tel:+39 3470795547" style="color:#fff;"><i class="fa fa-phone-square" aria-hidden="true"></i> +39 347.0795547</a><br/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<style>
		.tabs .nav-tabs .nav-link.active {
			color:#0072C6;
		}
	</style>
	<section>	
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div style="width:100%; display:flex; gap:35px;">
						<h3 class="gradient-title"><?php if($lingua=="ita"){?>LA FLOTTA<?php }else{?>THE FLEET<?php }?></h3>
						<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="tabs tabs-folder">
						<ul class="nav nav-tabs" id="myTab3" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#Le_Derive" role="tab" aria-controls="home" aria-selected="true" style="color:#2e343c"><b><?php if($lingua=="ita"){?>LE DERIVE<?php }else{?>DINGHIES<?php }?></b></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#I_Cabinati" role="tab" aria-controls="profile" aria-selected="false" style="color:#2e343c"><b><?php if($lingua=="ita"){?>I CABINATI<?php }else{?>KEELBOATS<?php }?></b></a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent3">
							<div class="tab-pane fade show active" id="Le_Derive" role="tabpanel" aria-labelledby="home-tab">
								<h4 style="color:#0072c6">Laser</h4>
								<p style="">
									<?php if($lingua=="ita"){?>	
										Agili imbarcazioni di 4,20 metri di lunghezza, sono le derive olimpiche più diffuse al mondo. L’ideale per apprendere una disciplina impegnativa e divertente al tempo stesso.
									<?php }else{?>
										These agile, 4.20m crafts are the olympic dinghies most diffused worldwide. Ideal for learning a discipline which requires serious effort and is great fun at the same time.
									<?php }?>
								</p>
								
								<?php /*<h4 style="color:#0072c6">Laser 2</h4>
								<p style="">
									<?php if($lingua=="ita"){?>	
										Poco più grande del laser, utilizzato per i corsi di perfezionamento e regata alle prese con manovre che prevedono l’utilizzo dello spinnaker.
									<?php }else{?>
										Slightly larger than the Laser, this vessel is used for advanced levels of sailing, incorporating Manoeuvres where the use of spinnaker and bow are often called for.
									<?php }?>
								</p>*/?>
								<h4 style="color:#0072c6">RS Quest</h4>
								<p style="">
									<?php if($lingua=="ita"){?>	
										Una moderna deriva creata per Scuole Vela con caratteristiche notevolmente avanzate. È attrezzata con randa fiocco e gennaker, a bordo possono salire un istruttore insieme a 2 o 3 allievi.
									<?php }else{?>
										A modern dinghy designed for sailing schools and boasting advanced features. It is equipped with a mainsail jib and gennaker, and is suitable for an instructor along with 2 or 3 students.
									<?php }?>
								</p>
								
								<h4 style="color:#0072c6">Laser Pico</h4>
								<p style="">
									<?php if($lingua=="ita"){?>	
										La novità della Laser, sono barche divertenti e stabili che permettono ai principianti di veleggiare con facilità nelle giornate di vento forte.
									<?php }else{?>
										The latest from Laser, these boats are fun and stable, allowing students to sail easily even with strong winds.
									<?php }?>
								</p>
								
								<h4 style="color:#0072c6">FIV 555</h4>
								<p style="">
									<?php if($lingua=="ita"){?>	
										La barca della federazione per avviare i ragazzi agli skiff, barche veloci divertenti e molto impegnative.
									<?php }else{?>
										The new boat of the Italian Sailing Federation to initiate kids to skiffs, speedboats fun and very challenging
									<?php }?>
								</p>
								
								<h4 style="color:#0072c6">Laser Bug</h4>
								<p style="">
									<?php if($lingua=="ita"){?>	
										Singolo per bambini con sola randa più semplice e più veloce dell’Optimist.
									<?php }else{?>
										Single with one mainsail easier and faster than Optimist
									<?php }?>
								</p>
							</div>
							<div class="tab-pane fade" id="I_Cabinati" role="tabpanel" aria-labelledby="profile-tab">
								<?php if($lingua=="ita"){?>	
									<p style="">
										La flotta dei cabinati è composta da barche di varie misure.
									</p>
								<?php }?>
								<h4 style="color:#0072c6">J 24</h4>
								<p style="">
									<?php if($lingua=="ita"){?>	
										Imbarcazioni monotipo di 7,30 metri di lunghezza, ideali per tutti coloro che si accostano alla vela per imparare, perfezionarsi ed avviarsi alla regata.
									<?php }else{?>
										The school has 5 J 24 robust and fast monotype of 7.30 meters, ideal to learn, improve own knowledge and start to make regattas.
									<?php }?>
								</p>
								
								<h4 style="color:#0072c6">J105</h4>
								<p style="">
									<?php if($lingua=="ita"){?>	
										35 piedi sportivo e scattante con il quale effettuiamo crociere intorno alle isole dell’arcipelago e allenamenti per regate. E’ armato con grande gennaker è ideale per divertirsi e navigare in velocità. Sui cabinati durante l’inverno vengono effettuati corsi di altura e corsi regata.
									<?php }else{?>
										35 foot racing, ideal for cruises around the islands of the Archipelago, armed with a large gennaker is the perfect boat to have fun and surf speed.
									<?php }?>
								</p>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</section>

	<section class="text-light" style="background: url(https://www.yccs.it/web/images/scuola/gallery/sf-scuola-2.jpg) center center;">
		<div class="container">
			<div class="row">
				<div class="col-md-6">			
					<h3 style="text-shadow:#000 1px 1px 2px; font-size:40px; line-height:40px;"><?php if($lingua=="ita"){?>Per richiedere<br/>qualsiasi informazione<?php }else{?>For any <br/>Request<?php }?></h3>
				</div>
				<div class="col-md-6">			
					<div style="float:right;width:180px; margin:0;  border-radius:5px; border: solid 2px #fff; background:rgba(0,0,0,0.2);">
						<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs-porto-cervo/yccs-sailing-school.html#contattaci">
							<div style="padding:10px; color:#fff; text-align:center; text-shadow:#000 1px 1px 2px">
								<?php if($lingua=="ita"){?>CONTATTACI<?php }else{?><strong>CONTACT US </strong><?php }?>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<style>
		.table-striped tbody tr:nth-of-type(odd) {
			background-color: #F9F9F9;
		}
	</style>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div style="width:100%; display:flex; gap:35px;">
						<h3 class="gradient-title"><?php if($lingua=="ita"){?>TARIFFE CORSI<?php }else{?>SAILING SCHOOL FEES<?php }?></h3>
						<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="accordion clean color-border-bottom">
						<div class="table-responsive">					  
						  <?php if($lingua=="ita"){?>
							  <table class="table table-striped" style=";">
								<thead>
								  <tr>
									<th><b>CORSI DERIVE Maggio/Settembre (Base Porto Cervo) </b></th>
									<th style="text-align:center;"><b>1a settim.</b></th>
									<th style="text-align:center;"><b>2a settim.</b></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>Da 6 a 18 anni</td>
									<td style="text-align:center;">&euro;380</td>
									<td style="text-align:center;">&euro;320</td>
								  </tr>
								  <tr>
									<td>Oltre i 18 anni</td>
									<td style="text-align:center;">&euro;440</td>
									<td style="text-align:center;">&euro;380</td>
								  </tr>
								</tbody>
								<thead>
								  <tr>
									<th><b>CORSI DERIVE Ottobre/Aprile</b></th>
									<th colspan="2" style="text-align:center;"><b>al mese</b></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>Da 10 a 18 anni</td>
									<td colspan="2" style="text-align:center;">&euro;100</td>
								  </tr>
								</tbody>
								<thead>
								  <tr>
									<th><b>CORSI CABINATI (J24 e J105)</b></th>
									<th style="text-align:center;"><b>1a settim.</b></th>
									<th style="text-align:center;"><b>2a settim.</b></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>Da 12 a 18 anni</td>
									<td style="text-align:center;">&euro;400</td>
									<td style="text-align:center;">&euro;340</td>
								  </tr>
								  <tr>
									<td>Oltre i 18 anni</td>
									<td style="text-align:center;">&euro;450</td>
									<td style="text-align:center;">&euro;400</td>
								  </tr>					  
								</tbody>
								<thead>
								  <tr>
									<th><b>CORSI J24 con alloggio (oltre i 18 anni)</b></th>
									<th style="text-align:center;"><b>1a settim.</b></th>
									<th style="text-align:center;"><b>2a settim.</b></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>Maggio - Giugno - Settembre</td>
									<td style="text-align:center;">&euro;750</td>
									<td style="text-align:center;">&euro;690</td>
								  </tr>
								  <tr>
									<td>Luglio</td>
									<td style="text-align:center;">&euro;870</td>
									<td style="text-align:center;">&euro;800</td>
								  </tr>
								  <tr>
									<td>Agosto</td>
									<td style="text-align:center;">&euro;910</td>
									<td style="text-align:center;">&euro;840</td>
								  </tr>
								  <tr>
									<td>Extra settimanale per integrazione corso full time</td>
									<td colspan="2" style="text-align:center;">&euro;140</td>
								  </tr>
								  <?php /*<tr>
									<td>Iscrizione - Inclusa tessera FIV</td>
									<td colspan="2" style="text-align:center;">&euro;50</td>
								  </tr>		*/?>				  
								</tbody>
								<thead>
								  <tr>
									<th><b>Iscrizione - Inclusa tessera FIV</b></th>
									<th></th>
									<th></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>Maggio/Settembre</td>
									<td colspan="2" style="text-align:center;">&euro;50</td>
								  </tr>
								  <tr>
									<td>Ottobre/Aprile</td>
									<td colspan="2" style="text-align:center;">&euro;20</td>
								  </tr>
								</tbody>
							  </table>
						  <?php }else{?>							  
							  <table class="table table-striped" style=";">
								<thead>
								  <tr>
									<th><b>DINGHIES May/September (Porto Cervo)</b></th>
									<th style="text-align:center;"><b>1st week</b></th>
									<th style="text-align:center;"><b>2nd week</b></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>6/18 years old</td>
									<td style="text-align:center;">&euro;380</td>
									<td style="text-align:center;">&euro;320</td>
								  </tr>
								  <tr>
									<td>Adults</td>
									<td style="text-align:center;">&euro;440</td>
									<td style="text-align:center;">&euro;380</td>
								  </tr>
								</tbody>
								<thead>
								  <tr>
									<th><b>DINGHIES October/April (Porto Cervo)</b></th>
									<th colspan="2" style="text-align:center;"><b>per month</b></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>10/18 years old</td>
									<td colspan="2" style="text-align:center;">&euro;100</td>
								  </tr>
								</tbody>
								<thead>
								  <tr>
									<th><b>KEELBOATS SAILING COURSES (J24 e J105)</b></th>
									<th style="text-align:center;"><b>1st week</b></th>
									<th style="text-align:center;"><b>2nd week</b></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>12/18 years old</td>
									<td style="text-align:center;">&euro;400</td>
									<td style="text-align:center;">&euro;340</td>
								  </tr>
								  <tr>
									<td>Adults</td>
									<td style="text-align:center;">&euro;450</td>
									<td style="text-align:center;">&euro;400</td>
								  </tr>					  
								</tbody>
								<thead>
								  <tr>
									<th><b>COURSES J24 with accommodation (only adults)</b></th>
									<th style="text-align:center;"><b>1st week</b></th>
									<th style="text-align:center;"><b>2nd week</b></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>May - June - September</td>
									<td style="text-align:center;">&euro;750</td>
									<td style="text-align:center;">&euro;690</td>
								  </tr>
								  <tr>
									<td>July</td>
									<td style="text-align:center;">&euro;870</td>
									<td style="text-align:center;">&euro;800</td>
								  </tr>
								  <tr>
									<td>August</td>
									<td style="text-align:center;">&euro;910</td>
									<td style="text-align:center;">&euro;840</td>
								  </tr>
								  <tr>
									<td>Weekly extra for full time course integration</td>
									<td colspan="2" style="text-align:center;">&euro;140</td>
								  </tr>
								 <?php /* <tr>
									<td>Membership - Mandatory FIV included</td>
									<td colspan="2" style="text-align:center;">&euro;50</td>
								  </tr>	*/?>					  
								</tbody>
								<thead>
								  <tr>
									<th><b>Membership - Mandatory FIV included</b></th>
									<th></th>
									<th></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>May/September</td>
									<td colspan="2" style="text-align:center;">&euro;50</td>
								  </tr>
								  <tr>
									<td>October/April</td>
									<td colspan="2" style="text-align:center;">&euro;20</td>
								  </tr>
								</tbody>
							  </table>
						  
						  <?php }?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section class="text-light" style="background: url(https://www.yccs.it/web/images/scuola/gallery/sf-scuola-3.jpg) center;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">			
					<div style="width:40%; margin:0 auto;  margin-bottom:15px; border-radius:5px; border: solid 2px #fff; background:rgba(0,0,0,0.2)">
						<a href="<?php if($lingua=="eng"){?>en/<?php }?>yccs-sailing-school-iscrizioni.html">
							<div style="padding:10px; color:#fff; text-align:center; text-shadow:#000 1px 1px 2px">
								<strong><?php if($lingua=="ita"){?>TESSERAMENTO E ISCRIZIONE CORSI <?php echo date("Y");?><?php }else{?>MEMBERSHIP AND REGISTRATION OF THE COURSES <?php echo date("Y");?><?php }?></strong>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container" >
			<div class="row">
				<div class="col-md-12">
					<div style="width:100%; display:flex; gap:35px;">
						<h3 class="gradient-title"><?php if($lingua=="ita"){?>CORSI<?php }else{?>COURSES<?php }?></h3>
						<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="tabs tabs-folder">
						<ul class="nav nav-tabs" id="myTab3" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#Derive" role="tab" aria-controls="home" aria-selected="true" style="color:#2e343c"><b><?php if($lingua=="ita"){?>DERIVE<?php }else{?>DINGHIES<?php }?></b></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#Cabinati" role="tab" aria-controls="profile" aria-selected="false" style="color:#2e343c"><b><?php if($lingua=="ita"){?>CABINATI<?php }else{?>KEELBOATS<?php }?></b></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#Corsi_con_alloggio" role="tab" aria-controls="profile" aria-selected="false" style="color:#2e343c"><b><?php if($lingua=="ita"){?>CORSI CON ALLOGGIO<?php }else{?>COURSES WITH ACCOMMODATION<?php }?></b></a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent3">
							<div class="tab-pane fade show active" style="text-align:justify" id="Derive" role="tabpanel" aria-labelledby="home-tab">
								<h4 style="color:#0072c6"><?php if($lingua=="ita"){?>Corsi Derive<?php }else{?>Dinghies Sailing courses<?php }?></h4>
								<p style="">
									<?php if($lingua=="ita"){?>
										<?php /*<p style="">
											La Scuola della Vela, riconosciuta dalla Federazione Italiana Vela &egrave; diretta da Franco Pistone, istruttore nazionale dal 1978, organizza corsi su derive e cabinati, i corsi sono seguiti da un gruppo di esperti istruttori di vela. Le lezioni si svolgono nella suggestiva cornice della Costa Smeralda a Porto Cervo dove si trovano le derive.<br />
											I corsi sono aperti a bambini dai sei anni di et&agrave;, ragazzi ed adulti. Per i pi&ugrave; grandi sono consigliati i J 24 barche di sette metri, tecniche, divertenti e pi&ugrave; stabili.</p>
										<p style="">
											Per gli allievi &egrave; disponibile il servizio navetta gratuito da casa alla scuola, salvo disponibilit&agrave; al momento dell&rsquo;iscrizione.</p>
										*/?>
										<p style="">
											<strong>Programma Corsi</strong>
										</p>
										<p style="">
											La durata dei corsi &egrave; di sei giorni a settimana:
										</p>
										
										<p style="">
											<strong>Derive </strong><em>et&agrave; minima 6 anni</em> <br /><br />
											<strong>Inizio il luned&igrave;</strong> - Orario dalle ore 10,00 alle 13,00<br />
											Ore 10,00 inizio lezione teorica<br />
											Ore 10,45 armamento delle barche e uscita in mare<br />
											Ore 12,45 rientro<br />
											Ore 13,00 fine della lezione<br /><br />
											<strong>Imbarcazioni usate</strong>: Laser, Laser Bug, Laser Pico, Laser Vago, Open Skiff, Rs Quest e Fiv 555.
										</p>	
										
										
										<?php /*<div style="padding:20px 20px 10px; border:solid 1px #E6E8EB; border-radius:3px; margin-top:20px">
											<p style="">
												<strong>Corsi su cabinati: J24 o J105</strong>, <em>et&agrave; minima 12 anni</em><br/><br/>
												<strong>Inizio il luned&igrave;</strong> - Orario dalle ore 10,00 alle ore 13,00<br /><br />
												<strong>Imbarcazioni usate</strong>:<br/>
												Laser Pico , Laser Bug, Open Skiff per i pi&ugrave; piccoli<br />
												Laser, Laser Vago, Rs Quest e Fiv 555 per i ragazzi e gli adulti.
											</p>
										</div>*/?>
									<?php }else{?>
										<?php /*<p style="">
											La Scuola della Vela, offers sailing courses on dinghies for children and adults.<br />
											Approved by the Italian Sailing Association (FIV), the school is directed by Franco Pistone, FIV certified instructor since 1978. The suggestive surroundings of the Sardinian Emerald Coast host our lessons: dinghies operate out of Porto Cervo, are open to all from six years and over. Boats: Laser, Laser Pico, Laser Bug, Laser 2, Fiv 555.</p>
										<p style="">
											Free shuttle service from home to school subjet to availability, will be determinated at the enrollment time.</p>
										*/?>
										<p style="">
											<strong>Program</strong>
										</p>
										<p style="">
											Six day courses as follows:										
										</p>
										<p style="">
											<strong>Dinghies </strong><em>6 years minimum age</em> (Laser, Laser Bug, Laser Pico, Laser Vago, Open Skiff, Rs Quest e Fiv 555).<br /><br/>
											<strong>First lesson on Monday</strong> - from 10,00 until 1,00 pm<br />
											h. 10,00 on-shore lesson<br />
											h. 10,45 rig, then out on the water<br />
											h. 12,45 pm back ashore<br />
											h. 01,00 pm end of lesson
										</p>
										<?php /*<div style="padding:20px 20px 10px; border:solid 1px #E6E8EB; border-radius:3px; margin-top:20px">
											<p style="">
												<strong>Keelboats: J-24’s or J-105’s</strong>, <em>13 years minimum age</em><br/><br/>
												<strong>First lesson on Monday</strong> - from 10,00 until 1,00 pm<br />											
												<strong>Imbarcazioni usate</strong>:<br/>
												Laser Pico , Laser Bug, Open Skiff per i pi&ugrave; piccoli<br/>
												Laser, Laser Vago, Rs Quest e Fiv 555 per i ragazzi e gli adulti.
											</p>
										</div>*/?>
									<?php }?>
								</p>
							</div>
							<div class="tab-pane fade" style="text-align:justify" id="Cabinati" role="tabpanel" aria-labelledby="profile-tab">
								<h4 style="color:#0072c6"><?php if($lingua=="ita"){?>Corsi Cabinati<?php }else{?>Keelboats Sailing courses<?php }?></h4>
								<p style="">							
									<?php if($lingua=="ita"){?>
										<div style="">
											Sono aperti agli adulti e ai ragazzi dai 13 anni, hanno cadenza settimanale.</div>
										<div style="">
											Per partecipare occorre un certificato di sana e robusta costituzione non agonistico.</div>
										<div style="">
											I corsi si svolgono a bordo dei J24, barca veloce di 7,30 mt. adatta sia ai neofiti che per i corsi di perfezionamento e regata.</div>
										<div style="">
											&nbsp;</div>
										<div style="">
											La durata dei corsi &egrave; di sei giorni a settimana con Inizio il Luned&igrave; dalle ore 10,00 alle ore 13,00.</div>
										<div style="">
											&nbsp;</div>
										<div style="">
											<strong>Programma Corsi</strong></div>
										<div style="">
											&nbsp;</div>
										<div style="">
											<em>Ore 10,00</em> inizio lezione teorica</div>
										<div style="">
											<em>Ore 10,45</em> armamento delle barche e uscita in mare</div>
										<div style="">
											<em>Ore 12,45</em> rientro in porto</div>
										<div style="">
											<em>Ore 13,00</em> disarmo della barca e fine della lezione.</div>
										<div style="">
											&nbsp;</div>
									<?php }else{?>
										<div style="">
											We organize keelboats sailing courses from minimum 13 years old and adults.</div>
										<div style="">
											Courses take place in Porto Cervo or Poltu Quatu with J24 7.2 or with J105 10.5 meter all boats very challenging, fun and stable.</div>
										<div style="">
											&nbsp;</div>
										<div style="">
											Six day courses as follows: <strong>First lesson on Monday</strong> - from 10,00 until 1 pm</div>
										<div style="">
											&nbsp;</div>
										<div style="">
											<strong>Program</strong></div>
										<div style="">
											&nbsp;</div>
										<div style="">
											h. 10,00 on-shore lesson</div>
										<div style="">
											h. 10,45 rig, then out on the water</div>
										<div style="">
											h. 02,45 pm back ashore</div>
										<div style="">
											h. 01 pm end of lesson.</div>
										<div style="">
											&nbsp;</div>
									<?php }?>
									<?php if($lingua=="ita"){?>
										<div style="">
											<strong>I Livelli</strong></div>
										<div style="">
											&nbsp;</div>
										<div style="">
											<em>1&deg; livello</em>: BASE - Termini velici, nodi marini, armamento barche e prime manovre.</div>
										<div style="">
											<em>2&deg; livello</em>: PERFEZIONAMENTO - Virata, strambata, tecnica di conduzione nelle varie andature, il vento apparente.</div>
										<div style="">
											<em>3&deg; livello</em>: AVANZATO - Manovre intorno alle boe, il controllo della barca, assetto a bordo.</div>
										<div style="">
											<em>4&deg; livello</em>: AGONISTICO - Regole base, messa a punto della barca, partenza, manovre in velocit&agrave;, lo spinnaker.</div>
										<div style="">
											<em>5&deg; livello</em>: REGATA - Organizzazione della regata e le regole</div>
									<?php }else{?>
										<div style="">
											<strong>LEVELS</strong></div>
										<div style="">
											&nbsp;</div>
										<div style="">
											<em>1&deg; BASIC</em>: Sailing terminology, rigging the boat, points of sail, knots, heading up and bearing away</div>
										<div style="">
											<em>2&deg; INTERMEDIATE</em>: Sailing the boat, onboard safety, true and apparent wind, tacking and jibing.</div>
										<div style="">
											<em>3&deg; ADVANCED</em>: AVANZATO - Mark rounding, finer points of sail, hull trim, and advanced boat handling.</div>
										<div style="">
											<em>4&deg; RACING</em>: Basic racing rules, starts, quick maneuvers, and spinnaker flying.</div>
										<div style="">
											<em>5&deg; ADVANCED RACING</em>: Regatta organization, racing rules, on board roles, tactics and strategies.</div>
									<?php }?>
								</p>
							</div>
							<div class="tab-pane fade" style="text-align:justify" id="Corsi_con_alloggio" role="tabpanel" aria-labelledby="profile-tab">
								<?php 
								$x=0;
								$x++; $foto_foresteria[$x]['ante'] = "web/images/foresteria/s_DSC00329.jpg"; $foto_foresteria[$x]['img'] = "web/images/foresteria/DSC00329.jpg";
								//$x++; $foto_foresteria[$x]['ante'] = "web/images/foresteria/s_DSC00332.jpg"; $foto_foresteria[$x]['img'] = "web/images/foresteria/DSC00332.jpg";
								$x++; $foto_foresteria[$x]['ante'] = "web/images/foresteria/s_DSC00341.jpg"; $foto_foresteria[$x]['img'] = "web/images/foresteria/DSC00341.jpg";
								$x++; $foto_foresteria[$x]['ante'] = "web/images/foresteria/s_DSC00360.jpg"; $foto_foresteria[$x]['img'] = "web/images/foresteria/DSC00360.jpg";
								$x++; $foto_foresteria[$x]['ante'] = "web/images/foresteria/s_DSC00409.jpg"; $foto_foresteria[$x]['img'] = "web/images/foresteria/DSC00409.jpg";
								$x++; $foto_foresteria[$x]['ante'] = "web/images/foresteria/s_DSC00440.jpg"; $foto_foresteria[$x]['img'] = "web/images/foresteria/DSC00440.jpg";
								$x++; $foto_foresteria[$x]['ante'] = "web/images/foresteria/s_DSC00456.jpg"; $foto_foresteria[$x]['img'] = "web/images/foresteria/DSC00456.jpg";
								?>
								<style>
									.accordion .ac-item .ac-title:before {padding-right:10px}
								</style>
								
								<?php if($lingua=="ita"){?>
									<h4 style="color:#0072c6"><?php if($lingua=="ita"){?>Corsi con Alloggio<?php }else{?>Corsi con Alloggio<?php }?></h4>
									<p>La YCCS Sailing School, offre la possibilit&agrave; di frequentare i corsi di vela alloggiando nella foresteria dello Yacht Club Costa Smeralda a Porto Cervo Marina.<br />
									La nuova struttura ha due camerate con bagno con sette letti ciascuna e una zona relax/aula con tavoli per le lezioni e la colazione.&nbsp;</p>

									<p>I corsi con alloggio sono riservati agli allievi maggiorenni.<br />
									I corsi di vela sono di sei giorni con sei notti di ospitalit&agrave;, si possono fare una o pi&ugrave; settimane.<br />
									Imbarcazioni utilizzate : cabinati 7,32 mt. (J 24)&nbsp;<br />
									I corsi cabinati si svolgeranno con un minimo di due allievi.</p>
									
									<div class="accordion" style="margin-top:20px">
										<div class="ac-item" style="padding:0; background:#0072C6">
											<h5 class="ac-title" style="padding:12px; color:#fff">FOTO DELLA FORESTERIA</h5>
											<div class="ac-content" style="margin:0; padding:0;">
												<div class="row" style="background:#fff; padding:20px;" data-lightbox="gallery">
													<?php 													
													for($i=1; $i<=count($foto_foresteria); $i++){?>
														<div class="col-lg-4 col-sm-6" style="padding-bottom:20px;">
															<div class="grid-item-wrap">
																<div class="grid-item" style="padding-bottom:0">
																	<a title="Foresteria - <?php echo $i;?>" data-lightbox="gallery-image" href="https://www.yccs.it/<?php echo $foto_foresteria[$i]['img'] ;?>">
																		<div class="grid-image">
																			<img alt="Foresteria - <?php echo $i;?>" src="https://www.yccs.it/<?php echo $foto_foresteria[$i]['ante'] ;?>" />
																		</div>
																		<div class="grid-description">
																			<span class="btn btn-light btn-rounded">Zoom</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													<?php }?>
												</div>
											</div>
										</div>
									</div>

									<p><br />
									<strong>Programma</strong><br />
									Arrivo la domenica<br />
									Inizio del corso Luned&igrave; alle ore 10,00<br />
									Fine del corso il sabato alle ore 13,00 partenza il sabato pomeriggio<br />
									Su richiesta con integrazione di 140 &euro; a settimana gli allievi residenziali possono frequentare anche il pomeriggio, con orario 10,00 / 13,00 e 15,30 / 17,30, (il sabato i corsi termineranno alle 13,00)<br />
									La domenica &eacute; dedicata agli arrivi ed alla sistemazione in foresteria.<br />
									<br />
									<strong>Tariffe corsi cabinati con alloggio 2024</strong><br />
									Corso di vela di sei giorni e sei notti in foresteria.<br />
									maggio, giugno e settembre prima settimana &euro;750 seconda settimana &euro;690<br />
									Luglio: prima settimana &euro;870 seconda settimana &euro;800<br />
									Agosto prima settimana &euro;910 seconda settimana &euro;840&euro;<br />
									Obbligatoria, tessera Fiv e iscrizione e &euro;50<br />
									Extra :Integrazione per corso full time 140&euro; a settimana.<br />
									in base al numero dei partecipanti il pomeriggio si potr&agrave; uscire in deriva o in cabinato, a discrezione della scuola.<br />
									Extra<br />
									pranzo e cena e colazione, sono possibili in ristoranti convenzionati vicino la foresteria.<br />
									<br />
									Tariffe per persona, include i consumi , la biancheria e la pulizia finale.<br />
									<br />
									Al momento dell&#39;iscrizione bisogna presentare un certificato medico di sana e robusta costituzione e un documento con il codice fiscale<br />
									<br />
									<strong>Cosa &egrave; compreso:</strong><br />
									&bull; Sei giorni di corso di vela, dal luned&igrave; al sabato<br />
									&bull; Sei notti in foresteria, dalla domenica al venerd&igrave;.<br />
									&bull; Lenzuola e asciugamani (i letti non saranno preparati).<br />
									&bull; una pulizia iniziale e finale, durante la settimana le camere dovranno essere tenute in ordine dagli allievi.<br />
									&bull; Una maglietta della scuola vela (in regalo)<br />
									&bull; il salvagente per il periodo del corso<br />
									&bull; Il materiale didattico.</p>

									<p><br />
									<strong>Cosa serve:</strong><br />
									&bull; Certificato medico di sana e robusta costituzione (non agonistico)<br />
									&bull; Copia di un documento e codice fiscale<br />
									<br />
									<strong>Abbigliamento:</strong><br />
									&bull; giacca cerata o lycra, pantaloni corti o lunghi, scarpa da vela o ginnastica con suola bianca.<br />
									&bull; crema solare, cappellino.<br />
									Su richiesta organizziamo il transfert da Olbia a Porto Cervo<br />
									<br />
									<strong>Programma:</strong><br />
									&bull; ore 9,30 colazione<br />
									&bull; ore 10,00 inizio lezione teorica allo Yccs.<br />
									&bull; ore 10,40 armamento e uscita in barca.<br />
									&bull; ore 13,00 fine lezione.<br />
									&bull; pomeriggio su richiesta:<br />
									&bull; ore 15,30 uscita in barca pomeridiana derive o cabinati.<br />
									&bull; ore 17,30 rientro.<br />
									&bull; Il sabato il corso termina alle ore 13,00.</p>
								<?php }else{?>
									<h4 style="color:#0072c6">Courses with Accommodation</h4>
									<p>The YCCS Sailing School offers the opportunity to attend sailing courses and stay in the Yacht Club Costa Smeralda's guest accommodation in Porto Cervo Marina.<br />
									The new facility has two dormitories with seven beds each, bathrooms and a lounge/classroom area with tables for lessons and breakfast.</p>

									<p>Courses with accommodation are reserved for students over 18 years of age.<br />
									Sailing courses are six days with six nights' accommodation, one or several weeks can be booked.<br />
									Courses on cabin cruisers will be held with a minimum of two students.<br />
									
									<div class="accordion" style="margin-top:20px">
										<div class="ac-item" style="padding:0; background:#0072C6">
											<h5 class="ac-title" style="padding:12px; color:#fff">PHOTOS OF THE GUEST ACCOMODATION</h5>
											<div class="ac-content" style="margin:0; padding:0;">
												<div class="row" style="background:#fff; padding:20px;" data-lightbox="gallery">
													<?php 													
													for($i=1; $i<=count($foto_foresteria); $i++){?>
														<div class="col-lg-4 col-sm-6" style="padding-bottom:20px;">
															<div class="grid-item-wrap">
																<div class="grid-item" style="padding-bottom:0">
																	<a title="Guest Accomodation - <?php echo $i;?>" data-lightbox="gallery-image" href="https://www.yccs.it/<?php echo $foto_foresteria[$i]['img'] ;?>">
																		<div class="grid-image">
																			<img alt="Guest Accomodation - <?php echo $i;?>" src="https://www.yccs.it/<?php echo $foto_foresteria[$i]['ante'] ;?>" />
																		</div>
																		<div class="grid-description">
																			<span class="btn btn-light btn-rounded">Zoom</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													<?php }?>
												</div>
											</div>
										</div>
									</div>

									<p><br />
									<strong>Programme</strong><br />
									Arrival on Sunday

									Course start, Monday at 10 a.m.<br />
									End of course, Saturday at 1 p.m., departure on Saturday afternoon<br />
									On request and at a supplement of €140 per week, residential students can also attend afternoon classes at 10 a.m. to 1 p.m. and 3.30 p.m. to 5.30 p.m. (courses finish at 1 p.m. on Saturdays)<br />
									Sunday is dedicated to arrivals and settling into the accommodation.<br />
									<br />
									<strong>Cabin cruiser courses with accommodation 2024</strong><br />
									Six-day sailing course with six nights in guest accommodation.<br />
									May, June and September - first week €750, second week €690<br />
									July - first week €870, second week €800<br />
									August - first week €910, second week €840<br />
									Compulsory FIV card and registration €50<br />
									Extras: Supplement for full time course €140 per week.<br />
									Depending on the number of participants, afternoon sessions may be on dinghies or cabin cruisers, at the school's discretion.<br />
									Extras<br />
									Breakfast, lunch and dinner are available in affiliated restaurants near the guest accommodation.<br />
									<br />
									Rates per person, including linens and final cleaning.<br />
									<br />
									Upon enrolment, participants must present a medical certificate of good health and an ID document with their tax code.<br />
									<br />
									<strong>Included:</strong><br />
									&bull; Six-day sailing course, Monday to Saturday<br />
									&bull; Six nights in guest accommodation, Sunday to Friday.<br />
									&bull; Bed linen and towels (beds will not be made up).<br />
									&bull; Initial and final cleaning, during the week the rooms must be kept tidy by the students.<br />
									&bull; Sailing school T-shirt (gift).<br />
									&bull; Life jacket for use during the course.<br />
									&bull; Teaching materials.

									<p><br />
									<strong>Required:</strong><br />
									&bull; Medical certificate of good health (non-competitive)<br />
									&bull; Copy of ID and tax code<br />
									<br />
									<strong>Abbigliamento:</strong><br />
									&bull; Waterproof or lycra jacket, short or long trousers, boat shoes or trainers with white soles.<br />
									&bull; Sun cream, hat.<br />
									On request we can organise a transfer from Olbia to Porto Cervo.<br />
									<br />
									<strong>Programma:</strong><br />
									&bull; 9.30 a.m. breakfast<br />
									&bull; 10 a.m. theory lesson at the YCCS.<br />
									&bull; 10.40 a.m. rigging and lesson on the water.<br />
									&bull; 1 p.m. end of lesson.<br />
									&bull; Afternoon, on request:<br />
									&bull; 3.30 p.m. lesson on dinghies or cabin cruisers.<br />
									&bull; 5.30 p.m. end of lesson.<br />
									&bull; On Saturdays the course finishes at 1 p.m.									
								<?php }?>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</section>


	<div style="width:100%;margin-top:-30px;" data-lightbox-type="gallery">
		<div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="0" data-lightbox="gallery">
			<?php for($i=1; $i<=13; $i++){
				if($i!=9){?>
					<div class="portfolio-item shadow img-zoom">
						<div class="portfolio-item-wrap">
							<div class="portfolio-image">
								<a href="#">
									<img src="https://www.yccs.it/web/images/scuola/gallery/thumb/s-yccs-sailing-school_<?php echo $i;?>.jpg" alt="YCCS Sailing School - Foto <?php echo $i;?>">
								</a>
							</div>
							<div class="portfolio-description">
								<a title="YCCS Sailing School - Foto <?php echo $i;?>" data-lightbox="gallery-image" href="web/images/scuola/gallery/yccs-sailing-school_<?php echo $i;?>.jpg"><i class="icon-maximize"></i></a>
							</div>
						</div>
					</div>
				<?php }
			}?>
		</div>
	</div>
	<a name="contattaci"></a>
	<section>
		<div class="container" >
			<div class="row">
				<div class="col-md-12">
					<div style="width:100%; display:flex; gap:35px;">
						<h3 class="gradient-title"><?php if($lingua=="ita"){?>CONTATTI<?php }else{?>CONTACTS<?php }?></h3>
						<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="tabs tabs-folder">
						<div class="tab-content" id="myTabContent3">
							<div class="tab-pane fade show active" style="text-align:justify" id="Derive" role="tabpanel" aria-labelledby="home-tab">
								
								<p style="display:flex; flex-direction:column; gap:5px;">
									<span class="azzurro"><b>Via Della Marina, Edificio Yacht Club Costa Smeralda</b></span>
									<span>Sede Operativa c/o Centro Sportivo YCCS</span>
									<span>07021 - Porto Cervo (SS)</span>
									<span>E-mail: <a href="mailto:sailingschool@yccs.it">sailingschool@yccs.it</a></span>
									<span>Tel: <a href="tel:+390789902200">+39 0789 902200</a></span>
									<span>Cell: <a href="tel:+393470795547">+39 347 079 5547</a></span>
									<span>P.Iva: 00333630903</span>
								</p>
							</div>
						</div>							
					</div>					
				</div>
			</div>
		</div>
	</section>
@endsection