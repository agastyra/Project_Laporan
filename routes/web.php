<?php

use App\Http\Controllers\akuncontroller;
use App\Http\Controllers\DashControl;
use App\Http\Controllers\memorialcontroller;
use App\Models\transaksi_penjualan;
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

Route::get('/accounting/accounts', [akuncontroller::class, "index"]);

Route::get('/sales', [transaksi_penjualan::class, "index"]);

Route::get('/memo', [memorialcontroller::class, "index"]);
