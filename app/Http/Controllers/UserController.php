<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['notifications as unread_notifications_count' => function ($query) {
            $query->where('user_notification.is_read', 0);
        }])->get();
        // dd($users);
        return view('users.index', compact('users'));
    }

    public function impersonateUser(User $user)
{
    // Retrieve the user's notifications
    $notifications = $user->notifications;

    return view('users.impersonate', compact('user', 'notifications'));
}
}
