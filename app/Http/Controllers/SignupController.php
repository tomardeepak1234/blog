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
    // 🔥 Register Form Show
    public function register()
    {
           $roles = Role::all();
           $states = State::all();
      return view('Register', compact('roles', 'states'));
    }
    
    public function showform()
    {
          $roles = Role::all();
           $states = State::all();
        return view('user.register',compact('roles', 'states'));
    }

   

    public function listing()
    {
        $users = User::latest()->get();
        return view('user.list', compact('users'));
    }


    public function showAdminPanel()
    {
        return view('Admin.Admin_meta');
    }
    
  public function dashboard()
    {
       
    $users = User::all();
    $posts = Post::all();
    $roles = Role::all();
    return view('admin.dashboard', compact('users','posts','roles'));

    }

    public function index()
{
    $users = User::all();
    return view('user.list', compact('users'));
}

  
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
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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

    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('list')->with('success', 'User deleted successfully.');
}

public function edit($id)
{
    $user = User::findOrFail($id);
    $roles = Role::all(); 

    return view('user.edit', compact('user','roles'));
}


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
    $user->save();

    return redirect()->route('list')->with('success','User updated successfully');
}
}