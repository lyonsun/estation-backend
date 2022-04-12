@extends('layout')

@section('content')

<h1 class="text-3xl py-8">Stations</h1>

<div class="pb-8">
    <a href="{{ route('stations.create') }}" class="btn btn-success bg-emerald-400 text-white p-4 text-lg rounded hover:bg-emerald-500">Create new station</a>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success bg-emerald-400 text-white p-4 rounded mb-4">
    <p>{{ $message }}</p>
</div>
@endif

<div class="station-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

    @foreach ($stations as $station)
    <div class="station-item p-4 border rounded shadow-lg">
        <div class="text-lg font-bold">{{$station->name}}</div>
        <div>Address: {{$station->address}}</div>
        <div>Latitude: {{$station->latitude}}</div>
        <div>Longitude: {{$station->longitude}}</div>
        <div>Company: {{$station->company->name}}</div>

        <div class="flex gap-4 mt-4">
            <a href="{{ route('stations.edit', $station->id) }}" class="btn btn-info bg-blue-400 text-white p-2 rounded hover:bg-blue-500">Edit</a>
            <form action="{{ route('stations.destroy', $station->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger bg-red-400 text-white p-2 rounded hover:bg-red-500" type="submit">Delete</button>
            </form>
        </div>
    </div>
    @endforeach

</div>

@endsection