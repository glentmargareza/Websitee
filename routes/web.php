<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes — Jeep Wukirsari
|--------------------------------------------------------------------------
|
| Definisikan route web aplikasi di sini. Route ini di-load oleh
| RouteServiceProvider dan semuanya berada dalam grup middleware "web".
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

