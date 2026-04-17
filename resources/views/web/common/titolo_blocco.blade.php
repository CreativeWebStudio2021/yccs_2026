@php
	if(!isset($color_titolo_1)) $color_titolo_1 = "#BBBBBB";
	if(!isset($color_titolo_2)) $color_titolo_2 = "#fff";
@endphp
<style>
	.titolo_blocco_testo{width:50%; }
	@media screen AND (max-width:1024px){
		.titolo_blocco_testo{width:70%;}
	}
	@media screen AND (max-width:650px){
		.titolo_blocco_testo{width:80%;}
	}	
</style>
<div style=" margin:20px auto 40px; border-top:solid 1px <?php echo $color_titolo_1;?>; position:relative;" class="titolo_blocco_testo">
	<div style="position:absolute; top:-18px; width:100%;  text-align:center;">
		<h4 style="color:{{ $color_titolo_1 }}; display:inline; background:{{ $color_titolo_2 }}; text-transform: uppercase; font-family:'Open Sans'; font-weight:400; font-size:19px">&nbsp;&nbsp;{{ $titolo_blocco }}&nbsp;&nbsp;</h4>
	</div>
</div>