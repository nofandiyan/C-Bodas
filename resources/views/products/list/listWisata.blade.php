@extends('layouts.app')

@section('content')

@foreach($wisata as $wisata)
	<p>{{$wisata->title}}</p>
	<p>{{$wisata->desc}}</p>
	<p>{{$wisata->street}}</p>
	<p>{{$wisata->village}}</p>
	<p>{{$wisata->city}}</p>
	<p>{{$wisata->prov}}</p>
	<p>{{$wisata->zipCode}}</p>
	<p>{{$wisata->ticketStock}}</p>
	<p>{{$wisata->price}}</p>
	<a href="/produkWisata/{{$wisata->id}}" class="btn btn-info" role="button">Detail</a>
	<hr>
@endforeach

@endsection