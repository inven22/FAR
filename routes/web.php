<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\pesanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\kelolakelaslapangan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\custumerController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'dashboard/admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::post('update', [HomeController::class, 'updateprofile'])->name('profile.update');
    });

    Route::controller(AkunController::class)
        ->prefix('akun')
        ->as('akun.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get','post'],'tambah', 'tambahAkun')->name('add');
            Route::match(['get','post'],'{id}/ubah', 'ubahAkun')->name('edit');
            Route::delete('{id}/hapus', 'hapusAkun')->name('delete');

        });

    Route::controller(kelolakelaslapangan::class)
        ->prefix('crud')
        ->as('crud.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'read')->name('tampil');
            Route::post('adddata', 'addform')->name('tampil.add');
           
            // Route::match(['get','post'],'{id}/ubah', 'ubahAkun')->name('edit');
            // Route::delete('{id}/hapus', 'hapusAkun')->name('delete');

        });
});

Route::get('/pesan/{id}', [pesanController::class,'index'])->name('pesan');
Route::post('/lapangan/{lapanganId}/pemesanan', [pesanController::class,'store'])->name('pemesanan.store');

Route::get('/riwayat', [pesanController::class,'RiwayatIndex'])->name('riwayat.index');
Route::post('/lapangan/{lapanganId}/pemesanan', [pesanController::class,'store'])->name('pemesanan.store');

Route::get('list_pesan', [App\Http\Controllers\pesanController::class,'readpesanan'])->name('pesan.index');
// //
// Route::get('data.index', [custumerController::class, 'index'])->name('data');

// Route::post('data.store', [custumerController::class, 'store'])->name('data.store');
// Route::post('data.edits', [custumerController::class, 'edits'])->name('edits');
// Route::post('data.updates', [custumerController::class, 'updates'])->name('updates');
// Route::post('data.hapus', [custumerController::class, 'hapus'])->name('hapus');

Route::get('list_custumer', [App\Http\Controllers\custumerController::class,'index'])->name('cus.index');
Route::get('/add_custumer',[App\Http\Controllers\custumerController::class,'Add'])->name('cus.add');
Route::post('/insert_custumer', [App\Http\Controllers\custumerController::class,'insert']);
Route::get('/edit_custumer/{id}', [App\Http\Controllers\custumerController::class,'Edit'])->name('cus.edit');
Route::post('/update_custumer/{id}', [App\Http\Controllers\custumerController::class,'Update']);
Route::get('/delete/{id}', [App\Http\Controllers\custumerController::class,'Delete']);

Route::get('list_lapangan', [App\Http\Controllers\lapangan::class,'index'])->name('la.index');
Route::get('/add_lapangan',[App\Http\Controllers\lapangan::class,'Add'])->name('la.add');
Route::post('/insert_lapangan', [App\Http\Controllers\lapangan::class,'insert']);
Route::get('/edit_lapangan/{id}', [App\Http\Controllers\lapangan::class,'Edit'])->name('la.edit');
Route::post('/update_lapangan/{id}', [App\Http\Controllers\lapangan::class,'Update']);
Route::get('/delete/{id}', [App\Http\Controllers\lapangan::class,'Delete']);
Route::get('/export', [App\Http\Controllers\DataExport::class,'export'])->name('cus.export');
Route::get('/export_lapang', [App\Http\Controllers\DataExport::class,'exportlapang'])->name('la.export');

Route::get('pesan', [App\Http\Controllers\pesanController::class,'pesan'])->name('pesan.index');