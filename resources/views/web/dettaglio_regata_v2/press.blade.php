<div style="position:relative; width:100%; height:100%; text-align:center;">
	<div  id="press" style="position:absolute; top:-100px;"></div>
	@php
		$query_press = DB::table('press')
			->select('*')
			->where('id_edizione', $id_dett)
			->where(function($q) {
				$q->whereNotNull('foto1')
				  ->orWhereNotNull('foto2');
			})
			->orderBy('data', 'DESC')
			->limit(5)
		//dd($query_press->toSql(), $query_press->getBindings());	
			->get();

		$num_press = $query_press->count();
	@endphp

	<style>
		#CS_Com{						
			top:50%; margin-top:-61px; left:50%; margin-left:-75px;  width:150px;
		}
		#newsDateBox{ top:-40px;}
		#newsDate{ font-size:0.9em;}
		#newsTitle{ font-size:font-size:1.1em; padding: 25px 25px;}
		@media (max-width: 500px) {
			#CS_Com{margin-top:-40px;}
		}
		@media (max-width: 400px) {
			#CS_Com{margin-top:-15px; margin-left:-60px;  width:120px;}
			#newsDateBox{ top:-35px;}
			#newsDate{ font-size:0.8em;}
			#newsTitle{ font-size:1.0em; padding: 10px 25px; line-height:15px;}
		}
	</style>
	<div style="position:relative; width:100%; height:100%; <?php if($num_press==0){?>background:#fff; <?php }?> background-size:cover" id="newsImg">
		<?php if($num_press==0){?>
			<img src="https://www.yccs.it/web/images/new/coming_soon_press.png" alt="<?php echo $titolo_regata;?>" id="CS_Com"  style="position:absolute; background:#<?php echo $colore;?>"/>	
		<?php }?>
	</div>
	
	<?php if($num_press>0){?><a href="<?php if($lingua=="ita"){?>regate<?php }else{?>en/regattas<?php }?>-<?php echo $anno_regata;?>/press/<?php echo to_htaccess_url($nome_regata,"");?>-<?php echo $id_dett;?>.html"><?php }?>
		<div style="position:absolute; left:19px; top:19px; background:#<?php echo $colore;?>">
			<div  class="titoliBox" style="padding: 15px 30px; font-size:0.9em; color:#fff">
				<?php if($lingua=="ita"){?>COMUNICATI STAMPA<?php }else{?>PRESS RELEASE<?php }?>&nbsp;&nbsp;<?php if($num_press>0){?><i class="fa fa-chevron-right" aria-hidden="true"></i><?php }?>
			</div>
		</div>
	<?php if($num_press>0){?></a><?php }?>
	
	<?php if($num_press>0){?>
		<div style="position:absolute; width:90%; bottom:5%; left:5%;">				
			<div style="position:absolute; left:0; bottom:0px;">
				<div style="position:absolute; left:0;  background:#<?php echo $colore;?>" id="newsDateBox">
					<div class="titoliBox" style="padding: 5px 25px; color:#fff" id="newsDate">
						
					</div>
				</div>
				<a href="" id="newsLink">
					<div class="titoliBox" style=" text-align:left; background:rgba(255,255,255,0.7); color:#<?php echo $colore_testo;?>" id="newsTitle">
						
					</div>
				</a>
			</div>
		</div>
	<?php }?>
	<?php if($num_press>1){?>
		<div style="position:absolute; right:30px; top:50px; color:#fff; cursor:pointer;  text-shadow:2px 2px 5px #000; z-index:1000" id="newsArrow">
			<i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
		</div>
	<?php }?>
</div>
</div>
<script>
	var w=$("#boxStampa").width();
	h = (w/100)*60;
	document.getElementById('boxStampa').style.height=h+"px";
	$(".imgSlide").css({"height":((h/2))+"px", "width":"auto"});
	$("#newsArrow").css({"top":((h/2)-15)+"px"});

	@if($num_press>0)
		@php
			$string_titoli='';
			$string_date='';
			$string_img='';
			$string_link='';
		@endphp
		@foreach($query_press AS $key_press=>$value_press)
			@foreach($value_press AS $key_risu=>$value_risu)
				@php
					$risu_press[$key_risu]=$value_risu;
				@endphp
			@endforeach
			
			@php
				$titolo_eng=$risu_press['titolo_eng'];
				$titolo_ita=$risu_press['titolo_eng'];
				if($risu_press['titolo'] && trim($risu_press['titolo'])!="") $titolo_ita=$risu_press['titolo'];
				
				if($lingua=="ita") $titolo=$titolo_ita; else $titolo=$titolo_eng;
				$string_titoli.='"'.$titolo.'",';
				$string_date .= '"'.date_to_data($risu_press['data']).'",';
				if(!empty($risu_press['foto1'])) $foto=$risu_press['foto1'];
				else $foto=$risu_press['foto2'];
				if(is_file("resarea/img_up/regate/press/".$foto))
					$string_img .= '"resarea/img_up/regate/press/'.$foto.'",';
				else{
					$string_img .= '"https://www.yccs.it/resarea/img_up/regate/press/'.$foto.'",';					
				}
				$string_link .= '"regate-'.$anno_regata.'/press/'.to_htaccess_url($nome_regata,"").'-'.$id_dett.'/'.to_htaccess_url($titolo,"").'-'.$risu_press['id'].'.html",';
			@endphp
		@endforeach
		@php
			$string_titoli=substr($string_titoli,0,-1);
			$string_date=substr($string_date,0,-1);
			$string_img=substr($string_img,0,-1);
			$string_link=substr($string_link,0,-1);
		@endphp
		var titoli = [<?php echo $string_titoli;?>];
		var date = [<?php echo $string_date;?>];
		var img = [<?php echo $string_img;?>];
		var link = [<?php echo $string_link;?>];
	@endif

	var ind=0;
	$("#newsArrow").click(function(){
		nextPress();
	})
	function nextPress(){
		$("#newsDate").css({"display":"none"});
		$("#newsTitle").css({"display":"none"});
		$("#newsImg").css({"display":"none"});
		$("#newsDate").html(date[ind]);
		$("#newsTitle").html(titoli[ind]);
		$("#newsLink").attr("href",link[ind]);
		$("#newsImg").css({"background":"url("+img[ind]+") center center"});
		$("#newsImg").css({"background-size":"cover"});
		$("#newsImg").fadeIn(800);
		$("#newsDate").fadeIn(800);
		$("#newsTitle").fadeIn(800);
		ind++;
		if(ind==5) ind=0;
	}
	<?php if($num_press>0){?> nextPress();<?php }?>
</script>