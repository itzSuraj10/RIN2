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
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Impersonate a user
Route::get('/users/{user}/impersonate', [UserController::class, 'impersonateUser'])->name('users.impersonate');

// User Setting
Route::get('/users/{user}/setting', [UserController::class, 'editSetting'])->name('users.edit-setting');
Route::put('/users/{user}/setting', [UserController::class, 'updateSetting'])->name('users.update-setting');

// User post notification
Route::get('/users/{user}/post-notification', [NotificationController::class, 'create'])->name('users.create-notification');
Route::post('/users/{user}/post-notification', [NotificationController::class, 'storeNotification'])->name('users.store-notification');
Route::get('/users/{user}/notification-list', [NotificationController::class, 'listPostedNotifications'])->name('users.list-notification');
Route::get('/users/{user}/get-notification', [NotificationController::class, 'getNotification'])->name('users.get-notification');
Route::post('/users/{user}/markNotifyRead/{notificationId}', [NotificationController::class, 'markNotifyRead'])->name('users.mark-notify-read');
