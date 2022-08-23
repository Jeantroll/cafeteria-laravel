@extends('layouts.app')

@section('content')
    @include('layouts.headers.wel-module')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                </div>
            </div>
            <div class="col-xl-4">                
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Productos</h3>
                            </div>
                            
                            <form method="POST" action="search-product" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                                @csrf
                                <div class="form-group mb-0">
                                  <div class="input-group input-group-alternative input-group-merge">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" name="search" placeholder="Buscar" type="text">
                                  </div>
                                </div>
                                <button type="submit" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                                    <i class="fas fa-search"></i>
                                </button>
                              </form>
                              <form method="POST" action="add-product" class="col text-right">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">Agregar nuevo producto</button>
                            </form>
                            @if ($succses)
                            <a href="{{route('productos')}}" class="btn btn-sm btn-success">Recargar</a>
                            @endif


                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre producto</th>
                                    <th scope="col">Referencia</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Peso</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Fecha de creación</th>
                                    <th scope="col">Fecha de actualización</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($producto as $pr)
                                <tr>
                                    <td>
                                        {{$pr->id}}
                                    </td>
                                    <td>
                                        {{$pr->name_product}}

                                    </td>
                                    <td>
                                        {{$pr->reference}}
                                    </td>
                                    <td>
                                        {{$pr->price}}

                                    </td>
                                    <td>
                                        {{$pr->peso}}

                                    </td>
                                    <td>
                                        {{$pr->category}}
                                    </td>
                                    @if ($pr->stock > 0)
                                    <td>
                                        {{$pr->stock}}

                                    </td>
                                    @elseif ($pr->stock == 0)
                                    <span class="badge badge-danger">{{$pr->stock}}</span>
                                        

                                    @endif
                                    <td>
                                        {{$pr->created_at}}

                                    </td>
                                    <td>
                                        {{$pr->updated_at}}
                                    </td>
                                    <td>
                                        <form method="POST" action="edit-product" class="col text-right">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$pr->id}}">
                                            <button type="submit" class="btn btn-sm btn-success">Editar</button>
                                        </form>
                                        <form method="POST" action="delete-product" class="col text-right">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$pr->id}}">
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            

        </div>

        @include('layouts.footers.auth')
    </div>
    @if ($succses)
<script>
    Swal.fire(
        'Eliminado!',
        'El producto ha sido eliminado!',
        'success'
    )
</script>

@endif
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush