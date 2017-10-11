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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'TestController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// admin routes

Route::middleware(['App\Http\Middleware\AdminMiddleware'])->group(function () {
	
    // admin	
    Route::get('/admin','Admin\MainController@index');

    // crear enlace pago con Stripe
    Route::get('/admin/stripe/nuevo', 'Admin\StripeController@index');
    Route::post('/admin/stripe/guardar', 'Admin\StripeController@store');

    // ver
    Route::get('/admin/stripe/todos', 'Admin\StripeController@getAll');
    Route::get('/admin/stripe/link/{id}', 'Admin\StripeController@getLink');

});

// pago 
Route::get('/pagar/{token}/{email}', 'PaymentController@index');
Route::post('/confirm/{token}/{email}', 'PaymentController@validatePayment');

Route::get('stripe',function(){
	return view('stripe_public.main');
});

// erori 
Route::get('errors/admin503', function() {
	return view('errors.admin503');
});

// test email
Route::get('test/mail/{id}',function($id){
	return new App\Mail\LinkTestMailController($id);
});
// email con datos de pago
Route::get('test/pay-link-mail/{id}',function($id){
    return new App\Mail\MailController($id);
});

// confirmacion despues del pago
Route::get('test/confirmation-mail/{id}',function($id){
    return new App\Mail\ConfirmationTestMailController($id);
});