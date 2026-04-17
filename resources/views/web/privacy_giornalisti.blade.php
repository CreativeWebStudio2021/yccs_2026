@extends('web.index')

@section('content')
	@php
		$img_background = "web/images/testate/loYCCSoggi.jpg";
		if($lingua=="ita")  $page_title = "Privacy - YCCS Giornalisti";
		else $page_title = "Privacy - YCCS Journalists";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
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
						<h3 class="text-uppercase">PRIVACY - YCCS GIORNALISTI</h3>					
						<div style="margin-top:30px;">
							La Newsletter di YCCS è pubblicata sul sito Internet istituzionale e distribuita via e-mail a coloro che hanno
							fatto richiesta di riceverla. I dati forniti saranno utilizzati con strumenti informatici e telematici al solo fine
							di fornire il servizio richiesto e, per tale ragione, saranno conservati esclusivamente per il periodo in cui lo
							stesso sarà attivo. La finalità di tale trattamento è da rinvenirsi nella richiesta da parte degli interessati di
							ricevere informazioni sulle iniziative e manifestazioni sportive e associative svolte e organizzate dallo
							scrivente e dai partner coinvolti nelle attività.<br/>
							Il titolare del trattamento è YCCS via della Marina Porto Cervo.
							I dati saranno trattati esclusivamente dal personale e dai collaboratori del Titolare del Trattamento o delle
							imprese espressamente nominate come responsabili del trattamento (ad es. per esigenze di manutenzione
							tecnologica del sito).
							Gli interessati hanno il diritto di ottenere, nei casi previsti, l&#39;accesso ai dati personali e la rettifica o la
							cancellazione degli stessi o la limitazione del trattamento che li riguarda o di opporsi al trattamento (artt.
							15 e ss. del Regolamento). L&#39;apposita istanza è presentata contattando il Titolare del trattamento
							all’indirizzo mail: <a href="mailto:privacy@yccs.it">privacy@yccs.it</a><br/>
							Gli interessati che ritengono che il trattamento dei dati personali a loro riferiti effettuato attraverso questo
							servizio avvenga in violazione di quanto previsto dal Regolamento hanno il diritto di proporre reclamo,
							come previsto dall&#39;art. 77 del Regolamento stesso, o di adire le opportune sedi giudiziarie (art. 79 del
							Regolamento).
							Se ricevi questa mail è perché hai fornito l’autorizzazione al trattamento dei tuoi dati di registrazione per le
							finalità sopra indicate.<br/><br/>
							<b>CANCELLAZIONE DEL SERVIZIO</b><br/>
							Per non ricevere più la newsletter, cliccare sul link SafeUnsubscribe presente in fondo a tutte le email,
							oppure puoi inviare un’email a: <a href="mailto:pressoffice@yccs.it">pressoffice@yccs.it</a>. In caso di problemi tecnici, è possibile inviare una
							segnalazione e-mail a: <a href="mailto:privacy@yccs.it">privacy@yccs.it</a>
						</div>
					<?php }else{?>
						<h3 class="text-uppercase">PRIVACY - YCCS JOURNALISTS</h3>					
						<div style="margin-top:30px;">
							The YCCS Newsletter is published on the association&#39;s website and distributed by e-mail to those who have
							requested to receive it. The data provided will be used with computer and telematic tools for the sole
							purpose of providing the requested service and, therefore, will be kept only for the period during which it is
							active. The purpose of said processing is due to those concerned requesting to receive information on the
							initiatives and sports events and members&#39; activities held and organised by the author and by partners
							involved in the activities.<br/>
							The data controller is YCCS, Via della Marina, Porto Cervo.
							The data will be processed exclusively by staff and collaborators of the data controller or by companies
							expressly appointed as data processors (e.g. for technical maintenance requirements of the site).
							Interested parties have the right to obtain, in the cases provided for, access to personal data and
							rectification or cancellation of said data or limitation of the processing concerning them or to oppose the
							processing (arts. 15 and ss. of the regulation). The appropriate request can be made by contacting the data
							controller by e-mail at: <a href="mailto:privacy@yccs.it">privacy@yccs.it</a> .<br/>
							Interested parties who believe that the processing of personal data related to them through this service is
							in violation of the provisions set out in the regulation have the right to object, as provided for by art. 77 of
							the regulation itself, or to refer the matter to the appropriate courts (art. 79 of the regulation).
							You are receiving this message because you gave permission for the processing of your registration data for
							the abovementioned purposes.<br/><br/>
							<b>UNSUBSCRIBE</b><br/>
							To stop receiving the newsletter, click the SafeUnsubscribe link at the bottom of all emails, or send an
							email to: <a href="mailto:pressoffice@yccs.it">pressoffice@yccs.it</a> . In the event of technical problems,
							send an e-mail alert to: <a href="mailto:privacy@yccs.it">privacy@yccs.it</a>
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