<?php

declare(strict_types=1);

use App\Http\Controllers\AdvertisementController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Advertisement/List', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified', 'throttle:advertisement'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('advertisement', [AdvertisementController::class, 'index'])->name('advertisement');

Route::prefix('advertisement')->middleware(['auth:sanctum', 'verified', 'throttle:advertisement'])->group(function () {
    Route::get('/create', function () {
        return Inertia::render('Advertisement/Create');
    })->name('create');

    Route::post('store', [AdvertisementController::class, 'store'])->name('store');

    Route::get('/edit/{id}', [AdvertisementController::class, 'edit'])->name('edit');

    Route::post('update', [AdvertisementController::class, 'update'])->name('update');

    Route::post('/destroy', [AdvertisementController::class, 'destroy'])->name('destroy');
});
