<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PurchaseController extends Controller
{

    public function purchaseIndex(){
        $pre = false;
        $success = false;

        $producto = \DB::connection('mysql')
        ->table('products')
        ->get();

        return view('layouts.forms.shop',['producto'=>$producto,'pre' =>$pre,'success'=>$success]);
    }

    public function purchaseAdd(Request $request){
        $pre = true;
        $success = false;
        $id = $request->get('id');
        $total = $request->get('total');
        $canti = $request->get('cantidad');

        $idFactura = $request->get('idFactura');

        $producto = \DB::connection('mysql')
        ->table('products')
        ->get();

        $counts = \DB::connection('mysql')
        ->table('purchase')
        ->where('created_at','LIKE', date("Y-m-d").'%')
        ->get();
        $quant = \DB::connection('mysql')
        ->table('products')
        ->where('id',$id)
        ->first();

        if(count($counts) <= 9){
            $certified_number = "NUMRAD".date("Ymd")."000".count($counts)."P";
        }elseif(count($counts) <= 99){
            $certified_number = "NUMRAD".date("Ymd")."00".count($counts)."P";
        }elseif(count($counts) <= 999){
            $certified_number = "NUMRAD".date("Ymd")."0".count($counts)."P";
        }elseif(count($counts) <= 9999){
            $certified_number = "NUMRAD".date("Ymd").count($counts)."P";
        }

        $passed = \DB::connection('mysql')
        ->table('purchase')
        ->where('id',$idFactura)
        ->get();

        if (sizeof($passed) == 0) {
            $quant = \DB::connection('mysql')
            ->table('products')
            ->where('id',$id)
            ->first();

            $addeds = \DB::connection('mysql')
            ->table('purchase')
            ->insertGetId([
                'number_rad' => $certified_number,
                'total_price' => $total,
                'active' => 1,
                'process' => 0,
                'created_at' =>Carbon::now()
            ]); 
            
            $productCanti = \DB::connection('mysql')
            ->table('products')
            ->where('id',$id)
            ->update([
                'stock' => $quant->stock - $canti
            ]);
            
            $pivotAdd = \DB::connection('mysql')
            ->table('products_has_purchase')
            ->insertGetId([
                'id_product' => $id,
                'id_purchase' => $addeds,
                'quantity' => $canti
            ]); 
        
        }else{
            $priceU = \DB::connection('mysql')
            ->table('purchase')
            ->where('id',$idFactura)
            ->first();
            $pivotAdd = \DB::connection('mysql')
            ->table('products_has_purchase')
            ->insertGetId([
                'id_product' => $id,
                'id_purchase' => $idFactura,
                'quantity' => $canti

            ]); 
            $productCanti = \DB::connection('mysql')
            ->table('products')
            ->where('id',$id)
            ->update([
                'stock' => $quant->stock - $canti
            ]);
            $updPrice = \DB::connection('mysql')
            ->table('purchase')
            ->where('id',$idFactura)
            ->update([
                'total_price' => $priceU->total_price + $total,
            ]); 

            $addeds = $idFactura;

        }

        return view('layouts.forms.shop',['producto'=>$producto,'pre' =>$pre,'addeds' =>$addeds,'success'=>$success]);
    }

    public function confirmPurchase(Request $request){
        $pre = false;
        $success = true;
        $idFactura = $request->get('idFactura');
        $producto = \DB::connection('mysql')
        ->table('products')
        ->get();
        $updPrice = \DB::connection('mysql')
        ->table('purchase')
        ->where('id',$idFactura)
        ->update([
            'process' => 1,
        ]); 

        $addeds = $idFactura;

        return view('layouts.forms.shop',['producto'=>$producto,'pre' =>$pre,'addeds' =>$addeds,'success'=>$success]);

    }
    public function cancelPurchase(Request $request){
        $succses = true;
        $idFactura = $request->get('idFactura');

		$ventas = \DB::connection('mysql')
		->table('purchase')
		->get();

        $ventaProduct = \DB::connection('mysql')
		->table('products_has_purchase')
        ->where('id_purchase',$idFactura)
		->first();

        $ventaProductCant = \DB::connection('mysql')
		->table('products_has_purchase')
        ->where('id_purchase',$idFactura)
        ->where('id_product',$ventaProduct->id_product)
		->first();

        $productCantidad = \DB::connection('mysql')
		->table('products')
        ->where('id',$ventaProductCant->id_product)
		->first();

        $cancelFact = $productCantidad->stock + $ventaProductCant->quantity;

        $upProd = \DB::connection('mysql')
        ->table('products')
        ->where('id',$productCantidad->id)
        ->update([
            'stock' => $cancelFact
        ]);

        $updPrice = \DB::connection('mysql')
        ->table('purchase')
        ->where('id',$idFactura)
        ->update([
            'process' => 2,
        ]); 

        $updPrice = \DB::connection('mysql')
        ->table('purchase')
        ->where('id',$idFactura)
        ->update([
            'process' => 2,
        ]); 

        $updPrice = \DB::connection('mysql')
        ->table('purchase')
        ->where('id',$idFactura)
        ->update([
            'process' => 2,
        ]); 

		return view('pages.purchase',['ventas'=>$ventas,'succses'=>$succses]);
    }

    
    
}
