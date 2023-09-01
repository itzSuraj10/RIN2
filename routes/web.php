<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
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

Route::redirect('/', '/users');

// List users and their notification counts
Route::get('/users', [UserController::class, 'index']);

// Impersonate a user
Route::get('/users/{user}/impersonate', [UserController::class, 'impersonateUser'])->name('users.impersonate');

// User post notification
Route::get('/users/{user}/post-notification', [NotificationController::class, 'create'])->name('users.create-notification');
Route::post('/users/{user}/post-notification', [NotificationController::class, 'store'])->name('users.store-notification');

// Mark a single notification as read
Route::get('/mark-as-read/{user}/{notification}', [UserController::class, 'markNotificationAsRead'])->name('users.mark-as-read');

// Mark all notifications as read
Route::get('/mark-all-as-read/{user}', [UserController::class, 'markAllNotificationsAsRead'])->name('users.mark-all-as-read');