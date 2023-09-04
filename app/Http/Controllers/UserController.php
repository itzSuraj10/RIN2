<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::withCount(['notifications as unread_notifications_count' => function ($query) {
            $query->where('user_notification.is_read', 0)
            ->where('expires_at', '>=', now());
        }]);

        if ($request->filled('search')) {
            $users->where(function ($query) use ($request) {
                $searchTerm = $request->input('search');
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $users = $users->get();
        return view('users.index', compact('users'));
    }

    public function impersonateUser(Request $request, User $user)
    {
        // Retrieve the user's notifications
        $notifications = $user->notifications();

        if ($request->filled('search')) {
            $notifications->where(function ($query) use ($request) {
                $searchTerm = $request->input('search');
                $query->where('message', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('type', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('filter')) {
                $notifications->where('type', $request->input('filter') );
        }
        $notifications = $notifications->get();

        return view('users.impersonate', compact('user', 'notifications'));
    }

    public function editSetting(User $user)
    {
        // Retrieve the user's notifications
        $notifications = $user->notifications;

        return view('users.setting', compact('user', 'notifications'));
    }

    public function updateSetting(Request $request, User $user)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'notification_switch' => 'required|in:true,false',
            'email' => 'required|email',
            'phone_number' => 'nullable|numeric', 
        ]);
        
        try {
            // Use DB::transaction to ensure atomicity
            DB::beginTransaction();
            // Update user notification settings
            $user->update([
                'notification_switch' => ($validatedData['notification_switch'] == 'true') ? 1 : 0,
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
            ]);

            DB::commit();
            
            return redirect()->back()->with('message', 'User setting updated successfully');
        } catch (\Exception $e) {
            // Handle exceptions 
            DB::rollBack();
            // return Response::json(['message' => 'Failed to create notification: ' . $e->getMessage()], 400);
            return redirect()->back()->with('error', 'Failed to update user setting: ' . $e->getMessage());
        }
    }
}
