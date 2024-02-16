@php use App\Models\Category; @endphp
@extends('main')

@section('title', 'Create Category')

@section('content')

    <div class="container py-5 mb-5">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br/>
        @endif
        <form action="{{ route('category.store') }}" method="POST" class="blue-background p-5 rounded">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}">
            </div>
            <button type="submit" class="btn btn-pink mt-3">Create</button>
            <a class="btn btn-gray mt-3" href="{{ route('category.index') }}">Back</a>
        </form>
    </div>
@endsection
