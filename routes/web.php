<?php

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


Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('category', 'CategoryController')->except(['create', 'show']);
    Route::resource('product', 'ProductController')->except(['show']);
    Route::resource('image', 'ImageController')->except(['show']);
    Route::resource('users', 'UserController')->except(['show']);
    Route::resource('ongkos', 'OngkosController')->except(['show']);
    Route::resource('review', 'feedbacksController')->except(['show']);
    Route::group(['prefix' => 'payments'], function() {
        Route::get('/', 'PaymentController@index')->name('payments.index');
        Route::get('/{cart_id}', 'PaymentController@view')->name('payments.view');
        Route::get('/payment/{id}', 'PaymentController@acceptPayment')->name('payments.approve_payment');
        Route::post('/payments.done', 'PaymentController@done')->name('payments.done');
        Route::delete('/{cart_id}', 'PaymentController@destroy')->name('payments.destroy');
      
    });

    Route::group(['prefix' => 'reports'], function() {
        Route::get('/order', 'HomeController@orderReport')->name('report.order');
        Route::get('/order/pdf/{daterange}', 'HomeController@orderReportPdf')->name('report.order_pdf');
       
    });
});
