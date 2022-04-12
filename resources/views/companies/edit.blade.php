@extends('layout')

@section('content')

<h1 class="text-3xl py-8">Edit company</h1>

<div class="pb-8">
    <a href="{{ route('companies.index') }}" class="btn btn-success py-2 text-lg underline">Back to company list</a>
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

<form action="{{ route('companies.update', $company->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="flex gap-4 mb-4">
        <label for="name">Name</label>
        <input class="border rounded" type="text" name="name" id="name" value="{{ $company->name }}">
    </div>

    <div class="flex gap-4 mb-4">
        <label for="parent_company_id">Parent company</label>
        <select class="border rounded" name="parent_company_id" id="parent_company_id">
            <option value="">--SELECT--</option>
            @foreach ($companies as $available_company)
            @if ($company->id !== $available_company->id && $available_company->parent_company_id !== $company->id)
            <option @selected($company->parent_company_id === $available_company->id) value="{{$available_company->id}}">{{$available_company->name}}</option>
            @endif
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit" class="btn btn-success bg-emerald-400 text-white px-6 py-1.5 text-lg rounded hover:bg-emerald-500">Update</button>
    </div>
</form>

@endsection