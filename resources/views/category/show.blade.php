@php use App\Models\Category; @endphp
@extends('main')

@section('title', 'Details')

@section('content')

    <div class="container py-5 mb-5">
        <div class="card mx-auto my-5 col-md-6">
            <div class="card-header text-center">
                <h1>{{ $category->name }}</h1>
            </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <p class="mb-3"><strong>ID:</strong> {{ $category->id }}</p>
                            <p class="mb-3"><strong>Is Deleted:</strong> {{ $category->is_deleted  ? 'Yes' : 'No' }} </p>

                            <h4 class="mb-3">Funkos in this category:</h4>
                            <ul>
                                @foreach ($category->funkos as $funko)
                                    <li class="mb-1">{{ $funko->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-pink" href="{{ route('category.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
