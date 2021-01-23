@extends('layouts.main')

@section('content-main')
    <div class="container mb-5">
        <h1>{{ $classroom->name }} details</h1>
        <h6>ID: {{ $classroom->id }}</h6>
        <a  class="btn btn-primary" href="{{ route('classrooms.edit', $classroom->id) }}">Edit</a>
        <hr>

        <p>{{ $classroom->description }}</p>
        <hr>

        {{-- <div class="mb-3">Created at: {{ $classroom->created_at->format('l d/m/Y') }}</div> --}}
        {{-- Formato data ita --}}
        <div class="mb-3">Created at: {{ $classroom->created_at->isoFormat('dddd DD/MM/YYYY') }}</div>
        <div class="mb-3">Updated at: {{ $classroom->updated_at->diffForHumans() }}</div>
    </div>
@endsection