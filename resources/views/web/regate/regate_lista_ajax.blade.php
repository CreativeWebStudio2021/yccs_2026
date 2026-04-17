<?php
$_GET['anno'] ? $anno = $_GET['anno'] : '';
$_GET['box'] ? $box = $_GET['box'] : '';
$_GET['lingua'] ? $lingua = $_GET['lingua'] : 'ita';
?>
<style>
	.<?php echo $box;?> .list-link{
		transform:translateY(100px);
		opacity:0;
		transition: all 1s ease
	}
	.listaNomiRegate{
		margin-top:50px;
		display:flex;
		gap:5px;
		flex-direction:column;
		padding-bottom:50px;
	}
	@media screen and (max-width:800px) {
		.listaNomiRegate{
			padding-bottom:0;
		}
	}
</style>
<div class="bigAnno">
	<?php echo $anno;?>
</div>
<div style="padding-right:0px; margin-top:10px;">
	@if($lingua=="ita")
		Lo Yacht Club organizza <span style="color:var(--azzurro); font-weight:600;">regate</span> durante la stagione estiva e offre ai propri soci, ai loro ospiti e agli armatori servizi pregiati presso la struttura di Porto Cervo.
	@else
		The Yacht Club organizes <span style="color:var(--azzurro); font-weight:600;">regattas</span> during the summer season and offers its members, their guests, and boat owners premium services at the Porto Cervo facility.
	@endif
	
	<div <?php /*class="listaRegateDesk"*/?>>
		<div class="listaNomiRegate">
			@php
				$query_c = DB::table('edizioni_regate');
				$query_c = $query_c->select('*');
				$query_c = $query_c->where('anno','=',$anno);
				$query_c = $query_c->orderby('data_dal','ASC');
				$query_c = $query_c->get();
			@endphp
			
			@foreach($query_c AS $key_c=>$value_c)
				@php
					$link_regata = "regate-".$anno."/".creaSlug($value_c->nome_regata)."-".$value_c->id.".html";
					$link_regata_eng = "regattas-".$anno."/".creaSlug($value_c->nome_regata)."-".$value_c->id.".html";
					if($lingua=="eng")
						$link_regata = "en/".$link_regata_eng;
					$title_regata = $value_c->nome_regata." - ".config('app.name');
				@endphp
				<a href="{{ $link_regata }}" title="{{ $title_regata }}">
					<div class="list-link" style="align-items:flex-start;">
						<img src="{{ asset('web/images/star_grey.png') }}" alt="" class="list-icon"/>
						<span style="font-size:16px;">{!! $value_c->nome_regata !!}</span>
					</div>		
				</a>			
			@endforeach
		</div>
	</div>
	
</div>
<script>
	altezza = $(".<?php echo $box;?>").outerHeight();
	document.getElementById('boxRegate').style.height=altezza+"px";
	
	setTimeout(() => {
		$(".<?php echo $box;?> .list-link").css({			  
		  "transform": "translateY(0px)",
		  "opacity": "1"
		});
	}, 500);
</script>