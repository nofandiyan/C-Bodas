@extends('layouts.app')

@section('content')

@foreach($ternak as $ternak)
	<p>{{$ternak->title}}</p>
	<p>{{$ternak->desc}}</p>
	<p>{{$ternak->year}}</p>
	<p>{{$ternak->month}}</p>
	<p>{{$ternak->day}}</p>
	<p>{{$ternak->gender}}</p>
	<p>{{$ternak->weight}}</p>
	<p>{{$ternak->price}}</p>
	<a href="/produkTernak/{{$ternak->id}}" class="btn btn-info" role="button">Detail</a>
	<hr>
@endforeach

@endsection