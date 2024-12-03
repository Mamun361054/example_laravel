<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('hello.welcome');
})->name('home');




Route::get('/', [ProfileController::class, 'show'])->name('profile.show');

Route::post('store', [ProfileController::class, 'store'])->name('profile.store');

Route::post('update/{id}',action: [ProfileController::class,'update'])->name('profile.update');

Route::get('delete/{id}',action:[ProfileController::class,'delete'])->name('profile.delete');
