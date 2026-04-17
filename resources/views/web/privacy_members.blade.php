@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/loYCCSoggi.jpg";
		$page_title = "Privacy - YCCS Members";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']="Privacy - YCCS Members"; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<!-- Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container-fluid">
			<div class="row">
				<!-- post content -->
				<div class="content col-lg-2"></div>
				<div class="content col-lg-6">
					<?php if($lingua=="ita"){?>
						<h3 class="text-uppercase">PRIVACY - YCCS MEMBERS</h3>					
						<div style="margin-top:30px;">
							<b>Comunicazione al Socio,</b><br/><br/>
							Caro Socio, con la presente comunichiamo che Yacht Club Costa Smeralda Associazione Sportiva
							Dilettantistica <b>(YCCS)</b> in adeguamento al regolamento UE (GDPR 679/16) ha predisposto la corrente
							informativa, ai sensi dell’art. 13 del D. Lgs. 196/2003 (Codice Privacy) e dell’art. 13 del GDPR 2016/679,
							recante disposizioni a tutela delle persone fisiche rispetto al trattamento dei dati personali, per tale motivo
							desideriamo informarLa che i dati personali da Lei forniti in qualità di socio di YCCS formeranno oggetto di
							trattamento nel rispetto della normativa sopra richiamata e degli obblighi di riservatezza cui è tenuta la
							scrivente.<br/><br/>
							<b>Il Titolare del trattamento</b> è YCCS nella persona del Segretario Generale, domiciliato per la carica presso
							YCCS. Loc. Porto Cervo Marina - Edificio Yacht Club – 07021 - Porto Cervo<br/><br/>
							<b>Il Responsabile del trattamento</b> è Albatros S.r.l. nella persona del Legale Rappresentante pro tempore<br/><br/>
							<b>Finalità del trattamento</b><br/><br/>
							I dati personali da Lei forniti sono necessari per le attività legate alla sua iscrizione alla presente
							Associazione, e sono trattati, senza il suo consenso espresso (art. 6 lett. b, GDPR), per le seguenti Finalità:<br/>
							- l’iscrizione all’Associazione e il ricevimento delle informazioni e comunicazioni inerenti le attività alla
							stessa legate;<br/>
							- adempimento agli obblighi precontrattuali, contrattuali e fiscali derivanti da rapporti con Lei in essere;<br/>
							- adempimento agli obblighi previsti dalla legge, da un regolamento, dalla normativa comunitaria o da un
							ordine dell’Autorità;<br/><br/>
							<b>Modalità di trattamento e conservazione</b><br/><br/>
							Il trattamento sarà svolto in forma automatizzata e/o manuale, nel rispetto di quanto previsto dall’art. 32
							del GDPR 679/2016, ad opera di soggetti appositamente incaricati e in ottemperanza a quanto previsto
							dall’art. 29 GDPR 679 /2016.<br/>
							Le segnaliamo che, nel rispetto dei principi di liceità, limitazione delle finalità e minimizzazione dei dati, ai
							sensi dell’art. 5 GDPR 679/2016, i Suoi dati personali saranno conservati per il periodo di tempo necessario
							per il conseguimento delle finalità per le quali sono raccolti e trattati, e comunque per non oltre 10 anni
							dalla cessazione del rapporto per le Finalità di Servizio.<br/><br/>
							<b>Ambito di comunicazione e diffusione</b><br/><br/>
							Informiamo inoltre che i dati raccolti non saranno mai diffusi e non saranno oggetto di comunicazione,
							salvo le comunicazioni necessarie che possono comportare il trasferimento di dati alle aziende di servizi
							incaricate allo svolgimento delle attività fiscali e amministrative, a consulenti, studi professionali o ad altri
							soggetti incaricati dal Titolare per l’adempimento degli obblighi di legge; inoltre i Suoi dati potranno essere
							resi accessibili a dipendenti e collaboratori dell’Associazione o di società da questa controllate e a questa
							collegate.<br/><br/>
							<b>Trasferimento dei dati personali</b><br/><br/>
							I Suoi dati non saranno trasferiti né in Stati membri dell’Unione Europea né in Paesi terzi non appartenenti
							all’Unione Europea.<br/><br/>
							<b>Diritti dell’interessato</b><br/><br/>

							In ogni momento, Lei potrà esercitare, ai sensi dell’art. 7 del D. Lgs. 196/2003 e degli articoli dal 15 al 22 del
							Regolamento UE n. 2016/679, ed in particolare il diritto di:<br/>
							a) chiedere la conferma dell’esistenza o meno di propri dati personali;<br/>
							b) ottenere le indicazioni circa le finalità del trattamento, le categorie dei dati personali, i destinatari o le
							categorie di destinatari a cui i dati personali sono stati o saranno comunicati e, quando possibile, il periodo
							di conservazione;<br/>
							c) ottenere la rettifica e la cancellazione dei dati;<br/>
							d) proporre reclamo a un’autorità di controllo.<br/><br/>
							Può esercitare i Suoi diritti con richiesta scritta inviata a Yacht Club Costa Smeralda Associazione Sportiva
							Dilettantistica (YCCS) Loc. Porto Cervo Marina - Edificio Yacht Club – 07021 - Porto Cervo (OT), oppure una
							e-mail all’indirizzo: <a href="privacy@yccs.it">privacy@yccs.it</a> oppure una pec: <a href="yachtcostasmeralda@pec.it">yachtcostasmeralda@pec.it</a><br/><br/>
							Porto Cervo, 25 Maggio 2018
						</div>
					<?php }else{?>
						<h3 class="text-uppercase">Communication to Members</h3>					
						<div style="margin-top:30px;">
							Dear Member,
							We hereby inform you that the Yacht Club Costa Smeralda <b>(YCCS)</b> amateur sporting association, in
							compliance with EU Regulations (GDPR 679/16) has prepared the current statement, pursuant to art. 13 of
							Legislative Decree 196/2003 (Privacy) and art. 13 of GDPR 2016/679, setting out provisions for the
							protection of individuals regarding the processing of personal data. We therefore wish to inform you that
							the personal information you provide as a member of the YCCS will be processed in accordance with the
							aforementioned law and the obligations of confidentiality to which we are subject.<br/><br/>
							
							<b>The data controller</b> is YCCS in the person of the Secretary General, domiciled for the purposes of said role
							at YCCS. Loc. Porto Cervo Marina - Yacht Club Building - 07021 - Porto Cervo – Italy.<br/><br/>
							
							<b>The data processor</b> is Albatros Srl in the person of its legal representative pro tempore.<br/><br/>
							
							<b>Purposes of the processing</b><br/><br/>
							
							The personal data supplied by you are required for activities relating to your membership of this
							association, and are processed, without your express consent (article. 6 let. b, GDPR), for the following
							purposes:<br/>
							- membership of the association and receipt of information and communications relating to the activities of
							the same;<br/>
							- fulfilment of pre-contractual, contractual and fiscal obligations arising out of the association&#39;s relationship
							with you;<br/>
							- fulfilment of obligations required by law, regulations, EU legislation or by an order of the relevant
							authorities;<br/><br/>
							
							<b>Processing and archiving methods</b><br/><br/>
							
							Processing will be carried out automatically and/or manually, in accordance with art. 32 of GDPR 679/2016,
							by persons authorised to do so and in compliance with art. 29 of GDPR 679/2016.<br/>
							Please note that, in accordance with the principles of lawfulness, purpose limitation and data minimisation,
							pursuant to art. 5 of GDPR 679/2016, your personal data will be stored for the period of time necessary for
							the purposes for which they are collected and processed, and in any case for no longer than 10 years from
							the termination of the relationship for the purposes of the service.<br/><br/>
							
							<b>Scope of communication and dissemination</b><br/><br/>
							
							Please also note that the data collected will never be disclosed and will not be communicated, except for
							necessary communications which may involve the transfer of data to service companies responsible for
							fiscal and administrative activities, or to consultants, professional firms or other persons appointed by the
							controller in order to fulfil its legal obligations; in addition, your data may be made available to employees
							and collaborators of the association or of its subsidiaries and affiliates.<br/><br/>
							
							<b>Transfer of personal data</b><br/><br/>
							
							Your data will not be transferred to EU Member States or third countries outside of the European Union.<br/><br/>
							
							<b>Data subject&#39;s rights</b><br/><br/>
							
							At any time, you may exercise your rights pursuant to art. 7 of Legislative Decree 196/2003 and articles 15
							to 22 of EU Regulation no. 2016/679, and in particular the right to:<br/>

							a) request confirmation of the existence or otherwise of your personal data;<br/>
							b) receive information regarding the purposes of the processing, the categories of personal data, the
							recipients or categories of recipients to whom the personal data have been or will be disclosed and,
							whenever possible, the retention period;<br/>
							c) obtain rectification and erasure of data;<br/>
							d) lodge a complaint with a supervising authority.<br/><br/>
							
							You may exercise your rights by means of a written request sent to the Yacht Club Costa Smeralda (YCCS)
							amateur sporting association loc. Porto Cervo Marina - 07021 Porto Cervo - Yacht Club Building - (OT), or by
							e-mail to: <a href="privacy@yccs.it">privacy@yccs.it</a> or by certified email to: <a href="yachtcostasmeralda@pec.it">yachtcostasmeralda@pec.it</a>.<br/><br/>
							Porto Cervo, 25 May 2018
						</div>
					<?php }?>
				</div>
				<!-- end: post content -->
				<!-- Sidebar-->
				<div class="sidebar sticky-sidebar sidebar-modern col-lg-4" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
					<div class="row">
						<div class="content col-lg-7">
							@include('web.common.laterale')
						</div>
						<div class="content col-lg-5"></div>
					</div>
				</div>
				<!-- end: Sidebar-->
			</div>
		</div>
	</section> <!-- end: Content -->
	
@endsection