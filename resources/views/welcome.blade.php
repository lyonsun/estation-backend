@extends('layout')

@section('content')

<div class="py-10">
    <h2 class="text-2xl mb-8 text-center">Find the nearest charging stations</h2>
    <form class="filter-bar grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 items-center gap-8 mb-2" action="{{ route('home') }}" method="GET">
        <input id="input-latitude" class="p-2 rounded border text-xl" type="text" name="latitude" value="{{ $latitude }}" placeholder="Latitude">
        <input id="input-longitude" class="p-2 rounded border text-xl" type="text" name="longitude" value="{{ $longitude }}" placeholder="Longitude">
        <input id="input-radius" class="p-2 rounded border text-xl" type="text" name="radius" value="{{ $radius }}" placeholder="Radius Distance">
        <button id="btn-find-station" class="bg-emerald-400 text-white px-6 py-2 text-xl rounded flex justify-center items-center gap-2 hover:bg-emerald-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Find
        </button>
    </form>

    <small class="italic text-slate-600">You can get the latitude & longitude by right-clicking on a location in Google Maps. The radius distance should be a number in kilometer.</small>
</div>

<div class="stations-wrapper">

    @foreach ($stations as $address => $stations_in_address)
    <div class="text-xl shadow-md font-bold bg-emerald-400 text-white px-4 py-2 text-center">{{ $address }}</div>

    <div class="stations-list mt-5 mb-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($stations_in_address as $station)
        <div class="station-card p-4 border rounded shadow-lg">
            <div class="text-lg font-bold">{{$station->name}}</div>
            <div>Address: {{$station->address}}</div>
            <div>Latitude: {{$station->latitude}}</div>
            <div>Longitude: {{$station->longitude}}</div>
            <div>Distance (KM): {{$station->distance}}</div>
            <div>Company: {{$station->company->name}}</div>
            <hr class="my-4">
            <div>All stations owned by <b>{{$station->company->name}}</b> are:</div>
            <div class="flex flex-wrap gap-4 mt-2">
                @foreach ($station->all_company_stations as $company_station)
                <div class="p-2 bg-zinc-700 text-white rounded shadow-md hover:bg-zinc-800">
                    <a class="whitespace-nowrap" href="{{ route('stations.show', $company_station->id) }}">{{$company_station->name}}</a>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>

@endsection