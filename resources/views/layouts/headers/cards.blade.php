<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                @php
                                    $counts = \DB::connection('mysql')
                                    ->table('products')
                                    ->get();

                                    $prodCont = count($counts);
                                @endphp
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Productos</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$prodCont}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                @php
                                    $userscounts = \DB::connection('mysql')
                                    ->table('users')
                                    ->get();

                                    $userCont = count($userscounts);
                                @endphp
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Usuarios</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$userCont}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                @php
                                    $ventasCont = \DB::connection('mysql')
                                    ->table('purchase')
                                    ->get();

                                    $ventasCont = count($ventasCont);
                                @endphp
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Ventas</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$ventasCont}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>