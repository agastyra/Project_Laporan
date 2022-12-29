<?php

use App\Http\Controllers\akuncontroller;
use App\Http\Controllers\barangcontroller;
use App\Http\Controllers\DashControl;
use App\Http\Controllers\memorialcontroller;
use App\Http\Controllers\transaksi_penjualancontroller;
use App\Http\Controllers\bukti_kas_keluarcontroller;
use App\Models\bukti_kas_keluar;
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
Route::get('/accounting/accounts/new', [akuncontroller::class, "create"])->name('create_account');
Route::get('/accounting/accounts/edit/{akun}', [akuncontroller::class, "edit"])->name('edit_account');
Route::put('/accounting/accounts/edit/{akun}', [akuncontroller::class, "update"])->name('update_account');
Route::delete('/accounting/accounts/{akun}', [akuncontroller::class, "destroy"])->name('delete_account');

Route::get('/sales', [transaksi_penjualancontroller::class, "index"]);

Route::get('/memo', [memorialcontroller::class, "index"]);

Route::get('/barang', [barangcontroller::class, "index"]);

//route kas keluar
Route::get('/bukti_kas_keluar', [bukti_kas_keluarcontroller::class, "index"]);
Route::get('/jurnal_kas_keluar', [bukti_kas_keluarcontroller::class, "jurnal"]);
Route::get('/form_kas_keluar', [bukti_kas_keluarcontroller::class, "form"]);