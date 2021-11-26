<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\LoginController;
use Illuminate\Routing\Router;
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

Route::view('/', 'welcome');

Route::view('login', 'login')->name('login');

Route::get('logout',        [LoginController::class, 'logout'])->name('logout');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware('admin')
     ->prefix('admin')
     ->name('admin.')
     ->namespace('Admin')
     ->group(function (Router $router) {

        $router->view('dashboard', 'admin.layout')->name('dashboard');

        $router->get('products', [ProductController::class, 'index'])->name('products');

});
