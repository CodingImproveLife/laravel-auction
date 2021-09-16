<?php

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('profile', App\Http\Controllers\ProfileController::class)->only('edit', 'update');
    Route::resource('lots', App\Http\Controllers\LotController::class);
    Route::delete('lot-images/{id}', [App\Http\Controllers\LotImageController::class, 'destroy'])->name('lot-images.destroy');
    Route::get('profile/add-money', [App\Http\Controllers\ProfileController::class, 'topUpBalance'])->name('profile.addMoney');
    Route::post('bid', [App\Http\Controllers\BidController::class, 'store'])->name('bid');

    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['can:edit users']
    ], function () {
        Route::resource('users', \App\Http\Controllers\Admin\UsersController::class)->only('index', 'edit', 'update');
        Route::resource('lots', \App\Http\Controllers\Admin\LotsController::class)->only('index', 'destroy');
    });
});

require __DIR__ . '/auth.php';
