@php use App\Models\Funko; @endphp
@extends('main')

@section('title', 'Edit')

@section('content')

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
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <h1 class="text-center">Update Funko</h1>

                <form  action="{{ route("funkos.update", $funko->id) }}" method="post" class="p-5 blue-background rounded">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $funko->id }}">

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input class="form-control" id="name" name="name" type="text" required
                               value="{{ $funko->name }}">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input class="form-control" id="stock" name="stock" type="number" step="0.01" required
                               value="{{ $funko->stock }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input class="form-control" id="price" name="price" type="number" step="0.01" required
                               value="{{ $funko->price }}">
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                                <option @if($funko->category->id == $category->id) selected
                                        @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-pink btn-block" type="submit">Update</button>
                    <a class="btn btn-gray btn-block mt-2" href="{{ route('funkos.index') }}">Back</a>
                </form>
            </div>
        </div>
    </div>
    </body>
@endsection
