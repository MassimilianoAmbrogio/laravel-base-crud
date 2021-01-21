@extends('layouts.main')

@section('content-main')
    <div class="container mb-5">
        <h1>Create a new Classroom</h1>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('classrooms.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="name">Classroom name</label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="description">Classroom description</label>
                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Create">
            </div>
        </form>
    </div>
@endsection