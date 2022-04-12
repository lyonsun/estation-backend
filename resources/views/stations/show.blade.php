@extends('layout')

@section('content')

<h1 class="text-3xl py-8">{{$station->name}}</h1>

<div class="pb-8">
    <a href="{{ route('stations.index') }}" class="btn btn-success py-2 text-lg underline">Back to station list</a>
</div>

<p>{{ $station->name }}</p>
<p>{{ $station->address }}</p>
<p>{{ $station->latitude }}</p>
<p>{{ $station->longitude }}</p>
<p>{{ $station->company->name }}</p>

@endsection