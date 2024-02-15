@php use App\Models\Funko; @endphp
@extends('main')

@section('title', 'Tienda de Funkos')

@section('content')


    <form  action="{{ route('funkos.index')}}" class="mb-3 mx-auto" method="get" style="width: 50%; margin-top: 20px;">
        <div class="input-group">
            <input type="text" class="form-control" id="search" name="search" placeholder="Name">
        </div>
    </form>
    @if (count($funkos) > 0)
   <table class="table mx-auto" style="width: 80%;">
       <thead>
       <tr class="table-primary">
           <th class="text-center">Name</th>
           <th class="text-center">Price</th>
           <th class="text-center">Image</th>
           <th class="text-center">Actions</th>
       </tr>
       </thead>
       <tbody>
         @foreach ($funkos as $funko)
       <tr class="table-secondary">
           <td class="text-center">{{ $funko->name }}</td>
           <td class="text-center">{{ $funko->price }}</td>
           <td class="text-center">
               @if($funko->image != Funko::$IMAGE_DEFAULT)
                   <img alt="Imagen del funko" height="50" src="{{ asset('storage/funko/' . $funko->image) }}"
                        width="50">
               @else
                   <img alt="Imagen por defecto" height="50" src="{{ Funko::$IMAGE_DEFAULT }}"
                        width="50">
               @endif
           </td>
           <td class="text-center">
               <a class="btn btn-primary btn-sm"
                  href="{{ route('funkos.show', $funko->id) }}">Detalles</a>
               <a class="btn btn-secondary btn-sm"
                  href="{{ route('funkos.edit', $funko->id) }}">Editar</a>

               <a class="btn btn-info btn-sm"
                  href="{{ route('funkos.editImg', $funko->id) }}">Imagen</a>
               <form action="{{ route('funkos.destroy', $funko->id) }}" method="POST"
                     style="display: inline;">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Estás seguro de que deseas borrar este producto?')">Borrar
                   </button>
               </form>
           </td>
       </tr>
         @endforeach
       </tbody>
   </table>
    @else
        <p class='lead'><em>No se ha encontrado datos de funkos.</em></p>
    @endif
    <div class="pagination-container">
        {{ $funkos->links('pagination::bootstrap-5') }}
    </div>
@endsection
