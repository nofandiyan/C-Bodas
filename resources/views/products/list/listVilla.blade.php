@extends('layouts.app')

@section('content')

@foreach($villa as $villa)
	<p>{{$villa->title}}</p>
	<p>{{$villa->desc}}</p>
	<p>{{$villa->street}}</p>
	<p>{{$villa->village}}</p>
	<p>{{$villa->city}}</p>
	<p>{{$villa->prov}}</p>
	<p>{{$villa->zipCode}}</p>
	<p>{{$villa->dateOrdered}}</p>
	<p>{{$villa->price}}</p>
	<a href="/produkVilla/{{$villa->id}}" class="btn btn-info" role="button">Detail</a>
	<hr>
@endforeach

@endsection