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
                            <h3>Agregar productos a tu gusto!!</h3>
                        </div>
                    </div>
<br>
                    <form method="POST" action="product-added">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nombre producto *</label>
                          <input type="text" name="name_p" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Producto">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Precio *</label>
                            <input type="number" name="price" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Precio">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Peso *</label>
                            <input type="number" name="peso" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Peso">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Categoria *</label>
                            <input type="string" name="category" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Categoria">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Stock *</label>
                          <input type="number" name="stock" required class="form-control" id="exampleInputPassword1" placeholder="Stock">
                        </div>
                      
                        <button type="submit" class="btn btn-primary">Agregar</button>
                      </form>
                    
                </div>
            </div>
            

        </div>

        @include('layouts.footers.auth')
    </div>
    @if ($succses)
<script>
    Swal.fire(
        'Agregado!',
        'Tu producto ha sido agregado!',
        'success'
    )
</script>

@endif
@if ($fail)
<script>
   Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'El producto ya ha sido agregado!'
    })
</script>

@endif
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush