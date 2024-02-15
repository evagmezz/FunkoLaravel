@php use App\Models\Funko; @endphp
@extends('main')

@section('title', 'Crear')

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
<div class="container py-5 md-5">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            <h1 class="text-center">Crear Funko</h1>

            <form action="{{ route('funkos.store') }}" enctype="multipart/form-data" method="POST">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input class="form-control" id="name" name="name" type="text" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input class="form-control" id="price" name="price" type="number" required
                           value="0">
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input class="form-control" id="stock" name="stock" type="number" required
                           value="0">
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <input accept="image/*" class="form-control-file" id="image" name="image" required type="file">
                    <small class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </div>

                <button class="btn btn-primary" type="submit">Crear</button>
                <a class="btn btn-primary" href="{{ route('funkos.index') }}">Volver</a>
            </form>
        </div>
    </div>
</div>
</body>
@endsection
