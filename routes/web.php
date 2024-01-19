<?php


use Illuminate\Support\Facades\Route;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\MessagesController;
use App\Http\Controllers\SendMessageController;
use Carbon\Carbon;

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

// web.php

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::view('/create-message', 'create-message')
     ->middleware('auth')
     ->name('create-message');
     
Route::get('dashboard', [MessagesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('/messages', [SendMessageController::class, 'store'])->name('message.store');

Route::get('message-sent', function () {
    return view('message-sent', ['dateToBeSent' => session('dateToBeSent')]);
})->name('message-sent');

Route::delete('/message/{id}', [MessagesController::class, 'destroy'])->name('message.delete');

Route::get('/testroute', function() {
    $name = "Funny Coder";

    // The email sending is done using the to method on the Mail facade
    Mail::to('dearfuturemetest@gmail.com')->send(new VerifyMail($name));
});

require __DIR__ . '/auth.php';




// Route::get('/', function () {
//     return view('welcome');
// })->middleware('guest');

// Route::middleware(['auth', 'verified'])->group(function () {

//     Route::view('/create-message', 'create-message')->name('create-message');

//     Route::get('dashboard', [MessagesController::class, 'index'])->name('dashboard');

//     Route::view('profile', 'profile')->name('profile');

//     Route::post('/messages', [SendMessageController::class, 'store'])->name('message.store');

//     Route::get('message-sent', function () {
//         return view('message-sent', ['dateToBeSent' => session('dateToBeSent')]);
//     })->name('message-sent');
    
//     Route::delete('/message/{id}', [MessagesController::class, 'destroy'])->name('message.delete');
// });

// require __DIR__ . '/auth.php';
