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

Route::group([
    'middleware'=>['auth','estado'] ],
function(){ 
    Route::get('/admin','HomeController@index')->name('dashboard');

    Route::get('user/getJson' , 'UsersController@getJson' )->name('users.getJson');
    Route::get('users' , 'UsersController@index' )->name('users.index');
    Route::post('users' , 'UsersController@store' )->name('users.store');
    Route::delete('users/{user}' , 'UsersController@destroy' );
    Route::post('users/update/{user}' , 'UsersController@update' );
    Route::get('users/{user}/edit', 'UsersController@edit' );
    Route::post('users/reset/tercero' , 'UsersController@resetPasswordTercero')->name('users.reset.tercero');
    Route::post('users/reset' , 'UsersController@resetPassword')->name('users.reset');
    Route::get( '/users/cargar' , 'UsersController@cargarSelect')->name('users.cargar');
    Route::get( '/users/cargarA' , 'UsersController@cargarSelectApertura')->name('users.cargarA');

    Route::get( '/negocio/{negocio}/edit' , 'NegocioController@edit')->name('negocio.edit');
    Route::put( '/negocio/{negocio}/update' , 'NegocioController@update')->name('negocio.update');

    Route::get( '/destinos' , 'DestinosController@index')->name('destinos.index');
    Route::get( '/destinos/getJson/' , 'DestinosController@getJson')->name('destinos.getJson');
    Route::get( '/destinos/new' , 'DestinosController@create')->name('destinos.new');
    Route::get( '/destinos/edit/{destino}' , 'DestinosController@edit')->name('destinos.edit');
    Route::put( '/destinos/{destino}/update' , 'DestinosController@update')->name('destinos.update');
    Route::post( '/destinos/save/' , 'DestinosController@store')->name('destinos.save');
    Route::post('/destinos/{destino}/delete' , 'DestinosController@destroy');
    Route::post('/destinos/{destino}/activar' , 'DestinosController@activar');

    Route::get( '/vehiculos' , 'VehiculosController@index')->name('vehiculos.index');
    Route::get( '/vehiculos/getJson/' , 'VehiculosController@getJson')->name('vehiculos.getJson');
    Route::get( '/vehiculos/new' , 'VehiculosController@create')->name('vehiculos.new');
    Route::get( '/vehiculos/edit/{vehiculo}' , 'VehiculosController@edit')->name('vehiculos.edit');
    Route::put( '/vehiculos/{vehiculo}/update' , 'VehiculosController@update')->name('vehiculos.update');
    Route::post( '/vehiculos/save/' , 'VehiculosController@store')->name('vehiculos.save');
    Route::post('/vehiculos/{vehiculo}/delete' , 'VehiculosController@destroy');
    Route::post('/vehiculos/{vehiculo}/activar' , 'VehiculosController@activar');

    Route::get( '/oficinas' , 'OficinasController@index')->name('oficinas.index');
    Route::get( '/oficinas/getJson/' , 'OficinasController@getJson')->name('oficinas.getJson');
    Route::get( '/oficinas/new' , 'OficinasController@create')->name('oficinas.new');
    Route::get( '/oficinas/edit/{oficina}' , 'OficinasController@edit')->name('oficinas.edit');
    Route::put( '/oficinas/{oficina}/update' , 'OficinasController@update')->name('oficinas.update');
    Route::post( '/oficinas/save/' , 'OficinasController@store')->name('oficinas.save');
    Route::post('/oficinas/{oficina}/delete' , 'OficinasController@destroy');
    Route::post('/oficinas/{oficina}/activar' , 'OficinasController@activar');

    Route::get( '/guias' , 'GuiasController@index')->name('guias.index');
    Route::get( '/guias/getJson/' , 'GuiasController@getJson')->name('guias.getJson');
    Route::get( '/guias/new' , 'GuiasController@create')->name('guias.new');
    Route::get( '/guias/show/{guia}' , 'GuiasController@show')->name('guias.show');
    Route::get( '/guias/edit/{guia}' , 'GuiasController@edit')->name('guias.edit');
    Route::put( '/guias/{guia}/update' , 'GuiasController@update')->name('guias.update');
    Route::post( '/guias/save/' , 'GuiasController@store')->name('guias.save');
    Route::post('/guias/{guia}/delete' , 'GuiasController@destroy');
    Route::post('/guias/{guia}/activar' , 'GuiasController@activar');
    Route::get( '/guias/rpt_guias' , 'GuiasController@rpt_guias')->name('guias.rpt_guias');
    Route::get( '/guias/entrega/{guia}' , 'GuiasController@entrega')->name('guias.entrega');
    Route::post( '/guias/saveentrega/' , 'GuiasController@saveentrega')->name('guias.saveentrega');
    Route::get('/guias/getPaquete/{tipo_paquete}' , 'GuiasController@getPaquete')->name('guias.getPaquere');
    Route::post('/guias/{guia_detalle}/deleteDetalle' , 'GuiasController@destroyDetalle');
    Route::get('/guias/{guia}/getDetalles' , 'GuiasController@getDetalles')->name('guias.getDetalles');

    Route::get( '/empresas' , 'EmpresasController@index')->name('empresas.index');
    Route::get( '/empresas/getJson/' , 'EmpresasController@getJson')->name('empresas.getJson');
    Route::get( '/empresas/new' , 'EmpresasController@create')->name('empresas.new');
    Route::get( '/empresas/edit/{empresa}' , 'EmpresasController@edit')->name('empresas.edit');
    Route::put( '/empresas/{empresa}/update' , 'EmpresasController@update')->name('empresas.update');
    Route::post( '/empresas/save/' , 'EmpresasController@store')->name('empresas.save');
    Route::post('/empresas/{empresa}/delete' , 'EmpresasController@destroy');
    Route::post('/empresas/{empresa}/activar' , 'EmpresasController@activar');

    Route::get( '/empleados' , 'EmpleadosController@index')->name('empleados.index');
    Route::get( '/empleados/getJson/' , 'EmpleadosController@getJson')->name('empleados.getJson');
    Route::get( '/empleados/new' , 'EmpleadosController@create')->name('empleados.new');
    Route::get( '/empleados/edit/{empleado}' , 'EmpleadosController@edit')->name('empleados.edit');
    Route::put( '/empleados/{empleado}/update' , 'EmpleadosController@update')->name('empleados.update');
    Route::post( '/empleados/save/' , 'EmpleadosController@store')->name('empleados.save');
    Route::post('/empleados/{empleado}/delete' , 'EmpleadosController@destroy');
    Route::post('/empleados/{empleado}/activar' , 'EmpleadosController@activar');
    
    Route::get( '/gestion_guias' , 'GuiasController@gestion_guias')->name('guias.gestion');
    Route::get( '/gestion_guias/getGuias/{oficina}' , 'GuiasController@getGuias')->name('guias.getGuias');



    Route::get('/envios/getGuia/{guia}' , 'EnviosController@getGuia')->name('envios.getGuia');
    Route::get('/envios' , 'EnviosController@index')->name('envios.index');
    Route::get('/envios/getJson/' , 'EnviosController@getJson')->name('envios.getJson');
    Route::get('/envios/new' , 'EnviosController@create')->name('envios.new');
    Route::post( '/envios/save/' , 'EnviosController@store')->name('envios.save');
    Route::get('/envios/show/{envio_maestro}' , 'EnviosController@show')->name('envios.show');
    Route::get('/envios/ruta/{envio_maestro}' , 'EnviosController@ruta')->name('envios.ruta');
    Route::get('/envios/oficina/{envio_maestro}' , 'EnviosController@oficina')->name('envios.oficina');
    Route::post('/envios/{envio_maestro}/delete' , 'EnviosController@destroy');
    Route::post('/envios/{envio_detalle}/deleteDetalle' , 'EnviosController@destroyDetalle');
    Route::get('/envios/{envio_maestro}/getDetalles' , 'EnviosController@getDetalles')->name('envios.getDetalles');
    Route::get( '/envios/pdf/{envio_maestro}', 'EnviosController@pdfEnvio');



    Route::get('/reportes/guias_fecha' , 'ReportesController@guias_fecha')->name('reportes.guias_fecha');
    Route::get('/reportes/guias/{guia}' , 'ReportesController@guias')->name('reportes.guias');
    

});


Route::get('/', function () {
    $negocio = App\Negocio::all();
    return view('welcome', compact('negocio'));
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home')->middleware(['estado']);

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user/get/' , 'Auth\LoginController@getInfo')->name('user.get');
Route::post('/user/contador' , 'Auth\LoginController@Contador')->name('user.contador');
Route::post('/password/reset2' , 'Auth\ForgotPasswordController@ResetPassword')->name('password.reset2');
Route::get('/user-existe/', 'Auth\LoginController@userExiste')->name('user.existe');

//Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
/*Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');*/