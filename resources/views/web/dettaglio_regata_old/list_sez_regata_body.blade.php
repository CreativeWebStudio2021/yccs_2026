<div class="tab-pane fade <?php if($active=="info"){?>show active<?php }?>" id="info{{$tipo}}" role="tabpanel" aria-labelledby="home-tab">
	@include('web.dettaglio_regata_old.info')
</div>
<div class="tab-pane fade <?php if($active=="documenti"){?>show active<?php }?>" id="documenti{{$tipo}}" role="tabpanel" aria-labelledby="profile-tab">
	@include('web.dettaglio_regata_old.documenti')
</div>
<div class="tab-pane fade <?php if($active=="iscritti"){?>show active<?php }?>" id="iscritti{{$tipo}}" role="tabpanel" aria-labelledby="contact-tab">
	@include('web.dettaglio_regata_old.iscritti')
</div>
<div class="tab-pane fade <?php if($active=="risultati"){?>show active<?php }?>" id="risultati{{$tipo}}" role="tabpanel" aria-labelledby="contact-tab">
	@include('web.dettaglio_regata_old.risultati')
</div>
<div class="tab-pane fade <?php if($active=="stampa"){?>show active<?php }?>" id="stampa{{$tipo}}" role="tabpanel" aria-labelledby="contact-tab">
	@include('web.dettaglio_regata_old.stampa')
</div>
<div class="tab-pane fade <?php if($active=="foto"){?>show active<?php }?>" id="foto{{$tipo}}" role="tabpanel" aria-labelledby="contact-tab">
	@if($active=="foto")
		@include('web.dettaglio_regata_old.foto')
	@endif
</div>
<div class="tab-pane fade <?php if($active=="video"){?>show active<?php }?>" id="video{{$tipo}}" role="tabpanel" aria-labelledby="contact-tab">
	@include('web.dettaglio_regata_old.video')
</div>
@if($crew_board==1)
	<div class="tab-pane fade <?php if($active=="crew_board"){?>show active<?php }?>" id="crew_board{{$tipo}}" role="tabpanel" aria-labelledby="contact-tab">
		@include('web.dettaglio_regata_old.crew_board')
	</div>
@endif