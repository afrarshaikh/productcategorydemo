<?php

// use Illuminate\Routing\Route;

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
$router->get('/get/testresult', 'CommonController@getTestResult');
Route::get('/', function () {
    return redirect()->route('category.index');
});
Route::resource('category','CategoryController');
Route::get('/categorytable/data', ['uses' => 'CategoryController@datatable', 'as' => 'category.datatable.list']);//For datatable
Route::post('/categoryrestore/{category}', ['uses' => 'CategoryController@restore', 'as' => 'category.restore']);

Route::resource('product','ProductController');
Route::get('/productstable/data', ['uses' => 'ProductController@datatable', 'as' => 'products.datatable.list']);//For datatable
Route::post('/productrestore/{category}', ['uses' => 'ProductController@restore', 'as' => 'product.restore']);


