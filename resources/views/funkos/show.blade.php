@php use App\Models\Funko; @endphp
@extends('main')

@section('title', 'Detalles')

@section('content')

    <div class="card mx-auto my-5 col-md-6">
        <div class="card-header text-center">
            <h1>{{ $funko->name }}</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $funko->id }}</dd>
                        <dt>Stock:</dt>
                        <dd>{{ $funko->stock }}</dd>
                        <dt>Price:</dt>
                        <dd>{{ $funko->price }}</dd>
                        <dt>Category:</dt>
                        <dd>{{ $funko->category->name }}</dd>
                    </dl>
                </div>
                <div class="col-sm-6">
                    @if($funko->image != Funko::$IMAGE_DEFAULT)
                        <img alt="Imagen del funko" class="img-fluid"
                             src="{{ asset('storage/funko/' . $funko->image) }}">
                    @else
                        <img alt="Imagen por defecto" class="img-fluid" src="{{ Funko::$IMAGE_DEFAULT }}">
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-primary" href="{{ route('funkos.index') }}">Volver</a>
        </div>
    </div>
@endsection
