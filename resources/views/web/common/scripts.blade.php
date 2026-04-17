<!--Plugins-->

<script src="{!! asset('web/js/plugins.js') !!}"></script>
<!--Template functions-->
<script src="{!! asset('web/js/functions.js') !!}"></script>

<?php if($cmd=="magazine_dett" || $cmd=="sail_talk_dett" || $cmd=="40_anni_di_azzurra"){?>
	<script src="{!! asset('web/js/jquery.imageScroll.js') !!}"></script>
	<script>
		$('.img-holder').imageScroll({
		//            image: null,
		//            imageAttribute: 'image',
		//            container: $('body'),
		//            windowObject: $(window),
		//            speed:.2,
		//            coverRatio:.75,
		//            coverRatio:1,
		//            holderClass: 'imageHolder',
		//            imgClass: 'img-holder-img',
		//            holderMinHeight: 200,
		//            holderMaxHeight: null,
		            extraHeight: 0,
		//            mediaWidth: 1600,
		            mediaHeight: 900,
		//            parallax: true,
		//            touch: false
		});
	</script>
<?php }?>

<?php if($cmd=="reservation-request" || $cmd=="yccs-sailing-school-iscrizioni" || $cmd=="new_modulo_iscrizione" || $cmd=="registrazione-giornalisti"){?>
	<script src="resarea/jui/js/jquery-ui-1.9.2.min.js"></script>
	
	<script type="text/javascript">
		$.datepicker.setDefaults( $.datepicker.regional[ "it" ] );
		$( ".mws-datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
	</script>
<?php }if($cmd=="new_modulo_iscrizione"){?>
	<script type="text/javascript">
		$( ".mws-datepicker2" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( ".mws-datepicker3" ).datepicker({ dateFormat: 'dd-mm-yy' });
	</script>
<?php }?>

<script src="https://connect.facebook.net/it_IT/all.js#xfbml=1"></script>