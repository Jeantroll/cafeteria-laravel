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
                                <h3 class="mb-0">Ventas realizadas</h3>
                            </div>
                              <form method="POST" action="purchase-up" class="col text-right">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">CREAR VENTA</button>
                            </form>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Numero de radicación</th>
                                    <th scope="col">Venta Total</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Proceso</th>
                                    <th scope="col">Fecha de creación</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $vt)
                                    <tr>
                                        <td>{{$vt->id}}</td>
                                        <td>{{$vt->number_rad}}</td>
                                        <td>{{$vt->total_price}}</td>
                                        @if ($vt->active == 1)
                                            <td><span class="badge badge-success">Activo</span></td>
                                        @else
                                           <td><span class="badge badge-danger">Cancelado</span></td> 
                                        @endif
                                        @if ($vt->process == 1)
                                         <td><span class="badge badge-success">PROCESADO</span></td>
                                        @elseif ($vt->process == 2)
                                        <td><span class="badge badge-danger">CANCELADO</span></td> 
                                        @else
                                        <td><span class="badge badge-warning">EN PROCESO</span></td> 

                                        @endif
                                        <td>{{$vt->created_at}}</td>

                                        @if ($vt->process == 1)
                                        @elseif ($vt->process == 0)
                                        <td>
                                            <form method="POST" action="cancel-purchase" class="col text-right">
                                                @csrf
                                                <input type="hidden" name="idFactura" id="idfact" value="{{$vt->id}}">
                                                <button type="submit" class="btn btn-sm btn-danger">CANCELAR</button>
                                            </form>
                                            <form method="POST" action="confirm-purchase" class="col text-right">
                                                @csrf
                                                <input type="hidden" name="idFactura" id="idfact" value="{{$vt->id}}">
                                                <button type="submit" class="btn btn-sm btn-success">APROBAR</button>
                                            </form>

                                        </td>
                                        @endif

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
            'Venta cancelada!',
            'La venta ha sido cancelada con exito!',
            'success'
        )
        </script>
    @endif
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush