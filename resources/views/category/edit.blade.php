@php use App\Models\Category; @endphp
@extends('main')

@section('title', 'Edit Category')

@section('content')
    <div class="container py-5 mb-5">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
            <br/>
        @endif
        <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data"
              id="formEditCat" class="blue-background p-5 rounded">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $category->id }}">

            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="name" type="text" required
                       value="{{ $category->name }}">
            </div>
            <button form="formEditCat" class="btn btn-pink mt-3" type="submit">Update</button>
            <a class="btn btn-gray mt-3" href="{{ route('category.index') }}">Back</a>
        </form>
    </div>
@endsection
