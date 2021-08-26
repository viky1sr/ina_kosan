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

//Route::get('/', function () {
//    return view('pages.frontend');
//});

Route::get('/','LadingPageController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'kos-kosan','as' => 'kos-kosan.'] , function () {
    Route::get('/pria','AllKosKosanController@indexPria')->name('pria-index');
    Route::get('/wanita','AllKosKosanController@indexWanita')->name('wanita-index');
    Route::get('/campur','AllKosKosanController@indexCampur')->name('campur-index');
    Route::get('/create','AllKosKosanController@create')->name('create');
    Route::post('/create','AllKosKosanController@store')->name('store');
    Route::get('/edit/{id}','AllKosKosanController@edit')->name('edit');
    Route::post('/edit/{id}','AllKosKosanController@update')->name('update');
    Route::delete('/delete/{id}','AllKosKosanController@destroy')->name('destroy');
    Route::get('/datatable-pria','AllKosKosanController@dataTablesPria')->name('datatable-pria');
    Route::get('/datatable-wanita','AllKosKosanController@dataTablesWanita')->name('datatable-wanita');
    Route::get('/datatable-campur','AllKosKosanController@dataTablesCampur')->name('datatable-campur');
    Route::get('/pay-now/{id}','AllKosKosanController@payNowShow')->name('pay-now-show');
    Route::post('/pay-now/{id}','AllKosKosanController@payNowStore')->name('pay-now-store');
});

Route::group(['prefix' => 'virtaul-account','as' => 'virtaul-account.'] , function () {
    Route::get('/{id}','VirtualAccountController@show')->name('show');
});

Route::group(['prefix' => 'my-kosan','as' => 'my-kosan.'] , function () {
    Route::get('/','MyKosanController@index')->name('index');
    Route::get('/datatable','MyKosanController@dataTables')->name('datatable');
});

Route::group(['prefix' => 'visitor','as' => 'visitor.'] , function () {
    Route::get('/','AllUserController@visitorIndex')->name('index');
    Route::get('/datatable','AllUserController@visitorDataTable')->name('datatable');
    Route::get('/create/{id}','AllUserController@visitorCreate')->name('visitor-create');
    Route::post('/create/{id}','AllUserController@visitorStore')->name('visitor-store');
});

Route::group(['prefix' => 'member','as' => 'member.'] , function () {
    Route::get('/','AllUserController@memberIndex')->name('index');
    Route::get('/datatable','AllUserController@memberDataTable')->name('datatable');
});

Route::group(['prefix' => 'transfer', 'as' => 'transfer.' ], function() {
    Route::get('/','TransferController@transferIndex')->name('index');
    Route::post('/','TransferController@transferStore')->name('store');
});

Route::group(['prefix' => 'my-kosan', 'as' => 'my-kosan.' ], function() {
    Route::get('/','MyKosanController@index')->name('index');
    Route::get('/datatable','MyKosanController@dataTable')->name('datatable');
    Route::get('/pay/{id}','MyKosanController@edit')->name('edit');
    Route::post('/pay/{id}','MyKosanController@update')->name('update');
});