@extends('web.index')

@section('content')
	@if($conferenza==0)
		@include('web.young-azzurra-gallery-dett_old')		
	@else
		@include('web.young-azzurra-gallery-dett_new')				
	@endif
@endsection