@php use App\Models\Category; @endphp
@extends('main')

@section('title', 'Categories')

@section('content')

    <div class="container">
        <table class="table table-striped mx-auto mt-4" style="width: 100%;">
            <thead>
            <tr>
                <th class="text-center">Category Name</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ( count($categories ?? []) > 0 )
                @foreach ($categories as $category)
                    <tr>
                        <td class="text-center">{{ $category->name }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('category.show', $category->id) }}" class="btn btn-pink mr-2">Details</a>
                                <a href="{{ route('category.create', $category->id) }}" class="btn btn-gray mr-2">Create</a>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-pink mr-2">Update</a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-gray mr-2"
                                            onclick="return confirm('¿Estás seguro de que deseas borrar esta categoría?');">
                                        Delete
                                    </button>
                                </form>
                                <form action="{{ route('category.activate', $category->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-pink"
                                            onclick="return confirm('¿Estás seguro de que deseas activar esta categoría?');">
                                        Activate
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center"><p class='lead'><em>No se han encontrado categorías</em></p></td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
