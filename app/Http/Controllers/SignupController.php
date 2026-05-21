<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\State;
use App\Models\Role;
use App\Models\Post;


class SignupController extends Controller
{
    // Show Registration Form
    public function register()
    {
        $roles = Role::all();
        $states = State::all();
        return view('Register', compact('roles', 'states'));
    }
    // Handle Registration
    public function showform()
    {
        $roles = Role::all();
        $states = State::all();
        return view('user.register', compact('roles', 'states'));
    }

    // User listing for admin
    public function listing()
    {
        $users = User::with(['role', 'state'])
            ->latest()
            ->paginate(5);

        return view('user.list', compact('users'));
    }
    // Show Profile

    public function showAdminPanel()
    {
        return view('Admin.Admin_meta');
    }

    public function dashboard()
    {
        $users = User::with(['role', 'state'])->get();
        $roles = Role::all();
        $posts = Post::with(['user', 'likes', 'comments'])->get();

        // ── Line Chart: posts ka date + month ──
        $chartPosts = $posts->map(function ($p) {
            return [
                'date'  => $p->created_at->toDateString(),   // "2025-03-15"
                'month' => $p->created_at->format('Y-m'),    // "2025-03"
            ];
        })->values()->toArray();

        // ── Pie Chart: state-wise users ──
        $chartUsers = $users->map(function ($u) {
            return [
                'state' => $u->state?->name ?? 'Unknown',
            ];
        })->values()->toArray();

        return view('admin.dashboard', compact(
            'users',
            'posts',
            'roles',
            'chartPosts',
            'chartUsers'
        ));
    }

    // User Profile
    public function index()
    {
        $users = User::all();
        return view('user.list', compact('users'));
    }

    // Show Profile
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username'   => 'required|unique:users,username',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8|confirmed',
            'role_id'    => 'required|exists:roles,id',
            'state_id'   => 'nullable|exists:states,id',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,avif|max:5120',
        ]);

        $imagePath = null;

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')
                ->store('profiles', 'public');
        }

        User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'username'   => $request->username,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'role_id'    => $request->role_id,
            'state_id'   => $request->state_id,
            'bio'        => $request->bio,
            'profile_image' => $imagePath,
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Account created successfully!');
    }

    // Delete User
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('list')->with('success', 'User deleted successfully.');
    }
    // Edit User

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $states = State::all();

        return view('user.edit', compact('user', 'roles', 'states'));
    }

    // Update User
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);

        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
        ]);

        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        $user->state_id = $request->state_id;
        $user->save();

        return redirect()->route('list')->with('success', 'User updated successfully');
    }

    
}
