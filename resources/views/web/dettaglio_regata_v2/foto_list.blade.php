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
			
			$link_back="regate-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
			if($lingua=="eng") $link_back="en/regattas-".$anno_regata."/".to_htaccess_url($nome_regata,"")."-".$id_dett.".html";
		@endphp	

		<section class="content" style="margin-top:30px;">
			<div class="container"> 
				<a href="<?php echo $link_back;?>"><div style="width:300px; margin:0 auto; padding:10px 0; border:solid 1px #<?php echo $colore_testo;?>; color:#<?php echo $colore_testo;?>; text-align:center; margin-top:-25px; margin-bottom:30px"><b><?php if($lingua=="ita"){?>TORNA ALLA HOME REGATA<?php }else{?>BACK TO REGATTA<?php }?></b></div></a>	
				
				@php
					$query_img = DB::table('edizioni_foto');
					$query_img = $query_img->select('*');
					$query_img = $query_img->where('id_edizione','=',$id_dett);
					$query_img = $query_img->orderby('ordine','DESC');
					$query_img = $query_img->get();
					$num_img = $query_img->count();
				@endphp
				@if($num_img>0)
					<div id="portfolio" class="grid-layout portfolio-3-columns" data-margin="20" data-lightbox="gallery">
						@foreach($query_img AS $key_img=>$value_img)
							@foreach($value_img AS $key_risu=>$value_risu)
								@php
									$risu_img[$key_risu]=$value_risu;
								@endphp
							@endforeach
							@php
								if (stristr($risu_img['foto'],"admin")==true || stristr($risu_img['foto'],"resarea")) {
									$foto=substr($risu_img['foto'],1);
									$foto=str_replace("admin/img_up/regate/foto/","",$foto);
									$foto=str_replace("resarea/img_up/regate/foto/","",$foto);
									
									if(is_file("resarea/img_up/regate/foto/s_$foto")) $s_foto="resarea/img_up/regate/foto/s_$foto";
									else $s_foto="resarea/img_up/regate/foto/$foto";
									$foto="resarea/img_up/regate/foto/$foto";												
								} else {
									$foto=substr($risu_img['foto'],1);
									$foto=str_replace("-150-100","-800-600",$foto);
									$foto=str_replace("-140-90","-800-600",$foto);
									$foto=substr($foto,0,-6).".jpg";
									
									$s_foto=substr($risu_img['foto'],1);
								}
								
								$testo="";
								if(isset($risu_img['testo']) && $risu_img['testo']!="") $testo = $risu_img['testo'];
							@endphp
								<div class="portfolio-item shadow img-zoom">
									<div class="portfolio-item-wrap">
										<div class="portfolio-image">
											<a href="#"><img src="<?php echo $s_foto;?>" alt="{{ $testo }}"></a>
										</div>
										<div class="portfolio-description">
											<a title="{{ $testo }}" data-lightbox="gallery-image" href="<?php echo $foto;?>"><i class="icon-maximize"></i></a>
										</div>
									</div>
								</div>
						@endforeach
					</div>
				@endif
			</div>
		</section>
		<!-- END: SECTION --> 
	@else
		<script>
			window.location="<?php echo config('app.url');?>/home.html";
		</script>
	@endif	
@endsection