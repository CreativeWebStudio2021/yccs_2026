<?php
$_GET['anno'] ? $anno = $_GET['anno'] : '';
$_GET['lingua'] ? $lingua = $_GET['lingua'] : '';

$gap = "45";
?>
<div style="flex:1; display:flex; flex-direction:column; gap:{{ $gap }}px;" class="colRegLeft  colRegLeft<?php echo $anno;?>">
	@php
		$query_c = DB::table('edizioni_regate');
		$query_c = $query_c->select('*');
		$query_c = $query_c->where('visibile','=','1');
		$query_c = $query_c->where('anno','=',$anno);
		$query_c = $query_c->orderby('data_dal','ASC');
		$query_c = $query_c->get();
		$z=1;
		$y=1;
		$order_left = 0;
	@endphp
	
	@foreach($query_c AS $key_c=>$value_c)											
		
		@php
			$data_dal = substr($value_c->data_dal,5);
			$temp = explode("-",$data_dal);
			$data_dal = $temp[1]."-".$temp[0];
			
			$data_al = substr($value_c->data_al,5);
			$temp = explode("-",$data_al);
			$data_al = $temp[1]."-".$temp[0];				
		
			$query_foto = DB::table('edizioni_foto')
				->select('foto')
				->WHERE('id_edizione','=',$value_c->id)
				->orderby('ordine','ASC')
				->limit(1)
				->get();
			$num_foto=$query_foto->count();
			
			if($num_foto>0){
				 $foto = $query_foto[0]->foto;
				 $foto=str_replace("admin/","resarea/",$foto);
				 if(str_replace("/images/igallery","",$foto)!=$foto){
					 $foto=str_replace("/images/igallery","/web/images/igallery",$foto);
					 $foto=substr($foto,1);
					 $foto=str_replace("-150-100","-800-600",$foto);
					 $foto=str_replace("-140-90","-800-600",$foto);
					 $foto=substr($foto,0,-6).".jpg";
				 }else $foto=str_replace("/admin","admin",$foto);
			}else $foto="web/images/regate/rolexswancup2015.jpg";	
				
			$titolo_regata=$value_c->nome_regata." - ".$value_c->luogo." ".$anno;
			if($lingua=="eng") $link_regata="en/"; else  $link_regata="";
			if($value_c->link_esterno && trim($value_c->link_esterno)!=""){
				$link_regata=$value_c->link_esterno;
				if($lingua=="eng" &&  $value_c->link_esterno_eng && trim($value_c->link_esterno_eng)!="") $link_regata=$value_c->link_esterno_eng.'" target="_blank';
			}else{
				if($lingua=="ita"){
					$link_regata.="regate-$anno/".creaSlug($value_c->nome_regata,"")."-".$value_c->id.".html";	
				}else{
					$link_regata.="regattas-$anno/".creaSlug($value_c->nome_regata,"")."-".$value_c->id.".html";
				}								
			}
		@endphp
		@php
			$grid_order = ($order_left < 4) ? ($order_left * 2 + 1) : (8 + $order_left);
			$order_left++;
		@endphp
		<div class="regata <?php if($z!=1){?>regataMob<?php }?>" data-grid-order="{{ $grid_order }}" <?php if($y>3){?>style="visibility:hidden"<?php }?>>
			<a href="{{ $link_regata }}" alt="{{ $titolo_regata }}" @if($value_c->link_esterno && trim($value_c->link_esterno)!="") target="_blank" @endif>
				<div style="width:100%; aspect-ratio: 3 / 2; position:relative; overflow:hidden;">
					<img style="width:100%; height:100%; object-fit:cover;" src="{{ smartAsset($foto); }}" class="news-hero-image" alt="{{ $titolo_regata }}">
				</div>
			</a>
			
			<div class="news-hero-title" style="color:var(--azzurro); font-weight:600; margin:10px 0 5px; height:40px;">
				{{ $value_c->nome_regata }}
			</div>
			<div class="news-hero-title" style="color:#000;">
				<?php if($lingua=="ita"){?>dal<?php }else{?>from<?php }?> {{ $data_dal }} <?php if($lingua=="ita"){?>al<?php }else{?>to<?php }?> {{ $data_al }}<br/>
				{{ $value_c->luogo }}
			</div>	
			<a href="{{ $link_regata }}" @if($value_c->link_esterno && trim($value_c->link_esterno)!="") target="_blank" @endif class="link-arrow" style="width:158px; margin-top:10px; margin-right:20px;" alt="{{ $titolo_regata }}">
				<span>
					<?php if($lingua=="ita"){?>
						Dettagli regata
					<?php }else{?>
						Regatta details
					<?php }?>
				</span>
				<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
			</a>
		</div>
		
		@php
			$z++; if($z==3) $z=1;
			$y++;
		@endphp
	@endforeach	
</div>
<div style="flex:1; margin-top:60px; display:flex; flex-direction:column; gap:{{ $gap }}px;" class="colRegRight colRegRight<?php echo $anno;?>">
	@php
		$query_c = DB::table('edizioni_regate');
		$query_c = $query_c->select('*');
		$query_c = $query_c->where('visibile','=','1');
		$query_c = $query_c->where('anno','=',$anno);
		$query_c = $query_c->orderby('data_dal','ASC');
		$query_c = $query_c->get();
		$z=1;
		$y=1;
		$order_right = 0;
	@endphp
	
	@foreach($query_c AS $key_c=>$value_c)
		@if($z==2)
			@php
				$data_dal = substr($value_c->data_dal,5);
				$temp = explode("-",$data_dal);
				$data_dal = $temp[1]."-".$temp[0];
				
				$data_al = substr($value_c->data_al,5);
				$temp = explode("-",$data_al);
				$data_al = $temp[1]."-".$temp[0];
				
			
				$query_foto = DB::table('edizioni_foto')
					->select('foto')
					->WHERE('id_edizione','=',$value_c->id)
					->orderby('ordine','ASC')
					->limit(1)
					->get();
				$num_foto=$query_foto->count();
				
				if($num_foto>0){
					 $foto = $query_foto[0]->foto;
					 $foto=str_replace("admin/","resarea/",$foto);
					 if(str_replace("/images/igallery","",$foto)!=$foto){
						 $foto=str_replace("/images/igallery","/web/images/igallery",$foto);
						 $foto=substr($foto,1);
						 $foto=str_replace("-150-100","-800-600",$foto);
						 $foto=str_replace("-140-90","-800-600",$foto);
						 $foto=substr($foto,0,-6).".jpg";
					 }else $foto=str_replace("/admin","admin",$foto);
				}else $foto="web/images/regate/rolexswancup2015.jpg";	
					
				$titolo_regata=$value_c->nome_regata." - ".$value_c->luogo." ".$anno;
				if($lingua=="eng") $link_regata="en/"; else  $link_regata="";
				if($value_c->link_esterno && trim($value_c->link_esterno)!=""){
					$link_regata=$value_c->link_esterno;
					if($lingua=="eng" &&  $value_c->link_esterno_eng && trim($value_c->link_esterno_eng)!="") $link_regata=$value_c->link_esterno_eng.'" target="_blank';
				}else{
					if($lingua=="ita"){
						$link_regata.="regate-$anno/".creaSlug($value_c->nome_regata,"")."-".$value_c->id.".html";	
					}else{
						$link_regata.="regattas-$anno/".creaSlug($value_c->nome_regata,"")."-".$value_c->id.".html";
					}
				}			
			@endphp
			@php $grid_order_right = $order_right * 2 + 2; $order_right++; @endphp
			<div class="regata regataDesk" data-grid-order="{{ $grid_order_right }}" <?php if($y>4){?>style="visibility:hidden"<?php }?>>
				<a href="{{ $link_regata }}" alt="{{ $titolo_regata }}" @if($value_c->link_esterno && trim($value_c->link_esterno)!="") target="_blank" @endif>
					<div style="width:100%; aspect-ratio: 3 / 2; position:relative; overflow:hidden;">
						<img style="width:100%; height:100%; object-fit:cover;" src=" {{ smartAsset($foto); }}" class="news-hero-image">
					</div>
				</a>
				
				<div class="news-hero-title" style="color:var(--azzurro); font-weight:600; margin:10px 0 5px; height:40px;">
					{{ $value_c->nome_regata }}
				</div>
				<div class="news-hero-title" style="color:#000;">
					<?php if($lingua=="ita"){?>dal<?php }else{?>from<?php }?> {{ $data_dal }} <?php if($lingua=="ita"){?>al<?php }else{?>to<?php }?> {{ $data_al }}<br/>
					{{ $value_c->luogo }}
				</div>	
				<a href="{{ $link_regata }}" @if($value_c->link_esterno && trim($value_c->link_esterno)!="") target="_blank" @endif class="link-arrow" style="width:158px; margin-top:10px; margin-right:20px;" alt="{{ $titolo_regata }}">
					<span>
						<?php if($lingua=="ita"){?>
							Dettagli regata
						<?php }else{?>
							Regatta details
						<?php }?>
					</span>
					<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
				</a>
			</div>
		@endif
		@php
			$z++; if($z==3) $z=1;
			$y++;
		@endphp
	@endforeach
</div>

<script>
	var altezza<?php echo $anno;?> = $(".colRegRight<?php echo $anno;?>").outerHeight();
	document.getElementById('calendarioRegate').style.minHeight=(parseInt(altezza<?php echo $anno;?>)+parseInt("550"))+"px";
	
	var regateLeft<?php echo $anno;?> = document.querySelectorAll('.colRegLeft<?php echo $anno;?> .regata');				 
	regateLeft<?php echo $anno;?>.forEach((el, idx) => {
		setTimeout(() => {
			el.classList.add('visible');
		}, 800 + ((idx-1) * 300));
	});
	var regateRight<?php echo $anno;?> = document.querySelectorAll('.colRegRight<?php echo $anno;?> .regata');				 
	regateRight<?php echo $anno;?>.forEach((el, idx) => {
		setTimeout(() => {
			el.classList.add('visible');
		}, 1000 + ((idx-1) * 300));
	});
	
	
	var altezzaBox = $(".colRegLeft<?php echo $anno;?> .regata").first().outerHeight()+{{ $gap }};
	
	var position = 0;

	function setArrowDownState(active) {
	  document.querySelectorAll('.arrow-down').forEach(function(el) {
	    el.style.opacity = active ? "1" : "0.5";
	    el.style.cursor = active ? "pointer" : "default";
	  });
	}
	function setArrowUpState(active) {
	  document.querySelectorAll('.arrow-up').forEach(function(el) {
	    el.style.opacity = active ? "1" : "0.5";
	    el.style.cursor = active ? "pointer" : "default";
	  });
	}

	function sali(anno) {
	  const regateLeft = document.querySelectorAll('.colRegLeft' + anno + ' .regata:not(.regataMob)');
	  const regateRight = document.querySelectorAll('.colRegRight' + anno + ' .regata');
	  const conteggio = regateLeft.length;
		
	  if (position + 3 >= conteggio){
		  setArrowDownState(false);
	  }else{
		  setArrowDownState(true);
	  }
	  
	  if (position + 2 >= conteggio){
		  return;
	  }
	  
	  position++;
	  
	  if(position>0){
		  setArrowUpState(true);
	  }

	  regateLeft.forEach((regata, idx) => {
		setTimeout(() => {
		  if (idx === position || idx === position + 1) {
			$(regata).css({
			  "opacity": "1",
			  "visibility": "visible"
			});
		  } else {
			$(regata).css({
			  "opacity": "0",
			  "visibility": "hidden"
			});
		  }
		  $(regata).css({
			"transform": "translateY(-" + (position * altezzaBox) + "px)",
			"transition": "all 1s ease"
		  });
		}, idx * 100);
		
	  });

	  var conteggioRight = regateRight.length;
	  var altezzaBoxRight = conteggioRight > 0 ? ($(".colRegRight" + anno + " .regata").first().outerHeight() || 0) + {{ $gap }} : altezzaBox;
	  var translateRight = position * altezzaBoxRight;
	  setTimeout(() => {
		regateRight.forEach((regata, idx) => {
		  setTimeout(() => {
			if (idx === position || idx === position + 1) {
			  $(regata).css({
				"opacity": "1",
				"visibility": "visible"
			  });
			} else {
			  $(regata).css({
				"opacity": "0",
				"visibility": "hidden"
			  });
			}
			$(regata).css({
			  "transform": "translateY(-" + translateRight + "px)",
			  "transition": "all 1s ease"
			});
		  }, idx * 100);
		});
	  }, 200); 
	}


	
	function scendi(anno) {
	  const regateLeft = Array.from(document.querySelectorAll('.colRegLeft' + anno + ' .regata:not(.regataMob)'));
	  const regateRight = Array.from(document.querySelectorAll('.colRegRight' + anno + ' .regata'));
	  const conteggio = regateLeft.length;
	  const conteggioRight = regateRight.length;

	  if (position <= 0) return;
	  
	  position--;
      
	  if(position < conteggio - 1){
		  setArrowDownState(true);
	  }
	  if (position === 0){
		  setArrowUpState(false);
	  }
	  
	  // Left: aggiorna in ordine inverso per evitare flash
	  regateLeft.reverse().forEach((regata, idx) => {
		setTimeout(() => {
		  const realIndex = conteggio - 1 - idx;
		  if (realIndex === position || realIndex === position + 1) {
			$(regata).css({
			  "opacity": "1",
			  "visibility": "visible"
			});
		  } else {
			$(regata).css({
			  "opacity": "0",
			  "visibility": "hidden"
			});
		  }
		  $(regata).css({
			"transform": "translateY(-" + (position * altezzaBox) + "px)",
			"transition": "all 1s ease"
		  });
		}, idx * 50);
	  });

	  // Right: usa idx della colonna destra; translate senza offset così il margin-top:60px del contenitore resta
	  var altezzaBoxRight = conteggioRight > 0 ? ($(".colRegRight" + anno + " .regata").first().outerHeight() || 0) + {{ $gap }} : altezzaBox;
	  var translateRight = position * altezzaBoxRight;
	  regateRight.forEach((regata, idx) => {
		setTimeout(() => {
		  var visible = (idx === position || idx === position + 1);
		  $(regata).css({
			"opacity": visible ? "1" : "0",
			"visibility": visible ? "visible" : "hidden",
			"transform": "translateY(-" + translateRight + "px)",
			"transition": "all 1s ease"
		  });
		}, idx * 50);
	  });
	}

	// Stato iniziale frecce al caricamento contenuto
	setArrowUpState(false);
	setArrowDownState(document.querySelectorAll('.colRegLeft<?php echo $anno;?> .regata:not(.regataMob)').length > 2);
</script>