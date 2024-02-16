@php use App\Models\Funko; @endphp
@extends('main')

@section('title', 'Details')

@section('content')

    <div class="card mx-auto my-5 col-md-6">
        <div class="card-header text-center">
            <h1>{{ $funko->name }}</h1>
        </div>
        <div class="card-body">
            @if($funko->image != Funko::$IMAGE_DEFAULT)
                <img alt="Imagen del funko" class="img-fluid mb-3" style="width: 80%;"
                src="{{ asset('storage/funko/' . $funko->image) }}">
            @else
                <img alt="Imagen por defecto" class="img-fluid mb-3" style="width: 80%;"
                src="{{ Funko::$IMAGE_DEFAULT }}">
            @endif
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>ID:</strong> {{ $funko->id }}</li>
                <li class="list-group-item"><strong>Stock:</strong> {{ $funko->stock }}</li>
                <li class="list-group-item"><strong>Price:</strong> &euro;{{ $funko->price }}</li>
                <li class="list-group-item"><strong>Category:</strong> {{ $funko->category->name }}</li>
            </ul>
        </div>
        <div class="card-footer text-center">
            <a class="btn btn-gray" href="{{ route('funkos.index') }}">Back</a>
        </div>
    </div>
@endsection
