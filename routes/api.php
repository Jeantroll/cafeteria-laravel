<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('sumar-producto/{idProd}/{cantidadProd}', function ($idProd,$cantidadProd) {
    $adds = \DB::connection('mysql')
    ->table('products')
    ->where('id',$idProd)
    ->first();

    if ($adds->stock >= $cantidadProd) {
        $precioProducto = $adds->price;

        $total = $precioProducto * $cantidadProd;

        return response()->json([
            "success" => true,
            "action" => "Calculo de cantidad por precio unitario",
            "message" => "Operacion exitosa.",
            "code" => 200,
            "data" => $total
        ], 200);
    }else{
        return response()->json([
            "success" => false,
            "action" => "Calculo de cantidad por precio unitario",
            "message" => "Operacion erronea.",
            "code" => 200,
            "data" => 'La cantidad es superior a la que hay en stock'
        ], 200);
    }

    //dd($total);

    }


    
    
); 
Route::get('products-pre/{idFactura}', function ($idFactura) {
    $productsPre = \DB::connection('mysql')
    ->table('products')
    ->where('purchase.id',$idFactura)
    ->join('products_has_purchase','products_has_purchase.id_product','products.id')
    ->join('purchase','purchase.id','products_has_purchase.id_purchase')
    ->get();

    return response()->json([
        "success" => true,
        "action" => "Consulta de productos",
        "message" => "Operacion exitosa.",
        "code" => 200,
        "data" => $productsPre
    ], 200);

    }


    
    
); 




