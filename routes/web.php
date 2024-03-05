<?php

use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user= Auth()->user();
    return view('dashboard', compact("user"));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::post('/saldo_update', function(Request $request){
    //     User::findOrFail(Auth()->user()->id)->update([
    //         "saldo" => $request->add_saldo
    //     ]);
    // })->name('saldo.update');
    Route::post('/pagar', [FinanceiroController::class, 'pagar'])->name('pagar');
    Route::post('/transferir', [FinanceiroController::class, 'transferir'])->name('transferir');
    Route::post('/depositar', [FinanceiroController::class, 'depositar'])->name('depositar');
    Route::post('/sacar', [FinanceiroController::class, 'sacar'])->name('sacar');
});

require __DIR__.'/auth.php';
