<style>
	.tabs .nav-tabs .nav-link{color:#111;font-weight:bold; text-transform:uppercase;}
	@media screen AND (max-width:1560px){
		.tabs .nav-tabs .nav-link{padding:20px;}
	}
	@media screen AND (max-width:1450px){
		.tabs .nav-tabs .nav-link{padding:11px;}
	}
	@media screen AND (max-width:1200px){
		.tabs .nav-tabs .nav-link{padding:8px; font-size:0.85em}
	}
</style>
@php $link_tab_new = str_replace('/'.$active.'/','/info/',$link_tab) @endphp
<li class="nav-item" <?php if($active=="info"){?>class="active"<?php }?> <?php if($num_info>0){?>onmousedown="cambia_tab('info',1); window.history.pushState({},'','<?php echo $link_tab_new;?>');"<?php }?>>
	<a class="nav-link <?php if($active=="info"){?>active<?php }?> <?php if($num_info==0){?> disabled<?php }?>" id="home-tab" data-toggle="tab" href="#info{{$tipo}}" role="tab" aria-controls="home" aria-selected="true">Info</a>
</li>
@php $link_tab_new = str_replace('/'.$active.'/','/documenti/',$link_tab) @endphp
<li class="nav-item" <?php if($active=="documenti"){?>class="active"<?php }?> <?php if($num_documenti>0){?>onmousedown="cambia_tab('documenti',1); window.history.pushState({},'','<?php echo $link_tab_new;?>');"<?php }?>>
	<a class="nav-link <?php if($active=="documenti"){?>active<?php }?> <?php if($num_documenti==0){?> disabled<?php }?>" id="profile-tab" data-toggle="tab" href="#documenti{{$tipo}}" role="tab" aria-controls="profile" aria-selected="false"><?php if($lingua=="ita"){?>Documenti<?php }else{?>Documents<?php }?></a>
</li>
@php $link_tab_new = str_replace('/'.$active.'/','/iscritti/',$link_tab) @endphp
<li class="nav-item" <?php if($active=="iscritti"){?>class="active"<?php }?> <?php if($num_iscritti>0){?>onmousedown="cambia_tab('iscritti',1); window.history.pushState({},'','<?php echo $link_tab_new;?>');"<?php }?>>
	<a class="nav-link <?php if($active=="iscritti"){?>active<?php }?> <?php if($num_iscritti==0){?> disabled<?php }?>" id="contact-tab" data-toggle="tab" href="#iscritti{{$tipo}}" role="tab" aria-controls="contact" aria-selected="false"><?php if($lingua=="ita"){?>Iscritti<?php }else{?>Entry List<?php }?></a>
</li>
@php $link_tab_new = str_replace('/'.$active.'/','/risultati/',$link_tab) @endphp
<li class="nav-item" <?php if($active=="risultati"){?>class="active"<?php }?> <?php if($num_risultati>0){?>onmousedown="cambia_tab('risultati',1); window.history.pushState({},'','<?php echo $link_tab_new;?>');"<?php }?>>
	<a class="nav-link <?php if($active=="risultati"){?>active<?php }?> <?php if($num_risultati==0){?> disabled<?php }?>" id="profile-tab" data-toggle="tab" href="#risultati{{$tipo}}" role="tab" aria-controls="profile" aria-selected="false"><?php if($lingua=="ita"){?>Risultati<?php }else{?>Results<?php }?></a>
</li>
@php $link_tab_new = str_replace('/'.$active.'/','/stampa/',$link_tab) @endphp
<li class="nav-item" <?php if($active=="stampa"){?>class="active"<?php }?> <?php if($num_stampa>0){?>onmousedown="cambia_tab('stampa',1); window.history.pushState({},'','<?php echo $link_tab_new;?>');"<?php }?>>
	<a class="nav-link <?php if($active=="stampa"){?>active<?php }?> <?php if($num_stampa==0){?> disabled<?php }?>" id="profile-tab" data-toggle="tab" href="#stampa{{$tipo}}" role="tab" aria-controls="profile" aria-selected="false"><?php if($lingua=="ita"){?>Stampa<?php }else{?>Press Release<?php }?></a>
</li>
@php $link_tab_new = str_replace('/'.$active.'/','/foto/',$link_tab) @endphp
<li class="nav-item" <?php if($active=="foto"){?>class="active"<?php }?> <?php if($num_foto>0){?>onmousedown="cambia_tab('foto',1); <?php if($active=="foto"){?>window.history.pushState({},'','<?php echo $link_tab_new;?>');<?php }else{?>window.location='<?php echo $link_tab_new;?>';<?php }?>"<?php }?>>
	<a class="nav-link <?php if($active=="foto"){?>active<?php }?> <?php if($num_foto==0){?> disabled<?php }?>" id="profile-tab" data-toggle="tab" href="#foto{{$tipo}}" role="tab" aria-controls="profile" aria-selected="false"><?php if($lingua=="ita"){?>Foto<?php }else{?>Photo<?php }?></a>
</li>
@php $link_tab_new = str_replace('/'.$active.'/','/video/',$link_tab) @endphp
<li class="nav-item" <?php if($active=="video"){?>class="active"<?php }?> <?php if($num_video>0){?>onmousedown="cambia_tab('video',1); window.history.pushState({},'','<?php echo $link_tab_new;?>');"<?php }?>>
	<a class="nav-link <?php if($active=="video"){?>active<?php }?> <?php if($num_video==0){?> disabled<?php }?>" id="profile-tab" data-toggle="tab" href="#video{{$tipo}}" role="tab" aria-controls="profile" aria-selected="false">Video</a>
</li>
@if($crew_board==1)
	@php $link_tab_new = str_replace('/'.$active.'/','/crew_board/',$link_tab) @endphp
	<li class="nav-item" <?php if($active=="crew_board"){?>class="active"<?php }?> <?php if($num_info>0){?>onmousedown="cambia_tab('crew_board',1); window.history.pushState({},'','<?php echo $link_tab_new;?>');"<?php }?>>
		<a class="nav-link <?php if($active=="crew_board"){?>active<?php }?>" id="profile-tab" data-toggle="tab" href="#crew_board{{$tipo}}" role="tab" aria-controls="profile" aria-selected="false">Crew/Boat Board</a>
	</li>
@endif