<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function create()
    {
        return view('notifications.create');
    }
}
