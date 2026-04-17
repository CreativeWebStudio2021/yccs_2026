<style>
	.sidebarTitle{padding-bottom:10px; border-bottom:solid 4px #444444}
</style>

<div class="widget clearfix widget-archive">
	<div style="width:100%; display:flex; gap:10px;">
		<h4 class="gradient-title" style="font-size:25px;"><?php if($lingua=="ita"){?>Login Socio<?php }else{?>Member Login<?php }?></h4>
		<div class="link-arrow" style="flex:1; margin-top:10px; border-bottom:solid 1px;"></div>
	</div>
						
	<div style="width:100%;">
		@if(isset($_SESSION["user_nome_login"]))
			<?php if($lingua=="ita"){?>Ciao<?php }else{?>Hi<?php }?>, <?php echo ucwords($_SESSION["user_nome_login"]);?>
		@endif
	</div>
	
	<div style="margin-top:10px">
		<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/logout.html" title="Area Soci - <?php if($lingua=="ita"){?>ESCI<?php }else{?>LOGOUT<?php }?> - {{ config('app.name') }}">
			<div class="btn btn-dark btn-xs"><?php if($lingua=="ita"){?>ESCI<?php }else{?>LOGOUT<?php }?></div>
		</a>
	</div>
</div>

<style>
	.list-group-item{background:#fff;  transition: 0.3s;}
	.list-group-item:hover{background:#00AEEF; color:#fff}
</style>
<div class="widget clearfix widget-blog-articles">
	<div style="width:100%; display:flex; gap:10px;">
		<h4 class="gradient-title" style="font-size:25px;">Member Menu</h4>
		<div class="link-arrow" style="flex:1; margin-top:10px; border-bottom:solid 1px;"></div>
	</div>
	<ul class="list-group" style="padding-top:20px">
		<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/benvenuto.html">
			<li class="list-group-item {{ ($cmd=='benvenuto') ? 'active' : ''}}">
				<b><?php if($lingua=="ita"){?>Benvenuto<?php }else{?>Welcome<?php }?></b>
			</li>
		</a>
		<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/carrello.html">
			<li class="list-group-item {{ $cmd=='carrello' ? 'active' : ''}}">
				@php
					$num_prods=0;
					if(isset($mysidname)){
						$query_id_cart = DB::table('carrelli')
							->select('id')
							->where('sessione','=',$mysidname)
							->get();
						$num_id_cart = $query_id_cart->count();
						if($num_id_cart>0){
							$id_cart = $query_id_cart[0]->id;
						}
					}
					
					if(isset($id_cart) && $id_cart!=""){
						$query_prods = DB::table('prodotti_carr')
							->select('*')
							->where('id_carrello','=',$id_cart)
							->get();
						$num_prods = $query_prods->count();					
					}
				@endphp
				<b>{{ Lang::get('website.carrello') }} <span id="testo_cart">({{ $num_prods }})</span></b>
			</li>
		</a>
		@if($cmd=="checkout")
			<a>
				<li class="list-group-item {{ $cmd=='checkout' ? 'active' : ''}}">
					<b>Checkout</b>
				</li>
			</a>
			<div class="list-group-item" style="background:#fff">
				<div style="margin-left:20px;">
					<a style="<?php if(isset($step) && $step==1){?>font-weight:bold<?php }?>" href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/checkout-step1.html">
						<?php if($lingua=="ita"){?>Step 1 di 3: Dettagli di Spedizione/Fatturazione<?php }else{?>Step 1 of 3: Shipping/Invoice Details<?php }?>
					</a>
				</div>
			</div>
			<div class="list-group-item" style="background:#fff">
				<div style="margin-left:20px;">
					<a style="<?php if(isset($step) && $step==2){?>font-weight:bold<?php }?>" href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/checkout-step2.html">
						<?php if($lingua=="ita"){?>Step 2 di 3: Metodo di pagamento e spedizione<?php }else{?>Step 2 of 3: Payment/Shipping Method<?php }?>
					</a>
				</div>
			</div>
			<div class="list-group-item" style="background:#fff">
				<div style="margin-left:20px;">
					<a style="<?php if(isset($step) && $step==3){?>font-weight:bold<?php }?>" href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/checkout-step3.html">
						<?php if($lingua=="ita"){?>Step 3 di 3: Conferma Ordine<?php }else{?>Step 3 of 3: Confirm Your Order <?php }?>
					</a>
				</div>
			</div>
		@endif
		<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/la-boutique.html">
			<li class="list-group-item {{ ($cmd=='la-boutique' || $cmd=='prodotti_dett') ? 'active' : ''}}">
				<b>{{ Lang::get('website.la boutique') }}</b>
			</li>
		</a>
		@if($cmd=="la-boutique" || $cmd=="prodotti_dett")
			@php
				$query_cat = DB::table('categorie')
					->select('*')
					->orderby('ordine','DESC')
					->get();
			@endphp
			@foreach($query_cat AS $key_cat=>$value_cat)
				@php
					$query_prod = DB::table('prodotti')
						->select('id')
						->where('id_rife','=',$value_cat->id)
						->where('stato','=','1')
						->get();
					$num_prod = $query_prod->count();
				@endphp
				@if($num_prod>0)
					@php
						$nome_c = $value_cat->nome;
						if($lingua=="eng" &&isset($value_cat->nome_eng) && $value_cat->nome_eng!="") $nome_c = $value_cat->nome_eng;
						
						$link_c="area-soci/la-boutique/".creaSlug($value_cat->nome,'')."-".$value_cat->id.".html";
						if($lingua=="eng") $link_c="en/".$link_c;
					@endphp
					<a href="{{ $link_c }}">
						<li class="list-group-item" style="color:#111; {{ $id_cat==$value_cat->id ? 'font-weight:700' : ''}}">
							<div style="padding-left:30px">{{ $nome_c }}{!! $id_cat==$value_cat->id ? '&nbsp;&nbsp;<i class="fa fa-caret-down"></i>' : ''!!}</div>
						</li>
					</a>
					@if($id_cat==$value_cat->id)
						@php
							$query_sottocat = DB::table('sottocategorie')
								->select('*')
								->where('id_rife','=',$value_cat->id )
								->orderby('ordine','DESC')
								->get();
						@endphp
						@foreach($query_sottocat AS $key_sottocat=>$value_sottocat)
							@php
								$query_prod = DB::table('prodotti')
									->select('id')
									->where('id_riferimento','=',$value_sottocat->id)
									->where('stato','=','1')
									->get();
								$num_prod = $query_prod->count();
							@endphp
							@if($num_prod>0)
								@php
									$nome_c = $value_sottocat->nome;
									if($lingua=="eng" &&isset($value_sottocat->nome_eng) && $value_sottocat->nome_eng!="") $nome_c = $value_sottocat->nome_eng;
									
									$link_c="area-soci/la-boutique/".creaSlug($value_cat->nome,'')."-".$value_cat->id."/".creaSlug($value_sottocat->nome,'')."-".$value_sottocat->id.".html";
									if($lingua=="eng") $link_c="en/".$link_c;
								@endphp
								<a href="{{ $link_c }}">
									<li class="list-group-item" style="color:#111; {{ $id_sottocat==$value_sottocat->id ? 'font-weight:700' : ''}}">
										<div style="padding-left:60px">{{ $nome_c }}</div>
									</li>
								</a>
							@endif
						@endforeach
					@endif
				@endif
			@endforeach
		@endif
		<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/i-miei-ordini.html">
			<li class="list-group-item {{ $cmd=='i-miei-ordini' ? 'active' : ''}}">
				<b>{{ Lang::get('website.i miei ordini') }}</b>
			</li>
		</a>
		<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/profilo-socio.html">
			<li class="list-group-item {{ $cmd=='profilo-socio' ? 'active' : ''}}">
				<b>{{ Lang::get('website.profilo socio') }}</b>
			</li>
		</a>
		<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/comunicazioni-ai-soci.html">
			<li class="list-group-item {{ $cmd=='comunicazioni-ai-soci' ? 'active' : ''}}">
				<b>{{ Lang::get('website.comunicazioni ai soci') }}</b>
			</li>
		</a>
		
		@php
			$query_stato = DB::table('statuto')
				->select('pdf', 'pdf_eng')
				->where('id','=','1')
				->get();
			$file_statuto = $query_stato[0]->pdf;
			if($lingua=="eng" && trim($query_stato[0]->pdf_eng)!="") $file_statuto = $query_stato[0]->pdf_eng;
		@endphp
		@if(trim($file_statuto)!="")
			<a  title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Statuto<?php }else{?>Statute<?php }?> - {{ config('app.name') }}">
				<li style="cursor:pointer;" class="list-group-item openStatuto openStatutoBott" >
					<b><?php if($lingua=="ita"){?>Statuto<?php }else{?>Statute<?php }?></b>
				</li>
			</a>
		@endif
		
		@php
			$query_f = DB::table('regolamento_interno')
				->select('pdf', 'pdf_eng')
				->where('id','=','1')
				->get();
			$file_reg = $query_f[0]->pdf;
			if($lingua=="eng" && trim($query_f[0]->pdf_eng)!="") $file_reg = $query_f[0]->pdf_eng;
		@endphp
		@if(trim($file_reg)!="")
			<a  title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Regolamento Interno<?php }else{?>Internal Rules<?php }?> - {{ config('app.name') }}">
				<li style="cursor:pointer;" class="list-group-item openReg openRegBott" >
					<b><?php if($lingua=="ita"){?>Regolamento Interno<?php }else{?>Internal Rules<?php }?></b>
				</li>
			</a>
		@endif
		
		<a  title="{{ Lang::get('website.area soci') }} - <?php if($lingua=="ita"){?>Codice di Comportamento Etico<?php }else{?>Code of Ethical Conduct<?php }?> - {{ config('app.name') }}">
			<li style="cursor:pointer;" class="list-group-item openCodiceComportamento openRegBott" >
				<b><?php if($lingua=="ita"){?>Codice di Comportamento Etico<?php }else{?>Code of Ethical Conduct<?php }?></b>
			</li>
		</a>
		
		<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/certificato-di-guidone.html">
			<li class="list-group-item {{ $cmd=='certificato-di-guidone' ? 'active' : ''}}">
				<b>{{ Lang::get('website.certificato di guidone') }}</b>
			</li>
		</a>
		<?php /*<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/regate-interclub.html">
			<li class="list-group-item {{ $cmd=='regate-interclub' ? 'active' : ''}}">
				<b>{{ Lang::get('website.regate interclub') }}</b>
			</li>
		</a>*/?>
		@if($_SERVER['REMOTE_ADDR'] == "93.45.34.21")
			<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/centro-sportivo.html">
				<li class="list-group-item {{ $cmd=='centro-sportivo' ? 'active' : ''}}">
					<b>{{ Lang::get('website.centro_sportivo nome pagina') }}</b>
				</li>
			</a>
		@endif
		<a href="<?php if($lingua=="eng"){?>en/<?php }?>area-soci/pagamento-quota.html">
			<li class="list-group-item {{ $cmd=='pagamento-quota' ? 'active' : ''}}">
				<b>{{ Lang::get('website.pagamento quota') }}</b>
			</li>
		</a>
	</ul>
</div>