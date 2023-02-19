<?php

use App\Http\Controllers\akuncontroller;
use App\Http\Controllers\BuktiKasMasukController;
use App\Http\Controllers\DashControl;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\memorialcontroller;
use App\Http\Controllers\transaksi_penjualancontroller;
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

// Routing untuk akun
Route::get('/accounting/accounts', [akuncontroller::class, "index"])->name('accounts');
Route::post('/accounting/accounts', [akuncontroller::class, "store"])->name('save_account');
Route::get('/accounting/accounts/{akun}', [akuncontroller::class, "show"])->name('detail_account');
Route::get('/accounting/accounts/edit/{akun}', [akuncontroller::class, "edit"])->name('edit_account');
Route::put('/accounting/accounts/edit/{akun}', [akuncontroller::class, "store"])->name('update_account');
Route::delete('/accounting/accounts/{akun}', [akuncontroller::class, "destroy"])->name('delete_account');

//Transaksi Penjualan
Route::post('/detail', "DetailPenjualanController@store")->name('detail.store');
Route::put('/detail/edit/{id}', "DetailPenjualanController@update")->name('detail.update');
Route::get('/detail/edit/{id}', "DetailPenjualanController@edit")->name('detail.edit');
Route::post('/calcDet', "DetailPenjualanController@calcDetail")->name('detail.calc');
Route::delete('/detail/{id}', "DetailPenjualanController@destroy")->name('detail.destroy');
Route::get('/sales', [transaksi_penjualancontroller::class, 'index'])->name('transaksi.index');
Route::get('/sales/show', [transaksi_penjualancontroller::class, 'show'])->name('transaksi.show');
Route::post('/sales/store', [transaksi_penjualancontroller::class, 'store'])->name('transaksi.store');
Route::get('/getBarangData/{id}', [transaksi_penjualancontroller::class, 'getData']);
Route::post('/calc', [transaksi_penjualancontroller::class, 'calculate'])->name('calculate');
Route::post('/calcSub', [transaksi_penjualancontroller::class, 'calcSub'])->name('subCalc');
Route::get('/sales/create/{no_transaction?}', [transaksi_penjualancontroller::class, 'create'])->name('transaksi.create');

//Bukti Kas Masuk
Route::get('/bkm/create', [BuktiKasMasukController::class, 'create'])->name('bkm.create');
Route::get('/getTransData/{id}', [BuktiKasMasukController::class, 'getTransData'])->name('getTrans');
Route::post('/bkm/store', [BuktiKasMasukController::class, 'store'])->name('bkm.store');


Route::get('/memo', [memorialcontroller::class, "index"]);