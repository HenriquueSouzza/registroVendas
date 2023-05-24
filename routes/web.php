<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\CadastrosController;
use App\Http\Controllers\RelatoriosController;
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

Route::view('/', 'home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::prefix('vendas')->name('vendas.')->group(function () {
        Route::get('/', [VendasController::class, 'index'])->name('index');
        Route::get('/nova', [VendasController::class, 'create'])->name('nova');
        Route::post('/nova', [VendasController::class, 'store']);
        Route::get('/{id}', [VendasController::class, 'show'])->name('show');
        Route::delete('/{id}', [VendasController::class, 'destroy'])->name('apagar');
        Route::get('/gerar-relatorio/{id}', [VendasController::class, 'relatorio'])->name('relatorio');
    });
    Route::get('/cadastros', [CadastrosController::class, 'index'])->name('cadastros');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
