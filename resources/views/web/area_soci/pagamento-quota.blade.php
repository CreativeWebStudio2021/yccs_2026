@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
	@section('content')
		@php
			$img_background = "web/images/testate/consiglio_direttivo.jpg";
		$video_background = "web/video/blue-sea.mp4";
			$page_title = Lang::get('website.pagamento quota');
			$x=0;
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.area soci'); $breadcrumbs[$x]['link']=''; 
			$x++; $breadcrumbs[$x]['titolo']=Lang::get('website.pagamento quota'); $breadcrumbs[$x]['link']=''; 
			
		@endphp
		@include('web.common.page_title')
		
		<!-- Content -->
		<section id="page-content" class="sidebar-right">
			<div class="container-fluid">
				<div class="row">
					<!-- post content -->
					<div class="content col-lg-1"></div>
					<div class="content col-lg-7">
						<div style="width:100%; display:flex; gap:35px;">
							<h3 class="gradient-title" style="line-height:1.2"><?php if($lingua=="ita"){?>Pagamento Quote YCCS <?php }else{?>YCCS Fee Payment<?php }?></h3>
							<div class="link-arrow" style="flex:1; margin-top:50px; border-bottom:solid 2px;"></div>
						</div>
						<div style="padding-top:20px">
							<form action="https://www.paypal.com/cgi-bin/webscr" class="form-gray-fields" method="post" target="_top" name="formPaga">		
								@csrf
								<input type="hidden" name="cmd" value="_s-xclick" />
								<input type="hidden" name="hosted_button_id" value="RX4Q6CT65QEZJ" />	
								<div class="col-md-12 form-group">
									<input type="hidden" name="on0" value="Select Annual Fee">
									<label style="color:#111111"><b><?php if($lingua=="ita"){?>Seleziona la quota annuale<?php }else{?>Select Annual Fee<?php }?></b></label>
									<select class="form-control input-lg" name="os0">
										<option value="Annual Fee">Ordinary Member €3.500,00 EUR</option>
										<option value="Junior Fee">Junior Member €300,00 EUR</option>
										
									</select>
								</div>
								
								<div class="col-md-12 form-group">
									<input type="hidden" name="on1" value="Name and Surname">
									<label style="color:#111111"><b><?php if($lingua=="ita"){?>Nome e Cognome<?php }else{?>Name and Surname<?php }?></b></label>
									<input type="text" class="form-control input-lg" name="os1" value="{{ isset($nome) ? $nome : '' }}" maxlength="200">
								</div>
								<input type="hidden" name="currency_code" value="EUR" />
								<?php if($lingua=="ita"){?>
									<input type="image" src="https://www.paypalobjects.com/it_IT/IT/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - Il metodo rapido, affidabile e innovativo per pagare e farsi pagare.">
								<?php }else{?>
									<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
								<?php }?>
								<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
							</form>
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