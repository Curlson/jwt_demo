<?php

use Illuminate\Http\Request;

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

Route::prefix('auth')->group(function($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
});
//middleware('refresh.token')->

Route::middleware([])->group(function() {
    Route::get('profile','UserController@profile');
    // 导入 excel
    Route::post('user/import','UserController@import');
    Route::get('user/export','UserController@export');
    Route::get('test', function(){
        return 'hello wrold';
    });
});
