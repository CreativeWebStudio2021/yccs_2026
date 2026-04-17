@include('web.common.functions')
@extends('web.layout')

@section('content')
	<section class="content">
		<div class="container">
			<div class="row">
				<!-- Blog post-->
				<div class="post-content post-modern col-md-12">	
					<div class="col-md-6 center no-padding">
						<div class="col-md-12 p-b-20">
							<h3><?php if($lingua=="ita"){?>Cambia Password<?php }else{?>Change Password<?php }?></h3>
						</div>
						
						@php
							$query_att = DB::table('edizioni_modulo_iscritti');
							$query_att = $query_att->select('id','email');
							$query_att = $query_att->where('codice', '=', $codice);							
							$query_att = $query_att->get();
							$num_att = $query_att->count();
						@endphp
						
						@if($num_att==1)
							@php 
								if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato=""; 
								if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
								if(isset($_POST['password'])) $password=$_POST['password']; else $password="";
								if(isset($_POST['password_conf'])) $password_conf=$_POST['password_conf']; else $password_conf="";
							@endphp
								
							@if($stato=="inviato")
								@php
									
									foreach($query_att[0] AS $key_risu=>$value_risu){
										$risu_att[$key_risu]=$value_risu;
									}
								@endphp
								@if($email==$risu_att['email'])
									@php
										$password=crypt($password,"");
										
										$string_mod= array();
										$string_mod['password']=$password;
										
										$query_up = DB::table('edizioni_modulo_iscritti');
										$query_up = $query_up->where('id','=',$risu_att['id']);
										$query_up = $query_up->update($string_mod);					
									@endphp
									<div style="padding-top:40px;">
										<b>
										<br/><br/><br/>
										@if($lingua=="ita")
											La password &egrave; stata aggiornata con successo.<br/>
											Ora potrai recuperare i dati di una precedente iscrizione.
										@else
											The password was successfully updated.<br/>
											You will now be able to retrieve the data of a previous subscription.
										@endif
										</b>
									</div>
									@php
										$query_ed = DB::table('edizioni_regate');
										$query_ed = $query_ed->select('*');
										$query_ed = $query_ed->where('id','=',$id_edizione);
										$query_ed = $query_ed->get();
										
										foreach($query_ed[0] AS $key_risu=>$value_risu){
											$risu_ed[$key_risu]=$value_risu;
										}
									@endphp
									<script type="text/javascript">
										function loc(){
											@if($lingua=="ita")
												window.location='regate-<?php echo $risu_ed['anno'];?>/modulo_iscrizione/<?php echo to_htaccess_url($risu_ed['nome_regata'],"");?>-<?php echo $id_edizione;?>.html';
											@else
												window.location='en/regattas-<?php echo $risu_ed['anno'];?>/entry_form/<?php echo to_htaccess_url($risu_ed['nome_regata'],"");?>-<?php echo $id_edizione;?>.html';												
											@endif
										}
										window.setTimeout('loc()' , 5000);
									</script>
								@else
									<div style="padding-top:40px;">
										<br/><br/><br/>
										@if($lingua=="ita")
											<b>ATTENZIONE!!<br/>Non &egrave; possibile procedere con il cambio password.<br/><br/>
											La mail inserita non corrisponde all'account di cui si vuole cambiare la password.</b>
										@else
											<b>WARNING!!<br/>It is not possible to change the password.<br/><br/>
											The email entered does not correspond to the account whose password you want to change.</b>
										@endif
									</div>
									<script type="text/javascript">
										function loc(){
											window.location='<?php echo $_SERVER['REQUEST_URI'];?>';
										}
										window.setTimeout('loc()' , 5000);
									</script>
								@endif
							@else
								<form method="post" action="{{ url()->full() }}" id="formCambiaPsw" name="formCambiaPsw" autocomplete="off">
									@csrf
									{!! Form::hidden('stato', 'inviato')!!}
									<div class="col-md-12 form-group">
										<label class="sr-only">Email *</label>
										<input type="text" class="form-control input-lg" placeholder="Email *" name="email" value="<?php echo $email;?>">
									</div>
									<div class="col-md-12 form-group">
										<label class="sr-only"><?php if($lingua=="ita"){?>Nuova Password<?php }else{?>New Password<?php }?> *</label>
										<input type="password" class="form-control input-lg" placeholder="Password *" name="password" value="<?php echo $password;?>">
									</div>
									<div class="col-md-12 form-group">
										<label class="sr-only"><?php if($lingua=="ita"){?>Verifica Password<?php }else{?>Verify Password<?php }?> *</label>
										<input type="password" class="form-control input-lg" placeholder="<?php if($lingua=="ita"){?>Verifica Password<?php }else{?>Verify Password<?php }?>" name="password_conf" value="<?php echo $password_conf;?>">
									</div>
									
									
									<div class="col-md-12 form-group" style="font-size:0.9em">(* <?php if($lingua=="ita"){?>campi obbligatori<?php } else {?>required fields<?php }?>)<br /><br /></div>
													
									<div class="col-md-12 form-group">
										<button type="button" class="btn btn-primary" OnClick="check_form();"><?php if($lingua=="ita"){?>Modifica<?php }else{?>Update<?php }?> </button>
										<button class="btn btn-danger m-l-10" type="button"><?php if($lingua=="ita"){?>Annulla<?php }else{?>Cancel<?php }?></button>						
									</div>
								</form>
								<script type="text/javascript">
									Filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
									
									function check_form(){
										if (document.formCambiaPsw.email.value=="") alert('<?php if($lingua=="eng"){?>"Email" required<?php } else {?>Campo "E-mail" obbligatorio<?php }?>');
										else if (Filtro.test(document.formCambiaPsw.email.value)==false) alert('<?php if($lingua=="eng"){?>Enter a valid email address<?php } else {?>Inserisci un indirizzo e-mail corretto<?php }?>');
										else if (document.formCambiaPsw.password.value=="") alert('<?php if($lingua=="eng"){?>"Password" required<?php } else {?>Campo "Password" obbligatorio<?php }?>');
										else if (document.formCambiaPsw.password_conf.value=="") alert('<?php if($lingua=="eng"){?>"Verify Password" required<?php } else {?>Campo "Verifica Password" obbligatorio<?php }?>');
										else if (document.formCambiaPsw.password_conf.value!=document.formCambiaPsw.password.value) alert('<?php if($lingua=="eng"){?>Warning: the "Password" and "Verify Password" fields do not match<?php } else {?>Attenzione: i campi "Password" e "Verifica Password" non coincidono<?php }?>');
										else document.formCambiaPsw.submit();
									}
								</script>
							@endif
						@endif
					</div>
				</div>			
			
			</div>
		</div>
	</section>
@endsection