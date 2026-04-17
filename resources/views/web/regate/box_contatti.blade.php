<?php /*<div style="position:absolute; width:80%;  left:10%; top:50px; background:#fff; box-shadow: 4px 4px 25px 0px rgba(0, 0, 0, 0.1);">
	<div style="padding:20px;">
		<div style="width:100%; display:flex; gap:35px; margin-bottom:10px;">
			<h3 class="gradient-title" style="font-size:22px; margin-top:10px;"><?php if($lingua=="ita"){?>RICHIESTA CONTATTI<?php }else{?>CONTACT DETAILS REQUEST<?php }?></h3>
			<div style="flex:1;">
				<div class="link-arrow" style="width:200px !important; gap:47px !important; margin-top:0px; padding-left:calc(100% - 200px); padding-bottom:7px; border-bottom:solid 1px;">
					
				</div>
			</div>
		</div>
		<p style="font-size:12px; font-weight:600">
		<?php if($lingua=="ita"){?>
			Compila il seguente form per richiedere i dati. Se la richiesta verr&agrave; accettata riceverai i dati per email.
		<?php }else{?>
			Fill in the following form to request contact details. If the request is accepted you will receive the data by email.
		<?php }?>
		</p>
		<form name="sendRequest" action="{{ url()->full() }}" method="post" autocomplete="off">
			@csrf
			<input type="hidden" name="stato" value="inviato"/>
			<div style="display:flex; flex-direction:column; gap:10px">
				<div style="display:flex; gap:50px">
					<div style="flex:1">
						<div style="display:flex; flex-direction:column; gap:5px">
							<label style="font-weight:600; font-size:12px;" for="name"><?php if($lingua=="ita"){?>Nome<?php }else{?>Your Name<?php }?></label>
							<input type="text" name="nome" placeholder="<?php if($lingua=="ita"){?>Inserisci Nome<?php }else{?>Enter Name<?php }?>" id="name3" aria-required="true">
						</div>
					</div>
					<div style="flex:1">
						<div style="display:flex; flex-direction:column; gap:5px">
							<label style="font-weight:600; font-size:12px;" for="email"><?php if($lingua=="ita"){?>Cognome<?php }else{?>Your Surname<?php }?></label>
							<input type="email"name="email" placeholder="<?php if($lingua=="ita"){?>Inserisci Email<?php }else{?>Enter email<?php }?>" id="email3" aria-required="true">
						</div>
					</div>
				</div>
				<div style="display:flex; gap:50px">
					<div style="flex:1">
						<div style="display:flex; flex-direction:column; gap:5px">
							<label style="font-weight:600; font-size:12px;" for="email"><?php if($lingua=="ita"){?>Email<?php }else{?>Your Email<?php }?></label>
							<input type="email"name="email" placeholder="<?php if($lingua=="ita"){?>Inserisci Email<?php }else{?>Enter email<?php }?>" id="email3" aria-required="true">
						</div>
					</div>
					<div style="flex:1">
						<div style="display:flex; flex-direction:column; gap:5px">
							<label style="font-weight:600; font-size:12px;" for="email"><?php if($lingua=="ita"){?>Telefono<?php }else{?>Your Phone<?php }?></label>
							<input type="number"name="email" placeholder="<?php if($lingua=="ita"){?>Inserisci Telefono<?php }else{?>Enter Phone<?php }?>" id="email3" aria-required="true">
						</div>
					</div>
				</div>
				<div style="display:flex; gap:50px">
					<div style="flex:1">
						<div style="display:flex; flex-direction:column; gap:5px">
							<label style="font-weight:600; font-size:12px;" for="messaggio"><?php if($lingua=="ita"){?>Messaggio<?php }else{?>Message<?php }?></label>
							<textarea name="messaggioAsk"  rows="4" placeholder="<?php if($lingua=="ita"){?>Inserisci Messaggio<?php }else{?>Enter Message<?php }?>" id="messaggio"></textarea>
						</div>
					</div>
				</div>
				<div style="display:flex; gap:5px; align-items:center;">
					<input type="checkbox" id="privacy" name="privacy" value="0" onclick="check_privacy()"/>
					<label style="font-weight:600; font-size:12px;" for="messaggio">
						<a target="_blank" href="<?php if($lingua=="en"){?>en/<?php }?>privacy.html" target="_blank">
							<?php if($lingua=="ita"){?>
								Dichiaro di aver preso visione dell’informativa sul trattamento dei dati personali (GDPR 679/16), e di autorizzarne il trattamento
							<?php } else {?>
								I declare to have read the notice on processing of personal data (GDPR 679/16), and I authorise processing.
							<?php }?> *
						</a>
					</label>
				</div>
				<div style="display:flex; gap:10px; margin-top:20px; margin-bottom:10px;justify-content:center;">
					<button class="btnYccsWhite" style="width:80px;" type="button" id="inviaCrew" onclick="checkForm();"><?php if($lingua=="ita"){?>INVIA<?php }else{?>SEND<?php }?></button>
					<button class="btnYccsAnnulla" style="width:100px;" type="button" onclick="vediBoardRequest();"><?php if($lingua=="ita"){?>ANNULLA<?php }else{?>BACK<?php }?></button>
				</div>
			</div>
		</form>
	</div>
</div>*/?>