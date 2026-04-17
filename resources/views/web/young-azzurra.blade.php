@extends('web.index')

@section('content')
	@if($conferenza==0)
		@include('web.young-azzurra_old')		
	@else
		@include('web.young-azzurra_new')				
	@endif
@endsection
