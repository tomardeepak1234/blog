<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function create()
    {
        $states = State::all();
        $user = Auth::user();
        return view('profile', compact('states', 'user'));
    }

    //  Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6|confirmed',
            ]);

            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Current password incorrect'
                ]);
            }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    // Update Profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'state_id' => 'nullable|exists:states,id',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        $user->state_id = $request->state_id;

        if ($user->email !== $request->email) {
            $user->email = $request->email;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    // Deactivate Account
    public function deactivateAccount()
    {
        $user = Auth::user();

        $user->update([
            'is_active' => false
        ]);

        Auth::logout();

        return redirect('/login')->with('success', 'Account deactivated successfully');
    }

    //  Delete Account
    public function deleteAccount()
    {
        $user = Auth::user();

        if (!empty($user->profile_image) && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        Auth::logout();
        $user->delete();

        return redirect('/login')->with('success', 'Account deleted permanently');
    }

    public function updateAvatar(Request $request)
{
    $request->validate([
        'profile_image' => 'required|image|mimes:jpg,jpeg,png,avif|max:5120', // 5MB
    ]);

    $user = Auth::user();


    if (!empty($user->profile_image) && Storage::disk('public')->exists($user->profile_image)) {
        Storage::disk('public')->delete($user->profile_image);
    }


    $path = $request->file('profile_image')->store('profile_images', 'public');


    $user->update([
        'profile_image' => $path
    ]);

    return back()->with('success', 'Profile image updated successfully!');
}
}
