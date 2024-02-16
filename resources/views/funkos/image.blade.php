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
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <input accept="image/*" class="form-control-file" id="image" name="image" required type="file">
                        <small class="text-danger"></small>
                        <input name="id" value="{{ $funko->id }}" type="hidden">
                    </div>

                    <button class="btn btn-pink" type="submit">Update</button>
                    <a class="btn btn-gray" href="{{ route('funkos.index') }}">Back</a>
                </form>
            </div>
        </div>
    </div>
    </body>
@endsection

