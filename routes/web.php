<?php

use App\Http\Controllers\akuncontroller;
use App\Http\Controllers\DashControl;
use App\Http\Controllers\memorialcontroller;
use App\Http\Controllers\transaksi_penjualancontroller;
use App\Http\Controllers\barangcontroller;
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

// Routing untuk akun
Route::get('/accounting/accounts', [akuncontroller::class, "index"])->name('accounts');
Route::post('/accounting/accounts', [akuncontroller::class, "store"])->name('save_account');
Route::get('/accounting/accounts/{akun}', [akuncontroller::class, "show"])->name('detail_account');
Route::get('/accounting/accounts/edit/{akun}', [akuncontroller::class, "edit"])->name('edit_account');
Route::put('/accounting/accounts/edit/{akun}', [akuncontroller::class, "store"])->name('update_account');
Route::delete('/accounting/accounts/{akun}', [akuncontroller::class, "destroy"])->name('delete_account');

Route::get('/sales', [transaksi_penjualancontroller::class, "index"]);

Route::get('/memo', [memorialcontroller::class, "index"]);

Route::get('/barang', [barangcontroller::class, "index"]);