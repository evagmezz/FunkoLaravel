@php use App\Models\Funko; @endphp
@extends('main')

@section('title', 'Funkolandia')

@section('content')
    <div class="container">
        <form action="{{ route('funkos.index')}}" class="mb-3 mx-auto" method="get"
              style="width: 50%; margin-top: 20px;">
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search" placeholder="Name">
            </div>
        </form>
        @if (count($funkos) > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center">Image</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($funkos as $funko)
                    <tr>
                        <td class="text-center"><a href="{{ route('funkos.show', $funko->id) }}"><img src="{{ asset('storage/funko/' . $funko->image) }}"
                                                     alt="Image of funko" style="width: 100px;"></a></td>
                        <td class="text-center">{{ $funko->name }}</td>
                        <td class="text-center">&euro;{{ $funko->price }}</td>
                        <td class="text-center">
                            <a href="{{ route('funkos.show', $funko->id) }}" class="btn btn-pink">Details</a>
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <a href="{{ route('funkos.edit', $funko->id) }}" class="btn btn-gray">Edit</a>
                            @endif
                                <a href="{{ route('funkos.editImg', $funko->id) }}" class="btn btn-pink">Image</a>
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <form action="{{ route('funkos.destroy', $funko->id) }}" method="POST"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-gray"
                                            onclick="return confirm('Are you sure you want to delete this funko?');">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class='lead text-center'><em>There are no funkos to display</em></p>
        @endif
        <div class="pagination-container my-custom-class">
            {{ $funkos->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
