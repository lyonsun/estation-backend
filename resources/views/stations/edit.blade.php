@extends('layout')

@section('content')

<h1 class="text-3xl py-8">Edit station</h1>

<div class="pb-8">
    <a href="{{ route('stations.index') }}" class="btn btn-success py-2 text-lg underline">Back to station list</a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('stations.update', $station->id) }} " method="POST">
    @csrf
    @method('PUT')

    <div class="flex gap-4 mb-4">
        <label for="name">Name</label>
        <input class="border rounded" type="text" name="name" id="name" value="{{ $station->name }}">
    </div>

    <div class="flex gap-4 mb-4">
        <label for="address">Address</label>
        <input class="border rounded" type="text" name="address" id="address" value="{{ $station->address }}">
    </div>

    <div class="flex gap-4 mb-4">
        <label for="latitude">Latitude</label>
        <input class="border rounded" type="text" name="latitude" id="latitude" value="{{ $station->latitude }}">
    </div>

    <div class="flex gap-4 mb-4">
        <label for="longitude">Longitude</label>
        <input class="border rounded" type="text" name="longitude" id="longitude" value="{{ $station->longitude }}">
    </div>

    <div class="flex gap-4 mb-4">
        <label for="company_id">Company</label>
        <select class="border rounded" name="company_id" id="company_id">
            @foreach ($companies as $company)
            <option @selected($station->company->id === $company->id) value="{{$company->id}}">{{$company->name}}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit" class="btn btn-success bg-emerald-400 text-white px-6 py-1.5 text-lg rounded hover:bg-emerald-500">Update</button>
    </div>
</form>

@endsection