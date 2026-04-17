@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$query_ed = DB::table('edizioni_regate');
		$query_ed = $query_ed->select('*');
		$query_ed = $query_ed->where('id','=',$id_dett);
		$query_ed = $query_ed->where('visibile','=','1');
		$query_ed = $query_ed->where('new','=','1');
		$query_ed = $query_ed->get();
		$num_ed = $query_ed->count();
	@endphp

	@if($num_ed>0)
		@php	
			$nome_regata = $query_ed[0]->nome_regata;
			$luogo    =  $query_ed[0]->luogo;
			$anno_regata   =  $query_ed[0]->anno;
			$titolo_regata=$nome_regata." - ".$luogo." ".$anno_regata;
			
			$logo_edizione  = $query_ed[0]->logo_edizione;
			
			$data_dal   = $query_ed[0]->data_dal;
			$data_al   = $query_ed[0]->data_al;
			$lista_iscritti   = $query_ed[0]->lista_iscritti;
			
			$link_back="regate-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
			if($lingua=="eng") $link_back="en/regattas-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		@endphp	
		@if($lista_iscritti==0)
			<script>
				window.location='<?php echo config('app.url');?>/<?php echo $link_back;?>';
			</script>
		@else
			<!-- CONTENT -->
			<section class="content" style="margin-top:30px; padding-bottom:0; background:#fff">
				<div class="container"> 
					<a href="<?php if($lingua=="eng"){?>en/<?php }?><?php echo $link_back;?>"><div style="width:300px; margin:0 auto; padding:10px 0; border:solid 1px #<?php echo $colore_testo;?>; color:#<?php echo $colore_testo;?>; text-align:center; margin-top:-25px; margin-bottom:30px"><b><?php if($lingua=="ita"){?>TORNA ALLA HOME REGATA<?php }else{?>BACK TO REGATTA<?php }?></b></div></a>		  	  				 
				</div>
			</section>
			<section class="content" style="padding:20px; background:#fff" id="printArea">
				<div style="width:100%; text-align:center; display:none" id="logo_stampa">
					<img src="resarea/img_up/regate/<?php echo $logo_edizione;?>" alt="" style="width:100px; border:solid 1px; margin-bottom:20px;"/>
				</div>
				
				<div class="container" style="">
					
						<div class="titoliBox2" style="margin-bottom:20px; text-align:center;">
							<h1 style="line-height:35px">
								<?php echo $nome_regata;?><br/>
								<span style="font-size:0.6em"><?php echo $luogo;?>, <?php if($lingua=="ita"){?>dal<?php }else{?>from<?php }?> <?php echo $data_dal;?> <?php if($lingua=="ita"){?>al<?php }else{?>to<?php }?> <?php echo $data_al;?></span>
							</h1>
						</div>
						<div class="titoliBox2" style="margin-bottom:10px; text-align:center;"><h3><?php if($lingua=="ita"){?>Lista Iscritti<?php }else{?>Entry List<?php }?></h3></div>
						
						<div class="table-responsive" style="margin-top:40px;">
							<style>
								.table-striped>tbody>tr:nth-of-type(odd){
									background-color: #b8cce4;
								}
							</style>
							<table class="table table-striped" style="border-bottom:solid 3px #002060">
								<thead>
									<tr style="background:#002060; color:#fff">
										<th>YACHT NAME</th>
										<th>LH (m)</th>
										<th>Beam (m)</th>
										<th>Draft (m)</th>
										<th>Builder</th>
										<th>Designer</th>
									</tr>
								</thead>
								<tbody>
									@php
										$query_ele = DB::table('edizioni_iscrizioni_regata');
										$query_ele = $query_ele->select('*');
										$query_ele = $query_ele->where('visibile','=','1');
										$query_ele = $query_ele->where('id_edizione','=',$id_dett);
										$query_ele = $query_ele->orderby('ordine','DESC');
										$query_ele = $query_ele->get();
										$num_item = $query_ele->count();
									@endphp
									@foreach($query_ele AS $ley_ele=>$value_ele)
										@php
											$boat_name = ucwords(trim($value_ele->boat_name));
											$builder = ucwords(trim($value_ele->builder));
											$designer = ucwords(trim($value_ele->designer));						
											
											$lh = $value_ele->lh;
											$beam = $value_ele->beam;
											$min_draft = $value_ele->min_draft;
										@endphp
									
										<tr>
											<td><?php echo ($x+1);?> <b><?php echo $boat_name;?></b></td>
											<td><b><?php echo $lh;?></b></td>
											<td><?php echo $beam;?></td>
											<td><?php echo $min_draft;?></td>
											<td><i><?php echo $builder;?></i></td>
											<td><i><?php echo $designer;?></i></td>
										</tr>
									@endforeach
								</tbody>
							</table>
							
							<div style="float:right; background:grey; cursor:pointer; border-radius:3px; width:100px; text-align:center; color:#fff" onclick="printDiv('printArea')" id="print_icon">
								<div style="padding:5px 8px;">
									<i class="fa fa-print" aria-hidden="true"></i> <?php if($lingua=="ita"){?>STAMPA<?php }else{?>PRINT<?php }?>
								</div>
							</div>
							
							
							<script>
								function printDiv(divName){
									document.getElementById('logo_stampa').style.display="block";
									document.getElementById('loghi_stampa').style.display="block";
									document.getElementById('print_icon').style.display="none";
									var printContents = document.getElementById(divName).innerHTML;
									var originalContents = document.body.innerHTML;
									
									
									document.body.innerHTML = printContents;
									window.print();
									document.body.innerHTML = originalContents;
									document.getElementById('print_icon').style.display="block";
									document.getElementById('logo_stampa').style.display="none";
									document.getElementById('loghi_stampa').style.display="none";
								}
							</script>
						</div>
						
					
				</div>
				
				<div class="footer-content" style="display:none" id="loghi_stampa">
					<div class="container" >
						<div class="row" style="text-align:center; padding:20px 0">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div style="position:relative; text-align:center; margin:0 auto;" id="partnerUfficiali">
									<img src="web/images/new/loghi.jpg" alt="" style="width:100%;"/>					
									<div style="position:absolute; top:0; left:0; width:30%; height:100%;">
										<img src="web/images/new/blank.png" style="width:100%; height:100%;" alt="Rolex"/>
									</div>
									<div style="position:absolute; top:0; left:30%; width:40%; height:100%;">
										<img src="web/images/new/blank.png" style="width:100%; height:100%;" alt="One Ocean"/>
									</div>
									<div style="position:absolute; top:0; left:70%; width:30%; height:100%;">
										<img src="web/images/new/blank.png" style="width:100%; height:100%;" alt="Audi"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- END: SECTION --> 
		@endif
		
	@else
		<script>
			window.location="<?php echo config('app.url');?>/home.html";
		</script>
	@endif	
@endsection