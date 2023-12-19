<?php

use App\Http\Controllers\Gamefeature;
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

Route::get('/', [Gamefeature::class, 'getGameService']);
Route::get('/detail/{name}', [Gamefeature::class, 'getGameDetail'])->name('game-detail');
Route::get('/invoice/{id}', [Gamefeature::class, 'invoiceOrder'])->name('invoice-page');
Route::post('/', [Gamefeature::class, 'orderGameService'])->name('place-order');