<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SuperAdminController extends Controller
{
    public function __construct()
    {
        // Apply middleware to ensure the user is authenticated
        $this->middleware('auth');
    }
    public function admin()
    {

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        return view('admin.dashboard', ['user' => $user]);
    }

    public function profile()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        return view('admin.profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string',
            'department' => 'nullable|string|max:255',
            'profile_role' => 'nullable|string|max:255',
            'staff_student_id' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
        ]);

        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->department = $request->department;
        $user->profile_role = $request->profile_role;
        $user->staff_student_id = $request->staff_student_id;
        $user->title = $request->title;

        if ($request->hasFile('avatar')) {
            // Define the custom directory path within the public folder
            $destinationPath = public_path('profile/u/assets');

            // Generate a unique file name to avoid collisions
            $avatarFileName = uniqid() . '_' . $request->file('avatar')->getClientOriginalName();

            // Move the uploaded file to the public/profile/u/assets directory
            $request->file('avatar')->move($destinationPath, $avatarFileName);

            // Update the user's avatar path
            $user->avatar = 'profile/u/assets/' . $avatarFileName;
        }

        $user->save();

        return redirect()->route('admin_profile')->with('success', 'Profile updated successfully.');
    }
}
