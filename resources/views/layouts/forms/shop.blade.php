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
                            <h3>Genera tu venta!</h3>
                        </div>
                    </div>
<br>
                    <form method="POST" action="purchase-added">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Producto *</label>
                          <select class="form-control" name="id" id="id" onchange="parseCantidad()">

                            @foreach ($producto as $pr)
                            <option value="{{$pr->id }}">{{$pr->name_product}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cantidad *</label>
                            <input type="number" name="cantidad" id="cantidad" onchange="parseCantidad()" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Precio">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Valor *</label>
                            <input type="number" name="total" id="total"  required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Peso">
                          </div>
                          @if ($pre)
                          <input type="hidden" name="idFactura" id="idfact" value="{{$addeds}}">
                          @else
                          <input type="hidden" name="idFactura" id="idfact" value="NO">

                          @endif

                        <button type="submit" class="btn btn-primary" id="buttonVenta">Generar venta</button>
                      </form>

                      <br>
                      <br>
                      @if ($pre)
                      <form action="confirm-purchase" method="POST">
                        @csrf
                        <input type="hidden" name="idFactura" id="idfact" value="{{$addeds}}">

                        <button type="submit" class="btn btn-danger">
                            Confirmar venta
                          </button>
                      </form>
                      
                      @endif

                    
                </div>
            </div>
            
        </div>
        <br>
        <br>
        @if ($pre)

        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
            Productos agregados
          </button>
        @endif

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <center>
                    Productos agregados a la venta
                  </center>

                  <div id="productsAdd">

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        @include('layouts.footers.auth')
    </div>
    @if ($success)
    <script>
        Swal.fire(
            'Venta confirmada!',
            'La venta ha sido confirmada con exito!',
            'success'
        )
    </script>
    @endif
    <script>
productosPre();

let timerss;

function timer() {
    timerss = setTimeout(productosPre, 3000);
}

function productosPre() {

    let idfactura = document.getElementById("idfact").value; 

    let headers = new Headers();
      
      if(idfactura == null){
          var ajaxurl = "http://localhost:8000/api/products-pre/0";
      }else{
          var ajaxurl = "http://localhost:8000/api/products-pre/"+idfactura;
      }

      fetch(ajaxurl, {
              //mode: 'no-cors',
              //credentials: 'include',
              method: 'GET',
              headers: headers
      })
      .then(function(response) {
          return response.text();
      })
      .then(function(data) {

          var data = JSON.parse(data);

          console.log(data);

              var productsF = data.data;

              console.log(productsF);
              let prod = document.getElementById("productsAdd");
              prod.innerHTML = '';

              for (let item of productsF) {
                console.log(item)
                prod.innerHTML += '<ul class="list-group"><li class="list-group-item">'+item.name_product+'</li><li class="list-group-item">'+item.total_price+'</li></ul>'
            }
    })
}

        function consultarTotal(idprod, cantidad){
    
    let headers = new Headers();
          
          if(idprod == null && cantidad == null){
              var ajaxurl = "http://localhost:8000/api/sumar-producto/0/0";
          }else{
              var ajaxurl = "http://localhost:8000/api/sumar-producto/"+idprod+"/"+cantidad;
          }
    
          fetch(ajaxurl, {
                  //mode: 'no-cors',
                  //credentials: 'include',
                  method: 'GET',
                  headers: headers
          })
          .then(function(response) {
              return response.text();
          })
          .then(function(data) {
    
              var data = JSON.parse(data);
    
              if(data.success){
                    var total = document.getElementById('total').value = data.data;    
                    document.getElementById('buttonVenta').disabled = false;

                    console.log(data);
                }else{
                    alert(data.data);
                    var total = document.getElementById('total').value = '0'; 
                    
                    document.getElementById('buttonVenta').disabled = true;

                }
        })
    }

    function parseCantidad() {
    var idprod = document.getElementById('id').value;
    var cantidad = document.getElementById('cantidad').value;

    consultarTotal(idprod, cantidad)
    }
    </script>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush