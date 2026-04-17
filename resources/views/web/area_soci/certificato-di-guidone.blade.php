@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.certificato di guidone');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.certificato di guidone'); $breadcrumbs[$x]['link']=''; 
			
		@endphp
		@include('web.common.page_title')
		
		
		@php
			if(isset($_POST['nome'])) {
				$nome = $_POST['nome'];
			} else{
				$nome = "";
			}
			
			$preferenza = "";
			if(isset($_POST['p_posta'])) {
				$p_posta = $_POST['p_posta'];
			} else{
				$p_posta = "off";
			}
			if ($p_posta=="on") $preferenza .= "Posta"; 
			
			if(isset($_POST['p_email'])) {
				$p_email = $_POST['p_email'];
			} else{
				$p_email = "off";
			}
			if ($p_email=="on" && $preferenza!="") $preferenza .= " - Email"; 
				elseif ($p_email=="on") $preferenza .= "Email"; 
			
			if(isset($_POST['p_fax'])) {
				$p_fax = $_POST['p_fax'];
			} else{
				$p_fax = "off";
			}
			if ($p_fax=="on" && $preferenza!="") $preferenza .= " - Fax"; 
				elseif ($p_fax=="on") $preferenza .= "Fax";
				
			if(isset($_POST['p_tel'])) {
				$p_tel = $_POST['p_tel'];
			} else{
				$p_tel = "off";
			}
			if ($p_tel=="on" && $preferenza!="") $preferenza .= " - Telefono"; 
				elseif ($p_tel=="on") $preferenza .= "Telefono";
			
			if(isset($_POST['imbarcazione'])) {
				$imbarcazione = $_POST['imbarcazione'];
			} else{
				$imbarcazione = "";
			}
			
			if(isset($_POST['bandiera'])) {
				$bandiera = $_POST['bandiera'];
			} else{
				$bandiera = "";
			}
			
			$tipo = "";
			if(isset($_POST['t_vela'])) {
				$t_vela = $_POST['t_vela'];
			} else{
				$t_vela = "off";
			}
			if ($t_vela=="on") $tipo = "Vela";

			if(isset($_POST['t_motore'])) {
				$t_motore = $_POST['t_motore'];
			} else{
				$t_motore = "off";
			}
			if ($t_motore=="on") $tipo = "a Motore";
			
			if(isset($_POST['colore'])) {
				$colore = $_POST['colore'];
			} else{
				$colore = "";
			}
			
			if(isset($_POST['cantiere'])) {
				$cantiere = $_POST['cantiere'];
			} else{
				$cantiere = "";
			}
			
			if(isset($_POST['email'])) {
				$email = $_POST['email'];
			} else{
				$email = "";
			}
			
			if(isset($_POST['progettista'])) {
				$progettista = $_POST['progettista'];
			} else{
				$progettista = "";
			}
			
			if(isset($_POST['modello'])) {
				$modello = $_POST['modello'];
			} else{
				$modello = "";
			}
					
			if(isset($_POST['anno'])) {
				$anno = $_POST['anno'];
			} else{
				$anno = "";
			}
					
			if(isset($_POST['materiale'])) {
				$materiale = $_POST['materiale'];
			} else{
				$materiale = "";
			}
			
			if(isset($_POST['lunghezza'])) {
				$lunghezza = $_POST['lunghezza'];
			} else{
				$lunghezza = "";
			}
			
			if(isset($_POST['larghezza'])) {
				$larghezza = $_POST['larghezza'];
			} else{
				$larghezza = "";
			}
			
			if(isset($_POST['pescaggio'])) {
				$pescaggio = $_POST['pescaggio'];
			} else{
				$pescaggio = "";
			}
			
			if(isset($_POST['motore'])) {
				$motore = $_POST['motore'];
			} else{
				$motore = "";
			}
			
			if(isset($_POST['potenza'])) {
				$potenza = $_POST['potenza'];
			} else{
				$potenza = "";
			}
			
			if(isset($_POST['num_velico'])) {
				$num_velico = $_POST['num_velico'];
			} else{
				$num_velico = "";
			}
			
			$porto_cervo = "No";
			if(isset($_POST['posto_cervo_on'])) {
				$posto_cervo_on = $_POST['posto_cervo_on'];
			} else{
				$posto_cervo_on = "off";
			}
			if ($posto_cervo_on=="on") $porto_cervo = "Sì";
				
			if(isset($_POST['num_posto_cervo'])) {
				$num_posto_cervo = $_POST['num_posto_cervo'];
			} else{
				$num_posto_cervo = "";
			}

			$virgin_gorda = "No";
			if(isset($_POST['posto_gorda_on'])) {
				$posto_gorda_on = $_POST['posto_gorda_on'];
			} else{
				$posto_gorda_on = "off";
			}
			if ($posto_gorda_on=="on") $virgin_gorda = "Sì";

			if(isset($_POST['num_posto_gorda'])) {
				$num_posto_gorda = $_POST['num_posto_gorda'];
			} else{
				$num_posto_gorda = "";
			}
			
			$altra_marina = "";
			if(isset($_POST['posto_altro_on'])) {
				$posto_altro_on = $_POST['posto_altro_on'];
			} else{
				$posto_altro_on = "off";
			}
			if(isset($_POST['posto_altro_off'])) {
				$posto_altro_off = $_POST['posto_altro_off'];
			} else{
				$posto_altro_off = "off";
			}
			if ($posto_altro_on=="on") $altra_marina = "Sì";
				elseif ($posto_altro_off=="on") $altra_marina = "No";
			
			if(isset($_POST['citta'])) {
				$citta = $_POST['citta'];
			} else{
				$citta = "";
			}
			
			if(isset($_POST['manutenzione'])) {
				$manutenzione = $_POST['manutenzione'];
			} else{
				$manutenzione = "";
			}
			
			if(isset($_POST['permanenza'])) {
				$permanenza = $_POST['permanenza'];
			} else{
				$permanenza = "";
			}
			
			if(isset($_POST['comandante'])) {
				$comandante = $_POST['comandante'];
			} else{
				$comandante = "";
			}
			
			if(isset($_POST['contatti'])) {
				$contatti = $_POST['contatti'];
			} else{
				$contatti = "";
			}
			
			if(isset($_POST['note'])) {
				$note = $_POST['note'];
			} else{
				$note = "";
			}
			
			if(isset($_POST['posto_cervo_off'])) {
				$posto_cervo_off  = $_POST['posto_cervo_off'];
			} else{
				$posto_cervo_off  = "";
			}
			
			if(isset($_POST['num_cervo'])) {
				$num_cervo  = $_POST['num_cervo'];
			} else{
				$num_cervo  = "";
			}
			
			if(isset($_POST['posto_gorda_off'])) {
				$posto_gorda_off  = $_POST['posto_gorda_off'];
			} else{
				$posto_gorda_off  = "";
			}
			
			if(isset($_POST['num_gorda'])) {
				$num_gorda  = $_POST['num_gorda'];
			} else{
				$num_gorda  = "";
			}
			
			if(isset($_POST['privacy'])) $privacy=$_POST['privacy']; else $privacy="0";
		@endphp
		<style>
			.form-group label:not(.error) {font-weight: 600; color:#111111}
			.form-gray-fields .form-control {
				background-color: #f2f2f2;
				border-color: #e9e9e9;
				color: #333;
			}
		</style>
		
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-7">
						@if( count($errors) > 0)
							@foreach($errors->all() as $error)
								<div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="background:{{ $message_color }}">
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
						
						<div style="width:100%; display:flex; gap:35px;">
							<h3 class="gradient-title" style="line-height:1"><?php if($lingua=="ita"){?>Modulo per l'emissione<br/>del Certificato di Guidone<?php }else{?>Burgee Certificate<br/>application form<?php }?></h3>
							<div class="link-arrow" style="flex:1; margin-top:100px; border-bottom:solid 2px;"></div>
						</div>
						<div class="m-t-30">
							<form action="{{url()->full()}}" class="form-gray-fields" method="post" name="certForm" id="certForm" autocomplete="off">
								@csrf
								<input type="hidden" name="stato_cert" value="1"/>
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="nome"><?php if($lingua=="ita"){?>Nome e Cognome del Socio<?php }else{?>Member’s first name and surname<?php }?> *</label>
										<input type="text" class="form-control" id="nome" name="nome" value="<?php  echo $nome; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-12">
										<label for="preferenza"><?php if($lingua=="ita"){?>Preferenza per essere contattato<?php }else{?>To be contacted by<?php }?></label>
										<div class="row">	
											<div class="col-sm-3"><input type="checkbox" name="p_posta" id="p_posta" <?php  if ($p_posta=="on") echo "checked=\"checked\""; ?>> &nbsp; <?php if($lingua=="ita"){?>Posta<?php }else{?>Post<?php }?></div>
											<div class="col-sm-3"><input type="checkbox" name="p_email" id="p_email" <?php  if ($p_email=="on") echo "checked=\"checked\""; ?>> &nbsp; Email</div>
											<div class="col-sm-3"><input type="checkbox" name="p_fax" id="p_fax" <?php  if ($p_fax=="on") echo "checked=\"checked\""; ?>> &nbsp; Fax</div>
											<div class="col-sm-3"><input type="checkbox" name="p_tel" id="p_tel" <?php  if ($p_tel=="on") echo "checked=\"checked\""; ?>> &nbsp; <?php if($lingua=="ita"){?>Telefono<?php }else{?>Phone<?php }?></div>
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label for="imbarcazione"><?php if($lingua=="ita"){?>Nome imbarcazione<?php }else{?>Yacht Name<?php }?> *</label>
										<input type="text" class="form-control" id="imbarcazione" name="imbarcazione" value="<?php  echo $imbarcazione; ?>">
									</div>
									
									<div class="form-group col-sm-6">
										<label for="bandiera"><?php if($lingua=="ita"){?>Bandiera<?php }else{?>Flag<?php }?> *</label>
										<input type="text" class="form-control" id="bandiera" name="bandiera" value="<?php  echo $bandiera; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="tipo"><?php if($lingua=="ita"){?>Tipo Imbarcazione<?php }else{?>Type of boat<?php }?> *</label>
										<div class="row">	
											<div class="col-sm-6"><input type="radio" name="t_vela" id="t_vela" <?php  if ($t_vela=="on") echo "checked=\"checked\""; ?>> &nbsp; <?php if($lingua=="ita"){?>Vela<?php }else{?>Sail<?php }?></div>
											<div class="col-sm-6"><input type="radio" name="t_motore" id="t_motore" <?php  if ($t_motore=="on") echo "checked=\"checked\""; ?>> &nbsp; <?php if($lingua=="ita"){?>a Motore<?php }else{?>Motor-powered<?php }?></div>
										</div>
									</div>
									
									<div class="form-group col-sm-6">
										<label for="colore"><?php if($lingua=="ita"){?>Colore<?php }else{?>Hull colour<?php }?></label>
										<input type="text" class="form-control" id="colore" name="colore" value="<?php  echo $colore; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="cantiere"><?php if($lingua=="ita"){?>Cantiere<?php }else{?>Name of yard<?php }?> *</label>
										<input type="text" class="form-control" id="cantiere" name="cantiere" value="<?php  echo $cantiere; ?>">
									</div>
									
									<div class="form-group col-sm-6">
										<label for="progettista"><?php if($lingua=="ita"){?>Progettista<?php }else{?>Designer<?php }?> *</label>
										<input type="text" class="form-control" id="progettista" name="progettista" value="<?php  echo $progettista; ?>">
									</div>
								</div>	
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="modello"><?php if($lingua=="ita"){?>Modello<?php }else{?>Model<?php }?></label>
										<input type="text" class="form-control" id="modello" name="modello" value="<?php  echo $modello; ?>">
									</div>
									
									<div class="form-group col-sm-6">
										<label for="anno"><?php if($lingua=="ita"){?>Anno<?php }else{?>Year<?php }?> *</label>
										<input type="text" class="form-control" id="anno" name="anno" value="<?php  echo $anno; ?>">
									</div>
								</div>	
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="materiale"><?php if($lingua=="ita"){?>Materiale di costruzione<?php }else{?>Construction material<?php }?></label>
										<input type="text" class="form-control" id="materiale" name="materiale" value="<?php  echo $materiale; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="lunghezza"><?php if($lingua=="ita"){?>Lunghezza<?php }else{?>Length<?php }?> *</label>
										<input type="text" class="form-control" id="lunghezza" name="lunghezza" value="<?php  echo $lunghezza; ?>">
									</div>
									
									<div class="form-group col-sm-6">
										<label for="larghezza"><?php if($lingua=="ita"){?>Larghezza<?php }else{?>Beam<?php }?> *</label>
										<input type="text" class="form-control" id="larghezza" name="larghezza" value="<?php  echo $larghezza; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="pescaggio"><?php if($lingua=="ita"){?>Pescaggio<?php }else{?>Draught<?php }?> *</label>
										<input type="text" class="form-control" id="pescaggio" name="pescaggio" value="<?php  echo $pescaggio; ?>">
									</div>
									
									<div class="form-group col-sm-6">
										<label for="motore"><?php if($lingua=="ita"){?>Motore<?php }else{?>Engine<?php }?></label>
										<input type="text" class="form-control" id="motore" name="motore" value="<?php  echo $motore; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="potenza"><?php if($lingua=="ita"){?>Potenza cavalli<?php }else{?>HP<?php }?></label>
										<input type="text" class="form-control" id="potenza" name="potenza" value="<?php  echo $potenza; ?>">
									</div>
									
									<div class="form-group col-sm-6">
										<label for="num_velico"><?php if($lingua=="ita"){?>Nr. Velico<?php }else{?>Sail no.<?php }?></label>
										<input type="text" class="form-control" id="num_velico" name="num_velico" value="<?php  echo $num_velico; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="porto_cervo"><?php if($lingua=="ita"){?>Posto barca a Porto Cervo<?php }else{?>Berth in Porto Cervo<?php }?> *</label>
										<div class="row">	
											<div class="col-sm-3"><input type="radio" name="posto_cervo_on" id="posto_cervo_on" <?php  if ($posto_cervo_on=="on") echo "checked=\"checked\""; ?>> &nbsp; <?php if($lingua=="ita"){?>S&igrave;<?php }else{?>Yes<?php }?></div>
											<div class="col-sm-3"><input type="radio" name="posto_cervo_off" id="posto_cervo_off" <?php  if ($posto_cervo_off=="on") echo "checked=\"checked\""; ?>> &nbsp; No</div>
										</div>
									</div>
									
									<div class="form-group col-sm-6">
										<label for="num_cervo"><?php if($lingua=="ita"){?>Nr.<?php }else{?>No.<?php }?></label>
										<input type="text" class="form-control" id="num_cervo" name="num_cervo" value="<?php  echo $num_cervo; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="virgin_gorda"><?php if($lingua=="ita"){?>Posto barca a Virgin Gorda<?php }else{?>Berth in Virgin Gorda<?php }?> *</label>
										<div class="row">	
											<div class="col-sm-3"><input type="radio" name="posto_gorda_on" id="posto_gorda_on" <?php  if ($posto_gorda_on=="on") echo "checked=\"checked\""; ?>> &nbsp; <?php if($lingua=="ita"){?>S&igrave;<?php }else{?>Yes<?php }?></div>
											<div class="col-sm-3"><input type="radio" name="posto_gorda_off" id="posto_gorda_off" <?php  if ($posto_gorda_off=="on") echo "checked=\"checked\""; ?>> &nbsp; No</div>
										</div>
									</div>
									
									<div class="form-group col-sm-6">
										<label for="num_gorda"><?php if($lingua=="ita"){?>Nr. VG<?php }else{?>No.<?php }?></label>
										<input type="text" class="form-control" id="num_gorda" name="num_gorda" value="<?php  echo $num_gorda; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="altra_marina"><?php if($lingua=="ita"){?>Posto barca altra Marina<?php }else{?>Berth elsewhere<?php }?></label>
										<div class="row">	
											<div class="col-sm-3"><input type="radio" name="posto_altro_on" id="posto_altro_on" <?php  if ($posto_altro_on=="on") echo "checked=\"checked\""; ?>> &nbsp; <?php if($lingua=="ita"){?>S&igrave;<?php }else{?>Yes<?php }?></div>
											<div class="col-sm-3"><input type="radio" name="posto_altro_off" id="posto_altro_off" <?php  if ($posto_altro_off=="on") echo "checked=\"checked\""; ?>> &nbsp; No</div>
										</div>
									</div>
									
									<div class="form-group col-sm-6">
										<label for="citta"><?php if($lingua=="ita"){?>Citt&agrave;/Paese<?php }else{?>City/Country<?php }?></label>
										<input type="text" class="form-control" id="citta" name="citta" value="<?php  echo $citta; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="manutenzione"><?php if($lingua=="ita"){?>Nome cantiere di manutenzione di fiducia<?php }else{?>Maintenance and dry dock yard<?php }?></label>
										<input type="text" class="form-control" id="manutenzione" name="manutenzione" value="<?php  echo $manutenzione; ?>">
									</div>
									
									<div class="form-group col-sm-6">
										<label for="permanenza"><?php if($lingua=="ita"){?>Porto di abituale permanenza<?php }else{?>Home port<?php }?></label>
										<input type="text" class="form-control" id="permanenza" name="permanenza" value="<?php  echo $permanenza; ?>">
									</div>
								</div>
								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="comandante"><?php if($lingua=="ita"){?>Nome Comandante<?php }else{?>Yacht captain<?php }?></label>
										<input type="text" class="form-control" id="comandante" name="comandante" value="<?php  echo $comandante; ?>">
									</div>
									
									<div class="form-group col-sm-6">
										<label for="contatti"><?php if($lingua=="ita"){?>Contatti<?php }else{?>Contact details<?php }?> *</label>
										<input type="text" class="form-control" id="contatti" name="contatti" value="<?php  echo $contatti; ?>">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="email"><?php if($lingua=="ita"){?>E-mail<?php }else{?>E-mail<?php }?> *</label>
										<input type="email" class="form-control" id="email" name="email" value="<?php  echo $email; ?>">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="note"><?php if($lingua=="ita"){?>Note Aggiuntive<?php }else{?>Notes<?php }?> *</label>
										<textarea class="form-control" id="note" name="note"><?php  echo $note; ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<?php if($lingua=="ita"){?>Codice di Verifica<?php } else {?>Verify Code<?php }?> *:<br/>
									<div class="g-recaptcha" data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
								</div>
								
								<div class="form-group" style="margin-top:20px">
									<?php /*<?php //if($lingua=="eng"){?><p>In accordance with d.lgs. 196/2003 (Italy) I authorize the Data Controller to treat this data for the purposes herein indicated. The Data Controller shall not release this information to third parties unless obliged to do so by law.</p><?php }?>*/?>
									<label><input type="checkbox" id="privacy" name="privacy" value="<?php echo $privacy;?>" onclick="check_privacy()" value="<?php echo $privacy;?>"/> &nbsp; <a href="<?php if($lingua=="en"){?>en/<?php }?>privacy.html"><?php if($lingua=="ita"){?>Dichiaro di aver preso visione dell’informativa sul trattamento dei dati personali (GDPR 679/16), e di autorizzarne il trattamento<?php } else {?>I declare to have read the notice on processing of personal data (GDPR 679/16), and I authorise processing.<?php }?> *</a></label>
									
									<script type="text/javascript">
										var pr=0;
										function check_privacy(){
											if(pr==0) pr=1;
											else pr=0;
											document.certForm.privacy.value=pr;
										}
									</script>
								</div>
								<div class="form-group" style="font-size:0.9em">(* <?php if($lingua=="ita"){?>campi obbligatori<?php } else {?>required fields<?php }?>)<br /><br /></div>
								
								<button class="btn btn-primary" type="button" id="form-submit" OnClick="check_form();"><?php if($lingua=="ita"){?>Invia<?php } else {?>Send<?php }?></button>
							</form>
							<script type="text/javascript">
								Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
								
								function check_form(){
									if (document.certForm.nome.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Nome e Cognome del Socio" obbligatorio'<?php }else{?>'"Member’s first name and surname" required'<?php }?>);			
									else if (document.certForm.imbarcazione.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Nome imbarcazione" obbligatorio'<?php }else{?>'"Yacht Name" required'<?php }?>);	
									else if (document.certForm.bandiera.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Bandiera" obbligatorio'<?php }else{?>'"Flag" required'<?php }?>);	
									else if (document.certForm.t_vela.value=="off" && document.certForm.t_motore.value=="off") alert(<?php if($lingua=="ita"){?>'Campo "Tipo imbarcazione" obbligatorio'<?php }else{?>'"Type of boat" required'<?php }?>);	
									else if (document.certForm.cantiere.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Cantiere" obbligatorio'<?php }else{?>'"Name of yard" required'<?php }?>);	
									else if (document.certForm.progettista.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Progettista" obbligatorio'<?php }else{?>'"Designer" required'<?php }?>);	
									else if (document.certForm.anno.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Anno" obbligatorio'<?php }else{?>'"Year" required'<?php }?>);	
									else if (isNaN(document.certForm.anno.value) && document.certForm.anno.value!="") alert(<?php if($lingua=="ita"){?>'Inserisci un anno corretto (solo numeri)'<?php }else{?>'Enter a valid value for Year (only numbers)'<?php }?>);
									else if (document.certForm.lunghezza.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Lunghezza" obbligatorio'<?php }else{?>'"Length" required'<?php }?>);
									else if (document.certForm.larghezza.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Larghezza" obbligatorio'<?php }else{?>'"Beam" required'<?php }?>);
									else if (document.certForm.pescaggio.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Pescaggio" obbligatorio'<?php }else{?>'"Draught" required'<?php }?>);
									else if (document.certForm.posto_cervo_on.value=="off" && document.certForm.posto_cervo_off.value=="off") alert(<?php if($lingua=="ita"){?>'Campo "Posto barca a Porto Cervo" obbligatorio'<?php }else{?>'"Berth in Porto Cervo" required'<?php }?>);	
									else if (document.certForm.posto_gorda_on.value=="off" && document.certForm.posto_gorda_off.value=="off") alert(<?php if($lingua=="ita"){?>'Campo "Posto barca a Virgin Gorda" obbligatorio'<?php }else{?>'"Berth in Virgin Gorda" required'<?php }?>);	
									else if (document.certForm.contatti.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Contatti" obbligatorio'<?php }else{?>'"Contact details" required'<?php }?>);
									else if (document.certForm.email.value=="") alert(<?php if($lingua=="ita"){?>'Campo "E-mail" obbligatorio'<?php }else{?>'"E-mail" required'<?php }?>);
									else if (Filtro.test(document.certForm.email.value)==false) alert(<?php if($lingua=="ita"){?>'Inserisci un indirizzo e-mail corretto'<?php }else{?>'Enter a valid email address'<?php }?>);
									else if (document.certForm.note.value=="") alert(<?php if($lingua=="ita"){?>'Campo "Note Aggiuntive" obbligatorio'<?php }else{?>'"Notes" required'<?php }?>);
									else if (document.certForm.privacy.value=="0") alert(<?php if($lingua=="ita"){?>'Autorizzazione della privacy obbligatoria'<?php }else{?>'Privacy required'<?php }?>);
									else document.certForm.submit();
								}
							</script>
						</div>
					</div>	
					<div class="content col-lg-1"></div>				
					<!-- end: post content -->
					<!-- Sidebar-->
					<div class="sidebar sticky-sidebar sidebar-modern col-lg-3" style="background:#FBFBFB; border-left:solid 1px #EEEEEE">
						<div class="row">
							<div class="content col-lg-12">
								@include('web.common.laterale-area-soci')
							</div>
						</div>
					</div>
					<!-- end: Sidebar-->
				</div>
			</div>
		</section> <!-- end: Content -->
		
	@endsection
@else	
	<script language="javascript">
		window.location = "<?php echo config('app.url');?>/<?php if($lingua=="eng"){?>en/<?php }?>area-soci/login.html";
	</script>
@endif