@extends('layouts.app')

@section('content')

@foreach($tani as $tani)
	<p>{{$tani->title}}</p>
	<a href="/produkTani/{{$tani->id}}" class="btn btn-info" role="button">Detail</a>
	<hr>
@endforeach

@endsection