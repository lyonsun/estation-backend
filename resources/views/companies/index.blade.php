@extends('layout')

@section('content')

<h1 class="text-3xl py-8">Companies</h1>

<div class="pb-8">
    <a href="{{ route('companies.create') }}" class="btn btn-success bg-emerald-400 text-white p-4 text-lg rounded hover:bg-emerald-500">Create new company</a>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success bg-emerald-400 text-white p-4 rounded mb-4">
    <p>{{ $message }}</p>
</div>
@endif

<div class="company-list">

    <div class="list-heading bg-zinc-700 text-white border p-2 grid grid-cols-3 gap-4">
        <div class="list-heading-item">Name</div>
        <div class="list-heading-item">Parent company</div>
        <div class="list-heading-item">Action</div>
    </div>

    @foreach ($companies as $company)
    <div class="company-item border-b border-x p-2 grid grid-cols-3 gap-4">
        <p>{{$company->name}}</p>

        @if ($company->parent != null)
        <p>{{$company->parent->name}}</p>
        @else
        <p>-</p>
        @endif

        <div class="flex gap-4">
            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-info text-blue-400">Edit</a>

            <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger text-red-400" type="submit">Delete</button>
            </form>
        </div>

    </div>
    @endforeach

</div>

@endsection