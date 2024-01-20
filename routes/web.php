<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/', [Dashboard::class, 'index']);
    Route::get('/create', [Dashboard::class, 'create']);
    Route::post('/process-request', [Dashboard::class, 'show']);
    Route::post('/store', [Dashboard::class, 'store']);

    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/barang/create', [BarangController::class, 'create']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/delete/{id_barang}', [BarangController::class, 'destroy']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::get('/', [Dashboard::class, 'index']);
// Route::post('/process-request', [Dashboard::class, 'show']);
// Route::post('/store', [Dashboard::class, 'store']);

// Route::get('/barang', [BarangController::class, 'index']);
// Route::get('/barang/create', [BarangController::class, 'create']);
// Route::post('/barang/store', [BarangController::class, 'store']);
// Route::post('/barang/delete/{id_barang}', [BarangController::class, 'destroy']);
require __DIR__ . '/auth.php';
