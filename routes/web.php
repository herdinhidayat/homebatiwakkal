<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profilestatus', [ProfileController::class, 'status'])->name('profile.status');
Route::post('/profilestatus', [ProfileController::class, 'terbaru'])->name('profile.status');

require __DIR__ . '/auth.php';

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('pesan/{id}', [PesanController::class, 'index'])->name('pesan.index')->middleware('auth');
Route::post('pesan/{id}', [PesanController::class, 'pesan']);
Route::get('check_out', [PesanController::class, 'check_out'])->name('pesan.check_out');
Route::delete('check-out/{id}', [PesanController::class, 'delete']);
Route::get('konfirmasi-check-out', [PesanController::class, 'konfirmasi']);


Route::get('history', [HistoryController::class, 'index'])->name('history.index');
Route::get('history/{id}', [HistoryController::class, 'detail'])->name('history.detail');
