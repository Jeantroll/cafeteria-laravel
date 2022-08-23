@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
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
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Mayor stock</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">Ver todo</a>
                            </div>
                        </div>
                    </div>
                    @php
                        $prods = \DB::connection('mysql')
                            ->table('products')
                            ->orderBy('stock', 'DESC')
                            ->take(5)
                            ->get();
                    @endphp
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prods as $vtC)
                                <tr>
                                    <td>{{$vtC->id}}</td>
                                    <td>{{$vtC->name_product}}</td>
                                    <td>{{$vtC->reference}}</td>
                                    <td>{{$vtC->price}}</td>
                                    <td>{{$vtC->peso}}</td>
                                    <td>{{$vtC->category}}</td>
                                    <td>{{$vtC->stock}}</td>
                                    <td>{{$vtC->created_at}}</td>
                                    <td>{{$vtC->updated_at}}</td>

                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Ultimas 5 ventas</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">Ver todo</a>
                            </div>
                        </div>
                    </div>
                    @php
                        $ventasCont = \DB::connection('mysql')
                            ->table('purchase')
                            ->where('active',1)
                            ->where('process',1)
                            ->orderBy('created_at', 'DESC')
                            ->take(5)
                            ->get();
                    @endphp
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Numero radicación</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventasCont as $vt)                                    
                                <tr>
                                    <td>{{$vt->number_rad}}</td>
                                    <td>{{$vt->total_price}}</td>   
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
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush