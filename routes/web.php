<?php

use App\Http\Controllers\akuncontroller;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\barangcontroller;
use App\Http\Controllers\BuktiKasMasukController;
use App\Http\Controllers\bukti_kas_keluarcontroller;
use App\Http\Controllers\bukti_kas_masukcontroller;
use App\Http\Controllers\DashControl;
use App\Http\Controllers\jurnal_penyesuaiancontroller;
use App\Http\Controllers\memorialcontroller;
use App\Http\Controllers\NeracaSaldoController;
use App\Http\Controllers\transaksi_pembeliancontroller;
use App\Http\Controllers\transaksi_penjualancontroller;
use App\Http\Livewire\BukuBesar\BukuBesar;
use Illuminate\Support\Facades\Route;
//use Barryvdh\DomPDF\PDF;
//use Dompdf\Dompdf;
//use Dompdf\Options;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashControl::class, 'index']);
    Route::post('/authentication/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::middleware(['office'])->group(function () {
    // Routing untuk akun
    Route::get('/accounting/accounts', [akuncontroller::class, "index"])->name('accounts');
    Route::post('/accounting/accounts', [akuncontroller::class, "store"])->name('save_account');
    Route::get('/accounting/accounts/new', [akuncontroller::class, "create"])->name('create_account');
    Route::get('/accounting/accounts/edit/{akun}', [akuncontroller::class, "edit"])->name('edit_account');
    Route::put('/accounting/accounts/edit/{akun}', [akuncontroller::class, "update"])->name('update_account');
    Route::delete('/accounting/accounts/delete/{akun}', [akuncontroller::class, "destroy"])->name('delete_account');

    //Bukti Kas Masuk
    Route::get('/accounting/cash-in', [BuktiKasMasukController::class, 'index'])->name('bkm.index');
    Route::get('/accounting/cash-in/table', [BuktiKasMasukController::class, 'index'])->name('bkm.table');
    Route::get('/accounting/cash-in/create', [BuktiKasMasukController::class, 'create'])->name('bkm.create');
    Route::get('/accounting/getTransData/{id}', [BuktiKasMasukController::class, 'getTransData'])->name('getTrans');
    Route::get('/accounting/getMemoData/{id}', [BuktiKasMasukController::class, 'getMemoData'])->name('getMemo');
    Route::post('/accounting/debKredCal', [BuktiKasMasukController::class, 'debKredCal'])->name('debKred');
    Route::post('/accounting/cash-in/store', [BuktiKasMasukController::class, 'store'])->name('bkm.store');
    Route::get('/accounting/cash-in/edit/{id}', [BuktiKasMasukController::class, 'edit'])->name('bkm.edit');
    Route::put('/accounting/cash-in/edit/{id}', [BuktiKasMasukController::class, 'update'])->name('bkm.update');
    Route::get('accounting/cash-in/print/{id}', [BuktiKasMasukController::class, 'report'])->name('print');

    Route::get('/balance', [NeracaSaldoController::class, 'index']);
    Route::get('/PrintBalance', [NeracaSaldoController::class, 'print'])->name('print.ns');

    // route buku besar
    Route::get('/accounting/ledger', BukuBesar::class)->name('ledger');

    Route::get('/penyesuaian', [jurnal_penyesuaiancontroller::class, "index"]);

    //route kas keluar
    Route::get('/accounting/cash-out', [bukti_kas_keluarcontroller::class, "index"])->name('cash_out');
    Route::post('/accounting/cash-out', [bukti_kas_keluarcontroller::class, "save"])->name('save_cash_out');
    Route::get('/accounting/cash-out/new', [bukti_kas_keluarcontroller::class, "form"])->name('create_cash_out');
    Route::get('/accounting/cash-out/get_transaction/{transaksi_pembelian:id}', [bukti_kas_keluarcontroller::class, 'get_transaction'])->name('get_transaction');
    Route::get('/accounting/cash-out/print/{bukti_kas_keluar}', [bukti_kas_keluarcontroller::class, "report"])->name('report_cash_out');

    //route kas masuk
    Route::get('/form_kas_masuk', [bukti_kas_masukcontroller::class, "form"]);
    Route::get('/laporan_kas_masuk', [bukti_kas_masukcontroller::class, "report"]);
    Route::get('/tabel_kas_masuk', [bukti_kas_masukcontroller::class, "tabel"]);

    // route jurnal memorial
    Route::get('/accounting/memorial', [memorialcontroller::class, "index"])->name('memorial');
    Route::get('/accounting/memorial/new', [memorialcontroller::class, "create"])->name('create_memorial');
    Route::post('/accounting/memorial', [memorialcontroller::class, "store"])->name('save_memorial');
    Route::get('/accounting/memorial/detail/{jurnal_memorial}', [memorialcontroller::class, "detail"])->name('detail_memorial');
    Route::post('/accounting/memorial/delete/{jurnal_memorial}', [memorialcontroller::class, "destroy"])->name('delete_memorial');
    Route::get('/accounting/memorial/get_detail', [memorialcontroller::class, 'get_detail'])->name('get_detail_memorial');
    Route::get('/accounting/memorial/validate_akun/{akun:id}', [memorialcontroller::class, 'validate_akun'])->name('validate_akun_memorial');
    Route::post('/accounting/memorial/store_detail', [memorialcontroller::class, 'store_detail'])->name('store_detail_memorial');
    Route::put('/accounting/memorial/update_detail_qty', [memorialcontroller::class, 'update_detail_qty'])->name('update_detail_qty_memorial');
    Route::put('/accounting/memorial/update_detail', [memorialcontroller::class, 'update_detail'])->name('update_detail_memorial');
    Route::delete('/accounting/memorial/delete_detail', [memorialcontroller::class, 'delete_detail'])->name('delete_detail_memorial');
    Route::delete('/accounting/memorial/delete_detail', [memorialcontroller::class, 'delete_detail'])->name('delete_detail');
});

Route::middleware(['cashier'])->group(function () {
    //route barang
    // Route::get('/barang', [barangcontroller::class, 'index'])->name('barang');
    Route::get('/barang', [barangcontroller::class, "index"])->name('barang');
    Route::post('/barang/tambah', [barangcontroller::class, "store"])->name('simpan_barang');
    Route::get('/barang/tambah', [barangcontroller::class, "create"])->name('tambah_barang');
    Route::get('/barang/edit/{barang}', [barangcontroller::class, "edit"])->name('edit_barang');
    Route::put('/barang/edit/{barang}', [barangcontroller::class, "update"])->name('update_barang');
    Route::delete('/barang/{barang}', [barangcontroller::class, "destroy"])->name('hapus_barang');
    //Route::put('/barang/tambah/{barang}', [barangcontroller::class, "incrementid"])->name('increment');

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

    // route pembelian
    Route::get('/purchase', [transaksi_pembeliancontroller::class, "index"])->name('purchase');
    Route::get('/purchase/new', [transaksi_pembeliancontroller::class, "create"])->name('create_purchase');
    Route::get('/purchase/detail/{transaksi_pembelian}', [transaksi_pembeliancontroller::class, "detail"])->name('detail_purchase');
    Route::delete('/purchase/delete/{transaksi_pembelian}', [transaksi_pembeliancontroller::class, 'delete'])->name('delete_purchase');
    Route::post('/purchase/save_transaksi', [transaksi_pembeliancontroller::class, "store"])->name('save_purchase');
    Route::get('/cari_barang/{barang:id}', [transaksi_pembeliancontroller::class, "cari_barang"]);
    Route::post('/purchase/save_detail', [transaksi_pembeliancontroller::class, "store_detail"])->name('save_detail_purchase');
    Route::get('/purchase/get_detail', [transaksi_pembeliancontroller::class, "get_detail"])->name('get_detail_purchase');
    Route::get('/purchase/validate_barang/{barang:id}', [transaksi_pembeliancontroller::class, "validate_barang"])->name('validate_barang');
    Route::put('/purchase/update_detail', [transaksi_pembeliancontroller::class, "update_detail"])->name("update_detail");
    Route::put('/purchase/update_detail_qty', [transaksi_pembeliancontroller::class, "update_detail_qty"])->name("update_detail_qty");
    Route::delete('/purchase/delete_detail', [transaksi_pembeliancontroller::class, "delete_detail"])->name('delete_detail_purchase');
    Route::get('/purchase/print/{id}', [transaksi_pembeliancontroller::class, "print"])->name('printpem');
});

// authentication
Route::middleware(['guest'])->group(function () {
    Route::get('/authentication/register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('/authentication/register', [AuthenticationController::class, 'register_user'])->name('register_user');
    Route::get('/authentication/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/authentication/login', [AuthenticationController::class, 'login_user'])->name('login_user');
});
