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
                            <h3>Edita el producto</h3>
                        </div>
                    </div>
<br>
                    <form method="POST" action="edited-product">
                        @csrf
                        @foreach ($product_edit as $pr_e)
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre producto *</label>
                            <input type="text" name="name_p" value="{{$pr_e->name_product}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Producto">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Precio *</label>
                              <input type="number" name="price" value="{{$pr_e->price}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Precio">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Peso *</label>
                              <input type="number" name="peso" value="{{$pr_e->peso}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Peso">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Categoria *</label>
                              <input type="string" name="category" value="{{$pr_e->category}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Categoria">
                            </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Stock *</label>
                            <input type="number" name="stock" value="{{$pr_e->stock}}" required class="form-control" id="exampleInputPassword1" placeholder="Stock">
                          </div>
                        @endforeach
                        <input type="hidden" name="id" value="{{$id}}">

                        <button type="submit" class="btn btn-primary">Editar</button>
                      </form>
                    
                </div>
            </div>
            

        </div>

        @include('layouts.footers.auth')
    </div>
@if ($succses)
<script>
    Swal.fire(
        'Editado!',
        'Tu producto ha sido editado!',
        'success'
    )
</script>

@endif
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush