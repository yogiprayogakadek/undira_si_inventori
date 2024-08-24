<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/change-password', 'Main\DashboardController@updatePassword')->name('change.password');
Route::namespace('Main')->middleware(['auth', 'checkPassword'])->group(function() {
    Route::get('/', 'DashboardController@index');
    Route::controller('DashboardController')
        ->prefix('/dashboard')
        ->name('dashboard.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/chart', 'chart')->name('chart');
            Route::post('/update-profil', 'updateProfil')->name('update.profil');
            Route::post('/update-password', 'updatePassword')->name('update.password');
        });

    Route::controller('PenggunaController')
        ->prefix('/pengguna')
        ->name('pengguna.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/print', 'print')->name('print');

            Route::post('/update-password', 'updatePassword')->name('update.password');
        });

    Route::controller('SupplierController')
        ->prefix('/supplier')
        ->name('supplier.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/print', 'print')->name('print');
        });

    Route::controller('ProdukController')
        ->prefix('/produk')
        ->name('produk.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/print', 'print')->name('print');
        });

    Route::controller('ProdukKeluarController')
        ->prefix('/produk-keluar')
        ->name('produk-keluar.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/print', 'print')->name('print');

            // get list produk
            Route::get('/list-produk', 'listProduk')->name('list-produk');
            Route::get('/data-produk-keluar/{id}', 'dataKeluar')->name('data-produk-keluar');
        });

    Route::controller('ProdukMasukController')
        ->prefix('/produk-masuk')
        ->name('produk-masuk.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/print', 'print')->name('print');

            // get list produk
            Route::get('/list-produk', 'listProduk')->name('list-produk');
            Route::get('/data-produk-masuk/{id}', 'dataMasuk')->name('data-produk-masuk');
        });

    Route::controller('ProdukRequestController')
        ->prefix('/produk-request')
        ->name('produk-request.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/print', 'print')->name('print');

            // get list produk
            Route::get('/list-produk', 'listProduk')->name('list-produk');
            Route::get('/data-produk-request/{id}', 'dataRequest')->name('data-produk-request');
            Route::post('/update-status', 'updateStatus')->name('update-status');
        });

        Route::controller('LaporanController')
        ->prefix('/laporan')
        ->name('laporan.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/render', 'render')->name('render');
            Route::post('/print', 'print')->name('print');
        });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
