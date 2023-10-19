<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MessagesController;

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

Route::get('/', function () { return redirect()->route('home'); });

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'handle'])->name('register');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'handle'])->name('login');

Route::post('/logout', [LogoutController::class, 'handle'])->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [MainController::class, 'home'])->name('home');
    Route::get('/profile', [MainController::class, 'profile'])->name('profile');
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
    Route::get('/settings', [MainController::class, 'settings'])->name('settings');
    Route::get('/user/{username}', [MainController::class, 'display'])->name('display');

    Route::post('/update-username', [MainController::class, 'update_username'])->name('update-username');
    Route::post('/update-password', [MainController::class, 'update_password'])->name('update-password');
    Route::post('/delete-user', [MainController::class, 'delete_user'])->name('delete-user');

    Route::post('/update-account-about-me', [MainController::class, 'update_account_about_me'])->name('update-account-about-me');
    Route::post('/update-account-username', [MainController::class, 'update_account_username'])->name('update-account-username');
    Route::post('/add-account-game', [MainController::class, 'add_account_game'])->name('add-account-game');
    Route::post('/remove-account-game', [MainController::class, 'remove_account_game'])->name('remove-account-game');


    Route::get('/messages/{chat_with}', [MessagesController::class, 'chat'])->name('chat');
    Route::post('/messages/send/{send_to}', [MessagesController::class, 'send_message'])->name('send_message');
    Route::post('/messages/create', [MessagesController::class, 'create_chat'])->name('create-new-chat');

    Route::get('/search-users/{searchTerm}', [MainController::class, 'search_users'])->name('search-users');
});
