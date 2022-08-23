<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{

    //Index
    public function add(Request $request){
        $succses = false;
        $fail = false;

        return view('layouts.forms.add_product',['succses'=>$succses,'fail' =>$fail]);
    } 
    public function edit(Request $request){
        $id = $request->get('id');
        $succses =false;

        $product_edit = \DB::connection('mysql')
        ->table('products')
        ->where('id', $id)
        ->get();

        return view('layouts.forms.edit_product',['product_edit' => $product_edit,'succses' =>$succses,'id' =>$id]);
    } 

    //Submit forms
    public function added(Request $request){
        $nombre_producto = $request->get('name_p');
        $precio = $request->get('price');
        $peso = $request->get('peso');
        $categoria = $request->get('category');
        $stock = $request->get('stock');
        $succses = false;
        $fail = false;

        $counts = \DB::connection('mysql')
        ->table('products')
        ->where('created_at','LIKE', date("Y-m-d").'%')
        ->get();


        if(count($counts) <= 9){
            $certified_number = "RF".date("Ymd")."000".count($counts)."A";
        }elseif(count($counts) <= 99){
            $certified_number = "RF".date("Ymd")."00".count($counts)."A";
        }elseif(count($counts) <= 999){
            $certified_number = "RF".date("Ymd")."0".count($counts)."A";
        }elseif(count($counts) <= 9999){
            $certified_number = "RF".date("Ymd").count($counts)."A";
        }
        
        $pass = \DB::connection('mysql')
        ->table('products')
        ->where('name_product', $nombre_producto)
        ->get();

        if (sizeof($pass) == 0) {
            $succses = true;

            $producto_agregado = \DB::connection('mysql')
            ->table('products')
            ->insertGetId([
                'name_product' => $nombre_producto,
                'reference' => $certified_number,
                'price' => $precio,
                'peso' => $peso,
                'category' => $categoria,
                'stock' => $stock,
                'created_at' => Carbon::now()
            ]);
        }else{
            $fail = true;
        }
        
        
        return view('layouts.forms.add_product',['succses'=>$succses,'fail' =>$fail]);
    }

    public function edited(Request $request){
        $id = $request->get('id');
        $nombre_producto = $request->get('name_p');
        $precio = $request->get('price');
        $peso = $request->get('peso');
        $categoria = $request->get('category');
        $stock = $request->get('stock');

        $succses =true;

        $product_edit = \DB::connection('mysql')
        ->table('products')
        ->where('id', $id)
        ->get();

        $producto_agregado = \DB::connection('mysql')
            ->table('products')
            ->where('id',$id)
            ->update([
                'name_product' => $nombre_producto,
                'price' => $precio,
                'peso' => $peso,
                'category' => $categoria,
                'stock' => $stock,
                'updated_at' => Carbon::now()
            ]);

        return view('layouts.forms.edit_product',['product_edit' => $product_edit,'succses' =>$succses,'id'=>$id]);
    } 
    
    public function delete(Request $request){
        $succses = true;

        $id = $request->get('id');

        $producto = \DB::connection('mysql')
        ->table('products')
        ->orderBy('id', 'DESC')
        ->get();

        $producto_eliminado = \DB::connection('mysql')
        ->table('products')
        ->where('id',$id)
        ->delete();

		return view('pages.products',['producto'=>$producto,'succses'=>$succses]);
    }
    
    public function searchProduct(Request $request){
        $succses = false;
        $search = $request->get('search');

        if ($search != '') {
            $producto = \DB::connection('mysql')
            ->table('products')
            ->where('id',$search)
            ->orwhere('name_product',$search)
            ->orwhere('reference',$search)
            ->orderBy('id', 'DESC')
            ->get();
        }else{
            $producto = \DB::connection('mysql')
            ->table('products')
            ->orderBy('id', 'DESC')
            ->get();
        }
		return view('pages.products',['producto'=>$producto,'succses'=>$succses]);
    }


}
