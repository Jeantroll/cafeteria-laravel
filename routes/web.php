<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	 //Productos rutas
	 Route::post('edit-product', 'App\Http\Controllers\ProductController@edit');
	 Route::post('add-product','App\Http\Controllers\ProductController@add');
	 Route::post('product-added','App\Http\Controllers\ProductController@added');
	 Route::post('delete-product','App\Http\Controllers\ProductController@delete');
	 Route::post('edited-product','App\Http\Controllers\ProductController@edited');
	 Route::post('search-product','App\Http\Controllers\ProductController@searchProduct');

	 
	 Route::get('products', function () {
		$succses = false;

		$producto = \DB::connection('mysql')
        ->table('products')
        ->get();

		return view('pages.products',['producto'=>$producto,'succses'=>$succses]);

		}
		
		)->name('productos');
		
		Route::get('ventas', function () {
			$succses = false;
	
			$ventas = \DB::connection('mysql')
			->table('purchase')
			->get();
	
			return view('pages.purchase',['ventas'=>$ventas,'succses'=>$succses]);
	
			}
			
		)->name('ventas'); 

		Route::post('purchase-up','App\Http\Controllers\PurchaseController@purchaseIndex');
		Route::post('purchase-added','App\Http\Controllers\PurchaseController@purchaseAdd');
		Route::post('confirm-purchase','App\Http\Controllers\PurchaseController@confirmPurchase');
		Route::post('cancel-purchase','App\Http\Controllers\PurchaseController@cancelPurchase');

	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

