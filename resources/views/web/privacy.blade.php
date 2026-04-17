@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/loYCCSoggi.jpg";
		$page_title = "Privacy";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']="Privacy"; $breadcrumbs[$x]['link']=''; 
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
						<h3 class="text-uppercase">PRIVACY - Informativa ai sensi del GDPR 679/16</h3>					
						<div style="margin-top:30px;">
							<p>Gentile Utente,</p>
							<p>L&#39;accesso al sito non richiede la digitazione delle proprie generalità, ma per la fruizione di alcuni servizi
							presenti nel sito dovrà inserire i Suoi dati personali nelle apposite sezioni.<br/> I dati inseriti, per i fini di cui
							sopra, verranno trattati con misure di sicurezza adeguate agli attuali standard tecnologici e rispettando le
							prescrizioni del <b>GDPR 679/16.</b> Secondo la normativa indicata, tale trattamento sarà improntato ai principi di
							correttezza, liceità e trasparenza e di tutela della Sua riservatezza e dei Suoi diritti. <br/>La seguente informativa
							è relativa al sito <a href="www.yccs.it">www.yccs.it</a>, ai sottodomini e ai siti ad esso collegati e ad esso riconducibili, e non riguarda
							altri siti web eventualmente consultati dall&#39;utente connesso tramite link posti nelle pagine del nostro sito
							non riconducibili allo Yacht Club Costa Smeralda o alle aziende ad esso collegate. <br/>Nessun dato derivante
							dalla consultazione del servizio web viene comunicato o diffuso.<br/><br/>
							In merito al trattamento dei dati richiesti per l’accesso, tramite autenticazione, Le forniamo le seguenti
							informazioni:<br/><br/>
							<b>1.</b> &#39;Yacht Club Costa Smeralda&#39; raccoglie e tratta i Suoi dati personali per le finalità connesse alla
							realizzazione e gestione delle attività associative proprie della sua natura. I suoi dati potranno
							essere trattati per le finalità interne di compilazione di liste anagrafiche, tenuta della contabilità, la
							fatturazione, la gestione del credito, per la soddisfazione di tutti gli obblighi previsti dalle normative
							vigenti, scopi statistici, per comunicazioni, e servizi da Lei esplicitamente richiesti. Riceverà le
							informazioni e comunicazioni inerenti le attività svolte dall’Associazione e gli inviti ad eventi dalla
							stessa organizzati o partecipati.<br/><br/>
							<b>2.</b> Il trattamento sarà effettuato sia manualmente che utilizzando strumenti elettronici,
							nell&#39;osservanza di tutte le cautele necessarie a garantire la sicurezza e la riservatezza delle
							informazioni.<br/><br/>
							<b>3.</b> I dati all&#39;interno della nostra Società potranno essere trattati da tutte le figure autorizzate al
							trattamento dal Titolare e formati sugli obblighi della Legge in materia di Privacy.<br/><br/>
							<b>4.</b> I dati potranno essere comunicati a terze parti, esclusivamente per esigenze tecniche ed operative
							strettamente collegate alle finalità sopraelencate ed in particolare alle seguenti categorie di
							soggetti:<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>a.</b> Enti, professionisti, società o altre strutture da noi incaricate dei trattamenti connessi
							all&#39;adempimento degli obblighi amministrativi, contabili, commerciali e gestionali legati
							all&#39;ordinario svolgimento della nostra attività economica, anche per finalità di recupero
							credito;<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>b.</b> Alle pubbliche autorità ed amministrazioni per le finalità connesse all&#39;adempimento di
							obblighi legali;<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>c.</b> Banche, istituti finanziari o altri soggetti ai quali il trasferimento dei dati risulti necessario
							allo svolgimento delle attività della nostra Società in relazione all&#39;assolvimento, da parte
							nostra, delle obbligazioni contrattuali assunte nei Vs. confronti.<br/><br/>

							<b>5.</b> Il Suo rifiuto al trattamento dei dati di cui al punto 1 della presente informativa comporterà
							l&#39;impossibilità, da parte nostra, di erogare i servizi richiesti ed di adempiere agli obblighi di legge.<br/><br/>
							<b>6.</b> Il titolare del trattamento è Yacht Club Costa Smeralda, nella persona del Segretario Generale pro
							tempore, E-mail: <a href="mailto:privacy@yccs.it">privacy@yccs.it</a>.<br/><br/>
							<b>7.</b> Trasferimento dei dati personali: i suoi dati non saranno trasferiti né in Stati membri dell’Unione
							Europea né in Paesi terzi non appartenenti all’Unione Europea.<br/><br/>
							<b>8.</b> Diritti dell’interessato: In ogni momento, Lei potrà esercitare, ai sensi dell’art. 7 del D.Lgs. 196/2003
							e degli articoli dal 15 al 22 del Regolamento UE n. 2016/679, ed in particolare il diritto di:<br/>

							&nbsp;&nbsp;&nbsp;&nbsp;<b>a.</b> chiedere la conferma dell’esistenza o meno di propri dati personali;<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>b.</b> ottenere le indicazioni circa le finalità del trattamento, le categorie dei dati personali, i
							destinatari o le categorie di destinatari a cui i dati personali sono stati o saranno comunicati
							e, quando possibile, il periodo di conservazione;<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>c.</b> ottenere la rettifica e la cancellazione dei dati;<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>d.</b> proporre reclamo a un’autorità di controllo.<br/><br/>

							Può esercitare i Suoi diritti con richiesta scritta inviata a Yacht Club Costa Smeralda - Associazione Sportiva
							Dilettantistica (YCCS) Loc. Porto Cervo Marina-Edificio Yacht Club – 07021 - Porto Cervo (OT), oppure una e-
							mail all’indirizzo:  <a href="mailto:privacy@yccs.it">privacy@yccs.it</a>; oppure una PEC: <a href="mailto:yachtcostasmeralda@pec.it">yachtcostasmeralda@pec.it</a>
							</p>
							<p>Porto Cervo, 25 maggio 2018</p>
							<br /><br /><br /><br />
						</div>
					<?php }else{?>
						<h3 class="text-uppercase">PRIVACY POLICY in accordance with GDPR 679/16</h3>					
						<div style="margin-top:30px;">
							<p>
								Dear User,</p>
							<p>
								Access to the site does not require you to type your name, but for the use of certain services on the website you must enter your personal details in the appropriate sections. The data provided for the purposes set out above will be processed using appropriate security measures in line with current technological standards and respecting the requirements of GDPR 679/16. According to the abovementioned regulations, this treatment will be based on principles of correctness, lawfulness and transparency and protection of your privacy and rights. The following statement relates to the website <a href="http://www.yccs.it/">www.yccs.it,</a> sub-domains and sites connected to it or attributable to it and does not apply to other websites that may be consulted by users connected via links published on pages of our site not attributable to the Yacht Club Costa Smeralda or companies linked to it. No data derived from consulting the web service is communicated or disseminated.</p>
							<p>
								With regard to the processing of data required for access through authentication, the following information is provided:</p>
							<ol style=" margin-left:30px;">
								<li>
									&#39;Yacht Club Costa Smeralda&#39; collects and processes your personal data for purposes related to carrying out and managing the activities of an association of its nature. Your data may be used for the internal purposes of compiling registry lists, bookkeeping, invoicing, credit management, to satisfy all obligations provided for by law, for statistical purposes, for communications, and for services explicitly requested by you. You will receive information and communications regarding the activities of the association and invitations to events organised or taken part in by the same.</li>
								<li>
									Processing shall be carried out either manually or by electronic means, in accordance with all necessary precautions to ensure security and confidentiality of the information.</li>
								<li>
									The data may be handled within our company by all those authorised to process it by the Controller and trained in legal obligations regarding privacy.</li>
								<li>
									The data may be disclosed to third parties, exclusively for technical and operational requirements closely related to the purposes listed above and in particular to the following categories:
									<ol style="list-style-type:lower-alpha; margin-left:30px;">
										<li>
											Organisations, professionals, companies or other structures charged by us with processing related to the fulfilment of administrative, accounting, commercial and management obligations relating to our ordinary business activities, as well as for credit recovery purposes;</li>
										<li>
											Public authorities and administrations for purposes related to the fulfilment of legal obligations;</li>
										<li>
											Banks, financial institutions or other parties to whom the transfer of data is necessary to carry out our company&#39;s activities in relation to the fulfilment of our contractual obligations towards you.</li>
									</ol>
								</li>
								<li>
									Your refusal to allow processing of the data referred to in clause 1 of this policy will render it impossible for us to provide the services requested and to fulfil our legal obligations.</li>
								<li>
									The data controller is the Yacht Club Costa Smeralda, in the person of the Secretary General pro-tempore, e-mail: <a href="mailto:privacy@yccs.it">privacy@yccs.it.</a></li>
								<li>
									Transfer of personal data: your data will not be transferred to EU Member States or third countries outside of the European Union.</li>
								<li>
									Data subject&#39;s rights: you may exercise you rights at any time, pursuant to art. 7 of Law Decree 196/2003 and articles from 15 to 22 of the EU Regulation no. 2016/679, in particular the right to:
									<ol style="list-style-type:lower-alpha;">
								<li>
									request confirmation of the existence or otherwise of your personal data;</li>
								<li>
									obtain information about the purposes of the processing, the categories of personal data, the recipients or categories of recipients to whom the personal data have been or will be disclosed and, whenever possible, the retention period;</li>
								<li>
									rectification and erasure of data;</li>
								<li>
									object to a supervising authority.</li>
							</ol>
								</li>
							</ol>
							
							<p>
								You may exercise your rights via written request to the Yacht Club Costa Smeralda (YCCS) Amateur Sporting Association, Loc. Porto Cervo - Yacht Club Building - Porto Cervo 07021 &ndash; (OT, Italy), or by e-mail to: <a href="mailto:privacy@yccs.it">privacy@yccs.it</a>; or certified email: <a href="mailto:yachtcostasmeralda@pec.it">yachtcostasmeralda@pec.it</a></p>
							<p>
								Porto Cervo, 25 May 2018</p>

							
							<br /><br /><br /><br />
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