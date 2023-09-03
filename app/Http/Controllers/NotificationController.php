<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{
    public function create(User $user)
    {
        $userList = User::all();
        return view('notifications.create', compact('user', 'userList'));
    }

    public function storeNotification(Request $request, User $user)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'type' => 'required|in:marketing,invoices,system',
            'message' => 'required|string|max:255',
            'destination' => 'required|in:specific_user,all_users',
            'user_id' => 'required_if:destination,specific_user',
        ]);

        try {
            // Use DB::transaction to ensure atomicity
            DB::beginTransaction();
            // Create a new notification
            $notification = Notification::create([
                'type' => $validatedData['type'],
                'message' => $validatedData['message'],
            ]);

            // Handle the destination based on user selection
            if ($validatedData['destination'] === 'specific_user') {
                // Attach the notification to the specific user
                $user->notifications()->attach($notification->id);
            } else {
                // Attach the notification to all users
                $users = User::all();
                foreach ($users as $u) {
                    $u->notifications()->attach($notification->id);
                }
            }
            DB::commit();
            // return Response::json(['message' => "Creation successfully"], 200);
            // return redirect()->route('users.impersonate', ['user' => $user->id]);
            return redirect()->back()->with('message', 'Notification created successfully');
        } catch (\Exception $e) {
            // Handle exceptions 
            DB::rollBack();
            // return Response::json(['message' => 'Failed to create notification: ' . $e->getMessage()], 400);
            return redirect()->back()->with('error', 'Failed to create notification: ' . $e->getMessage());
        }
    }

    public function listPostedNotifications(User $user)
    {
        $notifications = Notification::where('posted_by', $user->id)->get();

        return view('notifications.list', compact('user', 'notifications'));
    }
}
