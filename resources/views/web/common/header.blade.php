@php
	if(!isset($conferenza)){
		$data_conferenza = "2022-04-06 09:00:00";
		if(date("Y-m-d H:i:s")<$data_conferenza) $conferenza=0;
		else $conferenza=1;	
	}
	
	$query_s = DB::table('magazine_stato')
		->select('stato')
		->where('id', '=', '1')
		->get();
		
	$stato = $query_s[0]->stato;
	
	$query_s = DB::table('sail_talk_stato')
		->select('stato')
		->where('id', '=', '1')
		->get();
	
	$stato_sail_talk = $query_s[0]->stato;
@endphp

<style>
	#headerDesk{display:block}
	#headerMob{display:none}
	@media screen AND (max-width:1023px){
		#headerDesk{display:none}
		#headerMob{display:block}
	}
</style>
<div id="headerDesk">
	@include('web.common.headerDesk')
</div>
<div id="headerMob">
	@include('web.common.headerMob')
</div>