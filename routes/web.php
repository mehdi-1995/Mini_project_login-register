<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Services\Notification\Notification;
use App\Http\Controllers\Auth\Personalize\MagicController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Personalize\TwoFactorController;

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
    return view('index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('test', function () {
    (new Notification)->sendSms(User::first(), 'add');
});


Route::prefix('auth')->group(function () {
    Route::get('login/magic/form', [MagicController::class, 'showMagicForm'])->name('login.magic.showMagicForm');
    Route::post('login/magic', [MagicController::class, 'sendToken'])->name('login.magic.sendToken');
    Route::get('login/magic/{magicToken:token}', [MagicController::class, 'authenticate'])->name('login.magic.authenticate');
    Route::middleware('auth')->group(function () {
        Route::get('two-factor/toggle', [TwoFactorController::class, 'showTwoFactorForm'])->name('auth.two-factor.toggle');
        Route::get('two-factor/activate', [TwoFactorController::class, 'requestActivate'])->name('auth.two-factor.activate');
        Route::get('two-factor/activate/form', [TwoFactorController::class, 'showEnterCodeForm'])->name('auth.two-factor.showEnterCode');
        Route::post('two-factor/confirmCode', [TwoFactorController::class, 'confirmCode'])->name('auth.two-factor.confirmCode');
        Route::get('two-factor/deActive', [TwoFactorController::class, 'deActive'])->name('auth.two-factor.deActive');
        Route::get('login/code', [AuthenticatedSessionController::class, 'showCodeForm'])->name('auth.login.showCodeForm');
        Route::post('login/confirmCode', [AuthenticatedSessionController::class, 'confirmCode'])->name('auth.login.confirmCode');
    });
});
