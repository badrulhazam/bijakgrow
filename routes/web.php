<?php

use App\Http\Controllers\ProfileController;
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

use App\Http\Controllers\InvestmentComparisonController;

Route::match(['get', 'post'], '/investment', [InvestmentComparisonController::class, 'index'])->name('investment.index');


Route::get('/dealer', function () {
    return view('investment.dealer');
})->name('dealer.page');

require __DIR__.'/auth.php';
