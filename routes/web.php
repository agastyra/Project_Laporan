<?php

use App\Http\Controllers\akuncontroller;
use App\Http\Controllers\DashControl;
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

Route::get('/', [DashControl::class, 'index']);
<<<<<<< HEAD
Route::get('/accounting/accounts', [akuncontroller::class, "index"]);
=======

Route::get('/sales', function () {
    return view('transaksi.penjualan.sales');
});
>>>>>>> de0dea076892ef940ba2dc3d94f8cfbd7405d8d5
