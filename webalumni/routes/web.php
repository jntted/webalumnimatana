<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;

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
    return view('layout.beranda');
});

Route::get('/forum', function () {
    return view('layout.forum');
});

// Public Auth Routes
Route::get('/daftar', [AuthController::class, 'registrationForm'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Protected Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
    
    // Data collection routes
    Route::get('/data/{role}', [AuthController::class, 'dataForm'])->name('data.form');
    Route::post('/data/{role}', [AuthController::class, 'storeData'])->name('data.store');
    
    // Profile picture upload
    Route::post('/profile-picture', [AuthController::class, 'updateProfilePicture'])->name('profile.picture.update');
});

// Alumni routes
Route::resource('alumni', AlumniController::class);