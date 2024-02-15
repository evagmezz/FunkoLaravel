@php use App\Models\Funko; @endphp
@extends('main')

@section('title', 'Imagen de Funko')

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

        <div class="card mx-auto my-5 col-md-6">
            <div class="card-header text-center">
                <h1>{{ $funko->name }}</h1>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-2">Image:</dt>
                    <dd class="col-sm-10"> @if($funko->image != Funko::$IMAGE_DEFAULT)
                            <img alt="Imagen del funko" class="img-fluid"
                                 src="{{ asset('storage/funko/' . $funko->image) }}">
                        @else
                            <img alt="Imagen por defecto" class="img-fluid" src="{{ Funko::$IMAGE_DEFAULT }}">
                        @endif
                    </dd>
                </dl>

                <form action="{{ route("funkos.updateImg", $funko->id) }}" enctype="multipart/form-data"
                      method="post">
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input accept="image/*" class="form-control-file" id="image" name="image" required type="file">
                        <small class="text-danger"></small>
                        <input name="id" value="{{ $funko->id }}" type="hidden">
                    </div>

                    <button class="btn btn-primary" type="submit">Actualizar</button>
                    <a class="btn btn-primary" href="{{ route('funkos.index') }}">Volver</a>
                </form>
            </div>
        </div>
    </div>
    </body>
@endsection

